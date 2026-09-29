<h1>Edit Soal</h1>

<h2>{{ $kuis->judul }}</h2>

<form
    action="{{ route('kuis.soal.update', [$kuis->id_kuis, $soal->id_soal]) }}"
    method="POST"
>

    @csrf
    @method('PUT')

    <div>
        <label>Pertanyaan</label>
        <br>

        <textarea
            name="pertanyaan"
            rows="5"
            cols="60"
            required
        >{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
    </div>

    <br>

    <div>
        <label>Opsi A</label>
        <br>

        <input
            type="text"
            name="opsi_a"
            value="{{ old('opsi_a', $soal->opsi_a) }}"
        >
    </div>

    <br>

    <div>
        <label>Opsi B</label>
        <br>

        <input
            type="text"
            name="opsi_b"
            value="{{ old('opsi_b', $soal->opsi_b) }}"
        >
    </div>

    <br>

    <div>
        <label>Opsi C</label>
        <br>

        <input
            type="text"
            name="opsi_c"
            value="{{ old('opsi_c', $soal->opsi_c) }}"
        >
    </div>

    <br>

    <div>
        <label>Opsi D</label>
        <br>

        <input
            type="text"
            name="opsi_d"
            value="{{ old('opsi_d', $soal->opsi_d) }}"
        >
    </div>

    <br>

    <div>
        <label>Opsi E</label>
        <br>

        <input
            type="text"
            name="opsi_e"
            value="{{ old('opsi_e', $soal->opsi_e) }}"
        >
    </div>

    <br>

    <div>
        <label>Jawaban Benar</label>
        <br>

        <select name="jawaban">

            <option value="">-- Pilih Jawaban --</option>

            <option value="A"
                {{ old('jawaban', $soal->jawaban) == 'A' ? 'selected' : '' }}>
                A
            </option>

            <option value="B"
                {{ old('jawaban', $soal->jawaban) == 'B' ? 'selected' : '' }}>
                B
            </option>

            <option value="C"
                {{ old('jawaban', $soal->jawaban) == 'C' ? 'selected' : '' }}>
                C
            </option>

            <option value="D"
                {{ old('jawaban', $soal->jawaban) == 'D' ? 'selected' : '' }}>
                D
            </option>

            <option value="E"
                {{ old('jawaban', $soal->jawaban) == 'E' ? 'selected' : '' }}>
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

            <option value="mudah"
                {{ old('tingkat_kesulitan', $soal->tingkat_kesulitan) == 'mudah' ? 'selected' : '' }}>
                Mudah
            </option>

            <option value="sedang"
                {{ old('tingkat_kesulitan', $soal->tingkat_kesulitan) == 'sedang' ? 'selected' : '' }}>
                Sedang
            </option>

            <option value="sulit"
                {{ old('tingkat_kesulitan', $soal->tingkat_kesulitan) == 'sulit' ? 'selected' : '' }}>
                Sulit
            </option>

        </select>
    </div>

    <br>

    <button type="submit">
        Update Soal
    </button>

</form>

<br>

<a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}">
    ← Kembali ke Daftar Soal
</a>
