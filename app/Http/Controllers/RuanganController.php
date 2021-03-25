<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function form()
    {
        return view('barang.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam'         => ['required', 'max:255'],
            'nim'                   => ['required', 'regex:/[0-9]+/', 'min:8', 'max:9'],
            'email'                 => ['email', 'required'],
            'no_hp'                 => ['max:13', 'required', 'regex:/[0-9]+/'],
            'afiliasi'              => ['required'],
            'ruang_lab'             => ['required'],
            'mata_kuliah'           => ['required'],
            'kode_matkul'           => ['required'],
            'dosen'                 => ['required'],
            'waktu'                 => ['required'],
            'hari'                  => ['in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu', 'required'],
            'minggu'                => ['required', 'numeric', 'min:1', 'max:16', 'array'],
            'minggu.*'              => ['required', 'numeric', 'min:1', 'max:16', 'distinct'],
        ]);

        // !BELOM SELESAI
    }
}
