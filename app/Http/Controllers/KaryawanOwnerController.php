<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanOwnerController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::active()->get();
        return view('karyawans.index', compact('karyawans'));
    }

    public function create()
    {
        return view('owner.master-data.form-add.karyawan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'alamat'      => 'nullable|string|max:255',
            'no_hp'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:100',
            'pekerja'       => 'required',
            'jabatan'       => 'nullable',
        ]);
        $lastId = Karyawan::max('id') ?? 0;
        $nextId = $lastId + 1;
        $kodeAkun = 'K-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        Karyawan::create([
            'kode_karyawan' => 'K-' . uniqid(), // generate kode unik
            'kode_akun'     => $kodeAkun,
            'nama'      => $request->nama,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'email'         => $request->email,
            'pekerja'         => $request->pekerja,
            'jabatan'         => $request->jabatan,
            'created_by'    => Auth::check() ? Auth::user()->name : null,
        ]);
        return redirect()->route('master-data-owner.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('owner.master-data.form-edit.karyawan', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'nama'    => 'required|string|max:100',
            'alamat'      => 'nullable|string|max:255',
            'no_hp'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:100',
            'pekerja'       => 'required',
            'jabatan'       => 'nullable',
        ]);
        // dd($request->all());

        $karyawan = Karyawan::findOrFail($id);

        $karyawan->update([
            'nama'         => $request->nama,
            'alamat'      => $request->alamat,
            'no_hp'       => $request->no_hp,
            'email'       => $request->email,
            'pekerja'         => $request->pekerja,
            'jabatan'         => $request->jabatan,
        ]);
        return redirect()->route('master-data-owner.index')->with('success', 'Karyawan berhasil diupdate');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update(['deleted_at' => Carbon::now('Asia/Jakarta')]); // manual soft delete
        return redirect()->route('master-data-owner.index')->with('success', 'Karyawan berhasil dihapus (soft delete)');
    }
}
