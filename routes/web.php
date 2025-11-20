<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JurnalUmumController;
use App\Http\Controllers\KasbonContentController;
use App\Http\Controllers\PiutangHutangController;
use App\Http\Controllers\PinjamanContentController;
use App\Http\Controllers\PinjamanKaryawanController;

Route::get('/', function () {
    return view('login');
});
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

// master data
Route::get('/admin/master-data', function () {
    return view('admin.master-data.data');
});


Route::resource('assets', AssetController::class);
Route::resource('piutangHutang', PiutangHutangController::class);
Route::resource('karyawans', KaryawanController::class);
Route::resource('proyeks', ProyekController::class);
Route::resource('jurnalUmums', JurnalUmumController::class);
Route::resource('pinjamanKaryawans', PinjamanKaryawanController::class);
Route::resource('pinjamanContents', PinjamanContentController::class);
Route::resource('kasbonContents', KasbonContentController::class);
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
