<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanKaryawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_karyawan',
        'nama_karyawan',
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
}
