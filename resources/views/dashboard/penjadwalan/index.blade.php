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
        <div class="dropdown float-right mb-3 mr-4">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter Ruangan
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($ruanglabs as $ruang)
                <a class="dropdown-item" href="{{ route('penjadwalan.index', ['slug' => $ruang->slug]) }}">{{$ruang->lokasi . ' : ' . $ruang->ruang}}</a>
                @endforeach
            </div>
        </div>
        <form action="{{ route('penjadwalan.reset', $id) }}" method="POST">
            @csrf
            <input name="slug" type="hidden" value="{{$slug}}">
            <button class="btn btn-danger ml-3" type="submit" onclick="return confirm('Aksi ini akan mereset seluruh jadwal')">Reset Jadwal</button>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th scope="row">Senin</th>
                        <th scope="row">Selasa</th>
                        <th scope="row">Rabu</th>
                        <th scope="row">Kamis</th>
                        <th scope="row">Jumat</th>
                        <th scope="row">Sabtu</th>
                        <th scope="row">Minggu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">07:00</td>
                        @for ($i = 0; $i < 7; $i++) <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#data{{$jadwal[$i][0]['id']}}">Detail</button></td>
                            <div class="modal fade" id="data{{$jadwal[$i][0]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data Jadwal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="accordion{{$jadwal[$i][0]['id']}}">
                                                @foreach($ruangans as $ruangan)
                                                @if ($ruangan->hari == $jadwal[$i][0]['hari'] and $ruangan->waktu == $jadwal[$i][0]['waktu'])
                                                <div class="card">
                                                    <div class="card-header text-center" id="headingOne">
                                                        <h5 class="mx-auto">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#minggu{{$ruangan->id}}" aria-expanded="true" aria-controls="minggu{{$ruangan->id}}">
                                                                Minggu {{$ruangan->minggu}}
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="minggu{{$ruangan->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion{{$jadwal[$i][0]['id']}}">
                                                        <div class="card-body">
                                                            @if($ruangan->status == 1)
                                                            @foreach($peminjams as $peminjam)
                                                            @if($peminjam->formruangan->ruang_lab == $ruangan->ruang_lab)
                                                            <dl class="ml-3">
                                                                <dt><small><b>Nama Peminjam</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->nama_peminjam }}</dd>
                                                                <dt><small><b>NIM / NIP</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->nim }}</dd>
                                                                <dt><small><b>Email</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->email }}</dd>
                                                                <dt><small><b>No HP</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->no_hp }}</dd>
                                                                <dt><small><b>Afiliasi</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->afiliasi }}</dd>
                                                                <dt><small><b>Mata Kuliah</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->mata_kuliah }}</dd>
                                                                <dt><small><b>Kode Mata Kuliah</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->kode_matkul }}</dd>
                                                                <dt><small><b>Dosen</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->dosen }}</dd>
                                                                <dt><small><b>Keterangan</b></small></dt>
                                                                <dd>{!! nl2br(e($peminjam->formruangan->keterangan)) !!}</dd>
                                                            </dl>
                                                            <form action="{{ route('penjadwalan.destroy', $ruangan->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="slug" value="{{$slug}}">
                                                                <button class="btn btn-danger float-right mb-3" onclick="return confirm('Yakin ingin menghapus jadwal?')">Hapus Jadwal</button>
                                                            </form>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            Belum ada jadwal
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                    </tr>
                    <tr>
                        <td scope="row">09:00</td>
                        @for ($i = 7; $i < 14; $i++) <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#data{{$jadwal[$i][0]['id']}}">Detail</button></td>
                            <div class="modal fade" id="data{{$jadwal[$i][0]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data Jadwal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="accordion{{$jadwal[$i][0]['id']}}">
                                                @foreach($ruangans as $ruangan)
                                                @if ($ruangan->hari == $jadwal[$i][0]['hari'] and $ruangan->waktu == $jadwal[$i][0]['waktu'])
                                                <div class="card">
                                                    <div class="card-header text-center" id="headingOne">
                                                        <h5 class="mx-auto">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#minggu{{$ruangan->id}}" aria-expanded="true" aria-controls="minggu{{$ruangan->id}}">
                                                                Minggu {{$ruangan->minggu}}
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="minggu{{$ruangan->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion{{$jadwal[$i][0]['id']}}">
                                                        <div class="card-body">
                                                            @if($ruangan->status == 1)
                                                            @foreach($peminjams as $peminjam)
                                                            @if($peminjam->formruangan->ruang_lab == $ruangan->ruang_lab)
                                                            <dl class="ml-3">
                                                                <dt><small><b>Nama Peminjam</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->nama_peminjam }}</dd>
                                                                <dt><small><b>NIM / NIP</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->nim }}</dd>
                                                                <dt><small><b>Email</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->email }}</dd>
                                                                <dt><small><b>No HP</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->no_hp }}</dd>
                                                                <dt><small><b>Afiliasi</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->afiliasi }}</dd>
                                                                <dt><small><b>Mata Kuliah</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->mata_kuliah }}</dd>
                                                                <dt><small><b>Kode Mata Kuliah</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->kode_matkul }}</dd>
                                                                <dt><small><b>Dosen</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->dosen }}</dd>
                                                                <dt><small><b>Keterangan</b></small></dt>
                                                                <dd>{!! nl2br(e($peminjam->formruangan->keterangan)) !!}</dd>
                                                            </dl>
                                                            <form action="{{ route('penjadwalan.destroy', $ruangan->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="slug" value="{{$slug}}">
                                                                <button class="btn btn-danger float-right mb-3" onclick="return confirm('Yakin ingin menghapus jadwal?')">Hapus Jadwal</button>
                                                            </form>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            Belum ada jadwal
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                    </tr>
                    <tr>
                        <td scope="row">13:00</td>
                        @for ($i = 14; $i < 21; $i++) <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#data{{$jadwal[$i][0]['id']}}">Detail</button></td>
                            <div class="modal fade" id="data{{$jadwal[$i][0]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data Jadwal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="accordion{{$jadwal[$i][0]['id']}}">
                                                @foreach($ruangans as $ruangan)
                                                @if ($ruangan->hari == $jadwal[$i][0]['hari'] and $ruangan->waktu == $jadwal[$i][0]['waktu'])
                                                <div class="card">
                                                    <div class="card-header text-center" id="headingOne">
                                                        <h5 class="mx-auto">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#minggu{{$ruangan->id}}" aria-expanded="true" aria-controls="minggu{{$ruangan->id}}">
                                                                Minggu {{$ruangan->minggu}}
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="minggu{{$ruangan->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion{{$jadwal[$i][0]['id']}}">
                                                        <div class="card-body">
                                                            @if($ruangan->status == 1)
                                                            @foreach($peminjams as $peminjam)
                                                            @if($peminjam->formruangan->ruang_lab == $ruangan->ruang_lab)
                                                            <dl class="ml-3">
                                                                <dt><small><b>Nama Peminjam</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->nama_peminjam }}</dd>
                                                                <dt><small><b>NIM / NIP</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->nim }}</dd>
                                                                <dt><small><b>Email</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->email }}</dd>
                                                                <dt><small><b>No HP</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->no_hp }}</dd>
                                                                <dt><small><b>Afiliasi</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->afiliasi }}</dd>
                                                                <dt><small><b>Mata Kuliah</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->mata_kuliah }}</dd>
                                                                <dt><small><b>Kode Mata Kuliah</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->kode_matkul }}</dd>
                                                                <dt><small><b>Dosen</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->dosen }}</dd>
                                                                <dt><small><b>Keterangan</b></small></dt>
                                                                <dd>{!! nl2br(e($peminjam->formruangan->keterangan)) !!}</dd>
                                                            </dl>
                                                            <form action="{{ route('penjadwalan.destroy', $ruangan->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="slug" value="{{$slug}}">
                                                                <button class="btn btn-danger float-right mb-3" onclick="return confirm('Yakin ingin menghapus jadwal?')">Hapus Jadwal</button>
                                                            </form>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            Belum ada jadwal
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                    </tr>
                    <tr>
                        <td scope="row">15:00</td>
                        @for ($i = 21; $i < 28; $i++) <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#data{{$jadwal[$i][0]['id']}}">Detail</button></td>
                            <div class="modal fade" id="data{{$jadwal[$i][0]['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data Jadwal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="accordion{{$jadwal[$i][0]['id']}}">
                                                @foreach($ruangans as $ruangan)
                                                @if ($ruangan->hari == $jadwal[$i][0]['hari'] and $ruangan->waktu == $jadwal[$i][0]['waktu'])
                                                <div class="card">
                                                    <div class="card-header text-center" id="headingOne">
                                                        <h5 class="mx-auto">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#minggu{{$ruangan->id}}" aria-expanded="true" aria-controls="minggu{{$ruangan->id}}">
                                                                Minggu {{$ruangan->minggu}}
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="minggu{{$ruangan->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion{{$jadwal[$i][0]['id']}}">
                                                        <div class="card-body">
                                                            @if($ruangan->status == 1)
                                                            @foreach($peminjams as $peminjam)
                                                            @if($peminjam->formruangan->ruang_lab == $ruangan->ruang_lab)
                                                            <dl class="ml-3">
                                                                <dt><small><b>Nama Peminjam</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->nama_peminjam }}</dd>
                                                                <dt><small><b>NIM / NIP</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->nim }}</dd>
                                                                <dt><small><b>Email</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->email }}</dd>
                                                                <dt><small><b>No HP</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->no_hp }}</dd>
                                                                <dt><small><b>Afiliasi</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->afiliasi }}</dd>
                                                                <dt><small><b>Mata Kuliah</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->mata_kuliah }}</dd>
                                                                <dt><small><b>Kode Mata Kuliah</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->kode_matkul }}</dd>
                                                                <dt><small><b>Dosen</b></small></dt>
                                                                <dd>{{ $peminjam->formruangan->dosen }}</dd>
                                                                <dt><small><b>Keterangan</b></small></dt>
                                                                <dd>{!! nl2br(e($peminjam->formruangan->keterangan)) !!}</dd>
                                                            </dl>
                                                            <form action="{{ route('penjadwalan.destroy', $ruangan->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="slug" value="{{$slug}}">
                                                                <button class="btn btn-danger float-right mb-3" onclick="return confirm('Yakin ingin menghapus jadwal?')">Hapus Jadwal</button>
                                                            </form>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            Belum ada jadwal
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection('content')