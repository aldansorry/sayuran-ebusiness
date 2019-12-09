-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2019 at 08:59 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebisnis_sayur`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `alamatNote` varchar(64) NOT NULL,
  `kecamatan` varchar(64) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `telepon` varchar(16) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(32) NOT NULL,
  `point` double NOT NULL DEFAULT '0',
  `gambar` varchar(128) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_online` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `alamat`, `alamatNote`, `kecamatan`, `kodepos`, `telepon`, `email`, `password`, `point`, `gambar`, `created_date`, `last_online`) VALUES
(2, '3', '3', '3', '3', '3', '3', '3', '3', 0, '', '2019-12-01 12:55:00', '2019-12-08 07:40:05'),
(5, '4', '4', '4', '4', '4', '4', '4', '4', 0, '', '2019-12-01 13:44:59', '2019-12-01 07:45:18'),
(6, 'a', 'a', 'a', 'a222', 'a', 'a', 'a', '2', 100000, '', '2019-12-08 13:51:15', '2019-12-08 08:29:29'),
(7, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 9000, '', '2019-12-08 13:52:20', '2019-12-09 08:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `kode` varchar(16) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_kirim` datetime NOT NULL,
  `payment_method` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `fk_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `kode`, `tanggal`, `tanggal_kirim`, `payment_method`, `status`, `bukti_pembayaran`, `fk_pengguna`) VALUES
(3, '', '2019-12-01 13:39:50', '0000-00-00 00:00:00', 0, 1, '', 2),
(4, '', '2019-12-01 13:43:58', '0000-00-00 00:00:00', 0, 1, '', 2),
(5, '', '2019-12-01 13:44:35', '0000-00-00 00:00:00', 0, 1, '', 2),
(6, '', '2019-12-01 13:44:59', '0000-00-00 00:00:00', 0, 1, '', 5),
(7, '', '2019-12-01 13:45:31', '0000-00-00 00:00:00', 0, 1, '', 5),
(8, 'nuNT9U7xKyDXicdq', '2019-12-01 14:21:09', '0000-00-00 00:00:00', 0, 1, '', 5),
(9, '21B6CC8338A2C300', '2019-12-01 14:22:40', '0000-00-00 00:00:00', 0, 5, '4fbdd1e5da86c5f79f530df129d7babb.jpg', 5),
(10, '32B4A837B742390C', '2019-12-01 14:24:47', '0000-00-00 00:00:00', 0, 5, '32B4A837B742390C.jpg', 5),
(11, 'C66CD7C97465113B', '2019-12-01 14:24:50', '0000-00-00 00:00:00', 0, 5, 'C66CD7C97465113B.jpg', 5),
(12, '434BA541B2998DD2', '2019-12-01 14:24:51', '0000-00-00 00:00:00', 0, 1, '', 5),
(13, 'C2DA121749632239', '2019-12-01 14:24:52', '0000-00-00 00:00:00', 0, 1, '', 5),
(14, '69A9366D94085578', '2019-12-01 14:24:52', '0000-00-00 00:00:00', 0, 1, '', 5),
(15, 'D062D9867C476CB9', '2019-12-01 14:24:53', '0000-00-00 00:00:00', 0, 1, '', 5),
(16, '383DB6009C2D45CC', '2019-12-01 14:24:53', '0000-00-00 00:00:00', 0, 1, '', 5),
(17, '8400D28838B73BD7', '2019-12-01 14:24:54', '0000-00-00 00:00:00', 0, 1, '', 5),
(18, 'D3802570441C354A', '2019-12-01 14:24:54', '0000-00-00 00:00:00', 0, 1, '', 5),
(19, '872219CB47949321', '2019-12-01 14:24:55', '0000-00-00 00:00:00', 0, 1, '', 5),
(20, '5D56B403946C1599', '2019-12-01 14:24:55', '0000-00-00 00:00:00', 0, 1, '', 5),
(21, '4B687B5B53C83D91', '2019-12-01 14:24:56', '0000-00-00 00:00:00', 0, 1, '', 5),
(22, 'B510C2305B65DD0B', '2019-12-01 14:24:56', '0000-00-00 00:00:00', 0, 1, '', 5),
(23, 'B8A273B4812A6C86', '2019-12-01 14:24:56', '0000-00-00 00:00:00', 0, 1, '', 5),
(24, '39D106C0A8472C87', '2019-12-01 14:24:57', '0000-00-00 00:00:00', 0, 1, '', 5),
(25, 'D976A609CA424552', '2019-12-01 14:24:57', '0000-00-00 00:00:00', 0, 1, '', 5),
(26, '21881DA2A59B7B30', '2019-12-01 14:24:57', '0000-00-00 00:00:00', 0, 1, '', 5),
(27, '64AB80CC952D9C3A', '2019-12-01 14:24:58', '0000-00-00 00:00:00', 0, 1, '', 5),
(28, 'AAB240D940D63BB1', '2019-12-01 14:24:58', '0000-00-00 00:00:00', 0, 1, '', 5),
(29, '8848D7306796D561', '2019-12-01 14:24:58', '0000-00-00 00:00:00', 0, 1, '', 5),
(30, '0762312438C44A00', '2019-12-01 14:24:59', '0000-00-00 00:00:00', 0, 1, '', 5),
(31, 'B9DBB20D583046BA', '2019-12-01 14:24:59', '0000-00-00 00:00:00', 0, 1, '', 5),
(32, 'B5917CAB78CD6942', '2019-12-01 14:24:59', '0000-00-00 00:00:00', 0, 1, '', 5),
(33, 'A439626360D912C5', '2019-12-01 14:25:00', '0000-00-00 00:00:00', 0, 1, '', 5),
(34, 'B6008C8262567954', '2019-12-01 14:25:00', '0000-00-00 00:00:00', 0, 1, '', 5),
(35, 'AC36A49D575C2BB9', '2019-12-01 14:25:00', '0000-00-00 00:00:00', 0, 1, '', 5),
(36, '6B97CD2A30B8C3A2', '2019-12-01 14:25:00', '0000-00-00 00:00:00', 0, 1, '', 5),
(37, '349C67B2119AB646', '2019-12-01 14:25:01', '0000-00-00 00:00:00', 0, 1, '', 5),
(38, 'A2281D3D38B1456C', '2019-12-01 14:25:01', '0000-00-00 00:00:00', 0, 1, '', 5),
(39, '5CB630B1C1642BA2', '2019-12-01 14:25:01', '0000-00-00 00:00:00', 0, 1, '', 5),
(40, '328122391289BA4A', '2019-12-01 14:25:02', '0000-00-00 00:00:00', 0, 1, '', 5),
(41, '0D98A2B7818BC0BB', '2019-12-01 14:25:02', '0000-00-00 00:00:00', 0, 1, '', 5),
(42, '809B58C07CA1D945', '2019-12-01 14:25:02', '0000-00-00 00:00:00', 0, 1, '', 5),
(43, '03602DC71839BB63', '2019-12-01 14:25:02', '0000-00-00 00:00:00', 0, 1, '', 5),
(44, 'C405616AB8903D39', '2019-12-01 15:30:35', '2019-12-01 02:02:00', 0, 5, 'C405616AB8903D39.jpg', 2),
(45, 'B14106A8DC303A78', '2019-12-09 14:39:40', '2019-12-10 02:22:00', 2, 2, '', 7),
(46, '8BC79A90767169C6', '2019-12-09 14:55:01', '2019-12-19 23:11:00', 2, 2, '', 7),
(47, 'B271A6C9A3A38506', '2019-12-09 14:55:46', '2019-12-10 02:02:00', 1, 3, 'B271A6C9A3A38506.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `fk_penjualan` int(11) NOT NULL,
  `fk_produk_detail` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_sekarang` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `fk_penjualan`, `fk_produk_detail`, `jumlah`, `harga_sekarang`) VALUES
