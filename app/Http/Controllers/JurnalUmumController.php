<?php
namespace App\Http\Controllers;

use App\Models\JurnalUmum;
use Illuminate\Http\Request;

class JurnalUmumController extends Controller
{
    public function index()
    {
        $jurnalUmums = JurnalUmum::active()->get();
        return view('jurnalUmums.index', compact('jurnalUmums'));
    }

    public function create()
    {
        return view('jurnalUmums.create');
    }

    public function store(Request $request)
    {
        JurnalUmum::create($request->all());
        return redirect()->route('jurnalUmums.index')->with('success', 'Jurnal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jurnalUmum = JurnalUmum::findOrFail($id);
        return view('jurnalUmums.edit', compact('jurnalUmum'));
    }

    public function update(Request $request, $id)
    {
        $jurnalUmum = JurnalUmum::findOrFail($id);
        $jurnalUmum->update($request->all());
        return redirect()->route('jurnalUmums.index')->with('success', 'Jurnal berhasil diupdate');
    }

    public function destroy($id)
    {
        $jurnalUmum = JurnalUmum::findOrFail($id);
        $jurnalUmum->update(['deleted_at' => now()]); // manual soft delete
        return redirect()->route('jurnalUmums.index')->with('success', 'Jurnal berhasil dihapus (soft delete)');
    }
}
