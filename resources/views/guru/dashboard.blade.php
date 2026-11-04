@extends('layouts.guru')
@section('title', 'Dashboard Guru')
@section('content')

<div class="page-heading">
    <div>
        <h1>Dashboard</h1>
        <p>Ringkasan aktivitas pembelajaran TIK.</p>
    </div>
    <a class="btn btn-secondary" href="{{ route('kuis.index') }}">Lihat semua kuis</a>
</div>

<div class="stats">
    <div class="stat">
        <span class="label">Siswa</span>
        <span class="value">{{ $jumlahSiswa }}</span>
        <small>Terdaftar di sistem</small>
    </div>
    <div class="stat">
        <span class="label">Materi</span>
        <span class="value">{{ $jumlahMateri }}</span>
        <small><a href="{{ route('materi.index') }}">Kelola materi</a></small>
    </div>
    <div class="stat">
        <span class="label">Kuis Aktif</span>
        <span class="value">{{ $jumlahKuis }}</span>
        <small><a href="{{ route('kuis.index') }}">Kelola kuis</a></small>
    </div>
    <div class="stat">
        <span class="label">Rata-rata Nilai</span>
        <span class="value">{{ $rataNilai ? number_format($rataNilai, 0) : '—' }}</span>
        <small>Dari seluruh pengerjaan</small>
    </div>
</div>

<div class="grid grid-2">

    <section class="card">
        <div class="card-header">
            <div>
                <h2>Kuis Terbaru</h2>
                <p class="muted">5 kuis yang terakhir dibuat</p>
            </div>
            <a href="{{ route('kuis.index') }}" class="btn btn-secondary btn-small">Lihat semua</a>
        </div>
        @if($kuisTerbaru->isNotEmpty())
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kuisTerbaru as $kuis)
                            <tr>
                                <td>
                                    <strong><a href="{{ route('kuis.show', $kuis->id_kuis) }}">{{ $kuis->judul }}</a></strong>
                                    <span class="muted small">{{ $kuis->alokasi_waktu ? $kuis->alokasi_waktu.' menit' : 'Waktu bebas' }}</span>
                                </td>
                                <td>{{ ucfirst($kuis->kategori) }}</td>
                                <td>
                                    @if($kuis->status_publikasi === 'terbit')
                                        <span class="badge badge-success">Terbit</span>
                                    @else
                                        <span class="badge badge-muted">Draft</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty">
                <p>Belum ada kuis yang dibuat.</p>
                <a href="{{ route('kuis.create') }}" class="btn">Buat kuis pertama</a>
            </div>
        @endif
    </section>

    <section class="card">
        <div class="card-header">
            <div>
                <h2>Materi Terbaru</h2>
                <p class="muted">5 materi yang terakhir ditambahkan</p>
            </div>
            <a href="{{ route('materi.index') }}" class="btn btn-secondary btn-small">Lihat semua</a>
        </div>
        @if($materiTerbaru->isNotEmpty())
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Bab</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materiTerbaru as $materi)
                            <tr>
                                <td>
                                    <strong>{{ $materi->judul }}</strong>
                                </td>
                                <td class="muted">{{ $materi->bab ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty">
                <p>Belum ada materi yang ditambahkan.</p>
                <a href="{{ route('materi.index') }}" class="btn">Tambah materi</a>
            </div>
        @endif
    </section>

</div>

@endsection
