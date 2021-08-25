-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2021 at 03:56 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `nm_admin` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nm_admin`, `username`, `password`) VALUES
(2, 'Ihsan Sayid', 'ihsan', '$2y$10$5demgWqQMD9zYWMrxjxKxuMUk7bzxkl7hagchwgZStyto217WBWy6'),
(3, 'Admin Perpus', 'admin', '$2y$10$I4WV0t9XKQrdbiybVv.PXuMgZrRHdXtKVBInTABAzkb/cY/T7IaXW');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` char(5) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `id_kategori` char(5) NOT NULL,
  `id_penulis` char(5) NOT NULL,
  `id_penerbit` char(5) NOT NULL,
  `status` enum('Tersedia','Dipinjam') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `id_kategori`, `id_penulis`, `id_penerbit`, `status`) VALUES
('BK001', 'Soe Hoek Gi Part 1', 'KT002', 'PL011', 'PN001', 'Tersedia'),
('BK002', 'Soe Hoek Gi Part 2', 'KT002', 'PL009', 'PN002', 'Tersedia'),
('BK003', 'Soe Hoek Gi Part 3', 'KT001', 'PL010', 'PN003', 'Dipinjam'),
('BK004', 'Soe Hoek Gi Part 4', 'KT003', 'PL007', 'PN001', 'Dipinjam'),
('BK005', 'Soe Hoek Gi Part 5', 'KT002', 'PL011', 'PN002', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` char(5) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
('KT001', 'Fiksi'),
('KT002', 'Biography'),
('KT003', 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` char(5) NOT NULL,
  `nama_penerbit` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`) VALUES
('PN001', 'Sriwijiaya Inc'),
('PN002', 'Airlangga'),
('PN003', 'Anggajaya'),
('PN005', 'Daursalam'),
('PN006', 'Kuncehn'),
('PN007', 'Frimantle');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` char(5) NOT NULL,
  `nama_penulis` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama_penulis`) VALUES
('PL007', 'Dr Radjin Ginting'),
('PL008', 'Abdul Muis'),
('PL009', 'Sukijan'),
('PL010', 'Fiersa Besari'),
('PL011', 'Soe Hoek Gi'),
('PL012', 'Letnan Jendral Prabowo');

-- --------------------------------------------------------

--
-- Table structure for table `tbanggota`
--

CREATE TABLE `tbanggota` (
  `idanggota` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jeniskelamin` varchar(10) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL,
  `foto` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbanggota`
--

INSERT INTO `tbanggota` (`idanggota`, `nama`, `jeniskelamin`, `alamat`, `status`, `foto`) VALUES
('AG002', 'Husni Mubarok', 'P', 'Jl. Jakarta No 03 Bandung', 'Y', 'foto-AG002.jpg'),
('AG003', 'Fahmi', 'L', 'Jl. Cijerah hilir 01 Bandung\r\n', 'Y', 'foto-AG003.jpeg'),
('AG004', 'Raina Khansa Nabila', 'P', 'Jl. Ambon no 02 Bandung', 'Y', 'foto-AG004.jpg'),
('AG005', 'Ihsan Sayid Muharrom', 'L', 'Jl. Riau no 25 Bandung', 'Y', '-'),
('AG006', 'Ihsan Sayid Muharroms', 'P', '12121', 'Y', '-'),
('AG007', '2121', 'P', '1212121212', 'Y', '-');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` char(5) NOT NULL,
  `id_anggota` char(5) NOT NULL,
  `id_buku` char(5) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `id_admin` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_anggota`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `id_admin`) VALUES
('TR001', 'AG004', 'BK002', '2021-08-21', '2021-08-22', 3),
('TR002', 'AG003', 'BK005', '2021-08-21', '2021-08-22', 3),
('TR003', 'AG002', 'BK002', '2021-08-21', '2021-08-21', 3),
('TR004', 'AG004', 'BK003', '2021-08-22', NULL, 2),
('TR005', 'AG002', 'BK004', '2021-08-22', NULL, 2),
('TR006', 'AG002', 'BK002', '2021-08-22', '2021-08-22', 2),
('TR007', 'AG003', 'BK001', '2021-08-22', '2021-08-22', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `fk_buku_kategori` (`id_kategori`),
  ADD KEY `fk_buku_penulis` (`id_penulis`),
  ADD KEY `fk_buku_penerbit` (`id_penerbit`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `tbanggota`
--
ALTER TABLE `tbanggota`
  ADD PRIMARY KEY (`idanggota`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_anggota` (`id_anggota`),
  ADD KEY `fk_transaksi_buku` (`id_buku`),
  ADD KEY `fk_transaksi_admin` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `fk_buku_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `fk_buku_penerbit` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`),
  ADD CONSTRAINT `fk_buku_penulis` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`),
  ADD CONSTRAINT `fk_transaksi_anggota` FOREIGN KEY (`id_anggota`) REFERENCES `tbanggota` (`idanggota`),
  ADD CONSTRAINT `fk_transaksi_buku` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
