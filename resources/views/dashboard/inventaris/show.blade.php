@extends('master.dashboard')

@section('title-page')
Inventaris
@endsection

@section('content')
<div class="row">
    <div class="kotak">
        <div class="img-inven">
            <img src="{{ $data->foto }}" class="img-i mx-auto" alt="">
        </div>
        <div class="info">
            <div class="info-nama">
                <h3>{{ $data->nama_barang }}</h3>
            </div>
            <p class="text-info mt-5">Kode Barang : {{ $data->kd_barang }}</p>
            <p class="text-info">Nama Barang : {{ $data->nama_barang }}</p>
            <p class="text-info">Lokasi Barang : {{ $data->lokasi }}</p>
            <p class="text-info">Kategori Barang : {{ $data->kategori }}</p>
            <p class="text-info">Stok Barang : {{ $data->stok }}</p>
            <p class="text-info">Bisa dipinjam : {{ $data->peminjaman }}</p>
            <p class="text-info">Status Barang : {{ $data->status }}</p>
            <p class="text-info">Masuk Barang : {{ $data->masuk_barang }}</p>
        </div>
    </div>
    <div class="mt-4" style="float:right; display: flex;">
        <a class="btn btn-primary" href="{{ route('inventaris.edit', $data->id) }}">Edit</a>
        <form method="POST" action="{{ route('inventaris.destroy', $data->id) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger ml-3" type="submit">Hapus</button>
        </form>
    </div>
</div>
@endsection