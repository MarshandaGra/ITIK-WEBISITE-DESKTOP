@extends('layouts.guru')
@section('title', 'Detail Materi - ' . $materi->judul)

@push('styles')
<style>
    .pdf-viewer-frame {
        width: 100%;
        height: 700px;
        border: 1px solid var(--border);
        border-radius: 12px;
        margin-top: 16px;
    }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <a href="{{ route('materi.index') }}" class="muted small" style="display:inline-block; margin-bottom:6px;">
            ← Kembali ke daftar materi
        </a>
        <h1>{{ $materi->judul }}</h1>
        <p>{{ $materi->bab ?? 'Materi Pembelajaran' }} &bull; Kelas {{ $materi->kelas ?? '-' }}</p>
    </div>
    <div class="actions">
        <a href="{{ route('materi.edit', $materi->id_materi) }}" class="btn">
            Edit Materi
        </a>
        <a href="{{ route('materi.index') }}" class="btn btn-secondary">
            Semua Materi
        </a>
    </div>
</div>

<div class="grid grid-2">
    <!-- KIRI: DOKUMEN PDF / ISI -->
    <div>
        <section class="card">
            <div class="card-header">
                <div>
                    <h2>Isi &amp; Dokumen Pembelajaran</h2>
                    <p class="muted">Pratinjau dokumen materi siswa</p>
                </div>
                @if($pdfUrl)
                    <a href="{{ $pdfUrl }}" target="_blank" class="btn btn-secondary btn-small">
                        Buka PDF di Tab Baru ↗
                    </a>
                @endif
            </div>

            @if($pdfUrl)
                <iframe
                    src="{{ $pdfUrl }}#toolbar=1"
                    class="pdf-viewer-frame"
                    title="Dokumen {{ $materi->judul }}"
                ></iframe>
            @elseif($materi->isi_materi)
                <div class="alert alert-warning">
                    File tercatat sebagai <strong>{{ basename($materi->isi_materi) }}</strong>, namun tidak ditemukan di penyimpanan server.
                </div>
            @else
                <div class="empty">
                    <p>Belum ada file dokumen PDF yang diunggah untuk materi ini.</p>
                </div>
            @endif
        </section>

        @if($materi->link_youtube)
            <section class="card">
                <div class="card-header">
                    <h2>Video Pembelajaran</h2>
                </div>
                <a href="{{ $materi->link_youtube }}" target="_blank" class="btn btn-secondary">
                    ▶ Tonton Video di YouTube ↗
                </a>
            </section>
        @endif
    </div>

    <!-- KANAN: DETAIL INFORMASI -->
    <div>
        <section class="card">
            <div class="card-header">
                <h2>Informasi Materi</h2>
                <span class="badge">Kelas {{ $materi->kelas ?? '-' }}</span>
            </div>

            <dl class="identity">
                <div>
                    <dt>ID Materi</dt>
                    <dd>{{ $materi->id_materi }}</dd>
                </div>
                <div>
                    <dt>Mata Pelajaran</dt>
                    <dd>{{ $materi->mapel?->nama_mapel ?? '-' }}</dd>
                </div>
                <div>
                    <dt>Bab</dt>
                    <dd>{{ $materi->bab ?? '-' }}</dd>
                </div>
                <div>
                    <dt>Kelas</dt>
                    <dd>{{ $materi->kelas ?? '-' }}</dd>
                </div>
            </dl>

            <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid var(--border);">
                <span class="muted small" style="display:block; margin-bottom: 6px; font-weight: 600;">Deskripsi Materi:</span>
                <p style="margin: 0; line-height: 1.6; color: var(--ink);">
                    {{ $materi->deskripsi ?? 'Tidak ada deskripsi materi.' }}
                </p>
            </div>
        </section>
    </div>
</div>

@endsection
