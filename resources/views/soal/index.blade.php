<h1>Daftar Soal</h1>

<h2>{{ $kuis->judul }}</h2>

<p>
    Kategori: {{ $kuis->kategori }}
</p>

<p>
    Jumlah soal: {{ $soal->count() }}
</p>

<hr>

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

<a href="{{ route('kuis.soal.create', $kuis->id_kuis) }}">
    + Tambah Soal
</a>

<br><br>

<a href="{{ route('kuis.show', $kuis->id_kuis) }}">
    ← Kembali ke Kuis
</a>

<hr>

@if ($soal->count() > 0)

    <ol>

        @foreach ($soal as $item)

            <li>

                <p>
                    <strong>
                        {{ $item->pertanyaan }}
                    </strong>
                </p>

                <p>
                    A. {{ $item->opsi_a }}
                </p>

                <p>
                    B. {{ $item->opsi_b }}
                </p>

                <p>
                    C. {{ $item->opsi_c }}
                </p>

                <p>
                    D. {{ $item->opsi_d }}
                </p>

                @if ($item->opsi_e)
                    <p>
                        E. {{ $item->opsi_e }}
                    </p>
                @endif

                <p>
                    Jawaban: {{ $item->jawaban }}
                </p>

                <p>
                    Tingkat Kesulitan:
                    {{ $item->tingkat_kesulitan ?? '-' }}
                </p>

                <a href="{{ route('kuis.soal.show', [$kuis->id_kuis, $item->id_soal]) }}">
                    Lihat
                </a>

                |

                <a href="{{ route('kuis.soal.edit', [$kuis->id_kuis, $item->id_soal]) }}">
                    Edit
                </a>

                |

                <form
                    action="{{ route('kuis.soal.destroy', [$kuis->id_kuis, $item->id_soal]) }}"
                    method="POST"
                    style="display: inline;"
                >

                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Hapus
                    </button>

                </form>

            </li>

            <hr>

        @endforeach

    </ol>

@else

    <p>Belum ada soal untuk kuis ini.</p>

@endif
