<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perusahaan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_perusahaan','nama_perusahaan','created_by','deleted_at'
    ];

    public function dataPerusahaans()
    {
        return $this->hasMany(DataPerusahaan::class, 'kode_perusahaan', 'kode_perusahaan');
    }
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
