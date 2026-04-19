<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\KasBulanan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
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

        $bulan = $bulanMap[date('F')];
        $tahun = date('Y');

        // 🔥 FIX: ambil user terbaru
        $user = Auth::user()->fresh();

        // ======================
        // DATA KAS (SEMUA ROLE)
        // ======================
        $totalKasBulanIni = KasBulanan::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->sum('total');

        $kasData = KasBulanan::selectRaw('bulan, SUM(total) as total')
            ->where('tahun', $tahun)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $bulanList = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $kasPerBulan = [];

        foreach ($bulanList as $b) {
            $kasPerBulan[] = $kasData[$b] ?? 0;
        }

        // ======================
        // ADMIN
        // ======================
        if ($user->role == 'admin') {

            $totalAnggota = Anggota::count();

            $totalPengeluaranBulanIni = Pengeluaran::whereMonth('tanggal', date('m'))
                ->whereYear('tanggal', $tahun)
                ->sum('jumlah');

            return view('dashboard', compact(
                'totalAnggota',
                'totalKasBulanIni',
                'totalPengeluaranBulanIni',
                'kasPerBulan',
                'bulan',
                'tahun'
            ));
        }

        // ======================
        // USER
        // ======================
        return view('dashboard_user', compact(
            'totalKasBulanIni',
            'kasPerBulan',
            'bulan',
            'tahun'
        ));
    }
}
