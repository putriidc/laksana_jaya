<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_karyawan',
        'ket_owner',
        'kontrak',
        'tanggal',
        'sisa',
        'bayar',
        'jenis',
        'menunggu',
        'setuju',
        'tolak',
        'created_by',
        'deleted_at',
    ];

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    // Relasi ke PinjamanKaryawan
    public function karyawanPinjaman()
    {
        return $this->belongsTo(PinjamanKaryawan::class, 'kode_karyawan', 'kode_karyawan');
    }
    public function kas()
    {
        return $this->belongsTo(Asset::class, 'kode_kas', 'kode_akun')
                    ->whereNull('deleted_at');
    }
}
