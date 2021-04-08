@extends('master.master')

@section('title', 'Form Pinjam Barang')

@section('css')
<link rel="stylesheet" href="{{ asset('css/formbarang.css')}}">
@endsection

@section('content')
<div class="row">
    <h4 class="p-2 title-header">Formulir Peminjaman Alat</h4>
    <div class="line"></div>
    <h4 class="title-data">Data Peminjam</h4>
    <div class="line-2"></div>
</div>
<div class="row">
    <form class="col-8" action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="form-group p-1">
            <label>Nama lengkap</label>
            <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}" class="form-control rounded @error('nama_peminjam') is-invalid @enderror" required placeholder="Masukkan nama anda" autofocus>
            @error('nama_peminjam')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>NIM/NIP</label>
            <input type="text" name="nim" value="{{ old('nim') }}" class="form-control rounded @error('nim') is-invalid @enderror" required placeholder="Masukan NIM/NIP anda">
            @error('nim')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Alamat Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded @error('email') is-invalid @enderror" required placeholder="Masukan alamat email anda">
            @error('email')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Nomor Telepon</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="form-control rounded @error('no_hp') is-invalid @enderror" required placeholder="Masukan nomor HP anda">
            @error('no_hp')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Afiliasi / Program Studi</label>
            <input type="text" name="afiliasi" value="{{ old('afiliasi') }}" class="form-control rounded @error('afiliasi') is-invalid @enderror" required placeholder="Masukan program studi anda">
            @error('afiliasi')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <h4 class="title-keterangan">Keterangan Peminjam</h4>
        <div class="line-3"></div>
        <div class="row pb-5">
            <div class="col-10">
                <input list="barangs" name="kode[1]" class="form-control @error('kode[1]') is-invalid @enderror" required placeholder="Pilih barang">
                <datalist id="barangs">
                    @foreach($barangs as $barang)
                    <option value="{{ $barang->id }}">{{ $barang->id }}</option>
                    @endforeach
                </datalist>
                @error('kode[1]')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-2">
                <input type="number" name="jumlah[1]" min="1" max="5" value="1" class="form-control @error('jumlah[1]') is-invalid @enderror" required>
                @error('jumlah[1]')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Tanggal Peminjaman*</label>
                <input type="date" name="tanggal_peminjaman" class="form-control rounded @error('tanggal_peminjaman') is-invalid @enderror" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required placeholder="Pilih tanggal peminjaman">
                @error('tanggal_peminjaman')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Tanggal Pengembalian*</label>
                <input type="date" name="tanggal_pengembalian" class="form-control rounded @error('tanggal_pengembalian') is-invalid @enderror" value="{{ Carbon\Carbon::now()->addDay()->format('Y-m-d') }}" required placeholder="Pilih tanggal pengembalian">
                @error('tanggal_pengembalian')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-submit">Pinjam</button>
    </form>
</div>
@endsection