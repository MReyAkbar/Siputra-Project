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
})->middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin,manager']);

Route::prefix('admin/laporan')->group(function () {
    Route::get('/harian', fn() => view('admin.laporan.index'));
    Route::get('/mingguan', fn() => view('admin.laporan.mingguan'));
    Route::get('/bulanan', fn() => view('admin.laporan.bulanan'));
});

Route::prefix('admin/manajemen/ikan')->group(function () {
    Route::get('/data-ikan', fn() => view('admin.manajemen.ikan.data-ikan'))->name('admin.ikan.index');
    Route::get('/tambah-ikan', fn() => view('admin.manajemen.ikan.tambah-ikan'))->name('admin.ikan.create');
    Route::get('/{id}/edit-ikan', function ($id) {
        return view('admin.manajemen.ikan.edit-ikan', ['id' => $id]);
    })->name('admin.ikan.edit');
});

Route::prefix('/admin/manajemen/gudang')->group(function () {
    Route::get('/data-gudang', fn() => view('admin.manajemen.gudang.data-gudang'));
    Route::get('/{id}/edit-gudang', function ($id) {
        return view('admin.manajemen.gudang.edit-gudang', ['id' => $id]);
    });
});

Route::get('/admin/manajemen/stok/data-stok', function () {
    return view('admin.manajemen.stok.data-stok');
});

Route::prefix('/admin/transaksi/pembelian')->group(function () {
    Route::get('/index', fn() => view('admin.transaksi.pembelian.index'))->name('admin.pembelian.index');
    Route::get('/input-pembelian', fn() => view('admin.transaksi.pembelian.input-pembelian'))->name('admin.pembelian.create');
});

Route::prefix('/admin/transaksi/penjualan')->group(function () {
    Route::get('/index', fn() => view('admin.transaksi.penjualan.index'))->name('admin.penjualan.index');
    Route::get('/input-penjualan', fn() => view('admin.transaksi.penjualan.input-penjualan'))->name('admin.penjualan.create');
});

// Manage User admin pages (backend + frontend)
// Only managers can access the Manage User pages. Admins can access the admin dashboard
Route::prefix('admin/manage-user')->middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':manager'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\ManageUserController::class, 'index'])->name('admin.manage-user.index');
    Route::get('/{id}/edit', [\App\Http\Controllers\Admin\ManageUserController::class, 'edit'])->name('admin.manage-user.edit');
    Route::put('/{id}', [\App\Http\Controllers\Admin\ManageUserController::class, 'update'])->name('admin.manage-user.update');
    Route::delete('/{id}', [\App\Http\Controllers\Admin\ManageUserController::class, 'destroy'])->name('admin.manage-user.destroy');
    // Bulk actions & export
    Route::post('/bulk-delete', [\App\Http\Controllers\Admin\ManageUserController::class, 'bulkDelete'])->name('admin.manage-user.bulkDelete');
    Route::get('/export', [\App\Http\Controllers\Admin\ManageUserController::class, 'exportCsv'])->name('admin.manage-user.export');
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
