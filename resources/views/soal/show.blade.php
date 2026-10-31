<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Soal - ITIK</title>

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

        .logo h2 { font-size: 22px; }
        .logo span { font-size: 14px; opacity: .85; }

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
            margin-bottom: 4px;
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

        .profile-mini small { color: #777394; }

        /* ================= BREADCRUMB ================= */

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #999;
            margin-bottom: 22px;
        }

        .breadcrumb a {
            color: #7160ef;
            text-decoration: none;
        }

        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb span { color: #ccc; }

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

        /* ================= CARD ================= */

        .card {
            background: white;
            border-radius: 22px;
            padding: 30px;
            box-shadow: 0 4px 18px rgba(70,60,130,.06);
            margin-bottom: 22px;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
            padding-bottom: 18px;
            border-bottom: 1px solid #eeeef5;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #202044;
        }

        .card-sub {
            font-size: 13px;
            color: #777394;
            margin-top: 3px;
        }

        /* ================= BADGES ================= */

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .badge-kategori { background: #eeeaff; color: #5b4ae3; }
        .badge-mudah  { background: #e9f9ef; color: #25834a; }
        .badge-sedang { background: #fff3dc; color: #c98200; }
        .badge-sulit  { background: #ffe5e5; color: #d64545; }

        .badges-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        /* ================= PERTANYAAN ================= */

        .pertanyaan-box {
            background: #f7f6fc;
            border-radius: 14px;
            padding: 22px 24px;
            font-size: 17px;
            line-height: 1.6;
            color: #202044;
            margin-bottom: 24px;
        }

        .pertanyaan-label {
            font-size: 11px;
            font-weight: bold;
            color: #a99cf0;
            letter-spacing: .07em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        /* ================= OPSI ================= */

        .opsi-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .opsi-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 18px;
            border-radius: 13px;
            border: 1.5px solid #eeeef5;
            background: white;
            font-size: 15px;
            color: #44435f;
        }

        .opsi-item.benar {
            border-color: #b3ead0;
            background: #f0fbf5;
        }

        .opsi-huruf {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            flex-shrink: 0;
            background: #eeeaff;
            color: #5b4ae3;
        }

        .opsi-item.benar .opsi-huruf {
            background: #25834a;
            color: white;
        }

        .opsi-teks {
            flex: 1;
            padding-top: 5px;
            line-height: 1.5;
        }

        .opsi-keterangan {
            font-size: 11px;
            font-weight: bold;
            color: #25834a;
            margin-top: 3px;
        }

        /* ================= INFO GRID ================= */

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
        }

        .info-item {
            background: #f7f6fc;
            border-radius: 12px;
            padding: 14px 16px;
        }

        .info-label {
            font-size: 11px;
            font-weight: bold;
            color: #a99cf0;
            letter-spacing: .06em;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .info-value {
            font-size: 15px;
            font-weight: bold;
            color: #202044;
        }

        /* ================= ACTIONS ================= */

        .bottom-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 8px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: opacity .15s;
        }

        .btn:hover { opacity: .85; }

        .btn-primary {
            background: #6553e8;
            color: white;
        }

        .btn-secondary {
            background: #eeeaff;
            color: #5b4ae3;
        }

        .btn-warning {
            background: #fff3dc;
            color: #c98200;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 900px) {
            .sidebar { display: none; }
            .content { padding: 20px; }
        }

        @media(max-width: 600px) {
            .topbar { flex-direction: column; align-items: flex-start; gap: 15px; }
            .profile-mini { display: none; }
            .bottom-actions { flex-direction: column-reverse; align-items: stretch; }
            .bottom-actions .btn { width: 100%; }
        }
    </style>
</head>


<body>

<div class="layout">


    <!-- ================= SIDEBAR ================= -->

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
                ☑ &nbsp; Kuis &amp; Soal
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
                <h1>Detail Soal</h1>
                <p>Lihat isi dan pilihan jawaban soal</p>
            </div>

            <div class="profile-mini">
                <div class="avatar-small">
                    {{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 2)) }}
                </div>
                <div>
                    <strong>{{ Auth::user()->nama_lengkap }}</strong>
                    <br>
                    <small>{{ ucfirst(Auth::user()->role) }}</small>
                </div>
            </div>

        </div>


        <!-- BREADCRUMB -->

        <div class="breadcrumb">
            <a href="{{ route('kuis.index', ['mapel' => $kuis->id_mapel]) }}">Kuis &amp; Soal</a>
            <span>›</span>
            <a href="{{ route('kuis.show', $kuis->id_kuis) }}">{{ $kuis->judul }}</a>
            <span>›</span>
            <a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}">Daftar Soal</a>
            <span>›</span>
            <span style="color:#202044;">Detail Soal</span>
        </div>


        <!-- ALERT -->

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif


        <!-- CARD INFO KUIS -->

        <div class="card">

            <div class="card-header">

                <div>
                    <div class="card-title">{{ $kuis->judul }}</div>
                    <div class="card-sub">ID Kuis: {{ $kuis->id_kuis }}</div>
                </div>

                <div class="badges-row">
                    <span class="badge badge-kategori">{{ $kuis->kategori }}</span>
                    <span class="badge badge-{{ $kuis->tingkat_kesulitan ?? 'mudah' }}">
                        {{ ucfirst($kuis->tingkat_kesulitan ?? 'Mudah') }}
                    </span>
                </div>

            </div>

            <div class="info-grid">

                <div class="info-item">
                    <div class="info-label">ID Soal</div>
                    <div class="info-value">{{ $soal->id_soal }}</div>
                </div>

                @if ($soal->tingkat_kesulitan)
                    <div class="info-item">
                        <div class="info-label">Tingkat Soal</div>
                        <div class="info-value">{{ ucfirst($soal->tingkat_kesulitan) }}</div>
                    </div>
                @endif

                <div class="info-item">
                    <div class="info-label">Jawaban Benar</div>
                    <div class="info-value" style="color:#25834a;">{{ $soal->jawaban }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Bobot Nilai</div>
                    <div class="info-value">{{ $soal->bobot ? number_format($soal->bobot, 2) . '%' : 'Otomatis' }}</div>
                </div>

            </div>

        </div>


        <!-- CARD PERTANYAAN & PILIHAN -->

        <div class="card">

            <div class="card-header">
                <div>
                    <div class="card-title">Pertanyaan</div>
                    <div class="card-sub">Isi soal dan pilihan jawaban</div>
                </div>
            </div>


            <!-- PERTANYAAN -->

            <div class="pertanyaan-box">
                <div class="pertanyaan-label">Soal</div>
                {{ $soal->pertanyaan }}
            </div>


            <!-- PILIHAN JAWABAN -->

            <div style="margin-bottom: 10px;">
                <span style="font-size:13px; font-weight:bold; color:#777394; letter-spacing:.05em; text-transform:uppercase;">Pilihan Jawaban</span>
            </div>

            <div class="opsi-list">

                @foreach (['A' => $soal->opsi_a, 'B' => $soal->opsi_b, 'C' => $soal->opsi_c, 'D' => $soal->opsi_d, 'E' => $soal->opsi_e] as $huruf => $opsi)

                    @if ($opsi !== null && $opsi !== '')

                        <div class="opsi-item {{ $soal->jawaban === $huruf ? 'benar' : '' }}">

                            <div class="opsi-huruf">{{ $huruf }}</div>

                            <div class="opsi-teks">
                                {{ $opsi }}
                                @if ($soal->jawaban === $huruf)
                                    <div class="opsi-keterangan">✓ Jawaban Benar</div>
                                @endif
                            </div>

                        </div>

                    @endif

                @endforeach

            </div>

        </div>


        <!-- BOTTOM ACTIONS -->

        <div class="bottom-actions">

            <a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}" class="btn btn-secondary">
                ← Kembali ke Daftar Soal
            </a>

            <a href="{{ route('kuis.soal.edit', [$kuis->id_kuis, $soal->id_soal]) }}" class="btn btn-warning">
                ✎ Edit Soal
            </a>

        </div>


    </main>

</div>

</body>

</html>
