<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SANI TOUR') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #f59e0b;
            --bg: #f9fafb;
            --sidebar-bg: #ffffff;
            --sidebar-border: #e5e7eb;
            --text: #111827;
            --text-muted: #6b7280;
            --radius: 8px;
            --sidebar-width: 240px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        aside {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
        }

        .sidebar-header {
            padding: 1.5rem;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary);
            border-bottom: 1px solid var(--sidebar-border);
        }

        .sidebar-nav {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: var(--text-muted);
            border-radius: var(--radius);
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .nav-item:hover { background: #f3f4f6; color: var(--text); }
        .nav-item.active { background: #fef3c7; color: #92400e; }

        main { flex: 1; margin-left: var(--sidebar-width); padding: 2rem; }

        .card {
            background: white;
            border-radius: var(--radius);
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        h1 { font-size: 1.5rem; margin-bottom: 1.5rem; }

        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th { text-align: left; padding: 0.75rem; border-bottom: 1px solid #e5e7eb; color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase; }
        td { padding: 1rem 0.75rem; border-bottom: 1px solid #f3f4f6; font-size: 0.9rem; }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { opacity: 0.9; }

        .btn-secondary { background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; }
        .btn-secondary:hover { background: #e5e7eb; }

        .btn-danger { background: #fee2e2; color: #b91c1c; }
        .btn-danger:hover { background: #fecaca; }

        .btn-icon { padding: 0.4rem; }

        .status-pill {
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .status-confirmed { background: #dcfce7; color: #166534; }
        .status-pending { background: #fef9c3; color: #854d0e; }

        input, select, textarea {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-family: inherit;
        }

        .login-page { margin-left: 0; width: 100%; display: flex; align-items: center; justify-content: center; background: #fffbeb; }
    </style>
</head>
<body>
    @auth
    <aside>
        <div class="sidebar-header">SANI TOUR</div>
        <nav class="sidebar-nav">
            <a href="{{ route('bookings.index') }}" class="nav-item {{ request()->routeIs('bookings.*') ? 'active' : '' }}">
                <i data-lucide="shopping-cart"></i> Pesanan
            </a>
            <a href="{{ route('tours.index') }}" class="nav-item {{ request()->routeIs('tours.*') ? 'active' : '' }}">
                <i data-lucide="map"></i> Wisata
            </a>
            <a href="{{ route('packages.index') }}" class="nav-item {{ request()->routeIs('packages.*') ? 'active' : '' }}">
                <i data-lucide="package"></i> Paket
            </a>
            <a href="{{ route('schedules.index') }}" class="nav-item {{ request()->routeIs('schedules.*') ? 'active' : '' }}">
                <i data-lucide="calendar"></i> Jadwal
            </a>
            <a href="{{ route('users.index') }}" class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i data-lucide="users"></i> Pengguna
            </a>
        </nav>
        
        <form action="{{ route('logout') }}" method="POST" style="margin-top: auto; padding: 1rem;">
            @csrf
            <button type="submit" class="btn btn-danger" style="width: 100%;">
                <i data-lucide="log-out"></i> Keluar
            </button>
        </form>
    </aside>

    <main>
        @yield('content')
    </main>
    @else
    <div class="login-page">
        @yield('content')
    </div>
    @endauth

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
