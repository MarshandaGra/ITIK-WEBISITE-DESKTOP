@extends('layouts.guru')
@section('title', 'Detail Kuis - ' . $kuis->judul)

@push('styles')
<style>
    .meta-box {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }
    .meta-item {
        background: #fbfafd;
        border: 1px solid #ebe6f7;
        border-radius: 12px;
        padding: 14px 18px;
    }
    .meta-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: #777394;
        margin-bottom: 4px;
    }
    .meta-val {
        font-size: 15px;
        font-weight: 700;
        color: #202044;
    }
    .soal-item {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        padding: 14px 16px;
        border-bottom: 1px solid #f0eff6;
    }
    .soal-item:last-child {
        border-bottom: none;
    }
    .soal-num {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #ede9fc;
        color: #5542dc;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <a href="{{ route('kuis.index', ['mapel' => $kuis->id_mapel]) }}" class="btn btn-secondary" style="display:inline-block; margin-bottom:10px;">
            ← Kembali
        </a>
        <h1>{{ $kuis->judul }}</h1>
        <p>Detail kuis, jadwal, daftar butir soal, dan publikasi.</p>
    </div>
    <div style="display: flex; gap: 10px;">
        @if ($kuis->status_publikasi === 'terbit')
            <a href="{{ route('kuis.edit', $kuis->id_kuis) }}" class="btn btn-secondary" onclick="alert('Kuis tersebut tidak dapat diedit karena berstatus terbit. Ubah ke status draft terlebih dahulu.'); return false;">
                ✎ Edit Kuis
            </a>
        @else
            <a href="{{ route('kuis.edit', $kuis->id_kuis) }}" class="btn btn-secondary">
                ✎ Edit Kuis
            </a>
        @endif
        <a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}" class="btn btn-primary">
            ⚙ Kelola Bank Soal
        </a>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="background:#fde8e8; border:1px solid #f8b4b4; color:#9b1c1c; padding:14px 18px; border-radius:12px; margin-bottom:20px;">
        <strong>Kuis belum dapat dipublikasikan:</strong>
        <ul style="margin: 8px 0 0 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- STATUS PUBLIKASI BANNER -->
@if ($kuis->status_publikasi === 'draft' && $kuis->is_aktif)
    <div class="card" style="background: #fffdf5; border-color: #fde8a0; margin-bottom: 24px; padding: 18px 24px; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
        <div>
            <strong style="color: #946200; font-size: 16px; display: block; margin-bottom: 4px;">Kuis masih dalam status DRAFT</strong>
            <p class="muted small" style="margin: 0;">Publikasikan kuis agar siswa dapat melihat dan mengerjakan kuis ini sesuai jadwal.</p>
        </div>
        <form action="{{ route('kuis.publish', $kuis->id_kuis) }}" method="POST" onsubmit="return confirm('Yakin ingin mempublikasikan kuis ini?');">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-primary" style="background: #10b981; border-color: #10b981;">
                ✓ Publikasikan Kuis
            </button>
        </form>
    </div>
@elseif ($kuis->status_publikasi === 'terbit' && $kuis->is_aktif)
    <div class="card" style="background: #f0fdf4; border-color: #bbf7d0; margin-bottom: 24px; padding: 18px 24px; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
        <div>
            <strong style="color: #166534; font-size: 16px; display: block; margin-bottom: 4px;">🟢 Kuis AKTIF / TERBIT</strong>
            <p class="muted small" style="margin: 0;">Kuis ini dapat dikerjakan siswa. Tarik kuis kembali ke draft jika ingin menghentikan pengerjaan sementara atau mengubah butir soal.</p>
        </div>
        <form action="{{ route('kuis.unpublish', $kuis->id_kuis) }}" method="POST" onsubmit="return confirm('Yakin ingin menarik kuis ini kembali ke draft? Siswa tidak akan bisa mengerjakan kuis ini.');">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-secondary" style="color: #b91c1c; border-color: #fca5a5;">
                ✕ Tarik ke Draft
            </button>
        </form>
    </div>
@endif

