<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\AlatDibeli;
use App\Models\AlatDihapus;
use App\Models\AlatDikembalikan;
use App\Models\AlatDipinjam;
use App\Models\CatatStok;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class AlatAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Alat::active();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama_alat', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        $alats = $query->get();

        return view('admin.data-alat.data', compact('alats'));
    }

    public function print(Request $request)
    {
        $query = Alat::active();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama_alat', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        $alats = $query->get();

        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.data-alat.print', compact('alats', 'jamCetak', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("Data Alat.pdf");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data-alat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori'    => 'nullable|string|max:255',
            'spesifikasi' => 'nullable|string',
            'satuan'      => 'nullable|string',
            'stok'        => 'nullable|integer|min:0',
            'foto'        => 'nullable|image',
        ]);

        // Ambil kode_barang terakhir, termasuk data yang sudah di soft delete
        $lastBarang = Alat::withTrashed()->latest('id')->first();

        if (!$lastBarang) {
            $nomorUrut = 1;
        } else {
            // Mengambil angka dari string 'KB-001' -> menjadi 1
            $lastKode = $lastBarang->kode_alat;
            $nomorUrut = (int) substr($lastKode, 3) + 1;
        }

        // Str::padLeft digunakan agar format tetap 001, 002, dst (misal: KB-0010)
        $kodeAlat = 'KA-' . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('alat', 'public');
        }
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        Alat::create([
            'tanggal'     => $today,
            'kode_alat'   => $kodeAlat,
            'nama_alat'   => $request->nama_alat,
            'kategori'    => $request->kategori,
            'spesifikasi' => $request->spesifikasi,
            'satuan'      => $request->satuan,
            'stok'        => $request->stok ?? 0,
            'foto'        => $fotoPath,
            'created_by'  => Auth::check() ? Auth::user()->id : null,
        ]);

        return redirect()->route('alatsAdmin.index')->with('success', 'Alat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $catatStok = CatatStok::where('kode_alat', $alat->kode_alat)->latest()->get();

        // Alat Dibeli
        $queryDibeli = AlatDibeli::with('alat')
            ->where('kode_alat', $alat->kode_alat)
            ->whereNull('deleted_at');

        if ($request->filled('start_dibeli') && $request->filled('end_dibeli')) {
            $queryDibeli->whereBetween('tanggal', [$request->start_dibeli, $request->end_dibeli]);
        }
        $alatDibelis = $queryDibeli->get();

        // Alat Dihapus
        $queryDihapus = AlatDihapus::with('alat')
            ->where('kode_alat', $alat->kode_alat)
            ->whereNull('deleted_at');

        if ($request->filled('start_dihapus') && $request->filled('end_dihapus')) {
            $queryDihapus->whereBetween('tanggal', [$request->start_dihapus, $request->end_dihapus]);
        }
        $alatDihapus = $queryDihapus->get();

        // Alat Dipinjam
        $queryDipinjam = AlatDipinjam::with('alat')
            ->where('kode_alat', $alat->kode_alat)
            ->whereNull('deleted_at');

        if ($request->filled('start_dipinjam') && $request->filled('end_dipinjam')) {
            $queryDipinjam->whereBetween('tanggal', [$request->start_dipinjam, $request->end_dipinjam]);
        }
        $alatDipinjams = $queryDipinjam->get();

        // Alat Dikembalikkan
        $queryDikembalikan = AlatDikembalikan::with('alat')
            ->where('kode_alat', $alat->kode_alat)
            ->whereNull('deleted_at');

        if ($request->filled('start_dikembalikan') && $request->filled('end_dikembalikan')) {
            $queryDikembalikan->whereBetween('tanggal', [$request->start_dikembalikan, $request->end_dikembalikan]);
        }
        $alatDikembalikans = $queryDikembalikan->get();

        $proyeks = Proyek::whereNull('deleted_at')->get();

        return view('admin.data-alat.detail', compact(
            'alat',
            'alatDibelis',
            'alatDipinjams',
            'alatDikembalikans',
            'alatDihapus',
            'proyeks',
            'catatStok'
        ));
    }


    public function printDibeli(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $query = AlatDibeli::with('alat')
            ->where('kode_alat', $alat->kode_alat)
            ->whereNull('deleted_at');

        if ($request->filled('start_dibeli') && $request->filled('end_dibeli')) {
            $query->whereBetween('tanggal', [$request->start_dibeli, $request->end_dibeli]);
        }

        $alatDibelis = $query->orderBy('tanggal', 'desc')->get();
        $spv = Auth::user()->name ?? 'Rudi';
        $role = Auth::user()->role ?? 'supervisor';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.data-alat.alatDibeli.print', compact('alat', 'jamCetak', 'alatDibelis', 'spv', 'role', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("AlatDibeli_{$alat->nama_alat}.pdf");
    }

    public function printDihapus(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $query = AlatDihapus::with('alat')
            ->where('kode_alat', $alat->kode_alat)
            ->whereNull('deleted_at');

        if ($request->filled('start_dihapus') && $request->filled('end_dihapus')) {
            $query->whereBetween('tanggal', [$request->start_dihapus, $request->end_dihapus]);
        }

        $alatDihapus = $query->orderBy('tanggal', 'desc')->get();
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.data-alat.alatDihapus.print', compact('alat', 'jamCetak', 'alatDihapus', 'admin', 'role', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("AlatDihapus_{$alat->nama_alat}.pdf");
    }

    public function printDipinjam(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $query = AlatDipinjam::with('alat')
            ->where('kode_alat', $alat->kode_alat)
            ->whereNull('deleted_at');

        if ($request->filled('start_dipinjam') && $request->filled('end_dipinjam')) {
            $query->whereBetween('tanggal', [$request->start_dipinjam, $request->end_dipinjam]);
        }

        $proyeks = Proyek::whereNull('deleted_at')->get();
        $alatDipinjams = $query->orderBy('tanggal', 'desc')->get();
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.data-alat.alatDipinjam.print', compact('alat', 'proyeks', 'jamCetak',  'alatDipinjams', 'admin', 'role', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("AlatDipinjam_{$alat->nama_alat}.pdf");
    }

    public function printDikembalikan(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $query = AlatDikembalikan::with('alat')
            ->where('kode_alat', $alat->kode_alat)
            ->whereNull('deleted_at');

        if ($request->filled('start_dikembalikan') && $request->filled('end_dikembalikan')) {
            $query->whereBetween('tanggal', [$request->start_dikembalikan, $request->end_dikembalikan]);
        }

        $proyeks = Proyek::whereNull('deleted_at')->get();
        $alatDikembalikans = $query->orderBy('tanggal', 'desc')->get();
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('admin.data-alat.alatDikembalikan.print', compact('alat', 'jamCetak', 'proyeks', 'alatDikembalikans', 'admin', 'role', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("AlatDikembalikan_{$alat->nama_alat}.pdf");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        return view('admin.data-alat.edit', compact('alat'));
    }

    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori'    => 'nullable|string|max:255',
            'spesifikasi' => 'nullable|string',
            'satuan'      => 'nullable|string',
            'stok'        => 'nullable|integer|min:0',
            'foto'        => 'nullable|image',
        ]);

        // Upload foto baru jika ada
        $fotoPath = $alat->foto;
        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('alat', 'public');
        }

        $alat->update([
            'nama_alat' => $request->nama_alat,
            'kategori'    => $request->kategori,
            'spesifikasi' => $request->spesifikasi,
            'satuan'      => $request->satuan,
            'stok'        => $request->stok ?? 0,
            'foto'        => $fotoPath,
        ]);

        return redirect()->route('alatsAdmin.index')->with('success', 'alat berhasil diupdate');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);

        // Hapus foto dari storage kalau ada
        if ($alat->foto && Storage::disk('public')->exists($alat->foto)) {
            Storage::disk('public')->delete($alat->foto);
        }

        // Manual soft delete
        $alat->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);

        return redirect()->route('alatsAdmin.index')->with('success', 'alat berhasil dihapus');
    }
}
