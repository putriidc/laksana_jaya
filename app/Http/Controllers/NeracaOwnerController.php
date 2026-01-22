<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NeracaOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //NERACA LAJUR
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

        //NERACA SALDO
        $akunKas = Asset::active()->where('akun_header', 'asset_lancar_bank')->get();
        $akunLancar = Asset::active()->where('akun_header', 'asset_lancar')->get();
        $akunKewajiban  = Asset::active()->where('akun_header', 'kewajiban')->get();
        $akunTetap      = Asset::active()->where('akun_header', 'asset_tetap')->get();

        $akunKasNames = $akunKas->pluck('nama_akun')->toArray();
        $akunLancarNames = $akunLancar->pluck('nama_akun')->toArray();
        $akunKewajibanNames = $akunKewajiban->pluck('nama_akun')->toArray();
        $akunTetapNames = $akunTetap->pluck('nama_akun')->toArray();

        $queryKas = JurnalUmum::active()->whereIn('nama_perkiraan', $akunKasNames);
        $queryLancar = JurnalUmum::active()->whereIn('nama_perkiraan', $akunLancarNames);
        $queryKewajiban      = JurnalUmum::active()->whereIn('nama_perkiraan', $akunKewajibanNames);
        $queryTetap      = JurnalUmum::active()->whereIn('nama_perkiraan', $akunTetapNames);

        // kas bank
        $detailKas = $queryKas
            ->select(
                'nama_perkiraan',
                DB::raw('SUM(debit) as total_debit'),
                DB::raw('SUM(kredit) as total_kredit')
            )
            ->groupBy('nama_perkiraan')
            ->get()
            ->keyBy('nama_perkiraan');
        $kasFinal = collect($akunKasNames)->map(fn($akun) => [
            'nama_perkiraan' => $akun,
            'total' => ($detailKas[$akun]->total_debit ?? 0) - ($detailKas[$akun]->total_kredit ?? 0),
        ]);
        // Lancar
        $detailLancar = $queryLancar
            ->select(
                'nama_perkiraan',
                DB::raw('SUM(debit) as total_debit'),
                DB::raw('SUM(kredit) as total_kredit')
            )
            ->groupBy('nama_perkiraan')
            ->get()
            ->keyBy('nama_perkiraan');

        $lancarFinal = collect($akunLancarNames)->map(fn($akun) => [
            'nama_perkiraan' => $akun,
            'total' => ($detailLancar[$akun]->total_debit ?? 0) - ($detailLancar[$akun]->total_kredit ?? 0),
        ]);

        // Kewajiban
        $detailKewajiban = $queryKewajiban
            ->select(
                'nama_perkiraan',
                DB::raw('SUM(debit) as total_debit'),
                DB::raw('SUM(kredit) as total_kredit')
            )
            ->groupBy('nama_perkiraan')
            ->get()
            ->keyBy('nama_perkiraan');

        $kewajibanFinal = collect($akunKewajibanNames)->map(fn($akun) => [
            'nama_perkiraan' => $akun,
            'total' => ($detailKewajiban[$akun]->total_debit ?? 0) - ($detailKewajiban[$akun]->total_kredit ?? 0),
        ]);

        // Tetap
        $detailTetap = $queryTetap
            ->select(
                'nama_perkiraan',
                DB::raw('SUM(debit) as total_debit'),
                DB::raw('SUM(kredit) as total_kredit')
            )
            ->groupBy('nama_perkiraan')
            ->get()
            ->keyBy('nama_perkiraan');

        $tetapFinal = collect($akunTetapNames)->map(fn($akun) => [
            'nama_perkiraan' => $akun,
            'total' => ($detailTetap[$akun]->total_debit ?? 0) - ($detailTetap[$akun]->total_kredit ?? 0),
        ]);

        $totalKas = $kasFinal->sum('total');
        $totalLancar = $lancarFinal->sum('total');
        $totalKewajiban      = $kewajibanFinal->sum('total');
        $totalTetap     = $tetapFinal->sum('total');

        $now = Carbon::now();

        // periode bulan sebelumnya (Desember ke belakang)
        $startPrev = JurnalUmum::active()->min('tanggal'); // tanggal transaksi pertama
        $endPrev   = $now->copy()->subMonth()->endOfMonth();


        // periode bulan ini
        $startCurr = $now->copy()->startOfMonth();
        $endCurr   = $now->copy()->endOfMonth();

        // Pendapatan & Biaya bulan sebelumnya
        $pendapatanPrev = JurnalUmum::active()->whereIn(
            'nama_perkiraan',
            Asset::active()->where('akun_header', 'pendapatan')->pluck('nama_akun')
        )->whereBetween('tanggal', [$startPrev, $endPrev])->sum('kredit');

        $biayaPrev = JurnalUmum::active()->whereIn(
            'nama_perkiraan',
            Asset::active()->where('akun_header', 'hpp_proyek')->pluck('nama_akun')
        )->whereBetween('tanggal', [$startPrev, $endPrev])->sum('debit');

        $labaSebelumnya = $pendapatanPrev - $biayaPrev;

        // Pendapatan & Biaya bulan ini
        $pendapatanCurr = JurnalUmum::active()->whereIn(
            'nama_perkiraan',
            Asset::active()->where('akun_header', 'pendapatan')->pluck('nama_akun')
        )->whereBetween('tanggal', [$startCurr, $endCurr])->sum('kredit');

        $biayaCurr = JurnalUmum::active()->whereIn(
            'nama_perkiraan',
            Asset::active()->where('akun_header', 'hpp_proyek')->pluck('nama_akun')
        )->whereBetween('tanggal', [$startCurr, $endCurr])->sum('debit');

        $labaBerjalan = $pendapatanCurr - $biayaCurr;

        // Deviden (kewajiban)
        $debitKewajiban = JurnalUmum::active()->whereIn(
            'nama_perkiraan',
            Asset::active()->where('akun_header', 'kewajiban')->pluck('nama_akun')
        )->sum('debit');

        $kreditKewajiban = JurnalUmum::active()->whereIn(
            'nama_perkiraan',
            Asset::active()->where('akun_header', 'kewajiban')->pluck('nama_akun')
        )->sum('kredit');

        $deviden = $debitKewajiban - $kreditKewajiban;

        $saldo_awal = Asset::active()->where('akun_header', 'asset_lancar_bank')->get();
        $total_saldo_awal = $saldo_awal->sum('saldo_awal');
        // Saldo modal
        $saldoModal = $total_saldo_awal - $totalKewajiban;

        // Laba ditahan
        $labaDitahan = $labaSebelumnya + $labaBerjalan - $deviden;

        // return $labaDitahan;

        // periode tahun ini (1 Januari s/d 31 Desember tahun berjalan)
        $startYear = $now->copy()->startOfYear();
        $endYear   = $now->copy()->endOfYear();

        // Pendapatan tahun ini (kredit)
        $pendapatanTahunIni = JurnalUmum::active()->whereIn(
            'nama_perkiraan',
            Asset::active()->where('akun_header', 'pendapatan')->pluck('nama_akun')
        )->whereBetween('tanggal', [$startYear, $endYear])->sum('kredit');

        // Biaya tahun ini (debit)
        $biayaTahunIni = JurnalUmum::active()->whereIn(
            'nama_perkiraan',
            Asset::active()->where('akun_header', 'hpp_proyek')->pluck('nama_akun')
        )->whereBetween('tanggal', [$startYear, $endYear])->sum('debit');

        // Laba tahun berjalan
        $labaTahunBerjalan = $pendapatanTahunIni - $biayaTahunIni;

        // return $labaTahunBerjalan;


        return view('owner.neraca.data', compact(
            'assets',
            'start',
            'end',
            'lancarFinal',
            'kewajibanFinal',
            'tetapFinal',
            'totalLancar',
            'totalKewajiban',
            'totalTetap',
            'labaDitahan',
            'labaTahunBerjalan',
            'saldoModal',
            'kasFinal',
            'totalKas',
        ));
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
