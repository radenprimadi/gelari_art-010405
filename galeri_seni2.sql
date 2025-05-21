-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 05:42 PM
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
-- Database: `galeri_seni2`
--

-- --------------------------------------------------------

--
-- Table structure for table `karya_seni`
--

CREATE TABLE `karya_seni` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karya_seni`
--

INSERT INTO `karya_seni` (`id`, `judul`, `deskripsi`, `gambar`, `username`, `kategori`) VALUES
(26, 'Lebaron', 'This is it', '2020-08-16-16-25-23_0.png', 'raden', 'Realistic'),
(27, 'adad', 'muach', '2020-08-22-14-40-32_0.png', 'raden', 'Realistic'),
(28, 'adad', 'adad', '2020-08-13-01-22-53_0.png', 'raden', 'Anime_Art'),
(29, 'adad', 'adad', '2020-08-09-20-45-54_0.png', 'raden', 'Realistic'),
(30, 'adwad', 'adawd', '2020-08-22-11-48-10_0.png', 'raden', 'Realistic'),
(31, 'awdad', 'adwdad', '2020-08-13-01-22-53_0.png', 'raden', 'Realistic'),
(32, 'adawda', 'dawdad', '2020-08-28-14-31-53_0.png', 'raden', 'Realistic'),
(33, 'dwada', 'dawda', '2020-08-02-12-49-16_0.png', 'raden', 'Anime_Art'),
(35, '123', 'wewew', 'Screenshot (1).png', 'haha', 'Anime_Art'),
(36, 'test', 'ini art', 'images.jpeg', 'imam', 'Anime_Art'),
(38, 'ghgf', 'in am', 'FB_IMG_1706435134579.jpeg', 'imam', 'Anime_Art');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `is_admin`) VALUES
(1, 'raden', '$2y$10$BZX5qSGf.2ZwG/zjTe1zsOJugg198jzg6W/wfFAoVo/sUXQI6hskC', 0),
(4, 'setya', '$2y$10$x2Zubx.wmFruxd16wQgSoeeokKvklZc47ZJ7nvWWeQQAT2PM60Cye', 0),
(8, 'redra', 'lerbon', 1),
(10, 'imam', '$2y$10$bm3YiarrBFYsx0xpm7njjOTXcX.MP/efLH1YiPf0SQrFbUb1glbQC', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karya_seni`
--
ALTER TABLE `karya_seni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judul` (`judul`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karya_seni`
--
ALTER TABLE `karya_seni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
