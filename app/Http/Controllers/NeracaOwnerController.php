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
    public function index(Request $request)
    {
        // Ambil semua asset
        $assets = Asset::with(['jurnalUmum' => function ($query) {
            $query->select('id', 'kode_perkiraan', 'debit', 'kredit', 'tanggal');
        }])->get();

        // Ambil input tanggal dari request
        $start = $request->filled('start') ? Carbon::parse($request->start)->startOfDay() : null;
        $end   = $request->filled('end')   ? Carbon::parse($request->end)->endOfDay()   : null;

        // Map tiap asset dengan sum debit & kredit dari jurnal umum sesuai periode
        $assets = $assets->map(function ($asset) use ($start, $end) {
            $query = JurnalUmum::where('kode_perkiraan', $asset->kode_akun);

            if ($start && $end) {
                $query->whereBetween('tanggal', [$start, $end]);
            }

            $debitSum  = $query->sum('debit');
            $kreditSum = $query->sum('kredit');

            $asset->debit_total  = $debitSum;
            $asset->kredit_total = $kreditSum;
            return $asset;
        });

        return view('owner.neraca.data', compact('assets', 'start', 'end'));
    }

    public function printLajur(Request $request)
    {
        // Ambil input tanggal dari request
        $start = $request->filled('start') ? Carbon::parse($request->start)->startOfDay() : null;
        $end   = $request->filled('end')   ? Carbon::parse($request->end)->endOfDay()   : null;

        // Ambil semua asset
        $assets = Asset::with(['jurnalUmum' => function ($query) {
            $query->select('id', 'kode_perkiraan', 'debit', 'kredit', 'tanggal');
        }])->get();

        // Map tiap asset dengan sum debit & kredit sesuai periode
        $assets = $assets->map(function ($asset) use ($start, $end) {
            $query = JurnalUmum::where('kode_perkiraan', $asset->kode_akun);

            if ($start && $end) {
                $query->whereBetween('tanggal', [$start, $end]);
            }

            $asset->debit_total  = $query->sum('debit');
            $asset->kredit_total = $query->sum('kredit');

            return $asset;
        });

        $owner        = Auth::user()->name ?? 'Rian';
        $role         = Auth::user()->role ?? 'owner';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak     = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        // Label periode untuk ditampilkan di PDF
        if ($start && $end) {
            $periodeLabel = $start->translatedFormat('d F Y') . ' s/d ' . $end->translatedFormat('d F Y');
        } else {
            $periodeLabel = 'Semua Periode';
        }

        $pdf = Pdf::loadView('owner.neraca.printLajur', compact(
            'assets',
            'owner',
            'role',
            'tanggalCetak',
            'jamCetak',
            'periodeLabel'
        ))->setPaper('A4', 'portrait');

        // Pastikan nama file aman (tanpa karakter / atau \)
        $filename = 'laporan-neraca-lajur-' . preg_replace('/[^A-Za-z0-9\-]/', '-', $periodeLabel) . '.pdf';

        return $pdf->stream($filename);
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
