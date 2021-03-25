<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FormRuangan;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanRuanganController extends Controller
{
    public function index()
    {
        $ruangans = FormRuangan::where('validasi', 1)
            ->orderByDesc('created_at')
            ->get();
        $peminjamans = PeminjamanRuangan::all();
        return view('dahsboard.peminjaman.ruangan.index', compact('ruangans', 'peminjamans'));
    }

    public function status(Request $request)
    {
        $id = $request->input('form_id');
        switch ($request->input('action')) {
            case '0':
                DB::transaction(function () use ($id) {
                    FormRuangan::where('id', $id)->update([
                        'validasi'  => 0
                    ]);
                    $peminjamans = PeminjamanBarang::where('form_ruangan_id', $id)->get();
                    foreach ($peminjamans as $peminjaman) {
                        Ruangan::where('minggu', $peminjaman->minggu)
                            ->where('waktu', $peminjaman->formruangan->waktu)
                            ->where('hari', $peminjaman->formruangan->hari)
                            ->update(
                                [
                                    'status'        => 1,
                                    'updated_at'    => now()->toDateTimeString()
                                ]
                            );
                    }
                });
                break;
            case '1':
                DB::transaction(function () use ($id) {
                    $peminjamans = PeminjamanBarang::where('form_ruangan_id', $id)->get();
                    foreach ($peminjamans as $peminjaman) {
                        Ruangan::where('minggu', $peminjaman->minggu)
                            ->where('waktu', $peminjaman->formruangan->waktu)
                            ->where('hari', $peminjaman->formruangan->hari)
                            ->update(
                                [
                                    'status'        => 0,
                                    'updated_at'    => now()->toDateTimeString()
                                ]
                            );
                    }
                    FormRuangan::where('id', $id)->delete();
                });
                break;
        }
    }

    public function riwayat()
    {
        $forms = FormRuangan::where('validasi', 0)->get();
        return view('dashboard.peminjaman.ruangan.riwayat', compact('forms'));
    }
}
