<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\SampinganController;
use App\Http\Controllers\JurnalUmumController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\KasbonContentController;
use App\Http\Controllers\PiutangHutangController;
use App\Http\Controllers\PinjamanContentController;
use App\Http\Controllers\PinjamanKaryawanController;

Route::get('/', function () {
    return view('login');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// Halaman yang butuh login
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('/admin/master-data', [MasterDataController::class, 'index'])->name('master-data.index');


    Route::resource('akun', AssetController::class);

    Route::resource('piutangHutang', PiutangHutangController::class);

    Route::resource('karyawan', KaryawanController::class);

    Route::resource('proyek', ProyekController::class);

    Route::resource('jurnalUmums', JurnalUmumController::class);

    Route::resource('pinjamanKaryawans', PinjamanKaryawanController::class);

    Route::resource('pinjamanContents', PinjamanContentController::class);
    Route::get('pinjamanContents/pinjam/{id}', [PinjamanContentController::class, 'pinjam'])
        ->name('pinjamanContents.pinjam');
    Route::get('pinjamanContents/bayar/{id}', [PinjamanContentController::class, 'bayar'])
        ->name('pinjamanContents.bayar');
    Route::get('pinjamanContents/editBayar/{id}', [PinjamanContentController::class, 'editBayar'])
        ->name('pinjamanContents.editBayar');
    Route::delete('pinjamanContents/destroyBayar/{id}', [PinjamanContentController::class, 'destroyBayar'])
        ->name('pinjamanContents.destroyBayar');
    Route::post('pinjamanContents/storeBayar', [PinjamanContentController::class, 'storeBayar'])
        ->name('pinjamanContents.storeBayar');
    Route::put('pinjamanContents/updateBayar/{id}', [PinjamanContentController::class, 'updateBayar'])
        ->name('pinjamanContents.updateBayar');

    Route::resource('kasbonContents', KasbonContentController::class);
    Route::get('kasbonContents/pinjam/{id}', [KasbonContentController::class, 'pinjam'])
        ->name('kasbonContents.pinjam');
    Route::get('kasbonContents/bayar/{id}', [KasbonContentController::class, 'bayar'])
        ->name('kasbonContents.bayar');
    Route::get('kasbonContents/editBayar/{id}', [KasbonContentController::class, 'editBayar'])
        ->name('kasbonContents.editBayar');
    Route::delete('kasbonContents/destroyBayar/{id}', [KasbonContentController::class, 'destroyBayar'])
        ->name('kasbonContents.destroyBayar');
    Route::post('kasbonContents/storeBayar', [KasbonContentController::class, 'storeBayar'])
        ->name('kasbonContents.storeBayar');
    Route::put('kasbonContents/updateBayar/{id}', [KasbonContentController::class, 'updateBayar'])
        ->name('kasbonContents.updateBayar');

    // freelance
    Route::resource('sampingans', SampinganController::class);
    // freelance



    // kepala gudang
    // dasboard
    route::get('/kepala-gudang/dashboard', function () {
        return view('kepala-gudang.dashboard');
    });
    // dasboard

    // Input data barang
    route::get('/kepala-gudang/input-data-barang', function () {
        return view('kepala-gudang.input-data-barang.index');
    });
    // Input data barang

    // output data barang
    route::get('/kepala-gudang/output-data-barang', function () {
        return view('kepala-gudang.output-data-barang.index');
    });
    // output data barang

    // data barang
    route::get('/kepala-gudang/data-barang', function () {
        return view('kepala-gudang.data-barang.data');
    });
    // data barang

    // transaksi barang
    route::get('/kepala-gudang/transaksi-barang', function () {
        return view('kepala-gudang.transaksi-barang.data');
    });
    // transaksi barang
    // kepala gudang
});
