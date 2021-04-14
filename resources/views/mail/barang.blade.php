<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <title>Pengembalian Barang Pinjaman</title>
</head>

<body style="box-sizing: border-box; font-family: 'Quicksand', sans-serif;">
    Mohon mengembalikan barang yang anda pinjam
    <h4>Data</h4>
    <ul>
        <li>Nama : {{$content['nama']}}</li>
        <li>Nim / NIP : {{$content['nim']}}</li>
        <li>Afiliasi : {{$content['afiliasi']}}</li>
        <li>Tanggal Peminjaman : {{$content['awal']}}</li>
        <li>Tanggal Pengembalian : {{$content['akhir']}}</li>
    </ul>
    <h4>Barang dipinjam</h4>
    <ol>
        @foreach($content['barang'] as $barang)
        <li>{{$barang->inventaris->nama_barang}} <small>({{$barang->jumlah}} unit)</small></li>
        @endforeach
    </ol>
</body>

</html>