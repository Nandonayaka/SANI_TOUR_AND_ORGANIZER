@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; font-weight: 700;">{{ isset($booking) ? 'Edit' : 'Buat' }} Pesanan</h1>
    <a href="{{ route('bookings.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">&larr; Kembali ke Daftar</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ isset($booking) ? route('bookings.update', $booking) : route('bookings.store') }}" method="POST">
        @csrf
        @if(isset($booking)) @method('PUT') @endif

        <div style="margin-bottom: 1.5rem;">
            <label for="user_id">Pilih Pelanggan</label>
            <select name="user_id" id="user_id" style="width: 100%; padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border); background: white;">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ (old('user_id', $booking->user_id ?? '') == $user->id) ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
            @error('user_id') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="schedule_id">Pilih Jadwal</label>
            <select name="schedule_id" id="schedule_id" style="width: 100%; padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border); background: white;">
                @foreach($schedules as $s)
                    <option value="{{ $s->id }}" {{ (old('schedule_id', $booking->schedule_id ?? '') == $s->id) ? 'selected' : '' }}>
                        {{ $s->tourPackage->tour->name }} - {{ $s->tourPackage->name }} ({{ \Carbon\Carbon::parse($s->start_date)->format('d M Y') }})
                    </option>
                @endforeach
            </select>
            @error('schedule_id') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="total_persons">Jumlah Orang</label>
            <input type="number" name="total_persons" id="total_persons" value="{{ old('total_persons', $booking->total_persons ?? 1) }}" required min="1">
            @error('total_persons') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label for="status">Status</label>
            <select name="status" id="status" style="width: 100%; padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border); background: white;">
                <option value="pending" {{ (old('status', $booking->status ?? '') == 'pending') ? 'selected' : '' }}>Menunggu</option>
                <option value="confirmed" {{ (old('status', $booking->status ?? '') == 'confirmed') ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="cancelled" {{ (old('status', $booking->status ?? '') == 'cancelled') ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            @error('status') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">{{ isset($booking) ? 'Perbarui' : 'Buat' }} Pesanan</button>
    </form>
</div>
@endsection
