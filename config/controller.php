<?php

// Fungsi untuk Menampilkan Data Barang
function select($query)
{
  // Panggil Koneksi Database
  global $db;
  $result     = mysqli_query($db, $query);
  $rows       = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[]   = $row;
  }
  return $rows;
}

// Fungsi untuk Menambahkan Data Barang
function create_barang($post)
{
  global $db;

  $nama     = strip_tags($post['nama']);
  $jumlah   = strip_tags($post['jumlah']);
  $harga    = strip_tags($post['harga']);
  $barcode  = rand(100000, 999999);

  // Query Tambah Data
  $query = "INSERT INTO barang VALUES(null, '$nama', '$jumlah', '$harga', '$barcode', CURRENT_TIMESTAMP())";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Fungsi untuk Mengedit Data Barang
function edit_barang($post)
{
  global $db;

  $id_barang  = $post['id_barang'];
  $nama       = strip_tags($post['nama']);
  $jumlah     = strip_tags($post['jumlah']);
  $harga      = strip_tags($post['harga']);

  // Query Edit Data
  $query = "UPDATE barang SET nama = '$nama', jumlah = $jumlah, harga = '$harga' WHERE id_barang = $id_barang";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Fungsi untuk Menghapus Data Barang
function delete_barang($id_barang)
{
  global $db;

  // Query Hapus Data
  $query = "DELETE FROM barang WHERE id_barang = $id_barang";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Fungsi untuk Menambahkan Data Mahasiswa
function create_mahasiswa($post)
{
  global $db;

  $nama           = strip_tags($post['nama']);
  $prodi          = strip_tags($post['prodi']);
  $jenis_kelamin  = strip_tags($post['jenis_kelamin']);
  $no_hp          = strip_tags($post['no_hp']);
  $email          = strip_tags($post['email']);
  $alamat         = $post['alamat'];
  $foto           = upload_file();

  // Check Upload Foto
  if (!$foto) {
    return false;
  }

  // Query Tambah Data
  $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$prodi', '$jenis_kelamin', '$no_hp', '$alamat', '$email', '$foto')";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Fungsi untuk Mengedit Data Mahasiswa
function edit_mahasiswa($post)
{
  global $db;

  $id_mahasiswa   = strip_tags($post['id_mahasiswa']);
  $nama           = strip_tags($post['nama']);
  $prodi          = strip_tags($post['prodi']);
  $jenis_kelamin  = strip_tags($post['jenis_kelamin']);
  $no_hp          = strip_tags($post['no_hp']);
  $alamat         = $post['alamat'];
  $email          = strip_tags($post['email']);
  $fotoLama       = strip_tags($post['fotolama']);

  // Check Upload Foto Baru atau Tidak
  if ($_FILES['foto']['error'] == 4) {
    $foto = $fotoLama;
  } else {
    $foto = upload_file();
  }

  // Query Edit Data
  $query = "UPDATE mahasiswa SET nama = '$nama', prodi = '$prodi', jenis_kelamin = '$jenis_kelamin', no_hp = '$no_hp', alamat = '$alamat', email = '$email', foto = '$foto' WHERE id_mahasiswa = $id_mahasiswa";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Fungsi untuk Upload File
function upload_file()
{

  $nama_file = $_FILES['foto']['name'];
  $ukuran_file = $_FILES['foto']['size'];
  $error = $_FILES['foto']['error'];
  $tmp_name = $_FILES['foto']['tmp_name'];

  // Cek Ekstensi File yang Diupload
  $ekstensi_valid = ['jpg', 'jpeg', 'png'];
  $ekstensi_file  = explode('.', $nama_file);
  $ekstensi_file  = strtolower(end($ekstensi_file));

  // Pesan Error Jika Format File Tidak Valid
  if (!in_array($ekstensi_file, $ekstensi_valid)) {
    echo "<script>  alert('Format File Tidak Valid'); document.location.href = 'create_mahasiswa.php';
    </script>";
    die();
  }

  // Cek Ukuran File 2 mb. Jika Melebihi Maka Muncul Pesan Error
  if ($ukuran_file > 2048000) {
    echo "<script>  alert('Ukuran File Terlalu Besar. Maksimal 2 mb'); 
    </script>";
    die();
  }

  // Generate Nama File Baru
  $nama_file_baru  = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_file;

  // Memindahkan File ke Dalam Folder Local
  move_uploaded_file($tmp_name, 'assets/img/' . $nama_file_baru);
  return $nama_file_baru;
}

// Fungsi untuk Menghapus Data Mahasiswa
function delete_mahasiswa($id_mahasiswa)
{
  global $db;

  // Ambil Foto Sesuai Data yang Dipilih
  $foto = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
  unlink("assets/img/" . $foto['foto']);

  // Query Hapus Data
  $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Fungsi untuk Menambahkan Data Akun
function create_akun($post)
{
  global $db;

  $nama       = strip_tags($post['nama']);
  $username   = strip_tags($post['username']);
  $email      = strip_tags($post['email']);
  $password   = strip_tags($post['password']);
  $role       = strip_tags($post['role']);

  // Enkripsi Password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Query Tambah Data
  $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$role')";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Fungsi untuk Mengedit Data Akun
function edit_akun($post)
{
  global $db;

  $id_akun    = strip_tags($post['id_akun']);
  $nama       = strip_tags($post['nama']);
  $username   = strip_tags($post['username']);
  $email      = strip_tags($post['email']);
  $password   = strip_tags($post['password']);
  $role       = strip_tags($post['role']);

  // Enkripsi Password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Query Tambah Data
  $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', role = '$role' WHERE id_akun = $id_akun";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}

// Fungsi untuk Menghapus Data Akun
function delete_akun($data_akun)
{
  global $db;

  // Query Hapus Data
  $query = "DELETE FROM akun WHERE id_akun = $data_akun";

  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
}
