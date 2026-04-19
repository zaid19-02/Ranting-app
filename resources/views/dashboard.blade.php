@extends('layouts.app')

@section('content')
<style>
    :root {
        --dark-green: #022c22;
        --emerald: #10b981;
        --soft-bg: #f1f5f9;
    }

    body {
        background-color: var(--soft-bg);
        font-family: 'Inter', -apple-system, sans-serif;
    }

    /* Header Mewah & Responsive */
    .dashboard-header {
        background: linear-gradient(135deg, var(--dark-green) 0%, #064e3b 100%);
        color: white;
        padding: 2rem;
        border-radius: 24px;
        margin-bottom: 2rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        position: relative;
        overflow: hidden;
    }

    /* Stat Cards Optimization */
    .stat-card {
        border: none;
        border-radius: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }

    /* Chart Container Hybrid */
    .chart-wrapper {
        background: white;
        padding: 1.5rem;
        border-radius: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        position: relative;
        /* Desktop height */
        height: 400px;
    }

    /* Responsive Adjustments for Android */
    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1.5rem;
            text-align: center;
            flex-direction: column;
            gap: 1rem;
        }

        .chart-wrapper {
            height: 300px; /* Shorter on mobile */
            padding: 1rem;
        }

        .display-stats {
            font-size: 1.5rem !important;
        }
    }

    .ls-tight { letter-spacing: -0.025em; }
</style>

<div class="container py-3 py-md-5">

    {{-- TOP HEADER --}}
    <div class="dashboard-header d-flex justify-content-between align-items-center shadow-lg">
        <div class="z-1">
            <h2 class="fw-bold ls-tight mb-1">E-Kas Dashboard</h2>
            <p class="mb-0 opacity-75 small">Sistem Informasi Keuangan Mahesa Kurung</p>
        </div>
        @if (Auth::user()->role == 'admin')
            <span class="badge bg-white text-dark px-4 py-2 rounded-pill fw-bold shadow-sm z-1">
                <i class="fas fa-user-shield me-2 text-success"></i>ADMINISTRATOR
            </span>
        @endif
    </div>

    {{-- GREETING --}}
    <div class="row mb-4 px-2">
        <div class="col-12">
            <h4 class="text-dark fw-bold mb-0">Halo, <span class="text-success">{{ Auth::user()->name }}</span>!</h4>
            <p class="text-muted small">Periode: <span class="fw-semibold text-dark">{{ $bulan ?? date('F') }} {{ $tahun ?? date('Y') }}</span></p>
        </div>
    </div>

