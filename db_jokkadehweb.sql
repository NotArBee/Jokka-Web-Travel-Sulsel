-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 11:17 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jokkadehweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `paket_wisata`
--

CREATE TABLE `paket_wisata` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_wisata` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket_wisata`
--

INSERT INTO `paket_wisata` (`id`, `nama_wisata`, `foto`, `deskripsi`, `harga`) VALUES
(1, 'Bugis Waterpark', '6660e539bc7b42.88174796.jpg', 'Bugis Waterpark Adventure🌊 Tempat rekreasi yang mengusung perpaduan unik antara konsep alam dengan budaya lokal. Jadi, selain berwisata dan bermain air tentu mengajak keluarga dan anak-anak berlibur ditempat ini juga bisa menjadi wisata edukasi budaya dan sejarah.', 50000),
(2, 'Mesjid Raya Makassar', '6660e63d4ca549.97380653.jpg', 'Masjid Raya Makassar (Makassar: ᨆᨔᨗᨁᨗ ᨒᨚᨄᨚᨓ ᨆᨀᨔᨑ) merupakan sebuah masjid yang terletak di Makassar, Indonesia. Masjid ini dibangun pada tahun 1948 dan selesai pada tahun 1949. Masjid ini mengalami renovasi dari tahun 1999 hingga tahun 2005. Pertama kali dirancang oleh arsitek Mohammad Soebardjo setelah memenangi sayembara yang digelar panitia pembangunan masjid raya. Masjid ini dapat menampung hingga 10.000 jamaah.', 40000),
(3, 'Pulau Samalona', '6660e6be061303.50820502.jpg', 'Pulau Samalona merupakan salah satu pulau terindah yang dimiliki Indonesia. Pulau yang berjarak dua kilometer dari Kota Makassar ini dapat dicapai dengan menaiki perahu motor dari dermaga kecil dekat Pantai Losari dengan waktu tempuh sekitar 30 menit.', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `nama_pemenesan` varchar(100) NOT NULL,
  `no.telpon` varchar(15) NOT NULL,
  `id_paket wisata` int(10) UNSIGNED NOT NULL,
  `tanggal_perjalanan` date NOT NULL,
  `paket_wisata` varchar(80) NOT NULL,
  `total_harga` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`) VALUES
(1, 'admin@gmail.com', 'adminjokka', 'admin'),
(2, 'arya@gmail.com', '$2y$10$sdAwsFFyRVzzqjIeY1BrF.HSgjDFm71cHCusAxA/ia5DG6j5cbvPq', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paket_wisata`
--
ALTER TABLE `paket_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paket_wisata`
--
ALTER TABLE `paket_wisata`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
