<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\PiutangHutang;
use Illuminate\Support\Facades\Auth;

class PiutangHutangController extends Controller
{
    public function index()
    {
        $piutangHutangs = PiutangHutang::active()->get();
        return view('admin.master-data.data', compact('piutangHutangs'));
    }

    public function create()
    {
        $karyawans = Karyawan::active()->get();
        return view('admin.master-data.form-add.piutang-hutang', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_akun'   => 'required|string|max:100',
            'akun_header' => 'required|string|max:50',
        ]);

        // Tentukan prefix
        $prefix = strtolower($request->akun_header) === 'piutang' ? 'PI-' : 'HU-';

        // Cari kode terakhir untuk header ini
        $lastKode = PiutangHutang::where('akun_header', $request->akun_header)
            ->orderBy('id', 'desc')
            ->value('kode_akun');

        if ($lastKode) {
            $lastNumber = (int) substr($lastKode, 3);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $newKode = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        PiutangHutang::create([
            'kode_akun'   => $newKode,
            'nama_akun'   => $request->nama_akun,
            'akun_header' => $request->akun_header,
            'created_by'  => Auth::id(),
        ]);

        return redirect()->route('master-data.index')
            ->with('success', 'Data Piutang/Hutang berhasil disimpan');
    }


    public function edit($id)
    {
        $piutangHutang = PiutangHutang::findOrFail($id);
        return view('admin.master-data.form-edit.piutang-hutang', compact('piutangHutang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'nama_akun'   => 'required|string|max:100',
            'akun_header' => 'required|string|max:50',
        ]);

        $piutangHutang = PiutangHutang::findOrFail($id);

        $piutangHutang->update([

            'nama_akun'   => $request->nama_akun,
            'akun_header' => $request->akun_header,
        ]);

        return redirect()->route('master-data.index')
            ->with('success', 'Data Piutang/Hutang berhasil diupdate');
    }

    public function destroy($id)
    {
        $piutangHutang = PiutangHutang::findOrFail($id);
        $piutangHutang->update(['deleted_at' => Carbon::now('Asia/Jakarta')]); // manual soft delete
        return redirect()->route('master-data.index')->with('success', 'Data berhasil dihapus (soft delete)');
    }
}
