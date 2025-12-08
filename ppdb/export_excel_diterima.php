<?php
// Pastikan file functions.php sudah disertakan untuk koneksi database
include "functions.php";

// Pastikan hanya user yang sudah login yang bisa mengakses file ini
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 1. HEADER UNTUK MENGATUR OUTPUT SEBAGAI FILE EXCEL (CSV)
$filename = "siswa_diterima_" . date('Ymd_His') . ".csv";

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");

// 2. AMBIL DATA DARI DATABASE
$query = "SELECT * FROM tbl_siswa_verifikasi ORDER BY tgl_verifikasi DESC";
$data_siswa = query($query);

// 3. MENULIS DATA KE OUTPUT
$output = fopen("php://output", "w");

// A. TULIS JUDUL/HEADER KOLOM
$header = array(
    'No. Registrasi', 
    'Nama Lengkap', 
    'Asal Sekolah', 
    'Tempat Lahir', 
    'Tanggal Lahir', 
    'Alamat', 
    'No. HP/WA', 
    'Email', 
    'Jurusan Pilihan 1', 
    'Jurusan Pilihan 2', 
    'Penerima Bantuan', 
    'Nama Ayah', 
    'Nama Ibu', 
    'Tanggal Daftar',
    'Tanggal Verifikasi'
);

// Tulis header ke file CSV
fputcsv($output, $header, ';'); // Menggunakan titik koma (;) sebagai delimiter

// B. TULIS DATA PER BARIS
foreach ($data_siswa as $row) {
    
    // Pastikan urutan data sesuai dengan header di atas
    $row_output = array(
        $row['nomor_registrasi'],
        $row['nama'],
        $row['asal'],
        $row['tempat_lahir'],
        $row['tgl_lahir'],
        $row['alamat'],
        $row['no_hp'],
        $row['email'],
        $row['jurusan1'],
        $row['jurusan2'],
        $row['penerima_bantuan'],
        $row['nama_ayah'],
        $row['nama_ibu'],
        $row['tgl_daftar'],
        $row['tgl_verifikasi'] // Pastikan kolom ini ada di tbl_siswa_verifikasi
    );
    
    // Tulis baris data ke file CSV
    fputcsv($output, $row_output, ';');
}

// 4. TUTUP OUTPUT
fclose($output);
exit();
?>