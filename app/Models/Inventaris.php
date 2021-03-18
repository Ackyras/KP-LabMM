<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'barang';

    public $timestamps = false;

    protected $fillable = [
        'kd_barang',
        'nama_barang',
        'foto',
        'lokasi',
        'kategori',
        'stok',
        'peminjaman',
        'status',
        'masuk_barang',
        'updated_at'
    ];
}
