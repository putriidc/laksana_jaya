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
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $excludedAccounts = Asset::active()->whereIn('akun_header', ['asset_tetap', 'kewajiban', 'ekuitas', 'pendapatan'])
        ->whereNotIn('kode_akun', ['450', '451', '211', '116'])
        ->pluck('nama_akun');
        $cashInDaily = JurnalUmum::whereDate('tanggal', $today)
            ->selectRaw('HOUR(created_at) as hour, SUM(debit) as total')
            ->whereNotIn('nama_perkiraan', $excludedAccounts)
            ->where('debit', '!=', 0)
            ->where('created_by',  '!=', 'owner')
            ->where('created_by', Auth::user()->id)
            ->whereNull('deleted_at')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $cashOutDaily = JurnalUmum::whereDate('tanggal', $today)
            ->selectRaw('HOUR(created_at) as hour, SUM(kredit) as total')
            ->where('kredit', '!=', 0)
            ->whereNotIn('nama_perkiraan', $excludedAccounts)
            ->whereNull('deleted_at')
            ->where('created_by',  '!=', 'owner')
            ->where('created_by', Auth::user()->id)
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        // Siapkan array 24 jam (0-23) agar grafik tidak kosong
        $labels = [];
        $cashIn = array_fill(0, 24, 0);
        $cashOut = array_fill(0, 24, 0);

        for ($i = 0; $i < 24; $i++) {
            $labels[] = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
        }

        $karyawans = Karyawan::whereNull('deleted_at')->get();
        $hutangVendors = HutangVendor::active()->with(['supplier', 'proyek'])
            ->whereNull('deleted_at')
            ->whereNull('kode_akun')
            ->get();

        foreach ($cashInDaily as $item) {
            // Gunakan nama variabel yang akan di-compact: cashIn
            $cashIn[$item->hour] = $item->total;
        }

        foreach ($cashOutDaily as $item) {
            // Gunakan nama variabel yang akan di-compact: cashOut
            $cashOut[$item->hour] = $item->total;
        }

        // tampilkan nama kas dan isi saldo
        $akunKas = Asset::active()->where('akun_header', 'asset_lancar_bank')->get();
        $akunKasNames = $akunKas->pluck('nama_akun')->toArray();
        $queryKas = JurnalUmum::active()->whereIn('nama_perkiraan', $akunKasNames);
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

        return view('admin.dashboard', compact('bank', 'kasFinal', 'cashIn', 'cashOut', 'labels', 'karyawans', 'hutangVendors'));
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
