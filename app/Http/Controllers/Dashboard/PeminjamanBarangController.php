<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
        switch ($request->input('action')) {
            case '2':
                try {
                    DB::table('form_barang')->where('id', $id)->update([
                        'validasi'      => '2'
                    ]);
                } catch (Exception $th) {
                    return redirect()->route('peminjaman.barang')->with('msg', 'Gagal merubah status');
                }
                break;
            case '0':
                try {
                    DB::table('form_barang')->where('id', $id)->update([
                        'validasi'      => '0'
                    ]);
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
                    ->paginate(20)
            ]
        );
    }
}
