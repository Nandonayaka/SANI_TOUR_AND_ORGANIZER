@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col">
        <h2 class="fw-bold m-0">Katalog Wisata</h2>
        <p class="text-muted m-0">Daftar destinasi wisata yang tersedia</p>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createTourModal">
            <i data-lucide="map-pin" style="width: 18px;"></i>
            <span>Tambah Wisata</span>
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

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 120px;">Pratinjau</th>
                        <th>Destinasi</th>
                        <th>Deskripsi Singkat</th>
                        <th class="pe-4 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($tours as $tour)
                        <tr>
                            <td class="ps-4">
                                @if($tour->image)
                                    <div class="position-relative overflow-hidden rounded-3 shadow-sm" style="width: 80px; height: 60px;">
                                        <img src="{{ asset('storage/' . $tour->image) }}" class="w-100 h-100 object-fit-cover">
                                    </div>
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted border shadow-sm" style="width: 80px; height: 60px;">
                                        <i data-lucide="image" style="width: 20px;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $tour->name }}</div>
                            </td>
                            <td>
                                <div class="text-muted small lh-base" style="max-width: 450px;">
                                    {{ Str::limit($tour->description, 140) }}
                                </div>
                            </td>
                            <td class="pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('tours.edit', $tour) }}" class="btn btn-action btn-light text-secondary shadow-sm" title="Sunting">
                                        <i data-lucide="edit-3" style="width: 18px;"></i>
                                    </a>
                                    <form action="{{ route('tours.destroy', $tour) }}" method="POST" onsubmit="return confirm('Hapus destinasi wisata ini?')">
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
                                <i data-lucide="map" style="width: 48px; height: 48px;" class="mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada destinasi wisata yang terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 px-2">
    {{ $tours->links() }}
</div>

<!-- Modal Tambah Wisata -->
<div class="modal fade" id="createTourModal" tabindex="-1" aria-labelledby="createTourModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTourModalLabel">
                    <i data-lucide="map-pin" class="me-2 text-primary"></i> Tambah Destinasi Wisata
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('tours.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label">Nama Destinasi</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                    value="{{ old('name') }}" placeholder="Contoh: Pulau Komodo" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                    rows="10" placeholder="Tuliskan deskripsi lengkap destinasi...">{{ old('description') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Foto Utama</label>
                            <div class="bg-light border border-dashed rounded-4 d-flex flex-column align-items-center justify-content-center text-muted mb-3" style="height: 200px;" id="imagePreviewContainer">
                                <i data-lucide="image-plus" style="width: 32px; height: 32px;" class="mb-2"></i>
                                <div class="small fw-medium">Pilih file gambar</div>
                            </div>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                            <div class="form-text small mt-2">Maks. 5MB (JPG/PNG)</div>
                            @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light fw-bold text-secondary border-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Destinasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        const container = document.getElementById('imagePreviewContainer');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                container.innerHTML = `<img src="${e.target.result}" class="w-100 h-100 object-fit-cover rounded-4">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    @if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('createTourModal'));
        myModal.show();
    });
    @endif
</script>
@endsection
