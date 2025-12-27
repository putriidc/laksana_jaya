<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Carbon\Carbon;
use App\Models\Proyek;
use Illuminate\Http\Request;
use App\Models\PiutangHutang;
use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
    public function index()
    {
        $proyeks = Proyek::active()->get();
        return view('proyeks.index', compact('proyeks'));
    }

    public function create()
    {
        $pic = Karyawan::active()->get();
        return view('admin.master-data.form-add.proyek', compact('pic'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_mulai'       => 'required|date',
            'tgl_selesai'     => 'required|date',
            'no_kontrak'      => 'required|string|max:100',
            'hari_kalender'   => 'required|string|max:50',
            'nama_proyek'     => 'required|string|max:150',
            'nama_perusahaan' => 'required|string|max:150',
            'pic'             => 'required|string|max:150',
            'kategori'        => 'required|string|max:50',
            'jenis'           => 'required|string|max:50',
            'nilai_kontrak'   => 'required|numeric|min:0',
        ]);

        // generate kode akun P-00{id terakhir + 1}
        $lastId   = Proyek::max('id') ?? 0;
        $nextId   = $lastId + 1;
        $kodeAkun = 'P-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        Proyek::create([
            'kode_akun'      => $kodeAkun,
            'tgl_mulai'      => $request->tgl_mulai,
            'tgl_selesai'    => $request->tgl_selesai,
            'no_kontrak'     => $request->no_kontrak,
            'hari_kalender'  => $request->hari_kalender,
            'nama_proyek'    => $request->nama_proyek,
            'nama_perusahaan' => $request->nama_perusahaan,
            'pic'            => $request->pic,
            'kategori'       => $request->kategori,
            'jenis'          => $request->jenis,
            'nilai_kontrak'  => $request->nilai_kontrak,
            'created_by'     => Auth::check() ? Auth::user()->id : null,
        ]);
        return redirect()->route('master-data.index')->with('success', 'Proyek berhasil ditambahkan');
    }

    public function edit($id)
    {
        $proyek = Proyek::findOrFail($id);
        $pic = Karyawan::active()->get();
        return view('admin.master-data.form-edit.proyek', compact('proyek', 'pic'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_mulai'       => 'nullable|date',
            'tgl_selesai'     => 'nullable|date',
            'no_kontrak'      => 'nullable|string|max:100',
            'hari_kalender'   => 'nullable|string|max:50',
            'nama_proyek'     => 'required|string|max:150',
            'nama_perusahaan' => 'required|string|max:150',
            'pic'             => 'required|string|max:150',
            'kategori'        => 'nullable|string|max:50',
            'jenis'           => 'nullable|string|max:50',
            'nilai_kontrak'   => 'required|numeric|min:0',
        ]);

        $proyek = Proyek::findOrFail($id);

        $proyek->update([
            'tgl_mulai'      => $request->tgl_mulai,
            'tgl_selesai'    => $request->tgl_selesai,
            'no_kontrak'     => $request->no_kontrak,
            'hari_kalender'  => $request->hari_kalender,
            'nama_proyek'    => $request->nama_proyek,
            'nama_perusahaan' => $request->nama_perusahaan,
            'pic'            => $request->pic,
            'kategori'       => $request->kategori,
            'jenis'          => $request->jenis,
            'nilai_kontrak'  => $request->nilai_kontrak,
        ]);
        return redirect()->route('master-data.index')->with('success', 'Proyek berhasil diupdate');
    }

    public function destroy($id)
    {
        $proyek = Proyek::findOrFail($id);
        $proyek->update(['deleted_at' => Carbon::now('Asia/Jakarta')]); // manual soft delete
        return redirect()->route('master-data.index')->with('success', 'Proyek berhasil dihapus (soft delete)');
    }
}
