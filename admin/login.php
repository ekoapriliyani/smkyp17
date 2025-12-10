<?php
session_start();

// Jika ternyata user sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator | SMK YP 17</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Definisi Warna */
        :root {
            --teal-dark: #005959;
            --teal-light: #007d7d;
            --accent-color: #ffc107; /* Kuning/Yellow untuk kontras */
        }
        
        /* 1. PRELOADER STYLES */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--teal-dark);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Pastikan di atas semua elemen */
            transition: opacity 0.5s ease;
        }
        
        .spinner-border-custom {
            width: 3rem;
            height: 3rem;
            border: 0.35em solid var(--accent-color);
            border-right-color: transparent;
        }

        /* 2. BODY DAN LAYOUT STYLES (sama seperti sebelumnya) */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, var(--teal-dark) 0%, var(--teal-light) 100%);
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            margin: 0; 
            /* Sembunyikan konten utama saat preloader aktif */
            opacity: 0;
        }
        
        .login-container { 
            background: white; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3); 
            width: 100%; 
            max-width: 420px; 
            animation: fadeIn 1s ease-out;
        }

        .login-header {
            text-align: center; 
            margin-bottom: 30px; 
            color: var(--teal-dark);
        }
        .login-header h2 {
            font-weight: 700;
            margin-top: 10px;
        }
        .login-header i {
            font-size: 2.5rem;
            color: var(--accent-color);
        }
        
        .form-control:focus {
            border-color: var(--teal-light);
            box-shadow: 0 0 0 0.25rem rgba(0, 125, 125, 0.25);
        }
        
        .btn-custom {
            background-color: var(--teal-dark);
            border-color: var(--teal-dark);
            transition: background-color 0.3s, transform 0.2s;
            font-weight: 600;
        }
        .btn-custom:hover {
            background-color: var(--teal-light);
            border-color: var(--teal-light);
            transform: translateY(-2px);
            color: white;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div id="preloader">
    <div class="spinner-border text-warning spinner-border-custom" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<div class="login-container">
    
    <div class="login-header">
        <i class="fas fa-user-shield"></i>
        <h2>Admin Panel</h2>
        <p class="text-muted">SMK YP 17 Blitar</p>
    </div>
    
    <?php 
    if (isset($_GET['error']) && $_GET['error'] == 'gagal') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> Username atau **Password salah!**
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    ?>

    <form action="login_proses.php" method="POST"> 
        <div class="mb-3">
            <label for="username" class="form-label text-muted"><i class="fas fa-user me-2"></i> Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
        </div>
        <div class="mb-4">
            <label for="password" class="form-label text-muted"><i class="fas fa-lock me-2"></i> Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
        </div>
        
        <button type="submit" name="submit" class="btn btn-custom text-white w-100 py-2">
            <i class="fas fa-sign-in-alt me-2"></i> LOGIN
        </button>
    </form>
    
    <div class="text-center mt-4">
        <small class="text-muted">&copy; 2025 SMK YP 17 Blitar</small>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
    // JAVASCRIPT UNTUK MENGHILANGKAN PRELOADER
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        const body = document.body;

        // 1. Sembunyikan preloader dengan fade out (mengubah opacity)
        preloader.style.opacity = '0';
        
        // 2. Setelah transisi selesai (500ms), sembunyikan sepenuhnya (display: none)
        //    dan tampilkan konten body (opacity: 1)
        setTimeout(function() {
            preloader.style.display = 'none';
            body.style.opacity = '1';
        }, 500); 
    });
</script>
</body>
</html>