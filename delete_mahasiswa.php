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

// Menerima ID Mahasiswa yang Dipilih dari Pengguna
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

// Cek Tombol Edit dapat Ditekan
if (delete_mahasiswa($id_mahasiswa) > 0) {
    echo "<script>
        alert('Data berhasil dihapus'); document.location.href = 'mahasiswa.php';
        </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus'); document.location.href = 'mahasiswa.php';
        </script>";
}
