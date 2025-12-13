<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use App\Models\Proyek;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class JurnalUmumController extends Controller
{

    public function index(Request $request)
    {
        $query = JurnalUmum::active();

        // Cek apakah user isi tanggal
        if ($request->filled('start') && $request->filled('end')) {
            $start = Carbon::parse($request->start)->startOfDay();
            $end = Carbon::parse($request->end)->endOfDay();

            $query->whereBetween('tanggal', [$start, $end]);
        }

        //debit
        $akun = Asset::where('for_admin', true)
            ->Active()
            ->get();

        $kredit = Asset::Active()
        ->whereIn('nama_akun', ['Kas Besar', 'Kas Kecil', 'Kas Bank BCA'])
        ->get();

        $daftarProyek = Proyek::active()
            ->pluck('nama_proyek')
            ->filter()
            ->values();        // reset index biar rapi
        if ($request->filled('filter_proyek')) {
            $query->whereIn('nama_proyek', $request->filter_proyek);
        }


        $jurnals = $query->orderBy('tanggal', 'desc')->get();

        $totalDebit = $jurnals->sum('debit');
        $totalKredit = $jurnals->sum('kredit');
        $status = $totalDebit === $totalKredit ? 'Balance' : 'Tidak Balance';
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        return view('admin.jurnal-umum.data', compact('jurnals', 'today', 'totalDebit', 'totalKredit', 'status', 'akun', 'daftarProyek', 'kredit'));
    }

    public function print(Request $request)
    {
        $query = JurnalUmum::active();

        if ($request->filled('start') && $request->filled('end')) {
            $start = Carbon::parse($request->start)->startOfDay();
            $end = Carbon::parse($request->end)->endOfDay();
            $query->whereBetween('tanggal', [$start, $end]);
        }

        $jurnals = $query->orderBy('tanggal', 'desc')->get();
        $admin = Auth::user()->name ?? 'Administrator';
        $role = Auth::user()->role ?? 'admin';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');

        $pdf = Pdf::loadView('admin.jurnal-umum.print', compact('jurnals', 'admin', 'role', 'tanggalCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('jurnal-umum.pdf');
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
            'kredit'          =>  0,
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
            'debit'           =>  0,
            'kredit'          => $request->kredit ?? 0,
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
