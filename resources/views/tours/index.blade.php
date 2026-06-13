@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col">
        <h2 class="fw-bold m-0">Katalog Wisata</h2>
        <p class="text-muted m-0">Daftar destinasi wisata yang tersedia</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('tours.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i data-lucide="map-pin" style="width: 18px;"></i>
            <span>Tambah Wisata</span>
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
                        <th class="ps-4" style="width: 120px;">Pratinjau</th>
                        <th>Destinasi</th>
                        <th>Deskripsi Singkat</th>
                        <th class="pe-4 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($tours as $tour)
                        <tr>
                            <td class="ps-4">
                                @if($tour->image)
                                    <div class="position-relative overflow-hidden rounded-3 shadow-sm" style="width: 80px; height: 60px;">
                                        <img src="{{ asset('storage/' . $tour->image) }}" class="w-100 h-100 object-fit-cover">
                                    </div>
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted border shadow-sm" style="width: 80px; height: 60px;">
                                        <i data-lucide="image" style="width: 20px;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $tour->name }}</div>
                            </td>
                            <td>
                                <div class="text-muted small lh-base" style="max-width: 450px;">
                                    {{ Str::limit($tour->description, 140) }}
                                </div>
                            </td>
                            <td class="pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('tours.edit', $tour) }}" class="btn btn-action btn-light text-secondary shadow-sm" title="Sunting">
                                        <i data-lucide="edit-3" style="width: 18px;"></i>
                                    </a>
                                    <form action="{{ route('tours.destroy', $tour) }}" method="POST" onsubmit="return confirm('Hapus destinasi wisata ini?')">
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
    {{ $tours->links() }}
</div>
@endsection
