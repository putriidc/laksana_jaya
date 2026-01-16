<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\barangRetur;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class barangReturController extends Controller
{
    public function create($kode_barang)
    {
        // Ambil barang yang sedang dilihat
        $barang = Barang::where('kode_barang', $kode_barang)
            ->whereNull('deleted_at')
            ->firstOrFail();

        return view('kepala-gudang.detail-barang.transaksi-barang.create-masuk', compact('barang'));
    }

    public function createForBarang($kode_barang)
    {
        $barang = Barang::where('kode_barang', $kode_barang)
            ->whereNull('deleted_at')
            ->firstOrFail();
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $proyeks = Proyek::whereNull('deleted_at')->get();

        return view('kepala-gudang.detail-barang.transaksi-barang.create-retur', compact('barang', 'today', 'proyeks'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'kode_akun' => 'required|exists:proyeks,kode_akun',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
            'qty'         => 'required|integer|min:1',
        ]);

        // Simpan barang masuk
        $barangMasuk = barangRetur::create([
            'kode_barang' => $request->kode_barang,
            'kode_akun' => $request->kode_akun,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
            'qty'         => $request->qty,
            'created_by'  => Auth::check() ? Auth::user()->id : null,
        ]);

        // Tambah stok barang
        $barang = Barang::where('kode_barang', $request->kode_barang)->first();
        if ($barang) {
            $barang->increment('stok', $request->qty);
        }
        // pada proyek ambil nama proyek dan pic
        $proyek = Proyek::where('kode_akun', $request->kode_akun)->first();
        $pic = $proyek->pic;
        $nama_proyek = $proyek->nama_proyek;

        CatatStokBarang($request->kode_barang, $nama_proyek, $pic, $request->qty, 'Stok Barang Retur telah disimpan', $barangMasuk->id);
        return redirect()->route('barangs.show', $barang->id)->with('success', 'Barang retur berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barangMasuk = barangRetur::findOrFail($id);
        $barangs = Barang::whereNull('deleted_at')->get();
        $proyeks = Proyek::whereNull('deleted_at')->get();
        $proyekRetur = Proyek::where('kode_akun', $barangMasuk->kode_akun)->whereNull('deleted_at')->first();
        return view('kepala-gudang.detail-barang.transaksi-barang.edit-retur', compact('barangMasuk', 'barangs', 'proyeks', 'proyekRetur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|exists:barangs,kode_barang',
            'kode_akun' => 'required|exists:proyeks,kode_akun',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
            'qty'         => 'required|integer|min:1',
        ]);

        $barangMasuk = barangRetur::findOrFail($id);
        $barang = Barang::where('kode_barang', $barangMasuk->kode_barang)->first();

        if ($barang) {
            // 1. Kembalikan stok ke posisi sebelum transaksi ini
            $barang->decrement('stok', $barangMasuk->qty);

            // 2. Tambahkan stok dengan qty baru
            $barang->increment('stok', $request->qty);
        }

        // Update data barang masuk
        $barangMasuk->update([
            'kode_barang' => $request->kode_barang,
            'kode_akun' => $request->kode_akun,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
            'qty'         => $request->qty,
        ]);
        // pada proyek ambil nama proyek dan pic
        $proyek = Proyek::where('kode_akun', $request->kode_akun)->first();
        $pic = $proyek->pic;
        $nama_proyek = $proyek->nama_proyek;

        CatatStokBarang($request->kode_barang, $nama_proyek, $pic, $request->qty, 'Stok Barang Retur telah diedit', $barangMasuk->id);
        return redirect()->route('barangs.show', $barang->id)->with('success', 'Data barang retur berhasil diupdate');
    }

    public function destroy($id)
    {
        $barangMasuk = barangRetur::findOrFail($id);

        // Kurangi stok barang sesuai qty
        $barang = Barang::where('kode_barang', $barangMasuk->kode_barang)->first();
        if ($barang) {
            $barang->decrement('stok', $barangMasuk->qty);
        }

        // Soft delete
        $barangMasuk->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
                // pada proyek ambil nama proyek dan pic
        $proyek = Proyek::where('kode_akun', $barangMasuk->kode_akun)->first();
        $pic = $proyek->pic;
        $nama_proyek = $proyek->nama_proyek;

        CatatStokBarang($barangMasuk->kode_barang, $nama_proyek, $pic, $barangMasuk->qty, 'Stok Barang Retur telah dihapus', $barangMasuk->id);
        return redirect()->route('barangs.show', $barang->id)->with('success', 'Barang retur berhasil dihapus');
    }
}
