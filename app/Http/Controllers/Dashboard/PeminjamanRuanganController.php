<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FormRuangan;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanRuangan;
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
        $form_id = $request->input('form_id');
        switch ($request->input('action')) {
            case '0':
                DB::transaction(function () use ($id) {
                    FormRuangan::where('id', $id)->update([
                        'validasi'  => 0
                    ]);
                });
                $peminjaman = PeminjamanBarang::$encrypter
        }
    }
}
