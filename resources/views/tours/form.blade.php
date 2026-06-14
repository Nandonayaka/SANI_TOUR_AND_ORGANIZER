@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-9">
        <div class="mb-4">
            <h2 class="fw-bold m-0">{{ isset($tour) ? 'Sunting' : 'Tambah' }} Wisata</h2>
            <p class="text-muted m-0 small">Kelola informasi destinasi dan galeri foto</p>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-white border-bottom p-4">
                <h5 class="fw-bold m-0 text-primary d-flex align-items-center gap-2">
                    <i data-lucide="info" style="width: 20px;"></i> Informasi Destinasi
                </h5>
            </div>
            <div class="card-body p-4 text-center d-flex flex-column align-items-center">
                <form action="{{ isset($tour) ? route('tours.update', $tour) : route('tours.store') }}" method="POST" enctype="multipart/form-data" class="w-100 text-start">
                    @csrf
                    @if(isset($tour)) @method('PUT') @endif

                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">NAMA DESTINASI</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $tour->name ?? '') }}" required placeholder="Contoh: Labuan Bajo">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">DESKRIPSI LENGKAP</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="8" placeholder="Tuliskan deskripsi menarik tentang tempat ini...">{{ old('description', $tour->description ?? '') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label fw-bold small text-muted">FOTO PREVIEW</label>
                            <div class="mb-3">
                                @if(isset($tour) && $tour->image)
                                    <div class="position-relative mb-3 border rounded-4 overflow-hidden shadow-sm shadow-hover" style="height: 200px;">
                                        <img src="{{ asset('storage/' . $tour->image) }}" class="w-100 h-100 object-fit-cover">
                                        <div class="position-absolute bottom-0 start-0 w-100 p-2 bg-dark bg-opacity-50 text-white small text-center">Foto Saat Ini</div>
                                    </div>
                                @else
                                    <div class="bg-light border border-dashed rounded-4 d-flex flex-column align-items-center justify-content-center text-muted mb-3" style="height: 200px;">
                                        <i data-lucide="image-plus" style="width: 32px; height: 32px;" class="mb-2"></i>
                                        <div class="small fw-medium">Belum ada foto</div>
                                    </div>
                                @endif
                                
                                <div class="input-group">
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                </div>
                                <div class="form-text small mt-2">Maksimal ukuran file 5MB (JPG/PNG)</div>
                                @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-3 border-top d-flex justify-content-end gap-2">
                        <a href="{{ route('tours.index') }}" class="btn btn-light fw-bold text-secondary border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i data-lucide="save" style="width: 18px;" class="me-2"></i> Simpan Destinasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
