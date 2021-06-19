@extends('master.master')

@section('title', 'Form Pinjam Barang')

@section('css')
<link rel="stylesheet" href="{{ asset('css/formbarang.css')}}">
@endsection

@section('content')
<div class="row sticky-top bg-light pb-3">
    <h4 class="p-2 title-header">Formulir Peminjaman Barang</h4>
    <div class="line"></div>
</div>
<div class="row">
    <h4 class="title-data">Data Peminjam</h4>
    <div class="line-2"></div>
</div>
<div class="row pb-4">
    @if (session('status'))
    <div class="alert alert-success mt-3 w-50">
        {{ session('status') }}
    </div>
    @endif
    <form class="col-8" action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="form-group p-1">
            <label>Nama lengkap*</label>
            <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}" class="form-control rounded @error('nama_peminjam') is-invalid @enderror" required placeholder="Masukkan nama anda" autofocus>
            @error('nama_peminjam')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>NIM/NIP*</label>
            <input type="text" name="nim" value="{{ old('nim') }}" class="form-control rounded @error('nim') is-invalid @enderror" required placeholder="Masukan NIM/NIP anda">
            @error('nim')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Alamat Email*</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded @error('email') is-invalid @enderror" required placeholder="Masukan alamat email anda">
            @error('email')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Nomor Telepon*</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="form-control rounded @error('no_hp') is-invalid @enderror" required placeholder="Masukan nomor HP anda">
            @error('no_hp')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Afiliasi / Program Studi*</label>
            <input type="text" name="afiliasi" value="{{ old('afiliasi') }}" class="form-control rounded @error('afiliasi') is-invalid @enderror" required placeholder="Masukan program studi anda">
            @error('afiliasi')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <h4 class="title-keterangan">Keterangan Peminjam</h4>
        <div class="line-3"></div>
        <div class="row pb-5">
            <span id="peminjamanBarang" class="row">
                <label>Pilih barang*</label>
                <div class="col-9">
                    <input list="barangs" name="kode[0]" class="form-control @error('kode.*') is-invalid @enderror" required placeholder="Pilih barang">
                    <datalist id="barangs">
                        @foreach($barangs as $barang)
                        <option value="{{ $barang->nama_barang }}"><small>{{ $barang->peminjaman }} unit</small> </option>
                        @endforeach
                    </datalist>
                    @error('kode.*')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-3">
                    <input type="number" name="jumlah.0" min="1" max="5" value="1" class="form-control @error('jumlah.*') is-invalid @enderror" required>
                    @error('jumlah.*')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </span>
            <span id="spanBtn">
                <button id="tambahPeminjaman" type="button" class="btn btn-submit btn-add w-25">Tambah Barang</button>
            </span>
            <div class="form-group">
                <label>Tanggal Peminjaman*</label>
                <input type="date" name="tanggal_peminjaman" class="form-control rounded @error('tanggal_peminjaman') is-invalid @enderror" value="{{ Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') }}" required placeholder="Pilih tanggal peminjaman">
                @error('tanggal_peminjaman')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Tanggal Pengembalian*</label>
                <input type="date" name="tanggal_pengembalian" class="form-control rounded @error('tanggal_pengembalian') is-invalid @enderror" value="{{ Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->addDay()->format('Y-m-d') }}" required placeholder="Pilih tanggal pengembalian">
                @error('tanggal_pengembalian')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group p-1">
                <label>Keperluan*</label>
                <input type="text" name="keperluan" value="{{ old('keperluan') }}" class="form-control rounded @error('keperluan') is-invalid @enderror" required placeholder="Keperluan kegiatan">
                @error('keperluan')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group p-1">
                <label>Tempat Kegiatan*</label>
                <input type="text" name="tempat" value="{{ old('tempat') }}" class="form-control rounded @error('tempat') is-invalid @enderror" required placeholder="Tempat Kegiatan">
                @error('tempat')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-submit">Pinjam</button>
    </form>
</div>
@endsection

@section('js')
    
<script type="text/javascript">
    $(document).ready(function(){
        var i = 1;
        $(document).on('click', '#tambahPeminjaman', function() {
            if (i<5) {
                $('#peminjamanBarang').append('' + 
                    '<div id="tambahBarang' + i + '" class="row">' + 
                        '<label class="mt-3">Pilih barang (<small>opsional</small>)</label>' +
                        '<div class="col-9">' +
                            '<input list="barangs" name="kode[' + i + ']" class="form-control @error("' + 'kode.*' + '") is-invalid @enderror" required placeholder="Pilih barang">' +
                            '<datalist id="barangs">' +
                                '@foreach($barangs as $barang)' +
                                '<option value="{{ $barang->nama_barang }}"><small>{{ $barang->peminjaman }} unit</small> </option>' +
                                '@endforeach' + 
                            '</datalist>' +
                            '@error("' + 'kode.*' + '")' +
                            '<div class="alert alert-danger mt-1">{{ $message }}</div>' +
                            '@enderror' +
                        '</div>' + 
                        '<div class="col-3">' + 
                            '<input type="number" name="jumlah[' + i + ']" min="0" max="5" value="1" class="form-control @error("' + 'jumlah.*' + '") is-invalid @enderror" required>' +
                            '@error("jumlah.*' + '")' + 
                            '<div class="alert alert-danger mt-1">{{ $message }}</div>' + 
                            '@enderror' + 
                        '</div>' + 
                        '<button id="Barang' + i + '" type="button" class="btn btn-submit btn-remove w-25 hapusBarang">Hapus</button>' + 
                    '</div>'
                );
                i++;
                
            }
            if (i >= 5) {
                $('#tambahPeminjaman').remove();
            }
        });

        $(document).on('click', '.hapusBarang', function() {
            const btnHapus = i;
            const hapus = $(this).attr("id");
            $('#tambah' + hapus + '').remove();
            i--;
            if (btnHapus == 5 && i <= 4) {
                $('#spanBtn').append('' + 
                    '<button id="tambahPeminjaman" type="button" class="btn btn-submit btn-add w-25">Tambah Barang</button>' + ''
                );
            }
        });
    })
</script>
@endsection