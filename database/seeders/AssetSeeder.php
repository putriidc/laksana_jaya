<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssetSeeder extends Seeder
{
    public function run(): void
    {

        Asset::truncate();
        $dataKas = [
            ['kode_akun' => '111', 'nama_akun' => 'Kas Besar'],
            ['kode_akun' => '112', 'nama_akun' => 'Kas Kecil'],
            ['kode_akun' => '113', 'nama_akun' => 'Kas Bank BCA'],
            ['kode_akun' => '119', 'nama_akun' => 'Kas Flip'],
            ['kode_akun' => '123', 'nama_akun' => 'Kas BJB'],
            ['kode_akun' => '531', 'nama_akun' => 'OVO'],

        ];

        foreach ($dataKas as $item) {
            Asset::create([
                'kode_akun'     => $item['kode_akun'],
                'nama_akun'     => $item['nama_akun'],
                'for_admin'     => $item['for_admin'] ?? false, // default false kalau tidak ada
                'akun_header'   => 'asset_lancar_bank',
                'post_saldo'    => 'DEBET',
                'post_laporan'  => 'NERACA',
                'created_by'    => 'seeder',
            ]);
        }
        $data = [
            ['kode_akun' => '114', 'nama_akun' => 'Piutang Usaha', 'for_admin' => true],
            ['kode_akun' => '115', 'nama_akun' => 'Piutang Proyek'],
            ['kode_akun' => '116', 'nama_akun' => 'Piutang Karyawan'],
            ['kode_akun' => '117', 'nama_akun' => 'Persediaan Material', 'for_admin' => true],
            ['kode_akun' => '118', 'nama_akun' => 'Uang Muka PPh', 'for_admin' => true],
            ['kode_akun' => '120', 'nama_akun' => 'Piutang Pihak Lain', 'for_admin' => true],
            ['kode_akun' => '121', 'nama_akun' => 'Piutang Mandor/Tukang'],
            ['kode_akun' => '122', 'nama_akun' => 'Piutang Kontrak'],
            ['kode_akun' => '124', 'nama_akun' => 'Aktiva Lancar'],
        ];

        foreach ($data as $item) {
            Asset::create([
                'kode_akun'     => $item['kode_akun'],
                'nama_akun'     => $item['nama_akun'],
                'for_admin'     => $item['for_admin'] ?? false, // default false kalau tidak ada
                'akun_header'   => 'asset_lancar',
                'post_saldo'    => 'DEBET',
                'post_laporan'  => 'NERACA',
                'created_by'    => 'seeder',
            ]);
        }

        $dataTetap = [
            ['kode_akun' => '1231', 'nama_akun' => 'Tanah'],
            ['kode_akun' => '1232', 'nama_akun' => 'Bangunan'],
            ['kode_akun' => '1233', 'nama_akun' => 'Peralatan Kantor'],
            ['kode_akun' => '1234', 'nama_akun' => 'Peralatan WorkShop Interior'],
            ['kode_akun' => '1235', 'nama_akun' => 'Kendaraan Operasional'],
            ['kode_akun' => '1236', 'nama_akun' => 'Akum. Peny. Bangunan'],
            ['kode_akun' => '1237', 'nama_akun' => 'Akum. Peny. Peralatan Kantor'],
            ['kode_akun' => '1238', 'nama_akun' => 'Akum. Peny. Mesin & Peralatan Pompa'],
            ['kode_akun' => '1239', 'nama_akun' => 'Akum. Peny. Kendaraan Operasional'],
        ];

        foreach ($dataTetap as $item) {
            Asset::create([
                'kode_akun'     => $item['kode_akun'],
                'nama_akun'     => $item['nama_akun'],
                'for_admin'     => $item['for_admin'] ?? false, // default false kalau tidak ada
                'akun_header'   => 'asset_tetap',
                'post_saldo'    => 'DEBET',
                'post_laporan'  => 'NERACA',
                'created_by'    => 'seeder',
            ]);
        }

        $dataKewajiban = [
            ['kode_akun' => '210', 'nama_akun' => 'Hutang Usaha'],
            ['kode_akun' => '211', 'nama_akun' => 'Hutang Vendor'],
            ['kode_akun' => '212', 'nama_akun' => 'Hutang PPN'],
            ['kode_akun' => '213', 'nama_akun' => 'Uang Muka Proyek'],
            ['kode_akun' => '221', 'nama_akun' => 'Hutang Bank'],
            ['kode_akun' => '222', 'nama_akun' => 'Kewajiban Lancar'],
        ];

        foreach ($dataKewajiban as $item) {
            Asset::create([
                'kode_akun'     => $item['kode_akun'],
                'nama_akun'     => $item['nama_akun'],
                'for_admin'     => $item['for_admin'] ?? false, // default false kalau tidak ada
                'akun_header'   => 'kewajiban',
                'post_saldo'    => 'KREDIT',
                'post_laporan'  => 'NERACA',
                'created_by'    => 'seeder',
            ]);
        }

        $dataEkuitas = [
            ['kode_akun' => '310', 'nama_akun' => 'Modal'],
            ['kode_akun' => '320', 'nama_akun' => 'Laba Ditahan'],
            ['kode_akun' => '330', 'nama_akun' => 'Laba Tahun Berjalan'],
        ];

        foreach ($dataEkuitas as $item) {
            Asset::create([
                'kode_akun'     => $item['kode_akun'],
                'nama_akun'     => $item['nama_akun'],
                'for_admin'     => $item['for_admin'] ?? false, // default false kalau tidak ada
                'akun_header'   => 'ekuitas',
                'post_saldo'    => 'KREDIT',
                'post_laporan'  => 'NERACA',
                'created_by'    => 'seeder',
            ]);
        }

        $dataPendapatan = [
            ['kode_akun' => '410', 'nama_akun' => 'Pendapatan Proyek Fisik'],
            ['kode_akun' => '420', 'nama_akun' => 'Pendapatan Konsultan'],
            ['kode_akun' => '430', 'nama_akun' => 'Pendapatan Online'],
            ['kode_akun' => '440', 'nama_akun' => 'Pendapatan AR4N Bangunan'],
            ['kode_akun' => '450', 'nama_akun' => 'Pendapatan Lain-Lain'],
            ['kode_akun' => '451', 'nama_akun' => 'Pendapatan PBG'],
            ['kode_akun' => '452', 'nama_akun' => 'Pendapatan Mining'],
        ];

        foreach ($dataPendapatan as $item) {
            Asset::create([
                'kode_akun'     => $item['kode_akun'],
                'nama_akun'     => $item['nama_akun'],
                'for_admin'     => $item['for_admin'] ?? false, // default false kalau tidak ada
                'akun_header'   => 'pendapatan',
                'post_saldo'    => 'KREDIT',
                'post_laporan'  => 'LABA RUGI',
                'created_by'    => 'seeder',
            ]);
        }

        $dataHppProyek = [
            ['kode_akun' => '511', 'nama_akun' => 'Biaya Material, Alat dan Barang'],
            ['kode_akun' => '512', 'nama_akun' => 'Biaya Gaji Tukang & Pengawas Lapangan'],
            ['kode_akun' => '513', 'nama_akun' => 'Biaya Sewa Alat Berat'],
            ['kode_akun' => '514', 'nama_akun' => 'Biaya E-Commerce'],
            ['kode_akun' => '515', 'nama_akun' => 'Biaya Woodcraft'],
            ['kode_akun' => '516', 'nama_akun' => 'Biaya PBG', 'for_admin' => true],
            ['kode_akun' => '517', 'nama_akun' => 'Biaya Iklan dan Promosi', 'for_admin' => true],
            ['kode_akun' => '518', 'nama_akun' => 'Biaya Admin Bank', 'for_admin' => true],
            ['kode_akun' => '519', 'nama_akun' => 'Biaya Transportasi dan Perjalanan Dinas'],
            ['kode_akun' => '520', 'nama_akun' => 'Biaya Listrik, Air, Telpon dan Internet'],
            ['kode_akun' => '521', 'nama_akun' => 'Biaya Infaq dan Sumbangan'],
            ['kode_akun' => '522', 'nama_akun' => 'Biaya Operasional Lainnya'],
            ['kode_akun' => '523', 'nama_akun' => 'Biaya Alat Tulis Kantor'],
            ['kode_akun' => '524', 'nama_akun' => 'Biaya Sewa Gedung Kantor'],
            ['kode_akun' => '525', 'nama_akun' => 'Biaya Gaji Staf Kantor', 'for_admin' => true],
            ['kode_akun' => '526', 'nama_akun' => 'Biaya Konsumsi', 'for_admin' => true],
            ['kode_akun' => '527', 'nama_akun' => 'Biaya Owner', 'for_admin' => true],
            ['kode_akun' => '528', 'nama_akun' => 'Fee Perusahaan', 'for_admin' => true],
            ['kode_akun' => '529', 'nama_akun' => 'Biaya Entertainment', 'for_admin' => true],
            ['kode_akun' => '530', 'nama_akun' => 'Fee Dinas', 'for_admin' => true],
            ['kode_akun' => '532', 'nama_akun' => 'Biaya Reparasi dan Pemeliharaan', 'for_admin' => true],
            ['kode_akun' => '533', 'nama_akun' => 'Biaya Kartu Kredit', 'for_admin' => true],
            ['kode_akun' => '534', 'nama_akun' => 'Biaya Jilid dan Keperluan Product'],
            ['kode_akun' => '535', 'nama_akun' => 'Fee Bendera', 'for_admin' => true],
            ['kode_akun' => '536', 'nama_akun' => 'SKK', 'for_admin' => true],
            ['kode_akun' => '537', 'nama_akun' => 'Pajak'],
            ['kode_akun' => '538', 'nama_akun' => 'Biaya Asuransi'],
            ['kode_akun' => '539', 'nama_akun' => 'Biaya Adm dan Umum Lainnya'],
            ['kode_akun' => '540', 'nama_akun' => 'Beban PPh'],
        ];

        foreach ($dataHppProyek as $item) {
            Asset::create([
                'kode_akun'     => $item['kode_akun'],
                'nama_akun'     => $item['nama_akun'],
                'for_admin'     => $item['for_admin'] ?? false, // default false kalau tidak ada
                'akun_header'   => 'hpp_proyek',
                'post_saldo'    => 'DEBET',
                'post_laporan'  => 'LABA RUGI',
                'created_by'    => 'seeder',
            ]);
        }
    }
}
