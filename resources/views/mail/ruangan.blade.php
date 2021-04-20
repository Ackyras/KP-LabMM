<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <title>Verifikasi Peminjaman Ruangan</title>
</head>

<body style="box-sizing: border-box; font-family: 'Quicksand', sans-serif;">
    @if($content['validasi'] == 0)
    <p>Peminjaman Ruangan Anda di terima</p>
    <h4>Data</h4>
    <ul>
        <li>Nama : {{$content['nama']}}</li>
        <li>Nim / NIP : {{$content['nim']}}</li>
        <li>Afiliasi : {{$content['afiliasi']}}</li>
        <li>Lokasi : {{$content['lokasi']}}</li>
        <li>Ruang : {{$content['ruang']}}</li>
        <li>Mata Kuliah : {{$content['matkul']}}</li>
        <li>Hari : {{$content['hari']}}</li>
        <li>Waktu : {{$content['waktu']}}</li>
        <li>Keterangan : {{$content['keterangan']}}</li>
        <li>Minggu : </li>
        <ul>
            @foreach($content['minggu'] as $minggu)
            <li>{{ $minggu->minggu }}</li>
            @endforeach
        </ul>
    </ul>
    @else
    <p>Maaf, peminjaman Ruangan Anda di tolak karena {{$content['pesan']}}. Silahkan isi ulang form dengan waktu yang kosong. Terima kasih.</p>
    <h4>Data</h4>
    <ul>
        <li>Nama : {{$content['nama']}}</li>
        <li>Nim / NIP : {{$content['nim']}}</li>
        <li>Afiliasi : {{$content['afiliasi']}}</li>
        <li>Lokasi : {{$content['lokasi']}}</li>
        <li>Ruang : {{$content['ruang']}}</li>
        <li>Mata Kuliah : {{$content['matkul']}}</li>
        <li>Hari : {{$content['hari']}}</li>
        <li>Waktu : {{$content['waktu']}}</li>
        <li>Keterangan : {{$content['keterangan']}}</li>
        <li>Minggu : </li>
        <ul>
            @foreach($content['minggu'] as $minggu)
            <li>{{ $minggu->minggu }}</li>
            @endforeach
        </ul>
    </ul>
    @endif
</body>

</html>