<?php include "functions.php";
$siswa = query("SELECT * FROM tbl_siswa_verifikasi");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Data Siswa</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-navbar sticky-top shadow" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Data Calon Siswa SMK YP 17 Blitar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="admin.php">Calon Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="siswa_diterima.php">Siswa Diterima</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="siswa_ditolak.php">Siswa Tidak Diterima</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Tambahkan tombol cetak semua -->
    <!--<div class="container mt-3 mb-3">-->
    <!--    <a href="cetak_semua.php" class="btn btn-success">Cetak Semua Data</a>-->
    <!--</div>-->

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
                        <a href="detail_siswa.php?id=<?= $row['id']; ?>" class="btn btn-info" title="Detail">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <a href="cetak_single.php?id=<?= $row['id']; ?>" class="btn btn-warning" title="Cetak">
                            <i class="fas fa-print"></i>
                        </a>
                    </td>
                </tr>
                <?php $no++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- datatable -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    
    <script>
        // Inisialisasi DataTable
        $('#example').DataTable();
    </script>
</body>
</html>