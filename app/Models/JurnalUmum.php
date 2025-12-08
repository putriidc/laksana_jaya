<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalUmum extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_content',
        'kode_jurnal',
        'tanggal',
        'keterangan',
        'nama_perkiraan',
        'kode_perkiraan',
        'nama_proyek',
        'kode_proyek',
        'debit',
        'kredit',
        'created_by',
        'deleted_at',
    ];

    // Scope untuk ambil data aktif (belum dihapus)
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
