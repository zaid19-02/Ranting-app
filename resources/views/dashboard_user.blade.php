@extends('layouts.app')

@section('content')
<div class="container">

    {{-- 🔥 MENU USER --}}
    <div class="row mb-4 text-center">
        <div class="col-6 col-md-3 mb-2">
            <a href="{{ route('dashboard') }}" class="btn btn-success w-100 py-3">
                <i class="bi bi-graph-up"></i><br>
                Dashboard
            </a>
        </div>

        <div class="col-6 col-md-3 mb-2">
            <a href="{{ route('kas_bulanans.index') }}" class="btn btn-primary w-100 py-3">
                <i class="bi bi-wallet2"></i><br>
                Kas
            </a>
        </div>

        <div class="col-6 col-md-3 mb-2">
            <a href="{{ route('pengeluarans.index') }}" class="btn btn-danger w-100 py-3">
                <i class="bi bi-cash-stack"></i><br>
                Pengeluaran
            </a>
        </div>
    </div>

    <h4 class="mb-4">Dashboard Kas</h4>

    {{-- KAS BULAN INI --}}
    <div class="card shadow-sm p-4 mb-4">
        <h6 class="text-muted">Kas Bulan {{ $bulan }} {{ $tahun }}</h6>
        <h3 class="fw-bold text-success">
            Rp {{ number_format($totalKasBulanIni ?? 0, 0, ',', '.') }}
        </h3>
    </div>

    {{-- GRAFIK --}}
    <div class="card shadow-sm p-4">
        <h6 class="mb-3">Grafik Kas Tahunan</h6>
        <canvas id="chartKas"></canvas>
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
@endsection
