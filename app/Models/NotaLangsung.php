<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotaLangsung extends Model
{
    use SoftDeletes;

    protected $table = 'nota_langsung';

    protected $fillable = [
        'kode_nota',
        'tanggal',
        'nama_proyek',
        'kode_akun',
        'kode_kas',
        'pic',
        'keterangan',
        'nominal',
        'detail_biaya',
        'created_by',
    ];
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
