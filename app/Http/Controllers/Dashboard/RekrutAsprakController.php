<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekrutAsprakController extends Controller
{
    public function daftar()
    {
        $pembukaans = DB::table('pembukaans')->orderByDesc('id')->get();
        return view('Pendaftaran/OpenPendaftaran', ['pembukaans' => $pembukaans]);
    }

    public function daftarView()
    {
        return view('Pendaftaran/TambahPendaftaran');
    }

    public function daftarStore(Request $req)
    {
        $req->validate([
            'judul' => 'required',
            'pendaftaran' => 'required',
            'akhirpendaftaran' => 'required'
        ]);
        $judul = $req->input('judul');
        $pendaftaran = $req->input('pendaftaran');
        $akhirpendaftaran = $req->input('akhirpendaftaran');
        DB::table('pembukaans')->insert([
            'judul'             => $judul,
            'pendaftaran'       => $pendaftaran,
            'akhirpendaftaran'  => $akhirpendaftaran,
        ]);
        redirect()->route('rekrut.index')->with('success', 'Perekrutan berhasil dibuka');
    }

    public function indexMataKuliah($id)
    {
        $matakuliah = DB::table('matakuliahs')->where('id', $id)->get();
        return view('Pendaftaran/ListMatkul', ['matakuliahs' => $matakuliah, 'id' => $id]);
    }

    public function addMataKuliah()
    {
    }
}
