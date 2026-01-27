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
use App\Http\Controllers\MasterDataOwnerController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\AccEafOwnerController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\barangReturController;
use App\Http\Controllers\JurnalOwnerController;
use App\Http\Controllers\ProyekOwnerController;
use App\Http\Controllers\AccTukangSpvController;
use App\Http\Controllers\AlatAdminController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\alatDibeliAdminController;
use App\Http\Controllers\AlatDibeliController;
use App\Http\Controllers\AlatDibeliOwnerController;
use App\Http\Controllers\AlatDihapusAdminController;
use App\Http\Controllers\AlatDihapusController;
use App\Http\Controllers\AlatDihapusOwnerController;
use App\Http\Controllers\AlatDikembalikanController;
use App\Http\Controllers\AlatDikembalikanAdminController;
use App\Http\Controllers\AlatDikembalikanOwnerController;
use App\Http\Controllers\AlatDipinjamAdminController;
use App\Http\Controllers\AlatDipinjamController;
use App\Http\Controllers\AlatDipinjamOwnerController;
use App\Http\Controllers\AlatOwnerController;
use App\Http\Controllers\AssetOwnerController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangAdminController;
use App\Http\Controllers\BarangKeluarAdminController;
use App\Http\Controllers\BarangKeluarOwnerController;
use App\Http\Controllers\BarangMasukAdminController;
use App\Http\Controllers\BarangMasukOwnerController;
use App\Http\Controllers\BarangOwnerController;
use App\Http\Controllers\BarangReturAdminController;
use App\Http\Controllers\BarangReturOwnerController;
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
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardOwnerController;
use App\Http\Controllers\HutangVendorController;
use App\Http\Controllers\KaryawanOwnerController;
use App\Http\Controllers\NeracaOwnerController;
use App\Http\Controllers\NotaLangsungController;
use App\Http\Controllers\ProgresOwnerController;
use App\Http\Controllers\ProyekMdOwnerController;
use App\Http\Controllers\SaldoAwalOwnerController;
use App\Http\Controllers\SampinganOwnerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierOwnerController;
use App\Http\Controllers\UserController;
use App\Models\AlatDibeli;
use App\Models\AlatDipinjam;
use App\Models\JurnalUmum;
use App\Models\NotaLangsung;

