<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Proyek;
use App\Models\KasbonTukang;
use Illuminate\Http\Request;
use App\Models\TukangContent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class pinjamanTukangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjamans = KasbonTukang::whereNull('deleted_at')->get();
        $contents = TukangContent::with('kasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->where(function ($query) {
                $query->where('status_spv', '!=', 'accept')
                    ->orWhere('status_owner', '!=', 'accept');
            })
            ->get();

        return view('admin.pinjaman-tukang.data', compact('pinjamans', 'contents'));
    }

    public function print()
    {
        $pinjamans = KasbonTukang::active()->get();
        $tanggalCetak = Carbon::now('Asia/Jakarta')->format('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->format('H:i');
        $role = Auth::user()->role ?? 'Admin';
        $admin = Auth::user()->name ?? 'Admin';

        $pdf = Pdf::loadView('admin.pinjaman-tukang.print', compact('pinjamans', 'tanggalCetak', 'admin', 'role', 'jamCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-Pinjaman-Tukang.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $karyawans = Proyek::whereNull('deleted_at')->get();
        return view('admin.pinjaman-tukang.create', compact('today', 'karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'       => 'required|date',
            'nama_tukang' => 'required|string',
            'nama_akun' => 'required|string',
            'nama_proyek' => 'required|string',
        ]);
        $lastId = KasbonTukang::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeAkun = 'KT-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        KasbonTukang::create([
            'kode_kasbon'       => $kodeAkun,
            'tanggal'       => $request->tanggal,
            'nama_tukang' => $request->nama_tukang,
            'nama_akun' => $request->nama_akun,
            'nama_proyek' => $request->nama_proyek,
            'total'  => 0,
            'created_by'    => Auth::check() ? Auth::user()->id : null,
        ]);
        return redirect()->route('pinjamanTukangs.index')->with('success', 'Data pinjaman tukang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data pinjaman utama + relasi karyawan
        $pinjaman = KasbonTukang::active()->findOrFail($id);

        $today = Carbon::now('Asia/Jakarta')->toDateString();


        // Ambil semua transaksi pinjaman dan kasbon berdasarkan kode_karyawan
        $pinjamanContents = TukangContent::where('kode_kasbon', $pinjaman->kode_kasbon)
            ->whereNull('deleted_at')
            ->where('status_spv', 'accept')
            ->where('status_owner', 'accept')
            ->get();

        return view('admin.pinjaman-tukang.detail.data', compact('pinjaman', 'pinjamanContents', 'today'));
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
        $pinjamanKaryawan = KasbonTukang::findOrFail($id);
        $pinjamanKaryawan->update(['deleted_at' => Carbon::now('Asia/Jakarta')]); // manual soft delete
        return redirect()->route('pinjamanTukangs.index')->with('success', 'Data pinjaman berhasil dihapus (soft delete)');
    }
}
