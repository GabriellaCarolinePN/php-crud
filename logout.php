<?php

session_start();

// Membatasi Halaman Sebelum Login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Silahkan Login Terlebih Dahulu');
            document.location.href = 'login.php';
          </script>";
    exit;
}

// Kosongkan $_SESSION dari User yang Login
$_SESSION = [];

session_unset();
session_destroy();
header("Location: login.php");