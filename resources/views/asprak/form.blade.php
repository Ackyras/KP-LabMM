@extends('master.asprak')

@section('title', 'Pendaftaran Asprak')

@section('css')
<link rel="stylesheet" href="{{ asset('css/formasprak.css')}}">
@endsection

@section('content')
<div class="row pb-4">
    <form class="col-8" action="{{ route('calonasprak.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group p-1">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control rounded" required placeholder="Masukkan nama anda" autofocus autocomplete="off">
        </div>
        <div class="form-group p-1">
            <label>NIM</label>
            <input type="text" name="nim" value="{{ old('nim') }}" class="form-control rounded" required placeholder="Masukan NIM anda" autocomplete="off">
        </div>
        <div class="form-group p-1">
            <label>Alamat Email ITERA</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded" required placeholder="Masukan alamat email ITERA anda" autocomplete="off">
        </div>
        <div class="form-group p-1">
            <label>Program Studi</label>
            <input type="text" name="prodi" value="{{ old('prodi') }}" class="form-control rounded" required placeholder="Masukan program studi anda" autocomplete="off">
        </div>
        <div class="form-group p-1">
            <label>Angkatan</label>
            <input type="text" name="angkatan" value="{{ old('angkatan') }}" class="form-control rounded" required placeholder="Masukan angkatan anda" autocomplete="off">
        </div>
        <div class="form-group p-1">
            <label>Tanggal lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control rounded" required placeholder="Masukan tahun kelahiran anda" autocomplete="off">
        </div>
        <div class="form-group p-1">
            <label>Pilihan 1</label>
            <select class="form-control" name="pilihan[1]" required>
                <option value="" disabled selected>Pilihan 1</option>
                @foreach($matakuliahs as $matakuliah)
                <option value="{{ $matakuliah->mata_kuliah_id }}">{{$matakuliah->daftarmatakuliah->nama}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group p-1">
            <label>Pilihan 2</label>
            <select class="form-control" name="pilihan[2]">
                <option value="" disabled selected>Pilihan 2</option>
                @foreach($matakuliahs as $matakuliah)
                <option value="{{ $matakuliah->mata_kuliah_id }}">{{$matakuliah->daftarmatakuliah->nama}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group p-1">
            <label>Pilihan 3</label>
            <select class="form-control" name="pilihan[3]">
                <option value="" disabled selected>Pilihan 3</option>
                @foreach($matakuliahs as $matakuliah)
                <option value="{{ $matakuliah->mata_kuliah_id }}">{{$matakuliah->daftarmatakuliah->nama}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>CV</label>
            <input type="file" name="cv" class="form-control rounded" required>
        </div>
        <div class="form-group">
            <label>KHS</label>
            <input type="file" name="khs" class="form-control rounded" required>
        </div>
        <div class="form-group">
            <label>KTM</label>
            <input type="file" name="ktm" class="form-control rounded" required>
        </div>
        <button type="submit" class="btn btn-submit my-3">Daftar</button>
    </form>
</div>
@endsection