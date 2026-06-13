@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 700;">Jadwal Wisata</h1>
        <p style="color: var(--text-muted);">Kelola tanggal keberangkatan tour</p>
    </div>
    <a href="{{ route('schedules.create') }}" class="btn btn-primary">
        <i data-lucide="plus"></i> Tambah Jadwal
    </a>
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
                    <th>Wisata & Paket</th>
                    <th>Tgl Berangkat</th>
                    <th>Tgl Pulang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                    <tr>
                        <td>
                            <div style="font-weight: 600;">{{ $schedule->tourPackage->tour->name }}</div>
                            <div style="font-size: 0.875rem; color: var(--text-muted);">{{ $schedule->tourPackage->name }}</div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->end_date)->format('d M Y') }}</td>
                        <td>
                            <div style="display: flex; gap: 0.25rem;">
                                <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-secondary btn-icon" title="Edit">
                                    <i data-lucide="edit" style="width: 16px; height: 16px;"></i>
                                </a>
                                <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
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
        {{ $schedules->links() }}
    </div>
</div>
@endsection
