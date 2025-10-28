<?php
include "header.html";
include "functions.php";

// tangkap id
$id = $_GET["id"];
$sw = query("SELECT * FROM tbl_siswa WHERE id = $id")[0];


?>

<?php
if (isset($_POST["verifikasi"])) {
    if (verifikasi($_POST) > 0) {
        echo "<script>
            alert('Data berhasil diverifikasi');
            document.location.href='admin.php';
        </script>";
    }
}

?>



<br><br>
<div class="container">
    <h2 class="text-center">Verifikasi Peserta Didik Baru</h2>
    <form action="" method="post">
        <input hidden type="text" name="id" id="id" value="<?= $sw["id"]; ?>">
        <div class="mb-3">
            <label for="nomor_registrasi" class="form-label">Nomor Regostrasi</label>
            <input type="text" class="form-control" name="nomor_registrasi" id="nomor_registrasi" value="<?= $sw["nomor_registrasi"]; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" id="nama" value="<?= $sw["nama"]; ?>">
        </div>
        <div class="mb-3">
            <label for="asal" class="form-label">Asal Sekolah (SMP/MTs/PKBM)</label>
            <input type="text" class="form-control" name="asal" id="asal" value="<?= $sw["asal"]; ?>">
        </div>
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?= $sw["tempat_lahir"]; ?>">
        </div>
        <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="<?= $sw["tgl_lahir"]; ?>">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $sw["alamat"]; ?>">
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP/WA</label>
            <input type="number" class="form-control" name="no_hp" id="no_hp" value="<?= $sw["no_hp"]; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $sw["email"]; ?>">
        </div>
        <div class="mb-3">
            <label for="jurusan1" class="form-label">Jurusan 1</label>
            <input type="text" class="form-control" name="jurusan1" id="jurusan1" value="<?= $sw["jurusan1"]; ?>">
        </div>
        <div class="mb-3">
            <label for="jurusan2" class="form-label">Jurusan 2</label>
            <input type="text" class="form-control" name="jurusan2" id="jurusan2" value="<?= $sw["jurusan2"]; ?>">
        </div>
        <div class="mb-3">
            <label for="penerima_bantuan" class="form-label">Penerima Bantuan</label>
            <input type="text" class="form-control" name="penerima_bantuan" id="penerima_bantuan" value="<?= $sw["penerima_bantuan"]; ?>">
        </div>
        <div class="mb-3">
            <label for="nama_ayah" class="form-label">Nama Ayah</label>
            <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" value="<?= $sw["nama_ayah"]; ?>">
        </div>
        <div class="mb-3">
            <label for="nama_ibu" class="form-label">Nama Ibu</label>
            <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" value="<?= $sw["nama_ibu"]; ?>">
        </div>
        <div class="mb-3">
            <label for="tgl_daftar" class="form-label">Tanggal Daftar</label>
            <input type="text" class="form-control" name="tgl_daftar" id="tgl_daftar" value="<?= $sw["tgl_daftar"]; ?>" readonly>
        </div>
        <button type="submit" class="btn btn-success" name="verifikasi">Verifikasi</button>
        <a href="admin.php" class="btn">Batal</a>
    </form>
    <br><br>

</div>