@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        /* HEADER WEB */
        .page-header {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            padding: 2.5rem;
            border-radius: 1.5rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* CARD */
        .card-custom {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            background: white;
            overflow: hidden;
        }

        /* TABLE */
        .table thead {
            background-color: #f1f5f9;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
            transform: scale(1.002);
        }

        .badge-date {
            background-color: #e2e8f0;
            color: #475569;
            font-weight: 600;
            padding: 0.5em 1em;
        }

        .btn-action {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
        }

        /* ================= PRINT ================= */
        @media print {

            body {
                background: #fff !important;
                font-size: 11px;
            }

            /* SEMBUNYIKAN UI */
            .page-header,
            .btn,
            .btn-action,
            .no-print {
                display: none !important;
            }

            .card-custom {
                box-shadow: none !important;
                border: none !important;
            }

            /* ===== KOP ===== */
            .print-header {
                display: block !important;
                margin-bottom: 10px;
            }

            .kop-wrapper {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .kop-logo img {
                width: 70px;
                height: 70px;
                object-fit: contain;
            }

            .kop-text h2 {
                margin: 0;
                font-size: 18px;
                font-weight: bold;
                letter-spacing: 1px;
            }

            .kop-text p {
                margin: 0;
                font-size: 12px;
            }

            .kop-text span {
                font-size: 13px;
                font-weight: 600;
            }

            .kop-line {
                border: 1.5px solid #000;
                margin: 8px 0;
            }

            .tanggal-print {
                font-size: 11px;
                text-align: right;
            }

            /* TABLE PRINT */
            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }

            th,
            td {
                border: 1px solid #000 !important;
                padding: 6px !important;
            }

            thead {
                background: #d1fae5 !important;
            }

            tr {
                page-break-inside: avoid;
            }

            /* FULL KERTAS */
            @page {
                size: landscape;
                margin: 10mm;
            }
        }

        /* default hidden */
        .print-header {
            display: none;
        }
    </style>

    <div class="container py-4">

        {{-- HEADER WEBSITE --}}
        <div class="page-header d-flex justify-content-between align-items-center no-print">
            <div>
                <h2 class="fw-bold mb-1">Manajemen Kegiatan</h2>
                <p class="mb-0 opacity-75">Kelola dan pantau agenda tahunan</p>
            </div>

            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-outline-light fw-bold">
                    <i class="fas fa-print me-2"></i>Print
                </button>

                @if (Auth::user()->role == 'admin')
                    <a href="{{ route('kegiatan_tahunan.create') }}" class="btn btn-light fw-bold">
                        <i class="fas fa-plus-circle me-2"></i>Tambah
                    </a>
                @endif
            </div>
        </div>

        {{-- KOP PRINT --}}
        <div class="print-header">
            <div class="kop-wrapper">

                {{-- LOGO --}}
                <div class="kop-logo">
                    <img src="{{ asset('logo.png') }}" alt="Logo">
                </div>

                {{-- TEXT --}}
                <div class="kop-text">
                    <h2>MAHESA KURUNG AL-MUKAROMAH</h2>
                    <p>RANTING PENGASINAN</p>
                    <span>LAPORAN KEGIATAN TAHUNAN</span>
                </div>

            </div>

            <hr class="kop-line">

            <p class="tanggal-print">
                Tanggal Cetak: {{ date('d/m/Y') }}
            </p>
        </div>

        {{-- TABLE --}}
        <div class="card-custom">
            <div class="table-responsive">
                <table class="table table-hover mb-0">

                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Informasi</th>
                            <th>Waktu & Lokasi</th>
                            <th>Deskripsi</th>
                            @if (Auth::user()->role == 'admin')
                                <th class="text-center no-print">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kegiatans as $index => $kegiatan)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>

                                <td>
                                    <strong>{{ $kegiatan->nama_kegiatan }}</strong><br>
                                    Tahun {{ $kegiatan->tahun }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d/m/Y') }}<br>
                                    {{ $kegiatan->lokasi }}
                                </td>

                                <td>
                                    {{ $kegiatan->deskripsi }}
                                </td>

                                @if (Auth::user()->role == 'admin')
                                    <td class="text-center no-print">
                                        <a href="{{ route('kegiatan_tahunan.edit', $kegiatan->id) }}"
                                            class="btn btn-warning btn-action text-white">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('kegiatan_tahunan.destroy', $kegiatan->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-action">
                                                <i class="fas fa-trash"></i>
                                            </button>
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
