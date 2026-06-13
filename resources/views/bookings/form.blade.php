@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">
        <div class="d-flex align-items-center gap-3 mb-5">
            <a href="{{ route('bookings.index') }}" class="btn btn-light rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;">
                <i data-lucide="arrow-left" style="width: 20px;"></i>
            </a>
            <div>
                <h2 class="fw-bold m-0">{{ isset($booking) ? 'Edit' : 'Buat' }} Pesanan</h2>
                <p class="text-muted m-0 small">Lengkapi formulir di bawah untuk mencatat transaksi</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-white border-bottom p-4">
                <h5 class="fw-bold m-0 text-primary d-flex align-items-center gap-2">
                    <i data-lucide="clipboard-list" style="width: 20px;"></i> Detail Transaksi
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($booking) ? route('bookings.update', $booking) : route('bookings.store') }}" method="POST">
                    @csrf
                    @if(isset($booking)) @method('PUT') @endif

                    <div class="row g-4">
                        <div class="col-md-7">
                            <label class="form-label fw-bold small text-muted">NAMA LENGKAP PELANGGAN</label>
                            <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name', $booking->customer_name ?? '') }}" required placeholder="Contoh: Andi Wijaya">
                            @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-5">
                            <label class="form-label fw-bold small text-muted">NOMOR TELEPON / WHATSAPP</label>
                            <input type="text" name="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone', $booking->customer_phone ?? '') }}" placeholder="08123xxx">
                            @error('customer_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">PILIH DESTINASI & PAKET JADWAL</label>
                            <select name="schedule_id" class="form-select @error('schedule_id') is-invalid @enderror">
                                @foreach($schedules as $s)
                                    <option value="{{ $s->id }}" {{ (old('schedule_id', $booking->schedule_id ?? '') == $s->id) ? 'selected' : '' }}>
                                        {{ $s->tourPackage->tour->name }} - {{ $s->tourPackage->name }} ({{ \Carbon\Carbon::parse($s->start_date)->format('d M Y') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('schedule_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">JUMLAH PESERTA (PAX)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i data-lucide="users" style="width: 16px;"></i></span>
                                <input type="number" name="total_persons" class="form-control @error('total_persons') is-invalid @enderror" value="{{ old('total_persons', $booking->total_persons ?? 1) }}" required min="1">
                                <span class="input-group-text bg-light text-muted">Orang</span>
                            </div>
                            @error('total_persons') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">STATUS PESANAN</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="pending" {{ (old('status', $booking->status ?? '') == 'pending') ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                <option value="confirmed" {{ (old('status', $booking->status ?? '') == 'confirmed') ? 'selected' : '' }}>Diterima / Lunas</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-5 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">
                            <i data-lucide="save" style="width: 18px;" class="me-2"></i> Simpan Data
                        </button>
                        <a href="{{ route('bookings.index') }}" class="btn btn-light px-4">Batalkan</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
