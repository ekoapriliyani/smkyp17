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
    <title>Login Administrator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        /* Menggunakan warna teal gelap untuk konsistensi */
        .bg-custom-teal {
            background-color: #005959; 
        }
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .login-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #005959; margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login Admin SMK YP 17</h2>
    
    <?php 
    if (isset($_GET['error']) && $_GET['error'] == 'gagal') {
        echo '<div class="alert alert-danger" role="alert">Username atau Password salah!</div>';
    }
    ?>

    <form action="login_proses.php" method="POST"> 
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="submit" class="btn bg-custom-teal text-white w-100">LOGIN</button>
    </form>
</div>

</body>
</html>