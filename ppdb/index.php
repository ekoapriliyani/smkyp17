<?php
include "header.html";
include "functions.php";
?>

<?php
if (isset($_POST["daftar"])) {
    if (tambah($_POST) > 0) {
        echo "<script>
            alert('Data berhasil disimpan');
            document.location.href='index.php';
        </script>";
    }
}

?>


<div class="container">
    <img src="kop.png" alt="kop" width="100%">
    <form action="" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="masukkan nama lengkap" required>
        </div>
        <div class="mb-3">
            <label for="asal" class="form-label">Asal Sekolah (SMP/MTs/PKBM)</label>
            <input type="text" class="form-control" name="asal" id="asal" placeholder="masukkan asal sekolah" required>
        </div>
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="masukkan tempat_lahir" required>
        </div>
        <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="masukkan alamat lengkap" required>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP/WA</label>
            <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="masukkan nomor hp" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="masukkan alamat email">
        </div>
        <div class="mb-3">
            <label for="jurusan">Konsentrasi Keahlian / Jurusan 1:</label>
            <select class="form-select" aria-label="Default select example" name="jurusan1">
                <option selected>--Pilih Jurusan 1--</option>
                <option value="TKR">Teknik Kendaraan Ringan</option>
                <option value="TEI">Teknik Elektronika Industri</option>
                <option value="TSM">Teknik Sepeda Motor</option>
                <option value="TKJ">Teknik Komputer Jaringan</option>
                <option value="DKV">Desain Komunikasi Visual</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jurusan">Konsentrasi Keahlian / Jurusan 2:</label>
            <select class="form-select" aria-label="Default select example" name="jurusan2">
                <option selected>--Pilih Jurusan 2--</option>
                <option value="TKR">Teknik Kendaraan Ringan</option>
                <option value="TEI">Teknik Elektronika Industri</option>
                <option value="TSM">Teknik Sepeda Motor</option>
                <option value="TKJ">Teknik Komputer Jaringan</option>
                <option value="DKV">Desain Komunikasi Visual</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="">Penerima Bantuan :</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penerima_bantuan" id="exampleRadios1" value="PKH">
                <label class="form-check-label" for="exampleRadios1">
                    Program Keluarga Harapan (PKH)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penerima_bantuan" id="exampleRadios2" value="BLT">
                <label class="form-check-label" for="exampleRadios2">
                    Bantuan Langsung Tunai (BLT)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penerima_bantuan" id="exampleRadios3" value="PIP">
                <label class="form-check-label" for="exampleRadios3">
                    Program Indonesia Pintar (PIP)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penerima_bantuan" id="exampleRadios4" value="BSL">
                <label class="form-check-label" for="exampleRadios4">
                    Bantuan Sosial Lainnya
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penerima_bantuan" id="exampleRadios5" value="-">
                <label class="form-check-label" for="exampleRadios5">
                    Tidak Ada
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="nama_ayah" class="form-label">Nama Ayah</label>
            <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="masukkan nama ayah">
        </div>
        <div class="mb-3">
            <label for="nama_ibu" class="form-label">Nama Ibu</label>
            <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="masukkan nama ibu">
        </div>
        <button type="submit" class="btn btn-primary" name="daftar">Daftar</button>
    </form>
    <br><br>
<img src="footer_ppdb.png" alt="kop" width="100%">
</div>

