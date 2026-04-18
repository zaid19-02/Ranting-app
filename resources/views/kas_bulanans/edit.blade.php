@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0"
        style="background: #f4f7f6; min-height: 100vh; font-family: 'Plus Jakarta Sans', sans-serif;">

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    {{-- Form Update menggunakan Method PUT --}}
                    <form action="{{ route('kas_bulanans.update', $kasBulanan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Card Utama: Informasi Dasar --}}
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                                <h5 class="mb-0 fw-bold text-dark">
                                    <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Data Kas:
                                    {{ $kasBulanan->anggota->nama_anggota }}
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Pilih Anggota</label>
                                        <select name="anggota_id" id="selectAnggota"
                                            class="form-select border-0 shadow-none" required>
                                            @foreach ($anggotas as $anggota)
                                                <option value="{{ $anggota->id }}"
                                                    {{ $kasBulanan->anggota_id == $anggota->id ? 'selected' : '' }}>
                                                    {{ $anggota->nama_anggota }} ({{ $anggota->kode_wilayah }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted mt-1 d-block">Anggota tidak bisa diubah jika salah input
                                            awal (opsional)</small>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label fw-bold">Bulan</label>
                                        <select name="bulan" class="form-select shadow-none border-0 bg-light" required>
                                            @foreach ($bulanList as $bulan)
                                                <option value="{{ $bulan }}"
                                                    {{ $kasBulanan->bulan == $bulan ? 'selected' : '' }}>
                                                    {{ $bulan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label fw-bold">Tahun</label>
                                        <input type="number" name="tahun"
                                            class="form-control shadow-none border-0 bg-light"
                                            value="{{ $kasBulanan->tahun }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Grid Kartu per Minggu --}}
                        <div class="row g-4 mb-4">
                            @php
                                $colors = ['1' => '#6c757d', '2' => '#0d6efd', '3' => '#198754', '4' => '#ffc107'];
                            @endphp

                            @foreach ($colors as $m => $color)
                                @php
                                    $tgl_field = 'tanggal_m_' . $m;
                                    $jml_field = 'jumlah_bayar_m_' . $m;
                                @endphp
                                <div class="col-md-6 col-lg-3">
                                    <div class="card border-0 shadow-sm h-100"
                                        style="border-radius: 12px; border-top: 4px solid {{ $color }} !important;">
                                        <div class="card-body p-3">
                                            <h6 class="fw-bold mb-3" style="color: {{ $color }}">Minggu
                                                {{ $m }}</h6>
                                            <div class="mb-2">
                                                <label class="small fw-semibold text-muted">Tanggal</label>
                                                <input type="date" name="{{ $tgl_field }}"
                                                    class="form-control form-control-sm border-0 bg-light"
                                                    value="{{ $kasBulanan->$tgl_field }}">
                                            </div>
                                            <div>
                                                <label class="small fw-semibold text-muted">Jumlah (Rp)</label>
                                                <input type="number" name="{{ $jml_field }}"
                                                    class="form-control form-control-sm border-0 bg-light"
                                                    value="{{ $kasBulanan->$jml_field }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Catatan --}}
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                            <div class="card-body p-4">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-chat-left-text me-2 text-success"></i>Catatan Tambahan
                                </label>
                                <textarea name="keterangan" class="form-control border-0 bg-light" rows="2" placeholder="Keterangan tambahan..."
                                    style="border-radius: 10px;">{{ $kasBulanan->keterangan }}</textarea>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-end gap-2 mb-5">
                            <a href="{{ route('kas_bulanans.index') }}" class="btn btn-light px-4 fw-bold shadow-sm"
                                style="border-radius: 10px; border: 1px solid #ddd;">Batal</a>
                            <button type="submit" class="btn btn-warning px-5 fw-bold shadow-sm text-white"
                                style="border-radius: 10px;">
                                <i class="bi bi-arrow-repeat me-2"></i>Perbarui Data
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        .form-label {
            font-size: 14px;
            color: #4b5563;
        }

        .select2-container--bootstrap-5 .select2-selection {
            background-color: #f8f9fa !important;
            border: none !important;
            border-radius: 10px !important;
            padding: 0.375rem 0.75rem;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#selectAnggota').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Anggota --',
                width: '100%'
            });
        });
    </script>
@endpush
