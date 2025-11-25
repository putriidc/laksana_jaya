<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\KasbonContent;
use App\Models\PinjamanKaryawan;
use Illuminate\Support\Facades\Auth;

class KasbonContentController extends Controller
{
    public function index()
    {
        $kasbonContents = KasbonContent::active()->get();
        return view('kasbonContents.index', compact('kasbonContents'));
    }

    public function create()
    {
        return view('kasbonContents.create');
    }
    public function pinjam($id)
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $pinjaman = PinjamanKaryawan::with('karyawan')->active()->findOrFail($id);
        return view('admin.pinjaman-karyawan.detail.form-add.kasbon', compact('pinjaman', 'today'));
    }
    public function bayar($id)
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $pinjaman = PinjamanKaryawan::with('karyawan')->active()->findOrFail($id);
        return view('admin.pinjaman-karyawan.detail.form-add.pengembalian-kasbon', compact('pinjaman', 'today'));
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
        $pinjamanKaryawan = PinjamanKaryawan::where('id', $request->kode_karyawan)->active()->firstOrFail();

        // Hitung sisa
        $sisa = $request->bayar + $pinjamanKaryawan->total_kasbon;

        // Update total pinjam di PinjamanKaryawan
        $pinjamanKaryawan->update([
            'total_kasbon' => $sisa,
        ]);

        // Simpan PinjamanContent
        KasbonContent::create([
            'kode_karyawan' => $pinjamanKaryawan->kode_karyawan,
            'kontrak'       => $request->kontrak,
            'tanggal'       => $request->tanggal,
            'jenis'         => 'pinjam',
            'bayar'         => $request->bayar,
            'sisa'          => $sisa,
            'menunggu'      => true,
            'created_by'    => Auth::id(),
        ]);

        return redirect()->route('pinjamanKaryawans.show', $pinjamanKaryawan->id)
            ->with('success', 'Data pinjaman berhasil ditambahkan');
    }
    public function storeBayar(Request $request)
    {
        $request->validate([
            'kode_karyawan' => 'required',
            'tanggal'       => 'required|date',
            'kontrak'       => 'nullable|string',
            'bayar'         => 'required|numeric|min:0',
        ]);

        // Ambil pinjaman utama
        $pinjamanKaryawan = PinjamanKaryawan::where('id', $request->kode_karyawan)->active()->firstOrFail();

        // Hitung sisa
        $sisa = $pinjamanKaryawan->total_kasbon - $request->bayar;

        // Update total pinjam di PinjamanKaryawan
        $pinjamanKaryawan->update([
            'total_kasbon' => $sisa,
        ]);

        // Simpan PinjamanContent
        KasbonContent::create([
            'kode_karyawan' => $pinjamanKaryawan->kode_karyawan,
            'kontrak'       => $request->kontrak,
            'tanggal'       => $request->tanggal,
            'jenis'         => 'cicil',
            'bayar'         => $request->bayar,
            'sisa'          => $sisa,
            'setuju'        => true,
            'created_by'    => Auth::id(),
        ]);

        return redirect()->route('pinjamanKaryawans.show', $pinjamanKaryawan->id)
            ->with('success', 'Data cicil pinjaman berhasil ditambahkan');
    }


    public function edit($id)
    {
        $content = KasbonContent::findOrFail($id);
        return view('admin.pinjaman-karyawan.detail.form-edit.kasbon', compact('content'));
    }
    public function editBayar($id)
    {
        $content = KasbonContent::findOrFail($id);
        return view('admin.pinjaman-karyawan.detail.form-edit.pengembalian-kasbon', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kontrak' => 'nullable|string',
            'bayar'   => 'required|numeric|min:0',
        ]);

        // Ambil PinjamanContent
        $content = KasbonContent::findOrFail($id);

        // Ambil PinjamanKaryawan sesuai kode_karyawan
        $pinjamanKaryawan = PinjamanKaryawan::where('kode_karyawan', $content->kode_karyawan)->active()->firstOrFail();

        // Kurangi total_kasbon dengan nilai lama, lalu tambah nilai baru
        $totalBaru = ($pinjamanKaryawan->total_kasbon - $content->bayar) + $request->bayar;

        // Update PinjamanKaryawan
        $pinjamanKaryawan->update([
            'total_kasbon' => $totalBaru,
        ]);

        // Update PinjamanContent
        $content->update([
            'kontrak'  => $request->kontrak,
            'tanggal'  => $request->tanggal,
            'bayar'    => $request->bayar,
            'sisa'     => $totalBaru,
        ]);

        return redirect()->route('pinjamanKaryawans.show', $pinjamanKaryawan->id)
            ->with('success', 'Data pinjaman berhasil diupdate');
    }
    public function updateBayar(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kontrak' => 'nullable|string',
            'bayar'   => 'required|numeric|min:0',
        ]);

        // Ambil PinjamanContent
        $content = KasbonContent::findOrFail($id);

        // Ambil PinjamanKaryawan sesuai kode_karyawan
        $pinjamanKaryawan = PinjamanKaryawan::where('kode_karyawan', $content->kode_karyawan)->active()->firstOrFail();

        // Kurangi total_kasbon dengan nilai lama, lalu tambah nilai baru
        $totalBaru = ($pinjamanKaryawan->total_kasbon + $content->bayar) - $request->bayar;

        // Update PinjamanKaryawan
        $pinjamanKaryawan->update([
            'total_kasbon' => $totalBaru,
        ]);

        // Update PinjamanContent
        $content->update([
            'kontrak'  => $request->kontrak,
            'tanggal'  => $request->tanggal,
            'bayar'    => $request->bayar,
            'sisa'     => $totalBaru,
        ]);

        return redirect()->route('pinjamanKaryawans.show', $pinjamanKaryawan->id)
            ->with('success', 'Data pinjaman berhasil diupdate');
    }

    public function destroy($id)
    {
        // Ambil PinjamanContent
        $content = KasbonContent::findOrFail($id);

        // Ambil PinjamanKaryawan sesuai kode_karyawan
        $pinjamanKaryawan = PinjamanKaryawan::where('kode_karyawan', $content->kode_karyawan)
            ->active()
            ->firstOrFail();

        // Kurangi total_kasbon dengan nilai yang dihapus
        $totalBaru = $pinjamanKaryawan->total_kasbon - $content->bayar;

        // Update PinjamanKaryawan
        $pinjamanKaryawan->update([
            'total_kasbon' => $totalBaru,
        ]);
        $content->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
         return redirect()->route('pinjamanKaryawans.show', $pinjamanKaryawan->id)
                     ->with('success', 'Data pinjaman berhasil dihapus');
    }
    public function destroyBayar($id)
    {
        // Ambil PinjamanContent
        $content = KasbonContent::findOrFail($id);

        // Ambil PinjamanKaryawan sesuai kode_karyawan
        $pinjamanKaryawan = PinjamanKaryawan::where('kode_karyawan', $content->kode_karyawan)
            ->active()
            ->firstOrFail();

        // Kurangi total_kasbon dengan nilai yang dihapus
        $totalBaru = $pinjamanKaryawan->total_kasbon + $content->bayar;

        // Update PinjamanKaryawan
        $pinjamanKaryawan->update([
            'total_kasbon' => $totalBaru,
        ]);
        $content->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
         return redirect()->route('pinjamanKaryawans.show', $pinjamanKaryawan->id)
                     ->with('success', 'Data pinjaman berhasil dihapus');
    }
}
