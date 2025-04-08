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

$title = 'Detail Mahasiswa';
include 'layout/header.php';

// Mengambil ID Mahasiswa dari URL
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

// Menampilkan Data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Mahasiswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="mahasiswa">Data Mahasiswa</a></li>
                    <li class="breadcrumb-item active">Detail Mahasiswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Mahasiswa</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h1><?php echo $data_mahasiswa['nama']; ?></h1>
                            <hr>

                            <table id="example2" class="table table-bordered table-striped mt-3">
                                <tr>
                                    <td width="15%">Nama</td>
                                    <td width="2%" class="text-center">:</td>
                                    <td><?php echo $data_mahasiswa['nama']; ?></td>
                                </tr>
                                <tr>
                                    <td width="">Program Studi</td>
                                    <td width="2%" class="text-center">:</td>
                                    <td><?php echo $data_mahasiswa['prodi']; ?></td>
                                </tr>
                                <tr>
                                    <td width="">Jenis Kelamin</td>
                                    <td width="2%" class="text-center">:</td>
                                    <td><?php echo $data_mahasiswa['jenis_kelamin']; ?></td>
                                </tr>
                                <tr>
                                    <td width="">No Handphone</td>
                                    <td width="2%" class="text-center">:</td>
                                    <td><?php echo $data_mahasiswa['no_hp']; ?></td>
                                </tr>
                                <tr>
                                    <td width="">Alamat Rumah/Kos</td>
                                    <td width="2%" class="text-center">:</td>
                                    <td><?php echo $data_mahasiswa['alamat']; ?></td>
                                </tr>
                                <tr>
                                    <td width="">Email</td>
                                    <td width="2%" class="text-center">:</td>
                                    <td><?php echo $data_mahasiswa['email']; ?></td>
                                </tr>
                                <tr>
                                    <td width="">Foto</td>
                                    <td width="2%" class="text-center">:</td>
                                    <td>
                                        <a href="assets/img/<?php echo $data_mahasiswa['foto']; ?>">
                                            <img src="assets/img/<?php echo $data_mahasiswa['foto']; ?>" alt="foto" width="15%">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <a href="mahasiswa.php" class="btn btn-danger btn-sm" style="float: right;"><i class="fas fa-times-circle"></i> Back</a>
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