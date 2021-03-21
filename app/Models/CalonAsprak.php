<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonAsprak extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'tanggal_lahir',
        'program_studi',
        'angkatan',
        'cv',
        'khs',
        'ktm',
        'pil1',
        'pil2',
        'pil3',
    ];
}
