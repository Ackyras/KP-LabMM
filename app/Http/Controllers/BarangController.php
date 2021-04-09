<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormBarangRequest;
use App\Models\FormBarang;
use App\Models\Inventaris;
use App\Models\PeminjamanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function list()
    {
        $barangs = Inventaris::where('status', 'Baik')
            ->orderByDesc('updated_at')
            ->get();
        $master = "peminjaman";
        return view('barang.list', compact('barangs', 'master'));
    }

    public function listElektronik()
    {
        $barangs = Inventaris::where('status', 'Baik')
            ->where('kategori', 'Elektronik')
            ->orderByDesc('updated_at')
            ->get();
        $master = "peminjaman";
        return view('barang.list', compact('barangs', 'master'));
    }

    public function listNonElektronik()
    {
        $barangs = Inventaris::where('status', 'Baik')
            ->where('kategori', 'Non Elektronik')
            ->orderByDesc('updated_at')
            ->get();
        $master = "peminjaman";
        return view('barang.list', compact('barangs', 'master'));
    }

    public function listTpb()
    {
        $barangs = Inventaris::where('status', 'Baik')
            ->where('lokasi', 'TPB')
            ->orderByDesc('updated_at')
            ->get();
        $master = "peminjaman";
        return view('barang.list', compact('barangs', 'master'));
    }

    public function listProdi()
    {
        $barangs = Inventaris::where('status', 'Baik')
            ->where('lokasi', 'PRODI')
            ->orderByDesc('updated_at')
            ->get();
        $master = "peminjaman";
        return view('barang.list', compact('barangs', 'master'));
    }

    public function search(Request $request)
    {
        $query = $request->input('barang');

        $barangs = Inventaris::where('status', 'Baik')
            ->where('nama_barang', 'like', '%' . $query  . '%')
            ->orderByDesc('updated_at')
            ->get();
        $master = "peminjaman";
        return view('barang.list', compact('barangs', 'master'));
    }

    public function show($id)
    {
        $barang = Inventaris::find($id);
        $master = "peminjaman";
        return view('barang.show', compact('barang', 'master'));
    }

    public function form()
    {
        $barangs = Inventaris::where('status', 'Baik')
            ->where('peminjaman', '>', 0)->get();
        $master = "peminjaman";
        return view('barang.form', compact('barangs', 'master'));
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
            for ($i = 1; $i <= $total; $i++) {
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

        return redirect()->route('barang.list')->with('msg', 'Berhasil membuat form');
    }
}
