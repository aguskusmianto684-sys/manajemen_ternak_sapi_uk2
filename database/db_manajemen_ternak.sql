-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2025 at 02:37 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_manajemen_ternak`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_activities`
--

CREATE TABLE `log_activities` (
  `id_log` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `aktivitas` varchar(100) DEFAULT NULL,
  `tabel` varchar(100) DEFAULT NULL,
  `id_data` int DEFAULT NULL,
  `detail` text,
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` text,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `log_activities`
--

INSERT INTO `log_activities` (`id_log`, `id_user`, `aktivitas`, `tabel`, `id_data`, `detail`, `ip_address`, `user_agent`, `waktu`) VALUES
(1, NULL, 'Login gagal (password salah) untuk admin', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 04:27:47'),
(2, NULL, 'Login gagal (password salah) untuk admin', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 04:28:04'),
(3, NULL, 'Login gagal (username tidak ditemukan) administrator', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 04:29:58'),
(4, NULL, 'Login gagal (password salah) untuk admin', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 04:30:53'),
(5, 1, 'Login berhasil', NULL, NULL, NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 04:46:08'),
(6, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:37:27'),
(7, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:38:53'),
(8, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:40:00'),
(9, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:40:06'),
(10, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:40:10'),
(11, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:40:17'),
(12, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:40:20'),
(13, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:40:58'),
(14, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:45:55'),
(15, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:46:01'),
(16, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:46:15'),
(17, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:46:32'),
(18, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:49:57'),
(19, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:50:01'),
(20, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:50:18'),
(21, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:51:34'),
(22, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:56:14'),
(23, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:56:26'),
(24, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:58:06'),
(25, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:58:15'),
(26, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:58:38'),
(27, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:58:45'),
(28, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:59:04'),
(29, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 05:59:10'),
(30, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:02:06'),
(31, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:02:13'),
(32, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:03:48'),
(33, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:03:53'),
(34, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:04:02'),
(35, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:04:10'),
(36, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:04:20'),
(37, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:04:30'),
(38, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:04:47'),
(39, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:04:54'),
(40, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:06:46'),
(41, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:06:58'),
(42, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:07:12'),
(43, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:07:16'),
(44, 2, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:07:41'),
(45, 2, 'Update', 'pakan', NULL, 'Mengubah pakan # menjadi: Jerami, stok 300 Kg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:24:37'),
(46, 2, 'Update', 'pakan', 3, 'Mengubah pakan #3 menjadi: Jerami, stok 390 Kg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:26:06'),
(47, 2, 'Update', 'pakan', NULL, 'Mengubah pakan 3 menjadi: Jerami, stok 300 Kg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:27:02'),
(48, 2, 'Insert', 'pakan', NULL, 'Menambahkan pakan baru: Je, stok 0.09 Kg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:29:01'),
(49, 2, 'Insert', 'pakan', NULL, 'Menambahkan pakan baru: Je, stok 0.09 Kg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:29:14'),
(50, NULL, 'Delete', 'pakan', NULL, 'Menghapus pakan: ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:30:02'),
(51, 2, 'Update', 'pakan', NULL, 'Mengubah pakan 5 menjadi: Je, stok 0 Kg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:30:11'),
(52, 2, 'Update', 'pakan', 5, 'Mengubah pakan 5 menjadi: J, stok 0 Kg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:32:44'),
(53, 2, 'Insert', 'pakan', 7, 'Menambahkan pakan baru: Jeddd, stok 0 Kg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:34:28'),
(54, NULL, 'Delete', 'pakan', NULL, 'Menghapus pakan: ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:34:34'),
(55, 2, 'Delete', 'pakan', 5, 'Menghapus pakan: J', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:35:53'),
(56, 2, 'Insert', 'pemberian_pakan', 0, 'Memberikan 9 kg pakan (Rumput Segar) ke sapi 2 pada 2025-09-28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:41:16'),
(57, 2, 'Update', 'pemberian_pakan', 7, 'Mengubah pemberian pakan #7: 9 kg (Rumput Segar) untuk sapi 2 pada 2025-09-28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 06:41:52'),
(58, 2, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 10:26:40'),
(59, 2, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 10:26:52'),
(60, NULL, 'Update', 'penjualan', 2, 'Memperbarui penjualan ID 2: sapi 2 → 2, harga 12500000, pembeli Bu Sitil, tanggal 2025-09-22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 10:32:49'),
(61, NULL, 'Update', 'penjualan', 2, 'Memperbarui penjualan ID 2: sapi 2 → 2, harga 12500000, pembeli Bu Siti, tanggal 2025-09-22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 10:33:03'),
(62, 2, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 10:33:34'),
(63, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 10:33:38'),
(64, 1, 'Update', 'pemberian_pakan', 3, 'Mengubah pemberian pakan #3: 6 kg (Jerami) untuk sapi 3 pada 2025-09-14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 10:52:56'),
(65, 1, 'Update', 'pemberian_pakan', 3, 'Mengubah pemberian pakan #3: 60 kg (Jerami) untuk sapi 3 pada 2025-09-14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 10:53:33'),
(66, 1, 'Update', 'riwayat_kesehatan', 3, 'Memperbarui riwayat kesehatan ID 3 untuk sapi ID 3: Vitamina (2025-09-17)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 10:57:00'),
(67, NULL, 'Update', 'penjualan', 2, 'Memperbarui penjualan ID 2: sapi 2 → 2, harga 12500, pembeli Bu Siti, tanggal 2025-09-22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 11:01:28'),
(68, 1, 'Update', 'penjualan', 2, 'Memperbarui penjualan ID 2: sapi 2 → 2, harga 125000, pembeli Bu Siti, tanggal 2025-09-22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 11:05:06'),
(69, 1, 'Update', 'sapi', 8, 'Mengubah data sapi ID 8 (kode: SAPI006, jenis: dko, status: Mati)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 11:10:06'),
(70, 1, 'Insert', 'sapi', 9, 'Menambahkan data sapi baru dengan kode: SAPI007, jenis: Sapi Madura, status: Dijual', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-28 11:10:55'),
(71, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-29 03:45:48'),
(72, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-29 04:13:15'),
(73, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-29 04:13:20'),
(74, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 01:50:56'),
(75, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 02:53:06'),
(76, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 04:38:07'),
(77, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 04:50:40'),
(78, 2, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 04:50:52'),
(79, 2, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 04:51:07'),
(80, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 04:51:11'),
(81, 1, 'Update', 'sapi', 6, 'Mengubah data sapi ID 6 (kode: SAPI005, jenis: sapira, status: Aktif)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 05:34:16'),
(82, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-16 04:12:25'),
(83, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 05:56:08'),
(85, NULL, 'DELETE', 'sapi', 8, 'Menghapus sapi ID 8 (Kode: SAPI006, Jenis: dko)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 05:59:27'),
(86, NULL, 'Delete', 'penjualan', 4, 'Menghapus penjualan ID 4: sapi ID 6, harga 200000, pembeli memet, tanggal 2025-09-26', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:01:57'),
(87, NULL, 'DELETE', 'sapi', 6, 'Menghapus sapi ID 6 (Kode: SAPI005, Jenis: sapira)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:02:11'),
(88, 1, 'Update', 'sapi', 3, 'Mengubah data sapi ID 3 (kode: SAPI003, jenis: Sapi Madura, status: Aktif)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:03:22'),
(89, 1, 'Insert', 'sapi', 10, 'Menambahkan data sapi baru dengan kode: SAPI004, jenis: sss, status: Aktif', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:04:13'),
(90, NULL, 'DELETE', 'sapi', 10, 'Menghapus sapi ID 10 (Kode: SAPI004, Jenis: sss)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:04:18'),
(91, 1, 'Insert', 'pakan', 8, 'Menambahkan pakan baru: Jeddd, stok 0 Kg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:04:31'),
(92, 1, 'Delete', 'pakan', 8, 'Menghapus pakan: Jeddd', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:04:36'),
(93, 1, 'Update', 'pakan', 2, 'Mengubah pakan 2 menjadi: Konsentrat, stok 196.5 Kg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:04:51'),
(94, 1, 'Insert', 'pemberian_pakan', 0, 'Memberikan 1 kg pakan (Rumput Segar) ke sapi 2 pada 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:06:13'),
(95, 1, 'Insert', 'pemberian_pakan', 0, 'Memberikan 1 kg pakan (Rumput Segar) ke sapi 1 pada 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:06:52'),
(96, 1, 'Insert', 'riwayat_kesehatan', 4, 'Menambahkan riwayat kesehatan sapi ID 2: vaksin pada 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:07:32'),
(97, 1, 'Update', 'riwayat_kesehatan', 4, 'Memperbarui riwayat kesehatan ID 4 untuk sapi ID 2: vaks (2025-10-17)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:07:42'),
(98, 1, 'Delete', 'riwayat_kesehatan', 4, 'Menghapus riwayat kesehatan ID 4: vaks untuk sapi ID 2 pada 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:07:50'),
(99, 1, 'Insert', 'penjualan', 11, 'Menambahkan penjualan sapi ID 2 seharga 20000 untuk pembeli: makan pada 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:08:33'),
(100, 1, 'Update', 'penjualan', 11, 'Memperbarui penjualan ID 11: sapi 2 → 2, harga 200, pembeli makan, tanggal 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:08:46'),
(101, NULL, 'Delete', 'penjualan', 11, 'Menghapus penjualan ID 11: sapi ID 2, harga 200, pembeli makan, tanggal 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:09:00'),
(102, 1, 'Insert', 'penjualan', 12, 'Menambahkan penjualan sapi ID 2 seharga 8909 untuk pembeli: jhg pada 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:09:18'),
(103, NULL, 'Delete', 'penjualan', 12, 'Menghapus penjualan ID 12: sapi ID 2, harga 8909, pembeli jhg, tanggal 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:09:47'),
(104, 1, 'Insert', 'sapi', 11, 'Menambahkan data sapi baru dengan kode: SAPI004, jenis: dad, status: Aktif', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:14:41'),
(105, 1, 'Insert', 'penjualan', 13, 'Menambahkan penjualan sapi ID 11 seharga 1232323 untuk pembeli: jaja pada 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:15:02'),
(106, NULL, 'Delete', 'penjualan', 13, 'Menghapus penjualan ID 13: sapi ID 11, harga 1232323, pembeli jaja, tanggal 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:15:09'),
(107, NULL, 'Delete', 'sapi', 11, 'Menghapus sapi ID 11: kode SAPI004, jenis dad, berat 233.00 kg', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:15:17'),
(108, 1, 'Insert', 'sapi', 12, 'Menambahkan data sapi baru dengan kode: SAPI004, jenis: dad, status: Aktif', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:17:02'),
(109, 1, 'Insert', 'penjualan', 14, 'Menambahkan penjualan sapi ID 12 seharga 12322 untuk pembeli: ndndn pada 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:17:22'),
(110, NULL, 'DELETE', 'penjualan', 14, 'Menghapus penjualan ID 14 (Sapi ID 12, Harga 12322, Pembeli ndndn, Tanggal 2025-10-17)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:17:27'),
(111, 1, 'Insert', 'penjualan', 15, 'Menambahkan penjualan sapi ID 12 seharga 234 untuk pembeli: dfs pada 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:17:50'),
(112, 1, 'Update', 'sapi', 12, 'Mengubah data sapi ID 12 (kode: SAPI004, jenis: dad, status: Aktif)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:18:02'),
(113, NULL, 'DELETE', 'sapi', 12, 'Menghapus sapi ID 12 (Kode: SAPI004, Jenis: dad, Status: Aktif)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:18:07'),
(114, NULL, 'DELETE', 'penjualan', 2, 'Menghapus penjualan ID 2 (Sapi ID 2, Harga 125000, Pembeli Bu Siti, Tanggal 2025-09-22)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:18:24'),
(115, 1, 'Insert', 'sapi', 13, 'Menambahkan data sapi baru dengan kode: SAPI004, jenis: dad, status: Aktif', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:20:24'),
(116, 1, 'Insert', 'penjualan', 16, 'Menambahkan penjualan sapi ID 13 seharga 234 untuk pembeli: nana pada 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:20:46'),
(117, NULL, 'DELETE', 'sapi', 13, 'Menghapus sapi ID 13 (Kode: SAPI004, Jenis: dad, Status: Terjual)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:20:56'),
(118, 1, 'Insert', 'sapi', 14, 'Menambahkan data sapi baru dengan kode: SAPI004, jenis: dad, status: Aktif', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:21:21'),
(119, 1, 'Insert', 'penjualan', 17, 'Menambahkan penjualan sapi ID 14 seharga 123 untuk pembeli: dcd pada 2025-10-17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:21:37'),
(120, NULL, 'DELETE', 'penjualan', 17, 'Menghapus penjualan ID 17 (Sapi ID 14, Harga 123, Pembeli dcd, Tanggal 2025-10-17)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:21:44'),
(121, NULL, 'DELETE', 'sapi', 14, 'Menghapus sapi ID 14 (Kode: SAPI004, Jenis: dad, Status: Aktif)', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-17 06:21:52'),
(122, 2, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-19 14:50:04'),
(123, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-21 02:10:44'),
(124, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-21 06:09:20'),
(125, 2, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-21 06:11:30'),
(126, 2, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-21 06:11:44'),
(127, 2, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-21 06:12:00'),
(128, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-21 06:13:26'),
(129, 1, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-21 06:25:24'),
(130, 2, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-21 06:25:34'),
(131, 2, 'Logout', NULL, NULL, 'User berhasil logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-21 06:27:41'),
(132, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', '2025-10-21 06:27:45'),
(133, 1, 'Login', NULL, NULL, 'User berhasil login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-25 01:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `pakan`
--

CREATE TABLE `pakan` (
  `id_pakan` int NOT NULL,
  `nama_pakan` varchar(100) NOT NULL,
  `stok_kg` decimal(10,2) DEFAULT '0.00',
  `satuan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pakan`
--

INSERT INTO `pakan` (`id_pakan`, `nama_pakan`, `stok_kg`, `satuan`) VALUES
(1, 'Rumput Segar', 19892.00, 'Kg'),
(2, 'Konsentrat', 196.50, 'Kg'),
(3, 'Jerami', 246.00, 'Kg');

-- --------------------------------------------------------

--
-- Table structure for table `pemberian_pakan`
--

CREATE TABLE `pemberian_pakan` (
  `id_pemberian` int NOT NULL,
  `id_sapi` int DEFAULT NULL,
  `id_pakan` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_kg` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemberian_pakan`
--

INSERT INTO `pemberian_pakan` (`id_pemberian`, `id_sapi`, `id_pakan`, `tanggal`, `jumlah_kg`) VALUES
(1, 1, 1, '2025-09-12', 5.00),
(2, 2, 2, '2025-09-13', 3.50),
(3, 3, 3, '2025-09-14', 60.00);

--
-- Triggers `pemberian_pakan`
--
DELIMITER $$
CREATE TRIGGER `trg_update_stok_pakan` AFTER INSERT ON `pemberian_pakan` FOR EACH ROW BEGIN
    UPDATE pakan 
    SET stok_kg = stok_kg - NEW.jumlah_kg
    WHERE id_pakan = NEW.id_pakan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int NOT NULL,
  `id_sapi` int DEFAULT NULL,
  `tanggal_jual` date DEFAULT NULL,
  `harga_jual` bigint NOT NULL,
  `pembeli` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_sapi`, `tanggal_jual`, `harga_jual`, `pembeli`) VALUES
