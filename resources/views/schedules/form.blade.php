@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">{{ isset($schedule) ? 'Edit' : 'Create' }} Schedule</h1>
    <a href="{{ route('schedules.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">&larr; Back to List</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ isset($schedule) ? route('schedules.update', $schedule) : route('schedules.store') }}" method="POST">
        @csrf
        @if(isset($schedule)) @method('PUT') @endif

        <div style="margin-bottom: 1.5rem;">
            <label for="tour_package_id">Select Package</label>
            <select name="tour_package_id" id="tour_package_id" style="width: 100%; padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border); background: white;">
                @foreach($packages as $p)
                    <option value="{{ $p->id }}" {{ (old('tour_package_id', $schedule->tour_package_id ?? '') == $p->id) ? 'selected' : '' }}>
                        {{ $p->tour->name }} - {{ $p->name }}
                    </option>
                @endforeach
            </select>
            @error('tour_package_id') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
            <div style="flex: 1;">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', isset($schedule) ? \Carbon\Carbon::parse($schedule->start_date)->format('Y-m-d') : '') }}" required>
                @error('start_date') <small style="color: red;">{{ $message }}</small> @enderror
            </div>
            <div style="flex: 1;">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', isset($schedule) ? \Carbon\Carbon::parse($schedule->end_date)->format('Y-m-d') : '') }}" required>
                @error('end_date') <small style="color: red;">{{ $message }}</small> @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">{{ isset($schedule) ? 'Update' : 'Create' }} Schedule</button>
    </form>
</div>
@endsection
