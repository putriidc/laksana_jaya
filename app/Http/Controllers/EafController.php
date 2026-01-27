<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Eaf;
use App\Models\Asset;
use App\Models\Proyek;
use App\Models\EafDetail;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use App\Models\PiutangHutang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class EafController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eaf = Eaf::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $proyek = Proyek::whereNull('deleted_at')
            ->get();
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
        return view('admin.form-eaf.form', compact('eaf', 'today', 'proyek', 'bank'));
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
            'tanggal'      => 'required|date',
            'nama_proyek'  => 'required|string',
            'pic'          => 'required|string',
            'keterangan'          => 'required|string',
            'kas'          => 'required|string',
            'nominal'      => 'required|numeric|min:1',
            'detail_biaya' => 'nullable|string',
        ]);

        $existingEaf = Eaf::where('nama_proyek', $request->nama_proyek)
            ->whereNull('deleted_at')
            ->latest()
            ->first();

        $hasPending = false;

        if ($existingEaf) {
            $hasPending = EafDetail::where('kode_eaf', $existingEaf->kode_eaf)
                ->where('is_generate', 0)
                ->whereNull('deleted_at')
                ->exists();
        }

        if ($existingEaf && $hasPending) {
            return redirect()->back()->with('error', 'Tidak bisa ajukan EAF baru, masih ada detail yang belum digenerate.');
        }



        $kodeEaf = 'EAF-' . Carbon::now('Asia/Jakarta')->format('YmdHis');

        Eaf::create([
            'kode_eaf'     => $kodeEaf,
            'tanggal'      => $request->tanggal,
            'nama_proyek'  => $request->nama_proyek,
            'pic'          => $request->pic,
            'keterangan'   => $request->keterangan,
            'kas'   => $request->kas,
            'nominal'      => $request->nominal,
            'acc_owner'    => 'pending',
            'acc_spv'      => 'pending',
            'ket_owner'    => 'pending',
            'ket_spv'      => 'pending',
            'detail_biaya' => $request->detail_biaya,
            'created_by'   => Auth::user()->name ?? 'system',
        ]);

        return redirect()->route('eaf.index')
            ->with('success', 'Data EAF berhasil disimpan dengan kode ' . $kodeEaf);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data EAF berdasarkan id
        $eaf = Eaf::with('details')->findOrFail($id);
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $tanggalDetail = optional($eaf->details->first())->tanggal;
        $hariIni = Carbon::now('Asia/Jakarta')->toDateString();
        $besok = Carbon::now('Asia/Jakarta')->subDay()->toDateString();
        $akun = Asset::Active()
            ->whereIn('nama_akun', [
                'Piutang Proyek',
                'Biaya Material, Alat dan Barang',
                'Biaya Gaji Tukang & pengawas lapangan',
                'Biaya Sewa Alat Berat',
                'Biaya Listrik,air, telphon dan Internet',
                'Biaya Infaq dan sumbangan',
                'Biaya Operasional Lainnya',
                'Biaya Alat tulis kantor',
                'Biaya Sewa Gedung Kantor',
                'Biaya Jilid dan Keperluan Product',
                'Pajak'
            ])
            ->get();
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
        // Kirim ke view detail
        return view('admin.form-eaf.detail', compact('eaf', 'today', 'akun', 'bank', 'detailTanggal', 'hariIni', 'besok'));
    }

    public function printDetail($id)
    {
        // Ambil data EAF berdasarkan id
        $eaf = Eaf::with('details')->findOrFail($id);
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $akun = Asset::Active()
            ->whereIn('nama_akun', [
                'Piutang Proyek',
                'Biaya Material, Alat dan Barang',
                'Biaya Gaji Tukang & pengawas lapangan',
                'Biaya Sewa Alat Berat',
                'Biaya Listrik,air, telphon dan Internet',
                'Biaya Infaq dan sumbangan',
                'Biaya Operasional Lainnya',
                'Biaya Alat tulis kantor',
                'Biaya Sewa Gedung Kantor',
                'Biaya Jilid dan Keperluan Product',
                'Pajak'
            ])
            ->get();
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
        // Kirim ke view detail
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.form-eaf.printDetail', compact('eaf', 'today', 'bank', 'admin', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Rincian-eaf.pdf');
    }

    public function print($id)
    {
        $eaf = Eaf::where('id', $id)
            ->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $proyek = Proyek::whereNull('deleted_at')
            ->get();
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

        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.form-eaf.print', compact('eaf', 'today', 'proyek', 'bank', 'admin', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('pengajuan-eaf.pdf');
    }

    public function storeDetail(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kode_eaf'   => 'required|exists:eaf,kode_eaf',
            'tanggal'    => 'required|date',
            'kode_akun'  => 'required|string',
            'nama_akun'  => 'required|string',
            'keterangan' => 'nullable|string',
            'kategori' => 'nullable|string',
            'debit'      => 'nullable|numeric|min:0',
            'kredit'     => 'nullable|numeric|min:0',
        ]);

        // Simpan data rincian
        EafDetail::create([
            'kode_eaf'   => $request->kode_eaf,
            'tanggal'    => $request->tanggal,
            'keterangan'    => $request->keterangan,
            'kategori'    => $request->kategori,
            'kode_akun'  => $request->kode_akun,
            'nama_akun'  => $request->nama_akun,
            'debit'      => $request->debit ?? 0,
            'kredit'     => $request->kredit ?? 0,
            'is_generate' => false,
            'created_by' => Auth::user()->id ?? 'system',
        ]);

        return redirect()->route('eaf.show', $id)
            ->with('success', 'Rincian EAF berhasil ditambahkan');
    }

    public function generate(Request $request, $id)
    {
        DB::transaction(function () use ($id) {
            $eaf = Eaf::with('details')->findOrFail($id);

            $proyek = Proyek::whereNull('deleted_at')
                ->where('nama_proyek', $eaf->nama_proyek)
                ->firstOrFail();

            // Hapus dulu jurnal yang sudah ada dari EAF ini
            JurnalUmum::whereIn('detail_eaf_id', $eaf->details->pluck('id'))
                ->delete(); // kalau pakai softDeletes, ini otomatis soft delete

            $assetBank = Asset::where('akun_header', 'asset_lancar_bank')->firstOrFail();
            $assetModal = Asset::where('nama_akun', 'Modal')->firstOrFail();
            // Loop semua detail
            foreach ($eaf->details as $index => $detail) {
                $kodeProyek = $index === 0 ? '-' : $proyek->kode_akun;
                $namaProyek = $index === 0 ? '-' : $proyek->nama_proyek;

                // cek apakah akun detail sama dengan asset bank
                if ($detail->kode_akun === $assetBank->kode_akun) {
                    if ($assetBank->saldo < $detail->kredit) {
                        // saldo tidak cukup → batalkan transaksi
                        return redirect()->back()->with('error', "Saldo {$assetBank->nama_akun} tidak mencukupi");
                    }
                    if ($detail->debit == 0) {
                        // keluar uang → kurangi saldo & modal
                        $assetBank->decrement('saldo', $detail->kredit);
                        $assetModal->decrement('saldo', $detail->kredit);
                    } elseif ($detail->kredit == 0) {
                        // masuk uang → tambah saldo & modal
                        $assetBank->increment('saldo', $detail->debit);
                        $assetModal->increment('saldo', $detail->debit);
                    }
                }

                $lastId = JurnalUmum::max('id') ?? 0; // kalau soft delete
                $nextId = $lastId + 1;
                $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

                JurnalUmum::create([
                    'detail_eaf_id' => $detail->id,
                    'detail_order' => $index + 1,
                    'kode_jurnal'   => $kodeJurnal,
                    'tanggal'       => $detail->tanggal,
                    'kode_perkiraan' => $detail->kode_akun,
                    'kode_proyek'   => $kodeProyek,
                    'nama_perkiraan' => $detail->nama_akun,
                    'nama_proyek'   => $namaProyek,
                    'keterangan'    => $detail->keterangan,
                    'kategori'      => $detail->kategori ?? null,
                    'debit'         => $detail->debit,
                    'kredit'        => $detail->kredit,
                    'created_by'    => Auth::id() ?? 'system',
                ]);

                $detail->update(['is_generate' => true]);
            }
        });

        return redirect()->route('eaf.show', $id)
            ->with('success', 'Data berhasil digenerate ke jurnal umum');
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
    public function destroy($id)
    {

        $detail = EafDetail::findOrFail($id);

        $eaf = Eaf::whereNull('deleted_at')
            ->where('kode_eaf', $detail->kode_eaf)
            ->firstOrFail();

        $detail->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);

        return redirect()->route('eaf.show', $eaf->id)
            ->with('success', 'Rincian EAF berhasil dihapus');
    }
}
