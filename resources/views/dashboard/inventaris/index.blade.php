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
    @foreach($data as $datas)
    <div class="card mx-3 my-3" style="width: 13rem; height: 280px;">
        <img src="{{ $datas->foto }}" class="card-img-top px-3 mx-auto" style="object-fit: contain; width: 10rem; height: 10rem;" alt="{{ $datas->kd_barang }}">
        <div class="card-body">
            <h6 class="card-title mx-auto">{{ $datas->nama_barang }}</h6>
            <a href="{{ route('inventaris.show', $datas->id) }}" class="btn btn-primary">Lihat Barang</a>
        </div>
    </div>
    @endforeach
    {{ $data->links() }}
</div>
@endsection