(1, 1, '2025-09-20', 15000000, 'Pak Budi');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_kesehatan`
--

CREATE TABLE `riwayat_kesehatan` (
  `id_riwayat` int NOT NULL,
  `id_sapi` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis_kegiatan` varchar(100) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat_kesehatan`
--

INSERT INTO `riwayat_kesehatan` (`id_riwayat`, `id_sapi`, `tanggal`, `jenis_kegiatan`, `keterangan`) VALUES
(1, 1, '2025-09-15', 'Vaksin PMK', 'Vaksinasi Penyakit Mulut dan Kuku'),
(2, 2, '2025-09-16', 'Pemeriksaan', 'Batuk ringan, diberikan obat'),
(3, 3, '2025-09-17', 'Vitamina', 'Pemberian vitamin untuk menambah nafsu makan');

-- --------------------------------------------------------

--
-- Table structure for table `sapi`
--

CREATE TABLE `sapi` (
  `id_sapi` int NOT NULL,
  `kode_sapi` varchar(20) NOT NULL,
  `jenis_sapi` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Jantan','Betina') NOT NULL,
  `berat_badan_kg` decimal(10,2) DEFAULT NULL,
  `status_kesehatan` varchar(100) DEFAULT NULL,
  `lokasi_kandang` varchar(50) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status_sapi` enum('Aktif','Dijual','Terjual','Mati') NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sapi`
--

INSERT INTO `sapi` (`id_sapi`, `kode_sapi`, `jenis_sapi`, `jenis_kelamin`, `berat_badan_kg`, `status_kesehatan`, `lokasi_kandang`, `tanggal_masuk`, `gambar`, `status_sapi`) VALUES
(1, 'SAPI001', 'Sapi Bali', 'Jantan', 250.50, 'Sehat', 'Kandang A', '2025-09-01', '1758856081_68d6039170796.png', 'Aktif'),
(2, 'SAPI002', 'Sapi PO', 'Betina', 220.00, 'Sakit Ringan', 'Kandang B', '2025-09-05', '1758856001_68d60341684d1.png', 'Aktif'),
(3, 'SAPI003', 'Sapi Madura', 'Betina', 180.00, 'Sehat', 'Kandang C', '2025-09-10', '1758865686_68d629166d1d1.jpg', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `hak_akses` enum('administrator','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `hak_akses`) VALUES
(1, 'admin', '$2y$10$Qxkjj3ceBp/1f5lGJVELZ.yJn9dce4n5bSKGxbDm0.ANr7ra52laa', 'agus', 'administrator'),
(2, 'petugas1', '$2y$10$kT5knEklWd/yqsFXPlH6auKM8zoD0PIdq9fxsiKH/8/ghJXTwDLe2', 'Budi Petugas', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pakan`
--
ALTER TABLE `pakan`
  ADD PRIMARY KEY (`id_pakan`);

