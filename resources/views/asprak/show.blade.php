@extends('master.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/asprak/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/asprak/login.css') }}">
<link rel="stylesheet" href="{{ asset('css/asprak/seleksi.css') }}">
@endsection

@section('logout')
@if(auth()->user() and auth()->user()->role == 'calonasprak')
<form action="{{ route('calonasprak.logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary-outline float-right">Logout</button>
</form>
@else
<a href="{{ route('calonasprak.login') }}" class="btn btn-primary-outline float-right">Login</a>
@endif
@endsection

@section('content')
<div class="row">
    <h4 class="p-2 title-header">Uji Seleksi @if($matkul) {{$matkul->daftarmatakuliah->nama}} @endif</h4>
    <div class="line"></div>
</div>
<div class="row mt-5 row-2">
    <div class="card mx-auto">
        <div class="card-body d-flex flex-column">
            @if($matkul)
            <a href="{{ $matkul->soal }}">Lihat Soal</a>

            @else
            <p>Uji seleksi belum dibuka, silahkan cek jadwal untuk waktu pelaksanaan</p>
            @endif
        </div>
        @if($matkul)
        <div class="card-footer">
            <form action="{{ route('calonasprak.test.store', $matkul->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="jawaban">Upload Jawaban</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    <button class="btn btn-login my-3 float-right" type="submit">Submit</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection