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
</div>
@endsection