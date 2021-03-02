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
        <form action="{{route('prosestambahpendaftaran')}}" method="POST">
            @csrf
            <label for="judul">Judul :</label>
            <input type="text" name="judul">
            @if ()

            @endif
            <label for="pendaftaran">Tanggal Mulai Pendaftaran :</label>
            <input type="date" name="pendaftaran">
            <label for="akhirpendaftaran">Tanggal Akhir Pendaftaran :</label>
            <input type="date" name="akhirpendaftaran">
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
