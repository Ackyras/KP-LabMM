@extends('master.dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Barang Dipinjam (Hari Ini)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-toolbox fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Form Masuk Peminjaman (Barang)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-wpforms fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Barang Belum Dikembalikan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Form Masuk Peminjaman (Ruangan)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-wpforms fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Peminjaman Barang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" style="font-size: 13px">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanngal Isi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"> 1 </th>
                                <td> Nama </td>
                                <td> Tanggal Isi </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('peminjaman.barang') }}" class="btn btn-primary btn-icon-split float-right w-100">
                    <span class="text" style="color:white;">Lihat Selengkapnya</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Peminjaman Ruangan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" style="font-size: 13px">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanngal Isi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"> 1 </th>
                                <td> Nama </td>
                                <td> Tanggal Isi </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('peminjaman.ruangan') }}" class="btn btn-primary btn-icon-split float-right w-100">
                    <span class="text" style="color:white;">Lihat Selengkapnya</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection