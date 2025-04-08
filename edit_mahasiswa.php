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

$title = 'Edit Mahasiswa';
include 'layout/header.php';
// Cek Tombol Edit dapat Ditekan
if (isset($_POST['Edit'])) {
    if (edit_mahasiswa($_POST) > 0) {
        echo "<script>
        alert('Data berhasil diedit'); document.location.href = 
        'mahasiswa.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal diedit'); document.location.href = 'mahasiswa.php';
        </script>";
    }
}

// Ambil ID Mahasiswa dari URL
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

// Ambil Data Mahasiswa berdasarkan ID
$data_mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-edit"></i> Edit Mahasiswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="mahasiswa">Data Mahasiswa</a></li>
                        <li class="breadcrumb-item active">Edit Mahasiswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_mahasiswa" value="<?php echo $data_mahasiswa['id_mahasiswa']; ?>">
                <input type="hidden" name="fotoLama" value="<?php echo $data_mahasiswa['foto']; ?>">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa..." required value="<?php echo $data_mahasiswa['nama']; ?>">
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <select name="prodi" id="prodi" class="form-control" required>
                            <?php $prodi = $data_mahasiswa['prodi']; ?>
                            <option value="Pendidikan Teknik Informatika dan Komputer" <?php echo $prodi == 'Pendidikan Teknik Informatika dan Komputer' ? 'selected' : null; ?>>Pendidikan Teknik Informatika dan Komputer</option>
                            <option value="Pendidikan Teknik Mesin" <?php echo $prodi == 'Pendidikan Teknik Mesin' ? 'selected' : null; ?>>Pendidikan Teknik Mesin</option>
                            <option value="Pendidikan Teknik Bangunan" <?php echo $prodi == 'Pendidikan Teknik Bangunan' ? 'selected' : null; ?>>Pendidikan Teknik Bangunan</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <?php $jenis_kelamin = $data_mahasiswa['jenis_kelamin']; ?>
                            <option value="Laki-laki" <?php echo $jenis_kelamin == 'Laki-laki' ? 'selected' : null; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php echo $jenis_kelamin == 'Perempuan' ? 'selected' : null; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor Handphone (Diawali dengan +62)</label>
                    <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: +6234567890..." required value="<?php echo $data_mahasiswa['no_hp']; ?>">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat"><?php echo $data_mahasiswa['alamat']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Mahasiswa</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Mahasiswa..." required value="<?php echo $data_mahasiswa['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Mahasiswa</label>
                    <input type="file" class="form-control" id="foto" name="foto" placeholder="Pas Photo 3x4" onchange="previewImg()">

                    <img src="assets/img/<?php echo $data_mahasiswa['foto']; ?>" alt="" class="img-thumbnail img-preview mt-2" width="150px">
                </div>
                <button type="submit" name="Edit" class="btn btn-primary" style="float: right;"><i class="fas fa-edit"></i> Edit Mahasiswa</button>
                <a href="mahasiswa.php" class="btn btn-danger"><i class="fas fa-times-circle"></i> Back</a>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- Preview Image -->
<script>
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?php include 'layout/footer.php'; ?>