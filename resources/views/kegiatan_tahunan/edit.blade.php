@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Kegiatan Tahunan - Tahun {{ $kegiatanTahunan->tahun }}</h2>

        <form action="{{ route('kegiatan_tahunan.update', $kegiatanTahunan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun" class="form-control" value="{{ $kegiatanTahunan->tahun }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Januari</label>
                    <textarea name="januari" class="form-control" rows="2">{{ $kegiatanTahunan->januari }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Februari</label>
                    <textarea name="februari" class="form-control" rows="2">{{ $kegiatanTahunan->februari }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Maret</label>
                    <textarea name="maret" class="form-control" rows="2">{{ $kegiatanTahunan->maret }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">April</label>
                    <textarea name="april" class="form-control" rows="2">{{ $kegiatanTahunan->april }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Mei</label>
                    <textarea name="mei" class="form-control" rows="2">{{ $kegiatanTahunan->mei }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Juni</label>
                    <textarea name="juni" class="form-control" rows="2">{{ $kegiatanTahunan->juni }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Juli</label>
                    <textarea name="juli" class="form-control" rows="2">{{ $kegiatanTahunan->juli }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Agustus</label>
                    <textarea name="agustus" class="form-control" rows="2">{{ $kegiatanTahunan->agustus }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">September</label>
                    <textarea name="september" class="form-control" rows="2">{{ $kegiatanTahunan->september }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Oktober</label>
                    <textarea name="oktober" class="form-control" rows="2">{{ $kegiatanTahunan->oktober }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">November</label>
                    <textarea name="november" class="form-control" rows="2">{{ $kegiatanTahunan->november }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Desember</label>
                    <textarea name="desember" class="form-control" rows="2">{{ $kegiatanTahunan->desember }}</textarea>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('kegiatan_tahunan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
