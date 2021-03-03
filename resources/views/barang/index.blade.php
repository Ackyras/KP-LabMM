<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorium Multimedia</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
</head>
<body background="{{ asset('img/background.jpg')}}" style="background-repeat: no-repeat; height: 100%; background-position: center center; background-size: cover; background-attachment: fixed;">
    <header>
        <a class="itera" href="#home"><img src="{{ asset('img/LabMM2.png')}}" alt="Laboratorium"></a>
        <div class="social">
            <a href="#youtube"><img src="{{ asset('img/youtube.png')}}" alt="" style="width: 35px;"></a>
            <a href="#facebook"><img src="{{ asset('img/facebook.png')}}" alt="" style="width: 29px;"></a>
            <a href="#email"><img src="{{ asset('img/email.png')}}" alt="" style="width: 33px;"></a>
            <a href="#twitter"><img src="{{ asset('img/twitter.png')}}" alt="" style="width: 35px;"></a>
            <a href="#instagram"><img src="{{ asset('img/instagram.png')}}" alt="" style="width: 30px;"></a>
        </div>
    </header>
        <div class="main">
        <div>
            <h1>
                Tata Cara
                Peminjaman
            </h1>
            <h2>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur quibusdam tempora necessitatibus voluptatibus ipsum sit dignissimos, aliquam vitae nam cupiditate officiis quaerat alias labore debitis architecto est aspernatur enim dolores.
            </h2>
            <a href="{{ route('list') }}"><button class="button">Get Started</button></a>
        </div>
    </div>
    </body>
</html>