<?php

namespace App\Http\Controllers;

use App\Models\KasbonTukang;
use Illuminate\Http\Request;
use App\Models\TukangContent;
use Illuminate\Support\Facades\Auth;

class AccTukangSpvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjamans = TukangContent::with('kasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->get();
        $contents = TukangContent::with('kasbon')->where('jenis', 'pinjam')
            ->whereNull('deleted_at')
            ->where('status_spv', '!=', 'accept')
            ->get();
        return view('kepala-gudang.pinjaman-karyawan.data', compact('pinjamans', 'contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tukang_content' => 'required',
        ]);

        $kasbonContent = TukangContent::active()->findOrFail($request->id_tukang_content);

        // Update status SPV dulu
        $kasbonContent->update([
            'status_spv' => 'accept',
        ]);

        // Cek apakah Owner juga sudah accept
        if ($kasbonContent->status_owner === 'accept') {
            $pinjamanKaryawan = KasbonTukang::active()
                ->where('kode_kasbon', $kasbonContent->kode_kasbon)
                ->firstOrFail();

            $sisa = $kasbonContent->bayar + $pinjamanKaryawan->total;

            $pinjamanKaryawan->update([
                'total' => $sisa,
            ]);

            $kasbonContent->update([
                'sisa' => $sisa,
            ]);
        }

        return redirect()->route('accspv.index')
            ->with('success', 'Status SPV berhasil disetujui');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
