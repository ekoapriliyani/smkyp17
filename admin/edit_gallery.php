<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "../koneksi.php"; 

if (!isset($_GET['id'])) {
    header("Location: gallery.php");
    exit();
}

$id_gambar = $_GET['id'];

// Ambil data gallery yang akan diedit
$stmt = $conn->prepare("SELECT id, image, caption FROM gallery WHERE id = ?");
$stmt->bind_param("i", $id_gambar);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Gambar tidak ditemukan.";
    exit();
}

$data_edit = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery: <?= htmlspecialchars($data_edit['caption']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Style sidebar dan layout disalin dari detail_gallery.php */
        :root { --teal-dark: #005959; --sidebar-width: 250px; }
        .bg-custom-teal { background-color: var(--teal-dark) !important; }
        body { min-height: 100vh; display: flex; margin: 0; }
        .sidebar { width: var(--sidebar-width); background-color: var(--teal-dark); color: white; padding: 0; flex-shrink: 0; }
        .sidebar a { color: white; padding: 15px 20px; text-decoration: none; display: block; transition: background-color 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #007d7d; color: white; }
        .sidebar a.active { border-left: 5px solid #ffc107; padding-left: 15px; }
        .sidebar .sidebar-header { padding: 20px; font-size: 1.25rem; text-align: center; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 10px; }
        .main-content { flex-grow: 1; padding: 20px; }
        .image-preview { max-width: 200px; height: auto; border-radius: 4px; margin-top: 10px; }
    </style>
</head>
<body>

    <div class="sidebar d-flex flex-column">
        <div class="sidebar-header"><i class="fas fa-tools"></i> Admin Panel</div>
        <a href="index.php"><i class="fas fa-tachometer-alt fa-fw me-2"></i> Dashboard</a>
        <a href="../ppdb/admin.php"><i class="fas fa-users-cog fa-fw me-2"></i> PPDB</a>
        <div class="sidebar-header mt-3" style="font-size: 1rem;">Konten Website</div>
        <a href="profil_sekolah.php"><i class="fas fa-school fa-fw me-2"></i> Kelola Profil Sekolah</a>
        <a href="gallery.php" class="active"><i class="fas fa-images fa-fw me-2"></i> Kelola Gallery</a>
        <a href="kegiatan.php"><i class="fas fa-calendar-alt fa-fw me-2"></i> Kelola Kegiatan</a>
        <div class="mt-auto"> 
            <hr class="mx-3" style="border-color: rgba(255, 255, 255, 0.2);">
            <a href="logout.php" class="bg-danger text-white"><i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout</a>
        </div>
    </div>
    <div class="main-content">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-edit me-2"></i> Edit Gambar Gallery</h1>
        </div>
        
        <div class="mb-4">
             <a href="gallery.php" class="btn btn-secondary">
                 <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Gallery
             </a>
        </div>

        <div class="card shadow-lg">
            <div class="card-header bg-custom-teal text-white">
                <h5 class="mb-0">Mengubah Gambar #<?= $data_edit['id']; ?></h5>
            </div>
            <div class="card-body">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?= $data_edit['id']; ?>">
                    <input type="hidden" name="gambar_lama" value="<?= $data_edit['image']; ?>">
                    
                    <div class="mb-3">
                        <label for="caption" class="form-label">Keterangan (Caption):</label>
                        <input type="text" name="caption" id="caption" class="form-control" value="<?= htmlspecialchars($data_edit['caption']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Ganti Gambar (Kosongkan jika tidak ingin diubah):</label>
                        <input type="file" name="image" id="image" class="form-control">
                        
                        <?php if (!empty($data_edit['image'])): ?>
                            <p class="mt-2">Gambar saat ini:</p>
                            <img src="<?= htmlspecialchars($data_edit['image']); ?>" class="image-preview img-thumbnail" alt="Gambar Saat Ini">
                        <?php endif; ?>
                    </div>
                    
                    <button class="btn btn-warning" type="submit" name="submit">
                        <i class="fas fa-sync-alt me-1"></i> Update Gallery
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>