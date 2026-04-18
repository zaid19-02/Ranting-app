<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\KasBulanan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Mapping bulan Inggris ke Indonesia agar match dengan Database
        $bulanListIndo = [
            'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
            'April' => 'April', 'May' => 'Mei', 'June' => 'Juni',
            'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September',
            'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember',
        ];

        $bulanSekarangIndo = $bulanListIndo[date('F')];
        $tahunSekarang = date('Y');

        // 2. Mengambil data statistik
        $totalAnggota = Anggota::count();

        // Menghitung total kas bulan ini (berdasarkan kolom 'total')
        $totalKasBulanIni = KasBulanan::where('bulan', $bulanSekarangIndo)
            ->where('tahun', $tahunSekarang)
            ->sum('total');

        // Menghitung pengeluaran bulan ini (berdasarkan kolom 'jumlah')
        $totalPengeluaranBulanIni = Pengeluaran::whereMonth('tanggal', date('m'))
            ->whereYear('tanggal', $tahunSekarang)
            ->sum('jumlah');

        // 3. Menyiapkan data untuk Grafik (12 Bulan)
        $kasPerBulan = [];
        $daftarSemuaBulan = [
            'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ];

        foreach ($daftarSemuaBulan as $namaBulan) {
            $kasPerBulan[] = KasBulanan::where('bulan', $namaBulan)
                ->where('tahun', $tahunSekarang)
                ->sum('total');
        }

        // 4. Mengirim data ke view dashboard.blade.php
        return view('dashboard', [
            'totalAnggota' => $totalAnggota,
            'totalKasBulanIni' => $totalKasBulanIni,
            'totalPengeluaranBulanIni' => $totalPengeluaranBulanIni,
            'kasPerBulan' => $kasPerBulan,
            'bulan' => $bulanSekarangIndo,
            'tahun' => $tahunSekarang
        ]);
    }
}
