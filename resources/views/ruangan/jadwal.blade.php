@extends('master.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/jadwalruangan.css') }}">
@endsection

@section('content')
<div class="row">
    <h4 class="p-2 title-header">Jadwal Ruangan</h4>
    <div class="line"></div>
</div>
<div class="row row-2">
    <div class="card mx-auto">
        <div class="card-body align-items-center d-flex">
            <div class="table-responsive w-100">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead">
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
                            @for ($i = 0; $i <= 6; $i++) <td><button class="btn btn-submit" data-toggle="modal" data-target="#modal{{$jadwal[$i][0]['id']}}">Detail</button></td>
                                <div class="modal fade" id="modal{{$jadwal[$i][0]['id']}}" tabindex="-1" role="dialog" aria-labelledby="modalclient" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalclient">Data Jadwal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="accordion{{$jadwal[$i][0]['id']}}">
                                                    @foreach($ruangans as $ruangan)
                                                    @if ($ruangan->hari == $jadwal[$i][0]['hari'] and $ruangan->waktu == $jadwal[$i][0]['waktu'])
                                                    <div class="card mx-auto">
                                                        <button class="btn btn-submit text-white mb-3 card-header" data-toggle="collapse" data-target="#minggu{{$ruangan->id}}" aria-expanded="true" aria-controls="minggu{{$ruangan->id}}">
                                                            Minggu {{$ruangan->minggu}}<i class="fas fa-caret-down float-right mr-3 icon-dropdown"></i>
                                                        </button>
                                                        <div id="minggu{{$ruangan->id}}" class="collapse mb-3" aria-labelledby="headingOne" data-parent="#accordion{{$jadwal[$i][0]['id']}}">
                                                            <div class="card-body">
                                                                @if($ruangan->status == 1)
                                                                @foreach($peminjams as $peminjam)
                                                                @if($peminjam->formruangan->ruang_lab == $ruangan->ruang_lab and $peminjam->ruangan_id == $ruangan->id)
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
                            @for ($i = 7; $i < 14; $i++) <td><button class="btn btn-submit" data-toggle="modal" data-target="#modal{{$jadwal[$i][0]['id']}}">Detail</button></td>
                                <div class="modal fade" id="modal{{$jadwal[$i][0]['id']}}" tabindex="-1" role="dialog" aria-labelledby="modalclient" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalclient">Data Jadwal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="accordion{{$jadwal[$i][0]['id']}}">
                                                    @foreach($ruangans as $ruangan)
                                                    @if ($ruangan->hari == $jadwal[$i][0]['hari'] and $ruangan->waktu == $jadwal[$i][0]['waktu'])
                                                    <div class="card mx-auto">
                                                        <button class="btn btn-submit text-white mb-3 card-header" data-toggle="collapse" data-target="#minggu{{$ruangan->id}}" aria-expanded="true" aria-controls="minggu{{$ruangan->id}}">
                                                            Minggu {{$ruangan->minggu}}<i class="fas fa-caret-down float-right mr-3 icon-dropdown"></i>
                                                        </button>
                                                        <div id="minggu{{$ruangan->id}}" class="collapse mb-3" aria-labelledby="headingOne" data-parent="#accordion{{$jadwal[$i][0]['id']}}">
                                                            <div class="card-body">
                                                                @if($ruangan->status == 1)
                                                                @foreach($peminjams as $peminjam)
                                                                @if($peminjam->formruangan->ruang_lab == $ruangan->ruang_lab and $peminjam->ruangan_id == $ruangan->id)
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
                            @for ($i = 14; $i < 21; $i++) <td><button class="btn btn-submit" data-toggle="modal" data-target="#modal{{$jadwal[$i][0]['id']}}">Detail</button></td>
                                <div class="modal fade" id="modal{{$jadwal[$i][0]['id']}}" tabindex="-1" role="dialog" aria-labelledby="modalclient" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalclient">Data Jadwal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="accordion{{$jadwal[$i][0]['id']}}">
                                                    @foreach($ruangans as $ruangan)
                                                    @if ($ruangan->hari == $jadwal[$i][0]['hari'] and $ruangan->waktu == $jadwal[$i][0]['waktu'])
                                                    <div class="card mx-auto">
                                                        <button class="btn btn-submit text-white mb-3 card-header" data-toggle="collapse" data-target="#minggu{{$ruangan->id}}" aria-expanded="true" aria-controls="minggu{{$ruangan->id}}">
                                                            Minggu {{$ruangan->minggu}}<i class="fas fa-caret-down float-right mr-3 icon-dropdown"></i>
                                                        </button>
                                                        <div id="minggu{{$ruangan->id}}" class="collapse mb-3" aria-labelledby="headingOne" data-parent="#accordion{{$jadwal[$i][0]['id']}}">
                                                            <div class="card-body">
                                                                @if($ruangan->status == 1)
                                                                @foreach($peminjams as $peminjam)
                                                                @if($peminjam->formruangan->ruang_lab == $ruangan->ruang_lab and $peminjam->ruangan_id == $ruangan->id)
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
                            @for ($i = 21; $i < 28; $i++) <td><button class="btn btn-submit" data-toggle="modal" data-target="#modal{{$jadwal[$i][0]['id']}}">Detail</button></td>
                                <div class="modal fade" id="modal{{$jadwal[$i][0]['id']}}" tabindex="-1" role="dialog" aria-labelledby="modalclient" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalclient">Data Jadwal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="accordion{{$jadwal[$i][0]['id']}}">
                                                    @foreach($ruangans as $ruangan)
                                                    @if ($ruangan->hari == $jadwal[$i][0]['hari'] and $ruangan->waktu == $jadwal[$i][0]['waktu'])
                                                    <div class="card mx-auto">
                                                        <button class="btn btn-submit text-white mb-3 card-header" data-toggle="collapse" data-target="#minggu{{$ruangan->id}}" aria-expanded="true" aria-controls="minggu{{$ruangan->id}}">
                                                            Minggu {{$ruangan->minggu}}<i class="fas fa-caret-down float-right mr-3 icon-dropdown"></i>
                                                        </button>
                                                        <div id="minggu{{$ruangan->id}}" class="collapse mb-3" aria-labelledby="headingOne" data-parent="#accordion{{$jadwal[$i][0]['id']}}">
                                                            <div class="card-body">
                                                                @if($ruangan->status == 1)
                                                                @foreach($peminjams as $peminjam)
                                                                @if($peminjam->formruangan->ruang_lab == $ruangan->ruang_lab and $peminjam->ruangan_id == $ruangan->id)
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
</div>
@endsection

@section('js')
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection