<?php
// Mulai sesi
session_start();

// Cek apakah form sudah disubmit
if (isset($_POST['submit'])) {
    
    // --- Konfigurasi Koneksi Database (HARUS DIGANTI) ---
    $host = "localhost";
    $dbuser = "root";
    $dbpass = "Eko123$";
    $dbname = "dbsmkyp17"; // <<< GANTI DENGAN NAMA DATABASE ANDA

    // Buat koneksi
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        // Hentikan dan tampilkan pesan error jika koneksi gagal
        die("Koneksi database gagal: " . $conn->connect_error);
    }
    
    // Ambil dan bersihkan data dari form
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Gunakan Prepared Statement (Asumsi tabel: user_admin)
    $stmt = $conn->prepare("SELECT password, nama_lengkap FROM user_admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    // Ambil hasilnya
    $result = $stmt->get_result();

    // 1. Cek apakah username ditemukan
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // 2. Verifikasi Password (menggunakan password_verify untuk password yang di-hash)
        if (password_verify($password, $row['password'])) {
            
            // --- Login Berhasil! ---
            
            // Set session
            $_SESSION['username'] = $row['nama_lengkap']; // Simpan nama lengkap admin
            $_SESSION['login'] = true; 
            
            // Arahkan ke halaman utama dashboard (index.php)
            header("Location: index.php"); 
            exit();
            
        } else {
            // Password salah
            header("Location: login.php?error=gagal");
            exit();
        }
    } else {
        // Username tidak ditemukan
        header("Location: login.php?error=gagal");
        exit();
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

} else {
    // Jika diakses tanpa submit form, arahkan kembali ke halaman login
    header("Location: login.php");
    exit();
} 
?>