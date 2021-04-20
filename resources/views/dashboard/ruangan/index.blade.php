@extends('master.dashboard')

@section('title-page', "Penjadwalan Ruangan")

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Penjadwalan Ruangan</h6>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
        @endif
        <input class="mb-2 form-control w-25 float-right" type="text" id="myInput" onkeyup="searchData()" placeholder="Cari Data">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Ruangan</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ruanglabs as $ruang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ruang->ruang }}</td>
                        <td>{{ $ruang->lokasi }}</td>
                        <td>{{ $ruang->status }}</td>
                        <td>
                            <a href="{{ route('penjadwalan.index', $ruang->slug) }}" class="btn btn-sm btn-info">Jadwal</a>
                            <a href="{{ route('ruanglab.edit', $ruang->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('ruanglab.destroy', $ruang->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Menghapus data akan menghapus seluruh jadwal diruangan {{ $ruang->ruang}}')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Belum ada ruangan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$ruanglabs->links()}}
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