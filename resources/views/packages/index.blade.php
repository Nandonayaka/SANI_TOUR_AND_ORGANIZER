@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col">
        <h2 class="fw-bold m-0">Paket Wisata</h2>
        <p class="text-muted m-0">Daftar harga dan fasilitas tur</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('packages.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i data-lucide="plus-square" style="width: 18px;"></i>
            <span>Tambah Paket</span>
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

<div class="card shadow-sm col-lg-11">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <thead>
                    <tr>
                        <th class="ps-4">Destinasi Wisata</th>
                        <th>Nama Paket</th>
                        <th>Harga per Orang</th>
                        <th class="pe-4 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($packages as $package)
                        <tr>
                            <td class="ps-4 fw-bold text-dark">{{ $package->tour->name }}</td>
                            <td>
                                <span class="badge bg-light text-dark border fw-medium px-3 py-2 rounded-3">
                                    {{ $package->name }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-primary">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('packages.edit', $package) }}" class="btn btn-action btn-light text-secondary shadow-sm" title="Edit">
                                        <i data-lucide="edit-3" style="width: 18px;"></i>
                                    </a>
                                    <form action="{{ route('packages.destroy', $package) }}" method="POST" onsubmit="return confirm('Hapus paket ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-action btn-light text-danger shadow-sm" title="Hapus">
                                            <i data-lucide="trash-2" style="width: 18px;"></i>
                                        </button>
                                    </form>
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
    {{ $packages->links() }}
</div>
@endsection
