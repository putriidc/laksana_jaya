<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PinjamanKaryawan;

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
        $pinjamanKaryawan->update(['deleted_at' => Carbon::now('Asia/Jakarta')]); // manual soft delete
        return redirect()->route('pinjamanKaryawans.index')->with('success', 'Data pinjaman berhasil dihapus (soft delete)');
    }
}
