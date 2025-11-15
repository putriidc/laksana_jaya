<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiutangHutang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'akun_header',
        'created_by',
        'deleted_at',
    ];

    // Scope untuk ambil data aktif (belum dihapus)
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}

