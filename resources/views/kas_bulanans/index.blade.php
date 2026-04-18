@extends('layouts.app')

@section('content')

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* PRINT FIX */
        @media print {

            .no-print,
            .d-print-none {
                display: none !important;
            }

            body {
                background: #fff !important;
            }

            .card {
                box-shadow: none !important;
            }
        }

        .soft-card {
            border-radius: 18px;
        }
    </style>

    <div class="container-fluid py-4 bg-light min-vh-100">

        {{-- HEADER --}}
        <div class="card border-0 shadow-sm mb-4 overflow-hidden" style="border-radius: 24px; background-color: #0f4332;">

            <div class="card-body text-center text-white py-5">

                <h2 class="fw-bold mb-1" style="letter-spacing: 2px;">
                    MAHESA KURUNG AL-MUKAROMAH
                </h2>

                <div class="text-white-50 small" style="letter-spacing: 4px;">
                    RANTING PENGASINAN
                </div>

            </div>
        </div>

        {{-- TOP SECTION --}}
        <div class="row g-3 mb-4">

            {{-- PERIODE --}}
            <div class="col-md-4">
                <div class="card border-0 shadow-sm soft-card">
                    <div class="card-body d-flex align-items-center gap-3">

                        <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-calendar-check text-success fs-4"></i>
                        </div>

                        <div>
                            <div class="text-muted small fw-bold">LAPORAN PERIODE</div>
                            <h4 class="mb-0 fw-bold">{{ $bulan }} {{ $tahun }}</h4>
                        </div>

                    </div>
                </div>
            </div>

            {{-- FILTER --}}
            <div class="col-md-5 no-print">
                <div class="card border-0 shadow-sm soft-card">
                    <div class="card-body">

                        <form action="{{ route('kas_bulanans.index') }}" method="GET" class="d-flex gap-2">

                            {{-- 🔍 SEARCH NAMA --}}
                            <input type="text" name="search" class="form-control shadow-sm" placeholder="Cari nama..."
                                value="{{ request('search') }}" style="width: 160px;">

                            {{-- BULAN --}}
                            <select name="bulan" class="form-select shadow-sm">

                                <option value="All" {{ $bulan == 'All' ? 'selected' : '' }}>
                                    All
                                </option>

                                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $b)
                                    <option value="{{ $b }}" {{ $bulan == $b ? 'selected' : '' }}>
                                        {{ $b }}
                                    </option>
                                @endforeach

                            </select>

                            {{-- TAHUN --}}
                            <input type="number" name="tahun" class="form-control shadow-sm" value="{{ $tahun }}"
                                style="width: 120px;">

                            {{-- BUTTON --}}
                            <button class="btn btn-dark">
                                <i class="bi bi-search"></i>
                            </button>

                        </form>

                    </div>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="col-md-3 d-flex justify-content-end align-items-center gap-2 no-print">

                @if (Auth::check() || session('role') == 'admin')
                    <a href="{{ route('kas_bulanans.create') }}" class="btn btn-success px-3 shadow-sm">
                        <i class="bi bi-plus-lg me-1"></i> Input
                    </a>
                @endif

                <button onclick="window.print()" class="btn btn-outline-dark shadow-sm">
                    <i class="bi bi-printer"></i>
                </button>

            </div>

        </div>

        {{-- ========================= --}}
        {{-- HEADER RINCIAN --}}
        {{-- ========================= --}}

        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">

            <h5 class="mb-0 fw-bold text-dark">
                <i class="bi bi-table me-2 text-success"></i>
                Rincian Kas Murid
            </h5>

            <span class="badge bg-light text-dark border fw-semibold px-3 py-2">
                Total Kas: Rp
                {{ number_format(
                    $kasBulanans->sum(function ($anggota) {
                        return $anggota->kasBulanans->sum('total');
                    }),
                    0,
                    ',',
                    '.',
                ) }}
            </span>

        </div>

        {{-- TABLE --}}
        <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px; overflow: hidden;">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light text-center">
                        <tr class="align-middle">
                            <th rowspan="2" class="py-3 small fw-bold text-secondary border-end" style="width: 50px;">NO
                            </th>
                            <th rowspan="2" class="py-3 small fw-bold text-secondary border-end text-start">
                                NAMA ANGGOTA
                            </th>

                            <th colspan="2" class="border-bottom text-dark">MINGGU 1</th>
                            <th colspan="2" class="border-bottom text-primary">MINGGU 2</th>
                            <th colspan="2" class="border-bottom text-success">MINGGU 3</th>
                            <th colspan="2" class="border-bottom text-warning">MINGGU 4</th>

                            <th rowspan="2" class="py-3 small fw-bold text-secondary border-start">TOTAL</th>

                            @if (Auth::check() || session('role') == 'admin')
                                <th rowspan="2" class="py-3 small fw-bold text-secondary text-center d-print-none">
                                    AKSI
                                </th>
                            @endif
                        </tr>

                        <tr class="text-center bg-light">
                            <th class="py-2 x-small border-end">TGL</th>
                            <th class="py-2 x-small border-end">JUMLAH</th>
                            <th class="py-2 x-small border-end">TGL</th>
                            <th class="py-2 x-small border-end">JUMLAH</th>
                            <th class="py-2 x-small border-end">TGL</th>
                            <th class="py-2 x-small border-end">JUMLAH</th>
                            <th class="py-2 x-small border-end">TGL</th>
                            <th class="py-2 x-small border-end">JUMLAH</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($kasBulanans as $index => $anggota)
                            @php $kas = $anggota->kasBulanans->first(); @endphp

                            <tr>
                                <td class="text-center fw-bold border-end text-muted">{{ $index + 1 }}</td>
                                <td class="fw-bold border-end">{{ $anggota->nama_anggota }}</td>

                                @for ($i = 1; $i <= 4; $i++)
                                    @php
                                        $tgl = 'tanggal_m_' . $i;
                                        $jml = 'jumlah_bayar_m_' . $i;
                                    @endphp

                                    <td class="text-center small border-end">
                                        {{ $kas && $kas->$tgl ? date('d/m', strtotime($kas->$tgl)) : '-' }}
                                    </td>

                                    <td class="text-end border-end">
                                        {{ number_format($kas->$jml ?? 0, 0, ',', '.') }}
                                    </td>
                                @endfor

                                <td class="text-end fw-bold bg-light">
                                    Rp {{ number_format($kas->total ?? 0, 0, ',', '.') }}
                                </td>

                                @if (Auth::check() || session('role') == 'admin')
                                    <td class="text-center d-print-none">
                                        @if ($kas)
                                            <a href="{{ route('kas_bulanans.edit', $kas) }}"
                                                class="btn btn-sm btn-light border text-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('kas_bulanans.destroy', $kas) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-light border text-danger"
                                                    onclick="return confirm('Hapus data kas ini?')">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-light text-muted border">Nihil</span>
                                        @endif
                                    </td>
                                @endif

                            </tr>

                        @empty
                            <tr>
                                <td colspan="12" class="text-center py-5 text-muted">
                                    Data kas belum tersedia untuk periode ini.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>
@endsection
