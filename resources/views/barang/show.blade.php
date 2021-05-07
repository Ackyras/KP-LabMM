@extends('master.master')

@section('title', $barang->nama_barang)

@section('css')
<link rel="stylesheet" href="{{ asset('css/showbarang.css')}}">
@endsection

@section('content')
<div class="row">
    <h3 class="title-header">{{ $barang->nama_barang }}</h3>
    <div class="line"></div>
</div>
<div class="row">
    <div class="col-5">
        <img class="image-barang" src="{{ $barang->foto }}" alt="">
    </div>
    <div class="col-7">
        <h3 class="title-detail">Detail</h3>
        <div class="line-detail"></div>
        <pre class="text-detail">Nama barang      : {{ $barang->nama_barang }}</pre>
        <pre class="text-detail">Lokasi barang      : {{ $barang->lokasi }}</pre>
        <pre class="text-detail">Kategori Barang  : {{ $barang->kategori }}</pre>
        <pre class="text-detail">Stok barang          : {{ $barang->peminjaman }}</pre>
    </div>
</div>
<a class="btn btn-form" href="{{route('barang.form')}}">Isi Form</a>
@endsection