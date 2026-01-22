<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KasbonTukang extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'kasbon_tukangs';

    protected $fillable = [
        'tanggal',
        'kode_kasbon',
        'nama_tukang',
        'nama_akun',
        'nama_proyek',
        'kode_kas',
        'total',
        'created_by',
        'deleted_at',
    ];

    // Relasi: KasbonTukang punya banyak TukangContent
    public function contents()
    {
        return $this->hasMany(TukangContent::class, 'kode_kasbon', 'kode_kasbon')
                    ->whereNull('deleted_at');
    }
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
