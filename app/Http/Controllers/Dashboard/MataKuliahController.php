<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DaftarMataKuliah;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MataKuliahController extends Controller
{
    protected $pembukaan_id;

    public function __construct()
    {
        $this->pembukaan_id = PembukaanAsprak::latest()->first();
    }

    public function create()
    {
        $matakuliahs = DaftarMataKuliah::all();
        return view('dashboard.pendaftaran.matakuliah.create', compact('matakuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matakuliah'        => 'required',
            'dosen'             => 'required',
            'tanggal_seleksi'   => ['required', 'after:today'],
            'awal_seleksi'      => ['required', 'date_format:H:i', 'unique:App\Models\MataKuliah,awal_seleksi'],
            'akhir_seleksi'     => ['required', 'date_format:H:i', 'after:awal_seleksi'],
            'soal'              => ['mimetypes:application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword', 'max:2048', 'nullable']
        ]);

        $matkul = DaftarMataKuliah::where('id', $request->input('matakuliah'))->pluck('nama')->first();
        $link = '';
        if ($request->hasFile('soal')) {
            $file = $request->file('soal');
            $path = "public/" . $this->pembukaan_id->judul . "/" . "matakuliah/" . $matkul;
            $store = $file->storeAs($path, $file->getClientOriginalName());
            $link = $request->root() . '/storage/' . $this->pembukaan_id->judul . '/matakuliah' . "/" . $matkul . "/" . $file->getClientOriginalName();
            $file = Storage::url($store);
            $file = $request->root() . $file;
        }

        MataKuliah::create(
            [
                'mata_kuliah_id'        => $request->input('matakuliah'),
                'pembukaan_asprak_id'   => $this->pembukaan_id->id,
                'dosen'                 => $request->input('dosen'),
                'tanggal_seleksi'       => $request->input('tanggal_seleksi'),
                'awal_seleksi'          => $request->input('awal_seleksi'),
                'akhir_seleksi'         => $request->input('akhir_seleksi'),
                'soal'                  => ($link != "") ? $link : null
            ]
        );

        return redirect()->route('rekrut.show', $this->pembukaan_id->id)->with('pesan', 'Mata Kuliah berhasil ditambah');
    }

    public function edit($id)
    {
        $matakuliahs = DaftarMataKuliah::all();
        $matkul = MataKuliah::findOrFail($id);
        return view('dashboard.pendaftaran.matakuliah.edit', compact('matakuliahs', 'matkul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'matakuliah'        => 'required',
            'dosen'             => 'required',
            'tanggal_seleksi'   => ['required', 'after:today'],
            'awal_seleksi'      => ['required', 'date_format:H:i'],
            'akhir_seleksi'     => ['required', 'date_format:H:i', 'after:awal_seleksi'],
            'soal'              => ['mimetypes:application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword', 'max:2048', 'nullable']
        ]);

        $matkul = DaftarMataKuliah::where('id', $request->input('matakuliah'))->pluck('nama')->first();
        $link = '';
        if ($request->hasFile('soal')) {
            $file = $request->file('soal');
            $path = "public/" . $this->pembukaan_id->judul . "/" . "matakuliah/" . $matkul;
            $store = $file->storeAs($path, $file->getClientOriginalName());
            $link = $request->root() . '/storage/' . $this->pembukaan_id->judul . '/matakuliah' . "/" . $matkul . "/" . $file->getClientOriginalName();
            $file = Storage::url($store);
            $file = $request->root() . $file;
        }

        MataKuliah::where('id', $id)
            ->update(
                [
                    'mata_kuliah_id'        => $request->input('matakuliah'),
                    'pembukaan_asprak_id'   => $this->pembukaan_id->id,
                    'dosen'                 => $request->input('dosen'),
                    'tanggal_seleksi'       => $request->input('tanggal_seleksi'),
                    'awal_seleksi'          => $request->input('awal_seleksi'),
                    'akhir_seleksi'         => $request->input('akhir_seleksi'),
                    'soal'                  => ($link != "") ? $link : $request->input('oldsoal')
                ]
            );

        return redirect()->route('rekrut.show', $this->pembukaan_id->id)->with('pesan', 'Mata Kuliah berhasil diubah');
    }

    public function destroy($id)
    {
        MataKuliah::where('id', $id)->delete();
        return redirect()->route('rekrut.show', $this->pembukaan_id->id)->with('pesan', 'Mata Kuliah berhasil dihapus');
    }
}
