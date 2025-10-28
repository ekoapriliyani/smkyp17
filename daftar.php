<?php include "header.html" ?>
<?php include "navbar.html" ?>
<br><br>
<div class="container">
    <h2 class="text-center">Pernerimaan Peserta Didik Baru Tahun 2025</h2>
    <form>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="masukkan nama lengkap">
        </div>
        <div class="mb-3">
            <label for="asal" class="form-label">Asal Sekolah (SMP/MTs/PKBM)</label>
            <input type="text" class="form-control" name="asal" id="asal" placeholder="masukkan asal sekolah">
        </div>
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="masukkan tempat_lahir">
        </div>
        <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="masukkan alamat lengkap">
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP/WA</label>
            <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="masukkan nomor hp">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="masukkan alamat email">
        </div>
        <div class="mb-3">
            <label for="jurusan">Konsentrasi Keahlian : (Bisa pilih lebih dari satu jurusan)</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="TKR" id="tkr">
                <label class="form-check-label" for="tkr">
                    Teknik Kendaraan Ringan
                </label>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>