<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="main-container">
        <table>
            <tr>
                <th>Kode Mata Kuliah</th>
                <th>Mata Kuliah</th>
                <th>Dosen Pengampu</th>
                <th>Tanggal Seleksi</th>
                <th>Jam Seleksi</th>
            </tr>
            @foreach ($matakuliahs as $matakuliah)
                <tr>
                    <td>{{$matakuliah->kode}}</td>
                    <td>{{$matakuliah->nama}}</td>
                    <td>{{$matakuliah->dosen}}</td>
                    <td>{{$matakuliah->tanggalsekelsi}}</td>
                    <td>{{$matakuliah->jamseleksi}} s/d {{$matakuliah->akhirseleksi}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