<style>
    /* Styling Tambahan Khusus Kartu Premium */
    .premium-card {
        border: none;
        border-radius: 24px;
        background: #ffffff;
        position: relative;
        overflow: hidden;
        z-index: 1;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
    }

    /* Efek Dekorasi Lingkaran Abstrak di Belakang Kartu */
    .premium-card::before {
        content: "";
        position: absolute;
        top: -20px;
        right: -20px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: currentColor;
        opacity: 0.03;
        z-index: -1;
    }

    .premium-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.12);
    }

    /* Ikon Box dengan Neumorphism halus */
    .icon-shape {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1.25rem;
        position: relative;
    }

    /* Gradient Teks untuk Angka agar Mewah */
    .text-gradient-dark {
        background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .stat-label {
        font-size: 0.75rem;
        letter-spacing: 1.5px;
        color: #94a3b8;
        font-weight: 700;
        text-transform: uppercase;
    }

    .currency-tag {
        font-size: 0.9rem;
        font-weight: 600;
        color: #64748b;
        margin-right: 2px;
    }

    /* Glow Effect untuk kartu sukses dan bahaya */
    .glow-success { border-top: 5px solid #10b981; }
    .glow-danger { border-top: 5px solid #ef4444; }
    .glow-primary { border-top: 5px solid #3b82f6; }

    @media (max-width: 576px) {
        .icon-shape { width: 40px; height: 40px; font-size: 1.1rem; margin-bottom: 0.75rem; }
        .display-stats { font-size: 1.25rem !important; }
    }
</style>

{{-- STATISTIC CARDS SECTION --}}
<div class="row g-3 g-md-4">

    {{-- Total Anggota --}}
    <div class="col-6 col-md-4">
        <div class="card premium-card glow-primary h-100 color-primary">
            <div class="card-body p-3 p-md-4">
                <div class="icon-shape bg-primary text-primary bg-opacity-10 shadow-sm">
                    <i class="fas fa-users"></i>
                </div>
                <p class="stat-label mb-1">Anggota</p>
                <h2 class="fw-extrabold mb-0 text-gradient-dark display-stats ls-tight">
                    {{ $totalAnggota ?? 0 }}
                </h2>
                <div class="mt-2 small text-primary fw-semibold" style="font-size: 0.7rem;">
                    <i class="fas fa-check-circle me-1"></i> Data Terverifikasi
                </div>
            </div>
        </div>
    </div>

    {{-- Kas Masuk --}}
    <div class="col-6 col-md-4">
        <div class="card premium-card glow-success h-100 text-success">
            <div class="card-body p-3 p-md-4">
                <div class="icon-shape bg-success text-white shadow-md">
                    <i class="fas fa-wallet"></i>
                </div>
                <p class="stat-label mb-1">Kas Masuk</p>
                <h2 class="fw-extrabold mb-0 text-success display-stats ls-tight">
                    <span class="currency-tag">Rp</span>{{ number_format(($totalKasBulanIni ?? 0), 0, ',', '.') }}
                </h2>
                <div class="mt-2 small text-success fw-semibold" style="font-size: 0.7rem;">
                    <i class="fas fa-trending-up me-1"></i> Bulan Ini
                </div>
            </div>
        </div>
    </div>

    {{-- Pengeluaran --}}
    <div class="col-12 col-md-4">
        <div class="card premium-card glow-danger h-100 text-danger">
            <div class="card-body p-3 p-md-4">
                <div class="row align-items-center">
                    <div class="col-8 col-md-12">
                        <div class="icon-shape bg-danger bg-opacity-10 text-danger">
                            <i class="fas fa-arrow-right-from-bracket"></i>
                        </div>
                        <p class="stat-label mb-1">Pengeluaran</p>
                        <h2 class="fw-extrabold mb-0 text-danger display-stats ls-tight">
                            <span class="currency-tag">Rp</span>{{ number_format(($totalPengeluaranBulanIni ?? 0), 0, ',', '.') }}
                        </h2>
                    </div>
                    <div class="col-4 d-md-none text-end">
                        {{-- Ikon tambahan khusus mobile agar tidak kosong --}}
                        <i class="fas fa-receipt opacity-25 fa-3x"></i>
                    </div>
                </div>
                <div class="mt-2 small text-danger fw-semibold" style="font-size: 0.7rem;">
                    <i class="fas fa-info-circle me-1"></i> Total Alokasi
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- CHART SECTION --}}
    <div class="row mt-4 mt-md-5">
        <div class="col-12">
            <div class="chart-wrapper shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark mb-0">
                        <i class="fas fa-chart-line me-2 text-success"></i>Tren Tahunan
                    </h5>
                    <span class="badge bg-light text-dark border fw-normal">Live Data</span>
                </div>
                {{-- Canvas Wrapper to handle responsiveness --}}
                <div style="position: relative; height: calc(100% - 60px); width: 100%;">
                    <canvas id="kasChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- QUICK NAVIGATION --}}
    <div class="mt-5 mb-5">
        <h5 class="fw-bold mb-4 text-dark px-2">Menu Cepat</h5>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <a href="{{ route('kas_bulanans.index') }}" class="btn btn-white w-100 py-3 shadow-sm border-0 rounded-4 text-dark fw-bold">
                    <i class="fas fa-plus-circle text-success d-block mb-2 fs-4"></i> Input Kas
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('pengeluarans.index') }}" class="btn btn-white w-100 py-3 shadow-sm border-0 rounded-4 text-dark fw-bold">
                    <i class="fas fa-receipt text-danger d-block mb-2 fs-4"></i> Pengeluaran
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('anggotas.index') }}" class="btn btn-white w-100 py-3 shadow-sm border-0 rounded-4 text-dark fw-bold">
                    <i class="fas fa-user-friends text-primary d-block mb-2 fs-4"></i> Data Anggota
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="#" class="btn btn-white w-100 py-3 shadow-sm border-0 rounded-4 text-dark fw-bold">
                    <i class="fas fa-file-invoice-dollar text-warning d-block mb-2 fs-4"></i> Laporan
                </a>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('kasChart').getContext('2d');

        // Gradient effect
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.4)');
        gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Total Kas',
                    data: {!! json_encode($kasPerBulan) !!},
                    borderColor: '#10b981',
                    backgroundColor: gradient,
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#10b981',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Penting agar mengikuti container
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#022c22',
                        titleFont: { size: 14 },
                        bodyFont: { size: 14 },
                        padding: 12,
                        cornerRadius: 10,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            },
                            font: { size: 11 }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11 } }
                    }
                }
            }
        });
    });
</script>
@endsection
