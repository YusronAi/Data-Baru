<?php
session_start();

if (!isset ($_SESSION['login'])) {
    echo "<script>
        window.location.replace('login.php');
        </script>";
}
require "functions.php";

if (isset($_POST['submit'])) {

    if (tambah($_POST) > 0) {
        echo "
        <script>
            alert('Data Berhasil Ditambahkan!');
            document.location.href = 'index.php';
        </script>
        ";
    }else {
        echo "
        <script>
            alert('Data Gagal Ditambahkan!');
            document.location.href = 'tambah.php';
        </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Daftar Barang dalam Tas</title>
</head>
<body>
    <h1>Tambah Daftar Barang dalam Tas</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ol>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="" required>
            </li>
            <li>
                <label for="jumlah">Jumlah :</label>
                <input type="text" name="jumlah" id="">
            </li>
            <li>
                <label for="warna">Warna :</label>
                <input type="text" name="warna" id="">
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="file" name="gambar" id="">
            </li>
        </ol>
        <button type="submit" name="submit">Tambah Barang</button>
    </form>
</body>
</html>