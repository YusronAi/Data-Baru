<?php
session_start();

if (!isset ($_SESSION['login'])) {
    echo "<script>
        window.location.replace('login.php');
        </script>";
}
require "functions.php";

// Pagination
// Konfigurasi

$jumlahDataPerHalaman = 2;
$jumlahData = count(tampil("SELECT * FROM tas"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;


$rows = tampil("SELECT * FROM tas LIMIT $awalData, $jumlahDataPerHalaman");

// Tombol cari ditekan

if (isset($_POST['cari'])) {
    $rows = cari($_POST['keyword']);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Daftar Barang dalam Tas</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <h1>Daftar Barang dalam Tas</h1>
    <a href="tambah.php">Tambah Daftar Barang dalam Tas</a><br><br>

    <form action="" method="POST">
        <input type="text" name="keyword" id="" autofocus autocomplete="off"
        placeholder="Masukkan keyword..." size="38">
        <button type="submit" name="cari">Cari</button><br><br>
    </form><br>

    <!-- nafigasi -->

    <?php if ( $halamanAktif > 1 ) : ?>
        <a href='?halaman=<?= $halamanAktif - 1; ?>'>&laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if( $i == $halamanAktif ) : ?>
            <a href="?halaman=<?= $i ?>" style="font-weight: 500; color: red;"><?= $i ?></a>
        <?php else: ?>
            <a href="?halaman=<?= $i ?>" ><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ( $halamanAktif < $jumlahHalaman) : ?>
        <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
    <?php endif; ?>

    <form action="" method="post">
        <table cellspacing="10" cellpaddding="10" border="10">
            <tr>
                <th>ID</th>
                <th>Aksi</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Warna</th>
                <th>Gambar</th>
            </tr>
    <?php $i = 1 ?>
    <?php foreach($rows as $row) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><a href="edit.php?id=<?= $row['id']; ?>">Edit |</a>
                <a href="hapus.php?id=<?= $row['id'] ?>">Hapus</a></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td><?= $row['warna'] ?></td>
                <td><?= $row['gambar'] ?></td>
            </tr>
    <?php $i++ ?>
    <?php endforeach; ?>
        </table>
    </form>
</body>
</html>