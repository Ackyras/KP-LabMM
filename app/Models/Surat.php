<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'perihal',
        'pengirim',
        'penerima',
        'nomor',
        'lokasi',
        'kategori',
        'tanggal_masuk',
        'file'
    ];
}
