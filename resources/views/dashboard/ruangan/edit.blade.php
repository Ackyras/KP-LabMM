@extends('master.dashboard')

@section('title-page')
Tambah Data Ruangan
@endsection

@section('content')
<form method="POST" action="{{ route('ruanglab.update', $ruanglab->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Ruangan</label>
        <input type="text" name="ruang" value="{{ $ruanglab->ruang }}" class="form-control @error('ruang') is-invalid @enderror" autofocus required>
        @error('ruang')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Lokasi</label>
        <input type="text" name="lokasi" value="{{ $ruanglab->lokasi }}" class="form-control @error('lokasi') is-invalid @enderror" required>
        @error('lokasi')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Status</label>
        <select name="status" required class="form-control @error('status') is-invalid @enderror">
            <option value="" disabled selected>Pilih status ruangan</option>
            <option value="Baik" {{ $ruanglab->status == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Tidak Baik" {{ $ruanglab->status == 'Tidak Baik' ? 'selected' : '' }}>Tidak Baik</option>
        </select>
        @error('status')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="my-3 mx-auto form-admin position-relative pb-5">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Ubah</button>
    </div>
</form>
@endsection