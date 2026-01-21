<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\JurnalUmum;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Master akun pendapatan
        $akunPendapatan = [
            'Pendapatan Proyek Fisik',
            'Pendapatan Konsultan',
            'Pendapatan Mining',
        ];

        // Master akun biaya
        $akunBiaya = [
            'Biaya Material, Alat dan Barang',
            'Biaya Gaji Tukang & Pengawas Lapangan',
            'Biaya Sewa Alat Berat',
            'Biaya Asuransi',
            'Biaya Transportasi dan Perjalanan Dinas',
            'Biaya Listrik, Air, Telp & Internet',
            'Biaya Infaq dan Sumbangan',
            'Biaya Operasional Lainnya',
            'Biaya Alat Tulis Kantor',
            'Biaya Sewa Gedung Kantor',
            'Biaya Gaji Staff Kantor',
            'Biaya Konsumsi',
            'Biaya Adm dan Umum Lainnya',
            'Fee Perusahaan',
            'Beban PPh',
        ];

        // Base query
        $queryPendapatan = JurnalUmum::active()->whereIn('nama_perkiraan', $akunPendapatan);
        $queryBiaya      = JurnalUmum::active()->whereIn('nama_perkiraan', $akunBiaya);

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

        // Cash In Global
        $cashInGL = JurnalUmum::where('debit', '!=', 0)
            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();


        // Cash Out Global
        $cashOutGL = JurnalUmum::where('kredit', '!=', 0)
            ->whereNull('deleted_at')
            ->orderBy('tanggal', 'desc')
            ->get();

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

        // Saldo modal
        $saldoModal = $totalLancar + $totalKas + $totalTetap - $totalKewajiban;

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

        return view('owner.dashboard', compact('cashInGL', 'cashOutGL', 'pendapatanFinal',
            'biayaFinal',
            'totalPendapatan',
            'totalBiaya',
            'totalLabaRugi',
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
            'totalKas',));
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
