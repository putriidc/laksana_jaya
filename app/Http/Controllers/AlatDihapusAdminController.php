<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\AlatDihapus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlatDihapusAdminController extends Controller
{
     public function createForAlat($kode_alat)
    {
        $alats = Alat::where('kode_alat', $kode_alat)
            ->whereNull('deleted_at')
            ->firstOrFail();
        $today = Carbon::now('Asia/Jakarta')->toDateString();

         return view('admin.data-alat.alatDihapus.create', compact('alats', 'today'));
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

        // kurangi stok barang
        $alat = Alat::where('kode_alat', $request->kode_alat)->first();
        if ($alat->stok < $request->qty) {
            // keluarkan notif bahwa stok tidak cukup dan gagalkan menyimpan
            return redirect()->route('alatsAdmin.show', $alat->id)->with('error', 'Total Stok Alat yang dikeluarkan lebih besar dari stok yang tersedia');
        } else {
            // Simpan barang masuk
            $alatMasuk = AlatDihapus::create([
                'kode_alat' => $request->kode_alat,
                'tanggal'     => $request->tanggal,
                'keterangan'  => $request->keterangan,
                'qty'         => $request->qty,
                'created_by'  => Auth::check() ? Auth::user()->id : null,
                ]);
                
            $alat->decrement('stok', $request->qty);
            CatatStok($request->kode_alat, null, null, $request->qty, 'Stok Alat Di kurangi(dihapus)', $alatMasuk->id);
            return redirect()->route('alatsAdmin.show', $alat->id)->with('success', 'Stok Alat yang dihapus berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $alatMasuk = AlatDihapus::findOrFail($id);
        $alats = Alat::where('kode_alat', $alatMasuk->kode_alat)
                    ->whereNull('deleted_at')->first();
        return view('admin.data-alat.alatDihapus.edit', compact('alatMasuk', 'alats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_alat' => 'required|exists:alats,kode_alat',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
            'qty'         => 'required|integer|min:1',
        ]);

        $alatMasuk = AlatDihapus::findOrFail($id);
        $alat = alat::where('kode_alat', $alatMasuk->kode_alat)->first();

        if (($alat->stok + $alatMasuk->qty) < $request->qty) {
            return redirect()->route('alatsAdmin.show', $alat->id)->with('error', 'Total Stok Alat yang dikeluarkan lebih besar dari stok yang tersedia');
        } else {
            // 1. Kembalikan stok ke posisi sebelum transaksi ini
            $alat->increment('stok', $alatMasuk->qty);

            // 2. Tambahkan stok dengan qty baru
            $alat->decrement('stok', $request->qty);

            // Update data barang masuk
            $alatMasuk->update([
                'kode_alat' => $request->kode_alat,
                'tanggal'     => $request->tanggal,
                'keterangan'  => $request->keterangan,
                'qty'         => $request->qty,
            ]);
    
            CatatStok($request->kode_alat, null, null, $request->qty, 'Stok Alat Dikurangi(dihapus) telah Di Edit', $alatMasuk->id);
            return redirect()->route('alatsAdmin.show', $alat->id)->with('success', 'Stok Alat yang dihapus berhasil diupdate');
        }

    }

    public function destroy($id)
    {
        $alatMasuk = AlatDihapus::findOrFail($id);

        // Kurangi stok barang sesuai qty
        $alat = Alat::where('kode_alat', $alatMasuk->kode_alat)->first();
        if ($alat) {
            $alat->increment('stok', $alatMasuk->qty);
        }

        // Soft delete
        $alatMasuk->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
        CatatStok($alatMasuk->kode_alat, null, null, $alatMasuk->qty, 'Stok Alat yang dikurangi(dihapus) Di Hapus', $alatMasuk->id);

        return redirect()->route('alatsAdmin.show', $alat->id)->with('success', 'Stok Alat yang dihapus berhasil didelete dari data');
    }
}
