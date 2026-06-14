@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col">
        <h2 class="fw-bold m-0">Penjadwalan</h2>
        <p class="text-muted m-0">Atur kalender tiket dan keberangkatan</p>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createScheduleModal">
            <i data-lucide="calendar-plus" style="width: 18px;"></i>
            <span>Buat Jadwal</span>
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

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <thead>
                    <tr>
                        <th class="ps-4">Tiket Wisata</th>
                        <th>Tanggal Berangkat</th>
                        <th>Tanggal Pulang</th>
                        <th class="text-center">Durasi</th>
                        <th class="pe-4 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($schedules as $schedule)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $schedule->tourPackage->tour->name }}</div>
                                <div class="text-muted small fs-7">{{ $schedule->tourPackage->name }}</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2 text-dark fw-medium">
                                    <i data-lucide="calendar" style="width: 14px;" class="text-primary"></i>
                                    {{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2 text-dark fw-medium">
                                    <i data-lucide="calendar" style="width: 14px;" class="text-secondary"></i>
                                    {{ \Carbon\Carbon::parse($schedule->end_date)->format('d M Y') }}
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3">
                                    {{ \Carbon\Carbon::parse($schedule->start_date)->diffInDays(\Carbon\Carbon::parse($schedule->end_date)) }} Hari
                                </span>
                            </td>
                            <td class="pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-action btn-light text-secondary shadow-sm" title="Sunting">
                                        <i data-lucide="edit-3" style="width: 18px;"></i>
                                    </a>
                                    <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-action btn-light text-danger shadow-sm" title="Hapus">
                                            <i data-lucide="trash-2" style="width: 18px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i data-lucide="calendar-x" style="width: 48px; height: 48px;" class="mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada jadwal yang dibuat.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 px-2">
    {{ $schedules->links() }}
</div>

<!-- Modal Tambah Jadwal -->
<div class="modal fade" id="createScheduleModal" tabindex="-1" aria-labelledby="createScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createScheduleModalLabel">
                    <i data-lucide="calendar-plus" class="me-2 text-primary"></i> Buat Jadwal Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('schedules.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label">Pilih Paket Wisata</label>
                        <select name="tour_package_id" class="form-select @error('tour_package_id') is-invalid @enderror" required>
                            <option value="" selected disabled>Pilih paket...</option>
                            @foreach($packages as $p)
                                <option value="{{ $p->id }}" {{ old('tour_package_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->tour->name }} - {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tour_package_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Berangkat</label>
                            <div class="input-group">
                                <span class="input-group-text"><i data-lucide="calendar" style="width: 16px;"></i></span>
                                <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" required>
                            </div>
                            @error('start_date') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pulang</label>
                            <div class="input-group">
                                <span class="input-group-text text-secondary"><i data-lucide="calendar" style="width: 16px;"></i></span>
                                <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}" required>
                            </div>
                            @error('end_date') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light fw-bold text-secondary border-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('createScheduleModal'));
        myModal.show();
    });
</script>
@endif
@endsection
