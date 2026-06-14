@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="mb-4">
            <h2 class="fw-bold m-0">{{ isset($schedule) ? 'Sunting' : 'Tambah' }} Jadwal</h2>
            <p class="text-muted m-0 small">Lengkapi data jadwal keberangkatan</p>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ isset($schedule) ? route('schedules.update', $schedule) : route('schedules.store') }}" method="POST">
                    @csrf
                    @if(isset($schedule)) @method('PUT') @endif

                    <div class="mb-4">
                        <label class="form-label">Tiket / Paket Wisata</label>
                        <select name="tour_package_id" class="form-select @error('tour_package_id') is-invalid @enderror" required>
                            <option value="" disabled {{ !isset($schedule) ? 'selected' : '' }}>Pilih paket...</option>
                            @foreach($packages as $p)
                                <option value="{{ $p->id }}" {{ (old('tour_package_id', $schedule->tour_package_id ?? '') == $p->id) ? 'selected' : '' }}>
                                    {{ $p->tour->name }} - {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tour_package_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Tanggal Berangkat</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i data-lucide="calendar" style="width: 16px;"></i></span>
                                <input type="date" name="start_date" class="form-control border-start-0 ps-0 @error('start_date') is-invalid @enderror" 
                                    value="{{ old('start_date', isset($schedule) ? \Carbon\Carbon::parse($schedule->start_date)->format('Y-m-d') : '') }}" required>
                            </div>
                            @error('start_date') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Tanggal Pulang</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0 text-secondary"><i data-lucide="calendar" style="width: 16px;"></i></span>
                                <input type="date" name="end_date" class="form-control border-start-0 ps-0 @error('end_date') is-invalid @enderror" 
                                    value="{{ old('end_date', isset($schedule) ? \Carbon\Carbon::parse($schedule->end_date)->format('Y-m-d') : '') }}" required>
                            </div>
                            @error('end_date') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('schedules.index') }}" class="btn btn-light fw-bold text-secondary border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                            <i data-lucide="save" class="me-2" style="width: 18px;"></i>
                            {{ isset($schedule) ? 'Simpan Perubahan' : 'Buat Jadwal' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
