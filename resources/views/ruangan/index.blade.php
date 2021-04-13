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
            <table class="table table-bordered table-hover">
                <thead class="thead">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Ruangan</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ruangs as $ruang)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $ruang->ruang }}</td>
                        <td>{{ $ruang->lokasi }}</td>
                        <td><a href="{{ route('ruangan.show', $ruang->slug) }}" class="btn btn-submit">Lihat Jadwal</a></td>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="4">Tidak ada jadwal ruangan</th>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $ruangs->links() }}
    </div>
</div>
@endsection