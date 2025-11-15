<?php
namespace App\Http\Controllers;

use App\Models\PinjamanKaryawan;
use Illuminate\Http\Request;

class PinjamanKaryawanController extends Controller
{
    public function index()
    {
        $pinjamanKaryawans = PinjamanKaryawan::active()->get();
        return view('pinjamanKaryawans.index', compact('pinjamanKaryawans'));
    }

    public function create()
    {
        return view('pinjamanKaryawans.create');
    }

    public function store(Request $request)
    {
        PinjamanKaryawan::create($request->all());
        return redirect()->route('pinjamanKaryawans.index')->with('success', 'Data pinjaman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pinjamanKaryawan = PinjamanKaryawan::findOrFail($id);
        return view('pinjamanKaryawans.edit', compact('pinjamanKaryawan'));
    }

    public function update(Request $request, $id)
    {
        $pinjamanKaryawan = PinjamanKaryawan::findOrFail($id);
        $pinjamanKaryawan->update($request->all());
        return redirect()->route('pinjamanKaryawans.index')->with('success', 'Data pinjaman berhasil diupdate');
    }

    public function destroy($id)
    {
        $pinjamanKaryawan = PinjamanKaryawan::findOrFail($id);
        $pinjamanKaryawan->update(['deleted_at' => now()]); // manual soft delete
        return redirect()->route('pinjamanKaryawans.index')->with('success', 'Data pinjaman berhasil dihapus (soft delete)');
    }
}
