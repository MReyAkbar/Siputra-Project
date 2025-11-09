<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/katalog/{id}', function ($id) {
    return view('detail-ikan');
});

Route::get('/keranjang', function () {
    return view('keranjang');
});

Route::get('/gudang', function () {
    return view('gudang');
});

Route::get('/gudang/{id}', function ($id) {
    return view('detail-gudang');
});

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::prefix('admin/laporan')->group(function () {
    Route::get('/harian', fn() => view('admin.laporan.index'));
    Route::get('/mingguan', fn() => view('admin.laporan.mingguan'));
    Route::get('/bulanan', fn() => view('admin.laporan.bulanan'));
});

Route::get('/admin/manajemen/gudang', function () {
    return view('admin.manajemen.gudang');
});

Route::get('/admin/manajemen/ikan', function () {
    return view('admin.manajemen.ikan');
});

Route::get('/admin/manajemen/stok', function () {
    return view('admin.manajemen.stok');
});

Route::get('/admin/transaksi/pembelian', function () {
    return view('admin.transaksi.pembelian');
});

Route::get('/admin/transaksi/penjualan', function () {
    return view('admin.transaksi.penjualan');
});

Route::get('/admin/manage-user', function () {
    return view('admin.manage-user');
});

Route::get('/admin/aktivitas', function () {
    return view('admin.aktivitas');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
