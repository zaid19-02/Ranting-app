<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Aplikasi Kas' }} - Mahesa Kurung</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    @stack('styles')

    <style>
        body {
            background-color: #f4f7f6;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: all 0.3s;
            border-radius: 8px;
            margin: 4px 15px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #198754;
            /* Warna hijau khas MK */
            color: white;
        }

        .content {
            padding: 25px;
            min-height: 100vh;
        }

        /* Perbaikan untuk tampilan mobile */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                position: relative;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            @if (session('role') == 'admin')
                <div class="col-md-2 sidebar shadow">
                    <div class="py-4">
                        <div class="text-center mb-4 px-3">
                            <h6 class="text-white fw-bold">PENGASINAN</h6>
                            <hr class="border-secondary">
                        </div>

                        <a href="{{ route('dashboard') }}"
                            class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('anggotas.index') }}"
                            class="{{ request()->routeIs('anggotas.*') ? 'active' : '' }}">
                            <i class="bi bi-people me-2"></i> Data Anggota
                        </a>
                        <a href="{{ route('kas_bulanans.index') }}"
                            class="{{ request()->routeIs('kas_bulanans.*') ? 'active' : '' }}">
                            <i class="bi bi-wallet2 me-2"></i> Kas Bulanan
                        </a>
                        <a href="{{ route('pengeluarans.index') }}"
                            class="{{ request()->routeIs('pengeluarans.*') ? 'active' : '' }}">
                            <i class="bi bi-cart-dash me-2"></i> Pengeluaran
                        </a>
                        <a href="{{ route('kegiatan_tahunan.index') }}"
                            class="{{ request()->routeIs('kegiatan_tahunan.*') ? 'active' : '' }}">
                            <i class="bi bi-calendar-event me-2"></i> Kegiatan
                        </a>

                        <div class="mt-5 px-3">
                            <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100 text-start border-0">
                                <i class="bi bi-box-arrow-left me-2"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 content">
                    @yield('content')
                </div>
            @else
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm px-4">
                        <span class="navbar-brand fw-bold">KAS RANTING</span>
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm ms-auto">
                            <i class="bi bi-box-arrow-left"></i> Logout
                        </a>
                    </nav>
                    <div class="container mt-4">
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
            // Auto inisialisasi DataTable jika ada class .datatable
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
