<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Models\Menu;

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
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        abort(403);
    }

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

// Pesanan admin
Route::get('/admin/pesanan', [PesananController::class, 'indexAdmin'])
    ->name('admin.pesanan.index');

Route::put('/admin/pesanan/{id}/status', [PesananController::class, 'updateStatus'])
    ->name('admin.pesanan.status');

// Menu siswa
Route::get('/siswa/menu', function () {
    if (!auth()->check() || auth()->user()->role !== 'siswa') {
        abort(403);
    }

    $menus = Menu::orderBy('kategori')
        ->orderBy('nama_menu')
        ->get();

    return view('siswa.menu', compact('menus'));
})->name('siswa.menu');

// Pemesanan siswa
Route::post('/siswa/pesanan', [PesananController::class, 'store'])
    ->name('siswa.pesanan.store');

    Route::get('/siswa/riwayat', [PesananController::class, 'riwayat'])
    ->name('siswa.riwayat');

    Route::get('/admin/pesanan', [PesananController::class, 'indexAdmin'])
    ->name('admin.pesanan.index');

Route::put('/admin/pesanan/{id}/status', [PesananController::class, 'updateStatus'])
    ->name('admin.pesanan.status');
