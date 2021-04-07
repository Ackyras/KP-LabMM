@extends('master.dashboard')

@section('css')
@endsection

@section('title-page', 'List Calon Asprak')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Calon Asprak</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Angkatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($aspraks as $asprak)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $asprak->nama }}</td>
                        <td>{{ $asprak->program_studi }}</td>
                        <td>{{ $asprak->angkatan }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#data{{$asprak->id}}">Detail</button>
                        </td>
                        <div class="modal fade" id="data{{$asprak->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Data Calon Asprak</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <b class="ml-3">Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{ $asprak->nama }}</br>
                                        <b class="ml-3">NIM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{ $asprak->nim }}</br>
                                        <b class="ml-3">Program Studi &nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{ $asprak->program_studi }}</br>
                                        <b class="ml-3">Angkatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{ $asprak->angkatan }}</br>
                                        <b class="ml-3">E-mail &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{ $asprak->email }}</br>
                                        <b class="ml-3">Tanggal lahir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{ $asprak->tanggal_lahir }}</br>
                                        <a href="{{ $asprak->cv }}" class="btn btn-sm btn-info">Lihat CV</a>
                                        <a href="{{ $asprak->khs }}" class="btn btn-sm btn-info">Lihat KHS</a>
                                        <a href="{{ $asprak->ktm }}" class="btn btn-sm btn-info">Lihat KTM</a>
                                        <b class="ml-3 d-block">Pilihan mata kuliah</b></br>
                                        <ul>
                                            @foreach ($pilihans as $pilihan)
                                            @foreach ($daftar_matkuls as $daftar_matkul)
                                            @if($pilihan->matakuliah->mata_kuliah_id == $daftar_matkul->id and $pilihan->calon_asprak_id == $asprak->id)
                                            <li>{{ $daftar_matkul->nama }}</li>
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('asprak.verifikasi') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $asprak->id }}">
                                            <button type="submit" name="action" value="0" onclick="return confirm('Yakin ingin menghapus data calon asprak {{ $asprak->nama }}?')" class="btn btn-danger">Hapus</button>
                                            <button type="submit" name="action" value="1" onclick="return confirm('Verifikasi calon asprak {{ $asprak->nama }}?')" class="btn btn-success">Verifikasi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Tidak ada pendaftar calon asprak</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection