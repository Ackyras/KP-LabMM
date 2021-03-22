@extends('master.dashboard')

@section('title-page')
Peminjaman Barang
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Peminjam Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
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
                            {{-- <form action="{{ route('rekrut.destroy', $daftar->id) }}" method="POST">
                            @csrf
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger" style="display:inline-block;">Hapus</button>
                            </form> --}}
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
                                    <h5 class="my-2">Status : {{ ($form->validasi == '1') ? "Belum Meminjam" : "Sedang Meminjam" }}</h5>
                                    <b>Nama :</b> {{$form->nama_peminjam}} </br>
                                    <b>Nim :</b> {{$form->nim}}</br>
                                    <b>Email :</b> {{$form->email}}</br>
                                    <b>No HP :</b> {{$form->no_hp}}</br>
                                    <b>Afiliasi :</b> {{$form->afiliasi}}</br>
                                    <b>Tanggal Peminjaman :</b> {{$form->tanggal_peminjaman}}</br>
                                    <b>Tanggal Pengembalian :</b> {{$form->tanggal_pengembalian}}</br>
                                    <b>Barang Pinjaman</b>
                                    <ul>
                                        @foreach ($barangs as $barang)
                                        @if ($barang->form_barang_id == $form->id)
                                        <li>{{ $barang->inventaris->nama_barang }} <small>({{$barang->jumlah}} unit)</small></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('peminjaman.barang.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="form_barang_id" value="{{ $form->id }}" />
                                        <button type="submit" name="action" value="3" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger">Hapus Data</button>
                                        @if ($form->validasi == 1)
                                        <button type="submit" name="action" value="2" class="btn btn-warning">Sedang meminjam</button>
                                        @endif
                                        @if ($form->validasi == 2)
                                        <button type="submit" name="action" value="0" class="btn btn-success">Selesai meminjam</button>
                                        @endif
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
@endsection('content')