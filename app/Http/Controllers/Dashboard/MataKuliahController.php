<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DaftarMataKuliah;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use Illuminate\Http\Request;

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
            'tanggal_seleksi'   => 'required',
            'awal_seleksi'      => 'required',
            'akhir_seleksi'     => 'required'
        ]);
        MataKuliah::create(
            [
                'mata_kuliah_id'        => $request->input('matakuliah'),
                'pembukaan_asprak_id'   => $this->pembukaan_id->id,
                'kode'                  => $request->input('matakuliah'),
                'dosen'                 => $request->input('dosen'),
                'tanggal_seleksi'       => $request->input('tanggal_seleksi'),
                'awal_seleksi'          => $request->input('awal_seleksi'),
                'akhir_seleksi'         => $request->input('akhir_seleksi'),
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
            'tanggal_seleksi'   => 'required',
            'awal_seleksi'      => 'required',
            'akhir_seleksi'     => 'required'
        ]);
        MataKuliah::where('id', $id)
            ->update(
                [
                    'mata_kuliah_id'        => $request->input('matakuliah'),
                    'pembukaan_asprak_id'   => $this->pembukaan_id->id,
                    'kode'                  => $request->input('matakuliah'),
                    'dosen'                 => $request->input('dosen'),
                    'tanggal_seleksi'       => $request->input('tanggal_seleksi'),
                    'awal_seleksi'          => $request->input('awal_seleksi'),
                    'akhir_seleksi'         => $request->input('akhir_seleksi'),
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
