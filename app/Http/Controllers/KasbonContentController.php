<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\JurnalUmum;
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

        // // Hitung sisa
        // $sisa = $request->bayar + $pinjamanKaryawan->total_kasbon;

        // // Update total pinjam di PinjamanKaryawan
        // $pinjamanKaryawan->update([
        //     'total_kasbon' => $sisa,
        // ]);

        // Simpan PinjamanContent
        KasbonContent::create([
            'kode_karyawan' => $pinjamanKaryawan->kode_karyawan,
            'kontrak'       => $request->kontrak,
            'tanggal'       => $request->tanggal,
            'jenis'         => 'pinjam',
            'bayar'         => $request->bayar,
            'sisa'          => 0,
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
        $sisa = $pinjamanKaryawan->total_kasbon + $request->bayar;

        // Update total pinjam di PinjamanKaryawan
        $pinjamanKaryawan->update([
            'total_kasbon' => $sisa,
        ]);

        // Simpan PinjamanContent
        $content = KasbonContent::create([
            'kode_karyawan' => $pinjamanKaryawan->kode_karyawan,
            'kontrak'       => $request->kontrak,
            'tanggal'       => $request->tanggal,
            'jenis'         => 'cicil',
            'bayar'         => $request->bayar,
            'sisa'          => $sisa,
            'setuju'        => true,
            'created_by'    => Auth::id(),
        ]);

        // ✅ Tambahkan input ke jurnal umum
        $asset = Asset::where('nama_akun', 'Piutang Karyawan')->first();

        // $proyek = Proyek::where('nama_proyek', $kasbonContent->kasbon->nama_proyek)->first();
        // generate kode jurnal J-00{id terakhir + 1}
        $lastId = JurnalUmum::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        JurnalUmum::create([
            'id_kasbon'   => $content->id, // generate kode unik
            'kode_jurnal'   => $kodeJurnal, // generate kode unik
            'tanggal'       => $request->tanggal,         // sama dengan tanggal kasbonContent
            'keterangan'    => $request->kontrak,         // isi kontrak
            'nama_perkiraan' => $asset ? $asset->nama_akun : null,
            'kode_perkiraan' => $asset ? $asset->kode_akun : null,
            'nama_proyek'   => '-',
            'kode_proyek'   =>  '-',
            'debit'         => 0,
            'kredit'        => $request->bayar,
            'created_by'    => Auth::check() ? Auth::user()->id : null,
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

        $jurnal = JurnalUmum::where('id_kasbon', $content->id)->first();

        if ($jurnal) {
            $jurnal->update([
                'tanggal'    => $request->tanggal,
                'keterangan' => $request->kontrak,
                'debit'      => 0,
                'kredit'     => $request->bayar,
            ]);
        }

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
