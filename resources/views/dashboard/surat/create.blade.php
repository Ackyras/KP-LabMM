@extends('master.dashboard')

@section('title-page', 'Tambah Surat')

@section('content')
<form method="POST" action="{{ route('surat.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Judul Surat</label>
        <input type="text" name="judul" value="{{ old('judul') }}" class="form-control @error('judul') is-invalid @enderror" required>
        @error('judul')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Perihal</label>
        <input type="text" name="perihal" value="{{ old('perihal') }}" class="form-control @error('perihal') is-invalid @enderror" required>
        @error('perihal')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Pengirim</label>
        <input type="text" name="pengirim" value="{{ old('pengirim') }}" class="form-control @error('pengirim') is-invalid @enderror" required>
        @error('pengirim')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Penerima</label>
        <input type="text" name="penerima" value="{{ old('penerima') }}" class="form-control @error('penerima') is-invalid @enderror" required>
        @error('penerima')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Nomor</label>
        <input type="text" name="nomor" value="{{ old('nomor') }}" class="form-control @error('nomor') is-invalid @enderror" required>
        @error('nomor')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Lokasi Surat</label>
        <select name="lokasi" class="form-select @error('lokasi') is-invalid @enderror" required>
            <option selected disabled value="" {{ old('lokasi') == '' ? 'selected' : '' }}>Pilih Lokasi Surat</option>
            <option value="TPB" {{ old('lokasi') == 'TPB' ? 'selected' : '' }}>TPB</option>
            <option value="PRODI" {{ old('lokasi') == 'PRODI' ? 'selected' : '' }}>Prodi</option>
        </select>
        @error('lokasi')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Kategori Surat</label>
        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
            <option selected disabled value="" {{ old('kategori') == '' ? 'selected' : '' }}>Pilih Kategori Surat</option>
            <option value="1" {{ old('kategori') == '1' ? 'selected' : '' }}>Surat Masuk</option>
            <option value="2" {{ old('kategori') == '2' ? 'selected' : '' }}>Surat Keluar</option>
        </select>
        @error('kategori')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" class="form-control @error('tanggal_masuk') is-invalid @enderror" required>
        @error('tanggal_masuk')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">File Surat</label>
        <input class="form-control @error('file') is-invalid @enderror" name="file" type="file" id="formFile">
        @error('file')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="my-3 mx-auto form-admin position-relative pb-5">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Submit</button>
    </div>
</form>
@endsection