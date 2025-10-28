<?php
include "header.html";
include "navbar.html";
?>

<!-- ====== Video YouTube Autoplay di Atas Konten ====== -->
<div class="container mt-3 mb-4">
    <div class="ratio ratio-16x9" style="border-radius: 10px; overflow: hidden;">
        <?php
        // ID video YouTube
        $video_id = "dQw4w9WgXcQ"; // ganti dengan ID video sekolah kamu

        // URL embed autoplay + mute
        $embed_url = "https://www.youtube.com/embed/$video_id?autoplay=1&mute=1&rel=0";
        ?>
        <iframe src="<?= $embed_url; ?>" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
</div>
<!-- ====== Akhir Video ====== -->

<div class="container">
    <h3>Teknik Komputer Jaringan</h3>
    <p>Teknik Komputer dan Jaringan (TKJ) adalah salah satu program studi di Sekolah Menengah Kejuruan (SMK) yang fokus pada pengetahuan dan keterampilan dalam bidang teknologi informasi dan komunikasi, khususnya yang berkaitan dengan komputer dan jaringan. Program ini dirancang untuk mempersiapkan siswa menjadi tenaga kerja terampil yang siap bekerja di industri IT atau melanjutkan pendidikan ke jenjang yang lebih tinggi. </p>

    <div class="row">
        <div class="col-sm-7 mb-3">
            <h5>Tujuan Pendidikan Teknik Komputer Jaringan</h5>
            <ul>
                <li><b>Pengetahuan Teknikal :</b> Membekali siswa dengan pemahaman mengenai dasar-dasar komputer, perangkat keras, perangkat lunak, dan jaringan.</li>
                <li><b>Keterampilan Praktis :</b> Melatih siswa dalam keterampilan praktis seperti instalasi, konfigurasi, dan perawatan komputer dan jaringan.</li>
                <li><b>Keamanan Jaringan :</b> Mengajarkan teknik dan praktik terbaik untuk menjaga keamanan jaringan dan data.</li>
                <li><b>Etika Profesional :</b> Membangun etika profesional dan sikap kerja yang baik.</li>
            </ul>
            <h5>Kurikulum Teknik Komputer Jaringan</h5>
            <ul>
                <li><b>Dasar-Dasar Komputer :</b> Memahami prinsip kerja komputer, perangkat keras (hardware), dan perangkat lunak (software).</li>
                <li><b>Jaringan Dasar :</b> Studi tentang konsep dasar jaringan, jenis-jenis jaringan, dan topologi jaringan.</li>
                <li><b>Instalasi dan Konfigurasi Jaringan :</b> Teknik instalasi dan konfigurasi perangkat jaringan seperti router, switch, dan access point.</li>
                <li><b>Administrasi Jaringan :</b> Manajemen dan administrasi jaringan, termasuk pengelolaan server dan layanan jaringan.</li>
                <li><b>Keamanan Jaringan :</b> Teknik untuk melindungi jaringan dari ancaman seperti malware, hacking, dan serangan siber lainnya.</li>
                <li><b>Pemrograman Dasar :</b> Pengenalan bahasa pemrograman yang relevan dengan bidang jaringan.</li>
                <li><b>Praktik Lapangan :</b> Latihan praktik di laboratorium komputer untuk memperkuat keterampilan teknis siswa.</li>
            </ul>
        </div>
        <div class="col-sm-5 mb-3">
            <img src="img/tkj1.png" alt="" style="width: 100%;" class="mb-3">
            <img src="img/tkj2.jpg" alt="" style="width: 100%;">
        </div>
    </div>

    <h5>Peluang Karier Lulusan Teknik Komputer Jaringan (TKJ)</h5>
    <ul>
        <li><b>Teknisi Jaringan :</b> Bekerja di perusahaan atau organisasi untuk mengelola dan memelihara jaringan komputer.</li>
        <li><b>Administrator Sistem :</b> Bertanggung jawab atas pengelolaan dan pemeliharaan sistem komputer dan jaringan.</li>
        <li><b>IT Support :</b> Memberikan dukungan teknis kepada pengguna komputer dan jaringan.</li>
        <li><b>Network Engineer :</b> Merancang, mengimplementasikan, dan mengelola jaringan komputer yang kompleks.</li>
        <li><b>Keamanan Siber :</b> Spesialis dalam melindungi sistem dan jaringan dari ancaman siber.</li>
        <li><b>Wirausaha :</b> Membuka usaha di bidang teknologi informasi seperti layanan instalasi jaringan, konsultan IT, atau toko komputer.</li>
    </ul>
    <br><br>
    <div class="row text-center">
        <h5>Untuk Informasi Pendaftaran, silahkan klik tombol dibawah ini</h5>
        <a href="https://wa.me/+6282142290464" target="_blank"><button type="button" class="btn-utama"><b>Informasi Pendaftaran</b></button></a>
    </div>
    <br><br>


</div>
<?php include "footer.html"; ?>