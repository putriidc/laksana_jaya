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

class BarangController extends Controller
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

        return view('kepala-gudang.data-barang.data', compact('barangs'));
    }


    public function create()
    {
        return view('kepala-gudang.data-barang.create');
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

        // Generate kode_barang otomatis
        $lastId = Barang::max('id') ?? 0;
        $kodeBarang = 'KB-00' . ($lastId + 1);

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

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan');
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

        return view('kepala-gudang.detail-barang.index', compact(
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

        $pdf = Pdf::loadView('kepala-gudang.detail-barang.printIn', compact('barang', 'barangMasuks', 'admin', 'role', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("BarangMasuk_{$barang->nama_barang}.pdf");
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

        $pdf = Pdf::loadView('kepala-gudang.detail-barang.printOut', compact('barang', 'barangKeluars', 'admin', 'role', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("BarangKeluar_{$barang->nama_barang}.pdf");
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

        $pdf = Pdf::loadView('kepala-gudang.detail-barang.printRtr', compact('barang', 'barangReturs', 'admin', 'role', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("BarangRetur_{$barang->nama_barang}.pdf");
    }


    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('kepala-gudang.data-barang.edit', compact('barang'));
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

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diupdate');
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

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus');
    }
}
