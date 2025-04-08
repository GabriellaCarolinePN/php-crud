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

$title = 'Tambah Mahasiswa';
include 'layout/header.php';
// Cek Tombol Tambah dapat Ditekan
if (isset($_POST['tambah'])) {
    if (create_mahasiswa($_POST) > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan'); document.location.href = 
        'mahasiswa.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan'); document.location.href = 'mahasiswa.php';
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
                    <h1 class="m-0"><i><i class="fas fa-plus-circle"></i></i> Tambah Mahasiswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="mahasiswa">Data Mahasiswa</a></li>
                        <li class="breadcrumb-item active">Tambah Mahasiswa</li>
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
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa..." required>
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <select name="prodi" id="prodi" class="form-control" required>
                            <option value="">-- Pilih Program Studi --</option>
                            <option value="Pendidikan Teknik Informatika dan Komputer">Pendidikan Teknik Informatika dan Komputer</option>
                            <option value="Pendidikan Teknik Mesin">Pendidikan Teknik Mesin</option>
                            <option value="Pendidikan Teknik Bangunan">Pendidikan Teknik Bangunan</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="">-- Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor Handphone (Diawali dengan +62)</label>
                    <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: +6234567890..." required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat"></textarea>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Mahasiswa</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Mahasiswa..." required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Mahasiswa</label>
                    <input type="file" class="form-control" id="foto" name="foto" placeholder="Pas Photo 3x4" onchange="previewImg()">
                    <img src="" alt="" class="img-thumbnail img-preview mt-2" width="150px">
                </div>
                <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah Mahasiswa</button>
                <a href="mahasiswa.php" class="btn btn-danger">Back</a>
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