--
-- Indexes for table `pemberian_pakan`
--
ALTER TABLE `pemberian_pakan`
  ADD PRIMARY KEY (`id_pemberian`),
  ADD KEY `id_sapi` (`id_sapi`),
  ADD KEY `id_pakan` (`id_pakan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_sapi` (`id_sapi`);

--
-- Indexes for table `riwayat_kesehatan`
--
ALTER TABLE `riwayat_kesehatan`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_sapi` (`id_sapi`);

--
-- Indexes for table `sapi`
--
ALTER TABLE `sapi`
  ADD PRIMARY KEY (`id_sapi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `pakan`
--
ALTER TABLE `pakan`
  MODIFY `id_pakan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pemberian_pakan`
--
ALTER TABLE `pemberian_pakan`
  MODIFY `id_pemberian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `riwayat_kesehatan`
--
ALTER TABLE `riwayat_kesehatan`
  MODIFY `id_riwayat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sapi`
--
ALTER TABLE `sapi`
  MODIFY `id_sapi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD CONSTRAINT `log_activities_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;

--
-- Constraints for table `pemberian_pakan`
--
ALTER TABLE `pemberian_pakan`
  ADD CONSTRAINT `pemberian_pakan_ibfk_1` FOREIGN KEY (`id_sapi`) REFERENCES `sapi` (`id_sapi`),
  ADD CONSTRAINT `pemberian_pakan_ibfk_2` FOREIGN KEY (`id_pakan`) REFERENCES `pakan` (`id_pakan`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_sapi`) REFERENCES `sapi` (`id_sapi`);

--
-- Constraints for table `riwayat_kesehatan`
--
ALTER TABLE `riwayat_kesehatan`
  ADD CONSTRAINT `riwayat_kesehatan_ibfk_1` FOREIGN KEY (`id_sapi`) REFERENCES `sapi` (`id_sapi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
