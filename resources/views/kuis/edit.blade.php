@extends('layouts.guru')
@section('title', 'Edit Kuis - ' . $kuis->judul)

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
        <a href="{{ route('kuis.index', ['mapel' => $kuis->id_mapel]) }}" class="btn btn-secondary" style="display:inline-block; margin-bottom:6px;">
            ← Kembali
        </a>
        <h1>Edit Kuis</h1>
        <p>Perbarui informasi kuis, alokasi waktu, kriteria kelulusan, dan jadwal pelaksanaan.</p>
    </div>
</div>

<section class="card form-card">
    <div class="card-header">
        <div>
            <h2>Formulir Edit Kuis</h2>
            <p class="muted">Tanda bintang (<span style="color:#a52a3b;">*</span>) menandakan kolom wajib diisi.</p>
        </div>
    </div>

    <form action="{{ route('kuis.update', $kuis->id_kuis) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="judul">Judul Kuis <span style="color:#a52a3b;">*</span></label>
            <input
                type="text"
                id="judul"
                name="judul"
                value="{{ old('judul', $kuis->judul) }}"
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
                rows="4"
                placeholder="Masukkan petunjuk atau deskripsi kuis..."
            >{{ old('deskripsi', $kuis->deskripsi) }}</textarea>
            @error('deskripsi') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="grid grid-2">
            <div class="field">
                <label for="id_mapel">Mata Pelajaran <span style="color:#a52a3b;">*</span></label>
                <select id="id_mapel" name="id_mapel" required>
                    @foreach ($mapel as $itemMapel)
                        <option value="{{ $itemMapel->id_mapel }}" @selected(old('id_mapel', $kuis->id_mapel) === $itemMapel->id_mapel)>
                            {{ $itemMapel->kode_mapel }} - {{ $itemMapel->nama_mapel }}{{ $itemMapel->is_aktif ? '' : ' (nonaktif)' }}
                        </option>
                    @endforeach
                </select>
                <p class="help">Diisi otomatis, tidak dapat diubah.</p>
                @error('id_mapel') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="tahun_ajaran">Tahun Ajaran</label>
                <input
                    id="tahun_ajaran"
                    type="text"
                    value="{{ $kuis->tahunAjaran?->nama ?? '-' }}"
                    readonly
                >
                <p class="help">Tahun ajaran kuis dikunci sejak kuis dibuat.</p>
            </div>
        </div>

        <div class="grid grid-2">
            <div class="field">
                <label for="tingkat_kesulitan">Tingkat Kesulitan <span style="color:#a52a3b;">*</span></label>
                <select id="tingkat_kesulitan" name="tingkat_kesulitan" required>
                    @foreach (['mudah' => 'Mudah', 'sedang' => 'Sedang', 'sulit' => 'Sulit'] as $nilai => $label)
                        <option value="{{ $nilai }}" @selected(old('tingkat_kesulitan', $kuis->tingkat_kesulitan) === $nilai)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('tingkat_kesulitan') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="kategori">Kategori <span style="color:#a52a3b;">*</span></label>
                <select name="kategori" id="kategori" required>
                    <option value="post-test" @selected(old('kategori', $kuis->kategori) === 'post-test')>Post-test</option>
                    <option value="pre-test" @selected(old('kategori', $kuis->kategori) === 'pre-test')>Pre-test</option>
                    <option value="kuis harian" @selected(old('kategori', $kuis->kategori) === 'kuis harian')>Kuis Harian</option>
                    <option value="ulangan" @selected(old('kategori', $kuis->kategori) === 'ulangan')>Ulangan</option>
                    <option value="remedial" @selected(old('kategori', $kuis->kategori) === 'remedial')>Remedial</option>
                </select>
                @error('kategori') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- PILIH MATERI TERKAIT -->
        <div id="materi-container" class="special-card">
            <label for="materi-select" style="font-weight:700; display:block; margin-bottom:6px;">Materi Terkait</label>
            <p class="muted small" style="margin-bottom:10px;">Pilih materi yang berkaitan dengan kuis. Tahan tombol Ctrl (Windows) untuk memilih beberapa bab.</p>
            <select
                id="materi-select"
                name="materi[]"
                multiple
                style="height: 140px; width: 100%; border: 1px solid #d0c8ed; border-radius: 10px; padding: 10px;"
            >
                @foreach ($materi as $itemMateri)
                    <option
                        value="{{ $itemMateri->id_materi }}"
                        data-mapel="{{ $itemMateri->id_mapel }}"
                        @selected(in_array($itemMateri->id_materi, old('materi', $materiTerpilih ?? [])))
                    >
                        @if ($itemMateri->bab) [{{ $itemMateri->bab }}] - @endif {{ $itemMateri->judul }}
                    </option>
                @endforeach
            </select>
            <p id="materi-empty-hint" class="help" style="display:none; color:#c98200; font-weight:700; margin-top:8px;">
                ⚠️ Belum ada materi untuk mata pelajaran ini.
            </p>
        </div>

        <div class="grid grid-2">
            <div class="field">
                <label for="alokasi_waktu">Alokasi Waktu (menit)</label>
                <input
                    type="number"
                    id="alokasi_waktu"
                    name="alokasi_waktu"
                    value="{{ old('alokasi_waktu', $kuis->alokasi_waktu) }}"
                    min="1"
                    placeholder="Contoh: 60"
                >
                <p class="help">Kosongkan jika kuis tidak memiliki batas pengerjaan.</p>
                @error('alokasi_waktu') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="kkm">KKM (Kriteria Ketuntasan Minimal)</label>
                <input
                    type="number"
                    id="kkm"
                    name="kkm"
                    value="{{ old('kkm', $kuis->kkm) }}"
                    min="0"
                    max="100"
                    step="0.01"
                    placeholder="Contoh: 75"
                >
                <p class="help">Batas nilai minimal untuk dinyatakan lulus.</p>
                @error('kkm') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- JADWAL TERBIT & DRAFT OTOMATIS -->
        <div id="waktu-container" class="special-card">
            <label style="font-weight:700; display:block; margin-bottom:6px;">📅 Jadwal Terbit &amp; Selesai Otomatis</label>
            <p class="muted small" style="margin-bottom:12px;" id="waktu-keterangan">Tentukan tanggal dan jam untuk menerbitkan kuis secara otomatis, dan/atau mengembalikannya ke draft saat waktu berakhir. (Wajib untuk kategori Ulangan, opsional untuk kategori lainnya).</p>
            <div class="grid grid-2">
                <div class="field">
                    <label for="waktu_mulai">Tanggal &amp; Waktu Terbit Otomatis</label>
                    <input
                        type="datetime-local"
                        id="waktu_mulai"
                        name="waktu_mulai"
                        value="{{ old('waktu_mulai', $kuis->waktu_mulai?->format('Y-m-d\TH:i')) }}"
                    >
                    <p class="help">Kuis otomatis berstatus "Terbit" saat waktu ini tiba.</p>
                    @error('waktu_mulai') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="waktu_selesai">Tanggal &amp; Waktu Selesai (Otomatis Ditutup / Draft)</label>
                    <input
                        type="datetime-local"
                        id="waktu_selesai"
                        name="waktu_selesai"
                        value="{{ old('waktu_selesai', $kuis->waktu_selesai?->format('Y-m-d\TH:i')) }}"
                    >
                    <p class="help">Kuis otomatis kembali ke "Draft" saat waktu ini lewat.</p>
                    @error('waktu_selesai') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('kuis.index', ['mapel' => $kuis->id_mapel]) }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>

@push('scripts')
<script>
    const kategori = document.getElementById('kategori');
    const materiContainer = document.getElementById('materi-container');
    const waktuContainer = document.getElementById('waktu-container');

    function updateForm() {
        if (!kategori) return;
        if (
            kategori.value === 'ulangan' ||
            kategori.value === 'post-test' ||
            kategori.value === 'pre-test' ||
            kategori.value === 'kuis harian'
        ) {
            if (materiContainer) materiContainer.style.display = 'block';
        } else {
            if (materiContainer) materiContainer.style.display = 'none';
        }

        const ket = document.getElementById('waktu-keterangan');
        if (ket) {
            ket.textContent = kategori.value === 'ulangan'
                ? 'Jadwal wajib diisi untuk kategori Ulangan.'
                : 'Jadwal opsional: Tentukan tanggal dan jam untuk menerbitkan kuis secara otomatis.';
        }
    }

    if (kategori) {
        kategori.addEventListener('change', updateForm);
        updateForm();
    }

    // Filter Materi sesuai Mapel Kuis
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
