<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrakProyek extends Model
{
    protected $fillable = ['kode_proyek', 'nama_proyek', 'nilai_kontrak', 'dpp', 'ppn_persen', 'ppn', 'pph', 'pph_persen', 'sisa_potong_pajak', 'fee_dinas_persen', 'fee_dinas', 'net_persen', 'net', 'keuntungan', 'real_untung', 'created_by',];
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'kode_proyek', 'kode_akun');
    }
}
