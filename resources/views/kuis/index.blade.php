@extends('layouts.guru')
@section('title', 'Kuis & Soal')

@push('styles')
<style>
    .mapel-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 18px;
    }
    .mapel-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        color: inherit;
        text-decoration: none;
        transition: transform .2s ease, border-color .2s ease;
    }
    .mapel-card:hover {
        transform: translateY(-2px);
        border-color: var(--purple);
        text-decoration: none;
    }
    .mapel-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--purple-light);
        display: grid;
        place-items: center;
        font-size: 20px;
        margin-bottom: 12px;
    }
    .mapel-banner {
        background: linear-gradient(135deg, #7160ef 0%, #5c4be0 100%);
        border-radius: 16px;
        padding: 22px 26px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }
    .mapel-banner h3 {
        margin: 0 0 4px;
        font-size: 20px;
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
        padding: 8px 16px;
        border-radius: 10px;
        text-decoration: none;
    }
    .btn-back-mapel:hover {
        background: var(--purple-light);
        text-decoration: none;
    }
    .view-toggle {
        display: flex;
        gap: 8px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .view-btn {
        background: white;
        border: 1px solid var(--border);
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        color: var(--ink);
    }
    .view-btn.active {
        background: var(--purple);
        color: white;
        border-color: var(--purple);
    }
    .bab-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 18px;
    }
    .bab-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }
    .level-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }
    .level-pill.active-mudah { background: #dcfce7; color: #166534; }
    .level-pill.active-sedang { background: #fef3c7; color: #92400e; }
    .level-pill.active-sulit { background: #fee2e2; color: #991b1b; }
    .level-pill.inactive { background: #f3f4f6; color: #9ca3af; }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <h1>Kuis &amp; Soal</h1>
        <p>{{ $mapelTerpilih ? 'Kelola kuis mata pelajaran: ' . $mapelTerpilih->nama_mapel : 'Pilih mata pelajaran untuk mengelola kuis dan soal.' }}</p>
    </div>
    @if ($mapelTerpilih)
        <a href="{{ route('kuis.create', ['mapel' => $mapelTerpilih->id_mapel]) }}" class="btn">
            + Tambah Kuis
        </a>
    @endif
</div>

@if (!$mapelTerpilih)
    {{-- PILIH MATA PELAJARAN --}}
    <section class="card">
        <div class="card-header">
            <div>
                <h2>Pilih Mata Pelajaran</h2>
                <p class="muted">Klik mata pelajaran untuk mengelola kuis dan soal di dalamnya.</p>
            </div>
        </div>

        @if ($mapelAktif->isEmpty())
            <div class="empty">
                <h3>Belum ada mata pelajaran aktif</h3>
                <p>Hubungi admin untuk menambahkan mata pelajaran terlebih dahulu.</p>
            </div>
        @else
            <div class="mapel-grid">
                @foreach ($mapelAktif as $mapel)
                    <a href="{{ route('kuis.index', ['mapel' => $mapel->id_mapel]) }}" class="mapel-card">
                        <div>
                            <div class="mapel-icon">📖</div>
                            <h3 style="font-size: 17px; margin-bottom: 4px;">{{ $mapel->nama_mapel }}</h3>
                            <span class="muted small">{{ $mapel->id_mapel }}</span>
                        </div>
                        <div style="margin-top: 16px; padding-top: 12px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; font-size: 12px;">
                            <span class="muted"><strong>{{ $mapel->kuis_count }}</strong> kuis aktif</span>
                            <span style="font-weight: 700; color: var(--purple);">Kelola →</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

@else
    {{-- BANNER MAPEL TERPILIH --}}
    <div class="mapel-banner">
        <div>
            <h3>{{ $mapelTerpilih->nama_mapel }}</h3>
            <p>{{ $kuis->count() }} kuis tersedia &bull; Kode: {{ $mapelTerpilih->id_mapel }}</p>
        </div>
        <a href="{{ route('kuis.index') }}" class="btn-back-mapel">
            ← Ganti Mata Pelajaran
        </a>
    </div>

    {{-- TOGGLE VIEW --}}
    <div class="view-toggle">
        <button type="button" class="view-btn active" id="btn-view-bab" onclick="switchView('bab')">
            📁 Kelompokkan Per Bab Materi
        </button>
        <button type="button" class="view-btn" id="btn-view-all" onclick="switchView('all')">
            📋 Semua Kuis (Tabel Lengkap)
        </button>
    </div>

    @php
        $kuisPerMateri = [];
        $kuisUmum = [];
        foreach ($kuis as $k) {
            if ($k->materi->isNotEmpty()) {
                foreach ($k->materi as $m) {
                    $kuisPerMateri[$m->id_materi][$k->id_kuis] = $k;
                }
            } else {
                $kuisUmum[$k->id_kuis] = $k;
            }
        }
    @endphp

    {{-- VIEW 1: PER BAB --}}
    <div id="view-bab">
        @if ($daftarMateri->isNotEmpty())
            @foreach ($daftarMateri as $materiItem)
                @php
                    $listKuisBab = array_values($kuisPerMateri[$materiItem->id_materi] ?? []);
                    $hasMudah = collect($listKuisBab)->contains(fn ($k) => $k->tingkat_kesulitan === 'mudah');
                    $hasSedang = collect($listKuisBab)->contains(fn ($k) => $k->tingkat_kesulitan === 'sedang');
                    $hasSulit = collect($listKuisBab)->contains(fn ($k) => $k->tingkat_kesulitan === 'sulit');
                @endphp

                <div class="bab-card">
                    <div class="bab-header">
                        <div>
                            <h2 style="font-size: 17px; margin-bottom: 2px;">
                                {{ $materiItem->bab ? $materiItem->bab . ' - ' : '' }}{{ $materiItem->judul }}
                            </h2>
                            <span class="muted small">{{ count($listKuisBab) }} kuis terdaftar</span>
                        </div>

                        <div style="display: flex; gap: 6px;">
                            <span class="level-pill {{ $hasMudah ? 'active-mudah' : 'inactive' }}">
                                {{ $hasMudah ? '✓' : '○' }} Mudah
                            </span>
                            <span class="level-pill {{ $hasSedang ? 'active-sedang' : 'inactive' }}">
                                {{ $hasSedang ? '✓' : '○' }} Sedang
                            </span>
                            <span class="level-pill {{ $hasSulit ? 'active-sulit' : 'inactive' }}">
                                {{ $hasSulit ? '✓' : '○' }} Sulit
                            </span>
                        </div>
                    </div>

                    @if (count($listKuisBab) > 0)
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Judul Kuis</th>
                                        <th>Kategori</th>
                                        <th>Tingkat</th>
                                        <th style="width: 50px;">Soal</th>
                                        <th>KKM</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                        <th style="min-width: 170px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listKuisBab as $item)
                                        <tr>
                                            <td><code>{{ $item->id_kuis }}</code></td>
                                            <td><strong>{{ $item->judul }}</strong></td>
                                            <td><span class="badge">{{ ucfirst($item->kategori) }}</span></td>
                                            <td>
                                                <span class="badge {{ $item->tingkat_kesulitan === 'mudah' ? 'badge-success' : ($item->tingkat_kesulitan === 'sedang' ? 'badge-warning' : 'badge-danger') }}">
                                                    {{ ucfirst($item->tingkat_kesulitan ?? 'sedang') }}
                                                </span>
                                            </td>
                                            <td>{{ $item->soal->count() }}</td>
                                            <td>{{ $item->kkm ?? '-' }}</td>
                                            <td>{{ $item->alokasi_waktu ?? '-' }}m</td>
                                            <td>
                                                @if($item->status_publikasi === 'terbit')
                                                    <span class="badge badge-success">Terbit</span>
                                                @else
                                                    <span class="badge badge-muted">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="actions">
                                                    <a href="{{ route('kuis.show', $item->id_kuis) }}" class="btn btn-secondary btn-small">Lihat</a>
                                                    @if ($item->status_publikasi === 'terbit')
                                                        <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-secondary btn-small" onclick="alert('Kuis tersebut tidak dapat diedit karena berstatus terbit. Ubah ke status draft terlebih dahulu.'); return false;">Edit</a>
                                                    @else
                                                        <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-secondary btn-small">Edit</a>
                                                    @endif
                                                    <form action="{{ route('kuis.destroy', $item->id_kuis) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Arsipkan kuis ini?')">Arsip</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" style="padding: 16px;">
                            <p class="muted small" style="margin-bottom: 8px;">Belum ada kuis untuk bab materi ini.</p>
                            <a href="{{ route('kuis.create', ['mapel' => $mapelTerpilih->id_mapel]) }}" class="btn btn-secondary btn-small">
                                + Buat Kuis Bab Ini
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif

        {{-- KUIS UMUM --}}
        @if (count($kuisUmum) > 0)
            <div class="bab-card">
                <div class="bab-header">
                    <div>
                        <h2 style="font-size: 17px; margin-bottom: 2px;">📝 Ulangan &amp; Kuis Umum</h2>
                        <span class="muted small">{{ count($kuisUmum) }} kuis umum tanpa materi spesifik</span>
                    </div>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul Kuis</th>
                                <th>Kategori</th>
                                <th>Tingkat</th>
                                <th>Soal</th>
                                <th>KKM</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kuisUmum as $item)
                                <tr>
                                    <td><code>{{ $item->id_kuis }}</code></td>
                                    <td><strong>{{ $item->judul }}</strong></td>
                                    <td><span class="badge">{{ ucfirst($item->kategori) }}</span></td>
                                    <td>
                                        <span class="badge {{ $item->tingkat_kesulitan === 'mudah' ? 'badge-success' : ($item->tingkat_kesulitan === 'sedang' ? 'badge-warning' : 'badge-danger') }}">
                                            {{ ucfirst($item->tingkat_kesulitan ?? 'sedang') }}
                                        </span>
                                    </td>
                                    <td>{{ $item->soal->count() }}</td>
                                    <td>{{ $item->kkm ?? '-' }}</td>
                                    <td>{{ $item->alokasi_waktu ?? '-' }}m</td>
                                    <td>
                                        @if($item->status_publikasi === 'terbit')
                                            <span class="badge badge-success">Terbit</span>
                                        @else
                                            <span class="badge badge-muted">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('kuis.show', $item->id_kuis) }}" class="btn btn-secondary btn-small">Lihat</a>
                                            @if ($item->status_publikasi === 'terbit')
                                                <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-secondary btn-small" onclick="alert('Kuis tersebut tidak dapat diedit karena berstatus terbit. Ubah ke status draft terlebih dahulu.'); return false;">Edit</a>
                                            @else
                                                <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-secondary btn-small">Edit</a>
                                            @endif
                                            <form action="{{ route('kuis.destroy', $item->id_kuis) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Arsipkan kuis ini?')">Arsip</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    {{-- VIEW 2: SEMUA KUIS TABEL LENGKAP --}}
    <div id="view-all" style="display: none;">
        <section class="card">
            @if ($kuis->count() > 0)
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tingkat</th>
                                <th>Soal</th>
                                <th>KKM</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kuis as $item)
                                <tr>
                                    <td><code>{{ $item->id_kuis }}</code></td>
                                    <td><strong>{{ $item->judul }}</strong></td>
                                    <td><span class="badge">{{ ucfirst($item->kategori) }}</span></td>
                                    <td>
                                        <span class="badge {{ $item->tingkat_kesulitan === 'mudah' ? 'badge-success' : ($item->tingkat_kesulitan === 'sedang' ? 'badge-warning' : 'badge-danger') }}">
                                            {{ ucfirst($item->tingkat_kesulitan ?? 'sedang') }}
                                        </span>
                                    </td>
                                    <td>{{ $item->soal->count() }}</td>
                                    <td>{{ $item->kkm ?? '-' }}</td>
                                    <td>{{ $item->alokasi_waktu ?? '-' }}m</td>
                                    <td>
                                        @if($item->status_publikasi === 'terbit')
                                            <span class="badge badge-success">Terbit</span>
                                        @else
                                            <span class="badge badge-muted">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('kuis.show', $item->id_kuis) }}" class="btn btn-secondary btn-small">Lihat</a>
                                            @if ($item->status_publikasi === 'terbit')
                                                <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-secondary btn-small" onclick="alert('Kuis tersebut tidak dapat diedit karena berstatus terbit. Ubah ke status draft terlebih dahulu.'); return false;">Edit</a>
                                            @else
                                                <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-secondary btn-small">Edit</a>
                                            @endif
                                            <form action="{{ route('kuis.destroy', $item->id_kuis) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Arsipkan kuis ini?')">Arsip</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty">
                    <h3>Belum ada kuis di mata pelajaran ini</h3>
                    <p>Klik tombol "Tambah Kuis" untuk membuat kuis baru.</p>
                </div>
            @endif
        </section>
    </div>
@endif

@push('scripts')
<script>
    function switchView(mode) {
        const viewBab = document.getElementById('view-bab');
        const viewAll = document.getElementById('view-all');
        const btnBab = document.getElementById('btn-view-bab');
        const btnAll = document.getElementById('btn-view-all');
        if (!viewBab || !viewAll) return;
        if (mode === 'bab') {
            viewBab.style.display = 'block';
            viewAll.style.display = 'none';
            btnBab.classList.add('active');
            btnAll.classList.remove('active');
        } else {
            viewBab.style.display = 'none';
            viewAll.style.display = 'block';
            btnAll.classList.add('active');
            btnBab.classList.remove('active');
        }
    }
</script>
@endpush

@endsection
