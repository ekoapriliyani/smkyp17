<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "dbsmkyp17");

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
    $nama = $data["nama"];
    $asal = $data["asal"];
    $tempat_lahir = $data["tempat_lahir"];
    $tgl_lahir = $data["tgl_lahir"];
    $alamat = $data["alamat"];
    $no_hp = $data["no_hp"];
    $email = $data["email"];
    $jurusan1 = $data["jurusan1"];
    $jurusan2 = $data["jurusan2"];
    $penerima_bantuan = $data["penerima_bantuan"];
    $nama_ayah = $data["nama_ayah"];
    $nama_ibu = $data["nama_ibu"];
    $tgl_daftar = date('Y-m-d H:i:s');


    // Mendapatkan nomor registrasi terakhir
    $queryLastNumber = "SELECT nomor_registrasi FROM tbl_siswa ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $queryLastNumber);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastNumber = $row['nomor_registrasi'];
        $lastDigits = substr($lastNumber, -4); // Mengambil 4 digit terakhir
        $newNumber = (int)$lastDigits + 1;
        $newNumberFormatted = str_pad($newNumber, 4, '0', STR_PAD_LEFT); // Pad dengan nol
    } else {
        // Jika belum ada nomor registrasi, mulai dari 0001
        $newNumberFormatted = '0001';
    }

    // Membuat nomor registrasi baru
    $dateCode = date('Ymd'); // Format tanggal untuk nomor registrasi
    $nomor_registrasi = "YP17" . $dateCode . $newNumberFormatted;


    $query = "INSERT INTO tbl_siswa VALUES(
        '',
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


// fungsi verifikasi
function verifikasi($data)
{
    global $conn;
    $id = $data["id"];
    $nomor_registrasi = $data["nomor_registrasi"];
    $nama = $data["nama"];
    $asal = $data["asal"];
    $tempat_lahir = $data["tempat_lahir"];
    $tgl_lahir = $data["tgl_lahir"];
    $alamat = $data["alamat"];
    $no_hp = $data["no_hp"];
    $email = $data["email"];
    $jurusan1 = $data["jurusan1"];
    $jurusan2 = $data["jurusan2"];
    $penerima_bantuan = $data["penerima_bantuan"];
    $nama_ayah = $data["nama_ayah"];
    $nama_ibu = $data["nama_ibu"];
    $tgl_daftar = date('Y-m-d H:i:s');

    $query = "INSERT INTO tbl_siswa_verifikasi VALUES(
        '',
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

    mysqli_query($conn, "DELETE FROM tbl_siswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}
