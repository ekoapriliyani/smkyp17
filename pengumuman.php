<?php
include "ppdb/functions.php"; // Menggunakan koneksi database yang ada

$siswa_diterima = query("SELECT nomor_registrasi, nama, asal, jurusan1 FROM tbl_siswa_verifikasi ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Hasil PPDB SMK YP 17</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f4f4; }
        .header-custom { background-color: #005959; color: white; padding: 20px 0; }
        .status-badge { font-size: 1.1rem; padding: 5px 15px; border-radius: 5px; }
    </style>
</head>
<body>

<header class="header-custom text-center shadow-sm">
    <div class="container">
        <h1 class="mb-1"><i class="fas fa-bullhorn me-2"></i> Pengumuman Hasil Seleksi PPDB</h1>
        <p class="lead">SMK YP 17 Blitar - Tahun Ajaran 2025/2026</p>
    </div>
</header>

<div class="container mt-5">
    
    <div class="alert alert-success text-center shadow-sm" role="alert">
        <h4 class="alert-heading">Selamat!</h4>
        <p>Berikut adalah daftar nama Calon Siswa yang dinyatakan **DITERIMA** di SMK YP 17.</p>
        <hr>
        <p class="mb-0">Siswa yang diterima harap melanjutkan proses pendaftaran ulang sesuai jadwal yang ditentukan.</p>
    </div>

    <div class="card shadow-sm mb-5">
        <div class="card-header bg-white">
            <h5 class="mb-0 text-primary">Daftar Siswa Diterima</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>No. Registrasi</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Sekolah</th>
                            <th>Jurusan Pilihan</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($siswa_diterima as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><strong><?= htmlspecialchars($row['nomor_registrasi']); ?></strong></td>
                                <td><?= htmlspecialchars($row['nama']); ?></td>
                                <td><?= htmlspecialchars($row['asal']); ?></td>
                                <td><?= htmlspecialchars($row['jurusan1']); ?></td>
                                <td class="text-center">
                                    <span class="badge bg-success status-badge">DITERIMA</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($siswa_diterima)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data siswa yang dinyatakan diterima.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>