<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Progres extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_paket','minggu','persen', 'keterangan','created_by','deleted_at'
    ];

    public function dataPerusahaan()
    {
        return $this->belongsTo(DataPerusahaan::class, 'kode_paket', 'kode_paket');
    }
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
