@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kegiatan Tahunan</h2>

        @if (Auth::user()->role == 'admin')
            <a href="{{ route('kegiatan_tahunan.create') }}" class="btn btn-primary">
                Tambah Kegiatan
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($kegiatans->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" style="width: 60px;">No</th>
                        <th>Nama Kegiatan</th>
                        <th>Tahun</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>

                        @if (Auth::user()->role == 'admin')
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach ($kegiatans as $index => $kegiatan)
                        <tr>
                            <td class="text-center">
                                {{ $index + 1 }}
                            </td>

                            <td class="fw-bold">
                                {{ $kegiatan->nama_kegiatan }}
                            </td>

                            <td>
                                {{ $kegiatan->tahun }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d M Y') }}
                            </td>

                            <td>
                                {{ $kegiatan->lokasi ?? '-' }}
                            </td>

                            <td>
                                {{ $kegiatan->deskripsi ?? '-' }}
                            </td>

                            @if (Auth::user()->role == 'admin')
                                <td class="text-center">

                                    <a href="{{ route('kegiatan_tahunan.edit', $kegiatan->id) }}"
                                        class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('kegiatan_tahunan.destroy', $kegiatan->id) }}"
                                        method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning text-center">
            <h5>Belum ada data kegiatan</h5>
            <p>Silakan tambah kegiatan terlebih dahulu.</p>

            @if (Auth::user()->role == 'admin')
                <a href="{{ route('kegiatan_tahunan.create') }}" class="btn btn-primary">
                    Tambah Kegiatan
                </a>
            @endif
        </div>
    @endif

</div>
@endsection
