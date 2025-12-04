<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "../koneksi.php"; 
// Asumsi $conn adalah objek koneksi mysqli dari koneksi.php

// ----------------------------------------------------
// 1. QUERY DATA STATISTIK
// ----------------------------------------------------

// A. Total Calon Siswa (tbl_siswa)
$query_calon = "SELECT COUNT(*) as total_calon FROM tbl_siswa";
$result_calon = $conn->query($query_calon);
$total_calon = $result_calon->fetch_assoc()['total_calon'];

// B. Total Siswa Diterima (tbl_siswa_verifikasi)
$query_diterima = "SELECT COUNT(*) as total_diterima FROM tbl_siswa_verifikasi";
$result_diterima = $conn->query($query_diterima);
$total_diterima = $result_diterima->fetch_assoc()['total_diterima'];

// C. Total Siswa Ditolak (tbl_siswa_ditolak)
$query_ditolak = "SELECT COUNT(*) as total_ditolak FROM tbl_siswa_ditolak";
$result_ditolak = $conn->query($query_ditolak);
$total_ditolak = $result_ditolak->fetch_assoc()['total_ditolak'];

// ----------------------------------------------------
// 2. TAMPILAN HTML DENGAN DATA
// ----------------------------------------------------
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | SMK YP 17</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- STYLE SIDEBAR SERAGAM DARI INDEX.PHP --- */
        :root {
            --teal-dark: #005959;
            --sidebar-width: 250px;
        }
        .bg-custom-teal {
            background-color: var(--teal-dark) !important;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            margin: 0;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--teal-dark);
            color: white;
            padding: 0;
            flex-shrink: 0;
        }
        .sidebar a {
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #007d7d;
            color: white;
        }
        .sidebar .sidebar-header {
            padding: 20px;
            font-size: 1.25rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 10px;
        }
        .sidebar a.active {
            background-color: #007d7d;
            border-left: 5px solid #ffc107;
            padding-left: 15px;
        }
        
        .main-content {
            flex-grow: 1;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        /* Mengganti bg-info di Card 1 menjadi Teal agar seragam, atau warna lain yang Anda suka */
        .bg-card-1 {
            background-color: #17a2b8 !important; /* Biru muda/Info */
        }
    </style>
</head>
<body>

    <div class="sidebar d-flex flex-column">
        <div class="sidebar-header">
            <i class="fas fa-tools"></i> Admin Panel
        </div>
        <a href="index.php" class="active"><i class="fas fa-tachometer-alt fa-fw me-2"></i> Dashboard</a>
        <a href="../ppdb/admin.php"><i class="fas fa-users-cog fa-fw me-2"></i> PPDB</a>
        <a href="profil_sekolah.php"><i class="fas fa-school fa-fw me-2"></i> Kelola Profil Sekolah</a>
        <a href="gallery.php"><i class="fas fa-images fa-fw me-2"></i> Kelola Gallery</a>
        <a href="kegiatan.php"><i class="fas fa-calendar-alt fa-fw me-2"></i> Kelola Kegiatan</a>
        <div class="mt-auto"> 
            <hr class="mx-3" style="border-color: rgba(255, 255, 255, 0.2);">
            <a href="logout.php" class="bg-danger text-white">
                <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
            </a>
        </div>
    </div>
    <div class="main-content">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Dashboard Utama</h1>
        </div>

        <div class="alert alert-info">
            Selamat Datang Admin (<?php echo $_SESSION['username']; ?>)!
        </div>
        
        <div class="row mt-4">
            
            <div class="col-md-4">
                <div class="card text-white bg-card-1 mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user-graduate me-2"></i> Total Calon Siswa</h5>
                        <p class="card-text fs-3"><?= $total_calon; ?> Siswa</p> 
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card text-white bg-custom-teal mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-check-circle me-2"></i> Total Siswa Diterima</h5>
                        <p class="card-text fs-3"><?= $total_diterima; ?> Siswa</p> 
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-times-circle me-2"></i> Total Siswa Ditolak</h5>
                        <p class="card-text fs-3"><?= $total_ditolak; ?> Siswa</p> 
                    </div>
                </div>
            </div>
            
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

<?php 
// Tutup koneksi setelah semua data selesai diolah
if (isset($conn)) {
    $conn->close();
}
?>