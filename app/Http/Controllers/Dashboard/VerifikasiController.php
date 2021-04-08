<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CalonAsprak;
use App\Models\DaftarMataKuliah;
use App\Models\PembukaanAsprak;
use App\Models\PenilaianAsprak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifikasiController extends Controller
{
    protected $pembukaan_id;

    public function __construct()
    {
        $this->pembukaan_id = PembukaanAsprak::latest()->first();
    }

    public function index()
    {
        $aspraks = CalonAsprak::where('periode', $this->pembukaan_id)
            ->where('status', 0)
            ->orderBy('created_at', 'desc')
            ->simplePaginate(20);
        $pilihans = PenilaianAsprak::with('matakuliah')->get();
        $daftar_matkuls = DaftarMataKuliah::has('matakuliahs')->get();
        return view('dashboard.pendaftaran.verifikasi.index', compact('aspraks', 'pilihans', 'daftar_matkuls'));
    }

    public function verifikasiberkas(Request $request)
    {
        switch ($request->input('action')) {
            case '0':
                CalonAsprak::where('id', $request->input('id'))->delete();
                break;
            case '1':
                // KIRIM NOTIFIKASI
            case '2':
                $password = uniqid();
                CalonAsprak::where('id', $request->input('id'))
                    ->update(
                        [
                            'password'  => bcrypt($password),
                            'status'    => 1
                        ]
                    );
                // KIRIM NOTIFIKASI
                break;
        }

        return redirect()->route('asprak.index');
    }

    public function indexnilai()
    {
        $aspraks = CalonAsprak::latest()->where('periode', $this->pembukaan_id)
            ->where('status', 1)
            ->simplePaginate(20);
        $penilaian = PenilaianAsprak::with('matakuliah')->get();
        $daftar_matkuls = DaftarMataKuliah::has('matakuliahs')->get();
        return view('dashboard.pendaftaran.penilaian.index', compact('aspraks', 'pilihans', 'daftar_matkuls'));
    }

    public function penilaian(Request $request)
    {
        PenilaianAsprak::where('id', $request->input('penilaian_id'))
            ->update(
                [
                    'nilai' => $request->nilai
                ]
            );
        return redirect()->route('asprak.nilai.index');
    }

    public function verifikasilulus(Request $request)
    {
        switch ($request->input('action')) {
            case '1':
                CalonAsprak::where('id', $request->input('id'))
                    ->update(
                        [
                            'status'    => '3'
                        ]
                    );
                break;
                // KIRIM NOTIFIKASI LULUS
            case '2':
                CalonAsprak::where('id', $request->input('id'))
                    ->update(
                        [
                            'status'    => '4'
                        ]
                    );
                break;
                // KIRIM NOTIFIKASI TIDAK LULUS
        }
    }
}
