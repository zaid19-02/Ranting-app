@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <form action="{{ route('kas_bulanans.store_massal') }}" method="POST">
            @csrf

            <div class="card border-0 shadow-sm mb-4"
                style="border-radius: 20px; background: linear-gradient(135deg, #198754, #146c43);">
                <div class="card-body p-4 text-white">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <h3 class="fw-bold mb-1">Input Kas Kolektif</h3>
                            <p class="opacity-75 mb-0">Ranting Pengasinan - Mahesa Kurung</p>
                        </div>
                        <div class="col-md-3">
                            <label class="small fw-bold opacity-75">Periode Bulan</label>
                            <select name="bulan" class="form-select border-0 shadow-sm py-2" style="border-radius: 10px;">
                                @foreach ($bulanList as $bulan)
                                    <option value="{{ $bulan }}"
                                        {{ $bulan == now()->translatedFormat('F') ? 'selected' : '' }}>{{ $bulan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="small fw-bold opacity-75">Tahun</label>
                            <input type="number" name="tahun" class="form-control border-0 shadow-sm py-2"
                                style="border-radius: 10px;" value="{{ date('Y') }}">
                        </div>
                        <div class="col-md-2 text-end pt-3">
                            <span class="badge bg-white text-success p-2 px-3 shadow-sm" style="border-radius: 10px;">
                                <i class="bi bi-people-fill me-1"></i> {{ $anggotas->count() }} Anggota
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                @foreach ($anggotas as $anggota)
                    <div class="col-xl-6">
                        <div class="card border-0 shadow-sm member-card"
                            style="border-radius: 18px; border-left: 5px solid transparent; transition: 0.3s;">
                            <div class="card-body p-3">
                                <div class="row align-items-center">
                                    <div class="col-md-4 border-end border-light">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-box bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center me-3"
                                                style="width: 45px; height: 45px;">
                                                <i class="bi bi-person-circle fs-4"></i>
                                            </div>
                                            <div class="overflow-hidden">
                                                <h6 class="fw-bold mb-0 text-dark text-truncate">
                                                    {{ $anggota->nama_anggota }}</h6>
                                                <small class="text-muted"
                                                    style="font-size: 11px;">{{ $anggota->kode_wilayah }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row g-2 text-center">
                                            @foreach ([2, 3, 4] as $m)
                                                <div class="col-4">
                                                    <label class="text-muted fw-bold mb-1"
                                                        style="font-size: 9px; letter-spacing: 0.5px;">MINGGU
                                                        {{ $m }}</label>
                                                    <input type="date"
                                                        name="kas[{{ $anggota->id }}][tgl_{{ $m }}]"
                                                        class="form-control form-control-sm border-0 bg-light mb-1"
                                                        style="font-size: 10px; border-radius: 8px;">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text border-0 bg-light text-muted small"
                                                            style="font-size: 9px;">Rp</span>
                                                        <input type="number"
                                                            name="kas[{{ $anggota->id }}][bayar_{{ $m }}]"
                                                            class="form-control border-0 bg-light fw-bold text-success"
                                                            placeholder="0" style="border-radius: 0 8px 8px 0;">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="sticky-bottom bg-white bg-opacity-75 py-3 mt-5 shadow-lg border-top"
                style="backdrop-filter: blur(10px); margin-left: -20px; margin-right: -20px; padding-left: 40px; padding-right: 40px;">
                <div class="d-flex justify-content-between align-items-center container">
                    <div class="text-muted small">
                        <i class="bi bi-info-circle me-1"></i> Data yang diisi Rp 0 tidak akan tersimpan ke database.
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('kas_bulanans.index') }}" class="btn btn-light px-4 fw-bold"
                            style="border-radius: 12px;">Batal</a>
                        <button type="submit" class="btn btn-success px-5 fw-bold shadow-sm"
                            style="border-radius: 12px; background: #198754;">
                            <i class="bi bi-cloud-check-fill me-2"></i>Simpan Laporan Kolektif
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <style>
        .member-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
            border-left: 5px solid #198754 !important;
        }

        .form-control:focus {
            background-color: #fff !important;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1) !important;
        }

        /* Sembunyikan panah input number */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection
