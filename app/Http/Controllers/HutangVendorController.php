<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\Proyek;
use App\Models\Supplier;
use App\Models\JurnalUmum;
use App\Models\HutangVendor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HutangVendorController extends Controller
{
    public function index()
    {
        $hutangVendors = HutangVendor::active()->with(['supplier', 'proyek'])->get();
        $suppliers = Supplier::active()->get();
        $proyeks   = Proyek::active()->get();
        $bank = Asset::Active()
            ->where('akun_header', 'asset_lancar_bank')
            ->where('nama_akun', '!=', 'Kas BJB')
            ->get();
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        return view('admin.hutang-vendor.data', compact('hutangVendors', 'suppliers', 'proyeks', 'bank', 'today'));
    }

    public function print()
    {
        $query = HutangVendor::active();
        $hutangVendors = $query->orderBy('tgl_hutang', 'desc')->get();
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.hutang-vendor.print', compact('hutangVendors', 'admin', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('hutang-vendor.pdf');
    }

    public function printDetail(Request $request)
    {
        $tgl_hutang = $request->tgl_hutang;
        $supplier = $request->supplier;
        $tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $nominal = $request->nominal;
        $proyek = $request->proyek;
        $keterangan = $request->keterangan;
        $status = $request->status;
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.hutang-vendor.printDetail', compact('tgl_hutang', 'supplier', 'tgl_jatuh_tempo', 'nominal', 'proyek', 'keterangan', 'status', 'admin', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'potrait');

        return $pdf->stream('detail-hutang-vendor.pdf');
    }
    /**
     * Tampilkan form create hutang vendor.
     */
    public function create()
    {
        // Ambil semua supplier & proyek aktif (tidak soft delete)
        $suppliers = Supplier::active()->get();
        $proyeks   = Proyek::active()->get();

        return view('hutang_vendor.create', compact('suppliers', 'proyeks'));
    }

    /**
     * Simpan hutang vendor baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_hutang'      => 'required|date',
            'tgl_jatuh_tempo' => 'required|date',
            'kode_supplier'   => 'required|exists:suppliers,kode_akun',
            'nominal'         => 'required|numeric',
            'kode_proyek'     => 'required|exists:proyeks,kode_akun',
            'keterangan'      => 'nullable|string',
            'created_by'      => 'nullable|string',
        ]);

        // Generate kode vendor otomatis
        $last = HutangVendor::withTrashed()->orderBy('id', 'desc')->first();
        $lastCode = $last ? $last->kode_vendor : null;
        $number   = $lastCode ? intval(substr($lastCode, 2)) + 1 : 1;
        $newCode  = 'HV' . str_pad($number, 4, '0', STR_PAD_LEFT);

        HutangVendor::create([
            'kode_vendor'     => $newCode,
            'tgl_hutang'      => $request->tgl_hutang,
            'tgl_jatuh_tempo' => $request->tgl_jatuh_tempo,
            'kode_supplier'   => $request->kode_supplier,
            'nominal'         => $request->nominal,
            'kode_proyek'     => $request->kode_proyek,
            'keterangan'      => $request->keterangan,
            'created_by'      => $request->created_by,
        ]);
        $proyek = Proyek::active()->where('kode_akun', $request->kode_proyek)->first();
        $supplier = Supplier::active()->where('kode_akun', $request->kode_supplier)->first();
        $lastId = JurnalUmum::max('id') ?? 0; // kalau soft delete
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        JurnalUmum::create([
            'detail_order' => 3,
            'kode_vendor'   => $newCode,
            'kode_jurnal'   => $kodeJurnal,
            'tanggal'       => $request->tgl_hutang,
            'kode_perkiraan' => '211',
            'kode_proyek'   => $request->kode_proyek,
            'nama_perkiraan' => 'Hutang Vendor',
            'nama_proyek'   => $proyek->nama_proyek,
            'keterangan'    => 'Hutang ke -' . $supplier->nama,
            'kategori'      => 'TF toko' ?? null,
            'debit'         => 0,
            'kredit'        => $request->nominal,
            'created_by'    => Auth::id() ?? 'system',
        ]);
        JurnalUmum::create([
            'detail_order' => 3,
            'kode_vendor'   => $newCode,
            'kode_jurnal'   => $kodeJurnal,
            'tanggal'       => $request->tgl_hutang,
            'kode_perkiraan' => '511',
            'kode_proyek'   => $request->kode_proyek,
            'nama_perkiraan' => 'Biaya Material, Alat dan Barang',
            'nama_proyek'   => $proyek->nama_proyek,
            'keterangan'    => 'Hutang ke -' . $supplier->nama,
            'kategori'      => 'TF toko' ?? null,
            'debit'         => $request->nominal,
            'kredit'        => 0,
            'created_by'    => Auth::id() ?? 'system',
        ]);

        return redirect()->route('hutang_vendor.index')->with('success', 'Hutang vendor berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit hutang vendor.
     */
    public function edit($id)
    {
        $hutangVendor = HutangVendor::withTrashed()->findOrFail($id);
        $suppliers    = Supplier::all();
        $proyeks      = Proyek::all();

        return view('hutang_vendor.edit', compact('hutangVendor', 'suppliers', 'proyeks'));
    }

    /**
     * Update hutang vendor.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_hutang'      => 'required|date',
            'tgl_jatuh_tempo' => 'required|date',
            'kode_supplier'   => 'required|exists:suppliers,kode_akun',
            'nominal'         => 'required|numeric',
            'kode_proyek'     => 'required|exists:proyeks,kode_akun',
            'keterangan'      => 'nullable|string',
            'created_by'      => 'nullable|string',
        ]);

        $hutangVendor = HutangVendor::withTrashed()->findOrFail($id);

        $hutangVendor->update([
            'tgl_hutang'      => $request->tgl_hutang,
            'tgl_jatuh_tempo' => $request->tgl_jatuh_tempo,
            'kode_supplier'   => $request->kode_supplier,
            'nominal'         => $request->nominal,
            'kode_proyek'     => $request->kode_proyek,
            'keterangan'      => $request->keterangan,
            'created_by'      => $request->created_by,
        ]);

        return redirect()->route('hutang_vendor.index')->with('success', 'Hutang vendor berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $hutangVendor = HutangVendor::findOrFail($id);

        // hapus semua jurnal terkait vendor ini
        JurnalUmum::where('kode_vendor', $hutangVendor->kode_vendor)->delete();

        // hapus hutang vendor
        $hutangVendor->delete();

        return redirect()
            ->route('hutang_vendor.index')
            ->with('success', 'Data hutang vendor dan jurnal terkait berhasil dihapus.');
    }

    public function bayar(Request $request, $id)
    {
        $request->validate([
            'tgl_bayar' => 'required|date',
            'kode_akun' => 'required|string',
        ]);

        $hutang = HutangVendor::findOrFail($id);
        $hutang->tgl_bayar = $request->tgl_bayar;
        $hutang->kode_akun = $request->kode_akun;
        $hutang->save();

        return redirect()->back()->with('success', 'Hutang vendor berhasil dibayar.');
    }
    public function generate($id)
    {
        $hutang = HutangVendor::findOrFail($id);

        // ✅ cek dulu apakah sudah ada tgl_bayar dan kode_akun
        if (empty($hutang->tgl_bayar) || empty($hutang->kode_akun)) {
            return response()->json([
                'error' => 'Anda belum membayar hutang'
            ], 400);
        }

        // update status generate
        $hutang->is_generate = true;
        $hutang->save();

        $proyek = Proyek::active()->where('kode_akun', $hutang->kode_proyek)->first();
        $kas = Asset::active()->where('kode_akun', $hutang->kode_akun)->first();
        $lastId = JurnalUmum::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        if (!$kas) {
                return redirect()->back()->with('error', 'Akun kas tidak ditemukan');
            }
            // Cek saldo cukup atau tidak
            if ($kas->saldo < $hutang->nominal) {
                return redirect()->back()->with('error', "Saldo {$kas->nama_akun} tidak mencukupi");
            }
            if ($kas) {
                // Kurangi saldo
                $kas->saldo -= $hutang->nominal;
                $kas->save();
                $modal = Asset::where('nama_akun', 'Modal')->first();
                if ($modal) {
                    if (($hutang->nominal ?? 0) > 0) {
                        $modal->saldo -= $hutang->nominal;
                    }
                    $modal->save();
                }
            }
        // buat jurnal debit hutang vendor
        JurnalUmum::create([
            'detail_order'   => 3,
            'kode_jurnal'    => $kodeJurnal,
            'tanggal'        => Carbon::now('Asia/Jakarta'),
            'kode_perkiraan' => '211',
            'kode_proyek'    => '-',
            'nama_perkiraan' => 'Hutang Vendor',
            'nama_proyek'    =>  '-',
            'keterangan'     => 'Bayar - ' . $hutang->keterangan,
            'debit'          => $hutang->nominal,
            'kredit'         => 0,
            'created_by'     => Auth::id() ?? 'system',
        ]);

        // buat jurnal kredit kas/bank
        JurnalUmum::create([
            'detail_order'   => 3,
            'kode_jurnal'    => $kodeJurnal,
            'tanggal'        => Carbon::now('Asia/Jakarta'),
            'kode_perkiraan' => $kas->kode_akun,
            'kode_proyek'    => $hutang->kode_proyek,
            'nama_perkiraan' => $kas->nama_akun,
            'nama_proyek'    => $proyek->nama_proyek ?? '-',
            'keterangan'     => 'Bayar - ' . $hutang->keterangan,
            'debit'          => 0,
            'kredit'         => $hutang->nominal,
            'created_by'     => Auth::id() ?? 'system',
        ]);

        return response()->json(['success' => true]);
    }
}
