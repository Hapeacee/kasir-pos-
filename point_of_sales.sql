-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 04:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `point_of_sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_user` int(50) NOT NULL,
  `nama_kasir` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` int(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` int(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_user`, `nama_kasir`, `level`, `email`, `no_hp`, `tgl_lahir`, `alamat`, `password`) VALUES
(1, 'Ghaniy', 'user', 'ghaniy123@gmail.com', 812345678, '2007-04-11', 17510, 'gani123');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(50) NOT NULL,
  `id_produk` int(50) NOT NULL,
  `id_penjualan` int(50) NOT NULL,
  `id_user` int(50) NOT NULL,
  `jumlah_produk` int(50) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `id_produk`, `id_penjualan`, `id_user`, `jumlah_produk`, `subtotal`) VALUES
(10, 3, 1, 1, 2, 10000.00),
(11, 3, 2, 1, 1, 5000.00),
(12, 3, 3, 1, 1, 5000.00),
(13, 3, 4, 1, 1, 5000.00),
(14, 2, 4, 1, 1, 3000.00),
(15, 3, 5, 1, 1, 5000.00),
(16, 3, 6, 1, 1, 5000.00),
(17, 2, 7, 1, 3, 9000.00),
(18, 1, 7, 1, 5, 10000.00),
(19, 3, 7, 1, 1, 5000.00),
(20, 2, 8, 1, 1, 3000.00),
(21, 2, 9, 1, 1, 3000.00),
(22, 1, 10, 1, 1, 2000.00);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bulanan`
--

CREATE TABLE `laporan_bulanan` (
  `id_laporan_bulanan` int(50) NOT NULL,
  `total_penjualan` decimal(10,2) NOT NULL,
  `bulan_penjualan` date NOT NULL,
  `nama_kasir` varchar(255) NOT NULL,
  `id_user` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_bulanan`
--

INSERT INTO `laporan_bulanan` (`id_laporan_bulanan`, `total_penjualan`, `bulan_penjualan`, `nama_kasir`, `id_user`) VALUES
(1, 1.00, '2025-02-19', 'Ghaniy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_harian`
--

CREATE TABLE `laporan_harian` (
  `id_laporan_harian` int(50) NOT NULL,
  `total_penjualan` decimal(10,2) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `nama_kasir` varchar(255) NOT NULL,
  `id_user` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_harian`
--

INSERT INTO `laporan_harian` (`id_laporan_harian`, `total_penjualan`, `tanggal_penjualan`, `nama_kasir`, `id_user`) VALUES
(19, 1000.00, '2025-05-07', 'Ghaniy', 0),
(20, 1000.00, '2025-05-07', 'Ghaniy', 0),
(21, 1000.00, '2025-05-07', 'Ghaniy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(50) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_tlp` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_tlp`) VALUES
(1, 'Tyo', 'Tytian Kencana', 87174843);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `id_pelanggan` int(50) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(50) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stok`) VALUES
(1, 'Pensil Faber Castel', 2000.00, 30),
(2, 'Pulpen', 3000.00, 12),
(3, 'Aqua 650ml', 5000.00, 10),
(4, 'Pulpen Joyko', 5000.00, 20),
(5, 'Penghapus Fabel Castle', 2000.00, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  ADD PRIMARY KEY (`id_laporan_bulanan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `laporan_harian`
--
ALTER TABLE `laporan_harian`
  ADD PRIMARY KEY (`id_laporan_harian`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `tanggal_penjualan` (`tanggal_penjualan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `laporan_harian`
--
ALTER TABLE `laporan_harian`
  MODIFY `id_laporan_harian` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `akun` (`id_user`),
  ADD CONSTRAINT `detail_penjualan_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

--
-- Constraints for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  ADD CONSTRAINT `laporan_bulanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `akun` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
