<h1>Detail Nilai Siswa</h1>

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


<h3>Data Siswa</h3>

<table border="1" cellpadding="8" cellspacing="0">

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


<br>


<h3>Data Kuis</h3>

<table border="1" cellpadding="8" cellspacing="0">

    <tr>
        <th>Judul Kuis</th>
        <td>
            {{ $mengerjakan->kuis->judul ?? '-' }}
        </td>
    </tr>

    <tr>
        <th>Kategori</th>
        <td>
            {{ $mengerjakan->kuis->kategori ?? '-' }}
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
            <strong>
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

                <strong style="color: green;">
                    Lulus
                </strong>

            @else

                <strong style="color: red;">
                    Tidak Lulus
                </strong>

            @endif

        </td>
    </tr>

</table>


{{-- KHUSUS REMEDIAL --}}

@if($mengerjakan->kuis->kategori === 'remedial')

    <br>

    <h3>Informasi Remedial</h3>

    @if($remedial && $remedial->mengerjakanAsal)

        <table border="1" cellpadding="10" cellspacing="0">

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
                    <strong>{{ $mengerjakan->nilai }}</strong>
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
                        <strong>Lulus setelah remedial</strong>
                    @else
                        <strong>Belum lulus setelah remedial</strong>
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

        <p>Data nilai asal remedial tidak ditemukan.</p>

    @endif

@endif


<br>


<h3>Validasi Nilai</h3>

<table border="1" cellpadding="8" cellspacing="0">

    <tr>
        <th>Status Validasi</th>

        <td>
            {{ $mengerjakan->status_validasi ?? '-' }}
        </td>
    </tr>

    <tr>
        <th>Validator</th>

        <td>
            {{ $mengerjakan->validator->nama_lengkap ?? '-' }}
        </td>
    </tr>

</table>


<br>


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

        <button type="submit">
            Validasi Nilai
        </button>

    </form>

@else

    <p>
        <strong>
            Nilai sudah divalidasi.
        </strong>
    </p>

@endif


<br>

<a href="{{ route('guru.nilai.index') }}">
    ← Kembali ke Daftar Nilai
</a>
