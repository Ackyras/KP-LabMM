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
    
    <table
    id="table"
    data-toggle="table"
    data-height="460"
    
    data-show-columns="true"
    data-show-refresh="true"
    data-show-columns-toggle-all="true"
    data-show-toggle="true"

    data-detail-view="true"
    data-detail-formatter="detailFormatter"
    data-search="true"
    data-search-highlight="true"
    data-toolbar=".toolbar"
    data-custom-sort="customSort"
    data-pagination="true"
    data-side-pagination="server"
    data-url="https://examples.wenzhixin.net.cn/examples/bootstrap_table/data">
    <thead>
        <tr>
        <th data-field="id" data-sortable="true">Kode</th>
        <th data-field="name" data-sortable="true">Nama</th>
        <th data-field="price" data-sortable="true">Lokasi</th>
        <th data-field="price" data-sortable="true">Kategori</th>
        <th data-field="price" data-sortable="true">Stock</th>
        <th data-field="price" data-sortable="true">Tersedia</th>
        <th data-field="price" data-sortable="true">Tanggal Masuk</th>
        </tr>
    </thead>
    <tr>
        <td>asd</td>
        <td>asd</td>
        <td>asd</td>
        <td>ada</td>
        <td>ga</td>
    </tr>
    <tr>
        <td>asd</td>
        <td>asd</td>
        <td>asd</td>
        <td>ada</td>
        <td>ga</td>
    </tr>
    </table>
    {{-- @foreach($data as $datas)
    <div class="card mx-3 my-3" style="width: 13rem; height: 280px;">
        <img src="{{ $datas->foto }}" class="card-img-top px-3 mx-auto" style="object-fit: contain; width: 10rem; height: 10rem;" alt="{{ $datas->kd_barang }}">
        <div class="card-body">
            <h6 class="card-title mx-auto">{{ $datas->nama_barang }}</h6>
            <a href="{{ route('inventaris.show', $datas->id) }}" class="btn btn-primary">Lihat Barang</a>
        </div>
    </div>
    @endforeach --}}
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
      $.each(row, function (key, value) {
        if (key == "id"){
            html.push("<button class='btn-action btn btn-info btn-sm mt-2' name='detail-'" + value +">Lihat Detail</button><button class='btn-action btn btn-outline-secondary btn-sm mx-2 mt-2' name='edit-'" + value +">Edit</button><button class='btn-action btn btn-outline-danger btn-sm mt-2' name='hapus-'" + value +">Hapus</button>")
        }
        // html.push('<p><b>' + key + ':</b> ' + value + "</p>")
      }
      )
      return html.join('')
    }
  </script>
@endsection