<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_akun',
        'tgl_mulai',
        'tgl_selesai',
        'no_kontrak',
        'hari_kalender',
        'nama_proyek',
        'nama_perusahaan',
        'pic',
        'kategori',
        'jenis',
        'nilai_kontrak',
        'created_by',
        'deleted_at',
    ];


    // Scope untuk ambil data aktif (belum dihapus)
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
