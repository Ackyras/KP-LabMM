<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'form_barang_id',
        'barang_id',
        'jumlah'
    ];

    public function formbarang()
    {
        return $this->belongsTo(FormBarang::class);
    }

    public function inventaris()
    {
        return $this->belongsTo(Inventaris::class, 'barang_id', 'id');
    }
}
