<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatDihapus extends Model
{
    use HasFactory;

    // Paksa Laravel menggunakan nama tabel ini
    protected $table = 'alat_dihapus';

    protected $fillable = [
        'kode_alat',
        'tanggal',
        'keterangan',
        'qty',
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
