<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\KaryawanController;
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


    Route::resource('akun', AssetController::class);
    Route::resource('piutangHutang', PiutangHutangController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('proyek', ProyekController::class);
    Route::resource('jurnalUmums', JurnalUmumController::class);
    Route::resource('pinjamanKaryawans', PinjamanKaryawanController::class);
    Route::resource('pinjamanContents', PinjamanContentController::class);
    Route::resource('kasbonContents', KasbonContentController::class);


// master data
Route::get('/admin/master-data', [MasterDataController::class, 'index'])->name('master-data.index');
Route::get('/admin/master-data/create-asset', function () {
    return view('admin.master-data.form-add.asset');
});
Route::get('/admin/master-data/create-piutang-hutang', function () {
    return view('admin.master-data.form-add.piutang-hutang');
});
Route::get('/admin/master-data/create-karyawan', function () {
    return view('admin.master-data.form-add.karyawan');
});
Route::get('/admin/master-data/create-proyek', function () {
    return view('admin.master-data.form-add.proyek');
});
// master data

// jurnal umum
Route::get('/admin/jurnal-umum', function () {
    return view('admin.jurnal-umum.data');
});
Route::get('/admin/jurnal-umum/create', function () {
    return view('admin.jurnal-umum.form-add.index');
});
// jurnal umum

// freelance
Route::get('/admin/freelance', function () {
    return view('admin.freelance.data');
});

Route::get('/admin/freelance/create', function () {
    return view('admin.freelance.form-add.index');
});
// freelance

// pinjawan karyawan
Route::get('/admin/pinjawan-karyawan', function () {
    return view('admin.pinjaman-karyawan.data');
});
Route::get('/admin/pinjawan-karyawan/create', function () {
    return view('admin.pinjaman-karyawan.form-add.index');
});
Route::get('/admin/pinjawan-karyawan/detail', function () {
    return view('admin.pinjaman-karyawan.detail.data');
});
Route::get('/admin/pinjawan-karyawan/detail/form-pinjaman', function () {
    return view('admin.pinjaman-karyawan.detail.form-add.pinjaman');
});
Route::get('/admin/pinjawan-karyawan/detail/form-pengembalian-pinjaman', function () {
    return view('admin.pinjaman-karyawan.detail.form-add.pengembalian-pinjaman');
});
Route::get('/admin/pinjawan-karyawan/detail/form-kasbon', function () {
    return view('admin.pinjaman-karyawan.detail.form-add.kasbon');
});
Route::get('/admin/pinjawan-karyawan/detail/form-pengembalian-kasbon', function () {
    return view('admin.pinjaman-karyawan.detail.form-add.pengembalian-kasbon');
});
// pinjawan karyawan


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
