<?php 
include "functions.php";
$siswa = query("SELECT * FROM tbl_siswa_verifikasi");

// Memanggil library TCPDF
require_once('tcpdf/tcpdf.php');

// Membuat objek PDF
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// Set dokumen informasi
$pdf->SetCreator('SMK YP 17 Blitar');
$pdf->SetAuthor('SMK YP 17 Blitar');
$pdf->SetTitle('Data Siswa Diterima');
$pdf->SetSubject('Data Siswa');

// Menghapus header dan footer default
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Menambahkan halaman
$pdf->AddPage();

// Membuat konten
$html = '
<h2 style="text-align:center">DATA SISWA YANG DITERIMA</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="10%">No Reg</th>
            <th width="15%">Nama Siswa</th>
            <th width="15%">Asal Sekolah</th>
            <th width="10%">Tempat Lahir</th>
            <th width="10%">Tgl Lahir</th>
            <th width="20%">Alamat</th>
            <th width="7%">Jurusan 1</th>
            <th width="7%">Jurusan 2</th>
        </tr>
    </thead>
    <tbody>';

$no = 1;
foreach ($siswa as $row) {
    $html .= '
    <tr>
        <td>'.$no.'</td>
        <td>'.$row["nomor_registrasi"].'</td>
        <td>'.$row["nama"].'</td>
        <td>'.$row["asal"].'</td>
        <td>'.$row["tempat_lahir"].'</td>
        <td>'.$row["tgl_lahir"].'</td>
        <td>'.$row["alamat"].'</td>
        <td>'.$row["jurusan1"].'</td>
        <td>'.$row["jurusan2"].'</td>
    </tr>';
    $no++;
}

$html .= '
    </tbody>
</table>';

// Mencetak konten
$pdf->writeHTML($html, true, false, true, false, '');

// Menutup dan mengeluarkan dokumen PDF
$pdf->Output('data_siswa_diterima.pdf', 'I');
?>