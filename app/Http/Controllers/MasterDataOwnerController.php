<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Proyek;
use App\Models\Karyawan;
use App\Models\Supplier;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use App\Models\PiutangHutang;

class MasterDataOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lancars = Asset::where('akun_header', 'asset_lancar')
            ->whereNull('deleted_at')->get();
        $banks = Asset::where('akun_header', 'asset_lancar_bank')->whereNull('deleted_at')->get()
        ->map(function ($bank) {
            $debit = JurnalUmum::where('kode_perkiraan', $bank->kode_akun)->sum('debit');
            $kredit = JurnalUmum::where('kode_perkiraan', $bank->kode_akun)->sum('kredit');
            $saldo =  $debit - $kredit;
            $bank->saldo = $saldo;
            return $bank;
        });
        $tetaps = Asset::where('akun_header', 'asset_tetap')
            ->whereNull('deleted_at')->get();
        $kewajibans = Asset::where('akun_header', 'kewajiban')
            ->whereNull('deleted_at')->get();
        $ekuitass = Asset::where('akun_header', 'ekuitas')
            ->whereNull('deleted_at')->get();
        $pendapatans = Asset::where('akun_header', 'pendapatan')
            ->whereNull('deleted_at')->get();
        $hpps = Asset::where('akun_header', 'hpp_proyek')
            ->whereNull('deleted_at')->get();
        $piutangHutangs = PiutangHutang::whereNull('deleted_at')->get();
        $karyawans = Karyawan::whereNull('deleted_at')->get();
        $proyeks = Proyek::whereNull('deleted_at')->get();
        $suppliers = Supplier::whereNull('deleted_at')->get();

        return view('owner.master-data.data', compact(
            'lancars',
            'banks',
            'tetaps',
            'kewajibans',
            'ekuitass',
            'pendapatans',
            'hpps',
            'piutangHutangs',
            'karyawans',
            'proyeks',
            'suppliers'
        ));
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
