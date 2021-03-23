<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRuangan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nama_peminjam',
        'nim',
        'email',
        'no_hp',
        'afiliasi',
        'ruang_lab',
        'mata_kuliah',
        'kode_matkul',
        'dosen',
        'waktu',
        'hari',
        'validasi',
    ];

    public function peminjamanruangans()
    {
        return $this->hasMany(PeminjamanRuangan::class, 'form_ruangan_id', 'id');
    }
}
