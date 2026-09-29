<!DOCTYPE html>
<html>
<head>
    <title>Data Kuis</title>
</head>
<body>

    <h1>Data Kuis</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    @if (session('error'))
        <p style="color: red;">
            {{ session('error') }}
        </p>
    @endif

    <a href="{{ route('kuis.create') }}">
        + Tambah Kuis
    </a>

    <br><br>

    @if ($kuis->count() > 0)

        <table border="1" cellpadding="8" cellspacing="0">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Materi</th>
                    <th>KKM</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($kuis as $item)

                    <tr>
                        <td>{{ $item->id_kuis }}</td>

                        <td>
                            {{ $item->judul }}
                        </td>

                        <td>
                            {{ $item->kategori }}
                        </td>

                        <td>
                            @forelse ($item->materi as $materi)
                                {{ $materi->judul }}<br>
                            @empty
                                -
                            @endforelse
                        </td>

                        <td>
                            {{ $item->kkm ?? '-' }}
                        </td>

                        <td>
                            {{ $item->alokasi_waktu ?? '-' }} menit
                        </td>

                        <td>
                            {{ $item->status_publikasi }}
                        </td>

                        <td>

                            <a href="{{ route('kuis.show', $item->id_kuis) }}">
                                Lihat
                            </a>

                            |

                            <a href="{{ route('kuis.edit', $item->id_kuis) }}">
                                Edit
                            </a>

                            |

                            <form
                                action="{{ route('kuis.destroy', $item->id_kuis) }}"
                                method="POST"
                                style="display:inline;"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Arsipkan kuis ini?')"
                                >
                                    Arsipkan
                                </button>

                            </form>

                        </td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <p>Belum ada data kuis.</p>

    @endif

</body>
</html>
