<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    public function index()
    {
        return view('dashboard.inventaris.index', [
            'data' => DB::table('barang')->orderBy('masuk_barang', 'desc')->paginate(20)
        ]);
    }


    public function create()
    {
        return view('dashboard.inventaris.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'kd_barang'     => ['required', 'max:255'],
                'nama_barang'   => ['required', 'max:255'],
                'foto'          => ['nullable', 'mimes:jpeg,png,jpg'],
                'lokasi'        => [Rule::requiredIf($request->input('lokasi') == '0')],
                'kategori'      => [Rule::requiredIf($request->input('kategori') == '0')],
                'stok'          => ['regex:/[0-9]+/', 'required'],
                'peminjaman'    => ['regex:/[0-9]+/', 'required'],
                'status'        => [Rule::requiredIf($request->input('status') == '0')],
                'masuk_barang'  => ['date']
            ]
        );

        $kd_barang = $request->input('kd_barang');
        $nama_barang = $request->input('nama_barang');
        $lokasi = $request->input('lokasi');
        $kategori = $request->input('kategori');
        $stok = $request->input('stok');
        $peminjaman = $request->input('peminjaman');
        $status = $request->input('status');
        $masuk_barang = $request->input('masuk_barang');

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = 'public/' . $kd_barang . '/';
            $store = $foto->storeAs($path, $kd_barang . '.' . $foto->extension());
            $link = $request->root() . '/storage/' . $kd_barang . '/' . $kd_barang . '.' . $foto->extension();
            if ($store == '') {
                $link = $request->root() . '/storage/image/null.svg';
            } else {
                $foto = Storage::url($store);
                $foto = $request->root() . $foto;
            }
        } else {
            $link = public_path('img\null.png');
        }

        try {
            DB::table('barang')->insertGetId([
                'kd_barang'     => $kd_barang,
                'nama_barang'   => $nama_barang,
                'foto'          => $link,
                'lokasi'        => $lokasi,
                'kategori'      => $kategori,
                'stok'          => $stok,
                'peminjaman'    => $peminjaman,
                'status'        => $status,
                'masuk_barang'  => $masuk_barang
            ]);
        } catch (Exception $th) {
            return redirect()->route('inventaris.index')->with('pesan', 'Barang gagal ditambah');
        }

        return redirect()->route('inventaris.index')->with('pesan', 'Barang berhasil ditambah');
    }

    public function show($id)
    {
        if ($id == null)
            return abort(404);

        return view('dashboard.inventaris.show', ['data' => DB::table('barang')->where('id', $id)->first()]);
    }

    public function edit($id)
    {
        $data = DB::table('barang')->where('id', $id)->first();
        if ($data == null)
            return abort(404);

        return view('dashboard.inventaris.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kd_barang'     => ['required', 'max:255'],
            'nama_barang'   => ['required', 'max:255'],
            'foto'          => ['nullable', 'mimes:jpeg,png,jpg'],
            'lokasi'        => [Rule::requiredIf($request->input('lokasi') == '0')],
            'kategori'      => [Rule::requiredIf($request->input('kategori') == '0')],
            'stok'          => ['regex:/[0-9]+/'],
            'peminjaman'    => ['regex:/[0-9]+/'],
            'status'        => [Rule::requiredIf($request->input('status') == '0')],
            'masuk_barang'  => ['date']
        ]);

        $kd_barang = $request->input('kd_barang');
        $nama_barang = $request->input('nama_barang');
        $lokasi = $request->input('lokasi');
        $kategori = $request->input('kategori');
        $stok = $request->input('stok');
        $peminjaman = $request->input('peminjaman');
        $status = $request->input('status');
        $masuk_barang = $request->input('masuk_barang');
        $oldfile = $request->input('oldfile');
        $link = $request->root() . '/storage/image/null.svg';

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = 'public/' . $kd_barang . '/';
            $store = $foto->storeAs($path, $kd_barang . '.' . $foto->extension());
            $link = $request->root() . '/storage/' . $kd_barang . '/' . $kd_barang . '.' . $foto->extension();
            if ($store == '') {
                $link = asset('asset/image/null.svg');
            } else {
                $foto = Storage::url($store);
                $foto = $request->root() . $foto;
            }
        } else {
            if ($oldfile != $link)
                $link = $oldfile;
        }

        try {
            DB::table('barang')->where('id', $id)->update([
                'kd_barang'     => $kd_barang,
                'nama_barang'   => $nama_barang,
                'foto'          => $link,
                'lokasi'        => $lokasi,
                'kategori'      => $kategori,
                'stok'          => $stok,
                'peminjaman'    => $peminjaman,
                'status'        => $status,
                'masuk_barang'  => $masuk_barang
            ]);
        } catch (Exception $th) {
            return redirect()->route('inventaris.index')->with('pesan', 'Barang gagal ditambah');
        }

        return redirect()->route('inventaris.index')->with('pesan', 'Barang berhasil ditambah');
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                DB::table('barang')->where('id', $id)->delete();
            }, 5);
        } catch (Exception $th) {
            return redirect()->route('inventaris.index')->with('pesan', 'Data gagal dihapus');
        }

        return redirect()->route('inventaris.index')->with('pesan', 'Data berhasil dihapus');
    }
}
