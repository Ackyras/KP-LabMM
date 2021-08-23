@extends('master.dashboard')

@section('title-page', 'Buka Pendaftaran')

@section('content')
<form method="POST" action="{{ route('presensi.store') }}">
    @csrf
    <input type="hidden" name="token" value="{{Str::random(20)}}">
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Tanggal Presensi</label>
        <input class="form-control @error('valid_for') is-invalid @enderror" type="date" name="valid_for" value="<?php echo date("Y-m-d"); ?>" id="example-datetime-local-input">
        @error('valid_for')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Berlaku hingga</label>
        <input class="form-control @error('valid_until') is-invalid @enderror" type="datetime-local" name="valid_until" value="<?php echo date("Y-m-d"); ?>" id="example-datetime-local-input">
        @error('valid_until')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="my-3 mx-auto form-admin position-relative pb-5">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Submit</button>
    </div>
</form>
@endsection

