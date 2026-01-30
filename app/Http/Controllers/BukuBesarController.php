<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Carbon\Carbon;
use App\Models\JurnalUmum;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($code, Request $request)
    {
        // BukuBesar
        // Sidebar: Ambil daftar asset sesuai kriteria Anda
        $asset = Asset::active()
            ->where(function ($query) {
                $query->whereNotIn('akun_header', ['asset_tetap', 'kewajiban', 'ekuitas', 'pendapatan'])
                    ->orWhere(function ($q) {
                        $q->where('akun_header', 'pendapatan')
                            ->whereIn('kode_akun', ['450', '451']);
                    });
            })->get();

        // 1. Ambil info akun (Master)
        $account = Asset::where('kode_akun', $code)->first();

        if (!$account) {
            return redirect()->back()->with('error', 'Akun tidak ditemukan.');
        }

        // Proteksi Role/Header
        $allowedPendapatan = ['450', '451'];
        $disallowedHeaders = ['asset_tetap', 'kewajiban', 'ekuitas'];

        if (
            in_array($account->akun_header, $disallowedHeaders) ||
            ($account->akun_header == 'pendapatan' && !in_array($account->kode_akun, $allowedPendapatan))
        ) {
            return redirect()->back()->with('error', 'Role Ini dilarang untuk membuka Buku Besar ini.');
        }

        // 2. Ambil transaksi (Jurnal) - Siapkan Query dulu, JANGAN di ->get() dulu
        $query = JurnalUmum::whereNull('deleted_at')->where('nama_perkiraan', $account->nama_akun)->orderBy('tanggal', 'asc');

        // CEK FILTER TANGGAL
        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            // Gunakan nama input yang sesuai dengan di Form (tgl_mulai & tgl_selesai)
            $query->whereBetween('tanggal', [$request->tgl_mulai, $request->tgl_selesai]);
        }

        // Baru jalankan get() setelah semua filter terpasang
        $transactions = $query->get();
        $totalDebit = $query->sum('debit');
        $totalKredit = $query->sum('kredit');

        // 3. Logika Running Balance
        $saldoBerjalan = 0;
        foreach ($transactions as $trx) {
            // Tambahkan debit
            $saldoBerjalan += $trx->debit;
            // Kurangi kredit
            $saldoBerjalan -= $trx->kredit;

            $trx->saldo_temp = $saldoBerjalan;
        }

        return view('admin.buku-besar.data', compact('account', 'transactions', 'asset', 'totalDebit', 'totalKredit'));
    }

    public function index_owner($code, Request $request)
    {
        // Sidebar: Ambil daftar asset sesuai kriteria Anda
        $asset = Asset::active()->get();

        // 1. Ambil info akun (Master)
        $account = Asset::where('kode_akun', $code)->first();

        if (!$account) {
            return redirect()->back()->with('error', 'Akun tidak ditemukan.');
        }


        // 2. Ambil transaksi (Jurnal) - Siapkan Query dulu, JANGAN di ->get() dulu
        $query = JurnalUmum::active()->where('kode_perkiraan', $code)->orderBy('tanggal', 'asc');

        // CEK FILTER TANGGAL
        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            // Gunakan nama input yang sesuai dengan di Form (tgl_mulai & tgl_selesai)
            $query->whereBetween('tanggal', [$request->tgl_mulai, $request->tgl_selesai]);
        }

        // Baru jalankan get() setelah semua filter terpasang
        $transactions = $query->get();
        $totalDebit = $query->sum('debit');
        $totalKredit = $query->sum('kredit');

        // 3. Logika Running Balance
        $saldoBerjalan = 0;
        foreach ($transactions as $trx) {
            // Tambahkan debit
            $saldoBerjalan += $trx->debit;
            // Kurangi kredit
            $saldoBerjalan -= $trx->kredit;

            $trx->saldo_temp = $saldoBerjalan;
        }

        return view('owner.buku-besar.data', compact('account', 'transactions', 'asset', 'totalDebit', 'totalKredit'));
    }

    public function print($code, Request $request)
    {
        // 1. Ambil info akun (Master)
        $account = Asset::where('kode_akun', $code)->firstOrFail();

        // 2. Ambil transaksi (Jurnal) dengan filter yang sama
        $query = JurnalUmum::where('kode_perkiraan', $code)->orderBy('tanggal', 'asc');

        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            $query->whereBetween('tanggal', [$request->tgl_mulai, $request->tgl_selesai]);
        }

        $transactions = $query->get();

        // 3. Logika Running Balance (Wajib dihitung ulang untuk PDF)
        $saldoBerjalan = 0;
        foreach ($transactions as $trx) {
            if ($account->post_saldo == 'DEBET') {
                $saldoBerjalan += ($trx->debit - $trx->kredit);
            } else {
                $saldoBerjalan += ($trx->kredit - $trx->debit);
            }
            $trx->saldo_temp = $saldoBerjalan;
        }

        // 4. Konfigurasi PDF
        $owner = Auth::user()->name;
        $role = Auth::user()->role ?? 'owner';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('owner.buku-besar.print', [
            'account' => $account,
            'transactions' => $transactions,
            'owner' => $owner,
            'role' => $role,
            'tanggalCetak' => $tanggalCetak,
            'jamCetak' => $jamCetak,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream("buku-besar-{$code}.pdf");
    }

    public function print_owner($code, Request $request)
    {
        // 1. Ambil info akun (Master)
        $account = Asset::where('kode_akun', $code)->firstOrFail();

        // 2. Ambil transaksi (Jurnal) dengan filter yang sama
        $query = JurnalUmum::where('kode_perkiraan', $code)->orderBy('tanggal', 'asc');

        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            $query->whereBetween('tanggal', [$request->tgl_mulai, $request->tgl_selesai]);
        }

        $transactions = $query->get();

        // 3. Logika Running Balance (Wajib dihitung ulang untuk PDF)
        $saldoBerjalan = 0;
        foreach ($transactions as $trx) {
            if ($account->post_saldo == 'DEBET') {
                $saldoBerjalan += ($trx->debit - $trx->kredit);
            } else {
                $saldoBerjalan += ($trx->kredit - $trx->debit);
            }
            $trx->saldo_temp = $saldoBerjalan;
        }

        // 4. Konfigurasi PDF
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.buku-besar.print', [
            'account' => $account,
            'transactions' => $transactions,
            'admin' => $admin,
            'role' => $role,
            'tanggalCetak' => $tanggalCetak,
            'jamCetak' => $jamCetak,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream("buku-besar-{$code}.pdf");
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
