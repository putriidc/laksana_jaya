<?php

namespace App\Http\Controllers;

use App\Models\HutangVendor;
use App\Models\Supplier;
use App\Models\Proyek;
use Illuminate\Http\Request;

class HutangVendorController extends Controller
{
    public function index()
    {
        $hutangVendors = HutangVendor::active()->with(['supplier', 'proyek'])->get();
        $suppliers = Supplier::active()->get();
        $proyeks   = Proyek::active()->get();
        return view('admin.hutang-vendor.data', compact('hutangVendors', 'suppliers', 'proyeks'));
    }
    /**
     * Tampilkan form create hutang vendor.
     */
    public function create()
    {
        // Ambil semua supplier & proyek aktif (tidak soft delete)
        $suppliers = Supplier::active()->get();
        $proyeks   = Proyek::active()->get();

        return view('hutang_vendor.create', compact('suppliers', 'proyeks'));
    }

    /**
     * Simpan hutang vendor baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_hutang'      => 'required|date',
            'tgl_jatuh_tempo' => 'required|date',
            'kode_supplier'   => 'required|exists:suppliers,kode_akun',
            'nominal'         => 'required|numeric',
            'kode_proyek'     => 'required|exists:proyeks,kode_akun',
            'keterangan'      => 'nullable|string',
            'created_by'      => 'nullable|string',
        ]);

        // Generate kode vendor otomatis
        $last = HutangVendor::withTrashed()->orderBy('id', 'desc')->first();
        $lastCode = $last ? $last->kode_vendor : null;
        $number   = $lastCode ? intval(substr($lastCode, 2)) + 1 : 1;
        $newCode  = 'HV' . str_pad($number, 4, '0', STR_PAD_LEFT);

        HutangVendor::create([
            'kode_vendor'     => $newCode,
            'tgl_hutang'      => $request->tgl_hutang,
            'tgl_jatuh_tempo' => $request->tgl_jatuh_tempo,
            'kode_supplier'   => $request->kode_supplier,
            'nominal'         => $request->nominal,
            'kode_proyek'     => $request->kode_proyek,
            'keterangan'      => $request->keterangan,
            'created_by'      => $request->created_by,
        ]);

        return redirect()->route('hutang_vendor.index')->with('success', 'Hutang vendor berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit hutang vendor.
     */
    public function edit($id)
    {
        $hutangVendor = HutangVendor::withTrashed()->findOrFail($id);
        $suppliers    = Supplier::all();
        $proyeks      = Proyek::all();

        return view('hutang_vendor.edit', compact('hutangVendor', 'suppliers', 'proyeks'));
    }

    /**
     * Update hutang vendor.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_hutang'      => 'required|date',
            'tgl_jatuh_tempo' => 'required|date',
            'kode_supplier'   => 'required|exists:suppliers,kode_akun',
            'nominal'         => 'required|numeric',
            'kode_proyek'     => 'required|exists:proyeks,kode_akun',
            'keterangan'      => 'nullable|string',
            'created_by'      => 'nullable|string',
        ]);

        $hutangVendor = HutangVendor::withTrashed()->findOrFail($id);

        $hutangVendor->update([
            'tgl_hutang'      => $request->tgl_hutang,
            'tgl_jatuh_tempo' => $request->tgl_jatuh_tempo,
            'kode_supplier'   => $request->kode_supplier,
            'nominal'         => $request->nominal,
            'kode_proyek'     => $request->kode_proyek,
            'keterangan'      => $request->keterangan,
            'created_by'      => $request->created_by,
        ]);

        return redirect()->route('hutang_vendor.index')->with('success', 'Hutang vendor berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $hutangVendor = HutangVendor::findOrFail($id);
        $hutangVendor->delete();
        return redirect()->route('hutang_vendor.index')->with('success', 'Data hutang vendor berhasil dihapus.');
    }
}
