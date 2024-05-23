-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 04:20 PM
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(10) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah_barang` int(10) NOT NULL,
  `satuan_barang` varchar(20) NOT NULL,
  `harga_beli` double(20,0) NOT NULL,
  `status_barang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `jumlah_barang`, `satuan_barang`, `harga_beli`, `status_barang`) VALUES
(2, 'KB001', 'Beras', 0, 'kg', 10000, 0),
(3, 'KB002', 'Minyak Goreng', 51, 'liter', 15000, 1),
(4, 'KB003', 'Gula', 200, 'kg', 12000, 1),
(5, 'KB004', 'Sabun Mandi', 150, 'pcs', 5000, 1),
(6, 'KB005', 'Biskuit', 300, 'pcs', 8000, 1),
(7, 'KB006', 'Teh', 100, 'pcs', 6000, 1),
(8, 'KB007', 'Kopi', 75, 'pcs', 15000, 1),
(9, 'KB008', 'Pasta Gigi', 125, 'pcs', 7000, 1),
(10, 'KB009', 'Susu', 80, 'liter', 20000, 1),
(11, 'KB010', 'Mentega', 50, 'kg', 25000, 1),
(12, 'KB020', 'Face Wash', 20, 'pcs', 27000, 1),
(14, 'KB030', 'Shampoo', 21, 'pcs', 30000, 1),
(60, 'KB090', 'Bensin', 12, 'liter', 30000, 1),
(63, 'KB050', 'Saus', 10, 'pcs', 15000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
