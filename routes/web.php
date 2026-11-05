
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

// Halaman dan pengelolaan menu admin
Route::get('/admin/menu', [MenuController::class, 'index'])
    ->name('admin.menu.index');

Route::post('/admin/menu', [MenuController::class, 'store'])
    ->name('admin.menu.store');

Route::put('/admin/menu/{id}', [MenuController::class, 'update'])
    ->name('admin.menu.update');

Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])
    ->name('admin.menu.destroy');

Route::get('/siswa/menu', function () {
    return 'Halaman Menu Siswa BI-KANTIN berhasil dibuka!';
});

Route::get('/tes-halaman', function () {
    dd('BI-KANTIN BERHASIL TAMPIL!');
});