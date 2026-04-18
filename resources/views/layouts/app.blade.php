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
            --primary-green: #064e3b;
            --accent-green: #10b981;
            --bg-light: #f8fafc;
            --sidebar-dark: #022c22;
            --sidebar-width: 16.666667%; /* Sama dengan col-md-2 */
        }

        html, body {
            height: 100%;
            background-color: var(--bg-light);
            font-family: 'Inter', sans-serif;
            color: #334155;
        }

        /* Sidebar Locked Styling */
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, var(--sidebar-dark) 0%, #064e3b 100%);
            position: fixed; /* Mengunci Sidebar */
            top: 0;
            left: 0;
            z-index: 1050;
            box-shadow: 4px 0 15px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            padding: 0;
        }

        .sidebar-header {
            padding: 2rem 1rem;
            text-align: center;
        }

        .brand-logo {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            color: #fff;
            text-transform: uppercase;
            border-bottom: 2px solid var(--accent-green);
            padding-bottom: 8px;
            display: inline-block;
            letter-spacing: 1px;
        }

        .nav-links {
            margin-top: 1rem;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
            margin: 4px 15px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .sidebar a i {
            font-size: 1.2rem;
            margin-right: 12px;
        }

        .sidebar a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(5px);
        }

        .sidebar a.active {
            background: var(--accent-green);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        /* Main Content Adjustment */
        .main-wrapper {
            margin-left: var(--sidebar-width); /* Mendorong konten agar tidak tertutup sidebar */
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
        }

        .content {
            padding: 35px;
        }

        /* Top Navbar Premium Area */
        .navbar-custom {
            background: white;
            padding: 15px 25px;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(0,0,0,0.05);
        }

        /* Logout Button */
        .logout-section {
            position: absolute;
            bottom: 25px;
            width: 100%;
            padding: 0 15px;
        }

        .btn-logout-sidebar {
            color: #fca5a5;
            padding: 12px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: 0.3s;
            font-size: 0.9rem;
        }

        .btn-logout-sidebar:hover {
            background: rgba(220, 38, 38, 0.1);
            color: #ef4444;
        }

        /* Responsive Mobile */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                height: auto;
                width: 100%;
            }
            .main-wrapper {
                margin-left: 0;
                width: 100%;
            }
            .logout-section {
                position: relative;
                bottom: 0;
                margin: 20px 0;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            @if (session('role') == 'admin')
                <div class="col-md-2 sidebar shadow">
                    <div class="sidebar-header">
                        <span class="brand-logo fw-bold">Mahesa Kurung</span>
                        <p class="text-white-50 small mt-2 mb-0" style="font-size: 0.75rem;">Sistem Informasi Kas</p>
                    </div>

                    <div class="nav-links">
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2-fill"></i> Dashboard
                        </a>
                        <a href="{{ route('anggotas.index') }}" class="{{ request()->routeIs('anggotas.*') ? 'active' : '' }}">
                            <i class="bi bi-people-fill"></i> Data Anggota
                        </a>
                        <a href="{{ route('kas_bulanans.index') }}" class="{{ request()->routeIs('kas_bulanans.*') ? 'active' : '' }}">
                            <i class="bi bi-wallet2"></i> Kas Bulanan
                        </a>
                        <a href="{{ route('pengeluarans.index') }}" class="{{ request()->routeIs('pengeluarans.*') ? 'active' : '' }}">
                            <i class="bi bi-cart-dash-fill"></i> Pengeluaran
                        </a>
                        <a href="{{ route('kegiatan_tahunan.index') }}" class="{{ request()->routeIs('kegiatan_tahunan.*') ? 'active' : '' }}">
                            <i class="bi bi-calendar-check-fill"></i> Kegiatan
                        </a>
                    </div>

                    <div class="logout-section">
                        <a href="{{ route('logout') }}" class="btn-logout-sidebar">
                            <i class="bi bi-box-arrow-left me-2"></i> Keluar Sistem
                        </a>
                    </div>
                </div>

                <div class="main-wrapper">
                    <div class="content">
                        <div class="navbar-custom">
                            <div>
                                <h5 class="m-0 fw-bold text-dark text-uppercase" style="font-size: 0.9rem; letter-spacing: 0.5px;">
                                    {{ $title ?? 'Dashboard Overview' }}
                                </h5>
                                <small class="text-muted">Panel Administrasi Ranting</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="text-end me-3 d-none d-md-block">
                                    <p class="m-0 small fw-bold text-dark">Administrator</p>
                                    <p class="m-0 small text-muted" style="font-size: 0.7rem;">{{ date('l, d M Y') }}</p>
                                </div>
                                <div class="vr me-3"></div>
                                <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                                    <i class="bi bi-person-fill-check text-success fs-5"></i>
                                </div>
                            </div>
                        </div>

                        <div class="page-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm px-4 py-3" style="background: var(--sidebar-dark);">
                        <div class="container">
                            <span class="navbar-brand fw-bold">MK - KAS RANTING</span>
                            <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm border-0 ms-auto">
                                <i class="bi bi-box-arrow-left me-1"></i> Logout
                            </a>
                        </div>
                    </nav>
                    <div class="container mt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                @yield('content')
                            </div>
                        </div>
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
            // Auto inisialisasi DataTable
            if ($('.datatable').length > 0) {
                $('.datatable').DataTable({
                    responsive: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                    },
                    drawCallback: function() {
                        $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                    }
                });
            }
        });
    </script>
</body>

</html>
