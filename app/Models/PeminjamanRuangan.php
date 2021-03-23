<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanRuangan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'form_ruangan_id',
        'minggu'
    ];

    public function formruangan()
    {
        return $this->belongsTo(FormRuangan::class, 'form_ruangan_id', 'id');
    }
}
