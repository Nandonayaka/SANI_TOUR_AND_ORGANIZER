<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SANI TOUR') }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --bs-primary: #2563eb;
            --bs-primary-rgb: 37, 99, 235;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            font-size: 0.9rem;
        }
        h2 { font-size: 1.5rem; }
        h3 { font-size: 1.25rem; }
        h5 { font-size: 1rem; }
        
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand {
            padding: 1.5rem;
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--bs-primary);
            text-transform: uppercase;
        }
        .nav-link {
            padding: 0.7rem 1rem;
            color: #4b5563;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            margin: 0.2rem 0.75rem;
            transition: all 0.2s ease;
            font-size: 0.85rem;
        }
        .nav-link:hover {
            background-color: #f9fafb;
            color: var(--bs-primary);
            transform: translateX(3px);
        }
        .nav-link.active {
            background-color: rgba(var(--bs-primary-rgb), 0.08);
            color: var(--bs-primary);
            font-weight: 600;
        }
        .main-content {
            margin-left: 240px;
            min-height: 100vh;
            padding: 2rem;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        .btn {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }
        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.75rem;
        }
        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0 !important;
            border-radius: 8px;
        }
        .btn-primary { 
            background-color: var(--bs-primary); 
            border-color: var(--bs-primary);
            box-shadow: 0 4px 14px 0 rgba(var(--bs-primary-rgb), 0.3);
            color: white;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px 0 rgba(var(--bs-primary-rgb), 0.4);
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            border: 1px solid #d1d5db;
            font-size: 0.85rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 4px rgba(var(--bs-primary-rgb), 0.1);
        }
        .table {
            font-size: 0.85rem;
        }
        .table thead th {
            background-color: #f9fafb;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
            border-top: none;
            padding: 0.75rem;
        }
        .status-pill {
            padding: 0.25rem 0.6rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    @auth
    <div class="sidebar">
        <div class="sidebar-brand">SANI TOUR</div>
        <div class="flex-grow-1">
            <nav class="nav flex-column">
                <a href="{{ route('bookings.index') }}" class="nav-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}">
                    <i data-lucide="shopping-cart" style="width: 20px;"></i> <span>Pesanan</span>
                </a>
                <a href="{{ route('tours.index') }}" class="nav-link {{ request()->routeIs('tours.*') ? 'active' : '' }}">
                    <i data-lucide="map" style="width: 20px;"></i> <span>Wisata</span>
                </a>
                <a href="{{ route('packages.index') }}" class="nav-link {{ request()->routeIs('packages.*') ? 'active' : '' }}">
                    <i data-lucide="package" style="width: 20px;"></i> <span>Paket</span>
                </a>
                <a href="{{ route('schedules.index') }}" class="nav-link {{ request()->routeIs('schedules.*') ? 'active' : '' }}">
                    <i data-lucide="calendar" style="width: 20px;"></i> <span>Jadwal</span>
                </a>
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i data-lucide="users" style="width: 20px;"></i> <span>Pengguna</span>
                </a>
            </nav>
        </div>
        <div class="p-3 border-top">
            <div class="d-flex align-items-center mb-3 px-2">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.8rem; font-weight: 700;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="ms-2 overflow-hidden">
                    <div class="small fw-bold text-dark text-truncate">{{ auth()->user()->name }}</div>
                    <div class="text-muted" style="font-size: 0.7rem;">Administrator</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light w-100 btn-sm d-flex align-items-center justify-content-center gap-2 text-danger fw-bold border-0">
                    <i data-lucide="log-out" style="width: 16px;"></i> Keluar
                </button>
            </form>
        </div>
    </div>
    @endauth

    <div class="{{ Auth::check() ? 'main-content' : 'd-flex align-items-center justify-content-center vh-100' }}">
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
