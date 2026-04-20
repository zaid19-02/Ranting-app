<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Member Dashboard' }} - Mahesa Kurung</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --bg-body: #f0f2f5;
            --primary-dark: #064e3b;
            --accent-emerald: #10b981;
            --glass-white: rgba(255, 255, 255, 0.85);
            --shadow-premium: 0 10px 30px -5px rgba(0, 0, 0, 0.08);
            --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: #1e293b;
            min-height: 100vh;
            background-image:
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(37, 99, 235, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
        }

        /* ================= LUXURY NAVBAR ================= */
        .navbar-main {
            background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);
            padding: 0.8rem 0;
            box-shadow: 0 10px 30px rgba(2, 44, 34, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: 1px;
            background: linear-gradient(to right, #fff, #a7f3d0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-pill-luxury {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 5px 15px;
            border-radius: 100px;
            backdrop-filter: blur(10px);
            transition: var(--transition-smooth);
        }

        .btn-logout-circle {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-smooth);
        }

        .btn-logout-circle:hover {
            background: #ef4444;
            color: white;
            transform: rotate(15deg) scale(1.1);
        }

        /* ================= MENU GRID ================= */
        .nav-grid-luxury {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        @media (max-width: 992px) {
            .nav-grid-luxury {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 576px) {
            .nav-grid-luxury {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .luxury-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 18px 10px;
            text-align: center;
            text-decoration: none;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-premium);
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #f1f5f9;
        }

        .luxury-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.15);
        }

        .icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 10px;
            transition: var(--transition-smooth);
        }

        .sc-blue {
            background: #eff6ff;
            color: #3b82f6;
        }

        .sc-cyan {
            background: #ecfeff;
            color: #0891b2;
        }

        .sc-emerald {
            background: #f0fdf4;
            color: #10b981;
        }

        .sc-rose {
            background: #fef2f2;
            color: #ef4444;
        }

        .sc-amber {
            background: #fffbeb;
            color: #f59e0b;
        }

        .luxury-card:hover .icon-wrapper {
            background: var(--primary-dark);
            color: #fff !important;
        }

        .label-luxury {
            font-weight: 800;
            font-size: 0.65rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .glass-container {
            background: var(--glass-white);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 24px;
            padding: 25px;
            margin-bottom: 50px;
            box-shadow: var(--shadow-premium);
            min-height: 400px;
        }

        footer {
            padding: 30px 0;
            color: #94a3b8;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2px;
        }
    </style>
</head>

<body>

    {{-- Navbar Khusus User --}}
    <nav class="navbar navbar-dark navbar-main sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-shield-check me-2"></i>MK-KAS <span class="fw-300">MEMBER</span>
            </a>

            <div class="d-flex align-items-center gap-3">
                <div class="user-pill-luxury d-none d-sm-flex align-items-center">
                    <div class="rounded-circle bg-success me-2"
                        style="width: 8px; height: 8px; box-shadow: 0 0 10px var(--accent-emerald);"></div>
                    <span class="text-white small fw-bold">{{ Auth::user()->name }}</span>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button class="btn-logout-circle" title="Keluar">
                        <i class="bi bi-power fs-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        {{-- Navigasi Menu User --}}
        <div class="nav-grid-luxury">
            <a href="{{ route('dashboard') }}" class="luxury-card">
                <div class="icon-wrapper sc-blue">
                    <i class="bi bi-house-door-fill"></i>
                </div>
                <span class="label-luxury">Beranda</span>
            </a>

            <a href="#" class="luxury-card">
                <div class="icon-wrapper sc-cyan">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <span class="label-luxury">Profil Saya</span>
            </a>

            <a href="{{ route('kas_bulanans.index') }}" class="luxury-card">
                <div class="icon-wrapper sc-emerald">
                    <i class="bi bi-journal-text"></i>
                </div>
                <span class="label-luxury">Riwayat Kas</span>
            </a>

            <a href="{{ route('pengeluarans.index') }}" class="luxury-card">
                <div class="icon-wrapper sc-rose">
                    <i class="bi bi-receipt-cutoff"></i>
                </div>
                <span class="label-luxury">Laporan Keluar</span>
            </a>

            <a href="#" class="luxury-card">
                <div class="icon-wrapper sc-amber">
                    <i class="bi bi-megaphone-fill"></i>
                </div>
                <span class="label-luxury">Info Kegiatan</span>
            </a>
        </div>

        {{-- Main Content --}}
        <div class="glass-container">
            @yield('content')
        </div>
    </div>

    <footer class="text-center text-uppercase">
        &copy; 2026 Mahesa Kurung &bull; Member Portal
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
