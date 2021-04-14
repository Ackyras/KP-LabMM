@extends('master.dashboard')

@section('title-page')
Riwayat Peminjaman Ruangan
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Riwayat Peminjam Ruangan</h6>
    </div>
    <div class="card-body">
        <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter Ruangan
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('peminjaman.ruangan.riwayat') }}">Semua</a>
                @foreach ($ruanglab as $ruang)
                <a class="dropdown-item" href="{{ route('peminjaman.ruangan.riwayat.filter', ['slug' => $ruang->slug]) }}">{{$ruang->lokasi . ' : ' . $ruang->ruang}}</a>
                @endforeach
            </div>
        </div>
        <form action="{{ route('peminjaman.ruangan.riwayat.search') }}" method="GET">
            <input class="my-2 form-control w-25 float-right mr-2" name="input" type="text" id="myInput" autocomplete="off" onkeyup="searchData()" placeholder="Cari nama atau program studi">
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Afiliasi</th>
                        <th>Ruangan</th>
                        <th>Waktu Mengisi</th>
                        <th>Validasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ruangans as $ruangan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ruangan->nama_peminjam }}</td>
                        <td>{{ $ruangan->afiliasi }}</td>
                        <td>{{ $ruangan->ruanglab->lokasi . ' : ' .$ruangan->ruanglab->ruang }}</td>
                        <td>{{ $ruangan->ruanglab->lokasi . ' : ' .$ruangan->ruanglab->ruang }}</td>
                        <td>{{ $ruangan->validasi == 0 ? "Diterima" : "Ditolak"}}</td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#data{{$ruangan->id}}">Detail</button>
                        </td>
                    </tr>
                    <div class="modal fade" id="data{{$ruangan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Data Peminjam</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="my-2 ml-3">{{ $ruangan->ruanglab->lokasi . ' : ' .$ruangan->ruanglab->ruang }}</h5>
                                    <dl class="ml-3">
                                        <dt><small><b>Nama</b></small></dt>
                                        <dd>{{$ruangan->nama_peminjam}}</dd>
                                        <dt><small><b>NIM / NIP</b></small></dt>
                                        <dd>{{$ruangan->nim}}</dd>
                                        <dt><small><b>Email</b></small></dt>
                                        <dd>{{$ruangan->email}}</dd>
                                        <dt><small><b>No HP</b></small></dt>
                                        <dd>{{$ruangan->no_hp}}</dd>
                                        <dt><small><b>Afiliasi</b></small></dt>
                                        <dd>{{$ruangan->afiliasi}}</dd>
                                        <dt><small><b>Ruang Lab</b></small></dt>
                                        <dd>{{$ruangan->ruanglab->lokasi . ' : ' .$ruangan->ruanglab->ruang}}</dd>
                                        <dt><small><b>Dosen</b></small></dt>
                                        <dd>{{$ruangan->dosen}}</dd>
                                        <dt><small><b>Kode Mata Kuliah</b></small></dt>
                                        <dd>{{$ruangan->kode_matkul}}</dd>
                                        <dt><small><b>Mata Kuliah</b></small></dt>
                                        <dd>{{$ruangan->mata_kuliah}}</dd>
                                        <dt><small><b>Hari</b></small></dt>
                                        <dd>{{$ruangan->hari}}</dd>
                                        <dt><small><b>Waktu</b></small></dt>
                                        <dd>{{$ruangan->waktu}}</dd>
                                    </dl>
                                    <b class="ml-3">Minggu Ke</b>
                                    <ul>
                                        @foreach ($peminjamans as $peminjaman)
                                        @if ($peminjaman->form_ruangan_id == $ruangan->id)
                                        <li>{{ $peminjaman->minggu }}</small></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6">@if ($kunci == null) Tidak ada riwayat peminjaman @else Tidak ada riwayat peminjam dengan kata kunci {{$kunci}} @endif</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $ruangans->links() }}
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
            if (td) {
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