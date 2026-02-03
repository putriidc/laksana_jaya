<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\Proyek;
use App\Models\JurnalUmum;
use App\Models\Karyawan;
use App\Models\KasbonTukang;
use Illuminate\Http\Request;
use App\Models\KasbonContent;
use App\Models\TukangContent;
use App\Models\PinjamanContent;
use App\Models\PinjamanKaryawan;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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
            $bank = Asset::where('kode_akun', $kasbonContent->kode_kas)->first();
            if (!$bank) {
                return redirect()->back()->with('error', 'Akun kas tidak ditemukan');
            }
            // hitung saldo dari jurnal
            $debit  = JurnalUmum::active()->where('nama_perkiraan', $bank->nama_akun)->sum('debit');
            $kredit = JurnalUmum::active()->where('nama_perkiraan', $bank->nama_akun)->sum('kredit');


            $saldo =  $debit - $kredit;
            if ($saldo < $kasbonContent->bayar) {
                return redirect()->back()->with('error', "Saldo {$bank->nama_akun} tidak mencukupi");
            }
            if ($bank) {
                // Kurangi saldo
                $bank->saldo -= $kasbonContent->bayar;
                $bank->save();
            }
            $sisa = $kasbonContent->bayar + $pinjamanKaryawan->total;

            $pinjamanKaryawan->update([
                'total' => $sisa,
            ]);

            $kasbonContent->update([
                'sisa' => $sisa,
            ]);

            // ✅ Tambahkan input ke jurnal umum
            $asset = Asset::where('nama_akun', $kasbonContent->kasbon->nama_akun)->first();

            $proyek = Proyek::where('nama_proyek', $kasbonContent->kasbon->nama_proyek)->first();
            // generate kode jurnal J-00{id terakhir + 1}
            $lastId = JurnalUmum::max('id') ?? 0;
            $nextId = $lastId + 1;
            $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);



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
                'created_by'    => $kasbonContent->created_by,
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
                'created_by'    => $kasbonContent->created_by,
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
        $bank = Asset::where('kode_akun', $pinjamContent->kode_kas)->first();
        if (!$bank) {
            return redirect()->back()->with('error', 'Akun kas tidak ditemukan');
        }
        // hitung saldo dari jurnal
        $debit  = JurnalUmum::active()->where('nama_perkiraan', $bank->nama_akun)->sum('debit');
        $kredit = JurnalUmum::active()->where('nama_perkiraan', $bank->nama_akun)->sum('kredit');


        $saldo =  $debit - $kredit;
        if ($saldo < $pinjamContent->bayar) {
            return redirect()->back()->with('error', "Saldo {$bank->nama_akun} tidak mencukupi");
        }
        if ($bank) {
            // Kurangi saldo
            $bank->saldo -= $pinjamContent->bayar;
            $bank->save();
        }

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
            'created_by'    => $pinjamContent->created_by,
        ]);

        JurnalUmum::create([
            'id_content'   => $pinjamContent->id, // generate kode unik
            'kode_jurnal'   => $kodeJurnal, // generate kode unik
            'tanggal'       => $pinjamContent->tanggal,         // sama dengan tanggal content
            'keterangan'    => $pinjamContent->kontrak,         // isi kontrak
            'nama_perkiraan' => $bank ? $bank->nama_akun : null,
            'kode_perkiraan' => $pinjamContent->kode_kas,
            'nama_proyek'   => '-',
            'kode_proyek'   => '-',
            'debit'         => 0,
            'kredit'        => $pinjamContent->bayar,
            'created_by'    => $pinjamContent->created_by,
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
        $bank = Asset::where('kode_akun', $kasbonContent->kode_kas)->first();
        if (!$bank) {
            return redirect()->back()->with('error', 'Akun kas tidak ditemukan');
        }
        // hitung saldo dari jurnal
        $debit  = JurnalUmum::active()->where('nama_perkiraan', $bank->nama_akun)->sum('debit');
        $kredit = JurnalUmum::active()->where('nama_perkiraan', $bank->nama_akun)->sum('kredit');


        $saldo =  $debit - $kredit;
        if ($saldo < $kasbonContent->bayar) {
            return redirect()->back()->with('error', "Saldo {$bank->nama_akun} tidak mencukupi");
        }
        if ($bank) {
            // Kurangi saldo
            $bank->saldo -= $kasbonContent->bayar;
            $bank->save();
        }

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
        $jumlahPinjam = KasbonContent::active()
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
            'created_by'    => $kasbonContent->created_by,
        ]);
        JurnalUmum::create([
            'id_content'   => $kasbonContent->id, // generate kode unik
            'kode_jurnal'   => $kodeJurnal, // generate kode unik
            'tanggal'       => $kasbonContent->tanggal,         // sama dengan tanggal content
            'keterangan'    => $kasbonContent->kontrak,         // isi kontrak
            'nama_perkiraan' => $bank ? $bank->nama_akun : null,
            'kode_perkiraan' => $kasbonContent->kode_kas,
            'nama_proyek'   => '-',
            'kode_proyek'   => '-',
            'debit'         => 0,
            'kredit'        => $kasbonContent->bayar,
            'created_by'    => $kasbonContent->created_by,
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
    // public function show(string $id)
    // {
    //     //
    // }

    public function printPinjaman()
    {
        $pinjamans = DB::table('pinjaman_contents')
            // Join ke tabel perantara (karyawan_pinjamans)
            ->join('karyawans', 'pinjaman_contents.kode_karyawan', '=', 'karyawans.kode_karyawan')
            ->select(
                'pinjaman_contents.*',
                'karyawans.nama as nama_karyawan' // Kita ambil namanya saja
            )
            ->whereNull('pinjaman_contents.deleted_at')
            ->orderBy('pinjaman_contents.tanggal', 'desc')
            ->get();

        $owner = Auth::user()->name ?? 'Rian';
        $role = Auth::user()->role ?? 'owner';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('owner.pinjaman-karyawan.printPinjaman', compact('pinjamans', 'owner', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Pinjaman-Karyawan.pdf');
    }
    public function printKasbon()
    {
        $kasbons = DB::table('kasbon_contents')
            // Join ke tabel perantara (karyawan_kasbons)
            ->join('karyawans', 'kasbon_contents.kode_karyawan', '=', 'karyawans.kode_karyawan')
            ->select(
                'kasbon_contents.*',
                'karyawans.nama as nama_karyawan' // Kita ambil namanya saja
            )
            ->whereNull('kasbon_contents.deleted_at')
            ->orderBy('kasbon_contents.tanggal', 'desc')
            ->get();

        $owner = Auth::user()->name ?? 'Rian';
        $role = Auth::user()->role ?? 'owner';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('owner.pinjaman-karyawan.printKasbon', compact('kasbons', 'owner', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Kasbon-Karyawan.pdf');
    }
    public function printKasbonTukang()
    {
        $kasbons = DB::table('tukang_contents')
            // Join ke tabel perantara (karyawan_kasbons)
            ->join('kasbon_tukangs', 'tukang_contents.kode_kasbon', '=', 'kasbon_tukangs.kode_kasbon')
            ->select(
                'tukang_contents.*',
                'kasbon_tukangs.nama_tukang as nama_tukang' // Kita ambil namanya saja
            )
            ->whereNull('tukang_contents.deleted_at')
            ->orderBy('tukang_contents.tanggal', 'desc')
            ->get();

        $owner = Auth::user()->name ?? 'Rian';
        $role = Auth::user()->role ?? 'owner';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('owner.pinjaman-karyawan.printKasbonTukang', compact('kasbons', 'owner', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Pinjaman-Tukang.pdf');
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
