<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Aplikasi Kas' }} - Mahesa Kurung</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-emerald: #022c22;
            --light-emerald: #064e3b;
            --accent-gold: #fbbf24;
            --glass-bg: rgba(255, 255, 255, 0.9);
            --sidebar-width: 260px;
        }

        body {
            background: #f1f5f9;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* --- SIDEBAR MEWAH --- */
        .sidebar {
            height: 100vh;
            background: linear-gradient(135deg, var(--primary-emerald) 0%, #065f46 100%);
            position: fixed;
            width: var(--sidebar-width);
            color: white;
            padding: 1.5rem 1rem;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar-brand {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-transform: uppercase;
            background: linear-gradient(to right, #fff, var(--accent-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.7);
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .sidebar a i {
            font-size: 1.2rem;
            margin-right: 15px;
        }

        .sidebar a:hover, .sidebar a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(8px);
        }

        .sidebar a.active {
            background: var(--accent-gold);
            color: var(--primary-emerald);
            box-shadow: 0 10px 20px rgba(251, 191, 36, 0.2);
        }

        /* --- MAIN AREA --- */
        .main {
            margin-left: var(--sidebar-width);
            padding: 2.5rem;
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .page-title h4 {
            margin: 0;
            font-weight: 700;
            color: var(--primary-emerald);
        }

        /* --- USER INTERFACE (MEMBER) --- */
        .navbar-user {
            background: var(--primary-emerald) !important;
            padding: 1rem 2rem;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .btn-logout {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 8px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #ef4444;
            color: white;
        }

        /* --- MODIFIKASI FORM LOGOUT SIDEBAR --- */
        .logout-wrapper {
            position: absolute;
            bottom: 30px;
            left: 15px;
            right: 15px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { width: 80px; padding: 1rem 0.5rem; }
            .sidebar-brand, .sidebar a span, .logout-wrapper span { display: none; }
            .main { margin-left: 80px; padding: 1.5rem; }
            .sidebar a i { margin-right: 0; font-size: 1.5rem; width: 100%; text-align: center; }
        }
    </style>
</head>

<body>

@guest
    <script>window.location.href = "/";</script>
@endguest

@auth
    @if (Auth::user()->isAdmin())
        {{-- ================= ADMIN SIDEBAR ================= --}}
        <div class="sidebar">
            <div class="sidebar-brand">
                Mahesa Kurung
            </div>

            <div class="nav-menu">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> <span>Dashboard</span>
                </a>
                <a href="{{ route('anggotas.index') }}" class="{{ request()->routeIs('anggotas.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> <span>Data Anggota</span>
                </a>
                <a href="{{ route('kas_bulanans.index') }}" class="{{ request()->routeIs('kas_bulanans.*') ? 'active' : '' }}">
                    <i class="bi bi-wallet2"></i> <span>Manajemen Kas</span>
                </a>
                <a href="{{ route('pengeluarans.index') }}" class="{{ request()->routeIs('pengeluarans.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-up-right-circle-fill"></i> <span>Pengeluaran</span>
                </a>
                <a href="{{ route('kegiatan_tahunan.index') }}" class="{{ request()->routeIs('kegiatan_tahunan.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event-fill"></i> <span>Kegiatan</span>
                </a>
            </div>

            <div class="logout-wrapper">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-logout w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-left"></i> <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        {{-- ================= ADMIN MAIN CONTENT ================= --}}
        <div class="main">
            <div class="top-bar">
                <div class="page-title">
                    <h4>{{ $title ?? 'Dashboard' }}</h4>
                </div>
                <div class="user-profile d-flex align-items-center gap-3">
                    <div class="text-end d-none d-md-block">
                        <p class="m-0 fw-bold small">{{ Auth::user()->name }}</p>
                        <p class="m-0 text-muted small" style="font-size: 11px;">Administrator</p>
                    </div>
                    <div class="avatar bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                </div>
            </div>

            <div class="content-body">
                @yield('content')
            </div>
        </div>

    @else
        {{-- ================= USER INTERFACE ================= --}}
        <nav class="navbar navbar-dark navbar-user px-4 mb-4">
            <div class="container-fluid">
                <span class="navbar-brand fw-bold font-montserrat">
                    <i class="bi bi-shield-check text-warning me-2"></i> MK-KAS MEMBER
                </span>

                <div class="d-flex align-items-center gap-4">
                    <span class="text-white-50 d-none d-md-block small">Halo, <b>{{ Auth::user()->name }}</b></span>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button class="btn btn-logout border-0">
                            <i class="bi bi-box-arrow-left me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container pb-5">
            <div class="row">
                <div class="col-12">
                    {{-- Area Konten User --}}
                    @yield('content')
                </div>
            </div>
        </div>
    @endif
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
