-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Okt 2025 pada 22.44
-- Versi server: 10.5.22-MariaDB-cll-lve
-- Versi PHP: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alfr7592_smk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(1000) NOT NULL,
  `uploaded_on` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `caption`, `uploaded_on`) VALUES
(2, 'uploads/WhatsApp Image 2024-08-06 at 13.46.47_6abd013a.jpg', 'Kontingen Kapiten Pattimura ikut serta memeriahkan kegiatan Kirab Pandu Praja Patria (KP3) 2024. KP3 merupakan kegiatan yang dilaksanakan untuk menumbuhkan rasa kebangsaan, cinta tanah air, membangun kekompakan hingga mengetahui sejarah yang ada di Kota Blitar. Sementara, dalam penilaian KP3 meliputi cerdas cermat serta yel-yel peserta yang unikÂ danÂ kreatif.', 2147483647);

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'SMK YP 17 BLITAR'),
(6, 'short_name', 'SMK YP 17'),
(11, 'logo', 'uploads/logo-1723221058.png?v=1723221058'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/BG-Login.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id` int(11) NOT NULL,
  `nomor_registrasi` varchar(50) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `asal` varchar(250) NOT NULL,
  `tempat_lahir` varchar(250) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
  `jurusan1` varchar(250) NOT NULL,
  `jurusan2` varchar(250) NOT NULL,
  `penerima_bantuan` varchar(250) NOT NULL,
  `nama_ayah` varchar(250) NOT NULL,
  `nama_ibu` varchar(250) NOT NULL,
  `tgl_daftar` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id`, `nomor_registrasi`, `nama`, `asal`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_hp`, `email`, `jurusan1`, `jurusan2`, `penerima_bantuan`, `nama_ayah`, `nama_ibu`, `tgl_daftar`) VALUES
(74, 'YP17202507110001', 'Testing ios', 'Testing ios', 'Testing', '2001-07-06', 'Testing', '081081081081', 'testing@gmail.com', 'TKR', 'TSM', '', 'Testing', 'Testing', '2025-07-11 23:42:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa_ditolak`
--

CREATE TABLE `tbl_siswa_ditolak` (
  `id` int(11) NOT NULL,
  `nomor_registrasi` varchar(50) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `asal` varchar(250) NOT NULL,
  `tempat_lahir` varchar(250) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
  `jurusan1` varchar(250) NOT NULL,
  `jurusan2` varchar(250) NOT NULL,
  `penerima_bantuan` varchar(250) NOT NULL,
  `nama_ayah` varchar(250) NOT NULL,
  `nama_ibu` varchar(250) NOT NULL,
  `tgl_daftar` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa_verifikasi`
--

CREATE TABLE `tbl_siswa_verifikasi` (
  `id` int(11) NOT NULL,
  `nomor_registrasi` varchar(50) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `asal` varchar(250) NOT NULL,
  `tempat_lahir` varchar(250) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
  `jurusan1` varchar(250) NOT NULL,
  `jurusan2` varchar(250) NOT NULL,
  `penerima_bantuan` varchar(250) NOT NULL,
  `nama_ayah` varchar(250) NOT NULL,
  `nama_ibu` varchar(250) NOT NULL,
  `tgl_daftar` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_siswa_verifikasi`
--

INSERT INTO `tbl_siswa_verifikasi` (`id`, `nomor_registrasi`, `nama`, `asal`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_hp`, `email`, `jurusan1`, `jurusan2`, `penerima_bantuan`, `nama_ayah`, `nama_ibu`, `tgl_daftar`) VALUES
(8, 'YP17202505270008', 'Fitria nikmatur rohmah ', 'Mtsn6blitar ', 'Tulungagung ', '2009-09-21', 'Dsn sumbersuko rt 01 rw 07', '085775583852', 'nairaaacry@gmail.com', 'DKV', 'TEI', 'PIP', 'Maikel kolim', 'anis nasikin', '2025-06-26 09:32:20'),
(11, 'YP17202505310009', 'Aurera Rizky Andhita Putri ', 'SMP negeri 03 nglegok ', 'Surabaya', '2009-04-13', 'Dsn sumberasri desa gambaranyar rt01rw12', '082231501833', 'aurerarizkyandhitaputri13@gmail.com', 'DKV', 'DKV', 'PIP', 'Widianto ', 'Yunita', '2025-06-28 17:06:08'),
(12, 'YP17202506200010', 'RAMADHANI SETYAWAN ', 'UPT SMP NEGERI 1 GARUM ', 'Blitar,01-9-2009', '2009-09-01', 'DSN KEMLOKO RT02 RW12 DESA SIDODADI KEC.GARUM KAB.BLITAR', '085704206573', 'setyawanramadhani957@gmail.com', 'TKR', 'TKR', 'PIP', 'ARIF LENGGONO (wali siswa)', 'Surti KANTI (almarhum)', '2025-06-28 17:06:16'),
(13, 'YP17202506230011', 'muhamad juliansah putra wirul pratama', 'smpn 2 wonotirto', 'blitar', '2010-07-07', 'kec wonotirto ds ngeni dsn dringo rw1 rt1', '085845681381', 'juliansyahyooke@gmail.com', 'TKR', 'TSM', 'PIP', 'imam khoirul', 'wiwik indiarti', '2025-06-28 17:06:24'),
(14, 'YP17202506260012', 'Tri wahyuni', 'Upt smp negeri 2 talun', 'Kab Blitar', '2009-12-05', 'Desa kendalrejo Dsn tegalrejo Rt 02 RW 04', '085855561389', 'Ggibransapu514@gmail.com', 'TKJ', 'DKV', 'PIP', 'Sunardi', 'Mukaromah', '2025-06-28 17:06:29'),
(15, 'YP17202506280013', 'Muhammad Rifai eka Setiawan ', 'upt smpn 2 talun', 'Blitar ', '2009-12-07', 'dusun bendelonje RT 001 RW 011 kendarejo ', '08165467592', 'rifaig658@gmail.com', 'TKR', 'TKJ', '-', 'heru susanto', 'nur Alifah ', '2025-06-28 17:06:35'),
(16, 'YP17202506280014', 'KEYLA MEGA NINGRUM SOFYAN', 'UPT SMPN 2 TALUN', 'BLITAR', '2009-08-19', 'desa purworejo kecamatan sanankulon kabupaten Blitar provinsi jawa timur', '085732260844', 'keylamega3@gmail.com', 'TKJ', 'DKV', 'PIP', 'RULI SOFYAN', 'ASTRIANI', '2025-06-28 17:06:40'),
(17, 'YP17202506280015', 'Lisa Nuraini ', 'UPT SMPN 2 Talun', 'Blitar ', '2010-02-08', 'Dsn.Sonogunting desa.pasirharjo RT.06 RW.01', '085745267540', 'ln411704@gmail.com', 'TKR', 'DKV', '-', 'Sujiono', 'Siti Mutmainah ', '2025-06-28 17:06:46'),
(18, 'YP17202506300001', 'jeny putri wahyu ningtyas', 'smpn 02 talun ', 'blitar', '2010-01-14', 'bendil putih tumpang jl randu gede', '085894165866', 'blitararkan@gmail.com', 'TKJ', 'TKJ', 'PIP', 'purwanto', 'Siti zulaikah', '2025-06-30 14:04:21'),
(19, 'YP17202507010001', 'REVI ANGGRAINI', 'UPT SMPN 2 TALUN', 'BLITAR', '2010-02-15', 'Dsn. Tegalrejo, Rt/Rw 01/04, Ds.Kendalrejo, Kc.Talun, Kb. Blitar', '085805540285', 'anggrainirevi08@gmail.com', 'TKJ', 'DKV', 'PKH', 'SUYANI', 'SUPRIHATIN', '2025-07-01 09:12:16'),
(20, 'YP17202507020001', 'FAIZ DWI RAHMADANI', 'SMP NEGERI 1 SANANKULON', 'BLITAR', '2010-06-08', 'DESA BENDOWULUNG RT 01 RW 04 ,KEC SANANKULON,KAB BLITAR', '085806046265', 'faizdwirahmadani77@gmail.com', 'TKR', 'TSM', 'PIP', 'Mujiono', 'Siti alfiyah', '2025-07-02 10:11:51'),
(21, 'YP17202507020001', 'MUHAMAD MIFTAHUL HUDA', 'UPT SMP NEGERI 1 GARUM', 'Blitar', '2010-02-28', 'DSN KEMMLOKO RT02 RW12 DESA SIDODADI KEC.GARUM KAB.BLITAR', '081515555459', 'mmiftahulhuda807@gmail.com', 'TEI', 'TKJ', '-', 'MOKHAMAD NURCAHYO', 'NINIK EKO WIDAYATI', '2025-07-02 10:12:21'),
(22, 'YP17202507020001', 'MOH.ILHAM FADILAH', 'Smpi Anharul Ulum', 'BLITAR ', '2008-04-04', 'DS Darungan RT 03 RW 02', '083843472168', 'kikirtno@gmail.com', 'TKR', 'TSM', '-', 'Ratno', 'Ismiati', '2025-07-02 16:17:52'),
(23, 'YP17202507020001', 'Alan Febrian ', 'UPT SMPN 1 Talun ', 'Kutai Kartanegara ', '2009-02-02', 'Tumpang tritihrejo RT 3 RW 8 ', '085792748119', 'alanfebriantw@gmail.com', 'TKR', 'TKJ', 'PIP', 'Iswanto ', 'Mesini ', '2025-07-02 20:18:31'),
(24, 'YP17202507020002', 'RESYAKI SAKTI MUKMIN', 'SMP NEGERI 1 GARUM', 'Purbalingga', '2010-07-09', 'Dusun Pucung sari kidul RT01 RW02, desa slorok, kecamatan garum, kabupaten Blitar, Jawa Timur ', '085755951053', 'saktiori857@gmail.com', 'TKJ', 'TKR', '-', 'SOLIKHIN', 'UNITI', '2025-07-03 04:25:11'),
(25, 'YP17202507020001', 'Wrong Input', '', '', '2010-07-09', '', '', '', '', '', '', '', '', '2025-07-03 18:35:25'),
(26, 'YP17202507030001', 'Ratan Dhamma', 'SMPN 2 SUTOJAYAN', 'Malang', '2010-02-02', 'Jl raya utara no 03 kalipang sutojayan kabupaten blitar RT 05 RW 01', '089523785724', 'jalandhamma@gmail.com', 'DKV', 'TKR', '-', 'Agung miarso', 'Dwi erlia budi', '2025-07-03 18:37:20'),
(27, 'YP17202507030002', 'FAREL DEFANDRA ALDIANO', 'SMP NEGERI 1 WONODADI', 'BLITAR', '2009-07-17', 'DESA GANDEKAN RT 03 RW 03 KECAMATAN WONODADI KABUPATEN BLITAR', '085815936707', 'fareldevan@gmail.com', 'TKR', 'TSM', '', 'ALI MUSTOFA', 'ASMAUN KUSNAH', '2025-07-03 19:31:45'),
(28, 'YP17202507030003', 'PUTRI SEPTIASARI', 'SMP NEGERI 3 SRENGAT', 'BLITAR', '2009-09-07', 'DESA GANDEKAN KECAMATAN WONODADI KABUPATEN BLITAR', '08979544696', 's22558838@gmail.com', 'TKJ', 'DKV', '', '-', '-', '2025-07-03 19:32:13'),
(29, 'YP17202507030001', 'Wrong Input', '', '', '2009-07-17', '', '', '', '', '', '', '', '', '2025-07-03 19:46:29'),
(30, 'YP17202507030003', 'AINUN NADIA DEVINA PRISKA ', 'MTSN 10 Blitar ', 'Blitar', '2010-12-15', 'Dsn.ponggok Desa.ponggok Kec.ponggok Kab.blitar', '085704076417', 'ainunnadiadevina@gmail.com', 'TKR', 'TEI', 'PIP', 'SUPRIONO ', 'SUHARTI', '2025-07-04 07:52:21'),
(31, 'YP17202507030001', 'Wrong Input', '', '', '2010-12-15', '', '', '', '', '', '', '', '', '2025-07-04 07:53:00'),
(32, 'YP17202507030002', 'Wrong Input', '', '', '2010-12-15', '', '', '', '', '', '', '', '', '2025-07-04 07:53:35'),
(33, 'YP17202507030001', 'AINUN NADIA DEVINA PRISKA ', 'MTSN 10 Blitar ', 'Blitar', '2010-12-15', 'Dsn.ponggok Desa.ponggok Kec.ponggok Kab.blitar', '085704076417', 'ainunnadiadevina@gmail.com', 'TKR', 'TEI', 'PIP', 'SUPRIONO ', 'SUHARTI', '2025-07-04 07:53:55'),
(34, 'YP17202507040001', 'MUHAMMAD SHABIAN WILDANTYO', 'SMPN 1 PONGGOK', 'BLITAR', '2010-03-06', 'DSN SUMBER NANAS RT.09 RW.07 PONGGOK', '087765322726', 'bibi.wildan2010@gmail.com', 'TKR', 'TEI', 'PIP', 'NANANG SUPRIANTO', 'SUPIYAH', '2025-07-04 08:12:42'),
(35, 'YP17202507040001', 'Ready Akbar Cahya Putra', 'SMP Negeri 8 Kota Blitar', 'Surabaya', '2009-11-03', 'Jl.Moyo No 2 RT.01 RW.09 Kelurahan Karangtengah Kecamatan Sananwetan', '085732261633', 'readyakbarc@gmail', 'TKR', 'DKV', '-', 'Dony Purwo Cahyono', 'Feriana Dwi Anita', '2025-07-04 11:12:56'),
(36, 'YP17202507040003', 'MUCHAMMAD ICHSAN MUBAROK', 'SMP Miftahul Huda Gogodeso', 'BLITAR', '2009-09-25', 'RT.2 RW.1 Ds. MINGGIRSARI   KEC. KANIGORO   KAB. BLITAR', '083175554803', 'ichsanjava9@gmail.com', 'TKJ', 'DKV', 'PIP', 'Amin r', 'Wasilatu n', '2025-07-04 16:00:01'),
(37, 'YP17202507040001', 'Wrong Input', '', 'Q', '2025-07-01', '', '', '', '', '', '', '', '', '2025-07-04 16:22:36'),
(38, 'YP17202507040002', 'Wrong Input', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2025-07-04 16:23:08'),
(39, 'YP17202507050001', 'Wrong Input', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2025-07-05 10:31:39'),
(40, 'YP17202507050001', 'CELSI JORDANIA SAPUTRI', 'SMPN 3 NGLEGOK', 'blitar', '2009-12-30', 'SUMBER ASRI, NGLEGOK, BLITAR', '085606135587', 'chelsiimutt31@gmail.com', 'TKJ', 'DKV', 'PKH', 'SUNARKO', 'KASIATUN', '2025-07-05 15:35:02'),
(41, 'YP17202507050002', 'ALE AL KATIRI WARDOYO', 'SMPN 7', 'BLITAR', '2010-03-15', 'Jl. Ir. Soekarno Gang IV No. 12', '085649622277', 'kiawardoyo898@gmail.com', 'TKJ', 'DKV', '', 'SUWISTYO JATMOKO', 'ENDANG SETYOWATI', '2025-07-05 15:35:14'),
(42, 'YP17202507050003', 'mohamad sulton ', 'MTSS AL MUTTAQIN ', 'Blitar ', '2009-04-07', 'KEDUNGWUNGU ', '081357664096', 'MUHAMADSULTON369@GMAIL.COM', 'TKR', 'TSM', '-', 'wandi ', 'MUNARSIH ', '2025-07-05 20:51:22'),
(43, 'YP17202507050001', 'Wrong Input', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2025-07-05 20:58:32'),
(44, 'YP17202507050002', 'Wrong Input', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2025-07-05 20:58:55'),
(45, 'YP17202507060001', 'Wrong Idetification', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2025-07-06 14:07:53'),
(46, 'YP17202507070001', 'Bimo Adi Saputro ', 'MTsn 6 Blitar ', 'Blitar ', '2009-09-29', 'Jalan Merdeka Tengah Desa Gledug RT 02 RW 04 Kecamatan Sanankulon Kabupaten Blitar ', '085606296290', 'rmfamily1922@gmail.com', 'TSM', '--Pilih Jurusan 2--', '-', 'Agus rudyanto ', 'Kasmiatun ', '2025-07-07 09:52:34'),
(47, 'YP17202507070001', 'Krisna surya ananda', 'Smpn 03 ponggok', 'Blitar', '2009-12-08', 'Blitar-ponggok-maliran Rt 02/Rw 03', '085784299821', 'suryaanandakrisna0@gmail.com', 'TSM', 'TKR', '-', 'Mujiono', 'Susiana', '2025-07-07 10:32:39'),
(48, 'YP17202507070002', 'Krisna surya ananda (Double-Input)', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2025-07-07 10:49:38'),
(49, 'YP17202507070001', 'Asfahani Mohammad Fiqri', 'MTsN 3 TA', 'Tulungagung', '2009-06-21', 'Dsn. Bangunsari', '085749336063', 'asfahanifikri@gmail.com', 'TKJ', 'TKR', 'PIP', 'M.bashori', 'Masroin', '2025-07-07 12:18:34'),
(50, 'YP17202507070002', 'Muhammad Azizi Ghifran', 'SMPN 1 Kanigoro', 'Blitar', '2009-12-17', 'Ds karangsono RT:03 RW :04 kec KANIGORO kab blitar', '085733282132', 'muhammadazizig10@gmail.com', 'TEI', 'TKR', '-', 'Miftahul anwar', 'Dewi yulikah', '2025-07-07 14:26:25'),
(51, 'YP17202507070001', 'Muhammad azizi ghifran (Double Input)', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2025-07-07 14:37:22'),
(52, 'YP17202507070001', 'MUHAMMAD REONALDI SAPUTRA ', 'mts- al umron bendosewu', 'blitar', '2010-02-25', 'DSN MUNGKUNG ', '08546813286', 'renoreonaldi931@gmail.com', 'TKR', 'TEI', 'PIP', 'panca imam Wahyudi', 'wiwik indarti', '2025-07-07 14:51:08'),
(53, 'YP17202507070001', 'MOCH.NAUFAL RAFI ALFARIZQI', 'UPT SMPN 1 KANIGORO', 'Blitar', '2009-04-19', 'Dsn. Karangsono Ds. Karangsono kec. Kanigoro kab.', '085606291660', 'rafinaufal656@gmail.com', 'TSM', 'TKR', 'BSL', 'Ismail', 'Siti nurarifah', '2025-07-07 15:53:16'),
(54, 'YP17202507070001', 'AHMAD DAFA MADANI ', 'SMP 5 KOTA BLITAR ', 'Rembang ', '2008-10-08', 'Jl.cemara no.6', '081331715607', 'ahmatdafamadanidafa@gmail.com', 'TKR', 'TSM', 'PKH', 'Zaenal Mustofa ', 'Nur hayati ', '2025-07-07 16:17:04'),
(55, 'YP17202507070001', 'Muhammad Mirza Al hadziiqi', 'SMPN 3 ponggok', 'Di blitar', '2009-12-09', 'Kabupaten Blitar desa bendo kec ponggok', '085706983009', 'zarzyou0@gmail.com', 'TKR', 'TSM', '-', 'Ariel Priyo jatmiko', 'Marmiati', '2025-07-07 20:37:45'),
(56, 'YP17202507080001', 'DELPY OCHIE WUYI ANDANATA', 'MTSN 6 BLITAR', 'BLITAR', '2009-10-21', 'DSN KEMBANGAN DESA SUMBERJO RT2 RW9 KEC SANANKULON BLITAR JAWATIMUR', '085857450694', 'ochiedelpy@gmail.com', 'TSM', 'TKR', 'PIP', 'ANANG YUS BUDI SETYAWAN', 'NURUL HIDAYAH', '2025-07-08 17:15:53'),
(57, 'YP17202507080001', 'WENDY CYNTIASARY FEBRIANY', 'SMPN 1 SANANKULON', 'Blitar ', '2010-02-16', 'Desa tuliskriyo kecamatan sanankulon kabupaten blitar provinsi jawa timur', '089678847940', 'sintiasariwindy@gmail.com', 'TEI', 'TSM', '-', 'Kasiarno', 'Sulikah', '2025-07-08 19:05:04'),
(58, 'YP17202507080002', 'WENDY CYNTIASARY FEBRIANY (Double Input)', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2025-07-08 19:05:29'),
(59, 'YP17202507080002', 'WYNDY CYNTIASARY FEBRIANY', 'SMPN 1 SANANKULON', 'Blitar ', '2010-02-16', 'Desa tuliskriyo kecamatan sanankulon kabupaten blitar provinsi jawa timur', '089678847940', 'sintiasariwindy@gmail.com', 'TEI', 'TSM', '-', 'Kasiarno', 'Sulikah', '2025-07-08 20:14:03'),
(60, 'YP17202507080001', 'MOCHAMMAD SIGIT PERMADI ', 'MTsN 6 BLITAR', 'blitar', '2009-05-20', 'dusun sumber 1 rt 3 rw 2', '081916635675', 'permadisigit657@gmail.com', 'TKJ', 'DKV', 'PIP', 'MOH SODIQ', 'SRIANAH', '2025-07-08 20:14:12'),
(61, 'YP17202507090001', 'Muhammad Alif Haikal', 'SMP Muhammadiyah 1 Blitar', 'Pangkal Pinang', '2006-01-02', 'Jl. A Yani No. 59 B RT 02 RW 09 ', '089517852511', 'alifhykal702@gmail.com', 'TSM', '-', 'PIP', 'Hashim', 'Kanti', '2025-07-09 13:03:16'),
(62, 'YP17202507090001', 'REYNARD JIBRIEL RAHMADANTE ', 'SMP BUSTANUL MUTAALIMIN', 'BLITAR ', '2009-02-05', 'Darungan', '085183766497', 'rahmadante09.d2nt3@gmail.com', 'TKJ', 'DKV', '-', 'Joko Supriadi ', 'Evi Suciati ', '2025-07-09 13:48:46'),
(63, 'YP17202507090005', 'CALVIN FAREL KURNIASANDY', 'SMPN 2 KADEMANGAN', 'blitar', '2009-06-17', 'DS.PLOSOREJO, DSN.PARAAN, RT03, RW 09, blitar', '085775420760', 'kelvinfarell735@gmail.com', 'TKR', 'TSM', '-', 'JOKO SUSELO', 'susana', '2025-07-09 14:38:29'),
(64, 'YP17202507090003', 'Sirajul Wisnu', 'SMPN 2 Kademangan ', 'Blitar', '2009-06-24', 'desa plosorejo dusun paraan rt03/rw09 Kab. Blitar', '085646696032', 'tuluswong331@gmail.com', 'TKR', 'TSM', '-', 'Khoirul Maruf', 'Choirul Nikmah', '2025-07-09 15:07:20'),
(65, 'YP17202507090004', 'eko', 'smpn 1 garum', 'Blitar', '1998-11-04', 'Taman Kertamukti Residence Blok C30 No 02', '08666', 'eko@gmail.com', 'TKR', 'TKJ', 'PKH', 'sabar santoso', 'istilah', '2025-07-09 15:07:31'),
(66, 'YP17202507090001', 'Sirajul Wisnu (Double Input)', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2025-07-09 15:08:17'),
(67, 'YP17202507090002', 'Sirajul Wisnu (Double Input)', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '2025-07-09 15:08:49'),
(68, 'YP17202507110001', 'Fatkul Ibnu Rohman ', 'SMPN 14 malang ', 'Malang', '2009-05-27', 'Dukuh golek ', '082257543570', 'fatkulibnu27@gmail.com', 'TEI', 'TEI', 'BSL', 'Edy mulyono (ALM)', 'Dewi nurwati ', '2025-07-11 22:15:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1645064505', NULL, 1, '2021-01-20 14:02:37', '2022-02-17 10:21:45'),
(5, 'John', 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', 'uploads/avatars/5.png?v=1645514943', NULL, 2, '2022-02-22 15:29:03', '2022-02-22 15:34:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_siswa_ditolak`
--
ALTER TABLE `tbl_siswa_ditolak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_siswa_verifikasi`
--
ALTER TABLE `tbl_siswa_verifikasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa_verifikasi`
--
ALTER TABLE `tbl_siswa_verifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
