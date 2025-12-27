<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Progres;
use App\Models\Karyawan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\PiutangHutang;
use App\Models\DataPerusahaan;
use Illuminate\Support\Facades\Auth;

class DataPerusahaanController extends Controller
{
    public function index()
    {
        $dataPerusahaans = DataPerusahaan::with('perusahaan')->whereNull('deleted_at')->get();
        return view('data_perusahaan.index', compact('dataPerusahaans'));
    }

    public function create($kode_perusahaan)
    {
        // Ambil perusahaan berdasarkan kode
        $perusahaan = Perusahaan::where('kode_perusahaan', $kode_perusahaan)->firstOrFail();

        // Ambil PIC dari PiutangHutang (akun_header yang diawali 'PIC')
        $pics = Karyawan::whereNull('deleted_at')->get();

        return view('kepala-proyek.data-proyek.form-add.form-add', compact('perusahaan', 'pics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_perusahaan' => 'required|exists:perusahaans,kode_perusahaan',
            'nama_paket'      => 'required|string|max:255',
            'pic'             => 'nullable|string',
            'no_hp'           => 'nullable|string',
            'mc0'             => 'nullable|date',
            'korlap'          => 'nullable|string',
            'kontraktor'      => 'nullable|string',
            'tgl_pho'         => 'nullable|date',
            'tgl_ambil'       => 'nullable|date',
            'kendala'         => 'nullable|string',
            'minggu'          => 'required|integer|min:1',
            'persen'          => 'required|integer|min:0|max:100',
        ]);

        // Generate kode_paket otomatis
        $last = DataPerusahaan::orderBy('id', 'desc')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $kodePaket = 'PK-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        // Simpan DataPerusahaan
        $dataPerusahaan = DataPerusahaan::create([
            'kode_perusahaan'        => $request->kode_perusahaan,
            'kode_paket'             => $kodePaket,
            'nama_paket'             => $request->nama_paket,
            'pic'                    => $request->pic,
            'no_hp'                  => $request->no_hp,
            'mc0'                    => $request->mc0,
            'korlap'                 => $request->korlap,
            'kontraktor'             => $request->kontraktor,
            'tgl_pho'                => $request->tgl_pho,
            'tgl_ambil'              => $request->tgl_ambil,
            'kendala'                => $request->kendala,
            'is_pho'                 => $request->has('is_pho'),
            'is_kontraktor_admin'    => $request->has('is_kontraktor_admin'),
            'is_pengawas_admin'      => $request->has('is_pengawas_admin'),
            'is_kontraktor_kontraktor' => $request->has('is_kontraktor_kontraktor'),
            'is_konsultan_kontraktor'  => $request->has('is_konsultan_kontraktor'),
            'created_by'             => Auth::check() ? Auth::user()->id : null,
        ]);

        // Simpan progres pertama
        Progres::create([
            'kode_paket' => $kodePaket,
            'minggu'     => $request->minggu,
            'persen'     => $request->persen,
            'created_by' => Auth::check() ? Auth::user()->id : null,
        ]);
        $data = Perusahaan::where('kode_perusahaan', $request->kode_perusahaan)
            ->whereNull('deleted_at')
            ->firstOrFail();

        return redirect()->route('perusahaan.show', $data->id)
            ->with('success', 'Data perusahaan berhasil ditambahkan');
    }

    public function show($id)
    {
        // Ambil data perusahaan berdasarkan id
        $dataPerusahaan = DataPerusahaan::with('perusahaan')->findOrFail($id);

        // Ambil semua progres yang terkait dengan kode_paket
        $progres = Progres::where('kode_paket', $dataPerusahaan->kode_paket)
            ->whereNull('deleted_at')
            ->orderBy('minggu', 'asc')
            ->get();

        // Hitung total progres (maksimal 100%)
        $totalProgress = $progres->sum('persen');
        if ($totalProgress > 100) {
            $totalProgress = 100;
        }

        return view('kepala-proyek.data-proyek.detail.detail', compact('dataPerusahaan', 'progres', 'totalProgress'));
    }


