<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    protected $table = 'qr_codes';

    protected $fillable = [
        'valid_for',
        'valid_until',
        'token',
    ];

    public function asprak()
    {
        return $this->belongsToMany(Asprak::class, 'presensis')->withTimestamps();
    }
}
