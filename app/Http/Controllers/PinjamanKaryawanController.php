<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\KasbonContent;
use App\Models\PinjamanContent;
use App\Models\PinjamanKaryawan;
use Illuminate\Support\Facades\Auth;

class PinjamanKaryawanController extends Controller
{
    public function index()
    {
        $pinjamans = PinjamanKaryawan::with('karyawan')->active()->get();
        $pinjams = PinjamanContent::with('karyawanPinjaman')
            ->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->where(function ($q) {
                $q->where('setuju', false)
                    ->orWhereNull('setuju');
            })
            ->get();

        $kasbons = KasbonContent::with('karyawanKasbon')
            ->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->where(function ($q) {
                $q->where('setuju', false)
                    ->orWhereNull('setuju');
            })
            ->get();

        return view('admin.pinjaman-karyawan.data', compact('pinjamans', 'pinjams', 'kasbons'));
    }
    public function show($id)
    {
        // Ambil data pinjaman utama + relasi karyawan
        $pinjaman = PinjamanKaryawan::with('karyawan')->active()->findOrFail($id);

        // Ambil semua transaksi pinjaman dan kasbon berdasarkan kode_karyawan
        $pinjamanContents = PinjamanContent::where('kode_karyawan', $pinjaman->kode_karyawan)
            ->where('setuju', true)
            ->active()->get();
        $kasbonContents   = KasbonContent::where('kode_karyawan', $pinjaman->kode_karyawan)
            ->where('setuju', true)
            ->active()->get();
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        return view('admin.pinjaman-karyawan.detail.data', compact('pinjaman', 'pinjamanContents', 'kasbonContents', 'today'));
    }

    public function create()
    {
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $karyawans = Karyawan::whereNull('deleted_at')->get();
        return view('admin.pinjaman-karyawan.form-add.index', compact('today', 'karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'       => 'required|date',
            'kode_karyawan' => 'required|string',
        ]);

        PinjamanKaryawan::create([
            'tanggal'       => $request->tanggal,
            'kode_karyawan' => $request->kode_karyawan,
            'total_pinjam'  => 0,
            'total_kasbon'  => 0,
            'created_by'    => Auth::check() ? Auth::user()->id : null,
        ]);
        return redirect()->route('pinjamanKaryawans.index')->with('success', 'Data pinjaman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pinjaman = PinjamanKaryawan::findOrFail($id);
        $karyawans = Karyawan::whereNull('deleted_at')->get();
        return view('admin.pinjaman-karyawan.form-edit.index', compact('pinjaman', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'       => 'required|date',
            'kode_karyawan' => 'required|string',
        ]);

        $pinjaman = PinjamanKaryawan::findOrFail($id);

        $pinjaman->update([
            'tanggal'       => $request->tanggal,
            'kode_karyawan' => $request->kode_karyawan,
        ]);
        return redirect()->route('pinjamanKaryawans.index')->with('success', 'Data pinjaman berhasil diupdate');
    }

    public function destroy($id)
    {
        $pinjamanKaryawan = PinjamanKaryawan::findOrFail($id);
        $pinjamanKaryawan->update(['deleted_at' => Carbon::now('Asia/Jakarta')]); // manual soft delete
        return redirect()->route('pinjamanKaryawans.index')->with('success', 'Data pinjaman berhasil dihapus (soft delete)');
    }
}
