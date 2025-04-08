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

$title = 'Daftar Akun';
include 'layout/header.php';

// Tampil Seluruh Data
$data_akun = select("SELECT * FROM akun");

//Tampil Data Berdasarkan User Login
$id_akun = $_SESSION['id_akun'];
$data_byLogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");

// Cek Tombol Tambah dapat Ditekan
if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
        alert('Akun berhasil ditambahkan'); document.location.href = 'akun.php';
        </script>";
    } else {
        echo "<script>
        alert('Akun gagal ditambahkan'); document.location.href = 'akun.php';
        </script>";
    }
}

// Cek Tombol Edit dapat Ditekan
if (isset($_POST['edit'])) {
    if (edit_akun($_POST) > 0) {
        echo "<script>
        alert('Akun berhasil diedit'); document.location.href = 'akun.php';
        </script>";
    } else {
        echo "<script>
        alert('Akun gagal diedit'); document.location.href = 'akun.php';
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
                    <h1 class="m-0">Data Akun</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Akun</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Akun</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if ($_SESSION['role'] == 1) : ?>
                                <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah Akun</button>
                            <?php endif; ?>

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>

                                    <!-- Menampilkan Seluruh Data untuk Role 1/Admin -->
                                    <?php if ($_SESSION['role'] == 1) : ?>
                                        <?php foreach ($data_akun as $akun) : ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $akun['nama']; ?></td>
                                                <td><?php echo $akun['username']; ?></td>
                                                <td><?php echo $akun['email']; ?></td>
                                                <td>Password Ter-enkripsi</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#modalUbah<?php echo $akun['id_akun']; ?>"><i class="fas fa-edit"></i> Edit</button>
                                                    <button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#modalHapus<?php echo $akun['id_akun']; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <!-- Menampilkan Data Berdasarkan User yang Login -->
                                    <?php else : ?>
                                        <?php foreach ($data_byLogin as $akun) : ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $akun['nama']; ?></td>
                                                <td><?php echo $akun['username']; ?></td>
                                                <td><?php echo $akun['email']; ?></td>
                                                <td>Password Ter-enkripsi</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#modalUbah<?php echo $akun['id_akun']; ?>"><i class="fas fa-edit"></i> Edit</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required minlength="6">
                    </div>

                    <div class="mb-3">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="1">Admin</option>
                            <option value="2">Operator</option>
                            <option value="3">Mahasiswa</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Kembali</button>
                <button type="submit" name="tambah" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Akun</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php foreach ($data_akun as $akun): ?>
    <div class="modal fade" id="modalUbah<?php echo $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_akun" value="<?php echo $akun['id_akun']; ?>">

                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $akun['nama']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?php echo $akun['username']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $akun['email']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password">Password <br><small>(masukkan password baru/lama)</small> </label>
                            <input type="password" name="password" id="password" class="form-control" required minlength="6">
                        </div>

                        <?php if ($_SESSION['role'] == 1) : ?>
                            <div class="mb-3">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <?php $level = $akun['role']; ?>
                                    <option value="1" <?php echo $level == '1' ? 'selected' : null;  ?>>Admin</option>
                                    <option value="2" <?php echo $level == '2' ? 'selected' : null;  ?>>Operator</option>
                                    <option value="3" <?php echo $level == '3' ? 'selected' : null;  ?>>Mahasiswa</option>
                                </select>
                            </div>
                        <?php else : ?>
                            <input type="hidden" name="role" value="<?php echo $akun['role']; ?>">
                        <?php endif; ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                    <button type="submit" name="edit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php foreach ($data_akun as $akun): ?>
    <div class="modal fade" id="modalHapus<?php echo $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Akun <?php echo $akun['nama']; ?> akan dihapus. Anda yakin? </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                    <a href="delete_akun.php?id_akun=<?php echo $akun['id_akun']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus Akun</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php include 'layout/footer.php'; ?>