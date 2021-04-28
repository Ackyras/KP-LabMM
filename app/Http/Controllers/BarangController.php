<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormBarangRequest;
use App\Models\FormBarang;
use App\Models\Inventaris;
use App\Models\PeminjamanBarang;
use App\Rules\BarangPinjaman;
use App\Rules\BarangPinjamanJumlah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

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
        $barangs = array();
        $jumlahs = array();
        $dipinjam = array();
        $jumlahDipinjam = array();
        array_push($barangs, $request->input('kode1'));
        array_push($jumlahs, $request->input('jumlah1'));

        if (!is_null($request->input('kode2')) and !is_null($request->input('jumlah2') and ($request->input('jumlah2') != 0))) {
            $request->validate(
                [
                    'kode2'                 => ['nullable', new BarangPinjaman($request->get('kode2'))],
                    'jumlah2'               => [new BarangPinjamanJumlah($request->get('kode2')), 'min:0']
                ]
            );
            array_push($barangs, $request->input('kode2'));
            array_push($jumlahs, $request->input('jumlah2'));
        }
        if (!is_null($request->input('kode3')) and !is_null($request->input('jumlah3') and ($request->input('jumlah3') != 0))) {
            $request->validate(
                [
                    'kode3'                 => ['nullable', new BarangPinjaman($request->get('kode3'))],
                    'jumlah3'               => [new BarangPinjamanJumlah($request->get('kode3')), 'min:0']
                ]
            );
            array_push($barangs, $request->input('kode3'));
            array_push($jumlahs, $request->input('jumlah3'));
        }
        if (!is_null($request->input('kode4')) and !is_null($request->input('jumlah4') and ($request->input('jumlah4') != 0))) {
            $request->validate(
                [
                    'kode4'                 => ['nullable', new BarangPinjaman($request->get('kode4'))],
                    'jumlah4'               => [new BarangPinjamanJumlah($request->get('kode4')), 'min:0']
                ]
            );
            array_push($barangs, $request->input('kode4'));
            array_push($jumlahs, $request->input('jumlah4'));
        }
        if (!is_null($request->input('kode5')) and !is_null($request->input('jumlah5') and ($request->input('jumlah5') != 0))) {
            $request->validate(
                [
                    'kode5'                 => ['nullable', new BarangPinjaman($request->get('kode5'))],
                    'jumlah5'               => [new BarangPinjamanJumlah($request->get('kode5')), 'min:0']
                ]
            );
            array_push($barangs, $request->input('kode5'));
            array_push($jumlahs, $request->input('jumlah5'));
        }

        $barangs = array_unique($barangs);
        $jumlahs = array_unique($jumlahs);

        DB::transaction(function () use ($request, $barangs, $jumlahs, $dipinjam, $jumlahDipinjam) {
            $peminjam = FormBarang::create(
                [
                    'nama_peminjam'         => $request->input('nama_peminjam'),
                    'nim'                   => $request->input('nim'),
                    'email'                 => $request->input('email'),
                    'no_hp'                 => $request->input('no_hp'),
                    'afiliasi'              => $request->input('afiliasi'),
                    'tanggal_peminjaman'    => $request->input('tanggal_peminjaman'),
                    'tanggal_pengembalian'  => $request->input('tanggal_pengembalian'),
                    'updated_at'            => now()->toDateTimeString()
                ]
            );

            for ($i = 0; $i < count($barangs); $i++) {
                if ($barangs[$i] != null and $jumlahs[$i] != null) {
                    $barang = Inventaris::where('nama_barang', $barangs[$i])->first();
                    array_push($dipinjam, $barang->nama_barang);
                    array_push($jumlahDipinjam, $jumlahs[$i]);
                    PeminjamanBarang::create(
                        [
                            'form_barang_id'     => $peminjam->id,
                            'barang_id'          => $barang->id,
                            'jumlah'             => $jumlahs[$i],
                        ]
                    );
                }
            }
        });

        for ($i = 0; $i < count($barangs); $i++) {
            if ($barangs[$i] != null and $jumlahs[$i] != null) {
                $barang = Inventaris::where('nama_barang', $barangs[$i])->first();
                array_push($dipinjam, $barang->nama_barang);
                array_push($jumlahDipinjam, $jumlahs[$i]);
            }
        }

        $content = [
            'nama'                  => $request->get('nama_peminjam'),
            'nim'                   => $request->get('nim'),
            'no_hp'                 => $request->get('no_hp'),
            'email'                 => $request->get('email'),
            'prodi'                 => $request->get('afiliasi'),
            'tanggal_peminjaman'    => $request->get('tanggal_peminjaman'),
            'tanggal_pengembalian'  => $request->get('tanggal_pengembalian'),
            'barang'                => $dipinjam,
            'jumlah'                => $jumlahDipinjam,
        ];
        dd($content);
        $pdf = PDF::loadview('barang.surat', compact('content'));

        return $pdf->stream('test.pdf');

        return redirect()->route('barang.form')->with('status', 'Berhasil meminjam barang, silahkan ikuti alur selanjutnya');
    }
}
