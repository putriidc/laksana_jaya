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
