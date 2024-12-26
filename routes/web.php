<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\PeminjamanController;

// Guest Route -> halaman login dan register
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::post('/post-login', [AuthController::class, 'login']);
});

// Admin Route -> halaman admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard'); 

    // Rute untuk Kendaraan
    Route::get('/admin/kendaraan', [KendaraanController::class, 'index'])->name('admin.kendaraan'); // Menampilkan daftar kendaraan
    Route::get('/admin/kendaraan/create', [KendaraanController::class, 'create'])->name('admin.kendaraan.create'); // Menampilkan form tambah kendaraan
    Route::post('/admin/kendaraan', [KendaraanController::class, 'store'])->name('admin.kendaraan.store'); // Menyimpan kendaraan baru
    Route::get('/admin/kendaraan/{id}', [KendaraanController::class, 'detail'])->name('admin.kendaraan.detail'); // Menampilkan detail kendaraan
    Route::get('/admin/kendaraan/{id}/edit', [KendaraanController::class, 'edit'])->name('admin.kendaraan.edit'); // Menampilkan form edit kendaraan
    Route::put('/admin/kendaraan/{id}', [KendaraanController::class, 'update'])->name('admin.kendaraan.update'); // Memperbarui kendaraan
    Route::delete('/admin/kendaraan/{id}', [KendaraanController::class, 'delete'])->name('admin.kendaraan.delete'); // Menghapus kendaraan
    
     // Rute untuk Peminjaman
    Route::get('/admin/peminjaman', [PeminjamanController::class, 'index'])->name('admin.peminjaman'); // Menampilkan daftar peminjaman
    Route::get('/admin/peminjaman/create', [PeminjamanController::class, 'create'])->name('admin.peminjaman.create'); // Menampilkan form tambah peminjaman
    Route::post('/admin/peminjaman', [PeminjamanController::class, 'store'])->name('admin.peminjaman.store'); // Menyimpan peminjaman baru
    Route::get('/admin/peminjaman/{id}', [PeminjamanController::class, 'detail'])->name('admin.peminjaman.detail'); // Menampilkan detail peminjaman
    Route::get('/admin/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('admin.peminjaman.edit'); // Menampilkan form edit peminjaman
    Route::put('/admin/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('admin.peminjaman.update'); // Memperbarui peminjaman
    Route::delete('/admin/peminjaman/{id}', [PeminjamanController::class, 'delete'])->name('admin.peminjaman.delete'); // Menghapus peminjaman

    Route::get('/admin-logout', [AuthController::class, 'admin_logout'])->name('admin.logout');
});


// // User Route -> halaman user
// Route::group(['middleware' => 'web'], function () {
//     // Dashboard User
//     Route::get('/user', [UserUserController::class, 'index'])->name('user.dashboard');
//     Route::get('/user-logout', [AuthController::class, 'user_logout'])->name('user.logout');

//     // Detail Produk User
//     Route::get('/user/product/detail/{id}', [UserUserController::class, 'detail_product'])->name('user.detail.product');
//     Route::get('/product/purchase/{productId}/{userId}', [UserUserController::class, 'purchase']);
//     Route::get('/flash-sale/{id}', [FlashsaleController::class, 'detailFlashSale']);

//     // History
//     Route::get('/user/history/{id}', [UserUserController::class, 'history'])->name('user.history');
    
// })->middleware('web');
