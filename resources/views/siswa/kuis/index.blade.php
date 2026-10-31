<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Kuis - ITIK</title>

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

        /* SIDEBAR */

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

        .menu a.active:hover {
            background: white;
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
            gap: 20px;
            margin-bottom: 40px;
        }

        .title h1 {
            font-size: 34px;
            margin-bottom: 5px;
        }

        .title p {
            color: #777394;
            font-size: 17px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 10px 18px;
            border-radius: 40px;
            box-shadow: 0 3px 15px rgba(0,0,0,.04);
            flex-shrink: 0;
        }

        .avatar {
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

        .profile small {
            color: #777394;
        }

        /* ALERT */

        .alert {
            padding: 15px 22px;
            border-radius: 16px;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .alert.success {
            background: #e7f8ec;
            color: #20a653;
        }

        .alert.error {
            background: #fde8e8;
            color: #d93636;
        }

        /* CARD */

        .section-card {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 4px 18px rgba(70,60,130,.06);
            margin-bottom: 25px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .section-header h2 {
            font-size: 22px;
        }

        .section-header p {
            color: #777394;
            margin-top: 5px;
        }

        .see-all {
            text-decoration: none;
            color: #5d4be4;
            border: 1px solid #ddd9f8;
            padding: 10px 15px;
            border-radius: 12px;
            white-space: nowrap;
            background: white;
        }

        .see-all:hover {
            background: #f5f3ff;
        }

        /* KUIS GRID */

        .mapel-grid-siswa {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 18px;
        }

        .mapel-card {
            background: white;
            border-radius: 20px;
            padding: 26px 22px;
            border: 1.5px solid #eeeef5;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 11px;
            transition: box-shadow .15s, border-color .15s, transform .1s;
            box-shadow: 0 2px 10px rgba(70,60,130,.05);
        }

        .mapel-card:hover {
            border-color: #a99cf0;
            box-shadow: 0 6px 24px rgba(91,74,227,.12);
            transform: translateY(-2px);
        }

        .mapel-icon-s {
            width: 50px;
            height: 50px;
            border-radius: 13px;
            background: linear-gradient(135deg, #7160ef, #5948dd);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 21px;
        }

        .mapel-kode {
            font-size: 10px;
            font-weight: bold;
            color: #a99cf0;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .mapel-nama {
            font-size: 17px;
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

        .mapel-banner {
            background: linear-gradient(135deg, #7160ef, #5948dd);
            color: white;
            border-radius: 18px;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
        }

        .mapel-banner-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .mapel-banner-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: rgba(255,255,255,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .mapel-banner h3 {
            font-size: 18px;
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
            padding: 9px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: bold;
            border: 1px solid rgba(255,255,255,.3);
            white-space: nowrap;
        }

        .btn-back-mapel:hover {
            background: rgba(255,255,255,.3);
        }

        /* ================= BAB GRID SISWA ================= */
        .bab-grid-siswa {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 15px;
            margin-bottom: 25px;
        }

        .bab-card-siswa {
            background: white;
            border-radius: 20px;
            padding: 24px;
            border: 1.5px solid #eeeef5;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: all .2s;
            box-shadow: 0 4px 14px rgba(70,60,130,.05);
        }

        .bab-card-siswa:hover {
            border-color: #7160ef;
            box-shadow: 0 8px 24px rgba(113,96,239,.15);
            transform: translateY(-2px);
        }

        .bab-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .bab-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #7160ef, #5948dd);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .bab-card-tag {
            font-size: 11px;
            font-weight: bold;
            color: #7160ef;
            background: #eeeaff;
            padding: 3px 9px;
            border-radius: 12px;
            display: inline-block;
        }

        .bab-card-title {
            font-size: 18px;
            font-weight: bold;
            color: #202044;
            line-height: 1.35;
        }

        .bab-card-desc {
            font-size: 13px;
            color: #777394;
            line-height: 1.4;
        }

        .bab-card-footer {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid #f0eff8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            font-weight: bold;
            color: #5d4be4;
        }

        .breadcrumb-siswa {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #777394;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .breadcrumb-siswa a {
            color: #5d4be4;
            text-decoration: none;
            font-weight: bold;
        }

        .breadcrumb-siswa a:hover {
            text-decoration: underline;
        }

        /* KUIS GRID */

        .kuis-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .kuis-item {
            border: 1px solid #eeeef5;
            border-radius: 20px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            background: white;
            position: relative;
        }

        .kuis-item.terkunci {
            opacity: .75;
            background: #faf9ff;
        }

        .kuis-item h3 {
            font-size: 18px;
            line-height: 1.35;
            margin-bottom: 10px;
        }

        .badges-row {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 14px;
        }

        .badge {
            display: inline-block;
            align-self: flex-start;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            white-space: nowrap;
            background: #eeeaff;
            color: #5d4be4;
        }

        .badge-mudah { background: #e9f9ef; color: #25834a; }
        .badge-sedang { background: #fff3dc; color: #c98200; }
        .badge-sulit { background: #ffe5e5; color: #d64545; }
        .badge-kunci { background: #f5f5f5; color: #888; }
        .badge-lulus { background: #e9f9ef; color: #25834a; }
        .badge-belum { background: #fff3dc; color: #c98200; }

        .kuis-meta {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            padding: 14px 0;
            border-top: 1px solid #eeeef5;
            border-bottom: 1px solid #eeeef5;
            margin-bottom: 18px;
            margin-top: auto;
        }

        .meta-number {
            font-size: 21px;
            font-weight: bold;
        }

        .meta-label {
            color: #777394;
            font-size: 12px;
            margin-top: 2px;
        }

        .btn {
            display: block;
            width: 100%;
            text-decoration: none;
            text-align: center;
            border: none;
            cursor: pointer;
            background: #6553e8;
            color: white;
            padding: 12px 20px;
            border-radius: 13px;
            font-size: 15px;
        }

        .btn:hover {
            background: #5948dd;
        }

        .btn:disabled,
        .btn.disabled {
            background: #c5c0e3;
            cursor: not-allowed;
        }

        .btn-ulang {
            background: #fff3dc;
            color: #c98200;
            border: 1.5px solid #f0d888;
        }

        .btn-ulang:hover {
            background: #ffe8a0;
        }

        .kunci-info {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f5f4fc;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12px;
            color: #777394;
            margin-top: 2px;
        }

        /* TABLE */

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            color: #777394;
            font-size: 14px;
            font-weight: normal;
            padding: 12px 14px;
            border-bottom: 1px solid #eeeef5;
            white-space: nowrap;
        }

        tbody td {
            padding: 17px 14px;
            border-bottom: 1px solid #eeeef5;
            font-size: 16px;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #faf9ff;
        }

        .col-no {
            width: 60px;
            color: #777394;
        }

        .row-title {
            font-weight: bold;
            font-size: 17px;
        }

        .btn-inline {
            display: inline-block;
            text-decoration: none;
            background: #6553e8;
            color: white;
            padding: 10px 18px;
            border-radius: 12px;
            font-size: 14px;
            white-space: nowrap;
        }

        .btn-inline:hover {
            background: #5948dd;
        }

        .badge.inline {
            margin-bottom: 0;
        }

        /* EMPTY STATE */

        .empty {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            background: #eeeaff;
            color: #604de7;
            font-size: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
        }

        .empty h3 {
            font-size: 20px;
            margin-bottom: 6px;
        }

        .empty p {
            color: #777394;
        }

        a:focus-visible,
        button:focus-visible {
            outline: 3px solid #b9aefc;
            outline-offset: 2px;
        }

        @media(max-width: 1300px) {
            .kuis-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 1100px) {
            .topbar {
                flex-wrap: wrap;
            }
        }

        @media(max-width: 700px) {
            .sidebar {
                display: none;
            }

            .content {
                padding: 20px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .topbar-right {
                flex-direction: column;
                align-items: flex-start;
            }

            .kuis-grid {
                grid-template-columns: 1fr;
            }

            .section-card {
                padding: 22px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="logo">
            <div class="logo-icon">IT</div>

            <div>
                <h2>ITIK</h2>
                <span>Portal Siswa</span>
            </div>
        </div>

        <div class="menu-title">
            Menu Utama
        </div>

        <nav class="menu">

            <a href="{{ route('siswa.dashboard') }}">
                ▦ &nbsp; Dashboard
            </a>

            <a href="{{ url('/siswa/materi') }}">
                ▣ &nbsp; Materi
            </a>

            <a href="{{ url('/siswa/kuis') }}" class="active">
                ☑ &nbsp; Kuis
            </a>

            <a href="{{ url('/siswa/nilai') }}">
                ◉ &nbsp; Nilai Saya
            </a>

            <a href="{{ url('/siswa/remedial') }}">
                ↻ &nbsp; Remedial
            </a>

            <a href="{{ route('profil') }}">
                ◎ &nbsp; Profil
            </a>

        </nav>

    </aside>


    <!-- CONTENT -->

    <main class="content">

        <div class="topbar">

            <div class="title">
                <h1>Daftar Kuis</h1>
                <p>Kerjakan kuis yang tersedia</p>
            </div>

            <div class="topbar-right">

                <a href="{{ route('siswa.nilai') }}" class="see-all">
                    Lihat nilai saya
                </a>

                <div class="profile">

                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 2)) }}
                    </div>

                    <div>
                        <strong>{{ Auth::user()->nama_lengkap }}</strong>
                        <br>
                        <small>{{ ucfirst(Auth::user()->role) }}</small>
                    </div>

                </div>

            </div>

        </div>


        <!-- NOTIFIKASI -->

        @if (session('error'))
            <div class="alert error">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif


        <!-- KUIS TERSEDIA -->

        @if (!$mapelTerpilih)

            {{-- ===== PILIH MATA PELAJARAN ===== --}}

            <div class="section-card">

                <div class="section-header">
                    <div>
                        <h2>Pilih Mata Pelajaran</h2>
                        <p>Pilih mata pelajaran untuk melihat kuis yang tersedia</p>
                    </div>
                </div>

                @if ($mapelAktif->isEmpty())

                    <div class="empty">
                        <div class="empty-icon">📚</div>
                        <h3>Belum ada mata pelajaran</h3>
                        <p>Belum ada kuis yang tersedia saat ini.</p>
                    </div>

                @else

                    <div class="mapel-grid-siswa">

                        @foreach ($mapelAktif as $mapel)

                            <a href="{{ url('/siswa/kuis?mapel=' . $mapel->id_mapel) }}" class="mapel-card">

                                <div class="mapel-icon-s">📖</div>

                                <div>
                                    <div class="mapel-kode">{{ $mapel->id_mapel }}</div>
                                    <div class="mapel-nama">{{ $mapel->nama_mapel }}</div>
                                </div>

                                <div class="mapel-count">
                                    <span class="mapel-count-num">{{ $mapel->kuis_count }}</span>
                                    kuis tersedia
                                </div>

                            </a>

                        @endforeach

                    </div>

                @endif

            </div>

        @else

            {{-- ===== DAFTAR KUIS MAPEL TERPILIH ===== --}}

            {{-- Breadcrumb Navigasi --}}
            <div class="breadcrumb-siswa">
                <a href="{{ url('/siswa/kuis') }}">📚 Semua Mata Pelajaran</a>
                <span>›</span>
                @if ($materiTerpilih)
                    <a href="{{ url('/siswa/kuis?mapel=' . $mapelTerpilih->id_mapel) }}">{{ $mapelTerpilih->nama_mapel }}</a>
                    <span>›</span>
                    <span style="color: #202044; font-weight: bold;">
                        {{ $materiTerpilih->bab ? $materiTerpilih->bab . ' - ' : '' }}{{ $materiTerpilih->judul }}
                    </span>
                @else
                    <span style="color: #202044; font-weight: bold;">{{ $mapelTerpilih->nama_mapel }}</span>
                @endif
            </div>

            {{-- Banner Mapel --}}
            <div class="mapel-banner">
                <div class="mapel-banner-info">
                    <div class="mapel-banner-icon">📖</div>
                    <div>
                        <h3>{{ $mapelTerpilih->nama_mapel }}</h3>
                        <p>
                            @if ($materiTerpilih)
                                Bab: {{ $materiTerpilih->bab ? $materiTerpilih->bab . ' - ' : '' }}{{ $materiTerpilih->judul }}
                            @else
                                {{ $daftarMateri->count() }} Bab Materi • {{ $kuis->count() }} Kuis tersedia
                            @endif
                        </p>
                    </div>
                </div>

                @if ($materiTerpilih)
                    <a href="{{ url('/siswa/kuis?mapel=' . $mapelTerpilih->id_mapel) }}" class="btn-back-mapel">
                        ← Kembali ke Daftar Bab
                    </a>
                @else
                    <a href="{{ url('/siswa/kuis') }}" class="btn-back-mapel">
                        ← Ganti Mata Pelajaran
                    </a>
                @endif
            </div>

            @if (!$materiTerpilih)

                {{-- ===== TAMPILAN 1: DAFTAR BAB MATERI ===== --}}

                <div class="section-card">

                    <div class="section-header">
                        <div>
                            <h2>Pilih Bab Materi</h2>
                            <p>Pilih materi yang ingin kamu pelajari dan kerjakan kuisnya (Mudah → Sedang → Sulit)</p>
                        </div>
                    </div>

                    @if ($daftarMateri->isEmpty())

                        <div class="empty">
                            <div class="empty-icon">📖</div>
                            <h3>Belum ada bab materi</h3>
                            <p>Materi pembelajaran untuk mata pelajaran ini belum tersedia.</p>
                        </div>

                    @else

                        <div class="bab-grid-siswa">

                            @foreach ($daftarMateri as $materiItem)
                                @php
                                    // Ambil kuis terbit yang berelasi dengan materi ini
                                    $kuisDiBab = $materiItem->kuis->where('status_publikasi', 'terbit')->where('is_aktif', true);
                                    $hasMudah = $kuisDiBab->contains(fn ($k) => $k->tingkat_kesulitan === 'mudah');
                                    $hasSedang = $kuisDiBab->contains(fn ($k) => $k->tingkat_kesulitan === 'sedang');
                                    $hasSulit = $kuisDiBab->contains(fn ($k) => $k->tingkat_kesulitan === 'sulit');
                                @endphp

                                <a href="{{ url('/siswa/kuis?mapel=' . $mapelTerpilih->id_mapel . '&materi=' . $materiItem->id_materi) }}" class="bab-card-siswa">

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

                                    <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 6px;">
                                        <span class="badge {{ $hasMudah ? 'badge-mudah' : 'badge-kunci' }}">
                                            {{ $hasMudah ? '✓' : '○' }} Mudah
                                        </span>
                                        <span class="badge {{ $hasSedang ? 'badge-sedang' : 'badge-kunci' }}">
                                            {{ $hasSedang ? '✓' : '○' }} Sedang
                                        </span>
                                        <span class="badge {{ $hasSulit ? 'badge-sulit' : 'badge-kunci' }}">
                                            {{ $hasSulit ? '✓' : '○' }} Sulit
                                        </span>
                                    </div>

                                    <div class="bab-card-footer">
                                        <span>{{ $kuisDiBab->count() }} Kuis Tersedia</span>
                                        <span>Buka Bab Ini →</span>
                                    </div>

                                </a>

                            @endforeach

                        </div>

                    @endif

                </div>

                {{-- Bagian Kuis Umum / Ulangan jika ada --}}
                @php
                    $kuisTanpaBab = $kuis->filter(fn ($k) => $k->materi->isEmpty() || strtolower(trim($k->kategori)) === 'ulangan');
                @endphp

                @if ($kuisTanpaBab->isNotEmpty())

                    <div class="section-card">

                        <div class="section-header">
                            <div>
                                <h2>📝 Ulangan &amp; Kuis Umum</h2>
                                <p>Kuis evaluasi umum untuk mata pelajaran {{ $mapelTerpilih->nama_mapel }}</p>
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
                                @endphp

                                <div class="kuis-item {{ $terkunci ? 'terkunci' : '' }}">

                                    <h3>{{ $item->judul }}</h3>

                                    <div class="badges-row">
                                        <span class="badge">{{ $item->kategori }}</span>
                                        <span class="badge badge-{{ $item->tingkat_kesulitan ?? 'mudah' }}">
                                            {{ ucfirst($item->tingkat_kesulitan ?? 'mudah') }}
                                        </span>
                                        @if ($terkunci)
                                            <span class="badge badge-kunci">🔒 Terkunci</span>
                                        @elseif ($lulus)
                                            <span class="badge badge-lulus">✓ Lulus</span>
                                        @elseif ($sudahPernah)
                                            <span class="badge badge-belum">Belum Lulus</span>
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
                                        <p style="font-size:13px; color:#777394; margin-bottom:10px;">
                                            Nilai terbaik kamu: <strong style="color:{{ $lulus ? '#25834a' : '#c98200' }};">{{ number_format($nilaiTertinggi, 1) }}</strong>
                                        </p>
                                    @endif

                                    @php
                                        $katItem = strtolower(trim($item->kategori ?? ''));
                                        $bisaUlang = in_array($katItem, ['kuis harian', 'pre-test', 'pass-test']);
                                    @endphp

                                    @if ($terkunci)
                                        <button class="btn disabled" disabled>🔒 Kuis Terkunci</button>
                                        <div class="kunci-info">ℹ️ {{ $alasanKunci }}</div>
                                    @elseif ($bisaUlang && $sudahPernah && !$lulus)
                                        <form action="{{ route('siswa.kuis.mulai', $item->id_kuis) }}" method="GET">
                                            <button type="submit" class="btn btn-ulang">↻ Kerjakan Ulang</button>
                                        </form>
                                    @elseif ($katItem === 'ulangan' && $sudahPernah && !$lulus)
                                        <div style="font-size: 13px; color: #d93636; margin-bottom: 8px; font-weight: bold;">
                                            ⚠️ Nilai di bawah KKM
                                        </div>
                                        <a href="{{ route('siswa.remedial.index') }}" class="btn" style="background: #e67e22; text-align: center; display: block;">
                                            Cek Tugas Remedial
                                        </a>
                                    @else
                                        <form action="{{ route('siswa.kuis.mulai', $item->id_kuis) }}" method="GET">
                                            <button type="submit" class="btn">
                                                {{ $sudahPernah ? '→ Kerjakan Lagi' : 'Mulai' }}
                                            </button>
                                        </form>
                                    @endif

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif

            @else

                {{-- ===== TAMPILAN 2: KUIS DI BAB MATERI TERPILIH ===== --}}

                @php
                    // Filter kuis yang berelasi dengan materi terpilih
                    $kuisBabTerpilih = $kuis->filter(function ($k) use ($materiTerpilih) {
                        return $k->materi->contains('id_materi', $materiTerpilih->id_materi);
                    })->sortBy(function ($k) {
                        // Urutkan: mudah -> sedang -> sulit
                        return match($k->tingkat_kesulitan) {
                            'mudah' => 1,
                            'sedang' => 2,
                            'sulit' => 3,
                            default => 4
                        };
                    });
                @endphp

                <div class="section-card">

                    <div class="section-header">
                        <div>
                            <h2>Kuis {{ $materiTerpilih->bab ? $materiTerpilih->bab . ': ' : '' }}{{ $materiTerpilih->judul }}</h2>
                            <p>Selesaikan kuis secara berurutan: <strong>Mudah</strong> → <strong>Sedang</strong> → <strong>Sulit</strong></p>
                        </div>

                        <a href="{{ url('/siswa/kuis?mapel=' . $mapelTerpilih->id_mapel) }}" class="see-all">
                            ← Pilih Bab Lain
                        </a>
                    </div>

                    @if ($kuisBabTerpilih->isEmpty())

                        <div class="empty">
                            <div class="empty-icon">📝</div>
                            <h3>Belum ada kuis untuk bab ini</h3>
                            <p>Kuis untuk bab materi ini belum dipublikasikan oleh guru.</p>
                            <a href="{{ url('/siswa/kuis?mapel=' . $mapelTerpilih->id_mapel) }}" class="btn-inline" style="margin-top: 15px;">
                                ← Kembali ke Daftar Bab
                            </a>
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
                                @endphp

                                <div class="kuis-item {{ $terkunci ? 'terkunci' : '' }}">

                                    <h3>{{ $item->judul }}</h3>

                                    <div class="badges-row">

                                        <span class="badge">{{ $item->kategori }}</span>

                                        <span class="badge badge-{{ $item->tingkat_kesulitan ?? 'mudah' }}">
                                            Tingkat {{ ucfirst($item->tingkat_kesulitan ?? 'mudah') }}
                                        </span>

                                        @if ($terkunci)
                                            <span class="badge badge-kunci">🔒 Terkunci</span>
                                        @elseif ($lulus)
                                            <span class="badge badge-lulus">✓ Lulus</span>
                                        @elseif ($sudahPernah)
                                            <span class="badge badge-belum">Belum Lulus</span>
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
                                        <p style="font-size:13px; color:#777394; margin-bottom:10px;">
                                            Nilai terbaik kamu: <strong style="color:{{ $lulus ? '#25834a' : '#c98200' }};">{{ number_format($nilaiTertinggi, 1) }}</strong>
                                        </p>
                                    @endif

                                    @php
                                        $katBabItem = strtolower(trim($item->kategori ?? ''));
                                        $bisaBabUlang = in_array($katBabItem, ['kuis harian', 'pre-test', 'pass-test']);
                                    @endphp

                                    @if ($terkunci)

                                        <button class="btn disabled" disabled>🔒 Kuis Terkunci</button>
                                        <div class="kunci-info">
                                            ℹ️ {{ $alasanKunci }}
                                        </div>

                                    @elseif ($bisaBabUlang && $sudahPernah && !$lulus)

                                        <form action="{{ route('siswa.kuis.mulai', $item->id_kuis) }}" method="GET">
                                            <button type="submit" class="btn btn-ulang">↻ Kerjakan Ulang</button>
                                        </form>

                                    @elseif ($katBabItem === 'ulangan' && $sudahPernah && !$lulus)

                                        <div style="font-size: 13px; color: #d93636; margin-bottom: 8px; font-weight: bold;">
                                            ⚠️ Nilai di bawah KKM
                                        </div>
                                        <a href="{{ route('siswa.remedial.index') }}" class="btn" style="background: #e67e22; text-align: center; display: block;">
                                            Cek Tugas Remedial
                                        </a>

                                    @else

                                        <form action="{{ route('siswa.kuis.mulai', $item->id_kuis) }}" method="GET">
                                            <button type="submit" class="btn">
                                                {{ $sudahPernah ? '→ Kerjakan Lagi' : 'Mulai' }}
                                            </button>
                                        </form>

                                    @endif

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

            @endif

            {{-- Kuis Remedial --}}
            @if ($remedial->isNotEmpty())

                <div class="section-card">

                    <div class="section-header">
                        <div>
                            <h2>Kuis Remedial</h2>
                            <p>Tugas perbaikan nilai untukmu</p>
                        </div>
                    </div>

                    <div class="table-wrap">

                        <table>

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($remedial as $item)
                                    <tr>
                                        <td class="col-no">{{ $loop->iteration }}</td>
                                        <td><span class="row-title">{{ $item->kuisRemedial->judul }}</span></td>
                                        <td><span class="badge inline">{{ $item->kuisRemedial->kategori }}</span></td>
                                        <td>
                                            <a href="{{ route('siswa.kuis.mulai', $item->kuisRemedial->id_kuis) }}" class="btn-inline">
                                                Kerjakan Remedial
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            @endif

        @endif

    </main>

</div>

</body>
</html>