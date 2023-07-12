<?php
require "functions.php";

if (isset($_POST['daftar'])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('Registrasi berhasil!');
        </script>";
    }else {
        echo mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
</head>
<body>
    <h1>Registrasi</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username  :</label>
                <input type="text" name="username">
            </li>
            <li>
                <label for="password">Password  :</label>
                <input type="password" name="pass1">
            </li>
            <li>
                <label for="password2">Konfirmasi Password  :</label>
                <input type="password" name="pass2">
            </li>
            <button type="submit" name="daftar">Daftar</button>
        </ul>
    </form>
</body>
</html>