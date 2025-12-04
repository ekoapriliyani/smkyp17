<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "../koneksi.php"; 
// Asumsi $conn adalah objek koneksi mysqli dari koneksi.php

// Tentukan direktori upload untuk kegiatan
$target_dir = "uploads/kegiatan/";

if (isset($_POST['action']) && $_POST['action'] == 'insert') {
    
    $judul = $_POST['judul'];
    $tanggal_kegiatan = $_POST['tanggal_kegiatan'];
    $deskripsi = $_POST['deskripsi'];
    
    // ----------------------------------------------------
    // PROSES UPLOAD GAMBAR
    // ----------------------------------------------------
    if (!empty($_FILES["gambar"]["name"])) {
        
        $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
        $new_file_name = 'keg_' . uniqid('', true) . '_' . time() . '.' . $imageFileType;
        $target_file = $target_dir . $new_file_name;
        
        // Cek ekstensi dan ukuran (Sama seperti Gallery)
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check === false) {
            header('location:kegiatan.php?error=not_image');
            exit;
        }
        if ($_FILES["gambar"]["size"] > 5000000) { // Batas 5MB
            header('location:kegiatan.php?error=file_too_large');
            exit;
        }
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            header('location:kegiatan.php?error=invalid_format');
            exit;
        }

        // Pastikan direktori ada
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Pindahkan file
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $gambar_path = $target_file;
        } else {
            header('location:kegiatan.php?error=upload_failed');
            exit;
        }
        
    } else {
        $gambar_path = null;
    }
    
    // ----------------------------------------------------
    // INSERT KE DATABASE
    // ----------------------------------------------------
    $stmt = $conn->prepare("INSERT INTO tbl_kegiatan (judul, deskripsi, tanggal_kegiatan, gambar) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $judul, $deskripsi, $tanggal_kegiatan, $gambar_path); 

    if ($stmt->execute()) {
        header('location:kegiatan.php?status=success');
    } else {
        // Error database
        header('location:kegiatan.php?error=db_error');
    }
    $stmt->close();
    
} 
// ----------------------------------------------------
// LOGIKA HAPUS DATA
// ----------------------------------------------------
elseif (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    
    $id = $_GET['id'];
    
    // 1. Ambil path gambar untuk dihapus dari server
    $stmt = $conn->prepare("SELECT gambar FROM tbl_kegiatan WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row && !empty($row['gambar']) && file_exists($row['gambar'])) {
        unlink($row['gambar']); // Hapus file fisik
    }

    // 2. Hapus data dari tabel
    $stmt = $conn->prepare("DELETE FROM tbl_kegiatan WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('location:kegiatan.php?status=deleted');
    } else {
        header('location:kegiatan.php?error=db_error_delete');
    }
    $stmt->close();
}


$conn->close();
// Tidak ada tag penutup ?>