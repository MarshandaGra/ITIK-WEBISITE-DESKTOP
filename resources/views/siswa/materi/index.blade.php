@extends('layouts.siswa')
@section('title', 'Materi Pembelajaran')

@push('styles')
<style>
    /* === LEVEL 1: MAPEL CARDS SISWA === */
    .mapel-grid-siswa {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }
    .mapel-card-s {
        background: white;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 26px 24px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        box-shadow: 0 4px 20px #29263d04;
        transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
        text-decoration: none;
        color: inherit;
    }
    .mapel-card-s:hover {
        transform: translateY(-3px);
        border-color: var(--purple);
        box-shadow: 0 8px 30px rgba(85,66,220,.12);
        text-decoration: none;
    }
    .mapel-icon-s {
        width: 50px;
        height: 50px;
        background: var(--purple-light);
        color: var(--purple);
        border-radius: 14px;
        display: grid;
        place-items: center;
        font-size: 24px;
    }
    .mapel-title-s {
        font-size: 17px;
        font-weight: 700;
        color: var(--ink);
        margin: 0 0 4px;
    }
    .mapel-code-s {
        font-size: 12px;
        color: var(--muted);
        font-weight: 600;
    }
    .mapel-count-s {
        font-size: 13px;
        color: var(--purple);
        font-weight: 600;
    }
    .mapel-arrow-s {
        font-size: 20px;
        color: var(--muted);
        margin-top: auto;
        align-self: flex-end;
    }

    /* === LEVEL 2: MATERI ROWS (ALA FOTO 2) === */
    .materi-list-foto2 {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .materi-card-link {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        box-shadow: 0 4px 20px #29263d03;
        transition: border-color .2s ease, box-shadow .2s ease, transform .15s ease;
        text-decoration: none;
        color: inherit;
    }
    .materi-card-link:hover {
        border-color: var(--purple);
        box-shadow: 0 6px 25px rgba(85,66,220,.08);
        transform: translateY(-1px);
        text-decoration: none;
    }
    .materi-main-info {
        display: flex;
        align-items: center;
        gap: 18px;
        flex: 1;
        min-width: 0;
    }
    .materi-num-badge {
        width: 48px;
        height: 48px;
        background: #181528;
        color: white;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 800;
        flex-shrink: 0;
        letter-spacing: .5px;
    }
    .materi-text-wrap {
        flex: 1;
        min-width: 0;
    }
    .materi-row-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--ink);
        margin: 0 0 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .materi-row-subtitle {
        font-size: 13px;
        color: var(--muted);
        margin: 0;
        line-height: 1.4;
    }
    .materi-side-info {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-shrink: 0;
    }
    .arrow-icon {
        font-size: 20px;
        color: var(--muted);
        transition: transform .15s ease, color .15s ease;
    }
    .materi-card-link:hover .arrow-icon {
        transform: translateX(4px);
        color: var(--purple);
    }

    /* BREADCRUMB */
    .breadcrumb-siswa {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--muted);
        margin-bottom: 18px;
        flex-wrap: wrap;
    }
    .breadcrumb-siswa a {
        color: var(--purple);
        text-decoration: none;
        font-weight: 600;
    }
    .breadcrumb-siswa a:hover {
        text-decoration: underline;
    }
    .breadcrumb-siswa .sep {
        color: var(--muted);
    }
    .breadcrumb-siswa .current {
        color: var(--ink);
        font-weight: 700;
    }
</style>
@endpush

@section('content')

@if(!$mapelTerpilih)
    {{-- ============================================================ --}}
    {{-- LEVEL 1: PILIH MATA PELAJARAN --}}
    {{-- ============================================================ --}}
    <div class="page-heading">
        <div>
            <h1>Materi Pembelajaran</h1>
            <p>Pilih mata pelajaran untuk mulai membaca dan mempelajari materi bahan ajar.</p>
        </div>
        <a href="{{ route('siswa.kuis.index') }}" class="btn btn-secondary">
            Ke Daftar Kuis →
        </a>
    </div>

    @if($mapelAktif->isEmpty())
        <div class="empty">
            <h3>Belum Ada Mata Pelajaran Aktif</h3>
            <p>Materi pembelajaran akan tersedia setelah ditambahkan oleh guru.</p>
        </div>
    @else
        <div class="mapel-grid-siswa">
            @foreach($mapelAktif as $mp)
                <a href="{{ route('siswa.materi.index', ['mapel' => $mp->id_mapel]) }}" class="mapel-card-s">
                    <div class="mapel-icon-s">📚</div>
                    <div>
                        <div class="mapel-code-s">{{ $mp->kode_mapel }}</div>
                        <h3 class="mapel-title-s">{{ $mp->nama_mapel }}</h3>
                        <div class="mapel-count-s">{{ $mp->materi_count ?? 0 }} Materi Pembelajaran</div>
                    </div>
                    <div class="mapel-arrow-s">→</div>
                </a>
            @endforeach
        </div>
    @endif

@else
    {{-- ============================================================ --}}
    {{-- LEVEL 2: DAFTAR MATERI PER MAPEL (ALA FOTO 2) --}}
    {{-- ============================================================ --}}
    <div class="breadcrumb-siswa">
        <a href="{{ route('siswa.materi.index') }}">Materi</a>
        <span class="sep">›</span>
        <span class="current">{{ $mapelTerpilih->nama_mapel }}</span>
    </div>

    <div class="page-heading">
        <div>
            <a href="{{ route('siswa.materi.index') }}" class="btn btn-secondary" style="display:inline-block; margin-bottom: 10px;">
                ← Kembali
            </a>
            <h1>{{ $mapelTerpilih->nama_mapel }}</h1>
            <p>{{ $materi->count() }} materi pembelajaran tersedia untuk mata pelajaran ini.</p>
        </div>
    </div>

    @if($materi->isEmpty())
        <div class="empty">
            <h3>Belum Ada Materi untuk Mata Pelajaran Ini</h3>
            <p>Guru belum menambahkan materi pembelajaran untuk mata pelajaran ini.</p>
            <a href="{{ route('siswa.materi.index') }}" class="btn btn-secondary" style="margin-top: 14px;">
                ← Pilih Mata Pelajaran Lain
            </a>
        </div>
    @else
        <div class="materi-list-foto2">
            @foreach($materi as $idx => $item)
                @php
                    $prog = $item->relationLoaded('progress') ? $item->progress->first() : null;
                @endphp
                <a href="{{ route('siswa.materi.show', $item->id_materi) }}" class="materi-card-link">
                    <div class="materi-main-info">
                        <div class="materi-num-badge">
                            {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>
                        <div class="materi-text-wrap">
                            <h3 class="materi-row-title">{{ $item->judul }}</h3>
                            <p class="materi-row-subtitle">
                                @if($item->bab)
                                    <strong>{{ $item->bab }}</strong> &bull;
                                @endif
                                Kelas {{ $item->kelas ?? '-' }}
                                @if($item->deskripsi)
                                    &bull; {{ Str::limit($item->deskripsi, 85) }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="materi-side-info">
                        @if(!$prog)
                            <span class="badge badge-muted">Belum Mulai</span>
                        @elseif($prog->status === 'sedang belajar')
                            <span class="badge badge-warning">Sedang Belajar</span>
                        @elseif($prog->status === 'selesai')
                            <span class="badge badge-success">✓ Selesai</span>
                        @else
                            <span class="badge">{{ $prog->status }}</span>
                        @endif
                        <span class="arrow-icon">→</span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

@endif

@endsection
