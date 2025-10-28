<?php 
include "functions.php";

// Ambil ID dari parameter URL
$id = $_GET['id'];
$siswa = query("SELECT * FROM tbl_siswa_verifikasi WHERE id = $id")[0];

// Konversi semua field ke UPPERCASE
$siswa['jurusan1'] = strtoupper($siswa['jurusan1']);
$siswa['jurusan2'] = strtoupper($siswa['jurusan2']);
$siswa['nama'] = strtoupper($siswa['nama']);
$siswa['tempat_lahir'] = strtoupper($siswa['tempat_lahir']);
$siswa['alamat'] = strtoupper($siswa['alamat']);
$siswa['asal'] = strtoupper($siswa['asal']);
$siswa['nama_ayah'] = strtoupper($siswa['nama_ayah']);
$siswa['nama_ibu'] = strtoupper($siswa['nama_ibu']);
$siswa['penerima_bantuan'] = strtoupper($siswa['penerima_bantuan']);


// Memanggil library TCPDF
require_once('tcpdf/tcpdf.php');

// Membuat objek PDF
$pdf = new TCPDF('P', 'mm', 'F4', true, 'UTF-8', false);

// Set dokumen informasi
$pdf->SetCreator('SMK YP 17 Blitar');
$pdf->SetAuthor('SMK YP 17 Blitar');
$pdf->SetTitle('Formulir Penerimaan - ' . $siswa['nomor_registrasi']);
$pdf->SetSubject('Formulir Penerimaan');

// Menghapus header dan footer default
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Menambahkan halaman
$pdf->AddPage();

// Path logo
$logo_kiri = 'kop.png'; 
$logo_bawah = 'kopypbawah.png';
$footer = 'footer.png';

// Membuat kop surat dengan background gradasi biru
$kop_surat = '
<style>
    .kop {
        text-align: center;
        position: relative;
    }
</style>

<div class="kop-surat">
    <img src="'.$logo_kiri.'" class="kop" />
</div>';

// Membuat konten formulir
$formulir = '
<table border="0" cellpadding="2" width="100%">
    <tr>
        <td><strong>Nomor Peserta</strong></td>
        <td>: '.$siswa["nomor_registrasi"].'</td>
    </tr>
    <tr>
        <td><strong>1. Pilihan Jurusan</strong></td>
        <td>: '.$siswa["jurusan1"].' | '.$siswa["jurusan2"].'</td>
    </tr>
    <tr>
        <td><strong>2. Nama Lengkap</strong></td>
        <td>: '.$siswa["nama"].'</td>
    </tr>
    <tr>
        <td><strong>3. Tempat/Tanggal Lahir</strong></td>
        <td>: '.$siswa["tempat_lahir"].', '.$siswa["tgl_lahir"].'</td>
    </tr>
    <tr>
        <td><strong>4. Alamat Rumah</strong></td>
        <td>: '.$siswa["alamat"].'</td>
    </tr>
    <tr>
        <td><strong>5. Nomor HP/WA</strong></td>
        <td>: '.$siswa["no_hp"].'</td>
    </tr>
    <tr>
        <td><strong>6. Email</strong></td>
        <td>: '.$siswa["email"].'</td>
    </tr>
    <tr>
        <td><strong>7. Asal Sekolah</strong></td>
        <td>: '.$siswa["asal"].'</td>
    </tr>
    <tr>
        <td><strong>8. Nama Orang Tua</strong></td>
        <td>: Bapak : '.$siswa["nama_ayah"].' -  Ibu : '.$siswa["nama_ibu"].'</td>
    </tr>
     <tr>
        <td><strong>9. Penerima Bantuan</strong></td>
        <td>: '.$siswa["penerima_bantuan"].'</td>
    </tr>
</table>


<table border="0" width="100%">
    <tr>
        <td width="50%" style="text-align:center">
           
        </td>
        <td width="50%" style="text-align:center">
            <br>
            Blitar, ....................... 2025
            <p>Calon Peserta Didik Baru</p>
            <br>
            <p>(___________________)</p>
        </td>
    </tr>
</table>
<div class="kop-surat">
    <img src="'.$logo_bawah.'" class="kop" />
</div>

<table border="0" cellpadding="2" width="100%">
    <tr>
        <td><strong>Nama Lengkap</strong></td>
        <td>: '.$siswa["nama"].'</td>
    </tr>
    <tr>
        <td><strong>Alamat Rumah</strong></td>
        <td>: '.$siswa["alamat"].'</td>
    </tr>
    <tr>
        <td><strong>Nomor HP/WA</strong></td>
        <td>: '.$siswa["no_hp"].'</td>
    </tr>
     <tr>
        <td><strong>Pilihan Jurusan</strong></td>
        <td>: '.$siswa["jurusan1"].' | '.$siswa["jurusan2"].'</td>
    </tr>
</table>

<table border="0" width="100%">
    <tr>
        <td width="50%" style="text-align:center">
           
        </td>
        <td width="50%" style="text-align:center">
            <br>
            Blitar, ....................... 2025
            <p>Panitia PPDB</p>
            <br>
            <p>(___________________)</p>
        </td>
    </tr>
</table>
<br><br>
<div class="kop-surat">
    <img src="'.$footer.'" class="kop" />
</div>

';


// Menggabungkan kop surat dan formulir
$html = $kop_surat . $formulir;

// Mencetak konten
$pdf->writeHTML($html, true, false, true, false, '');

// Menutup dan mengeluarkan dokumen PDF
$pdf->Output('formulir_penerimaan_'.$siswa['nomor_registrasi'].'.pdf', 'I');
?>