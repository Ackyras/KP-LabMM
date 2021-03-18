<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('prosesregister')}}" method="post">
        <input type="text" name="nama" id="" placeholder="Nama">
        <input type="text" name="username" id="" placeholder="Username">
        <input type="email" name="email" id="" placeholder="Email">
        <input type="password" name="password" id="" placeholder="Password">
        <input type="radio" name="role" id="" placeholder="Admin" value="admin">
        <input type="radio" name="role" id="" placeholder="User" value="user">
    </form>
</body>
</html>
