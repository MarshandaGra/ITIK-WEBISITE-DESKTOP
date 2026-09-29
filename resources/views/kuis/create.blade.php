<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kuis</title>
</head>
<body>

    <h1>Tambah Kuis</h1>

    @if ($errors->any())
        <div style="color: red;">
            <strong>Terdapat kesalahan:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kuis.store') }}" method="POST">

        @csrf

        <div>
            <label>Judul</label><br>

            <input
                type="text"
                name="judul"
                value="{{ old('judul') }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Deskripsi</label><br>

            <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
        </div>

        <br>

        <div>
            <label>Kategori</label><br>

            <select name="kategori" id="kategori" required>

                <option value="">
                    -- Pilih Kategori --
                </option>

                <option value="post-test">
                    Post-test
                </option>

                <option value="pass-test">
                    Pass-test
                </option>

                <option value="kuis harian">
                    Kuis Harian
                </option>

                <option value="ulangan">
                    Ulangan
                </option>

                <option value="remedial">
                    Remedial
                </option>

            </select>
        </div>

        <br>

        {{-- Materi --}}
        <div id="materi-container">

            <label>Materi</label><br>

            <select name="materi[]" multiple>

                @foreach ($materis as $materi)

                    <option value="{{ $materi->id_materi }}">
                        {{ $materi->judul }}
                        @if ($materi->bab)
                            - {{ $materi->bab }}
                        @endif
                    </option>

                @endforeach

            </select>

            <p>
                Tekan Ctrl + klik untuk memilih lebih dari satu materi.
            </p>

        </div>

        <br>

        <div>
            <label>Alokasi Waktu (menit)</label><br>

            <input
                type="number"
                name="alokasi_waktu"
                value="{{ old('alokasi_waktu') }}"
                min="1"
            >
        </div>

        <br>

        <div>
            <label>KKM</label><br>

            <input
                type="number"
                name="kkm"
                value="{{ old('kkm') }}"
                min="0"
                max="100"
                step="0.01"
            >
        </div>

        <br>

        {{-- Khusus ulangan --}}
        <div id="waktu-container" style="display:none;">

            <h3>Jadwal Ulangan</h3>

            <label>Waktu Mulai</label><br>

            <input
                type="datetime-local"
                name="waktu_mulai"
                value="{{ old('waktu_mulai') }}"
            >

            <br><br>

            <label>Waktu Selesai</label><br>

            <input
                type="datetime-local"
                name="waktu_selesai"
                value="{{ old('waktu_selesai') }}"
            >

        </div>

        <br>

        <button type="submit">
            Simpan Kuis
        </button>

        <a href="{{ route('kuis.index') }}">
            Batal
        </a>

    </form>

    <script>

        const kategori = document.getElementById('kategori');
        const materiContainer = document.getElementById('materi-container');
        const waktuContainer = document.getElementById('waktu-container');

        function updateForm() {

            if (kategori.value === 'ulangan') {

                materiContainer.style.display = 'block';
                waktuContainer.style.display = 'block';

            } else if (
                kategori.value === 'post-test' ||
                kategori.value === 'pass-test' ||
                kategori.value === 'kuis harian'
            ) {

                materiContainer.style.display = 'block';
                waktuContainer.style.display = 'none';

            } else if (kategori.value === 'remedial') {

                materiContainer.style.display = 'none';
                waktuContainer.style.display = 'none';

            } else {

                materiContainer.style.display = 'none';
                waktuContainer.style.display = 'none';

            }

        }

        kategori.addEventListener('change', updateForm);

        updateForm();

    </script>

</body>
</html>
