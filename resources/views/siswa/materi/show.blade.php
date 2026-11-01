@extends('layouts.siswa')
@section('title', $materi->judul)

@push('styles')
<style>
    .pdf-frame {
        width: 100%;
        height: 650px;
        border: 1px solid var(--border);
        border-radius: 12px;
        background: #fdfdfd;
    }
    .isi-teks {
        font-size: 15px;
        line-height: 1.8;
        white-space: pre-wrap;
        color: var(--ink);
    }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <a href="{{ route('siswa.materi.index') }}" class="muted small" style="display:inline-block; margin-bottom:6px;">
            ← Kembali ke daftar materi
        </a>
        <h1>{{ $materi->judul }}</h1>
        <p>{{ $materi->bab ?? '-' }} &bull; Kelas {{ $materi->kelas ?? '-' }}</p>
    </div>
    @if($pdfUrl)
        <a href="{{ $pdfUrl }}" target="_blank" class="btn btn-secondary btn-small">
            Buka PDF di tab baru ↗
        </a>
    @endif
</div>

<div class="grid grid-2">
    <!-- KIRI: ISI MATERI -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
        <section class="card">
            <div class="card-header">
                <h2>Isi Materi</h2>
            </div>

            @if($pdfUrl)
                <iframe
                    class="pdf-frame"
                    src="{{ $pdfUrl }}#toolbar=1"
                    title="PDF {{ $materi->judul }}"
                ></iframe>
            @elseif($materi->isi_materi)
                <p class="isi-teks">{{ $materi->isi_materi }}</p>
            @else
                <div class="empty">
                    <p>File atau teks materi belum tersedia.</p>
                </div>
            @endif
        </section>

        @if($materi->link_youtube)
            <section class="card">
                <div class="card-header">
                    <h2>Video Pembelajaran</h2>
                </div>
                <a href="{{ $materi->link_youtube }}" target="_blank" class="btn btn-secondary">
                    ▶ Tonton video pembelajaran di YouTube ↗
                </a>
            </section>
        @endif
    </div>

    <!-- KANAN: INFORMASI & PROGRESS -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
        <section class="card">
            <div class="card-header">
                <h2>Informasi Materi</h2>
                @if($progress->status === 'selesai')
                    <span class="badge badge-success">✓ Selesai</span>
                @else
                    <span class="badge badge-warning">Sedang Belajar</span>
                @endif
            </div>

            <dl class="identity">
                <div>
                    <dt>Judul</dt>
                    <dd>{{ $materi->judul }}</dd>
                </div>
                <div>
                    <dt>Bab</dt>
                    <dd>{{ $materi->bab ?? '-' }}</dd>
                </div>
                <div>
                    <dt>Kelas</dt>
                    <dd>{{ $materi->kelas ?? '-' }}</dd>
                </div>
                <div>
                    <dt>Deskripsi</dt>
                    <dd>{{ $materi->deskripsi ?? '-' }}</dd>
                </div>
            </dl>
        </section>

        <section class="card">
            <div class="card-header">
                <h2>Tandai Pembelajaran</h2>
            </div>

            @if($progress->status !== 'selesai')
                <p class="muted small" style="margin-bottom: 16px;">
                    Sudah selesai membaca dan memahami materi ini? Tandai agar progres belajarmu tercatat.
                </p>

                <form action="{{ route('siswa.materi.selesai', $materi->id_materi) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">
                        ✓ Tandai Sudah Selesai Membaca
                    </button>
                </form>
            @else
                <div class="alert alert-success" style="margin-bottom: 0;">
                    ✓ Materi ini sudah kamu tandai selesai dipelajari!
                </div>
            @endif
        </section>
    </div>
</div>

@endsection
