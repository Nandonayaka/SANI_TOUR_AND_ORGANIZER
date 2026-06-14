@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="mb-4">
            <h2 class="fw-bold m-0">{{ isset($package) ? 'Sunting' : 'Tambah' }} Paket</h2>
            <p class="text-muted m-0 small">Lengkapi detail paket wisata</p>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ isset($package) ? route('packages.update', $package) : route('packages.store') }}" method="POST">
                    @csrf
                    @if(isset($package)) @method('PUT') @endif

                    <div class="mb-4">
                        <label class="form-label">Destinasi Wisata</label>
                        <select name="tour_id" class="form-select @error('tour_id') is-invalid @enderror" required>
                            <option value="" disabled {{ !isset($package) ? 'selected' : '' }}>Pilih wisata...</option>
                            @foreach($tours as $tour)
                                <option value="{{ $tour->id }}" {{ (old('tour_id', $package->tour_id ?? '') == $tour->id) ? 'selected' : '' }}>
                                    {{ $tour->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tour_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Nama Paket</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name', $package->name ?? '') }}" placeholder="Contoh: Paket Premium Bali" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Harga (IDR)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                                value="{{ old('price', $package->price ?? '') }}" placeholder="0" required>
                        </div>
                        @error('price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Deskripsi (Opsional)</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" 
                            placeholder="Tuliskan fasilitas atau detail lainnya...">{{ old('description', $package->description ?? '') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('packages.index') }}" class="btn btn-light fw-bold text-secondary border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                            <i data-lucide="save" class="me-2" style="width: 18px;"></i>
                            {{ isset($package) ? 'Simpan Perubahan' : 'Buat Paket' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
