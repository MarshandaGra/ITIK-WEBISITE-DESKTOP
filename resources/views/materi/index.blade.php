@extends('layouts.guru')
@section('title', 'Materi Pembelajaran')

@push('styles')
<style>
    /* === LEVEL 1: MAPEL CARDS === */
    .mapel-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }
    .mapel-card {
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
    .mapel-card:hover {
        transform: translateY(-3px);
        border-color: var(--purple);
        box-shadow: 0 8px 30px rgba(85,66,220,.12);
        text-decoration: none;
    }
    .mapel-icon {
        width: 50px;
        height: 50px;
        background: var(--purple-light);
        color: var(--purple);
        border-radius: 14px;
        display: grid;
        place-items: center;
        font-size: 24px;
    }
    .mapel-title {
        font-size: 17px;
        font-weight: 700;
        color: var(--ink);
        margin: 0 0 4px;
    }
    .mapel-code {
        font-size: 12px;
        color: var(--muted);
        font-weight: 600;
    }
    .mapel-count {
        font-size: 13px;
        color: var(--purple);
        font-weight: 600;
    }
    .mapel-arrow {
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
    .materi-row-foto2 {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        box-shadow: 0 4px 20px #29263d03;
        transition: border-color .2s ease, box-shadow .2s ease, transform .15s ease;
    }
    .materi-row-foto2:hover {
        border-color: var(--purple);
        box-shadow: 0 6px 25px rgba(85,66,220,.08);
        transform: translateY(-1px);
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
    .materi-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    /* BREADCRUMB */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--muted);
        margin-bottom: 18px;
        flex-wrap: wrap;
    }
    .breadcrumb a {
        color: var(--purple);
        text-decoration: none;
        font-weight: 600;
    }
    .breadcrumb a:hover {
        text-decoration: underline;
    }
    .breadcrumb .sep {
        color: var(--muted);
    }
    .breadcrumb .current {
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
            <p>Pilih mata pelajaran untuk melihat dan mengelola materi pembelajaran siswa.</p>
        </div>
    </div>

    @if($mapelAktif->isEmpty())
        <div class="empty">
            <h3>Belum Ada Mata Pelajaran Aktif</h3>
            <p>Hubungi admin untuk menambahkan mata pelajaran pembelajaran.</p>
        </div>
    @else
        <div class="mapel-grid">
            @foreach($mapelAktif as $mp)
                <a href="{{ route('materi.index', ['mapel' => $mp->id_mapel]) }}" class="mapel-card">
                    <div class="mapel-icon">📚</div>
                    <div>
                        <div class="mapel-code">{{ $mp->kode_mapel }}</div>
                        <h3 class="mapel-title">{{ $mp->nama_mapel }}</h3>
                        <div class="mapel-count">{{ $mp->materi_count ?? 0 }} Materi Pembelajaran</div>
                    </div>
                    <div class="mapel-arrow">→</div>
                </a>
            @endforeach
        </div>
    @endif

@else
    {{-- ============================================================ --}}
    {{-- LEVEL 2: DAFTAR MATERI PER MATA PELAJARAN (ALA FOTO 2) --}}
    {{-- ============================================================ --}}
    <div class="breadcrumb">
        <a href="{{ route('materi.index') }}">Materi</a>
        <span class="sep">›</span>
        <span class="current">{{ $mapelTerpilih->nama_mapel }}</span>
    </div>

    <div class="page-heading">
        <div>
            <a href="{{ route('materi.index') }}" class="btn btn-secondary" style="display:inline-block; margin-bottom: 10px;">
                ← Kembali
            </a>
            <h1>{{ $mapelTerpilih->nama_mapel }}</h1>
            <p>{{ $materi->count() }} materi pembelajaran tersedia untuk mata pelajaran ini.</p>
        </div>
        <a href="{{ route('materi.create', ['mapel' => $mapelTerpilih->id_mapel]) }}" class="btn">
            + Tambah Materi
        </a>
    </div>

    @if($materi->isEmpty())
        <div class="empty">
            <h3>Belum Ada Materi untuk Mata Pelajaran Ini</h3>
            <p>Silakan tambahkan materi pembelajaran pertama untuk siswa.</p>
            <a href="{{ route('materi.create', ['mapel' => $mapelTerpilih->id_mapel]) }}" class="btn" style="margin-top: 14px;">
                + Tambah Materi Pertama
            </a>
        </div>
    @else
        <div class="materi-list-foto2">
            @foreach($materi as $idx => $item)
                <div class="materi-row-foto2">
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
                                    &bull; {{ Str::limit($item->deskripsi, 90) }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="materi-actions">
                        <a href="{{ route('materi.show', $item->id_materi) }}" class="btn btn-secondary btn-small">
                            Lihat Dokumen
                        </a>
                        <a href="{{ route('materi.edit', $item->id_materi) }}" class="btn btn-secondary btn-small">
                            Edit
                        </a>
                        <form
                            action="{{ route('materi.destroy', $item->id_materi) }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="return confirm('Yakin ingin menghapus materi ini?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-small">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endif

@endsection
