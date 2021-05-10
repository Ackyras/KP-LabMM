<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorium Multimedia</title>
    <script src="https://kit.fontawesome.com/d808726940.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
    <div class="tes d-flex justify-content-center flex-column">
        <nav class="d-flex align-items-center mt-3">
            <a class="itera" href="{{ route('home') }}" style="flex: 1"><img src="{{ asset('img/LabMM2.png')}}" alt="Laboratorium"></a>
            <div class="mr-5" >
                <a href="#"><i class="fab fa-facebook-square fa-3x"></i></a>
            </div>
        </nav>
        <div class="d-flex my-auto " style="height:600px">
            <div class="col-2 card card-body card-landing  text-left">
                <div class="text-center d-flex justify-content-center align-items-center flex-column mb-4">
                    <span class="card-title">Alur Peminjaman Ruangan</span>
                    <div class="bar"></div>
                </div>
                <ul>
                    <li class="mb-3">
                        <div class="circle isi"></div>
                        <i class="fas fa-file-alt"></i>
                        <span class="list-text">Isi formulir</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle print"></div>
                        <i class="fas fa-print"></i>
                        <span class="list-text">Cetak formulir</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle sign"></div>
                        <i class="fas fa-file-signature"></i>
                        <span class="list-text">Meminta TTD formulir ke UPT Lab</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle door"></div>
                        <i class="fas fa-door-open"></i>
                        <span class="list-text">Temui laboran untuk meminjam ruangan </span>
                    </li>
                    <li class="mb-3">
                        <div class="circle cek"></div>
                        <i class="fas fa-clipboard-check"></i>
                        <span class="list-text">Konfirmasi ke laboran setelah ruangan selesai dipinjam</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle ceklis"></div>
                        <i class="fas fa-check-circle"></i>
                        <span class="list-text">Selesai</span>
                    </li>
                </ul>
            </div>
            <div class="col-2 card card-body card-landing  text-left">
                <div class="text-center d-flex justify-content-center align-items-center flex-column mb-4">
                    <span class="card-title">Alur Peminjaman Barang</span>
                    <div class="bar"></div>
                </div>
                <ul>
                    <li class="mb-3">
                        <div class="circle isi"></div>
                        <i class="fas fa-file-alt"></i>
                        <span class="list-text">Isi formulir</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle print"></div>
                        <i class="fas fa-print"></i>
                        <span class="list-text">Cetak formulir</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle sign"></div>
                        <i class="fas fa-file-signature"></i>
                        <span class="list-text">Meminta TTD formulir ke UPT Lab</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle box"></div>
                        <i class="fas fa-box-open"></i>
                        <span class="list-text">Temui laboran untuk mengambil barang di Laboratorium</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle cek"></div>
                        <i class="fas fa-people-carry"></i>
                        <span class="list-text">Kembalikan barang sebelum atau saat waktu pengembalian</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle ceklis"></div>
                        <i class="fas fa-check-circle"></i>
                        <span class="list-text">Selesai</span>
                    </li>
                </ul>
            </div>
            <div class="col-2 card card-body card-landing  text-left">
                <div class="text-center d-flex justify-content-center align-items-center flex-column mb-4">
                    <span class="card-title">Alur Pendaftaran Asisten Praktikum</span>
                    <div class="bar"></div>
                </div>
                <ul>
                    <li class="mb-3">
                        <div class="circle isi"></div>
                        <i class="fas fa-file-alt"></i>
                        <span class="list-text">Isi formulir</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle print"></div>
                        <i class="fas fa-clock"></i>
                        <span class="list-text">Tunggu pengumuman kelulusan verifikasi berkas</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle sign"></div>
                        <i class="fas fa-pen-alt"></i>
                        <span class="list-text">Uji seleksi asisten praktikum</span>
                    </li>
                    <li class="mb-3">
                        <div class="circle box"></div>
                        <i class="fas fa-bullhorn"></i>
                        <span class="list-text">Pengumuman hasil seleksi</span>
                    </li>
                </ul>
            </div>
            <div class="landing-text">
                <span class="big-text mb-5">
                    Website Laboratorium Multimedia
                </span>
                <br><br><br>
                <div class="small-text mt-5">
                    Mahasiswa dapat meminjam barang, ruangan, dan mendapatkan informasi mengenai asisten praktikum
                </div>
                <br><br><br>
                <button class="btn">Mulai</button>
            </div>
        </div>

    </div>
</body>

</html>