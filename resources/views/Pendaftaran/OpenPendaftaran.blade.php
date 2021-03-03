<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="main-container" id="">
        <div class="table">
            <table>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Akhir Pendaftaran</th>
                    <th></th>
                </tr>
                @foreach ($pembukaans as $pembukaan)
                    <tr>
                        <td>{{$pembukaan->judul}}</td>
                        <td>{{$pembukaan->pendaftaran}}</td>
                        <td>{{$pembukaan->akhirpendaftaran}}</td>
                        <td><a href="/mata-kuliah/{{$pembukaan->id}}">Detail</a></td>
                    </tr>
                @endforeach
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><a href="/open-pendaftaran/tambah">Buka Pendaftaran Asprak</a></td>
                </tr>
            </table>
        </div>
        {{-- <form action="{{route('prosespembukaan')}}" method="post"></form> --}}
    </div>
    <script>

    </script>
</body>
</html>
