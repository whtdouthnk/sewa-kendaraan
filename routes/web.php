<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/',[AuthController::class, 'index'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('proses.login');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');


Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard',[DashboardController::class,'admin'])->name('admin.dashboard');
    Route::get('/admin/log_aktivitas',[LogAktivitasController::class,'index'])->name('admin.log_aktivitas');
    Route::get('/admin/user/index',[UserController::class,'index'])->name('admin.user.index');
    Route::get('/admin/user/create',[UserController::class,'create'])->name('admin.user.create');
    Route::post('/admin/user/store',[UserController::class,'store'])->name('admin.user.store');
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/user/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    Route::get('/admin/kategori/index',[KategoriController::class,'index'])->name('admin.kategori.index');
    Route::get('/admin/kategori/create',[KategoriController::class,'create'])->name('admin.kategori.create');
    Route::post('/admin/kategori/store',[KategoriController::class,'store'])->name('admin.kategori.store');
    Route::get('/admin/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('/admin/kategori/update/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/admin/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    Route::get('/admin/kendaraan/index',[KendaraanController::class,'index'])->name('admin.kendaraan.index');
    Route::get('/admin/kendaraan/create',[KendaraanController::class,'create'])->name('admin.kendaraan.create');
    Route::post('/admin/kendaraan/store',[KendaraanController::class,'store'])->name('admin.kendaraan.store');
    Route::get('/admin/kendaraan/edit/{id}',[KendaraanController::class,'edit'])->name('admin.kendaraan.edit');
    Route::put('/admin/kendaraan/update/{id}',[KendaraanController::class,'update'])->name('admin.kendaraan.update');
    Route::delete('/admin/kendaraan/delete/{id}',[KendaraanController::class,'destroy'])->name('admin.kendaraan.destroy');
    Route::get('/transaksi/index', [TransaksiController::class, 'index'])
        ->name('admin.transaksi.index');
    Route::get('/transaksi/{transaksi}', [TransaksiController::class, 'show'])
        ->name('admin.transaksi.show');
    Route::delete('/transaksi/{transaksi}', [TransaksiController::class, 'destroy'])
        ->name('admin.transaksi.destroy');
});


Route::middleware(['auth','role:petugas'])->group(function () {
    Route::get('/petugas/dashboard',[DashboardController::class,'petugas'])
        ->name('petugas.dashboard');
    Route::get('/petugas/transaksi/index',[TransaksiController::class,'index_petugas'])
        ->name('petugas.transaksi.index');
    Route::get('/petugas/transaksi/show/{id}',[TransaksiController::class,'show_petugas'])
        ->name('petugas.transaksi.show');
        Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('petugas.laporan.index');

    Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])
        ->name('petugas.laporan.cetak');
        Route::put('/petugas/transaksi/{id}/status', [TransaksiController::class, 'updateStatus'])
        ->name('petugas.transaksi.updateStatus');
      
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak_petugas'])
    ->name('petugas.transaksi.cetak');
});

Route::middleware(['auth','role:pengguna'])->group(function () {
    Route::get('/pengguna/dashboard',[DashboardController::class,'pengguna'])->name('pengguna.dashboard');
    Route::get('/pengguna/kendaraan/index',[KendaraanController::class,'index_pengguna'])->name('pengguna.kendaraan.index');
    Route::get('/pengguna/transaksi/index',[TransaksiController::class,'index_pengguna'])->name('pengguna.transaksi.index');
    Route::get('/pengguna/transaksi/create/{id}',[TransaksiController::class,'create_pengguna'])->name('pengguna.transaksi.create');
    Route::get('/pengguna/transaksi/show/{id}',[TransaksiController::class,'show_pengguna'])->name('pengguna.transaksi.show');
    Route::post('/pengguna/transaksi/store',[TransaksiController::class,'store_pengguna'])->name('pengguna.transaksi.store');
    Route::put('/transaksi/{id}/batal', [TransaksiController::class, 'batal'])->name('pengguna.transaksi.batal');
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('pengguna.transaksi.cetak');
});