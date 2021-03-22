<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FormBarang;
use App\Models\Inventaris;
use App\Models\PeminjamanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanBarangController extends Controller
{
    public function index()
    {
        $forms = FormBarang::where('validasi', '1')
            ->orWhere('validasi', '2')
            ->orderByDesc('updated_at')
            ->paginate(20);
        return view('dashboard.peminjaman.barang.index', compact('forms'));
    }

    public function show($id)
    {
        $forms = FormBarang::where('form_barang_id', $id)->get();
        return view('dashboard.peminjaman.barang.show', compact('forms'));
    }

    public function status(Request $request)
    {
        $form_barang_id = $request->input('form_barang_id');
        switch ($request->input('action')) {
            case '2':
                DB::transaction(function () use ($form_barang_id) {
                    FormBarang::where('id', $form_barang_id)->update([
                        'validasi'              => '2',
                        'updated_at'            => now()->toDateTimeString()
                    ]);
                    $peminjaman = PeminjamanBarang::where('form_barang_id', $form_barang_id)->get();
                    foreach ($peminjaman as $pem) {
                        $inven = Inventaris::where('id', $pem->barang_id)->first();
                        $inven->update([
                            'peminjaman' => $inven->peminjaman - $pem->jumlah
                        ]);
                    }
                }, 5);

                break;
            case '0':
                DB::transaction(function () use ($form_barang_id) {
                    FormBarang::where('id', $form_barang_id)->update([
                        'validasi'              => '0',
                        'updated_at'            => now()->toDateTimeString()
                    ]);
                    $peminjaman = PeminjamanBarang::where('form_barang_id', $form_barang_id)->get();
                    foreach ($peminjaman as $pem) {
                        $inven = Inventaris::where('id', $pem->barang_id)->first();
                        $inven->update([
                            'peminjaman' => $inven->peminjaman + $pem->jumlah
                        ]);
                    }
                }, 5);

                break;
        }

        return redirect()->route('peminjaman.barang')->with('msg', 'Berhasil merubah status');
    }

    public function riwayat()
    {
        $peminjams = FormBarang::where('validasi', 0)
            ->orderByDesc('updated_at')
            ->get();

        $barangs = PeminjamanBarang::all();

        return view('dashboard.peminjaman.barang.riwayat', compact('peminjam', 'barangs'));
    }
}
