@extends('master.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/formruangan.css')}}">
@endsection

@section('content')
<div class="row">
    <h4 class="p-2 title-header">Formulir Peminjaman Ruangan</h4>
    <div class="line"></div>
    <h4 class="title-data">Data Peminjam</h4>
    <div class="line-2"></div>
</div>
<div class="row pb-4">
    @if (session('status'))
    <div class="alert alert-success mt-3 w-50">
        {{ session('status') }}
    </div>
    @endif
    <form class="col-8" action="{{ route('ruangan.store') }}" method="POST">
        @csrf
        <div class="form-group p-1">
            <label>Nama lengkap</label>
            <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}" class="form-control rounded @error('nama_peminjam') is-invalid @enderror" required placeholder="Masukkan nama anda" autofocus>
            @error('nama_peminjam')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>NIM/NIP</label>
            <input type="text" name="nim" value="{{ old('nim') }}" class="form-control rounded @error('nim') is-invalid @enderror" required placeholder="Masukan NIM/NIP anda">
            @error('nim')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Alamat Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded @error('email') is-invalid @enderror" required placeholder="Masukan alamat email anda">
            @error('email')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Nomor Telepon</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="form-control rounded @error('no_hp') is-invalid @enderror" required placeholder="Masukan nomor HP anda">
            @error('no_hp')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Afiliasi / Program Studi</label>
            <input type="text" name="afiliasi" value="{{ old('afiliasi') }}" class="form-control rounded @error('afiliasi') is-invalid @enderror" required placeholder="Masukan program studi anda">
            @error('afiliasi')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <h4 class="title-keterangan">Keterangan Peminjam</h4>
        <div class="line-3"></div>
        <div class="form-group p-1">
            <label>Ruangan Laboratorium</label>
            <select name="ruang_lab" class="form-control @error('ruang_lab') is-invalid @enderror" required>
                <option value="" selected disabled>Pilih ruangan</option>
                @foreach ($ruangs as $ruang)
                <option value="{{ $ruang->id }}"><b>{{ $ruang->lokasi }} : </b>{{$ruang->ruang}}</option>
                @endforeach
            </select>
            @error('ruang_lab')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Mata Kuliah*</label>
            <input type="text" name="mata_kuliah" value="{{ old('mata_kuliah') }}" class="form-control rounded @error('mata_kuliah') is-invalid @enderror" required placeholder="Masukkan mata kuliah">
            @error('mata_kuliah')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Kode Mata Kuliah*</label>
            <input type="text" name="kode_matkul" value="{{ old('kode_matkul') }}" class="form-control rounded @error('kode_matkul') is-invalid @enderror" required placeholder="Masukkan kode mata kuliah">
            @error('kode_matkul')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group p-1">
            <label>Nama Dosen*</label>
            <input type="text" name="dosen" value="{{ old('dosen') }}" class="form-control rounded @error('dosen') is-invalid @enderror" required placeholder="Masukkan kode mata kuliah">
            @error('dosen')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
            <div class="col-6">
                <label>Jam</label>
                <select name="waktu" class="form-control @error('waktu') is-invalid @enderror">
                    <option value="" disabled selected {{ old('waktu') == '' ? 'selected' : '' }}>Pilih Waktu</option>
                    <option value="07:00:00" {{ old('waktu') == '07:00:00' ? 'selected' : ''}}>07:00</option>
                    <option value="09:00:00" {{ old('waktu') == '09:00:00' ? 'selected' : ''}}>09:00</option>
                    <option value="13:00:00" {{ old('waktu') == '13:00:00' ? 'selected' : ''}}>13:00</option>
                    <option value="15:00:00" {{ old('waktu') == '15:00:00' ? 'selected' : ''}}>15:00</option>
                </select>
                @error('waktu')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label>Hari</label>
                <select name="hari" class="form-control @error('hari') is-invalid @enderror">
                    <option value="" disabled selected {{ old('hari') == '' ? 'selected' : '' }}>Pilih Hari</option>
                    <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : ''}}>Senin</option>
                    <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : ''}}>Selasa</option>
                    <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : ''}}>Rabu</option>
                    <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : ''}}>Kamis</option>
                    <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : ''}}>Jumat</option>
                    <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : ''}}>Sabtu</option>
                    <option value="Minggu" {{ old('hari') == 'Minggu' ? 'selected' : ''}}>Minggu</option>
                </select>
                @error('hari')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group p-1">
            <label>Keterangan Peminjaman*</label>
            <textarea value="{{ old('keterangan') }}" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" cols="3" rows="3" placeholder="Masukkan keterangan peminjaman" required autocomplete="off"></textarea>
            @error('keterangan')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
            <div class="col-9">
                @error('minggu')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
                <div class="form-group p-1">
                    <label>Minggu Ke-*</label></br>
                    <div class="d-flex justify-content-md-between ml-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[0]" type="checkbox" id="inlineCheckbox1" value="1">
                            <label class="form-check-label" for="inlineCheckbox1">
                                <pre class="text-minggu"> 1</pre>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[1]" type="checkbox" id="inlineCheckbox2" value="2">
                            <label class="form-check-label" for="inlineCheckbox2">
                                <pre class="text-minggu"> 2</pre>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[2]" type="checkbox" id="inlineCheckbox3" value="3">
                            <label class="form-check-label" for="inlineCheckbox3">
                                <pre class="text-minggu"> 3</pre>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[3]" type="checkbox" id="inlineCheckbox4" value="4">
                            <label class="form-check-label" for="inlineCheckbox4">
                                <pre class="text-minggu"> 4</pre>
                            </label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-md-between ml-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[4]" type="checkbox" id="inlineCheckbox5" value="5">
                            <label class="form-check-label" for="inlineCheckbox5">
                                <pre class="text-minggu"> 5</pre>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[5]" type="checkbox" id="inlineCheckbox6" value="6">
                            <label class="form-check-label" for="inlineCheckbox6">
                                <pre class="text-minggu"> 6</pre>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[6]" type="checkbox" id="inlineCheckbox7" value="7">
                            <label class="form-check-label" for="inlineCheckbox7">
                                <pre class="text-minggu"> 7</pre>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[7]" type="checkbox" id="inlineCheckbox8" value="8">
                            <label class="form-check-label" for="inlineCheckbox8">
                                <pre class="text-minggu"> 8</pre>
                            </label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-md-between ml-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[8]" type="checkbox" id="inlineCheckbox9" value="9">
                            <label class="form-check-label" for="inlineCheckbox9">
                                <pre class="text-minggu"> 9</pre>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[9]" type="checkbox" id="inlineCheckbox10" value="10">
                            <label class="form-check-label" for="inlineCheckbox10">10</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[10]" type="checkbox" id="inlineCheckbox11" value="11">
                            <label class="form-check-label" for="inlineCheckbox11">11</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[11]" type="checkbox" id="inlineCheckbox12" value="12">
                            <label class="form-check-label" for="inlineCheckbox12">12</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-md-between ml-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[12]" type="checkbox" id="inlineCheckbox13" value="13">
                            <label class="form-check-label" for="inlineCheckbox13">13</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[13]" type="checkbox" id="inlineCheckbox14" value="14">
                            <label class="form-check-label" for="inlineCheckbox14">14</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[14]" type="checkbox" id="inlineCheckbox15" value="15">
                            <label class="form-check-label" for="inlineCheckbox15">15</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="minggu[15]" type="checkbox" id="inlineCheckbox16" value="16">
                            <label class="form-check-label" for="inlineCheckbox16">16</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-submit">Pinjam</button>
    </form>
</div>
@endsection