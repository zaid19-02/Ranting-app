<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KasBulananController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\KegiatanTahunanController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (LOGIN / LOGOUT)
|--------------------------------------------------------------------------
*/

// FORM LOGIN
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// "/" arahkan ke login
Route::get('/', [AuthController::class, 'showLoginForm']);

// PROSES LOGIN
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| USER LOGIN (SEMUA ROLE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // DASHBOARD (admin & user)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::redirect('/home', '/dashboard');
});


/*
|--------------------------------------------------------------------------
| ADMIN ONLY 🔒
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // DATA ANGGOTA
    Route::get('/anggotas/search', [AnggotaController::class, 'search'])->name('anggotas.search');
    Route::resource('anggotas', AnggotaController::class);

    // KAS BULANAN
    Route::post('/kas_bulanans/store-massal', [KasBulananController::class, 'storeMassal'])
        ->name('kas_bulanans.store_massal');
    Route::resource('kas_bulanans', KasBulananController::class);

    // PENGELUARAN
    Route::resource('pengeluarans', PengeluaranController::class);

    // KEGIATAN
    Route::resource('kegiatan_tahunan', KegiatanTahunanController::class);
});
