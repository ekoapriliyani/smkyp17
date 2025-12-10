<?php
include "header.html";
include "functions.php";

// 1. Ambil Nomor Registrasi dari URL
if (!isset($_GET['no_reg']) || empty($_GET['no_reg'])) {
    header("Location: index.php");
    exit;
}

$nomor_registrasi = $_GET['no_reg'];

// 2. Ambil data siswa berdasarkan Nomor Registrasi
$nomor_registrasi_safe = mysqli_real_escape_string($conn, $nomor_registrasi);
$query_siswa = "SELECT * FROM tbl_siswa WHERE nomor_registrasi = '{$nomor_registrasi_safe}'";
$siswa = query($query_siswa);

if (empty($siswa)) {
    echo "
        <div class='container mt-5'>
            <div class='alert alert-danger'>Data pendaftaran tidak ditemukan.</div>
            <a href='index.php' class='btn btn-primary'>Kembali ke Pendaftaran</a>
        </div>";
    include "footer.html";
    exit;
}

$data_siswa = $siswa[0];

// Fungsi untuk konversi nama jurusan
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

<style>
.pdf-data-table th {
    width: 30%; 
    padding-right: 10px;
}

#pdf-content {
    padding: 20px;
    margin: auto;
    max-width: 800px;
}
.pdf-title {
    color: #005959; 
    font-size: 1.5rem;
    margin-top: 10px;
    margin-bottom: 5px;
}
.pdf-card-header {
    background-color: #007bff !important;
    color: white !important;
    padding: 8px 15px;
    font-weight: bold;
}
.tanda-tangan {
    margin-top: 50px;
    padding-left: 60%; 
    text-align: center;
}
</style>

<div class="container mt-4" id="pdf-content"> 
    <h3 class="text-center pdf-title">Bukti Pendaftaran Calon Siswa</h3>
    <p class="text-center lead">Harap simpan bukti ini untuk kelengkapan administrasi.</p>
    <hr>
    
    <div class="card shadow-sm mb-4 border-0">
        <div class="pdf-card-header">
            <i class="fas fa-id-card me-2"></i> Data Pendaftaran Anda
        </div>
        <div class="card-body">
            <table class="table table-borderless table-sm pdf-data-table">
                <tbody>
                    <tr><th>No. Registrasi</th><td>:</td><td><strong><?= htmlspecialchars($data_siswa['nomor_registrasi']); ?></strong></td></tr>
                    <tr><th>Nama Lengkap</th><td>:</td><td><?= htmlspecialchars($data_siswa['nama']); ?></td></tr>
                    <tr><th>Asal Sekolah</th><td>:</td><td><?= htmlspecialchars($data_siswa['asal']); ?></td></tr>
                    <tr><th>Tempat, Tgl Lahir</th><td>:</td><td><?= htmlspecialchars($data_siswa['tempat_lahir'] . ', ' . $data_siswa['tgl_lahir']); ?></td></tr>
                    <tr><th>Alamat</th><td>:</td><td><?= htmlspecialchars($data_siswa['alamat']); ?></td></tr>
                    <tr><th>No. HP/WA</th><td>:</td><td><?= htmlspecialchars($data_siswa['no_hp']); ?></td></tr>
                    <tr><th>Email</th><td>:</td><td><?= htmlspecialchars($data_siswa['email']); ?></td></tr>
                    
                    <tr><td colspan="3"><hr></td></tr>

                    <tr><th>Jurusan Pilihan 1</th><td>:</td><td><?= get_jurusan_name(htmlspecialchars($data_siswa['jurusan1'])); ?></td></tr>
                    <tr><th>Jurusan Pilihan 2</th><td>:</td><td><?= get_jurusan_name(htmlspecialchars($data_siswa['jurusan2'])); ?></td></tr>
                 </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container text-center mb-5 mt-4 download-button-area">
    <button id="download-btn" class="btn btn-lg btn-success me-3">
        <i class="fas fa-file-pdf me-2"></i> Unduh Bukti Pendaftaran (PDF)
    </button>
    <a href="index.php" class="btn btn-lg btn-secondary">
        <i class="fas fa-home me-2"></i> Kembali ke Beranda
    </a>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
document.getElementById('download-btn').addEventListener('click', function () {
    const element = document.getElementById('pdf-content');
    const filename = 'Bukti_Pendaftaran_<?= htmlspecialchars($data_siswa['nomor_registrasi']); ?>.pdf';
    
    // Konfigurasi untuk PDF
    const opt = {
        // Mengurangi margin agar konten lebih besar di A4
        margin:       [5, 5, 5, 5], 
        filename:     filename,
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { 
            scale: 2, 
            logging: false, 
            dpi: 192, 
            letterRendering: true 
        },
        // Mengatur format A4 dan orientasi portrait
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' } 
    };

    // Panggil fungsi konversi dan simpan
    html2pdf().set(opt).from(element).save();
    
    // Sembunyikan tombol download selama proses konversi (opsional)
    document.querySelector('.download-button-area').style.display = 'none';
    
    // Tampilkan kembali setelah 5 detik
    setTimeout(function() {
        document.querySelector('.download-button-area').style.display = 'block';
    }, 5000);
});
</script>

<?php 
include "footer.html"; 
?>