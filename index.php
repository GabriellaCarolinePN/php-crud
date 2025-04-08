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

// Membatasi Halaman Sesusai Role User yang Login
if ($_SESSION["role"] != 1 && $_SESSION["role"] != 2) {
    echo "<script>
          alert('Maaf, Anda Tidak Punya Hak Akses ke Halaman Ini');
          document.location.href = 'mahasiswa.php';
        </script>";
    exit;
}

$title = 'Daftar Barang';
include 'layout/header.php';

// Menghitung Jumlah Data
$jumlah_barang = select("SELECT COUNT(*) AS total FROM barang")[0]['total'];
$jumlah_mahasiswa = select("SELECT COUNT(*) AS total FROM mahasiswa")[0]['total'];
$jumlah_akun = select("SELECT COUNT(*) AS total FROM akun")[0]['total'];


// Menampilkan Data Barang
$data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $jumlah_barang; ?></h3>

                            <p>Data Barang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $jumlah_mahasiswa; ?></h3>

                            <p>Data Mahasiswa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="mahasiswa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $jumlah_akun; ?></h3>

                            <p>Data Akun</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="akun" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Main content -->
            <section class="content">
                <class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Tabel Data Barang</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <a href="create" class="btn btn-primary btn-sm mb-2"> <i class="fas fa-plus"></i> Tambah</a>
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Barcode</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;  ?>
                                            <?php foreach ($data_barang as $barang) :  ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $barang['nama']; ?></td>
                                                    <td><?php echo $barang['jumlah']; ?></td>
                                                    <td>Rp. <?php echo number_format($barang['harga'], 2, ',', '.'); ?></td>
                                                    <td class="text-center">
                                                        <img src="barcode.php?codetype=Code128&size=15&text=<?php echo $barang['barcode']; ?>&print=true" alt="barcode">
                                                    </td>
                                                    <td><?php echo date('d-m-Y | H:i:s', strtotime($barang['tanggal'])); ?></td>
                                                    <td width="15%" class="text-center">
                                                        <a href="edit.php?id_barang= <?php echo $barang['id_barang']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                                        <a href="delete.php?id_barang= <?php echo $barang['id_barang']; ?>" class="btn btn-danger" onclick="return confirm('Yakin Barang Ini Akan Dihapus?')"><i class="fas fa-trash-alt"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>