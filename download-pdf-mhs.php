<?php

require __DIR__ . '/vendor/autoload.php';
require 'config/app.php';

use Spipu\Html2Pdf\Html2Pdf;

$data_mhs = select("SELECT * FROM mahasiswa");

$content .= '<style type="text/css">
    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 11px;
        table-layout: fixed;
    }
    table th, table td {
        padding: 5px;
        text-align: center;
        vertical-align: middle;
        word-wrap: break-word;
        white-space: normal;
    }
    .gambar {
        width: 50px;
        height: auto;
        max-height: 70px;
        object-fit: cover;
    }
</style>';


$content .= '
<page>
    <h3 style="text-align: center; margin-bottom: 20px;">Tabel Data Mahasiswa</h3>
    <table border="1" align="center">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Jenis Kelamin</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Foto</th>
        </tr>';

$no = 1;
foreach ($data_mhs as $mhs) {
    $content .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . $mhs['nama'] . '</td>
            <td>' . $mhs['prodi'] . '</td>
            <td>' . $mhs['jenis_kelamin'] . '</td>
            <td>' . $mhs['no_hp'] . '</td>
            <td>' . $mhs['email'] . '</td>
            <td><img src="assets/img/' . $mhs['foto'] . '" class="gambar"></td>
        </tr>
    ';
}

$content .= '
    </table>
</page>';

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
ob_start();
$html2pdf->output('Laporan Data Mahasiswa.pdf');
