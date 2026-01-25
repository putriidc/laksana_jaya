<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sampingan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class SampinganOwnerController extends Controller
{
    public function index()
    {
        $sampingans = Sampingan::active()->get();
        return view('owner.freelance.data', compact('sampingans'));
    }

    public function print()
    {
        $sampingans = Sampingan::active()->get();
        $tanggalCetak = Carbon::now('Asia/Jakarta')->format('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->format('H:i');
        $role = Auth::user()->role ?? 'Admin';
        $admin = Auth::user()->name ?? 'Admin';

        $pdf = Pdf::loadView('owner.freelance.print', compact('sampingans', 'tanggalCetak', 'admin', 'role', 'jamCetak'))
            ->setPaper('A4', 'portrait');


        return $pdf->stream('laporan-freelance.pdf');
    }

    public function create()
    {
        return view('owner.freelance.form-add.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string',
            'tgl_mulai'  => 'nullable|date',
            'tgl_selesai' => 'nullable|date',
            'gaji'       => 'required|numeric|min:0',
            'hari'       => 'required|integer|min:0',
            'tambahan'   => 'nullable|numeric|min:0',
            'kasbon'     => 'nullable|numeric|min:0',
        ]);

        // Hitung total salary = gaji * hari
        $totalSalary = $request->gaji * $request->hari;

        // Hitung jumlah = total salary + tambahan
        $jumlah = $totalSalary + ($request->tambahan ?? 0);

        // Hitung total seluruh = jumlah - kasbon
        $totalSeluruh = $jumlah - ($request->kasbon ?? 0);

        Sampingan::create([
            'nama'       => $request->nama,
            'tgl_mulai'  => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'gaji'       => $request->gaji,
            'hari'       => $request->hari,
            'tambahan'   => $request->tambahan,
            'kasbon'     => $request->kasbon,
            'created_by' => Auth::user()->id ?? null, // kalau ada user login

            // field turunan bisa disimpan kalau kamu tambahkan di migration
            // misalnya: jumlah, total_salary, total_seluruh
        ]);

        return redirect()->route('sampingansOwner.index')->with('success', 'Data sampingan berhasil ditambahkan');
    }


    public function show($id)
    {
        $sampingan = Sampingan::findOrFail($id);
        return view('sampinganOwner.show', compact('sampingan'));
    }

    public function edit($id)
    {
        $sampingan = Sampingan::findOrFail($id);
        return view('owner.freelance.form-edit.index', compact('sampingan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'       => 'required|string',
            'tgl_mulai'  => 'nullable|date',
            'tgl_selesai' => 'nullable|date',
            'gaji'       => 'required|numeric|min:0',
            'hari'       => 'required|integer|min:0',
            'tambahan'   => 'nullable|numeric|min:0',
            'kasbon'     => 'nullable|numeric|min:0',
        ]);

        $sampingan = Sampingan::findOrFail($id);

        // Hitung ulang
        $totalSalary = $request->gaji * $request->hari;
        $jumlah = $totalSalary + ($request->tambahan ?? 0);
        $totalSeluruh = $jumlah - ($request->kasbon ?? 0);

        $sampingan->update([
            'nama'       => $request->nama,
            'tgl_mulai'  => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'gaji'       => $request->gaji,
            'hari'       => $request->hari,
            'tambahan'   => $request->tambahan,
            'kasbon'     => $request->kasbon,
            // field turunan bisa ikut diupdate kalau ada di tabel
        ]);

        return redirect()->route('sampingansOwner.index')->with('success', 'Data sampingan berhasil diupdate');
    }


    public function destroy($id)
    {
        $sampingan = Sampingan::findOrFail($id);
        $sampingan->update(['deleted_at' => Carbon::now('Asia/Jakarta')]); // manual soft delete

        return redirect()->route('sampingansOwner.index')->with('success', 'Data berhasil dihapus');
    }
}
