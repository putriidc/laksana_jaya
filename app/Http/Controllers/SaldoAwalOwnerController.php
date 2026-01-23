<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaldoAwalOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asset = Asset::active()
            ->where('akun_header', 'asset_lancar_bank')
            ->get();
        return view('owner.saldo_awal.data', compact('asset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bank = Asset::active()
            ->where('akun_header', 'asset_lancar_bank')
            ->where('saldo_awal', null)
            ->get();
        return view('owner.saldo_awal.index', compact('bank'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_akun' => 'required|string|exists:assets,kode_akun',
            'nominal'   => 'required|numeric|min:0',
        ]);

        // update saldo kas/bank sesuai kode akun
        $asset = Asset::where('kode_akun', $request->kode_akun)->firstOrFail();
        $assetModal = Asset::where('kode_akun', '310')->firstOrFail();
        $asset->saldo += $request->nominal;
        $asset->saldo_awal += $request->nominal;
        $asset->save();

        // update saldo Modal
        $modal = Asset::where('nama_akun', 'Modal')->first();
        if ($modal) {
            $modal->saldo += $request->nominal;
            $modal->save();
        }

            $lastId = JurnalUmum::max('id') ?? 0;
            $nextId = $lastId + 1;
            $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            $tanggal    = Carbon::now('Asia/Jakarta');
            $keterangan = 'Saldo Awal '. $asset->nama_akun;
            $keteranganModal = 'Tambah saldo Modal dari '. $asset->nama_akun;
            $nominal    = $request->nominal;

            // baris 2: debit ke kas/bank tujuan
            JurnalUmum::create([
                'kode_jurnal'   => $kodeJurnal,
                'detail_order' => 3,
                'tanggal'       => $tanggal,
                'kode_perkiraan' => $asset->kode_akun ?? '-',
                'nama_perkiraan' => $asset->nama_akun ?? '-',
                'keterangan'    => $keterangan,
                'nama_proyek'   => '-',
                'kode_proyek'   => '-',
                'debit'         => $nominal,
                'kredit'        => 0,
                'created_by'    => 'owner',
            ]);
            JurnalUmum::create([
                'kode_jurnal'   => $kodeJurnal,
                'detail_order' => 3,
                'tanggal'       => $tanggal,
                'kode_perkiraan' => $assetModal->kode_akun ?? '-',
                'nama_perkiraan' => $assetModal->nama_akun ?? '-',
                'keterangan'    => $keteranganModal,
                'nama_proyek'   => '-',
                'kode_proyek'   => '-',
                'debit'         => $nominal,
                'kredit'        => 0,
                'created_by'    => 'owner',
            ]);

        return redirect()->route('saldo.index')->with('success', 'Saldo awal berhasil disimpan');
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
