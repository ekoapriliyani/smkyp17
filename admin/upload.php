<?php
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

if (isset($_POST['submit'])) {
    $caption = $_POST['caption'];
    $target_dir = "uploads/";
    
    // --- START: MODIFIKASI UNTUK NAMA FILE UNIK ---
    
    // Ambil ekstensi file asli (contoh: jpg, png)
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

    // Buat nama file baru yang unik menggunakan uniqid() dan time()
    // Format: [unique_id]_[timestamp].[ekstensi]
    $new_file_name = uniqid('img_', true) . '_' . time() . '.' . $imageFileType;
    
    // Definisikan path file tujuan yang baru
    $target_file = $target_dir . $new_file_name;
    
    // --- END: MODIFIKASI UNTUK NAMA FILE UNIK ---


    // Check if file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        // Tambahkan pengalihan error yang lebih baik
        header('location:gallery.php?error=not_image');
        exit;
    }

    // Check file size (limit to 9MB)
    if ($_FILES["image"]["size"] > 9000000) {
        header('location:gallery.php?error=file_too_large');
        exit;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        header('location:gallery.php?error=invalid_format');
        exit;
    }

    // Cek apakah direktori 'uploads' sudah ada. Jika belum, buat.
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Pindahkan file yang di-upload
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert into database
        // Gunakan Prepared Statement untuk keamanan! (Sangat disarankan)
        $stmt = $conn->prepare("INSERT INTO gallery (image, caption) VALUES (?, ?)");
        $stmt->bind_param("ss", $target_file, $caption); 

        if ($stmt->execute()) {
            // Sukses, arahkan kembali ke gallery
            header('location:gallery.php?status=success');
        } else {
            // Error database
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Error saat memindahkan file
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
// Tidak ada tag penutup ?>