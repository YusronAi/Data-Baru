<?php
session_start();

session_unset();
$_SESSION = [];
session_destroy();

echo "<script>
    window.location.replace('login.php');
        </script>";

?>