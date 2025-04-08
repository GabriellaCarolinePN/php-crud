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

include 'config/app.php';

// Menerima ID Akun yang Dipilih dari Pengguna
$data_akun = (int)$_GET['id_akun'];

// Cek Tombol Edit dapat Ditekan
if (delete_akun($data_akun) > 0) {
    echo "<script>
        alert('Data berhasil dihapus'); document.location.href = 'akun.php';
        </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus'); document.location.href = 'akun.php';
        </script>";
}
