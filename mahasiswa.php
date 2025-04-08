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
if ($_SESSION["role"] != 1 && $_SESSION["role"] != 3) {
    echo "<script>
            alert('Maaf, Anda Tidak Punya Hak Akses ke Halaman Ini');
            document.location.href = 'akun.php';
          </script>";
    exit;
}

$title = 'Daftar Mahasiswa';
include 'layout/header.php';

// Menampilkan Data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC")

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
                        <li class="breadcrumb-item active">Data Mahasiswa</li>
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
                            <h3 class="card-title">Tabel Data Mahasiswa</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="create_mahasiswa.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambah Mahasiswa</a>

                            <a href="download-excel-mhs.php" class="btn btn-success mb-1"><i class="fas fa-file-excel"></i> Download Excel</a>

                            <a href="download-pdf-mhs.php" class="btn btn-danger mb-1"><i class="fas fa-file-pdf"></i> Download PDF</a>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Program Studi</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $mahasiswa['nama']; ?></td>
                                            <td><?php echo $mahasiswa['prodi']; ?></td>
                                            <td><?php echo $mahasiswa['jenis_kelamin']; ?></td>
                                            <td><?php echo $mahasiswa['no_hp']; ?></td>
                                            <td class="text-center" width="20%">
                                                <a href="detail_mahasiswa.php?id_mahasiswa=<?php echo $mahasiswa['id_mahasiswa']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-info-circle"></i> Detail</a>
                                                <a href="edit_mahasiswa.php?id_mahasiswa=<?php echo $mahasiswa['id_mahasiswa']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                                <a href="delete_mahasiswa.php?id_mahasiswa=<?php echo $mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Data Mahasiswa Ini Akan Dihapus?')"><i class="fas fa-trash-alt"></i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
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