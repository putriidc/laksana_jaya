<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'kode_barang',
        'tanggal',
        'nama_barang',
        'kategori',
        'spesifikasi',
        'satuan',
        'stok',
        'foto',
        'created_by',
        'deleted_at',
    ];

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    // Relasi: Barang punya banyak BarangMasuk
    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'kode_barang', 'kode_barang');
    }

    // Relasi: Barang punya banyak BarangKeluar
    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class, 'kode_barang', 'kode_barang');
    }
}
