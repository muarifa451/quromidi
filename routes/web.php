<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenjualanController;

// Halaman awal (dashboard)
Route::get('/', [DashboardController::class, 'index']);

// Login
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'postlogin']);
Route::get('/logout', [LoginController::class, 'logout']);

// Semua route di bawah ini hanya bisa diakses jika sudah login
Route::middleware(['ceklogin'])->group(function () {
    // Resource routes
    Route::resource('kategori', KategoriController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('pembeli', PembeliController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('pembelian', PembelianController::class);

    // Penjualan tanpa show/edit/update
    Route::resource('penjualan', PenjualanController::class)->except(['show', 'edit', 'update']);

    // ✅ Route khusus untuk detail penjualan (menghindari bentrok dengan 'create')
    Route::get('/penjualan/detail/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');

    // ✅ Route untuk download PDF
    Route::get('/penjualan/pdf', [PenjualanController::class, 'exportPDF'])->name('penjualan.pdf');

    // ✅ API JSON ambil data barang
    Route::get('/api/barang/{id}', [JsonController::class, 'getBarangById']);
});
