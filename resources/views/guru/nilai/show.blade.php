<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Nilai - ITIK</title>

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

        /* ALERT */

        .alert {
            padding: 15px 18px;
            border-radius: 13px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #e8f8ef;
            color: #188650;
            border: 1px solid #c9ecd9;
        }

        .alert-error {
            background: #fff0f0;
            color: #d64545;
            border: 1px solid #ffd0d0;
        }

        /* PAGE HEADER */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .page-header h2 {
            font-size: 23px;
            margin-bottom: 5px;
        }

        .page-header p {
            color: #777394;
            font-size: 14px;
        }

        /* CARD */

        .card {
            background: white;
            border-radius: 20px;
            padding: 28px;
            margin-bottom: 22px;
            box-shadow: 0 4px 18px rgba(70,60,130,.06);
        }

        .card h3 {
            font-size: 19px;
            margin-bottom: 20px;
        }

        /* INFO TABLE */

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table tr {
            border-bottom: 1px solid #f0eff6;
        }

        .info-table tr:last-child {
            border-bottom: none;
        }

        .info-table th {
            width: 240px;
            text-align: left;
            padding: 15px 10px 15px 0;
            color: #777394;
            font-size: 14px;
            font-weight: 600;
            vertical-align: top;
        }

        .info-table td {
            padding: 15px 0;
            color: #29274a;
            font-size: 14px;
        }

        .score {
            font-size: 19px;
            color: #5b4ae3;
        }

        /* BADGES */

        .badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-purple {
            background: #eeeaff;
            color: #5b4ae3;
        }

        .badge-green {
            background: #e8f8ef;
            color: #188650;
        }

        .badge-red {
            background: #ffe5e5;
            color: #d64545;
        }

        .badge-yellow {
            background: #fff4d6;
            color: #a97900;
        }

        /* VALIDATION */

        .validation-card {
            border: 1px solid #eeeef5;
        }

        .validation-status {
            display: inline-block;
            padding: 8px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-waiting {
            background: #fff4d6;
            color: #a97900;
        }

        .status-done {
            background: #e8f8ef;
            color: #188650;
        }

        /* ACTIONS */

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 25px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            border-radius: 12px;
            border: none;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        /* EVALUASI SOAL GURU */
        .eval-stats-guru {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .eval-stat-guru-box {
            flex: 1;
            min-width: 140px;
            background: #fbfbfe;
            border: 1px solid #eeeef6;
            border-radius: 14px;
            padding: 14px;
            text-align: center;
        }

        .eval-stat-guru-num {
            font-size: 24px;
            font-weight: bold;
        }

        .eval-stat-guru-label {
            font-size: 13px;
            color: #777394;
            margin-top: 4px;
        }

        .soal-guru-item {
            background: #fafafc;
            border: 1px solid #eeeef6;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 16px;
        }

        .soal-guru-item.benar {
            border-left: 4px solid #188650;
        }

        .soal-guru-item.salah {
            border-left: 4px solid #d64545;
        }

        .soal-guru-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .opsi-guru-list {
            display: grid;
            gap: 8px;
            margin-top: 12px;
        }

        .opsi-guru-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            background: white;
            border: 1px solid #ebebf3;
            font-size: 14px;
        }

        .opsi-guru-item.kunci {
            background: #e8f8ef;
            border-color: #a3e9c0;
            color: #155724;
            font-weight: 600;
        }

        .opsi-guru-item.jawaban-salah {
            background: #ffe5e5;
            border-color: #f5b7b7;
            color: #9b1c1c;
        }

        .opsi-guru-badge {
            margin-left: auto;
            font-size: 12px;
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 6px;
        }

        .btn-primary {
            background: #6553e8;
            color: white;
        }

        .btn-primary:hover {
            background: #5543d5;
        }

        .btn-secondary {
            background: #eeeaff;
            color: #5b4ae3;
        }

        .btn-secondary:hover {
            background: #e2ddff;
        }

        .btn-success {
            background: #188650;
            color: white;
        }

        .btn-success:hover {
            background: #117340;
        }

        .already-validated {
            padding: 14px 17px;
            background: #e8f8ef;
            border: 1px solid #c9ecd9;
            color: #188650;
            border-radius: 12px;
            font-size: 14px;
        }

        /* EMPTY */

        .empty-info {
            padding: 20px;
            border-radius: 12px;
            background: #f7f6ff;
            color: #777394;
            font-size: 14px;
        }

        /* RESPONSIVE */

        @media(max-width:900px) {
            .sidebar {
                display: none;
            }

            .content {
                padding: 25px;
            }
        }

        @media(max-width:700px) {
            .profile-mini {
                display: none;
            }

            .topbar {
                margin-bottom: 25px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .card {
                padding: 20px;
            }

            .info-table th {
                width: 150px;
            }

            .actions {
                flex-direction: column;
                align-items: stretch;
            }

            .actions .btn {
                width: 100%;
            }
        }

        @media(max-width:500px) {
            .content {
                padding: 20px 15px;
            }

            .title h1 {
                font-size: 28px;
            }

            .info-table th,
            .info-table td {
                display: block;
                width: 100%;
                padding: 8px 0;
            }

            .info-table th {
                padding-bottom: 3px;
            }

            .info-table td {
                padding-top: 3px;
                padding-bottom: 15px;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}

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


    {{-- CONTENT --}}

    <main class="content">

        <div class="topbar">

            <div class="title">

                <h1>Detail Nilai Siswa</h1>

                <p>
                    Detail hasil pengerjaan dan validasi nilai siswa
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


        {{-- ALERT SUCCESS --}}

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- ALERT ERROR --}}

        @if(session('error'))

            <div class="alert alert-error">
                {{ session('error') }}
            </div>

        @endif


        {{-- DATA SISWA --}}

        <div class="card">

            <h3>Data Siswa</h3>

            <table class="info-table">

                <tr>

                    <th>Nama Siswa</th>

                    <td>
                        {{ $mengerjakan->siswa->nama_lengkap ?? '-' }}
                    </td>

                </tr>

                <tr>

                    <th>Kelas</th>

                    <td>
                        {{ $mengerjakan->siswa->kelas ?? '-' }}
                    </td>

                </tr>

            </table>

        </div>


        {{-- DATA KUIS --}}

        <div class="card">

            <h3>Data Kuis</h3>

            <table class="info-table">

                <tr>

                    <th>Judul Kuis</th>

                    <td>
                        {{ $mengerjakan->kuis->judul ?? '-' }}
                    </td>

                </tr>

                <tr>

                    <th>Kategori</th>

                    <td>

                        <span class="badge badge-purple">
                            {{ $mengerjakan->kuis->kategori ?? '-' }}
                        </span>

                    </td>

                </tr>

                <tr>

                    <th>Percobaan</th>

                    <td>
                        {{ $mengerjakan->percobaan_ke }}
                    </td>

                </tr>

                <tr>

                    <th>Nilai</th>

                    <td>

                        <strong class="score">
                            {{ $mengerjakan->nilai ?? '-' }}
                        </strong>

                    </td>

                </tr>

                <tr>

                    <th>KKM</th>

                    <td>
                        {{ $mengerjakan->kuis->kkm ?? '-' }}
                    </td>

                </tr>

                <tr>

                    <th>Kelulusan</th>

                    <td>

                        @if($mengerjakan->nilai === null)

                            -

                        @elseif(
                            $mengerjakan->kuis->kkm !== null &&
                            $mengerjakan->nilai >= $mengerjakan->kuis->kkm
                        )

                            <span class="badge badge-green">
                                Lulus
                            </span>

                        @else

                            <span class="badge badge-red">
                                Tidak Lulus
                            </span>

                        @endif

                    </td>

                </tr>

            </table>

        </div>


        {{-- KHUSUS REMEDIAL --}}

        @if($mengerjakan->kuis->kategori === 'remedial')

            <div class="card">

                <h3>Informasi Remedial</h3>

                @if($remedial && $remedial->mengerjakanAsal)

                    <table class="info-table">

                        <tr>

                            <th>Kuis Asal</th>

                            <td>
                                {{ $remedial->mengerjakanAsal->kuis->judul }}
                            </td>

                        </tr>

                        <tr>

                            <th>Nilai Sebelum Remedial</th>

                            <td>
                                {{ $remedial->mengerjakanAsal->nilai }}
                            </td>

                        </tr>

                        <tr>

                            <th>Nilai Setelah Remedial</th>

                            <td>

                                <strong class="score">
                                    {{ $mengerjakan->nilai }}
                                </strong>

                            </td>

                        </tr>

                        <tr>

                            <th>KKM</th>

                            <td>
                                {{ $mengerjakan->kuis->kkm ?? '-' }}
                            </td>

                        </tr>

                        <tr>

                            <th>Status Remedial</th>

                            <td>

                                @if(
                                    $mengerjakan->kuis->kkm !== null &&
                                    $mengerjakan->nilai >= $mengerjakan->kuis->kkm
                                )

                                    <span class="badge badge-green">
                                        Lulus setelah remedial
                                    </span>

                                @else

                                    <span class="badge badge-red">
                                        Belum lulus setelah remedial
                                    </span>

                                @endif

                            </td>

                        </tr>

                        <tr>

                            <th>Status Tugas</th>

                            <td>
                                {{ ucfirst($remedial->status) }}
                            </td>

                        </tr>

                    </table>

                @else

                    <div class="empty-info">
                        Data nilai asal remedial tidak ditemukan.
                    </div>

                @endif

            </div>

        @endif


        {{-- EVALUASI JAWABAN SISWA PER BUTIR SOAL --}}
        @if(isset($soal) && $soal->isNotEmpty())
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <h3 style="margin-bottom: 4px;">📋 Evaluasi Jawaban Siswa per Butir Soal</h3>
                        <p style="color: #777394; font-size: 13px;">Daftar butir soal, jawaban yang dipilih siswa, serta kunci jawaban sistem.</p>
                    </div>
                </div>

                <div class="eval-stats-guru">
                    <div class="eval-stat-guru-box">
                        <div class="eval-stat-guru-num" style="color: #188650;">{{ $totalBenar ?? 0 }}</div>
                        <div class="eval-stat-guru-label">Jawaban Benar</div>
                    </div>
                    <div class="eval-stat-guru-box">
                        <div class="eval-stat-guru-num" style="color: #d64545;">{{ $totalSalah ?? 0 }}</div>
                        <div class="eval-stat-guru-label">Jawaban Salah</div>
                    </div>
                    <div class="eval-stat-guru-box">
                        <div class="eval-stat-guru-num" style="color: #5b4ae3;">{{ count($soal) }}</div>
                        <div class="eval-stat-guru-label">Total Butir Soal</div>
                    </div>
                </div>

                @foreach($soal as $itemSoal)
                    @php
                        $jawabanDipilih = $draftJawaban->get($itemSoal->id_soal)?->jawaban_dipilih;
                        $kunciBenar = $itemSoal->jawaban ? strtoupper($itemSoal->jawaban) : null;
                        $isBenar = $jawabanDipilih && $kunciBenar && strtoupper($jawabanDipilih) === $kunciBenar;
                        $opsiMap = [
                            'A' => $itemSoal->opsi_a,
                            'B' => $itemSoal->opsi_b,
                            'C' => $itemSoal->opsi_c,
                            'D' => $itemSoal->opsi_d,
                            'E' => $itemSoal->opsi_e,
                        ];
                    @endphp

                    <div class="soal-guru-item {{ $isBenar ? 'benar' : 'salah' }}">
                        <div class="soal-guru-head">
                            <strong style="color: #29274a; font-size: 15px;">
                                Soal #{{ $loop->iteration }}
                                <span style="font-weight: normal; font-size: 13px; color: #777394; margin-left: 6px;">
                                    (Bobot: {{ $itemSoal->bobot ?? 0 }}%)
                                </span>
                            </strong>

                            @if($isBenar)
                                <span class="badge badge-green">
                                    ✓ Benar (+{{ $itemSoal->bobot ?? 0 }}%)
                                </span>
                            @elseif($jawabanDipilih)
                                <span class="badge badge-red">
                                    ✗ Salah (Siswa pilih: {{ strtoupper($jawabanDipilih) }})
                                </span>
                            @else
                                <span class="badge badge-yellow">
                                    ○ Tidak Dijawab
                                </span>
                            @endif
                        </div>

                        <div style="font-size: 15px; line-height: 1.5; color: #202044; margin-bottom: 12px;">
                            {{ $itemSoal->pertanyaan }}
                        </div>

                        <div class="opsi-guru-list">
                            @foreach($opsiMap as $huruf => $teksOpsi)
                                @if($teksOpsi)
                                    @php
                                        $isKunci = $kunciBenar === $huruf;
                                        $isDipilih = strtoupper($jawabanDipilih ?? '') === $huruf;
                                        $cls = '';
                                        if ($isKunci) {
                                            $cls = 'kunci';
                                        } elseif ($isDipilih && !$isBenar) {
                                            $cls = 'jawaban-salah';
                                        }
                                    @endphp

                                    <div class="opsi-guru-item {{ $cls }}">
                                        <strong>{{ $huruf }}.</strong>
                                        <span>{{ $teksOpsi }}</span>

                                        @if($isKunci && $isDipilih)
                                            <span class="opsi-guru-badge badge-green">✓ Jawaban Siswa (Benar)</span>
                                        @elseif($isKunci)
                                            <span class="opsi-guru-badge badge-green">✓ Kunci Jawaban</span>
                                        @elseif($isDipilih)
                                            <span class="opsi-guru-badge badge-red">✗ Pilihan Siswa (Salah)</span>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- VALIDASI NILAI --}}

        <div class="card validation-card">

            <h3>Validasi Nilai</h3>

            <table class="info-table">

                <tr>

                    <th>Status Validasi</th>

                    <td>

                        @if($mengerjakan->status_validasi === 'belum divalidasi')

                            <span class="validation-status status-waiting">
                                Menunggu Validasi
                            </span>

                        @elseif($mengerjakan->status_validasi === 'sudah divalidasi')

                            <span class="validation-status status-done">
                                Sudah Divalidasi
                            </span>

                        @else

                            {{ $mengerjakan->status_validasi ?? '-' }}

                        @endif

                    </td>

                </tr>

                <tr>

                    <th>Validator</th>

                    <td>
                        {{ $mengerjakan->validator->nama_lengkap ?? '-' }}
                    </td>

                </tr>

            </table>


            <div class="actions">

                <a
                    href="{{ route('guru.nilai.index') }}"
                    class="btn btn-secondary"
                >
                    ← Kembali ke Daftar Nilai
                </a>


                @if($mengerjakan->status_validasi === 'belum divalidasi')

                    <form
                        action="{{ route(
                            'guru.nilai.validasi',
                            $mengerjakan->id_mengerjakan
                        ) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PATCH')

                        <button
                            type="submit"
                            class="btn btn-success"
                        >
                            ✓ Validasi Nilai
                        </button>

                    </form>

                @else

                    <div class="already-validated">
                        ✓ Nilai sudah divalidasi.
                    </div>

                @endif

            </div>

        </div>

    </main>

</body>

</html>