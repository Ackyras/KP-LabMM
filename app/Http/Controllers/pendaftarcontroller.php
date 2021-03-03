<?php

namespace App\Http\Controllers;

use App\Models\pendaftar;
use App\Models\pilihan;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pendaftarcontroller extends Controller
{
    //

    public function daftar(){
        $pilihan = new pilihan();

        return view('Pendaftaran/Daftar', ['pilihan'=>$pilihan]);
    }

    public function proses(Request $req){
        $req->validate([

        ]);
    }

    public function openpendaftaran(){
        $pembukaans=DB::table('pembukaans')->orderByDesc('id')->get();
        return view('Pendaftaran/OpenPendaftaran', ['pembukaans'=>$pembukaans]);
    }

    public function tambahmatkul($id){
        $matakuliah=DB::table('matakuliahs')->where('id', $id)->get();
        return view('Pendaftaran/ListMatkul',['matakuliahs'=>$matakuliah]);
    }

    public function prosesopen(Request $req){
        $req->validate([

        ]);
    }

    public function tambahpendaftaran(){
        return view('Pendaftaran/TambahPendaftaran');
    }

    public function prosestambahpendaftaran(Request $req){
        $validated=$req->validate([
            'judul'=>'required',
            'pendaftaran'=>'required',
            'akhirpendaftaran'=>'required'
        ]);
        return redirect('/open-pendaftaran')->with('success', 'Pembukaan pendaftaran berhasil dibuka');
    }

    public function isimatkul(Request $req){
        $matakuliah=DB::table('matakuliahs')->where('idpembukaan', $req);
    }
}
