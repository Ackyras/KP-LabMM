@extends('master.dashboard')

@section('title-page', 'Riwayat Presensi {{ $asprak->nama }}')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Presensi {{ $asprak->nama }}</h6>
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
                            <th>Waktu Asistensi</th>
                            <th>Waktu Presensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($asprak as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ date('l, d-m-Y', strtotime($itema->created_at)) }}</td>
                                {{-- <td>
                                    <a href="{{ route('presensi.index', $item->slug) }}" class="btn btn-sm btn-info">Riwayat Presensi</a>
                                    <a href="{{ route('ruanglab.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#data{{ $item->id }}">Detail</button>
                                    <form action="{{ route('presensi.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Menghapus data akan menghapus seluruh data presensi yang terkait dengan QRCode ini')"
                                            class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Belum ada presensi</td>
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
