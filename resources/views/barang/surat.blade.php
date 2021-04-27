<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Peminjaman Barang</title>
    <style>
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
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="row mx-auto">
            <img src="https://i.postimg.cc/RhC06K0S/template.png" alt="Template" class="template">
        </div>
        <div style="height:2px; background-color:black; margin-top:5px;"></div>
        <div class="row justify-content-center mx-auto" style="width: 100%">
            <p class="font-weight-bold mt-3" style="margin-left: 23%; font-weight: bold;">FORMULIR PEMINJAMAN ALAT LABORATORIUM</p>
        </div>
        <div style="height:2px; background-color:black; margin: 5px 25%;"></div>
        <div class="row mt-5" style="margin-left: 20%;">
            <p>Dengan ini menyatakan bahwa:</p>
        </div>
        <div class="row mt-3" style="margin-left: 22%; margin-right: 22%;">
            <div class="d-flex justify-content-between w-100" style="display: flex; justify-content: space-between; height: 12px;">
                <p>Nama</p>
                <p style="float:right;">{{$content['nama']}}</p>
            </div>
            <div class="d-flex justify-content-between w-100" style="display: flex; justify-content: space-between;  height: 12px;">
                <p>NIM/NRK</p>
                <p style="float:right">{{$content['nim']}}</p>
            </div>
            <div class="d-flex justify-content-between w-100" style="display: flex; justify-content: space-between;  height: 12px;">
                <p>No. HP</p>
                <p style="float:right">{{$content['no_hp']}}</p>
            </div>
            <div class="d-flex justify-content-between w-100" style="display: flex; justify-content: space-between;  height: 12px;">
                <p>Afiliasi</p>
                <p style="float:right">{{$content['prodi']}}</p>
            </div>
        </div>
        <div class="row" style="margin: 0 10%;">
            <p>Mengajukan permohonan peminjaman alat laboratorium dengan rincian terlampir.
                Peminjam bersedia memenuhi persyaratan yang ada di laboratorium dan jika terjadi kerusakan atau kehilangan barang yang dipinjam, maka peminjam bersedia untuk bertanggung jawab.
            </p>
        </div>
        <div class="row" style="margin-top: 10%; margin-right: 20%;">
            <div style="height: 12px">
                <p style="float:right">Lampung Selatan, 27-04-2021</p>
            </div>
            <div style="height: 12px">
                <p style="float:right">Peminjam,</p>
            </div>
        </div>
        <div class="row" style="margin-top: 8%; margin-right: 20%;">
            <div style="height: 12px">
                <p style="float:right">Muhammad Ikhbal</p>
            </div>
            <div style="height: 12px">
                <p style="float:right">118140123</p>
            </div>
        </div>
        <div class="row" style="margin: 10% 0 5% 0;">
            <img src="https://i.postimg.cc/9M1rmJBX/footer.png" alt="">
        </div>
    </div>
    <div class="wrapper">
        <div class="row mx-auto">
            <img src="https://i.postimg.cc/RhC06K0S/template.png" alt="Template" class="template">
        </div>
        <div style="height:2px; background-color:black; margin-top:5px;"></div>
        <div class="row justify-content-center mx-auto">
            <p class="font-weight-bold mt-3" style="font-weight: bold; margin-left: 38%;">RINCIAN KEGIATAN</p>
        </div>
        <div class="row mt-5" style="margin-left: 17%;">
            <p>Keperluan:</p>
        </div>
    </div>
    {{-- $content['nama'] --}}
</body>

</html>