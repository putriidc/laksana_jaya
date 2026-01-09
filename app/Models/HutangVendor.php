<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HutangVendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hutang_vendor';

    protected $fillable = [
        'kode_vendor',
        'tgl_hutang',
        'tgl_jatuh_tempo',
        'kode_supplier',
        'nominal',
        'kode_proyek',
        'keterangan',
        'is_generate',
        'created_by',
    ];

    // Relasi ke Supplier (kode_supplier -> kode_akun)
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'kode_supplier', 'kode_akun');
    }

    // Relasi ke Proyek (kode_proyek -> kode_akun)
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'kode_proyek', 'kode_akun');
    }
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
