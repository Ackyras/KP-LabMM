<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormBarangRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function list()
    {
        return view('barang.list', ['barang' => DB::table('barang')->paginate(20)]);
    }

    public function listElektronik($kategori)
    {
        return view(
            'barang.list',
            [
                'barang' => DB::table('barang')
                    ->where('kategori', 'like', $kategori)
            ]
        );
    }

    public function listNonElektronik($kategori)
    {
        return view(
            'barang.list',
            [
                'barang' => DB::table('barang')
                    ->where('kategori', 'like', $kategori)
            ]
        );
    }

    public function show($id)
    {
        $barang = DB::table('barang')->where('id', $id)->first();

        if (!$barang)
            return abort(404);

        return view('barang.show', ['barang' => $barang]);
    }

    public function form()
    {
        return view(
            'barang.form',
            [
                'data' => DB::table('barang')
                    ->select('kd_barang as kode', 'nama_barang as barang', 'peminjaman')
                    ->get()
            ]
        );
    }

    public function store(FormBarangRequest $request)
    {
        DB::table('form_barang')->insertGetId(
            $request->validated() +
                [
                    'kd_barang_1'           => $request->input('kd_barang1'),
                    'kd_barang_2'           => $request->input('kd_barang2'),
                    'kd_barang_3'           => $request->input('kd_barang3'),
                    'kd_barang_4'           => $request->input('kd_barang4'),
                    'kd_barang_5'           => $request->input('kd_barang5'),
                    'updated_at'            => now()->toDateTimeString()
                ]
        );

        return redirect()->route('list')->with('msg', 'Berhasil membuat form');
    }
}
