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

// Menerima ID Barang yang Dipilih dari Pengguna
$id_barang = (int)$_GET['id_barang'];

// Cek Tombol Edit dapat Ditekan
if (delete_barang($id_barang) > 0) {
    echo "<script>
        alert('Data berhasil dihapus'); document.location.href = 'index.php';
        </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus'); document.location.href = 'index.php';
        </script>";
}
