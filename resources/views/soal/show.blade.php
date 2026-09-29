<h1>Detail Soal</h1>

<h2>{{ $kuis->judul }}</h2>

<hr>

<p>
    <strong>Pertanyaan:</strong>
</p>

<p>
    {{ $soal->pertanyaan }}
</p>

<hr>

<p>
    <strong>Pilihan Jawaban:</strong>
</p>

<p>
    A. {{ $soal->opsi_a }}
</p>

<p>
    B. {{ $soal->opsi_b }}
</p>

<p>
    C. {{ $soal->opsi_c }}
</p>

<p>
    D. {{ $soal->opsi_d }}
</p>

@if ($soal->opsi_e)

    <p>
        E. {{ $soal->opsi_e }}
    </p>

@endif

<hr>

<p>
    <strong>Jawaban Benar:</strong>
    {{ $soal->jawaban }}
</p>

<p>
    <strong>Tingkat Kesulitan:</strong>
    {{ $soal->tingkat_kesulitan ?? '-' }}
</p>

<hr>

<a href="{{ route('kuis.soal.edit', [$kuis->id_kuis, $soal->id_soal]) }}">
    Edit Soal
</a>

<br><br>

<a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}">
    ← Kembali ke Daftar Soal
</a>
