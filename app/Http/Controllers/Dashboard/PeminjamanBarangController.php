<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanBarangController extends Controller
{
    public function index()
    {
        return view(
            'dashboard.peminjaman.barang.index',
            [
                'data' => DB::table('form_barang')
                    ->where('validasi', '1')
                    ->orWhere('validasi', '2')
                    ->paginate(20)
            ]
        );
    }

    public function show($id)
    {
        return view(
            'dashboard.peminjaman.barang.show',
            [
                'data' => DB::table('form_barang')
                    ->where('id', $id)
            ]
        );
    }

    public function status(Request $request, $id)
    {
        $form = DB::table('form_barang')->where('id', $id)->first();
        switch ($request->input('action')) {
            case '2':
                try {
                    DB::transaction(function () use ($id, $form) {
                        DB::table('form_barang')->where('id', $id)->update([
                            'validasi'              => '2',
                            'updated_at'            => now()->toDateTimeString()
                        ]);
                        $peminjaman = DB::table('barang')->where('kd_barang', $form->kd_barang_1)->first();
                        DB::table('barang')->where('kd_barang', $form->kd_barang_1)
                            ->update([
                                'peminjaman' => $peminjaman->peminjaman - 1,
                            ]);
                    }, 5);
                } catch (Exception $th) {
                    return redirect()->route('peminjaman.barang')->with('msg', 'Gagal merubah status');
                }
                break;
            case '0':
                try {
                    DB::transaction(function () use ($id, $form) {
                        DB::table('form_barang')->where('id', $id)->update([
                            'validasi'              => '0',
                            'updated_at'            => now()->toDateTimeString()
                        ]);
                        $peminjaman = DB::table('barang')->where('id', $id)->first();
                        DB::table('barang')->where('kd_barang', $form->kd_barang_1)
                            ->update([
                                'peminjaman' => $peminjaman->peminjaman + 1,
                            ]);
                    }, 5);
                } catch (Exception $th) {
                    return redirect()->route('peminjaman.barang')->with('msg', 'Gagal merubah status');
                }
                break;
        }
        return redirect()->route('peminjaman.barang')->with('msg', 'Berhasil merubah status');
    }

    public function riwayat()
    {
        return view(
            'dashboard.peminjaman.barang.riwayat',
            [
                'data' => DB::table('form_barang')
                    ->where('validasi', 0)
                    ->orderBy('updated_at', 'desc')
                    ->paginate(20)
            ]
        );
    }
}
