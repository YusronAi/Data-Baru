<?php
session_start();
require "functions.php";

// Cek Cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // Ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");

    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}
if (isset ($_SESSION['login'])) {
    echo "<script>
        window.location.replace('index.php');
        </script>";
}

if (isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // Cek username
    if (mysqli_num_rows($result)  === 1) {
        
        // Cek password
        $row = mysqli_fetch_assoc($result);
       if ( password_verify($password, $row['password'])){
            // header("Location : index.php");
            $_SESSION['login'] = true;

            // Cek remember me

            if (isset($_POST['remember'])) {
                // Buat cookie

                setcookie('id',$row['id']);
                setcookie('key', hash('sha256', $row['username']));
            }
            
            echo "<script>
            window.location.replace('index.php');
                   </script>";
        }
    }

    $error = true;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if( isset($error)) : ?>
        <p style="color : red;"> Username / Password Salah </p>
    <?php endif; ?>
    
    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </li>
            <button type="submit" name="login">Login</button>
        </ul>
    </form>
</body>
</html>