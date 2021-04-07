<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CalonAsprak;
use App\Models\DaftarMataKuliah;
use App\Models\PenilaianAsprak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifikasiController extends Controller
{
    public function index()
    {
        $aspraks = CalonAsprak::latest()->get();
        $matkuls = PenilaianAsprak::with('calonasprak')->get();
        // dd(DB::table('penilaian_aspraks')->join('mata_kuliahs', 'mata_kuliahs.mata_kuliah_id', '=', 'penilaian_aspraks.mata_kuliah_id')->join('daftar_mata_kuliahs', 'daftar_mata_kuliahs.id', '=', 'mata_kuliahs.mata_kuliah_id')->select('daftar_mata_kuliahs.nama')->first());

        return view('dashboard.pendaftaran.verifikasi.index', compact('aspraks', 'matkuls'));
    }

    public function verifikasi(Request $request)
    {
    }
}
