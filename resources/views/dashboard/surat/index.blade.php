@extends('master.dashboard')

@section('title-page')
{{ ($kategori == 1) ? "Surat Masuk" : "Surat Keluar" }}
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List {{ ($kategori == 1) ? "Surat Masuk" : "Surat Keluar" }}</h6>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Perihal</th>
                        <th>Pengirim</th>
                        <th>Lokasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($surats as $surat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $surat->judul }}</td>
                        <td>{{ $surat->perihal }}</td>
                        <td>{{ $surat->pengirim }}</td>
                        <td>{{ $surat->lokasi }}</td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#data{{$surat->id}}">Detail</button>
                        </td>
                    </tr>
                    <div class="modal fade" id="data{{$surat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Data Surat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>{{ ($surat->kategori == 1) ? "Surat Masuk" : "Surat Keluar" }}</h5>
                                    <b>Judul :</b> {{$surat->judul}} </br>
                                    <b>Perihal :</b> {{$surat->perihal}}</br>
                                    <b>Pengirim :</b> {{$surat->pengirim}}</br>
                                    <b>Penerima :</b> {{$surat->penerima}}</br>
                                    <b>Nomor Surat :</b> {{$surat->nomor}}</br>
                                    <b>Lokasi :</b> {{$surat->lokasi}}</br>
                                    <b>Kategori :</b> {{ ($surat->kategori == 1) ? "Surat Masuk" : "Surat Keluar" }}</br>
                                    <b>Tanggal Masuk :</b> {{$surat->tanggal_masuk}}</br>
                                    <a href="{{ $surat->file }}" class="btn btn-success">Lihat Surat</a>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('surat.edit', $surat->id) }}" class="btn btn-info">Edit</a>
                                    <form action="{{ route('surat.destroy', $surat->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" name="action" value="3" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger">Hapus Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6">Tidak ada surat</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$surats->links()}}
        </div>
    </div>
</div>
@endsection('content')