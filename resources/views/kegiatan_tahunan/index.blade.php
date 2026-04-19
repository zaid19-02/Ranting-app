@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8fafc;
    }
    .page-header {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        padding: 2.5rem;
        border-radius: 1.5rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .card-custom {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        background: white;
        overflow: hidden;
    }
    .table thead {
        background-color: #f1f5f9;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
    }
    .table tbody tr {
        transition: all 0.2s;
    }
    .table tbody tr:hover {
        background-color: #f8fafc;
        transform: scale(1.002);
    }
    .badge-date {
        background-color: #e2e8f0;
        color: #475569;
        font-weight: 600;
        padding: 0.5em 1em;
    }
    .btn-action {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.75rem;
        transition: 0.3s;
    }
    .btn-action:hover {
        transform: translateY(-2px);
    }
    .empty-state {
        padding: 4rem;
        text-align: center;
        background: white;
        border-radius: 1.5rem;
    }
</style>

<div class="container py-4">

    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h2 class="fw-bold mb-1">Manajemen Kegiatan</h2>
            <p class="mb-0 opacity-75">Kelola dan pantau seluruh agenda tahunan dalam satu dashboard.</p>
        </div>

        @if (Auth::user()->role == 'admin')
            <a href="{{ route('kegiatan_tahunan.create') }}" class="btn btn-light btn-lg px-4 shadow-sm fw-bold">
                <i class="fas fa-plus-circle me-2"></i>Tambah Kegiatan
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show rounded-4 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-4"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($kegiatans->count() > 0)
        <div class="card-custom border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center py-3" style="width: 80px;">No</th>
                            <th class="py-3">Informasi Kegiatan</th>
                            <th class="py-3">Waktu & Lokasi</th>
                            <th class="py-3">Deskripsi</th>
                            @if (Auth::user()->role == 'admin')
                                <th class="text-center py-3" style="width: 150px;">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatans as $index => $kegiatan)
                            <tr>
                                <td class="text-center align-middle">
                                    <span class="text-muted fw-bold">{{ $index + 1 }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="fw-bold text-dark fs-5">{{ $kegiatan->nama_kegiatan }}</div>
                                    <div class="text-muted small"><i class="far fa-calendar-alt me-1"></i> Tahun {{ $kegiatan->tahun }}</div>
                                </td>
                                <td class="align-middle">
                                    <div class="mb-1">
                                        <span class="badge badge-date rounded-pill">
                                            {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y') }}
                                        </span>
                                    </div>
                                    <div class="text-muted small">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $kegiatan->lokasi ?? 'Lokasi belum ditentukan' }}
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="text-muted mb-0 small" style="max-width: 250px;">
                                        {{ Str::limit($kegiatan->deskripsi ?? 'Tidak ada deskripsi tambahan.', 80) }}
                                    </p>
                                </td>
                                @if (Auth::user()->role == 'admin')
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('kegiatan_tahunan.edit', $kegiatan->id) }}"
                                               class="btn btn-warning btn-action text-white"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('kegiatan_tahunan.destroy', $kegiatan->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-action" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="empty-state shadow-sm">
            <div class="mb-4">
                <i class="fas fa-calendar-times fa-5x text-muted opacity-25"></i>
            </div>
            <h4 class="fw-bold text-dark">Belum Ada Agenda</h4>
            <p class="text-muted mb-4">Daftar kegiatan tahunan akan muncul di sini setelah Anda menambahkannya.</p>
            @if (Auth::user()->role == 'admin')
                <a href="{{ route('kegiatan_tahunan.create') }}" class="btn btn-primary px-5 rounded-pill fw-bold">
                    Mulai Tambah Kegiatan
                </a>
            @endif
        </div>
    @endif

</div>
@endsection
