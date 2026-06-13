@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">{{ isset($package) ? 'Edit' : 'Create' }} Package</h1>
    <a href="{{ route('packages.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">&larr; Back to List</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ isset($package) ? route('packages.update', $package) : route('packages.store') }}" method="POST">
        @csrf
        @if(isset($package)) @method('PUT') @endif

        <div style="margin-bottom: 1.5rem;">
            <label for="tour_id">Select Tour</label>
            <select name="tour_id" id="tour_id" style="width: 100%; padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border); background: white;">
                @foreach($tours as $tour)
                    <option value="{{ $tour->id }}" {{ (old('tour_id', $package->tour_id ?? '') == $tour->id) ? 'selected' : '' }}>{{ $tour->name }}</option>
                @endforeach
            </select>
            @error('tour_id') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="name">Package Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $package->name ?? '') }}" required placeholder="e.g. VIP Bali Trip">
            @error('name') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="price">Price (IDR)</label>
            <input type="number" name="price" id="price" value="{{ old('price', $package->price ?? '') }}" required placeholder="500000">
            @error('price') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="description">Description (Optional)</label>
            <textarea name="description" id="description" rows="3" style="width: 100%; padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border); font-family: inherit;">{{ old('description', $package->description ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">{{ isset($package) ? 'Update' : 'Create' }} Package</button>
    </form>
</div>
@endsection
