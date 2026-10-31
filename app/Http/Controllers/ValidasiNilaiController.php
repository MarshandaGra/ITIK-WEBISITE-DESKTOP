<?php

namespace App\Http\Controllers;

use App\Models\DraftJawaban;
use App\Models\Kuis;
use App\Models\Mengerjakan;
use App\Models\Remedial;
use App\Models\RemedialSiswa;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidasiNilaiController extends Controller
{
    /**
     * Menampilkan daftar nilai siswa
     */
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');
        $percobaan = $request->query('percobaan');
        $kelulusan = $request->query('kelulusan');
        $tanggal = $request->query('tanggal');

        $query = Mengerjakan::with(['kuis', 'siswa', 'validator'])
            ->where('status_pengerjaan', 'final');

        if ($kategori) {
            $query->whereHas('kuis', function ($q) use ($kategori) {
                $q->whereRaw('LOWER(TRIM(kategori)) = ?', [strtolower(trim($kategori))]);
            });
        }

        if ($percobaan) {
            $query->where('percobaan_ke', (int) $percobaan);
        }

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        $hasil = $query->orderBy('status_validasi')
            ->orderByDesc('tanggal')
            ->get();

        if ($kelulusan) {
            $hasil = $hasil->filter(function ($item) use ($kelulusan) {
                $lulus = $item->nilai !== null && $item->kuis && $item->kuis->kkm !== null && $item->nilai >= $item->kuis->kkm;
                if ($kelulusan === 'lulus') {
                    return $lulus;
                } elseif ($kelulusan === 'tidak_lulus') {
                    return !$lulus;
                }
                return true;
            })->values();
        }

        $sudahDitugaskanRemedial = RemedialSiswa::pluck('id_mengerjakan_asal')->toArray();

        // Daftar kategori kuis unik untuk filter
        $daftarKategori = Kuis::distinct()->pluck('kategori')->filter()->values();

        return view('guru.nilai.index', compact(
            'hasil',
            'sudahDitugaskanRemedial',
            'daftarKategori',
            'kategori',
            'percobaan',
            'kelulusan',
            'tanggal'
        ));
    }

    /**
     * Menampilkan detail hasil nilai siswa
     */
    public function show($id)
    {
        $mengerjakan = Mengerjakan::with(['siswa','kuis','validator',])
            ->findOrFail($id);

        $remedial = null;

        if ($mengerjakan->kuis->kategori === 'remedial') {

            $remedial = RemedialSiswa::with([
                'mengerjakanAsal.kuis',
            ])
                ->where(
                    'id_kuis_remedial',
                    $mengerjakan->id_kuis
                )
                ->whereHas('mengerjakanAsal', function ($query) use ($mengerjakan) {

                    $query->where(
                        'id_user',
                        $mengerjakan->id_user
                    );

                })
                ->first();
        }

        $soal = $mengerjakan->kuis->soal()->orderBy('id_soal')->get();
        $draftJawaban = DraftJawaban::where('id_kuis', $mengerjakan->id_kuis)
            ->where('id_user', $mengerjakan->id_user)
            ->get()
            ->keyBy('id_soal');

        $totalBenar = 0;
        $totalSalah = 0;
        foreach ($soal as $s) {
            $jw = $draftJawaban->get($s->id_soal)?->jawaban_dipilih;
            if ($jw && $s->jawaban && strtoupper($jw) === strtoupper($s->jawaban)) {
                $totalBenar++;
            } else {
                $totalSalah++;
            }
        }

        return view(
            'guru.nilai.show',
            compact(
                'mengerjakan',
                'remedial',
                'soal',
                'draftJawaban',
                'totalBenar',
                'totalSalah'
            )
        );
    }

    /**
     * Validasi nilai siswa
     */
    public function validasi(Mengerjakan $mengerjakan)
    {
        if ($mengerjakan->status_validasi === 'sudah divalidasi') {
            return redirect()
                ->route('guru.nilai.show', $mengerjakan->id_mengerjakan)
                ->with('error', 'Nilai ini sudah divalidasi.');
        }

        $mengerjakan->update([
            'status_validasi' => 'sudah divalidasi',
            'id_validator' => Auth::user()->id_user,
        ]);

        return redirect()
            ->route('guru.nilai.show', $mengerjakan->id_mengerjakan)
            ->with('success', 'Nilai siswa berhasil divalidasi.');
    }

    /**
     * Berikan tugas remedial langsung dari menu Nilai
     */
    public function tugaskanRemedial($id_mengerjakan)
    {
        $mengerjakan = Mengerjakan::with(['kuis', 'siswa'])->findOrFail($id_mengerjakan);

        if (strtolower(trim($mengerjakan->kuis->kategori ?? '')) !== 'ulangan') {
            return back()->with('error', 'Tugas remedial hanya dapat diberikan untuk kuis berkategori Ulangan.');
        }

        if ($mengerjakan->nilai === null || ($mengerjakan->kuis->kkm !== null && $mengerjakan->nilai >= $mengerjakan->kuis->kkm)) {
            return back()->with('error', 'Siswa ini sudah mencapai KKM.');
        }

        // Cari kuis remedial untuk kuis ulangan ini
        $remedial = Remedial::where('id_kuis_asal', $mengerjakan->id_kuis)->first();

        // Jika belum ada kuis remedial untuk ulangan ini, buatkan otomatis
        if (!$remedial) {
            $nomor = Kuis::query()
                ->pluck('id_kuis')
                ->map(fn($id) => (int) preg_replace('/^K/', '', $id))
                ->max() ?? 0;
            $newId = 'K' . str_pad($nomor + 1, 3, '0', STR_PAD_LEFT);

            $kuisRemedial = Kuis::create([
                'id_kuis' => $newId,
                'judul' => 'Remedial - ' . $mengerjakan->kuis->judul,
                'deskripsi' => 'Kuis remedial untuk perbaikan nilai ' . $mengerjakan->kuis->judul,
                'kategori' => 'remedial',
                'tingkat_kesulitan' => $mengerjakan->kuis->tingkat_kesulitan ?? 'sedang',
                'id_mapel' => $mengerjakan->kuis->id_mapel,
                'id_tahun_ajaran' => $mengerjakan->kuis->id_tahun_ajaran,
                'alokasi_waktu' => $mengerjakan->kuis->alokasi_waktu ?? 20,
                'kkm' => $mengerjakan->kuis->kkm ?? 75.00,
                'id_user' => Auth::user()->id_user,
                'status_publikasi' => 'terbit',
                'id_publisher' => Auth::user()->id_user,
                'is_aktif' => true,
            ]);

            $remedial = Remedial::create([
                'id_kuis_remedial' => $kuisRemedial->id_kuis,
                'id_kuis_asal' => $mengerjakan->id_kuis,
            ]);
        }

        RemedialSiswa::firstOrCreate(
            [
                'id_kuis_remedial' => $remedial->id_kuis_remedial,
                'id_mengerjakan_asal' => $mengerjakan->id_mengerjakan,
            ],
            [
                'id_guru' => Auth::user()->id_user,
                'tanggal_ditugaskan' => now()->toDateString(),
                'status' => 'ditugaskan',
            ]
        );

        $namaSiswa = $mengerjakan->siswa->nama_lengkap ?? 'siswa';
        return back()->with('success', "Tugas remedial berhasil diberikan kepada {$namaSiswa}!");
    }
}
