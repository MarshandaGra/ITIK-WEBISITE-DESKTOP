@extends('layouts.siswa')
@section('title', 'Nilai Saya')

@push('styles')
<style>
    /* BREADCRUMB */
    .breadcrumb-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 22px;
        font-size: 13px;
        color: var(--muted);
        flex-wrap: wrap;
    }
    .breadcrumb-wrap a {
        color: var(--purple);
        font-weight: 600;
    }
    .breadcrumb-wrap .current {
        color: var(--ink);
        font-weight: 700;
    }

    /* GRID MATA PELAJARAN */
    .mapel-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }
    .mapel-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all .2s ease;
        color: inherit;
        text-decoration: none;
    }
    .mapel-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(92, 75, 224, .08);
        border-color: var(--purple);
        text-decoration: none;
    }
    .mapel-icon-wrap {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: var(--purple-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 16px;
    }
    .mapel-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 6px;
        color: var(--ink);
    }
    .mapel-stats {
        display: flex;
        justify-content: space-between;
        background: #f8f7fc;
        padding: 12px 14px;
        border-radius: 12px;
        margin-bottom: 16px;
    }
    .mapel-stat-label {
        font-size: 11px;
        color: var(--muted);
        display: block;
    }
    .mapel-stat-value {
        font-size: 14px;
        font-weight: 700;
    }
    .btn-buka-mapel {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        font-weight: 700;
        color: var(--purple);
    }

    /* DAFTAR BAB MATERI PERSIS ALA FOTO 2 */
    .bab-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .bab-card-foto2 {
        display: flex;
        align-items: center;
        gap: 20px;
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 20px 24px;
        transition: all .2s ease;
        text-decoration: none;
        color: inherit;
    }
    .bab-card-foto2:hover {
        border-color: var(--purple);
        box-shadow: 0 6px 20px rgba(92, 75, 224, .08);
        text-decoration: none;
    }
    .bab-num-badge {
        background: #111827;
        color: white;
        font-size: 16px;
        font-weight: 800;
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        letter-spacing: .5px;
    }
    .bab-card-body {
        flex: 1;
        min-width: 0;
    }
    .bab-card-title {
        font-size: 17px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 6px;
    }
    .bab-card-subtitle {
        font-size: 13px;
        color: var(--muted);
        margin: 0;
    }
    .bab-card-arrow {
        color: #9ca3af;
        transition: transform .2s ease, color .2s ease;
        flex-shrink: 0;
    }
    .bab-card-foto2:hover .bab-card-arrow {
        transform: translateX(4px);
        color: var(--purple);
    }

    /* TINGKAT & SCORE */
    .score-val.pass { color: #166534; font-weight: 700; }
    .score-val.fail { color: #991b1b; font-weight: 700; }
    .badge-tingkat {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 700;
    }
    .badge-tingkat.mudah { background: #dcfce7; color: #166534; }
    .badge-tingkat.sedang { background: #fef3c7; color: #92400e; }
    .badge-tingkat.sulit { background: #fee2e2; color: #991b1b; }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <h1>Nilai Saya</h1>
        <p>Pantau hasil capaian evaluasi dan perkembangan belajarmu.</p>
    </div>
</div>

<!-- BREADCRUMB -->
<div class="breadcrumb-wrap">
    <a href="{{ url('/siswa/nilai') }}">Nilai Saya</a>
    @if ($mapelTerpilih)
        <span>›</span>
        @if ($materiTerpilih)
            <a href="{{ url('/siswa/nilai?mapel=' . $mapelTerpilih->id_mapel) }}">{{ $mapelTerpilih->nama_mapel }}</a>
            <span>›</span>
            <span class="current">{{ $materiTerpilih->judul }}</span>
        @else
            <span class="current">{{ $mapelTerpilih->nama_mapel }}</span>
        @endif
    @endif
</div>

{{-- LEVEL 1: PILIHAN MATA PELAJARAN --}}
@if (!$mapelTerpilih)
    <section class="card">
        <div class="card-header">
            <div>
                <h2>Pilih Mata Pelajaran</h2>
                <p class="muted">Pilih mata pelajaran untuk melihat riwayat nilai per bab materi</p>
            </div>
        </div>

        <div class="mapel-grid">
            @foreach ($mapelAktif as $mp)
                @php
                    $hasilMapel = $semuaHasil->filter(fn($h) => $h->kuis && $h->kuis->id_mapel === $mp->id_mapel);
                    $totalKuisSelesai = $hasilMapel->pluck('id_kuis')->unique()->count();
                    $rataRata = $hasilMapel->isNotEmpty() ? $hasilMapel->avg('nilai') : null;
                @endphp
                <a href="{{ url('/siswa/nilai?mapel=' . $mp->id_mapel) }}" class="mapel-card">
                    <div>
                        <div class="mapel-icon-wrap">
                            @if(stripos($mp->nama_mapel, 'informasi') !== false || stripos($mp->nama_mapel, 'tik') !== false)
                                💻
                            @elseif(stripos($mp->nama_mapel, 'server') !== false || stripos($mp->nama_mapel, 'jaringan') !== false)
                                🖥️
                            @elseif(stripos($mp->nama_mapel, 'indonesia') !== false)
                                🇮🇩
                            @else
                                📘
                            @endif
                        </div>
                        <h3 class="mapel-title">{{ $mp->nama_mapel }}</h3>
                        <p class="muted small" style="margin-bottom: 12px;">
                            {{ $mp->deskripsi ?? 'Kurikulum Pembelajaran SMK TKJ' }}
                        </p>
                    </div>

                    <div>
                        <div class="mapel-stats">
                            <div>
                                <span class="mapel-stat-label">Kuis Selesai</span>
                                <span class="mapel-stat-value">{{ $totalKuisSelesai }} Kuis</span>
                            </div>
                            <div style="text-align: right;">
                                <span class="mapel-stat-label">Rata-rata Nilai</span>
                                <span class="mapel-stat-value" style="color: {{ $rataRata && $rataRata >= 75 ? '#166534' : '#92400e' }};">
                                    {{ $rataRata !== null ? number_format($rataRata, 1) : '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="btn-buka-mapel">
                            <span>Lihat Nilai Bab Materi</span>
                            <span>→</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

{{-- LEVEL 2: DAFTAR BAB MATERI (ALA FOTO 2) --}}
@elseif ($mapelTerpilih && !$materiTerpilih)
    <section class="card">
        <div class="card-header">
            <div>
                <h2>Daftar Bab Materi — {{ $mapelTerpilih->nama_mapel }}</h2>
                <p class="muted">Klik bab materi di bawah untuk melihat rincian riwayat kuis dan evaluasi butir soal</p>
            </div>
            <a href="{{ url('/siswa/nilai') }}" class="btn btn-secondary btn-small">
                ← Kembali
            </a>
        </div>

        @if ($daftarMateri->isEmpty())
            <div class="empty">
                <h3>Belum Ada Bab Materi</h3>
                <p>Materi pembelajaran untuk mata pelajaran ini belum ditambahkan oleh guru.</p>
            </div>
        @else
            <div class="bab-list">
                @foreach ($daftarMateri as $index => $mat)
                    @php
                        $numStr = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                        $ringkasan = $ringkasanBab[$mat->id_materi] ?? [];
                        $totalKuis = $ringkasan['total_kuis'] ?? 0;
                        $kuisSelesai = $ringkasan['kuis_selesai'] ?? 0;
                        $nilaiTertinggi = $ringkasan['nilai_tertinggi'] ?? null;
                    @endphp
                    <a href="{{ url('/siswa/nilai?mapel=' . $mapelTerpilih->id_mapel . '&materi=' . $mat->id_materi) }}" class="bab-card-foto2">
                        <div class="bab-num-badge">{{ $numStr }}</div>
                        <div class="bab-card-body">
                            <h3 class="bab-card-title">{{ $mat->judul }}</h3>
                            <p class="bab-card-subtitle">
                                Bab {{ $mat->bab ?? ($index + 1) }} &bull; {{ $totalKuis }} Kuis Tersedia
                                @if($nilaiTertinggi !== null)
                                    &bull; Nilai Tertinggi: <strong>{{ number_format($nilaiTertinggi, 1) }}</strong> ({{ $kuisSelesai }}/{{ $totalKuis }} Kuis Dikerjakan)
                                @else
                                    &bull; Belum ada riwayat pengerjaan
                                @endif
                            </p>
                        </div>
                        <div class="bab-card-arrow">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    {{-- ULANGAN UMUM DI LEVEL MAPEL --}}
    @if ($hasilUlanganUmum->isNotEmpty())
        <section class="card">
            <div class="card-header">
                <div>
                    <h2>📝 Riwayat Nilai Ulangan &amp; Evaluasi</h2>
                    <p class="muted">Hasil pengerjaan ulangan mata pelajaran {{ $mapelTerpilih->nama_mapel }}</p>
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40px;">No</th>
                            <th>Kuis Ulangan</th>
                            <th style="width: 90px; text-align: center;">Percobaan</th>
                            <th>Nilai Siswa</th>
                            <th>KKM</th>
                            <th>Kelulusan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasilUlanganUmum as $item)
                            @php
                                $lulus = $item->nilai !== null && $item->kuis && $item->kuis->kkm !== null && $item->nilai >= $item->kuis->kkm;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $item->kuis->judul ?? '-' }}</strong>
                                    <span class="badge badge-warning" style="margin-top: 4px;">Ulangan</span>
                                </td>
                                <td style="text-align: center;">Ke-{{ $item->percobaan_ke }}</td>
                                <td>
                                    <strong class="score-val {{ $lulus ? 'pass' : 'fail' }}">
                                        {{ $item->nilai !== null ? number_format($item->nilai, 1) : '-' }}
                                    </strong>
                                </td>
                                <td>{{ number_format($item->kuis->kkm ?? 75, 1) }}</td>
                                <td>
                                    @if($lulus)
                                        <span class="badge badge-success">✓ Lulus</span>
                                    @else
                                        <span class="badge badge-warning">⚠️ Belum Lulus</span>
                                    @endif
                                </td>
                                <td>{{ $item->tanggal ? date('d/m/Y', strtotime($item->tanggal)) : '-' }}</td>
                                <td>
                                    <a href="{{ route('siswa.kuis.hasil', $item->id_kuis) }}" class="btn btn-secondary btn-small">
                                        📋 Evaluasi Soal
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif

{{-- LEVEL 3: RINCIAN NILAI KUIS BAB TERPILIH --}}
@elseif ($mapelTerpilih && $materiTerpilih)
    <section class="card">
        <div class="card-header">
            <div>
                <h2>Hasil Kuis — {{ $materiTerpilih->judul }}</h2>
                <p class="muted">Daftar riwayat pengerjaan dan hasil evaluasi butir kuis pada bab ini</p>
            </div>
            <a href="{{ url('/siswa/nilai?mapel=' . $mapelTerpilih->id_mapel) }}" class="btn btn-secondary btn-small">
                ← Kembali
            </a>
        </div>

        @if ($hasil->isEmpty())
            <div class="empty">
                <h3>Belum Ada Riwayat Kuis di Bab Ini</h3>
                <p>Kamu belum pernah mengerjakan kuis untuk bab materi ini.</p>
                <a href="{{ url('/siswa/kuis?mapel=' . $mapelTerpilih->id_mapel . '&materi=' . $materiTerpilih->id_materi) }}" class="btn" style="margin-top: 14px;">
                    Mulai Kerjakan Kuis Bab Ini →
                </a>
            </div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40px;">No</th>
                            <th>Nama Kuis</th>
                            <th>Kategori</th>
                            <th>Tingkat</th>
                            <th style="width: 80px; text-align: center;">Percobaan</th>
                            <th>Nilai</th>
                            <th>KKM</th>
                            <th>Kelulusan</th>
                            <th>Tanggal</th>
                            <th style="min-width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil as $item)
                            @php
                                $tingkat = strtolower(trim($item->kuis->tingkat_kesulitan ?? 'mudah'));
                                $lulus = $item->nilai !== null && $item->kuis && $item->kuis->kkm !== null && $item->nilai >= $item->kuis->kkm;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $item->kuis->judul ?? '-' }}</strong>
                                </td>
                                <td>
                                    <span class="badge">{{ ucfirst($item->kuis->kategori ?? '-') }}</span>
                                </td>
                                <td>
                                    <span class="badge-tingkat {{ $tingkat }}">
                                        {{ ucfirst($tingkat) }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <strong>Ke-{{ $item->percobaan_ke }}</strong>
                                </td>
                                <td>
                                    <strong class="score-val {{ $lulus ? 'pass' : 'fail' }}">
                                        {{ $item->nilai !== null ? number_format($item->nilai, 1) : '-' }}
                                    </strong>
                                </td>
                                <td>{{ $item->kuis->kkm !== null ? number_format($item->kuis->kkm, 1) : '-' }}</td>
                                <td>
                                    @if($lulus)
                                        <span class="badge badge-success">✓ Lulus</span>
                                    @else
                                        <span class="badge badge-warning">⚠️ Tidak Lulus</span>
                                    @endif
                                </td>
                                <td>{{ $item->tanggal ? date('d/m/Y', strtotime($item->tanggal)) : '-' }}</td>
                                <td>
                                    <a href="{{ route('siswa.kuis.hasil', $item->id_kuis) }}" class="btn btn-secondary btn-small">
                                        📋 Evaluasi Soal
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endif

@endsection
