<!DOCTYPE html>
<html>
<head>
    <title>Detail Kuis</title>
</head>
<body>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Kuis belum dapat dipublikasikan:</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>{{ $kuis->judul }}</h1>

    <p>
        <strong>ID:</strong>
        {{ $kuis->id_kuis }}
    </p>

    <p>
        <strong>Kategori:</strong>
        {{ $kuis->kategori }}
    </p>

    <p>
        <strong>Deskripsi:</strong>
        {{ $kuis->deskripsi ?? '-' }}
    </p>

    <p>
        <strong>KKM:</strong>
        {{ $kuis->kkm ?? '-' }}
    </p>

    <p>
        <strong>Alokasi waktu:</strong>
        {{ $kuis->alokasi_waktu ?? '-' }} menit
    </p>

    <p>
        <strong>Status:</strong>
        {{ $kuis->status_publikasi }}
    </p>

    @if ($kuis->kategori === 'ulangan')

        <p>
            <strong>Waktu mulai:</strong>
            {{ $kuis->waktu_mulai?->format('d-m-Y H:i') ?? '-' }}
        </p>

        <p>
            <strong>Waktu selesai:</strong>
            {{ $kuis->waktu_selesai?->format('d-m-Y H:i') ?? '-' }}
        </p>

    @endif

    <h3>Materi</h3>

    @forelse ($kuis->materi as $materi)

        <p>
            - {{ $materi->judul }}

            @if ($materi->bab)
                ({{ $materi->bab }})
            @endif
        </p>

    @empty

        <p>Tidak ada materi terkait.</p>

    @endforelse


    <h3>Soal</h3>

    <p>
    Jumlah soal: {{ $kuis->soal->count() }}
    </p>

    <a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}">
        Kelola Soal
    </a>
    @if ($kuis->soal->count() > 0)

        <ol>

            @foreach ($kuis->soal as $soal)

                <li>
                    {{ $soal->pertanyaan }}
                </li>

            @endforeach

        </ol>

    @else

        <p>Belum ada soal.</p>

    @endif

    @if ($kuis->status_publikasi === 'draft' && $kuis->is_aktif)
        @if (Auth::user()->role === 'guru')

            <form
                action="{{ route('kuis.publish', $kuis->id_kuis) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin mempublikasikan kuis ini?');"
            >
                @csrf
                @method('PATCH')

                <button type="submit" class="btn btn-success">
                    Publikasikan Kuis
                </button>
            </form>

        @endif
    @endif


    <br>

    <a href="{{ route('kuis.edit', $kuis->id_kuis) }}">
        Edit
    </a>

    |

    <a href="{{ route('kuis.index') }}">
        Kembali
    </a>

</body>
</html>
