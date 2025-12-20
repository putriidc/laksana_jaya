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
use Illuminate\Support\Facades\Auth;

class EafController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eaf = Eaf::whereNull('deleted_at')->get();
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $proyek = Proyek::whereNull('deleted_at')
            ->get();
        $bank = Asset::Active()
            ->where('akun_header', 'asset_lancar_bank')
            ->get();
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
        $akun = Asset::Active()
            ->whereIn('nama_akun', [
                'Piutang Proyek',
                'Biaya Material Alat dan Barang',
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
        $bank = Asset::Active()
            ->where('akun_header', 'asset_lancar_bank')
            ->get();
        // Kirim ke view detail
        return view('admin.form-eaf.detail', compact('eaf', 'today', 'akun', 'bank'));
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
            'debit'      => 'nullable|numeric|min:0',
            'kredit'     => 'nullable|numeric|min:0',
        ]);

        // Simpan data rincian
        EafDetail::create([
            'kode_eaf'   => $request->kode_eaf,
            'tanggal'    => $request->tanggal,
            'keterangan'    => $request->keterangan,
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
        $eaf = Eaf::with('details')->findOrFail($id);

        $proyek = Proyek::whereNull('deleted_at')
            ->where('nama_proyek', $eaf->nama_proyek)
            ->firstOrFail();

        // Loop semua detail, termasuk baris pertama
        foreach ($eaf->details as $index => $detail) {

            // Tentukan kode/nama proyek
            $kodeProyek = $index === 0 ? '-' : $proyek->kode_akun;
            $namaProyek = $index === 0 ? '-' : $proyek->nama_proyek;

            // generate kode jurnal J-00{id terakhir + 1}
            $lastId = JurnalUmum::max('id') ?? 0;
            $nextId = $lastId + 1;
            $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            // Insert ke jurnal umum
            JurnalUmum::create([
                'kode_jurnal'     => $kodeJurnal,
                'tanggal'     => $detail->tanggal,
                'kode_perkiraan'   => $detail->kode_akun,
                'kode_proyek' => $kodeProyek,
                'nama_perkiraan'   => $detail->nama_akun,
                'nama_proyek' => $namaProyek,
                'keterangan'  => $detail->keterangan,
                'debit'       => $detail->debit,
                'kredit'      => $detail->kredit,
                'created_by'  => Auth::user()->id ?? 'system',
            ]);

            // Update flag is_generate di EafDetail
            $detail->update(['is_generate' => true]);
        }

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
