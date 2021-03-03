@extends('master.dashboard')

@section('title-page')
Tambah Data Inventaris
@endsection

@section('content')
<form method="POST" action="{{ route('inventaris.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Kode Barang</label>
        <input type="text" name="kd_barang" value="{{ old('kd_barang') }}" class="form-control">
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Nama Barang</label>
        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" class="form-control">
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Lokasi Barang</label>
        <select name="lokasi" class="form-select">
            <option selected disabled value="0" {{ old('lokasi') == 0 ? 'selected' : '' }}>Pilih Lokasi Barang</option>
            <option value="TPB" {{ old('lokasi') == 'TPB' ? 'selected' : '' }}>TPB</option>
            <option value="PRODI" {{ old('lokasi') == 'PRODI' ? 'selected' : '' }}>Prodi</option>
        </select>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Kategori Barang</label>
        <select name="kategori" class="form-select">
            <option selected disabled value="0" {{ old('kategori') == 0 ? 'selected' : '' }}>Pilih Kategori Barang</option>
            <option value="Elektronik" {{ old('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
            <option value="Non Elektronik" {{ old('kategori') == 'Non Elektronik' ? 'selected' : '' }}>Non Elektronik</option>
        </select>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Stok Barang</label>
        <input type="text" name="stok" value="{{ old('stok') }}" class="form-control">
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Peminjaman Barang</label>
        <input type="text" name="peminjaman" value="{{ old('peminjaman') }}" class="form-control">
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Status Barang</label>
        <select name="status" class="form-select">
            <option selected disabled value="0" {{ old('status') == 0 ? 'selected' : '' }}>Pilih Status Barang</option>
            <option value="Baik" {{ old('status') == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Tidak Baik" {{ old('status') == 'Tidak Baik' ? 'selected' : '' }}>Tidak Baik</option>
        </select>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Masuk Barang</label>
        <input class="form-control" type="date" name="masuk_barang" value="<?php echo date("Y-m-d"); ?>" id="example-datetime-local-input">
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Foto Barang</label>
        <input class="form-control" name="foto" type="file" id="formFile">
    </div>
    <div class="my-3 mx-auto form-admin position-relative pb-5">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Submit</button>
    </div>
</form>
@endsection