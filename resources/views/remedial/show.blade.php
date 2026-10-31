<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Kuis Remedial - ITIK</title>

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

        .badge-lulus {
            background: #def7ec;
            color: #03543f;
        }

        .badge-gagal {
            background: #fde8e8;
            color: #9b1c1c;
        }

        .badge-belum {
            background: #f3f4f6;
            color: #4b5563;
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
        }

        .btn-back:hover {
            background: #e2ddf8;
        }

        .btn-action {
            display: inline-block;
            text-decoration: none;
            background: #6553e8;
            color: white;
            padding: 12px 22px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: bold;
        }

        .btn-action:hover {
            background: #5240d4;
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
                <h1>Detail Remedial</h1>
                <p>Pantau perkembangan hasil remedial siswa</p>
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

        <div class="info-card">
            <div class="info-item">
                <span class="info-label">Kuis Remedial</span>
                <span class="info-value" style="color: #6553e8;">{{ $remedial->kuisRemedial->judul ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Kuis Asal (Ulangan)</span>
                <span class="info-value">{{ $remedial->kuisAsal->judul ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">KKM</span>
                <span class="info-value" style="color: #c98200;">{{ number_format($remedial->kuisRemedial->kkm ?? $remedial->kuisAsal->kkm, 1) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Jumlah Butir Soal</span>
                <span class="info-value">{{ $remedial->kuisRemedial?->soal?->count() ?? 0 }} Soal</span>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('guru.remedial.siswa', $remedial->id_remedial) }}" class="btn-action">
                    👥 Tugaskan Siswa
                </a>
                <a href="{{ route('guru.remedial.index') }}" class="btn-back">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="table-card">
            <h2 style="font-size: 20px; margin-bottom: 20px;">Daftar Siswa yang Ditugaskan</h2>

            @if($remedial->remedialSiswa->isEmpty())

                <div class="empty-state">
                    <div style="font-size: 40px; margin-bottom: 10px;">📝</div>
                    <h3 style="color: #202044;">Belum Ada Siswa yang Diberi Tugas</h3>
                    <p>Klik tombol <strong>"👥 Tugaskan Siswa"</strong> di atas untuk memberikan tugas remedial kepada siswa yang nilainya di bawah KKM pada Ulangan.</p>
                </div>

            @else

                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Siswa</th>
                            <th>Nilai Ulangan Asal</th>
                            <th>KKM</th>
                            <th>Nilai Remedial</th>
                            <th>Status Pengerjaan</th>
                            <th>Hasil Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($remedial->remedialSiswa as $item)
                            @php
                                $nilaiAsal = $item->mengerjakanAsal?->nilai;
                                $nilaiRemedial = $item->hasilRemedial?->nilai;
                                $kkm = $remedial->kuisRemedial->kkm ?? $remedial->kuisAsal->kkm;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $item->mengerjakanAsal?->siswa?->nama_lengkap ?? '-' }}</strong><br>
                                    <small style="color: #777394;">NISN: {{ $item->mengerjakanAsal?->siswa?->nomor_induk ?? '-' }}</small>
                                </td>
                                <td>
                                    <span style="color: #d93636; font-weight: bold;">
                                        {{ $nilaiAsal !== null ? number_format($nilaiAsal, 1) : '-' }}
                                    </span>
                                </td>
                                <td>{{ number_format($kkm, 1) }}</td>
                                <td>
                                    @if($nilaiRemedial !== null)
                                        <strong style="color: {{ $nilaiRemedial >= $kkm ? '#25834a' : '#d93636' }};">
                                            {{ number_format($nilaiRemedial, 1) }}
                                        </strong>
                                    @else
                                        <span style="color: #777394;">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($nilaiRemedial !== null)
                                        <span class="badge badge-lulus">Selesai</span>
                                    @else
                                        <span class="badge badge-belum">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($nilaiRemedial === null)
                                        <span class="badge badge-belum">Belum Mengerjakan</span>
                                    @elseif($nilaiRemedial >= $kkm)
                                        <span class="badge badge-lulus">✓ Lulus Remedial</span>
                                    @else
                                        <span class="badge badge-gagal">Belum Lulus</span>
                                    @endif
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
