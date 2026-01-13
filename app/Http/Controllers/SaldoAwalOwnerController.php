<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class SaldoAwalOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asset = Asset::active()
            ->where('akun_header', 'asset_lancar_bank')
            ->get();
        return view('owner.saldo_awal.data', compact('asset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bank = Asset::active()
            ->where('akun_header', 'asset_lancar_bank')
            ->where('saldo', 0)
            ->get();
        return view('owner.saldo_awal.index', compact('bank'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_akun' => 'required|string|exists:assets,kode_akun',
            'nominal'   => 'required|numeric|min:0',
        ]);

        // update saldo kas/bank sesuai kode akun
        $asset = Asset::where('kode_akun', $request->kode_akun)->firstOrFail();
        $asset->saldo += $request->nominal;
        $asset->saldo_awal += $request->nominal;
        $asset->save();

        // update saldo Modal
        $modal = Asset::where('nama_akun', 'Modal')->first();
        if ($modal) {
            $modal->saldo += $request->nominal;
            $modal->save();
        }

        return redirect()->route('saldo.index')->with('success', 'Saldo awal berhasil disimpan');
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
