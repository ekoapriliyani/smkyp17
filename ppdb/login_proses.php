<?php
// Mulai sesi untuk menyimpan status login
session_start();

// Cek apakah data form sudah dikirim melalui metode POST
if (isset($_POST['submit'])) {
    
    // Konfigurasi Koneksi Database (GANTI SESUAI LINGKUNGAN ANDA!)
    $host = "localhost";
    $dbuser = "root";
    $dbpass = "Eko123$";
    $dbname = "dbsmkyp17"; // <<< GANTI DENGAN NAMA DATABASE ANDA

    // Buat koneksi
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }
    
    // Ambil dan bersihkan data dari form
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Gunakan Prepared Statement untuk keamanan dari SQL Injection
    // Asumsi: Tabel admin Anda bernama 'user_admin'
    $stmt = $conn->prepare("SELECT username, password, nama_lengkap FROM user_admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    // Ambil hasilnya
    $result = $stmt->get_result();

    // Cek apakah ada baris yang ditemukan
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // Verifikasi Password (PENTING: menggunakan password_verify untuk password yang di-hash)
        if (password_verify($password, $row['password'])) {
            
            // Login Berhasil!
            
            // Set session
            $_SESSION['username'] = $row['nama_lengkap']; // Simpan nama pengguna untuk tampilan
            $_SESSION['login'] = true; // Tambahkan penanda bahwa sesi sudah login
            
            // Arahkan ke halaman admin
            header("Location: admin.php");
            exit();
            
        } else {
            // Password salah
            header("Location: admin.php?error=gagal");
            exit();
        }
    } else {
        // Username tidak ditemukan
        header("Location: admin.php?error=gagal");
        exit();
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

} else {
    // Jika diakses tanpa submit form, arahkan kembali ke halaman login
    header("Location: admin.php");
    exit();
}
?>