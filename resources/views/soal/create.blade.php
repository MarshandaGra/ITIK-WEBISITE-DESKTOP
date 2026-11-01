@extends('layouts.guru')
@section('title', 'Tambah Soal - ' . $kuis->judul)

@push('styles')
<style>
    .options-entry {
        background: #fbfafd;
        border: 1px dashed #d0c8ed;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .option-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }
    .option-tag {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #5542dc;
        color: white;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}" class="muted small" style="display:inline-block; margin-bottom:6px;">
            ← Kembali ke daftar soal
        </a>
        <h1>Tambah Butir Soal</h1>
        <p>Kuis: <strong>{{ $kuis->judul }}</strong> &bull; Kategori: {{ ucfirst($kuis->kategori) }}</p>
    </div>
</div>

<section class="card form-card">
    <div class="card-header">
        <div>
            <h2>Formulir Butir Soal Pilihan Ganda</h2>
            <p class="muted">Tanda bintang (<span style="color:#a52a3b;">*</span>) menandakan kolom wajib diisi.</p>
        </div>
    </div>

    <form action="{{ route('kuis.soal.store', $kuis->id_kuis) }}" method="POST">
        @csrf

        <div class="field">
            <label for="pertanyaan">Pertanyaan / Butir Soal <span style="color:#a52a3b;">*</span></label>
            <textarea
                id="pertanyaan"
                name="pertanyaan"
                rows="4"
                placeholder="Tuliskan butir soal atau pertanyaan di sini..."
                required
            >{{ old('pertanyaan') }}</textarea>
            @error('pertanyaan') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="options-entry">
            <label style="font-weight: 700; display: block; margin-bottom: 6px;">Pilihan Jawaban</label>
            <p class="muted small" style="margin-bottom: 16px;">Tuliskan alternatif jawaban untuk opsi A hingga D (dan opsi E jika diperlukan).</p>

            <div class="option-row">
                <div class="option-tag">A</div>
                <div style="flex: 1;">
                    <input type="text" name="opsi_a" value="{{ old('opsi_a') }}" placeholder="Teks pilihan A *" required>
                    @error('opsi_a') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="option-row">
                <div class="option-tag">B</div>
                <div style="flex: 1;">
                    <input type="text" name="opsi_b" value="{{ old('opsi_b') }}" placeholder="Teks pilihan B *" required>
                    @error('opsi_b') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="option-row">
                <div class="option-tag">C</div>
                <div style="flex: 1;">
                    <input type="text" name="opsi_c" value="{{ old('opsi_c') }}" placeholder="Teks pilihan C *" required>
                    @error('opsi_c') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="option-row">
                <div class="option-tag">D</div>
                <div style="flex: 1;">
                    <input type="text" name="opsi_d" value="{{ old('opsi_d') }}" placeholder="Teks pilihan D *" required>
                    @error('opsi_d') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="option-row" style="margin-bottom: 0;">
                <div class="option-tag" style="background: #8b85b1;">E</div>
                <div style="flex: 1;">
                    <input type="text" name="opsi_e" value="{{ old('opsi_e') }}" placeholder="Teks pilihan E (opsional)">
                    @error('opsi_e') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="grid grid-2">
            <div class="field">
                <label for="jawaban">Kunci Jawaban Benar <span style="color:#a52a3b;">*</span></label>
                <select name="jawaban" id="jawaban" required>
                    <option value="">-- Pilih Kunci Jawaban --</option>
                    <option value="A" @selected(old('jawaban') === 'A')>A</option>
                    <option value="B" @selected(old('jawaban') === 'B')>B</option>
                    <option value="C" @selected(old('jawaban') === 'C')>C</option>
                    <option value="D" @selected(old('jawaban') === 'D')>D</option>
                    <option value="E" @selected(old('jawaban') === 'E')>E</option>
                </select>
                @error('jawaban') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label for="tingkat_kesulitan">Tingkat Kesulitan</label>
                <select name="tingkat_kesulitan" id="tingkat_kesulitan">
                    <option value="">-- Sesuai Kuis / Bebas --</option>
                    <option value="mudah" @selected(old('tingkat_kesulitan') === 'mudah')>Mudah</option>
                    <option value="sedang" @selected(old('tingkat_kesulitan') === 'sedang')>Sedang</option>
                    <option value="sulit" @selected(old('tingkat_kesulitan') === 'sulit')>Sulit</option>
                </select>
                @error('tingkat_kesulitan') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="field" style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:10px; padding:12px 16px; margin-bottom:20px;">
            <div style="font-size:13px; color:#166534; display:flex; align-items:center; gap:8px;">
                <span style="font-size:16px;">⚖️</span>
                <span><strong>Bobot Nilai Otomatis:</strong> Bobot dihitung otomatis oleh sistem secara merata (100 &divide; jumlah soal).</span>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                Simpan Soal
            </button>
        </div>
    </form>
</section>

@endsection
