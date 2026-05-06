<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\Admin\KategoriAdminController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ReservasiAdminController; // Ini yang dipakai di Admin
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;

// --- FRONTEND ROUTES (PUBLIK) ---
Route::get('/', function () {
    $kategoris = Kategori::with('produks')->has('produks')->get();
    return view('welcome', compact('kategoris'));
})->name('home');


// --- FRONTEND ROUTES (WAJIB LOGIN) ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ini untuk user yang mau booking (fungsi store)
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
    Route::post('/pesan', [PesananController::class, 'store'])->name('pesan.store');
});


// --- ADMIN ROUTES ---
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('kategori', KategoriAdminController::class);
    Route::resource('produk', ProdukController::class);

    // Pastikan ReservasiAdminController punya fungsi index()
    Route::get('/reservasi', [ReservasiAdminController::class, 'index'])->name('reservasi.index');
    Route::delete('/reservasi/{id}', [ReservasiAdminController::class, 'destroy'])->name('reservasi.destroy');
});

require __DIR__.'/auth.php';
