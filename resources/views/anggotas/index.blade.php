@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4 bg-light min-vh-100" style="font-family: 'Plus Jakarta Sans', sans-serif;">

        {{-- HEADER --}}
        <div class="card border-0 shadow-sm mb-4 overflow-hidden" style="border-radius: 24px; background-color: #0f4332;">

            <div class="card-body text-center text-white py-5">

                <h2 class="fw-bold mb-1" style="letter-spacing: 2px;">
                    MAHESA KURUNG AL-MUKAROMAH
                </h2>

                <div class="text-white-50 small" style="letter-spacing: 4px;">
                    RANTING PENGASINAN
                </div>

            </div>
        </div>

        {{-- TOP BAR --}}
        <div class="row g-3 mb-3">

            {{-- TOTAL --}}
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body d-flex align-items-center justify-content-between py-3">

                        <div class="d-flex align-items-center gap-2">

                            <div class="bg-success bg-opacity-10 p-2 rounded-3">
                                <i class="bi bi-people-fill text-success"></i>
                            </div>

                            <div class="text-muted small fw-semibold">
                                TOTAL ANGGOTA
                            </div>

                        </div>

                        <div class="fs-5 fw-bold text-dark">
                            {{ count($anggotas) }}
                        </div>

                    </div>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="col-md-8 d-flex justify-content-md-end align-items-center gap-2 flex-wrap">

                @if (session('role') == 'admin')
                    <a href="{{ route('anggotas.create') }}" class="btn px-4 rounded-3 shadow-sm text-white"
                        style="background-color: #137a4a; border: none;">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Anggota
                    </a>
                @endif

                <button onclick="window.print()" class="btn btn-outline-secondary px-4 rounded-3">
                    <i class="bi bi-printer me-1"></i> Print
                </button>

                <div id="customSearchBox"></div>

            </div>

        </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

                <h6 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-table me-2 text-primary"></i>
                    Data Anggota
                </h6>

                <small class="text-muted">Realtime data anggota</small>

            </div>

            {{-- ❌ FIX: HAPUS SCROLL RESPONSIVE --}}
            <div>

                <table class="table table-hover align-middle mb-0" id="anggotaTable">

                    <thead class="table-light">
                        <tr class="text-uppercase small text-muted">

                            <th class="ps-3">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Kelahiran</th>
                            <th>Alamat</th>
                            <th>Wilayah</th>
                            <th class="text-center">Status</th>
                            <th>Kontak</th>

                            @if (session('role') == 'admin')
                                <th class="text-center">Aksi</th>
                            @endif

                        </tr>
                    </thead>

                    <tbody>

                        @forelse($anggotas as $index => $anggota)
                            <tr>

                                <td class="ps-3 text-muted">{{ $index + 1 }}</td>

                                <td>
                                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                        {{ $anggota->kode_wilayah }}
                                    </span>
                                </td>

                                <td>
                                    <div class="fw-semibold text-dark">{{ $anggota->nama_anggota }}</div>
                                    <div class="text-muted small">{{ $anggota->ranting }}</div>
                                </td>

                                <td class="small text-muted">
                                    {{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d M Y') }}<br>
                                    {{ $anggota->tempat_lahir }}
                                </td>

                                <td class="small text-muted">
                                    {{ \Illuminate\Support\Str::limit($anggota->alamat, 35) }}
                                </td>

                                <td class="small">
                                    <div class="text-dark">{{ $anggota->kecamatan }}</div>
                                    <div class="text-muted">{{ $anggota->kabupaten_kota }}</div>
                                </td>

                                {{-- STATUS --}}
                                <td class="text-center">

                                    @php
                                        $statusStyle = match ($anggota->status) {
                                            'GURU RANTING' => [
                                                'bg' => '#ede9fe',
                                                'text' => '#7c3aed',
                                                'icon' => 'bi-award-fill',
                                            ],

                                            'ANGGOTA AKTIF' => [
                                                'bg' => '#dcfce7',
                                                'text' => '#16a34a',
                                                'icon' => 'bi-check-circle-fill',
                                            ],

                                            'NON AKTIF' => [
                                                'bg' => '#fee2e2',
                                                'text' => '#ef4444',
                                                'icon' => 'bi-slash-circle-fill',
                                            ],

                                            default => [
                                                'bg' => '#e0f2fe',
                                                'text' => '#0284c7',
                                                'icon' => 'bi-person-fill',
                                            ],
                                        };
                                    @endphp

                                    <span class="d-inline-flex align-items-center gap-1 px-3 py-2 rounded-pill shadow-sm"
                                        style="
                                        background: {{ $statusStyle['bg'] }};
                                        color: {{ $statusStyle['text'] }};
                                        font-size: 11px;
                                        font-weight: 700;
                                        border: 1px solid {{ $statusStyle['text'] }}20;
                                        white-space: nowrap;
                                    ">

                                        <i class="bi {{ $statusStyle['icon'] }}" style="font-size: 12px;"></i>

                                        {{ $anggota->status }}

                                    </span>

                                </td>

                                <td class="small text-dark">
                                    {{ $anggota->no_telpon }}
                                </td>

                                @if (session('role') == 'admin')
                                    <td class="text-center">

                                        <a href="{{ route('anggotas.edit', $anggota) }}"
                                            class="btn btn-sm btn-outline-warning rounded-3">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('anggotas.destroy', $anggota) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')

                                            <button class="btn btn-sm btn-outline-danger rounded-3"
                                                onclick="return confirm('Hapus data ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </td>
                                @endif

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    Tidak ada data anggota
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection


@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap"
        rel="stylesheet">

    <style>
        .table-hover tbody tr:hover {
            background: #f8fafc;
            transition: 0.2s;
        }

        .card {
            border-radius: 20px;
        }

        .badge {
            font-size: 11px;
        }

        /* search */
        #customSearchBox input {
            border-radius: 12px;
            padding: 8px 14px;
            border: 1px solid #e5e7eb;
            outline: none;
            min-width: 220px;
        }

        #customSearchBox input:focus {
            border-color: #0f172a;
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.1);
        }
    </style>
@endpush


@push('scripts')
    <script>
        $(document).ready(function() {

            $('#anggotaTable').DataTable({
                paging: false,
                info: false,
                ordering: false,
                scrollX: false, // ❌ FIX: hilangkan scroll + panah bawah
                language: {
                    search: "",
                    searchPlaceholder: "Cari anggota..."
                }
            });

            $('.dataTables_filter').appendTo('#customSearchBox');

        });
    </script>
@endpush
