@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">{{ isset($tour) ? 'Edit' : 'Tambah' }} Wisata</h1>
    <a href="{{ route('tours.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">&larr; Kembali ke Daftar</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ isset($tour) ? route('tours.update', $tour) : route('tours.store') }}" method="POST">
        @csrf
        @if(isset($tour)) @method('PUT') @endif

        <div style="margin-bottom: 1.5rem;">
            <label for="name">Nama Wisata</label>
            <input type="text" name="name" id="name" value="{{ old('name', $tour->name ?? '') }}" required placeholder="Contoh: Bali Paradise">
            @error('name') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="5" style="width: 100%; padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border); font-family: inherit;">{{ old('description', $tour->description ?? '') }}</textarea>
            @error('description') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="image">URL Gambar</label>
            <input type="text" name="image" id="image" value="{{ old('image', $tour->image ?? '') }}" placeholder="https://example.com/image.jpg">
            @error('image') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">{{ isset($tour) ? 'Perbarui' : 'Tambah' }} Wisata</button>
    </form>
</div>
@endsection
