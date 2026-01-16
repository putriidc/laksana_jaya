<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangRetur extends Model
{
    use HasFactory;
    protected $table = 'barang_retures';
    protected $fillable = [
        'kode_barang',
        'tanggal',
        'keterangan',
        'kode_akun',
        'qty',
        'created_by',
        'deleted_at',
    ];
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
