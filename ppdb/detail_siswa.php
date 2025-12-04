<?php
// 1. MEMULAI SESI DAN FUNCTIONS
session_start();
include "functions.php";

// Pastikan sudah login (Guardrail)
if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}

// 2. MENGAMBIL DATA SISWA LENGKAP DARI tbl_siswa_verifikasi
$id = $_GET['id'];

// Mengambil data utama dari tbl_siswa_verifikasi
$siswa = query("SELECT * FROM tbl_siswa_verifikasi WHERE id = $id");

if (!$siswa) {
    die("Data siswa tidak ditemukan di tbl_siswa_verifikasi.");
}

$siswa = $siswa[0];

// 3. MENENTUKAN STATUS (Karena data diambil dari satu tabel, kita asumsikan statusnya adalah "Telah Diverifikasi" jika ada di tabel ini)
$status = "Data Telah Diverifikasi";
$keterangan = "Status verifikasi final harus dicek di halaman 'Siswa Diterima' atau 'Siswa Ditolak'.";
$badge_class = "info"; 

// Catatan: Jika tbl_siswa_verifikasi adalah tabel yang menyimpan semua data, dan belum ada kolom status, kita tidak bisa menentukan Diterima/Ditolak secara otomatis dari tabel ini.
// Kita asumsikan data yang tampil adalah data yang valid dan siap diolah/diverifikasi.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Siswa | <?= htmlspecialchars($siswa['nama']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    
    <div class="container py-5">
        
        <h2 class="mb-4 text-primary"><i class="fas fa-user-circle me-2"></i> Detail Data Calon Siswa</h2>
        
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body bg-<?= $badge_class; ?> text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">Status Data: <span class="badge bg-white text-<?= $badge_class; ?>"><?= $status; ?></span></h4>
                        <small><?= $keterangan; ?></small>
                    </div>
                    <div>
                        <small><i class="fas fa-calendar-alt"></i> Tgl. Pendaftaran: <?= date('d F Y', strtotime($siswa['tgl_daftar'])); ?></small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-id-card me-2"></i> Data Pribadi & Sekolah</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr><th style="width: 35%;">No Registrasi</th><td>: <b><?= htmlspecialchars($siswa['nomor_registrasi']); ?></b></td></tr>
                            <tr><th>Nama Lengkap</th><td>: <?= htmlspecialchars($siswa['nama']); ?></td></tr>
                            <tr><th>Asal Sekolah</th><td>: <?= htmlspecialchars($siswa['asal']); ?></td></tr>
                            <tr><th>Tempat, Tgl Lahir</th><td>: <?= htmlspecialchars($siswa['tempat_lahir']); ?>, <?= date('d-m-Y', strtotime($siswa['tgl_lahir'])); ?></td></tr>
                            <tr><th>Alamat</th><td>: <?= htmlspecialchars($siswa['alamat']); ?></td></tr>
                            <tr><th>No HP Siswa</th><td>: <?= htmlspecialchars($siswa['no_hp']); ?></td></tr>
                            <tr><th>Email</th><td>: <?= htmlspecialchars($siswa['email']); ?></td></tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i> Pilihan Jurusan</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr><th style="width: 35%;">Pilihan Jurusan 1</th><td>: <b><?= htmlspecialchars($siswa['jurusan1']); ?></b></td></tr>
                            <tr><th>Pilihan Jurusan 2</th><td>: <?= htmlspecialchars($siswa['jurusan2']); ?></td></tr>
                            <tr><td colspan="2"><hr class="my-2"></td></tr>
                            <tr><th colspan="2" class="pt-0"><i class="fas fa-users me-2"></i> Data Keluarga</th></tr>
                            <tr><th>Nama Ayah</th><td>: <?= htmlspecialchars($siswa['nama_ayah']); ?></td></tr>
                            <tr><th>Nama Ibu</th><td>: <?= htmlspecialchars($siswa['nama_ibu']); ?></td></tr>
                            <tr><td colspan="2"><hr class="my-2"></td></tr>
                            <tr><th colspan="2" class="pt-0"><i class="fas fa-hands-helping me-2"></i> Bantuan Sosial</th></tr>
                            <tr><th>Penerima Bantuan</th><td>: <b><?= htmlspecialchars($siswa['penerima_bantuan']); ?></b></td></tr>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="d-flex justify-content-between mt-3">
            <a href="siswa_diterima.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Siswa</a>
            <a href="cetak_single.php?id=<?= $siswa['id']; ?>" class="btn btn-warning"><i class="fas fa-print me-1"></i> Cetak Data</a>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>