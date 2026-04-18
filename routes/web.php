<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KasBulananController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\KegiatanTahunanController;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;

// --- GUEST ROUTES (LOGIN/LOGOUT) ---
Route::get('/', function () {
    return view('login');
})->name('login.form');

Route::post('/login', function (Request $request) {
    if ($request->role == 'admin') {
        return redirect()->route('login.admin.form');
    } else {
        session(['role' => 'user', 'login' => true]);
        return redirect('/dashboard');
    }
})->name('login');

Route::get('/login/admin', function () {
    return view('admin_login');
})->name('login.admin.form');

Route::post('/login/admin', function (Request $request) {
    if ($request->username == 'admin' && $request->password == 'admin123') {
        session([
            'role' => 'admin',
            'login' => true,
            'user_name' => 'Administrator'
        ]);
        return redirect('/dashboard')->with('success', 'Selamat datang, Administrator!');
    }

    return back()->with('error', 'Username atau password salah!');
})->name('login.admin.submit');

Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');


// --- AUTH ROUTES (HARUS LOGIN) ---
Route::middleware(['auth.session'])->group(function () {

    // ✅ Dashboard HARUS pakai controller
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');

    // 1. Data Anggota
    Route::get('/anggotas/search', [AnggotaController::class, 'search'])->name('anggotas.search');
    Route::resource('anggotas', AnggotaController::class);

    // 2. Kas Bulanan
    Route::post('/kas_bulanans/store-massal', [KasBulananController::class, 'storeMassal'])->name('kas_bulanans.store_massal');
    Route::resource('kas_bulanans', KasBulananController::class);

    // 3. Pengeluaran
    Route::resource('pengeluarans', PengeluaranController::class);

    // 4. Kegiatan Tahunan
    Route::resource('kegiatan_tahunan', KegiatanTahunanController::class);
});
