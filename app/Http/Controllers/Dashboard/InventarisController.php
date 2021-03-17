<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventarisStoreRequest;
use App\Models\Inventaris;
use Carbon\Carbon;
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

    public function store(InventarisStoreRequest $request)
    {
        $kd_barang = $request->input('kd_barang');
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = 'public/' . $kd_barang . '/';
            $store = $foto->storeAs($path, $kd_barang . '.' . $foto->extension());
            $link = $request->root() . '/storage/' . $kd_barang . '/' . $kd_barang . '.' . $foto->extension();
            if ($store == '') {
                $link = asset('img/null.png');
            } else {
                $foto = Storage::url($store);
                $foto = $request->root() . $foto;
            }
        } else {
            $link = asset('img/null.png');
        }

        Inventaris::create(
            $request->validated() +
                [
                    'foto'          => $link,
                    'updated_at'    => Carbon::now()->setTimezone('Asia/Jakarta')
                ]
        );

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

    public function update(InventarisStoreRequest $request, $id)
    {
        $kd_barang = $request->input('kd_barang');
        $oldfile = $request->input('oldfile');
        $link = asset('img/null.png');

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = 'public/' . $kd_barang . '/';
            $store = $foto->storeAs($path, $kd_barang . '.' . $foto->extension());
            $link = $request->root() . '/storage/' . $kd_barang . '/' . $kd_barang . '.' . $foto->extension();
            if ($store == '') {
                $link = asset('img/null.png');
            } else {
                $foto = Storage::url($store);
                $foto = $request->root() . $foto;
            }
        } else {
            $link = $oldfile;
        }

        Inventaris::where('id', $id)
            ->update(
                $request->validated() +
                    [
                        'foto'          => $link,
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
