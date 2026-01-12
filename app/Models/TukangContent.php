<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TukangContent extends Model
{
    use HasFactory;

    protected $table = 'tukang_contents';

    protected $fillable = [
        'tanggal',
        'kode_kasbon',
        'kode_kas',
        'ket_spv',
        'ket_owner',
        'status_spv',
        'status_owner',
        'jenis',
        'kontrak',
        'bayar',
        'sisa',
        'created_by',
        'deleted_at',
    ];

    // Relasi: TukangContent milik satu KasbonTukang
    public function kasbon()
    {
        return $this->belongsTo(KasbonTukang::class, 'kode_kasbon', 'kode_kasbon')
                    ->whereNull('deleted_at');
    }
    public function kas()
    {
        return $this->belongsTo(Asset::class, 'kode_kas', 'kode_akun')
                    ->whereNull('deleted_at');
    }
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
