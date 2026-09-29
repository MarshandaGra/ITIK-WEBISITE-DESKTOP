<!DOCTYPE html>
<html>
<head>
    <title>Tambah Materi</title>
</head>
<body>

<h1>Tambah Materi</h1>

@if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('materi.store') }}" method="POST">

    @csrf

    <label>Judul</label><br>
    <input type="text" name="judul" value="{{ old('judul') }}">
    <br><br>

    <label>Bab</label><br>
    <input type="text" name="bab" value="{{ old('bab') }}">
    <br><br>

    <label>Kelas</label><br>
    <input type="text" name="kelas" value="{{ old('kelas') }}">
    <br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
    <br><br>

    <label>Isi Materi / Path PDF</label><br>
    <input type="text" name="isi_materi" value="{{ old('isi_materi') }}">
    <br><br>

    <label>Link YouTube</label><br>
    <input type="url" name="link_youtube" value="{{ old('link_youtube') }}">
    <br><br>

    <button type="submit">
        Simpan
    </button>

</form>

<br>

<a href="{{ route('materi.index') }}">
    Kembali
</a>

</body>
</html>
