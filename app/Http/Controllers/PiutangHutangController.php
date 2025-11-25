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
            'kode_akun'   => 'required|string|max:50',
            'nama_akun'   => 'required|string|max:100',
            'akun_header' => 'required|string|max:50',
            'nama_pic' => 'nullable',
        ]);
        // logika gabung akun_header + nama_pic kalau pilih PIC
        $akunHeader = $request->akun_header === 'PIC' && $request->nama_pic
            ? 'PIC ' . $request->nama_pic
            : $request->akun_header;
        PiutangHutang::create([
            'kode_akun'   => $request->kode_akun,
            'nama_akun'   => $request->nama_akun,
            'akun_header' => $akunHeader,
            'created_by' => Auth::user()->id ?? null, // kalau ada user login
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
            'kode_akun'   => 'required|string|max:50',
            'nama_akun'   => 'required|string|max:100',
            'akun_header' => 'required|string|max:50',
        ]);

        $piutangHutang = PiutangHutang::findOrFail($id);

        $piutangHutang->update([
            'kode_akun'   => $request->kode_akun,
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
