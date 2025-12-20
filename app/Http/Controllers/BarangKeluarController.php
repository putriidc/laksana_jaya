<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangKeluarController extends Controller
{
    public function index()
    {
        // $barangMasuks = BarangMasuk::with('barang')->whereNull('deleted_at')->get();
        // $barangKeluars = BarangKeluar::with('barang')->whereNull('deleted_at')->get();
        // return view('kepala-gudang.transaksi-barang.data', compact('barangKeluars', 'barangMasuks'));
    }

    public function create()
    {
        // Kirim semua barang aktif untuk option di form
        $barangs = Barang::whereNull('deleted_at')->get();
        return view('kepala-gudang.transaksi-barang.create-keluar', compact('barangs'));
    }
    public function createForBarang($kode_barang)
    {
        $barang = Barang::where('kode_barang', $kode_barang)
            ->whereNull('deleted_at')
            ->firstOrFail();
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        return view('kepala-gudang.detail-barang.transaksi-barang.create-keluar', compact('barang', 'today'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
            'qty'         => 'required|integer|min:1',
        ]);

        // Simpan barang masuk
        $barangKeluar = BarangKeluar::create([
            'kode_barang' => $request->kode_barang,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
            'qty'         => $request->qty,
            'created_by'  => Auth::check() ? Auth::user()->id : null,
        ]);

        // kurang stok barang
        $barang = Barang::where('kode_barang', $request->kode_barang)->first();
        if ($barang) {
            $barang->decrement('stok', $request->qty);
        }

        return redirect()->route('barangs.show', $barang->id)->with('success', 'Barang berhasil dikurangkan');
    }

    public function edit($id)
    {
        $barangMasuk = BarangKeluar::findOrFail($id);
        $barangs = Barang::whereNull('deleted_at')->get();
        return view('kepala-gudang.detail-barang.transaksi-barang.edit-keluar', compact('barangMasuk', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
            'qty'         => 'required|integer|min:1',
        ]);

        $barangMasuk = BarangKeluar::findOrFail($id);
        $barang = Barang::where('kode_barang', $barangMasuk->kode_barang)->first();

        if ($barang) {
            // 1. Kembalikan stok ke posisi sebelum transaksi ini
            $barang->increment('stok', $barangMasuk->qty);

            // 2. kurangkan stok dengan qty baru
            $barang->decrement('stok', $request->qty);
        }

        // Update data barang masuk
        $barangMasuk->update([
            'kode_barang' => $request->kode_barang,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
            'qty'         => $request->qty,
        ]);

        return redirect()->route('barangs.show', $barang->id)->with('success', 'Data barang masuk berhasil diupdate');
    }

    public function destroy($id)
    {
        $barangMasuk = Barangkeluar::findOrFail($id);

        // tambah stok barang sesuai qty
        $barang = Barang::where('kode_barang', $barangMasuk->kode_barang)->first();
        if ($barang) {
            $barang->increment('stok', $barangMasuk->qty);
        }

        // Soft delete
        $barangMasuk->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);

        return redirect()->route('barangs.show', $barang->id)->with('success', 'Barang masuk berhasil dihapus');
    }
}
