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

require 'config/app.php';

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();
$activeWorksheet->setCellValue('A2', 'No');
$activeWorksheet->setCellValue('B2', 'Nama');
$activeWorksheet->setCellValue('C2', 'Program Studi');
$activeWorksheet->setCellValue('D2', 'Jenis Kelamin');
$activeWorksheet->setCellValue('E2', 'Telepon');
$activeWorksheet->setCellValue('F2', 'Email');
$activeWorksheet->setCellValue('G2', 'Foto');

$data_mahasiswa = select("SELECT * FROM mahasiswa");

$no     = 1;
$start  = 3;

foreach ($data_mahasiswa as $mhs) {
    $activeWorksheet->setCellValue('A'.$start, $no++)->getColumnDimension('A')->setAutoSize(true);
    $activeWorksheet->setCellValue('B'.$start, $mhs['nama'])->getColumnDimension('B')->setAutoSize(true);
    $activeWorksheet->setCellValue('C'.$start, $mhs['prodi'])->getColumnDimension('C')->setAutoSize(true);
    $activeWorksheet->setCellValue('D'.$start, $mhs['jenis_kelamin'])->getColumnDimension('D')->setAutoSize(true);
    $activeWorksheet->setCellValue('E'.$start, $mhs['no_hp'])->getColumnDimension('E')->setAutoSize(true);
    $activeWorksheet->setCellValue('F'.$start, $mhs['email'])->getColumnDimension('F')->setAutoSize(true);
    $activeWorksheet->setCellValue('G'.$start, 'https://localhost/crud-php/assets/img/'. $mhs['foto'])->getColumnDimension('G')->setAutoSize(true);

    $start++;
}

// Table Border
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$border = $start - 1;

$activeWorksheet->getStyle('A2:G'.$border)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save('Laporan Data Mahasiswa (crud-php).xlsx');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet.sheet');
header('Content-Disposition: attachment;filename="Laporan Data Mahasiswa (crud-php).xlsx"');
readfile('Laporan Data Mahasiswa (crud-php).xlsx');
unlink('Laporan Data Mahasiswa (crud-php).xlsx');
exit;
