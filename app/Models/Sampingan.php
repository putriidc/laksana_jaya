<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sampingan extends Model
{
    use HasFactory;
    use SoftDeletes;


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
