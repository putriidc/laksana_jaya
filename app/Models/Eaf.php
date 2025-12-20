<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eaf extends Model
{
    use SoftDeletes;

    protected $table = 'eaf';

    protected $fillable = [
        'kode_eaf',
        'tanggal',
        'nama_proyek',
        'pic',
        'kas',
        'keterangan',
        'nominal',
        'acc_owner',
        'acc_spv',
        'ket_owner',
        'ket_spv',
        'detail_biaya',
        'created_by',
        'deleted_at'
    ];

    public function details()
    {
        return $this->hasMany(EafDetail::class, 'kode_eaf', 'kode_eaf');
    }

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    public function bank()
{
    return $this->belongsTo(Asset::class, 'kas', 'kode_akun');
}

}
