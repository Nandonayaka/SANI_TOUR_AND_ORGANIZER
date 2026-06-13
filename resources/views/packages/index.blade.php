@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 700;">Paket Wisata</h1>
        <p style="color: var(--text-muted);">Kelola paket untuk setiap destinasi wisata</p>
    </div>
    <a href="{{ route('packages.create') }}" class="btn btn-primary">
        <i data-lucide="plus"></i> Tambah Paket
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
                    <th>Wisata</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td style="font-weight: 600;">{{ $package->tour->name }}</td>
                        <td>{{ $package->name }}</td>
                        <td style="color: var(--primary); font-weight: 700;">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                        <td>
                            <div style="display: flex; gap: 0.25rem;">
                                <a href="{{ route('packages.edit', $package) }}" class="btn btn-secondary btn-icon" title="Edit">
                                    <i data-lucide="edit" style="width: 16px; height: 16px;"></i>
                                </a>
                                <form action="{{ route('packages.destroy', $package) }}" method="POST" onsubmit="return confirm('Hapus paket ini?')">
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
        {{ $packages->links() }}
    </div>
</div>
@endsection
