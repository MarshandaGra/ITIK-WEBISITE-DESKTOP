@extends('layouts.guru')
@section('title', 'Detail Soal - ' . $kuis->judul)

@push('styles')
<style>
    .soal-display {
        font-size: 16px;
        line-height: 1.7;
        color: #202044;
        background: #fbfafd;
        border: 1px solid #ebe6f7;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }
    .opsi-box-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 14px 18px;
        border-radius: 12px;
        border: 1px solid #ebe6f7;
        background: #ffffff;
        margin-bottom: 12px;
    }
    .opsi-box-item.is-correct {
        background: #f0fdf4;
        border-color: #86efac;
    }
    .opsi-circle {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #ede9fc;
        color: #5542dc;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .opsi-box-item.is-correct .opsi-circle {
        background: #166534;
        color: white;
    }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}" class="muted small" style="display:inline-block; margin-bottom:6px;">
            ← Kembali ke daftar soal
        </a>
        <h1>Detail Butir Soal</h1>
        <p>Kuis: <strong>{{ $kuis->judul }}</strong> &bull; ID Soal: {{ $soal->id_soal }}</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('kuis.soal.edit', [$kuis->id_kuis, $soal->id_soal]) }}" class="btn btn-primary">
            ✎ Edit Soal
        </a>
    </div>
</div>

<section class="card" style="margin-bottom: 24px;">
    <div class="card-header">
        <div>
            <h2>Pertanyaan & Kunci Jawaban</h2>
            <p class="muted">Tinjau isi pertanyaan dan konfigurasi kunci jawaban.</p>
        </div>
        <div style="display: flex; gap: 8px;">
            <span class="badge badge-info">Bobot: {{ $soal->bobot ? number_format($soal->bobot, 2) . '%' : 'Otomatis' }}</span>
            @if ($soal->tingkat_kesulitan)
                <span class="badge {{ $soal->tingkat_kesulitan === 'sulit' ? 'badge-danger' : ($soal->tingkat_kesulitan === 'sedang' ? 'badge-warning' : 'badge-info') }}">
                    {{ ucfirst($soal->tingkat_kesulitan) }}
                </span>
            @endif
        </div>
    </div>

    <div class="soal-display">
        <strong>Soal:</strong>
        <p style="margin-top: 8px; white-space: pre-line;">{{ $soal->pertanyaan }}</p>
    </div>

    <h3 style="font-size: 15px; margin-bottom: 12px; color: #202044;">Alternatif Pilihan Jawaban:</h3>

    @foreach (['A' => $soal->opsi_a, 'B' => $soal->opsi_b, 'C' => $soal->opsi_c, 'D' => $soal->opsi_d, 'E' => $soal->opsi_e] as $huruf => $opsi)
        @if ($opsi !== null && $opsi !== '')
            <div class="opsi-box-item {{ $soal->jawaban === $huruf ? 'is-correct' : '' }}">
                <div class="opsi-circle">{{ $huruf }}</div>
                <div style="flex: 1; font-size: 15px; color: #202044;">
                    {{ $opsi }}
                </div>
                @if ($soal->jawaban === $huruf)
                    <span class="badge badge-success" style="font-size: 12px;">✓ Kunci Benar</span>
                @endif
            </div>
        @endif
    @endforeach

    @if ($soal->pembahasan)
        <div style="background: #fbfafd; border-radius: 12px; padding: 16px 20px; border-left: 4px solid #5542dc; margin-top: 20px;">
            <strong style="color: #202044; display: block; margin-bottom: 6px;">Pembahasan:</strong>
            <p style="margin: 0; font-size: 14px; color: #575279; line-height: 1.6;">{{ $soal->pembahasan }}</p>
        </div>
    @endif
</section>

@endsection
