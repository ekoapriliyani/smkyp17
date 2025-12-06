<?php
// 1. MEMULAI SESI & KEAMANAN
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 2. KONEKSI DAN QUERY DATA
include "functions.php"; 

// 3. TANGKAP ID SISWA
$id = $_GET["id"];
$siswa = query("SELECT * FROM tbl_siswa WHERE id = $id");

if (!$siswa) {
    die("Data siswa tidak ditemukan.");
}

$siswa = $siswa[0];

// 4. LOGIKA VERIFIKASI (TANGANI FORM ACTION DARI MODAL)
// Catatan: Saya mengasumsikan fungsi 'verifikasi' Anda sekarang menangani logika 
// INSERT ke tbl_siswa_diterima atau tbl_siswa_ditolak dan menghapus dari tbl_siswa (atau mengupdate status).
if (isset($_POST["aksi_verifikasi"])) {
    if (verifikasi($_POST) > 0) {
        $redirect_page = ($_POST['aksi_verifikasi'] == 'diterima') ? 'siswa_diterima.php' : 'siswa_ditolak.php';
        echo "<script>
            alert('Verifikasi berhasil disimpan!');
            document.location.href='{$redirect_page}'; // Pindah ke halaman daftar yang benar
        </script>";
    } else {
        echo "<script>
            alert('Verifikasi gagal! Coba lagi.');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Siswa | <?= htmlspecialchars($siswa['nama']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* CSS Konsisten dengan Admin Panel */
        :root {
            --teal-dark: #005959;
            --sidebar-width: 250px;
        }
        .bg-custom-teal {
            background-color: var(--teal-dark) !important;
        }
        .main-content {
            padding: 20px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    
    <h2 class="mb-4 text-primary"><i class="fas fa-check-double me-2"></i> Verifikasi Data Calon Siswa</h2>
    <h4 class="text-muted mb-4"><?= htmlspecialchars($siswa['nomor_registrasi']); ?> - <?= htmlspecialchars($siswa['nama']); ?></h4>

    <div class="row">
        
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-custom-teal text-white">
                    <h5 class="mb-0"><i class="fas fa-user-check me-2"></i> Data Siswa untuk Validasi</h5>
                </div>
                <div class="card-body">
                    
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pribadi-tab" data-bs-toggle="tab" data-bs-target="#pribadi" type="button" role="tab" aria-controls="pribadi" aria-selected="true">Data Pribadi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="jurusan-tab" data-bs-toggle="tab" data-bs-target="#jurusan" type="button" role="tab" aria-controls="jurusan" aria-selected="false">Pilihan & Ortu</button>
                        </li>
                    </ul>

                    <div class="tab-content pt-3" id="myTabContent">
                        
                        <div class="tab-pane fade show active" id="pribadi" role="tabpanel" aria-labelledby="pribadi-tab">
                            <table class="table table-sm table-borderless">
                                <tr><th style="width: 35%;">No Registrasi</th><td>: <b><?= htmlspecialchars($siswa['nomor_registrasi']); ?></b></td></tr>
                                <tr><th>Nama Lengkap</th><td>: <?= htmlspecialchars($siswa['nama']); ?></td></tr>
                                <tr><th>Asal Sekolah</th><td>: <?= htmlspecialchars($siswa['asal']); ?></td></tr>
                                <tr><th>TTL</th><td>: <?= htmlspecialchars($siswa['tempat_lahir']); ?>, <?= date('d F Y', strtotime($siswa['tgl_lahir'])); ?></td></tr>
                                <tr><th>Alamat</th><td>: <?= htmlspecialchars($siswa['alamat']); ?></td></tr>
                                <tr><th>No HP</th><td>: <?= htmlspecialchars($siswa['no_hp']); ?></td></tr>
                                <tr><th>Email</th><td>: <?= htmlspecialchars($siswa['email']); ?></td></tr>
                                <tr><th>Tgl Daftar</th><td>: <?= date('d-m-Y H:i:s', strtotime($siswa['tgl_daftar'])); ?></td></tr>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="jurusan" role="tabpanel" aria-labelledby="jurusan-tab">
                            <table class="table table-sm table-borderless">
                                <tr><th style="width: 35%;">Jurusan 1</th><td>: <b><?= htmlspecialchars($siswa['jurusan1']); ?></b></td></tr>
                                <tr><th>Jurusan 2</th><td>: <?= htmlspecialchars($siswa['jurusan2']); ?></td></tr>
                                <tr><td colspan="2"><hr class="my-2"></td></tr>
                                <tr><th>Nama Ayah</th><td>: <?= htmlspecialchars($siswa['nama_ayah']); ?></td></tr>
                                <tr><th>Nama Ibu</th><td>: <?= htmlspecialchars($siswa['nama_ibu']); ?></td></tr>
                                <tr><td colspan="2"><hr class="my-2"></td></tr>
                                <tr><th>Penerima Bantuan</th><td>: <b><?= htmlspecialchars($siswa['penerima_bantuan']); ?></b></td></tr>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-cogs me-2"></i> Keputusan Verifikasi</h5>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">Pilih salah satu status di bawah ini setelah Anda selesai memvalidasi data siswa.</p>
                    
                    <button type="button" class="btn btn-success btn-lg w-100 mb-3" data-bs-toggle="modal" data-bs-target="#modalDiterima">
                        <i class="fas fa-check-circle me-2"></i>TERIMA SISWA
                    </button>
                    
                    <button type="button" class="btn btn-danger btn-lg w-100" data-bs-toggle="modal" data-bs-target="#modalDitolak">
                        <i class="fas fa-times-circle me-2"></i>TOLAK SISWA
                    </button>
                    
                </div>
                <div class="card-footer">
                    <a href="admin.php" class="btn btn-secondary w-100"><i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Siswa</a>
                </div>
            </div>
        </div>
        
    </div>
    
</div>

<div class="modal fade" id="modalDiterima" tabindex="-1" aria-labelledby="modalDiterimaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalDiterimaLabel">Konfirmasi Penerimaan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="lead text-center">Apakah Anda yakin ingin **MENERIMA** siswa ini?</p>
                    <p class="text-center text-danger">Data siswa akan dipindahkan ke daftar **Siswa Terverifikasi**.</p>
                    
                    <input hidden type="text" name="id" value="<?= $siswa["id"]; ?>">
                    <input hidden type="text" name="aksi_verifikasi" value="diterima">
                    </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check-circle me-1"></i> Ya, Terima Siswa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDitolak" tabindex="-1" aria-labelledby="modalDitolakLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalDitolakLabel">Konfirmasi Penolakan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="lead text-center">Apakah Anda yakin ingin **MENOLAK** siswa ini?</p>
                    <p class="text-center text-danger">Data siswa akan dipindahkan ke daftar **Siswa Ditolak**.</p>

                    <input hidden type="text" name="id" value="<?= $siswa["id"]; ?>">
                    <input hidden type="text" name="aksi_verifikasi" value="ditolak">
                    </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-times-circle me-1"></i> Ya, Tolak Siswa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>