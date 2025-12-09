<?php

use App\Http\Controllers\AccTukangSpvController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\SampinganController;
use App\Http\Controllers\JurnalUmumController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\barangReturController;
use App\Http\Controllers\KasbonContentController;
use App\Http\Controllers\PiutangHutangController;
use App\Http\Controllers\DataPerusahaanController;
use App\Http\Controllers\PinjamanContentController;
use App\Http\Controllers\PinjamanKaryawanController;
use App\Http\Controllers\pinjamanTukangController;
use App\Http\Controllers\TukangContentController;

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
    route::get('/gudang', function () {
        return view('kepala-gudang.dashboard');
    });
    // dasboard

    // data barang
    Route::resource('barangs', BarangController::class);
    // data barang
    Route::resource('accspv', AccTukangSpvController::class);

    // transaksi barang
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::get('barang-masuk/create/{kode_barang}', [BarangMasukController::class, 'createForBarang'])
    ->name('barang-masuk.create.for-barang');

    Route::resource('barang-keluar', BarangKeluarController::class);
    Route::get('barang-keluar/create/{kode_barang}', [BarangKeluarController::class, 'createForBarang'])
    ->name('barang-keluar.create.for-barang');

    Route::resource('barang-retur', barangReturController::class);
    Route::get('barang-retur/create/{kode_barang}', [barangReturController::class, 'createForBarang'])
    ->name('barang-retur.create.for-barang');
    // transaksi barang

    // detail barang
    Route::get('detail-barang', function () {
        return view('kepala-gudang.detail-barang.index');
    });
    Route::get('pinjaman-karyawan', function () {
        return view('kepala-gudang.pinjaman-karyawan.data');
    });
    Route::get('create-pinjaman', function () {
        return view('kepala-gudang.pinjaman-karyawan.create-pinjaman');
    });
    Route::get('pengajuan-eaf', function () {
        return view('kepala-gudang.pengajuan-eaf.data');
    });
    Route::get('create-pengajuan', function () {
        return view('kepala-gudang.pengajuan-eaf.create-pengajuan');
    });
    // kepala gudang

    // admin
    Route::resource('pinjamanTukangs', pinjamanTukangController::class);

    Route::resource('tukangContents', TukangContentController::class);
    Route::get('tukangContents/pinjam/{id}', [TukangContentController::class, 'pinjam'])
        ->name('tukangContents.pinjam');
    Route::get('tukangContents/bayar/{id}', [TukangContentController::class, 'bayar'])
        ->name('tukangContents.bayar');
    Route::get('tukangContents/editBayar/{id}', [TukangContentController::class, 'editBayar'])
        ->name('tukangContents.editBayar');
    Route::delete('tukangContents/destroyBayar/{id}', [TukangContentController::class, 'destroyBayar'])
        ->name('tukangContents.destroyBayar');
    Route::post('tukangContents/storeBayar', [TukangContentController::class, 'storeBayar'])
        ->name('tukangContents.storeBayar');
    Route::put('tukangContents/updateBayar/{id}', [TukangContentController::class, 'updateBayar'])
        ->name('tukangContents.updateBayar');

    Route::get('/pinjaman-tukang', function () {
        return view('admin.pinjaman-tukang.data');
    });
    Route::get('/create-tukang', function () {
        return view('admin.pinjaman-tukang.create');
    });
    Route::get('/detail-pinjaman-tukang', function () {
        return view('admin.pinjaman-tukang.detail.data');
    });
    Route::get('/pengembalian-tukang', function () {
        return view('admin.pinjaman-tukang.detail.create');
    });
    Route::get('/form-eaf', function () {
        return view('admin.form-eaf.form');
    });
    Route::get('/detail-eaf', function () {
        return view('admin.form-eaf.detail');
    });
    Route::get('/laba-rugi', function () {
        return view('admin.laba-rugi.data');
    });
    Route::get('/laporan-harian', function () {
        return view('admin.laporan-harian.data');
    });
    Route::get('/buku-besar', function () {
        return view('admin.buku-besar.data');
    });
    // admin


    //kepala proyek
    Route::resource('perusahaan', PerusahaanController::class);

    Route::resource('data-perusahaan', DataPerusahaanController::class);
    Route::prefix('perusahaan/{kode_perusahaan}')->group(function () {
        Route::get('data-perusahaan/create', [DataPerusahaanController::class, 'create'])->name('data-perusahaan.create');
    });
    Route::post('data-perusahaan/{id}/progres', [DataPerusahaanController::class, 'storeProgres'])
    ->name('data-perusahaan.progres.store');
    Route::put('progres/{id}', [DataPerusahaanController::class, 'updateProgres'])
    ->name('progres.update');



    // Kepala Proyek
    // dasboard
    Route::get('/kepala-proyek', function () {
        return view('kepala-proyek.dashboard');
    });
    // dasboard
    // data proyek
    Route::get('kepala-proyek/data-proyek-gumilang', function () {
        return view('kepala-proyek.data-proyek.cv-ars-gumilang');
    });
    Route::get('kepala-proyek/data-proyek-purnama', function () {
        return view('kepala-proyek.data-proyek.cv-arn-purnama');
    });
    // data proyek

    // form edit data proyek
    Route::get('kepala-proyek/data-proyek/update', function () {
        return view('kepala-proyek.data-proyek.form-edit.form-edit');
    });
    // form edit data proyek

    // form tambah data proyek
    Route::get('kepala-proyek/data-proyek/create', function () {
        return view('kepala-proyek.data-proyek.form-add.form-add');
    });
    // form tambah data proyek

    // detail data proyek
    Route::get('kepala-proyek/data-proyek/detail', function () {
        return view('kepala-proyek.data-proyek.detail.detail');
    });
    // detail data proyek

    // Kepala Proyek

    // owner
    Route::get('/owner-dashboard', function () {
        return view('owner.dashboard');
    });
    Route::get('/owner-pinjaman', function () {
        return view('owner.pinjaman-karyawan.data');
    });
    Route::get('/owner-pinjaman-create', function () {
        return view('owner.pinjaman-karyawan.create');
    });
    // owner
});
