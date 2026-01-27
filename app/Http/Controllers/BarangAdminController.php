<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\barangRetur;
use App\Models\BarangKeluar;
use App\Models\CatatStokBarang;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::active();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        $barangs = $query->get();

        return view('admin.data-barang.data', compact('barangs'));
    }

    public function print(Request $request) {
         $query = Barang::active();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        $barangs = $query->get();
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.data-barang.print', compact('barangs', 'jamCetak', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("Data Barang.pdf");
    }


    public function create()
    {
        return view('admin.data-barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori'    => 'nullable|string|max:255',
            'spesifikasi' => 'nullable|string',
            'satuan'      => 'nullable|string',
            'stok'        => 'nullable|integer|min:0',
            'foto'        => 'nullable|image',
        ]);

        // Ambil kode_barang terakhir, termasuk data yang sudah di soft delete
        $lastBarang = Barang::withTrashed()->latest('id')->first();

        if (!$lastBarang) {
            $nomorUrut = 1;
        } else {
            // Mengambil angka dari string 'KB-001' -> menjadi 1
            $lastKode = $lastBarang->kode_barang;
            $nomorUrut = (int) substr($lastKode, 3) + 1;
        }

        // Str::padLeft digunakan agar format tetap 001, 002, dst (misal: KB-0010)
        $kodeBarang = 'KB-' . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('barang', 'public');
        }
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        Barang::create([
            'tanggal'     => $today,
            'kode_barang' => $kodeBarang,
            'nama_barang' => $request->nama_barang,
            'kategori'    => $request->kategori,
            'spesifikasi' => $request->spesifikasi,
            'satuan'      => $request->satuan,
            'stok'        => $request->stok ?? 0,
            'foto'        => $fotoPath,
            'created_by'  => Auth::check() ? Auth::user()->id : null,
        ]);

        return redirect()->route('barangsAdmin.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function show(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $catatStok = CatatStokBarang::where('kode_barang', $barang->kode_barang)->latest()->get();

        // Barang Masuk
        $queryMasuk = BarangMasuk::with('barang')
            ->where('kode_barang', $barang->kode_barang)
            ->whereNull('deleted_at');

        if ($request->filled('start_masuk') && $request->filled('end_masuk')) {
            $queryMasuk->whereBetween('tanggal', [$request->start_masuk, $request->end_masuk]);
        }
        $barangMasuks = $queryMasuk->get();

        // Barang Keluar
        $queryKeluar = BarangKeluar::with('barang')
            ->where('kode_barang', $barang->kode_barang)
            ->whereNull('deleted_at');

        if ($request->filled('start_keluar') && $request->filled('end_keluar')) {
            $queryKeluar->whereBetween('tanggal', [$request->start_keluar, $request->end_keluar]);
        }
        $barangKeluars = $queryKeluar->get();

        // Barang Retur
        $queryRetur = BarangRetur::with('barang')
            ->where('kode_barang', $barang->kode_barang)
            ->whereNull('deleted_at');

        if ($request->filled('start_retur') && $request->filled('end_retur')) {
            $queryRetur->whereBetween('tanggal', [$request->start_retur, $request->end_retur]);
        }
        $barangReturs = $queryRetur->get();
        $proyeks = Proyek::whereNull('deleted_at')->get();

        return view('admin.detail-barang.index', compact(
            'barang',
            'proyeks',
            'catatStok',
            'barangMasuks',
            'barangKeluars',
            'barangReturs'
        ));
    }

    public function printMasuk(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $query = BarangMasuk::with('barang')
            ->where('kode_barang', $barang->kode_barang)
            ->whereNull('deleted_at');

        if ($request->filled('start_masuk') && $request->filled('end_masuk')) {
            $query->whereBetween('tanggal', [$request->start_masuk, $request->end_masuk]);
        }

        $barangMasuks = $query->orderBy('tanggal', 'desc')->get();
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');
        $proyeks = Proyek::whereNull('deleted_at')->get();

        $pdf = Pdf::loadView('admin.detail-barang.printIn', compact('barang', 'proyeks', 'jamCetak', 'barangMasuks', 'admin', 'role', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("BarangMasuk_{$barang->nama_barang}.pdf");
    }

    public function printDetailMasuk(request $request)
    {
        $tanggal = $request->tanggal;
        $qty = $request->qty;
        $keterangan = $request->keterangan;
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.detail-barang.printDetailMasuk', compact('tanggal', 'qty', 'keterangan', 'admin', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'potrait');

        return $pdf->stream('Transaksi Barang Masuk.pdf');
    }

    public function printKeluar(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $query = BarangKeluar::with('barang')
            ->where('kode_barang', $barang->kode_barang)
            ->whereNull('deleted_at');

        if ($request->filled('start_keluar') && $request->filled('end_keluar')) {
            $query->whereBetween('tanggal', [$request->start_keluar, $request->end_keluar]);
        }

        $barangKeluars = $query->orderBy('tanggal', 'desc')->get();
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');
        $proyeks = Proyek::whereNull('deleted_at')->get();

        $pdf = Pdf::loadView('admin.detail-barang.printOut', compact('barang', 'proyeks', 'jamCetak', 'barangKeluars', 'admin', 'role', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("BarangKeluar_{$barang->nama_barang}.pdf");
    }

    public function printDetailKeluar(request $request)
    {
        $tanggal = $request->tanggal;
        $proyek = $request->proyek;
        $pic = $request->pic;
        $qty = $request->qty;
        $keterangan = $request->keterangan;
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.detail-barang.printDetailKeluar', compact('tanggal', 'proyek', 'pic', 'qty', 'keterangan', 'admin', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'potrait');

        return $pdf->stream('Transaksi Barang Masuk.pdf');
    }

    public function printRetur(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $query = BarangRetur::with('barang')
            ->where('kode_barang', $barang->kode_barang)
            ->whereNull('deleted_at');

        if ($request->filled('start_retur') && $request->filled('end_retur')) {
            $query->whereBetween('tanggal', [$request->start_retur, $request->end_retur]);
        }

        $barangReturs = $query->orderBy('tanggal', 'desc')->get();
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');
        $proyeks = Proyek::whereNull('deleted_at')->get();

        $pdf = Pdf::loadView('admin.detail-barang.printRtr', compact('barang', 'proyeks', 'jamCetak', 'barangReturs', 'admin', 'role', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("BarangRetur_{$barang->nama_barang}.pdf");
    }

    public function printDetailRetur(request $request)
    {
        $tanggal = $request->tanggal;
        $proyek = $request->proyek;
        $pic = $request->pic;
        $qty = $request->qty;
        $keterangan = $request->keterangan;
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.detail-barang.printDetailRetur', compact('tanggal', 'proyek', 'pic', 'qty', 'keterangan', 'admin', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'potrait');

        return $pdf->stream('Transaksi Barang Retur.pdf');
    }


    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.data-barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori'    => 'nullable|string|max:255',
            'spesifikasi' => 'nullable|string',
            'satuan'      => 'nullable|string',
            'stok'        => 'nullable|integer|min:0',
            'foto'        => 'nullable|image',
        ]);

        // Upload foto baru jika ada
        $fotoPath = $barang->foto;
        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('barang', 'public');
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori'    => $request->kategori,
            'spesifikasi' => $request->spesifikasi,
            'satuan'      => $request->satuan,
            'stok'        => $request->stok ?? 0,
            'foto'        => $fotoPath,
        ]);

        return redirect()->route('barangsAdmin.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus foto dari storage kalau ada
        if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
            Storage::disk('public')->delete($barang->foto);
        }

        // Manual soft delete
        $barang->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);

        return redirect()->route('barangsAdmin.index')->with('success', 'Barang berhasil dihapus');
    }
}
