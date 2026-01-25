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
         if (Auth::user()->role === 'Admin 1') {
            $allowedAccounts = ['Kas Besar', 'Kas Bank BCA', 'Kas Flip', 'OVO'];

            $bank = Asset::Active()
                ->where('akun_header', 'asset_lancar_bank')
                ->whereIn('nama_akun', $allowedAccounts)
                ->where('nama_akun', '!=', 'Kas BJB')
                ->get();
        } elseif (Auth::user()->role === 'Admin 2') {
            $bank = Asset::Active()
                ->where('akun_header', 'asset_lancar_bank')
                ->where('nama_akun', '!=', 'Kas BJB')
                ->get();
        }
        return view('admin.pinjaman-karyawan.detail.form-add.kasbon', compact('pinjaman', 'today', 'bank'));
    }
    public function bayar($id)
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $pinjaman = PinjamanKaryawan::with('karyawan')->active()->findOrFail($id);
         if (Auth::user()->role === 'Admin 1') {
            $allowedAccounts = ['Kas Besar', 'Kas Bank BCA', 'Kas Flip', 'OVO'];

            $bank = Asset::Active()
                ->where('akun_header', 'asset_lancar_bank')
                ->whereIn('nama_akun', $allowedAccounts)
                ->where('nama_akun', '!=', 'Kas BJB')
                ->get();
        } elseif (Auth::user()->role === 'Admin 2') {
            $bank = Asset::Active()
                ->where('akun_header', 'asset_lancar_bank')
                ->where('nama_akun', '!=', 'Kas BJB')
                ->get();
        }
        return view('admin.pinjaman-karyawan.detail.form-add.pengembalian-kasbon', compact('pinjaman', 'today', 'bank'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_karyawan' => 'required',
            'tanggal'       => 'required|date',
            'kontrak'       => 'nullable|string',
            'bayar'         => 'required|numeric|min:0',
            'kode_kas'       => 'required',
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
            'kode_kas' => $request->kode_kas,
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
            'kode_kas' => 'required',
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
            'kode_kas' => $request->kode_kas,
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

        // update saldo di assets
        $bank = Asset::where('kode_akun', $request->kode_kas)->first();
        if ($bank) {
            if (($request->bayar ?? 0) > 0) {
                $bank->saldo += $request->bayar;
            }
            $bank->save();
        }
        // update saldo akun Modal
        $modal = Asset::where('nama_akun', 'Modal')->first();
        if ($modal) {
            if (($request->bayar ?? 0) > 0) {
                $modal->saldo += $request->bayar;
            }
            $modal->save();
        }

        JurnalUmum::create([
            'id_content'   => $content->id, // generate kode unik
            'kode_jurnal'   => $kodeJurnal, // generate kode unik
            'tanggal'       => $request->tanggal,         // sama dengan tanggal content
            'keterangan'    => $request->kontrak,         // isi kontrak
            'nama_perkiraan' => $bank ? $bank->nama_akun : null,
            'kode_perkiraan' => $request->kode_kas,
            'nama_proyek'   => '-',
            'kode_proyek'   => '-',
            'debit'         => $request->bayar,
            'kredit'        => 0,
            'created_by'    => Auth::check() ? Auth::user()->id : null,
        ]);
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

        // 🔥 Update saldo Asset (bank)
        $assetKas = Asset::where('kode_akun', $content->kode_kas)
            ->where('akun_header', 'asset_lancar_bank')
            ->first();

        if ($assetKas) {
            // rollback saldo lama
            $assetKas->saldo -= $content->bayar;

            // apply saldo baru
            $assetKas->saldo += $request->bayar;

            $assetKas->save();

            // 🔥 Update saldo Modal
            $assetModal = Asset::where('nama_akun', 'Modal')->first();

            if ($assetModal) {
                // rollback saldo lama
                $assetModal->saldo -= $content->bayar;

                // apply saldo baru
                $assetModal->saldo += $request->bayar;

                $assetModal->save();
            }
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
        $totalBaru = $pinjamanKaryawan->total_kasbon + $content->bayar;

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
        $totalBaru = $pinjamanKaryawan->total_kasbon - $content->bayar;

        // Update PinjamanKaryawan
        $pinjamanKaryawan->update([
            'total_kasbon' => $totalBaru,
        ]);
        // 🔥 Update saldo Asset (bank)
        $assetKas = Asset::where('kode_akun', $content->kode_kas)
            ->where('akun_header', 'asset_lancar_bank')
            ->first();

        if ($assetKas) {
            $assetKas->saldo -= $content->bayar;

            $assetKas->save();

            // 🔥 Update saldo Modal
            $assetModal = Asset::where('nama_akun', 'Modal')->first();

            if ($assetModal) {
                // rollback saldo lama
                $assetModal->saldo -= $content->bayar;

                $assetModal->save();
            }
        }
        $content->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
         return redirect()->route('pinjamanKaryawans.show', $pinjamanKaryawan->id)
                     ->with('success', 'Data pinjaman berhasil dihapus');
    }
}
