<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\Karyawan;
use App\Models\JurnalUmum;
use App\Models\HutangVendor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $today = Carbon::now('Asia/Jakarta')->toDateString();
        // $excludedAccounts = Asset::active()->whereIn('akun_header', ['asset_tetap', 'kewajiban', 'ekuitas', 'pendapatan'])
        // ->whereNotIn('kode_akun', ['450', '451', '211', '116'])
        // ->pluck('nama_akun');
        // $cashInDaily = JurnalUmum::whereDate('tanggal', $today)
        //     ->selectRaw('HOUR(created_at) as hour, SUM(debit) as total')
        //     ->whereNotIn('nama_perkiraan', $excludedAccounts)
        //     ->where('debit', '!=', 0)
        //     ->where('created_by',  '!=', 'owner')
        //     ->where('created_by', Auth::user()->id)
        //     ->whereNull('deleted_at')
        //     ->groupBy('hour')
        //     ->orderBy('hour')
        //     ->get();

        // $cashOutDaily = JurnalUmum::whereDate('tanggal', $today)
        //     ->selectRaw('HOUR(created_at) as hour, SUM(kredit) as total')
        //     ->where('kredit', '!=', 0)
        //     ->whereNotIn('nama_perkiraan', $excludedAccounts)
        //     ->whereNull('deleted_at')
        //     ->where('created_by',  '!=', 'owner')
        //     ->where('created_by', Auth::user()->id)
        //     ->groupBy('hour')
        //     ->orderBy('hour')
        //     ->get();

        // // Siapkan array 24 jam (0-23) agar grafik tidak kosong
        // $labels = [];
        // $cashIn = array_fill(0, 24, 0);
        // $cashOut = array_fill(0, 24, 0);

        // for ($i = 0; $i < 24; $i++) {
        //     $labels[] = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
        // }

        // foreach ($cashInDaily as $item) {
        //     // Gunakan nama variabel yang akan di-compact: cashIn
        //     $cashIn[$item->hour] = $item->total;
        // }

        // foreach ($cashOutDaily as $item) {
        //     // Gunakan nama variabel yang akan di-compact: cashOut
        //     $cashOut[$item->hour] = $item->total;
        // }


        // Alur Kas dalam 1 Bulan
        // Ambil daftar kas aktif, KECUALI Kas BJB
        // Sesuaikan 'nama_akun' dengan nama yang tepat di database Anda
        $assets = Asset::active()
                    ->where('akun_header', 'asset_lancar_bank')
                    ->where('nama_akun', '!=', 'Kas BJB')
                    ->get();

        $chartLabels = [];
        $seriesData = [];

        // 1. Tentukan tanggal awal dan akhir bulan ini
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $daysInMonth = now()->daysInMonth; // Mendapatkan jumlah hari bulan ini (28, 29, 30, atau 31)

        // 2. Siapkan label tanggal dari tanggal 1 sampai akhir bulan
        for ($i = 0; $i < $daysInMonth; $i++) {
            // Copy agar tidak merubah variabel startOfMonth asli
            $chartLabels[] = $startOfMonth->copy()->addDays($i)->format('Y-m-d');
        }

        // 3. Loop setiap Asset Kas
        foreach ($assets as $account) {
            $dailyBalances = [];

            // Optimasi: Ambil saldo awal SEBELUM bulan ini dimulai (Saldo Carry Over)
            $initialBalance = JurnalUmum::active()
                ->where('kode_perkiraan', $account->kode_akun)
                ->where('tanggal', '<', $chartLabels[0])
                ->get()
                ->reduce(function ($carry, $trx) use ($account) {
                    if ($account->post_saldo == 'DEBET') {
                        return $carry + ($trx->debit - $trx->kredit);
                    }
                    return $carry + ($trx->kredit - $trx->debit);
                }, 0);

            $currentRunningBalance = $initialBalance;

            foreach ($chartLabels as $tanggal) {
                // Ambil transaksi KHUSUS di tanggal tersebut saja agar lebih ringan
                $transactionsDay = JurnalUmum::active()
                    ->where('kode_perkiraan', $account->kode_akun)
                    ->where('tanggal', $tanggal)
                    ->get();

                foreach ($transactionsDay as $trx) {
                    if ($account->post_saldo == 'DEBET') {
                        $currentRunningBalance += ($trx->debit - $trx->kredit);
                    } else {
                        $currentRunningBalance += ($trx->kredit - $trx->debit);
                    }
                }

                // Jika tanggal sudah melewati hari ini, isi null agar garis tidak drop ke nol di masa depan
                if ($tanggal > now()->format('Y-m-d')) {
                    $dailyBalances[] = null;
                } else {
                    $dailyBalances[] = $currentRunningBalance;
                }
            }

            $seriesData[] = [
                'name' => $account->nama_akun,
                'data' => $dailyBalances
            ];
        }

        // Format label untuk Chart (Contoh: 01 Jan, 02 Jan, dst)
        $formattedLabels = array_map(function($tgl) {
            return date('d M', strtotime($tgl));
        }, $chartLabels);

        $karyawans = Karyawan::whereNull('deleted_at')->get();
        $hutangVendors = HutangVendor::active()->with(['supplier', 'proyek'])
            ->whereNull('deleted_at')
            ->whereNull('kode_akun')
            ->get();

        // tampilkan nama kas dan isi saldo
        //Dashboard
        $akunKas = Asset::active()->where('akun_header', 'asset_lancar_bank')->where('nama_akun', '!=', 'Kas BJB')->get();
        $akunKasKodes = $akunKas->pluck('kode_akun')->toArray(); // Ambil KODE
        $akunKasNames = $akunKas->pluck('nama_akun')->toArray(); // Ambil NAMA
        $queryKas = JurnalUmum::active()->whereIn('kode_perkiraan', $akunKasKodes); // Cari berdasarkan KODE
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

        // Biaya pengeluaran Laba Rugi
        $akunBiaya = Asset::active()->where('akun_header', 'hpp_proyek')->get();
        $akunBiayaNames = $akunBiaya->pluck('nama_akun')->toArray();
        $queryBiaya = JurnalUmum::active()->whereIn('nama_perkiraan', $akunBiayaNames);
        $detailBiaya = $queryBiaya
            ->select(
                'nama_perkiraan',
                DB::raw('SUM(debit) as total_debit'),
                DB::raw('SUM(kredit) as total_kredit')
            )
            ->groupBy('nama_perkiraan')
            ->get()
            ->keyBy('nama_perkiraan');
        $biayaFinal = collect($akunBiayaNames)->map(fn($akun) => [
            'nama_perkiraan' => $akun,
            'total' => ($detailBiaya[$akun]->total_debit ?? 0) - ($detailBiaya[$akun]->total_kredit ?? 0),
        ]);
        $totalBiaya = $biayaFinal->sum('total');

        return view('admin.dashboard', compact('seriesData', 'formattedLabels', 'biayaFinal', 'totalBiaya', 'kasFinal', 'karyawans', 'hutangVendors'));
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
