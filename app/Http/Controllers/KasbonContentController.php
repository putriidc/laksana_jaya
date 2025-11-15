<?php
namespace App\Http\Controllers;

use App\Models\KasbonContent;
use Illuminate\Http\Request;

class KasbonContentController extends Controller
{
    public function index()
    {
        $kasbonContents = KasbonContent::active()->get();
        return view('kasbonContents.index', compact('kasbonContents'));
    }

    public function create()
    {
        return view('kasbonContents.create');
    }

    public function store(Request $request)
    {
        KasbonContent::create($request->all());
        return redirect()->route('kasbonContents.index')->with('success', 'Transaksi kasbon berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kasbonContent = KasbonContent::findOrFail($id);
        return view('kasbonContents.edit', compact('kasbonContent'));
    }

    public function update(Request $request, $id)
    {
        $kasbonContent = KasbonContent::findOrFail($id);
        $kasbonContent->update($request->all());
        return redirect()->route('kasbonContents.index')->with('success', 'Transaksi kasbon berhasil diupdate');
    }

    public function destroy($id)
    {
        $kasbonContent = KasbonContent::findOrFail($id);
        $kasbonContent->update(['deleted_at' => now()]); // manual soft delete
        return redirect()->route('kasbonContents.index')->with('success', 'Transaksi kasbon berhasil dihapus (soft delete)');
    }
}
