<?php
// Pastikan file functions.php sudah disertakan jika ada pengecekan login di dalamnya
include "functions.php";

// Tentukan lokasi file
$file = 'ppdb/panduan-ppdb-smkyp17.pdf';
$filepath = __DIR__ . '/' . $file; // __DIR__ merujuk pada direktori file panduan.php (yaitu ppdb/)

// Cek apakah file benar-benar ada
if (file_exists($filepath)) {
    // Terapkan header untuk memaksa download
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf'); // Tipe file PDF
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    
    // Hapus buffering output
    ob_clean();
    flush();
    
    // Baca file dan kirim ke output
    readfile($filepath);
    exit;
} else {
    // Jika file tidak ditemukan, beri pesan error
    echo "<h1>Error 404: File panduan tidak ditemukan!</h1>";
    echo "<p>Pastikan file PDF bernama 'panduan-ppdb-smkyp17.pdf' ada di folder ppdb.</p>";
    exit;
}
?>