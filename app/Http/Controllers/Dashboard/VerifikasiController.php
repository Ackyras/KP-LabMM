<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CalonAsprak;
use App\Models\DaftarMataKuliah;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use App\Models\PenilaianAsprak;
use App\Models\User;
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
        $aspraks = CalonAsprak::where('periode', $this->pembukaan_id->id)
            ->where('status', 0)
            ->orderBy('created_at', 'desc')
            ->simplePaginate(20);
        $pilihans = PenilaianAsprak::with('matakuliah')->get();
        $daftar_matkuls = DaftarMataKuliah::has('matakuliahs')->get();
        return view('dashboard.pendaftaran.verifikasi.index', compact('aspraks', 'pilihans', 'daftar_matkuls'));
    }

    public function verifikasiberkas(Request $request)
    {
        $calon = CalonAsprak::where('id', $request->input('id'))->first();
        switch ($request->input('action')) {
            case '0':
                CalonAsprak::where('id', $calon->id)->delete();
                break;
            case '1':
                CalonAsprak::where('id', $calon->id)
                    ->update(
                        [
                            'status'    => 2
                        ]
                    );
                //KIRIM NOTIFIKASI TIDAK LULUS BERKAS
                break;
            case '2':
                $password = uniqid();
                DB::transaction(
                    function () use ($password, $calon) {
                        CalonAsprak::where('id', $calon->id)
                            ->update(
                                [
                                    'password'  => bcrypt($password),
                                    'status'    => 1
                                ]
                            );
                        $akun = User::create(
                            [
                                'name'      => $calon->nama,
                                'username'  => preg_replace("/\s+/", "", strtolower($calon->nama . '.' . $calon->nim)),
                                'role'      => 'calonasprak',
                                'email'     => $calon->email,
                                'password'  => bcrypt($password)
                            ]
                        );
                        // KIRIM NOTIFIKASI LULUS
                    }
                );
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
                    'nilai' => $request->input('nilai')
                ]
            );
        return redirect()->route('asprak.nilai.index');
    }

    public function verifikasilulus(Request $request)
    {
        $calon = CalonAsprak::where('id', $request->input('id'))->first();
        switch ($request->input('action')) {
            case '1':
                DB::transaction(
                    function () use ($calon, $request) {
                        CalonAsprak::where('id', $calon->id)
                            ->update(
                                [
                                    'status'    => '3'
                                ]
                            );
                        User::where('email', $calon->email)->delete();
                        $lulus = PenilaianAsprak::where('calon_asprak_id', $calon->id)
                            ->where('mata_kuliah_id', $request->input('mata_kuliah_id'))
                            ->update(['lulus' => 1]);
                        $lulus =  PenilaianAsprak::where('calon_asprak_id', $calon->id)
                            ->where('mata_kuliah_id', $request->input('mata_kuliah_id'))
                            ->first();
                        $mata_kuliah = MataKuliah::where('id', $lulus->mata_kuliah_id)->first();
                        $mata_kuliah = DaftarMataKuliah::where('id', $mata_kuliah->mata_kuliah_id)
                            ->pluck('nama')
                            ->first();
                        // KIRIM NOTIFIKASI LULUS ASPRAK
                    }
                );
                break;
            case '2':
                DB::transaction(
                    function () use ($calon) {
                        CalonAsprak::where('id', $calon->id)
                            ->update(
                                [
                                    'status'    => '3'
                                ]
                            );
                        User::where('email', $calon->email)->delete();
                        // KIRIM NOTIFIKASI LULUS TIDAK LULUS ASPRAK
                    }
                );
                break;
        }
    }
}
