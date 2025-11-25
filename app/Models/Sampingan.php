<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tgl_mulai',
        'tgl_selesai',
        'gaji',
        'hari',
        'tambahan',
        'kasbon',
        'created_by',
        'deleted_at',
    ];

    // Scope untuk ambil data aktif (belum dihapus)
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
