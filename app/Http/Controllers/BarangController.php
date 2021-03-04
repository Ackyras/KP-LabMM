<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function list()
    {
        return view('barang.list', ['barang' => DB::table('barang')->get()]);
    }

    public function show($id)
    {
        $barang = DB::table('barang')->where('id', $id)->first();

        if ($barang == null)
            return abort(404);

        return view('barang.show', ['barang' => $barang]);
    }

    public function form()
    {
        return view(
            'barang.form',
            [
                'data' => DB::table('barang')
                    ->select('kd_barang as kode', 'nama_barang as barang')
                    ->get()
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam'         => ['required', 'max:255'],
            'nim'                   => ['required', 'regex:/[0-9]+/'],
            'email'                 => ['email', 'required'],
            'no_hp'                 => ['max:13', 'required', 'regex:/[0-9]+/'],
            'afiliasi'              => ['required'],
            'jumlah_1'              => ['required', 'min:1'],
            'jumlah_2'              => ['required', 'min:0'],
            'jumlah_3'              => ['required', 'min:0'],
            'jumlah_4'              => ['required', 'min:0'],
            'jumlah_5'              => ['required', 'min:0'],
            'tanggal_peminjaman'    => ['date'],
            'tanggal_pengembalian'  => ['date']
        ]);

        $nama_peminjam = $request->input('nama_peminjam');
        $nim = $request->input('nim');
        $email = $request->input('email');
        $no_hp = $request->input('no_hp');
        $afiliasi = $request->input('afiliasi');

        $barang1 = $request->input('kd_barang1');
        $barang2 = $request->input('kd_barang2');
        $barang3 = $request->input('kd_barang3');
        $barang4 = $request->input('kd_barang4');
        $barang5 = $request->input('kd_barang5');

        $jumlah_1 = $request->input('jumlah_1');
        $jumlah_2 = $request->input('jumlah_2');
        $jumlah_3 = $request->input('jumlah_3');
        $jumlah_4 = $request->input('jumlah_4');
        $jumlah_5 = $request->input('jumlah_5');

        $tanggal_peminjaman = $request->input('tanggal_peminjaman');
        $tanggal_pengembalian = $request->input('tanggal_pengembalian');

        try {
            DB::table('form')->insertGetId([
                'nama_peminjam'         => $nama_peminjam,
                'nim'                   => $nim,
                'email'                 => $email,
                'no_hp'                 => $no_hp,
                'afiliasi'              => $afiliasi,
                'kd_barang_1'           => $barang1,
                'jumlah_1'              => $jumlah_1,
                'kd_barang_2'           => $barang2,
                'jumlah_2'              => $jumlah_2,
                'kd_barang_3'           => $barang3,
                'jumlah_3'              => $jumlah_3,
                'kd_barang_4'           => $barang4,
                'jumlah_4'              => $jumlah_4,
                'kd_barang_5'           => $barang5,
                'jumlah_5'              => $jumlah_5,
                'tanggal_peminjaman'    => $tanggal_peminjaman,
                'tanggal_pengembalian'  => $tanggal_pengembalian
            ]);
        } catch (Exception $th) {
            return redirect()->route('list')->with('msg', 'Gagal membuat form');
        }

        return redirect()->route('list')->with('msg', 'Berhasil membuat form');
    }

    public function index()
    {
        return view(
            'dashboard.inventaris.peminjaman.barang.index',
            [
                'data' => DB::table('form')
                    ->where('validasi', 'like', '1')
                    ->orWhere('validasi', 'like', '2')
                    ->get()
            ]
        );
    }

    public function status(Request $request, $id)
    {
        switch ($request->input('action')) {
            case '2':
                try {
                    DB::table('form')->where('id', $id)->update([
                        'validasi'      => '2'
                    ]);
                } catch (Exception $th) {
                    return redirect()->route('peminjaman.barang')->with('msg', 'Gagal merubah status');
                }
                break;
            case '0':
                try {
                    DB::table('form')->where('id', $id)->update([
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
            'dashboard.inventaris.peminjaman.barang.riwayat',
            [
                'data' => DB::table('form')
                    ->where('validasi', 0)
                    ->get()
            ]
        );
    }
}
