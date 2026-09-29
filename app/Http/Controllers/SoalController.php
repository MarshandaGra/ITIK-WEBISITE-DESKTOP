<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index(Kuis $kuis)
    {
        $soal = $kuis->soal()
            ->orderBy('id_soal')
            ->get();

        return view('soal.index', compact('kuis', 'soal'));
    }

    public function create(Kuis $kuis)
    {
        return view('soal.create', compact('kuis'));
    }

    public function store(Request $request, Kuis $kuis)
    {
        // Soal hanya boleh dibuat ketika kuis masih draft
        if ($kuis->status_publikasi !== 'draft') {
            return redirect()
                ->route('kuis.show', $kuis->id_kuis)
                ->with(
                    'error',
                    'Soal tidak dapat ditambahkan karena kuis sudah diterbitkan.'
                );
        }

        $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'nullable|string|max:255',
            'opsi_b' => 'nullable|string|max:255',
            'opsi_c' => 'nullable|string|max:255',
            'opsi_d' => 'nullable|string|max:255',
            'opsi_e' => 'nullable|string|max:255',
            'jawaban' => 'nullable|in:A,B,C,D,E',
            'tingkat_kesulitan' => 'nullable|string|max:50',
        ]);

        $jumlahSoal = $kuis->soal()->count();

        $idSoal = 'S' . str_pad(
            $jumlahSoal + 1,
            3,
            '0',
            STR_PAD_LEFT
        );

        // Pastikan ID tidak bentrok
        while (Soal::where('id_soal', $idSoal)->exists()) {
            $jumlahSoal++;

            $idSoal = 'S' . str_pad(
                $jumlahSoal + 1,
                3,
                '0',
                STR_PAD_LEFT
            );
        }

        $kuis->soal()->create([
            'id_soal' => $idSoal,
            'pertanyaan' => $request->pertanyaan,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'opsi_e' => $request->opsi_e,
            'jawaban' => $request->jawaban,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
        ]);

        return redirect()
            ->route('kuis.soal.index', $kuis->id_kuis)
            ->with('success', 'Soal berhasil ditambahkan.');
    }

    public function show(Kuis $kuis, Soal $soal)
    {
        $this->checkSoalBelongsToKuis($kuis, $soal);

        return view('soal.show', compact('kuis', 'soal'));
    }

    public function edit(Kuis $kuis, Soal $soal)
    {
        $this->checkSoalBelongsToKuis($kuis, $soal);

        if ($kuis->status_publikasi !== 'draft') {
            return redirect()
                ->route('kuis.soal.index', $kuis->id_kuis)
                ->with(
                    'error',
                    'Soal tidak dapat diedit karena kuis sudah diterbitkan.'
                );
        }

        return view('soal.edit', compact('kuis', 'soal'));
    }

    public function update(Request $request, Kuis $kuis, Soal $soal)
    {
        $this->checkSoalBelongsToKuis($kuis, $soal);

        if ($kuis->status_publikasi !== 'draft') {
            return redirect()
                ->route('kuis.soal.index', $kuis->id_kuis)
                ->with(
                    'error',
                    'Soal tidak dapat diedit karena kuis sudah diterbitkan.'
                );
        }

        $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'nullable|string|max:255',
            'opsi_b' => 'nullable|string|max:255',
            'opsi_c' => 'nullable|string|max:255',
            'opsi_d' => 'nullable|string|max:255',
            'opsi_e' => 'nullable|string|max:255',
            'jawaban' => 'nullable|in:A,B,C,D,E',
            'tingkat_kesulitan' => 'nullable|string|max:50',
        ]);

        $soal->update([
            'pertanyaan' => $request->pertanyaan,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'opsi_e' => $request->opsi_e,
            'jawaban' => $request->jawaban,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
        ]);

        return redirect()
            ->route('kuis.soal.index', $kuis->id_kuis)
            ->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Kuis $kuis, Soal $soal)
    {
        $this->checkSoalBelongsToKuis($kuis, $soal);

        if ($kuis->status_publikasi !== 'draft') {
            return redirect()
                ->route('kuis.soal.index', $kuis->id_kuis)
                ->with(
                    'error',
                    'Soal tidak dapat dihapus karena kuis sudah diterbitkan.'
                );
        }

        $soal->delete();

        return redirect()
            ->route('kuis.soal.index', $kuis->id_kuis)
            ->with('success', 'Soal berhasil dihapus.');
    }

    private function checkSoalBelongsToKuis(Kuis $kuis, Soal $soal): void
    {
        if ($soal->id_kuis !== $kuis->id_kuis) {
            abort(404);
        }
    }
}
