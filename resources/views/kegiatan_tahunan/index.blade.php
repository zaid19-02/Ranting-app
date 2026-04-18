@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Kegiatan Tahunan</h2>
            @if (session('role') == 'admin')
                <div>
                    <a href="{{ route('kegiatan_tahunan.create') }}" class="btn btn-primary">
                        Tambah Kegiatan
                    </a>
                    @if ($kegiatan)
                        <a href="{{ route('kegiatan_tahunan.edit', $kegiatan) }}" class="btn btn-warning">
                            Edit Kegiatan
                        </a>
                    @endif
                </div>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($kegiatan)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" style="width: 50px;">NO</th>
                            <th class="text-center">Bulan</th>
                            <th class="text-center">Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $bulanList = [
                                1 => 'JANUARI',
                                2 => 'FEBRUARI',
                                3 => 'MARET',
                                4 => 'APRIL',
                                5 => 'MEI',
                                6 => 'JUNI',
                                7 => 'JULI',
                                8 => 'AGUSTUS',
                                9 => 'SEPTEMBER',
                                10 => 'OKTOBER',
                                11 => 'NOVEMBER',
                                12 => 'DESEMBER',
                            ];
                        @endphp

                        @foreach ($bulanList as $no => $bulan)
                            @php
                                $bulanLower = strtolower($bulan);
                                $kegiatanBulan = $kegiatan->$bulanLower ?? '-';
                            @endphp
                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="fw-bold">{{ $bulan }}</td>
                                <td>{{ $kegiatanBulan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <strong>Tahun:</strong> {{ $kegiatan->tahun }}
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                <h5>Belum ada data kegiatan tahunan</h5>
                <p>Silakan tambah data kegiatan tahunan terlebih dahulu.</p>
                @if (session('role') == 'admin')
                    <a href="{{ route('kegiatan_tahunan.create') }}" class="btn btn-primary mt-2">
                        Tambah Kegiatan Tahun Ini
                    </a>
                @endif
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th {
            white-space: nowrap;
        }
    </style>
@endpush
