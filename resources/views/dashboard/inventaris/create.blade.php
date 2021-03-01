@extends('master.dashboard')

@section('title-page')
Tambah Data Inventaris
@endsection

@section('content')
<form method="POST" action="{{ route('inventaris.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Kode Barang</label>
        <input type="text" name="kd_barang" value="{{ old('kd_barang') }}" class="form-control" required>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Nama Barang</label>
        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" class="form-control" required>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Lokasi Barang</label>
        <select name="lokasi" class="form-select">
            <option selected disabled value="0">Pilih Lokasi Barang</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Kategori Barang</label>
        <select name="kategori" class="form-select">
            <option selected disabled value="0">Pilih Kategori Barang</option>
            <option value="1">Elektronik</option>
            <option value="2">Non Elektronik</option>
        </select>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Stok Barang</label>
        <input type="text" name="stok" value="{{ old('stok') }}" class="form-control" required>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Status Barang</label>
        <select name="status" class="form-select">
            <option selected disabled value="0">Pilih Status Barang</option>
            <option value="1">Tidak bisa dipinjam</option>
            <option value="2">Bisa dipinjam</option>
        </select>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Masuk Barang</label>
        <input class="form-control" type="date" name="masuk_barang" value="<?php echo date("Y-m-d"); ?>" id="example-datetime-local-input">
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Foto Barang</label>
        <input class="form-control" type="file" id="formFile">
    </div>
    <div class="my-3 mx-auto form-admin position-relative pb-5">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Submit</button>
    </div>
</form>
@endsection