@extends('layouts.app')

@section('content')
    <h2>Tambah Pengeluaran</h2>
    <form action="{{ route('pengeluarans.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Jumlah (Rp)</label>
                <input type="number" name="jumlah" class="form-control" step="1000" required>
            </div>
            <div class="col-md-12 mb-3">
                <label>Keterangan Pengeluaran</label>
                <textarea name="keterangan_pengeluaran" class="form-control" rows="3" required></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pengeluarans.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
