@extends('master.dashboard')

@section('title-page')
@if ($kategori == 1) Surat Masuk @elseif ($kategori == 2) Surat Keluar @else Search Surat @endif
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@if ($kategori == 1) Surat Masuk @elseif ($kategori == 2) Surat Keluar @else Search Surat @endif</h6>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('surat.search') }}" method="GET">
            <input name="input" class="my-2 form-control w-25 float-right mr-2" type="text" id="myInput" onkeyup="searchData()" placeholder="Cari judul surat">
        </form>
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
                                    <h5 class="ml-3">{{ ($surat->kategori == 1) ? "Surat Masuk" : "Surat Keluar" }}</h5>
                                    <dl class="ml-3">
                                        <dt><small><b>Juful</b></small></dt>
                                        <dd>{{$surat->judul}}</dd>
                                        <dt><small><b>Perihal</b></small></dt>
                                        <dd>{{ $surat->perihal }}</dd>
                                        <dt><small><b>Pengirim</b></small></dt>
                                        <dd>{{ $surat->pengirim }}</dd>
                                        <dt><small><b>Penerima</b></small></dt>
                                        <dd>{{$surat->penerima}} </dd>
                                        <dt><small><b>Nomor Surat</b></small></dt>
                                        <dd>{{$surat->nomor}} </dd>
                                        <dt><small><b>Lokasi</b></small></dt>
                                        <dd>{{ $surat->lokasi }}</b></dt>
                                        <dt><small><b>Kategori</b></small></dt>
                                        <dd>{{ ($surat->kategori == 1) ? "Surat Masuk" : "Surat Keluar" }}</b></dt>
                                        <dt><small><b>Tanggal Masuk</dt>
                                        <dd>{{ $surat->tanggal_masuk }}</b></small></dt>
                                    </dl>
                                    <a href="{{ $surat->file }}" class="btn btn-success ml-3">Lihat Surat</a>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('surat.edit', $surat->id) }}" class="btn btn-info">Edit</a>
                                    <form action="{{ route('surat.destroy', $surat->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger">Hapus Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6">@if($kategori == 3) Tidak ada surat dengan kata kunci {{$kunci}} @else Tidak ada surat @endif</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$surats->links()}}
        </div>
    </div>
</div>
<script>
    function searchData() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            tdKode = tr[i].getElementsByTagName("td")[1];
            if (tdKode) {
                txtValuKode = tdKode.textContent || tdKode.innerText;
                if ((txtValuKode.toUpperCase().indexOf(filter) > -1)) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection('content')