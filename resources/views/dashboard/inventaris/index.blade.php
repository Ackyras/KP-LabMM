@extends('master.dashboard')

@section('css')
<link href="{{ asset('css/bootstrap-table.css') }}" rel="stylesheet">
@endsection

@section('title-page')
Inventaris
@endsection

@section('content')
<div class="row">
    <div class="d-inline p-2 bg-primary text-white">
        <a class="text-white" href="{{ route('inventaris.create') }}">Tambah Inventaris</a>
        <i class="fas fa-plus"></i>
    </div>

    <table id="table" data-toggle="table" data-height="460" data-show-columns="true" data-show-refresh="true" data-show-columns-toggle-all="true" data-show-toggle="true" data-detail-view="true" data-detail-formatter="detailFormatter" data-search="true" data-search-highlight="true" data-toolbar=".toolbar" data-custom-sort="customSort" data-pagination="true" data-side-pagination="server">
        <thead>
            <tr>
                <th data-field="id" data-sortable="true">Kode</th>
                <th data-field="name" data-sortable="true">Nama</th>
                <th data-field="lokasi" data-sortable="true">Lokasi</th>
                <th data-field="kategori" data-sortable="true">Kategori</th>
                <th data-field="stok" data-sortable="true">Stock</th>
                <th data-field="Tersedia" data-sortable="true">Tersedia</th>
                <th data-field="Masuk" data-sortable="true">Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $barang)
            <tr>
                <td>{{ $barang->kd_barang }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->lokasi }}</td>
                <td>{{ $barang->kategori }}</td>
                <td>{{ $barang->stok }}</td>
                <td>{{ $barang->peminjaman }}</td>
                <td>{{ $barang->masuk_barang }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Data tidak ada</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $data->links() }}
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap-table.min.js') }}"></script>
<script src="https://kit.fontawesome.com/d808726940.js" crossorigin="anonymous"></script>
<script>
    function detailFormatter(index, row) {
        var html = []
        $.each(row, function(key, value) {
            if (key == "id") {
                html.push("<a href='{{ route('inventaris.show', $barang->id) }}' class='btn-action btn btn-info btn-sm mt-2'" + value + ">Lihat Detail</a><a href='{{ route('inventaris.edit', $barang->id) }}' class='btn-action btn btn-outline-secondary btn-sm mx-2 mt-2' name='edit-'" + value + ">Edit</a><button class='btn-action btn btn-outline-danger btn-sm mt-2' name='hapus-'" + value + ">Hapus</button>")
            }
            // html.push('<p><b>' + key + ':</b> ' + value + "</p>")
        })
        return html.join('')
    }
</script>
@endsection