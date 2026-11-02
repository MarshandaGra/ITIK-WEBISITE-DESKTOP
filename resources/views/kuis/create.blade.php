@extends('layouts.guru')
@section('title', 'Tambah Kuis')

@push('styles')
<style>
    .special-card {
        background: #fbfafd;
        border: 1px dashed #d0c8ed;
        border-radius: 14px;
        padding: 18px 20px;
        margin-bottom: 18px;
    }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <a href="{{ route('kuis.index', $mapelTerpilih ? ['mapel' => $mapelTerpilih] : []) }}" class="btn btn-secondary" style="display:inline-block; margin-bottom:6px;">
            ← Kembali
        </a>
        <h1>Tambah Kuis Baru</h1>
        <p>Atur parameter penilaian, tingkat kesulitan, alokasi waktu, dan jadwal kuis.</p>
    </div>
</div>

<section class="card form-card">
    <div class="card-header">
        <div>
            <h2>Formulir Kuis Baru</h2>
            <p class="muted">Tanda bintang (<span style="color:#a52a3b;">*</span>) menandakan kolom wajib diisi.</p>
        </div>
    </div>

    <form action="{{ route('kuis.store') }}" method="POST">
        @csrf

        <div class="field">
            <label for="judul">Judul Kuis <span style="color:#a52a3b;">*</span></label>
            <input
                type="text"
                id="judul"
                name="judul"
                value="{{ old('judul') }}"
                placeholder="Masukkan judul kuis"
                required
            >
            @error('judul') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="deskripsi">Deskripsi Kuis</label>
            <textarea
                id="deskripsi"
                name="deskripsi"
                placeholder="Masukkan petunjuk atau deskripsi kuis..."
            >{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="grid grid-2">
            <div class="field">
                <label for="id_mapel">Mata Pelajaran <span style="color:#a52a3b;">*</span></label>
                <select id="id_mapel" name="id_mapel" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach ($mapel as $itemMapel)
                        <option value="{{ $itemMapel->id_mapel }}" @selected(old('id_mapel', $mapelTerpilih) === $itemMapel->id_mapel)>
                            {{ $itemMapel->kode_mapel }} - {{ $itemMapel->nama_mapel }}
                        </option>
                    @endforeach
                </select>
                @if ($mapel->isEmpty())
                    <p class="help">Belum ada mata pelajaran aktif. Hubungi admin sekolah.</p>
                @endif
                @error('id_mapel') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="tahun_ajaran">Tahun Ajaran</label>
                <input
                    id="tahun_ajaran"
                    type="text"
                    value="{{ $tahunAjaran?->nama ?? 'Belum ada tahun ajaran aktif' }}"
                    readonly
                >
                <p class="help">Diisi otomatis dari tahun ajaran aktif.</p>
            </div>
        </div>

        <div class="grid grid-2">
            <div class="field">
                <label for="tingkat_kesulitan">Tingkat Kesulitan <span style="color:#a52a3b;">*</span></label>
                <select id="tingkat_kesulitan" name="tingkat_kesulitan" required>
                    @foreach (['mudah' => 'Mudah', 'sedang' => 'Sedang', 'sulit' => 'Sulit'] as $nilai => $label)
                        <option value="{{ $nilai }}" @selected(old('tingkat_kesulitan', 'mudah') === $nilai)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('tingkat_kesulitan') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="kategori">Kategori Kuis <span style="color:#a52a3b;">*</span></label>
                <select id="kategori" name="kategori" required>
                    <option value="" {{ old('kategori') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                    <option value="post-test" {{ old('kategori') === 'post-test' ? 'selected' : '' }}>Post-test</option>
                    <option value="pre-test" {{ old('kategori') === 'pre-test' ? 'selected' : '' }}>Pre-test</option>
                    <option value="kuis harian" {{ old('kategori') === 'kuis harian' ? 'selected' : '' }}>Kuis Harian</option>
                    <option value="ulangan" {{ old('kategori') === 'ulangan' ? 'selected' : '' }}>Ulangan</option>
                    <option value="remedial" {{ old('kategori') === 'remedial' ? 'selected' : '' }}>Remedial</option>
                </select>
                @error('kategori') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- MATERI PER MAPEL --}}
        <div id="materi-container" class="special-card" style="display: none;">
            <div class="field" style="margin-bottom: 0;">
                <label for="materi-select">Hubungkan ke Bab Materi</label>
                <select id="materi-select" name="materi[]" multiple style="min-height: 120px;">
                    @foreach ($materi as $itemMateri)
                        <option
                            value="{{ $itemMateri->id_materi }}"
                            data-mapel="{{ $itemMateri->id_mapel }}"
                            {{ in_array($itemMateri->id_materi, old('materi', [])) ? 'selected' : '' }}
                        >
                            @if ($itemMateri->bab) [{{ $itemMateri->bab }}] - @endif {{ $itemMateri->judul }}
                        </option>
                    @endforeach
                </select>
                <p id="materi-empty-hint" class="help" style="display: none; color: #8a4d08; font-weight: bold;">
                    ⚠️ Belum ada materi untuk mata pelajaran ini. Buat materi terlebih dahulu di menu Materi agar kuis dapat terpetakan ke bab.
                </p>
                <p class="help">Gunakan Ctrl + klik untuk memilih lebih dari satu bab materi.</p>
            </div>
        </div>

        <div class="grid grid-2">
            <div class="field">
                <label for="alokasi_waktu">Alokasi Waktu (menit)</label>
                <input
                    type="number"
                    id="alokasi_waktu"
                    name="alokasi_waktu"
                    value="{{ old('alokasi_waktu') }}"
                    min="1"
                    placeholder="Contoh: 60"
                >
                @error('alokasi_waktu') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="kkm">KKM (Kriteria Ketuntasan Minimal)</label>
                <input
                    type="number"
                    id="kkm"
                    name="kkm"
                    value="{{ old('kkm') }}"
                    min="0"
                    max="100"
                    step="0.01"
                    placeholder="Contoh: 75"
                >
                @error('kkm') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- JADWAL TERBIT & DRAFT OTOMATIS --}}
        <div id="waktu-container" class="special-card">
            <h3 style="font-size: 15px; margin-bottom: 6px;">📅 Jadwal Terbit &amp; Selesai Otomatis</h3>
            <p class="muted small" style="margin-bottom: 12px;" id="waktu-keterangan">
                Tentukan tanggal dan jam untuk menerbitkan kuis secara otomatis, dan/atau mengembalikannya ke draft saat waktu berakhir. (Wajib untuk kategori Ulangan, opsional untuk kategori lainnya).
            </p>
            <div class="grid grid-2">
                <div class="field" style="margin-bottom: 0;">
                    <label for="waktu_mulai">Tanggal &amp; Waktu Terbit Otomatis</label>
                    <input
                        type="datetime-local"
                        id="waktu_mulai"
                        name="waktu_mulai"
                        value="{{ old('waktu_mulai') }}"
                    >
                    <p class="help">Kuis otomatis berstatus "Terbit" saat waktu ini tiba.</p>
                    @error('waktu_mulai') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="field" style="margin-bottom: 0;">
                    <label for="waktu_selesai">Tanggal &amp; Waktu Selesai (Otomatis Ditutup / Draft)</label>
                    <input
                        type="datetime-local"
                        id="waktu_selesai"
                        name="waktu_selesai"
                        value="{{ old('waktu_selesai') }}"
                    >
                    <p class="help">Kuis otomatis kembali ke "Draft" saat waktu ini lewat.</p>
                    @error('waktu_selesai') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        {{-- REMEDIAL ASAL --}}
        <div id="field-remedial" class="special-card" style="display: none;">
            <div class="field" style="margin-bottom: 0;">
                <label for="id_kuis_asal">Kuis Ulangan Asal</label>
                <select id="id_kuis_asal" name="id_kuis_asal">
                    <option value="">-- Pilih Kuis Asal --</option>
                    @foreach($kuisAsal as $item)
                        <option value="{{ $item->id_kuis }}" {{ old('id_kuis_asal') == $item->id_kuis ? 'selected' : '' }}>
                            {{ $item->judul }} ({{ $item->kategori }})
                        </option>
                    @endforeach
                </select>
                @error('id_kuis_asal') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-actions actions">
            <button type="submit" class="btn">
                Simpan Kuis
            </button>
            <a href="{{ route('kuis.index', $mapelTerpilih ? ['mapel' => $mapelTerpilih] : []) }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</section>

