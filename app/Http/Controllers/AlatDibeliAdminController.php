<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\AlatDibeli;
use App\Models\AlatDikembalikan;
use App\Models\AlatDipinjam;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AlatDibeliAdminController extends Controller
{
    public function index()
    {
        $alatMasuks = AlatDibeli::with('alat')->whereNull('deleted_at')->get();
        $alatDipinjams = AlatDipinjam::with('alat')->whereNull('deleted_at')->get();
        $alatDikembalikans = AlatDikembalikan::with('alat')->whereNull('deleted_at')->get();
        return view('admin.transaksi-barang.data', compact('barangKeluars', 'barangMasuks', 'barangReturs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($kode_alat)
    {
        // Ambil alat yang sedang dilihat
        $alat = Alat::where('kode_alat', $kode_alat)
            ->whereNull('deleted_at')
            ->firstOrFail();

        return view('admin.data-alat.alatDibeli.create', compact('alat'));
    }

    public function createForAlat($kode_alat)
    {
        $alats = Alat::where('kode_alat', $kode_alat)
            ->whereNull('deleted_at')
            ->firstOrFail();
        $today = Carbon::now('Asia/Jakarta')->toDateString();

         return view('admin.data-alat.alatDibeli.create', compact('alats', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_alat'   => 'required|exists:alats,kode_alat',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
            'qty'         => 'required|integer|min:1',
        ]);

        // Simpan barang masuk
        $alatMasuk = AlatDibeli::create([
            'kode_alat' => $request->kode_alat,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
            'qty'         => $request->qty,
            'created_by'  => Auth::check() ? Auth::user()->id : null,
        ]);

        // Tambah stok barang
        $alat = Alat::where('kode_alat', $request->kode_alat)->first();
        if ($alat) {
            $alat->increment('stok', $request->qty);
        }
        CatatStok($request->kode_alat, null, null, $request->qty, 'Stok Alat Masuk', $alatMasuk->id);

        return redirect()->route('alatsAdmin.show', $alat->id)->with('success', 'Stok Alat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $alatMasuk = AlatDibeli::findOrFail($id);
        $alats = Alat::where('kode_alat', $alatMasuk->kode_alat)
                    ->whereNull('deleted_at')->first();
        return view('admin.data-alat.alatDibeli.edit', compact('alatMasuk', 'alats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_alat' => 'required|exists:alats,kode_alat',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
            'qty'         => 'required|integer|min:1',
        ]);

        $alatMasuk = AlatDibeli::findOrFail($id);
        $alat = alat::where('kode_alat', $alatMasuk->kode_alat)->first();

        if ($alat) {
            // 1. Kembalikan stok ke posisi sebelum transaksi ini
            $alat->decrement('stok', $alatMasuk->qty);

            // 2. Tambahkan stok dengan qty baru
            $alat->increment('stok', $request->qty);
        }

        // Update data barang masuk
        $alatMasuk->update([
            'kode_alat' => $request->kode_alat,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
            'qty'         => $request->qty,
        ]);

        CatatStok($request->kode_alat, null, null, $request->qty, 'Stok Alat Masuk Di Edit', $alatMasuk->id);
        return redirect()->route('alatsAdmin.show', $alat->id)->with('success', 'Stok Alat berhasil diupdate');
    }

    public function destroy($id)
    {
        $alatMasuk = AlatDibeli::findOrFail($id);

        // Kurangi stok barang sesuai qty
        $alat = Alat::where('kode_alat', $alatMasuk->kode_alat)->first();
        if ($alat) {
            $alat->decrement('stok', $alatMasuk->qty);
        }

        // Soft delete
        $alatMasuk->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
        CatatStok($alatMasuk->kode_alat, null, null, $alatMasuk->qty, 'Stok Alat Masuk Di Hapus', $alatMasuk->id);

        return redirect()->route('alatsAdmin.show', $alat->id)->with('success', 'Stok Alat Dibeli berhasil dihapus');
    }
}
