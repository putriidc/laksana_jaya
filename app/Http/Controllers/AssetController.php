<?php
namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::active()->get();
        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        return view('assets.create');
    }

    public function store(Request $request)
    {
        Asset::create($request->all());
        return redirect()->route('assets.index')->with('success', 'Asset berhasil ditambahkan');
    }

    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        return view('assets.edit', compact('asset'));
    }

    public function update(Request $request, $id)
    {
        $asset = Asset::findOrFail($id);
        $asset->update($request->all());
        return redirect()->route('assets.index')->with('success', 'Asset berhasil diupdate');
    }

    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->update(['deleted_at' => now()]); // manual soft delete
        return redirect()->route('assets.index')->with('success', 'Asset berhasil dihapus (soft delete)');
    }
}
