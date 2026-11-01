@extends('layouts.siswa')
@section('title', $materi->judul)

@push('styles')
<style>
    .pdf-viewer-container {
        border: 1px solid var(--border);
        border-radius: 12px;
        background: #f8fafc;
        overflow: hidden;
    }
    .pdf-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 16px;
        background: white;
        border-bottom: 1px solid var(--border);
        gap: 12px;
        flex-wrap: wrap;
    }
    .pdf-page-indicator {
        font-size: 13px;
        font-weight: 600;
        color: var(--ink);
    }
    .pdf-canvas-wrapper {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 20px 10px;
        max-height: 750px;
        overflow: auto;
        background: #475569;
    }
    #pdf-canvas {
        max-width: 100%;
        height: auto;
        box-shadow: 0 4px 20px rgba(0,0,0,.25);
        border-radius: 4px;
        background: white;
    }
    .pdf-loading {
        padding: 40px;
        text-align: center;
        color: #94a3b8;
        font-size: 14px;
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
        <a href="{{ route('siswa.materi.index', ['mapel' => $materi->id_mapel]) }}" class="btn btn-secondary" style="display:inline-block; margin-bottom:10px;">
            ← Kembali
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
                <h2>Isi Dokumen Materi</h2>
            </div>

            @if($pdfUrl)
                <div class="pdf-viewer-container">
                    <div class="pdf-toolbar">
                        <button type="button" id="prev-page" class="btn btn-secondary btn-small">
                            ← Sebelumnya
                        </button>
                        <span class="pdf-page-indicator">
                            Halaman <strong id="page_num">1</strong> dari <strong id="page_count">-</strong>
                        </span>
                        <button type="button" id="next-page" class="btn btn-secondary btn-small">
                            Selanjutnya →
                        </button>
                    </div>
                    <div class="pdf-canvas-wrapper">
                        <div id="pdf-loading" class="pdf-loading">Memuat dokumen materi...</div>
                        <canvas id="pdf-canvas" style="display: none;"></canvas>
                    </div>
                </div>
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

@if($pdfUrl)
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    const url = "{{ $pdfUrl }}";
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    let pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 1.3,
        canvas = document.getElementById('pdf-canvas'),
        ctx = canvas.getContext('2d'),
        loadingEl = document.getElementById('pdf-loading'),
        prevBtn = document.getElementById('prev-page'),
        nextBtn = document.getElementById('next-page'),
        pageNumEl = document.getElementById('page_num'),
        pageCountEl = document.getElementById('page_count');

    function renderPage(num) {
        pageRendering = true;
        pdfDoc.getPage(num).then(function(page) {
            const viewport = page.getViewport({ scale: scale });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            const renderTask = page.render(renderContext);

            renderTask.promise.then(function() {
                pageRendering = false;
                if (loadingEl) loadingEl.style.display = 'none';
                canvas.style.display = 'block';

                if (pageNumPending !== null) {
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
            });
        });

        pageNumEl.textContent = num;
        prevBtn.disabled = num <= 1;
        nextBtn.disabled = num >= pdfDoc.numPages;
    }

    function queueRenderPage(num) {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    }

    prevBtn.addEventListener('click', function() {
        if (pageNum <= 1) return;
        pageNum--;
        queueRenderPage(pageNum);
    });

    nextBtn.addEventListener('click', function() {
        if (pageNum >= pdfDoc.numPages) return;
        pageNum++;
        queueRenderPage(pageNum);
    });

    pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
        pdfDoc = pdfDoc_;
        pageCountEl.textContent = pdfDoc.numPages;
        renderPage(pageNum);
    }).catch(function(err) {
        if (loadingEl) {
            loadingEl.textContent = 'Gagal memuat pratinjau PDF. Anda dapat membuka PDF secara langsung di tab baru.';
        }
    });
</script>
@endpush
@endif

@endsection
