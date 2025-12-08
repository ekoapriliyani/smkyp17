<?php
include "header.html";
include "functions.php";

// 1. Ambil Nomor Registrasi dari URL
if (!isset($_GET['no_reg']) || empty($_GET['no_reg'])) {
    // Jika tidak ada nomor registrasi, kembalikan ke halaman daftar
    header("Location: index.php");
    exit;
}

$nomor_registrasi = $_GET['no_reg'];

// 2. Ambil data siswa berdasarkan Nomor Registrasi
// Sanitasi input sebelum digunakan dalam query (pencegahan SQL Injection)
$nomor_registrasi_safe = mysqli_real_escape_string($conn, $nomor_registrasi);

$query_siswa = "SELECT * FROM tbl_siswa WHERE nomor_registrasi = '{$nomor_registrasi_safe}'";
$siswa = query($query_siswa);

if (empty($siswa)) {
    echo "
        <div class='container mt-5'>
            <div class='alert alert-danger'>Data pendaftaran tidak ditemukan atau sudah diverifikasi.</div>
            <a href='index.php' class='btn btn-primary'>Kembali ke Pendaftaran</a>
        </div>";
    include "footer.html"; // Asumsi Anda punya footer.html
    exit;
}

// Data ditemukan, ambil baris pertama
$data_siswa = $siswa[0];

// Fungsi untuk konversi nama jurusan (opsional, untuk tampilan lebih bagus)
function get_jurusan_name($kode) {
    $jurusan_map = [
        'TKR' => 'Teknik Kendaraan Ringan',
        'TEI' => 'Teknik Elektronika Industri',
        'TSM' => 'Teknik Sepeda Motor',
        'TKJ' => 'Teknik Komputer Jaringan',
        'DKV' => 'Desain Komunikasi Visual',
        '--Pilih Jurusan 1--' => '-'
    ];
    return $jurusan_map[$kode] ?? $kode;
}
?>

<div class="container mt-4">
    <img src="kop.png" alt="kop" width="100%">
    <h2 class="text-center mt-3 text-primary">Bukti Pendaftaran Calon Siswa</h2>
    <p class="text-center lead">Harap simpan atau cetak bukti ini sebagai dokumen pendaftaran Anda.</p>
    <hr>
    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-id-card me-2"></i> Data Pendaftaran Anda</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless table-sm">
                        <tr><th>No. Registrasi</th><td>:</td><td><strong><?= htmlspecialchars($data_siswa['nomor_registrasi']); ?></strong></td></tr>
                        <tr><th>Nama Lengkap</th><td>:</td><td><?= htmlspecialchars($data_siswa['nama']); ?></td></tr>
                        <tr><th>Asal Sekolah</th><td>:</td><td><?= htmlspecialchars($data_siswa['asal']); ?></td></tr>
                        <tr><th>Tempat, Tgl Lahir</th><td>:</td><td><?= htmlspecialchars($data_siswa['tempat_lahir'] . ', ' . $data_siswa['tgl_lahir']); ?></td></tr>
                        <tr><th>Alamat</th><td>:</td><td><?= htmlspecialchars($data_siswa['alamat']); ?></td></tr>
                        <tr><th>No. HP/WA</th><td>:</td><td><?= htmlspecialchars($data_siswa['no_hp']); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless table-sm">
                        <tr><th>Jurusan Pilihan 1</th><td>:</td><td><?= get_jurusan_name(htmlspecialchars($data_siswa['jurusan1'])); ?></td></tr>
                        <tr><th>Jurusan Pilihan 2</th><td>:</td><td><?= get_jurusan_name(htmlspecialchars($data_siswa['jurusan2'])); ?></td></tr>
                        <tr><th>Penerima Bantuan</th><td>:</td><td><?= htmlspecialchars($data_siswa['penerima_bantuan']); ?></td></tr>
                        <tr><th>Nama Ayah</th><td>:</td><td><?= htmlspecialchars($data_siswa['nama_ayah']); ?></td></tr>
                        <tr><th>Nama Ibu</th><td>:</td><td><?= htmlspecialchars($data_siswa['nama_ibu']); ?></td></tr>
                        <tr><th>Tgl Daftar</th><td>:</td><td><?= htmlspecialchars($data_siswa['tgl_daftar']); ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-center mb-5 print-hide">
        <button onclick="window.print()" class="btn btn-lg btn-success me-3">
            <i class="fas fa-print me-2"></i> Cetak / Unduh Bukti Pendaftaran
        </button>
        <a href="index.php" class="btn btn-lg btn-secondary">
            <i class="fas fa-home me-2"></i> Kembali ke Beranda
        </a>
    </div>

    <img src="footer_ppdb.png" alt="kop" width="100%">
</div>

<style>
/* CSS untuk menyembunyikan elemen saat dicetak */
@media print {
    .print-hide, .navbar, .container:first-child > img:first-child { /* Asumsi navbar perlu disembunyikan */
        display: none !important;
    }
    body { 
        padding-top: 0 !important; /* Hapus padding body jika ada */
        margin: 0 !important;
    }
    .container {
        width: 100% !important;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<?php 
// include "footer.html"; 
?>