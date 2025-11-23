<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::whereNull('deleted_at')->get();
        return view('admin.master-data.data', compact('assets'));
    }

    public function create()
    {
        return view('admin.master-data.form-add.asset');
    }

     public function store(Request $request)
    {
        $request->validate([
            'kode_akun' => 'required|string|max:50',
            'nama_akun' => 'required|string|max:100',
            'akun_header' => 'required|string|max:100',
            'post_saldo' => 'nullable',
            'post_laporan' => 'nullable',
        ]);

        Asset::create([
            'kode_akun'     => $request->kode_akun,
            'nama_akun'     => $request->nama_akun,
            'akun_header'     => $request->akun_header,
            'post_saldo'    => $request->post_saldo,
            'post_laporan'  => $request->post_laporan,
            'created_by' => Auth::user()->id ?? null, // kalau ada user login
        ]);

        return redirect()->route('master-data.index')->with('success', 'Data akun berhasil disimpan');
    }

    public function edit($id)
    {
        $akun = Asset::findOrFail($id);
        return view('admin.master-data.form-edit.asset', compact('akun'));
    }

     public function update(Request $request, $id)
    {
        $request->validate([
            'kode_akun' => 'required|string|max:50',
            'nama_akun' => 'required|string|max:100',
            'akun_header' => 'required|string|max:100',
            'post_saldo' => 'nullable',
            'post_laporan' => 'nullable',
        ]);

        $asset = Asset::findOrFail($id);

        $asset->update([
            'kode_akun'     => $request->kode_akun,
            'nama_akun'     => $request->nama_akun,
            'akun_header'   => $request->akun_header,
            'post_saldo'    => $request->post_saldo,
            'post_laporan'  => $request->post_laporan,
        ]);

        return redirect()->route('master-data.index')->with('success', 'Data akun berhasil diupdate');
    }

    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->update(['deleted_at' => Carbon::now('Asia/Jakarta')]); // manual soft delete
        return redirect()->route('master-data.index')->with('success', 'Asset berhasil dihapus (soft delete)');
    }
}
