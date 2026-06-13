@extends('layouts.app')

@section('content')
<div class="card login-card p-4 shadow-lg border-0" style="max-width: 420px; width: 100%;">
    <div class="text-center mb-5">
        <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
            <i data-lucide="shield-check" style="width: 32px; height: 32px;"></i>
        </div>
        <h2 class="fw-bold text-dark">Selamat Datang</h2>
        <p class="text-muted small">Silakan masuk untuk mengelola Sani Tour</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger py-2 text-center border-0 small mb-4">
            <i data-lucide="alert-circle" style="width: 14px;" class="me-1"></i> Email atau password salah.
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-bold text-muted">ALAMAT EMAIL</label>
            <input type="email" name="email" class="form-control" required autofocus placeholder="admin@example.com">
        </div>
        
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <label class="form-label small fw-bold text-muted">KATA SANDI</label>
            </div>
            <input type="password" name="password" class="form-control" required placeholder="••••••••">
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">Masuk Sekarang</button>
    </form>
    
    <div class="mt-5 text-center text-muted small border-top pt-3">
        Dikelola oleh <span class="fw-bold">Sani Tour Admin</span>
    </div>
</div>
@endsection
