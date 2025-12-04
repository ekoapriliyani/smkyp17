<?php
// 1. Mulai sesi
session_start();

// 2. Hapus semua variabel sesi yang terdaftar
session_unset();

// 3. Hancurkan sesi yang sedang berjalan
session_destroy();

// 4. Arahkan pengguna kembali ke halaman login (admin.php)
// Pastikan tidak ada output sebelum baris ini
header("Location: ../admin/login.php?status=logout");
exit();
// TIDAK ADA TAG PENUTUP ?> 