    public function edit($id)
    {
        $dataPerusahaan = DataPerusahaan::with('perusahaan')->findOrFail($id);
        $pics = PiutangHutang::where('akun_header', 'like', 'PIC%')->get();
        $progres = Progres::where('kode_paket', $dataPerusahaan->kode_paket)
            ->whereNull('deleted_at')
            ->orderBy('minggu', 'asc')
            ->get();

        $totalProgress = min($progres->sum('persen'), 100);

        return view('kepala-proyek.data-proyek.form-edit.form-edit', compact('progres', 'totalProgress', 'dataPerusahaan',  'pics'));
    }

    public function update(Request $request, $id)
    {
        $dataPerusahaan = DataPerusahaan::findOrFail($id);

        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'kode_perusahaan' => 'required',
            'pic'        => 'nullable|string',
            'no_hp'      => 'nullable|string',
            'mc0'        => 'nullable|date',
            'korlap'     => 'nullable|string',
            'kontraktor' => 'nullable|string',
            'tgl_pho'    => 'nullable|date',
            'tgl_ambil'  => 'nullable|date',
            'kendala'    => 'nullable|string',
        ]);

        $dataPerusahaan->update([
            'nama_paket'             => $request->nama_paket,
            'pic'                    => $request->pic,
            'no_hp'                  => $request->no_hp,
            'mc0'                    => $request->mc0,
            'korlap'                 => $request->korlap,
            'kontraktor'             => $request->kontraktor,
            'tgl_pho'                => $request->tgl_pho,
            'tgl_ambil'              => $request->tgl_ambil,
            'kendala'                => $request->kendala,
            'is_pho'                 => $request->has('is_pho'),
            'is_kontraktor_admin'    => $request->has('is_kontraktor_admin'),
            'is_pengawas_admin'      => $request->has('is_pengawas_admin'),
            'is_kontraktor_kontraktor' => $request->has('is_kontraktor_kontraktor'),
            'is_konsultan_kontraktor'  => $request->has('is_konsultan_kontraktor'),
        ]);
        $data = Perusahaan::where('kode_perusahaan', $request->kode_perusahaan)
            ->whereNull('deleted_at')
            ->firstOrFail();

        return redirect()->route('perusahaan.show', $data->id)->with('success', 'Data perusahaan berhasil diupdate');
    }

    public function storeProgres(Request $request, $id)
    {
        $dataPerusahaan = DataPerusahaan::findOrFail($id);

        $request->validate([
            'minggu' => 'required|integer|min:1',
            'persen' => 'required|integer|min:0|max:100',
        ]);

        Progres::create([
            'kode_paket' => $dataPerusahaan->kode_paket,
            'minggu'     => $request->minggu,
            'persen'     => $request->persen,
            'created_by' => Auth::check() ? Auth::user()->id : null,
        ]);

        return redirect()->route('data-perusahaan.edit', $id)->with('success', 'Progres baru berhasil ditambahkan');
    }

    public function updateProgres(Request $request, $progresId)
{
    $progres = Progres::findOrFail($progresId);

    $request->validate([
        'minggu' => 'required|integer|min:1',
        'persen' => 'required|integer|min:0|max:100',
    ]);

    $progres->update([
        'minggu' => $request->minggu,
        'persen' => $request->persen,
    ]);

    return redirect()->route('data-perusahaan.edit', $progres->dataPerusahaan->id)
        ->with('success', 'Progres berhasil diupdate');
}


    public function destroy($id)
    {
    $dataPerusahaan = DataPerusahaan::findOrFail($id);

    // Soft delete DataPerusahaan
    $dataPerusahaan->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);

    // Soft delete semua progres yang terkait dengan kode_paket
    Progres::where('kode_paket', $dataPerusahaan->kode_paket)
        ->update(['deleted_at' => Carbon::now('Asia/Jakarta')]);

        $data = Perusahaan::where('kode_perusahaan', $dataPerusahaan->kode_perusahaan)
            ->whereNull('deleted_at')
            ->firstOrFail();
    return redirect()->route('perusahaan.show', $data->id)
        ->with('success', 'Data perusahaan dan progres terkait berhasil dihapus');
    }
}
