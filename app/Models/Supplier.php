<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'suppliers';

    protected $fillable = [
        'kode_akun',
        'nama',
        'alamat',
        'no_hp',
        'marketing',
        'created_by',
    ];
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
