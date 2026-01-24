<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\Proyek;
use App\Models\JurnalUmum;
use App\Models\NotaLangsung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class NotaLangsungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nota = NotaLangsung::active()->orderBy('id', 'desc')->get();
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $proyek = Proyek::whereNull('deleted_at')
            ->get();
        $hpp = Asset::whereNull('deleted_at')
            ->where('akun_header', 'hpp_proyek')->get();
        if (Auth::user()->role === 'Admin 1') {
            $allowedAccounts = ['Kas Besar', 'Kas Bank BCA', 'Kas Flip', 'OVO'];

            $bank = Asset::Active()
                ->where('akun_header', 'asset_lancar_bank')
                ->whereIn('nama_akun', $allowedAccounts)
                ->where('nama_akun', '!=', 'Kas BJB')
                ->get();
        } elseif (Auth::user()->role === 'Admin 2') {
            $bank = Asset::Active()
                ->where('akun_header', 'asset_lancar_bank')
                ->where('nama_akun', '!=', 'Kas BJB')
                ->get();
        }
        return view('admin.nota-langsung.data', compact('nota', 'today', 'proyek', 'hpp', 'bank'));
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
        $request->validate([
            'tanggal'      => 'required|date',
            'nama_proyek'  => 'required|string',
            'pic'          => 'required|string',
            'keterangan'          => 'required|string',
            'kode_akun'          => 'required|string',
            'kode_kas'          => 'required|string',
            'nominal'      => 'required|numeric|min:1',
            'detail_biaya' => 'nullable|string',
        ]);
        $kodeEaf = 'Nota-' . Carbon::now('Asia/Jakarta')->format('YmdHis');

        $nota = NotaLangsung::create([
            'kode_nota'     => $kodeEaf,
            'tanggal'      => $request->tanggal,
            'nama_proyek'  => $request->nama_proyek,
            'pic'          => $request->pic,
            'keterangan'   => $request->keterangan,
            'kode_akun'   => $request->kode_akun,
            'kode_kas'   => $request->kode_kas,
            'nominal'      => $request->nominal,
            'detail_biaya' => $request->detail_biaya,
            'created_by'   => Auth::user()->name ?? 'system',
        ]);

        $asset = Asset::active()->where('kode_akun', $request->kode_akun)->first();
        $bank = Asset::active()->where('kode_akun', $request->kode_kas)->first();
        $proyek = Proyek::active()->where('nama_proyek', $request->nama_proyek)->first();
        $lastId = JurnalUmum::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);


        JurnalUmum::create([
            'kode_jurnal'   => $kodeJurnal, // generate kode unik
            'detail_order' => 3,
            'tanggal'       => $request->tanggal,         // sama dengan tanggal kasbonContent
            'keterangan'    => $request->keterangan,         // isi kontrak
            'nama_perkiraan' => $asset ? $asset->nama_akun : null,
            'kode_perkiraan' => $asset ? $asset->kode_akun : null,
            'nama_proyek'   => $proyek ? $proyek->nama_proyek : null,
            'kode_proyek'   =>  $proyek ? $proyek->kode_akun : null,
            'debit'         => $request->nominal,
            'kredit'        => 0,
            'kategori'        => 'TF toko',
            'created_by'    => Auth::check() ? Auth::user()->id : null,
        ]);
        JurnalUmum::create([
            'kode_jurnal'   => $kodeJurnal, // generate kode unik
            'detail_order' => 3,
            'tanggal'       => $request->tanggal,         // sama dengan tanggal content
            'keterangan'    => $request->keterangan,         // isi kontrak
            'nama_perkiraan' => $bank ? $bank->nama_akun : null,
            'kode_perkiraan' => $bank ? $bank->kode_akun : null,
            'nama_proyek'   => $proyek ? $proyek->nama_proyek : null,
            'kode_proyek'   => $proyek ? $proyek->kode_akun : null,
            'debit'         => 0,
            'kredit'        => $request->nominal,
            'kategori'        => 'TF toko',
            'created_by'    => Auth::check() ? Auth::user()->id : null,
        ]);

        return redirect()->route('notaLangsung.index')
            ->with('success', 'Nota Langsung berhasil dibuat');
    }

    public function print()
    {
        $nota = NotaLangsung::active()->orderBy('id', 'desc')->get();
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $proyek = Proyek::whereNull('deleted_at')
            ->get();
        $hpp = Asset::whereNull('deleted_at')
            ->where('akun_header', 'hpp_proyek')->get();
        if (Auth::user()->role === 'Admin 1') {
            $allowedAccounts = ['Kas Besar', 'Kas Bank BCA', 'Kas Flip', 'OVO'];

            $bank = Asset::Active()
                ->where('akun_header', 'asset_lancar_bank')
                ->whereIn('nama_akun', $allowedAccounts)
                ->where('nama_akun', '!=', 'Kas BJB')
                ->get();
        } elseif (Auth::user()->role === 'Admin 2') {
            $bank = Asset::Active()
                ->where('akun_header', 'asset_lancar_bank')
                ->where('nama_akun', '!=', 'Kas BJB')
                ->get();
        }

        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.nota-langsung.print', compact('nota', 'today', 'proyek', 'hpp', 'bank', 'admin', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('nota-langsung.pdf');
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
        $detail = NotaLangsung::findOrFail($id);

        $detail->delete();

        return redirect()->route('notaLangsung.index')
            ->with('success', 'Nota Langsung berhasil dihapus');
    }
}
