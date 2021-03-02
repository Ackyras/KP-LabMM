<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembukaan extends Model
{
    use HasFactory;

    protected $fillable=[
        'judul',
        'pendaftaran',
        'akhirpendaftaran',
    ];
}
