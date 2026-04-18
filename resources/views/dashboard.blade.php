@extends('layouts.app')

@section('content')
    <style>
        :root {
            --dark-green: #064e3b;
            --emerald: #10b981;
        }

        body {
            background-color: #f8fafc;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--dark-green) 0%, #065f46 100%);
            color: white;
            padding: 2.5rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px rgba(6, 78, 59, 0.2);
        }

        .stat-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .icon-box {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .btn-luxury {
            background-color: white;
            color: var(--dark-green);
            border: 2px solid var(--dark-green);
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-luxury:hover {
            background-color: var(--dark-green);
            color: white !important;
        }

        .chart-container {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
    </style>

    <div class="container py-4">
        {{-- HEADER --}}
        <div class="dashboard-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">E-Kas Dashboard</h2>
                <p class="mb-0 opacity-75">Sistem Informasi Pengelolaan Kas & Anggota</p>
            </div>
            @if (session('role') == 'admin')
                <span class="badge bg-white text-success px-4 py-2 rounded-pill fw-bold shadow-sm">ADMINISTRATOR</span>
            @endif
        </div>

        {{-- GREETING & PERIODE --}}
        <div class="mb-4">
            <h4 class="text-dark fw-bold mb-0">Selamat Datang, <span class="text-success">{{ session('user_name') }}</span>!
            </h4>
            {{-- Baris di bawah ini yang tadinya error --}}
            <p class="text-muted mb-0">Laporan periode: <strong>{{ $bulan }} {{ $tahun }}</strong></p>
        </div>

        {{-- STATISTIC CARDS --}}
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card stat-card border-start border-4 border-primary h-100">
                    <div class="card-body">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="fas fa-users"></i></div>
                        <h6 class="text-muted text-uppercase small fw-bold">Total Anggota</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalAnggota ?? 0 }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card border-start border-4 border-success h-100">
                    <div class="card-body">
                        <div class="icon-box bg-success bg-opacity-10 text-success"><i class="fas fa-wallet"></i></div>
                        <h6 class="text-muted text-uppercase small fw-bold">Kas Bulan Ini</h6>
                        <h2 class="fw-bold mb-0 text-success">Rp {{ number_format($totalKasBulanIni ?? 0, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card border-start border-4 border-danger h-100">
                    <div class="card-body">
                        <div class="icon-box bg-danger bg-opacity-10 text-danger"><i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h6 class="text-muted text-uppercase small fw-bold">Pengeluaran</h6>
                        <h2 class="fw-bold mb-0 text-danger">Rp
                            {{ number_format($totalPengeluaranBulanIni ?? 0, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- CHART --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="chart-container">
                    <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-chart-line me-2 text-success"></i>Tren Kas Tahunan
                    </h5>
                    <canvas id="kasChart" height="80"></canvas>
                </div>
            </div>
        </div>

        {{-- NAVIGATION --}}
        <div class="mt-5">
            <h5 class="fw-bold mb-4 text-dark">Menu Navigasi</h5>
            @if (session('role') == 'admin')
                <div class="row g-3 text-center">
                    <div class="col-6 col-md-3">
                        <a href="{{ route('anggotas.index') }}" class="btn btn-luxury w-100 py-4 shadow-sm">
                            <i class="fas fa-user-edit mb-2 fa-2x d-block"></i><span>Anggota</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('kas_bulanans.index') }}" class="btn btn-luxury w-100 py-4 shadow-sm">
                            <i class="fas fa-coins mb-2 fa-2x d-block"></i><span>Kas Bulanan</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('pengeluarans.index') }}" class="btn btn-luxury w-100 py-4 shadow-sm">
                            <i class="fas fa-file-invoice-dollar mb-2 fa-2x d-block"></i><span>Pengeluaran</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('kegiatan_tahunan.index') }}" class="btn btn-luxury w-100 py-4 shadow-sm">
                            <i class="fas fa-calendar-check mb-2 fa-2x d-block"></i><span>Kegiatan</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script>
        const ctx = document.getElementById('kasChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Total Kas (Rp)',
                    data: {!! json_encode($kasPerBulan) !!},
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
