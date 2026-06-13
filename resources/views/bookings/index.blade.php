@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 700;">Manajemen Pesanan</h1>
        <p style="color: var(--text-muted);">Kelola pesanan tour dan jadwal keberangkatan Anda</p>
    </div>
    <a href="{{ route('bookings.create') }}" class="btn btn-primary">Tambah Pesanan Baru</a>
</div>

@if(session('success'))
    <div style="background: #ecfdf5; color: #065f46; padding: 1rem; border-radius: var(--radius); margin-bottom: 1.5rem; border: 1px solid #10b981;">
        Berhasil: {{ session('success') }}
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
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>
                            <div style="font-weight: 600;">{{ $booking->user->name }}</div>
                            <div style="font-size: 0.875rem; color: var(--text-muted);">{{ $booking->user->email }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $booking->schedule->tourPackage->tour->name }}</div>
                            <div style="font-size: 0.875rem; color: var(--text-muted);">{{ $booking->schedule->tourPackage->name }}</div>
                        </td>
                        <td>
                            <div style="font-size: 0.875rem;">
                                {{ \Carbon\Carbon::parse($booking->schedule->start_date)->format('d M Y') }}
                            </div>
                        </td>
                        <td>{{ $booking->total_persons }}</td>
                        <td>
                            <div style="font-weight: 600; color: var(--primary);">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </div>
                        </td>
                        <td>
                            <span class="status-pill status-{{ $booking->status }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('bookings.edit', $booking) }}" class="btn" style="background: #f1f5f9; color: var(--text); padding: 0.4rem 0.8rem; font-size: 0.875rem;">Edit</a>
                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-logout" style="padding: 0.4rem 0.8rem; font-size: 0.875rem;">Delete</button>
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

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
    <div class="card" style="padding: 1.5rem;">
        <h3 style="margin-bottom: 1rem; font-size: 1rem;">Quick Stats</h3>
        <div style="display: flex; gap: 1rem;">
            <div style="flex: 1; background: #eff6ff; padding: 1rem; border-radius: var(--radius);">
                <div style="font-size: 0.75rem; color: var(--primary); font-weight: 700; text-transform: uppercase;">Total Tours</div>
                <div style="font-size: 1.5rem; font-weight: 700;">{{ \App\Models\Tour::count() }}</div>
            </div>
            <div style="flex: 1; background: #ecfdf5; padding: 1rem; border-radius: var(--radius);">
                <div style="font-size: 0.75rem; color: #059669; font-weight: 700; text-transform: uppercase;">Total Sales</div>
                <div style="font-size: 1.5rem; font-weight: 700;">{{ $bookings->total() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
