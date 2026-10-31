<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nilai Saya - ITIK</title>

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
            transition: all .2s;
        }

        .menu a.active {
            background: white;
            color: #5b4ae3;
            font-weight: bold;
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

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 10px 18px;
            border-radius: 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,.04);
            flex-shrink: 0;
        }

        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #6553e8;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }

        /* BREADCRUMB */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            font-size: 14px;
            color: #777394;
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: #6553e8;
            text-decoration: none;
            font-weight: 600;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .sep {
            color: #b3b0cb;
        }

        .breadcrumb .current {
            color: #202044;
            font-weight: bold;
        }

        /* SECTION CARD */
        .section-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,.04);
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .section-header h2 {
            font-size: 22px;
            color: #202044;
        }

        .section-header p {
            color: #777394;
            font-size: 14px;
            margin-top: 4px;
        }

        .btn-nav-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            background: #edeafc;
            color: #6553e8;
            padding: 10px 18px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: bold;
            transition: all .2s;
        }

        .btn-nav-back:hover {
            background: #e0dbf8;
            transform: translateX(-2px);
        }

        /* ================= LEVEL 1: GRID MATA PELAJARAN ================= */
        .mapel-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 22px;
        }

        .mapel-card {
            background: white;
            border-radius: 18px;
            padding: 26px;
            border: 2px solid #eeecf8;
            box-shadow: 0 4px 15px rgba(0,0,0,.03);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all .25s ease;
            text-decoration: none;
            color: inherit;
        }

        .mapel-card:hover {
            border-color: #6553e8;
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(101,83,232,.12);
        }

        .mapel-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: #f0eefd;
            color: #6553e8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .mapel-title {
            font-size: 18px;
            font-weight: bold;
            color: #202044;
            margin-bottom: 12px;
        }

        .mapel-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            padding: 12px 0;
            border-top: 1px solid #f2f1f8;
            border-bottom: 1px solid #f2f1f8;
            margin-bottom: 16px;
        }

        .mapel-stat-item {
            display: flex;
            flex-direction: column;
        }

        .mapel-stat-label {
            font-size: 12px;
            color: #777394;
        }

        .mapel-stat-value {
            font-size: 16px;
            font-weight: bold;
            color: #202044;
            margin-top: 2px;
        }

        .btn-buka-mapel {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 18px;
            border-radius: 12px;
            background: #f5f4fc;
            color: #6553e8;
            font-weight: bold;
            font-size: 14px;
            transition: all .2s;
        }

        .mapel-card:hover .btn-buka-mapel {
            background: #6553e8;
            color: white;
        }

        /* ================= LEVEL 2: DAFTAR BAB MATERI (ALA FOTO 2) ================= */
        .bab-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .bab-card-foto2 {
            display: flex;
            align-items: center;
            gap: 22px;
            background: white;
            padding: 22px 28px;
            border-radius: 18px;
            border: 1.5px solid #ecebf6;
            box-shadow: 0 3px 12px rgba(40,30,80,.03);
            text-decoration: none;
            color: inherit;
            transition: all .2s ease;
        }

        .bab-card-foto2:hover {
            border-color: #6553e8;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(101,83,232,.12);
            background: #faf9ff;
        }

        .bab-num-badge {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: #111118;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: .5px;
            flex-shrink: 0;
        }

        .bab-card-body {
            flex: 1;
            min-width: 0;
        }

        .bab-card-title {
            font-size: 17.5px;
            font-weight: 700;
            color: #1a192c;
            margin-bottom: 6px;
            line-height: 1.35;
        }

        .bab-card-subtitle {
            font-size: 13.5px;
            color: #777394;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .bab-card-subtitle strong {
            color: #25834a;
        }

        .bab-card-arrow {
            color: #9995b3;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform .2s, color .2s;
        }

        .bab-card-foto2:hover .bab-card-arrow {
            color: #6553e8;
            transform: translateX(5px);
        }

        /* ================= LEVEL 3: TABEL RINCIAN NILAI ================= */
        .table-wrap {
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

        .badge-tingkat {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .badge-tingkat.mudah {
            background: #eafaf1;
            color: #25834a;
        }

        .badge-tingkat.sedang {
            background: #fff8e6;
            color: #b7791f;
        }

        .badge-tingkat.sulit {
            background: #fee2e2;
            color: #b91c1c;
        }

        .badge-lulus {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            background: #def7ec;
            color: #03543f;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-gagal {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            background: #fde8e8;
            color: #9b1c1c;
            font-size: 12px;
            font-weight: bold;
        }

        .score-val {
            font-size: 16px;
            font-weight: bold;
        }

        .score-val.pass {
            color: #188650;
        }

        .score-val.fail {
            color: #d64545;
        }

        .btn-evaluasi {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 10px;
            background: #edeafc;
            color: #6553e8;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            transition: all .2s;
            white-space: nowrap;
        }

        .btn-evaluasi:hover {
            background: #6553e8;
            color: white;
        }

        /* EMPTY STATE */
        .empty {
            text-align: center;
            padding: 50px 20px;
            color: #777394;
        }

        .empty-icon {
            font-size: 42px;
            margin-bottom: 12px;
        }

        .empty h3 {
            font-size: 20px;
            color: #202044;
            margin-bottom: 6px;
        }

        @media(max-width:900px) {
            .sidebar { display: none; }
            .content { padding: 25px; }
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

        <div class="menu-title">Menu Utama</div>

        <nav class="menu">
            <a href="{{ route('siswa.dashboard') }}">▦ &nbsp; Dashboard</a>
            <a href="{{ url('/siswa/materi') }}">▣ &nbsp; Materi</a>
            <a href="{{ url('/siswa/kuis') }}">☑ &nbsp; Kuis</a>
            <a href="{{ url('/siswa/nilai') }}" class="active">◉ &nbsp; Nilai Saya</a>
            <a href="{{ url('/siswa/remedial') }}">↻ &nbsp; Remedial</a>
            <a href="{{ route('profil') }}">◎ &nbsp; Profil</a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="content">

        <div class="topbar">
            <div class="title">
                <h1>Nilai Saya</h1>
                <p>Pantau hasil capaian evaluasi dan perkembangan belajarmu</p>
            </div>

            <div class="profile">
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'S', 0, 2)) }}
                </div>
                <div>
                    <strong>{{ Auth::user()->nama_lengkap }}</strong><br>
                    <small>NISN: {{ Auth::user()->nomor_induk }}</small>
                </div>
            </div>
        </div>

        <!-- BREADCRUMB -->
        <div class="breadcrumb">
            <a href="{{ url('/siswa/nilai') }}">Nilai Saya</a>
            @if ($mapelTerpilih)
                <span class="sep">›</span>
                @if ($materiTerpilih)
                    <a href="{{ url('/siswa/nilai?mapel=' . $mapelTerpilih->id_mapel) }}">{{ $mapelTerpilih->nama_mapel }}</a>
                    <span class="sep">›</span>
                    <span class="current">{{ $materiTerpilih->judul }}</span>
                @else
                    <span class="current">{{ $mapelTerpilih->nama_mapel }}</span>
                @endif
            @endif
        </div>

        {{-- ========================================================= --}}
        {{-- TAMPILAN LEVEL 1: PILIHAN MATA PELAJARAN                   --}}
        {{-- ========================================================= --}}
        @if (!$mapelTerpilih)

            <div class="section-card">
                <div class="section-header">
                    <div>
                        <h2>Pilih Mata Pelajaran</h2>
                        <p>Pilih mata pelajaran untuk melihat riwayat nilai per bab materi</p>
                    </div>
                </div>

                <div class="mapel-grid">
                    @foreach ($mapelAktif as $mp)
                        @php
                            $hasilMapel = $semuaHasil->filter(fn($h) => $h->kuis && $h->kuis->id_mapel === $mp->id_mapel);
                            $totalKuisSelesai = $hasilMapel->pluck('id_kuis')->unique()->count();
                            $rataRata = $hasilMapel->isNotEmpty() ? $hasilMapel->avg('nilai') : null;
                        @endphp
                        <a href="{{ url('/siswa/nilai?mapel=' . $mp->id_mapel) }}" class="mapel-card">
                            <div>
                                <div class="mapel-icon-wrap">
                                    @if(stripos($mp->nama_mapel, 'informasi') !== false || stripos($mp->nama_mapel, 'tik') !== false)
                                        💻
                                    @elseif(stripos($mp->nama_mapel, 'server') !== false || stripos($mp->nama_mapel, 'jaringan') !== false)
                                        🖥️
                                    @elseif(stripos($mp->nama_mapel, 'indonesia') !== false)
                                        🇮🇩
                                    @else
                                        📘
                                    @endif
                                </div>
                                <h3 class="mapel-title">{{ $mp->nama_mapel }}</h3>
                                <p style="font-size:13px; color:#777394; margin-bottom: 10px;">
                                    {{ $mp->deskripsi ?? 'Kurikulum Pembelajaran SMK TKJ' }}
                                </p>
                            </div>

                            <div>
                                <div class="mapel-stats">
                                    <div class="mapel-stat-item">
                                        <span class="mapel-stat-label">Kuis Selesai</span>
                                        <span class="mapel-stat-value">{{ $totalKuisSelesai }} Kuis</span>
                                    </div>
                                    <div class="mapel-stat-item">
                                        <span class="mapel-stat-label">Rata-rata Nilai</span>
                                        <span class="mapel-stat-value" style="color: {{ $rataRata && $rataRata >= 75 ? '#25834a' : '#c98200' }};">
                                            {{ $rataRata !== null ? number_format($rataRata, 1) : '-' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="btn-buka-mapel">
                                    <span>Lihat Nilai Bab Materi</span>
                                    <span>→</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        {{-- ========================================================= --}}
        {{-- TAMPILAN LEVEL 2: DAFTAR BAB MATERI (PERSIS ALA FOTO 2)    --}}
        {{-- ========================================================= --}}
        @elseif ($mapelTerpilih && !$materiTerpilih)

            <div class="section-card">
                <div class="section-header">
                    <div>
                        <h2>Daftar Bab Materi — {{ $mapelTerpilih->nama_mapel }}</h2>
                        <p>Klik bab materi di bawah untuk melihat rincian riwayat kuis dan evaluasi butir soal</p>
                    </div>

                    <a href="{{ url('/siswa/nilai') }}" class="btn-nav-back">
                        ← Pilih Mapel Lain
                    </a>
                </div>

                @if ($daftarMateri->isEmpty())
                    <div class="empty">
                        <div class="empty-icon">📂</div>
                        <h3>Belum Ada Bab Materi</h3>
                        <p>Materi pembelajaran untuk mata pelajaran ini belum ditambahkan oleh guru.</p>
                    </div>
                @else
                    <!-- DAFTAR KARTU BAB (ALA FOTO 2 DENGAN BADGE NOMOR HITAM SOLID) -->
                    <div class="bab-list">
                        @foreach ($daftarMateri as $index => $mat)
                            @php
                                $numStr = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                                $ringkasan = $ringkasanBab[$mat->id_materi] ?? [];
                                $totalKuis = $ringkasan['total_kuis'] ?? 0;
                                $kuisSelesai = $ringkasan['kuis_selesai'] ?? 0;
                                $nilaiTertinggi = $ringkasan['nilai_tertinggi'] ?? null;
                            @endphp
                            <a href="{{ url('/siswa/nilai?mapel=' . $mapelTerpilih->id_mapel . '&materi=' . $mat->id_materi) }}" class="bab-card-foto2">
                                <div class="bab-num-badge">{{ $numStr }}</div>
                                <div class="bab-card-body">
                                    <h3 class="bab-card-title">{{ $mat->judul }}</h3>
                                    <p class="bab-card-subtitle">
                                        Bab {{ $mat->bab ?? ($index + 1) }} &bull; {{ $totalKuis }} Kuis Tersedia
                                        @if($nilaiTertinggi !== null)
                                            &bull; Nilai Tertinggi: <strong>{{ number_format($nilaiTertinggi, 1) }}</strong> ({{ $kuisSelesai }}/{{ $totalKuis }} Kuis Dikerjakan)
                                        @else
                                            &bull; Belum ada riwayat pengerjaan
                                        @endif
                                    </p>
                                </div>
                                <div class="bab-card-arrow">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- BAGIAN ULANGAN UMUM DI LEVEL MAPEL (JIKA ADA) -->
            @if ($hasilUlanganUmum->isNotEmpty())
                <div class="section-card">
                    <div class="section-header">
                        <div>
                            <h2>📝 Riwayat Nilai Ulangan &amp; Evaluasi</h2>
                            <p>Hasil pengerjaan ulangan mata pelajaran {{ $mapelTerpilih->nama_mapel }}</p>
                        </div>
                    </div>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 40px;">No</th>
                                    <th>Kuis Ulangan</th>
                                    <th>Percobaan</th>
                                    <th>Nilai Siswa</th>
                                    <th>KKM</th>
                                    <th>Kelulusan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasilUlanganUmum as $item)
                                    @php
                                        $lulus = $item->nilai !== null && $item->kuis && $item->kuis->kkm !== null && $item->nilai >= $item->kuis->kkm;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong style="color: #202044;">{{ $item->kuis->judul ?? '-' }}</strong><br>
                                            <span style="font-size: 11px; background: #e0f2fe; color: #0284c7; padding: 2px 8px; border-radius: 10px; font-weight: bold;">
                                                Ulangan
                                            </span>
                                        </td>
                                        <td>Ke-{{ $item->percobaan_ke }}</td>
                                        <td>
                                            <span class="score-val {{ $lulus ? 'pass' : 'fail' }}">
                                                {{ $item->nilai !== null ? number_format($item->nilai, 1) : '-' }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($item->kuis->kkm ?? 75, 1) }}</td>
                                        <td>
                                            @if($lulus)
                                                <span class="badge-lulus">✓ Lulus</span>
                                            @else
                                                <span class="badge-gagal">⚠️ Belum Lulus</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->tanggal ? date('d/m/Y', strtotime($item->tanggal)) : '-' }}</td>
                                        <td>
                                            <a href="{{ route('siswa.kuis.hasil', $item->id_kuis) }}" class="btn-evaluasi">
                                                📋 Evaluasi Soal
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        {{-- ========================================================= --}}
        {{-- TAMPILAN LEVEL 3: RINCIAN NILAI KUIS BAB TERPILIH          --}}
        {{-- ========================================================= --}}
        @elseif ($mapelTerpilih && $materiTerpilih)

            <div class="section-card">
                <div class="section-header">
                    <div>
                        <h2>Hasil Kuis — {{ $materiTerpilih->judul }}</h2>
                        <p>Daftar riwayat pengerjaan dan hasil evaluasi butir kuis pada bab ini</p>
                    </div>

                    <a href="{{ url('/siswa/nilai?mapel=' . $mapelTerpilih->id_mapel) }}" class="btn-nav-back">
                        ← Kembali ke Daftar Bab
                    </a>
                </div>

                @if ($hasil->isEmpty())
                    <div class="empty">
                        <div class="empty-icon">📝</div>
                        <h3>Belum Ada Riwayat Kuis di Bab Ini</h3>
                        <p>Kamu belum pernah mengerjakan kuis untuk bab materi ini.</p>
                        <a href="{{ url('/siswa/kuis?mapel=' . $mapelTerpilih->id_mapel . '&materi=' . $materiTerpilih->id_materi) }}" class="btn-nav-back" style="background:#6553e8; color:white; margin-top:18px;">
                            Mulai Kerjakan Kuis Bab Ini →
                        </a>
                    </div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 40px;">No</th>
                                    <th>Nama Kuis</th>
                                    <th>Kategori</th>
                                    <th>Tingkat Kesulitan</th>
                                    <th style="width: 80px;">Percobaan</th>
                                    <th>Nilai</th>
                                    <th>KKM</th>
                                    <th>Kelulusan</th>
                                    <th>Tanggal</th>
                                    <th style="min-width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasil as $item)
                                    @php
                                        $tingkat = strtolower(trim($item->kuis->tingkat_kesulitan ?? 'mudah'));
                                        $lulus = $item->nilai !== null && $item->kuis && $item->kuis->kkm !== null && $item->nilai >= $item->kuis->kkm;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong style="color: #202044;">{{ $item->kuis->judul ?? '-' }}</strong>
                                        </td>
                                        <td>
                                            <span style="font-size: 11px; background: #eeeaff; color: #5b4ae3; padding: 3px 8px; border-radius: 10px; font-weight: bold;">
                                                {{ $item->kuis->kategori ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-tingkat {{ $tingkat }}">
                                                {{ ucfirst($tingkat) }}
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <strong>Ke-{{ $item->percobaan_ke }}</strong>
                                        </td>
                                        <td>
                                            <span class="score-val {{ $lulus ? 'pass' : 'fail' }}">
                                                {{ $item->nilai !== null ? number_format($item->nilai, 1) : '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $item->kuis->kkm !== null ? number_format($item->kuis->kkm, 1) : '-' }}
                                        </td>
                                        <td>
                                            @if($lulus)
                                                <span class="badge-lulus">✓ Lulus</span>
                                            @else
                                                <span class="badge-gagal">⚠️ Tidak Lulus</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item->tanggal ? date('d/m/Y', strtotime($item->tanggal)) : '-' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('siswa.kuis.hasil', $item->id_kuis) }}" class="btn-evaluasi">
                                                📋 Evaluasi Soal
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        @endif

    </main>

</div>

</body>
</html>