<!-- METADATA GRID -->
<section class="card" style="margin-bottom: 24px;">
    <div class="card-header">
        <div>
            <h2>Informasi Kuis</h2>
            <p class="muted">Ringkasan konfigurasi dan parameter pengerjaan.</p>
        </div>
        <div>
            @if ($kuis->status_publikasi === 'draft')
                <span class="badge badge-warning">Draft</span>
            @else
                <span class="badge badge-success">Terbit</span>
            @endif
        </div>
    </div>

    <div class="meta-box">
        <div class="meta-item">
            <div class="meta-label">Mata Pelajaran</div>
            <div class="meta-val">{{ $kuis->mapel?->nama_mapel ?? '-' }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">Kategori</div>
            <div class="meta-val" style="text-transform: capitalize;">{{ $kuis->kategori }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">Tingkat Kesulitan</div>
            <div class="meta-val">
                <span class="badge {{ $kuis->tingkat_kesulitan === 'sulit' ? 'badge-danger' : ($kuis->tingkat_kesulitan === 'sedang' ? 'badge-warning' : 'badge-info') }}">
                    {{ ucfirst($kuis->tingkat_kesulitan ?? 'mudah') }}
                </span>
            </div>
        </div>
        <div class="meta-item">
            <div class="meta-label">KKM</div>
            <div class="meta-val">{{ $kuis->kkm ?? '-' }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">Alokasi Waktu</div>
            <div class="meta-val">{{ $kuis->alokasi_waktu ? $kuis->alokasi_waktu . ' Menit' : 'Tidak Dibatasi' }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">Tahun Ajaran</div>
            <div class="meta-val">{{ $kuis->tahunAjaran?->nama ?? '-' }}</div>
        </div>
        @if ($kuis->waktu_mulai || $kuis->waktu_selesai)
            <div class="meta-item">
                <div class="meta-label">Waktu Mulai</div>
                <div class="meta-val">{{ $kuis->waktu_mulai?->format('d M Y, H:i') ?? '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Waktu Selesai</div>
                <div class="meta-val">{{ $kuis->waktu_selesai?->format('d M Y, H:i') ?? '-' }}</div>
            </div>
        @endif
    </div>

    @if ($kuis->deskripsi)
        <div style="background: #fbfafd; border-radius: 12px; padding: 14px 18px; border: 1px solid #ebe6f7;">
            <div class="meta-label">Deskripsi / Petunjuk</div>
            <div style="font-size: 14px; line-height: 1.6; color: #373356;">{!! nl2br(e($kuis->deskripsi)) !!}</div>
        </div>
    @endif
</section>

<div class="grid grid-2">
    <!-- MATERI TERKAIT -->
    <section class="card">
        <div class="card-header">
            <div>
                <h2>Materi Terkait</h2>
                <p class="muted">Bab pembelajaran yang dicakup oleh kuis ini.</p>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 10px;">
            @forelse ($kuis->materi as $materi)
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; background: #fbfafd; border-radius: 10px; border: 1px solid #f0eff6;">
                    <div style="width: 28px; height: 28px; border-radius: 8px; background: #ede9fc; color: #5542dc; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px;">
                        📖
                    </div>
                    <div>
                        <strong style="font-size: 14px; color: #202044;">{{ $materi->judul }}</strong>
                        @if ($materi->bab)
                            <span class="muted small" style="display: block;">Bab: {{ $materi->bab }}</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state" style="padding: 24px 16px;">
                    <p class="muted">Tidak ada materi yang ditautkan ke kuis ini.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- DAFTAR SOAL -->
    <section class="card">
        <div class="card-header">
            <div>
                <h2>Butir Soal ({{ $kuis->soal->count() }})</h2>
                <p class="muted">Pratinjau butir pertanyaan dalam kuis ini.</p>
            </div>
            <a href="{{ route('kuis.soal.index', $kuis->id_kuis) }}" class="btn btn-secondary small">
                Buka Bank Soal →
            </a>
        </div>

        <div style="max-height: 400px; overflow-y: auto;">
            @forelse ($kuis->soal as $index => $soal)
                <div class="soal-item">
                    <div class="soal-num">{{ $index + 1 }}</div>
                    <div style="flex: 1; font-size: 14px; line-height: 1.5; color: #202044;">
                        {{ \Illuminate\Support\Str::limit($soal->pertanyaan, 110) }}
                        <div style="margin-top: 4px;">
                            <span class="badge badge-info" style="font-size: 11px;">Bobot: {{ $soal->bobot }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="padding: 30px 16px; text-align: center;">
                    <p class="muted" style="margin-bottom: 12px;">Kuis ini belum memiliki butir soal.</p>
                    <a href="{{ route('kuis.soal.create', $kuis->id_kuis) }}" class="btn btn-primary small">
                        + Tambah Soal Pertama
                    </a>
                </div>
            @endforelse
        </div>
    </section>
</div>

@endsection
