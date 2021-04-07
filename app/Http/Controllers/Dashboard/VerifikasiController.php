<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CalonAsprak;
use App\Models\DaftarMataKuliah;
use App\Models\PenilaianAsprak;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $aspraks = CalonAsprak::latest()->get();
        $pilihans = PenilaianAsprak::with('matakuliah')->get();
        $daftar_matkuls = DaftarMataKuliah::has('matakuliahs')->get();
        return view('dashboard.pendaftaran.verifikasi.index', compact('aspraks', 'pilihans', 'daftar_matkuls'));
    }

    public function verifikasi(Request $request)
    {
    }
}
