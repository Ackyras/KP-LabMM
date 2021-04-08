@extends('master.dashboard')

@section('title-page')
Tambah Data Ruangan
@endsection

@section('content')
<form method="POST" action="{{ route('ruanglab.store') }}">
    @csrf
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Ruangan</label>
        <input type="text" name="ruang" value="{{ old('ruang') }}" class="form-control @error('ruang') is-invalid @enderror" autofocus required>
        @error('ruang')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Lokasi</label>
        <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="form-control @error('lokasi') is-invalid @enderror" required>
        @error('lokasi')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Lokasi</label>
        <select name="status" required class="form-control @error('status') is-invalid @enderror">
            <option value="" disabled selected>Pilih status ruangan</option>
            <option value="Baik">Baik</option>
            <option value="Tidak Baik">Tidak Baik</option>
        </select>
        @error('status')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="my-3 mx-auto form-admin position-relative pb-5">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Tambah</button>
    </div>
</form>
@endsection