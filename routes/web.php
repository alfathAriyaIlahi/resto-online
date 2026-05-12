<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KuponController;
use App\Http\Controllers\Admin\KategoriAdminController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ReservasiAdminController;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $kategoris = Kategori::with('produks')->has('produks')->get();
    return view('welcome', compact('kategoris'));
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');

    Route::post('/pesan', [PesananController::class, 'store'])->name('pesan.store');

    Route::post('/cek-kupon', [KuponController::class, 'cekKupon'])->name('kupon.cek');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('kategori', KategoriAdminController::class);
    Route::resource('produk', ProdukController::class);

    Route::get('/kupon', [KuponController::class, 'index'])->name('kupon.index');
    Route::post('/kupon/store', [KuponController::class, 'store'])->name('kupon.store');
    Route::delete('/kupon/{id}', [KuponController::class, 'destroy'])->name('kupon.destroy');

    Route::get('/reservasi', [ReservasiAdminController::class, 'index'])->name('reservasi.index');
    Route::delete('/reservasi/{id}', [ReservasiAdminController::class, 'destroy'])->name('reservasi.destroy');

    Route::post('/reservasi/store', [PesananController::class, 'store'])->name('reservasi.store');
});

require __DIR__.'/auth.php';
