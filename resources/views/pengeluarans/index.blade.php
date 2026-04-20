@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --dark-green: #022c22;
            --deep-green: #064e3b;
            --emerald: #10b981;
            --soft-bg: #f1f5f9;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, #f8fafc, #ecfdf5);
        }

        /* HEADER PREMIUM */
        .hero {
            background: linear-gradient(135deg, #022c22, #064e3b);
            border-radius: 24px;
            padding: 2.5rem;
            color: white;
            box-shadow: 0 15px 40px rgba(2, 44, 34, 0.3);
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: '';
            position: absolute;
            right: -60px;
            bottom: -60px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .btn-add {
            background: white;
            color: var(--dark-green);
            border-radius: 12px;
            font-weight: 700;
            padding: 10px 18px;
            transition: .3s;
        }

        .btn-add:hover {
            background: var(--emerald);
            color: white;
            transform: translateY(-2px);
        }

        /* SUMMARY CARD */
        .summary-card {
            background: white;
            border-radius: 18px;
            padding: 1.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .summary-card h3 {
            margin: 0;
            font-weight: 800;
            color: var(--deep-green);
        }

        /* TABLE */
        .table-box {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .table-modern thead th {
            background: var(--dark-green);
            color: white;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
        }

        .table-modern tbody tr:hover {
            background: rgba(16, 185, 129, 0.05);
        }

        .jumlah {
            font-weight: 800;
            color: var(--emerald);
        }

        /* BUTTON */
        .btn-edit {
            background: #f59e0b;
            color: white;
            border-radius: 8px;
        }

        .btn-hapus {
            background: #ef4444;
            color: white;
            border-radius: 8px;
        }

        /* PRINT FIX */
        @page {
            size: A4;
            margin: 12mm;
        }

        @media print {

            /* sembunyikan elemen UI */
            .hero,
            .btn,
            .no-print,
            nav,
            footer {
                display: none !important;
            }

            /* pastikan halaman bersih */
            html,
            body {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                background: #fff !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* container full agar tidak kepotong */
            .container,
            .container-fluid {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* kartu aman print */
            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                page-break-inside: avoid;
            }

            /* header print */
            .print-header {
                display: block !important;
                text-align: center;
                margin-bottom: 20px;
            }

            /* hindari tabel/row kepotong */
            table,
            tr,
            td,
            th {
                page-break-inside: avoid !important;
            }

            /* gambar tidak pecah */
            img {
                max-width: 100% !important;
                height: auto !important;
            }
        }

        /* default hidden */
        .print-header {
            display: none;
        }
    </style>

    <div class="container py-4">

        {{-- HEADER --}}
        <div class="hero d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h2 class="fw-bold">Data Pengeluaran</h2>
                <p class="mb-0 opacity-75">Transparansi biaya operasional</p>
            </div>

            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-outline-light">
                    <i class="fas fa-print"></i>
                </button>

                @if (Auth::user()->role == 'admin')
                    <a href="{{ route('pengeluarans.create') }}" class="btn-add">
                        <i class="fas fa-plus me-1"></i>Tambah
                    </a>
                @endif
            </div>
        </div>

        {{-- PRINT HEADER --}}
        <div class="print-header">
            <h2>MAHESA KURUNG AL-MUKAROMAH</h2>
            <p>RANTING PENGASINAN</p>
            <hr>
            <h4>LAPORAN PENGELUARAN</h4>
            <p>Tanggal Cetak: {{ now()->format('d/m/Y') }}</p>
        </div>

        {{-- SUMMARY --}}
        <div class="summary-card mt-4">
            <div>
                <small class="text-muted">TOTAL PENGELUARAN</small>
                <h3>
                    Rp {{ number_format($pengeluarans->sum('jumlah'), 0, ',', '.') }}
                </h3>
            </div>
            <i class="fas fa-wallet fa-2x text-success opacity-50"></i>
        </div>

        {{-- TABLE --}}
        <div class="table-box mt-4">
            <div class="table-responsive">
                <table class="table table-modern align-middle">

                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TANGGAL</th>
                            <th>KETERANGAN</th>
                            <th>JUMLAH</th>
                            @if (Auth::user()->role == 'admin')
                                <th>AKSI</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pengeluarans as $i => $p)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $p->keterangan_pengeluaran }}</td>
                                <td class="jumlah">
                                    Rp {{ number_format($p->jumlah, 0, ',', '.') }}
                                </td>

                                @if (Auth::user()->role == 'admin')
                                    <td>
                                        <a href="{{ route('pengeluarans.edit', $p) }}" class="btn btn-edit btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('pengeluarans.destroy', $p) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-hapus btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>
@endsection
