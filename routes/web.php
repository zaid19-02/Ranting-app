<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KasBulananController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\KegiatanTahunanController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;

// ==========================
// USER LANGSUNG KE DASHBOARD
// ==========================
Route::get('/', function () {
    session(['role' => 'user']); // otomatis user
    return redirect()->route('dashboard');
});

// ==========================
// ADMIN LOGIN
// ==========================
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

        return redirect()->route('dashboard')->with('success', 'Login admin berhasil!');
    }

    return back()->with('error', 'Username atau password salah!');
})->name('login.admin.submit');

// ==========================
// LOGOUT
// ==========================
Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');

// ==========================
// DASHBOARD (TANPA LOGIN WAJIB)
// ==========================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ==========================
// KHUSUS ADMIN SAJA
// ==========================
Route::middleware(['auth.session'])->group(function () {

    Route::get('/home', function () {
        return redirect()->route('dashboard');
    });

    // Data Anggota
    Route::get('/anggotas/search', [AnggotaController::class, 'search'])->name('anggotas.search');
    Route::resource('anggotas', AnggotaController::class);

    // Kas Bulanan
    Route::post('/kas_bulanans/store-massal', [KasBulananController::class, 'storeMassal'])->name('kas_bulanans.store_massal');
    Route::resource('kas_bulanans', KasBulananController::class);

    // Pengeluaran
    Route::resource('pengeluarans', PengeluaranController::class);

    // Kegiatan
    Route::resource('kegiatan_tahunan', KegiatanTahunanController::class);
});
