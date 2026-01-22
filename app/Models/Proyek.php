<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyek extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'kode_akun',
        'tgl_mulai',
        'tgl_selesai',
        'no_kontrak',
        'hari_kalender',
        'nama_proyek',
        'nama_perusahaan',
        'pic',
        'kategori',
        'jenis',
        'nilai_kontrak',
        'created_by',
        'deleted_at',
    ];


    // Scope untuk ambil data aktif (belum dihapus)
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    public function kontrak()
    {
        return $this->hasOne(KontrakProyek::class, 'kode_proyek', 'kode_akun');
    }
    public function picRelation()
    {
        return $this->belongsTo(Karyawan::class, 'pic', 'nama');
    }
}
