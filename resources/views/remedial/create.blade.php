<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buat Kuis Remedial - ITIK</title>

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

        .card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 6px 20px rgba(0,0,0,.05);
            max-width: 760px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 15px;
            color: #2c2a4a;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 13px 16px;
            border: 2px solid #e2e0f0;
            border-radius: 12px;
            font-size: 15px;
            background: #faf9ff;
            color: #202044;
            transition: all .2s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #6553e8;
            background: white;
            box-shadow: 0 0 0 3px rgba(101,83,232,.12);
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .hint {
            font-size: 13px;
            color: #777394;
            margin-top: 6px;
        }

        .btn-submit {
            background: #6553e8;
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-submit:hover {
            background: #5240d4;
            transform: translateY(-2px);
        }

        .btn-cancel {
            display: inline-block;
            text-decoration: none;
            background: #edeafc;
            color: #6553e8;
            padding: 14px 24px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            margin-left: 12px;
        }

        .btn-cancel:hover {
            background: #e2ddf8;
        }

        .alert-error {
            background: #fde8e8;
            color: #9b1c1c;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 22px;
            font-size: 14px;
        }

        .alert-info {
            background: #eef2ff;
            color: #3730a3;
            border-left: 4px solid #6366f1;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 22px;
            font-size: 14px;
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
                <h1>Buat Kuis Remedial</h1>
                <p>Siapkan kuis remedial untuk siswa yang nilainya di bawah KKM pada Ulangan</p>
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

        @if($errors->any())
            <div class="alert-error">
                <strong>Terdapat kesalahan:</strong>
                <ul style="margin-left: 20px; margin-top: 5px;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="alert-info">
            💡 <strong>Ketentuan Remedial:</strong> Sesuai kebijakan sekolah, kuis remedial hanya dapat dibuat untuk kuis dengan kategori <strong>Ulangan</strong>. Siswa yang nilainya &lt; KKM pada kuis ulangan yang dipilih akan dapat diberikan tugas kuis remedial ini.
        </div>

        <div class="card">

            <form action="{{ route('guru.remedial.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="id_kuis_asal">Pilih Kuis Ulangan (Kuis Asal) *</label>
                    <select name="id_kuis_asal" id="id_kuis_asal" required>
                        <option value="">-- Pilih Kuis Ulangan --</option>
                        @foreach($kuisAsal as $ka)
                            <option value="{{ $ka->id_kuis }}" {{ old('id_kuis_asal') == $ka->id_kuis ? 'selected' : '' }}>
                                [{{ $ka->id_kuis }}] {{ $ka->judul }} &nbsp;—&nbsp; KKM: {{ $ka->kkm }} &nbsp;(Mapel: {{ $ka->mapel->nama_mapel ?? '-' }})
                            </option>
                        @endforeach
                    </select>
                    <div class="hint">Hanya menampilkan kuis aktif berstatus terbit dengan kategori Ulangan.</div>
                </div>

                <div class="form-group">
                    <label for="judul">Judul Kuis Remedial *</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="Contoh: Remedial Ulangan Harian 1 - Dasar Jaringan" required maxlength="150">
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label for="kkm">Nilai KKM *</label>
                        <input type="number" step="0.01" name="kkm" id="kkm" value="{{ old('kkm', '75.00') }}" required min="0" max="100">
                        <div class="hint">Batas kelulusan remedial</div>
                    </div>

                    <div class="form-group">
                        <label for="alokasi_waktu">Alokasi Waktu (Menit) *</label>
                        <input type="number" name="alokasi_waktu" id="alokasi_waktu" value="{{ old('alokasi_waktu', 20) }}" required min="1" max="300">
                        <div class="hint">Durasi pengerjaan siswa</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi / Petunjuk Remedial</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" placeholder="Petunjuk pengerjaan remedial untuk siswa...">{{ old('deskripsi') }}</textarea>
                </div>

                <div style="margin-top: 30px; display: flex; align-items: center;">
                    <button type="submit" class="btn-submit">
                        Simpan Kuis Remedial
                    </button>
                    <a href="{{ route('guru.remedial.index') }}" class="btn-cancel">
                        Batal
                    </a>
                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>
