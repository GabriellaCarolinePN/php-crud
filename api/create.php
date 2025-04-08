<?php

// Render Halaman Menjadi JSON
header('Content-Type: application/json');

require '../config/app.php';

// Menerima Input
$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];

// Validasi Data
if ($nama == null) {
    echo json_encode(['pesan' => 'Nama Barang Belum Diisi']);
    exit;
}

// Query Tambah Data
$query = "INSERT INTO barang VALUES (null, '$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";
mysqli_query($db, $query);

// Cek Status Data
if ($query) {
    echo json_encode(['pesan' => 'Data Barang Berhasil Ditambahkan']);
} else {
    echo json_encode(['pesan' => 'Data Barang Gagal Ditambahkan']);
}
