<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\HutangVendor;
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

        // GET KAS
        // Ambil daftar kas aktif
        $assets = Asset::active()->where('akun_header', 'asset_lancar_bank')->get();

        $chartLabels = [];
        $seriesData = [];

        // 1. Siapkan rentang 7 hari terakhir
        for ($i = 6; $i >= 0; $i--) {
            $chartLabels[] = now()->subDays($i)->format('Y-m-d');
        }

        // 2. Loop setiap Asset Kas
        foreach ($assets as $account) {
            $dailyBalances = [];

            foreach ($chartLabels as $tanggal) {
                // Gunakan query yang identik dengan Buku Besar
                $transactions = JurnalUmum::whereNull('deleted_at')
                    ->where('nama_perkiraan', $account->nama_akun) // Samakan: pakai NAMA
                    ->where('tanggal', '<=', $tanggal)
                    ->get();

                $saldoBerjalan = 0;
                foreach ($transactions as $trx) {
                    // Gunakan rumus yang identik dengan Buku Besar
                    $saldoBerjalan += $trx->debit;
                    $saldoBerjalan -= $trx->kredit;
                }

                $dailyBalances[] = $saldoBerjalan;
            }

            $seriesData[] = [
                'name' => $account->nama_akun,
                'data' => $dailyBalances
            ];
        }

        // Format label tanggal untuk Chart (Contoh: 25 Jan)
        $formattedLabels = array_map(function($tgl) {
            return date('d M', strtotime($tgl));
        }, $chartLabels);


        //NERACA SALDO
        $now = Carbon::now();
        // default bulan ini
        $startCurr = now()->startOfMonth();
        $endCurr   = now()->endOfMonth();
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

        $queryKas = JurnalUmum::active()->whereIn('nama_perkiraan', $akunKasNames)->whereBetween('tanggal', [$startCurr, $endCurr]);
        $queryLancar = JurnalUmum::active()->whereIn('nama_perkiraan', $akunLancarNames)->whereBetween('tanggal', [$startCurr, $endCurr]);
        $queryKewajiban = JurnalUmum::active()->whereIn('nama_perkiraan', $akunKewajibanNames)->whereBetween('tanggal', [$startCurr, $endCurr]);
        $queryTetap = JurnalUmum::active()->whereIn('nama_perkiraan', $akunTetapNames)->whereBetween('tanggal', [$startCurr, $endCurr]);
        $querylabaDitahan = JurnalUmum::active()->whereIn('nama_perkiraan', $akunlabaDitahanNames)->whereBetween('tanggal', [$startCurr, $endCurr]);
        $queryModal = JurnalUmum::active()->whereIn('nama_perkiraan', $akunModalNames)->whereBetween('tanggal', [$startCurr, $endCurr]);

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

        // HUTANG VENDOR
        $hutangVendors = HutangVendor::active()->with(['supplier', 'proyek'])
            ->whereNull('deleted_at')
            ->whereNull('kode_akun')
            ->get();
        
        // tampilkan nama kas dan isi saldo
        //Dashboard
        $akunKas = Asset::active()->where('akun_header', 'asset_lancar_bank')->where('nama_akun', '!=', 'Kas BJB')->get();
        $akunKasKodes = $akunKas->pluck('kode_akun')->toArray(); // Ambil KODE
        $akunKasNames = $akunKas->pluck('nama_akun')->toArray(); // Ambil NAMA
        $queryKas = JurnalUmum::active()->whereIn('nama_perkiraan', $akunKasNames); // Cari berdasarkan nama
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

        return view('owner.dashboard', compact('cashInGL', 'cashOutGL', 'pendapatanFinal',
            'biayaCurr',
            'kasFinal',
            'hutangVendors',
            'pendapatanCurr',
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
            'totalKas',
            'seriesData',
            'formattedLabels',));
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
