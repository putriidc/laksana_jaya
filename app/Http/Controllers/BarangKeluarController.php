<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Proyek;
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
        $proyeks = Proyek::whereNull('deleted_at')->get();

        return view('kepala-gudang.detail-barang.transaksi-barang.create-keluar', compact('barang', 'today', 'proyeks'));
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
        // kurang stok barang
        $barang = Barang::where('kode_barang', $request->kode_barang)->first();
        if ($barang->stok < $request->qty) {
            return redirect()->route('barangs.show', $barang->id)->with('error', 'Total stok yang tersedia tidak cukup');
            } else {
            // Simpan barang masuk
            $barangKeluar = BarangKeluar::create([
                'kode_barang' => $request->kode_barang,
                'kode_akun' => $request->kode_akun,
                'tanggal'     => $request->tanggal,
                'keterangan'  => $request->keterangan,
                'qty'         => $request->qty,
                'created_by'  => Auth::check() ? Auth::user()->id : null,
            ]);
    
            // pada proyek ambil nama proyek dan pic
            $proyek = Proyek::where('kode_akun', $request->kode_akun)->first();
            $pic = $proyek->pic;
            $nama_proyek = $proyek->nama_proyek;
            $barang->decrement('stok', $request->qty);
            CatatStokBarang($request->kode_barang, $nama_proyek, $pic, $request->qty, 'Stok Barang Keluar telah disimpan', $barangKeluar->id);
            return redirect()->route('barangs.show', $barang->id)->with('success', 'Barang berhasil dikurangkan');
        }
    }

    public function edit($id)
    {
        $barangMasuk = BarangKeluar::findOrFail($id);
        $barangs = Barang::whereNull('deleted_at')->get();
        $proyeks = Proyek::whereNull('deleted_at')->get();
        $proyekKeluar = Proyek::where('kode_akun', $barangMasuk->kode_akun)->whereNull('deleted_at')->first();
        return view('kepala-gudang.detail-barang.transaksi-barang.edit-keluar', compact('barangMasuk', 'proyeks', 'barangs', 'proyekKeluar'));
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

        $barangKeluar = BarangKeluar::findOrFail($id);
        $barang = Barang::where('kode_barang', $barangKeluar->kode_barang)->first();

        if (($barang->stok + $barangKeluar->qty) < $request->qty) {
             return redirect()->route('barangs.show', $barang->id)->with('error', 'Total stok yang tersedia tidak cukup');
        } else {
        // 1. Kembalikan stok ke posisi sebelum transaksi ini
        $barang->increment('stok', $barangKeluar->qty);

        // 2. kurangkan stok dengan qty baru
        $barang->decrement('stok', $request->qty);

        // pada proyek ambil nama proyek dan pic
        $proyek = Proyek::where('kode_akun', $request->kode_akun)->first();
        $pic = $proyek->pic;
        $nama_proyek = $proyek->nama_proyek;
        
        // Update data barang masuk
        $barangKeluar->update([
            'kode_barang' => $request->kode_barang,
            'kode_akun' => $request->kode_akun,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
            'qty'         => $request->qty,
            ]);
            
        CatatStokBarang($request->kode_barang, $nama_proyek, $pic, $request->qty, 'Stok Barang keluar telah Di edit', $barangKeluar->id);
        return redirect()->route('barangs.show', $barang->id)->with('success', 'Data barang keluar berhasil diupdate');
        }
    }

    public function destroy($id)
    {
        $barangKeluar = Barangkeluar::findOrFail($id);

        // tambah stok barang sesuai qty
        $barang = Barang::where('kode_barang', $barangKeluar->kode_barang)->first();
        if ($barang) {
            $barang->increment('stok', $barangKeluar->qty);
        }
        // pada proyek ambil nama proyek dan pic
        $proyek = Proyek::where('kode_akun', $barangKeluar->kode_akun)->first();
        $pic = $proyek->pic;
        $nama_proyek = $proyek->nama_proyek;
        
        // Soft delete
        $barangKeluar->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
        
        CatatStokBarang($barangKeluar->kode_barang, $nama_proyek, $pic, $barangKeluar->qty, 'Stok Barang Keluar telah dihapus', $barangKeluar->id);
        return redirect()->route('barangs.show', $barang->id)->with('success', 'Stok Barang Keluar berhasil dihapus');
    }
}
