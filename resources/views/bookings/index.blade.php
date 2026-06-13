@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col">
        <h2 class="fw-bold m-0">Riwayat Pesanan</h2>
        <p class="text-muted m-0">Data transaksi pelangan terbaru</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('bookings.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i data-lucide="plus-circle" style="width: 18px;"></i>
            <span>Tambah Pesanan</span>
        </a>
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

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <thead>
                    <tr>
                        <th class="ps-4">Pelanggan</th>
                        <th>Destinasi & Paket</th>
                        <th>Tanggal</th>
                        <th>Pax</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th class="pe-4 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($bookings as $booking)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $booking->customer_name }}</div>
                                <div class="text-muted small">{{ $booking->customer_phone ?? 'Tanpa Telepon' }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $booking->schedule->tourPackage->tour->name }}</div>
                                <div class="text-muted small badge bg-light border text-dark fw-normal">{{ $booking->schedule->tourPackage->name }}</div>
                            </td>
                            <td>
                                <div class="fw-medium text-dark">{{ \Carbon\Carbon::parse($booking->schedule->start_date)->format('d/m/Y') }}</div>
                            </td>
                            <td>
                                <span class="fw-bold">{{ $booking->total_persons }}</span>
                            </td>
                            <td>
                                <div class="fw-bold text-primary">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                            </td>
                            <td>
                                @if($booking->status == 'confirmed')
                                    <span class="status-pill bg-success-subtle text-success">
                                        <i data-lucide="check-circle-2" style="width: 12px;" class="me-1"></i> Diterima
                                    </span>
                                @else
                                    <span class="status-pill bg-warning-subtle text-warning-emphasis">
                                        <i data-lucide="clock" style="width: 12px;" class="me-1"></i> Pending
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-action btn-light text-secondary shadow-sm" title="Edit Data">
                                        <i data-lucide="edit-2" style="width: 18px;"></i>
                                    </a>
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Hapus data pesanan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-action btn-light text-danger shadow-sm" title="Hapus Data">
                                            <i data-lucide="trash-2" style="width: 18px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 px-2">
    {{ $bookings->links() }}
</div>
@endsection
