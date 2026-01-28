<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPc\UnitOrganisasiController;
use App\Http\Controllers\WilayahController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // API untuk mendapatkan daftar desa berdasarkan kecamatan (untuk dropdown dinamis)
    Route::get('/api/wilayah/desa/{kecamatan_id}', [WilayahController::class, 'getDesaByKecamatan'])
         ->name('api.wilayah.desa');
});

// Hanya Admin PC yang bisa akses
Route::middleware(['auth', 'role:admin_pc'])->prefix('admin-pc')->name('admin_pc.')->group(function () {
    // Dashboard Admin PC (Bawaan Breeze atau buat sendiri nanti)
    Route::get('/dashboard', function () {
        return view('admin_pc.dashboard');
    })->name('dashboard');

    // CRUD Unit Organisasi
    Route::resource('unit-organisasi', UnitOrganisasiController::class);
});

// Admin PAC & PC bisa akses (PR dilarang)
Route::middleware(['auth', 'role:admin_pc,admin_pac'])->group(function () {
});

require __DIR__.'/auth.php';
