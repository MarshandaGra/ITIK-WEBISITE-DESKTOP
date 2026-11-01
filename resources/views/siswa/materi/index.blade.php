@extends('layouts.siswa')
@section('title', 'Materi Pembelajaran')

@section('content')

<div class="page-heading">
    <div>
        <h1>Materi Pembelajaran</h1>
        <p>Pilih materi untuk mulai membaca dan menyelesaikan target pembelajaran.</p>
    </div>
    <a href="{{ route('siswa.kuis.index') }}" class="btn btn-secondary">
        Ke Daftar Kuis →
    </a>
</div>

<section class="card">
    <div class="card-header">
        <div>
            <h2>Daftar Materi</h2>
            <p class="muted">{{ $materi->count() }} materi tersedia</p>
        </div>
    </div>

    @if($materi->isEmpty())
        <div class="empty">
            <h3>Belum ada materi</h3>
            <p>Materi akan muncul di sini setelah guru menambahkannya.</p>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th>Judul Materi</th>
                        <th>Bab</th>
                        <th>Kelas</th>
                        <th>Progress</th>
                        <th style="min-width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materi as $item)
                        @php
                            $progress = $item->progress->first();
                        @endphp
                        <tr>
                            <td class="number" style="text-align: left;">{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $item->judul }}</strong>
                            </td>
                            <td>{{ $item->bab ?? '-' }}</td>
                            <td>{{ $item->kelas ?? '-' }}</td>
                            <td>
                                @if(!$progress)
                                    <span class="badge badge-muted">Belum Mulai</span>
                                @elseif($progress->status === 'sedang belajar')
                                    <span class="badge badge-warning">Sedang Belajar</span>
                                @elseif($progress->status === 'selesai')
                                    <span class="badge badge-success">✓ Selesai</span>
                                @else
                                    <span class="badge">{{ $progress->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('siswa.materi.show', $item->id_materi) }}" class="btn btn-secondary btn-small">
                                    Buka Materi →
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>

@endsection
