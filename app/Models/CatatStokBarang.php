<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatStokBarang extends Model
{
    use HasFactory;

    // Paksa Laravel menggunakan nama tabel ini
    protected $table = 'catat_stok_barang';

    protected $fillable = [
        'kode_kartu',
        'kode_barang',
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
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
