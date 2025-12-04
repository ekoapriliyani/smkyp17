<?php
// 1. MEMULAI SESI
session_start();

// PASTIKAN FILE functions.php ADA DAN BENAR
include "functions.php"; 

// 2. CEK APAKAH SUDAH LOGIN
if (!isset($_SESSION['username'])) {
    // ----------------------------------------------------
    // JIKA BELUM LOGIN, TAMPILKAN FORM LOGIN
    // ----------------------------------------------------
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .login-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #007bff; margin-bottom: 20px; }
        .error { color: red; text-align: center; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login Admin PPDB</h2>
    
    <?php 
    if (isset($_GET['error']) && $_GET['error'] == 'gagal') {
        echo '<div class="alert alert-danger" role="alert">Username atau Password salah!</div>';
    }
    ?>

    <form action="login_proses.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">LOGIN</button>
    </form>
</div>

</body>
</html>

<?php
// Hentikan eksekusi script. Konten admin di bawah tidak akan dijalankan.
exit(); 
}

// ----------------------------------------------------
// JIKA SUDAH LOGIN, LANJUTKAN KE KONTEN ADMIN
// ----------------------------------------------------


// Lanjutkan dengan kode admin Anda
$siswa = query("SELECT * FROM tbl_siswa_verifikasi");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB | SMK YP 17</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

    <style>
        /* --- STYLE PERBAIKAN --- */
        :root {
            --teal-dark: #005959;
            --sidebar-width: 250px;
        }
        .bg-custom-teal {
            background-color: var(--teal-dark) !important;
        }
        
        body {
            min-height: 100vh;
            display: flex; /* Mempertahankan Flexbox untuk Sidebar dan Konten */
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Pindahkan background-color ke sini */
        }
        
        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--teal-dark);
            color: white;
            padding: 0;
            flex-shrink: 0;
            position: sticky; /* Agar sidebar tetap di tempatnya */
            top: 0;
            height: 100vh; /* Memastikan sidebar setinggi viewport */
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
        
        /* KONTEN UTAMA */
        .main-content {
            flex-grow: 1;
            /* Hapus padding agar navbar bisa mepet ke atas dan konten bisa menggunakan container-fluid */
            padding: 0; 
            min-width: 0; /* Penting untuk flex item agar tidak melebar berlebihan */
        }
        
        /* NAVBAR */
        .bg-navbar { 
            background-color: var(--teal-dark) !important; 
        }
        .navbar {
            /* Pastikan navbar mepet ke atas content */
            margin-bottom: 0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }
        
        /* CONTAINER KONTEN */
        .content-wrapper {
            padding: 20px; /* Berikan padding pada wrapper konten, bukan main-content */
        }
    </style>
</head>
<body>

    <div class="sidebar d-flex flex-column">
        <div class="sidebar-header">
                <i class="fas fa-tools"></i> <?php echo $_SESSION['username']; ?>
            </div>
            <a href="../admin/index.php"><i class="fas fa-tachometer-alt fa-fw me-2"></i> Dashboard</a>
            <a href="../ppdb/admin.php" class="active"><i class="fas fa-users-cog fa-fw me-2"></i> PPDB</a>
            <a href="../admin/profil_sekolah.php"><i class="fas fa-school fa-fw me-2"></i> Kelola Profil Sekolah</a>
            <a href="../admin/gallery.php"><i class="fas fa-images fa-fw me-2"></i> Kelola Gallery</a>
            <a href="../admin/kegiatan.php"><i class="fas fa-calendar-alt fa-fw me-2"></i> Kelola Kegiatan</a>
            <div class="mt-auto"> 
                <hr class="mx-3" style="border-color: rgba(255, 255, 255, 0.2);">
                <a href="logout.php" class="bg-danger text-white">
                    <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
                </a>
        </div>
    </div>

    
    <div class="main-content">
        
        <nav class="navbar navbar-expand-lg bg-navbar shadow" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Data Siswa Diterima</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="admin.php">Calon Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="siswa_diterima.php">Siswa Diterima</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="siswa_ditolak.php">Siswa Tidak Diterima</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid content-wrapper">  
            <div class="container-fluid mt-4"> 
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Reg</th>
                                <th>Nama Siswa</th>
                                <th>Asal Sekolah</th>
                                <th>Tempat Lahir</th>
                                <th>Tgl Lahir</th>
                                <th>Alamat</th>
                                <th>Jurusan 1</th>
                                <th>Jurusan 2</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($siswa as $row): ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $row["nomor_registrasi"]; ?></td>
                                    <td><?= $row["nama"]; ?></td>
                                    <td><?= $row["asal"]; ?></td>
                                    <td><?= $row["tempat_lahir"]; ?></td>
                                    <td><?= $row["tgl_lahir"]; ?></td>
                                    <td><?= $row["alamat"]; ?></td>
                                    <td><?= $row["jurusan1"]; ?></td>
                                    <td><?= $row["jurusan2"]; ?></td>
                                    <td>
                                        <a href="detail_siswa.php?id=<?= $row['id']; ?>" class="btn btn-info" title="Detail">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- datatable -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    
    <script>
        // Inisialisasi DataTable
        $('#example').DataTable();
    </script>
</body>
</html>