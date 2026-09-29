<h1>Tambah Soal</h1>

<h2>{{ $kuis->judul }}</h2>

<form
    action="{{ route('kuis.soal.store', $kuis->id_kuis) }}"
    method="POST"
>

    @csrf

    <div>
        <label>Pertanyaan</label>
        <br>

        <textarea
            name="pertanyaan"
            rows="5"
            cols="60"
            required
        >{{ old('pertanyaan') }}</textarea>
    </div>

    <br>

    <div>
        <label>Opsi A</label>
        <br>

        <input
            type="text"
            name="opsi_a"
            value="{{ old('opsi_a') }}"
        >
    </div>

    <br>

    <div>
        <label>Opsi B</label>
        <br>

        <input
            type="text"
            name="opsi_b"
            value="{{ old('opsi_b') }}"
        >
    </div>

    <br>

    <div>
        <label>Opsi C</label>
        <br>

        <input
            type="text"
            name="opsi_c"
            value="{{ old('opsi_c') }}"
        >
    </div>

    <br>

    <div>
        <label>Opsi D</label>
        <br>

        <input
            type="text"
            name="opsi_d"
            value="{{ old('opsi_d') }}"
        >
    </div>

    <br>

    <div>
        <label>Opsi E</label>
        <br>

        <input
            type="text"
            name="opsi_e"
            value="{{ old('opsi_e') }}"
        >
    </div>

    <br>

    <div>
        <label>Jawaban Benar</label>
        <br>

        <select name="jawaban">

            <option value="">-- Pilih Jawaban --</option>

            <option value="A" {{ old('jawaban') == 'A' ? 'selected' : '' }}>
                A
            </option>

            <option value="B" {{ old('jawaban') == 'B' ? 'selected' : '' }}>
                B
            </option>

            <option value="C" {{ old('jawaban') == 'C' ? 'selected' : '' }}>
                C
            </option>

            <option value="D" {{ old('jawaban') == 'D' ? 'selected' : '' }}>
                D
            </option>

            <option value="E" {{ old('jawaban') == 'E' ? 'selected' : '' }}>
                E
            </option>

        </select>
    </div>

    <br>

    <div>
        <label>Tingkat Kesulitan</label>
        <br>

        <select name="tingkat_kesulitan">

            <option value="">
                -- Pilih Tingkat Kesulitan --
            </option>

            <option value="mudah">
                Mudah
            </option>

            <option value="sedang">
                Sedang
            </option>

            <option value="sulit">
                Sulit
            </option>

        </select>
    </div>

    <br>

    <button type="submit">
        Simpan Soal
    </button>

</form>

<br>

<a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}">
    ← Kembali ke Daftar Soal
</a>
