@extends('layouts.guru')
@section('title', 'Tugaskan Siswa Remedial')

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
        <a href="{{ route('guru.remedial.index') }}" class="btn btn-secondary" style="display:inline-block; margin-bottom:10px;">
            ← Kembali
        </a>
        <h1>Tugaskan Siswa Remedial</h1>
        <p>Pilih siswa yang berhak mengikuti kuis remedial ini berdasarkan nilai ulangan asal.</p>
    </div>
</div>

<section class="card" style="margin-bottom: 24px;">
    <div class="meta-box" style="margin-bottom: 0;">
        <div class="meta-item">
            <div class="meta-label">Kuis Remedial</div>
            <div class="meta-val" style="color: #5542dc;">{{ $remedial->kuisRemedial->judul ?? '-' }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">Kuis Asal (Ulangan)</div>
            <div class="meta-val">{{ $kuisAsal->judul ?? '-' }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">KKM Kelulusan</div>
            <div class="meta-val" style="color: #c98200;">{{ number_format($kuisAsal->kkm, 1) }}</div>
        </div>
    </div>
</section>

<section class="card">
    <div class="card-header">
        <div>
            <h2>Daftar Siswa di Bawah KKM</h2>
            <p class="muted">Centang siswa yang ingin diberikan penugasan kuis remedial.</p>
        </div>
    </div>

    @if($hasilSiswa->isEmpty())
        <div class="empty-state" style="padding: 48px 20px; text-align: center;">
            <div style="font-size: 40px; margin-bottom: 12px;">🎉</div>
            <h3 style="margin-bottom: 6px;">Tidak Ada Siswa di Bawah KKM</h3>
            <p class="muted">Semua siswa yang telah mengumpulkan ulangan ini berhasil mencapai nilai &ge; KKM ({{ number_format($kuisAsal->kkm, 1) }}), atau belum ada siswa yang mengerjakan.</p>
        </div>
    @else
        <form action="{{ route('guru.remedial.tugaskan', $remedial->id_remedial) }}" method="POST">
            @csrf

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">Pilih</th>
                            <th style="width: 50px;">No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Nilai Ulangan</th>
                            <th>KKM</th>
                            <th>Percobaan</th>
                            <th>Status Penugasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasilSiswa as $hasil)
                            @php
                                $sudah = in_array($hasil->id_mengerjakan, $sudahDitugaskan);
                            @endphp
                            <tr>
                                <td style="text-align: center;">
                                    @if($sudah)
                                        <span style="color: #10b981; font-weight: bold; font-size: 16px;">✓</span>
                                    @else
                                        <input type="checkbox" name="id_mengerjakan[]" value="{{ $hasil->id_mengerjakan }}" style="width: 18px; height: 18px; cursor: pointer;">
                                    @endif
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $hasil->siswa->nomor_induk ?? '-' }}</td>
                                <td>
                                    <strong>{{ $hasil->siswa->nama_lengkap ?? '-' }}</strong>
                                </td>
                                <td>
                                    <span style="color: #b91c1c; font-weight: 700;">
                                        {{ number_format($hasil->nilai, 1) }}
                                    </span>
                                </td>
                                <td>{{ number_format($kuisAsal->kkm, 1) }}</td>
                                <td>Percobaan {{ $hasil->percobaan_ke }}</td>
                                <td>
                                    @if($sudah)
                                        <span class="badge badge-success">✓ Sudah Ditugaskan</span>
                                    @else
                                        <span class="badge badge-warning">Belum Ditugaskan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="form-actions" style="margin-top: 24px;">
                <a href="{{ route('guru.remedial.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    Tugaskan Siswa yang Dipilih
                </button>
            </div>
        </form>
    @endif
</section>

@endsection
