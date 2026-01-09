<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::active()->get();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.form-add.supplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'marketing' => 'nullable|string|max:255',

        ]);
        $lastSupplier = Supplier::withTrashed()->orderBy('id', 'desc')->first();
        $lastCode = $lastSupplier ? $lastSupplier->kode_akun : null;
        $number = $lastCode ? intval(substr($lastCode, 3)) + 1 : 1;
        $newCode = 'SUP' . str_pad($number, 4, '0', STR_PAD_LEFT);
        Supplier::create([
            'kode_akun' => $newCode,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'marketing' => $request->marketing,
            'created_by' => Auth::check() ? Auth::user()->id : null,
        ]);
        return redirect()->route('master-data.index')->with('success', 'Supplier berhasil ditambahkan dengan kode ' . $newCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::active()->findOrFail($id);
        return view('admin.master-data.form-edit.supplier', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'marketing' => 'nullable|string|max:255'
        ]);
        $supplier = Supplier::withTrashed()->findOrFail($id);
        $supplier->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'marketing' => $request->marketing,
        ]);
        return redirect()->route('master-data.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('master-data.index')->with('success', 'Supplier berhasil dihapus');
    }
}
