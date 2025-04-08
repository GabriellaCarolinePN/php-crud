<?php

// Render Halaman Menjadi JSON
header('Content-Type: application/json');

require '../config/app.php';

// Menerima Request Put
parse_str(file_get_contents('php://input'), $put);

// Menerima Input
$id_barang  = $put['id_barang'];
$nama       = $put['nama'];
$jumlah     = $put['jumlah'];
$harga      = $put['harga'];

// Validasi Data
if ($nama == null) {
    echo json_encode(['pesan' => 'Nama Barang Belum Diisi']);
    exit;
}

// Query Edit/Update Data
$query = "UPDATE barang SET nama = '$nama', jumlah = $jumlah, harga = '$harga' WHERE id_barang = $id_barang";
mysqli_query($db, $query);

// Cek Status Data
if ($query) {
    echo json_encode(['pesan' => 'Data Barang Berhasil Diedit']);
} else {
    echo json_encode(['pesan' => 'Data Barang Gagal Diedit']);
}
