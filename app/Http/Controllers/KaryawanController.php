<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::active()->get();
        return view('karyawans.index', compact('karyawans'));
    }

    public function create()
    {
        return view('admin.master-data.form-add.karyawan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'alamat'      => 'nullable|string|max:255',
            'no_hp'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:100',
        ]);
        $lastId = Karyawan::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeAkun = 'K-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        Karyawan::create([
            'kode_karyawan' => 'K-' . uniqid(), // generate kode unik
            'kode_akun'     => $kodeAkun,
            'nama'      => $request->nama,
            'akun_header'   => $request->akun_header,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'email'         => $request->email,
            'created_by'    => Auth::check() ? Auth::user()->name : null,
        ]);
        return redirect()->route('master-data.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.master-data.form-edit.karyawan', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'nama'    => 'required|string|max:100',
            'akun_header' => 'required|string|max:100',
            'alamat'      => 'nullable|string|max:255',
            'no_hp'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:100',
        ]);

        $karyawan = Karyawan::findOrFail($id);

        $karyawan->update([
            'nama'    => $request->nama,
            'akun_header' => $request->akun_header,
            'alamat'      => $request->alamat,
            'no_hp'       => $request->no_hp,
            'email'       => $request->email,
        ]);
        return redirect()->route('master-data.index')->with('success', 'Karyawan berhasil diupdate');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update(['deleted_at' => Carbon::now('Asia/Jakarta')]); // manual soft delete
        return redirect()->route('master-data.index')->with('success', 'Karyawan berhasil dihapus (soft delete)');
    }
}
