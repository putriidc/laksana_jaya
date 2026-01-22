<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PinjamanContent extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'kode_karyawan',
        'kode_kas',
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
