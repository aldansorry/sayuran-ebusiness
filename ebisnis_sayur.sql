-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11 Des 2019 pada 08.12
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `pengguna`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `fk_penjualan` int(11) NOT NULL,
  `fk_produk_detail` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_sekarang` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `kategori` varchar(32) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama`, `kategori`, `keterangan`, `gambar`) VALUES
(1, 'Wortel', 'sayuran', 'Manfaat wortel untuk kesehatan tubuh : menurunkan risiko kanker prostat, melawan kanker usus besar, mengurangi risiko leukimia, menjaga kesehatan mata, meningkatkan sistem kekebalan tubuh, dsb.', 'c111c4ea60372a035e29e1a96df75688.jpeg'),
(2, 'Bawang Merah', 'sayuran', 'Manfaat mengkonsumsi bawang merah antara lain : untuk meningkatkan kesehatan tulang, meningkatkan sistem imunitas, untuk mengatasi sembelit, untuk melegakkan tenggorokan, dapat mengontrol diabetes, dsb.', '6d7fd5897a11c0ca827dbfe6d5d937d4.jpg'),
(3, 'Daun Bawang', 'sayuran', 'Manfaat mengonsumsi daun bawang untuk kesehatan tubuh antara lain untuk kesehatan jantung, meningkatkan sistem kekebalan tubuh, mengobati cacingan, tinggi akan anti oksidan, mengobati infeksi, dsb.', 'b48fbab1aafeee416fb1596d8a61702a.jpg'),
(4, 'Sayur Asem', 'menu paket', 'Sayur asam adalah masakan sejenis sayur yang khas Indonesia. Ada banyak variasi lokal sayur asam seperti sayur asam Jakarta, sayur asam kangkung, dan sayur asam ikan asin.', 'a6c966d0d29e82617d2cc79a8058aa98.png'),
(5, 'Tomat', 'sayuran', 'manfaat tomat bagi kesehatan dan kecantikan anatara lain : mencegah penyakit kanker, menurunkan tekanan darah, menjaga kesehatan jantung, mengatasi diabetes, melancarkan pencernaan, dsb.', '291ef11e8b3ea7e3ac03423ed118128c.jpg'),
(6, 'Timun', 'sayuran', 'Manfaat mengonsumsi timun antara lain : mencegah osteoporosis, mencegah kanker, meningkatkan sistem saraf, meningkatkan penglihatan, membantu menurunkan berat badan, dsb,', '2090ce4c2ba1e1a0b47dedd7c00895f7.jpg'),
(7, 'Terong', 'sayuran', 'Manfaat terong antara lain : mengurangi risiko munculnya penyakit jantung, mengontrol kadar gula darah, menurunkan berat badan, mencegah kanker, menjaga kadar kolesterol, dsb.', 'fe168c27f2322242b3fc88ff42d69475.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_detail`
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
-- Dumping data untuk tabel `produk_detail`
--

INSERT INTO `produk_detail` (`id`, `jenis`, `gambar`, `satuan`, `harga`, `fk_produk`) VALUES
(2, 'sayur asem', 'b0fd739f4a69733aff7a5b8a6635ffe6.png', 'ons', 45000, 4),
(3, 'bulat', '06ca89347b63917b1779d94be161a799.png', 'ons', 12000, 1),
(4, 'balok', 'ee66162114c5d9f48f23e919de65d7a9.png', 'ons', 12000, 1),
(5, 'dadu', '2c7088c8f7befe81070f5c790e71fbc5.png', 'ons', 12000, 1),
(6, 'memanjang', 'ad8b1c66a53732a02f08e3d8f3d9fd64.png', 'ons', 12000, 1),
(7, 'peel', '08b2d46d2a22be8fabf9da834c6b29d6.png', 'ons', 7000, 2),
(8, 'lingkaran', '810037aedcf73cee5456d8711340e9c0.png', 'ons', 7000, 2),
(9, 'cincang', '4202dad3a11a7615dc9787eaa7a5daa3.png', 'ons', 7000, 2),
(10, 'setengah lingkaran', '8868e9b01c11bf69744a840348389d6c.png', 'ons', 7000, 2),
(11, 'batang', 'bf25accd8ef01e6afabd40c85b70b09b.png', 'ons', 6500, 3),
(12, 'lingkaran', 'e822219a0d92302b62dd725e56fa8ae1.png', 'ons', 6500, 3),
(13, 'miring', 'c46887cd7199033edc69bc9a736976bc.png', 'ons', 6500, 3),
(15, 'daun memanjang', 'e8b002382fe22852276ece1522ad99d0.png', 'ons', 6500, 3),
(16, 'cincang', '45de1edd6558900aeedf03343caae347.png', 'ons', 8000, 5),
(17, '1/4', '3a4ddb0e5f7c8c0d12063181b283a9e1.png', 'ons', 8000, 5),
(18, 'lingkaran', 'bb787f60846f509242bb072e925275bc.png', 'ons', 8000, 5),
(19, 'lingkaran', 'c9d4c695161981f88274ba29e8d9ff50.png', 'ons', 4500, 6),
(20, 'batang', 'ebc6c854683c7f9bd0e61ceb6e64f5d8.png', 'ons', 4500, 6),
(21, '1/4 lingkaran', '2fa33e0ee6edcc4f9052a0a60ad8c395.png', 'ons', 4500, 6),
(22, 'dadu', '291c1615bcb950e8c5ca1185e9b947bb.png', 'ons', 9500, 7),
(23, 'memanjang', '5af890550c7f64fec616b1c6223c8130.png', 'ons', 9500, 7),
(24, 'lingkaran', '8bd05f337624de5f30eeb34ea78354b0.png', 'ons', 9500, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`, `gambar`, `fk_supplier`, `last_online`) VALUES
(1, '1', '1', '1', 1, 'a4a769fecc9a16bddb3d5a0fe40fa913.jpg', NULL, '2019-12-10 05:38:22'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `produk_detail`
--
ALTER TABLE `produk_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`fk_pengguna`) REFERENCES `pengguna` (`id`);

--
-- Ketidakleluasaan untuk tabel `produk_detail`
--
ALTER TABLE `produk_detail`
  ADD CONSTRAINT `produk_detail_ibfk_1` FOREIGN KEY (`fk_produk`) REFERENCES `produk` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
