<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use Illuminate\Http\Request;

class PendaftaranAsprakController extends Controller
{
    public function index()
    {
        $daftars = PembukaanAsprak::latest()->get();
        return view('dashboard.pendaftaran.index', compact('daftars'));
    }

    public function show($id)
    {
        $pembukaan = PembukaanAsprak::findOrFail($id);
        $daftars = MataKuliah::with('daftarmatakuliah')->where('pembukaan_asprak_id', $id)->get();
        return view('dashboard.pendaftaran.show', compact('daftars', 'pembukaan'));
    }

    public function create()
    {
        return view('dashboard.pendaftaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required',
            'awal_pembukaan'    => ['required', 'date'],
            'akhir_pembukaan'   => ['required', 'date', 'after:awal_pembukaan']
        ]);
        PembukaanAsprak::create($request->all());

        return redirect()->route('rekrut.index')->with('pesan', 'Perekrutan berhasil dibuka');
    }

    public function edit($id)
    {
        $daftar = PembukaanAsprak::findOrFail($id);
        return view('dashboard.pendaftaran.edit', compact('daftar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'             => 'required',
            'awal_pembukaan'    => ['required', 'date'],
            'akhir_pembukaan'   => ['required', 'date', 'after:awal_pembukaan']
        ]);
        PembukaanAsprak::where('id', $id)
            ->update($request->only(['judul', 'awal_pembukaan', 'akhir_pembukaan']));

        return redirect()->route('rekrut.index')->with('pesan', 'Perekrutan berhasil diubah');
    }

    public function destroy($id)
    {
        PembukaanAsprak::where('id', $id)->delete();

        return redirect()->route('rekrut.index')->with('pesan', 'Perekrutan berhasil dihapus');
    }
}
