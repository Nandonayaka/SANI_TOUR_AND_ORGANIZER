@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col">
        <h2 class="fw-bold m-0">Akses Pengguna</h2>
        <p class="text-muted m-0">Kelola akun Admin dan Staff sistem</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('users.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i data-lucide="user-plus" style="width: 18px;"></i>
            <span>Tambah Staff</span>
        </a>
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

<div class="card shadow-sm col-lg-10">
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
                    @foreach($users as $user)
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
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-action btn-light text-secondary shadow-sm" title="Edit Akun">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 px-2">
    {{ $users->links() }}
</div>
@endsection
