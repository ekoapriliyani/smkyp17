<?php
// 1. MEMULAI SESI
session_start();

// PASTIKAN FILE functions.php ADA DAN BENAR
include "functions.php"; 

// 2. CEK APAKAH SUDAH LOGIN
if (!isset($_SESSION['username'])) {
    // ----------------------------------------------------
    // JIKA BELUM LOGIN, TAMPILKAN FORM LOGIN
    // ----------------------------------------------------
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .login-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #007bff; margin-bottom: 20px; }
        .error { color: red; text-align: center; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login Admin PPDB</h2>
    
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
        <button type="submit" name="submit" class="btn btn-primary w-100">LOGIN</button>
    </form>
</div>

</body>
</html>

<?php
// Hentikan eksekusi script. Konten admin di bawah tidak akan dijalankan.
exit(); 
}

// ----------------------------------------------------
// JIKA SUDAH LOGIN, LANJUTKAN KE KONTEN ADMIN
// ----------------------------------------------------

// Lanjutkan dengan kode admin Anda
$siswa = query("SELECT * FROM tbl_siswa");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <title>Data Siswa</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-navbar sticky-top shadow" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Data Calon Siswa SMK YP 17 Blitar (Login sebagai: <?php echo $_SESSION['username']; ?>)</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin.php">Calon Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="siswa_diterima.php">Siswa Diterima</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="siswa_ditolak.php">Siswa Tidak Diterima</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger ms-3" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <table class="table table-striped" id="example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Reg</th>
                    <th>Nama Siswa</th>
                    <th>Asal Sekolah</th>
                    <th>Tempat Lahir</th>
                    <th>Tgl Lahir</th>
                    <th>Alamat</th>
                    <th>Jurusan 1</th>
                    <th>Jurusan 2</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($siswa as $row): ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $row["nomor_registrasi"]; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["asal"]; ?></td>
                        <td><?= $row["tempat_lahir"]; ?></td>
                        <td><?= $row["tgl_lahir"]; ?></td>
                        <td><?= $row["alamat"]; ?></td>
                        <td><?= $row["jurusan1"]; ?></td>
                        <td><?= $row["jurusan2"]; ?></td>
                        <td>
                            <a href="verifikasi.php?id=<?= $row["id"]; ?>" class="btn btn-warning btn-sm">Verifikasi</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script>
        // Pastikan DataTable hanya diinisialisasi jika elemen #example ada (hanya saat login berhasil)
        $(document).ready(function() {
            if ($('#example').length) {
                $('#example').DataTable();
            }
        });
    </script>

</body>

</html>