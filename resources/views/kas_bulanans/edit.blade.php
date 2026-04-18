@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0"
        style="background: #f4f7f6; min-height: 100vh; font-family: 'Plus Jakarta Sans', sans-serif;">

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <form action="{{ route('kas_bulanans.update', $kas->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- HEADER --}}
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                                <h5 class="mb-0 fw-bold text-dark">
                                    <i class="bi bi-pencil-square me-2 text-warning"></i>
                                    Edit Data Kas: {{ $kas->anggota->nama_anggota }}
                                </h5>
                            </div>

                            <div class="card-body p-4">
                                <div class="row">

                                    {{-- ANGGOTA --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Pilih Anggota</label>
                                        <select name="anggota_id" id="selectAnggota"
                                            class="form-select border-0 shadow-none" required>

                                            @foreach ($anggotas as $anggota)
                                                <option value="{{ $anggota->id }}"
                                                    {{ $kas->anggota_id == $anggota->id ? 'selected' : '' }}>
                                                    {{ $anggota->nama_anggota }} ({{ $anggota->kode_wilayah }})
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    {{-- BULAN --}}
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label fw-bold">Bulan</label>
                                        <select name="bulan" class="form-select border-0 bg-light" required>
                                            @foreach ($bulanList as $b)
                                                <option value="{{ $b }}"
                                                    {{ $kas->bulan == $b ? 'selected' : '' }}>
                                                    {{ $b }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- TAHUN --}}
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label fw-bold">Tahun</label>
                                        <input type="number" name="tahun" class="form-control border-0 bg-light"
                                            value="{{ $kas->tahun }}" required>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- MINGGU --}}
                        <div class="row g-4 mb-4">
                            @php
                                $colors = ['1' => '#6c757d', '2' => '#0d6efd', '3' => '#198754', '4' => '#ffc107'];
                            @endphp

                            @foreach ($colors as $m => $color)
                                @php
                                    $tgl = 'tanggal_m_' . $m;
                                    $jml = 'jumlah_bayar_m_' . $m;
                                @endphp

                                <div class="col-md-6 col-lg-3">
                                    <div class="card border-0 shadow-sm h-100"
                                        style="border-top: 4px solid {{ $color }}; border-radius: 12px;">
                                        <div class="card-body p-3">

                                            <h6 class="fw-bold mb-3" style="color: {{ $color }}">
                                                Minggu {{ $m }}
                                            </h6>

                                            <div class="mb-2">
                                                <label class="small text-muted">Tanggal</label>
                                                <input type="date" name="{{ $tgl }}"
                                                    class="form-control form-control-sm border-0 bg-light"
                                                    value="{{ $kas->$tgl }}">
                                            </div>

                                            <div>
                                                <label class="small text-muted">Jumlah</label>
                                                <input type="number" name="{{ $jml }}"
                                                    class="form-control form-control-sm border-0 bg-light"
                                                    value="{{ $kas->$jml }}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- KETERANGAN --}}
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                            <div class="card-body p-4">
                                <label class="form-label fw-bold">Keterangan</label>
                                <textarea name="keterangan" class="form-control border-0 bg-light" rows="2">{{ $kas->keterangan }}</textarea>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('kas_bulanans.index') }}" class="btn btn-light border">
                                Batal
                            </a>

                            <button type="submit" class="btn btn-warning text-white">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
