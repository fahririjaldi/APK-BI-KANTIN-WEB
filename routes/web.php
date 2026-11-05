<?php

use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Login dan logout
Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// Dashboard admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

// Pengelolaan menu admin
Route::get('/admin/menu', [MenuController::class, 'index'])
    ->name('admin.menu.index');

Route::post('/admin/menu', [MenuController::class, 'store'])
    ->name('admin.menu.store');

Route::put('/admin/menu/{id}', [MenuController::class, 'update'])
    ->name('admin.menu.update');

Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])
    ->name('admin.menu.destroy');

// Halaman menu siswa
Route::get('/siswa/menu', function () {
    $menus = \App\Models\Menu::orderBy('kategori')
        ->orderBy('nama_menu')
        ->get();

    return view('siswa.menu', compact('menus'));
})->name('siswa.menu');

// Halaman testing
Route::get('/tes-halaman', function () {
    return 'BI-KANTIN BERHASIL TAMPIL!';
});

Route::post('/siswa/pesanan', [PesananController::class, 'store'])
    ->name('siswa.pesanan.store');

Route::get('/admin/pesanan', [PesananController::class, 'index'])
    ->name('admin.pesanan.index');