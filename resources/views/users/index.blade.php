@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 700;">Pengguna</h1>
        <p style="color: var(--text-muted);">Kelola pengguna sistem</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pengguna Baru</a>
</div>

@if(session('success'))
    <div style="background: #ecfdf5; color: #065f46; padding: 1rem; border-radius: var(--radius); margin-bottom: 1.5rem; border: 1px solid #10b981;">
        Berhasil: {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="background: #fef2f2; color: #991b1b; padding: 1rem; border-radius: var(--radius); margin-bottom: 1.5rem; border: 1px solid #ef4444;">
        {{ $errors->first() }}
    </div>
@endif

<div class="card">
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tgl Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td style="font-weight: 600;">{{ $user->name }} @if($user->id == auth()->id()) (You) @endif</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('users.edit', $user) }}" class="btn" style="background: #f1f5f9; color: var(--text); padding: 0.4rem 0.8rem; font-size: 0.875rem;">Edit</a>
                                @if($user->id != auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-logout" style="padding: 0.4rem 0.8rem; font-size: 0.875rem;">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{ $users->links() }}
    </div>
</div>
@endsection
