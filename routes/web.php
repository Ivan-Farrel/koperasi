<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\Admin\BukuTamuAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Layanan;
use App\Models\Setting;

/*
|--------------------------------------------------------------------------
| HALAMAN DEPAN
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $layanans = Layanan::all();

    $statusSistem = Setting::where('key', 'system_status')->value('value') ?? 'aktif';

    return view('welcome', compact('layanans', 'statusSistem'));
})->name('home');

/*
|--------------------------------------------------------------------------
| PROFILE (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| BUKU TAMU (PENGUNJUNG)
|--------------------------------------------------------------------------
*/
Route::get('/buku-tamu', [BukuTamuController::class, 'create'])->name('buku_tamu.create');
Route::post('/buku-tamu', [BukuTamuController::class, 'store'])->name('buku_tamu.store');

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin (PAKAI CONTROLLER)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Toggle Status Sistem
    Route::post('/dashboard/toggle-status', [DashboardController::class, 'toggleStatus'])
        ->name('dashboard.toggleStatus');

    // CRUD Layanan
    Route::resource('layanan', LayananController::class);

    // Buku Tamu (Admin)
    Route::get('/buku-tamu', [BukuTamuAdminController::class, 'index'])
        ->name('buku_tamu.index');

    // Export Buku Tamu
    Route::get('/buku-tamu/export', [BukuTamuAdminController::class, 'export'])
        ->name('buku_tamu.export');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (login, logout, dll)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
