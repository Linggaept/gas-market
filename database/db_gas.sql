-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 24, 2025 at 05:05 AM
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
-- Database: `db_gas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(10) NOT NULL,
  `nm_admin` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nm_admin`, `username`, `email`, `password`) VALUES
(1, 'administrator', 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pimpinan`
--

CREATE TABLE `tbl_pimpinan` (
  `id_pimpinan` int(10) NOT NULL,
  `nm_pimpinan` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_pimpinan`
--

INSERT INTO `tbl_pimpinan` (`id_pimpinan`, `nm_pimpinan`, `username`, `email`, `password`) VALUES
(1, 'pimpinan', 'pimpinan', 'pimpinan@gmail.com', 'pimpinan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_order`
--

CREATE TABLE `tbl_detail_order` (
  `id_detail_order` int(10) NOT NULL,
  `id_order` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `nm_produk` varchar(50) NOT NULL,
  `harga` int(10) NOT NULL,
  `jml_order` int(3) NOT NULL,
  `berat` int(10) NOT NULL,
  `subberat` int(10) NOT NULL,
  `subharga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_detail_order`
--

INSERT INTO `tbl_detail_order` (`id_detail_order`, `id_order`, `id_produk`, `nm_produk`, `harga`, `jml_order`, `berat`, `subberat`, `subharga`) VALUES
(60, 95, 4, 'Sendal Jepit Havaianas Top Mix', 45000, 1, 220, 220, 45000),
(61, 96, 1, 'Sendal Jepit Swallow Classic Hitam', 25000, 1, 200, 200, 25000),
(62, 97, 2, 'Sendal Jepit Swallow Classic Biru', 25000, 1, 200, 200, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kat_produk`
--

CREATE TABLE `tbl_kat_produk` (
  `id_kategori` int(10) NOT NULL,
  `nm_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_kat_produk`
--

INSERT INTO `tbl_kat_produk` (`id_kategori`, `nm_kategori`) VALUES
(1, 'Sendal Jepit'),
(2, 'Sendal Gunung'),
(3, 'Sendal Selop'),
(4, 'Sendal Anak'),
(5, 'Sendal Wanita'),
(6, 'Sendal Pria'),
(7, 'Sendal Olahraga'),
(8, 'Sendal Rumah'),
(9, 'Sendal Karet'),
(10, 'Sendal Kulit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id_order` int(10) NOT NULL,
  `id_pelanggan` int(10) NOT NULL,
  `nm_penerima` varchar(30) NOT NULL DEFAULT '',
  `telp` varchar(13) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kode_pos` int(10) NOT NULL,
  `alamat_pengiriman` varchar(50) NOT NULL,
  `tgl_order` date NOT NULL,
  `ongkir` int(10) NOT NULL,
  `total_order` int(10) NOT NULL,
  `status` varchar(30) DEFAULT 'Belum Dibayar',
  `no_resi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id_order`, `id_pelanggan`, `nm_penerima`, `telp`, `provinsi`, `kota`, `kode_pos`, `alamat_pengiriman`, `tgl_order`, `ongkir`, `total_order`, `status`, `no_resi`) VALUES
(80, 1, 'jjjkk', '9898989898', '18', '458', 88787, 'kklklkl', '2019-12-27', 0, 3161500, 'Menyiapkan Produk', ''),
(82, 1, 'Terbaru', '88787878787', '14', '296', 787878, 'kjkjkjkjkj', '2019-12-27', 1125000, 8424000, 'Produk Diterima', '55454dgdgdg'),
(83, 1, 'Jack Ber', '997997979', '14', '221', 87878, 'hjhjhjhjhj', '2019-12-27', 1100000, 4395000, 'Produk Dikirim', 'A65AS6AS6SA7A'),
(84, 1, 'jkj', '87878787878', '15', '215', 87878, 'hjsdsd', '2019-12-27', 950000, 1249000, 'Sudah Dibayar', NULL),
(85, 1, 'Arif', '081225789373', '10', '249', 76253, 'Jalan Suka Aku', '2019-12-30', 400000, 8295000, 'Belum Dibayar', NULL),
(86, 4, 'Bintang Reny', '082255305424', '14', '205', 74114, 'Jl.Pakanegara Gg.Ramania', '2020-01-08', 1000000, 1899000, 'Belum Dibayar', NULL),
(87, 5, 'Rizal Wijoyo', '85652385926', '5', '419', 78212, 'Jl.Turi 6. NO 153', '2020-01-08', 250000, 4248000, 'Sudah Dibayar', NULL),
(88, 1, '1222221212', '08754323332', '5', '39', 55792, '121341414', '2020-01-10', 250000, 17348000, 'Sudah Dibayar', NULL),
(89, 7, 'Wisnu Nugroho Aji', '0817779996858', '5', '501', 55223, 'Terban', '2020-01-11', 250000, 40747000, 'Belum Dibayar', NULL),
(90, 1, 'Arief Gilang', '0812266537363', '10', '196', 57474, 'Jl Suka saya', '2020-01-11', 450000, 67945000, 'Produk Diterima', 'A65AS6AS6SA7A'),
(91, 7, 'Wisnu Nugroho Aji', '087846915184', '2', '56', 12223, 'Situ', '2020-01-11', 600000, 5997000, 'Belum Dibayar', NULL),
(92, 8, 'user', '0127381723', '1', '17', 57463, 'Burikan,Cawas,Klaten', '2025-07-05', 50000, 13499000, 'Produk Diterima', '001'),
(93, 8, 'Agus Kabel', '0821390123', '11', '42', 57463, 'Burikan,Cawas,Klaten', '2025-07-05', 50000, 2499000, 'Belum Dibayar', NULL),
(94, 8, 'user', '082137819238', '2', '27', 57463, 'Burikan,Cawas,Klaten', '2025-07-05', 50000, 899000, 'Belum Dibayar', NULL),
(95, 9, 'user', '0128392131', '12', '544', 57463, 'Burikan,Cawas,Klaten', '2025-09-23', 7000, 45000, 'Produk Diterima', '1'),
(96, 9, 'user', '0128392131', '12', '544', 57463, 'Burikan,Cawas,Klaten', '2025-09-23', 7000, 25000, 'Belum Dibayar', NULL),
(97, 9, 'joki codingku', '0128392131', '3', '30', 57463, 'Burikan,Cawas,Klaten', '2025-09-23', 37500, 62500, 'Belum Dibayar', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(10) NOT NULL,
  `nm_pelanggan` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `nm_pelanggan`, `username`, `email`, `password`) VALUES
(1, 'Arif Nur R', 'arifnur', 'arif@gmail.com', '123'),
(2, 'Arief Gilang', 'ariefgilan', 'arief@gmail.com', '123'),
(4, ' Bintang Reny', 'Bintang', 'Bintangre10@gmail.com', 'Kepo56789_'),
(5, ' Rizal Wijoyo', 'Rizal', 'Wijal16@gmail.com', 'Kambing123'),
(6, ' aris Juliyanto', 'aris', 'aris@gmail.com', '12345'),
(7, ' Wisnu', 'Ajik', 'wisnu@gmail.com', '123456'),
(8, ' user', 'user', 'user@gmail.com', '12345678'),
(9, ' user', 'user', 'user@gmail.com', 'user12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(10) NOT NULL,
  `id_order` int(10) NOT NULL,
  `nm_pembayar` varchar(30) NOT NULL,
  `nm_bank` varchar(20) NOT NULL,
  `jml_pembayaran` int(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bukti_transfer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `id_order`, `nm_pembayar`, `nm_bank`, `jml_pembayaran`, `tgl_bayar`, `bukti_transfer`) VALUES
(7, 80, 'Jack Berwin', 'Mandiri', 889778888, '2019-12-27', '7.jpeg'),
(8, 82, 'JAck Berwin', 'MANDIRI', 789977667, '2019-12-27', 'sky.jpg'),
(9, 83, 'JackBer', 'BCA', 2147483647, '2019-12-27', '10.jpg'),
(10, 87, 'Rizal Wijoyo', 'Bank Bersama', 4248000, '2020-01-08', 'userphoto.png'),
(11, 84, '', '', 0, '2020-01-10', '9.jpg'),
(12, 88, '1212', '1212', 17348000, '2020-01-10', '5.jpg'),
(13, 90, 'Arief Gilang', 'BRI', 67945000, '2020-01-11', '8.jpg'),
(14, 92, 'user', 'Mandiri', 13499000, '2025-07-05', 'logo.png'),
(15, 95, 'user', 'Mandiri', 45000, '2025-09-23', 'Screenshot 2025-09-23 at 12.42.32.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengaturan`
--

CREATE TABLE `tbl_pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `nama_pengaturan` varchar(100) NOT NULL,
  `nilai_pengaturan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pengaturan`
--

INSERT INTO `tbl_pengaturan` (`id_pengaturan`, `nama_pengaturan`, `nilai_pengaturan`) VALUES
(1, 'origin_district', '5357');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `nm_produk` varchar(50) NOT NULL,
  `berat` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `stok` int(3) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `id_kategori`, `nm_produk`, `berat`, `harga`, `stok`, `gambar`, `deskripsi`) VALUES
(1, 1, 'Sendal Jepit Swallow Classic Hitam', 200, 25000, 49, '1.jpg', 'Sendal jepit klasik dengan kualitas terbaik, nyaman digunakan sehari-hari'),
(2, 1, 'Sendal Jepit Swallow Classic Biru', 200, 25000, 44, '2.jpg', 'Sendal jepit klasik warna biru, tahan lama dan anti slip'),
(3, 1, 'Sendal Jepit GSJ Rainbow', 180, 22000, 60, '3.jpg', 'Sendal jepit dengan motif pelangi, cocok untuk anak muda'),
(4, 1, 'Sendal Jepit Havaianas Top Mix', 220, 45000, 29, '4.jpg', 'Sendal jepit premium dari Brazil dengan kualitas internasional'),
(5, 2, 'Sendal Gunung Eiger Lightspeed', 450, 185000, 25, '5.jpg', 'Sendal gunung dengan teknologi quick dry dan anti slip sole'),
(6, 2, 'Sendal Gunung Consina Amazone', 480, 165000, 20, '6.jpg', 'Sendal gunung dengan tali webbing kuat dan bantalan empuk'),
(7, 2, 'Sendal Gunung Rei Granit', 520, 195000, 18, '7.jpg', 'Sendal gunung outdoor dengan grip maksimal untuk tracking'),
(8, 2, 'Sendal Gunung Outdoor Pro Adventure', 500, 175000, 22, '8.jpg', 'Sendal gunung dengan desain sporty dan material berkualitas'),
(9, 3, 'Sendal Selop Bata Comfort', 300, 85000, 35, '9.jpg', 'Sendal selop dengan bantalan memory foam untuk kenyamanan maksimal'),
(10, 3, 'Sendal Selop Fladeo Casual', 280, 65000, 40, '10.jpg', 'Sendal selop kasual dengan desain modern dan elegan'),
(11, 3, 'Sendal Selop Homyped Relax', 320, 75000, 30, '11.jpg', 'Sendal selop dengan teknologi anti bakteri dan anti bau'),
(12, 4, 'Sendal Anak Karakter Hello Kitty', 150, 35000, 55, '12.jpg', 'Sendal anak dengan karakter Hello Kitty yang lucu dan menarik'),
(13, 4, 'Sendal Anak Cars McQueen', 160, 38000, 48, '13.jpg', 'Sendal anak dengan karakter Cars McQueen, disukai anak laki-laki'),
(14, 4, 'Sendal Anak Frozen Elsa', 150, 35000, 52, '14.jpg', 'Sendal anak dengan karakter Frozen Elsa untuk anak perempuan'),
(15, 4, 'Sendal Anak Doraemon', 155, 32000, 45, '15.jpg', 'Sendal anak dengan karakter Doraemon yang menggemaskan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ulasan`
--

CREATE TABLE `tbl_ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `ulasan` text NOT NULL,
  `tgl_ulasan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ulasan`
--

INSERT INTO `tbl_ulasan` (`id_ulasan`, `id_produk`, `id_pelanggan`, `id_order`, `rating`, `ulasan`, `tgl_ulasan`) VALUES
(1, 4, 9, 95, 5, 'keren parah', '2025-09-23 10:40:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_pimpinan`
--
ALTER TABLE `tbl_pimpinan`
  ADD PRIMARY KEY (`id_pimpinan`);

--
-- Indexes for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD PRIMARY KEY (`id_detail_order`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tbl_kat_produk`
--
ALTER TABLE `tbl_kat_produk`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_order2` (`id_order`);

--
-- Indexes for table `tbl_pengaturan`
--
ALTER TABLE `tbl_pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`),
  ADD UNIQUE KEY `nama_pengaturan` (`nama_pengaturan`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tbl_ulasan`
--
ALTER TABLE `tbl_ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pimpinan`
--
ALTER TABLE `tbl_pimpinan`
  MODIFY `id_pimpinan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  MODIFY `id_detail_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_kat_produk`
--
ALTER TABLE `tbl_kat_produk`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_pengaturan`
--
ALTER TABLE `tbl_pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_ulasan`
--
ALTER TABLE `tbl_ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD CONSTRAINT `id_order` FOREIGN KEY (`id_order`) REFERENCES `tbl_order` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_produk` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `id_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `tbl_pelanggan` (`id_pelanggan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD CONSTRAINT `id_order2` FOREIGN KEY (`id_order`) REFERENCES `tbl_order` (`id_order`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kat_produk` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;