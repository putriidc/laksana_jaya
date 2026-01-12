<?php

use App\Models\CatatStok;

if (! function_exists('CatatStok')) {
    function CatatStok($kode_alat, $qty, $keterangan, $refrensi = null)
    {
        // Generate kode_barang otomatis
        $lastId = CatatStok::max('id') ?? 0;
        $kodeKartu = 'CSA-00' . ($lastId + 1);

        CatatStok::create([
            'kode_kartu' => $kodeKartu,
            'kode_alat' => $kode_alat,
            'qty' => $qty,
            'keterangan' => $keterangan,
            'tanggal' => now(),
            'refrensi' => $refrensi,
        ]);
    }
}
