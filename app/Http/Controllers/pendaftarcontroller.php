<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pendaftarcontroller extends Controller
{
    // view list pendaftaran
    public function openpendaftaran(){
        $pembukaans=DB::table('pembukaans')->orderByDesc('id')->get();
        return view('Pendaftaran/OpenPendaftaran', ['pembukaans'=>$pembukaans]);
    }

    // view form penambahan pendaftaran
    public function tambahpendaftaran(){
        return view('Pendaftaran/TambahPendaftaran');
    }

    // proses penambahan pendaftaran
    public function prosestambahpendaftaran(Request $req){
        $validated=$req->validate([
            'judul'=>'required',
            'pendaftaran'=>'required',
            'akhirpendaftaran'=>'required'
        ]);
        $judul=$req->input('judul');
        $pendaftaran=$req->input('pendaftaran');
        $akhirpendaftaran=$req->input('akhirpendaftaran');
        DB::table('pembukaans')->insert([
            'judul'             => $judul,
            'pendaftaran'       => $pendaftaran,
            'akhirpendaftaran'  => $akhirpendaftaran,
        ]);
        redirect('/open-pendaftaran')->with('success', 'Perekrutan berhasil dibuka');
<<<<<<< HEAD
    }

    // view list matkul
    public function listmatkul($id){
        $matakuliah=DB::table('matakuliahs')->where('id', $id)->get();
        return view('Pendaftaran/ListMatkul',['matakuliahs'=>$matakuliah, 'id'=>$id]);
    }

    // view penambahan matkul
    public function tambahmatkul(){

=======
    }

    // view list matkul
    public function listmatkul($id){
        $matakuliah=DB::table('matakuliahs')->where('id', $id)->get();
        return view('Pendaftaran/ListMatkul',['matakuliahs'=>$matakuliah, 'id'=>$id]);
    }

    // view penambahan matkul
    public function tambahmatkul(){
        
>>>>>>> ba33f1eb96dcd7443b9998b30e4ef3748bbf2ab3
    }
}
