<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'for_admin',
        'akun_header',
        'post_saldo',
        'post_laporan',
        'created_by',
        'deleted_at',
    ];

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    public function jurnalUmum()
    {
        return $this->hasMany(JurnalUmum::class, 'kode_perkiraan', 'kode_akun');
    }
}
