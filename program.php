<?php include "header.html" ?>
<?php include "navbar.html" ?>
<style>
    body {
      background-color: #f4f6f9;
      font-family: "Segoe UI", sans-serif;
    }

    .card-gelombang {
      border: none;
      border-radius: 1rem;
      background: linear-gradient(145deg, #ffffff, #f1f5ff);
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      max-width: 600px;
      margin: auto;
    }

    .card-gelombang:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 25px rgba(0,0,0,0.15);
    }

    .card-header {
      background: linear-gradient(90deg, #0d6efd, #0dcaf0);
      color: white;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
      text-align: center;
      font-weight: 600;
    }

    .list-group-item {
      border: none;
      background: transparent;
      padding-left: 1.8rem;
      position: relative;
    }

    .list-group-item::before {
      content: "✔";
      position: absolute;
      left: 0;
      color: #0d6efd;
      font-weight: bold;
    }
  </style>
<div class="container">
    <br><br>
    <h2 class="text-center">Program</h2>
    <hr><br>
    <div class="row">
        <div class="col-sm-6 mb-3">
            <h4>A.	Jenis Program Promosi SPMB Tahun ajaran 2026/2027 :</h4>
            <h5>1. Program Gratis Biaya Sekolah Bagi Yatim-Piatu</h5>
            <p>Mendapatkan bantuan penuh berupa :</p>
            <ul>
                <li>Bebas biaya SPP selama 3 tahun sekolah</li>
                <li>Bebas biaya daftar ulang selama 3 tahun sekolah</li>
                <li>Bebas biaya segala kegiatan yang dilakukan dilingkungan sekolah selama 3 tahun (Kecuali Kegiatan yang dilaksanakan di luar sekolah)</li>
                <li>Bantuan seragam dan perlengkapan</li>
            </ul>
            <!-- Tombol Modal -->
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#syaratModal">
              Syarat & Ketentuan
            </button>
            
            <!-- Modal -->
              <div class="modal fade" id="syaratModal" tabindex="-1" aria-labelledby="syaratModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                      <h5 class="modal-title" id="syaratModalLabel">Syarat & Ketentuan</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                      <ol>
                        <li>Merupakan Siswa Yatim-Piatu dengan melampirkan Akta kematian satu/kedua Orang tua.</li>
                        <li>Telah menyelesaikan pendidikan SMP/MTS/PKBM/Sederajat.</li>
                        <li>Tidak memiliki orang tua sambung.</li>
                        <li>Melampirkan surat keterangan dari RT/RW setempat (format file dari panitia).</li>
                      </ol>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
              <br> <hr>
              
              <h5>2. Program Gratis Seragam Putih Abu-Abuu</h5>
            <p>a.	Mendapat bantuan berupa satu set seragam putih abu-abu pada saat awal masuk sekolah</p>
            <!-- Tombol Modal -->
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#syaratModa2">
              Syarat & Ketentuan
            </button>
            
            <!-- Modal -->
              <div class="modal fade" id="syaratModa2" tabindex="-1" aria-labelledby="syaratModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                      <h5 class="modal-title" id="syaratModalLabel">Syarat & Ketentuan</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                      <ol>
                        <li>Telah menyelesaikan pendidikan SMP/MTS/PKBM/Sederajat</li>
                        <li>Program untuk 20 pendaftar pertama</li>
                        <li>Tindak lanjut program pemenuhan kuota konfirmasi ke panitia, tanpa adanya syarat tertentu</li>
                      </ol>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
              <br> <hr>
            
            
            <h5>3.	Program Cerdas Tanpa Batas</h5>
            <p>Mendapatkan bantuan berupa :</p>
            <ul>
                <li>Potongan biaya daftar ulang</li>
                <li>Subsidi Biaya SPP: Keringanan atau pembebasan biaya SPP (proporsional sesuai tingkat kebutuhan yang dikomunikasikan dengan bendahara sekolah dan panitia).</li>
            </ul>
            <!-- Tombol Modal -->
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#syaratModa3">
              Syarat & Ketentuan
            </button>
            
            <!-- Modal -->
              <div class="modal fade" id="syaratModa3" tabindex="-1" aria-labelledby="syaratModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                      <h5 class="modal-title" id="syaratModalLabel">Syarat & Ketentuan</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                      <ol>
                        <li>Telah menyelesaikan pendidikan SMP/MTS/PKBM/Sederajat</li>
                        <li>Surat Keterangan Tidak Mampu (SKTM) dari Kelurahan/Desa dengan melampirkan penghasilan orang tua</li>
                        <li>Melampirkan foto rumah (tampak depan, belakang, ruang tamu, dan dapur)</li>
                      </ol>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
              <br> <hr>  
            
        </div>
        <div class="col-sm-6 mb-3">
            <h4>B.	Gelombang Pendaftaran SPMB Tahun Ajaran 2026/2027</h4>
            <div class="card card-gelombang">
                <div class="card-header">
                  <h5 class="fw-semibold">Gelombang 1</h5>
                </div>
                <div class="card-body">
                  <p class="text-muted">
                    Pendaftaran dibuka mulai bulan <strong>Oktober – Desember 2025</strong>
                  </p>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Program Gratis Biaya Sekolah Bagi Yatim-Piatu</li>
                    <li class="list-group-item">Program Gratis Seragam Putih Abu-Abu</li>
                    <li class="list-group-item">Program Cerdas Tanpa Batas (Potongan 20%)</li>
                    <li class="list-group-item">Program Generasi 17 (Potongan 20%)</li>
                  </ul>
                </div>
            </div>
            <br>
            <div class="card card-gelombang">
                <div class="card-header">
                  <h5 class="fw-semibold">Gelombang 2</h5>
                </div>
                <div class="card-body">
                  <p class="text-muted">
                    Pendaftaran dibuka mulai bulan <strong>Januari  – Maret 2026</strong>
                  </p>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Program Gratis Biaya Sekolah Bagi Yatim-Piatu</li>
                    <li class="list-group-item">Program Cerdas Tanpa Batas (Potongan 20%)</li>
                    <li class="list-group-item">Program Generasi 17 (Potongan 10%)</li>
                    <li class="list-group-item">Program Pemimpin Muda</li>
                  </ul>
                </div>
            </div>
            <br>
            <div class="card card-gelombang">
                <div class="card-header">
                  <h5 class="fw-semibold">Gelombang 3</h5>
                </div>
                <div class="card-body">
                  <p class="text-muted">
                    Pendaftaran dibuka mulai bulan <strong>April  – Juli 2026</strong>
                  </p>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Program Gratis Biaya Sekolah Bagi Yatim-Piatu</li>
                    <li class="list-group-item">Program Cerdas Tanpa Batas (Potongan 15%)</li>
                    <li class="list-group-item">Program Generasi 17 (Potongan 10%)</li>
                    <li class="list-group-item">Program Daftar Ulang Cerdas</li>
                    <li class="list-group-item">Program Pemimpin Muda</li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>


<?php include "footer.html" ?>