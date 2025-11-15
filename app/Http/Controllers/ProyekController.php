<?php
namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    public function index()
    {
        $proyeks = Proyek::active()->get();
        return view('proyeks.index', compact('proyeks'));
    }

    public function create()
    {
        return view('proyeks.create');
    }

    public function store(Request $request)
    {
        Proyek::create($request->all());
        return redirect()->route('proyeks.index')->with('success', 'Proyek berhasil ditambahkan');
    }

    public function edit($id)
    {
        $proyek = Proyek::findOrFail($id);
        return view('proyeks.edit', compact('proyek'));
    }

    public function update(Request $request, $id)
    {
        $proyek = Proyek::findOrFail($id);
        $proyek->update($request->all());
        return redirect()->route('proyeks.index')->with('success', 'Proyek berhasil diupdate');
    }

    public function destroy($id)
    {
        $proyek = Proyek::findOrFail($id);
        $proyek->update(['deleted_at' => now()]); // manual soft delete
        return redirect()->route('proyeks.index')->with('success', 'Proyek berhasil dihapus (soft delete)');
    }
}
