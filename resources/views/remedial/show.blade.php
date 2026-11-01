@extends('layouts.guru')
@section('title', 'Detail Kuis Remedial')

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
</style>
@endpush

@section('content')

<div class="page-heading">
    <div>
        <a href="{{ route('guru.remedial.index') }}" class="muted small" style="display:inline-block; margin-bottom:6px;">
            ← Kembali ke daftar remedial
        </a>
        <h1>Detail Kuis Remedial</h1>
        <p>Pantau perkembangan dan hasil pengerjaan remedial siswa.</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="{{ route('guru.remedial.siswa', $remedial->id_remedial) }}" class="btn btn-primary">
            👥 Tugaskan Siswa
        </a>
    </div>
</div>

<section class="card" style="margin-bottom: 24px;">
    <div class="card-header">
        <div>
            <h2>Informasi Kuis Remedial</h2>
            <p class="muted">Kuis remedial yang dihubungkan dengan kuis ulangan.</p>
        </div>
    </div>

    <div class="meta-box">
        <div class="meta-item">
            <div class="meta-label">Kuis Remedial</div>
            <div class="meta-val" style="color: #5542dc;">{{ $remedial->kuisRemedial->judul ?? '-' }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">Kuis Asal (Ulangan)</div>
            <div class="meta-val">{{ $remedial->kuisAsal->judul ?? '-' }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">KKM Kelulusan</div>
            <div class="meta-val" style="color: #c98200;">{{ number_format($remedial->kuisRemedial->kkm ?? $remedial->kuisAsal->kkm, 1) }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">Jumlah Butir Soal</div>
            <div class="meta-val">{{ $remedial->kuisRemedial?->soal?->count() ?? 0 }} Soal</div>
        </div>
    </div>
</section>

<section class="card">
    <div class="card-header">
        <div>
            <h2>Daftar Siswa yang Ditugaskan</h2>
            <p class="muted">Status dan skor remedial siswa yang terdaftar.</p>
        </div>
    </div>

    @if($remedial->remedialSiswa->isEmpty())
        <div class="empty-state" style="padding: 48px 20px; text-align: center;">
            <div style="font-size: 40px; margin-bottom: 12px;">📝</div>
            <h3 style="margin-bottom: 6px;">Belum Ada Siswa yang Ditugaskan</h3>
            <p class="muted" style="margin-bottom: 20px;">Klik tombol "Tugaskan Siswa" di atas untuk memilih siswa yang nilainya di bawah KKM pada Ulangan.</p>
            <a href="{{ route('guru.remedial.siswa', $remedial->id_remedial) }}" class="btn btn-primary">
                👥 Tugaskan Siswa Sekarang
            </a>
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Siswa</th>
                        <th>Nilai Ulangan Asal</th>
                        <th>KKM</th>
                        <th>Nilai Remedial</th>
                        <th>Status Pengerjaan</th>
                        <th>Hasil Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($remedial->remedialSiswa as $item)
                        @php
                            $nilaiAsal = $item->mengerjakanAsal?->nilai;
                            $nilaiRemedial = $item->hasilRemedial?->nilai;
                            $kkm = $remedial->kuisRemedial->kkm ?? $remedial->kuisAsal->kkm;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $item->mengerjakanAsal?->siswa?->nama_lengkap ?? '-' }}</strong>
                                <div class="muted small">NISN: {{ $item->mengerjakanAsal?->siswa?->nomor_induk ?? '-' }}</div>
                            </td>
                            <td>
                                <span style="color: #b91c1c; font-weight: 700;">
                                    {{ $nilaiAsal !== null ? number_format($nilaiAsal, 1) : '-' }}
                                </span>
                            </td>
                            <td>{{ number_format($kkm, 1) }}</td>
                            <td>
                                @if($nilaiRemedial !== null)
                                    <strong style="color: {{ $nilaiRemedial >= $kkm ? '#15803d' : '#b91c1c' }};">
                                        {{ number_format($nilaiRemedial, 1) }}
                                    </strong>
                                @else
                                    <span class="muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($nilaiRemedial !== null)
                                    <span class="badge badge-success">Selesai</span>
                                @else
                                    <span class="badge badge-secondary">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($nilaiRemedial === null)
                                    <span class="badge badge-secondary">Belum Mengerjakan</span>
                                @elseif($nilaiRemedial >= $kkm)
                                    <span class="badge badge-success">✓ Lulus Remedial</span>
                                @else
                                    <span class="badge badge-danger">Belum Lulus</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>

@endsection
