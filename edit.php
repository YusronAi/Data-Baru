<?php
session_start();

if (!isset ($_SESSION['login'])) {
    echo "<script>
        window.location.replace('login.php');
        </script>";
}
require "functions.php";
$id = $_GET['id'];


$mhs = tampil("SELECT * FROM tas where id=$id")[0];

if (isset($_POST['submit'])) {
    if (edit($_POST, $id) > 0) {
        echo "
        <script>
            alert('Data Berhasil Diedit!');
            document.location.href = 'index.php';
        </script>
        ";
    }else {
        echo "
        <script>
            alert('Data Gagal Ditambahkan!');
            document.location.href = 'edit.php';
        </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Daftar Barang dalam Tas</title>
</head>
<body>
    <h1>Edit Daftar Barang dalam Tas</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="gambarLama" value="<?= $mhs['gambar']; ?>">
        <ol>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="" required value="<?= $mhs['nama']; ?>">
            </li>
            <li>
                <label for="jumlah">Jumlah :</label>
                <input type="text" name="jumlah" id="" value="<?= $mhs['jumlah']; ?>">
            </li>
            <li>
                <label for="warna">Warna :</label>
                <input type="text" name="warna" id="" value="<?= $mhs['warna']; ?>">
            </li>
            <li>
                <label for="gambar">Gambar :</label><br>
                <img src="img/<?= $mhs['gambar']; ?>" alt="" width="40"><br>
                <input type="file" name="gambar">
            </li>
        </ol>
        <button type="submit" name="submit">Edit Barang</button>
    </form>
</body>
</html>