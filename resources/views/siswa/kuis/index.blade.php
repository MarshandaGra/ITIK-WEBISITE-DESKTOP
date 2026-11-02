@extends('layouts.siswa')
@section('title', 'Daftar Kuis')

@push('styles')
<style>
    .breadcrumb-siswa {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        font-size: 13px;
        color: var(--muted);
        flex-wrap: wrap;
    }
    .breadcrumb-siswa a {
        color: var(--purple);
        font-weight: 600;
    }
    .mapel-banner {
        background: linear-gradient(135deg, #7160ef 0%, #5c4be0 100%);
        border-radius: 16px;
        padding: 24px 28px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    .mapel-banner-info {
        display: flex;
        align-items: center;
        gap: 18px;
    }
    .mapel-banner-icon {
        width: 52px;
        height: 52px;
        background: rgba(255, 255, 255, .2);
        border-radius: 14px;
        display: grid;
        place-items: center;
        font-size: 24px;
    }
    .mapel-banner h3 {
        margin: 0 0 4px;
        font-size: 22px;
    }
    .mapel-banner p {
        margin: 0;
        opacity: .9;
        font-size: 13px;
    }
    .btn-back-mapel {
        background: white;
        color: var(--purple);
        font-size: 13px;
        font-weight: 700;
        padding: 9px 16px;
        border-radius: 10px;
        text-decoration: none;
    }
    .btn-back-mapel:hover {
        background: var(--purple-light);
        text-decoration: none;
    }

    /* Grid Mapel */
    .mapel-grid-siswa {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 18px;
    }
    .mapel-card-s {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-decoration: none;
        color: inherit;
        transition: all .2s ease;
    }
    .mapel-card-s:hover {
        border-color: var(--purple);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(92, 75, 224, .08);
        text-decoration: none;
    }
    .mapel-icon-s {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--purple-light);
        display: grid;
        place-items: center;
        font-size: 22px;
        margin-bottom: 14px;
    }
    .mapel-nama {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 6px;
        color: var(--ink);
    }
    .mapel-count {
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px solid var(--border);
        font-size: 12px;
        color: var(--muted);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .mapel-count-num {
        font-weight: 700;
        color: var(--purple);
    }

    /* Bab Grid */
    .bab-grid-siswa {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 18px;
    }
    .bab-card-siswa {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-decoration: none;
        color: inherit;
        transition: all .2s ease;
    }
    .bab-card-siswa:hover {
        border-color: var(--purple);
        box-shadow: 0 8px 25px rgba(92, 75, 224, .08);
        text-decoration: none;
    }
    .bab-card-header {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        margin-bottom: 12px;
    }
    .bab-card-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--purple-light);
        display: grid;
        place-items: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .bab-card-tag {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        color: var(--purple);
        background: var(--purple-light);
        padding: 2px 8px;
        border-radius: 6px;
        margin-bottom: 4px;
    }
    .bab-card-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--ink);
    }
    .bab-card-desc {
        font-size: 13px;
        color: var(--muted);
        margin: 8px 0 14px;
        line-height: 1.5;
    }
    .bab-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        font-weight: 700;
        color: var(--purple);
        padding-top: 12px;
        border-top: 1px solid var(--border);
    }

    /* Kuis Grid */
    .kuis-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 18px;
    }
    .kuis-item {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
    }
    .kuis-item.terkunci {
        opacity: .75;
        background: #fbfbfd;
    }
    .kuis-item h3 {
        font-size: 17px;
        margin-bottom: 10px;
        color: var(--ink);
    }
    .badges-row {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }
    .kuis-meta {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        background: #f8f7fc;
        padding: 10px;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 16px;
    }
    .meta-number {
        font-size: 16px;
        font-weight: 700;
        color: var(--purple);
    }
    .meta-label {
        font-size: 11px;
        color: var(--muted);
    }
    .kunci-info {
        font-size: 12px;
        color: var(--muted);
        margin-top: 8px;
        line-height: 1.4;
    }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <h1>Daftar Kuis</h1>
        <p>Pilih kuis pembelajaran yang tersedia dan selesaikan tantangannya.</p>
    </div>
    <a href="{{ route('siswa.nilai.index') }}" class="btn btn-secondary">
        Lihat Nilai Saya →
    </a>
