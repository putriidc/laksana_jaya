<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanKaryawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'kode_karyawan',
        'total_pinjam',
        'total_kasbon',
        'created_by',
        'deleted_at',
    ];

    // Scope untuk ambil data aktif (belum dihapus)
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    // Relasi ke Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'kode_karyawan', 'kode_karyawan');
    }
    public function pinjamanContent()
    {
        return $this->hasMany(PinjamanContent::class, 'kode_karyawan', 'kode_karyawan');
    }

    public function kasbonContent()
    {
        return $this->hasMany(KasbonContent::class, 'kode_karyawan', 'kode_karyawan');
    }
}
