-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 06:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `username`, `email`, `password`, `role`) VALUES
(1, 'Super Admin', 'admin', 'admin@gmail.com', '$2y$10$OP6Tlqe0v6Ep7akXokr7FuYmYGyyhI6q/MQhAk8n8Sr2mJGJqL6Yi', '1'),
(2, 'Jonwonu Uye', 'wonu', 'wonu@gmail.com', '$2y$10$bbaOquvB8A/PP4Cj6c/S4ehbwpTR5FTBYIwK8eCIsX23oO8RdgO2K', '2'),
(6, 'lala', 'lala', 'lala@gmail.com', '$2y$10$Oq3KGa3v67wfBFNYMjr9B.FHnlRi..R/rdEu5ctIBOCncGWc0uZyK', '2'),
(7, 'Jeon Wonwoo King', 'jonu', 'jonu@gmail.com', '$2y$10$PUMsH32DXUXR5XIVBgP59uijSFEut6M2yCZzmEPYZcNopUk91sVGe', '3'),
(10, 'Admin Barang', 'admbarang', 'barang@gmail.com', '$2y$10$4c/V5GHSOi3.HocoOfSyWe0JA0iGlF5SsUFLidvCFncUvlGRnTHTe', '2'),
(11, 'Admin Mahasiswa', 'admmahasiswa', 'mahasiswa@gmail.com', '$2y$10$rE5zMfRcHUNF76pCmAaZ8.6P8.4H3jTwiJZtLJ5OQjXd0qu5JmeQy', '3');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `barcode` varchar(15) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `jumlah`, `harga`, `barcode`, `tanggal`) VALUES
(21, 'Casing Protector v5', '4', '900000', '831201', '2025-04-06 04:53:20'),
(22, 'Keyboard Strawberry Tech', '5', '50500', '767872', '2025-04-07 15:17:50'),
(25, 'Laptop Thinkpad X Series', '10', '2500000', '344039', '2025-04-08 16:24:33');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama`, `prodi`, `jenis_kelamin`, `no_hp`, `alamat`, `email`, `foto`) VALUES
(1, 'Jecklin Jecky', 'Pendidikan Teknik Mesin', 'Laki-laki', '089898867645', '', 'jeklin@gmail.com', '67f150bd05e10.png'),
(3, 'Lala', 'Pendidikan Teknik Informatika dan Komputer', 'Perempuan', '+6281515411393', '', 'lala@gmail.com', '67a039581f392.jpg'),
(4, 'Gabriella C', 'Pendidikan Teknik Informatika dan Komputer', 'Perempuan', '+6285678987634', '', 'gabriella@gmail.com', '67a0393848174.jpg'),
(6, 'Titik Koma', 'Pendidikan Teknik Bangunan', 'Laki-laki', '45755636', '', 'titik@gmail.com', '67a0392ae1192.png'),
(8, 'Putra Sihombing', 'Pendidikan Teknik Bangunan', 'Laki-laki', '+627879823924', '', 'putra@gmail.com', '67f150ed427f9.png'),
(15, 'Yurinawa Simampang', 'Pendidikan Teknik Mesin', 'Laki-laki', '091918393289', '<p><strong><em>Jl. Setapak Menjus, RT 01/RW 01, Sukasuka, Indonesia</em></strong></p>', 'yurin@gmail.com', '67f213ec92aff.png'),
(17, 'Oki Jikolsa', 'Pendidikan Teknik Bangunan', 'Perempuan', '08682382637', '<p>Jl. Setapak Menjus, Sukokambang<a href=\"/ckfinder/userfiles/images/foto%20alamat/Screenshot%20(68).png\" target=\"_blank\"><img alt=\"\" src=\"/ckfinder/userfiles/images/foto%20alamat/Screenshot%20(68).png\" style=\"width:100%\" /></a></p>\r\n', 'oki@gmail.com', '67f21e8fe6e08.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
