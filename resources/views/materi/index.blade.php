<!DOCTYPE html>
<html>
<head>
    <title>Data Materi</title>
</head>
<body>

<h1>Data Materi</h1>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

<a href="{{ route('materi.create') }}">
    + Tambah Materi
</a>

<br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Bab</th>
            <th>Kelas</th>
            <th>Deskripsi</th>
            <th>Link YouTube</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($materi as $item)
            <tr>
                <td>{{ $item->id_materi }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->bab }}</td>
                <td>{{ $item->kelas }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>{{ $item->link_youtube }}</td>

                <td>
                    <a href="{{ route('materi.edit', $item->id_materi) }}">
                        Edit
                    </a>

                    <form
                        action="{{ route('materi.destroy', $item->id_materi) }}"
                        method="POST"
                        style="display: inline;"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            onclick="return confirm('Yakin ingin menghapus materi ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">
                    Belum ada data materi.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
