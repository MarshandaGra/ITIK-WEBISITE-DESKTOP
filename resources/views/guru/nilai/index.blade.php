@extends('layouts.guru')
@section('title', 'Daftar Nilai Siswa')

@push('styles')
<style>
    /* FILTER SECTION DENGAN GAYA CHIPS SEPERTI WHATSAPP */
    .filter-section {
        background: white;
        border-radius: 16px;
        padding: 18px 22px;
        margin-bottom: 22px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 20px #29263d03;
    }
    .filter-header-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: var(--muted);
        margin-bottom: 12px;
    }
    .filter-pills-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
    }
    .pill-item {
        position: relative;
    }
    .pill-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        border-radius: 24px;
        background: #f6f5fc;
        border: 1.5px solid #ded9f7;
        color: var(--ink);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s ease;
        user-select: none;
    }
    .pill-btn:hover {
        background: var(--purple-light);
        border-color: #b8aaff;
    }
    .pill-btn.active {
        background: var(--purple);
        color: white;
        border-color: var(--purple);
    }
    .pill-btn.active .caret {
        color: white;
    }
    .pill-btn .caret {
        font-size: 9px;
        color: var(--muted);
        transition: transform .2s ease;
    }
    .pill-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        background: white;
        border-radius: 14px;
        border: 1px solid var(--border);
        box-shadow: 0 10px 35px rgba(41, 38, 61, .12);
        z-index: 100;
        min-width: 220px;
        padding: 6px;
    }
    .pill-dropdown.show {
        display: block;
    }
    .pill-dropdown-item {
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        color: var(--ink);
        transition: background .15s ease;
    }
    .pill-dropdown-item:hover {
        background: var(--purple-light);
        color: var(--purple);
    }
    .pill-dropdown-item.selected {
        background: var(--purple-light);
        color: var(--purple);
        font-weight: 700;
    }
    .pill-input-form {
        display: none;
        align-items: center;
        gap: 6px;
        background: white;
        border: 1.5px solid var(--purple);
        border-radius: 24px;
        padding: 4px 10px;
        box-shadow: 0 4px 15px rgba(92, 75, 224, .15);
    }
    .pill-input-form.show {
        display: inline-flex;
    }
    .pill-input-form input {
        border: none;
        outline: none;
        font-size: 13px;
        font-weight: 600;
        padding: 4px 8px;
        width: 110px;
        min-height: auto;
    }
    .pill-input-form button {
        border: none;
        background: var(--purple);
        color: white;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
    }
    .btn-pill-reset {
        background: #fff0f2 !important;
        border-color: #efc0c8 !important;
        color: #96293b !important;
    }
    .badge-category {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        text-transform: capitalize;
    }
    .badge-category.ulangan { background: #fee2e2; color: #991b1b; }
    .badge-category.remedial { background: #fef3c7; color: #92400e; }
    .badge-category.kuis-harian, .badge-category[class*="kuis"] { background: #e0e7ff; color: #3730a3; }
    .badge-category.pre-test, .badge-category.post-test { background: #dcfce7; color: #166534; }
    .score.pass { color: #166534; font-weight: 700; }
    .score.fail { color: #991b1b; font-weight: 700; }
    .pass { color: #166534; font-weight: 600; font-size: 12px; }
    .fail { color: #991b1b; font-weight: 600; font-size: 12px; }
    .btn-action-remedial {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #f59e0b;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s ease;
    }
    .btn-action-remedial:hover {
        background: #d97706;
    }
    .badge-remedial-done {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 11px;
        font-weight: 700;
    }

    /* KELAS CARDS GURU */
    .kelas-section {
        margin-bottom: 24px;
    }
    .kelas-grid-guru {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 16px;
    }
    .kelas-card-guru {
        background: white;
        border: 1.5px solid var(--border);
        border-radius: 16px;
        padding: 18px 20px;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 4px 18px #29263d04;
        transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
    }
    .kelas-card-guru:hover {
        transform: translateY(-2px);
        border-color: var(--purple);
        box-shadow: 0 8px 25px rgba(85,66,220,.1);
        text-decoration: none;
    }
    .kelas-card-guru.active {
        border-color: var(--purple);
        background: #fbfafd;
        box-shadow: 0 0 0 2px var(--purple);
    }
    .kelas-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    .kelas-card-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--ink);
        margin: 0;
    }
    .kelas-stat-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-bottom: 14px;
    }
    .kelas-stat-box {
        background: #f8fafc;
        border-radius: 10px;
        padding: 8px 10px;
    }
    .kelas-stat-box .label {
        font-size: 11px;
        color: var(--muted);
        display: block;
        font-weight: 600;
        margin-bottom: 2px;
    }
    .kelas-stat-box .value {
        font-size: 13px;
        font-weight: 800;
        color: var(--ink);
    }
    .kelas-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 10px;
        border-top: 1px solid var(--border);
        font-size: 12px;
        font-weight: 700;
        color: var(--purple);
    }
    .banner-kelas-active {
        background: linear-gradient(135deg, #ede9fc 0%, #f6f5fc 100%);
        border: 1px solid #d0c8ed;
        border-radius: 14px;
        padding: 14px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        flex-wrap: wrap;
        gap: 12px;
    }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <h1>Daftar Nilai Siswa</h1>
        <p>Pantau hasil pengerjaan kuis siswa per kelas dan berikan tugas remedial bagi yang belum lulus ulangan.</p>
    </div>
</div>

{{-- LEVEL 1: KELOMPOK KELAS GURU --}}
@if(isset($kelasList) && $kelasList->isNotEmpty())
    <div class="kelas-section">
        <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: var(--muted); margin-bottom: 12px;">
            🏫 Pilih Kelas Pembelajaran
        </div>
        <div class="kelas-grid-guru">
            @foreach($kelasList as $k)
                @php
                    $isActive = ($idKelas === $k->id_kelas);
                @endphp
                <a href="{{ $isActive ? route('guru.nilai.index') : route('guru.nilai.index', ['kelas' => $k->id_kelas]) }}"
                   class="kelas-card-guru {{ $isActive ? 'active' : '' }}">
                    <div>
                        <div class="kelas-card-header">
                            <h3 class="kelas-card-title">{{ $k->nama_kelas }}</h3>
                            <span class="badge {{ $isActive ? 'badge-primary' : 'badge-muted' }}">
                                Tingkat {{ $k->tingkat }}
                            </span>
                        </div>
                        <div class="kelas-stat-grid">
                            <div class="kelas-stat-box">
                                <span class="label">👥 Siswa</span>
                                <span class="value">{{ $k->total_siswa }}</span>
                            </div>
                            <div class="kelas-stat-box">
                                <span class="label">📖 Materi</span>
                                <span class="value">{{ $k->total_materi }}</span>
                            </div>
                            <div class="kelas-stat-box">
                                <span class="label">📝 Kuis Aktif</span>
                                <span class="value">{{ $k->kuis_aktif }}</span>
                            </div>
                            <div class="kelas-stat-box">
                                <span class="label">📊 Rata Nilai</span>
                                <span class="value" style="color: {{ $k->rata_nilai && $k->rata_nilai >= 75 ? '#166534' : '#92400e' }};">
                                    {{ $k->rata_nilai !== null ? $k->rata_nilai : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="kelas-card-footer">
                        <span>{{ $isActive ? '✓ Sedang Dilihat' : 'Buka Nilai Kelas' }}</span>
                        <span>{{ $isActive ? '✕' : '→' }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif

@if($kelasTerpilih)
    <div class="banner-kelas-active">
        <div>
            <strong style="color: var(--purple); font-size: 15px;">
                📂 Menampilkan Data Nilai: Kelas {{ $kelasTerpilih->nama_kelas }}
            </strong>
            <span class="muted small" style="margin-left: 8px;">
                ({{ $kelasTerpilih->total_siswa }} Siswa &bull; Rata-rata Nilai: {{ $kelasTerpilih->rata_nilai ?? '-' }})
            </span>
        </div>
        <a href="{{ route('guru.nilai.index') }}" class="btn btn-secondary btn-small">
            ✕ Tampilkan Semua Kelas
        </a>
    </div>
@endif

<!-- WHATSAPP-LIKE FILTER PILLS BAR -->
<div class="filter-section">
    <div class="filter-header-label">
        <span>⚡ Klasifikasi &amp; Filter Cepat</span>
    </div>

    <div class="filter-pills-bar">

        <!-- 1. CHIP KATEGORI (DROPDOWN) -->
        <div class="pill-item">
            <div class="pill-btn" id="btn-chip-kategori" onclick="toggleDropdown('dropdown-kategori')">
                <span>🏷️ Kategori:</span>
                <strong id="label-kategori">{{ $kategori ? ucfirst($kategori) : 'Semua' }}</strong>
                <span class="caret">▼</span>
            </div>
            <div class="pill-dropdown" id="dropdown-kategori">
                <div class="pill-dropdown-item {{ !$kategori ? 'selected' : '' }}" onclick="applyFilter('kategori', '')">
                    Semua Kategori
                </div>
                <div class="pill-dropdown-item {{ strtolower($kategori) === 'ulangan' ? 'selected' : '' }}" onclick="applyFilter('kategori', 'ulangan')">
                    Ulangan
                </div>
                <div class="pill-dropdown-item {{ strtolower($kategori) === 'kuis harian' ? 'selected' : '' }}" onclick="applyFilter('kategori', 'kuis harian')">
                    Kuis Harian
                </div>
                <div class="pill-dropdown-item {{ strtolower($kategori) === 'pre-test' ? 'selected' : '' }}" onclick="applyFilter('kategori', 'pre-test')">
                    Pre-test
                </div>
                <div class="pill-dropdown-item {{ strtolower($kategori) === 'post-test' ? 'selected' : '' }}" onclick="applyFilter('kategori', 'post-test')">
                    Post-test
                </div>
                <div class="pill-dropdown-item {{ strtolower($kategori) === 'remedial' ? 'selected' : '' }}" onclick="applyFilter('kategori', 'remedial')">
                    Remedial
                </div>
            </div>
        </div>

        <!-- 2. CHIP PERCOBAAN (INLINE FORM INPUT HANYA ANGKA) -->
        <div class="pill-item">
            <div class="pill-btn {{ $percobaan ? 'active' : '' }}" id="btn-chip-percobaan" onclick="showPercobaanInput()">
                <span>🔄 Percobaan:</span>
                <strong id="label-percobaan">{{ $percobaan ? 'Ke-' . $percobaan : 'Semua' }}</strong>
                <span class="caret">▼</span>
            </div>
            <div class="pill-input-form" id="form-chip-percobaan">
                <label for="input-percobaan" style="font-size:12px; font-weight:bold; color:var(--purple);">Ke-</label>
                <input type="number" id="input-percobaan" min="1" placeholder="1" value="{{ $percobaan ?? '' }}" onkeydown="if(event.key==='Enter') submitPercobaan()">
                <button type="button" onclick="submitPercobaan()" title="Terapkan">✓</button>
                <button type="button" onclick="resetPercobaanInput()" title="Batal" style="background:#ddd; color:#333;">✕</button>
            </div>
        </div>

        <!-- 3. CHIP KELULUSAN (DROPDOWN) -->
        <div class="pill-item">
            <div class="pill-btn {{ $kelulusan ? 'active' : '' }}" id="btn-chip-kelulusan" onclick="toggleDropdown('dropdown-kelulusan')">
                <span>🎓 Kelulusan:</span>
                <strong id="label-kelulusan">
                    @if($kelulusan === 'lulus') Lulus (≥ KKM)
                    @elseif($kelulusan === 'tidak_lulus') Tidak Lulus (&lt; KKM)
                    @else Semua
                    @endif
                </strong>
                <span class="caret">▼</span>
            </div>
            <div class="pill-dropdown" id="dropdown-kelulusan">
                <div class="pill-dropdown-item {{ !$kelulusan ? 'selected' : '' }}" onclick="applyFilter('kelulusan', '')">
                    Semua Kelulusan
                </div>
                <div class="pill-dropdown-item {{ $kelulusan === 'lulus' ? 'selected' : '' }}" onclick="applyFilter('kelulusan', 'lulus')">
                    ✓ Lulus (≥ KKM)
                </div>
                <div class="pill-dropdown-item {{ $kelulusan === 'tidak_lulus' ? 'selected' : '' }}" onclick="applyFilter('kelulusan', 'tidak_lulus')">
                    ⚠️ Tidak Lulus (&lt; KKM)
                </div>
            </div>
        </div>

        <!-- 4. CHIP TANGGAL (DATE PICKER) -->
        <div class="pill-item">
            <div class="pill-btn {{ $tanggal ? 'active' : '' }}" id="btn-chip-tanggal" onclick="showTanggalInput()">
                <span>📅 Tanggal:</span>
                <strong id="label-tanggal">{{ $tanggal ? date('d/m/Y', strtotime($tanggal)) : 'Semua' }}</strong>
                <span class="caret">▼</span>
            </div>
            <div class="pill-input-form" id="form-chip-tanggal">
                <input type="date" id="input-tanggal" value="{{ $tanggal ?? '' }}" onchange="submitTanggal(this.value)">
                <button type="button" onclick="resetTanggalInput()" title="Batal" style="background:#ddd; color:#333;">✕</button>
            </div>
        </div>

        <!-- 5. CHIP RESET (JIKA ADA FILTER AKTIF) -->
        <div class="pill-item" id="pill-reset-wrapper" style="{{ ($kategori || $percobaan || $kelulusan || $tanggal) ? '' : 'display:none;' }}">
            <div class="pill-btn btn-pill-reset" onclick="resetAllFilters()">
                ✕ Reset Filter
            </div>
        </div>

    </div>
</div>

@if($hasil->isEmpty())
    <div class="empty">
        <h3>Tidak Ada Hasil Kuis</h3>
        <p>Tidak ditemukan data hasil kuis yang sesuai dengan kriteria filter saat ini.</p>
        @if($kategori || $percobaan || $kelulusan || $tanggal)
            <button onclick="resetAllFilters()" class="btn btn-secondary btn-small">
                ✕ Hapus Semua Filter
            </button>
        @endif
    </div>
@else
    <section class="card">
        <div class="card-header">
            <div>
                <h2>Hasil Pengerjaan Kuis Siswa</h2>
                <p class="muted" id="info-count-row">Menampilkan {{ $hasil->count() }} data pengerjaan kuis siswa</p>
            </div>
        </div>

        <div class="table-wrap">
            <table id="table-nilai">
                <thead>
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th>Siswa</th>
                        <th>Kuis</th>
                        <th>Kategori</th>
                        <th style="width: 90px; text-align: center;">Percobaan</th>
                        <th style="width: 70px;">Nilai</th>
                        <th style="width: 70px;">KKM</th>
                        <th>Kelulusan</th>
                        <th>Tanggal</th>
                        <th style="min-width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasil as $item)
                        @php
                            $kat = strtolower(trim($item->kuis->kategori ?? ''));
                            $isUlangan = $kat === 'ulangan';
                            $lulus = $item->nilai !== null && $item->kuis && $item->kuis->kkm !== null && $item->nilai >= $item->kuis->kkm;
                            $sudahRemedial = in_array($item->id_mengerjakan, $sudahDitugaskanRemedial);
                        @endphp
                        <tr class="data-row"
                            data-kategori="{{ $kat }}"
                            data-percobaan="{{ $item->percobaan_ke }}"
                            data-lulus="{{ $lulus ? 'lulus' : 'tidak_lulus' }}"
                            data-tanggal="{{ $item->tanggal ? date('Y-m-d', strtotime($item->tanggal)) : '' }}">

                            <td class="row-num number" style="text-align: left;">{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $item->siswa->nama_lengkap ?? '-' }}</strong>
                                <span class="muted small">NISN: {{ $item->siswa->nomor_induk ?? '-' }}</span>
                            </td>

                            <td>
                                <strong>{{ $item->kuis->judul ?? '-' }}</strong>
                            </td>

                            <td>
                                <span class="badge-category {{ $kat }}">
                                    {{ $item->kuis->kategori ?? '-' }}
                                </span>
                            </td>

                            <td style="text-align: center;">
                                <strong>Ke-{{ $item->percobaan_ke }}</strong>
                            </td>

                            <td>
                                <strong class="score {{ $lulus ? 'pass' : 'fail' }}">
                                    {{ $item->nilai !== null ? number_format($item->nilai, 1) : '-' }}
                                </strong>
                            </td>

                            <td>
                                {{ $item->kuis->kkm !== null ? number_format($item->kuis->kkm, 1) : '-' }}
                            </td>

                            <td>
                                @if($item->nilai === null)
                                    -
                                @elseif($lulus)
                                    <span class="pass">✓ Lulus</span>
                                @else
                                    <span class="fail">⚠️ Tidak Lulus</span>
                                @endif
                            </td>

                            <td>
                                {{ $item->tanggal ? date('d/m/Y', strtotime($item->tanggal)) : '-' }}
                            </td>

                            <td>
                                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                    <a href="{{ route('guru.nilai.show', $item->id_mengerjakan) }}" class="btn btn-secondary btn-small">
                                        Lihat Detail
                                    </a>

                                    {{-- FITUR BERIKAN REMEDIAL: HANYA UNTUK KUIS KATEGORI ULANGAN YANG TIDAK LULUS --}}
                                    @if($isUlangan && !$lulus)
                                        @if($sudahRemedial)
                                            <span class="badge-remedial-done" title="Siswa sudah diberikan tugas remedial">
                                                ✓ Remedial Ditugaskan
                                            </span>
                                        @else
                                            <form action="{{ route('guru.nilai.remedial', $item->id_mengerjakan) }}" method="POST" style="display:inline;" onsubmit="return confirm('Berikan tugas remedial untuk siswa {{ $item->siswa->nama_lengkap ?? 'ini' }}?')">
                                                @csrf
                                                <button type="submit" class="btn-action-remedial" title="Tugaskan kuis remedial ke siswa ini">
                                                    ⚡ Berikan Remedial
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endif

@push('scripts')
<script>
    // State Filter Aktif
    const activeFilters = {
        kategori: '{{ strtolower($kategori ?? "") }}',
        percobaan: '{{ $percobaan ?? "" }}',
        kelulusan: '{{ $kelulusan ?? "" }}',
        tanggal: '{{ $tanggal ?? "" }}'
    };

    function toggleDropdown(id) {
        const el = document.getElementById(id);
        const isShown = el.classList.contains('show');
        closeAllDropdowns();
        if (!isShown) {
            el.classList.add('show');
        }
    }

    function closeAllDropdowns() {
        document.querySelectorAll('.pill-dropdown').forEach(d => d.classList.remove('show'));
    }

    // Tutup dropdown jika klik di luar
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.pill-item')) {
            closeAllDropdowns();
        }
    });

    // 1. Kategori Filter
    function applyFilter(key, value) {
        activeFilters[key] = value.toLowerCase().trim();
        closeAllDropdowns();

        const labelEl = document.getElementById('label-' + key);
        const btnEl = document.getElementById('btn-chip-' + key);
        if (value) {
            labelEl.textContent = value.charAt(0).toUpperCase() + value.slice(1);
            btnEl.classList.add('active');
        } else {
            labelEl.textContent = 'Semua';
            btnEl.classList.remove('active');
        }

        runClientFilter();
    }

    // 2. Percobaan Filter
    function showPercobaanInput() {
        document.getElementById('btn-chip-percobaan').style.display = 'none';
        const form = document.getElementById('form-chip-percobaan');
        form.classList.add('show');
        const inp = document.getElementById('input-percobaan');
        inp.focus();
        inp.select();
    }

    function submitPercobaan() {
        const val = document.getElementById('input-percobaan').value.trim();
        activeFilters.percobaan = val;
        const btn = document.getElementById('btn-chip-percobaan');
        const label = document.getElementById('label-percobaan');
        const form = document.getElementById('form-chip-percobaan');

        form.classList.remove('show');
        btn.style.display = 'inline-flex';

        if (val) {
            label.textContent = 'Ke-' + val;
            btn.classList.add('active');
        } else {
            label.textContent = 'Semua';
            btn.classList.remove('active');
        }

        runClientFilter();
    }

    function resetPercobaanInput() {
        document.getElementById('input-percobaan').value = '';
        submitPercobaan();
    }

    // 4. Tanggal Filter
    function showTanggalInput() {
        document.getElementById('btn-chip-tanggal').style.display = 'none';
        const form = document.getElementById('form-chip-tanggal');
        form.classList.add('show');
        document.getElementById('input-tanggal').focus();
    }

    function submitTanggal(val) {
        activeFilters.tanggal = val.trim();
        const btn = document.getElementById('btn-chip-tanggal');
        const label = document.getElementById('label-tanggal');
        const form = document.getElementById('form-chip-tanggal');

        form.classList.remove('show');
        btn.style.display = 'inline-flex';

        if (val) {
            const parts = val.split('-');
            label.textContent = parts[2] + '/' + parts[1] + '/' + parts[0];
            btn.classList.add('active');
        } else {
            label.textContent = 'Semua';
            btn.classList.remove('active');
        }

        runClientFilter();
    }

    function resetTanggalInput() {
        document.getElementById('input-tanggal').value = '';
        submitTanggal('');
    }

    // Reset Semua Filter
    function resetAllFilters() {
        activeFilters.kategori = '';
        activeFilters.percobaan = '';
        activeFilters.kelulusan = '';
        activeFilters.tanggal = '';

        document.getElementById('label-kategori').textContent = 'Semua';
        document.getElementById('btn-chip-kategori').classList.remove('active');

        document.getElementById('label-percobaan').textContent = 'Semua';
        document.getElementById('btn-chip-percobaan').classList.remove('active');
        document.getElementById('input-percobaan').value = '';

        document.getElementById('label-kelulusan').textContent = 'Semua';
        document.getElementById('btn-chip-kelulusan').classList.remove('active');

        document.getElementById('label-tanggal').textContent = 'Semua';
        document.getElementById('btn-chip-tanggal').classList.remove('active');
        document.getElementById('input-tanggal').value = '';

        const url = new URL(window.location);
        url.search = '';
        window.history.pushState({}, '', url);

        runClientFilter();
    }

    // Filter Real-Time pada Baris Tabel
    function runClientFilter() {
        const rows = document.querySelectorAll('.data-row');
        let visibleCount = 0;

        rows.forEach((row) => {
            const kat = (row.getAttribute('data-kategori') || '').toLowerCase();
            const perc = row.getAttribute('data-percobaan') || '';
            const lulus = row.getAttribute('data-lulus') || '';
            const tgl = row.getAttribute('data-tanggal') || '';

            let match = true;

            if (activeFilters.kategori && kat !== activeFilters.kategori) {
                match = false;
            }
            if (activeFilters.percobaan && perc !== activeFilters.percobaan) {
                match = false;
            }
            if (activeFilters.kelulusan && lulus !== activeFilters.kelulusan) {
                match = false;
            }
            if (activeFilters.tanggal && tgl !== activeFilters.tanggal) {
                match = false;
            }

            if (match) {
                row.style.display = '';
                visibleCount++;
                const numCell = row.querySelector('.row-num');
                if (numCell) numCell.textContent = visibleCount;
            } else {
                row.style.display = 'none';
            }
        });

        const hasActive = activeFilters.kategori || activeFilters.percobaan || activeFilters.kelulusan || activeFilters.tanggal;
        const resetBtn = document.getElementById('pill-reset-wrapper');
        if (resetBtn) {
            resetBtn.style.display = hasActive ? 'inline-block' : 'none';
        }

        const countInfo = document.getElementById('info-count-row');
        if (countInfo) {
            countInfo.textContent = 'Menampilkan ' + visibleCount + ' data pengerjaan kuis siswa';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (activeFilters.kategori || activeFilters.percobaan || activeFilters.kelulusan || activeFilters.tanggal) {
            runClientFilter();
        }
    });
</script>
@endpush

@endsection
