<?php
// Mulai sesi dan cek login (WAJIB DITAMBAHKAN)
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Konfigurasi Koneksi Database
$servername = "localhost";
$username = "root";
$password = "Eko123$";
$dbname = "dbsmkyp17";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tentukan direktori upload
$target_dir = "uploads/";

// ----------------------------------------------------------------------
// LOGIKA UTAMA: INSERT atau UPDATE (dari form POST)
// ----------------------------------------------------------------------
if (isset($_POST['submit'])) {
    
    // Tentukan aksi: 'update' jika ada dari edit_gallery.php, atau 'insert'
    $action = $_POST['action'] ?? 'insert'; 
    $caption = $_POST['caption'];
    
    // Variabel yang dibutuhkan untuk UPDATE
    $id = $_POST['id'] ?? null;
    $gambar_lama = $_POST['gambar_lama'] ?? null;
    $gambar_path = $gambar_lama; // Default menggunakan gambar lama

    // ----------------------------------------------------
    // PROSES UPLOAD GAMBAR BARU (JIKA ADA)
    // ----------------------------------------------------
    // Cek apakah file baru di-upload (Hanya jika error UPLOAD_ERR_NO_FILE tidak terjadi)
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] !== UPLOAD_ERR_NO_FILE && $_FILES["image"]["name"] !== "") {
        
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_file_name = uniqid('img_', true) . '_' . time() . '.' . $imageFileType;
        $target_file = $target_dir . $new_file_name;
        
        // Pengecekan Keamanan File
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            header('location:gallery.php?error=not_image');
            exit;
        }
        if ($_FILES["image"]["size"] > 9000000) {
            header('location:gallery.php?error=file_too_large');
            exit;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            header('location:gallery.php?error=invalid_format');
            exit;
        }
        
        // Cek apakah direktori 'uploads' sudah ada. Jika belum, buat.
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Pindahkan file baru
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $gambar_path = $target_file;
            
            // Jika ini aksi update dan ada gambar lama, HAPUS GAMBAR LAMA
            if ($action == 'update' && !empty($gambar_lama) && file_exists($gambar_lama)) {
                unlink($gambar_lama); 
            }
        } else {
            // Error saat memindahkan file
            header('location:gallery.php?error=upload_failed');
            exit;
        }
    }
    // Jika tidak ada file baru di-upload, $gambar_path tetap berisi $gambar_lama (saat update)
    // atau tetap null (saat insert, yang seharusnya tidak terjadi karena required)


    // ----------------------------------------------------
    // EKSEKUSI DATABASE
    // ----------------------------------------------------
    if ($action == 'insert') {
        // Aksi INSERT (Tambah Gambar Baru)
        $stmt = $conn->prepare("INSERT INTO gallery (image, caption) VALUES (?, ?)");
        $stmt->bind_param("ss", $gambar_path, $caption); 

        if ($stmt->execute()) {
            header('location:gallery.php?status=success');
        } else {
            echo "Error INSERT: " . $stmt->error;
        }
        $stmt->close();
        
    } elseif ($action == 'update') {
        // Aksi UPDATE (Edit Gambar)
        $stmt = $conn->prepare("UPDATE gallery SET image = ?, caption = ? WHERE id = ?");
        // Jika tidak ada gambar baru di-upload, $gambar_path masih berisi gambar lama (dari hidden input)
        $stmt->bind_param("ssi", $gambar_path, $caption, $id); 

        if ($stmt->execute()) {
            header('location:gallery.php?status=updated');
        } else {
            echo "Error UPDATE: " . $stmt->error;
        }
        $stmt->close();
    }
} 

// ----------------------------------------------------------------------
// LOGIKA HAPUS DATA (Biasanya di file terpisah, tapi bisa dimasukkan di sini)
// ----------------------------------------------------------------------
elseif (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    
    $id = $_GET['id'];
    
    // 1. Ambil path gambar untuk dihapus dari server
    $stmt = $conn->prepare("SELECT image FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row && !empty($row['image']) && file_exists($row['image'])) {
        unlink($row['image']); // Hapus file fisik
    }

    // 2. Hapus data dari tabel
    $stmt = $conn->prepare("DELETE FROM tbl_gallery WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('location:gallery.php?status=deleted');
    } else {
        header('location:gallery.php?error=db_error_delete');
    }
    $stmt->close();
}


$conn->close();
// Tidak ada tag penutup ?>