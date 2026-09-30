<h1>Validasi Nilai Siswa</h1>

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

@if($hasil->isEmpty())

    <p>Belum ada hasil kuis siswa.</p>

@else

<table border="1" cellpadding="10" cellspacing="0">

    <thead>
        <tr>
            <th>No</th>
            <th>Siswa</th>
            <th>Kuis</th>
            <th>Kategori</th>
            <th>Percobaan</th>
            <th>Nilai</th>
            <th>KKM</th>
            <th>Kelulusan</th>
            <th>Validasi</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        @foreach($hasil as $item)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->siswa->nama_lengkap ?? '-' }}
                </td>

                <td>
                    {{ $item->kuis->judul ?? '-' }}
                </td>

                <td>

                    @if($item->kuis->kategori === 'remedial')

                        <strong>Remedial</strong>

                    @else

                        {{ $item->kuis->kategori ?? '-' }}

                    @endif

                </td>

                <td>
                    {{ $item->percobaan_ke }}
                </td>

                <td>
                    <strong>
                        {{ $item->nilai ?? '-' }}
                    </strong>
                </td>

                <td>
                    {{ $item->kuis->kkm ?? '-' }}
                </td>

                <td>

                    @if($item->nilai === null)

                        -

                    @elseif(
                        $item->kuis->kkm !== null &&
                        $item->nilai >= $item->kuis->kkm
                    )

                        Lulus

                    @else

                        Tidak Lulus

                    @endif

                </td>

                <td>

                    @if($item->status_validasi === 'belum divalidasi')

                        <strong style="color: orange;">
                            Menunggu Validasi
                        </strong>

                    @elseif($item->status_validasi === 'sudah divalidasi')

                        <strong style="color: green;">
                            Sudah Divalidasi
                        </strong>

                    @else

                        {{ $item->status_validasi ?? '-' }}

                    @endif

                </td>

                <td>
                    {{ $item->tanggal ?? '-' }}
                </td>

                <td>

                    <a href="{{ route(
                        'guru.nilai.show',
                        $item->id_mengerjakan
                    ) }}">
                        Lihat Detail
                    </a>

                </td>

            </tr>

        @endforeach

    </tbody>

</table>

@endif
