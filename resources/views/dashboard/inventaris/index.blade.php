@extends('master.dashboard')

@section('title-page')
Inventaris
@endsection

@section('content')
<div class="row">
    <div class="d-inline p-2 bg-primary text-white">
        <a class="text-white" href="{{ route('inventaris.create') }}">Tambah Inventaris</a>
        <i class="fas fa-plus"></i>
    </div>
    @foreach($data as $data)
    <div class="card mx-3 my-3" style="width: 12rem; height: 280px;">
        <img src="{{ $data->foto }}" class="card-img-top mt-3" style="object-fit: contain; width: 10rem; height: 10rem;" alt="{{ $data->kd_barang }}">
        <div class="card-body">
            <h5 class="card-title mx-auto">{{ $data->nama_barang }}</h5>
            <a href="{{ route('inventaris.show', $data->id) }}" class="btn btn-primary">Lihat Barang</a>
        </div>
    </div>
    @endforeach
</div>
@endsection