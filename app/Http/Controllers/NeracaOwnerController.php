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
        $now = Carbon::now();
        if ($request->filled('start') && $request->filled('end')) {
            $startCurr = Carbon::parse($request->start)->startOfDay(); // 15 Januari 2026 00:00
            $endCurr   = Carbon::parse($request->end)->endOfDay();     // 15 Februari 2026 23:59
        } else {
            // default bulan ini
            $startCurr = now()->startOfMonth();
            $endCurr   = now()->endOfMonth();
        }
        $akunKas = Asset::active()->where('akun_header', 'asset_lancar_bank')->get();
        $akunLancar = Asset::active()->where('akun_header', 'asset_lancar')->get();
        $akunKewajiban  = Asset::active()->where('akun_header', 'kewajiban')->get();
        $akunTetap      = Asset::active()->where('akun_header', 'asset_tetap')->get();
        $akunlabaDitahan      = Asset::active()->where('kode_akun', '320')->get();
        $akunModal      = Asset::active()->where('kode_akun', '310')->get();

        $akunKasNames = $akunKas->pluck('nama_akun')->toArray();
        $akunLancarNames = $akunLancar->pluck('nama_akun')->toArray();
        $akunKewajibanNames = $akunKewajiban->pluck('nama_akun')->toArray();
        $akunTetapNames = $akunTetap->pluck('nama_akun')->toArray();
        $akunlabaDitahanNames = $akunlabaDitahan->pluck('nama_akun')->toArray();
        $akunModalNames = $akunModal->pluck('nama_akun')->toArray();

        $queryKas = JurnalUmum::active()->whereIn('nama_perkiraan', $akunKasNames);
        $queryLancar = JurnalUmum::active()->whereIn('nama_perkiraan', $akunLancarNames);
        $queryKewajiban = JurnalUmum::active()->whereIn('nama_perkiraan', $akunKewajibanNames);
        $queryTetap = JurnalUmum::active()->whereIn('nama_perkiraan', $akunTetapNames);
        $querylabaDitahan = JurnalUmum::active()->whereIn('nama_perkiraan', $akunlabaDitahanNames);
        $queryModal = JurnalUmum::active()->whereIn('nama_perkiraan', $akunModalNames);

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
        // laba di tahan
        $detaillabaDitahan = $querylabaDitahan
            ->select(
                'nama_perkiraan',
                DB::raw('SUM(debit) as total_debit'),
                DB::raw('SUM(kredit) as total_kredit')
            )
            ->groupBy('nama_perkiraan')
            ->get()
            ->keyBy('nama_perkiraan');

        $labaDitahanFinal = collect($akunlabaDitahanNames)->map(fn($akun) => [
            'nama_perkiraan' => $akun,
            'total' => ($detaillabaDitahan[$akun]->total_debit ?? 0) - ($detaillabaDitahan[$akun]->total_kredit ?? 0),
        ]);
        // modal
        $detailModal = $queryModal
            ->select(
                'nama_perkiraan',
                DB::raw('SUM(debit) as total_debit'),
                DB::raw('SUM(kredit) as total_kredit')
            )
            ->groupBy('nama_perkiraan')
            ->get()
            ->keyBy('nama_perkiraan');

        $modalFinal = collect($akunModalNames)->map(fn($akun) => [
            'nama_perkiraan' => $akun,
            'total' => ($detailModal[$akun]->total_debit ?? 0) - ($detailModal[$akun]->total_kredit ?? 0),
        ]);

        $totalKas = $kasFinal->sum('total');
        $totalLancar = $lancarFinal->sum('total');
        $totalKewajiban      = $kewajibanFinal->sum('total');
        $totalTetap     = $tetapFinal->sum('total');
        $totallabaDitahan     = $labaDitahanFinal->sum('total');
        $totalModal     = $modalFinal->sum('total');

        // ambil periode tahun sebelumnya penuh
        // $startPrev = $now->copy()->subMonth()->startOfMonth();
        // $endPrev   = $now->copy()->subMonth()->endOfMonth();


        // // Pendapatan & Biaya bulan sebelumnya
        // $pendapatanPrev = JurnalUmum::active()->whereIn(
        //     'nama_perkiraan',
        //     Asset::active()->where('akun_header', 'pendapatan')->pluck('nama_akun')
        // )->whereBetween('tanggal', [$startPrev, $endPrev])->sum('kredit');

        // $biayaPrev = JurnalUmum::active()->whereIn(
        //     'nama_perkiraan',
        //     Asset::active()->where('akun_header', 'hpp_proyek')->pluck('nama_akun')
        // )->whereBetween('tanggal', [$startPrev, $endPrev])->sum('debit');

        // $labaSebelumnya = $pendapatanPrev - $biayaPrev;

        // Deviden (kewajiban)
        $debitKewajiban = JurnalUmum::active()->whereIn(
            'nama_perkiraan',
            Asset::active()->where('akun_header', 'kewajiban')->pluck('nama_akun')
        )->whereBetween('tanggal', [$startCurr, $endCurr])->sum('debit');

        $kreditKewajiban = JurnalUmum::active()->whereIn(
            'nama_perkiraan',
            Asset::active()->where('akun_header', 'kewajiban')->pluck('nama_akun')
        )->whereBetween('tanggal', [$startCurr, $endCurr])->sum('kredit');

        $deviden = $debitKewajiban - $kreditKewajiban;

        // $saldo_awal = Asset::active()->where('akun_header', 'asset_lancar_bank')->get();
        // $total_saldo_awal = $saldo_awal->sum('saldo_awal');
        // $saldoModal = $total_saldo_awal;

        // $a = $labaSebelumnya - $deviden;
        // // Laba ditahan
        // $labaDitahan = $a;

        // $startYear = $now->copy()->startOfMonth();
        // $endYear   = $now->copy()->endOfMonth();


        // $pendapatanTahunIni = JurnalUmum::active()->whereIn(
        //     'nama_perkiraan',
        //     Asset::active()->where('akun_header', 'pendapatan')->pluck('nama_akun')
        // )->whereBetween('tanggal', [$startYear, $endYear])->sum('kredit');

        // // Biaya tahun ini (debit)
        // $biayaTahunIni = JurnalUmum::active()->whereIn(
        //     'nama_perkiraan',
        //     Asset::active()->where('akun_header', 'hpp_proyek')->pluck('nama_akun')
        // )->whereBetween('tanggal', [$startYear, $endYear])->sum('debit');

        // // Laba tahun berjalan
        // $labaTahunBerjalan = $pendapatanTahunIni - $biayaTahunIni;



        // 🔎 periode bulan sebelumnya → ambil bulan sebelum startCurr
        $startPrev = $startCurr->copy()->subMonth()->startOfMonth();
        $endPrev   = $startCurr->copy()->subMonth()->endOfMonth();

        // Pendapatan & Biaya bulan sebelumnya
        $pendapatanPrev = JurnalUmum::active()
            ->whereIn('nama_perkiraan', Asset::active()->where('akun_header', 'pendapatan')->pluck('nama_akun'))
            ->whereBetween('tanggal', [$startPrev, $endPrev])
            ->sum('kredit');

        $biayaPrev = JurnalUmum::active()
            ->whereIn('nama_perkiraan', Asset::active()->where('akun_header', 'hpp_proyek')->pluck('nama_akun'))
            ->whereBetween('tanggal', [$startPrev, $endPrev])
            ->sum('debit');

        $labaSebelumnya = $pendapatanPrev - $biayaPrev;

        // 🔎 Pendapatan & Biaya periode pencarian (15 Jan – 15 Feb)
        $pendapatanCurr = JurnalUmum::active()
            ->whereIn('nama_perkiraan', Asset::active()->where('akun_header', 'pendapatan')->pluck('nama_akun'))
            ->whereBetween('tanggal', [$startCurr, $endCurr])
            ->sum('kredit');

        $biayaCurr = JurnalUmum::active()
            ->whereIn('nama_perkiraan', Asset::active()->where('akun_header', 'hpp_proyek')->pluck('nama_akun'))
            ->whereBetween('tanggal', [$startCurr, $endCurr])
            ->sum('debit');

        $labaTahunBerjalan = $pendapatanCurr - $biayaCurr;
        $a = $labaSebelumnya - $deviden;
        // Laba ditahan
        // $labaDitahan = $a;
        $labaDitahan = $totallabaDitahan;

        $saldo_awal = Asset::active()->where('akun_header', 'asset_lancar_bank')->get();
        $total_saldo_awal = $saldo_awal->sum('saldo_awal');
        // $saldoModal = $total_saldo_awal;
        $saldoModal = $totalModal;




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

    public function printSaldo(Request $request)
    {
        // 1. Logika Rentang Tanggal
        if ($request->filled('start') && $request->filled('end')) {
            $startCurr = Carbon::parse($request->start)->startOfDay();
            $endCurr   = Carbon::parse($request->end)->endOfDay();
        } else {
            $startCurr = now()->startOfMonth();
            $endCurr   = now()->endOfMonth();
        }

        // 2. Ambil Master Akun & Nama Akun
        $akunKasNames = Asset::active()->where('akun_header', 'asset_lancar_bank')->pluck('nama_akun')->toArray();
        $akunLancarNames = Asset::active()->where('akun_header', 'asset_lancar')->pluck('nama_akun')->toArray();
        $akunKewajibanNames = Asset::active()->where('akun_header', 'kewajiban')->pluck('nama_akun')->toArray();
        $akunTetapNames = Asset::active()->where('akun_header', 'asset_tetap')->pluck('nama_akun')->toArray();
        $akunLabaDitahanNames = Asset::active()->where('kode_akun', '320')->pluck('nama_akun')->toArray();
        $akunModalNames = Asset::active()->where('kode_akun', '310')->pluck('nama_akun')->toArray();

        // 3. Langsung Query Saldo (Tanpa Helper)
        $detailKas = JurnalUmum::active()->whereIn('nama_perkiraan', $akunKasNames)->whereBetween('tanggal', [$startCurr, $endCurr])
            ->select('nama_perkiraan', DB::raw('SUM(debit) as total_debit'), DB::raw('SUM(kredit) as total_kredit'))
            ->groupBy('nama_perkiraan')->get()->keyBy('nama_perkiraan');

        $detailLancar = JurnalUmum::active()->whereIn('nama_perkiraan', $akunLancarNames)->whereBetween('tanggal', [$startCurr, $endCurr])
            ->select('nama_perkiraan', DB::raw('SUM(debit) as total_debit'), DB::raw('SUM(kredit) as total_kredit'))
            ->groupBy('nama_perkiraan')->get()->keyBy('nama_perkiraan');

        $detailKewajiban = JurnalUmum::active()->whereIn('nama_perkiraan', $akunKewajibanNames)->whereBetween('tanggal', [$startCurr, $endCurr])
            ->select('nama_perkiraan', DB::raw('SUM(debit) as total_debit'), DB::raw('SUM(kredit) as total_kredit'))
            ->groupBy('nama_perkiraan')->get()->keyBy('nama_perkiraan');

        $detailTetap = JurnalUmum::active()->whereIn('nama_perkiraan', $akunTetapNames)->whereBetween('tanggal', [$startCurr, $endCurr])
            ->select('nama_perkiraan', DB::raw('SUM(debit) as total_debit'), DB::raw('SUM(kredit) as total_kredit'))
            ->groupBy('nama_perkiraan')->get()->keyBy('nama_perkiraan');

        $detailLabaDitahan = JurnalUmum::active()->whereIn('nama_perkiraan', $akunLabaDitahanNames)->whereBetween('tanggal', [$startCurr, $endCurr])
            ->select('nama_perkiraan', DB::raw('SUM(debit) as total_debit'), DB::raw('SUM(kredit) as total_kredit'))
            ->groupBy('nama_perkiraan')->get()->keyBy('nama_perkiraan');

        $detailModal = JurnalUmum::active()->whereIn('nama_perkiraan', $akunModalNames)->whereBetween('tanggal', [$startCurr, $endCurr])
            ->select('nama_perkiraan', DB::raw('SUM(debit) as total_debit'), DB::raw('SUM(kredit) as total_kredit'))
            ->groupBy('nama_perkiraan')->get()->keyBy('nama_perkiraan');

        // 4. Kalkulasi Data Final untuk View
        $kasFinal = collect($akunKasNames)->map(fn($n) => ['nama' => $n, 'total' => ($detailKas[$n]->total_debit ?? 0) - ($detailKas[$n]->total_kredit ?? 0)]);
        $lancarFinal = collect($akunLancarNames)->map(fn($n) => ['nama' => $n, 'total' => ($detailLancar[$n]->total_debit ?? 0) - ($detailLancar[$n]->total_kredit ?? 0)]);
        $kewajibanFinal = collect($akunKewajibanNames)->map(fn($n) => ['nama' => $n, 'total' => ($detailKewajiban[$n]->total_kredit ?? 0) - ($detailKewajiban[$n]->total_debit ?? 0)]);
        $tetapFinal = collect($akunTetapNames)->map(fn($n) => ['nama' => $n, 'total' => ($detailTetap[$n]->total_debit ?? 0) - ($detailTetap[$n]->total_kredit ?? 0)]);

        // 5. Hitung Laba Rugi Berjalan (Langsung Query)
        $pndptn = JurnalUmum::active()->whereIn('nama_perkiraan', Asset::active()->where('akun_header', 'pendapatan')->pluck('nama_akun'))->whereBetween('tanggal', [$startCurr, $endCurr])->sum('kredit');
        $biaya = JurnalUmum::active()->whereIn('nama_perkiraan', Asset::active()->where('akun_header', 'hpp_proyek')->pluck('nama_akun'))->whereBetween('tanggal', [$startCurr, $endCurr])->sum('debit');
        $labaTahunBerjalan = $pndptn - $biaya;

        // 6. Final Totaling
        $totalAktivaLancar = $kasFinal->sum('total') + $lancarFinal->sum('total');
        $totalAktivaTetap  = $tetapFinal->sum('total');
        $totalKewajiban    = $kewajibanFinal->sum('total');

        $saldoModal = $detailModal->sum(fn($q) => $q->total_kredit - $q->total_debit);
        $saldoLabaDitahan = $detailLabaDitahan->sum(fn($q) => $q->total_kredit - $q->total_debit);
        $totalPasiva = $totalKewajiban + $saldoModal + $saldoLabaDitahan + $labaTahunBerjalan;
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak     = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        // 7. Load PDF
        $data = [
            'periode'           => $startCurr->format('d M Y') . ' - ' . $endCurr->format('d M Y'),
            'kasFinal'          => $kasFinal,
            'lancarFinal'       => $lancarFinal,
            'kewajibanFinal'    => $kewajibanFinal,
            'tetapFinal'        => $tetapFinal,
            'labaTahunBerjalan' => $labaTahunBerjalan,
            'labaDitahan'       => $saldoLabaDitahan,
            'modal'             => $saldoModal,
            'totalAktivaLancar' => $totalAktivaLancar,
            'totalAktivaTetap'  => $totalAktivaTetap,
            'totalKewajiban'    => $totalKewajiban,
            'totalPasiva'       => $totalPasiva,
            'tanggalCetak'      => $tanggalCetak,
            'jamCetak'          => $jamCetak
        ];

        return Pdf::loadView('owner.neraca.printSaldo', $data)->stream('Laporan_Neraca.pdf');
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
