<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $fillable = [
        'kode_perusahaan','nama_perusahaan','created_by','deleted_at'
    ];

    public function dataPerusahaans()
    {
        return $this->hasMany(DataPerusahaan::class, 'kode_perusahaan', 'kode_perusahaan');
    }
}
