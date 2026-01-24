<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\AlatDikembalikan;
use App\Models\AlatDipinjam;
use App\Models\Proyek;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlatDikembalikanAdminController extends Controller
{
    public function createForAlat($kode_alat)
    {
        $alats = Alat::where('kode_alat', $kode_alat)
            ->whereNull('deleted_at')
            ->firstOrFail();
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $proyeks = Proyek::whereNull('deleted_at')->get();
        $alatdipinjams = AlatDipinjam::where('kode_alat', $alats->kode_alat)->whereNull('deleted_at')->get();

         return view('admin.data-alat.alatDikembalikan.create', compact('alats', 'today', 'proyeks', 'alatdipinjams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_alat' => 'required|exists:alats,kode_alat',
            'id_pinjaman' => 'required|exists:alat_dipinjams,id',
            'kode_akun' => 'required|exists:proyeks,kode_akun',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
            'qty'         => 'required|integer|min:1',
        ]);
        
        // cari id pinjaman dan hapus data pinjaman
        $alatPinjam = AlatDipinjam::where('id', $request->id_pinjaman)->first();
        if(!$alatPinjam){
            return redirect()->back()->with('error', 'Data alat yang dipinjam tidak ditemukan');
        }
        $alatPinjam->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
        
        // pada proyek ambil nama proyek dan pic
        $proyek = Proyek::where('kode_akun', $request->kode_akun)->first();
        $pic = $proyek->pic;
        $nama_proyek = $proyek->nama_proyek;

        // Simpan barang masuk
        $alatMasuk = AlatDikembalikan::create([
            'kode_alat'   => $request->kode_alat,
            'id_pinjaman' => $request->id_pinjaman,
            'kode_akun'   => $request->kode_akun,
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
        
        CatatStok($request->kode_alat, $nama_proyek, $pic, $request->qty, 'Stok Alat Dikembalikan', $alatMasuk->id);
        return redirect()->route('alatsAdmin.show', $alat->id)->with('success', 'Stok Alat berhasil dikembalikan');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $alatDikembalikans = AlatDikembalikan::findOrFail($id);
        $proyeks = Proyek::whereNull('deleted_at')->get();
        $proyekDikembalikan = Proyek::where('kode_akun', $alatDikembalikans->kode_akun)->whereNull('deleted_at')->first();
        $alats = Alat::where('kode_alat', $alatDikembalikans->kode_alat)
                        ->whereNull('deleted_at')->first();
        $alatDipinjams = AlatDipinjam::where('kode_alat', $alats->kode_alat)
                        ->whereNull('deleted_at')
                        ->get();
        return view('admin.data-alat.alatDikembalikan.edit', compact('alatDikembalikans', 'alats', 'proyeks', 'alatDipinjams', 'proyekDikembalikan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pinjaman' => 'required',
            'kode_alat' => 'required|exists:alats,kode_alat',
            'kode_akun' => 'required|exists:proyeks,kode_akun',
            'tanggal'     => 'required|date',
            'keterangan'  => 'nullable|string',
            'qty'         => 'required|integer|min:1',
        ]);

        $alatDikembalikan = AlatDikembalikan::findOrFail($id);
        $alat = alat::where('kode_alat', $alatDikembalikan->kode_alat)->first();

        // pada proyek ambil nama proyek dan pic
        $proyek = Proyek::where('kode_akun', $request->kode_akun)->first();
        $pic = $proyek->pic;
        $nama_proyek = $proyek->nama_proyek;

        if ($alat) {
            // 1. Kembalikan stok ke posisi sebelum transaksi ini
            $alat->decrement('stok', $alatDikembalikan->qty);

            // 2. tambah stok dengan qty baru
            $alat->increment('stok', $request->qty);
        }

        // 1. Ambil data lama, gunakan withTrashed() agar data yang didelete bisa ditemukan
        $alatPinjamLama = AlatDipinjam::withTrashed()->where('id', $alatDikembalikan->id_pinjaman)->first();

        if ($alatPinjamLama) {
            // Gunakan restore() untuk mengubah deleted_at menjadi null secara otomatis
            $alatPinjamLama->restore();
        }

        // 2. Ambil data baru dan hapus (Soft Delete)
        $alatPinjamBaru = AlatDipinjam::findOrFail($request->id_pinjaman);

        // Cukup gunakan delete(), Laravel akan otomatis mengisi deleted_at dengan Carbon::now()
        $alatPinjamBaru->delete();

        // Update data barang masuk
        $alatDikembalikan->update([
            'kode_alat' => $request->kode_alat,
            'id_pinjaman' => $request->id_pinjaman,
            'kode_akun' => $request->kode_akun,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
            'qty'         => $request->qty,
        ]);

        CatatStok($request->kode_alat, $nama_proyek, $pic, $request->qty, 'Stok Alat Dikembalikan telah Diedit', $alatDikembalikan->id);
        return redirect()->route('alatsAdmin.show', $alat->id)->with('success', 'Stok Alat Dikembalikan berhasil diupdate');
    }

    public function destroy($id)
    {
        $alatDikembalikan = AlatDikembalikan::findOrFail($id);

        // Kurangi stok barang sesuai qty
        $alat = Alat::where('kode_alat', $alatDikembalikan->kode_alat)->first();
        if ($alat) {
            $alat->decrement('stok', $alatDikembalikan->qty);
        }

        // pada proyek ambil nama proyek dan pic
        $proyek = Proyek::where('kode_akun', $alatDikembalikan->kode_akun)->first();
        $pic = $proyek->pic;
        $nama_proyek = $proyek->nama_proyek;

        // Ambil data termasuk yang sudah di-soft delete
        $alatPinjam = AlatDipinjam::withTrashed()->where('id', $alatDikembalikan->id_pinjaman)->first();

        if ($alatPinjam) {
            // Ini cara resmi mengembalikan data (set deleted_at jadi null)
            $alatPinjam->restore(); 
        }

        // Untuk soft delete data yang sekarang
        // Pastikan model AlatDikembalikan juga menggunakan trait SoftDeletes
        $alatDikembalikan->delete();
        CatatStok($alatDikembalikan->kode_alat, $nama_proyek, $pic, $alatDikembalikan->qty, 'Stok Alat Dikembalikan Di Hapus', $alatDikembalikan->id);

        return redirect()->route('alatsAdmin.show', $alat->id)->with('success', 'Stok Alat Dikembalikan berhasil dihapus');
    }
}
