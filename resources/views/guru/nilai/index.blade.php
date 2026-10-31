<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nilai Siswa - ITIK</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f4fc;
            color: #202044;
            min-height: 100vh;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 270px;
            background: linear-gradient(180deg, #7160ef, #5948dd);
            color: white;
            padding: 30px 25px;
            flex-shrink: 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 60px;
        }

        .logo-icon {
            width: 55px;
            height: 55px;
            border: 1px solid rgba(255,255,255,.4);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: bold;
        }

        .logo h2 {
            font-size: 22px;
        }

        .logo span {
            font-size: 14px;
            opacity: .85;
        }

        .menu-title {
            font-size: 14px;
            opacity: .7;
            margin-bottom: 15px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: white;
            padding: 15px 18px;
            border-radius: 15px;
            margin-bottom: 8px;
            font-size: 17px;
        }

        .menu a.active {
            background: white;
            color: #5b4ae3;
        }

        .menu a:hover {
            background: rgba(255,255,255,.15);
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 30px 45px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .title h1 {
            font-size: 32px;
            margin-bottom: 6px;
        }

        .title p {
            color: #777394;
            font-size: 16px;
        }

        .profile-mini {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 8px 16px;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
        }

        .avatar-small {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #6553e8;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* ALERTS */
        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 22px;
            font-size: 15px;
        }

        .alert-success {
            background: #def7ec;
            color: #03543f;
        }

        .alert-error {
            background: #fde8e8;
            color: #9b1c1c;
        }

        /* WHATSAPP-LIKE FILTER PILLS */
        .filter-section {
            background: white;
            border-radius: 18px;
            padding: 18px 24px;
            margin-bottom: 25px;
            box-shadow: 0 4px 18px rgba(70,60,130,.04);
        }

        .filter-header-label {
            font-size: 13px;
            font-weight: bold;
            color: #777394;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-pills-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .pill-item {
            position: relative;
            display: inline-block;
        }

        .pill-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: 24px;
            background: #f3f1fe;
            color: #4b3dc7;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            border: 1.5px solid #dedaf8;
            transition: all .2s ease;
            user-select: none;
        }

        .pill-btn:hover {
            background: #e6e2fc;
            border-color: #c4bbf5;
        }

        .pill-btn.active {
            background: #6553e8;
            color: white;
            border-color: #5544d6;
            box-shadow: 0 4px 12px rgba(101,83,232,.3);
        }

        .pill-btn .caret {
            font-size: 10px;
            transition: transform .2s;
        }

        .pill-btn.active .caret {
            color: white;
        }

        .pill-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            z-index: 100;
            background: white;
            border-radius: 16px;
            padding: 8px;
            min-width: 200px;
            box-shadow: 0 12px 30px rgba(0,0,0,.15);
            border: 1px solid #e7e5f4;
            animation: fadeIn .15s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .pill-dropdown.show {
            display: block;
        }

        .pill-dropdown-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            text-align: left;
            padding: 9px 14px;
            border-radius: 10px;
            background: transparent;
            border: none;
            font-size: 13.5px;
            color: #29274a;
            cursor: pointer;
            text-decoration: none;
            transition: background .15s;
        }

        .pill-dropdown-item:hover {
            background: #f5f4fc;
            color: #5b4ae3;
        }

        .pill-dropdown-item.selected {
            background: #eeeaff;
            color: #5b4ae3;
            font-weight: bold;
        }

        .pill-input-form {
            display: none;
            align-items: center;
            gap: 6px;
            background: white;
            padding: 4px 12px;
            border-radius: 24px;
            border: 2px solid #6553e8;
            box-shadow: 0 4px 12px rgba(101,83,232,.2);
        }

        .pill-input-form.show {
            display: inline-flex;
        }

        .pill-input-form input[type="number"] {
            width: 75px;
            border: none;
            outline: none;
            font-size: 13.5px;
            font-weight: bold;
            color: #29274a;
            padding: 5px 0;
        }

        .pill-input-form input[type="date"] {
            border: none;
            outline: none;
            font-size: 13px;
            color: #29274a;
            background: transparent;
            font-weight: bold;
            padding: 4px 0;
        }

        .pill-input-form button {
            background: #6553e8;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            cursor: pointer;
        }

        .btn-pill-reset {
            background: #fee2e2;
            color: #b91c1c;
            border-color: #fca5a5;
        }

        .btn-pill-reset:hover {
            background: #fecaca;
        }

        /* CARD & TABLE */
        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(70,60,130,.06);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .card-header h2 {
            font-size: 22px;
            color: #202044;
        }

        .card-header p {
            color: #777394;
            font-size: 14px;
            margin-top: 4px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: #f7f6ff;
            color: #5b5875;
            font-size: 13px;
            font-weight: bold;
            text-align: left;
            padding: 15px 14px;
            border-bottom: 2px solid #eeeef5;
            white-space: nowrap;
        }

        tbody td {
            padding: 16px 14px;
            border-bottom: 1px solid #f0eff6;
            font-size: 14px;
            color: #55526b;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #faf9ff;
        }

        .student-name {
            color: #29274a;
            font-weight: bold;
        }

        .quiz-name {
            color: #5b4ae3;
            font-weight: 600;
        }

        .badge-category {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #eeeaff;
            color: #5b4ae3;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .badge-category.ulangan {
            background: #e0f2fe;
            color: #0284c7;
        }

        .badge-category.remedial {
            background: #fef3c7;
            color: #d97706;
        }

        .score {
            color: #29274a;
            font-size: 16px;
        }

        .pass {
            color: #188650;
            font-weight: bold;
        }

        .fail {
            color: #d64545;
            font-weight: bold;
        }

        .btn-view {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
            border-radius: 8px;
            background: #eeeaff;
            color: #5b4ae3;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .btn-view:hover {
            background: #e2ddff;
        }

        .btn-action-remedial {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 8px 12px;
            border-radius: 8px;
            background: #e67e22;
            color: white;
            border: none;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: all .2s;
            white-space: nowrap;
        }

        .btn-action-remedial:hover {
            background: #d35400;
            transform: translateY(-1px);
        }

        .badge-remedial-done {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 12px;
            background: #def7ec;
            color: #03543f;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .empty-card {
            background: white;
            border-radius: 20px;
            padding: 55px 30px;
            text-align: center;
            box-shadow: 0 4px 18px rgba(70,60,130,.06);
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            border-radius: 18px;
            background: #eeeaff;
            color: #6553e8;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 28px;
        }

        @media(max-width:900px) {
            .sidebar { display: none; }
            .content { padding: 25px; }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <div class="logo-icon">IT</div>
            <div>
                <h2>ITIK</h2>
                <span>Portal Guru</span>
            </div>
        </div>

        <div class="menu-title">Menu Utama</div>

        <nav class="menu">
            <a href="{{ route('dashboard') }}">▦ &nbsp; Dashboard</a>
            <a href="{{ url('/guru/materi') }}">▣ &nbsp; Materi</a>
            <a href="{{ route('kuis.index') }}">☑ &nbsp; Kuis &amp; Soal</a>
            <a href="{{ route('guru.nilai.index') }}" class="active">◉ &nbsp; Nilai</a>
            <a href="{{ route('profil') }}">◎ &nbsp; Profil</a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="content">

        <div class="topbar">
            <div class="title">
                <h1>Daftar Nilai Siswa</h1>
                <p>Pantau hasil pengerjaan kuis siswa dan berikan tugas remedial bagi yang belum lulus ulangan</p>
            </div>

            <div class="profile-mini">
                <div class="avatar-small">
                    {{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'G', 0, 2)) }}
                </div>
                <div>
                    <strong>{{ Auth::user()->nama_lengkap }}</strong><br>
                    <small>{{ ucfirst(Auth::user()->role) }}</small>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                ⚠️ {{ session('error') }}
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
                        <label for="input-percobaan" style="font-size:12px; font-weight:bold; color:#6553e8;">Ke-</label>
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
            <div class="empty-card">
                <div class="empty-icon">◉</div>
                <h3>Tidak Ada Hasil Kuis</h3>
                <p>Tidak ditemukan data hasil kuis yang sesuai dengan kriteria filter saat ini.</p>
                @if($kategori || $percobaan || $kelulusan || $tanggal)
                    <div style="margin-top: 15px;">
                        <button onclick="resetAllFilters()" class="btn-view" style="padding: 10px 20px; font-size: 14px;">
                            ✕ Hapus Semua Filter
                        </button>
                    </div>
                @endif
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2>Hasil Pengerjaan Kuis Siswa</h2>
                        <p id="info-count-row">Menampilkan {{ $hasil->count() }} data pengerjaan kuis siswa</p>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table id="table-nilai">
                        <thead>
                            <tr>
                                <th style="width: 40px;">No</th>
                                <th>Siswa</th>
                                <th>Kuis</th>
                                <th>Kategori</th>
                                <th style="width: 90px;">Percobaan</th>
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
                                    
                                    <td class="row-num">{{ $loop->iteration }}</td>

                                    <td>
                                        <span class="student-name">{{ $item->siswa->nama_lengkap ?? '-' }}</span><br>
                                        <small style="color: #777394;">NISN: {{ $item->siswa->nomor_induk ?? '-' }}</small>
                                    </td>

                                    <td>
                                        <span class="quiz-name">{{ $item->kuis->judul ?? '-' }}</span>
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
                                            <a href="{{ route('guru.nilai.show', $item->id_mengerjakan) }}" class="btn-view">
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
            </div>
        @endif

    </main>

    <!-- JAVASCRIPT KLASIFIKASI & FILTER REAL-TIME SEPERTI DI WHATSAPP -->
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

            // Update label chip
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

        // 3. Kelulusan Filter
        // Handled via applyFilter('kelulusan', 'lulus'/'tidak_lulus'/'')

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

            // Update URL without reload
            const url = new URL(window.location);
            url.search = '';
            window.history.pushState({}, '', url);

            runClientFilter();
        }

        // Filter Real-Time pada Baris Tabel (Instant LIKE / WhatsApp experience)
        function runClientFilter() {
            const rows = document.querySelectorAll('.data-row');
            let visibleCount = 0;

            rows.forEach((row, idx) => {
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

            // Tampilkan atau sembunyikan tombol reset filter
            const hasActive = activeFilters.kategori || activeFilters.percobaan || activeFilters.kelulusan || activeFilters.tanggal;
            const resetBtn = document.getElementById('pill-reset-wrapper');
            if (resetBtn) {
                resetBtn.style.display = hasActive ? 'inline-block' : 'none';
            }

            // Update counter info
            const countInfo = document.getElementById('info-count-row');
            if (countInfo) {
                countInfo.textContent = 'Menampilkan ' + visibleCount + ' data pengerjaan kuis siswa';
            }
        }

        // Inisialisasi awal saat load
        document.addEventListener('DOMContentLoaded', function() {
            if (activeFilters.kategori || activeFilters.percobaan || activeFilters.kelulusan || activeFilters.tanggal) {
                runClientFilter();
            }
        });
    </script>

</body>
</html>
