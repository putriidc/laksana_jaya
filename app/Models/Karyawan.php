<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'kode_karyawan',
        'kode_akun',
        'nama',
        'pekerja',
        'jabatan',
        'alamat',
        'no_hp',
        'email',
        'created_by',
        'deleted_at',
    ];

    // Scope untuk ambil data aktif (belum dihapus)
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
     // Relasi ke PinjamanKaryawan
    public function pinjaman()
    {
        return $this->hasMany(PinjamanKaryawan::class, 'kode_karyawan', 'kode_karyawan');
    }
}
