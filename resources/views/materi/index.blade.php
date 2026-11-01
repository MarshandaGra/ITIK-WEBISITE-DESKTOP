@extends('layouts.guru')
@section('title', 'Materi Pembelajaran')

@push('styles')
<style>
    .materi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
    }
    .materi-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 4px 20px #29263d03;
        transition: transform .2s ease, border-color .2s ease;
    }
    .materi-card:hover {
        transform: translateY(-2px);
        border-color: var(--purple);
    }
    .materi-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    .materi-icon {
        width: 42px;
        height: 42px;
        background: var(--purple-light);
        color: var(--purple);
        border-radius: 12px;
        display: grid;
        place-items: center;
        font-size: 20px;
    }
    .materi-card h3 {
        font-size: 17px;
        margin: 0 0 6px;
        color: var(--ink);
    }
    .materi-bab {
        font-size: 12px;
        font-weight: 700;
        color: var(--purple);
        margin-bottom: 10px;
    }
    .materi-desc {
        font-size: 13px;
        color: var(--muted);
        line-height: 1.5;
        margin-bottom: 16px;
        flex-grow: 1;
    }
    .materi-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 14px;
        border-top: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 8px;
    }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <h1>Materi</h1>
        <p>Kelola materi pembelajaran TIK dan pantau kesiapan bahan ajar.</p>
    </div>
    <a href="{{ route('materi.create') }}" class="btn">
        + Tambah Materi
    </a>
</div>

{{-- SEARCH TOOLBAR --}}
<div class="card" style="padding: 14px 18px; margin-bottom: 22px;">
    <div class="filter-form" style="align-items: center;">
        <div class="field field-search" style="margin-bottom: 0;">
            <input
                type="search"
                id="searchMateri"
                placeholder="Cari materi berdasarkan judul, bab, atau kelas..."
                autocomplete="off"
            >
        </div>
        <span class="muted small" id="countMateri">
            {{ $materi->count() }} materi tersedia
        </span>
    </div>
</div>

@if($materi->count() > 0)
    <div class="materi-grid" id="materiGrid">
        @foreach($materi as $item)
            <div class="materi-card" data-search="{{ strtolower($item->judul . ' ' . $item->bab . ' ' . $item->kelas) }}">
                <div>
                    <div class="materi-header-row">
                        <div class="materi-icon">▣</div>
                        <span class="badge badge-muted">Kelas {{ $item->kelas ?? '-' }}</span>
                    </div>

                    <h3>{{ $item->judul }}</h3>
                    <div class="materi-bab">{{ $item->bab ?? 'Materi Pembelajaran' }}</div>

                    <div class="materi-desc">
                        {{ $item->deskripsi ? Str::limit($item->deskripsi, 110) : 'Tidak ada deskripsi materi.' }}
                    </div>
                </div>

                <div class="materi-footer">
                    <span class="muted small">ID: {{ $item->id_materi }}</span>
                    <div class="actions">
                        <a href="{{ route('materi.show', $item->id_materi) }}" class="btn btn-secondary btn-small">
                            Lihat
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
            </div>
        @endforeach
    </div>
@else
    <div class="empty">
        <h3>Belum ada materi</h3>
        <p>Silakan tambahkan materi pembelajaran pertama untuk siswa.</p>
        <a href="{{ route('materi.create') }}" class="btn" style="margin-top: 14px;">
            + Tambah Materi Pertama
        </a>
    </div>
@endif

@push('scripts')
<script>
    const searchInput = document.getElementById('searchMateri');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.materi-card');
            let visible = 0;

            cards.forEach(card => {
                const searchData = card.getAttribute('data-search') || '';
                if (!keyword || searchData.includes(keyword)) {
                    card.style.display = '';
                    visible++;
                } else {
                    card.style.display = 'none';
                }
            });

            const countEl = document.getElementById('countMateri');
            if (countEl) {
                countEl.textContent = visible + ' materi ditampilkan';
            }
        });
    }
</script>
@endpush

@endsection
