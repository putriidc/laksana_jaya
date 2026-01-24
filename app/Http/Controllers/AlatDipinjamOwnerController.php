<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\AlatDipinjam;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AlatDipinjamOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $alatMasuks = AlatDibeli::with('alat')->whereNull('deleted_at')->get();
    //     $alatDipinjams = AlatDipinjam::with('alat')->whereNull('deleted_at')->get();
    //     $alatDikembalikans = AlatDikembalikan::with('alat')->whereNull('deleted_at')->get();
    //     return view('owner.transaksi-barang.data', compact('barangKeluars', 'barangMasuks', 'barangReturs'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create($kode_alat)
    // {
    //     // Ambil alat yang sedang dilihat
    //     $alat = Alat::where('kode_alat', $kode_alat)
    //         ->whereNull('deleted_at')
    //         ->firstOrFail();

    //     return view('owner.data-alat.alatDibeli.create', compact('alat'));
    // }

    public function createForAlat($kode_alat)
    {
        $alats = Alat::where('kode_alat', $kode_alat)
            ->whereNull('deleted_at')
            ->firstOrFail();
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $proyeks = Proyek::whereNull('deleted_at')->get();

         return view('owner.data-alat.alatDipinjam.create', compact('alats', 'today', 'proyeks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_alat' => 'required|exists:alats,kode_alat',
            'kode_akun' => 'required|exists:proyeks,kode_akun',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
            'qty'         => 'required|integer|min:1',
        ]);

        // Tambah stok barang
        $alat = Alat::where('kode_alat', $request->kode_alat)->first();
        if ($alat->stok < $request->qty) {
            return redirect()->route('alatsOwner.show', $alat->id)->with('error', 'Total stok yang tersedia tidak cukup');
        } else {
            // pada proyek ambil nama proyek dan pic
            $proyek = Proyek::where('kode_akun', $request->kode_akun)->first();
            $pic = $proyek->pic;
            $nama_proyek = $proyek->nama_proyek;
    
            // Simpan barang masuk
            $alatMasuk = AlatDipinjam::create([
                'kode_alat' => $request->kode_alat,
                'kode_akun' => $request->kode_akun,
                'tanggal'     => $request->tanggal,
                'keterangan'  => $request->keterangan,
                'qty'         => $request->qty,
                'created_by'  => Auth::check() ? Auth::user()->id : null,
            ]);
            $alat->decrement('stok', $request->qty);
            CatatStok($request->kode_alat, $nama_proyek, $pic, $request->qty, 'Stok Alat Dipinjam', $alatMasuk->id);
            return redirect()->route('alatsOwner.show', $alat->id)->with('success', 'Stok Alat berhasil dipinjam');
        }
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $alatPinjam = AlatDipinjam::findOrFail($id);
        $proyeks = Proyek::whereNull('deleted_at')->get();
        $proyekDipinjam = Proyek::where('kode_akun', $alatPinjam->kode_akun)->whereNull('deleted_at')->first();
        $alats = Alat::where('kode_alat', $alatPinjam->kode_alat)
                        ->whereNull('deleted_at')->first();
        return view('owner.data-alat.alatDipinjam.edit', compact('alatPinjam', 'alats', 'proyeks' , 'proyekDipinjam'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_alat' => 'required|exists:alats,kode_alat',
            'kode_akun' => 'required|exists:proyeks,kode_akun',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
            'qty'         => 'required|integer|min:1',
        ]);

        // pada proyek ambil nama proyek dan pic
        $proyek = Proyek::where('kode_akun', $request->kode_akun)->first();
        $pic = $proyek->pic;
        $nama_proyek = $proyek->nama_proyek;

        $alatMasuk = AlatDipinjam::findOrFail($id);
        $alat = alat::where('kode_alat', $alatMasuk->kode_alat)->first();

        if (($alat->stok + $alatMasuk->qty) < $request->qty) {
            return redirect()->route('alatsOwner.show', $alat->id)->with('error', 'Total stok yang tersedia tidak cukup');
        } else {
            // 1. Kembalikan stok ke posisi sebelum transaksi ini
            $alat->increment('stok', $alatMasuk->qty);

            // 2. kurangi stok dengan qty baru
            $alat->decrement('stok', $request->qty);

            // Update data barang masuk
            $alatMasuk->update([
                'kode_alat' => $request->kode_alat,
                'kode_akun' => $request->kode_akun,
                'tanggal'     => $request->tanggal,
                'keterangan'  => $request->keterangan,
                'qty'         => $request->qty,
            ]);

            CatatStok($request->kode_alat, $nama_proyek, $pic, $request->qty, 'Stok Alat Dipinjam telah Diedit', $alatMasuk->id);
            return redirect()->route('alatsOwner.show', $alat->id)->with('success', 'Stok Alat berhasil diupdate');
        }
    }

    public function destroy($id)
    {
        $alatMasuk = AlatDipinjam::findOrFail($id);

        // pada proyek ambil nama proyek dan pic
        $proyek = Proyek::where('kode_akun', $alatMasuk->kode_akun)->first();
        $pic = $proyek->pic;
        $nama_proyek = $proyek->nama_proyek;

        // Kurangi stok barang sesuai qty
        $alat = Alat::where('kode_alat', $alatMasuk->kode_alat)->first();
        if ($alat) {
            $alat->increment('stok', $alatMasuk->qty);
        }

        // Soft delete
        $alatMasuk->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
        CatatStok($alatMasuk->kode_alat, $nama_proyek, $pic, $alatMasuk->qty, 'Stok Alat Dipinjam Di Hapus', $alatMasuk->id);

        return redirect()->route('alatsOwner.show', $alat->id)->with('success', 'Stok Alat Dibeli berhasil dihapus');
    }
}
