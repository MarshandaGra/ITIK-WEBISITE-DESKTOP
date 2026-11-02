@extends('layouts.guru')
@section('title', 'Edit Soal - ' . $kuis->judul)

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
        cursor: pointer;
        border-radius: 10px;
        padding: 4px 8px;
        transition: background .15s ease;
    }
    .option-row:hover {
        background: #f0eeff;
    }
    .option-row.selected .option-tag {
        background: #10b981 !important;
    }
    .option-row.selected {
        background: #f0fdf4;
        border: 1.5px solid #bbf7d0;
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
        transition: background .2s ease;
    }
    .jawaban-hint {
        margin-top: 10px;
        font-size: 12px;
        color: var(--muted);
        font-style: italic;
    }
    .jawaban-selected-label {
        margin-top: 10px;
        font-size: 13px;
        font-weight: 700;
        color: #10b981;
        display: none;
    }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}" class="btn btn-secondary" style="display:inline-block; margin-bottom:6px;">
            ← Kembali
        </a>
        <h1>Edit Butir Soal</h1>
        <p>Kuis: <strong>{{ $kuis->judul }}</strong></p>
    </div>
</div>

<section class="card form-card">
    <div class="card-header">
        <div>
            <h2>Formulir Edit Butir Soal</h2>
            <p class="muted">Tanda bintang (<span style="color:#a52a3b;">*</span>) menandakan kolom wajib diisi.</p>
        </div>
    </div>

    <form action="{{ route('kuis.soal.update', [$kuis->id_kuis, $soal->id_soal]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="pertanyaan">Pertanyaan / Butir Soal <span style="color:#a52a3b;">*</span></label>
            <textarea
                id="pertanyaan"
                name="pertanyaan"
                rows="4"
                placeholder="Tuliskan butir soal atau pertanyaan di sini..."
                required
            >{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
            @error('pertanyaan') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="options-entry">
            <label style="font-weight: 700; display: block; margin-bottom: 6px;">Pilihan Jawaban</label>
            <p class="muted small" style="margin-bottom: 16px;">Tuliskan alternatif jawaban untuk opsi A hingga D (dan opsi E jika diperlukan). <strong>Klik opsi untuk menjadikannya kunci jawaban.</strong></p>

            {{-- Hidden input untuk menyimpan kunci jawaban --}}
            <input type="hidden" name="jawaban" id="hidden-jawaban" value="{{ old('jawaban', $soal->jawaban) }}" required>

            <div class="option-row" data-opsi="A" onclick="pilihJawaban(this, 'A')">
                <div class="option-tag">A</div>
                <div style="flex: 1;">
                    <input type="text" name="opsi_a" value="{{ old('opsi_a', $soal->opsi_a) }}" placeholder="Teks pilihan A *" required onclick="event.stopPropagation()">
                    @error('opsi_a') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="option-row" data-opsi="B" onclick="pilihJawaban(this, 'B')">
                <div class="option-tag">B</div>
                <div style="flex: 1;">
                    <input type="text" name="opsi_b" value="{{ old('opsi_b', $soal->opsi_b) }}" placeholder="Teks pilihan B *" required onclick="event.stopPropagation()">
                    @error('opsi_b') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="option-row" data-opsi="C" onclick="pilihJawaban(this, 'C')">
                <div class="option-tag">C</div>
                <div style="flex: 1;">
                    <input type="text" name="opsi_c" value="{{ old('opsi_c', $soal->opsi_c) }}" placeholder="Teks pilihan C *" required onclick="event.stopPropagation()">
                    @error('opsi_c') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="option-row" data-opsi="D" onclick="pilihJawaban(this, 'D')">
                <div class="option-tag">D</div>
                <div style="flex: 1;">
                    <input type="text" name="opsi_d" value="{{ old('opsi_d', $soal->opsi_d) }}" placeholder="Teks pilihan D *" required onclick="event.stopPropagation()">
                    @error('opsi_d') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="option-row" data-opsi="E" onclick="pilihJawaban(this, 'E')" style="margin-bottom: 0;">
                <div class="option-tag">E</div>
                <div style="flex: 1;">
                    <input type="text" name="opsi_e" value="{{ old('opsi_e', $soal->opsi_e) }}" placeholder="Teks pilihan E (opsional)" onclick="event.stopPropagation()">
                    @error('opsi_e') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <p class="jawaban-hint">👆 Klik pada baris opsi untuk memilihnya sebagai kunci jawaban yang benar.</p>
            <p class="jawaban-selected-label" id="label-jawaban-selected"></p>
            @error('jawaban') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label for="tingkat_kesulitan">Tingkat Kesulitan</label>
            <select name="tingkat_kesulitan" id="tingkat_kesulitan">
                <option value="">-- Sesuai Kuis / Bebas --</option>
                <option value="mudah" @selected(old('tingkat_kesulitan', $soal->tingkat_kesulitan) === 'mudah')>Mudah</option>
                <option value="sedang" @selected(old('tingkat_kesulitan', $soal->tingkat_kesulitan) === 'sedang')>Sedang</option>
                <option value="sulit" @selected(old('tingkat_kesulitan', $soal->tingkat_kesulitan) === 'sulit')>Sulit</option>
            </select>
            @error('tingkat_kesulitan') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>

@push('scripts')
<script>
    // Click-to-select kunci jawaban
    function pilihJawaban(rowEl, opsi) {
        document.querySelectorAll('.option-row').forEach(r => r.classList.remove('selected'));
        rowEl.classList.add('selected');
        document.getElementById('hidden-jawaban').value = opsi;
        const lbl = document.getElementById('label-jawaban-selected');
        if (lbl) {
            lbl.textContent = '✅ Kunci Jawaban: Opsi ' + opsi;
            lbl.style.display = 'block';
        }
    }

    // Pre-select jawaban saat halaman load
    document.addEventListener('DOMContentLoaded', function() {
        const jawabanSaat = document.getElementById('hidden-jawaban').value;
        if (jawabanSaat) {
            const row = document.querySelector('.option-row[data-opsi="' + jawabanSaat + '"]');
            if (row) {
                row.classList.add('selected');
                const lbl = document.getElementById('label-jawaban-selected');
                if (lbl) {
                    lbl.textContent = '✅ Kunci Jawaban: Opsi ' + jawabanSaat;
                    lbl.style.display = 'block';
                }
            }
        }
    });
</script>
@endpush

@endsection
