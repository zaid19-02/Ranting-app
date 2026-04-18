@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4" style="background-color: #f8f9fc; min-height: 100vh; font-family: 'Inter', sans-serif;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-10">

                    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap">
                        <div>
                            <h2 class="fw-bold text-dark mb-1">Tambah Anggota Baru</h2>
                            <p class="text-muted small mb-0">Silahkan lengkapi data profil anggota dengan benar.</p>
                        </div>
                        <a href="{{ route('anggotas.index') }}"
                            class="btn btn-outline-secondary border-0 fw-semibold px-3 mt-2 mt-md-0">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    <form action="{{ route('anggotas.store') }}" method="POST">
                        @csrf

                        <div class="card border-0 shadow-sm mb-5" style="border-radius: 16px; overflow: hidden;">

                            <div style="height: 5px; background: linear-gradient(90deg, #0d6efd, #6610f2);"></div>

                            <div class="card-body p-4 p-md-5">

                                <div class="row mb-4">
                                    <div class="col-12 mb-3">
                                        <h5 class="fw-bold text-primary mb-0"><i
                                                class="bi bi-person-badge me-2"></i>Identitas Pribadi</h5>
                                        <hr class="mt-2 opacity-50">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">Kode Wilayah</label>
                                        <input type="text" name="kode_wilayah"
                                            class="form-control form-control-lg border-0 bg-light shadow-none @error('kode_wilayah') is-invalid @enderror"
                                            placeholder="Contoh: PGS-01" value="{{ old('kode_wilayah') }}" required>
                                        @error('kode_wilayah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">Nama Lengkap Anggota</label>
                                        <input type="text" name="nama_anggota"
                                            class="form-control form-control-lg border-0 bg-light shadow-none @error('nama_anggota') is-invalid @enderror"
                                            placeholder="Masukkan nama lengkap" value="{{ old('nama_anggota') }}" required>
                                        @error('nama_anggota')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir"
                                            class="form-control form-control-lg border-0 bg-light shadow-none"
                                            placeholder="Kota Lahir" value="{{ old('tempat_lahir') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir"
                                            class="form-control form-control-lg border-0 bg-light shadow-none"
                                            value="{{ old('tanggal_lahir') }}" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12 mb-3 mt-2">
                                        <h5 class="fw-bold text-primary mb-0"><i class="bi bi-geo-alt-fill me-2"></i>Alamat
                                            & Domisili</h5>
                                        <hr class="mt-2 opacity-50">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">Alamat Lengkap</label>
                                        <textarea name="alamat" class="form-control border-0 bg-light shadow-none" rows="2"
                                            placeholder="Jl. Raya No. 123..." required>{{ old('alamat') }}</textarea>
                                    </div>
                                    <div class="col-md-3 col-6 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">Kelurahan</label>
                                        <input type="text" name="kelurahan"
                                            class="form-control border-0 bg-light shadow-none" placeholder="Kelurahan"
                                            required>
                                    </div>
                                    <div class="col-md-3 col-6 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">Kecamatan</label>
                                        <input type="text" name="kecamatan"
                                            class="form-control border-0 bg-light shadow-none" placeholder="Kecamatan"
                                            required>
                                    </div>
                                    <div class="col-md-3 col-6 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">Kabupaten/Kota</label>
                                        <input type="text" name="kabupaten_kota"
                                            class="form-control border-0 bg-light shadow-none" placeholder="Kota" required>
                                    </div>
                                    <div class="col-md-3 col-6 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">Provinsi</label>
                                        <input type="text" name="provinsi"
                                            class="form-control border-0 bg-light shadow-none" placeholder="Provinsi"
                                            required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12 mb-3 mt-2">
                                        <h5 class="fw-bold text-primary mb-0"><i
                                                class="bi bi-briefcase-fill me-2"></i>Keanggotaan & Kontak</h5>
                                        <hr class="mt-2 opacity-50">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">Ranting</label>
                                        <input type="text" name="ranting"
                                            class="form-control form-control-lg border-0 bg-light shadow-none fw-bold"
                                            value="PENGASINAN" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">Status</label>
                                        <select name="status"
                                            class="form-select form-select-lg border-0 bg-light shadow-none" required>
                                            <option value="">Pilih Status</option>
                                            <option value="GURU RANTING">GURU RANTING</option>
                                            <option value="ANGGOTA AKTIF">ANGGOTA AKTIF</option>
                                            <option value="NON AKTIF">NON AKTIF</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label small fw-bold text-uppercase">No. Telpon
                                            (WhatsApp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text border-0 bg-light text-success"><i
                                                    class="bi bi-whatsapp"></i></span>
                                            <input type="text" name="no_telpon"
                                                class="form-control form-control-lg border-0 bg-light shadow-none"
                                                placeholder="08xxxxxxxx" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4 gap-2">
                                    <button type="reset" class="btn btn-light px-4 py-2 fw-semibold">Reset</button>
                                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm"
                                        style="border-radius: 10px;">
                                        <i class="bi bi-check-circle me-2"></i>Simpan Data
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* Styling khusus agar terlihat premium */
        .form-control,
        .form-select,
        .input-group-text {
            border-radius: 10px !important;
            transition: all 0.3s ease-in-out;
        }

        /* Efek focus yang halus */
        .form-control:focus,
        .form-select:focus {
            background-color: #ffffff !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05) !important;
            border: 1px solid #0d6efd !important;
        }

        /* Penyesuaian label agar tidak kaku */
        .form-label {
            letter-spacing: 0.5px;
            color: #4b5563;
            margin-bottom: 8px;
        }

        /* Responsif untuk HP */
        @media (max-width: 768px) {
            .card-body {
                padding: 25px !important;
            }

            h2 {
                font-size: 1.5rem;
            }

            .btn-primary {
                width: 100%;
                /* Tombol simpan penuh di layar HP */
            }
        }
    </style>
@endpush
