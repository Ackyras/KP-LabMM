@extends('master.dashboard')

@section('title-page')
List Daftar Barang
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Daftar Barang</h6>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('inventaris.search') }}" method="GET">
            <input name="input" class="my-2 form-control w-25 float-right mr-2" type="text" id="myInput" onkeyup="searchData()" placeholder="Cari nama barang atau lokasi">
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $barang)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $barang->kd_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->lokasi }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#data{{$barang->id}}">Detail</button>
                        </td>
                    </tr>
                    <div class="modal fade" id="data{{$barang->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img class="foto-barang my-3" src="{{ $barang->foto }}" /></br>
                                    <h5 class="font-weight-bold nama-barang">{{ $barang->nama_barang }}</h5>
                                    <dl class="ml-3">
                                        <dt><small><b>Kode</b></small></dt>
                                        <dd>{{ $barang->kd_barang }}</dd>
                                        <dt><small><b>Nama</b></small></dt>
                                        <dd>{{ $barang->nama_barang }}</dd>
                                        <dt><small><b>Lokasi</b></small></dt>
                                        <dd>{{ $barang->lokasi }}</dd>
                                        <dt><small><b>Kategori</b></small></dt>
                                        <dd>{{$barang->kategori}} </dd>
                                        <dt><small><b>Status Barang</b></small></dt>
                                        <dd>{{$barang->status}} </dd>
                                        <dt><small><b>Stok Total</b></small></dt>
                                        <dd>{{ $barang->stok }}</b></dt>
                                        <dt><small><b>Peminjaman</b></small></dt>
                                        <dd>{{ $barang->peminjaman }}</b></dt>
                                        <dt><small><b>Masuk Barang</dt>
                                        <dd>{{ Carbon\Carbon::createFromFormat('Y-m-d', $barang->masuk_barang)->format('d-m-Y') }}</b></small></dt>
                                        <dt><small><b>Update Terakhir</dt>
                                        <dd>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $barang->updated_at)->format('d-m-Y H:i:s') }}</b></small></dt>
                                    </dl>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('inventaris.edit', $barang->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('inventaris.destroy', $barang->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus barang?')" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6">@if ($kunci == null) Tidak ada barang @else Tidak ada barang dengan kata kunci {{$kunci}} @endif</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $barangs->links() }}
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
            td = tr[i].getElementsByTagName("td")[2];
            tdLokasi = tr[i].getElementsByTagName("td")[3];
            if (td || tdKode || tdLokasi) {
                txtValue = td.textContent || td.innerText;
                txtValueLokasi = tdLokasi.textContent || tdLokasi.innerText;
                txtValuKode = tdKode.textContent || tdKode.innerText;
                if ((txtValue.toUpperCase().indexOf(filter) > -1) || (txtValueLokasi.toUpperCase().indexOf(filter) > -1) || (txtValuKode.toUpperCase().indexOf(filter) > -1)) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection('content')