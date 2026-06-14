@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col">
        <h2 class="fw-bold m-0">Riwayat Pesanan</h2>
        <p class="text-muted m-0">Data transaksi pelangan terbaru</p>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createBookingModal">
            <i data-lucide="plus-circle" style="width: 18px;"></i>
            <span>Tambah Pesanan</span>
        </button>
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

@if($errors->any())
    <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center gap-3 mb-4" role="alert">
        <div class="bg-danger text-white rounded-circle p-1 d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
            <i data-lucide="alert-circle" style="width: 16px;"></i>
        </div>
        <div class="fw-bold">Gagal menyimpan data. Periksa kembali form Anda.</div>
    </div>
@endif

<div class="card shadow-sm col-lg-12">
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
                    @forelse($bookings as $booking)
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
                            <td class="text-center">
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
                                    <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-action btn-light text-secondary shadow-sm" title="Sunting">
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
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i data-lucide="shopping-cart" style="width: 48px; height: 48px;" class="mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada pesanan yang tercatat.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 px-2">
    {{ $bookings->links() }}
</div>

<!-- Modal Tambah Pesanan -->
<div class="modal fade" id="createBookingModal" tabindex="-1" aria-labelledby="createBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBookingModalLabel">
                    <i data-lucide="plus-circle" class="me-2 text-primary"></i> Buat Pesanan Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Pelanggan</label>
                            <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" placeholder="Andi Wijaya" required>
                            @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') }}" placeholder="08123xxxx">
                            @error('customer_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Pilih Jadwal Wisata</label>
                            <select name="schedule_id" class="form-select @error('schedule_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Pilih jadwal...</option>
                                @foreach($schedules as $s)
                                    <option value="{{ $s->id }}" {{ old('schedule_id') == $s->id ? 'selected' : '' }}>
                                        {{ $s->tourPackage->tour->name }} - {{ $s->tourPackage->name }} ({{ \Carbon\Carbon::parse($s->start_date)->format('d M Y') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('schedule_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jumlah Orang (Pax)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-lucide="users" style="width: 16px;"></i></span>
                                <input type="number" name="total_persons" class="form-control @error('total_persons') is-invalid @enderror" value="{{ old('total_persons', 1) }}" min="1" required>
                            </div>
                            @error('total_persons') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Diterima / Lunas</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light fw-bold text-secondary border-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('createBookingModal'));
        myModal.show();
    });
</script>
@endif
@endsection
