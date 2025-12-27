<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EafDetail extends Model
{
    use SoftDeletes;

    protected $table = 'eaf_detail';

    protected $fillable = [
        'kode_eaf',
        'tanggal',
        'keterangan',
        'kategori',
        'kode_akun',
        'nama_akun',
        'debit',
        'kredit',
        'is_generate',
        'created_by',
        'deleted_at'
    ];
    protected $casts = [ 'is_generate' => 'boolean', ];

    public function eaf()
    {
        return $this->belongsTo(Eaf::class, 'kode_eaf', 'kode_eaf');
    }

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
