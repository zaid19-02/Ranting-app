@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER USER --}}
    <div class="card border-0 shadow-sm mb-4 text-white"
        style="border-radius: 20px; background: linear-gradient(135deg, #198754, #146c43);">
        <div class="card-body p-4">
            <h2 class="fw-bold mb-1">Dashboard User</h2>
            <p class="mb-0 opacity-75">
                Selamat datang di Sistem Kas Ranting Pengasinan
            </p>
        </div>
    </div>

    {{-- MENU USER --}}
    <div class="row g-3 mb-4">

        <div class="col-md-3 col-6">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm text-center h-100 dashboard-menu">
                    <div class="card-body py-4">
                        <i class="bi bi-house-door fs-2 text-success"></i>
                        <h6 class="mt-3 mb-0 fw-bold">Dashboard</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('kas_bulanans.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm text-center h-100 dashboard-menu">
                    <div class="card-body py-4">
                        <i class="bi bi-wallet2 fs-2 text-primary"></i>
                        <h6 class="mt-3 mb-0 fw-bold">Kas Bulanan</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('pengeluarans.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm text-center h-100 dashboard-menu">
                    <div class="card-body py-4">
                        <i class="bi bi-cash-stack fs-2 text-danger"></i>
                        <h6 class="mt-3 mb-0 fw-bold">Pengeluaran</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-6">
            <a href="{{ route('kegiatan_tahunan.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm text-center h-100 dashboard-menu">
                    <div class="card-body py-4">
                        <i class="bi bi-calendar-event fs-2 text-warning"></i>
                        <h6 class="mt-3 mb-0 fw-bold">Kegiatan</h6>
                    </div>
                </div>
            </a>
        </div>

    </div>

    {{-- INFO CARD --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Kas Bulan {{ $bulan }} {{ $tahun }}</h6>
                    <h3 class="fw-bold text-success">
                        Rp {{ number_format($totalKasBulanIni ?? 0, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total Pengeluaran</h6>
                    <h3 class="fw-bold text-danger">
                        Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Saldo Saat Ini</h6>
                    <h3 class="fw-bold text-primary">
                        Rp {{ number_format(($totalKasBulanIni ?? 0) - ($totalPengeluaran ?? 0), 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

    {{-- GRAFIK --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Grafik Kas Tahunan</h5>
            <canvas id="chartKas"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const dataKas = @json($kasPerBulan);

    new Chart(document.getElementById('chartKas'), {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
            datasets: [{
                label: 'Kas (Rp)',
                data: dataKas,
                borderWidth: 3,
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

<style>
    .dashboard-menu {
        border-radius: 18px;
        transition: 0.3s;
    }

    .dashboard-menu:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }
</style>
@endsection