</div>

@if (!$mapelTerpilih)
    {{-- PILIH MATA PELAJARAN --}}
    <section class="card">
        <div class="card-header">
            <div>
                <h2>Pilih Mata Pelajaran</h2>
                <p class="muted">Pilih mata pelajaran untuk melihat kuis yang tersedia</p>
            </div>
        </div>

        @if ($mapelAktif->isEmpty())
            <div class="empty">
                <h3>Belum ada mata pelajaran</h3>
                <p>Belum ada kuis yang tersedia saat ini.</p>
            </div>
        @else
            <div class="mapel-grid-siswa">
                @foreach ($mapelAktif as $mapel)
                    <a href="{{ url('/siswa/kuis?mapel=' . $mapel->id_mapel) }}" class="mapel-card-s">
                        <div>
                            <div class="mapel-icon-s">📖</div>
                            <div class="mapel-nama">{{ $mapel->nama_mapel }}</div>
                            <span class="muted small">{{ $mapel->id_mapel }}</span>
                        </div>
                        <div class="mapel-count">
                            <span>Kuis Tersedia</span>
                            <span class="mapel-count-num">{{ $mapel->kuis_count }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

@else
    {{-- BREADCRUMB --}}
    <div class="breadcrumb-siswa">
        <a href="{{ url('/siswa/kuis') }}">📚 Semua Mata Pelajaran</a>
        <span>›</span>
        @if ($materiTerpilih)
            <a href="{{ url('/siswa/kuis?mapel=' . $mapelTerpilih->id_mapel) }}">{{ $mapelTerpilih->nama_mapel }}</a>
            <span>›</span>
            <strong>{{ $materiTerpilih->bab ? $materiTerpilih->bab . ' - ' : '' }}{{ $materiTerpilih->judul }}</strong>
        @else
            <strong>{{ $mapelTerpilih->nama_mapel }}</strong>
        @endif
    </div>

    {{-- BANNER MAPEL --}}
    <div class="mapel-banner">
        <div class="mapel-banner-info">
            <div class="mapel-banner-icon">📖</div>
            <div>
                <h3>{{ $mapelTerpilih->nama_mapel }}</h3>
                <p>
                    @if ($materiTerpilih)
                        Bab: {{ $materiTerpilih->bab ? $materiTerpilih->bab . ' - ' : '' }}{{ $materiTerpilih->judul }}
                    @else
                        {{ $daftarMateri->count() }} Bab Materi &bull; {{ $kuis->count() }} Kuis tersedia
                    @endif
                </p>
            </div>
        </div>

        @if ($materiTerpilih)
            <a href="{{ url('/siswa/kuis?mapel=' . $mapelTerpilih->id_mapel) }}" class="btn-back-mapel">
                ← Kembali
            </a>
        @else
            <a href="{{ url('/siswa/kuis') }}" class="btn-back-mapel">
                ← Kembali
            </a>
        @endif
    </div>

    @if (!$materiTerpilih)
        {{-- LEVEL 1: PILIH BAB MATERI --}}
        <section class="card">
            <div class="card-header">
                <div>
                    <h2>Pilih Bab Materi</h2>
                    <p class="muted">Pilih materi yang ingin kamu pelajari dan kerjakan kuisnya (Mudah → Sedang → Sulit)</p>
                </div>
            </div>

            @if ($daftarMateri->isEmpty())
                <div class="empty">
                    <h3>Belum ada bab materi</h3>
                    <p>Materi pembelajaran untuk mata pelajaran ini belum tersedia.</p>
                </div>
            @else
                <div class="bab-grid-siswa">
                    @foreach ($daftarMateri as $materiItem)
                        @php
                            $kuisDiBab = $materiItem->kuis->where('status_publikasi', 'terbit')->where('is_aktif', true);
                            $hasMudah = $kuisDiBab->contains(fn ($k) => $k->tingkat_kesulitan === 'mudah');
                            $hasSedang = $kuisDiBab->contains(fn ($k) => $k->tingkat_kesulitan === 'sedang');
                            $hasSulit = $kuisDiBab->contains(fn ($k) => $k->tingkat_kesulitan === 'sulit');
                        @endphp

                        <a href="{{ url('/siswa/kuis?mapel=' . $mapelTerpilih->id_mapel . '&materi=' . $materiItem->id_materi) }}" class="bab-card-siswa">
                            <div>
                                <div class="bab-card-header">
                                    <div class="bab-card-icon">📖</div>
                                    <div>
                                        <span class="bab-card-tag">{{ $materiItem->bab ?? 'Materi' }}</span>
                                        <div class="bab-card-title">{{ $materiItem->judul }}</div>
                                    </div>
                                </div>

                                @if ($materiItem->deskripsi)
                                    <div class="bab-card-desc">
                                        {{ Str::limit($materiItem->deskripsi, 90) }}
                                    </div>
                                @endif

                                <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 10px;">
                                    <span class="badge {{ $hasMudah ? 'badge-success' : 'badge-muted' }}">
                                        {{ $hasMudah ? '✓' : '○' }} Mudah
                                    </span>
                                    <span class="badge {{ $hasSedang ? 'badge-warning' : 'badge-muted' }}">
                                        {{ $hasSedang ? '✓' : '○' }} Sedang
                                    </span>
                                    <span class="badge {{ $hasSulit ? 'badge-danger' : 'badge-muted' }}">
                                        {{ $hasSulit ? '✓' : '○' }} Sulit
                                    </span>
                                </div>
                            </div>

                            <div class="bab-card-footer">
                                <span>{{ $kuisDiBab->count() }} Kuis Tersedia</span>
                                <span>Buka Bab Ini →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- KUIS UMUM / ULANGAN --}}
        @php
            $kuisTanpaBab = $kuis->filter(fn ($k) => $k->materi->isEmpty() || strtolower(trim($k->kategori)) === 'ulangan');
        @endphp

        @if ($kuisTanpaBab->isNotEmpty())
            <section class="card">
                <div class="card-header">
                    <div>
                        <h2>📝 Ulangan &amp; Kuis Umum</h2>
                        <p class="muted">Kuis evaluasi umum untuk mata pelajaran {{ $mapelTerpilih->nama_mapel }}</p>
                    </div>
                </div>

                <div class="kuis-grid">
                    @foreach ($kuisTanpaBab as $item)
                        @php
                            $status = $statusKuis[$item->id_kuis] ?? [];
                            $terkunci = $status['terkunci'] ?? false;
                            $sudahPernah = $status['sudah_pernah'] ?? false;
                            $lulus = $status['lulus'] ?? false;
                            $nilaiTertinggi = $status['nilai_tertinggi'] ?? null;
                            $alasanKunci = $status['alasan_kunci'] ?? null;
                            $katItem = strtolower(trim($item->kategori ?? ''));
                            $bisaUlang = in_array($katItem, ['kuis harian', 'pre-test', 'pass-test']);
                        @endphp

                        <div class="kuis-item {{ $terkunci ? 'terkunci' : '' }}">
                            <div>
                                <h3>{{ $item->judul }}</h3>
                                <div class="badges-row">
                                    <span class="badge">{{ ucfirst($item->kategori) }}</span>
                                    <span class="badge badge-muted">{{ ucfirst($item->tingkat_kesulitan ?? 'mudah') }}</span>
                                    @if ($terkunci)
                                        <span class="badge badge-muted">🔒 Terkunci</span>
                                    @elseif ($lulus)
                                        <span class="badge badge-success">✓ Lulus</span>
                                    @elseif ($sudahPernah)
                                        <span class="badge badge-warning">Belum Lulus</span>
                                    @endif
                                </div>

                                <div class="kuis-meta">
                                    <div>
                                        <div class="meta-number">{{ $item->alokasi_waktu }}</div>
                                        <div class="meta-label">Menit</div>
                                    </div>
                                    <div>
                                        <div class="meta-number">{{ $item->kkm }}</div>
                                        <div class="meta-label">KKM</div>
                                    </div>
                                    <div>
                                        <div class="meta-number">{{ $item->soal()->count() }}</div>
                                        <div class="meta-label">Soal</div>
                                    </div>
                                </div>

                                @if ($nilaiTertinggi !== null)
                                    <p class="small muted" style="margin-bottom: 12px;">
                                        Nilai terbaik kamu: <strong style="color: {{ $lulus ? '#166534' : '#92400e' }};">{{ number_format($nilaiTertinggi, 1) }}</strong>
                                    </p>
                                @endif
                            </div>

                            <div>
                                @if ($terkunci)
                                    <button class="btn btn-secondary" style="width: 100%; opacity: .6;" disabled>🔒 Kuis Terkunci</button>
                                    <div class="kunci-info">ℹ️ {{ $alasanKunci }}</div>
                                @elseif ($bisaUlang && $sudahPernah && !$lulus)
                                    <form action="{{ route('siswa.kuis.mulai', $item->id_kuis) }}" method="GET">
                                        <button type="submit" class="btn btn-warning" style="width: 100%;">↻ Kerjakan Ulang</button>
                                    </form>
                                @elseif ($katItem === 'ulangan' && $sudahPernah && !$lulus)
                                    <div class="small" style="color: #991b1b; font-weight: 700; margin-bottom: 8px;">
                                        ⚠️ Nilai di bawah KKM
                                    </div>
                                    <a href="{{ route('siswa.remedial.index') }}" class="btn btn-warning" style="width: 100%; text-align: center;">
                                        Cek Tugas Remedial
                                    </a>
                                @else
                                    <form action="{{ route('siswa.kuis.mulai', $item->id_kuis) }}" method="GET">
                                        <button type="submit" class="btn" style="width: 100%;">
                                            {{ $sudahPernah ? '→ Kerjakan Lagi' : 'Mulai' }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    @else
        {{-- LEVEL 2: KUIS DI BAB TERPILIH --}}
        @php
            $kuisBabTerpilih = $kuis->filter(function ($k) use ($materiTerpilih) {
                return $k->materi->contains('id_materi', $materiTerpilih->id_materi);
            })->sortBy(function ($k) {
                return match($k->tingkat_kesulitan) {
                    'mudah' => 1,
                    'sedang' => 2,
                    'sulit' => 3,
                    default => 4
                };
            });
        @endphp

        <section class="card">
            <div class="card-header">
                <div>
                    <h2>Kuis {{ $materiTerpilih->bab ? $materiTerpilih->bab . ': ' : '' }}{{ $materiTerpilih->judul }}</h2>
                    <p class="muted">Selesaikan kuis secara berurutan: <strong>Mudah</strong> → <strong>Sedang</strong> → <strong>Sulit</strong></p>
                </div>
                <a href="{{ url('/siswa/kuis?mapel=' . $mapelTerpilih->id_mapel) }}" class="btn btn-secondary btn-small">
                    ← Pilih Bab Lain
                </a>
            </div>

            @if ($kuisBabTerpilih->isEmpty())
                <div class="empty">
                    <h3>Belum ada kuis untuk bab ini</h3>
                    <p>Kuis untuk bab materi ini belum dipublikasikan oleh guru.</p>
                </div>
            @else
                <div class="kuis-grid">
                    @foreach ($kuisBabTerpilih as $item)
                        @php
                            $status = $statusKuis[$item->id_kuis] ?? [];
                            $terkunci = $status['terkunci'] ?? false;
                            $sudahPernah = $status['sudah_pernah'] ?? false;
                            $lulus = $status['lulus'] ?? false;
                            $nilaiTertinggi = $status['nilai_tertinggi'] ?? null;
                            $alasanKunci = $status['alasan_kunci'] ?? null;
                            $katBabItem = strtolower(trim($item->kategori ?? ''));
                            $bisaBabUlang = in_array($katBabItem, ['kuis harian', 'pre-test', 'pass-test']);
                        @endphp

                        <div class="kuis-item {{ $terkunci ? 'terkunci' : '' }}">
                            <div>
                                <h3>{{ $item->judul }}</h3>
                                <div class="badges-row">
                                    <span class="badge">{{ ucfirst($item->kategori) }}</span>
                                    <span class="badge badge-muted">Tingkat {{ ucfirst($item->tingkat_kesulitan ?? 'mudah') }}</span>
                                    @if ($terkunci)
                                        <span class="badge badge-muted">🔒 Terkunci</span>
                                    @elseif ($lulus)
                                        <span class="badge badge-success">✓ Lulus</span>
                                    @elseif ($sudahPernah)
                                        <span class="badge badge-warning">Belum Lulus</span>
                                    @endif
                                </div>

                                <div class="kuis-meta">
                                    <div>
                                        <div class="meta-number">{{ $item->alokasi_waktu }}</div>
                                        <div class="meta-label">Menit</div>
                                    </div>
                                    <div>
                                        <div class="meta-number">{{ $item->kkm }}</div>
                                        <div class="meta-label">KKM</div>
                                    </div>
                                    <div>
                                        <div class="meta-number">{{ $item->soal()->count() }}</div>
                                        <div class="meta-label">Soal</div>
                                    </div>
                                </div>

                                @if ($nilaiTertinggi !== null)
                                    <p class="small muted" style="margin-bottom: 12px;">
                                        Nilai terbaik kamu: <strong style="color: {{ $lulus ? '#166534' : '#92400e' }};">{{ number_format($nilaiTertinggi, 1) }}</strong>
                                    </p>
                                @endif
                            </div>

                            <div>
                                @if ($terkunci)
                                    <button class="btn btn-secondary" style="width: 100%; opacity: .6;" disabled>🔒 Kuis Terkunci</button>
                                    <div class="kunci-info">ℹ️ {{ $alasanKunci }}</div>
                                @elseif ($bisaBabUlang && $sudahPernah && !$lulus)
                                    <form action="{{ route('siswa.kuis.mulai', $item->id_kuis) }}" method="GET">
                                        <button type="submit" class="btn btn-warning" style="width: 100%;">↻ Kerjakan Ulang</button>
                                    </form>
                                @elseif ($katBabItem === 'ulangan' && $sudahPernah && !$lulus)
                                    <div class="small" style="color: #991b1b; font-weight: 700; margin-bottom: 8px;">
                                        ⚠️ Nilai di bawah KKM
                                    </div>
                                    <a href="{{ route('siswa.remedial.index') }}" class="btn btn-warning" style="width: 100%; text-align: center;">
                                        Cek Tugas Remedial
                                    </a>
                                @else
                                    <form action="{{ route('siswa.kuis.mulai', $item->id_kuis) }}" method="GET">
                                        <button type="submit" class="btn" style="width: 100%;">
                                            {{ $sudahPernah ? '→ Kerjakan Lagi' : 'Mulai' }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    {{-- KUIS REMEDIAL --}}
    @if ($remedial->isNotEmpty())
        <section class="card">
            <div class="card-header">
                <div>
                    <h2>Kuis Remedial</h2>
                    <p class="muted">Tugas perbaikan nilai untukmu</p>
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40px;">No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($remedial as $item)
                            <tr>
                                <td class="number" style="text-align: left;">{{ $loop->iteration }}</td>
                                <td><strong>{{ $item->kuisRemedial->judul }}</strong></td>
                                <td><span class="badge">{{ ucfirst($item->kuisRemedial->kategori) }}</span></td>
                                <td>
                                    <a href="{{ route('siswa.kuis.mulai', $item->kuisRemedial->id_kuis) }}" class="btn btn-small">
                                        Kerjakan Remedial →
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif
@endif

@endsection
