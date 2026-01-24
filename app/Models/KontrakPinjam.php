<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KontrakPinjam extends Model
{
    use SoftDeletes;

    protected $table = 'kontrak_pinjam';

    protected $fillable = [
        'id_pinjaman_content',
        'jangka_waktu',
        'angsuran',
        'created_by',
    ];

    // relasi ke PinjamanContent
    public function pinjamanContent()
    {
        return $this->belongsTo(PinjamanContent::class, 'id_pinjaman_content', 'id');
    }
}
