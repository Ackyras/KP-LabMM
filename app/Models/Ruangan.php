<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'waktu',
        'hari',
        'minggu',
        'status',
        'updated_at'
    ];

    public function peminjamanruangans()
    {
        return $this->hasMany(PeminjamanRuangan::class, 'ruangan_id', 'id');
    }
}
