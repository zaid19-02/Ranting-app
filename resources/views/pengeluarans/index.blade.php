@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Pengeluaran</h2>
    @if(session('role') == 'admin')
    <a href="{{ route('pengeluarans.create') }}" class="btn btn-primary">Tambah Pengeluaran</a>
    @endif
</div>

<table class="table table-bordered datatable">
    <thead>
        <tr>
            <th>NO</th>
            <th>TANGGAL</th>
            <th>KETERANGAN PENGELUARAN</th>
            <th>JUMLAH (Rp)</th>
            @if(session('role') == 'admin')
            <th>AKSI</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($pengeluarans as $index => $pengeluaran)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $pengeluaran->tanggal }}</td>
            <td>{{ $pengeluaran->keterangan_pengeluaran }}</td>
            <td>Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
            @if(session('role') == 'admin')
            <td>
                <a href="{{ route('pengeluarans.edit', $pengeluaran) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('pengeluarans.destroy', $pengeluaran) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
