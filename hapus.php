<?php
session_start();

if (!isset ($_SESSION['login'])) {
    echo "<script>
        window.location.replace('login.php');
        </script>";
}
require "functions.php";
$id = $_GET['id'];

if (hapus($id) > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'index.php';
        </script>";
}else{
    echo "Data gagal ditambakan";
}


?>