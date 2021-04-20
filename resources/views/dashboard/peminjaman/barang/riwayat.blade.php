@extends('master.dashboard')

@section('title-page')
Riwayat Peminjaman Barang
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Riwayat Peminjam Barang</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('peminjaman.barang.riwayat.search') }}" method="GET">
            <input class="my-2 form-control w-25 float-right mr-2" name="input" type="text" id="myInput" autocomplete="off" onkeyup="searchData()" placeholder="Cari nama atau program studi">
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Afiliasi</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($forms as $form)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $form->nama_peminjam }}</td>
                        <td>{{ $form->afiliasi }}</td>
                        <td>{{ $form->tanggal_peminjaman }}</td>
                        <td>{{ $form->tanggal_pengembalian }}</td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#data{{$form->id}}">Detail</button>
                        </td>
                    </tr>
                    <div class="modal fade" id="data{{$form->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Data Peminjam</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <dl class="ml-3">
                                        <dt><small><b>Nama</b></small></dt>
                                        <dd>{{$form->nama_peminjam}}</dd>
                                        <dt><small><b>NIM / NIP</b></small></dt>
                                        <dd>{{$form->nim}}</dd>
                                        <dt><small><b>Email</b></small></dt>
                                        <dd>{{$form->email}}</dd>
                                        <dt><small><b>No HP</b></small></dt>
                                        <dd>{{$form->no_hp}}</dd>
                                        <dt><small><b>Afiliasi</b></small></dt>
                                        <dd>{{$form->afiliasi}}</dd>
                                        <dt><small><b>Tanggal Peminjaman</b></small></dt>
                                        <dd>{{$form->tanggal_peminjaman}}</dd>
                                        <dt><small><b>Tanggal Pengembalian</b></small></dt>
                                        <dd>{{$form->tanggal_pengembalian}}</b></dt>
                                    </dl>
                                    <b class="ml-3">Barang Pinjaman</b>
                                    <ul>
                                        @foreach ($barangs as $barang)
                                        @if ($barang->form_barang_id == $form->id)
                                        <li>{{ $barang->inventaris->nama_barang }} <small>({{$barang->jumlah}} unit)</small></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6">@if ($kunci == null) Tidak ada riwayat @else Tidak ada riwayat dengan kata kunci {{$kunci}} @endif</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $forms->links() }}
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
            td = tr[i].getElementsByTagName("td")[1];
            tdAfiliasi = tr[i].getElementsByTagName("td")[2];
            if (td || tdAfiliasi) {
                txtValue = td.textContent || td.innerText;
                txtValueAfiliasi = tdAfiliasi.textContent || tdAfiliasi.innerText;
                if ((txtValue.toUpperCase().indexOf(filter) > -1) || (txtValueAfiliasi.toUpperCase().indexOf(filter) > -1)) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection('content')