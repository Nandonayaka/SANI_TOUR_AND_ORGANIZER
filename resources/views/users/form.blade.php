@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col">
        <h2 class="fw-bold m-0">{{ isset($user) ? 'Edit Akun Staff' : 'Tambah Staff Baru' }}</h2>
        <p class="text-muted m-0">Lengkapi data di bawah untuk {{ isset($user) ? 'memperbarui' : 'mendaftarkan' }} akses sistem</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('users.index') }}" class="btn btn-light d-flex align-items-center gap-2 border shadow-sm">
            <i data-lucide="arrow-left" style="width: 18px;"></i>
            <span>Batal</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
                    @csrf
                    @if(isset($user)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted" for="name">NAMA LENGKAP</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required placeholder="Masukkan nama lengkap">
                        @error('name') <small class="text-danger small mt-1 d-block">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted" for="email">ALAMAT EMAIL</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required placeholder="nama@sani-tour.id">
                        @error('email') <small class="text-danger small mt-1 d-block">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted" for="password">
                            KATA SANDI {{ isset($user) ? '(KOSONGKAN JIKA TIDAK INGIN MENGUBAH)' : '' }}
                        </label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control" {{ isset($user) ? '' : 'required' }} placeholder="••••••••" style="padding-right: 40px;">
                            <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted border-0 d-flex align-items-center" onclick="togglePassword('password', this)" style="height: 100%; text-decoration: none; padding-right: 0.8rem;">
                                <i data-lucide="eye" style="width: 18px;"></i>
                            </button>
                        </div>
                        @error('password') <small class="text-danger small mt-1 d-block">{{ $message }}</small> @enderror
                    </div>

                    <hr class="my-4 opacity-10">

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                        <i data-lucide="{{ isset($user) ? 'save' : 'plus-circle' }}" class="me-2" style="width: 18px;"></i>
                        {{ isset($user) ? 'Simpan Perubahan' : 'Daftarkan Staff' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('[data-lucide]');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }
</script>
@endsection
