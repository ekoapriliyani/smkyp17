<?php
include "header.html";
include "functions.php";

if (isset($_POST["daftar"])) {
    // Fungsi tambah() sekarang mengembalikan Nomor Registrasi (string) jika sukses, atau false jika gagal.
    $nomor_reg_baru = tambah($_POST); 
    
    if ($nomor_reg_baru !== false) {
        // REDIRECT KE HALAMAN BUKTI DENGAN NOMOR REGISTRASI
        echo "<script>
            alert('Selamat Anda Berhasil Mendaftar! Nomor Registrasi Anda: " . $nomor_reg_baru . "');
            document.location.href='bukti_pendaftaran.php?no_reg=" . $nomor_reg_baru . "';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Pendaftaran gagal. Silakan coba lagi.');
            document.location.href='index.php';
        </script>";
    }
}

?>


<div class="container mt-4">
    
    <div class="alert alert-info text-dark shadow-sm" role="alert">
        <h4 class="alert-heading"><i class="fas fa-info-circle me-2"></i> Petunjuk Singkat Pendaftaran!</h4>
        <p class="mb-2">
            Harap isi semua kolom dengan <b>data yang benar dan valid.</b> Data yang sudah disimpan tidak dapat diubah tanpa persetujuan panitia.
        </p>
        <p class="mb-0">
            Pastikan Anda memilih <b>Konsentrasi Keahlian (Jurusan)</b> yang sesuai. Setelah selesai, Anda akan diarahkan untuk mengunduh bukti pendaftaran.
        </p>
    </div>

    <div class="text-center mb-4">
        <a href="../panduan.php" target="_blank" class="btn btn-warning btn-lg fw-bold shadow-sm">
            <i class="fas fa-book-open me-2"></i> Download Panduan PPDB Lengkap
        </a>
    </div>

    <img src="kop.png" alt="kop" width="100%" class="mb-4">
    
    <h3 class="mb-4 text-center text-primary"><i class="fas fa-edit me-2"></i> Formulir Pendaftaran Calon Siswa</h3>

    <form action="" method="post" class="p-4 border rounded shadow-sm bg-white">
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="masukkan nama lengkap" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="asal" class="form-label">Asal Sekolah (SMP/MTs/PKBM)</label>
                <input type="text" class="form-control" name="asal" id="asal" placeholder="masukkan asal sekolah" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="masukkan tempat lahir" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="masukkan alamat lengkap" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="no_hp" class="form-label">Nomor HP/WA</label>
                <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="masukkan nomor hp" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="masukkan alamat email">
            </div>
        </div>
        
        <h5 class="mt-4 mb-3 text-secondary"><i class="fas fa-graduation-cap me-1"></i> Pilihan Konsentrasi Keahlian</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="jurusan1">Jurusan Pilihan 1:</label>
                <select class="form-select" name="jurusan1" required>
                    <option selected value="">--Pilih Jurusan 1--</option>
                    <option value="TKR">Teknik Kendaraan Ringan</option>
                    <option value="TEI">Teknik Elektronika Industri</option>
                    <option value="TSM">Teknik Sepeda Motor</option>
                    <option value="TKJ">Teknik Komputer Jaringan</option>
                    <option value="DKV">Desain Komunikasi Visual</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="jurusan2">Jurusan Pilihan 2:</label>
                <select class="form-select" name="jurusan2">
                    <option selected value="">--Pilih Jurusan 2--</option>
                    <option value="TKR">Teknik Kendaraan Ringan</option>
                    <option value="TEI">Teknik Elektronika Industri</option>
                    <option value="TSM">Teknik Sepeda Motor</option>
                    <option value="TKJ">Teknik Komputer Jaringan</option>
                    <option value="DKV">Desain Komunikasi Visual</option>
                </select>
            </div>
        </div>
        
        <h5 class="mt-4 mb-3 text-secondary"><i class="fas fa-hands-helping me-1"></i> Status Bantuan Sosial</h5>
        <div class="mb-3 p-3 border rounded bg-light">
            <label for="" class="form-label fw-bold">Penerima Bantuan :</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penerima_bantuan" id="exampleRadios1" value="PKH">
                <label class="form-check-label" for="exampleRadios1">Program Keluarga Harapan (PKH)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penerima_bantuan" id="exampleRadios2" value="BLT">
                <label class="form-check-label" for="exampleRadios2">Bantuan Langsung Tunai (BLT)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penerima_bantuan" id="exampleRadios3" value="PIP">
                <label class="form-check-label" for="exampleRadios3">Program Indonesia Pintar (PIP)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penerima_bantuan" id="exampleRadios4" value="BSL">
                <label class="form-check-label" for="exampleRadios4">Bantuan Sosial Lainnya</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penerima_bantuan" id="exampleRadios5" value="-" checked>
                <label class="form-check-label" for="exampleRadios5">Tidak Ada</label>
            </div>
        </div>

        <h5 class="mt-4 mb-3 text-secondary"><i class="fas fa-users me-1"></i> Data Orang Tua</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="masukkan nama ayah">
            </div>
            <div class="col-md-6 mb-3">
                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="masukkan nama ibu">
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg mt-4 w-100" name="daftar">
            <i class="fas fa-paper-plane me-2"></i> Daftar Sekarang
        </button>
        
    </form>
    
    <br><br>
    <img src="footer_ppdb.png" alt="footer" width="100%">
</div>