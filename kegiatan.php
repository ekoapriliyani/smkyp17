<?php 
// Asumsi file ini berada di root PPDB (SMKYP17/kegiatan.php)
include "header.html"; 
include "ppdb/functions.php"; // Diperlukan untuk koneksi database dan fungsi query
?>
<?php include "navbar.html" ?>

<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary"><i class="fas fa-camera-retro me-2"></i>Kegiatan / Agenda Sekolah</h2>
    <hr>

    <?php
    // Query data kegiatan, diurutkan berdasarkan tanggal_kegiatan terbaru
    $kegiatan = query("SELECT * FROM tbl_kegiatan ORDER BY tanggal_kegiatan DESC");

    // Direktori root (untuk pengecekan file_exists)
    $root_dir = __DIR__ . '/admin/'; // Mengarahkan ke root folder admin

    if (empty($kegiatan)) {
        echo '<div class="alert alert-warning text-center" role="alert">
                Belum ada data kegiatan yang diunggah saat ini.
              </div>';
    } else {
        echo '<div class="row">';
        
        foreach ($kegiatan as $row) {
            
            // ASUMSI BARU: Kolom 'gambar' sudah berisi path relatif LENGKAP dari folder 'admin'
            // Contoh: 'uploads/kegiatan/namafile.jpg'
            
            $gambar_path_db = $row['gambar'];
            
            // Path URL yang digunakan di tag <img> (Relatif dari kegiatan.php)
            // Karena kegiatan.php dan folder admin sejajar, kita tambahkan prefix 'admin/'
            $image_path_url  = 'admin/' . $gambar_path_db; 
            
            // Path Absolut untuk pengecekan file_exists() (Relatif dari root server PHP)
            $image_path_file = $root_dir . $gambar_path_db; 

            $judul      = htmlspecialchars($row['judul']);
            $deskripsi  = htmlspecialchars($row['deskripsi']);
            $tanggal    = date('d F Y', strtotime($row['tanggal_kegiatan'])); 
            
            echo '
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    ';
            
            // Pengecekan Keberadaan File
            if (file_exists($image_path_file) && !is_dir($image_path_file)) {
                // Jika file ditemukan secara fisik, gunakan path URL
                echo '<img src="' . $image_path_url . '" class="card-img-top" alt="' . $judul . '" style="height: 200px; object-fit: cover;">';
                
            } else {
                // Tampilkan Placeholder (untuk debugging)
                echo '<div style="height: 200px; background-color: #f8d7da; color: #721c24; display: flex; align-items: center; justify-content: center; text-align: center; border-bottom: 2px solid #dc3545;">
                        <small>DEBUG: File tidak ditemukan di path: ' . $image_path_file . '</small>
                      </div>';
            }

            echo '
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-success">' . $judul . '</h5>
                        <p class="card-text flex-grow-1">' . substr($deskripsi, 0, 100) . '...</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> ' . $tanggal . '</small>
                    </div>
                </div>
            </div>
            ';
        }

        echo '</div>'; // Tutup row
    }
    ?>
</div>

<?php include "footer.html" ?>