<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asprak extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'tanggallahir',
        'prodi',
        'angkatan',
        'mata_kuliah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function presensi()
    {
        return $this->belongsToMany(QrCode::class, 'presensis')->withTimestamps();
    }
}
