@extends('layouts.app')
@section('title', 'Profil Saya')

@push('styles')
<style>
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(41, 38, 61, .55);
        z-index: 999;
        place-items: center;
        padding: 20px;
    }
    .modal-overlay.active {
        display: grid;
    }
    .modal-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        max-width: 480px;
        width: 100%;
        box-shadow: 0 10px 40px rgba(0,0,0,.15);
    }
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .btn-close {
        background: none;
        border: none;
        font-size: 24px;
        line-height: 1;
        cursor: pointer;
        color: var(--muted);
    }
</style>
@endpush

@section('content')
@php($pengguna = auth()->user())

<div class="page-heading">
    <div>
        <h1>Profil Saya</h1>
        <p>Informasi akun dan pengaturan keamanan.</p>
    </div>
</div>

<section class="card form-card">
    <div class="card-header">
        <div>
            <h2>{{ $pengguna?->nama_lengkap }}</h2>
            <p class="muted">Data akun yang sedang aktif digunakan.</p>
        </div>
        <span class="badge">{{ ucfirst($pengguna?->role ?? 'Pengguna') }}</span>
    </div>

    <dl class="identity">
        <div>
            <dt>Nomor Induk (NISN / NIP)</dt>
            <dd>{{ $pengguna?->nomor_induk ?? '—' }}</dd>
        </div>
        <div>
            <dt>Nama Lengkap</dt>
            <dd>{{ $pengguna?->nama_lengkap ?? '—' }}</dd>
        </div>
        <div>
            <dt>Email</dt>
            <dd>{{ $pengguna?->email ?? 'Belum diisi' }}</dd>
        </div>
        <div>
            <dt>Peran</dt>
            <dd>{{ ucfirst($pengguna?->role ?? '—') }}</dd>
        </div>
        <div>
            <dt>Kelas</dt>
            <dd>{{ $pengguna?->kelas ?? '—' }}</dd>
        </div>
        <div>
            <dt>Status Akun</dt>
            <dd>{{ ucfirst($pengguna?->status ?? 'Aktif') }}</dd>
        </div>
    </dl>

    <div class="form-actions actions">
        <button type="button" class="btn" onclick="bukaModalPassword()">
            🔑 Ganti Password
        </button>
        <a class="btn btn-secondary" href="{{ $pengguna?->role === 'siswa' ? route('siswa.dashboard') : route('dashboard') }}">
            ← Kembali
        </a>
    </div>
</section>

{{-- MODAL GANTI PASSWORD --}}
<div id="modalPassword" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <h2>Ganti Password</h2>
            <button type="button" class="btn-close" onclick="tutupModalPassword()">&times;</button>
        </div>

        @if ($errors->has('password_lama') || $errors->has('password_baru'))
            <div class="alert alert-error">
                {{ $errors->first('password_lama') ?: $errors->first('password_baru') }}
            </div>
        @endif

        <form action="{{ route('profil.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="password_lama">Password Saat Ini</label>
                <input
                    type="password"
                    id="password_lama"
                    name="password_lama"
                    placeholder="Masukkan password saat ini"
                    required
                >
            </div>

            <div class="field">
                <label for="password_baru">Password Baru</label>
                <input
                    type="password"
                    id="password_baru"
                    name="password_baru"
                    placeholder="Minimal 6 karakter"
                    required
                >
            </div>

            <div class="field">
                <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
                <input
                    type="password"
                    id="password_baru_confirmation"
                    name="password_baru_confirmation"
                    placeholder="Ulangi password baru"
                    required
                >
            </div>

            <div class="actions" style="margin-top: 20px;">
                <button type="submit" class="btn">
                    Simpan Password
                </button>
                <button type="button" class="btn btn-secondary" onclick="tutupModalPassword()">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function bukaModalPassword() {
        document.getElementById('modalPassword').classList.add('active');
    }

    function tutupModalPassword() {
        document.getElementById('modalPassword').classList.remove('active');
    }

    document.getElementById('modalPassword').addEventListener('click', function(e) {
        if (e.target === this) {
            tutupModalPassword();
        }
    });

    @if ($errors->has('password_lama') || $errors->has('password_baru'))
        bukaModalPassword();
    @endif
</script>
@endpush

@endsection
