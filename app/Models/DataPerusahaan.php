<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataPerusahaan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_perusahaan','kode_paket','nama_paket','pic','no_hp','mc0','korlap','kontraktor',
        'tgl_pho','tgl_ambil','kendala','is_pho','is_gambar','is_kontraktor_admin','is_pengawas_admin',
        'is_kontraktor_kontraktor','is_konsultan_kontraktor','created_by','deleted_at'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'kode_perusahaan', 'kode_perusahaan');
    }

    public function progres()
    {
        return $this->hasMany(Progres::class, 'kode_paket', 'kode_paket');
    }
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
