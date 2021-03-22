<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormBarangRequest;
use App\Models\FormBarang;
use App\Models\Inventaris;
use App\Models\PeminjamanBarang;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function list()
    {
        $barangs = Inventaris::where('status', 'Baik')
            ->orderByDesc('updated_at')
            ->get();
        return view('barang.list', compact('barangs'));
    }

    public function listElektronik()
    {
        $barangs = Inventaris::where('status', 'Baik')
            ->where('kategori', 'Elektronik')
            ->orderByDesc('updated_at')
            ->get();
        return view('barang.list', compact('barangs'));
    }

    public function listNonElektronik()
    {
        $barangs = Inventaris::where('status', 'Baik')
            ->where('kategori', 'Non Elektronik')
            ->orderByDesc('updated_at')
            ->get();
        return view('barang.list', compact('barangs'));
    }

    public function show($id)
    {
        $barang = Inventaris::find($id);
        return view('barang.show', compact('barang'));
    }

    public function form()
    {
        $barangs = Inventaris::where('peminjaman', '>', 0)->get();
        return view('barang.form', compact('barangs'));
    }

    public function store(FormBarangRequest $request)
    {
        DB::transaction(function () use ($request) {
            $peminjam = FormBarang::create(
                $request->validated() +
                    [
                        'updated_at'            => now()->toDateTimeString()
                    ]
            );
            $barang = $request->input('kode');
            $jumlah = $request->input('jumlah');

            $total = count($barang);
            for ($i = 0; $i < $total; $i++) {
                if ($barang[$i] != '' and $jumlah[$i] != 0) {
                    PeminjamanBarang::create(
                        [
                            'form_barang_id'     => $peminjam->id,
                            'barang_id'          => $barang[$i],
                            'jumlah'             => $jumlah[$i],
                        ]
                    );
                }
            }
        });

        return redirect()->route('list')->with('msg', 'Berhasil membuat form');
    }
}