Route::get('/', function () {
    return view('login');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// Halaman yang butuh login
Route::middleware('auth')->group(function () {
    Route::middleware('role:Super Admin')->group(function () {
       Route::get('/admin-dashboard', [DashboardAdminController::class, 'index'])->name('admin-dashboard', DashboardAdminController::class);
         Route::get('/nota-langsung', function () {
            return view('admin.nota-langsung.data');
        });
        // ADMIN KEUANGAN
        Route::get('/admin/master-data', [MasterDataController::class, 'index'])->name('master-data.index');

        Route::resource('akun', AssetController::class);

        Route::resource('piutangHutang', PiutangHutangController::class);

        Route::resource('karyawan', KaryawanController::class);

        Route::resource('proyek', ProyekController::class);

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

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
        Route::post('jurnalOwner/storeTrans', [JurnalOwnerController::class, 'storeTrans'])
            ->name('jurnalOwner.storeTrans');
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
        Route::get('pinjamanContents/{id}/print', [PinjamanContentController::class, 'printPinjam'])
            ->name('pinjamanContents.printPinjam');
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

        Route::get('hutang_vendor/print', [HutangVendorController::class, 'print'])->name('hutang_vendor.print');
        Route::get('hutang_vendor/printDetail', [HutangVendorController::class, 'printDetail'])->name('hutang_vendor_detail.print');
        Route::resource('hutang_vendor', HutangVendorController::class);
        Route::put('/hutang_vendor/{id}/bayar', [HutangVendorController::class, 'bayar'])->name('hutang-vendor.bayar');
        // ADMIN KEUANGAN

        // kepala gudang
        route::get('/gudang', function () {
            return view('kepala-gudang.dashboard');
        });

        Route::get('barangs/{id}/printMasuk', [BarangController::class, 'printMasuk'])
            ->name('barangs.printMasuk');
        Route::get('print-masuk-detail', [BarangController::class, 'printDetailMasuk'])
            ->name('print-masuk-detail.print');
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


        // Route::get('/owner-dashboard', function () {
        //     return view('owner.dashboard');
        // });

        Route::resource('saldo', SaldoAwalOwnerController::class);
        // owner
    });

    Route::middleware(['role:Admin 1,Admin 2'])->group(function () {
        Route::get('/admin-dashboard', [DashboardAdminController::class, 'index'])->name('admin-dashboard', DashboardAdminController::class);

        Route::get('print-nota-langsung', [NotaLangsungController::class, 'print'])->name('nota-langsung.print');
        Route::get('print-nota-detail', [NotaLangsungController::class, 'printDetail'])->name('nota-detail.print');
        Route::resource('notaLangsung', NotaLangsungController::class);
        // ADMIN KEUANGAN
        Route::get('/admin/master-data', [MasterDataController::class, 'index'])->name('master-data.index');

        Route::resource('akun', AssetController::class);

        Route::resource('piutangHutang', PiutangHutangController::class);

        Route::resource('karyawan', KaryawanController::class);

        Route::resource('proyek', ProyekController::class);

        // data alat dan barang
         Route::get('print-masuk-detail-admin', [BarangAdminController::class, 'printDetailMasuk'])
            ->name('print-masuk-detail-admin.print');
        Route::get('print-keluar-detail-admin', [BarangAdminController::class, 'printDetailKeluar'])
            ->name('print-keluar-detail-admin.print');
        Route::get('print-retur-detail-admin', [BarangAdminController::class, 'printDetailRetur'])
            ->name('print-retur-detail-admin.print');
         Route::get('barangsAdmin/{id}/printMasuk', [BarangAdminController::class, 'printMasuk'])
            ->name('barangsAdmin.printMasuk');
        Route::get('barangsAdmin/{id}/printKeluar', [BarangAdminController::class, 'printKeluar'])
            ->name('barangsAdmin.printKeluar');
        Route::get('barangsAdmin/{id}/printRetur', [BarangAdminController::class, 'printRetur'])
            ->name('barangsAdmin.printRetur');
        Route::get('print-barang-admin', [BarangAdminController::class, 'print'])->name('barang-admin.print');
        Route::resource('barangsAdmin', BarangAdminController::class);
        Route::get('print-beli-detail-admin', [AlatAdminController::class, 'printDetailBeli'])
            ->name('print-beli-detail-admin.print');
        Route::get('print-hapus-detail-admin', [AlatAdminController::class, 'printDetailHapus'])
            ->name('print-hapus-detail-admin.print');
        Route::get('print-pinjam-detail-admin', [AlatAdminController::class, 'printDetailPinjam'])
            ->name('print-pinjam-detail-admin.print');
        Route::get('print-kembali-detail-admin', [AlatAdminController::class, 'printDetailKembali'])
            ->name('print-kembali-detail-admin.print');
        Route::get('alatsAdmin/{id}/printDibeli', [AlatAdminController::class, 'printDibeli'])
            ->name('alatsAdmin.printDibeli');
        Route::get('alatsAdmin/{id}/printDihapus', [AlatAdminController::class, 'printDihapus'])
            ->name('alatsAdmin.printDihapus');
        Route::get('alatsAdmin/{id}/printDipinjam', [AlatAdminController::class, 'printDipinjam'])
            ->name('alatsAdmin.printDipinjam');
        Route::get('alatsAdmin/{id}/printDikembalikan', [AlatAdminController::class, 'printDikembalikan'])
            ->name('alatsAdmin.printDikembalikan');
        Route::resource('barangsAdmin', BarangAdminController::class);
         Route::get('print-alat-admin', [AlatAdminController::class, 'print'])->name('alat-admin.print');
        Route::resource('alatsAdmin', AlatAdminController::class);
        // Transaksi Alat
        Route::resource('alat-beli-admin', AlatDibeliAdminController::class);
        Route::get('alat-beli-admin/create/{kode_alat}', [AlatDibeliAdminController::class, 'createForAlat'])
            ->name('alat-beli-admin.create.for-alat');
        Route::resource('alat-hapus-admin', AlatDihapusAdminController::class);
        Route::get('alat-hapus-admin/create/{kode_alat}', [AlatDihapusAdminController::class, 'createForAlat'])
            ->name('alat-hapus-admin.create.for-alat');
        Route::resource('alat-pinjam-admin', AlatDipinjamAdminController::class);
        Route::get('alat-pinjam-admin/create/{kode_alat}', [AlatDipinjamAdminController::class, 'createForAlat'])
            ->name('alat-pinjam-admin.create.for-alat');
        Route::resource('alat-kembalikan-admin', AlatDikembalikanAdminController::class);
        Route::get('alat-kembalikan-admin/create/{kode_alat}', [AlatDikembalikanAdminController::class, 'createForAlat'])
            ->name('alat-kembalikan-admin.create.for-alat');
        // Transaksi Alat

        // transaksi barang
        Route::resource('barang-masuk-admin', BarangMasukAdminController::class);
        Route::get('barang-masuk-admin/create/{kode_barang}', [BarangMasukAdminController::class, 'createForBarang'])
            ->name('barang-masuk-admin.create.for-barang');

        Route::resource('barang-keluar-admin', BarangKeluarAdminController::class);
        Route::get('barang-keluar-admin/create/{kode_barang}', [BarangKeluarAdminController::class, 'createForBarang'])
            ->name('barang-keluar-admin.create.for-barang');

        Route::resource('barang-retur-admin', BarangReturAdminController::class);
        Route::get('barang-retur-admin/create/{kode_barang}', [BarangReturAdminController::class, 'createForBarang'])
            ->name('barang-retur-admin.create.for-barang');
        // transaksi barang
        // data alat dan barang

        Route::get('printDetail', [JurnalUmumController::class, 'printDetail'])->name('jurnalDetail.print');
        Route::get('printMutasiDetail', [JurnalUmumController::class, 'printMutasiDetail'])->name('jurnalMutasiDetail.print');
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
        Route::get('pinjamanContents/{id}/print', [PinjamanContentController::class, 'printPinjam'])
            ->name('pinjamanContents.printPinjam');
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
        Route::get('bukubesarAdmin/{code}/print', [BukuBesarController::class, 'print_owner'])
            ->name('buku-besar-admin.print');

        Route::get('print-eaf/{id}', [EafController::class, 'print'])->name('eaf.print');
        Route::get('print-eaf-detail/{id}', [EafController::class, 'printDetail'])->name('eaf-detail.print');
        Route::get('print-eaf-detail/{kode}', [EafController::class, 'printDetail'])->name('eaf-detail.print');
        Route::resource('eaf', EafController::class);
        Route::post('/eaf/{id}/detail', [EafController::class, 'storeDetail'])->name('eaf.storeDetail');
        Route::post('/eaf/{id}/generate', [EafController::class, 'generate'])->name('eaf.generate');

        Route::resource('supplier', SupplierController::class);

        Route::get('hutang_vendor/print', [HutangVendorController::class, 'print'])->name('hutang_vendor.print');
        Route::get('hutang_vendor/printDetail', [HutangVendorController::class, 'printDetail'])->name('hutang_vendor_detail.print');
        Route::resource('hutang_vendor', HutangVendorController::class);
        Route::put('/hutang_vendor/{id}/bayar', [HutangVendorController::class, 'bayar'])->name('hutang-vendor.bayar');
        Route::post('/hutang_vendor/{id}/generate', [HutangVendorController::class, 'generate'])
            ->name('hutang-vendor.generate');
        // ADMIN KEUANGAN
    });

    Route::middleware('role:Supervisor')->group(function () {
        // kepala gudang
        route::get('/gudang', function () {
            return view('kepala-gudang.dashboard');
        });
        Route::get('print-masuk-detail-spv', [BarangController::class, 'printDetailMasuk'])
            ->name('print-masuk-detail-spv.print');
        Route::get('print-keluar-detail-spv', [BarangController::class, 'printDetailKeluar'])
            ->name('print-keluar-detail-spv.print');
        Route::get('print-retur-detail-spv', [BarangController::class, 'printDetailRetur'])
            ->name('print-retur-detail-spv.print');
        Route::get('barangs/{id}/printMasuk', [BarangController::class, 'printMasuk'])
            ->name('barangs.printMasuk');
        Route::get('barangs/{id}/printKeluar', [BarangController::class, 'printKeluar'])
            ->name('barangs.printKeluar');
        Route::get('barangs/{id}/printRetur', [BarangController::class, 'printRetur'])
            ->name('barangs.printRetur');
        Route::get('print-barang', [BarangController::class, 'print'])->name('barang.print');
        Route::resource('barangs', BarangController::class);
        Route::get('print-accspv', [AccTukangSpvController::class, 'print'])->name('accspv.print');

        Route::resource('accspv', AccTukangSpvController::class);
        Route::post('/pinjaman/{id}/decline', [AccTukangSpvController::class, 'decline'])
            ->name('pinjaman.decline');

        Route::get('print-beli-detail-spv', [AlatController::class, 'printDetailBeli'])
            ->name('print-beli-detail-spv.print');
        Route::get('print-hapus-detail-spv', [AlatController::class, 'printDetailHapus'])
            ->name('print-hapus-detail-spv.print');
        Route::get('print-pinjam-detail-spv', [AlatController::class, 'printDetailPinjam'])
            ->name('print-pinjam-detail-spv.print');
        Route::get('print-kembali-detail-spv', [AlatController::class, 'printDetailKembali'])
            ->name('print-kembali-detail-spv.print');
        Route::get('alats/{id}/printDibeli', [AlatController::class, 'printDibeli'])
            ->name('alats.printDibeli');
        Route::get('alats/{id}/printDihapus', [AlatController::class, 'printDihapus'])
            ->name('alats.printDihapus');
        Route::get('alats/{id}/printDipinjam', [AlatController::class, 'printDipinjam'])
            ->name('alats.printDipinjam');
        Route::get('alats/{id}/printDikembalikan', [AlatController::class, 'printDikembalikan'])
            ->name('alats.printDikembalikan');

        Route::resource('barangs', BarangController::class);
         Route::get('print-alat', [AlatController::class, 'print'])->name('alat.print');
        Route::resource('alats', AlatController::class);
        // data barang
        Route::resource('accspv', AccTukangSpvController::class);
        Route::post('/pinjaman/{id}/decline', [AccTukangSpvController::class, 'decline'])
            ->name('pinjaman.decline');

        // Transaksi Alat
        Route::resource('alat-beli', AlatDibeliController::class);
        Route::get('alat-beli/create/{kode_alat}', [AlatDibeliController::class, 'createForAlat'])
            ->name('alat-beli.create.for-alat');
        Route::resource('alat-hapus', AlatDihapusController::class);
        Route::get('alat-hapus/create/{kode_alat}', [AlatDihapusController::class, 'createForAlat'])
            ->name('alat-hapus.create.for-alat');
        Route::resource('alat-pinjam', AlatDipinjamController::class);
        Route::get('alat-pinjam/create/{kode_alat}', [AlatDipinjamController::class, 'createForAlat'])
            ->name('alat-pinjam.create.for-alat');
        Route::resource('alat-kembalikan', AlatDikembalikanController::class);
        Route::get('alat-kembalikan/create/{kode_alat}', [AlatDikembalikanController::class, 'createForAlat'])
            ->name('alat-kembalikan.create.for-alat');
        // Transaksi Alat

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
        Route::resource('AccEafSpv', AccEafSpvController::class);
        Route::post('/Acceaf/{id}/decline', [AccEafSpvController::class, 'decline'])
            ->name('Acceaf.decline');
        Route::post('/acc-eaf-spv/update-detail-biaya', [AccEafSpvController::class, 'updateDetailBiaya'])
            ->name('AccEafSpv.updateDetailBiaya');

    });

    Route::middleware('role:Owner')->group(function () {
        // owner
        // Freelance
        Route::resource('sampingansOwner', SampinganOwnerController::class);
        Route::get('freelance-owner/print', [SampinganOwnerController::class, 'print'])->name('freelance-owner.print');
        // Freelance
        // data alat dan barang
        Route::get('print-masuk-detail', [BarangOwnerController::class, 'printDetailMasuk'])
            ->name('print-masuk-detail.print');
        Route::get('print-keluar-detail', [BarangOwnerController::class, 'printDetailKeluar'])
            ->name('print-keluar-detail.print');
        Route::get('print-retur-detail', [BarangOwnerController::class, 'printDetailRetur'])
            ->name('print-retur-detail.print');
         Route::get('barangsOwner/{id}/printMasuk', [BarangOwnerController::class, 'printMasuk'])
            ->name('barangsOwner.printMasuk');
        Route::get('barangsOwner/{id}/printKeluar', [BarangOwnerController::class, 'printKeluar'])
            ->name('barangsOwner.printKeluar');
        Route::get('barangsOwner/{id}/printRetur', [BarangOwnerController::class, 'printRetur'])
            ->name('barangsOwner.printRetur');
        Route::get('print-barang-owner', [BarangOwnerController::class, 'print'])->name('barang-owner.print');
        Route::resource('barangsOwner', BarangOwnerController::class);
        Route::get('print-beli-detail', [AlatOwnerController::class, 'printDetailBeli'])
            ->name('print-beli-detail.print');
        Route::get('print-hapus-detail', [AlatOwnerController::class, 'printDetailHapus'])
            ->name('print-hapus-detail.print');
        Route::get('print-pinjam-detail', [AlatOwnerController::class, 'printDetailPinjam'])
            ->name('print-pinjam-detail.print');
        Route::get('print-kembali-detail', [AlatOwnerController::class, 'printDetailKembali'])
            ->name('print-kembali-detail.print');
        Route::get('alatsOwner/{id}/printDibeli', [AlatOwnerController::class, 'printDibeli'])
            ->name('alatsOwner.printDibeli');
        Route::get('alatsOwner/{id}/printDihapus', [AlatOwnerController::class, 'printDihapus'])
            ->name('alatsOwner.printDihapus');
        Route::get('alatsOwner/{id}/printDipinjam', [AlatOwnerController::class, 'printDipinjam'])
            ->name('alatsOwner.printDipinjam');
        Route::get('alatsOwner/{id}/printDikembalikan', [AlatOwnerController::class, 'printDikembalikan'])
            ->name('alatsOwner.printDikembalikan');
        Route::resource('barangsOwner', BarangOwnerController::class);
         Route::get('print-alat-owner', [AlatOwnerController::class, 'print'])->name('alat-owner.print');
        Route::resource('alatsOwner', AlatOwnerController::class);
        // Transaksi Alat
        Route::resource('alat-beli-owner', AlatDibeliOwnerController::class);
        Route::get('alat-beli-owner/create/{kode_alat}', [AlatDibeliOwnerController::class, 'createForAlat'])
            ->name('alat-beli-owner.create.for-alat');
        Route::resource('alat-hapus-owner', AlatDihapusOwnerController::class);
        Route::get('alat-hapus-owner/create/{kode_alat}', [AlatDihapusOwnerController::class, 'createForAlat'])
            ->name('alat-hapus-owner.create.for-alat');
        Route::resource('alat-pinjam-owner', AlatDipinjamOwnerController::class);
        Route::get('alat-pinjam-owner/create/{kode_alat}', [AlatDipinjamOwnerController::class, 'createForAlat'])
            ->name('alat-pinjam-owner.create.for-alat');
        Route::resource('alat-kembalikan-owner', AlatDikembalikanOwnerController::class);
        Route::get('alat-kembalikan-owner/create/{kode_alat}', [AlatDikembalikanOwnerController::class, 'createForAlat'])
            ->name('alat-kembalikan-owner.create.for-alat');
        // Transaksi Alat

        // transaksi barang
        Route::resource('barang-masuk-owner', BarangMasukOwnerController::class);
        Route::get('barang-masuk-owner/create/{kode_barang}', [BarangMasukOwnerController::class, 'createForBarang'])
            ->name('barang-masuk-owner.create.for-barang');

        Route::resource('barang-keluar-owner', BarangKeluarOwnerController::class);
        Route::get('barang-keluar-owner/create/{kode_barang}', [BarangKeluarOwnerController::class, 'createForBarang'])
            ->name('barang-keluar-owner.create.for-barang');

        Route::resource('barang-retur-owner', BarangReturOwnerController::class);
        Route::get('barang-retur-owner/create/{kode_barang}', [BarangReturOwnerController::class, 'createForBarang'])
            ->name('barang-retur-owner.create.for-barang');
        // transaksi barang
        // data alat dan barang
        // master data
        Route::get('/owner/master-data', [MasterDataOwnerController::class, 'index'])->name('master-data-owner.index');
        Route::resource('akunOwner', AssetOwnerController::class);
        Route::resource('karyawanOwner', KaryawanOwnerController::class);
        Route::resource('proyekMdOwner', ProyekMdOwnerController::class);
        Route::resource('supplierOwner', SupplierOwnerController::class);
        // master data
        // dashboard
        Route::get('/owner-dashboard', [DashboardOwnerController::class, 'index'])->name('owner-dashboard', DashboardOwnerController::class);
        Route::resource('labarugi', LabaRugiController::class);
        // dashboard
        // user management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        // user management
        Route::get('print-pinjaman-owner', [AccOwnerController::class, 'printPinjaman'])->name('accownerPinjaman.print');
        Route::get('print-kasbon-owner', [AccOwnerController::class, 'printKasbon'])->name('accownerKasbon.print');
        Route::get('print-kasbontukang-owner', [AccOwnerController::class, 'printKasbonTukang'])->name('accownerKasbonTukang.print');
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

        Route::get('print-accEafOwner', [AccEafOwnerController::class, 'print'])->name('accEafOwner.print');
        Route::resource('AccEafOwner', AccEafOwnerController::class);
        Route::post('/AcceafO/{id}/decline', [AccEafOwnerController::class, 'decline'])
            ->name('AcceafO.decline');
        Route::post('/acc-eaf-owner/update-detail-biaya', [AccEafOwnerController::class, 'updateDetailBiaya'])
            ->name('AcceafO.updateDetailBiaya');

         Route::get('printMutasiDetailOwner', [JurnalOwnerController::class, 'printMutasiDetail'])->name('jurnalMutasiDetailOwner.print');
        Route::get('print-jurnalOnwner', [JurnalOwnerController::class, 'print'])->name('jurnalOwner.print');
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
        Route::post('jurnalOwner/storeTrans', [JurnalOwnerController::class, 'storeTrans'])
            ->name('jurnalOwner.storeTrans');
        Route::post('/jurnalOwner/bulk-delete', [JurnalOwnerController::class, 'bulkDelete'])
            ->name('jurnalOwner.bulk-delete');

        Route::get('print-resume', [ProyekOwnerController::class, 'print'])->name('resume.print');
        Route::get('print-data-management', [ProyekOwnerController::class, 'printManagement'])->name('dataManagement.print');
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

        Route::get('print-lajur', [NeracaOwnerController::class, 'printLajur'])->name('neracaLajur.print');
        Route::resource('neracaOwner', NeracaOwnerController::class);

        Route::get('labarugi/print', [LabaRugiController::class, 'print'])->name('labarugi.print');
        Route::resource('labarugi', LabaRugiController::class);

        Route::get('bukubesar_owner/{code}', [BukuBesarController::class, 'index_owner'])
            ->name('bukubesar_owner.index');
        Route::get('bukubesar_owner/{code}/print', [BukuBesarController::class, 'print'])
            ->name('bukubesar_owner.print');


        // Route::get('/owner-dashboard', function () {
        //     return view('owner.dashboard');
        // });

        Route::resource('saldo', SaldoAwalOwnerController::class);

        // owner
    });


    Route::middleware('role:Kepala Proyek')->group(function () {
        Route::get('/kepala-proyek', function () {
            return view('kepala-proyek.dashboard');
        });
        Route::get('print-perusahaan/{id}', [PerusahaanController::class, 'print'])->name('perusahaan.print');
        //kepala proyek
        Route::resource('perusahaan', PerusahaanController::class);

        Route::get('print-data-perusahaan/{id}', [DataPerusahaanController::class, 'print'])->name('data-perusahaan.print');

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
