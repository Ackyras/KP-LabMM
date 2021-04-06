@extends('master.dashboard')

@section('title-page')
List Pelaporan
@endsection

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Pelaporan Kerusakan</h6>
    </div>
    <div class="container mt-2">
        <div class="row justify-content-center">
          <a href="#" class="btn btn-outline-primary col-3 mx-4">
            Belum Dikerjakan
          </a>
          <a href="#" class="btn btn-outline-primary col-3 mx-4">
            Sedang Dikerjakan
          </a>
          <a href="#" class="btn btn-outline-primary col-3 mx-4">
            Sudah Dikerjakan
          </a>
        </div>
    </div>
    <div class="card-body">
        <input class="my-2 form-control w-25 float-right" type="text" id="myInput" onkeyup="searchData()" placeholder="Cari Data">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Afiliasi</th>
                        <th>Tanggal Pelaporan</th>
                        <th>Jenis Kerusakan</th>
                        <th>Tanggal Penyelesaian</th>
                        <th>Lokasi</th>
                        <th>Ruangan</th>
                        <th>Kode Komputer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($forms as $form)
                    @empty
                    <tr>
                        <td colspan="6">Tidak ada pelaporan</td>
                    </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
    </div>
    <div>
        @yield('isi')
    </div>
</div>
@endsection('content')
