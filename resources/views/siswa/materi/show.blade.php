<h1>{{ $materi->judul }}</h1>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

@if(session('error'))
    <p style="color: red;">
        {{ session('error') }}
    </p>
@endif

<h3>Informasi Materi</h3>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Judul</th>
        <td>{{ $materi->judul }}</td>
    </tr>

    <tr>
        <th>Bab</th>
        <td>{{ $materi->bab ?? '-' }}</td>
    </tr>

    <tr>
        <th>Kelas</th>
        <td>{{ $materi->kelas ?? '-' }}</td>
    </tr>

    <tr>
        <th>Deskripsi</th>
        <td>{{ $materi->deskripsi ?? '-' }}</td>
    </tr>

    <tr>
        <th>Status Progress</th>
        <td>
            @if($progress->status === 'selesai')
                <strong style="color: green;">Selesai</strong>
            @else
                <strong style="color: orange;">Sedang Belajar</strong>
            @endif
        </td>
    </tr>
</table>

<br>

<h3>Isi Materi</h3>

@if($pdfUrl)
    <iframe
        src="{{ $pdfUrl }}#toolbar=1"
        style="
            width: 100%;
            height: 70vh;
            min-height: 500px;
            border: 1px solid #ddd;
            border-radius: 8px;
        "
    ></iframe>

    <p>
        <a href="{{ $pdfUrl }}" target="_blank">
            Buka PDF di tab baru ↗
        </a>
    </p>
@elseif($materi->isi_materi)
    <p>{{ $materi->isi_materi }}</p>
@else
    <p>File materi belum tersedia.</p>
@endif

@if($materi->link_youtube)
    <h3>Video Pembelajaran</h3>
    <p>
        <a href="{{ $materi->link_youtube }}" target="_blank">
            Tonton Video Pembelajaran
        </a>
    </p>
@endif

<br>

@if($progress->status !== 'selesai')
    <form
        action="{{ route('siswa.materi.selesai', $materi->id_materi) }}"
        method="POST"
    >
        @csrf
        <button type="submit">
            ✓ Tandai Sudah Selesai Membaca
        </button>
    </form>
@else
    <p>
        <strong style="color: green;">
            ✓ Materi sudah selesai dipelajari.
        </strong>
    </p>
@endif

<br>

<a href="{{ route('siswa.materi.index') }}">
    ← Kembali ke Daftar Materi
</a>

