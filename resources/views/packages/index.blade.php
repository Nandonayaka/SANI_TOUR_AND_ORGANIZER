@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col">
        <h2 class="fw-bold m-0">Paket Wisata</h2>
        <p class="text-muted m-0">Daftar harga dan fasilitas tur</p>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createPackageModal">
            <i data-lucide="plus-square" style="width: 18px;"></i>
            <span>Tambah Paket</span>
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
                        <th class="ps-4">Destinasi Wisata</th>
                        <th>Nama Paket</th>
                        <th>Harga per Orang</th>
                        <th class="pe-4 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($packages as $package)
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
                                    <a href="{{ route('packages.edit', $package) }}" class="btn btn-action btn-light text-secondary shadow-sm" title="Sunting">
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
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i data-lucide="package-x" style="width: 48px; height: 48px;" class="mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada paket wisata yang dibuat.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 px-2">
    {{ $packages->links() }}
</div>

<!-- Modal Tambah Paket -->
<div class="modal fade" id="createPackageModal" tabindex="-1" aria-labelledby="createPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPackageModalLabel">
                    <i data-lucide="package-plus" class="me-2 text-primary"></i> Tambah Paket Wisata
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('packages.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Destinasi</label>
                        <select name="tour_id" class="form-select @error('tour_id') is-invalid @enderror" required>
                            <option value="" selected disabled>Pilih wisata...</option>
                            @foreach($tours as $tour)
                                <option value="{{ $tour->id }}" {{ old('tour_id') == $tour->id ? 'selected' : '' }}>{{ $tour->name }}</option>
                            @endforeach
                        </select>
                        @error('tour_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Paket</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name') }}" placeholder="Contoh: Paket Hemat" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                                value="{{ old('price') }}" placeholder="0" required>
                        </div>
                        @error('price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-1">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Berikan detail paket...">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light fw-bold text-secondary border-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Paket</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('createPackageModal'));
        myModal.show();
    });
</script>
@endif
@endsection
