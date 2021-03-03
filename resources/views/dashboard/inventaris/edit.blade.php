@extends('master.dashboard')

@section('title-page')
Tambah Data Inventaris
@endsection

@section('content')
<form method="POST" action="{{ route('inventaris.update', $data->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Kode Barang</label>
        <input type="text" name="kd_barang" value="{{ $data->kd_barang }}" class="form-control" required>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Nama Barang</label>
        <input type="text" name="nama_barang" value="{{ $data->nama_barang }}" class="form-control" required>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Lokasi Barang</label>
        <select name="lokasi" class="form-select">
            <option selected disabled value="0" {{ $data->lokasi == 0 ? 'selected' : '' }}>Pilih Lokasi Barang</option>
            <option value="TPB" {{ $data->lokasi == 'TPB' ? 'selected' : '' }}>TPB</option>
            <option value="PRODI" {{ $data->lokasi == 'PRODI' ? 'selected' : '' }}>Prodi</option>
        </select>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Kategori Barang</label>
        <select name="kategori" class="form-select">
            <option selected disabled value="0" {{ $data->kategori == 0 ? 'selected' : '' }}>Pilih Kategori Barang</option>
            <option value="Elektronik" {{ $data->kategori == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
            <option value="Non Elektronik" {{ $data->kategori == 'Non Elektronik' ? 'selected' : '' }}>Non Elektronik</option>
        </select>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Stok Barang</label>
        <input type="text" name="stok" value="{{ $data->stok }}" class="form-control" required>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Peminjaman Barang</label>
        <input type="text" name="peminjaman" value="{{ $data->peminjaman }}" class="form-control" required>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Status Barang</label>
        <select name="status" class="form-select">
            <option selected disabled value="0" {{ $data->status == 0 ? 'selected' : '' }}>Pilih Status Barang</option>
            <option value="Baik" {{ $data->status == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Tidak Baik" {{ $data->status == 'Tidak Baik' ? 'selected' : '' }}>Tidak Baik</option>
        </select>
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Masuk Barang</label>
        <input class="form-control" type="date" name="masuk_barang" value="{{ $data->masuk_barang }}" id="example-datetime-local-input">
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Foto Barang</label>
        <input class="form-control" name="foto" type="file" id="formFile">
        <input type="hidden" name="oldfile" value="{{ $data->foto }}">
    </div>
    <div class="my-3 mx-auto form-admin position-relative pb-5">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Submit</button>
    </div>
</form>
@endsection