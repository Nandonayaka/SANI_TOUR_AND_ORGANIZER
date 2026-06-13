@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col">
        <h2 class="fw-bold m-0">Penjadwalan</h2>
        <p class="text-muted m-0">Atur kalender tiket dan keberangkatan</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('schedules.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i data-lucide="calendar-plus" style="width: 18px;"></i>
            <span>Buat Jadwal</span>
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
                        <th class="ps-4">Tiket Wisata</th>
                        <th>Tanggal Berangkat</th>
                        <th>Tanggal Pulang</th>
                        <th class="text-center">Durasi</th>
                        <th class="pe-4 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($schedules as $schedule)
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
                                    <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-action btn-light text-secondary shadow-sm" title="Edit">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 px-2">
    {{ $schedules->links() }}
</div>
@endsection
