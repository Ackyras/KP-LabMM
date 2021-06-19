<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormBarangRequest;
use App\Models\FormBarang;
use App\Models\Inventaris;
use App\Models\PeminjamanBarang;
use App\Rules\BarangPinjaman;
use App\Rules\BarangPinjamanJumlah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

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
        foreach ($request->input('kode') as $index => $value) {
            $request->validate(
                [
                    'kode.' . $index        => ['required', new BarangPinjaman($request->get('kode')[$index])],
                    'jumlah.' . $index      => ['min:0', new BarangPinjamanJumlah($request->get('kode')[$index]), 'numeric']
                ]
            );
        }

        $barangs = array_unique($request->input('kode'));
        $jumlahs = $request->input('jumlah');

        DB::transaction(function () use ($request, $barangs, $jumlahs) {
            $peminjam = FormBarang::create(
                [
                    'nama_peminjam'         => $request->input('nama_peminjam'),
                    'nim'                   => $request->input('nim'),
                    'email'                 => $request->input('email'),
                    'no_hp'                 => $request->input('no_hp'),
                    'afiliasi'              => $request->input('afiliasi'),
                    'tanggal_peminjaman'    => $request->input('tanggal_peminjaman'),
                    'tanggal_pengembalian'  => $request->input('tanggal_pengembalian'),
                    'keperluan'             => $request->input('keperluan'),
                    'tempat'                => $request->input('tempat'),
                    'updated_at'            => now()->setTimezone('Asia/Jakarta')->toDateTimeString()
                ]
            );

            foreach ($barangs as $key => $value) {
                $barang = Inventaris::where('nama_barang', $value)->first();
                PeminjamanBarang::create(
                    [
                        'form_barang_id'     => $peminjam->id,
                        'barang_id'          => $barang->id,
                        'jumlah'             => $jumlahs[$key],
                    ]
                );
            }
        });

        $dipinjam = array();
        $jumlahDipinjam = array();

        foreach ($barangs as $key => $value) {
            $barang = Inventaris::where('nama_barang', $barangs[$key])->first();
            array_push($dipinjam, $barang->nama_barang);
            array_push($jumlahDipinjam, $jumlahs[$key]);
        }

        $content = [
            'nama'                  => $request->get('nama_peminjam'),
            'nim'                   => $request->get('nim'),
            'no_hp'                 => $request->get('no_hp'),
            'email'                 => $request->get('email'),
            'prodi'                 => $request->get('afiliasi'),
            'tanggal_peminjaman'    => $request->get('tanggal_peminjaman'),
            'tanggal_pengembalian'  => $request->get('tanggal_pengembalian'),
            'keperluan'             => $request->get('keperluan'),
            'tempat'                => $request->get('tempat'),
            'barang'                => $dipinjam,
            'jumlah'                => $jumlahDipinjam,
        ];
        $pdf = PDF::loadview('barang.surat', compact('content'));

        return $pdf->stream('test.pdf');

        return redirect()->route('barang.form')->with('status', 'Berhasil meminjam barang, silahkan ikuti alur selanjutnya');
    }
}
