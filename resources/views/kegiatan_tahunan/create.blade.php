@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Tambah Kegiatan Tahunan</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('kegiatan_tahunan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama Kegiatan</label>
                    <input
                        type="text"
                        name="nama_kegiatan"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Tahun</label>
                    <input
                        type="number"
                        name="tahun"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Tanggal Kegiatan</label>
                    <input
                        type="date"
                        name="tanggal_kegiatan"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Lokasi</label>
                    <input
                        type="text"
                        name="lokasi"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan
                </button>

                <a href="{{ route('kegiatan_tahunan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>
        </div>
    </div>

</div>
@endsection
