<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tugaskan Siswa Remedial - ITIK</title>

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

        .info-card {
            background: white;
            border-radius: 20px;
            padding: 25px 30px;
            box-shadow: 0 6px 20px rgba(0,0,0,.05);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 13px;
            color: #777394;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 16px;
            font-weight: bold;
            color: #202044;
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

        .badge-warning {
            background: #fff8e6;
            color: #b7791f;
            border: 1px solid #f6e05e;
        }

        .badge-success {
            background: #def7ec;
            color: #03543f;
        }

        .btn-submit {
            background: #6553e8;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-submit:hover {
            background: #5240d4;
            transform: translateY(-2px);
        }

        .btn-back {
            display: inline-block;
            text-decoration: none;
            background: #edeafc;
            color: #6553e8;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: bold;
            margin-right: 12px;
        }

        .btn-back:hover {
            background: #e2ddf8;
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

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #777394;
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
            <a href="{{ route('dashboard') }}">▦ &nbsp; Dashboard</a>
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
                <h1>Tugaskan Siswa Remedial</h1>
                <p>Pilih siswa yang berhak mengikuti kuis remedial ini</p>
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

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <div class="info-card">
            <div class="info-item">
                <span class="info-label">Kuis Remedial</span>
                <span class="info-value" style="color: #6553e8;">{{ $remedial->kuisRemedial->judul ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Kuis Asal (Ulangan)</span>
                <span class="info-value">{{ $kuisAsal->judul ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">KKM Kelulusan</span>
                <span class="info-value" style="color: #c98200;">{{ number_format($kuisAsal->kkm, 1) }}</span>
            </div>
            <div>
                <a href="{{ route('guru.remedial.index') }}" class="btn-back">
                    ← Kembali ke Daftar
                </a>
            </div>
        </div>

        <div class="table-card">

            @if($hasilSiswa->isEmpty())

                <div class="empty-state">
                    <div style="font-size: 40px; margin-bottom: 10px;">🎉</div>
                    <h3 style="color: #202044;">Tidak Ada Siswa di Bawah KKM</h3>
                    <p>Semua siswa yang telah mengumpulkan ulangan ini berhasil mencapai nilai &ge; KKM ({{ number_format($kuisAsal->kkm, 1) }}), atau belum ada siswa yang mengerjakan.</p>
                </div>

            @else

                <form action="{{ route('guru.remedial.tugaskan', $remedial->id_remedial) }}" method="POST">
                    @csrf

                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50px;">Pilih</th>
                                <th style="width: 50px;">No</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Nilai Ulangan</th>
                                <th>KKM</th>
                                <th>Percobaan Ke</th>
                                <th>Status Tugas Remedial</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hasilSiswa as $hasil)
                                @php
                                    $sudah = in_array($hasil->id_mengerjakan, $sudahDitugaskan);
                                @endphp
                                <tr>
                                    <td>
                                        @if($sudah)
                                            <span style="color: #10b981; font-weight: bold; font-size: 18px;">✓</span>
                                        @else
                                            <input type="checkbox" name="id_mengerjakan[]" value="{{ $hasil->id_mengerjakan }}" style="width: 18px; height: 18px; cursor: pointer;">
                                        @endif
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $hasil->siswa->nomor_induk ?? '-' }}</td>
                                    <td>
                                        <strong>{{ $hasil->siswa->nama_lengkap ?? '-' }}</strong>
                                    </td>
                                    <td>
                                        <span style="color: #d93636; font-weight: bold;">
                                            {{ number_format($hasil->nilai, 1) }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($kuisAsal->kkm, 1) }}</td>
                                    <td>Percobaan {{ $hasil->percobaan_ke }}</td>
                                    <td>
                                        @if($sudah)
                                            <span class="badge badge-success">✓ Sudah Ditugaskan</span>
                                        @else
                                            <span class="badge badge-warning">Belum Ditugaskan</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div style="margin-top: 25px; display: flex; align-items: center; justify-content: flex-end; gap: 15px;">
                        <a href="{{ route('guru.remedial.index') }}" class="btn-back">
                            Batal
                        </a>
                        <button type="submit" class="btn-submit">
                            Tugaskan Siswa yang Dipilih
                        </button>
                    </div>

                </form>

            @endif

        </div>

    </main>

</div>

</body>
</html>
