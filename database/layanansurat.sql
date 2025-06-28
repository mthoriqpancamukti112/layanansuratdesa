-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2025 at 03:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `layanansurat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kewarganegaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_buat` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `nik`, `no_kk`, `username`, `jk`, `tempat_lahir`, `tgl_lahir`, `kewarganegaraan`, `agama`, `status`, `pendidikan`, `pekerjaan`, `provinsi`, `kabupaten`, `kecamatan`, `alamat`, `no_hp`, `desa`, `tgl_buat`, `created_at`, `updated_at`) VALUES
(1, 1, '1234567890123456', '8766547656546546', 'admin', 'Laki-laki', 'Mataram', '2000-10-01', 'Indonesia', 'Islam', 'Menikah', 'Sarjana', 'Administrator', 'Nusa Tenggara Barat', 'Mataram', 'Ampenan', 'Jl. Jenderal Sudirman No.1', '081234567890', 'Pejarakan Karya', '2024-06-26', '2024-06-16 19:02:46', '2024-06-26 00:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_ahliwaris`
--

CREATE TABLE `anggota_ahliwaris` (
  `id` bigint UNSIGNED NOT NULL,
  `surat_penduduk_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggota_ahliwaris`
--

INSERT INTO `anggota_ahliwaris` (`id`, `surat_penduduk_id`, `nama`, `nik`, `tempat_lahir`, `tgl_lahir`, `jk`, `created_at`, `updated_at`) VALUES
(1, 5, 'Muthopati', '1234567890123456', 'Mataram', '2024-07-18', 'Laki-laki', '2024-07-18 07:19:25', '2024-07-18 07:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_keluarga_pindahs`
--

CREATE TABLE `anggota_keluarga_pindahs` (
  `id` bigint UNSIGNED NOT NULL,
  `surat_penduduk_id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shdk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggota_keluarga_pindahs`
--

INSERT INTO `anggota_keluarga_pindahs` (`id`, `surat_penduduk_id`, `nik`, `nama`, `shdk`, `created_at`, `updated_at`) VALUES
(1, 4, '1234567890123456', 'Muthopati', 'Anak', '2024-07-18 07:17:56', '2024-07-18 07:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `desas`
--

CREATE TABLE `desas` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_kantor` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kades` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_kades` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sekdes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_sekdes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bendahara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `desas`
--

INSERT INTO `desas` (`id`, `image`, `nama_desa`, `kecamatan`, `kabupaten`, `provinsi`, `alamat_kantor`, `no_telp`, `email`, `kades`, `nip_kades`, `sekdes`, `nip_sekdes`, `bendahara`, `created_at`, `updated_at`) VALUES
(1, '20240617035445.png', 'Belake', 'Gerung', 'Lombok Barat', 'Nusa Tenggara Barat', 'Jl.DR Sutomo Beleke-Gerung Kode Pos. 83363', '089876765665', 'desabeleke21@gmail.com', 'Islahudin, S.IP', '19287182', 'Amrullah Yusup', '12871827', 'Maisah', '2024-06-16 19:54:45', '2024-06-16 19:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `detail_surats`
--

CREATE TABLE `detail_surats` (
  `id` bigint UNSIGNED NOT NULL,
  `surat_penduduk_id` bigint UNSIGNED NOT NULL,
  `bidang_usaha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berjalan_sejak` date DEFAULT NULL,
  `alamat_usaha` text COLLATE utf8mb4_unicode_ci,
  `nama_usaha_skusaha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keperluan_tidakmampu` text COLLATE utf8mb4_unicode_ci,
  `upload_kk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alasan_pindah` enum('Pekerjaan','Pendidikan','Keamanan','Kesehatan','Perumahan','Keluarga','Pindah Tempat Tinggal') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_tujuan_pindah` text COLLATE utf8mb4_unicode_ci,
  `nama_desa_pindah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan_pindah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten_pindah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi_pindah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` int DEFAULT NULL,
  `rt` int DEFAULT NULL,
  `rw` int DEFAULT NULL,
  `klasifikasi_pindah` enum('Dalam Satu Desa/Kelurahan','Antar Desa/Kelurahan','Antar Kecamatan','Antar Kab/Kota','Antar Provinsi') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_perpindahan` enum('Kepala Keluarga','Kep. Keluarga dan Seluruh Anggota Keluarga','Kep. Keluarga dan Sebagian Anggota Keluarga','Anggota Keluarga') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_no_kk_tidakpindah` enum('Numpang KK','Membuat KK baru','Tidak ada anggota keluarga yang ditinggal','Nomor KK tetap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_no_kk_pindah` enum('Numpang KK','Membuat KK baru','Nama Kep. keluarga dan No. KK tetap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rencana_tgl_pindah` date DEFAULT NULL,
  `keperluan_ahliwaris` text COLLATE utf8mb4_unicode_ci,
  `nama_usaha_rekomendasibbm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konsumen_pengguna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_usaha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_alat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fungsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_alat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daya_alat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lama_penggunaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lama_operasi_alat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konsumsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alat_pembelian_digunakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dusun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_desa_sktanah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan_sktanah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten_sktanah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luas_tanah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_tanah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `digunakan_untuk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cara_memperoleh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batas_utara` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batas_timur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batas_selatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batas_barat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keperluan_sktanah` text COLLATE utf8mb4_unicode_ci,
  `jumlah_penghasilan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_surats`
--

INSERT INTO `detail_surats` (`id`, `surat_penduduk_id`, `bidang_usaha`, `berjalan_sejak`, `alamat_usaha`, `nama_usaha_skusaha`, `keperluan_tidakmampu`, `upload_kk`, `upload_ktp`, `alasan_pindah`, `alamat_tujuan_pindah`, `nama_desa_pindah`, `kecamatan_pindah`, `kabupaten_pindah`, `provinsi_pindah`, `no_telp`, `kode_pos`, `rt`, `rw`, `klasifikasi_pindah`, `jenis_perpindahan`, `status_no_kk_tidakpindah`, `status_no_kk_pindah`, `rencana_tgl_pindah`, `keperluan_ahliwaris`, `nama_usaha_rekomendasibbm`, `konsumen_pengguna`, `jenis_usaha`, `jenis_alat`, `fungsi`, `jumlah_alat`, `daya_alat`, `lama_penggunaan`, `lama_operasi_alat`, `konsumsi`, `alat_pembelian_digunakan`, `dusun`, `nama_desa_sktanah`, `kecamatan_sktanah`, `kabupaten_sktanah`, `luas_tanah`, `status_tanah`, `digunakan_untuk`, `cara_memperoleh`, `batas_utara`, `batas_timur`, `batas_selatan`, `batas_barat`, `keperluan_sktanah`, `jumlah_penghasilan`, `keperluan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Perdagangan', '2015-06-08', 'Jln Lestari', 'Dagang Geprek', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-18 05:47:32', '2024-07-18 05:47:32'),
(2, 2, 'Perdagangan', '2024-07-18', 'Mataram', 'Dagang Cilok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-18 06:38:15', '2024-07-18 06:38:15'),
(3, 3, NULL, NULL, NULL, NULL, 'contoh saja', 'Thoriq_20240718151457_kk.jpeg', 'Thoriq_20240718151457_ktp.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-18 07:14:57', '2024-07-18 07:14:57'),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pindah Tempat Tinggal', 'Dusun Rumak Barat Utara', 'Pejarakan', 'Ampenan', 'Mataram', 'Nusa Tenggara Barat', '089876765665', 83113, 3, 4, 'Antar Desa/Kelurahan', 'Anggota Keluarga', 'Nomor KK tetap', 'Membuat KK baru', '2024-07-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-18 07:17:56', '2024-07-18 07:17:56'),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'contoh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-18 07:19:25', '2024-07-18 07:19:25'),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Penan', 'Pejarakan', 'Ampenan', 'Mataram', '60', 'contoh', 'contoh', 'contoh', 'contoh', 'contoh', 'contoh', 'contoh', 'contoh', NULL, NULL, '2024-07-18 07:20:47', '2024-07-18 07:20:47'),
(8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'contoh', 'contoh', 'contoh', 'contoh', 'contoh', '3', '120', '1 hari', '3 jam', 'contoh', 'contoh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-18 07:22:40', '2024-07-18 07:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_08_231344_create_admins_table', 1),
(6, '2024_06_08_231513_create_penduduks_table', 1),
(7, '2024_06_09_000946_create_desas_table', 2),
(8, '2024_06_09_005226_create_permohonan_surats_table', 2),
(9, '2024_06_10_114344_create_surats_table', 3),
(10, '2024_06_17_025830_create_surat_penduduks_table', 4),
(11, '2024_06_17_025916_create_detail_surats_table', 4),
(12, '2024_06_17_030006_create_anggota_ahliwaris_table', 4),
(13, '2024_06_17_030022_create_anggota_keluarga_pindahs_table', 4),
(14, '2024_07_07_230730_create_anggota_ahliwaris_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `penduduks`
--

CREATE TABLE `penduduks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `no_kk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kewarganegaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penduduks`
--

INSERT INTO `penduduks` (`id`, `user_id`, `no_kk`, `nik`, `jk`, `tempat_lahir`, `tgl_lahir`, `kewarganegaraan`, `agama`, `status`, `pendidikan`, `pekerjaan`, `provinsi`, `kabupaten`, `kecamatan`, `desa`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, 2, '1234567890123456', '1234567890123456', 'Laki-laki', 'Mataram', '2000-01-10', 'Indonesia', 'Islam', 'Belum Menikah', 'SMA', 'Mahasiswa', 'Nusa Tenggara Barat', 'Mataram', 'Ampenan', 'Pejarakan Karya', 'Jln. Lestari Penan', '081233799312', '2024-06-16 19:05:27', '2024-06-16 19:05:27'),
(3, 6, '1234567890198767', '1234567890123457', 'Laki-laki', 'Mataram', '2024-07-08', 'Indonesia', 'Islam', 'Belum Menikah', 'S1', 'Mahasiswa', 'Nusa Tenggara Barat', 'Mataram', 'Ampenan', 'Pejarakan Karya', 'Lestari', '089876564443', '2024-07-18 06:36:35', '2024-07-18 06:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_surats`
--

CREATE TABLE `permohonan_surats` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_buat` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surats`
--

CREATE TABLE `surats` (
  `id` bigint UNSIGNED NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_surat` enum('usaha','tidak_mampu','pindah','ahliwaris','tanah','rekomendasibbm','penghasilan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surats`
--

INSERT INTO `surats` (`id`, `no_surat`, `nama_surat`, `jenis_surat`, `created_at`, `updated_at`) VALUES
(1, '510/......./Pemb.BLK/......../2024', 'Keterangan Usaha', 'usaha', '2024-06-16 19:02:46', '2024-06-16 19:02:46'),
(2, '401/......./Pemb.BLK/......../2024', 'Keterangan Tidak Mampu', 'tidak_mampu', '2024-06-16 19:02:46', '2024-06-16 19:02:46'),
(3, '471/......./BLK/......../2024', 'Keterangan Ahli Waris', 'ahliwaris', '2024-06-16 19:02:46', '2024-06-16 19:02:46'),
(4, '471/......./Pemb.BLK/......../2024', 'Keterangan Milik Tanah', 'tanah', '2024-06-16 19:02:46', '2024-06-16 19:02:46'),
(5, '510/......../Pemb.BLK/......../2024', 'Keterangan Pindah', 'pindah', '2024-06-16 19:02:46', '2024-06-16 19:02:46'),
(6, '510/Kades/52/52/01.01.2009/Tani/JBT/VI/2024', 'Rekomendasi BBM', 'rekomendasibbm', '2024-06-16 19:02:46', '2024-06-16 19:02:46'),
(8, '401/....../Kesra.BLK/....../2024', 'Keterangan Penghasilan Orang Tua', 'penghasilan', '2024-07-21 23:45:23', '2024-07-21 23:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `surat_penduduks`
--

CREATE TABLE `surat_penduduks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `surat_id` bigint UNSIGNED NOT NULL,
  `desa_id` bigint UNSIGNED NOT NULL,
  `status` enum('diproses','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diproses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_penduduks`
--

INSERT INTO `surat_penduduks` (`id`, `user_id`, `surat_id`, `desa_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'disetujui', '2024-07-18 05:47:32', '2024-07-18 05:48:19'),
(2, 6, 1, 1, 'disetujui', '2024-07-18 06:38:15', '2024-07-18 06:38:38'),
(3, 6, 2, 1, 'disetujui', '2024-07-18 07:14:57', '2024-07-18 07:16:23'),
(4, 6, 5, 1, 'disetujui', '2024-07-18 07:17:56', '2024-07-18 07:18:07'),
(5, 6, 3, 1, 'disetujui', '2024-07-18 07:19:25', '2024-07-18 07:19:31'),
(6, 6, 4, 1, 'disetujui', '2024-07-18 07:20:47', '2024-07-18 07:20:53'),
(8, 6, 6, 1, 'disetujui', '2024-07-18 07:22:40', '2024-07-18 07:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','penduduk') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'null', 'Admin Desa Beleka', 'admin@gmail.com', NULL, '$2y$10$W.ajyU3X2NrKgtcQScjFXeWfnfwi4HDJb1KKNPYAvMgzg.jCyNhWq', 'admin', NULL, '2024-06-16 19:02:46', '2024-06-16 19:02:46'),
(2, '1234567890123456', 'M Thoriq Panca Mukti', NULL, NULL, NULL, 'penduduk', NULL, '2024-06-16 19:05:27', '2024-06-16 19:05:27'),
(6, '1234567890123457', 'Thoriq', NULL, NULL, NULL, 'penduduk', NULL, '2024-07-18 06:36:35', '2024-07-18 06:36:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_nik_unique` (`nik`),
  ADD UNIQUE KEY `admins_no_kk_unique` (`no_kk`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indexes for table `anggota_ahliwaris`
--
ALTER TABLE `anggota_ahliwaris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_ahliwaris_surat_penduduk_id_foreign` (`surat_penduduk_id`);

--
-- Indexes for table `anggota_keluarga_pindahs`
--
ALTER TABLE `anggota_keluarga_pindahs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_keluarga_pindahs_surat_penduduk_id_foreign` (`surat_penduduk_id`);

--
-- Indexes for table `desas`
--
ALTER TABLE `desas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_surats`
--
ALTER TABLE `detail_surats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_surats_surat_penduduk_id_foreign` (`surat_penduduk_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penduduks`
--
ALTER TABLE `penduduks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penduduks_no_kk_unique` (`no_kk`),
  ADD UNIQUE KEY `penduduks_nik_unique` (`nik`),
  ADD KEY `penduduks_user_id_foreign` (`user_id`);

--
-- Indexes for table `permohonan_surats`
--
ALTER TABLE `permohonan_surats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surats`
--
ALTER TABLE `surats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_penduduks`
--
ALTER TABLE `surat_penduduks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_penduduks_user_id_foreign` (`user_id`),
  ADD KEY `surat_penduduks_surat_id_foreign` (`surat_id`),
  ADD KEY `surat_penduduks_desa_id_foreign` (`desa_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `anggota_ahliwaris`
--
ALTER TABLE `anggota_ahliwaris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anggota_keluarga_pindahs`
--
ALTER TABLE `anggota_keluarga_pindahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `desas`
--
ALTER TABLE `desas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_surats`
--
ALTER TABLE `detail_surats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `penduduks`
--
ALTER TABLE `penduduks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permohonan_surats`
--
ALTER TABLE `permohonan_surats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surats`
--
ALTER TABLE `surats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `surat_penduduks`
--
ALTER TABLE `surat_penduduks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `anggota_ahliwaris`
--
ALTER TABLE `anggota_ahliwaris`
  ADD CONSTRAINT `anggota_ahliwaris_surat_penduduk_id_foreign` FOREIGN KEY (`surat_penduduk_id`) REFERENCES `surat_penduduks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `anggota_keluarga_pindahs`
--
ALTER TABLE `anggota_keluarga_pindahs`
  ADD CONSTRAINT `anggota_keluarga_pindahs_surat_penduduk_id_foreign` FOREIGN KEY (`surat_penduduk_id`) REFERENCES `surat_penduduks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_surats`
--
ALTER TABLE `detail_surats`
  ADD CONSTRAINT `detail_surats_surat_penduduk_id_foreign` FOREIGN KEY (`surat_penduduk_id`) REFERENCES `surat_penduduks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penduduks`
--
ALTER TABLE `penduduks`
  ADD CONSTRAINT `penduduks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surat_penduduks`
--
ALTER TABLE `surat_penduduks`
  ADD CONSTRAINT `surat_penduduks_desa_id_foreign` FOREIGN KEY (`desa_id`) REFERENCES `desas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surat_penduduks_surat_id_foreign` FOREIGN KEY (`surat_id`) REFERENCES `surats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surat_penduduks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
