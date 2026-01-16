<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Eaf;
use App\Models\Asset;
use App\Models\EafDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AccEafOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eaf_needAcc = Eaf::with('bank')
            ->whereNull('deleted_at')
            ->where('acc_owner', 'pending')
            ->get();

        $eaf = Eaf::with('bank')
            ->whereNull('deleted_at')
            ->whereHas('bank') // hanya ambil yang punya relasi
            ->where(function ($query) {
                $query->where('acc_owner', '!=', 'accept')
                    ->orWhere('acc_owner', '!=', 'decline');
            })
            ->get();

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        return view('owner.pengajuan-eaf.data', compact('eaf', 'today', 'eaf_needAcc'));
    }

    public function print()
    {
        $eafs = Eaf::with('bank') // tambahkan eager load relasi
            ->whereNull('deleted_at')
            ->where(function ($query) {
                $query->where('acc_owner', '!=', 'accept')
                    ->orWhere('acc_owner', '!=', 'decline');
            })
            ->get();

        $owner = Auth::user()->name ?? 'Rian';
        $role = Auth::user()->role ?? 'owner';
        $tanggalCetak = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        $jamCetak = Carbon::now('Asia/Jakarta')->translatedFormat('H:i');

        $pdf = Pdf::loadView('owner.pengajuan-eaf.print', compact('eafs', 'owner', 'role', 'tanggalCetak', 'jamCetak'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Form-acc-eaf.pdf');
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
            'id_eaf' => 'required',
        ]);

        $eaf = Eaf::active()->findOrFail($request->id_eaf);

        // Update status  dulu
        $eaf->update([
            'acc_owner' => 'accept',
            'ket_owner' => 'accept',
        ]);
        if ($eaf->acc_spv === 'accept') {
            // Cek apakah sudah pernah generate
            $sudahAda = EafDetail::active()
                ->where('kode_eaf', $eaf->kode_eaf)
                ->exists();

            if (!$sudahAda) {
                $kas = Asset::active()
                    ->where('kode_akun', $eaf->kas)
                    ->first();

                $piutang = Asset::active()
                    ->where('nama_akun', 'Piutang Proyek')
                    ->first();

                if (!$kas || !$piutang) {
                    return back()->with('error', 'Akun kas atau piutang tidak ditemukan');
                }

                EafDetail::create([
                    'kode_eaf'   => $eaf->kode_eaf,
                    'tanggal'    => $eaf->tanggal,
                    'keterangan'    => 'keluar untuk ' . $eaf->nama_proyek,
                    'kode_akun'  => $kas->kode_akun,
                    'nama_akun'  => $kas->nama_akun,
                    'debit'      => 0,
                    'kredit'     => $eaf->nominal ?? 0,
                    'is_generate' => false,
                    'created_by' => Auth::user()->id ?? 'system',
                ]);

                EafDetail::create([
                    'kode_eaf'   => $eaf->kode_eaf,
                    'tanggal'    => $eaf->tanggal,
                    'keterangan'    => 'kas ' . $eaf->nama_proyek,
                    'kode_akun'  => $piutang->kode_akun,
                    'nama_akun'  => $piutang->nama_akun,
                    'debit'      => $eaf->nominal ?? 0,
                    'kredit'     => 0,
                    'is_generate' => false,
                    'created_by' => Auth::user()->id ?? 'system',
                ]);
            }
        }

        return redirect()->route('AccEafOwner.index')
            ->with('success', 'Status EAF berhasil disetujui');
    }

    public function decline(Request $request, $id)
    {
        $eaf = Eaf::findOrFail($id);

        $eaf->acc_owner = 'decline';
        $eaf->ket_owner = $request->ket_spv; // ambil alasan dari input
        $eaf->save();

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan Eaf berhasil ditolak'
        ]);
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
