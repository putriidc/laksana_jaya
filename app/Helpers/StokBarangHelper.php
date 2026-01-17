<?php

use App\Models\CatatStokBarang;

if (! function_exists('CatatStokBarang')) {
    function CatatStokBarang($kode_barang, $proyek, $pic, $qty, $keterangan, $refrensi = null)
    {
        // Generate kode_barang otomatis
        $lastId = CatatStokBarang::max('id') ?? 0;
        $kodeKartu = 'CSA-00' . ($lastId + 1);

        CatatStokBarang::create([
            'kode_kartu' => $kodeKartu,
            'kode_barang' => $kode_barang,
            'proyek' => $proyek,
            'pic' => $pic,
            'qty' => $qty,
            'keterangan' => $keterangan,
            'tanggal' => now(),
            'refrensi' => $refrensi,
        ]);
    }
}
