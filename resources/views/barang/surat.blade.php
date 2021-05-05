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
            <div style="display: flex; height: 12px;  margin-top:10px;">
                <p>Nama</p>
                <p style="margin-left: 30%;">: {{$content['nama']}}</p>
            </div>
            <div style="display: flex;  height: 12px; margin-top:14px;">
                <p>NIM/NRK</p>
                <p style="margin-left: 30%;">: {{$content['nim']}}</p>
            </div>
            <div style="display: flex;  height: 12px;  margin-top:14px;">
                <p>No. HP</p>
                <p style="margin-left: 30%;">: {{$content['no_hp']}}</p>
            </div>
            <div style="display: flex;  height: 12px;  margin-top:14px;">
                <p>Afiliasi</p>
                <p style="margin-left: 30%;">: {{$content['prodi']}}</p>
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
                <p style="float:right; margin-right: 4%;">Peminjam,</p>
            </div>
        </div>
        <div style="margin-top: 8%; margin-right: 20%;">
            <div style="height: 12px">
                <p style="float:right">{{$content['nama']}}</p>
            </div>
        </div>
        <div style="margin-top: 2%; margin-right: 5%;">
            <div style="height: 12px">
                <p style="float:right">{{$content['nim']}}</p>
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
            <p style="margin-left: 40%; font-weight: bold;">RINCIAN KEGIATAN</p>
        </div>
        <div style="margin-left: 18%; margin-right: 25%;">
            <div style="display: flex; justify-content: center; height: 12px;  margin-top:10px;">
                <p>Keperluan</p>
                <p style="margin-left: 40%;">: {{$content['keperluan']}}</p>
            </div>
            <div style="display: flex; justify-content: center;  height: 12px; margin-top:14px;">
                <p>Tempat Kegiatan</p>
                <p style="margin-left: 40%;">: {{$content['tempat']}}</p>
            </div>
            <div style="display: flex; justify-content: center;  height: 12px; margin-top:14px;">
                <p>Akhir Peminjaman</p>
                <p style="margin-left: 40%;">: {{$content['tanggal_pengembalian']}}</p>
            </div>
            <div style="display: flex; justify-content: center;  height: 12px; margin-top:14px;">
                <p>Akhir Peminjaman</p>
                <p style="margin-left: 40%;">: {{$content['tanggal_pengembalian']}}</p>
            </div>
        </div>
        <div style="width: 100%; margin-top:10px;">
            <p style="margin-left: 40%; font-weight: bold;">DAFTAR ALAT YANG DIPINJAM</p>
        </div>
        <table style="margin: 0 auto; padding: 2%;" border="1">
            <tr>
                <th style="background-color: #c9c9c9; color:black; padding: 10px 5px;">No</th>
                <th style="background-color: #c9c9c9; color:black; padding: 10px 40px;">Nama Barang</th>
                <th style="background-color: #c9c9c9; color:black;  padding: 10px 5px;">Jumlah</th>
                <th style="background-color: #c9c9c9; color:black;  padding: 10px;">Paraf Laboran</th>
            </tr>
            @foreach($content['barang'] as $key => $value)
            <tr>
                <td style="padding: 5px; text-align:center;">{{$loop->iteration}}.</td>
                <td style="padding: 5px;"> {{$value}}</td>
                <td style="padding: 5px; text-align:center;">{{$content['jumlah'][$key]}}</td>
                <td style="padding: 5px;"></td>
            </tr>
            @endforeach
        </table>
        <div style="margin-top: 10%; margin-right: 20%;">
            <div style="height: 12px">
                <p style="float:right">Lampung Selatan, 27-04-2021</p>
            </div>
        </div>
        <div style="margin-top: 2%; margin-right: 7%;">
            <div style="height: 12px">
                <p style="float:left; margin-left: 8%;">Menyetujui,</p>
                <p style="float:right">Mengetahui,</p>
            </div>
        </div>
        <div style="margin-top: 1%; margin-right: 12%;">
            <div style="height: 12px">
                <p style="float:left; margin-left: -12%;">Laboran</p>
                <p style="float:right">Koordinator Laboratorium</p>
            </div>
        </div>
        <div style="margin-top: 12%; margin-right: 23%;">
            <div style="height: 12px">
                <p style="float:left; margin-left: 7%;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>
                <p style="float:right">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>
            </div>
        </div>
        <div style="margin: 7% 0 5% 0;">
            <img src="https://i.postimg.cc/9M1rmJBX/footer.png" alt="">
        </div>
    </div>
    {{-- $content['nama'] --}}
</body>

</html>