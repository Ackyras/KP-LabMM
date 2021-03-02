<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="main-container">
        <form action="{{route('prosespendaftaran')}}" method="post">
            <label for="nama">Nama :</label>
            <input type="text" name="nama" id="nama" placeholder="Nama">
            <label for="nim">NIM :</label>
            <input type="text" name="nim" id="nim" placeholder="NIM">
            <label for="email">E-Mail :</label>
            <input type="email" name="email" id="email" placeholder="Example@student.itera.ac.id">
            <label for="tanggallahir">Tanggal Lahir :</label>
            <input type="date" name="tanggallahir" id="tanggallahir">
            <label for="prodi">Program Studi :</label>
            <input type="text" name="prodi" id="prodi" placeholder="Teknik Example(ketik lengkap)">
            <label for="angkatan">Angkatan :</label>
            <input type="number" name="angkatan" id="angkatan">
            <label for="CV">CV :</label>
            <input type="file" name="CV" id="CV">
            <label for="KHS">KHS :</label>
            <input type="file" name="KHS" id="KHS">
            <label for="KTM">KTM :</label>
            <input type="file" name="KTM" id="KTM">
            <label for="pil1">Pilihan 1 :</label>

        </form>
    </div>
</body>
</html>
