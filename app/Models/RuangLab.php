<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangLab extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'ruang',
        'lokasi',
        'status'
    ];

    public function ruangans()
    {
        return $this->hasMany(Ruangan::class, 'ruang_lab', 'id');
    }
}
