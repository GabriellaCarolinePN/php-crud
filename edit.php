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

$title = 'Edit Barang';
include 'layout/header.php';

// Mengambil ID Barang dari URL
$id_barang = (int)$_GET['id_barang'];
$barang = select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];

// Cek Tombol Edit Dapat Ditekan
if (isset($_POST['edit'])) {
    if (edit_barang($_POST) > 0) {
        echo "<script>
        alert('Data Berhasil Diedit'); document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Diedit'); document.location.href = 'index.php';
        </script>";
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-edit"></i> Edit Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index">Data Barang</a></li>
                        <li class="breadcrumb-item active">Edit Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post">

                <input type="hidden" name="id_barang" value="<?php echo $barang['id_barang']; ?>">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $barang['nama']; ?>" placeholder="Nama Barang..." required>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Barang</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $barang['jumlah']; ?>" placeholder="Jumlah Barang..." required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Barang</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $barang['harga']; ?>" placeholder="Harga Barang..." required>
                </div>
                <button type="submit" name="edit" class="btn btn-primary" style="float: right;"><i class="fas fa-edit"></i> Edit</button>
                <a href="index.php" class="btn btn-danger"><i class="fas fa-times-circle"></i> Back</a>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>