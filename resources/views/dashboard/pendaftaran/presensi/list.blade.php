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
                        <th>Mata Kuliah</th>
                        <th>Tanggal presensi</th>
                        <th>Dibuat pada</th>
                        <th>Berlaku hingga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($qr as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$item->matakuliah->nama}}</td>
                        <td>{{ date('l, d-m-Y', strtotime($item->valid_for)) }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->valid_until }}</td>
                        <td>
                            {{-- <a href="{{ route('presensi.index', $item->slug) }}" class="btn btn-sm
                            btn-info">Riwayat Presensi</a> --}}
                            {{-- <a href="{{ route('ruanglab.edit', $item->id) }}" class="btn btn-sm
                            btn-primary">Edit</a> --}}
                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#data{{ $item->id }}">Detail</button>
                            <form action="{{ route('presensi.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Menghapus data akan menghapus seluruh data presensi yang terkait dengan QRCode ini')"
                                    class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="data{{ $item->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">QRCode</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="visible-print text-center">
                                        {!! QrCode::size(100)->generate($item->token) !!}
                                        <p>{{ date('d-m-Y, H:m', strtotime($item->created_at)) }} -
                                            {{ date('d-m-Y, H:m', strtotime($item->valid_until)) }}</p>
                                    </div>

                                    {{-- <img src="{!!$message->embedData(QrCode::format('png')->generate($item->token), 'QrCode.png', 'image/png')!!}"></br> --}}
                                    <div class="modal-footer">
                                        <a href="{{ route('inventaris.edit', $item->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus barang?')"
                                                class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="5">Belum ada ruangan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $qr->links() }}
        </div>
    </div>
    <!-- Create New QRCode Modal -->
    <div class="modal fade" id="createQRModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">QRCode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('presensi.store') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{Str::random(20)}}">
                        <div class="row">
                            <div class="col">
                                <div class="mb-1 mx-auto form-admin">
                                    <label class="form-label" for="matakuliah">Mata Kuliah</label>
                                    <select name="form-control @error('matakuliah') is-invalid @enderror"
                                        id="matakuliah">
                                        <option value="" disabled selected>Mata Kuliah</option>
                                        @forelse ($matakuliah as $item)
                                        <option value="{{$item->id}}">{{$item->daftarmatakuliah->nama}}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                    @error('matakuliah')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 mx-auto form-admin">
                            <label class="form-label">Tanggal Presensi</label>
                            <input class="form-control @error('valid_for') is-invalid @enderror" type="date"
                                name="valid_for" value="<?php echo date("Y-m-d"); ?>" id="example-datetime-local-input">
                            @error('valid_for')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-1 mx-auto form-admin">
                            <label class="form-label">Berlaku hingga</label>
                            <input class="form-control @error('valid_until') is-invalid @enderror" type="datetime-local"
                                name="valid_until" value="<?php echo date("Y-m-d"); ?>"
                                id="example-datetime-local-input">
                            @error('valid_until')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-3 mx-auto form-admin position-relative pb-5">
                            <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Create New QRCode Modal -->
    <div class="card-footer">
        <div class="float-right">
            <button class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#createQRModal"
                type="button">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </button>
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
