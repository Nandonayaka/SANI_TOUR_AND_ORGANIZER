@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 700;">Wisata</h1>
        <p style="color: var(--text-muted);">Kelola destinasi wisata Anda</p>
    </div>
    <a href="{{ route('tours.create') }}" class="btn btn-primary">Tambah Wisata Baru</a>
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
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tours as $tour)
                    <tr>
                        <td style="font-weight: 600;">{{ $tour->name }}</td>
                        <td style="color: var(--text-muted); font-size: 0.875rem; max-width: 300px;">{{ Str::limit($tour->description, 100) }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('tours.edit', $tour) }}" class="btn" style="background: #f1f5f9; color: var(--text); padding: 0.4rem 0.8rem; font-size: 0.875rem;">Edit</a>
                                <form action="{{ route('tours.destroy', $tour) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
        {{ $tours->links() }}
    </div>
</div>
@endsection
