<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "Eko123$", "dbsmkyp17");

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


// fungsi tampil data
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// fungsi tambah data
function tambah($data)
{
    global $conn;
    // ... (Fungsi tambah() Anda yang sudah ada)
    $nama = htmlspecialchars($data["nama"]);
    $asal = htmlspecialchars($data["asal"]);
    $tempat_lahir = htmlspecialchars($data["tempat_lahir"]);
    $tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan1 = htmlspecialchars($data["jurusan1"]);
    $jurusan2 = htmlspecialchars($data["jurusan2"]);
    $penerima_bantuan = htmlspecialchars($data["penerima_bantuan"]);
    $nama_ayah = htmlspecialchars($data["nama_ayah"]);
    $nama_ibu = htmlspecialchars($data["nama_ibu"]);
    $tgl_daftar = date('Y-m-d H:i:s');


    // Mendapatkan nomor registrasi terakhir
    $queryLastNumber = "SELECT nomor_registrasi FROM tbl_siswa ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $queryLastNumber);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastNumber = $row['nomor_registrasi'];
        $lastDigits = substr($lastNumber, -4); 
        $newNumber = (int)$lastDigits + 1;
        $newNumberFormatted = str_pad($newNumber, 4, '0', STR_PAD_LEFT); 
    } else {
        // Jika belum ada nomor registrasi, mulai dari 0001
        $newNumberFormatted = '0001';
    }

    // Membuat nomor registrasi baru
    $dateCode = date('Ymd'); 
    $nomor_registrasi = "YP17" . $dateCode . $newNumberFormatted;


    $query = "INSERT INTO tbl_siswa (
        nomor_registrasi, nama, asal, tempat_lahir, tgl_lahir, alamat, no_hp, email, 
        jurusan1, jurusan2, penerima_bantuan, nama_ayah, nama_ibu, tgl_daftar
    ) VALUES(
        '$nomor_registrasi',
        '$nama',
        '$asal',
        '$tempat_lahir',
        '$tgl_lahir',
        '$alamat',
        '$no_hp',
        '$email',
        '$jurusan1',
        '$jurusan2',
        '$penerima_bantuan',
        '$nama_ayah',
        '$nama_ibu',
        '$tgl_daftar'
    )";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


// FUNGSI BARU UNTUK VERIFIKASI (PINDAH DATA)
function verifikasi($data)
{
    global $conn;

    // Ambil data dari form verifikasi yang baru
    $id_siswa = htmlspecialchars($data["id"]);
    $aksi = htmlspecialchars($data["aksi_verifikasi"]);
    
    // List kolom yang akan dipindahkan (asumsi struktur tabel identik)
    // ID dihilangkan dari list karena asumsi tabel tujuan menggunakan AUTO_INCREMENT baru
    $kolom = "nomor_registrasi, nama, asal, tempat_lahir, tgl_lahir, alamat, no_hp, email, jurusan1, jurusan2, penerima_bantuan, nama_ayah, nama_ibu, tgl_daftar";

    // Tentukan tabel tujuan
    if ($aksi == "diterima") {
        $tabel_tujuan = "tbl_siswa_verifikasi";
    } elseif ($aksi == "ditolak") {
        $tabel_tujuan = "tbl_siswa_ditolak";
    } else {
        return 0; // Aksi tidak valid
    }

    // 1. SALIN/INSERT DATA ke tabel tujuan (dengan kolom tgl_verifikasi)
    $query_insert = "
        INSERT INTO $tabel_tujuan ($kolom, tgl_verifikasi) 
        SELECT $kolom, NOW() 
        FROM tbl_siswa 
        WHERE id = $id_siswa
    ";
    
    $berhasil_insert = mysqli_query($conn, $query_insert);

    if (!$berhasil_insert) {
        return 0; // Gagal menyalin data
    }
    
    // 2. HAPUS DATA DARI TABEL SUMBER (tbl_siswa)
    $query_delete = "DELETE FROM tbl_siswa WHERE id = $id_siswa";
    $berhasil_delete = mysqli_query($conn, $query_delete);

    if (!$berhasil_delete) {
        // Jika gagal hapus, data terduplikasi. Ini harus ditangani lebih lanjut 
        // dalam aplikasi nyata (rollback transaksi). Untuk saat ini, kita kembalikan 0.
        return 0;
    }

    // Mengembalikan jumlah baris yang terpengaruh (1 jika berhasil)
    return mysqli_affected_rows($conn); 
}
?>