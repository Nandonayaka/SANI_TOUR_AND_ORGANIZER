@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col">
        <h2 class="fw-bold m-0">Akses Pengguna</h2>
        <p class="text-muted m-0">Kelola akun Admin dan Staff sistem</p>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createStaffModal">
            <i data-lucide="user-plus" style="width: 18px;"></i>
            <span>Tambah Staff</span>
        </button>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-3 mb-4" role="alert">
        <div class="bg-success text-white rounded-circle p-1 d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
            <i data-lucide="check" style="width: 16px;"></i>
        </div>
        <div class="fw-bold">{{ session('success') }}</div>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center gap-3 mb-4" role="alert">
        <div class="bg-danger text-white rounded-circle p-1 d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
            <i data-lucide="alert-circle" style="width: 16px;"></i>
        </div>
        <div class="fw-bold">Gagal menyimpan data. Periksa kembali form Anda.</div>
    </div>
@endif

<div class="card shadow-sm col-lg-12">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <thead>
                    <tr>
                        <th class="ps-4">Nama</th>
                        <th>Email</th>
                        <th>Bergabung</th>
                        <th class="pe-4 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($users as $user)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold small" style="width: 32px; height: 32px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="fw-bold text-dark">
                                        {{ $user->name }}
                                        @if($user->id == auth()->id())
                                            <span class="badge bg-primary text-white border-0 ms-1 px-2" style="font-size: 0.6rem;">SAYA</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-muted">{{ $user->email }}</span></td>
                            <td><div class="text-muted small">{{ $user->created_at->format('d M Y') }}</div></td>
                            <td class="pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-action btn-light text-secondary shadow-sm" title="Sunting">
                                        <i data-lucide="settings" style="width: 18px;"></i>
                                    </a>
                                    @if($user->id != auth()->id())
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus akses pengguna ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-action btn-light text-danger shadow-sm" title="Hapus Akun">
                                                <i data-lucide="user-minus" style="width: 18px;"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i data-lucide="users-2" style="width: 48px; height: 48px;" class="mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada user staff yang terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 px-2">
    {{ $users->links() }}
</div>

<!-- Modal Tambah Staff -->
<div class="modal fade" id="createStaffModal" tabindex="-1" aria-labelledby="createStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createStaffModalLabel">
                    <i data-lucide="user-plus" class="me-2 text-primary"></i> Tambah Staff Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama..." required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="modal_password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required style="padding-right: 40px;">
                            <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted border-0" onclick="togglePassword('modal_password', this)">
                                <i data-lucide="eye" style="width: 18px;"></i>
                            </button>
                        </div>
                        @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light fw-bold text-secondary border-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Daftarkan Staff</button>
                </div>
            </form>
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

    @if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('createStaffModal'));
        myModal.show();
    });
    @endif
</script>
@endsection
