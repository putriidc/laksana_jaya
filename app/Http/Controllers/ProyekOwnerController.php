<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Proyek;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use App\Models\KontrakProyek;
use Illuminate\Support\Facades\Auth;

class ProyekOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // tangkap kategori dari query string
        $kategori = $request->input('kategori');

        // filter berdasarkan kategori
        $proyeks = Proyek::where('kategori', $kategori)
            ->whereNull('deleted_at')
            ->orderBy('nama_perusahaan')
            ->get()
            ->groupBy('nama_perusahaan');

        return view('owner.data-proyek.proyek.data', compact('proyeks', 'kategori'));
    }
    public function indexManage(Request $request)
    {


        $kontrak = KontrakProyek::whereNull('deleted_at')
            ->get();

        return view('owner.management.data', compact('kontrak'));
    }
    public function indexResume(Request $request)
    {
        $proyeks = Proyek::all();
        $assetBankAccounts = Asset::where('akun_header', 'asset_lancar_bank')->pluck('nama_akun');
        $resume = $proyeks->map(function ($proyek) use ($assetBankAccounts) {
            $jurnal = JurnalUmum::where('nama_proyek', $proyek->nama_proyek)->where('nama_perkiraan', '!=', 'Piutang Proyek')->whereNotIn('nama_perkiraan', $assetBankAccounts)->get();
            $totalPengeluaran = $jurnal->sum('debit');
            $piutangVendor = 0;
            $kontrak = KontrakProyek::where('kode_proyek', $proyek->kode_akun)->first();
            $net = $kontrak->net;
            return [
            'nama_proyek' => $proyek->nama_proyek,
            'tgl_mulai' => $proyek->tgl_mulai,
            'jenis_proyek' => $proyek->jenis ?? '-',
            'total_pengeluaran' => $totalPengeluaran,
            'piutang_vendor' => $piutangVendor,
            'total_tp_pv' => $totalPengeluaran + $piutangVendor,
            'persentase' => ($totalPengeluaran / $net) * 100,
            'sisa' => $net - $totalPengeluaran,
            'net' => $net,
        ];
        });

        return view('owner.resume.data', compact('resume'));
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
    public function storeKontrak(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_proyek'        => 'required|string',
                'nama_proyek'        => 'required|string',
                'nilai_kontrak'      => 'required|integer|min:0',
                'dpp'                => 'required|integer|min:0',
                'ppn_persen'         => 'required|numeric|min:0',
                'ppn'                => 'required|integer|min:0',
                'pph'                => 'nullable|integer|min:0',
                'sisa_potong_pajak'  => 'required|integer|min:0',
                'fee_dinas_persen'   => 'required|numeric|min:0',
                'fee_dinas'          => 'required|integer|min:0',
                'net_persen'         => 'required|numeric|min:0',
                'net'                => 'required|integer|min:0',
                'keuntungan'         => 'required|integer|min:0',
                'real_untung'        => 'required|integer|min:0',
            ]);

            $validated['created_by'] = Auth::id();

            KontrakProyek::create($validated);

            return redirect()->back()->with('success', 'Data kontrak berhasil disimpan.');
        } catch (\Throwable $e) { // kirim pesan error ke session return
            redirect()->back()->with('error', 'Gagal menyimpan kontrak: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proyek = Proyek::findOrFail($id);

        // ambil semua nama akun dari Asset dengan akun_header = asset_lancar_bank
        $assetBankAccounts = Asset::where('akun_header', 'asset_lancar_bank')
            ->pluck('nama_akun'); // ambil nama_akun, bisa juga kode_akun kalau mau

        $jurnal = JurnalUmum::where('nama_proyek', $proyek->nama_proyek)
            ->where('nama_perkiraan', '!=', 'Piutang Proyek')
            ->whereNotIn('nama_perkiraan', $assetBankAccounts)
            ->orderBy('tanggal', 'desc')
            ->get();
        $totalDebit = $jurnal->sum('debit');

        return view('owner.data-proyek.proyek.detail', compact('proyek', 'jurnal', 'totalDebit'));
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
