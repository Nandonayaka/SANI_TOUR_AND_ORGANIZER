@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    <div class="card" style="width: 100%; max-width: 400px;">
        <h1 style="margin-bottom: 0.5rem; text-align: center;">Selamat Datang</h1>
        <p style="color: var(--text-muted); text-align: center; margin-bottom: 2rem;">Masuk untuk mengelola tour Anda</p>

        @if($errors->any())
            <div style="color: #ef4444; background: #fef2f2; padding: 1rem; border-radius: var(--radius); margin-bottom: 1rem; font-size: 0.875rem;">
                Login gagal. Silakan periksa kembali email/password Anda.
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" placeholder="admin@example.com" required autofocus>
            </div>
            <div>
                <label for="password">Kata Sandi</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem; padding: 1rem;">Masuk Sekarang</button>
        </form>

        <div style="margin-top: 1.5rem; text-align: center; font-size: 0.875rem; color: var(--text-muted);">
            <p>Demo Admin: admin@example.com / password</p>
        </div>
    </div>
</div>
@endsection
