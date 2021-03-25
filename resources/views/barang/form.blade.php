@extends('master.master')

@section('content')
    <h1 class="p-2 text-dark">Formulir Peminjaman</h1>
    <form class="col-7 pt-3 m-4 text-body">
        <div class="form-group p-1" id="form">
            <label for="form" class="">Nama lengkap</label>
            <input type="text" class="form-control rounded" id="form" placeholder="Nama anda" style="">
        </div>
        <div class="form-group p-1" id="form">
            <label for="form">NIM/NIP</label>
            <input type="text" class="form-control rounded" id="form" placeholder="Masukan Nomor Induk">
        </div>
        <div class="form-group p-1" id="form">
            <label for="form">Alamat Email</label>
            <input type="email" class="form-control rounded" id="form" placeholder="Masukan Alamat email">
        </div>
        <div class="form-group p-1" id="form">
            <label for="form">Nomor Telepon</label>
            <input type="text" class="form-control rounded" id="form" placeholder="Masukan Nomor Telepon">
        </div>
        <div class="form-group p-1" id="form">
            <label for="form">Afiliasi / Program Studi</label>
            <input type="text" class="form-control rounded" id="form" placeholder="Masukan Afiliasi">
        </div>
        <h2 class="text-dark pt-2">Keterangan Pinjaman</h2>
        <div class="row">
            <div class="col">
              <input type="text" class="form-control" placeholder="First name">
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Last name">
            </div>
        </div>        
    </form>
@endsection