@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Manajemen Pesanan</h1>
    <a href="{{ route('bookings.create') }}" class="btn btn-primary">
        <i data-lucide="plus"></i> Tambah Pesanan
    </a>
</div>

@if(session('success'))
    <div style="background: #ecfdf5; color: #065f46; padding: 0.75rem; border-radius: 6px; margin-bottom: 1.5rem; font-size: 0.9rem; border: 1px solid #10b981;">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Wisata & Paket</th>
                    <th>Jadwal</th>
                    <th>Orang</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>
                            <div style="font-weight: 600;">{{ $booking->user->name }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $booking->user->email }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $booking->schedule->tourPackage->tour->name }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $booking->schedule->tourPackage->name }}</div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($booking->schedule->start_date)->format('d M Y') }}</td>
                        <td>{{ $booking->total_persons }}</td>
                        <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-pill status-{{ $booking->status }}">
                                {{ $booking->status == 'confirmed' ? 'Diterima' : 'Pending' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.25rem;">
                                <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-secondary btn-icon" title="Edit">
                                    <i data-lucide="edit" style="width: 16px; height: 16px;"></i>
                                </a>
                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-icon" title="Hapus">
                                        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
