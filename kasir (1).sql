-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 02:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id_activity` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `activity` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `delete` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id_activity`, `id_user`, `activity`, `timestamp`, `delete`) VALUES
(1725, NULL, ' memperbarui item:  (Harga lama: 1000.00, Harga baru: 1000, Stok lama: 50, Stok baru: 12)', '2024-11-02 06:49:37', NULL),
(1726, NULL, ' buat barcode: {\"id\":6,\"nama_barang\":\"mouse\",\"harga\":\"1200000.00\",\"stok\":3,\"created_at\":\"2024-10-30T03:23:00.000000Z\",\"updated_at\":\"2024-10-30T03:23:00.000000Z\"}', '2024-11-02 06:55:51', NULL),
(1727, NULL, ' buat barcode: {\"id\":7,\"nama_barang\":\"laptop\",\"harga\":\"90000.00\",\"stok\":100,\"created_at\":\"2024-10-30T03:36:58.000000Z\",\"updated_at\":\"2024-10-30T03:36:58.000000Z\"}', '2024-11-02 06:56:00', NULL),
(1728, NULL, ' buat barcode: {\"id\":6,\"nama_barang\":\"mouse\",\"harga\":\"1200000.00\",\"stok\":3,\"created_at\":\"2024-10-30T03:23:00.000000Z\",\"updated_at\":\"2024-10-30T03:23:00.000000Z\"}', '2024-11-02 06:56:21', NULL),
(1729, NULL, ' buat barcode: {\"id\":1,\"nama_barang\":\"Pensil\",\"harga\":\"60000.00\",\"stok\":12,\"created_at\":null,\"updated_at\":\"2024-10-30T03:52:52.000000Z\"}', '2024-11-02 06:56:52', NULL),
(1730, NULL, ' buat barcode: {\"id\":1,\"nama_barang\":\"Pensil\",\"harga\":\"60000.00\",\"stok\":12,\"created_at\":null,\"updated_at\":\"2024-10-30T03:52:52.000000Z\"}', '2024-11-02 06:56:57', NULL),
(1731, NULL, ' buat barcode: {\"id\":1,\"nama_barang\":\"Pensil\",\"harga\":\"60000.00\",\"stok\":12,\"created_at\":null,\"updated_at\":\"2024-10-30T03:52:52.000000Z\"}', '2024-11-02 06:56:59', NULL),
(1732, NULL, ' buat barcode: {\"id\":1,\"nama_barang\":\"Pensil\",\"harga\":\"60000.00\",\"stok\":12,\"created_at\":null,\"updated_at\":\"2024-10-30T03:52:52.000000Z\"}', '2024-11-02 06:57:16', NULL),
(1733, NULL, ' buat barcode: {\"id\":6,\"nama_barang\":\"mouse\",\"harga\":\"1200000.00\",\"stok\":3,\"created_at\":\"2024-10-30T03:23:00.000000Z\",\"updated_at\":\"2024-10-30T03:23:00.000000Z\"}', '2024-11-02 06:57:33', NULL),
(1734, NULL, ' memperbarui item:  (Harga lama: 5000.00, Harga baru: 75000, Stok lama: 200, Stok baru: 3)', '2024-11-04 05:37:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `item_id`, `quantity`, `subtotal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 4, 1, '3000.00', '2024-10-29 09:37:20', '2024-11-04 05:41:38', NULL),
(7, 2, 4, '4000.00', '2024-10-29 09:40:15', '2024-10-29 09:40:48', '2024-10-29 09:40:48'),
(8, 1, 90, '180000.00', '2024-10-29 09:42:14', '2024-10-29 09:50:55', '2024-10-29 09:50:55'),
(9, 7, 42, '3780000.00', '2024-10-29 20:37:21', '2024-10-29 20:43:34', '2024-10-29 20:43:34'),
(10, 1, 12, '720000.00', '2024-10-29 20:37:32', '2024-11-01 08:01:43', '2024-11-01 08:01:43'),
(11, 1, 1, '60000.00', '2024-11-01 08:44:49', '2024-11-02 00:18:15', '2024-11-02 00:18:15'),
(12, 2, 1, '1000.00', '2024-11-01 08:44:52', '2024-11-02 00:18:15', '2024-11-02 00:18:15'),
(13, 1, 1, '60000.00', '2024-11-02 00:02:37', '2024-11-02 00:18:15', '2024-11-02 00:18:15'),
(14, 2, 1, '1000.00', '2024-11-02 00:03:17', '2024-11-02 00:18:15', '2024-11-02 00:18:15'),
(15, 7, 1, '90000.00', '2024-11-02 00:13:45', '2024-11-02 00:18:15', '2024-11-02 00:18:15'),
(16, 2, 1, '1000.00', '2024-11-02 00:18:12', '2024-11-02 00:18:15', '2024-11-02 00:18:15'),
(17, 1, 2, '120000.00', '2024-11-02 00:18:19', '2024-11-02 00:20:24', '2024-11-02 00:20:24'),
(18, 1, 3, '180000.00', '2024-11-02 00:40:26', '2024-11-04 05:40:28', '2024-11-04 05:40:28'),
(19, 1, 7, '420000.00', '2024-11-04 05:40:24', '2024-11-04 05:41:30', '2024-11-04 05:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `nama_barang`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'Pensil', '60000.00', 12, NULL, '2024-10-29 20:52:52'),
(2, 'Penghapus', '1000.00', 12, NULL, '2024-11-02 06:49:37'),
(3, 'Buku Tulis', '75000.00', 3, NULL, '2024-11-04 05:37:57'),
(4, 'Bolpoin', '3000.00', 150, NULL, NULL),
(5, 'modem usb', '100000.00', 50, NULL, NULL),
(6, 'mouse', '1200000.00', 3, '2024-10-29 20:23:00', '2024-10-29 20:23:00'),
(7, 'laptop', '90000.00', 100, '2024-10-29 20:36:58', '2024-10-29 20:36:58'),
(8, 'lapyu', '2000.00', 2, '2024-11-04 05:37:41', '2024-11-04 05:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `logo_id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `nama_web` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`logo_id`, `logo`, `icon`, `nama_web`) VALUES
(1, 'logo.png', 'icon.png', '123');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `bayar` decimal(10,2) NOT NULL,
  `kembalian` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `total_harga`, `bayar`, `kembalian`, `created_at`) VALUES
(1, '2000.00', '7000.00', '5000.00', '2024-10-29 21:05:36'),
(2, '123000.00', '40000000.00', '39877000.00', '2024-11-02 00:04:03'),
(3, '120000.00', '30000000.00', '29880000.00', '2024-11-02 00:20:21'),
(4, '420000.00', '500000.00', '80000.00', '2024-11-04 05:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('laki','perempuan') DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `level` int(255) DEFAULT NULL,
  `create_at` varchar(255) DEFAULT NULL,
  `create_by` int(255) DEFAULT NULL,
  `update_at` varchar(255) DEFAULT NULL,
  `update_by` int(255) DEFAULT NULL,
  `delete_at` varchar(255) DEFAULT NULL,
  `delete_by` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `level`, `create_at`, `create_by`, `update_at`, `update_by`, `delete_at`, `delete_by`) VALUES
(12, 'admin', '202cb962ac59075b964b07152d234b70', 'clara', 'perempuan', 'lorem ipsum', 1, '2024-08-14 08:34:45', 1, NULL, NULL, NULL, NULL),
(13, 'asep', '202cb962ac59075b964b07152d234b70', 'dd', 'laki', 'tm', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'morgen', '202cb962ac59075b964b07152d234b70', 'morgen taw', 'perempuan', 'orci', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'epan', '202cb962ac59075b964b07152d234b70', 'uu', 'laki', 'aman', 4, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'manda', '202cb962ac59075b964b07152d234b70', 'ee', '', 'balaoi', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'buk alda', '$2y$10$ASqkDY.RiPHIs6wBewj7EeEh5e7aKnDrAczWDk26XE.ZSMEtSrb9e', 'as', 'perempuan', NULL, NULL, '2024-10-11 18:09:20', NULL, '2024-10-11 18:09:20', NULL, NULL, NULL),
(19, 'deren', '6a53c0a2839d37d49a1c3d7546060504', 'oo', 'perempuan', NULL, NULL, '2024-10-11 18:09:37', NULL, '2024-10-11 18:09:37', NULL, NULL, NULL),
(20, 'logi', '$2y$10$Ot08TBFIpVlYMlAHReLli.qyTOAyHQfQjO6x0OFy53pLBFzdQFv9e', 'kobi', 'laki', NULL, NULL, '2024-10-11 18:13:55', NULL, '2024-10-11 18:13:55', NULL, NULL, NULL),
(21, 'user', 'e10adc3949ba59abbe56e057f20f883e', 'rr', 'perempuan', NULL, NULL, '2024-10-11 18:17:40', NULL, '2024-10-11 18:17:40', NULL, NULL, NULL),
(22, 'van', '$2y$10$HVVsAgurtGpGxTCcRm3uDulOSnQnpEeH6YwjN2EtVQ87dUA8.n59m', 'ff', 'laki', NULL, NULL, '2024-10-11 18:35:23', NULL, '2024-10-11 18:35:23', NULL, NULL, NULL),
(23, 'asep', '$2y$10$5anbTGNo6H9C68mT4WHTgORfAgVul35cjOtYuCBfiV9MJBkkMp9Ry', 'pan', 'laki', NULL, NULL, '2024-10-11 18:53:45', NULL, '2024-10-11 18:53:45', NULL, NULL, NULL),
(24, 'asus', '$2y$10$.rqdRVpXHtp0xvcy0LHPKO260nRXM1elwaFh7NW4Y8UvugAD9P5fi', 'as', 'laki', NULL, NULL, '2024-10-11 18:58:27', NULL, '2024-10-11 18:58:27', NULL, NULL, NULL),
(25, 'tin', '202cb962ac59075b964b07152d234b70', 'hsh', 'laki', NULL, NULL, '2024-10-11 19:23:57', NULL, '2024-10-11 19:23:57', NULL, NULL, NULL),
(26, 'pak if', '202cb962ac59075b964b07152d234b70', 'pak if', 'laki', NULL, NULL, '2024-10-12 04:05:32', NULL, '2024-10-12 04:05:32', NULL, NULL, NULL),
(27, 'yoga', '$2y$10$6/8bqWak4BPXSxV0gGLVQOgpJxrUo9q/phyUxqa0HM2BBTZF6kOgW', 'yoga', 'laki', NULL, NULL, '2024-10-12 04:39:25', NULL, '2024-10-12 04:39:25', NULL, NULL, NULL),
(28, 'iphone', '$2y$10$iMb1wAx/TMW9XVZu0b2Wduod9FLB4OcX6zMs.3dekYee4zhkKAp0K', 'asep', 'laki', NULL, NULL, '2024-10-12 04:42:25', NULL, '2024-10-12 04:42:25', NULL, NULL, NULL),
(29, 'uauau', '$2y$10$iJD4HCTb8Qy3SYf388zQTue3SzAgmlYaGQvguP7u998s44pKaoJHW', 'hsh', 'perempuan', NULL, NULL, '2024-10-12 04:45:46', NULL, '2024-10-12 04:45:46', NULL, NULL, NULL),
(30, 'lampu', '202cb962ac59075b964b07152d234b70', 'haha', 'perempuan', NULL, NULL, '2024-10-12 04:48:55', NULL, '2024-10-12 04:48:55', NULL, NULL, NULL),
(31, 'asusvivobook', '$2y$10$7tgFuM1Yp0mUCdLP/fmbsu0M6MYN2EF8e9sLfOW.azHdvaZQnB2uW', 'iphone', 'perempuan', NULL, NULL, '2024-10-12 04:56:28', NULL, '2024-10-12 04:56:28', NULL, NULL, NULL),
(32, 't', 'd9b1d7db4cd6e70935368a1efb10e377', 'aha', 'laki', NULL, NULL, '2024-10-12 05:01:00', NULL, '2024-10-12 05:01:00', NULL, NULL, NULL),
(33, 'kk', 'd9b1d7db4cd6e70935368a1efb10e377', 'as', 'laki', NULL, NULL, '2024-10-12 05:04:18', NULL, '2024-10-12 05:04:18', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id_activity`) USING BTREE;

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`logo_id`) USING BTREE;

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id_activity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1735;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
