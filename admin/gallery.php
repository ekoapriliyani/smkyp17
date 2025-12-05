<?php
// 1. MEMULAI SESI & KEAMANAN
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 2. KONEKSI DAN QUERY DATA (Asumsi tabel gallery bernama 'gallery')
// PASTIKAN jalur koneksi.php sudah benar.
include "../koneksi.php"; 

// Query untuk mengambil data gallery
// Menggunakan prepared statement lebih baik, tapi kita gunakan query langsung sesuai konteks file Anda.
$query = "SELECT id, image, caption FROM gallery ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Gallery | SMK YP 17</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    
    <style>
        /* --- STYLE SIDEBAR SERAGAM --- */
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
            background-color: #f4f4f4; /* Tambahkan background agar terlihat rapi */
        }
        
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--teal-dark);
            color: white;
            padding: 0;
            flex-shrink: 0;
            position: sticky; /* Tambahkan sticky agar sidebar tetap */
            top: 0;
            height: 100vh;
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
            min-width: 0; /* Penting untuk DataTables */
        }
        
        .gallery-image-preview {
            max-width: 80px; 
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
        <a href="profil_sekolah.php"><i class="fas fa-school fa-fw me-2"></i> Kelola Profil Sekolah</a>
        <a href="gallery.php" class="active"><i class="fas fa-images fa-fw me-2"></i> Kelola Gallery</a>
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
            <h1><i class="fas fa-images me-2"></i> Kelola Gallery</h1>
        </div>
        
        <div class="mb-4 d-flex justify-content-between">
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                 <i class="fas fa-plus me-1"></i> Tambahkan Gambar
             </button>
             <a href="index.php" class="btn btn-secondary">
                 <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
             </a>
        </div>
        
        <?php 
        // Notifikasi Sukses/Gagal
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'sukses') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Gambar berhasil diunggah/diperbarui!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } elseif ($_GET['status'] == 'hapus_sukses') {
                 echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Gambar berhasil dihapus!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } elseif ($_GET['status'] == 'gagal') {
                 echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Operasi gagal! Silakan coba lagi.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
        ?>

        <div class="card shadow">
            <div class="card-header bg-custom-teal text-white">
                Daftar Gambar Gallery
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTableGallery">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td><img src='" . htmlspecialchars($row["image"]) . "' class='gallery-image-preview img-thumbnail' alt='Thumbnail'></td>";
                                    echo "<td>" . htmlspecialchars($row["caption"]) . "</td>";
                                    
                                    // Kolom Aksi
                                    echo "<td>";
                                    echo "<a href='detail_gallery.php?id={$row["id"]}' class='btn btn-info btn-sm me-1' title='Detail'><i class='fas fa-eye'></i></a>";
                                    echo "<a href='edit_gallery.php?id={$row["id"]}' class='btn btn-warning btn-sm me-1' title='Edit'><i class='fas fa-edit'></i></a>";
                                    // Tombol Hapus dengan konfirmasi
                                    echo "<a href='hapusgallery.php?id={$row["id"]}' class='btn btn-danger btn-sm' title='Hapus' onclick=\"return confirm('Yakin ingin menghapus gambar ini?')\"><i class='fas fa-trash-alt'></i></a>";
                                    echo "</td>";

                                    echo "</tr>";
                                }
                            } else {
                                // DataTables akan menampilkan "No data available in table" secara otomatis jika tidak ada data di <tbody>
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-custom-teal text-white">
                    <h5 class="modal-title" id="modalLabel">Tambahkan Gambar Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="image" class="form-label">Pilih Gambar :</label>
                            <input type="file" name="image" id="image" class="form-control" required>
                            <small class="text-muted">Max. ukuran 2MB, format JPG/PNG.</small>
                        </div>
                        <div class="mb-3">
                            <label for="caption" class="form-label">Keterangan :</label>
                            <input type="text" name="caption" id="caption" class="form-control" required>
                        </div>
                        <button class="btn btn-info" type="submit" name="submit">
                            <i class="fas fa-upload me-1"></i> Upload Gambar
                        </button>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable.
            // Menghapus properti "language" memastikan penggunaan Bahasa Inggris (default).
            $('#dataTableGallery').DataTable({
                "order": [[ 0, "asc" ]]
            });
        });
    </script>
</body>
</html>

<?php 
// Tutup koneksi 
if (isset($conn)) {
    $conn->close();
}
?>