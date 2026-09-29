<!DOCTYPE html>
<html>
<head>
    <title>Edit Kuis</title>
</head>
<body>

    <h1>Edit Kuis</h1>

    @if ($errors->any())
        <div style="color:red;">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <form
        action="{{ route('kuis.update', $kuis->id_kuis) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div>
            <label>Judul</label><br>

            <input
                type="text"
                name="judul"
                value="{{ old('judul', $kuis->judul) }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Deskripsi</label><br>

            <textarea name="deskripsi">{{ old('deskripsi', $kuis->deskripsi) }}</textarea>
        </div>

        <br>

        <div>
            <label>Kategori</label><br>

            <select name="kategori" id="kategori" required>

                <option value="post-test"
                    {{ $kuis->kategori === 'post-test' ? 'selected' : '' }}>
                    Post-test
                </option>

                <option value="pass-test"
                    {{ $kuis->kategori === 'pass-test' ? 'selected' : '' }}>
                    Pass-test
                </option>

                <option value="kuis harian"
                    {{ $kuis->kategori === 'kuis harian' ? 'selected' : '' }}>
                    Kuis Harian
                </option>

                <option value="ulangan"
                    {{ $kuis->kategori === 'ulangan' ? 'selected' : '' }}>
                    Ulangan
                </option>

                <option value="remedial"
                    {{ $kuis->kategori === 'remedial' ? 'selected' : '' }}>
                    Remedial
                </option>

            </select>
        </div>

        <br>

        <div id="materi-container">

            <label>Materi</label><br>

            <select name="materi[]" multiple>

                @foreach ($materis as $materi)

                    <option
                        value="{{ $materi->id_materi }}"
                        {{ in_array($materi->id_materi, $kuis->materi->pluck('id_materi')->toArray()) ? 'selected' : '' }}
                    >
                        {{ $materi->judul }}

                        @if ($materi->bab)
                            - {{ $materi->bab }}
                        @endif

                    </option>

                @endforeach

            </select>

        </div>

        <br>

        <div>
            <label>Alokasi Waktu (menit)</label><br>

            <input
                type="number"
                name="alokasi_waktu"
                value="{{ old('alokasi_waktu', $kuis->alokasi_waktu) }}"
                min="1"
            >
        </div>

        <br>

        <div>
            <label>KKM</label><br>

            <input
                type="number"
                name="kkm"
                value="{{ old('kkm', $kuis->kkm) }}"
                min="0"
                max="100"
                step="0.01"
            >
        </div>

        <br>

        <div id="waktu-container">

            <h3>Jadwal Ulangan</h3>

            <label>Waktu Mulai</label><br>

            <input
                type="datetime-local"
                name="waktu_mulai"
                value="{{ $kuis->waktu_mulai?->format('Y-m-d\TH:i') }}"
            >

            <br><br>

            <label>Waktu Selesai</label><br>

            <input
                type="datetime-local"
                name="waktu_selesai"
                value="{{ $kuis->waktu_selesai?->format('Y-m-d\TH:i') }}"
            >

        </div>

        <br>

        <button type="submit">
            Update Kuis
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
