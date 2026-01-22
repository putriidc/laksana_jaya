<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JurnalUmum extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'id_content',
        'id_pinjam',
        'id_kasbon',
        'kode_vendor',
        'detail_eaf_id',
        'detail_order',
        'kode_jurnal',
        'tanggal',
        'keterangan',
        'kategori',
        'nama_perkiraan',
        'kode_perkiraan',
        'nama_proyek',
        'kode_proyek',
        'debit',
        'kredit',
        'created_by',
        'deleted_at',
    ];

    // Scope untuk ambil data aktif (belum dihapus)
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function detailEaf() {
        return $this->belongsTo(EafDetail::class, 'detail_eaf_id');
    }

}
