<?php
require "functions.php";

$rows = tampil("SELECT * FROM tas");

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
    <h1>Daftar Barang dalam Tas</h1>
    <a href="tambah.php">Tambah Daftar Barang dalam Tas</a><br><br>

    <form action="" method="POST">
        <input type="text" name="keyword" id="" autofocus autocomplete="off"
        placeholder="Masukkan keyword..." size="38">
        <button type="submit" name="cari">Cari</button><br><br>
    </form>

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