(3, 4, 8, 1, 10000),
(4, 5, 8, 1, 10000),
(5, 6, 8, 1, 10000),
(6, 7, 8, 1, 10000),
(7, 8, 8, 1, 10000),
(8, 9, 8, 1, 10000),
(9, 44, 8, 1, 10000),
(10, 45, 11, 1, 9000),
(11, 46, 11, 1, 9000),
(12, 47, 11, 10, 9000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `kategori` varchar(32) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `kategori`, `keterangan`, `gambar`) VALUES
(3, 'Wortel Cute', 'Wortel', 'Wortel yang dipotong hingga lucu', '.jpg'),
(4, 'Tomato', 'Tomat', '11', '7e3d67c7833e8180d927b6a205acab2f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk_detail`
--

CREATE TABLE `produk_detail` (
  `id` int(11) NOT NULL,
  `jenis` varchar(32) NOT NULL,
  `gambar` varchar(64) NOT NULL,
  `satuan` varchar(32) NOT NULL,
  `harga` double NOT NULL,
  `fk_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_detail`
--

INSERT INTO `produk_detail` (`id`, `jenis`, `gambar`, `satuan`, `harga`, `fk_produk`) VALUES
(8, 'Sedang', 'acc1ccd9487691e3b63471b9d4b4216f.jpg', 'Kg', 10000, 3),
(10, 'Besar', 'fbf1827ed332de251e95538a9f6a8b73.jpg', 'Kg', 15000, 3),
(11, '22', '7f982f7de7044b916d4b2207e41550bc.jpg', 'Kg', 9000, 4),
(13, '1', '529976982a180f2fe9e6e5dcf1698fe4.jpg', 'Kg', 8000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `keterangan`, `gambar`) VALUES
(2, '1', '1', '1', 'cb34287e223ba4ffbcde45168010abac.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` int(11) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `fk_supplier` int(11) DEFAULT NULL,
  `last_online` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`, `gambar`, `fk_supplier`, `last_online`) VALUES
(1, '1', '1', '1', 1, 'a4a769fecc9a16bddb3d5a0fe40fa913.jpg', NULL, '2019-12-09 08:56:04'),
(2, '2', '2', '2', 2, 'e19a393cf6b1b521078d95bb31d0b675.jpg', 2, '2019-11-30 14:29:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengguna` (`fk_pengguna`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_penjualan` (`fk_penjualan`),
  ADD KEY `fk_produk_detail` (`fk_produk_detail`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_detail`
--
ALTER TABLE `produk_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produk` (`fk_produk`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_supplier` (`fk_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk_detail`
--
ALTER TABLE `produk_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`fk_pengguna`) REFERENCES `pengguna` (`id`);

--
-- Constraints for table `produk_detail`
--
ALTER TABLE `produk_detail`
  ADD CONSTRAINT `produk_detail_ibfk_1` FOREIGN KEY (`fk_produk`) REFERENCES `produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
