<?php

// Render Halaman Menjadi JSON
header('Content-Type: application/json');

require '../config/app.php';

// Menerima Request Put/Delete
parse_str(file_get_contents('php://input'), $delete);

// Menerima Input ID Data yang Akan Dihapus
$id_barang = $delete['id_barang'];

// Query Hapus Data
$query = "DELETE FROM barang WHERE id_barang = $id_barang";
mysqli_query($db, $query);

// Cek Status Data
if ($query) {
    echo json_encode(['pesan' => 'Data Barang Berhasil Dihapus']);
} else {
    echo json_encode(['pesan' => 'Data Barang Gagal Dihapus']);
}
