@extends('layouts.siswa')
@section('title', 'Hasil Kuis - ' . $kuis->judul)

@push('styles')
<style>
    .score-card {
        text-align: center;
        padding: 30px;
    }
    .score-number {
        font-size: 58px;
        font-weight: 800;
        color: #166534;
        line-height: 1.1;
        margin: 10px 0;
    }
    .score-number.gagal {
        color: #991b1b;
    }
    .eval-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }
    .eval-stat-box {
        background: #f8f7fc;
        padding: 12px;
        border-radius: 12px;
    }
    .eval-stat-num {
        font-size: 24px;
        font-weight: 700;
    }
    .eval-stat-label {
        font-size: 11px;
        color: var(--muted);
    }
    .soal-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 16px;
        border-left: 5px solid #d1d5db;
    }
    .soal-card.benar { border-left-color: #10b981; }
    .soal-card.salah { border-left-color: #ef4444; }
    .soal-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }
    .soal-card-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--ink);
    }
    .soal-pertanyaan {
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 12px;
    }
    .opsi-review-list {
        display: grid;
        gap: 8px;
    }
    .opsi-review-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        border-radius: 8px;
        background: #f9fafb;
        border: 1px solid var(--border);
        font-size: 13px;
    }
    .opsi-review-item.kunci {
        background: #ecfdf5;
        border-color: #a7f3d0;
        font-weight: 600;
    }
    .opsi-review-item.jawaban-salah {
        background: #fef2f2;
        border-color: #fecaca;
    }
    .opsi-label {
        font-weight: 700;
        width: 20px;
    }
    .opsi-status-text {
        margin-left: auto;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 10px;
    }
    .opsi-status-text.kunci {
        background: #d1fae5;
        color: #065f46;
    }
    .opsi-status-text.jawaban-kamu {
        background: #fee2e2;
        color: #991b1b;
    }
</style>
@endpush

@section('content')
@php
    $lulus = $lulus ?? ($hasil->nilai !== null && $kuis->kkm !== null && (float) $hasil->nilai >= (float) $kuis->kkm);
@endphp

<div class="page-heading">
    <div>
        <a href="{{ route('siswa.kuis.index') }}" class="btn btn-secondary" style="display:inline-block; margin-bottom:10px;">
            ← Kembali
        </a>
        <h1>Hasil Kuis</h1>
        <p>{{ $kuis->judul }}</p>
    </div>
    <div class="actions">
        @php
            $katKuis = strtolower(trim($kuis->kategori ?? ''));
            $bolehUlang = in_array($katKuis, ['kuis harian', 'pre-test', 'pass-test']);
        @endphp

        @if(!$lulus && $bolehUlang)
            <a href="{{ route('siswa.kuis.mulai', $kuis->id_kuis) }}" class="btn btn-warning">
                ↻ Kerjakan Ulang Kuis
            </a>
        @elseif(!$lulus && $katKuis === 'ulangan')
            <a href="{{ route('siswa.remedial.index') }}" class="btn btn-warning">
                Lihat Tugas Remedial
            </a>
        @endif
        <a href="{{ route('siswa.kuis.index') }}" class="btn btn-secondary">
            Daftar Kuis
        </a>
    </div>
</div>

<div class="grid grid-2">
    <!-- KIRI: KARTU NILAI -->
    <section class="card score-card">
        <span class="muted small">Nilai Akhir Kamu</span>
        <div class="score-number {{ $lulus ? '' : 'gagal' }}">
            {{ $hasil->nilai }}
        </div>

        <div>
            @if($lulus)
                <span class="badge badge-success">✓ Lulus (≥ KKM {{ $kuis->kkm ?? '-' }})</span>
            @else
                <span class="badge badge-warning">⚠️ Tidak Lulus (&lt; KKM {{ $kuis->kkm ?? '-' }})</span>
            @endif
        </div>

        <div class="eval-stats">
            <div class="eval-stat-box">
                <div class="eval-stat-num" style="color: #166534;">{{ $totalBenar ?? 0 }}</div>
                <div class="eval-stat-label">Jawaban Benar</div>
            </div>
            <div class="eval-stat-box">
                <div class="eval-stat-num" style="color: #991b1b;">{{ $totalSalah ?? 0 }}</div>
                <div class="eval-stat-label">Jawaban Salah</div>
            </div>
            <div class="eval-stat-box">
                <div class="eval-stat-num" style="color: var(--purple);">{{ count($soal ?? []) }}</div>
                <div class="eval-stat-label">Total Butir Soal</div>
            </div>
        </div>
    </section>

    <!-- KANAN: DETAIL KUIS -->
    <section class="card">
        <div class="card-header">
            <h2>Detail Pengerjaan</h2>
            <span class="badge">{{ ucfirst($kuis->kategori) }}</span>
        </div>

        <dl class="identity">
            <div>
                <dt>Judul Kuis</dt>
                <dd>{{ $kuis->judul }}</dd>
            </div>
            <div>
                <dt>KKM</dt>
                <dd>{{ $kuis->kkm ?? '-' }}</dd>
            </div>
            <div>
                <dt>Percobaan Ke</dt>
                <dd>{{ $hasil->percobaan_ke }}</dd>
            </div>
            <div>
                <dt>Waktu Pengerjaan</dt>
                <dd>{{ $durasiTampil ?? 'Belum tercatat' }}</dd>
            </div>
        </dl>
    </section>
