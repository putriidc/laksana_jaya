<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\Proyek;
use App\Models\Progres;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use App\Models\KontrakProyek;
use App\Models\DataPerusahaan;
use Illuminate\Support\Facades\Auth;

class ProyekOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // tangkap kategori dari query string
        $kategori = $request->input('kategori');

        // filter berdasarkan kategori
        $proyeks = Proyek::where('kategori', $kategori)
            ->whereNull('deleted_at')
            ->orderBy('nama_perusahaan')
            ->get()
            ->groupBy('nama_perusahaan');

        return view('owner.data-proyek.proyek.data', compact('proyeks', 'kategori'));
    }
    public function indexManage(Request $request)
    {


        $kontrak = KontrakProyek::whereNull('deleted_at')
            ->get();

        return view('owner.management.data', compact('kontrak'));
    }
    public function indexResume(Request $request)
    {
        $proyeks = Proyek::all();
        $assetBankAccounts = Asset::where('akun_header', 'asset_lancar_bank')->pluck('nama_akun');
        $resume = $proyeks->map(function ($proyek) use ($assetBankAccounts) {
            $jurnal = JurnalUmum::where('nama_proyek', $proyek->nama_proyek)->where('nama_perkiraan', '!=', 'Piutang Proyek')->whereNotIn('nama_perkiraan', $assetBankAccounts)->get();
            $totalPengeluaran = $jurnal->sum('debit');
            $piutangVendor = 0;
            $kontrak = KontrakProyek::where('kode_proyek', $proyek->kode_akun)->first();
            $net = $kontrak->net ?? 0;

            $dataPerusahaan = DataPerusahaan::whereNull('deleted_at')->where('nama_paket', $proyek->nama_proyek)->first();

            // Ambil semua progres yang terkait dengan kode_paket
            $progres = Progres::where('kode_paket', $dataPerusahaan->kode_paket)
                ->whereNull('deleted_at')
                ->orderBy('minggu', 'asc')
                ->get();

            // Hitung total progres (maksimal 100%)
            $totalProgress = $progres->sum('persen');
            if ($totalProgress > 100) {
                $totalProgress = 100;
            }
            return [
                'nama_proyek' => $proyek->nama_proyek,
                'nilai_kontrak' => $proyek->nilai_kontrak,
                'tgl_mulai' => $proyek->tgl_mulai,
                'jenis_proyek' => $proyek->jenis ?? '-',
                'total_pengeluaran' => $totalPengeluaran,
                'piutang_vendor' => $piutangVendor,
                'total_tp_pv' => $totalPengeluaran + $piutangVendor,
                'persentase' => $net > 0 ? ($totalPengeluaran / $net) * 100 : 0,
                'sisa' => $net - $totalPengeluaran,
                'net' => $net,
                'total_progres' => $totalProgress ?? 0,
            ];
        });

        return view('owner.resume.data', compact('resume'));
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
    public function storeKontrak(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_proyek'        => 'required|string',
                'nama_proyek'        => 'required|string',
                'nilai_kontrak'      => 'required|integer|min:0',
                'dpp'                => 'required|integer|min:0',
                'ppn_persen'         => 'required|numeric|min:0',
                'ppn'                => 'required|integer|min:0',
                'pph'                => 'nullable|integer|min:0',
                'pph_persen' => 'required|numeric|min:0',
                'sisa_potong_pajak'  => 'required|integer|min:0',
                'fee_dinas_persen'   => 'required|numeric|min:0',
                'fee_dinas'          => 'required|integer|min:0',
                'net_persen'         => 'required|numeric|min:0',
                'net'                => 'required|integer|min:0',
                'keuntungan'         => 'required|integer|min:0',
                'real_untung'        => 'required|integer|min:0',
            ]);

            $validated['created_by'] = Auth::id();

            KontrakProyek::create($validated);

            return redirect()->back()->with('success', 'Data kontrak berhasil disimpan.');
        } catch (\Throwable $e) { // kirim pesan error ke session return
            redirect()->back()->with('error', 'Gagal menyimpan kontrak: ' . $e->getMessage());
        }
    }

    public function updateKontrak(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'kode_proyek'        => 'required|string',
                'nama_proyek'        => 'required|string',
                'nilai_kontrak'      => 'required|integer|min:0',
                'dpp'                => 'required|integer|min:0',
                'ppn_persen'         => 'required|numeric|min:0',
                'ppn'                => 'required|integer|min:0',
                'pph'                => 'nullable|integer|min:0',
                'pph_persen'         => 'required|numeric|min:0',
                'sisa_potong_pajak'  => 'required|integer|min:0',
                'fee_dinas_persen'   => 'required|numeric|min:0',
                'fee_dinas'          => 'required|integer|min:0',
                'net_persen'         => 'required|numeric|min:0',
                'net'                => 'required|integer|min:0',
                'keuntungan'         => 'required|integer|min:0',
                'real_untung'        => 'required|integer|min:0',
            ]);

            $validated['created_by'] = Auth::id();

            $kontrak = KontrakProyek::findOrFail($id);
            $kontrak->update($validated);

            return redirect()->back()->with('success', 'Data kontrak berhasil diperbarui.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui kontrak: ' . $e->getMessage());
        }
    }

    function ProyekSelesai(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|integer|exists:kontrak_proyeks,id',
            ]);


            $manag = KontrakProyek::findOrFail($validated['id']);

            $lastId = JurnalUmum::max('id') ?? 0;
            $nextId = $lastId + 1;
            $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            $today = Carbon::now('Asia/Jakarta')->toDateString();





            JurnalUmum::create([
                'kode_jurnal'   => $kodeJurnal,
                'detail_order' => 3,
                'tanggal'       => $today,
                'kode_perkiraan' => '122',
                'nama_perkiraan' => 'Piutang Kontrak',
                'keterangan'    => 'Pendapatan Proyek'. $manag->nama_proyek,
                'nama_proyek'   => $manag->nama_proyek,
                'kode_proyek'   => $manag->kode_proyek,
                'debit'         => 0,
                'kredit'        => $manag->real_untung,
                'created_by'    => 'owner',
            ]);


            JurnalUmum::create([
                'kode_jurnal'   => $kodeJurnal,
                'detail_order' => 3,
                'tanggal'       => $today,
                'kode_perkiraan' => '410',
                'nama_perkiraan' => 'Pendapatan Proyek Fisik',
                'keterangan'    => 'Pendapatan Proyek'. $manag->nama_proyek,
                'nama_proyek'   => $manag->nama_proyek,
                'kode_proyek'   => $manag->kode_proyek,
                'debit'         => $manag->real_untung,
                'kredit'        => 0,
                'created_by'    => 'owner',
            ]);

            $manag->update(['is_generate' => true]);
            return redirect()->back()->with('success', 'Data kontrak berhasil diperbarui.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui kontrak: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proyek = Proyek::with('kontrak')->findOrFail($id);

        // ambil semua nama akun dari Asset dengan akun_header = asset_lancar_bank
        $assetBankAccounts = Asset::where('akun_header', 'asset_lancar_bank')
            ->pluck('nama_akun'); // ambil nama_akun, bisa juga kode_akun kalau mau

        $jurnal = JurnalUmum::where('nama_proyek', $proyek->nama_proyek)
            ->where('nama_perkiraan', '!=', 'Piutang Proyek')
            ->whereNotIn('nama_perkiraan', $assetBankAccounts)
            ->orderBy('tanggal', 'desc')
            ->get();
        $totalDebit = $jurnal->sum('debit');

        return view('owner.data-proyek.proyek.detail', compact('proyek', 'jurnal', 'totalDebit'));
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
