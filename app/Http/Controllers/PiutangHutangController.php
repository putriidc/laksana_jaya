<?php
namespace App\Http\Controllers;

use App\Models\PiutangHutang;
use Illuminate\Http\Request;

class PiutangHutangController extends Controller
{
    public function index()
    {
        $piutangHutangs = PiutangHutang::active()->get();
        return view('piutangHutang.index', compact('piutangHutangs'));
    }

    public function create()
    {
        return view('piutangHutang.create');
    }

    public function store(Request $request)
    {
        PiutangHutang::create($request->all());
        return redirect()->route('piutangHutang.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $piutangHutang = PiutangHutang::findOrFail($id);
        return view('piutangHutang.edit', compact('piutangHutang'));
    }

    public function update(Request $request, $id)
    {
        $piutangHutang = PiutangHutang::findOrFail($id);
        $piutangHutang->update($request->all());
        return redirect()->route('piutangHutang.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $piutangHutang = PiutangHutang::findOrFail($id);
        $piutangHutang->update(['deleted_at' => now()]); // manual soft delete
        return redirect()->route('piutangHutang.index')->with('success', 'Data berhasil dihapus (soft delete)');
    }
}
