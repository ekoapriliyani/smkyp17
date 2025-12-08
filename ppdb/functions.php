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

    // 1. Sanitasi dan Keamanan (PENTING: Gunakan mysqli_real_escape_string)
    // Pastikan semua input disanitasi sebelum dimasukkan ke database
    $nama               = mysqli_real_escape_string($conn, $data["nama"]);
    $asal               = mysqli_real_escape_string($conn, $data["asal"]);
    $tempat_lahir       = mysqli_real_escape_string($conn, $data["tempat_lahir"]);
    $tgl_lahir          = mysqli_real_escape_string($conn, $data["tgl_lahir"]);
    $alamat             = mysqli_real_escape_string($conn, $data["alamat"]);
    $no_hp              = mysqli_real_escape_string($conn, $data["no_hp"]);
    $email              = mysqli_real_escape_string($conn, $data["email"]);
    $jurusan1           = mysqli_real_escape_string($conn, $data["jurusan1"]);
    $jurusan2           = mysqli_real_escape_string($conn, $data["jurusan2"]);
    
    // Pastikan nilai penerima_bantuan tidak kosong (gunakan operator ?? untuk default jika tidak ada)
    $penerima_bantuan   = mysqli_real_escape_string($conn, $data["penerima_bantuan"] ?? '-'); 
    
    $nama_ayah          = mysqli_real_escape_string($conn, $data["nama_ayah"]);
    $nama_ibu           = mysqli_real_escape_string($conn, $data["nama_ibu"]);
    $tgl_daftar         = date('Y-m-d H:i:s');


    // 2. Mendapatkan nomor registrasi terakhir
    $queryLastNumber = "SELECT nomor_registrasi FROM tbl_siswa ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $queryLastNumber);

    $newNumberFormatted = '0001'; // Default
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastNumber = $row['nomor_registrasi'];
        $lastDigits = substr($lastNumber, -4); 
        $newNumber = (int)$lastDigits + 1;
        $newNumberFormatted = str_pad($newNumber, 4, '0', STR_PAD_LEFT); 
    }

    // 3. Membuat nomor registrasi baru
    $dateCode = date('Ymd'); 
    $nomor_registrasi = "YP17" . $dateCode . $newNumberFormatted;


    // 4. Query INSERT
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

    // 5. Cek keberhasilan dan kembalikan Nomor Registrasi
    if (mysqli_affected_rows($conn) > 0) {
        // Jika berhasil, kembalikan nomor registrasi
        return $nomor_registrasi; 
    } else {
        // Jika gagal
        return false; 
    }
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