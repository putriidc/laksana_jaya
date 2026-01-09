<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EafController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\AccOwnerController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LabaRugiController;
use App\Http\Controllers\AccEafSpvController;
use App\Http\Controllers\SampinganController;
use App\Http\Controllers\JurnalUmumController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\AccEafOwnerController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\barangReturController;
use App\Http\Controllers\JurnalOwnerController;
use App\Http\Controllers\ProyekOwnerController;
use App\Http\Controllers\AccTukangSpvController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\KasbonContentController;
use App\Http\Controllers\LaporanHarianController;
use App\Http\Controllers\PiutangHutangController;
use App\Http\Controllers\TukangContentController;
use App\Http\Controllers\DataPerusahaanController;
use App\Http\Controllers\LaporanHarianOwnerController;
use App\Http\Controllers\pinjamanTukangController;
use App\Http\Controllers\PinjamanContentController;
use App\Http\Controllers\PinjamanKaryawanController;
use App\Http\Controllers\BukuBesarController;
use App\Http\Controllers\HutangVendorController;
use App\Http\Controllers\NeracaOwnerController;
use App\Http\Controllers\ProgresOwnerController;
use App\Http\Controllers\SupplierController;
use App\Models\JurnalUmum;

Route::get('/', function () {
    return view('login');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// Halaman yang butuh login
Route::middleware('auth')->group(function () {
    Route::middleware('role:Super Admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        });
        // ADMIN KEUANGAN
        Route::get('/admin/master-data', [MasterDataController::class, 'index'])->name('master-data.index');

        Route::resource('akun', AssetController::class);

        Route::resource('piutangHutang', PiutangHutangController::class);

        Route::resource('karyawan', KaryawanController::class);

        Route::resource('proyek', ProyekController::class);

        Route::get('jurnalUmums/print', [JurnalUmumController::class, 'print'])->name('jurnalUmums.print');
        Route::resource('jurnalUmums', JurnalUmumController::class)->except(['show']);
        Route::post('jurnalUmums/storeCashIn', [JurnalUmumController::class, 'storeCashIn'])
            ->name('jurnalUmums.storeCashIn');
        Route::post('jurnalUmums/storeDebit', [JurnalUmumController::class, 'storeDebit'])
            ->name('jurnalUmums.storeDebit');
        Route::post('jurnalUmums/storeKredit', [JurnalUmumController::class, 'storeKredit'])
            ->name('jurnalUmums.storeKredit');
        Route::post('jurnalUmums/storeCashOut', [JurnalUmumController::class, 'storeCashOut'])
            ->name('jurnalUmums.storeCashOut');
        Route::post('jurnalUmums/storeBank', [JurnalUmumController::class, 'storeBank'])
            ->name('jurnalUmums.storeBank');
        Route::post('/jurnalUmums/bulk-delete', [JurnalUmumController::class, 'bulkDelete'])
            ->name('jurnalUmums.bulk-delete');
        Route::get('jurnalUmums/print', [JurnalUmumController::class, 'print'])->name('jurnalUmums.print');

        Route::get('laporanHarian/printCashOut', [LaporanHarianController::class, 'printCashOut'])->name('laporanHarian.printCashOut');
        Route::get('laporanHarian/printCashIn', [LaporanHarianController::class, 'printCashIn'])->name('laporanHarian.printCashIn');
        Route::get('laporanHarian/printCashInGlobal', [LaporanHarianController::class, 'printCashInGlobal'])
            ->name('laporanHarian.printCashInGlobal');
        Route::get('laporanHarian/printCashOutGlobal', [LaporanHarianController::class, 'printCashOutGlobal'])
            ->name('laporanHarian.printCashOutGlobal');
        Route::resource('laporanHarian', LaporanHarianController::class);
        Route::put('laporanHarian/{id}', [LaporanHarianController::class, 'update'])->name('laporanHarian.update');

        Route::resource('pinjamanKaryawans', PinjamanKaryawanController::class);
        Route::get('pinjamanKaryawan/print', [PinjamanKaryawanController::class, 'print'])->name('pinjamanKaryawan.print');
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
        Route::get('pinjaman-karyawan/{id}/print', [PinjamanContentController::class, 'print'])
            ->name('pinjaman-karyawan.print');

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

        Route::resource('sampingans', SampinganController::class);
        Route::get('freelance/print', [SampinganController::class, 'print'])->name('freelance.print');

        Route::get('pinjamanTukangs/print', [pinjamanTukangController::class, 'print'])->name('pinjamanTukangs.print');
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
        Route::get('tukangContents/{id}/print', [TukangContentController::class, 'print'])
            ->name('tukangContents.print');

        Route::get('bukubesar/{code}', [BukuBesarController::class, 'index'])
            ->name('bukubesar.index');
        Route::get('bukubesar/{code}/print', [BukuBesarController::class, 'print'])
            ->name('buku-besar.print');
        Route::get('bukubesar_owner/{code}', [BukuBesarController::class, 'index_owner'])
            ->name('bukubesar_owner.index');
        Route::get('bukubesar_owner/{code}/print', [BukuBesarController::class, 'print'])
            ->name('bukubesar_owner.print');

        Route::get('labarugi/print', [LabaRugiController::class, 'print'])->name('labarugi.print');
        Route::resource('labarugi', LabaRugiController::class);

        Route::resource('eaf', EafController::class);
        Route::post('/eaf/{id}/detail', [EafController::class, 'storeDetail'])->name('eaf.storeDetail');
        Route::post('/eaf/{id}/generate', [EafController::class, 'generate'])->name('eaf.generate');

        Route::resource('supplier', SupplierController::class);

        Route::resource('hutang_vendor', HutangVendorController::class);
        // ADMIN KEUANGAN

        // kepala gudang
        route::get('/gudang', function () {
            return view('kepala-gudang.dashboard');
        });

        Route::get('barangs/{id}/printMasuk', [BarangController::class, 'printMasuk'])
            ->name('barangs.printMasuk');
        Route::get('barangs/{id}/printKeluar', [BarangController::class, 'printKeluar'])
            ->name('barangs.printKeluar');
        Route::get('barangs/{id}/printRetur', [BarangController::class, 'printRetur'])
            ->name('barangs.printRetur');
        Route::resource('barangs', BarangController::class);

        Route::resource('accspv', AccTukangSpvController::class);
        Route::post('/pinjaman/{id}/decline', [AccTukangSpvController::class, 'decline'])
            ->name('pinjaman.decline');

        Route::resource('barang-masuk', BarangMasukController::class);
        Route::get('barang-masuk/create/{kode_barang}', [BarangMasukController::class, 'createForBarang'])
            ->name('barang-masuk.create.for-barang');
        Route::resource('barang-keluar', BarangKeluarController::class);
        Route::get('barang-keluar/create/{kode_barang}', [BarangKeluarController::class, 'createForBarang'])
            ->name('barang-keluar.create.for-barang');
        Route::resource('barang-retur', barangReturController::class);
        Route::get('barang-retur/create/{kode_barang}', [barangReturController::class, 'createForBarang'])
            ->name('barang-retur.create.for-barang');

        Route::resource('AccEafSpv', AccEafSpvController::class);
        Route::post('/Acceaf/{id}/decline', [AccEafSpvController::class, 'decline'])
            ->name('Acceaf.decline');
        // kepala gudang

        //kepala proyek
        Route::get('/kepala-proyek', function () {
            return view('kepala-proyek.dashboard');
        });
        Route::resource('perusahaan', PerusahaanController::class);

        Route::resource('data-perusahaan', DataPerusahaanController::class);
        Route::prefix('perusahaan/{kode_perusahaan}')->group(function () {
            Route::get('data-perusahaan/create', [DataPerusahaanController::class, 'create'])->name('data-perusahaan.create');
        });
        Route::post('data-perusahaan/{id}/progres', [DataPerusahaanController::class, 'storeProgres'])
            ->name('data-perusahaan.progres.store');
        Route::put('progres/{id}', [DataPerusahaanController::class, 'updateProgres'])
            ->name('progres.update');
        //kepala proyek

        // owner
        Route::resource('accowner', AccOwnerController::class);

        Route::post('/pinjamanO/{id}/decline', [AccOwnerController::class, 'decline'])
            ->name('pinjaman.decline');
        Route::post('/pinjamanKR/{id}/decline', [AccOwnerController::class, 'declineKR'])
            ->name('pinjaman.decline');
        Route::post('/pinjamanKS/{id}/decline', [AccOwnerController::class, 'declineKS'])
            ->name('pinjaman.decline');
        Route::post('accowner/storePinjam/{id}', [AccOwnerController::class, 'storePinjam'])
            ->name('accowner.storePinjam');
        Route::post('accowner/storeKasbon/{id}', [AccOwnerController::class, 'storeKasbon'])
            ->name('accowner.storeKasbon');
        Route::get('/create-pinjaman/{id}/edit', [AccOwnerController::class, 'edit'])
            ->name('create-pinjaman.edit');
        Route::get('/create-kasbon/{id}/edit', [AccOwnerController::class, 'editKasbon'])
            ->name('create-kasbon.edit');
        Route::get('indexTukang', [AccOwnerController::class, 'indexTukang'])
            ->name('accowner.indexTukang');
        Route::put('/accowner/{id}/updateKasbon', [AccOwnerController::class, 'updateKasbon'])
            ->name('accowner.updateKasbon');

        Route::resource('AccEafOwner', AccEafOwnerController::class);
        Route::post('/AcceafO/{id}/decline', [AccEafOwnerController::class, 'decline'])
            ->name('AcceafO.decline');

        Route::resource('jurnalOwner', JurnalOwnerController::class)->except(['show']);
        Route::post('jurnalOwner/storeCashIn', [JurnalOwnerController::class, 'storeCashIn'])
            ->name('jurnalOwner.storeCashIn');
        Route::post('jurnalOwner/storeCashOut', [JurnalOwnerController::class, 'storeCashOut'])
            ->name('jurnalOwner.storeCashOut');
        Route::post('jurnalOwner/storeDebit', [JurnalOwnerController::class, 'storeDebit'])
            ->name('jurnalOwner.storeDebit');
        Route::post('jurnalOwner/storeKredit', [JurnalOwnerController::class, 'storeKredit'])
            ->name('jurnalOwner.storeKredit');
        Route::post('jurnalOwner/storeBank', [JurnalOwnerController::class, 'storeBank'])
            ->name('jurnalOwner.storeBank');
        Route::post('/jurnalOwner/bulk-delete', [JurnalOwnerController::class, 'bulkDelete'])
            ->name('jurnalOwner.bulk-delete');

        Route::get('/proyekOwner', [ProyekOwnerController::class, 'index'])->name('proyekOwner.index');
        Route::get('/proyekOwner/indexManage', [ProyekOwnerController::class, 'indexManage'])->name('proyekOwner.indexManage');
        Route::get('/proyekOwner/indexResume', [ProyekOwnerController::class, 'indexResume'])->name('proyekOwner.indexResume');
        Route::resource('proyekOwner', ProyekOwnerController::class);
        Route::post('/kontrak/storeKontrak', [ProyekOwnerController::class, 'storeKontrak'])->name('kontrak.storeKontrak');
        Route::put('/kontrak/updateKontrak/{id}', [ProyekOwnerController::class, 'updateKontrak'])->name('kontrak.update');
        Route::post('/proyekOwner/proyekSelesai', [ProyekOwnerController::class, 'ProyekSelesai'])->name('proyekOwner.proyekSelesai');

        Route::get('laporanHarianOwner/printCashOut', [LaporanHarianOwnerController::class, 'printCashOut'])->name('laporanHarianOwner.printCashOut');
        Route::get('laporanHarianOwner/printCashIn', [LaporanHarianOwnerController::class, 'printCashIn'])->name('laporanHarianOwner.printCashIn');
        Route::get('laporanHarianOwner/printCashInGlobal', [LaporanHarianOwnerController::class, 'printCashInGlobal'])
            ->name('laporanHarianOwner.printCashInGlobal');
        Route::get('laporanHarianOwner/printCashOutGlobal', [LaporanHarianOwnerController::class, 'printCashOutGlobal'])
            ->name('laporanHarianOwner.printCashOutGlobal');
        Route::resource('laporanHarianOwner', LaporanHarianOwnerController::class);
        Route::put('laporanHarianOwner/{id}', [LaporanHarianOwnerController::class, 'update'])->name('laporanHarianOwner.update');

        Route::resource('progresOwner', ProgresOwnerController::class);

        Route::resource('neracaOwner', NeracaOwnerController::class);


        Route::get('/owner-dashboard', function () {
            return view('owner.dashboard');
        });
        Route::get('/saldo', function () {
            return view('owner.saldo_awal.index');
        });
        // owner
    });

    Route::middleware('role:Admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        });
        // ADMIN KEUANGAN
        Route::get('/admin/master-data', [MasterDataController::class, 'index'])->name('master-data.index');

        Route::resource('akun', AssetController::class);

        Route::resource('piutangHutang', PiutangHutangController::class);

        Route::resource('karyawan', KaryawanController::class);

        Route::resource('proyek', ProyekController::class);

        Route::get('jurnalUmums/print', [JurnalUmumController::class, 'print'])->name('jurnalUmums.print');
        Route::resource('jurnalUmums', JurnalUmumController::class)->except(['show']);
        Route::post('jurnalUmums/storeCashIn', [JurnalUmumController::class, 'storeCashIn'])
            ->name('jurnalUmums.storeCashIn');
        Route::post('jurnalUmums/storeDebit', [JurnalUmumController::class, 'storeDebit'])
            ->name('jurnalUmums.storeDebit');
        Route::post('jurnalUmums/storeKredit', [JurnalUmumController::class, 'storeKredit'])
            ->name('jurnalUmums.storeKredit');
        Route::post('jurnalUmums/storeCashOut', [JurnalUmumController::class, 'storeCashOut'])
            ->name('jurnalUmums.storeCashOut');
        Route::post('jurnalUmums/storeBank', [JurnalUmumController::class, 'storeBank'])
            ->name('jurnalUmums.storeBank');
        Route::post('/jurnalUmums/bulk-delete', [JurnalUmumController::class, 'bulkDelete'])
            ->name('jurnalUmums.bulk-delete');
        Route::get('jurnalUmums/print', [JurnalUmumController::class, 'print'])->name('jurnalUmums.print');

        Route::get('laporanHarian/printCashOut', [LaporanHarianController::class, 'printCashOut'])->name('laporanHarian.printCashOut');
        Route::get('laporanHarian/printCashIn', [LaporanHarianController::class, 'printCashIn'])->name('laporanHarian.printCashIn');
        Route::get('laporanHarian/printCashInGlobal', [LaporanHarianController::class, 'printCashInGlobal'])
            ->name('laporanHarian.printCashInGlobal');
        Route::get('laporanHarian/printCashOutGlobal', [LaporanHarianController::class, 'printCashOutGlobal'])
            ->name('laporanHarian.printCashOutGlobal');
        Route::resource('laporanHarian', LaporanHarianController::class);
        Route::put('laporanHarian/{id}', [LaporanHarianController::class, 'update'])->name('laporanHarian.update');

        Route::resource('pinjamanKaryawans', PinjamanKaryawanController::class);
        Route::get('pinjamanKaryawan/print', [PinjamanKaryawanController::class, 'print'])->name('pinjamanKaryawan.print');
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
        Route::get('pinjaman-karyawan/{id}/print', [PinjamanContentController::class, 'print'])
            ->name('pinjaman-karyawan.print');

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

        Route::resource('sampingans', SampinganController::class);
        Route::get('freelance/print', [SampinganController::class, 'print'])->name('freelance.print');

        Route::get('pinjamanTukangs/print', [pinjamanTukangController::class, 'print'])->name('pinjamanTukangs.print');
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
        Route::get('tukangContents/{id}/print', [TukangContentController::class, 'print'])
            ->name('tukangContents.print');

        Route::get('bukubesar/{code}', [BukuBesarController::class, 'index'])
            ->name('bukubesar.index');
        Route::get('bukubesar/{code}/print', [BukuBesarController::class, 'print'])
            ->name('buku-besar.print');
        Route::get('bukubesar_owner/{code}', [BukuBesarController::class, 'index_owner'])
            ->name('bukubesar_owner.index');
        Route::get('bukubesar_owner/{code}/print', [BukuBesarController::class, 'print'])
            ->name('bukubesar_owner.print');

        Route::get('labarugi/print', [LabaRugiController::class, 'print'])->name('labarugi.print');
        Route::resource('labarugi', LabaRugiController::class);

        Route::resource('eaf', EafController::class);
        Route::post('/eaf/{id}/detail', [EafController::class, 'storeDetail'])->name('eaf.storeDetail');
        Route::post('/eaf/{id}/generate', [EafController::class, 'generate'])->name('eaf.generate');

        Route::resource('supplier', SupplierController::class);

        Route::resource('hutang_vendor', HutangVendorController::class);
        // ADMIN KEUANGAN
    });

    Route::middleware('role:Supervisor')->group(function () {
        // kepala gudang
        route::get('/gudang', function () {
            return view('kepala-gudang.dashboard');
        });

        Route::get('barangs/{id}/printMasuk', [BarangController::class, 'printMasuk'])
            ->name('barangs.printMasuk');
        Route::get('barangs/{id}/printKeluar', [BarangController::class, 'printKeluar'])
            ->name('barangs.printKeluar');
        Route::get('barangs/{id}/printRetur', [BarangController::class, 'printRetur'])
            ->name('barangs.printRetur');
        Route::resource('barangs', BarangController::class);

        Route::resource('accspv', AccTukangSpvController::class);
        Route::post('/pinjaman/{id}/decline', [AccTukangSpvController::class, 'decline'])
            ->name('pinjaman.decline');

        Route::resource('barang-masuk', BarangMasukController::class);
        Route::get('barang-masuk/create/{kode_barang}', [BarangMasukController::class, 'createForBarang'])
            ->name('barang-masuk.create.for-barang');
        Route::resource('barang-keluar', BarangKeluarController::class);
        Route::get('barang-keluar/create/{kode_barang}', [BarangKeluarController::class, 'createForBarang'])
            ->name('barang-keluar.create.for-barang');
        Route::resource('barang-retur', barangReturController::class);
        Route::get('barang-retur/create/{kode_barang}', [barangReturController::class, 'createForBarang'])
            ->name('barang-retur.create.for-barang');

        Route::resource('AccEafSpv', AccEafSpvController::class);
        Route::post('/Acceaf/{id}/decline', [AccEafSpvController::class, 'decline'])
            ->name('Acceaf.decline');
        // kepala gudang
    });

    Route::middleware('role:Owner')->group(function () {
        // owner
        Route::resource('accowner', AccOwnerController::class);

        Route::post('/pinjamanO/{id}/decline', [AccOwnerController::class, 'decline'])
            ->name('pinjaman.decline');
        Route::post('/pinjamanKR/{id}/decline', [AccOwnerController::class, 'declineKR'])
            ->name('pinjaman.decline');
        Route::post('/pinjamanKS/{id}/decline', [AccOwnerController::class, 'declineKS'])
            ->name('pinjaman.decline');
        Route::post('accowner/storePinjam/{id}', [AccOwnerController::class, 'storePinjam'])
            ->name('accowner.storePinjam');
        Route::post('accowner/storeKasbon/{id}', [AccOwnerController::class, 'storeKasbon'])
            ->name('accowner.storeKasbon');
        Route::get('/create-pinjaman/{id}/edit', [AccOwnerController::class, 'edit'])
            ->name('create-pinjaman.edit');
        Route::get('/create-kasbon/{id}/edit', [AccOwnerController::class, 'editKasbon'])
            ->name('create-kasbon.edit');
        Route::get('indexTukang', [AccOwnerController::class, 'indexTukang'])
            ->name('accowner.indexTukang');
        Route::put('/accowner/{id}/updateKasbon', [AccOwnerController::class, 'updateKasbon'])
            ->name('accowner.updateKasbon');

        Route::resource('AccEafOwner', AccEafOwnerController::class);
        Route::post('/AcceafO/{id}/decline', [AccEafOwnerController::class, 'decline'])
            ->name('AcceafO.decline');


        Route::resource('jurnalOwner', JurnalOwnerController::class)->except(['show']);
        Route::post('jurnalOwner/storeCashIn', [JurnalOwnerController::class, 'storeCashIn'])
            ->name('jurnalOwner.storeCashIn');
        Route::post('jurnalOwner/storeCashOut', [JurnalOwnerController::class, 'storeCashOut'])
            ->name('jurnalOwner.storeCashOut');
        Route::post('jurnalOwner/storeDebit', [JurnalOwnerController::class, 'storeDebit'])
            ->name('jurnalOwner.storeDebit');
        Route::post('jurnalOwner/storeKredit', [JurnalOwnerController::class, 'storeKredit'])
            ->name('jurnalOwner.storeKredit');
        Route::post('jurnalOwner/storeBank', [JurnalOwnerController::class, 'storeBank'])
            ->name('jurnalOwner.storeBank');
        Route::post('/jurnalOwner/bulk-delete', [JurnalOwnerController::class, 'bulkDelete'])
            ->name('jurnalOwner.bulk-delete');

        Route::get('/proyekOwner', [ProyekOwnerController::class, 'index'])->name('proyekOwner.index');
        Route::get('/proyekOwner/indexManage', [ProyekOwnerController::class, 'indexManage'])->name('proyekOwner.indexManage');
        Route::get('/proyekOwner/indexResume', [ProyekOwnerController::class, 'indexResume'])->name('proyekOwner.indexResume');
        Route::resource('proyekOwner', ProyekOwnerController::class);
        Route::post('/kontrak/storeKontrak', [ProyekOwnerController::class, 'storeKontrak'])->name('kontrak.storeKontrak');
        Route::put('/kontrak/updateKontrak/{id}', [ProyekOwnerController::class, 'updateKontrak'])->name('kontrak.update');
        Route::post('/proyekOwner/proyekSelesai', [ProyekOwnerController::class, 'ProyekSelesai'])->name('proyekOwner.proyekSelesai');

        Route::get('laporanHarianOwner/printCashOut', [LaporanHarianOwnerController::class, 'printCashOut'])->name('laporanHarianOwner.printCashOut');
        Route::get('laporanHarianOwner/printCashIn', [LaporanHarianOwnerController::class, 'printCashIn'])->name('laporanHarianOwner.printCashIn');
        Route::get('laporanHarianOwner/printCashInGlobal', [LaporanHarianOwnerController::class, 'printCashInGlobal'])
            ->name('laporanHarianOwner.printCashInGlobal');
        Route::get('laporanHarianOwner/printCashOutGlobal', [LaporanHarianOwnerController::class, 'printCashOutGlobal'])
            ->name('laporanHarianOwner.printCashOutGlobal');
        Route::resource('laporanHarianOwner', LaporanHarianOwnerController::class);
        Route::put('laporanHarianOwner/{id}', [LaporanHarianOwnerController::class, 'update'])->name('laporanHarianOwner.update');

        Route::resource('progresOwner', ProgresOwnerController::class);

        Route::resource('neracaOwner', NeracaOwnerController::class);


        Route::get('/owner-dashboard', function () {
            return view('owner.dashboard');
        });
        Route::get('/saldo', function () {
            return view('owner.saldo_awal.index');
        });
        // owner
    });


    Route::middleware('role:Kepala Proyek')->group(function () {
        Route::get('/kepala-proyek', function () {
            return view('kepala-proyek.dashboard');
        });
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
        //kepala proyek
    });
});
