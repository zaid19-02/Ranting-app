@extends('layouts.app')

@section('content')
    <style>
        /* Custom Luxury Green Theme - Pengeluaran */
        :root {
            --dark-green-deep: #064e3b;
            /* Hijau Tua Utama */
            --emerald-glow: #10b981;
            /* Hijau Emerald Terang untuk Aksen */
            --soft-emerald: #ecfdf5;
            /* Latar belakang kartu lembut */
            --luxury-bg: #f8fafc;
            /* Latar belakang halaman utama */
        }

        body {
            background-color: var(--luxury-bg);
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        /* Container Utama Megah */
        .page-wrapper {
            padding: 1.5rem 0;
        }

        /* Header Section - Gradasi Hijau Tua */
        .hero-header {
            background: linear-gradient(135deg, var(--dark-green-deep) 0%, #065f46 100%);
            color: white;
            padding: 2.5rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px rgba(6, 78, 59, 0.2);
            position: relative;
            overflow: hidden;
        }

        /* Hiasan Latar Belakang Header */
        .hero-header::after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .hero-header h1 {
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        /* Tombol Tambah Mewah */
        .btn-luxury-add {
            background: white;
            color: var(--dark-green-deep);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-luxury-add:hover {
            background: var(--emerald-glow);
            color: white !important;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(6, 78, 59, 0.25);
        }

        /* Card untuk Tabel (Glassmorphism Effect) */
        .table-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* Kustomisasi Tabel Modern */
        .table-responsive {
            border-radius: 15px;
            overflow: hidden;
        }

        .table-modern {
            margin-bottom: 0;
        }

        /* Header Tabel - Hijau Tua */
        .table-modern thead th {
            background-color: var(--dark-green-deep);
            color: white;
            border: none;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            padding: 1.25rem 1rem;
            font-weight: 700;
        }

        /* Baris Tabel */
        .table-modern tbody td {
            vertical-align: middle;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
            font-size: 0.95rem;
        }

        /* Baris Putih/Abadi */
        .table-modern tbody tr {
            transition: all 0.2s ease;
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        /* Efek Hover Baris */
        .table-modern tbody tr:hover {
            background-color: rgba(16, 185, 129, 0.03);
            /* Sentuhan Hijau Emerald sangat tipis */
        }

        /* Teks Rupiah - Hijau Emerald Deep */
        .table-modern td.jumlah-rupiah {
            font-weight: 700;
            color: #059669;
            /* Sedikit lebih terang dari tua */
            font-size: 1.1rem;
        }

        /* Tombol Aksi */
        .btn-edit {
            background-color: #f59e0b;
            /* Ambar */
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            transition: 0.3s;
        }

        .btn-edit:hover {
            background-color: #d97706;
            color: white !important;
        }

        .btn-hapus {
            background-color: #ef4444;
            /* Merah */
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            transition: 0.3s;
        }

        .btn-hapus:hover {
            background-color: #dc2626;
            color: white !important;
        }

        /* Responsif Kustom - Mobile First */
        @media (max-width: 768px) {
            .hero-header {
                padding: 1.5rem;
                text-align: center;
            }

            .table-container {
                padding: 1rem;
            }

            .table-modern thead th {
                font-size: 0.7rem;
                padding: 0.75rem 0.5rem;
            }

            .table-modern tbody td {
                font-size: 0.85rem;
                padding: 0.75rem 0.5rem;
            }
        }
    </style>

    <div class="page-wrapper">
        <div class="container">

            {{-- HEADER SECTION (MEGAH) --}}
            <div class="hero-header d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm d-inline-block">
                        <i class="fas fa-file-invoice-dollar me-2"></i>REKAPITULASI
                    </span>
                    <h1 class="display-5 fw-bold text-white">Data Pengeluaran</h1>
                    <p class="mb-0 opacity-75">Manajemen transparansi biaya operasional organisasi</p>
                </div>
                @if (Auth::user()->role == 'admin')
                    <div>
                        <a href="{{ route('pengeluarans.create') }}" class="btn-luxury-add">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Pengeluaran
                        </a>
                    </div>
                @endif
            </div>

            {{-- TABEL SECTION (MEWAH & MODERN) --}}
            <div class="table-container">
                <div class="table-responsive">
                    {{-- Gunakan Class table-modern kita --}}
                    <table class="table table-modern datatable align-middle w-100">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th>TANGGAL</th>
                                <th>KETERANGAN PENGELUARAN</th>
                                <th>JUMLAH (Rp)</th>
                                @if (Auth::user()->role == 'admin')
                                    <th class="text-center">AKSI</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluarans as $index => $pengeluaran)
                                <tr>
                                    <td class="text-center text-muted">{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d/m/Y') }}</td>
                                    <td>
                                        {{ $pengeluaran->keterangan_pengeluaran }}
                                    </td>
                                    <td class="jumlah-rupiah">
                                        Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}
                                    </td>
                                    @if (Auth::user()->role == 'admin')
                                        <td class="text-center">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('pengeluarans.edit', $pengeluaran) }}"
                                                    class="btn btn-edit btn-sm shadow-sm">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                                <form action="{{ route('pengeluarans.destroy', $pengeluaran) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-hapus btn-sm shadow-sm"
                                                        onclick="return confirm('Yakin hapus pengeluaran ini?')">
                                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- Load FontAwesome jika belum ada --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- Script DataTable jika diperlukan (opsional, karena class 'datatable' ada) --}}
@endsection
