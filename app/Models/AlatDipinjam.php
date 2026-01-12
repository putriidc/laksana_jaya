<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatDipinjam extends Model
{
    use HasFactory;

    protected $table = 'alat_dipinjams';

    protected $fillable = [
        'kode_alat',
        'kode_akun',
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
