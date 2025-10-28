<?php
include "functions.php";

$id = $_GET['id'];
$siswa = query("SELECT * FROM tbl_siswa_verifikasi WHERE id = $id")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="mb-4">Detail Data Siswa</h3>
        <table class="table table-bordered">
            <tr><th>No Registrasi</th><td><?= $siswa['nomor_registrasi']; ?></td></tr>
            <tr><th>Nama</th><td><?= $siswa['nama']; ?></td></tr>
            <tr><th>Asal Sekolah</th><td><?= $siswa['asal']; ?></td></tr>
            <tr><th>Tempat Lahir</th><td><?= $siswa['tempat_lahir']; ?></td></tr>
            <tr><th>Tanggal Lahir</th><td><?= $siswa['tgl_lahir']; ?></td></tr>
            <tr><th>Alamat</th><td><?= $siswa['alamat']; ?></td></tr>
            <tr><th>No HP</th><td><?= $siswa['no_hp']; ?></td></tr>
            <tr><th>Email</th><td><?= $siswa['email']; ?></td></tr>
            <tr><th>Jurusan 1</th><td><?= $siswa['jurusan1']; ?></td></tr>
            <tr><th>Jurusan 2</th><td><?= $siswa['jurusan2']; ?></td></tr>
            <tr><th>Penerima Bantuan</th><td><?= $siswa['penerima_bantuan']; ?></td></tr>
            <tr><th>Nama Ayah</th><td><?= $siswa['nama_ayah']; ?></td></tr>
            <tr><th>Nama Ibu</th><td><?= $siswa['nama_ibu']; ?></td></tr>
            <tr><th>Tanggal Daftar</th><td><?= $siswa['tgl_daftar']; ?></td></tr>
        </table>
        <a href="siswa_diterima.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
