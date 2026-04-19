@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --deep-green: #064e3b;
        --emerald-bright: #10b981;
        --dark-slate: #1e293b;
    }

    body {
        background-color: #f1f5f9;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--dark-slate);
    }

    /* Hero Card - Kontras Tinggi */
    .hero-gradient {
        background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);
        border-radius: 24px;
        padding: 40px;
        color: #ffffff;
        box-shadow: 0 20px 40px rgba(2, 44, 34, 0.2);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .hero-label {
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--emerald-bright);
        margin-bottom: 10px;
        display: block;
    }

    .hero-amount {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        margin-bottom: 0;
        letter-spacing: -1px;
        color: #ffffff; /* Memastikan font putih bersih */
    }

    /* Stat Cards */
    .stat-box {
        background: #ffffff;
        border-radius: 20px;
        padding: 24px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        transition: transform 0.3s ease;
    }

    .stat-box:hover {
        transform: translateY(-5px);
    }

    .icon-circle-lg {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .text-dark-bold {
        color: #0f172a;
        font-weight: 700;
    }

    /* Menu Buttons */
    .quick-link {
        background: #ffffff;
        padding: 20px;
        border-radius: 18px;
        text-decoration: none;
        display: block;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .quick-link:hover {
        background: #064e3b;
        border-color: #10b981;
    }

    .quick-link:hover h6, .quick-link:hover i {
        color: #ffffff !important;
    }

    /* Chart Area */
    .chart-container {
        background: #ffffff;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }
</style>

<div class="container py-4">

    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-dark-bold">Ringkasan Keuangan</h2>
            <p class="text-muted">Pantau arus kas Mahesa Kurung secara real-time.</p>
        </div>
    </div>

    <div class="hero-gradient mb-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="hero-label">Total Saldo Kas Keseluruhan</span>
                <h1 class="hero-amount">
                    Rp {{ number_format($totalKasKeseluruhan, 0, ',', '.') }}
                </h1>
                <div class="mt-3">
                    <span class="badge bg-success py-2 px-3 rounded-pill">
                        <i class="fas fa-shield-check me-1"></i> Data Terverifikasi Database
                    </span>
                </div>
            </div>
            <div class="col-md-4 text-end d-none d-md-block">
                <i class="fas fa-wallet fa-8x opacity-25 text-white"></i>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-box">
                <div class="icon-circle-lg bg-primary text-white shadow-sm">
                    <i class="fas fa-users"></i>
                </div>
                <p class="text-muted small fw-bold mb-1">TOTAL ANGGOTA</p>
                <h3 class="text-dark-bold mb-0">{{ $totalAnggota }} Anggota</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-box" style="border-left: 5px solid #10b981;">
                <div class="icon-circle-lg bg-success text-white shadow-sm">
                    <i class="fas fa-arrow-trend-up"></i>
                </div>
                <p class="text-muted small fw-bold mb-1">MASUK (BULAN INI)</p>
                <h3 class="text-success fw-bold mb-0">Rp {{ number_format($totalKasBulanIni, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-box" style="border-left: 5px solid #ef4444;">
                <div class="icon-circle-lg bg-danger text-white shadow-sm">
                    <i class="fas fa-arrow-trend-down"></i>
                </div>
                <p class="text-muted small fw-bold mb-1">KELUAR (BULAN INI)</p>
                <h3 class="text-danger fw-bold mb-0">Rp {{ number_format($totalPengeluaranBulanIni, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="chart-container">
                <h5 class="text-dark-bold mb-4">Grafik Pertumbuhan Kas</h5>
                <div style="height: 300px;">
                    <canvas id="mainChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <h5 class="text-dark-bold mb-3">Navigasi Cepat</h5>
            <div class="row g-3">
                <div class="col-6 col-lg-12">
                    <a href="{{ route('kas_bulanans.index') }}" class="quick-link">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-plus-circle text-success fs-4 me-3"></i>
                            <h6 class="mb-0 text-dark-bold">Input Kas</h6>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-12">
                    <a href="{{ route('pengeluarans.index') }}" class="quick-link">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-minus-circle text-danger fs-4 me-3"></i>
                            <h6 class="mb-0 text-dark-bold">Pengeluaran</h6>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <a href="{{ route('anggotas.index') }}" class="quick-link">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-group text-primary fs-4 me-3"></i>
                            <h6 class="mb-0 text-dark-bold">Data Anggota</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('mainChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pemasukan',
                data: {!! json_encode($kasPerBulan) !!},
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection
