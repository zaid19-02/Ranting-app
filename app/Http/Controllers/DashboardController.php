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
        // =========================
        // MAPPING BULAN (AMAN)
        // =========================
        $bulanMap = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        // Ambil bulan sekarang (safe)
        $bulanSekarangEn = date('F');
        $bulan = $bulanMap[$bulanSekarangEn] ?? 'Januari'; // fallback biar tidak error

        $tahun = date('Y');

        // =========================
        // TOTAL ANGGOTA
        // =========================
        $totalAnggota = Anggota::count();

        // =========================
        // TOTAL KAS BULAN INI
        // =========================
        $totalKasBulanIni = KasBulanan::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->sum('total');

        // =========================
        // TOTAL PENGELUARAN
        // =========================
        $totalPengeluaranBulanIni = Pengeluaran::whereMonth('tanggal', date('m'))
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');

        // =========================
        // DATA GRAFIK 12 BULAN
        // =========================
        $kasPerBulan = [];

        $bulanList = [
            'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ];

        foreach ($bulanList as $b) {
            $kasPerBulan[] = KasBulanan::where('bulan', $b)
                ->where('tahun', $tahun)
                ->sum('total');
        }

        // =========================
        // RETURN KE VIEW
        // =========================
        return view('dashboard', [
            'totalAnggota' => $totalAnggota,
            'totalKasBulanIni' => $totalKasBulanIni,
            'totalPengeluaranBulanIni' => $totalPengeluaranBulanIni,
            'kasPerBulan' => $kasPerBulan,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }
}
