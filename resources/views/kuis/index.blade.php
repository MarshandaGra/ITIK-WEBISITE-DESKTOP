<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kuis - ITIK</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f4fc;
            color: #202044;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 270px;
            background: linear-gradient(180deg, #7160ef, #5948dd);
            color: white;
            padding: 30px 25px;
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

        /* ================= CONTENT ================= */

        .content {
            flex: 1;
            padding: 30px 45px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .title h1 {
            font-size: 34px;
            margin-bottom: 5px;
        }

        .title p {
            color: #777394;
            font-size: 17px;
        }

        .profile-mini {
            display: flex;
            align-items: center;
            gap: 12px;

            background: white;
            padding: 10px 18px;
            border-radius: 40px;

            box-shadow: 0 3px 15px rgba(0,0,0,.04);
        }

        .avatar-small {
            width: 45px;
            height: 45px;

            border-radius: 50%;
            background: #6553e8;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: bold;
        }

        .profile-mini small {
            color: #777394;
        }

        /* ================= HEADER ================= */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h2 {
            font-size: 22px;
        }

        .page-header p {
            color: #777394;
            margin-top: 5px;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            background: #6553e8;
            color: white;

            text-decoration: none;

            padding: 13px 20px;
            border-radius: 13px;

            font-weight: bold;
        }

        .btn-add:hover {
            background: #5543d5;
        }

        /* ================= ALERT ================= */

        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #e9f9ef;
            color: #25834a;
            border: 1px solid #c9efd7;
        }

        .alert-error {
            background: #fff0f0;
            color: #d64545;
            border: 1px solid #ffd0d0;
        }

        /* ================= MAPEL GRID ================= */

        .mapel-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
            margin-top: 5px;
        }

        .mapel-card {
            background: white;
            border-radius: 20px;
            padding: 28px 24px;
            box-shadow: 0 4px 18px rgba(70,60,130,.06);
            border: 1.5px solid #eeeef5;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: box-shadow .15s, border-color .15s, transform .1s;
        }

        .mapel-card:hover {
            border-color: #a99cf0;
            box-shadow: 0 6px 24px rgba(91,74,227,.12);
            transform: translateY(-2px);
        }

        .mapel-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: linear-gradient(135deg, #7160ef, #5948dd);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
        }

        .mapel-kode {
            font-size: 11px;
            font-weight: bold;
            color: #a99cf0;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .mapel-nama {
            font-size: 18px;
            font-weight: bold;
            color: #202044;
            line-height: 1.3;
        }

        .mapel-count {
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #777394;
        }

        .mapel-count-num {
            background: #eeeaff;
            color: #5b4ae3;
            font-weight: bold;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .mapel-arrow {
            margin-left: auto;
            color: #a99cf0;
            font-size: 18px;
        }

        /* ================= SELECTED MAPEL BANNER ================= */

        .mapel-banner {
            background: linear-gradient(135deg, #7160ef, #5948dd);
            color: white;
            border-radius: 18px;
            padding: 22px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 25px;
        }

        .mapel-banner-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .mapel-banner-icon {
            width: 48px;
            height: 48px;
            border-radius: 13px;
            background: rgba(255,255,255,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .mapel-banner h3 {
            font-size: 19px;
        }

        .mapel-banner p {
            font-size: 13px;
            opacity: .8;
            margin-top: 3px;
        }

        .btn-back-mapel {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255,255,255,.2);
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: bold;
            border: 1px solid rgba(255,255,255,.3);
            white-space: nowrap;
        }

        .btn-back-mapel:hover {
            background: rgba(255,255,255,.3);
        }

        /* ================= BAB GROUP ================= */
        .bab-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 18px rgba(70,60,130,.06);
            margin-bottom: 22px;
            border: 1.5px solid #eeeef5;
        }

        .bab-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f0eff8;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .bab-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .bab-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #eeeaff;
            color: #5b4ae3;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .bab-title {
            font-size: 17px;
            font-weight: bold;
            color: #202044;
        }

        .bab-sub {
            font-size: 13px;
            color: #777394;
            margin-top: 2px;
        }

        .bab-levels {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .level-pill {
            font-size: 11px;
            font-weight: bold;
            padding: 4px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .level-pill.active-mudah { background: #e9f9ef; color: #25834a; }
        .level-pill.active-sedang { background: #fff3dc; color: #c98200; }
        .level-pill.active-sulit { background: #ffe5e5; color: #d64545; }
        .level-pill.inactive { background: #f3f2f8; color: #b0adc4; }

        .view-toggle {
            display: inline-flex;
            background: #eeeaf8;
            padding: 4px;
            border-radius: 12px;
            gap: 4px;
            margin-bottom: 22px;
        }

        .view-btn {
            padding: 8px 18px;
            border-radius: 9px;
            border: none;
            background: transparent;
            font-size: 13px;
            font-weight: bold;
            color: #777394;
            cursor: pointer;
            text-decoration: none;
            transition: all .15s;
        }

        .view-btn.active {
            background: white;
            color: #5b4ae3;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }

        .empty-bab-hint {
            padding: 18px 20px;
            background: #faf9ff;
            border-radius: 12px;
            color: #777394;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* ================= TABLE CARD ================= */

        .table-card {
            background: white;
            border-radius: 23px;
            padding: 25px;

            box-shadow: 0 4px 18px rgba(70,60,130,.06);

            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        thead {
            background: #f7f6fc;
        }

        th {
            text-align: left;
            padding: 15px 14px;

            color: #777394;
            font-size: 13px;
            font-weight: bold;

            border-bottom: 1px solid #eeeef5;
        }

        td {
            padding: 17px 14px;

            font-size: 14px;
            color: #44435f;

            border-bottom: 1px solid #eeeef5;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #faf9ff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .id-kuis {
            color: #aaa7bc;
            font-size: 12px;
            font-weight: bold;
        }

        .judul-kuis {
            color: #202044;
            font-weight: bold;
        }

        .kesulitan {
            display: inline-block;
            padding: 4px 9px;
            border-radius: 14px;
            font-size: 11px;
            font-weight: bold;
        }

        .kesulitan-mudah { background: #e9f9ef; color: #25834a; }
        .kesulitan-sedang { background: #fff3dc; color: #c98200; }
        .kesulitan-sulit { background: #ffe5e5; color: #d64545; }

        .kategori {
            display: inline-block;

            background: #eeeaff;
            color: #5b4ae3;

            padding: 7px 11px;
            border-radius: 20px;

            font-size: 12px;
            font-weight: bold;
        }

        .kkm {
            font-weight: bold;
            color: #202044;
        }

        .waktu {
            color: #777394;
        }

        /* ================= STATUS ================= */

        .status {
            display: inline-block;

            padding: 7px 11px;
            border-radius: 20px;

            font-size: 12px;
            font-weight: bold;
        }

        .status-published,
        .status-publikasi,
        .status-publish,
        .status-aktif {
            background: #e9f9ef;
            color: #25834a;
        }

        .status-draft {
            background: #fff3dc;
            color: #c98200;
        }

        /* ================= ACTION ================= */

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            text-decoration: none;

            padding: 8px 12px;
            border-radius: 10px;

            font-size: 12px;
            font-weight: bold;

            border: none;
            cursor: pointer;
        }

        .btn-view {
            background: #eeeaff;
            color: #5b4ae3;
        }

        .btn-edit {
            background: #fff3dc;
            color: #c98200;
        }

        .btn-archive {
            background: #ffe5e5;
            color: #d64545;
        }

        .btn-view:hover {
            background: #e2ddff;
        }

        .btn-edit:hover {
            background: #ffe8bf;
        }

        .btn-archive:hover {
            background: #ffd5d5;
        }

        /* ================= EMPTY ================= */

        .empty {
            background: white;
            border-radius: 23px;
            padding: 60px 30px;

            text-align: center;
            color: #777394;

            box-shadow: 0 4px 18px rgba(70,60,130,.06);
        }

        .empty-icon {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .empty h3 {
            color: #202044;
            margin-bottom: 7px;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 850px) {

            .sidebar {
                display: none;
            }

            .content {
                padding: 20px;
            }

            .page-header {
                gap: 15px;
            }

            .table-card {
                padding: 15px;
            }
        }

        @media(max-width: 600px) {

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-add {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>


<body>

<div class="layout">

    <!-- ================= SIDEBAR ================= -->

    <aside class="sidebar">

        <div class="logo">

            <div class="logo-icon">
                IT
            </div>

            <div>
                <h2>ITIK</h2>
                <span>Portal Guru</span>
            </div>

        </div>


        <div class="menu-title">
            Menu Utama
        </div>


        <nav class="menu">

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                ▦ &nbsp; Dashboard
            </a>

            <a href="{{ route('materi.index') }}"
               class="{{ request()->routeIs('materi.*') ? 'active' : '' }}">
                ▣ &nbsp; Materi
            </a>

            <a href="{{ route('kuis.index') }}"
               class="{{ request()->routeIs('kuis.*') ? 'active' : '' }}">
                ☑ &nbsp; Kuis & Soal
            </a>

            <a href="{{ route('guru.nilai.index') }}"
               class="{{ request()->routeIs('guru.nilai.*') ? 'active' : '' }}">
                ◉ &nbsp; Nilai
            </a>

            <a href="{{ route('profil') }}"
               class="{{ request()->routeIs('profil') ? 'active' : '' }}">
                ◎ &nbsp; Profil
            </a>

        </nav>

    </aside>


    <!-- ================= CONTENT ================= -->

    <main class="content">


        <!-- TOPBAR -->

        <div class="topbar">

            <div class="title">

                <h1>Kuis &amp; Soal</h1>

                <p>
                    {{ $mapelTerpilih ? 'Kelola kuis — ' . $mapelTerpilih->nama_mapel : 'Pilih mata pelajaran untuk mengelola kuis' }}
                </p>

            </div>


            <div class="profile-mini">

                <div class="avatar-small">

                    {{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 2)) }}

                </div>

                <div>

                    <strong>
                        {{ Auth::user()->nama_lengkap }}
                    </strong>

                    <br>

                    <small>
                        {{ ucfirst(Auth::user()->role) }}
                    </small>

                </div>

            </div>

        </div>


        <!-- ================= ALERT ================= -->

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @elseif ($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif


        @if (!$mapelTerpilih)

            {{-- ===== TAMPILKAN PILIHAN MATA PELAJARAN ===== --}}

            <div class="page-header">
                <div>
                    <h2>Pilih Mata Pelajaran</h2>
                    <p>Klik mata pelajaran untuk mengelola kuis di dalamnya</p>
                </div>
            </div>

            @if ($mapelAktif->isEmpty())

                <div class="empty">
                    <div class="empty-icon">📚</div>
                    <h3>Belum ada mata pelajaran aktif</h3>
                    <p>Minta admin untuk menambahkan mata pelajaran terlebih dahulu.</p>
                </div>

            @else

                <div class="mapel-grid">

                    @foreach ($mapelAktif as $mapel)

                        <a href="{{ route('kuis.index', ['mapel' => $mapel->id_mapel]) }}" class="mapel-card">

                            <div class="mapel-icon">📖</div>

                            <div>
                                <div class="mapel-kode">{{ $mapel->id_mapel }}</div>
                                <div class="mapel-nama">{{ $mapel->nama_mapel }}</div>
                            </div>

                            <div class="mapel-count">
                                <span class="mapel-count-num">{{ $mapel->kuis_count }}</span>
                                kuis aktif
                                <span class="mapel-arrow">→</span>
                            </div>

                        </a>

                    @endforeach

                </div>

            @endif

        @else

            {{-- ===== TAMPILKAN DAFTAR KUIS MAPEL TERPILIH ===== --}}

            {{-- Banner Mapel Terpilih --}}
            <div class="mapel-banner">

                <div class="mapel-banner-info">
                    <div class="mapel-banner-icon">📖</div>
                    <div>
                        <h3>{{ $mapelTerpilih->nama_mapel }}</h3>
                        <p>{{ $kuis->count() }} kuis tersedia — {{ $mapelTerpilih->id_mapel }}</p>
                    </div>
                </div>

                <a href="{{ route('kuis.index') }}" class="btn-back-mapel">
                    ← Ganti Mata Pelajaran
                </a>

            </div>

            {{-- Header dengan tombol Tambah Kuis --}}
            <div class="page-header">
                <div>
                    <h2>Daftar Kuis</h2>
                    <p>Kelola kuis untuk {{ $mapelTerpilih->nama_mapel }}</p>
                </div>

                <a href="{{ route('kuis.create', ['mapel' => $mapelTerpilih->id_mapel]) }}" class="btn-add">
                    + Tambah Kuis
                </a>
            </div>

            {{-- Toggle Tampilan: Per Bab vs Semua --}}
            <div class="view-toggle">
                <button type="button" class="view-btn active" id="btn-view-bab" onclick="switchView('bab')">
                    📁 Kelompokkan Per Bab Materi
                </button>
                <button type="button" class="view-btn" id="btn-view-all" onclick="switchView('all')">
                    📋 Semua Kuis (Tabel Lengkap)
                </button>
            </div>

            @php
                // Petakan kuis per ID materi
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

            {{-- ===== VIEW 1: KELOMPOK PER BAB MATERI ===== --}}
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
                                <div class="bab-title-wrap">
                                    <div class="bab-icon">📖</div>
                                    <div>
                                        <div class="bab-title">
                                            {{ $materiItem->bab ? $materiItem->bab . ' - ' : '' }}{{ $materiItem->judul }}
                                        </div>
                                        <div class="bab-sub">
                                            Materi: {{ $materiItem->id_materi }} • {{ count($listKuisBab) }} kuis terdaftar
                                        </div>
                                    </div>
                                </div>

                                <div class="bab-levels">
                                    <span class="level-pill {{ $hasMudah ? 'active-mudah' : 'inactive' }}" title="{{ $hasMudah ? 'Tersedia kuis tingkat Mudah' : 'Belum ada kuis tingkat Mudah' }}">
                                        {{ $hasMudah ? '✓' : '○' }} Mudah
                                    </span>
                                    <span class="level-pill {{ $hasSedang ? 'active-sedang' : 'inactive' }}" title="{{ $hasSedang ? 'Tersedia kuis tingkat Sedang' : 'Belum ada kuis tingkat Sedang' }}">
                                        {{ $hasSedang ? '✓' : '○' }} Sedang
                                    </span>
                                    <span class="level-pill {{ $hasSulit ? 'active-sulit' : 'inactive' }}" title="{{ $hasSulit ? 'Tersedia kuis tingkat Sulit' : 'Belum ada kuis tingkat Sulit' }}">
                                        {{ $hasSulit ? '✓' : '○' }} Sulit
                                    </span>
                                </div>
                            </div>

                            @if (count($listKuisBab) > 0)

                                <div class="table-card" style="padding: 0; box-shadow: none; border-radius: 12px; border: 1px solid #f0eff8;">

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
                                            @foreach ($listKuisBab as $item)
                                                <tr>
                                                    <td><span class="id-kuis">{{ $item->id_kuis }}</span></td>
                                                    <td><div class="judul-kuis">{{ $item->judul }}</div></td>
                                                    <td><span class="kategori">{{ $item->kategori }}</span></td>
                                                    <td>
                                                        <span class="kesulitan kesulitan-{{ $item->tingkat_kesulitan ?? 'mudah' }}">
                                                            {{ ucfirst($item->tingkat_kesulitan ?? 'mudah') }}
                                                        </span>
                                                    </td>
                                                    <td><span class="kkm">{{ $item->soal->count() }}</span></td>
                                                    <td><span class="kkm">{{ $item->kkm ?? '-' }}</span></td>
                                                    <td><span class="waktu">{{ $item->alokasi_waktu ?? '-' }} menit</span></td>
                                                    <td>
                                                        <span class="status status-{{ strtolower(str_replace(' ', '-', $item->status_publikasi)) }}">
                                                            {{ $item->status_publikasi }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="actions">
                                                            <a href="{{ route('kuis.show', $item->id_kuis) }}" class="btn btn-view">Lihat</a>
                                                            @if ($item->status_publikasi === 'terbit')
                                                                <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-edit" onclick="alert('Kuis tersebut tidak dapat diedit karena berstatus terbit. Ubah ke status draft terlebih dahulu.'); return false;">Edit</a>
                                                            @else
                                                                <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-edit">Edit</a>
                                                            @endif
                                                            <form action="{{ route('kuis.destroy', $item->id_kuis) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-archive" onclick="return confirm('Arsipkan kuis ini?')">Arsipkan</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>

                            @else

                                <div class="empty-bab-hint">
                                    <span>Belum ada kuis untuk bab materi ini. Lengkapi kuis dengan 3 tingkat kesulitan (Mudah, Sedang, Sulit).</span>
                                    <a href="{{ route('kuis.create', ['mapel' => $mapelTerpilih->id_mapel]) }}" class="btn btn-view" style="padding: 6px 14px;">
                                        + Buat Kuis Bab Ini
                                    </a>
                                </div>

                            @endif

                        </div>
                    @endforeach

                @else

                    <div class="empty">
                        <div class="empty-icon">📚</div>
                        <h3>Belum ada materi pembelajaran</h3>
                        <p>Silakan buat materi pembelajaran terlebih dahulu untuk mata pelajaran ini agar kuis dapat terstruktur per bab.</p>
                        <a href="{{ route('materi.create') }}" class="btn-add" style="margin-top: 15px;">
                            + Buat Materi Baru
                        </a>
                    </div>

                @endif

                {{-- Bagian Kuis Umum / Tanpa Bab Tertentu --}}
                @if (count($kuisUmum) > 0)
                    <div class="bab-card">

                        <div class="bab-header">
                            <div class="bab-title-wrap">
                                <div class="bab-icon" style="background:#fff3dc; color:#c98200;">📝</div>
                                <div>
                                    <div class="bab-title">Ulangan &amp; Kuis Umum</div>
                                    <div class="bab-sub">{{ count($kuisUmum) }} kuis umum tanpa materi spesifik</div>
                                </div>
                            </div>
                        </div>

                        <div class="table-card" style="padding: 0; box-shadow: none; border-radius: 12px; border: 1px solid #f0eff8;">
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
                                            <td><span class="id-kuis">{{ $item->id_kuis }}</span></td>
                                            <td><div class="judul-kuis">{{ $item->judul }}</div></td>
                                            <td><span class="kategori">{{ $item->kategori }}</span></td>
                                            <td>
                                                <span class="kesulitan kesulitan-{{ $item->tingkat_kesulitan ?? 'mudah' }}">
                                                    {{ ucfirst($item->tingkat_kesulitan ?? 'mudah') }}
                                                </span>
                                            </td>
                                            <td><span class="kkm">{{ $item->soal->count() }}</span></td>
                                            <td><span class="kkm">{{ $item->kkm ?? '-' }}</span></td>
                                            <td><span class="waktu">{{ $item->alokasi_waktu ?? '-' }} menit</span></td>
                                            <td>
                                                <span class="status status-{{ strtolower(str_replace(' ', '-', $item->status_publikasi)) }}">
                                                    {{ $item->status_publikasi }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="actions">
                                                    <a href="{{ route('kuis.show', $item->id_kuis) }}" class="btn btn-view">Lihat</a>
                                                    @if ($item->status_publikasi === 'terbit')
                                                        <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-edit" onclick="alert('Kuis tersebut tidak dapat diedit karena berstatus terbit. Ubah ke status draft terlebih dahulu.'); return false;">Edit</a>
                                                    @else
                                                        <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-edit">Edit</a>
                                                    @endif
                                                    <form action="{{ route('kuis.destroy', $item->id_kuis) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-archive" onclick="return confirm('Arsipkan kuis ini?')">Arsipkan</button>
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

            {{-- ===== VIEW 2: SEMUA KUIS (TABEL LENGKAP) ===== --}}
            <div id="view-all" style="display: none;">

                @if ($kuis->count() > 0)

                    <div class="table-card">

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

                                        <td>
                                            <span class="id-kuis">{{ $item->id_kuis }}</span>
                                        </td>

                                        <td>
                                            <div class="judul-kuis">{{ $item->judul }}</div>
                                        </td>

                                        <td>
                                            <span class="kategori">{{ $item->kategori }}</span>
                                        </td>

                                        <td>
                                            <span class="kesulitan kesulitan-{{ $item->tingkat_kesulitan ?? 'mudah' }}">
                                                {{ ucfirst($item->tingkat_kesulitan ?? 'mudah') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="kkm">{{ $item->soal->count() }}</span>
                                        </td>

                                        <td>
                                            <span class="kkm">{{ $item->kkm ?? '-' }}</span>
                                        </td>

                                        <td>
                                            <span class="waktu">{{ $item->alokasi_waktu ?? '-' }} menit</span>
                                        </td>

                                        <td>
                                            <span class="status status-{{ strtolower(str_replace(' ', '-', $item->status_publikasi)) }}">
                                                {{ $item->status_publikasi }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="actions">

                                                <a href="{{ route('kuis.show', $item->id_kuis) }}" class="btn btn-view">
                                                    Lihat
                                                </a>

                                                @if ($item->status_publikasi === 'terbit')
                                                    <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-edit" onclick="alert('Kuis tersebut tidak dapat diedit karena berstatus terbit. Ubah ke status draft terlebih dahulu.'); return false;">
                                                        Edit
                                                    </a>
                                                @else
                                                    <a href="{{ route('kuis.edit', $item->id_kuis) }}" class="btn btn-edit">
                                                        Edit
                                                    </a>
                                                @endif

                                                <form
                                                    action="{{ route('kuis.destroy', $item->id_kuis) }}"
                                                    method="POST"
                                                    style="display:inline;"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="btn btn-archive"
                                                        onclick="return confirm('Arsipkan kuis ini?')"
                                                    >
                                                        Arsipkan
                                                    </button>
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
                        <div class="empty-icon">📝</div>
                        <h3>Belum ada kuis di mata pelajaran ini</h3>
                        <p>Klik tombol "Tambah Kuis" untuk membuat kuis pertama.</p>
                    </div>

                @endif

            </div>

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

        @endif


    </main>

</div>

</body>

</html>