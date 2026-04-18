<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Aplikasi Kas' }} - Mahesa Kurung</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    @stack('styles')

    <style>
        :root {
            --primary-green: #064e3b; /* Deep Emerald */
            --accent-green: #10b981; /* Emerald Spark */
            --bg-light: #f8fafc;
            --sidebar-dark: #022c22;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', sans-serif;
            color: #334155;
        }

        h1, h2, h3, h6, .navbar-brand {
            font-family: 'Montserrat', sans-serif;
            letter-spacing: -0.5px;
        }

        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--sidebar-dark) 0%, #064e3b 100%);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .brand-logo {
            font-size: 1.2rem;
            color: #fff;
            text-transform: uppercase;
            border-bottom: 2px solid var(--accent-green);
            padding-bottom: 10px;
            display: inline-block;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
            margin: 8px 18px;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .sidebar a i {
            font-size: 1.2rem;
            margin-right: 12px;
        }

        .sidebar a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar a.active {
            background: var(--accent-green);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }

        /* Content Area */
        .content {
            padding: 40px;
            background: transparent;
        }

        /* Card Customization untuk Yield Content */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f1f5f9;
            padding: 20px;
            font-weight: 700;
        }

        /* Navbar User Area */
        .navbar-custom {
            background: white;
            padding: 15px 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-btn {
            background: #fef2f2;
            color: #dc2626;
            border: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #dc2626;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                position: relative;
            }
            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            @if (session('role') == 'admin')
                <div class="col-md-2 sidebar">
                    <div class="sidebar-header">
                        <span class="brand-logo fw-bold">Mahesa Kurung</span>
                        <p class="text-white-50 small mt-2">Sistem Kas Ranting</p>
                    </div>

                    <div class="nav-links">
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2-fill"></i> Dashboard
                        </a>
                        <a href="{{ route('anggotas.index') }}" class="{{ request()->routeIs('anggotas.*') ? 'active' : '' }}">
                            <i class="bi bi-person-badge-fill"></i> Data Anggota
                        </a>
                        <a href="{{ route('kas_bulanans.index') }}" class="{{ request()->routeIs('kas_bulanans.*') ? 'active' : '' }}">
                            <i class="bi bi-vignette"></i> Kas Bulanan
                        </a>
                        <a href="{{ route('pengeluarans.index') }}" class="{{ request()->routeIs('pengeluarans.*') ? 'active' : '' }}">
                            <i class="bi bi-arrow-up-right-circle-fill"></i> Pengeluaran
                        </a>
                        <a href="{{ route('kegiatan_tahunan.index') }}" class="{{ request()->routeIs('kegiatan_tahunan.*') ? 'active' : '' }}">
                            <i class="bi bi-trophy-fill"></i> Kegiatan
                        </a>
                    </div>

                    <div style="position: absolute; bottom: 20px; width: 100%;" class="px-4">
                        <a href="{{ route('logout') }}" class="text-danger border-0 m-0 p-2">
                            <i class="bi bi-box-arrow-left"></i> <span class="small">Keluar Sistem</span>
                        </a>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="content">
                        <div class="navbar-custom">
                            <div>
                                <h5 class="m-0 fw-bold text-dark text-uppercase" style="font-size: 1rem;">{{ $title ?? 'Overview' }}</h5>
                                <small class="text-muted">Selamat datang kembali, Admin</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="me-3 fw-medium small d-none d-md-block">{{ date('d M Y') }}</span>
                                <div class="vr me-3"></div>
                                <i class="bi bi-person-circle fs-4 text-success"></i>
                            </div>
                        </div>

                        @yield('content')
                    </div>
                </div>
            @else
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm px-4 py-3" style="background: var(--sidebar-dark) !important;">
                        <span class="navbar-brand fw-bold">MK - KAS RANTING</span>
                        <a href="{{ route('logout') }}" class="logout-btn btn-sm ms-auto text-decoration-none">
                            <i class="bi bi-box-arrow-left me-1"></i> Logout
                        </a>
                    </nav>
                    <div class="container mt-5">
                        @yield('content')
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    @stack('scripts')

    <script>
        $(document).ready(function() {
            if ($('.datatable').length > 0) {
                $('.datatable').DataTable({
                    responsive: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                    }
                });
            }
        });
    </script>
</body>

</html>
