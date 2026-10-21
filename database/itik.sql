-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 21, 2026 at 06:42 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itik`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `draft_jawaban`
--

CREATE TABLE `draft_jawaban` (
  `id_draft` int NOT NULL,
  `id_kuis` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL COMMENT 'Siswa yang mengerjakan',
  `id_soal` varchar(50) NOT NULL,
  `jawaban_dipilih` varchar(5) DEFAULT NULL COMMENT 'A/B/C/D/E',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `draft_jawaban`
--

INSERT INTO `draft_jawaban` (`id_draft`, `id_kuis`, `id_user`, `id_soal`, `jawaban_dipilih`, `updated_at`) VALUES
(9, 'K005', 'U002', 'S002', 'B', '2026-09-30 11:59:03'),
(10, 'K005', 'U002', 'S003', 'B', '2026-09-30 11:59:04'),
(11, 'K005', 'U002', 'S004', 'B', '2026-09-30 11:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kuis`
--

CREATE TABLE `kuis` (
  `id_kuis` varchar(50) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi` text,
  `kategori` varchar(50) NOT NULL COMMENT 'post-test/pass-test/kuis harian/ulangan/remedial',
  `alokasi_waktu` int UNSIGNED DEFAULT NULL COMMENT 'Batas waktu pengerjaan dalam menit',
  `kkm` decimal(5,2) DEFAULT NULL COMMENT 'Nilai minimum kelulusan (KKM) untuk kuis ini',
  `waktu_mulai` datetime DEFAULT NULL COMMENT 'Khusus kategori ulangan: kapan ulangan mulai bisa diakses semua siswa',
  `waktu_selesai` datetime DEFAULT NULL COMMENT 'Khusus kategori ulangan: kapan ulangan ditutup, tidak bisa diakses lagi',
  `id_user` varchar(50) NOT NULL COMMENT 'Guru/operator pembuat kuis (remedial khusus guru)',
  `status_publikasi` varchar(20) NOT NULL DEFAULT 'draft' COMMENT 'draft/terbit - validasi isi soal, bukan nilai',
  `id_publisher` varchar(50) DEFAULT NULL COMMENT 'Guru yang mempublikasikan/memvalidasi kuis ini',
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Soft delete: 0 = diarsipkan/dihapus',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kuis`
--

INSERT INTO `kuis` (`id_kuis`, `judul`, `deskripsi`, `kategori`, `alokasi_waktu`, `kkm`, `waktu_mulai`, `waktu_selesai`, `id_user`, `status_publikasi`, `id_publisher`, `is_aktif`, `created_at`) VALUES
('K001', 'Pass-test Bab 1 - Algoritma', 'Kuis kelulusan Bab 1', 'pass-test', 20, 75.00, NULL, NULL, 'U001', 'terbit', 'U001', 0, '2026-09-22 23:35:25'),
('K002', 'Ulangan Tengah Semester', 'Mencakup Bab 1 dan Bab 2', 'ulangan', 60, 75.00, NULL, NULL, 'U001', 'terbit', 'U001', 0, '2026-09-22 23:35:25'),
('K003', 'Kuis Harian Bab 1', 'Kuis harian untuk latihan rutin Bab 1', 'kuis harian', 15, 70.00, NULL, NULL, 'U003', 'draft', NULL, 1, '2026-09-22 23:35:25'),
('K004', 'Remedial Pass-test Bab 1', 'Kuis remedial untuk siswa yang belum lulus K001', 'remedial', 20, 75.00, NULL, NULL, 'U001', 'terbit', 'U001', 0, '2026-09-22 23:35:25'),
('K005', 'Kuis coba', NULL, 'kuis harian', 10, 75.00, NULL, NULL, 'U001', 'terbit', NULL, 0, '2026-09-29 02:08:20'),
('K006', 'FREE FIRE', 'Battle royal dulu', 'kuis harian', 10, 50.00, NULL, NULL, 'U001', 'draft', NULL, 1, '2026-09-30 06:32:01'),
('K007', 'ufo', 'wq', 'post-test', 25, 50.00, NULL, NULL, 'U001', 'draft', NULL, 1, '2026-09-30 16:50:41'),
('K008', 'FREE FIRE', 'sdfbgfvdcs', 'kuis harian', 60, 100.00, NULL, NULL, 'U001', 'terbit', 'U001', 1, '2026-09-30 18:04:15'),
('K009', 'kamis', 'asasas', 'post-test', 60, 75.00, NULL, NULL, 'U001', 'terbit', 'U001', 1, '2026-10-01 00:10:18'),
('K010', 'kamis', 'asasas', 'post-test', 60, 75.00, NULL, NULL, 'U001', 'draft', NULL, 1, '2026-10-01 02:06:02'),
('K011', 'Kuis Benar', 'benar lengkap', 'post-test', 300, 100.00, NULL, NULL, 'U001', 'terbit', 'U001', 1, '2026-10-01 02:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` varchar(50) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `bab` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `deskripsi` text,
  `isi_materi` varchar(255) DEFAULT NULL COMMENT 'Path/nama file PDF materi, contoh: uploads/materi/materi01.pdf',
  `link_youtube` varchar(255) DEFAULT NULL,
  `id_user` varchar(50) NOT NULL COMMENT 'Guru/operator yang mengelola materi ini',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `judul`, `bab`, `kelas`, `deskripsi`, `isi_materi`, `link_youtube`, `id_user`, `created_at`, `updated_at`) VALUES
('M001', 'doa', 'bab2', 'X', 'Materi dasar mengenai konsep algoritma dan langkah-langkah pemrograman.', 'uploads/materi/M001_algoritma.pdf', 'https://www.youtube.com/watch?v=contoh123', 'U001', '2026-09-22 23:35:25', '2026-09-30 08:47:27'),
('M002', 'Struktur Data Dasar', 'Bab 2', 'X', 'Pengenalan array, list, dan struktur data sederhana.', 'uploads/materi/M002_struktur_data.pdf', NULL, 'U003', '2026-09-22 23:35:25', '2026-09-22 23:35:25'),
('M003', 'dosa', 'bab2', 'X', 'QWQW', 'materi/5mdUpYdtsYNWa5KOeRsvzXfYgbjipJ30hvqR2aW6.pdf', NULL, 'U001', '2026-09-29 23:50:04', '2026-09-29 23:50:04'),
('M004', 'dosa', 'bab 4', 'X', 'sdwfeggnhm', NULL, NULL, 'U001', '2026-09-30 11:03:05', '2026-09-30 11:03:05'),
('M005', 'coba kamis', 'bab 4234567890-=098765432134567890', 'x', 'iasmckdsoncodsnv nb nungervmeigmjcfpfriojfkcfopwx', 'materi/MFuzEddrO0qVaCsYZj8iofomxmqQYMg7pI4fyiZu.pdf', NULL, 'U001', '2026-09-30 17:22:34', '2026-09-30 17:58:40'),
('M006', 'dosa#', 'bab1', 'X', 'iya', NULL, NULL, 'U001', '2026-09-30 18:57:04', '2026-09-30 18:58:50'),
('M007', 'Test Upload PDF', 'Bab 7', 'X', 'Materi untuk menguji unggah dan tampilan PDF siswa.', 'materi/hpF8Nw7k9JlGFuMfOyU4XoSjJuYoZe9ifIVnwrpc.pdf', NULL, 'U001', '2026-10-05 18:01:52', '2026-10-05 19:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `materi_kuis`
--

CREATE TABLE `materi_kuis` (
  `id_materi_kuis` int NOT NULL,
  `id_materi` varchar(50) NOT NULL,
  `id_kuis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materi_kuis`
--

INSERT INTO `materi_kuis` (`id_materi_kuis`, `id_materi`, `id_kuis`) VALUES
(1, 'M001', 'K001'),
(3, 'M001', 'K002'),
(2, 'M001', 'K003'),
(16, 'M002', 'K001'),
(4, 'M002', 'K002'),
(6, 'M002', 'K005'),
(11, 'M002', 'K008'),
(15, 'M002', 'K011'),
(17, 'M003', 'K003'),
(8, 'M003', 'K006'),
(10, 'M003', 'K007'),
(12, 'M004', 'K009'),
(14, 'M004', 'K010');

-- --------------------------------------------------------

--
-- Table structure for table `mengerjakan`
--

CREATE TABLE `mengerjakan` (
  `id_mengerjakan` int NOT NULL,
  `id_kuis` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL COMMENT 'Siswa yang mengerjakan',
  `nilai` decimal(5,2) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `percobaan_ke` int NOT NULL DEFAULT '1' COMMENT 'Percobaan ke berapa (mendukung kerjakan ulang)',
  `status_pengerjaan` varchar(20) NOT NULL DEFAULT 'final' COMMENT 'final/dibatalkan',
  `status_validasi` varchar(50) DEFAULT 'belum divalidasi' COMMENT 'Validasi NILAI oleh guru',
  `id_validator` varchar(50) DEFAULT NULL COMMENT 'Guru yang memvalidasi nilai ini'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mengerjakan`
--

INSERT INTO `mengerjakan` (`id_mengerjakan`, `id_kuis`, `id_user`, `nilai`, `tanggal`, `percobaan_ke`, `status_pengerjaan`, `status_validasi`, `id_validator`) VALUES
(1, 'K001', 'U002', 60.00, '2026-09-05', 1, 'final', 'sudah divalidasi', 'U001'),
(3, 'K005', 'U002', 100.00, '2026-09-29', 1, 'final', 'belum divalidasi', NULL),
(4, 'K005', 'U002', 33.33, '2026-09-30', 2, 'final', 'sudah divalidasi', 'U001'),
(5, 'K005', 'U002', 33.33, '2026-09-30', 3, 'final', 'sudah divalidasi', 'U001'),
(6, 'K008', 'U002', 100.00, '2026-09-30', 1, 'final', 'belum divalidasi', NULL),
(8, 'K008', 'U002', 0.00, '2026-09-30', 2, 'final', 'belum divalidasi', NULL),
(11, 'K008', 'U002', 100.00, '2026-09-30', 3, 'final', 'sudah divalidasi', 'U001'),
(15, 'K001', 'U002', 100.00, '2026-09-30', 2, 'final', 'belum divalidasi', NULL),
(16, 'K008', 'U002', 50.00, '2026-09-30', 4, 'final', 'sudah divalidasi', 'U001'),
(17, 'K001', 'U002', 100.00, '2026-09-30', 3, 'final', 'belum divalidasi', NULL),
(18, 'K009', 'U002', 50.00, '2026-10-01', 1, 'final', 'sudah divalidasi', 'U001'),
(19, 'K011', 'U002', 0.00, '2026-10-01', 1, 'final', 'belum divalidasi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id_progress` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL COMMENT 'Contoh: belum mulai, sedang belajar, selesai',
  `tanggal` date DEFAULT NULL,
  `id_materi` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL COMMENT 'Siswa pemilik progress ini'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id_progress`, `status`, `tanggal`, `id_materi`, `id_user`) VALUES
('P001', 'selesai', '2026-09-05', 'M001', 'U002'),
('PJEO2XWPVLZ', 'selesai', '2026-09-30', 'M003', 'U002'),
('PSE5HIYZODX', 'selesai', '2026-09-30', 'M002', 'U002');

-- --------------------------------------------------------

--
-- Table structure for table `remedial`
--

CREATE TABLE `remedial` (
  `id_remedial` int NOT NULL,
  `id_kuis_remedial` varchar(50) NOT NULL COMMENT 'Kuis dengan kategori=remedial',
  `id_kuis_asal` varchar(50) NOT NULL COMMENT 'Kuis asal (misal pass-test) yang jadi alasan remedial'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `remedial`
--

INSERT INTO `remedial` (`id_remedial`, `id_kuis_remedial`, `id_kuis_asal`) VALUES
(1, 'K004', 'K001');

-- --------------------------------------------------------

--
-- Table structure for table `remedial_siswa`
--

CREATE TABLE `remedial_siswa` (
  `id_remedial_siswa` int NOT NULL,
  `id_kuis_remedial` varchar(50) NOT NULL,
  `id_mengerjakan_asal` int NOT NULL COMMENT 'Baris nilai siswa yang di bawah KKM (alasan diberi remedial)',
  `id_guru` varchar(50) NOT NULL COMMENT 'Guru yang menugaskan remedial ini',
  `tanggal_ditugaskan` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'ditugaskan' COMMENT 'ditugaskan/selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `remedial_siswa`
--

INSERT INTO `remedial_siswa` (`id_remedial_siswa`, `id_kuis_remedial`, `id_mengerjakan_asal`, `id_guru`, `tanggal_ditugaskan`, `status`) VALUES
(3, 'K004', 1, 'U001', '2026-10-01', 'ditugaskan');

-- --------------------------------------------------------

--
-- Table structure for table `sesi_kuis`
--

CREATE TABLE `sesi_kuis` (
  `id_sesi` int NOT NULL,
  `id_kuis` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL COMMENT 'Siswa yang memulai kuis',
  `percobaan_ke` int UNSIGNED NOT NULL DEFAULT '1',
  `waktu_mulai` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waktu_selesai` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sesi_kuis`
--

INSERT INTO `sesi_kuis` (`id_sesi`, `id_kuis`, `id_user`, `percobaan_ke`, `waktu_mulai`, `waktu_selesai`) VALUES
(3, 'K008', 'U002', 1, '2026-09-30 11:58:29', '2026-09-30 11:58:41'),
(4, 'K005', 'U002', 1, '2026-09-30 11:58:59', NULL),
(5, 'K008', 'U002', 2, '2026-09-30 11:59:23', '2026-09-30 11:59:30'),
(6, 'K002', 'U002', 1, '2026-09-30 11:59:38', NULL),
(7, 'K004', 'U002', 1, '2026-09-30 11:59:59', NULL),
(8, 'K001', 'U002', 1, '2026-09-30 12:00:08', '2026-09-30 12:18:47'),
(9, 'K008', 'U002', 3, '2026-09-30 12:09:33', '2026-09-30 12:09:39'),
(10, 'K008', 'U002', 4, '2026-09-30 12:18:51', '2026-09-30 12:18:55'),
(11, 'K001', 'U002', 3, '2026-09-30 12:19:00', '2026-09-30 12:19:06'),
(12, 'K009', 'U002', 1, '2026-09-30 18:37:28', '2026-09-30 18:37:38'),
(13, 'K011', 'U002', 1, '2026-09-30 19:22:14', '2026-09-30 19:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4V6R5ef9PG0vvR8y3eo8jw9J7V2JLf4QSOkVEdse', 'U001', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJXZ09jQTlYbTIzazg0VDRuRWhNcjJKTG5Bbk13RXRPNnV0MllsTDNFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9rdWlzIiwicm91dGUiOiJrdWlzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOiJVMDAxIiwicGFzc3dvcmRfaGFzaF93ZWIiOiIyYzUzOWU4ZjgzZTc2YTAyY2MzZDFjZDg2YTU5NTc3MjU5OWNiNjVlMjcyNzAyZWFlMGJlNDA3MDY2NzM4MWU1In0=', 1792547892);

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` varchar(50) NOT NULL,
  `id_kuis` varchar(50) NOT NULL,
  `pertanyaan` text NOT NULL,
  `opsi_a` varchar(255) DEFAULT NULL,
  `opsi_b` varchar(255) DEFAULT NULL,
  `opsi_c` varchar(255) DEFAULT NULL,
  `opsi_d` varchar(255) DEFAULT NULL,
  `opsi_e` varchar(255) DEFAULT NULL,
  `jawaban` varchar(5) DEFAULT NULL COMMENT 'Contoh: A/B/C/D/E',
  `bobot` decimal(5,2) NOT NULL DEFAULT '1.00',
  `tingkat_kesulitan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_kuis`, `pertanyaan`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `jawaban`, `bobot`, `tingkat_kesulitan`) VALUES
('S001', 'K001', 'Apa yang dimaksud dengan algoritma?', 'Bahasa pemrograman', 'Langkah-langkah logis penyelesaian masalah', 'Perangkat keras komputer', 'Sistem operasi', 'Jaringan komputer', 'B', 1.00, 'Mudah'),
('S002', 'K005', 'asdfghj', 'sa', 'cs', 'a', 'c', NULL, 'B', 1.00, 'Sedang'),
('S003', 'K005', 'xsxcscvdv', 'cddcdvew', 'dwdw', 'dwcwc', 'cscs', NULL, 'D', 1.00, 'Sedang'),
('S004', 'K005', 'v,mjhtyjk', 'nmhgtr', 'nbgfde', 'fdew', 'fv', NULL, 'A', 1.00, 'Sedang'),
('S005', 'K008', 'sadan', 'sadan', 'sadan', 'sadan', 'sadan', 'sadan', 'A', 50.00, 'mudah'),
('S006', 'K008', 'sadan arya', 'sadan', 'sadan', 'sadan', 'sadan', 'sadan', 'A', 50.00, 'mudah'),
('S007', 'K009', 'poiuhytrew', 'nk', 'oonojn', 'bnm', 'byibhilubn', NULL, 'A', 50.00, NULL),
('S008', 'K009', 'mcowpmcwkp', 'dwlq', 'ncejwko', 'kfrfk', 'r4r fj f', NULL, 'A', 50.00, 'sedang'),
('S009', 'K011', 'nkdsakdnwejfweopfmf', 'jndwnqon', 'nqwecnq', 'ndwqnd', 'dwqbd', NULL, 'B', 50.00, 'mudah'),
('S010', 'K011', 'nkdsakdnwejfweopfm', 'jndwnqon', 'nqwecnq', 'ndwqnd', 'dwqbd', NULL, 'B', 50.00, 'mudah');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(50) NOT NULL,
  `nomor_induk` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('guru','operator','siswa') NOT NULL,
  `kelas` varchar(50) DEFAULT NULL COMMENT 'Hanya diisi jika role=siswa, contoh: X, XI IPA 1',
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nomor_induk`, `nama_lengkap`, `role`, `kelas`, `email`, `password`) VALUES
('U001', '198001', 'Budi Guru', 'guru', NULL, 'budi@guru.sch.id', '$2y$12$eKPWxbVjXMbny45BTDjmnOyo1TTQmJqYjQoISOPlhn88ikQedvf/u'),
('U002', '202401', 'Siti Siswa', 'siswa', 'X', 'siti@siswa.sch.id', '$2y$12$Kg6QdWb756qCRmbnJqA7xeUqbzCBpP0mDWI9nkSSTX3iDWmGO4EsS'),
('U003', '199001', 'Andi Operator', 'operator', NULL, 'andi@sekolah.sch.id', '$2y$10$h56zOQg/eu0LTTADjhBD0.O.s.cyuan6L1hv0ZxRrT/T40U1qlOcq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `draft_jawaban`
--
ALTER TABLE `draft_jawaban`
  ADD PRIMARY KEY (`id_draft`),
  ADD UNIQUE KEY `uq_draft` (`id_kuis`,`id_user`,`id_soal`),
  ADD KEY `fk_draft_user` (`id_user`),
  ADD KEY `fk_draft_soal` (`id_soal`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kuis`
--
ALTER TABLE `kuis`
  ADD PRIMARY KEY (`id_kuis`),
  ADD KEY `fk_kuis_user` (`id_user`),
  ADD KEY `fk_kuis_publisher` (`id_publisher`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD UNIQUE KEY `uq_materi_judul` (`kelas`,`bab`,`judul`),
  ADD KEY `fk_materi_user` (`id_user`);

--
-- Indexes for table `materi_kuis`
--
ALTER TABLE `materi_kuis`
  ADD PRIMARY KEY (`id_materi_kuis`),
  ADD UNIQUE KEY `uq_materi_kuis` (`id_materi`,`id_kuis`),
  ADD KEY `fk_materikuis_kuis` (`id_kuis`);

--
-- Indexes for table `mengerjakan`
--
ALTER TABLE `mengerjakan`
  ADD PRIMARY KEY (`id_mengerjakan`),
  ADD UNIQUE KEY `uq_kuis_siswa_percobaan` (`id_kuis`,`id_user`,`percobaan_ke`),
  ADD KEY `fk_mengerjakan_user` (`id_user`),
  ADD KEY `fk_mengerjakan_validator` (`id_validator`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id_progress`),
  ADD KEY `fk_progress_materi` (`id_materi`),
  ADD KEY `fk_progress_user` (`id_user`);

--
-- Indexes for table `remedial`
--
ALTER TABLE `remedial`
  ADD PRIMARY KEY (`id_remedial`),
  ADD UNIQUE KEY `uq_kuis_remedial` (`id_kuis_remedial`),
  ADD KEY `fk_remedial_kuisasal` (`id_kuis_asal`);

--
-- Indexes for table `remedial_siswa`
--
ALTER TABLE `remedial_siswa`
  ADD PRIMARY KEY (`id_remedial_siswa`),
  ADD UNIQUE KEY `uq_remedial_siswa` (`id_kuis_remedial`,`id_mengerjakan_asal`),
  ADD KEY `fk_remedialsiswa_mengerjakan` (`id_mengerjakan_asal`),
  ADD KEY `fk_remedialsiswa_guru` (`id_guru`);

--
-- Indexes for table `sesi_kuis`
--
ALTER TABLE `sesi_kuis`
  ADD PRIMARY KEY (`id_sesi`),
  ADD UNIQUE KEY `uq_sesi_kuis_siswa_percobaan` (`id_kuis`,`id_user`,`percobaan_ke`),
  ADD KEY `fk_sesi_user` (`id_user`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `fk_soal_kuis` (`id_kuis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `draft_jawaban`
--
ALTER TABLE `draft_jawaban`
  MODIFY `id_draft` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materi_kuis`
--
ALTER TABLE `materi_kuis`
  MODIFY `id_materi_kuis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mengerjakan`
--
ALTER TABLE `mengerjakan`
  MODIFY `id_mengerjakan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `remedial`
--
ALTER TABLE `remedial`
  MODIFY `id_remedial` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `remedial_siswa`
--
ALTER TABLE `remedial_siswa`
  MODIFY `id_remedial_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sesi_kuis`
--
ALTER TABLE `sesi_kuis`
  MODIFY `id_sesi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `draft_jawaban`
--
ALTER TABLE `draft_jawaban`
  ADD CONSTRAINT `fk_draft_kuis` FOREIGN KEY (`id_kuis`) REFERENCES `kuis` (`id_kuis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_draft_soal` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_draft_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kuis`
--
ALTER TABLE `kuis`
  ADD CONSTRAINT `fk_kuis_publisher` FOREIGN KEY (`id_publisher`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kuis_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `fk_materi_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `materi_kuis`
--
ALTER TABLE `materi_kuis`
  ADD CONSTRAINT `fk_materikuis_kuis` FOREIGN KEY (`id_kuis`) REFERENCES `kuis` (`id_kuis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_materikuis_materi` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mengerjakan`
--
ALTER TABLE `mengerjakan`
  ADD CONSTRAINT `fk_mengerjakan_kuis` FOREIGN KEY (`id_kuis`) REFERENCES `kuis` (`id_kuis`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mengerjakan_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mengerjakan_validator` FOREIGN KEY (`id_validator`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `fk_progress_materi` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_progress_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `remedial`
--
ALTER TABLE `remedial`
  ADD CONSTRAINT `fk_remedial_kuisasal` FOREIGN KEY (`id_kuis_asal`) REFERENCES `kuis` (`id_kuis`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_remedial_kuisremedial` FOREIGN KEY (`id_kuis_remedial`) REFERENCES `kuis` (`id_kuis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `remedial_siswa`
--
ALTER TABLE `remedial_siswa`
  ADD CONSTRAINT `fk_remedialsiswa_guru` FOREIGN KEY (`id_guru`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_remedialsiswa_kuis` FOREIGN KEY (`id_kuis_remedial`) REFERENCES `kuis` (`id_kuis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_remedialsiswa_mengerjakan` FOREIGN KEY (`id_mengerjakan_asal`) REFERENCES `mengerjakan` (`id_mengerjakan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sesi_kuis`
--
ALTER TABLE `sesi_kuis`
  ADD CONSTRAINT `fk_sesi_kuis` FOREIGN KEY (`id_kuis`) REFERENCES `kuis` (`id_kuis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sesi_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `fk_soal_kuis` FOREIGN KEY (`id_kuis`) REFERENCES `kuis` (`id_kuis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
