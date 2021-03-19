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
        'jumlah_1',
        'jumlah_2',
        'jumlah_3',
        'jumlah_4',
        'jumlah_5',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'kd_barang_1',
        'kd_barang_2',
        'kd_barang_3',
        'kd_barang_4',
        'kd_barang_5',
        'updated_at'
    ];

    public function peminjamanbarang()
    {
        return $this->hasMany(PeminjamanBarang::class);
    }
}
