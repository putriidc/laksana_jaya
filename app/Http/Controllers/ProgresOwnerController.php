<?php

namespace App\Http\Controllers;

use App\Models\Progres;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\DataPerusahaan;

class ProgresOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $perusahaan = Perusahaan::findOrFail($id);
        $data = DataPerusahaan::where('kode_perusahaan', $perusahaan->kode_perusahaan)->whereNull('deleted_at')->get();

        // Hitung progres per paket
        $progressTotals = [];
        foreach ($data as $d) {
            $progres = Progres::where('kode_paket', $d->kode_paket)
                ->whereNull('deleted_at')
                ->get();

            $progressTotals[$d->id] = min($progres->sum('persen'), 100);
        }

        return view('owner.data-progres.index', compact('perusahaan', 'data', 'progressTotals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data perusahaan berdasarkan id
        $dataPerusahaan = DataPerusahaan::with('perusahaan')->findOrFail($id);

        // Ambil semua progres yang terkait dengan kode_paket
        $progres = Progres::where('kode_paket', $dataPerusahaan->kode_paket)
            ->whereNull('deleted_at')
            ->orderBy('minggu', 'asc')
            ->get();

        // Hitung total progres (maksimal 100%)
        $totalProgress = $progres->sum('persen');
        if ($totalProgress > 100) {
            $totalProgress = 100;
        }
        return view('owner.data-progres.detail.detail', compact('dataPerusahaan', 'progres', 'totalProgress'));

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
