<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "../koneksi.php"; 

if (isset($_POST['submit'])) {
    
    // Ambil data dari form
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $sejarah = $_POST['sejarah'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $id = 1; // ID selalu 1

    // Gunakan Prepared Statement untuk UPSERT (Update/Insert)
    // Jika ID 1 sudah ada (DUPLICATE KEY), maka UPDATE, jika belum ada, maka INSERT
    $sql = "INSERT INTO tbl_profil_sekolah (id, visi, misi, sejarah, alamat, email, telepon) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            visi = VALUES(visi), 
            misi = VALUES(misi), 
            sejarah = VALUES(sejarah), 
            alamat = VALUES(alamat), 
            email = VALUES(email), 
            telepon = VALUES(telepon)";

    $stmt = $conn->prepare($sql);
    // Tipe data: integer (id) dan string (visi, misi, sejarah, alamat, email, telepon)
    $stmt->bind_param("issssss", $id, $visi, $misi, $sejarah, $alamat, $email, $telepon); 

    if ($stmt->execute()) {
        header('location:profil_sekolah.php?status=success');
    } else {
        header('location:profil_sekolah.php?status=error');
    }
    
    $stmt->close();
}

$conn->close();
// Tidak ada tag penutup ?>