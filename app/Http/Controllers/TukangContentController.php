<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\Proyek;
use App\Models\JurnalUmum;
use App\Models\KasbonTukang;
use Illuminate\Http\Request;
use App\Models\KasbonContent;
use App\Models\TukangContent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TukangContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function print($id)
    {
        // Ambil data pinjaman utama + relasi karyawan
        $pinjaman = KasbonTukang::active()->findOrFail($id);

        // Ambil semua transaksi pinjaman dan kasbon berdasarkan kode_karyawan
        $pinjamanContents = TukangContent::where('kode_kasbon', $pinjaman->kode_kasbon)
            ->where('status_spv', 'accept')
            ->where('status_owner', 'accept')
            ->active()->get();

        $admin        = Auth::user()->name ?? 'Administrator';
        $role         = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');

        $pdf = Pdf::loadView('admin.pinjaman-tukang.detail.print', compact(
            'pinjaman',
            'pinjamanContents',
            'admin',
            'role',
            'tanggalCetak'
        ))->setPaper('A4', 'portrait');

        return $pdf->stream('detail-pinjaman-tukang.pdf');
    }
    public function pinjam($id)
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $pinjaman = KasbonTukang::active()->findOrFail($id);
        return view('admin.pinjaman-tukang.detail.pinjam', compact('pinjaman', 'today'));
    }
    public function bayar($id)
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $pinjaman = KasbonTukang::active()->findOrFail($id);
        return view('admin.pinjaman-tukang.detail.bayar', compact('pinjaman', 'today'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_karyawan' => 'required',
            'tanggal'       => 'required|date',
            'kontrak'       => 'nullable|string',
            'bayar'         => 'required|numeric|min:0',
        ]);

        // Ambil pinjaman utama
        $pinjamanKaryawan = KasbonTukang::where('id', $request->kode_karyawan)->active()->firstOrFail();

        // // Hitung sisa
        // $sisa = $request->bayar + $pinjamanKaryawan->total_pinjam;

        // // Update total pinjam di PinjamanKaryawan
        // $pinjamanKaryawan->update([
        //     'total_pinjam' => $sisa,
        // ]);

        // Simpan PinjamanContent
        TukangContent::create([
            'kode_kasbon' => $pinjamanKaryawan->kode_kasbon,
            'kontrak'       => $request->kontrak,
            'tanggal'       => $request->tanggal,
            'jenis'         => 'pinjam',
            'bayar'         => $request->bayar,
            'sisa'          => 0,
            'ket_spv'      => 'pending',
            'ket_owner'      => 'pending',
            'status_spv'      => 'pending',
            'status_owner'      => 'pending',
            'created_by'    => Auth::id(),
        ]);

        return redirect()->route('pinjamanTukangs.show', $pinjamanKaryawan->id)
            ->with('success', 'Data pinjaman berhasil ditambahkan');
    }
    //bayar pinjaman
    public function storeBayar(Request $request)
    {
        $request->validate([
            'kode_karyawan' => 'required',
            'tanggal'       => 'required|date',
            'kontrak'       => 'nullable|string',
            'bayar'         => 'required|numeric|min:0',
        ]);

        // Ambil pinjaman utama
        $pinjamanKaryawan = KasbonTukang::where('id', $request->kode_karyawan)->active()->firstOrFail();

        // Hitung sisa
        $sisa = $pinjamanKaryawan->total - $request->bayar;

        // Update total pinjam di PinjamanKaryawan
        $pinjamanKaryawan->update([
            'total' => $sisa,
        ]);

        // Simpan PinjamanContent
        $content = TukangContent::create([
            'kode_kasbon' => $pinjamanKaryawan->kode_kasbon,
            'kontrak'       => $request->kontrak,
            'tanggal'       => $request->tanggal,
            'jenis'         => 'cicil',
            'bayar'         => $request->bayar,
            'sisa'          => $sisa,
            'status_spv'      => 'accept',
            'status_owner'      => 'accept',
            'created_by'    => Auth::id(),
        ]);

        // ✅ Tambahkan input ke jurnal umum
        $asset  = Asset::where('nama_akun', $pinjamanKaryawan->nama_akun)->first();
        $proyek = Proyek::where('nama_proyek', $pinjamanKaryawan->nama_proyek)->first();
        // generate kode jurnal J-00{id terakhir + 1}
        $lastId = JurnalUmum::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        JurnalUmum::create([
            'id_content'   => $content->id, // generate kode unik
            'kode_jurnal'   => $kodeJurnal, // generate kode unik
            'tanggal'       => $request->tanggal,         // sama dengan tanggal content
            'keterangan'    => $request->kontrak,         // isi kontrak
            'nama_perkiraan' => $pinjamanKaryawan->nama_akun,
            'kode_perkiraan' => $asset ? $asset->kode_akun : null,
            'nama_proyek'   => $pinjamanKaryawan->nama_proyek,
            'kode_proyek'   => $proyek ? $proyek->kode_akun : null,
            'debit'         => 0,
            'kredit'        => $request->bayar,
            'created_by'    => Auth::check() ? Auth::user()->id : null,
        ]);

        return redirect()->route('pinjamanTukangs.show', $pinjamanKaryawan->id)
            ->with('success', 'Data cicil pinjaman berhasil ditambahkan');
    }


    public function edit($id)
    {
        $content = TukangContent::findOrFail($id);
        return view('admin.pinjaman-karyawan.detail.form-edit.pinjaman', compact('content'));
    }
    public function editBayar($id)
    {
        $content = TukangContent::findOrFail($id);
        return view('admin.pinjaman-tukang.detail.edit-bayar', compact('content'));
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'tanggal' => 'required|date',
        //     'kontrak' => 'nullable|string',
        //     'bayar'   => 'required|numeric|min:0',
        // ]);

        // // Ambil PinjamanContent
        // $content = PinjamanContent::findOrFail($id);

        // // Ambil PinjamanKaryawan sesuai kode_karyawan
        // $pinjamanKaryawan = PinjamanKaryawan::where('kode_karyawan', $content->kode_karyawan)->active()->firstOrFail();

        // // Kurangi total_pinjam dengan nilai lama, lalu tambah nilai baru
        // $totalBaru = ($pinjamanKaryawan->total_pinjam - $content->bayar) + $request->bayar;

        // // Update PinjamanKaryawan
        // $pinjamanKaryawan->update([
        //     'total_pinjam' => $totalBaru,
        // ]);

        // // Update PinjamanContent
        // $content->update([
        //     'kontrak'  => $request->kontrak,
        //     'tanggal'  => $request->tanggal,
        //     'bayar'    => $request->bayar,
        //     'sisa'     => $totalBaru,
        // ]);

        // return redirect()->route('pinjamanTukangs.show', $pinjamanKaryawan->id)
        //     ->with('success', 'Data pinjaman berhasil diupdate');
    }
    public function updateBayar(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kontrak' => 'nullable|string',
            'bayar'   => 'required|numeric|min:0',
        ]);

        // Ambil PinjamanContent
        $content = TukangContent::findOrFail($id);

        // Ambil PinjamanKaryawan sesuai kode_karyawan
        $pinjamanKaryawan = KasbonTukang::where('kode_kasbon', $content->kode_kasbon)->active()->firstOrFail();

        // Kurangi total_pinjam dengan nilai lama, lalu tambah nilai baru
        $totalBaru = ($pinjamanKaryawan->total + $content->bayar) - $request->bayar;

        // Update PinjamanKaryawan
        $pinjamanKaryawan->update([
            'total' => $totalBaru,
        ]);

        $jurnal = JurnalUmum::where('id_content', $content->id)->first();

        if ($jurnal) {
            $jurnal->update([
                'tanggal'    => $request->tanggal,
                'keterangan' => $request->kontrak,
                'debit'      => 0,
                'kredit'     => $request->bayar,
            ]);
        }

        // Update PinjamanContent
        $content->update([
            'kontrak'  => $request->kontrak,
            'tanggal'  => $request->tanggal,
            'bayar'    => $request->bayar,
            'sisa'     => $totalBaru,
        ]);

        return redirect()->route('pinjamanTukangs.show', $pinjamanKaryawan->id)
            ->with('success', 'Data pinjaman berhasil diupdate');
    }

    public function destroy($id)
    {
        // // Ambil PinjamanContent
        // $content = PinjamanContent::findOrFail($id);

        // // Ambil PinjamanKaryawan sesuai kode_karyawan
        // $pinjamanKaryawan = PinjamanKaryawan::where('kode_karyawan', $content->kode_karyawan)
        //     ->active()
        //     ->firstOrFail();

        // // Kurangi total_pinjam dengan nilai yang dihapus
        // $totalBaru = $pinjamanKaryawan->total_pinjam - $content->bayar;

        // // Update PinjamanKaryawan
        // $pinjamanKaryawan->update([
        //     'total_pinjam' => $totalBaru,
        // ]);
        // $content->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
        // return redirect()->route('pinjamanTukangs.show', $pinjamanKaryawan->id)
        //     ->with('success', 'Data pinjaman berhasil dihapus');
    }
    public function destroyBayar($id)
    {
        // Ambil PinjamanContent
        $content = TukangContent::findOrFail($id);

        // Ambil PinjamanKaryawan sesuai kode_karyawan
        $pinjamanKaryawan = KasbonTukang::where('kode_kasbon', $content->kode_kasbon)
            ->active()
            ->firstOrFail();

        // Kurangi total_pinjam dengan nilai yang dihapus
        $totalBaru = $pinjamanKaryawan->total + $content->bayar;

        // Update PinjamanKaryawan
        $pinjamanKaryawan->update([
            'total' => $totalBaru,
        ]);
        $content->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
        return redirect()->route('pinjamanTukangs.show', $pinjamanKaryawan->id)
            ->with('success', 'Data pinjaman berhasil dihapus');
    }
}
