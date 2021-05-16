<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventarisStoreRequest;
use App\Http\Requests\InventarisUpdateRequest;
use App\Models\Inventaris;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventarisController extends Controller
{
    public function index()
    {
        $kunci = null;
        $barangs = Inventaris::orderByDesc('updated_at')->paginate(10);
        return view('dashboard.inventaris.index', compact('barangs', 'kunci'));
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

        return redirect()->route('inventaris.index')->with('status', 'Barang berhasil ditambah');
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

    public function update(InventarisUpdateRequest $request, $id)
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

        return redirect()->route('inventaris.index')->with('status', 'Barang berhasil diubah');
    }

    public function destroy($id)
    {
        Inventaris::where('id', $id)->delete();
        return redirect()->route('inventaris.index')->with('status', 'Barang berhasil dihapus');
    }

    public function search(Request $request)
    {
        $input = '%' . $request->get('input') . '%';
        $barangs = Inventaris::where('kd_barang', 'like', $input)
            ->orWhere('nama_barang', 'like', $input)
            ->orWhere('lokasi', 'like', $input)
            ->orWhere('kategori', 'like', $input)
            ->orderBy('updated_at')
            ->paginate(10);
        $kunci = $request->get('input');
        return view('dashboard.inventaris.index', compact('barangs', 'kunci'));
    }
}
