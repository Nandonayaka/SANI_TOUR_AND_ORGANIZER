@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">{{ isset($user) ? 'Edit' : 'Tambah' }} Pengguna</h1>
    <a href="{{ route('users.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">&larr; Kembali ke Daftar</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
        @csrf
        @if(isset($user)) @method('PUT') @endif

        <div style="margin-bottom: 1.5rem;">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required placeholder="John Doe">
            @error('name') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="email">Alamat Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required placeholder="john@example.com">
            @error('email') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="password">Kata Sandi {{ isset($user) ? '(Kosongkan jika tidak ingin mengubah)' : '' }}</label>
            <input type="password" name="password" id="password" {{ isset($user) ? '' : 'required' }} placeholder="••••••••">
            @error('password') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">{{ isset($user) ? 'Perbarui' : 'Tambah' }} Pengguna</button>
    </form>
</div>
@endsection
