@extends('master.dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Barang Dipinjam (Hari Ini)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$barangdipinjam}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-toolbox fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Form Masuk Peminjaman (Barang)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$banyakformbarang}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-wpforms fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Barang Belum Dikembalikan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$barangbelumkembali}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Form Masuk Peminjaman (Ruangan)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$banyakformruangan}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-wpforms fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Peminjaman Barang Hari Ini</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" style="font-size: 13px">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Status</th>
                                <th scope="col">Waktu Isi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($formbarangs as $formbarang)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$formbarang->nama_peminjam}}</td>
                                <td>{{ ($formbarang->validasi == '1') ? "Belum Meminjam" : "Sedang Meminjam" }}</td>
                                <td>{{$formbarang->created_at}}</td>
                                <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#data{{$formbarang->id}}">Detail</button></td>
                            </tr>
                            <div class="modal fade" id="data{{$formbarang->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data Peminjam</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="my-2">Status : {{ ($formbarang->validasi == '1') ? "Belum Meminjam" : "Sedang Meminjam" }}</h5>
                                            <b>Nama :</b> {{$formbarang->nama_peminjam}} </br>
                                            <b>Nim :</b> {{$formbarang->nim}}</br>
                                            <b>Email :</b> {{$formbarang->email}}</br>
                                            <b>No HP :</b> {{$formbarang->no_hp}}</br>
                                            <b>Afiliasi :</b> {{$formbarang->afiliasi}}</br>
                                            <b>Tanggal Peminjaman :</b> {{$formbarang->tanggal_peminjaman}}</br>
                                            <b>Tanggal Pengembalian :</b> {{$formbarang->tanggal_pengembalian}}</br>
                                            <b>Barang Pinjaman</b>
                                            <ul>
                                                @foreach ($barangs as $barang)
                                                @if ($barang->form_barang_id == $formbarang->id)
                                                <li>{{ $barang->inventaris->nama_barang }} <small>({{$barang->jumlah}} unit)</small></li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('peminjaman.barang.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="form_barang_id" value="{{ $formbarang->id }}" />
                                                <button type="submit" name="action" value="3" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger">Hapus Data</button>
                                                @if ($formbarang->validasi == 1)
                                                <button type="submit" name="action" value="2" class="btn btn-warning">Sedang meminjam</button>
                                                @endif
                                                @if ($formbarang->validasi == 2)
                                                <button type="submit" name="action" value="0" class="btn btn-success">Selesai meminjam</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <th scope="row" colspan="5">Tidak ada form peminjaman barang</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('peminjaman.barang') }}" class="btn btn-primary btn-icon-split float-right w-100">
                    <span class="text" style="color:white;">Lihat Selengkapnya</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Peminjaman Ruangan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" style="font-size: 13px">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Ruangan</th>
                                <th scope="col">Waktu Isi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($formruangans as $formruangan)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td> {{$formruangan->nama_peminjam}} </td>
                                <td> {{$formruangan->ruanglab->ruang}} </td>
                                <td> {{$formruangan->created_at}} </td>
                                <td>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#data{{$formruangan->nim}}">Detail</button>
                                </td>
                            </tr>
                            <div class="modal fade" id="data{{$formruangan->nim}}" tabindex="-1" role="dialog" aria-labelledby="ruangan" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data Peminjam</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="my-2">{{ $formruangan->ruanglab->ruang }}</h5>
                                            <pre><b>Nama               :</b> {{$formruangan->nama_peminjam}}</pre>
                                            <pre><b>Nim                  :</b> {{$formruangan->nim}}</br></pre>
                                            <pre><b>Email                :</b> {{$formruangan->email}}</br></pre>
                                            <pre><b>No HP              :</b> {{$formruangan->no_hp}}</br></pre>
                                            <pre><b>Afiliasi             :</b> {{$formruangan->afiliasi}}</br></pre>
                                            <pre><b>Ruang Lab       :</b> {{$formruangan->ruanglab->ruang}}</br></pre>
                                            <pre><b>Dosen              :</b> {{$formruangan->dosen}}</br></pre>
                                            <pre><b>Kode Matkul    :</b> {{$formruangan->kode_matkul}}</br></pre>
                                            <pre><b>Mata Kuliah     :</b> {{$formruangan->mata_kuliah}}</br></pre>
                                            <pre><b>Hari                  :</b> {{$formruangan->hari}}</br></pre>
                                            <pre><b>Waktu              :</b> {{$formruangan->waktu}}</br></pre>
                                            <pre><b>Minggu Ke</b></pre>
                                            <ul>
                                                @foreach ($ruangans as $ruangan)
                                                @if ($ruangan->form_ruangan_id == $formruangan->id)
                                                <li>{{ $ruangan->minggu }}</small></li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('peminjaman.ruangan.update') }}">
                                                @csrf
                                                <input type="hidden" name="form_ruangan_id" value="{{ $formruangan->id }}" />
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger" name="action" value="0">Hapus</button>
                                                <button type="submit" class="btn btn-warning" name="action" value="1">Tidak Setuju</button>
                                                <button type="submit" class="btn btn-success" name="action" value="2">Setuju</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <th scope="row" colspan="5">Tidak ada form peminjaman ruangan</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('peminjaman.ruangan') }}" class="btn btn-primary btn-icon-split float-right w-100">
                    <span class="text" style="color:white;">Lihat Selengkapnya</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection