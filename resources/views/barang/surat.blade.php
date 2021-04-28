<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Peminjaman Barang</title>
    {{-- <style>
        body {
            overflow-x: hidden;
        }

        .template {
            width: 100%;
            height: 10%;
        }

        .wrapper {
            page-break-after: always;
        }

        .wrapper:last-child {
            page-break-after: avoid;
        }
    </style> --}}
</head>

<body>
    <div class="wrapper">
        <div>
            <img src="https://i.postimg.cc/RhC06K0S/template.png" alt="Template" style="width:700px;">
        </div>
        <div style="height:2px; background-color:black; margin-top:5px;"></div>
        <div style="width: 100%; margin-top:5px;">
            <p style="margin-left: 23%; font-weight: bold;">FORMULIR PEMINJAMAN ALAT LABORATORIUM</p>
        </div>
        <div style="height:2px; background-color:black; margin: 5px 25%;"></div>
        <div style="margin-left: 20%;">
            <p>Dengan ini menyatakan bahwa:</p>
        </div>
        <div style="margin-left: 22%; margin-right: 22%;">
            <div style="display: flex; justify-content: space-between; height: 12px;  margin-top:10px;">
                <p>Nama</p>
                <p style="float:right;">{{$content['nama']}}</p>
            </div>
            <div style="display: flex; justify-content: space-between;  height: 12px; margin-top:14px;">
                <p>NIM/NRK</p>
                <p style="float:right">{{$content['nim']}}</p>
            </div>
            <div style="display: flex; justify-content: space-between;  height: 12px;  margin-top:14px;">
                <p>No. HP</p>
                <p style="float:right">{{$content['no_hp']}}</p>
            </div>
            <div style="display: flex; justify-content: space-between;  height: 12px;  margin-top:14px;">
                <p>Afiliasi</p>
                <p style="float:right">{{$content['prodi']}}</p>
            </div>
        </div>
        <div style="margin: 5% 10%;">
            <p>Mengajukan permohonan peminjaman alat laboratorium dengan rincian terlampir.
                Peminjam bersedia memenuhi persyaratan yang ada di laboratorium dan jika terjadi kerusakan atau kehilangan barang yang dipinjam, maka peminjam bersedia untuk bertanggung jawab.
            </p>
        </div>
        <div style="margin-top: 10%; margin-right: 20%;">
            <div style="height: 12px">
                <p style="float:right">Lampung Selatan, 27-04-2021</p>
            </div>
        </div>
        <div style="margin-top: 2%; margin-right: 5%;">
            <div style="height: 12px">
                <p style="float:right">Peminjam,</p>
            </div>
        </div>
        <div style="margin-top: 8%; margin-right: 20%;">
            <div style="height: 12px">
                <p style="float:right">Muhammad Ikhbal</p>
            </div>
        </div>
        <div style="margin-top: 2%; margin-right: 5%;">
            <div style="height: 12px">
                <p style="float:right">118140123</p>
            </div>
        </div>
        <div style="margin: 15% 0 5% 0;">
            <img src="https://i.postimg.cc/9M1rmJBX/footer.png" alt="">
        </div>
    </div>
    <div class="wrapper">
        <div>
            <img src="https://i.postimg.cc/RhC06K0S/template.png" alt="Template" style="width:700px;">
        </div>
        <div style="height:2px; background-color:black; margin-top:5px;"></div>
        <div style="width: 100%; margin-top:5px;">
            <p style="margin-left: 45%; font-weight: bold;">RINCIAN KEGIATAN</p>
        </div>
        <div style="margin-left: 18%; margin-right: 35%;">
            <div style="display: flex; justify-content: center; height: 12px;  margin-top:10px;">
                <p>Awal Peminjaman</p>
                <p style="float:right;">{{$content['tanggal_peminjaman']}}</p>
            </div>
            <div style="display: flex; justify-content: center;  height: 12px; margin-top:14px;">
                <p>Akhir Peminjaman</p>
                <p style="float:right">{{$content['tanggal_pengembalian']}}</p>
            </div>
        </div>
        <div style="width: 100%; margin-top:10px;">
            <p style="margin-left: 40%; font-weight: bold;">DAFTAR ALAT YANG DIPINJAM</p>
        </div>
        <table style="margin: 0 auto; padding: 2%;">
            <tr>
                <th style="width: 10%;">No </th>
                <th style="width: 50%;">Nama Barang </th>
                <th style="width: 40%;">Jumlah </th>
            </tr>
            @foreach($content['barang'] as $key => $value)
            <tr>
                <td style="width: 10%;">{{$loop->iteration}}</td>
                <td style="width: 50%;">{{$value}}</td>
                <td style="width: 40%;">{{$content['jumlah'][$key]}}</td>
            </tr>
            @endforeach
        </table>
        <div style="margin-top: 10%; margin-right: 20%;">
            <div style="height: 12px">
                <p style="float:right">Lampung Selatan, 27-04-2021</p>
            </div>
        </div>
        <div style="margin-top: 2%; margin-right: 5%;">
            <div style="height: 12px">
                <p style="float:right">Mengetahui,</p>
            </div>
            <div style="height: 12px">
                <p style="float:right">Koordinator Laboratorium</p>
            </div>
        </div>
        <div style="margin-top: 8%; margin-right: 20%;">
            <div style="height: 12px">
                <p style="float:right">Muhammad Ikhbal</p>
            </div>
        </div>
    </div>
    {{-- $content['nama'] --}}
</body>

</html>