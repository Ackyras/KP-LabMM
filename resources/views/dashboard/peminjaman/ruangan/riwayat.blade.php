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
        <input class="my-2 form-control w-25 float-right" type="text" id="myInput" onkeyup="searchData()" placeholder="Cari Data">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Afiliasi</th>
                        <th>Ruangan</th>
                        <th>Waktu Mengisi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ruangans as $ruangan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ruangan->nama_peminjam }}</td>
                        <td>{{ $ruangan->afiliasi }}</td>
                        <td>{{ $ruangan->ruang_lab }}</td>
                        <td>{{ $ruangan->created_at }}</td>
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
                                    <h5 class="my-2">{{ $ruangan->ruang_lab }}</h5>
                                    <b>Nama :</b>{{$ruangan->nama_peminjam}}
                                    <b>Nim :</b> {{$ruangan->nim}}</br>
                                    <b>Email :</b> {{$ruangan->email}}</br>
                                    <b>No HP :</b> {{$ruangan->no_hp}}</br>
                                    <b>Afiliasi :</b> {{$ruangan->afiliasi}}</br>
                                    <b>Ruang Lab :</b> {{$ruangan->ruang_lab}}</br>
                                    <b>Dosen :</b> {{$ruangan->dosen}}</br>
                                    <b>Kode Matkul :</b> {{$ruangan->kode_matkul}}</br>
                                    <b>Mata Kuliah :</b> {{$ruangan->mata_kuliah}}</br>
                                    <b>Hari :</b> {{$ruangan->hari}}</br>
                                    <b>Waktu :</b> {{$ruangan->waktu}}</br>
                                    <b>Minggu Ke</b>
                                    <ul>
                                        @foreach ($peminjamans as $peminjaman)
                                        @if ($peminjaman->form_ruangan_id == $ruangan->id)
                                        <li>{{ $peminjaman->minggu }}</small></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{ route('peminjaman.ruangan.update') }}">
                                        @csrf
                                        <input type="hidden" name="form_ruangan_id" value="{{ $ruangan->id }}" />
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger" name="action" value="0">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6">Tidak ada peminjaman</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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