<?php
// 1. MEMULAI SESI & KEAMANAN
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 2. KONEKSI DAN QUERY DATA
include "../koneksi.php"; 

// Query untuk mengambil data profil sekolah (hanya ada 1 row dengan ID = 1)
$query = "SELECT * FROM tbl_profil_sekolah WHERE id = 1";
$result = $conn->query($query);
$data_profil = $result->fetch_assoc();

// Jika data_profil kosong, artinya belum pernah di INSERT.
if (!$data_profil) {
    // Siapkan array kosong agar form tidak error
    $data_profil = [
        'visi' => '', 
        'misi' => '', 
        'sejarah' => '', 
        'alamat' => '', 
        'email' => '', 
        'telepon' => ''
    ];
}

// Cek status dari URL
$status_msg = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
        $status_msg = '<div class="alert alert-success" role="alert"><i class="fas fa-check-circle"></i> Data Profil Sekolah berhasil diperbarui!</div>';
    } elseif ($_GET['status'] == 'error') {
        $status_msg = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan saat menyimpan data.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Profil Sekolah | SMK YP 17</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- STYLE SIDEBAR SERAGAM --- */
        :root { --teal-dark: #005959; --sidebar-width: 250px; }
        .bg-custom-teal { background-color: var(--teal-dark) !important; }
        body { min-height: 100vh; display: flex; margin: 0; }
        .sidebar { width: var(--sidebar-width); background-color: var(--teal-dark); color: white; padding: 0; flex-shrink: 0; }
        .sidebar a { color: white; padding: 15px 20px; text-decoration: none; display: block; transition: background-color 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #007d7d; color: white; }
        .sidebar a.active { border-left: 5px solid #ffc107; padding-left: 15px; }
        .sidebar .sidebar-header { padding: 20px; font-size: 1.25rem; text-align: center; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 10px; }
        .main-content { flex-grow: 1; padding: 20px; }
    </style>
</head>
<body>

    <div class="sidebar d-flex flex-column">
        
        <div class="sidebar-header">
            <i class="fas fa-tools"></i> Admin Panel
        </div>
        
        <a href="index.php"><i class="fas fa-tachometer-alt fa-fw me-2"></i> Dashboard</a>
        <a href="../ppdb/admin.php"><i class="fas fa-users-cog fa-fw me-2"></i> PPDB</a>
        <a href="profil_sekolah.php" class="active"><i class="fas fa-school fa-fw me-2"></i> Kelola Profil Sekolah</a>
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
            <h1><i class="fas fa-school me-2"></i> Kelola Profil Sekolah</h1>
        </div>
        
        <?= $status_msg; // Tampilkan pesan status ?>

        <div class="card shadow">
            <div class="card-header bg-custom-teal text-white">
                Form Edit Profil Sekolah
            </div>
            <div class="card-body">
                
                <form action="profil_sekolah_proses.php" method="post">
                    
                    <div class="mb-3">
                        <label for="visi" class="form-label">Visi Sekolah:</label>
                        <textarea name="visi" id="visi" class="form-control" rows="3" required><?= htmlspecialchars($data_profil['visi']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="misi" class="form-label">Misi Sekolah:</label>
                        <textarea name="misi" id="misi" class="form-control" rows="5" required><?= htmlspecialchars($data_profil['misi']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="sejarah" class="form-label">Sejarah/Tentang Sekolah:</label>
                        <textarea name="sejarah" id="sejarah" class="form-control" rows="8" required><?= htmlspecialchars($data_profil['sejarah']); ?></textarea>
                    </div>

                    <hr>
                    
                    <h5 class="mb-3">Informasi Kontak</h5>
                    
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Sekolah:</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" value="<?= htmlspecialchars($data_profil['alamat']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Resmi:</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($data_profil['email']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label">Nomor Telepon:</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" value="<?= htmlspecialchars($data_profil['telepon']); ?>">
                    </div>

                    <button class="btn btn-warning mt-3" type="submit" name="submit">
                        <i class="fas fa-sync-alt me-1"></i> Update Profil Sekolah
                    </button>
                    
                    <?php if ($data_profil['terakhir_diperbarui']): ?>
                    <small class="text-muted ms-3">Terakhir diupdate: <?= date('d M Y H:i', strtotime($data_profil['terakhir_diperbarui'])); ?></small>
                    <?php endif; ?>

                </form>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>

<?php 
if (isset($conn)) {
    $conn->close();
}
?>