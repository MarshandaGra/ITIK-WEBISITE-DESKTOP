<?php

namespace App\Http\Controllers;

use App\Models\DraftJawaban;
use App\Models\Mengerjakan;
use App\Models\Remedial;
use App\Models\RemedialSiswa;
use App\Models\Soal;
use Illuminate\Support\Facades\Auth;

class ValidasiNilaiController extends Controller
{
    /**
     * Menampilkan daftar nilai siswa
     */
    public function index()
    {
        $hasil = Mengerjakan::with(['kuis', 'siswa', 'validator'])
            ->where('status_pengerjaan', 'final')
            ->orderBy('status_validasi')
            ->orderByDesc('tanggal')
            ->get();

        return view('guru.nilai.index', compact('hasil'));
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
}
