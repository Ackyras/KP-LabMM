@extends('master.dashboard')

@section('title-page')
Tambah Data Inventaris
@endsection

@section('content')
<form method="POST" action="{{ route('inventaris.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Kode Barang</label>
        <input type="text" name="kd_barang" value="{{ old('kd_barang') }}" class="form-control @error('kd_barang') is-invalid @enderror" autofocus required>
        @error('kd_barang')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Nama Barang</label>
        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" class="form-control @error('nama_barang') is-invalid @enderror" required>
        @error('nama_barang')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Lokasi Barang</label>
        <select name="lokasi" class="form-select @error('lokasi') is-invalid @enderror" required>
            <option selected disabled value="" {{ old('lokasi') == '' ? 'selected' : '' }}>Pilih Lokasi Barang</option>
            <option value="TPB" {{ old('lokasi') == 'TPB' ? 'selected' : '' }}>TPB</option>
            <option value="PRODI" {{ old('lokasi') == 'PRODI' ? 'selected' : '' }}>Prodi</option>
        </select>
        @error('lokasi')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Kategori Barang</label>
        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
            <option selected disabled value="" {{ old('kategori') == '' ? 'selected' : '' }}>Pilih Kategori Barang</option>
            <option value="Elektronik" {{ old('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
            <option value="Non Elektronik" {{ old('kategori') == 'Non Elektronik' ? 'selected' : '' }}>Non Elektronik</option>
        </select>
        @error('kategori')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Stok Barang</label>
        <input type="number" name="stok" value="{{ old('stok') }}" class="form-control @error('stok') is-invalid @enderror" required>
        @error('stok')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Peminjaman Barang</label>
        <input type="number" name="peminjaman" value="{{ old('peminjaman') }}" class="form-control @error('peminjaman') is-invalid @enderror" required>
        @error('peminjaman')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Status Barang</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option selected disabled value="" {{ old('status') == '' ? 'selected' : '' }}>Pilih Status Barang</option>
            <option value="Baik" {{ old('status') == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Tidak Baik" {{ old('status') == 'Tidak Baik' ? 'selected' : '' }}>Tidak Baik</option>
        </select>
        @error('status')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Masuk Barang</label>
        <input class="form-control @error('masuk_barang') is-invalid @enderror" type="date" name="masuk_barang" value="<?php echo date("Y-m-d"); ?>" id="example-datetime-local-input">
        @error('masuk_barang')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Foto Barang</label>
        <input class="form-control @error('foto') is-invalid @enderror" name="foto" type="file" id="formFile" accept=".png, .jpg, .jpeg">
        @error('foto')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="my-3 mx-auto form-admin position-relative pb-5">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Submit</button>
    </div>
</form>
@endsection