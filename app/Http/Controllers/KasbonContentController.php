<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\KasbonContent;

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
        $kasbonContent->update(['deleted_at' => Carbon::now('Asia/Jakarta')]); // manual soft delete
        return redirect()->route('kasbonContents.index')->with('success', 'Transaksi kasbon berhasil dihapus (soft delete)');
    }
}
