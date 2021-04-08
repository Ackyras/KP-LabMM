<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRuangan extends Model
{
    use HasFactory;

    protected $table = 'form_ruangan';

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
        'keterangan'
    ];

    public function peminjamanruangans()
    {
        return $this->hasMany(PeminjamanRuangan::class, 'form_ruangan_id', 'id');
    }

    public function ruanglab()
    {
        return $this->belongsTo(RuangLab::class, 'ruang_lab', 'id');
    }
}
