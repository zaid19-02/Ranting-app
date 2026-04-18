<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\KasBulanan;
use App\Models\Pengeluaran;

class DashboardController extends Controller
{
    public function index()
    {
        // Mapping bulan Inggris → Indonesia
        $bulan = [
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
        ][date('F')];

        $tahun = date('Y');

        // ======================
        // TOTAL ANGGOTA
        // ======================
        $totalAnggota = Anggota::count();

        // ======================
        // TOTAL KAS BULAN INI
        // ======================
        $totalKasBulanIni = KasBulanan::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->sum('total');

        // ======================
        // TOTAL PENGELUARAN
        // ======================
        $totalPengeluaranBulanIni = Pengeluaran::whereMonth('tanggal', date('m'))
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');

        // ======================
        // GRAFIK KAS 12 BULAN
        // ======================
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

        return view('dashboard', compact(
            'totalAnggota',
            'totalKasBulanIni',
            'totalPengeluaranBulanIni',
            'kasPerBulan',
            'bulan',
            'tahun'
        ));
    }
}
