<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\IkanController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ManageCustomerController;
use App\Http\Controllers\Admin\ManageSupplierController;

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

/*
|--------------------------------------------------------------------------
| Admin Dashboard (Admin & Manager)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', App\Http\Middleware\RoleMiddleware::class . ':admin,manager'])
    ->prefix('admin')
    ->group(function () {

    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Laporan
    |--------------------------------------------------------------------------
    */
    Route::prefix('laporan')->group(function () {
        Route::view('/harian', 'admin.laporan.index')->name('admin.laporan.harian');
        Route::view('/mingguan', 'admin.laporan.mingguan')->name('admin.laporan.mingguan');
        Route::view('/bulanan', 'admin.laporan.bulanan')->name('admin.laporan.bulanan');
    });

    /*
    |--------------------------------------------------------------------------
    | Manajemen Ikan (Master Data)
    |--------------------------------------------------------------------------
    */
    Route::prefix('manajemen/ikan')->group(function () {
        Route::get('/data-ikan', [IkanController::class, 'index'])->name('admin.ikan.index');
        Route::get('/tambah', [IkanController::class, 'create'])->name('admin.ikan.create');
        Route::post('/tambah', [IkanController::class, 'store'])->name('admin.ikan.store');
        Route::get('/{id}/edit', [IkanController::class, 'edit'])->name('admin.ikan.edit');
        Route::put('/{id}', [IkanController::class, 'update'])->name('admin.ikan.update');
        Route::delete('/{id}', [IkanController::class, 'destroy'])->name('admin.ikan.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Gudang
    |--------------------------------------------------------------------------
    */
    Route::prefix('manajemen/gudang')->group(function () {
        Route::view('/data-gudang', 'admin.manajemen.gudang.data-gudang')->name('admin.gudang.index');
        Route::view('/{id}/edit-gudang', 'admin.manajemen.gudang.edit-gudang')->name('admin.gudang.edit');
    });

    /*
    |--------------------------------------------------------------------------
    | Stok Gudang
    |--------------------------------------------------------------------------
    */
    Route::view('manajemen/stok/data-stok', 'admin.manajemen.stok.data-stok')->name('admin.stok.index');

    /*
    |--------------------------------------------------------------------------
    | Pengguna
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::prefix('manajemen')->group(function () {
            Route::prefix('pengguna')->group(function () {
                // === CUSTOMER ===
                Route::prefix('manage-customer')->group(function () {
                    Route::get('/', [ManageCustomerController::class, 'index'])->name('manajemen.pengguna.manage-customer.index');
                    Route::get('/create', [ManageCustomerController::class, 'create'])->name('manajemen.pengguna.manage-customer.create');
                    Route::post('/', [ManageCustomerController::class, 'store'])->name('manajemen.pengguna.manage-customer.store');
                    Route::get('/{customer}/edit', [ManageCustomerController::class, 'edit'])->name('manajemen.pengguna.manage-customer.edit');
                    Route::put('/{customer}', [ManageCustomerController::class, 'update'])->name('manajemen.pengguna.manage-customer.update');
                    Route::delete('/{customer}', [ManageCustomerController::class, 'destroy'])->name('manajemen.pengguna.manage-customer.destroy');
                    Route::post('/bulk-delete', [ManageCustomerController::class, 'bulkDelete'])->name('manajemen.pengguna.manage-customer.bulkDelete');
                    Route::get('/export', [ManageCustomerController::class, 'exportCsv'])->name('manajemen.pengguna.manage-customer.export');
                });

                // === SUPPLIER ===
                Route::prefix('manage-supplier')->group(function () {
                    Route::get('/', [ManageSupplierController::class, 'index'])->name('manajemen.pengguna.manage-supplier.index');
                    Route::get('/create', [ManageSupplierController::class, 'create'])->name('manajemen.pengguna.manage-supplier.create');
                    Route::post('/', [ManageSupplierController::class, 'store'])->name('manajemen.pengguna.manage-supplier.store');
                    Route::get('/{supplier}/edit', [ManageSupplierController::class, 'edit'])->name('manajemen.pengguna.manage-supplier.edit');
                    Route::put('/{supplier}', [ManageSupplierController::class, 'update'])->name('manajemen.pengguna.manage-supplier.update');
                    Route::delete('/{supplier}', [ManageSupplierController::class, 'destroy'])->name('manajemen.pengguna.manage-supplier.destroy');
                    Route::post('/bulk-delete', [ManageSupplierController::class, 'bulkDelete'])->name('manajemen.pengguna.manage-supplier.bulkDelete');
                    Route::get('/export', [ManageSupplierController::class, 'exportCsv'])->name('manajemen.pengguna.manage-supplier.export');
                });
            });
        });
    });
    /*
    |--------------------------------------------------------------------------
    | Transaksi Pembelian
    |--------------------------------------------------------------------------
    */
    Route::prefix('transaksi/pembelian')->group(function () {
        Route::view('/index', 'admin.transaksi.pembelian.index')->name('admin.pembelian.index');
        Route::view('/input', 'admin.transaksi.pembelian.input-pembelian')->name('admin.pembelian.create');
    });

    /*
    |--------------------------------------------------------------------------
    | Transaksi Penjualan
    |--------------------------------------------------------------------------
    */
    Route::prefix('transaksi/penjualan')->group(function () {
        Route::view('/index', 'admin.transaksi.penjualan.index')->name('admin.penjualan.index');
        Route::view('/input', 'admin.transaksi.penjualan.input-penjualan')->name('admin.penjualan.create');
    });

    /*
    |--------------------------------------------------------------------------
    | Manage User (Only Manager)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware([App\Http\Middleware\RoleMiddleware::class . ':manager'])->group(function () {

        // === ROLE & ADMIN ===
        Route::prefix('manage-user')->group(function () {
            Route::get('/', [ManageUserController::class, 'index'])->name('admin.manage-user.index');
            Route::get('/{id}/edit', [ManageUserController::class, 'edit'])->name('admin.manage-user.edit');
            Route::put('/{id}', [ManageUserController::class, 'update'])->name('admin.manage-user.update');
            Route::delete('/{id}', [ManageUserController::class, 'destroy'])->name('admin.manage-user.destroy');
            Route::post('/bulk-delete', [ManageUserController::class, 'bulkDelete'])->name('admin.manage-user.bulkDelete');
            Route::get('/export', [ManageUserController::class, 'exportCsv'])->name('admin.manage-user.export');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Activity Logs
    |--------------------------------------------------------------------------
    */
    Route::get('/aktivitas', [ActivityLogController::class, 'index'])->name('admin.aktivitas.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/chatbot', function () {
    return view('chatbot');
})->name('chatbot');

require __DIR__ . '/auth.php';
