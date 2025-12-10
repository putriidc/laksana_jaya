<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\Proyek;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalUmumController extends Controller
{
    public function index()
    {
        $jurnals = JurnalUmum::active()
        ->orderBy('tanggal', 'desc')
        ->get();
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        $totalDebit = $jurnals->sum('debit');
        $totalKredit = $jurnals->sum('kredit');

        $status = $totalDebit === $totalKredit ? 'Balance' : 'Tidak Balance';
        return view('admin.jurnal-umum.data', compact('jurnals', 'today', 'totalDebit', 'totalKredit', 'status'));
    }

    public function create()
    {
        $assets = Asset::whereNull('deleted_at')
            ->get();
        $proyeks = Proyek::whereNull('deleted_at')
            ->get();
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        return view('admin.jurnal-umum.form-add.index', compact('assets', 'proyeks', 'today'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'         => 'required|date',
            'keterangan'      => 'nullable|string|max:255',
            'nama_perkiraan'  => 'nullable|string|max:100',
            'kode_perkiraan'  => 'nullable|string|max:50',
            'nama_proyek'     => 'nullable|string|max:100',
            'kode_proyek'     => 'nullable|string|max:50',
            'debit'           => 'nullable',
            'kredit'          => 'nullable',
        ]);

        // generate kode jurnal J-00{id terakhir + 1}
        $lastId = JurnalUmum::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        JurnalUmum::create([
            'kode_jurnal'     => $kodeJurnal,
            'tanggal'         => $request->tanggal,
            'keterangan'      => $request->keterangan,
            'nama_perkiraan'  => $request->nama_perkiraan,
            'kode_perkiraan'  => $request->kode_perkiraan,
            'nama_proyek'     => $request->nama_proyek,
            'kode_proyek'     => $request->kode_proyek,
            'debit'           => $request->debit ?? 0,
            'kredit'          => $request->kredit ?? 0,
            'created_by'      => Auth::check() ? Auth::user()->id : null,
        ]);
        return redirect()->route('jurnalUmums.index')->with('success', 'Jurnal berhasil ditambahkan');
    }

    public function storeCashIn(Request $request)
    {
        $request->validate([
            'tanggal'         => 'required|date',
            'keterangan'      => 'required|string|max:255',
            'nama_perkiraan'  => 'required|string|max:100',
            'kode_perkiraan'  => 'required|string|max:50',
            'kredit'          => 'required|numeric|min:1',
        ]);

        // generate kode jurnal J-00{id terakhir + 1}
        $lastId = JurnalUmum::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        JurnalUmum::create([
            'kode_jurnal'     => $kodeJurnal,
            'tanggal'         => $request->tanggal,
            'keterangan'      => $request->keterangan,
            'nama_perkiraan'  => $request->nama_perkiraan,
            'kode_perkiraan'  => $request->kode_perkiraan,
            'nama_proyek'     => '-',
            'kode_proyek'     => '-',
            'debit'           => 0,
            'kredit'          => $request->kredit ?? 0,
            'created_by'      => Auth::check() ? Auth::user()->id : null,
        ]);
        return redirect()->route('jurnalUmums.index')->with('success', 'Jurnal berhasil ditambahkan');
    }
    public function storeCashOut(Request $request)
    {
        $request->validate([
            'tanggal'         => 'required|date',
            'keterangan'      => 'required|string|max:255',
            'nama_perkiraan'  => 'required|string|max:100',
            'kode_perkiraan'  => 'required|string|max:50',
            'debit'          => 'required|numeric|min:1',
        ]);

        // generate kode jurnal J-00{id terakhir + 1}
        $lastId = JurnalUmum::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeJurnal = 'J-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        JurnalUmum::create([
            'kode_jurnal'     => $kodeJurnal,
            'tanggal'         => $request->tanggal,
            'keterangan'      => $request->keterangan,
            'nama_perkiraan'  => $request->nama_perkiraan,
            'kode_perkiraan'  => $request->kode_perkiraan,
            'nama_proyek'     => '-',
            'kode_proyek'     => '-',
            'debit'           => $request->debit ?? 0,
            'kredit'          => 0,
            'created_by'      => Auth::check() ? Auth::user()->id : null,
        ]);
        return redirect()->route('jurnalUmums.index')->with('success', 'Jurnal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jurnalUmum = JurnalUmum::findOrFail($id);
        $assets = Asset::whereNull('deleted_at')
            ->get();
        $proyeks = Proyek::whereNull('deleted_at')
            ->get();
        if ($jurnalUmum->tanggal != now()->toDateString()) {
            return redirect()->route('jurnalUmums.index')
                ->with('error', 'Data hanya bisa diedit di hari yang sama.');
        }
        return view('admin.jurnal-umum.form-edit.index', compact('jurnalUmum', 'assets', 'proyeks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'         => 'required|date',
            'keterangan'      => 'nullable|string|max:255',
            'nama_perkiraan'  => 'nullable|string|max:100',
            'kode_perkiraan'  => 'nullable|string|max:50',
            'nama_proyek'     => 'nullable|string|max:100',
            'kode_proyek'     => 'nullable|string|max:50',
            'debit'           => 'nullable|numeric|min:0',
            'kredit'          => 'nullable|numeric|min:0',
        ]);

        $jurnal = JurnalUmum::findOrFail($id);

        $jurnal->update([
            'tanggal'         => $request->tanggal,
            'keterangan'      => $request->keterangan,
            'nama_perkiraan'  => $request->nama_perkiraan,
            'kode_perkiraan'  => $request->kode_perkiraan,
            'nama_proyek'     => $request->nama_proyek,
            'kode_proyek'     => $request->kode_proyek,
            'debit'           => $request->debit,
            'kredit'          => $request->kredit,
        ]);
        return redirect()->route('jurnalUmums.index')->with('success', 'Jurnal berhasil diupdate');
    }

    public function destroy($id)
    {
        $jurnalUmum = JurnalUmum::findOrFail($id);
        $jurnalUmum->update(['deleted_at' => Carbon::now('Asia/Jakarta')]); // manual soft delete
        return redirect()->route('jurnalUmums.index')->with('success', 'Jurnal berhasil dihapus (soft delete)');
    }
}
