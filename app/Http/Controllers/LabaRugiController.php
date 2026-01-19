<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Carbon\Carbon;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LabaRugiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Master akun pendapatan
        $akunPendapatan = Asset::active()->where('akun_header', 'pendapatan')->get();

        // Master akun biaya
        $akunBiaya = Asset::active()->where('akun_header', 'hpp_proyek')->get();
        // Ambil list nama akun untuk filter
        $akunPendapatanNames = $akunPendapatan->pluck('nama_akun')->toArray();
        $akunBiayaNames = $akunBiaya->pluck('nama_akun')->toArray();
        // Base query
        $queryPendapatan = JurnalUmum::active()->whereIn('nama_perkiraan', $akunPendapatan);
        $queryBiaya      = JurnalUmum::active()->whereIn('nama_perkiraan', $akunBiaya);

        // Filter bulan kalau ada request
        if ($request->filled('bulan')) {
            $bulan = Carbon::parse($request->bulan);
            $start = $bulan->copy()->startOfMonth();
            $end   = $bulan->copy()->endOfMonth();

            $queryPendapatan->whereBetween('tanggal', [$start, $end]);
            $queryBiaya->whereBetween('tanggal', [$start, $end]);
        } else {
            $bulan = Carbon::now();
            $start = $bulan->copy()->startOfMonth();
            $end   = $bulan->copy()->endOfMonth();

            $queryPendapatan->whereBetween('tanggal', [$start, $end]);
            $queryBiaya->whereBetween('tanggal', [$start, $end]);
        }

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

        return view('owner.laba-rugi.data', compact(
            'pendapatanFinal',
            'biayaFinal',
            'totalPendapatan',
            'totalBiaya',
            'totalLabaRugi'
        ));
    }
    public function print(Request $request)
    {
        // Master akun pendapatan
        $akunPendapatan = Asset::active()->where('akun_header', 'pendapatan')->get();

        // Master akun biaya
        $akunBiaya = Asset::active()->where('akun_header', 'hpp_proyek')->get();
        $akunPendapatanNames = $akunPendapatan->pluck('nama_akun')->toArray();
        $akunBiayaNames = $akunBiaya->pluck('nama_akun')->toArray();
        // Base query
        $queryPendapatan = JurnalUmum::active()->whereIn('nama_perkiraan', $akunPendapatan);
        $queryBiaya      = JurnalUmum::active()->whereIn('nama_perkiraan', $akunBiaya);

        // Filter bulan kalau ada request
        if ($request->filled('bulan')) {
            $bulan = Carbon::parse($request->bulan);
            $start = $bulan->copy()->startOfMonth();
            $end   = $bulan->copy()->endOfMonth();

            $queryPendapatan->whereBetween('tanggal', [$start, $end]);
            $queryBiaya->whereBetween('tanggal', [$start, $end]);
        } else {
            $bulan = Carbon::now();
            $start = $bulan->copy()->startOfMonth();
            $end   = $bulan->copy()->endOfMonth();

            $queryPendapatan->whereBetween('tanggal', [$start, $end]);
            $queryBiaya->whereBetween('tanggal', [$start, $end]);
        }

        // Query pendapatan → ambil dari kredit
        $detailPendapatan = $queryPendapatan
            ->select('nama_perkiraan', DB::raw('SUM(debit) as total'))
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

        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');

        // Render ke PDF
        $pdf = Pdf::loadView('admin.laba-rugi.print', compact(
            'pendapatanFinal',
            'biayaFinal',
            'totalPendapatan',
            'totalBiaya',
            'totalLabaRugi',
            'bulan',
            'admin',
            'role',
            'tanggalCetak'
        ))->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-laba-rugi-' . $bulan->format('F-Y') . '.pdf');
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
