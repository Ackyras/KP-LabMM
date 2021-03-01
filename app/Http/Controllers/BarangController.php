<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    //
    public function index()
    {
        return view('barang.index');
    }

    public function list()
    {
        $barang = DB::table('barang')->get();
        return view('barang.list', ['barang' => $barang]);
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
        return view('barang.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => ['required', 'max:255'],
            'nim' => ['required', 'regex:/[0-9]+/'],
            'email' => ['email', 'required'],
            'no_hp' => ['max:13', 'required', 'regex:/[0-9]+/'],
            'afiliasi' => ['required'],
            'jumlah_1' => ['required', 'min:1'],
            'jumlah_2' => ['required', 'min:0'],
            'jumlah_3' => ['required', 'min:0'],
            'jumlah_4' => ['required', 'min:0'],
            'jumlah_5' => ['required', 'min:0'],
            'tanggal_peminjaman' => ['date'],
            'tanggal_pengembalian' => ['date']
        ]);

        $nama_peminjam = $request->input('nama_peminjam');
        $nim = $request->input('nim');
        $email = $request->input('email');
        $no_hp = $request->input('no_hp');
        $afiliasi = $request->input('afiliasi');

        $barang1 = DB::table('barang')->where('kd_barang', 'like', $request->input('kd_barang1'));
        $barang2 = DB::table('barang')->where('kd_barang', 'like', $request->input('kd_barang2'));
        $barang3 = DB::table('barang')->where('kd_barang', 'like', $request->input('kd_barang3'));
        $barang4 = DB::table('barang')->where('kd_barang', 'like', $request->input('kd_barang4'));
        $barang5 = DB::table('barang')->where('kd_barang', 'like', $request->input('kd_barang5'));

        $jumlah_1 = $request->input('jumlah_1');
        $jumlah_2 = $request->input('jumlah_2');
        $jumlah_3 = $request->input('jumlah_3');
        $jumlah_4 = $request->input('jumlah_4');
        $jumlah_5 = $request->input('jumlah_5');

        try {
            DB::table('form')->insertGetId([
                'nama_peminjam' => $nama_peminjam,
                'nim' => $nim,
                'email' => $email,
                'no_hp' => $no_hp,
                'afiliasi' => $afiliasi,
                'kd_barang_1' => $barang1,
                'jumlah_1' => $jumlah_1,
                'kd_barang_2' => $barang2,
                'jumlah_2' => $jumlah_2,
                'kd_barang_3' => $barang3,
                'jumlah_3' => $jumlah_3,
                'kd_barang_4' => $barang4,
                'jumlah_4' => $jumlah_4,
                'kd_barang_5' => $barang5,
                'jumlah_5' => $jumlah_5,
            ]);
        } catch (Exception $th) {
            return redirect()->route('list')->with('msg', 'Gagal membuat form');
        }
    }
}
