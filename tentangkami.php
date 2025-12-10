<?php 
include "header.html"; 
include "ppdb/functions.php"; 
?>
<?php include "navbar.html" ?>

<?php
// 1. Query data dari tbl_profil_sekolah
$profil = query("SELECT visi, misi, sejarah, alamat, email, telepon FROM tbl_profil_sekolah LIMIT 1");

// Cek apakah data ditemukan
if (empty($profil)) {
    $data_sekolah = [
        'visi' => 'Visi belum diatur.',
        'misi' => 'Misi belum diatur.',
        'sejarah' => 'Sejarah belum diatur.',
        'alamat' => 'Alamat belum diatur.',
        'email' => 'Email belum diatur.',
        'telepon' => 'Telepon belum diatur.',
    ];
} else {
    // Ambil baris pertama (dan satu-satunya) data
    $data_sekolah = $profil[0];
}
?>

<style>
    /* Styling untuk membuat tabel kontak lebih elegan */
    .contact-info-table th {
        width: 150px;
        color: #007bff; /* Warna biru untuk label */
    }
    .contact-info-table td {
        font-weight: 500;
    }
    .card-header-custom {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); /* Gradasi biru gelap */
        color: white;
        border-radius: 0.3rem 0.3rem 0 0 !important;
        padding: 1rem 1.25rem;
    }
    .card-title-custom {
        font-weight: 600;
    }
    .history-text {
        line-height: 1.8;
        font-size: 1.05rem;
        color: #333;
    }
</style>

<div class="container mt-5 mb-5">
    <h1 class="text-center mb-5 text-dark"><i class="fas fa-building me-2"></i> Mengenal Lebih Dekat SMK YP 17</h1>
    
    <div class="card shadow-lg mb-5 border-0">
        <div class="card-header-custom">
            <h4 class="mb-0 card-title-custom"><i class="fas fa-eye me-2"></i> Visi</h4>
        </div>
        <div class="card-body p-4">
            <p class="history-text"><?= nl2br(htmlspecialchars($data_sekolah['visi'])); ?></p>
        </div>
    </div>

    <div class="card shadow-lg mb-5 border-0">
        <div class="card-header-custom" style="background: linear-gradient(135deg, #0f9b8e 0%, #17a2b8 100%);">
            <h4 class="mb-0 card-title-custom"><i class="fas fa-rocket me-2"></i> Misi</h4>
        </div>
        <div class="card-body p-4">
            <p class="history-text"><?= nl2br(htmlspecialchars($data_sekolah['misi'])); ?></p>
        </div>
    </div>

    <div class="card shadow-lg mb-5 border-0">
        <div class="card-header-custom" style="background: linear-gradient(135deg, #343a40 0%, #6c757d 100%);">
            <h4 class="mb-0 card-title-custom"><i class="fas fa-book me-2"></i> Sejarah Singkat</h4>
        </div>
        <div class="card-body p-4">
            <p class="history-text" style="text-align: justify;"><?= nl2br(htmlspecialchars($data_sekolah['sejarah'])); ?></p>
        </div>
    </div>

    <div class="card shadow-lg mb-5 border-0">
        <div class="card-header-custom" style="background: linear-gradient(135deg, #dc3545 0%, #ffc107 100%);">
            <h4 class="mb-0 card-title-custom"><i class="fas fa-phone-square-alt me-2"></i> Kontak & Informasi</h4>
        </div>
        <div class="card-body p-4">
            <table class="table table-borderless contact-info-table">
                <tbody>
                    <tr>
                        <th><i class="fas fa-map-marked-alt me-2"></i> Alamat</th>
                        <td>:</td>
                        <td><?= htmlspecialchars($data_sekolah['alamat']); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-envelope-open-text me-2"></i> Email</th>
                        <td>:</td>
                        <td><a href="mailto:<?= htmlspecialchars($data_sekolah['email']); ?>" class="text-decoration-none"><?= htmlspecialchars($data_sekolah['email']); ?></a></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-headset me-2"></i> Telepon</th>
                        <td>:</td>
                        <td><?= htmlspecialchars($data_sekolah['telepon']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "footer.html" ?>