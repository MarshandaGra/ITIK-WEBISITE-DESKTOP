@extends('layouts.guru')
@section('title', 'Bank Soal - ' . $kuis->judul)

@push('styles')
<style>
    .soal-card-item {
        background: #ffffff;
        border: 1px solid #ebe6f7;
        border-radius: 14px;
        padding: 22px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
    }
    .soal-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 16px;
    }
    .soal-badge-num {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #5542dc;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }
    .options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 12px;
        margin-bottom: 16px;
    }
    .option-box {
        padding: 12px 16px;
        border-radius: 10px;
        background: #fbfafd;
        border: 1px solid #ebe6f7;
        font-size: 14px;
        color: #373356;
    }
    .option-box.is-correct {
        background: #f0fdf4;
        border-color: #86efac;
        color: #166534;
        font-weight: 600;
    }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <a href="{{ route('kuis.show', $kuis->id_kuis) }}" class="muted small" style="display:inline-block; margin-bottom:6px;">
            ← Kembali ke detail kuis
        </a>
        <h1>Kelola Bank Soal</h1>
        <p>Kuis: <strong>{{ $kuis->judul }}</strong> &bull; Total: {{ $soal->count() }} Soal</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('kuis.soal.create', $kuis->id_kuis) }}" class="btn btn-primary">
            + Tambah Soal
        </a>
    </div>
</div>

@if ($soal->count() > 0)
    @foreach ($soal as $index => $item)
        <div class="soal-card-item">
            <div class="soal-head">
                <div style="display: flex; gap: 14px; align-items: flex-start;">
                    <div class="soal-badge-num">{{ $index + 1 }}</div>
                    <div>
                        <div style="font-size: 15px; font-weight: 600; color: #202044; line-height: 1.6;">
                            {{ $item->pertanyaan }}
                        </div>
                        <div style="margin-top: 8px; display: flex; gap: 8px;">
                            <span class="badge badge-info">Bobot: {{ $item->bobot ?? 1 }}</span>
                            @if ($item->tingkat_kesulitan)
                                <span class="badge {{ $item->tingkat_kesulitan === 'sulit' ? 'badge-danger' : ($item->tingkat_kesulitan === 'sedang' ? 'badge-warning' : 'badge-info') }}">
                                    {{ ucfirst($item->tingkat_kesulitan) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 6px; flex-shrink: 0;">
                    <a href="{{ route('kuis.soal.show', [$kuis->id_kuis, $item->id_soal]) }}" class="btn btn-secondary small">
                        Lihat
                    </a>
                    <a href="{{ route('kuis.soal.edit', [$kuis->id_kuis, $item->id_soal]) }}" class="btn btn-secondary small">
                        Edit
                    </a>
                    <form
                        action="{{ route('kuis.soal.destroy', [$kuis->id_kuis, $item->id_soal]) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus butir soal ini?');"
                        style="display: inline;"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary small" style="color:#b91c1c; border-color:#fca5a5;">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>

            <!-- PILIHAN JAWABAN -->
            <div class="options-grid">
                <div class="option-box {{ $item->jawaban === 'A' ? 'is-correct' : '' }}">
                    <strong>A.</strong> {{ $item->opsi_a }}
                    @if ($item->jawaban === 'A') <span style="float: right;">✓ Benar</span> @endif
                </div>
                <div class="option-box {{ $item->jawaban === 'B' ? 'is-correct' : '' }}">
                    <strong>B.</strong> {{ $item->opsi_b }}
                    @if ($item->jawaban === 'B') <span style="float: right;">✓ Benar</span> @endif
                </div>
                <div class="option-box {{ $item->jawaban === 'C' ? 'is-correct' : '' }}">
                    <strong>C.</strong> {{ $item->opsi_c }}
                    @if ($item->jawaban === 'C') <span style="float: right;">✓ Benar</span> @endif
                </div>
                <div class="option-box {{ $item->jawaban === 'D' ? 'is-correct' : '' }}">
                    <strong>D.</strong> {{ $item->opsi_d }}
                    @if ($item->jawaban === 'D') <span style="float: right;">✓ Benar</span> @endif
                </div>
                @if ($item->opsi_e)
                    <div class="option-box {{ $item->jawaban === 'E' ? 'is-correct' : '' }}">
                        <strong>E.</strong> {{ $item->opsi_e }}
                        @if ($item->jawaban === 'E') <span style="float: right;">✓ Benar</span> @endif
                    </div>
                @endif
            </div>

            @if ($item->pembahasan)
                <div style="background: #fbfafd; border-radius: 8px; padding: 10px 14px; font-size: 13px; color: #575279; border-left: 3px solid #5542dc;">
                    <strong>Pembahasan:</strong> {{ $item->pembahasan }}
                </div>
            @endif
        </div>
    @endforeach
@else
    <div class="card empty-state" style="text-align: center; padding: 48px 20px;">
        <div style="font-size: 40px; margin-bottom: 12px;">📝</div>
        <h3 style="margin-bottom: 6px;">Belum Ada Butir Soal</h3>
        <p class="muted" style="margin-bottom: 20px;">Kuis ini belum memiliki soal. Klik tombol di bawah untuk menambahkan soal pilihan ganda.</p>
        <a href="{{ route('kuis.soal.create', $kuis->id_kuis) }}" class="btn btn-primary">
            + Tambah Soal Pertama
        </a>
    </div>
@endif

@endsection
