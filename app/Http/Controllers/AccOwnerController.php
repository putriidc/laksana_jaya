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
use App\Models\PinjamanContent;
use App\Models\PinjamanKaryawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AccOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjamans = PinjamanContent::with('karyawanPinjaman')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->get();
        $kasbons = KasbonContent::with('karyawanKasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->get();
        $contents = TukangContent::with('kasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->where('status_owner', 'pending')
            ->get();
        $contentPinjams = PinjamanContent::with('karyawanPinjaman')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->where('menunggu', true)
            ->get();
        $contentKasbons = KasbonContent::with('karyawanKasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->where('menunggu', true)
            ->get();
        return view('owner.pinjaman-karyawan.data', compact('pinjamans', 'contents', 'pinjamans', 'kasbons', 'contentKasbons', 'contentPinjams'));
    }
    public function indexTukang()
    {
        $tukangs = TukangContent::with('kasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->get();
        $contents = TukangContent::with('kasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->where('status_owner', 'pending')
            ->get();
        return view('owner.pinjaman-karyawan.dataTukang', compact('contents', 'tukangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tukang_content' => 'required',
        ]);

        $kasbonContent = TukangContent::active()->findOrFail($request->id_tukang_content);

        // Update status owner dulu
        $kasbonContent->update([
            'status_owner' => 'accept',
            'ket_owner' => 'accept',
        ]);

        // Cek apakah spv juga sudah accept
        if ($kasbonContent->status_spv === 'accept') {
            $pinjamanKaryawan = KasbonTukang::active()
                ->where('kode_kasbon', $kasbonContent->kode_kasbon)
                ->firstOrFail();

            $sisa = $kasbonContent->bayar + $pinjamanKaryawan->total;

            $pinjamanKaryawan->update([
                'total' => $sisa,
            ]);

            $kasbonContent->update([
                'sisa' => $sisa,
            ]);

            // ✅ Tambahkan input ke jurnal umum
            $asset = Asset::where('nama_akun', $kasbonContent->kasbon->nama_akun)->first();
            $bank = Asset::where('kode_akun', $kasbonContent->kode_kas)->first();
            $proyek = Proyek::where('nama_proyek', $kasbonContent->kasbon->nama_proyek)->first();
            // generate kode jurnal J-00{id terakhir + 1}
            $lastId = JurnalUmum::max('id') ?? 0;
            $nextId = $lastId + 1;
            $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            if (!$bank) {
                return redirect()->back()->with('error', 'Akun kas tidak ditemukan');
            }
            // Cek saldo cukup atau tidak
            if ($bank->saldo < $kasbonContent->bayar) {
                return redirect()->back()->with('error', "Saldo {$bank->nama_akun} tidak mencukupi");
            }
            if ($bank) {
                // Kurangi saldo
                $bank->saldo -= $kasbonContent->bayar;
                $bank->save();
                $modal = Asset::where('nama_akun', 'Modal')->first();
                if ($modal) {
                    if (($kasbonContent->bayar ?? 0) > 0) {
                        $modal->saldo -= $kasbonContent->bayar;
                    }
                    $modal->save();
                }
            }

            JurnalUmum::create([
                'id_content'   => $kasbonContent->id, // generate kode unik
                'kode_jurnal'   => $kodeJurnal, // generate kode unik
                'tanggal'       => $kasbonContent->tanggal,         // sama dengan tanggal content
                'keterangan'    => $kasbonContent->kontrak,         // isi kontrak
                'nama_perkiraan' => $kasbonContent->kasbon->nama_akun,
                'kode_perkiraan' => $asset ? $asset->kode_akun : null,
                'nama_proyek'   => $kasbonContent->kasbon->nama_proyek,
                'kode_proyek'   => $proyek ? $proyek->kode_akun : null,
                'debit'         => $kasbonContent->bayar,
                'kredit'        => 0,
                'created_by'    => Auth::check() ? Auth::user()->id : null,
            ]);
            JurnalUmum::create([
                'id_content'   => $kasbonContent->id, // generate kode unik
                'kode_jurnal'   => $kodeJurnal, // generate kode unik
                'tanggal'       => $kasbonContent->tanggal,         // sama dengan tanggal content
                'keterangan'    => $kasbonContent->kontrak,         // isi kontrak
                'nama_perkiraan' => $bank ? $bank->nama_akun : null,
                'kode_perkiraan' => $kasbonContent->kode_kas,
                'nama_proyek'   => $kasbonContent->kasbon->nama_proyek,
                'kode_proyek'   => $proyek ? $proyek->kode_akun : null,
                'debit'         => 0,
                'kredit'        => $kasbonContent->bayar,
                'created_by'    => Auth::check() ? Auth::user()->id : null,
            ]);
        }

        return redirect()->route('accowner.indexTukang')
            ->with('success', 'Status Owner berhasil disetujui');
    }
    public function storePinjam(Request $request)
    {
        $request->validate([
            'id_tukang_content' => 'required',
        ]);

        $pinjamContent = PinjamanContent::active()->findOrFail($request->id_tukang_content);

        // Update status owner dulu
        $pinjamContent->update([
            'setuju' => true,
            'menunggu' => null,
            'ket_owner' => 'accept',
        ]);

        // Cek apakah spv juga sudah accept

        $pinjamanKaryawan = PinjamanKaryawan::active()
            ->where('kode_karyawan', $pinjamContent->kode_karyawan)
            ->firstOrFail();

        // Hitung jumlah pinjaman content aktif untuk karyawan ini
        $jumlahPinjam = PinjamanContent::active()
            ->where('kode_karyawan', $pinjamContent->kode_karyawan)
            ->where(function ($q) {
                $q->whereNull('tolak')   // belum ditolak
                    ->orWhere('tolak', false); // atau explicitly false
            })
            ->count();

        // Kalau cuma satu data, anggap ini pinjaman baru
        if ($jumlahPinjam === 1) {
            $sisa = 10000000 - $pinjamContent->bayar;
        } else {
            $sisa = $pinjamanKaryawan->total_pinjam - $pinjamContent->bayar;
        }



        $pinjamanKaryawan->update([
            'total_pinjam' => $sisa,
        ]);

        $pinjamContent->update([
            'sisa' => $sisa,
        ]);

        // ✅ Tambahkan input ke jurnal umum
        $asset = Asset::where('nama_akun', 'Piutang Karyawan')->first();

        // $proyek = Proyek::where('nama_proyek', $kasbonContent->kasbon->nama_proyek)->first();
        // generate kode jurnal J-00{id terakhir + 1}
        $lastId = JurnalUmum::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        JurnalUmum::create([
            'id_pinjam'   => $pinjamContent->id, // generate kode unik
            'kode_jurnal'   => $kodeJurnal, // generate kode unik
            'tanggal'       => $pinjamContent->tanggal,         // sama dengan tanggal pinjamContent
            'keterangan'    => $pinjamContent->kontrak,         // isi kontrak
            'nama_perkiraan' => $asset ? $asset->nama_akun : null,
            'kode_perkiraan' => $asset ? $asset->kode_akun : null,
            'nama_proyek'   => '-',
            'kode_proyek'   =>  '-',
            'debit'         => $pinjamContent->bayar,
            'kredit'        => 0,
            'created_by'    => Auth::check() ? Auth::user()->id : null,
        ]);


        return redirect()->route('accowner.index')
            ->with('success', 'Status Owner berhasil disetujui');
    }
    public function storeKasbon(Request $request)
    {
        $request->validate([
            'id_tukang_content' => 'required',
        ]);

        $kasbonContent = KasbonContent::active()->findOrFail($request->id_tukang_content);

        // Update status owner dulu
        $kasbonContent->update([
            'setuju' => true,
            'menunggu' => null,
            'ket_owner' => 'accept',
        ]);

        // Cek apakah spv juga sudah accept

        $pinjamanKaryawan = PinjamanKaryawan::active()
            ->where('kode_karyawan', $kasbonContent->kode_karyawan)
            ->firstOrFail();

        // Hitung jumlah pinjaman content aktif untuk karyawan ini
        $jumlahPinjam = PinjamanContent::active()
            ->where('kode_karyawan', $kasbonContent->kode_karyawan)
            ->where(function ($q) {
                $q->whereNull('tolak')   // belum ditolak
                    ->orWhere('tolak', false); // atau explicitly false
            })
            ->count();

        // Kalau cuma satu data, anggap ini pinjaman baru
        if ($jumlahPinjam === 1) {
            $sisa = 500000 - $kasbonContent->bayar;
        } else {
            $sisa = $pinjamanKaryawan->total_kasbon - $kasbonContent->bayar;
        }

        $pinjamanKaryawan->update([
            'total_kasbon' => $sisa,
        ]);

        $kasbonContent->update([
            'sisa' => $sisa,
        ]);

        // ✅ Tambahkan input ke jurnal umum
        $asset = Asset::where('nama_akun', 'Piutang Karyawan')->first();

        // $proyek = Proyek::where('nama_proyek', $kasbonContent->kasbon->nama_proyek)->first();
        // generate kode jurnal J-00{id terakhir + 1}
        $lastId = JurnalUmum::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        JurnalUmum::create([
            'id_kasbon'   => $kasbonContent->id, // generate kode unik
            'kode_jurnal'   => $kodeJurnal, // generate kode unik
            'tanggal'       => $kasbonContent->tanggal,         // sama dengan tanggal kasbonContent
            'keterangan'    => $kasbonContent->kontrak,         // isi kontrak
            'nama_perkiraan' => $asset ? $asset->nama_akun : null,
            'kode_perkiraan' => $asset ? $asset->kode_akun : null,
            'nama_proyek'   => '-',
            'kode_proyek'   =>  '-',
            'debit'         => $kasbonContent->bayar,
            'kredit'        => 0,
            'created_by'    => Auth::check() ? Auth::user()->id : null,
        ]);


        return redirect()->route('accowner.index')
            ->with('success', 'Status Owner berhasil disetujui');
    }
    public function decline(Request $request, $id)
    {
        $pinjaman = TukangContent::findOrFail($id);

        $pinjaman->status_owner = 'decline';
        $pinjaman->ket_owner = $request->ket_owner; // ambil alasan dari input
        $pinjaman->save();

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan Kasbon Tukang berhasil ditolak'
        ]);
    }
    public function declineKR(Request $request, $id)
    {
        $pinjaman = PinjamanContent::findOrFail($id);

        $pinjaman->menunggu = null;
        $pinjaman->tolak = true;
        $pinjaman->ket_owner = $request->ket_owner; // ambil alasan dari input
        $pinjaman->save();

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan Pinjaman Karyawan berhasil ditolak'
        ]);
    }
    public function declineKS(Request $request, $id)
    {
        $pinjaman = KasbonContent::findOrFail($id);

        $pinjaman->menunggu = null;
        $pinjaman->tolak = true;
        $pinjaman->ket_owner = $request->ket_owner; // ambil alasan dari input
        $pinjaman->save();

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan Pinjaman Karyawan berhasil ditolak'
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $content = PinjamanContent::findOrFail($id);
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        return view('owner.pinjaman-karyawan.create', compact('content', 'today'));
    }
    public function editKasbon($id)
    {
        $content = KasbonContent::findOrFail($id);
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        return view('owner.pinjaman-karyawan.create-kasbon', compact('content', 'today'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kontrak' => 'required|string',
            'ket_owner' => 'nullable|string',
            'bayar'   => 'required|numeric|min:0',
        ]);

        $content = PinjamanContent::findOrFail($id);
        $pinjamanKaryawan = PinjamanKaryawan::active()
            ->where('kode_karyawan', $content->kode_karyawan)
            ->firstOrFail();
        $sisa = $request->bayar + $pinjamanKaryawan->total_pinjam;

        $pinjamanKaryawan->update([
            'total_pinjam' => $sisa,
        ]);

        $content->update([
            'tanggal' => $request->tanggal,
            'kontrak' => $request->kontrak,
            'bayar' => $request->bayar,
            'sisa' => $sisa,
            'ket_owner' => $request->ket_owner ?? 'accept dengan perubahan nominal',
            'menunggu' => null,
            'setuju' => true,
        ]);

        // ✅ Tambahkan input ke jurnal umum
        $asset = Asset::where('nama_akun', 'Piutang Karyawan')->first();
        // $proyek = Proyek::where('nama_proyek', $kasbonContent->kasbon->nama_proyek)->first();
        // generate kode jurnal J-00{id terakhir + 1}
        $lastId = JurnalUmum::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        // $proyek ? $proyek->kode_akun :
        JurnalUmum::create([
            'id_pinjam'   => $content->id, // generate kode unik
            'kode_jurnal'   => $kodeJurnal, // generate kode unik
            'tanggal'       => $content->tanggal,         // sama dengan tanggal content
            'keterangan'    => $content->kontrak,         // isi kontrak
            'nama_perkiraan' => $asset ? $asset->nama_akun : null,
            'kode_perkiraan' => $asset ? $asset->kode_akun : null,
            'nama_proyek'   => '-',
            'kode_proyek'   =>  '-',
            'debit'         => $content->bayar,
            'kredit'        => 0,
            'created_by'    => Auth::check() ? Auth::user()->id : null,
        ]);

        return redirect()->route('accowner.index')
            ->with('success', 'Pengajuan nominal berhasil diupdate');
    }
    public function updateKasbon(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kontrak' => 'required|string',
            'ket_owner' => 'nullable|string',
            'bayar'   => 'required|numeric|min:0',
        ]);

        $content = KasbonContent::findOrFail($id);
        $pinjamanKaryawan = PinjamanKaryawan::active()
            ->where('kode_karyawan', $content->kode_karyawan)
            ->firstOrFail();
        $sisa = $request->bayar + $pinjamanKaryawan->total_kasbon;

        $pinjamanKaryawan->update([
            'total_kasbon' => $sisa,
        ]);

        $content->update([
            'tanggal' => $request->tanggal,
            'kontrak' => $request->kontrak,
            'bayar' => $request->bayar,
            'sisa' => $sisa,
            'ket_owner' => $request->ket_owner ?? 'accept dengan perubahan nominal',
            'menunggu' => null,
            'setuju' => true,
        ]);

        // ✅ Tambahkan input ke jurnal umum
        $asset = Asset::where('nama_akun', 'Piutang Karyawan')->first();
        // $proyek = Proyek::where('nama_proyek', $kasbonContent->kasbon->nama_proyek)->first();
        // generate kode jurnal J-00{id terakhir + 1}
        $lastId = JurnalUmum::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        // $proyek ? $proyek->kode_akun :
        JurnalUmum::create([
            'id_kasbon'   => $content->id, // generate kode unik
            'kode_jurnal'   => $kodeJurnal, // generate kode unik
            'tanggal'       => $content->tanggal,         // sama dengan tanggal content
            'keterangan'    => $content->kontrak,         // isi kontrak
            'nama_perkiraan' => $asset ? $asset->nama_akun : null,
            'kode_perkiraan' => $asset ? $asset->kode_akun : null,
            'nama_proyek'   => '-',
            'kode_proyek'   =>  '-',
            'debit'         => $content->bayar,
            'kredit'        => 0,
            'created_by'    => Auth::check() ? Auth::user()->id : null,
        ]);

        return redirect()->route('accowner.index')
            ->with('success', 'Pengajuan nominal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
