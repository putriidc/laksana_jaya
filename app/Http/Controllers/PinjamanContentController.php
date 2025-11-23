<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PinjamanContent;

class PinjamanContentController extends Controller
{
    public function index()
    {
        $contents = PinjamanContent::active()->get();
        return view('pinjamanContents.index', compact('contents'));
    }

    public function create()
    {
        return view('pinjamanContents.create');
    }

    public function store(Request $request)
    {
        PinjamanContent::create($request->all());
        return redirect()->route('pinjamanContents.index')->with('success', 'Transaksi pinjaman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $content = PinjamanContent::findOrFail($id);
        return view('pinjamanContents.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $content = PinjamanContent::findOrFail($id);
        $content->update($request->all());
        return redirect()->route('pinjamanContents.index')->with('success', 'Transaksi pinjaman berhasil diupdate');
    }

    public function destroy($id)
    {
        $content = PinjamanContent::findOrFail($id);
        $content->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);
        return redirect()->route('pinjamanContents.index')->with('success', 'Transaksi pinjaman berhasil dihapus (soft delete)');
    }
}
