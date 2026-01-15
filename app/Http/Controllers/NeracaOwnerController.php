<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class NeracaOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua asset
        $assets = Asset::with(['jurnalUmum' => function ($query) {
            $query->select('id', 'kode_perkiraan', 'debit', 'kredit');
        }])->get(); // Map tiap asset dengan sum debit & kredit dari jurnal umum
        $assets = $assets->map(function ($asset) {
            $debitSum = JurnalUmum::where('kode_perkiraan', $asset->kode_akun)->sum('debit');
            $kreditSum = JurnalUmum::where('kode_perkiraan', $asset->kode_akun)->sum('kredit');
            $asset->debit_total = $debitSum;
            $asset->kredit_total = $kreditSum;
            return $asset;
        });
        return view('owner.neraca.data', compact('assets'));
    }

    public function printLajur()
    {
        $assets = Asset::with(['jurnalUmum' => function ($query) {
            $query->select('id', 'kode_perkiraan', 'debit', 'kredit');
        }])->get(); // Map tiap asset dengan sum debit & kredit dari jurnal umum
        $assets = $assets->map(function ($asset) {
            $debitSum = JurnalUmum::where('kode_perkiraan', $asset->kode_akun)->sum('debit');
            $kreditSum = JurnalUmum::where('kode_perkiraan', $asset->kode_akun)->sum('kredit');
            $asset->debit_total = $debitSum;
            $asset->kredit_total = $kreditSum;
            return $asset;
        });

        $owner = Auth::user()->name ?? 'Rian';
        $role = Auth::user()->role ?? 'owner';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('owner.neraca.printLajur', compact('assets', 'owner', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Pinjaman-Tukang.pdf');
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
