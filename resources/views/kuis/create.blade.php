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

                <option value="" {{ old('kategori') ? '' : 'selected' }}>
                    -- Pilih Kategori --
                </option>

                <option value="post-test" {{ old('kategori') === 'post-test' ? 'selected' : '' }}>
                    Post-test
                </option>

                <option value="pass-test" {{ old('kategori') === 'pass-test' ? 'selected' : '' }}>
                    Pass-test
                </option>

                <option value="kuis harian" {{ old('kategori') === 'kuis harian' ? 'selected' : '' }}>
                    Kuis Harian
                </option>

                <option value="ulangan" {{ old('kategori') === 'ulangan' ? 'selected' : '' }}>
                    Ulangan
                </option>

                <option value="remedial" {{ old('kategori') === 'remedial' ? 'selected' : '' }}>
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

                        <option
                            value="{{ $materi->id_materi }}"
                            {{ in_array($materi->id_materi, old('materi', [])) ? 'selected' : '' }}
                        >
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

            {{-- Alokasi waktu --}}
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

            {{-- KKM --}}
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
            <div id="waktu-container" style="display: none;">

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

            {{-- Khusus remedial --}}
            <div id="field-remedial" style="display: none;">

                <label>Kuis Asal</label><br>

                <select name="id_kuis_asal">

                    <option value="">
                        -- Pilih Kuis Asal --
                    </option>

                    @foreach($kuisAsal as $item)

                        <option
                            value="{{ $item->id_kuis }}"
                            {{ old('id_kuis_asal') == $item->id_kuis ? 'selected' : '' }}
                        >
                            {{ $item->judul }}
                            ({{ $item->kategori }})
                        </option>

                    @endforeach

                </select>

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

    // Mengatur tampilan field form sesuai kategori kuis yang dipilih.
    const kategori = document.getElementById('kategori');
    const materiContainer = document.getElementById('materi-container');
    const waktuContainer = document.getElementById('waktu-container');
    const remedialContainer = document.getElementById('field-remedial');

    function updateForm() {

        const value = kategori.value;

        // Default
        materiContainer.style.display = 'none';
        waktuContainer.style.display = 'none';
        remedialContainer.style.display = 'none';

        // Post-test, pass-test, kuis harian
        if (
            value === 'post-test' ||
            value === 'pass-test' ||
            value === 'kuis harian'
        ) {

            materiContainer.style.display = 'block';

        }

        // Ulangan
        else if (value === 'ulangan') {

            materiContainer.style.display = 'block';
            waktuContainer.style.display = 'block';

        }

        // Remedial
        else if (value === 'remedial') {

            remedialContainer.style.display = 'block';

        }

    }

    kategori.addEventListener('change', updateForm);

    updateForm();

</script>

</body>
</html>
