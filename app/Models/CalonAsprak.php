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
        'ktm'
    ];

    public function penilaianaspraks()
    {
        return $this->hasMany(Penilaian::class, 'calon_asprak_id', 'id');
    }
}
