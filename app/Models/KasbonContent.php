<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasbonContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_karyawan',
        'kontrak',
        'tanggal',
        'kasbon',
        'bayar',
        'created_by',
        'deleted_at',
    ];

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    // Relasi ke PinjamanKaryawan
    public function karyawanKasbon()
    {
        return $this->belongsTo(PinjamanKaryawan::class, 'kode_karyawan', 'kode_karyawan');
    }
}
