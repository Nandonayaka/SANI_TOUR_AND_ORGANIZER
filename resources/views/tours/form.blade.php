@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 1.5rem; font-weight: 700;">{{ isset($tour) ? 'Edit' : 'Tambah' }} Wisata</h1>
    <a href="{{ route('tours.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">&larr; Kembali ke Daftar</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ isset($tour) ? route('tours.update', $tour) : route('tours.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($tour)) @method('PUT') @endif

        <div style="margin-bottom: 1.5rem;">
            <label for="name">Nama Wisata</label>
            <input type="text" name="name" id="name" value="{{ old('name', $tour->name ?? '') }}" required placeholder="Contoh: Bali Paradise">
            @error('name') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="5" style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-family: inherit;">{{ old('description', $tour->description ?? '') }}</textarea>
            @error('description') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="image">Foto Wisata</label>
            @if(isset($tour) && $tour->image)
                <div style="margin-bottom: 1rem;">
                    <img src="{{ asset('storage/' . $tour->image) }}" alt="Preview" style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 8px; border: 1px solid var(--sidebar-border);">
                </div>
            @endif
            <input type="file" name="image" id="image" accept="image/*">
            <small style="color: var(--text-muted);">Pilih file gambar (JPG, PNG, max 2MB)</small>
            @error('image') <small style="color: red; display: block; margin-top: 5px;">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.75rem;">{{ isset($tour) ? 'Perbarui' : 'Simpan' }} Wisata</button>
    </form>
</div>
@endsection
