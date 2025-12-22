<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class LaporanHarianOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $today = Carbon::now('Asia/Jakarta')->toDateString();

        $cashIn = JurnalUmum::whereDate('tanggal', $today)

            ->where('debit', '!=', 0)
            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Cash In Global
        $cashInGL = JurnalUmum::where('debit', '!=', 0)
            ->whereNull('deleted_at')

            ->when($request->start_in && $request->end_in, function ($q) use ($request) {
                $q->whereBetween('tanggal', [$request->start_in, $request->end_in]);
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        $cashOut = JurnalUmum::whereDate('tanggal', $today)
            ->where('kredit', '!=', 0)

            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Cash Out Global
        $cashOutGL = JurnalUmum::where('kredit', '!=', 0)
            ->whereNull('deleted_at')

            ->when($request->start_out && $request->end_out, function ($q) use ($request) {
                $q->whereBetween('tanggal', [$request->start_out, $request->end_out]);
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalDebit = $cashOut->sum('kredit');
        $totalKredit = $cashIn->sum('debit');

        $status = $totalDebit === $totalKredit ? 'Balance' : 'Tidak Balance';
        return view('owner.laporan-harian.data', compact('cashIn', 'cashOut', 'cashInGL', 'cashOutGL', 'today', 'totalDebit', 'totalKredit', 'status'));
    }

    public function printCashIn(Request $request)
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $hari = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y'); // → 15 Desember 2025

        $cashIn = JurnalUmum::whereDate('tanggal', $today)
            ->where('kredit', '!=', 0)
            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();

        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');

        $pdf = Pdf::loadView('admin.laporan-harian.printCashIn', compact(
            'cashIn',
            'admin',
            'role',
            'hari',
            'tanggalCetak'
        ))->setPaper('A4', 'portrait');

        return $pdf->stream('Laporan Harian Cash In ' . $hari . '.pdf');
    }
    public function printCashOut(Request $request)
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $hari = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y'); // → 15 Desember 2025

        $cashOut = JurnalUmum::whereDate('tanggal', $today)
            ->where('debit', '!=', 0)
            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();

        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');

        $pdf = Pdf::loadView('owner.laporan-harian.printCashOut', compact(
            'cashOut',
            'admin',
            'role',
            'hari',
            'tanggalCetak'
        ))->setPaper('A4', 'portrait');

        return $pdf->stream('Laporan Harian Cash Out ' . $hari . '.pdf');
    }

    public function printCashInGlobal(Request $request)
    {
        $start = $request->input('start_in');
        $end   = $request->input('end_in');

        $cashInGL = JurnalUmum::where('kredit', '!=', 0)
            ->whereNull('deleted_at')
            ->when($start && $end, fn($q) => $q->whereBetween('tanggal', [$start, $end]))
            ->orderBy('tanggal', 'desc')
            ->get();

        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');

        $pdf = Pdf::loadView('owner.laporan-harian.printCashInGL', compact(
            'cashInGL',
            'admin',
            'role',
            'tanggalCetak',
            'start',
            'end'
        ))->setPaper('A4', 'landscape');

        return $pdf->stream("CashInGlobal_{$start}_{$end}.pdf");
    }

    public function printCashOutGlobal(Request $request)
    {
        $start = $request->input('start_out');
        $end   = $request->input('end_out');

        $cashOutGL = JurnalUmum::where('debit', '!=', 0)
            ->whereNull('deleted_at')
            ->when($start && $end, fn($q) => $q->whereBetween('tanggal', [$start, $end]))
            ->orderBy('tanggal', 'desc')
            ->get();

        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');

        $pdf = Pdf::loadView('owner.laporan-harian.printCashOutGL', compact(
            'cashOutGL',
            'admin',
            'role',
            'tanggalCetak',
            'start',
            'end'
        ))->setPaper('A4', 'landscape');

        return $pdf->stream("CashOutGlobal_{$start}_{$end}.pdf");
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

        return redirect()->route('laporanHarianOwner.index')->with('success', 'Data berhasil diupdate');
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

        return redirect()->route('laporanHarianOwner.index')
            ->with('success', 'Data jurnal berhasil dihapus (soft delete)');
    }
}