</div>

<!-- EVALUASI SOAL BENAR & SALAH -->
@if(isset($soal) && $soal->isNotEmpty())
    <section class="card">
        <div class="card-header">
            <div>
                <h2>📋 Evaluasi Soal (Benar &amp; Salah)</h2>
                <p class="muted">Pelajari butir soal untuk mengevaluasi pemahaman materi Anda.</p>
            </div>
        </div>

        @foreach($soal as $itemSoal)
            @php
                $jawabanDipilih = $draftJawaban->get($itemSoal->id_soal)?->jawaban_dipilih;
                $kunciBenar = $itemSoal->jawaban ? strtoupper($itemSoal->jawaban) : null;
                $isBenar = $jawabanDipilih && $kunciBenar && strtoupper($jawabanDipilih) === $kunciBenar;
                $opsiMap = [
                    'A' => $itemSoal->opsi_a,
                    'B' => $itemSoal->opsi_b,
                    'C' => $itemSoal->opsi_c,
                    'D' => $itemSoal->opsi_d,
                    'E' => $itemSoal->opsi_e,
                ];
            @endphp

            <div class="soal-card {{ $isBenar ? 'benar' : 'salah' }}">
                <div class="soal-card-header">
                    <div class="soal-card-title">
                        Soal #{{ $loop->iteration }}
                        <span class="muted small" style="margin-left: 6px;">(Bobot: {{ $itemSoal->bobot ?? 0 }}%)</span>
                    </div>

                    @if($isBenar)
                        <span class="badge badge-success">✓ Jawaban Benar (+{{ $itemSoal->bobot ?? 0 }}%)</span>
                    @elseif($jawabanDipilih)
                        <span class="badge badge-warning">✗ Jawaban Salah (Kamu pilih: {{ strtoupper($jawabanDipilih) }})</span>
                    @else
                        <span class="badge badge-muted">○ Tidak Dijawab</span>
                    @endif
                </div>

                <div class="soal-pertanyaan">
                    {{ $itemSoal->pertanyaan }}
                </div>

                <div class="opsi-review-list">
                    @foreach($opsiMap as $huruf => $teksOpsi)
                        @if($teksOpsi)
                            @php
                                $isKunci = $kunciBenar === $huruf;
                                $isDipilihSiswa = strtoupper($jawabanDipilih ?? '') === $huruf;
                                $itemClass = '';
                                if ($isKunci) {
                                    $itemClass = 'kunci';
                                } elseif ($isDipilihSiswa && !$isBenar) {
                                    $itemClass = 'jawaban-salah';
                                }
                            @endphp

                            <div class="opsi-review-item {{ $itemClass }}">
                                <div class="opsi-label">{{ $huruf }}.</div>
                                <div style="flex: 1;">{{ $teksOpsi }}</div>

                                @if($isKunci && $isDipilihSiswa)
                                    <span class="opsi-status-text kunci">✓ Pilihan Kamu (Benar)</span>
                                @elseif($isKunci)
                                    <span class="opsi-status-text kunci">✓ Kunci Jawaban</span>
                                @elseif($isDipilihSiswa)
                                    <span class="opsi-status-text jawaban-kamu">✗ Pilihan Kamu (Salah)</span>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
@endif

@endsection
