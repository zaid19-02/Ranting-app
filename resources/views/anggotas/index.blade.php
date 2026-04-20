@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4 bg-light min-vh-100" style="font-family: 'Plus Jakarta Sans', sans-serif;">

        <style>
            :root {
                --green-dark: #0f4332;
                --green: #145c43;
                --green-soft: #1f6f54;
            }

            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }

            /* ===== HEADER PREMIUM ===== */
            .main-header {
                background: linear-gradient(135deg, var(--green-dark), var(--green));
                border-radius: 28px;
                padding: 50px 20px;
                color: #fff;
                text-align: center;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
                position: relative;
                overflow: hidden;
            }

            .main-header::after {
                content: "";
                position: absolute;
                width: 300px;
                height: 300px;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 50%;
                top: -100px;
                right: -80px;
            }

            .main-header h2 {
                letter-spacing: 2px;
                font-weight: 800;
            }

            /* ===== CARD ===== */
            .card-premium {
                border: none;
                border-radius: 20px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
                overflow: hidden;
                transition: 0.3s;
            }

            .card-premium:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            }

            /* ===== TABLE ===== */
            .table thead {
                background: var(--green-dark);
                color: #fff;
                font-size: 12px;
            }

            .table tbody tr:hover {
                background: #f3f7f5;
            }

            /* ===== BUTTON ===== */
            .btn-green {
                background: var(--green-dark);
                color: #fff;
                border-radius: 12px;
                padding: 10px 16px;
                transition: 0.2s;
            }

            .btn-green:hover {
                background: var(--green-soft);
                color: #fff;
            }

            /* ===== SEARCH ===== */
            #customSearchBox input {
                border-radius: 12px;
                border: 1px solid #d1d5db;
                padding: 8px 14px;
                min-width: 220px;
            }

            #customSearchBox input:focus {
                border-color: var(--green);
                box-shadow: 0 0 0 3px rgba(20, 92, 67, 0.15);
            }

            /* ===== PRINT ===== */
            @media print {

                @page {
                    size: landscape;
                    margin: 10mm;
                }

                body {
                    background: #fff !important;
                    font-size: 11px;
                }

                .no-print,
                .btn,
                #customSearchBox,
                .dataTables_filter {
                    display: none !important;
                }

                .card-premium,
                .card {
                    box-shadow: none !important;
                    border: none !important;
                }

                .print-header {
                    display: block !important;
                    text-align: center;
                    margin-bottom: 15px;
                }

                table {
                    width: 100% !important;
                    border-collapse: collapse !important;
                }

                th,
                td {
                    border: 1px solid #000 !important;
                    padding: 6px !important;
                }

                thead th {
                    background: #0f4332 !important;
                    color: #fff !important;
                }

                tr {
                    page-break-inside: avoid;
                }
            }

            .print-header {
                display: none;
            }
        </style>

        {{-- HEADER --}}
        <div class="main-header mb-4 no-print">
            <h2>MAHESA KURUNG AL-MUKAROMAH</h2>
            <p class="mb-0 opacity-75">RANTING PENGASINAN</p>
        </div>

        {{-- PRINT HEADER --}}
        <div class="print-header">
            <h3>MAHESA KURUNG AL-MUKAROMAH</h3>
            <p>RANTING PENGASINAN</p>
            <hr>
            <h4>LAPORAN DATA ANGGOTA</h4>
            <p>Tanggal Cetak: {{ date('d/m/Y') }}</p>
        </div>

        {{-- TOP BAR --}}
        <div class="row g-3 mb-3 no-print">

            <div class="col-md-4">
                <div class="card-premium p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold">TOTAL ANGGOTA</div>
                        <h4 class="mb-0 fw-bold text-success">{{ count($anggotas) }}</h4>
                    </div>
                    <i class="bi bi-people-fill fs-2 text-success"></i>
                </div>
            </div>

            <div class="col-md-8 d-flex justify-content-end align-items-center gap-2 flex-wrap">

                @if (Auth::user()->role == 'admin')
                    <a href="{{ route('anggotas.create') }}" class="btn btn-green">
                        + Tambah Anggota
                    </a>
                @endif

                <button onclick="window.print()" class="btn btn-outline-success">
                    <i class="bi bi-printer"></i> Print
                </button>

                <div id="customSearchBox"></div>

            </div>
        </div>

        {{-- TABLE --}}
        <div class="card-premium">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0" id="anggotaTable">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Lahir</th>
                            <th>Alamat</th>
                            <th>Wilayah</th>
                            <th>Status</th>
                            <th>Kontak</th>
                            @if (Auth::user()->role == 'admin')
                                <th class="no-print">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($anggotas as $index => $anggota)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $anggota->kode_wilayah }}</td>
                                <td class="fw-bold">{{ $anggota->nama_anggota }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d/m/Y') }}<br>
                                    <small class="text-muted">{{ $anggota->tempat_lahir }}</small>
                                </td>
                                <td>{{ $anggota->alamat }}</td>
                                <td>{{ $anggota->kecamatan }}<br>{{ $anggota->kabupaten_kota }}</td>
                                <td>
                                    <span class="badge bg-success">{{ $anggota->status }}</span>
                                </td>
                                <td>{{ $anggota->no_telpon }}</td>

                                @if (Auth::user()->role == 'admin')
                                    <td class="no-print">
                                        <a href="{{ route('anggotas.edit', $anggota) }}"
                                            class="btn btn-sm btn-warning">Edit</a>

                                        <form action="{{ route('anggotas.destroy', $anggota) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
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


@push('scripts')
    <script>
        $(document).ready(function() {

            $('#anggotaTable').DataTable({
                paging: false,
                info: false,
                ordering: false,
                language: {
                    search: "",
                    searchPlaceholder: "Cari anggota..."
                }
            });

            $('.dataTables_filter').appendTo('#customSearchBox');

        });
    </script>
@endpush
