<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormBarang extends Model
{
    use HasFactory;

    protected $table = 'form_barang';

    public $timestamps = false;

    protected $fillable = [
        'nama_peminjam',
        'nim',
        'email',
        'no_hp',
        'afiliasi',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'keperluan',
        'tempat',
        'updated_at'
    ];

    public function peminjamanbarangs()
    {
        return $this->hasMany(PeminjamanBarang::class, 'form_barang_id', 'id');
    }
}
