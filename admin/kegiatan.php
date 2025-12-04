<?php
// 1. MEMULAI SESI & KEAMANAN
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 2. KONEKSI DAN QUERY DATA
include "../koneksi.php"; 

// Query untuk mengambil semua data kegiatan
$query_kegiatan = "SELECT id, judul, tanggal_kegiatan, gambar FROM tbl_kegiatan ORDER BY tanggal_kegiatan DESC";
$result_kegiatan = $conn->query($query_kegiatan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kegiatan | SMK YP 17</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
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
        /* Memberi highlight pada menu yang sedang aktif */
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
        .kegiatan-image-preview {
            max-width: 60px; 
            height: auto; 
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="sidebar d-flex flex-column">
        
        <div class="sidebar-header">
            <i class="fas fa-tools"></i> Admin Panel
        </div>
        
        <a href="index.php"><i class="fas fa-tachometer-alt fa-fw me-2"></i> Dashboard</a>
        <a href="../ppdb/admin.php"><i class="fas fa-users-cog fa-fw me-2"></i> PPDB</a>
        
        <div class="sidebar-header mt-3" style="font-size: 1rem;">
            Konten Website
        </div>
        
        <a href="profil_sekolah.php"><i class="fas fa-school fa-fw me-2"></i> Kelola Profil Sekolah</a>
        <a href="gallery.php"><i class="fas fa-images fa-fw me-2"></i> Kelola Gallery</a>
        <a href="kegiatan.php" class="active"><i class="fas fa-calendar-alt fa-fw me-2"></i> Kelola Kegiatan</a>
        
        <div class="mt-auto"> 
            <hr class="mx-3" style="border-color: rgba(255, 255, 255, 0.2);">
            <a href="logout.php" class="bg-danger text-white">
                <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
            </a>
        </div>
    </div>
    <div class="main-content">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-calendar-alt me-2"></i> Kelola Kegiatan Sekolah</h1>
        </div>
        
        <div class="mb-4 d-flex justify-content-between">
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                 <i class="fas fa-plus me-1"></i> Tambahkan Kegiatan
             </button>
             <a href="index.php" class="btn btn-secondary">
                 <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
             </a>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-custom-teal text-white">
                Daftar Kegiatan Sekolah
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="kegiatanTable" style="width:100%"> 
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 10%">Gambar</th>
                                <th>Judul Kegiatan</th>
                                <th style="width: 15%">Tanggal</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php if ($result_kegiatan->num_rows > 0): ?>
                            <?php while ($row = $result_kegiatan->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><img src="<?= $row["gambar"]; ?>" class="kegiatan-image-preview img-thumbnail" alt="Thumb"></td>
                                    <td><?= htmlspecialchars($row["judul"]); ?></td>
                                    <td><?= date('d M Y', strtotime($row["tanggal_kegiatan"])); ?></td>
                                    <td>
                                        <a href="detail_kegiatan.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm me-1" title="Detail"><i class="fas fa-eye"></i></a>
                                        <a href="edit_kegiatan.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm me-1" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="kegiatan_proses.php?action=delete&id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus kegiatan ini?')"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php $no++; endwhile; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="modal" id="modalTambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-custom-teal text-white">
                    <h5 class="modal-title">Form Tambah Kegiatan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="kegiatan_proses.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="insert">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Kegiatan:</label>
                            <input type="text" name="judul" id="judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan:</label>
                            <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Kegiatan:</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Utama Kegiatan (Max 5MB):</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" required>
                        </div>
                        <button class="btn btn-primary" type="submit" name="submit">
                            <i class="fas fa-save me-1"></i> Simpan Kegiatan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    
    <script>
        // Inisialisasi DataTable
        $(document).ready(function() {
            if ($('#kegiatanTable').length) {
                $('#kegiatanTable').DataTable({
                    "order": [[3, "desc"]] // Urutkan berdasarkan kolom Tanggal Kegiatan (kolom ke-3) secara descending
                });
            }
        });
    </script>
</body>
</html>

<?php 
if (isset($conn)) {
    $conn->close();
}
?>