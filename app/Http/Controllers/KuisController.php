<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class KuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::where('is_aktif', true)
            ->with('pembuat')
            ->latest('created_at')
            ->get();

        return view('kuis.index', compact('kuis'));
    }

    public function create()
    {
        $materis = Materi::orderBy('bab')
            ->orderBy('judul')
            ->get();

        return view('kuis.create', compact('materis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'kategori' => [
                'required',
                Rule::in([
                    'post-test',
                    'pass-test',
                    'kuis harian',
                    'ulangan',
                    'remedial',
                ]),
            ],
            'alokasi_waktu' => 'nullable|integer|min:1',
            'kkm' => 'nullable|numeric|min:0|max:100',
            'waktu_mulai' => 'nullable|date',
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
            'materi' => 'nullable|array',
            'materi.*' => 'exists:materis,id_materi',
        ]);

        /*
         * Validasi khusus kategori ulangan.
         */
        if ($validated['kategori'] === 'ulangan') {

            if (
                empty($validated['waktu_mulai']) ||
                empty($validated['waktu_selesai'])
            ) {
                return back()
                    ->withErrors([
                        'waktu_mulai' =>
                            'Kuis ulangan wajib memiliki waktu mulai dan waktu selesai.',
                    ])
                    ->withInput();
            }

        } else {

            /*
             * Kategori selain ulangan tidak menggunakan
             * jendela waktu khusus.
             */
            $validated['waktu_mulai'] = null;
            $validated['waktu_selesai'] = null;
        }

        /*
         * Remedial sementara kita tangani setelah CRUD dasar.
         */
        if ($validated['kategori'] === 'remedial') {
            // nanti ditambahkan relasi remedial
        }

        $validated['id_kuis'] = 'K' . str_pad(
            Kuis::count() + 1,
            3,
            '0',
            STR_PAD_LEFT
        );

        $validated['id_user'] = Auth::user()->id_user;

        $validated['status_publikasi'] = 'draft';

        unset($validated['materi']);

        $kuis = Kuis::create($validated);

        /*
         * Hubungkan materi untuk kategori
         * post-test, pass-test, kuis harian, dan ulangan.
         */
        if (
            $request->filled('materi') &&
            $validated['kategori'] !== 'remedial'
        ) {
            $kuis->materi()->sync($request->materi);
        }

        return redirect()
            ->route('kuis.index')
            ->with('success', 'Kuis berhasil dibuat sebagai draft.');
    }

    public function show($id)
    {
        $kuis = Kuis::with([
            'pembuat',
            'materi',
            'soal',
        ])->findOrFail($id);

        return view('kuis.show', compact('kuis'));
    }

    public function edit($id)
    {
        $kuis = Kuis::findOrFail($id);

        /*
         * Kuis yang sudah terbit tidak boleh diedit
         * sembarangan.
         */
        if ($kuis->status_publikasi === 'terbit') {
            return back()->withErrors([
                'kuis' => 'Kuis yang sudah terbit tidak dapat diedit.',
            ]);
        }

        $materis = Materi::orderBy('bab')
            ->orderBy('judul')
            ->get();

        $materiTerpilih = $kuis->materi
            ->pluck('id_materi')
            ->toArray();

        return view(
            'kuis.edit',
            compact('kuis', 'materis', 'materiTerpilih')
        );
    }

    public function update(Request $request, $id)
    {
        $kuis = Kuis::findOrFail($id);

        if ($kuis->status_publikasi === 'terbit') {
            return back()->withErrors([
                'kuis' => 'Kuis yang sudah terbit tidak dapat diedit.',
            ]);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'kategori' => [
                'required',
                Rule::in([
                    'post-test',
                    'pass-test',
                    'kuis harian',
                    'ulangan',
                    'remedial',
                ]),
            ],
            'alokasi_waktu' => 'nullable|integer|min:1',
            'kkm' => 'nullable|numeric|min:0|max:100',
            'waktu_mulai' => 'nullable|date',
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
            'materi' => 'nullable|array',
            'materi.*' => 'exists:materis,id_materi',
        ]);

        if ($validated['kategori'] === 'ulangan') {

            if (
                empty($validated['waktu_mulai']) ||
                empty($validated['waktu_selesai'])
            ) {
                return back()
                    ->withErrors([
                        'waktu_mulai' =>
                            'Kuis ulangan wajib memiliki waktu mulai dan waktu selesai.',
                    ])
                    ->withInput();
            }

        } else {
            $validated['waktu_mulai'] = null;
            $validated['waktu_selesai'] = null;
        }

        unset($validated['materi']);

        $kuis->update($validated);

        if ($validated['kategori'] !== 'remedial') {
            $kuis->materi()->sync($request->materi ?? []);
        }

        return redirect()
            ->route('kuis.index')
            ->with('success', 'Kuis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kuis = Kuis::findOrFail($id);

        /*
         * Soft delete / arsip.
         * Kita tidak menggunakan delete()
         * karena kuis bisa memiliki riwayat nilai.
         */
        $kuis->update([
            'is_aktif' => false,
        ]);

        return redirect()
            ->route('kuis.index')
            ->with('success', 'Kuis berhasil diarsipkan.');
    }
}