@push('scripts')
<script>
    const kategori = document.getElementById('kategori');
    const materiContainer = document.getElementById('materi-container');
    const waktuContainer = document.getElementById('waktu-container');
    const remedialContainer = document.getElementById('field-remedial');

    function updateForm() {
        const value = kategori.value;
        materiContainer.style.display = 'none';
        remedialContainer.style.display = 'none';

        if (value === 'post-test' || value === 'pre-test' || value === 'kuis harian' || value === 'ulangan') {
            materiContainer.style.display = 'block';
        } else if (value === 'remedial') {
            remedialContainer.style.display = 'block';
        }

        const ket = document.getElementById('waktu-keterangan');
        if (ket) {
            ket.textContent = value === 'ulangan'
                ? 'Jadwal wajib diisi untuk kategori Ulangan.'
                : 'Jadwal opsional: Tentukan tanggal dan jam untuk menerbitkan kuis secara otomatis.';
        }
    }

    if (kategori) {
        kategori.addEventListener('change', updateForm);
        updateForm();
    }

    const selectMapel = document.getElementById('id_mapel');
    const selectMateri = document.getElementById('materi-select');
    const hintMateriKosong = document.getElementById('materi-empty-hint');

    function filterMateriByMapel() {
        if (!selectMapel || !selectMateri) return;
        const mapelId = selectMapel.value;
        let visibleCount = 0;

        Array.from(selectMateri.options).forEach(opt => {
            const optMapel = opt.getAttribute('data-mapel');
            if (!mapelId || optMapel === mapelId) {
                opt.style.display = '';
                opt.disabled = false;
                visibleCount++;
            } else {
                opt.style.display = 'none';
                opt.disabled = true;
                opt.selected = false;
            }
        });

        if (hintMateriKosong) {
            hintMateriKosong.style.display = (mapelId && visibleCount === 0) ? 'block' : 'none';
        }
    }

    if (selectMapel) {
        selectMapel.addEventListener('change', filterMateriByMapel);
        filterMateriByMapel();
    }
</script>
@endpush

@endsection
