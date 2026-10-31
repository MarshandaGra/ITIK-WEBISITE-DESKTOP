<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Kuis - ITIK</title>

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

        .back-link {
            display: inline-block;
            text-decoration: none;
            color: #5d4be4;
            font-size: 15px;
            margin-bottom: 12px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .title h1 {
            font-size: 34px;
            margin-bottom: 5px;
        }

        .title p {
            color: #777394;
            font-size: 17px;
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

        /* LAYOUT HALAMAN */

        .columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            align-items: start;
        }

        .stack {
            display: grid;
            gap: 25px;
        }

        .section-card {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 4px 18px rgba(70,60,130,.06);
        }

        .section-header {
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 22px;
        }

        .section-header p {
            color: #777394;
            margin-top: 5px;
        }

        /* NILAI */

        .score-card {
            text-align: center;
            padding: 40px 30px;
        }

        .score-label {
            color: #777394;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .score-number {
            font-size: 84px;
            font-weight: bold;
            line-height: 1;
            color: #5d4be4;
            margin-bottom: 22px;
        }

        .score-number.gagal {
            color: #d93636;
        }

        .score-kkm {
            color: #777394;
            margin-top: 18px;
            font-size: 15px;
        }

        /* BADGE */

        .badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            white-space: nowrap;
            background: #e7f8ec;
            color: #20a653;
            font-weight: bold;
        }

        .badge.gagal {
            background: #fde8e8;
            color: #d93636;
        }

        .badge.kategori {
            background: #eeeaff;
            color: #5d4be4;
            font-weight: normal;
            padding: 7px 13px;
            font-size: 13px;
        }

        /* INFO */

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 16px 0;
            border-bottom: 1px solid #eeeef5;
        }

        .info-item:first-of-type {
            padding-top: 0;
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            color: #777394;
            font-size: 15px;
        }

        .info-value {
            font-size: 17px;
            text-align: right;
        }

        .info-value.strong {
            font-weight: bold;
        }

        /* REMEDIAL */

        .remedial-compare {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .compare-box {
            background: #f5f4fc;
            border-radius: 18px;
            padding: 20px;
            text-align: center;
        }

        .compare-box.after {
            background: #eeeaff;
        }

        .compare-number {
            font-size: 38px;
            font-weight: bold;
        }

        .compare-label {
            color: #777394;
            font-size: 14px;
            margin-top: 5px;
        }

        .remedial-result {
            padding: 16px 18px;
            border-radius: 16px;
            font-weight: bold;
            text-align: center;
            background: #e7f8ec;
            color: #20a653;
        }

        .remedial-result.gagal {
            background: #fff0d4;
            color: #d68a00;
        }

        /* BUTTON */

        .actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            background: #6553e8;
            color: white;
            padding: 14px 22px;
            border-radius: 14px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #5948dd;
        }

        .btn-ulang {
            background: #e67e22;
        }

        .btn-ulang:hover {
            background: #d35400;
        }

        .btn.outline {
            background: white;
            color: #5d4be4;
            border: 1px solid #ddd9f8;
            font-weight: normal;
        }

        .btn.outline:hover {
            background: #f5f3ff;
        }

        /* EVALUASI SOAL */
        .evaluasi-wrapper {
            margin-top: 35px;
        }

        .eval-stats {
            display: flex;
            gap: 15px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .eval-stat-box {
            flex: 1;
            min-width: 140px;
            background: #f8f7fd;
            border-radius: 16px;
            padding: 15px;
            text-align: center;
        }

        .eval-stat-num {
            font-size: 26px;
            font-weight: bold;
        }

        .eval-stat-label {
            font-size: 13px;
            color: #777394;
            margin-top: 4px;
        }

        .soal-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            margin-top: 18px;
            box-shadow: 0 4px 16px rgba(70,60,130,.05);
            border: 1px solid #eeeef5;
        }

        .soal-card.benar {
            border-left: 5px solid #20a653;
        }

        .soal-card.salah {
            border-left: 5px solid #d93636;
        }

        .soal-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        .soal-card-title {
            font-size: 16px;
            font-weight: bold;
            color: #4a3eb3;
        }

        .soal-status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .soal-status-badge.benar {
            background: #e7f8ec;
            color: #20a653;
        }

        .soal-status-badge.salah {
            background: #fde8e8;
            color: #d93636;
        }

        .soal-pertanyaan {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 18px;
            color: #202044;
        }

        .opsi-review-list {
            display: grid;
            gap: 10px;
        }

        .opsi-review-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            background: #fbfbfe;
            border: 1px solid #eeeef6;
            font-size: 15px;
            line-height: 1.4;
        }

        .opsi-review-item.kunci {
            background: #eafaf1;
            border-color: #a3e9c0;
            color: #155724;
            font-weight: 600;
        }

        .opsi-review-item.jawaban-salah {
            background: #fdf2f2;
            border-color: #f5b7b7;
            color: #9b1c1c;
        }

        .opsi-label {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #eae8fc;
            color: #5d4be4;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 13px;
            flex-shrink: 0;
        }

        .opsi-review-item.kunci .opsi-label {
            background: #20a653;
            color: white;
        }

        .opsi-review-item.jawaban-salah .opsi-label {
            background: #d93636;
            color: white;
        }

        .opsi-status-text {
            margin-left: auto;
            font-size: 12px;
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 8px;
            white-space: nowrap;
        }

        .opsi-status-text.kunci {
            background: #20a653;
            color: white;
        }

        .opsi-status-text.jawaban-kamu {
            background: #d93636;
            color: white;
        }

        a:focus-visible {
            outline: 3px solid #b9aefc;
            outline-offset: 2px;
        }

        @media(max-width: 1100px) {
            .columns {
                grid-template-columns: 1fr;
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

            .title h1 {
                font-size: 28px;
            }

            .section-card {
                padding: 22px;
            }

            .score-number {
                font-size: 64px;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

@php
    $lulus = $hasil->nilai !== null
        && $kuis->kkm !== null
        && $hasil->nilai >= $kuis->kkm;
@endphp

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
                <a href="{{ route('siswa.kuis.index') }}" class="back-link">
                    ← Kembali ke daftar kuis
                </a>

                <h1>Hasil Kuis</h1>
                <p>{{ $kuis->judul }}</p>
            </div>

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


        <!-- NOTIFIKASI -->

        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif


        <div class="columns">

            <!-- KIRI: NILAI -->

            <div class="section-card score-card">

                <div class="score-label">Nilai kamu</div>

                <div class="score-number {{ $lulus ? '' : 'gagal' }}">
                    {{ $hasil->nilai }}
                </div>

                @if($lulus)
                    <span class="badge">Lulus</span>
                @else
                    <span class="badge gagal">Tidak Lulus</span>
                @endif

                <div class="score-kkm">
                    KKM: {{ $kuis->kkm ?? '-' }}
                </div>

                <div class="eval-stats" style="margin-top: 25px; text-align: center;">
                    <div class="eval-stat-box">
                        <div class="eval-stat-num" style="color: #20a653;">{{ $totalBenar ?? 0 }}</div>
                        <div class="eval-stat-label">Jawaban Benar</div>
                    </div>
                    <div class="eval-stat-box">
                        <div class="eval-stat-num" style="color: #d93636;">{{ $totalSalah ?? 0 }}</div>
                        <div class="eval-stat-label">Jawaban Salah</div>
                    </div>
                    <div class="eval-stat-box">
                        <div class="eval-stat-num" style="color: #5d4be4;">{{ count($soal ?? []) }}</div>
                        <div class="eval-stat-label">Total Soal</div>
                    </div>
                </div>

            </div>


            <!-- KANAN: DETAIL -->

            <div class="stack">

                <div class="section-card">

                    <div class="section-header">
                        <h2>Detail Kuis</h2>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Judul</div>
                        <div class="info-value strong">{{ $kuis->judul }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Kategori</div>
                        <div class="info-value">
                            <span class="badge kategori">{{ $kuis->kategori }}</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Nilai</div>
                        <div class="info-value strong">{{ $hasil->nilai }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">KKM</div>
                        <div class="info-value">{{ $kuis->kkm ?? '-' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Status</div>
                        <div class="info-value">
                            @if($lulus)
                                <span class="badge">Lulus</span>
                            @else
                                <span class="badge gagal">Tidak Lulus</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Percobaan</div>
                        <div class="info-value">ke-{{ $hasil->percobaan_ke }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Waktu Pengerjaan</div>
                        <div class="info-value">{{ $durasiTampil ?? 'Belum tercatat' }}</div>
                    </div>

                </div>


                @if($kuis->kategori === 'remedial' && $remedial)

                    <div class="section-card">

                        <div class="section-header">
                            <h2>Hasil Remedial</h2>
                            <p>Perbandingan nilai sebelum dan sesudah remedial</p>
                        </div>

                        <div class="remedial-compare">

                            <div class="compare-box">
                                <div class="compare-number">{{ $nilaiAsal ?? '-' }}</div>
                                <div class="compare-label">Nilai sebelum remedial</div>
                            </div>

                            <div class="compare-box after">
                                <div class="compare-number">{{ $hasil->nilai }}</div>
                                <div class="compare-label">Nilai remedial</div>
                            </div>

                        </div>

                        <div class="info-item">
                            <div class="info-label">KKM</div>
                            <div class="info-value">{{ $kuis->kkm ?? '-' }}</div>
                        </div>

                        <div class="remedial-result {{ $lulus ? '' : 'gagal' }}" style="margin-top: 20px;">
                            @if($lulus)
                                Lulus setelah remedial
                            @else
                                Belum Lulus setelah remedial
                            @endif
                        </div>

                    </div>

                @endif

            </div>

        </div>

        @php
            $katKuis = strtolower(trim($kuis->kategori ?? ''));
            $bolehUlang = in_array($katKuis, ['kuis harian', 'pre-test', 'pass-test']);
        @endphp

        <!-- EVALUASI SOAL BENAR & SALAH -->
        @if(isset($soal) && $soal->isNotEmpty())
            <div class="evaluasi-wrapper">
                <div class="section-card">
                    <div class="section-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                        <div>
                            <h2>📋 Evaluasi Soal (Benar &amp; Salah)</h2>
                            <p>Pelajari butir soal untuk mengevaluasi pemahaman materi Anda.</p>
                        </div>
                        <div style="font-size: 14px; color: #777394;">
                            Total {{ count($soal) }} Butir Soal
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

                        <div class="soal-card {{ $isBenar ? 'benar' : 'salah' }}">
                            <div class="soal-card-header">
                                <div class="soal-card-title">
                                    Soal #{{ $loop->iteration }}
                                    <span style="font-size: 13px; font-weight: normal; color: #777394; margin-left: 8px;">
                                        (Bobot: {{ $itemSoal->bobot ?? 0 }}%)
                                    </span>
                                </div>

                                @if($isBenar)
                                    <span class="soal-status-badge benar">
                                        ✓ Jawaban Benar (+{{ $itemSoal->bobot ?? 0 }}%)
                                    </span>
                                @elseif($jawabanDipilih)
                                    <span class="soal-status-badge salah">
                                        ✗ Jawaban Salah (Kamu pilih: {{ strtoupper($jawabanDipilih) }})
                                    </span>
                                @else
                                    <span class="soal-status-badge salah">
                                        ○ Tidak Dijawab
                                    </span>
                                @endif
                            </div>

                            <div class="soal-pertanyaan">
                                {{ $itemSoal->pertanyaan }}
                            </div>

                            <div class="opsi-review-list">
                                @foreach($opsiMap as $huruf => $teksOpsi)
                                    @if($teksOpsi)
                                        @php
                                            $isKunci = $kunciBenar === $huruf;
                                            $isDipilihSiswa = strtoupper($jawabanDipilih ?? '') === $huruf;
                                            $itemClass = '';
                                            if ($isKunci) {
                                                $itemClass = 'kunci';
                                            } elseif ($isDipilihSiswa && !$isBenar) {
                                                $itemClass = 'jawaban-salah';
                                            }
                                        @endphp

                                        <div class="opsi-review-item {{ $itemClass }}">
                                            <div class="opsi-label">{{ $huruf }}</div>
                                            <div class="opsi-teks">{{ $teksOpsi }}</div>

                                            @if($isKunci && $isDipilihSiswa)
                                                <span class="opsi-status-text kunci">✓ Pilihan Kamu (Benar)</span>
                                            @elseif($isKunci)
                                                <span class="opsi-status-text kunci">✓ Kunci Jawaban</span>
                                            @elseif($isDipilihSiswa)
                                                <span class="opsi-status-text jawaban-kamu">✗ Pilihan Kamu (Salah)</span>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="actions">

            @if(!$lulus && $bolehUlang)
                <a href="{{ route('siswa.kuis.mulai', $kuis->id_kuis) }}" class="btn btn-ulang">
                    ↻ Kerjakan Ulang Kuis Sekarang
                </a>
            @elseif(!$lulus && $katKuis === 'ulangan')
                <a href="{{ route('siswa.remedial.index') }}" class="btn">
                    Lihat Tugas Remedial
                </a>
            @endif

            <a href="{{ route('siswa.kuis.index') }}" class="btn outline">
                ← Kembali ke Daftar Kuis
            </a>

        </div>

    </main>

</div>

</body>
</html>