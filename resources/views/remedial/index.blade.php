<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Remedial - ITIK</title>

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

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .btn-tambah {
            background: #6553e8;
            color: white;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .2s;
        }

        .btn-tambah:hover {
            background: #5240d4;
            transform: translateY(-2px);
        }

        .alert-success {
            background: #def7ec;
            color: #03543f;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 22px;
            font-size: 15px;
            font-weight: 500;
        }

        .alert-error {
            background: #fde8e8;
            color: #9b1c1c;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 22px;
            font-size: 15px;
        }

        .table-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0,0,0,.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 14px 16px;
            background: #f8f7fd;
            color: #55527a;
            font-size: 14px;
            font-weight: 600;
            border-bottom: 2px solid #edeafc;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f0eef8;
            font-size: 15px;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-remedial {
            background: #fff8e6;
            color: #b7791f;
            border: 1px solid #f6e05e;
        }

        .badge-ulangan {
            background: #ebf8ff;
            color: #2b6cb0;
            border: 1px solid #bee3f8;
        }

        .badge-terbit {
            background: #def7ec;
            color: #03543f;
        }

        .badge-draft {
            background: #f3f4f6;
            color: #4b5563;
        }

        .btn-action {
            display: inline-block;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s;
            margin-right: 6px;
        }

        .btn-siswa {
            background: #6553e8;
            color: white;
        }

        .btn-siswa:hover {
            background: #5240d4;
        }

        .btn-detail {
            background: #edeafc;
            color: #6553e8;
        }

        .btn-detail:hover {
            background: #e2ddf8;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #777394;
        }

        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 8px;
            color: #202044;
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
                <span>Portal Guru</span>
            </div>
        </div>

        <div class="menu-title">Menu Utama</div>

        <nav class="menu">
            <a href="{{ route('guru.dashboard') }}">▦ &nbsp; Dashboard</a>
            <a href="{{ url('/guru/materi') }}">▣ &nbsp; Materi</a>
            <a href="{{ route('kuis.index') }}">☑ &nbsp; Kuis &amp; Soal</a>
            <a href="{{ route('guru.nilai.index') }}">◉ &nbsp; Validasi Nilai</a>
            <a href="{{ route('guru.remedial.index') }}" class="active">↻ &nbsp; Remedial</a>
            <a href="{{ route('profil') }}">◎ &nbsp; Profil</a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="content">

        <div class="topbar">
            <div class="title">
                <h1>Kelola Remedial</h1>
                <p>Pengelolaan kuis remedial khusus untuk kuis ber-kategori Ulangan</p>
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
            <div class="alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <div class="section-header">
            <div>
                <h2 style="font-size: 22px;">Daftar Kuis Remedial</h2>
                <p style="color: #777394; font-size: 14px;">Remedial yang ditugaskan dari evaluasi ulangan siswa</p>
            </div>

            <a href="{{ route('guru.remedial.create') }}" class="btn-tambah">
                + Buat Kuis Remedial
            </a>
        </div>

        <div class="table-card">

            @if($remedials->isEmpty())

                <div class="empty-state">
                    <div style="font-size: 40px; margin-bottom: 10px;">📋</div>
                    <h3>Belum Ada Kuis Remedial</h3>
                    <p>Silakan buat kuis remedial baru untuk siswa yang nilainya di bawah KKM pada Ulangan.</p>
                    <a href="{{ route('guru.remedial.create') }}" class="btn-tambah" style="margin-top: 20px; display: inline-block;">
                        + Buat Kuis Remedial Sekarang
                    </a>
                </div>

            @else

                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Judul Kuis Remedial</th>
                            <th>Kuis Asal (Ulangan)</th>
                            <th>Mata Pelajaran</th>
                            <th>KKM</th>
                            <th>Jumlah Soal</th>
                            <th>Status</th>
                            <th style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($remedials as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $item->kuisRemedial->judul ?? '-' }}</strong><br>
                                    <span class="badge badge-remedial">Remedial</span>
                                </td>
                                <td>
                                    {{ $item->kuisAsal->judul ?? '-' }}<br>
                                    <span class="badge badge-ulangan">{{ $item->kuisAsal->kategori ?? 'Ulangan' }}</span>
                                </td>
                                <td>
                                    {{ $item->kuisAsal->mapel->nama_mapel ?? '-' }}
                                </td>
                                <td>
                                    <strong>{{ number_format($item->kuisRemedial->kkm ?? $item->kuisAsal->kkm, 1) }}</strong>
                                </td>
                                <td>
                                    {{ $item->kuisRemedial?->soal?->count() ?? 0 }} Soal
                                </td>
                                <td>
                                    @if(($item->kuisRemedial->status_publikasi ?? '') === 'terbit')
                                        <span class="badge badge-terbit">Terbit</span>
                                    @else
                                        <span class="badge badge-draft">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('guru.remedial.siswa', $item->id_remedial) }}" class="btn-action btn-siswa">
                                        👥 Tugaskan Siswa
                                    </a>
                                    <a href="{{ route('guru.remedial.show', $item->id_remedial) }}" class="btn-action btn-detail">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @endif

        </div>

    </main>

</div>

</body>
</html>
