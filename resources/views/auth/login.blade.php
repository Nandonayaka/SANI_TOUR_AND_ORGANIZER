@extends('layouts.app')

@section('content')
<div class="card" style="width: 100%; max-width: 360px; padding: 2rem;">
    <h1 style="text-align: center; margin-bottom: 0.5rem; color: var(--primary);">SANI TOUR</h1>
    <p style="text-align: center; color: var(--text-muted); font-size: 0.9rem; margin-bottom: 2rem;">Silakan login untuk melanjutkan</p>

    @if($errors->any())
        <div style="color: #b91c1c; font-size: 0.85rem; margin-bottom: 1rem; text-align: center;"> Email atau password salah. </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label>Email</label>
        <input type="email" name="email" required autofocus>
        
        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 0.75rem;">Login</button>
    </form>
    
    <div style="margin-top: 1.5rem; text-align: center; color: var(--text-muted); font-size: 0.75rem;">
        admin@example.com / password
    </div>
</div>
@endsection
