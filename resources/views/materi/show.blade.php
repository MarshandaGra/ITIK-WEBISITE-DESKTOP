@extends('layouts.guru')
@section('title', 'Detail Materi - ' . $materi->judul)

@push('styles')
<style>
    .pdf-viewer-container {
        border: 1px solid var(--border);
        border-radius: 12px;
        background: #f8fafc;
        overflow: hidden;
        margin-top: 16px;
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
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <a href="{{ route('materi.index', ['mapel' => $materi->id_mapel]) }}" class="btn btn-secondary" style="display:inline-block; margin-bottom:10px;">
            ← Kembali
        </a>
        <h1>{{ $materi->judul }}</h1>
        <p>{{ $materi->bab ?? 'Materi Pembelajaran' }} &bull; Kelas {{ $materi->kelas ?? '-' }}</p>
    </div>
    <div class="actions">
        <a href="{{ route('materi.edit', $materi->id_materi) }}" class="btn">
            Edit Materi
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
                        <div id="pdf-loading" class="pdf-loading">Memuat dokumen PDF...</div>
                        <canvas id="pdf-canvas" style="display: none;"></canvas>
                    </div>
                </div>
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
            <section class="card" style="margin-top: 20px;">
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
