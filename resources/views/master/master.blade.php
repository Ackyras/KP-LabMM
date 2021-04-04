<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Quicksand" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <title>@yield('title')</title>

</head>

<body background="{{ asset('img/background.jpg')}}" style="overflow: hidden; background-repeat: no-repeat; height: 100%; background-position: center center; background-size: cover; background-attachment: fixed;">
    <header style="max-height: 10%;">
        <a class="itera" href="{{ route('home') }}"><img src="{{ asset('img/LabMM2.png')}}" alt="Laboratorium"></a>
    </header>


    <div class="row mx-2" style="max-height: 90%;">
        <div class="col-sm p-3 bg-light rounded" style="height:10%; border-radius: 12px;">
            <ul class="sidenav-menu" style="font-size: clamp(1.8vh, 1rem, 1.5vw);">
                <a href="{{route('barang.list')}}">
                    <li class="sidenav-item p-3 border bg-light m-2 rounded-pill">
                        <i class="fas fa-archway px-3"></i>Daftar Barang
                    </li>
                </a>
                <a href="{{route('barang.form')}}">
                    <li class="sidenav-item p-3 border bg-light m-2 rounded-pill">
                        <i class="fas fa-stamp px-3"></i>Form Pinjam Barang
                    </li>
                </a>
                <a href="#">
                    <li class="sidenav-item p-3 border bg-light m-2 rounded-pill">
                        <i class="fas fa-boxes px-3"></i>Form Pinjam Ruangan
                    </li>
                </a>
            </ul>
            <footer class="text-wrap mx-auto">
                <p class="text-white font-footer text-center ml-4">Copyright&copyLaboratorium Multimedia</p>
                <p class="text-white font-footer text-center ml-4">Institut Teknologi Sumatera</p>
            </footer>
        </div>
        <div class="col-sm-9 p-4 bg-light mx-2 content">
            @yield('content')
        </div>
    </div>
    <!-- <script type="text/javascript" src="{{asset('js/mdbsnippet.min.js')}}"></script> -->
    <!-- <script type="text/javascript" src="{{asset('js/new-prism.js')}}"></script> -->
    <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
    @yield('js')
</body>

</html>