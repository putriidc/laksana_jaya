<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Proyek;
use App\Models\JurnalUmum;
use App\Models\KasbonTukang;
use Illuminate\Http\Request;
use App\Models\TukangContent;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AccTukangSpvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjamans = TukangContent::with('kasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->get();
        $contents = TukangContent::with('kasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->where('status_spv', 'pending')
            ->get();
        return view('kepala-gudang.pinjaman-karyawan.data', compact('pinjamans', 'contents'));
    }

    public function print()
    {
        $pinjamans = TukangContent::with('kasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->get();
        $contents = TukangContent::with('kasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->where('status_spv', 'pending')
            ->get();

        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('kepala-gudang.pinjaman-karyawan.print', compact('pinjamans', 'jamCetak', 'contents', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("PinjamanKaryawan.pdf");
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

        // Update status SPV dulu
        $kasbonContent->update([
            'status_spv' => 'accept',
            'ket_spv' => 'accept',
        ]);

        // Cek apakah Owner juga sudah accept
        if ($kasbonContent->status_owner === 'accept') {
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

        return redirect()->route('accspv.index')
            ->with('success', 'Status SPV berhasil disetujui');
    }

    public function decline(Request $request, $id)
    {
        $pinjaman = TukangContent::findOrFail($id);

        $pinjaman->status_spv = 'decline';
        $pinjaman->ket_spv = $request->ket_spv; // ambil alasan dari input
        $pinjaman->save();

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil ditolak'
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
