<?php

namespace App\Http\Controllers;

use App\Models\Progres;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\DataPerusahaan;
use Illuminate\Support\Facades\Auth;

class PerusahaanController extends Controller
{
    public function index()
    {
        // Ambil semua perusahaan yang belum dihapus
        $perusahaans = Perusahaan::whereNull('deleted_at')->get();
        return view('kepala-proyek.dashboard', compact('perusahaans'));
    }

    public function create()
    {
        return view('perusahaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
        ]);

        // Generate kode otomatis
        $last = Perusahaan::orderBy('id', 'desc')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $kode = 'PR-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        Perusahaan::create([
            'kode_perusahaan' => $kode,
            'nama_perusahaan' => $request->nama_perusahaan,
            'created_by'      => Auth::check() ? Auth::user()->id : null,
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan');
    }

    public function show($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $data = DataPerusahaan::where('kode_perusahaan', $perusahaan->kode_perusahaan)->whereNull('deleted_at')->get();

        // Hitung progres per paket
        $progressTotals = [];
        foreach ($data as $d) {
            $progres = Progres::where('kode_paket', $d->kode_paket)
                ->whereNull('deleted_at')
                ->get();

            $progressTotals[$d->id] = min($progres->sum('persen'), 100);
        }

        return view('kepala-proyek.data-proyek.index', compact('perusahaan', 'data', 'progressTotals'));
    }

    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $request, $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        $request->validate([
            'kode_perusahaan' => 'required|unique:perusahaans,kode_perusahaan,' . $perusahaan->id,
            'nama_perusahaan' => 'required|string|max:255',
        ]);

        $perusahaan->update([
            'kode_perusahaan' => $request->kode_perusahaan,
            'nama_perusahaan' => $request->nama_perusahaan,
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil diupdate');
    }

    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->update(['deleted_at' => now()]);

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil dihapus');
    }
}
