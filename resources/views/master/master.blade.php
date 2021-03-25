<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('css/new-prism.css')}}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css')}}">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <title>@yield('title')</title>

    <style>
        .sidenav-collapse {
            display: none;
        }

        .show {
            display: block !important;
        }
    </style>

</head>

<body background="{{ asset('img/background.jpg')}}" style="overflow: hidden; background-repeat: no-repeat; height: 100%; background-position: center center; background-size: cover; background-attachment: fixed;">
    <header style="max-height: 10%;">
        <a class="itera" href="{{ route('home') }}"><img src="{{ asset('img/LabMM2.png')}}" alt="Laboratorium"></a>
        <div class="">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-light" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </header>


    <div class="row" style="justify-content:space-between; max-height: 90%;">
             <div class="navCon col-sm p-3 bg-light" style="border-radius: 10px; height:10%;">
            <ul class="sidenav-menu" style="font-size: clamp(1.8vh, 1rem, 1.5vw);">
                <a href="{{route('barang.list')}}">
                    <li class="sidenav-item p-3 border bg-light m-2 rounded-pill">
                        <i class="fas fa-archway pr-3 pl-4"></i>Peminjaman Ruangan
                    </li>
                </a>
                <a href="{{route('barang.list')}}">
                    <li class="sidenav-item p-3 border bg-light m-2 rounded-pill">
                        <i class="fas fa-stamp pr-3 pl-4"></i>Antrian Peminjaman
                    </li>
                </a>
                <li class="sidenav-item p-3 border bg-light m-2 rounded-pill">
                    <a href="#" onclick="dropdown()" class="dropdownbtn"><i class="fas fa-boxes pr-3 pl-4 arits"></i>Peminjaman Barang</a href="#">
                    <ul id="dropdownUl" class="sidenav-collapse">
                        <li class="sidenav-item">
                            <a href="#Elektronik">Elektronik</a>
                        </li>
                        <li class="sidenav-item">
                            <a href="#Non-elektronik">Non-elektronik</a>
                        </li>
                    </ul>
                </li>
                <a href="{{route('barang.list')}}">
                    <li class="sidenav-item p-3 border bg-light m-2 rounded-pill">
                        <i class="fas fa-broom pr-3 pl-4"></i>Sapu dulu
                    </li>
                </a>
            </ul>
            <footer class="d-flex">
                <p>Laboratorium Multimedia</p>
                <p>Institut Teknologi Sumatera</p>
            </footer>
        </div>
             <div class="col-sm-9 p-5 bg-light" style="border-bottom-left-radius: 10px; border-top-left-radius: 10px; height:85vh; overflow-y: auto;">
            @yield('content')
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/mdbsnippet.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/new-prism.js')}}"></script>

    <script>
        function dropdown() {
            document.getElementById('dropdownUl').classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropdownbtn')) {
                var dropdowns = document.getElementsByClassName("sidenav-collapse");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
    <script src="{{ asset('dashboard/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
</body>

</html>