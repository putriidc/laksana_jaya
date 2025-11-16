<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/admin/master-data', function () {
    return view('admin.master-data.data');
});
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