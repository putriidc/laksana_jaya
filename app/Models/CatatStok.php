<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatStok extends Model
{
    use HasFactory;

    // Paksa Laravel menggunakan nama tabel ini
    protected $table = 'catat_stok';

    protected $fillable = [
        'kode_kartu',
        'kode_alat',
        'qty',
        'keterangan',
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
