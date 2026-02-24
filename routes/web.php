<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\Admin\BukuTamuAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarouselController;
use App\Models\Layanan;
use App\Models\Setting;
use App\Models\Carousel; 

/*
|--------------------------------------------------------------------------
| HALAMAN DEPAN
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $layanans = Layanan::all();
    
    // AMBIL DATA CAROUSEL DARI DATABASE
    $carousels = Carousel::where('is_active', true)->get();

    $statusSistem = Setting::where('key', 'system_status')->value('value') ?? 'aktif';

    // Kirim carousel ke view welcome
    return view('welcome', compact('layanans', 'statusSistem', 'carousels'));
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
| ADMIN AREA (PROTECTED BY AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Toggle Status Sistem
    Route::post('/dashboard/toggle-status', [DashboardController::class, 'toggleStatus'])
        ->name('dashboard.toggleStatus');

    // CRUD Layanan
    Route::resource('layanan', LayananController::class);

    // CRUD Carousel (DIPINDAH KE DALAM GRUP ADMIN AGAR AMAN)
    Route::resource('carousel', CarouselController::class)->except(['show', 'edit', 'update']);

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