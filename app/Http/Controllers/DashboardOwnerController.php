<?php

namespace App\Http\Controllers;

use App\Models\JurnalUmum;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Master akun pendapatan
        $akunPendapatan = [
            'Pendapatan Proyek Fisik',
            'Pendapatan Konsultan',
            'Pendapatan Mining',
        ];

        // Master akun biaya
        $akunBiaya = [
            'Biaya Material, Alat dan Barang',
            'Biaya Gaji Tukang & Pengawas Lapangan',
            'Biaya Sewa Alat Berat',
            'Biaya Asuransi',
            'Biaya Transportasi dan Perjalanan Dinas',
            'Biaya Listrik, Air, Telp & Internet',
            'Biaya Infaq dan Sumbangan',
            'Biaya Operasional Lainnya',
            'Biaya Alat Tulis Kantor',
            'Biaya Sewa Gedung Kantor',
            'Biaya Gaji Staff Kantor',
            'Biaya Konsumsi',
            'Biaya Adm dan Umum Lainnya',
            'Fee Perusahaan',
            'Beban PPh',
        ];

        // Base query
        $queryPendapatan = JurnalUmum::active()->whereIn('nama_perkiraan', $akunPendapatan);
        $queryBiaya      = JurnalUmum::active()->whereIn('nama_perkiraan', $akunBiaya);

        // Query pendapatan → ambil dari kredit
        $detailPendapatan = $queryPendapatan
            ->select('nama_perkiraan', DB::raw('SUM(kredit) as total'))
            ->groupBy('nama_perkiraan')
            ->pluck('total', 'nama_perkiraan');

        // Query biaya → ambil dari debit
        $detailBiaya = $queryBiaya
            ->select('nama_perkiraan', DB::raw('SUM(debit) as total'))
            ->groupBy('nama_perkiraan')
            ->pluck('total', 'nama_perkiraan');

        // Gabungkan dengan master list → isi 0 kalau tidak ada
        $pendapatanFinal = collect($akunPendapatan)->map(function ($akun) use ($detailPendapatan) {
            return [
                'nama_perkiraan' => $akun,
                'total' => $detailPendapatan[$akun] ?? 0,
            ];
        });

        $biayaFinal = collect($akunBiaya)->map(function ($akun) use ($detailBiaya) {
            return [
                'nama_perkiraan' => $akun,
                'total' => $detailBiaya[$akun] ?? 0,
            ];
        });

        // Hitung total
        $totalPendapatan = $pendapatanFinal->sum('total');
        $totalBiaya      = $biayaFinal->sum('total');
        $totalLabaRugi   = $totalPendapatan - $totalBiaya;

        // Cash In Global
        $cashInGL = JurnalUmum::where('debit', '!=', 0)
            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();


        // Cash Out Global
        $cashOutGL = JurnalUmum::where('kredit', '!=', 0)
            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('owner.dashboard', compact('cashInGL', 'cashOutGL', 'pendapatanFinal',
            'biayaFinal',
            'totalPendapatan',
            'totalBiaya',
            'totalLabaRugi'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
