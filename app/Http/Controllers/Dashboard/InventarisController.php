<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventarisStoreRequest;
use App\Models\Inventaris;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class InventarisController extends Controller
{
    public function index()
    {
        $data = Inventaris::orderBy('updated_at', 'desc')->get()->toJson();
        return view('dashboard.inventaris.index', compact('data'));
    }


    public function create()
    {
        return view('dashboard.inventaris.create');
    }

    public function store(InventarisStoreRequest $request)
    {
        $kd_barang = $request->input('kd_barang');
        $link = '';

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = 'public/' . $kd_barang . '/';
            $store = $foto->storeAs($path, $kd_barang . '.' . $foto->extension());
            $link = $request->root() . '/storage/' . $kd_barang . '/' . $kd_barang . '.' . $foto->extension();
            if ($store != '') {
                $foto = Storage::url($store);
                $foto = $request->root() . $foto;
            }
        }

        Inventaris::create(
            [
                'kd_barang'     => $request->input('kd_barang'),
                'nama_barang'   => $request->input('nama_barang'),
                'lokasi'        => $request->input('lokasi'),
                'kategori'      => $request->input('kategori'),
                'stok'          => $request->input('stok'),
                'peminjaman'    => $request->input('peminjaman'),
                'status'        => $request->input('status'),
                'masuk_barang'  => $request->input('masuk_barang'),
                'foto'          => ($link == '') ? asset('img/null.png') : $link,
                'updated_at'    => Carbon::now()->setTimezone('Asia/Jakarta')
            ]
        );

        return redirect()->route('inventaris.index')->with('pesan', 'Barang berhasil ditambah');
    }

    public function show($id)
    {
        $data = Inventaris::findOrFail($id);
        return view('dashboard.inventaris.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Inventaris::findOrFail($id);
        return view('dashboard.inventaris.edit', compact('data'));
    }

    public function update(InventarisStoreRequest $request, $id)
    {
        $kd_barang = $request->input('kd_barang');
        $oldfile = $request->input('oldfile');
        $link = '';

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = 'public/' . $kd_barang . '/';
            $store = $foto->storeAs($path, $kd_barang . '.' . $foto->extension());
            $link = $request->root() . '/storage/' . $kd_barang . '/' . $kd_barang . '.' . $foto->extension();
            if ($store != '') {
                $foto = Storage::url($store);
                $foto = $request->root() . $foto;
            }
        }

        Inventaris::where('id', $id)
            ->update(
                [
                    'kd_barang'     => $request->input('kd_barang'),
                    'nama_barang'   => $request->input('nama_barang'),
                    'lokasi'        => $request->input('lokasi'),
                    'kategori'      => $request->input('kategori'),
                    'stok'          => $request->input('stok'),
                    'peminjaman'    => $request->input('peminjaman'),
                    'status'        => $request->input('status'),
                    'masuk_barang'  => $request->input('masuk_barang'),
                    'foto'          => ($link == '') ? $oldfile : $link,
                    'updated_at'    => Carbon::now()->setTimezone('Asia/Jakarta')
                ]
            );

        return redirect()->route('inventaris.index')->with('pesan', 'Barang berhasil ditambah');
    }

    public function destroy($id)
    {
        Inventaris::where('id', $id)->delete();
        return redirect()->route('inventaris.index')->with('pesan', 'Data berhasil dihapus');
    }
}
