<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatatStok extends Model
{
    use HasFactory;
    use SoftDeletes;


    // Paksa Laravel menggunakan nama tabel ini
    protected $table = 'catat_stok';

    protected $fillable = [
        'kode_kartu',
        'kode_alat',
        'qty',
        'keterangan',
        'proyek',
        'pic',
        'tanggal',
        'refrensi',
        'created_by',
        'deleted_at',
    ];
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    // Relasi ke Barang
    public function alat()
    {
        return $this->belongsTo(Alat::class, 'kode_alat', 'kode_alat');
    }
}
