<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;

class LaporanHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $today = Carbon::now('Asia/Jakarta')->toDateString();

        $cashIn = JurnalUmum::whereDate('tanggal', $today)
            ->where('kredit', '!=', 0)
            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();

        $cashInGL = JurnalUmum::where('kredit', '!=', 0)
            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();

        $cashOut = JurnalUmum::whereDate('tanggal', $today)
            ->where('debit', '!=', 0)
            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();

        $cashOutGL = JurnalUmum::where('debit', '!=', 0)
            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalDebit = $cashOut->sum('debit');
        $totalKredit = $cashIn->sum('kredit');

        $status = $totalDebit === $totalKredit ? 'Balance' : 'Tidak Balance';
        return view('admin.laporan-harian.data', compact('cashIn', 'cashOut', 'cashInGL', 'cashOutGL', 'today', 'totalDebit', 'totalKredit', 'status'));
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'        => 'required|date',
            'keterangan'     => 'required|string|max:255',
            'kode_perkiraan' => 'required|string|max:100',
            'nama_perkiraan' => 'required|string|max:200',
            'debit'          => 'required|numeric|min:0',
            'kredit'         => 'required|numeric|min:0',
        ]);

        $laporan = JurnalUmum::findOrFail($id);
        $laporan->update($request->all());

        return redirect()->route('laporanHarian.index')->with('success', 'Data berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil data jurnal
    $jurnal = JurnalUmum::findOrFail($id);

    // Update kolom deleted_at dengan waktu sekarang (Asia/Jakarta)
    $jurnal->update([
        'deleted_at' => Carbon::now('Asia/Jakarta'),
    ]);

    return redirect()->route('laporanHarian.index')
        ->with('success', 'Data jurnal berhasil dihapus (soft delete)');
    }
}
