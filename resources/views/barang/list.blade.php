@extends('master.master')

@section('title', 'Daftar Barang')

@section('content')
<div class="row justify-content-between">
    <div class="col-6">
        <div class="dropdown pl-3">
            <button id="kategori-dropdown" onclick="kategoriOver()" class="dropbtn btn btn-outline-secondary">Kategori<i class="ml-2 fas fa-chevron-down arrow-d"></i></button>
            <div id="kategori" class="dropdown-content rounded">
                <a href="{{ route('barang.list') }}">Semua</a>
                <a href="{{ route('barang.list.elektronik') }}">Elektronik</a>
                <a href="{{ route('barang.list.nonelektronik') }}">Non Elektronik</a>
            </div>
        </div>
        <div class="dropdown pl-3 ml-5">
            <button id="lokasi-dropdown" onclick="lokasiOver()" class="dropbtn btn btn-outline-secondary">Lokasi<i class="ml-2 fas fa-chevron-down arrow-d"></i></button>
            <div id="lokasi" class="dropdown-content rounded">
                <a href="{{ route('barang.list') }}">Semua</a>
                <a href="{{ route('barang.list.tpb') }}">TPB</a>
                <a href="{{ route('barang.list.prodi') }}">Prodi</a>
            </div>
        </div>
    </div>
    <div class="col-3">
        <form action="{{ route('barang.search') }}" method="GET">
            <input type="text" name="barang" class="form-control color-form pl-4" placeholder="Cari barang" autocomplete="off">
        </form>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mt-3">
        @forelse($barangs as $barang)
        <div class="card mt-2">
            <img class="card-img-top mx-auto mt-2" src="{{ $barang->foto }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="c-title">{{ $barang->nama_barang }}</h5>
            </div>
            <a href="#" class="c-detail btn btn-outline-info">
                Detail
            </a>
        </div>
        @empty
        <p class="mt-5">Item tidak ditemukan</p>
        @endforelse
    </div>
</div>
@endsection

@section('js')
<script>
    document.getElementById("kategori-dropdown").addEventListener("mouseover", kategoriOver);
    document.getElementById("kategori-dropdown").addEventListener("mouseout", kategoriOver);
    document.getElementById("kategori").addEventListener("mouseover", kategoriOver);
    document.getElementById("kategori").addEventListener("mouseout", kategoriOver);

    document.getElementById("lokasi-dropdown").addEventListener("mouseover", lokasiOver);
    document.getElementById("lokasi-dropdown").addEventListener("mouseout", lokasiOver);
    document.getElementById("lokasi").addEventListener("mouseover", lokasiOver);
    document.getElementById("lokasi").addEventListener("mouseout", lokasiOver);

    function kategoriOver() {
        document.getElementById("kategori").classList.toggle("show");
    }

    function lokasiOver() {
        document.getElementById("lokasi").classList.toggle("show");
    }
</script>
@endsection