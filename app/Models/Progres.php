<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progres extends Model
{
    protected $fillable = [
        'kode_paket','minggu','persen','created_by','deleted_at'
    ];

    public function dataPerusahaan()
    {
        return $this->belongsTo(DataPerusahaan::class, 'kode_paket', 'kode_paket');
    }
}
