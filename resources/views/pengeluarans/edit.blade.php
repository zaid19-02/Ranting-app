@extends('layouts.app')

@section('content')
    <h2>Edit Pengeluaran</h2>
    <form action="{{ route('pengeluarans.update', $pengeluaran) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $pengeluaran->tanggal }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Jumlah (Rp)</label>
                <input type="number" name="jumlah" class="form-control" step="1000" value="{{ $pengeluaran->jumlah }}"
                    required>
            </div>
            <div class="col-md-12 mb-3">
                <label>Keterangan Pengeluaran</label>
                <textarea name="keterangan_pengeluaran" class="form-control" rows="3" required>{{ $pengeluaran->keterangan_pengeluaran }}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pengeluarans.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
