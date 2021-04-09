@extends('master.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/asprak/login.css') }}">
@endsection

@section('content')
<div class="row">
    <h4 class="p-2 title-header">Login</h4>
    <div class="line"></div>
</div>
<div class="row mt-3">
    <div class="card mx-auto">
        <div class="card-body align-items-center d-flex">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="mx-auto" action="{{ route('calonasprak.login.post') }}" method="POST">
                <i class="fas fa-sign-in-alt px-3"></i> Calon Asprak
                <div class="form-group mt-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" autofocus autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" autocomplete="off">
                </div>
                <button class="btn btn-login mt-3 float-right" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection