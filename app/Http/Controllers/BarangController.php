<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\barangRetur;
use Illuminate\Http\Request;
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

    public function show($id)
    {
        $barang = Barang::findOrFail($id);

        // Ambil semua barang masuk untuk barang ini
        $barangMasuks = BarangMasuk::with('barang')
            ->where('kode_barang', $barang->kode_barang)
            ->whereNull('deleted_at')
            ->get();

        // Ambil semua barang keluar untuk barang ini
        $barangKeluars = BarangKeluar::with('barang')
            ->where('kode_barang', $barang->kode_barang)
            ->whereNull('deleted_at')
            ->get();
        $barangReturs = barangRetur::with('barang')
            ->where('kode_barang', $barang->kode_barang)
            ->whereNull('deleted_at')
            ->get();


        return view('kepala-gudang.detail-barang.index', compact('barang', 'barangMasuks', 'barangKeluars', 'barangReturs'));
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
