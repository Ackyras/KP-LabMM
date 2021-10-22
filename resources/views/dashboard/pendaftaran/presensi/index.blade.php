@extends('master.dashboard')

@section('title-page', 'List Asprak')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Asprak</h6>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
        @endif
        <input class="mb-2 form-control w-25 float-right" type="text" id="myInput" onkeyup="searchData()"
            placeholder="Cari Data">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Email</th>
                        <th>Prodi</th>
                        <th>Angkatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($asprak as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nim }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->prodi }}</td>
                        <td>{{ $item->angkatan }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#data{{ $item->id }}">Riwayat Presensi</button>
                            {{-- <a href="{{ route('presensi.show', $item->id) }}" class="btn btn-sm btn-info">Riwayat
                            Presensi</a> --}}
                        </td>
                    </tr>
                    <div class="modal fade" id="data{{$item->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Riwayat Presensi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <dl class="ml-3">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <dt><b>No</b></dt>
                                                </dt>
                                            </div>
                                            <div class="col">
                                                <dt><b>Tanggal Asistensi</b></dt>
                                                </dt>
                                            </div>
                                            <div class="col">
                                                <dt><b>Waktu Presensi</b></dt>
                                                </dt>
                                            </div>
                                        </div>
                                        @forelse ($item->presensi as $presensi)
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <dd><small><b>{{$loop->iteration}}</b></small>
                                                    </dt>
                                            </div>
                                            <div class="col">
                                                <dd><small><b>{{ Carbon\Carbon::createFromFormat('Y-m-d', $presensi->valid_for)->format('d-m-Y') }}</b></small>
                                                    </dt>
                                            </div>
                                            <div class="col">
                                                <dd><small><b>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $presensi->created_at)->format('d-m-Y H:i:s') }}</b></small>
                                                    </dt>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="row justify-content-center">
                                            <center>
                                                <div class="col">
                                                    <dt><small><b> Belum ada reakam presensi ada Rekam
                                                                Presensi</b></small>
                                                    </dt>
                                                </div>
                                            </center>
                                        </div>
                                        @endforelse
                                    </dl>
                                </div>
                                <div class="modal-footer">
                                    <dd><small><b>Total presensi = {{$item->presensi_count}}</b></small></dd>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="5">Belum ada Asprak yang terdaftar</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $asprak->links() }}
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
                    if ((txtValue.toUpperCase().indexOf(filter) > -1) || (txtValueAfiliasi.toUpperCase().indexOf(filter) > -
                            1)) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
</script>
@endsection
