<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_alat',
        'tanggal',
        'nama_alat',
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
    public function alatDibeli()
    {
        return $this->hasMany(alatDibeli::class, 'kode_alat', 'kode_alat');
    }
    public function alatDipinjam()
    {
        return $this->hasMany(alatDipinjam::class, 'kode_alat', 'kode_alat');
    }
    public function alatDikembalikan()
    {
        return $this->hasMany(alatDikembalikan::class, 'kode_alat', 'kode_alat');
    }
}
