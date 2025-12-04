<?php
// HARUS ADA DI BARIS PERTAMA
session_start();

// Hapus semua variabel sesi yang terdaftar
$_SESSION = array(); 
// Alternatif: session_unset();

// Hancurkan sesi di server
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Arahkan pengguna kembali ke halaman login.php
header("Location: login.php?status=logout");
exit();
// Disarankan TIDAK menggunakan tag penutup ?> di akhir file PHP