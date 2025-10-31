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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
