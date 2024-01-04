-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2024 at 10:09 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21748514_cerbung`
--

-- --------------------------------------------------------

--
-- Table structure for table `cerita`
--

CREATE TABLE `cerita` (
  `idcerita` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `idusers_pembuat_awal` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cerita`
--

INSERT INTO `cerita` (`idcerita`, `judul`, `idusers_pembuat_awal`) VALUES
(1, 'TIMUN MAS', '160421023'),
(2, 'SANGKURIANG', '160421094'),
(3, 'MISTERI TELAGA WARNA', '160421094'),
(6, 'SI KABAYAN', '160421023'),
(7, 'PURBASARI DAN PURBARARANG RANG RANG RANG RANG RANG', '160421023'),
(9, 'JAKA TARUB', '160421094'),
(10, 'MALIN KUNDANG', '160421094'),
(11, 'JOKO BODO', '160421023'),
(12, 'CERITA PANJANG', '160421023'),
(13, 'CERITA PANJANG 2', '160421023'),
(14, 'INI CERITAKU', '160821013'),
(15, 'SEBUAH CERITA MASA LALU', '160821013'),
(16, 'MASA DEPAN YANG INDAH', '160821013'),
(17, 'KARANGANKU', '160821013'),
(18, 'SEBUAH CERITA MASA LALU PT.2', '160821013');

-- --------------------------------------------------------

--
-- Table structure for table `paragraf`
--

CREATE TABLE `paragraf` (
  `idparagraf` int(11) NOT NULL,
  `idusers` varchar(40) NOT NULL,
  `idcerita` int(11) NOT NULL,
  `isi_paragraf` varchar(100) DEFAULT NULL,
  `tanggal_pembuatan` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `paragraf`
--

INSERT INTO `paragraf` (`idparagraf`, `idusers`, `idcerita`, `isi_paragraf`, `tanggal_pembuatan`) VALUES
(1, '160421023', 1, 'Phasellus \"hendrerit\" elit eget nunc hendrerit interdum orci rutrum. Suspendisse iaculis efficitur.', '2023-10-11 13:33:13'),
(2, '160421094', 2, 'Phasellus pretium efficitur varius. Praesent hendrerit sem eu ex iaculis sagittis. Nunc in eleifend.', '2023-10-11 13:33:53'),
(3, '160421094', 3, 'Sed neque leo, aliquet at dui at, tincidunt consectetur orci. Nulla sit amet porta nisl, vitae quis.', '2023-10-11 13:34:55'),
(6, '160421023', 6, 'Fusce in est sed ligula lacinia ultrices. Integer nec suscipit nisl, quis euismod libero vestibulum.', '2023-10-11 13:36:55'),
(7, '160421023', 2, 'Fusce in est sed ligula lacinia ultrices. Integer nec suscipit nisl, quis euismod libero vestibulum.', '2023-10-11 13:37:15'),
(8, '160421023', 1, 'Suspendisse leo velit, lobortis nec dui sed, facilisis fringilla sem. Nullam dictum ipsum tincidunt.', '2023-10-11 13:38:48'),
(9, '160421023', 7, 'Nam consequat odio ligula, vitae euismod neque condimentum eget. Sed porttitor elementum dictum vel.', '2023-10-11 13:46:10'),
(11, '160421094', 9, 'Aliquam elementum, felis sed rutrum rutrum, lacus dolor suscipit justo, non imperdiet enim velit at.', '2023-10-11 13:54:24'),
(12, '160421094', 10, 'Aliquam elementum, felis sed rutrum rutrum, lacus dolor suscipit justo, non imperdiet enim velit at.', '2023-10-11 13:56:23'),
(13, '160421094', 7, 'Praesent non nulla nec tellus congue dictum. Praesent dictum laoreet sapien in tincidunt. Aenean eu.', '2023-10-11 13:56:51'),
(14, '160421023', 11, 'Curabitur et aliquam enim. Sed maximus maximus consectetur. Etiam interdum convallis erat id tellus.', '2023-10-11 14:15:52'),
(15, '160421023', 3, 'Nam rhoncus quis nunc non euismod. Aliquam nec neque justo. Praesent mollis, leo in bibendum ligula.', '2023-10-11 14:50:46'),
(16, '160421023', 3, 'Nulla vitae quam viverra, tincidunt purus ac, porttitor ante. Aenean ullamcorper ultrices massa nam.', '2024-01-04 06:26:16'),
(17, '160421023', 3, 'Duis volutpat lorem eros, sed tempor risus mattis ut. Vivamus ac ante dapibus, pretium purus tellus.', '2024-01-04 06:29:50'),
(18, '160421023', 12, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ornare nibh eu tortor commodo libero.', '2024-01-04 06:30:10'),
(19, '160421023', 13, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porttitor et tellus ac sodales justo.', '2024-01-04 06:31:07'),
(20, '160821013', 14, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque non bibendum felis. Ut tellus.', '2024-01-04 09:55:07'),
(21, '160821013', 15, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vel ante eget erat pretium vestibulum.', '2024-01-04 09:55:32'),
(22, '160821013', 16, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque auctor justo non nisi ornare justo.', '2024-01-04 09:56:06'),
(23, '160821013', 17, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ullamcorper lacus lectus, a volutpat.', '2024-01-04 09:56:23'),
(24, '160821013', 18, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nec efficitur sapien. Nam suscipit quam.', '2024-01-04 09:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` varchar(40) NOT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `salt` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `nama`, `password`, `salt`) VALUES
('160421023', 'Alexander Kenrick Duanto', 'd19cea416abae5c1a6a200471bd1a1e8', 'ChgAfDiEBj'),
('160421094', 'Wensel Alvin Viking', '58da3eda3a95915d2e71d33b687f0015', 'BghiCDjfAE'),
('160821013', 'Jeremy Ivan Hadiono', '022a778a724b2726a97f68e051044890', 'BCghfDEjAi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cerita`
--
ALTER TABLE `cerita`
  ADD PRIMARY KEY (`idcerita`),
  ADD KEY `fk_cerita_users1_idx` (`idusers_pembuat_awal`);

--
-- Indexes for table `paragraf`
--
ALTER TABLE `paragraf`
  ADD PRIMARY KEY (`idparagraf`),
  ADD KEY `fk_paragraf_users1_idx` (`idusers`),
  ADD KEY `fk_paragraf_cerita1_idx` (`idcerita`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cerita`
--
ALTER TABLE `cerita`
  MODIFY `idcerita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `paragraf`
--
ALTER TABLE `paragraf`
  MODIFY `idparagraf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cerita`
--
ALTER TABLE `cerita`
  ADD CONSTRAINT `fk_cerita_users1` FOREIGN KEY (`idusers_pembuat_awal`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `paragraf`
--
ALTER TABLE `paragraf`
  ADD CONSTRAINT `fk_paragraf_cerita1` FOREIGN KEY (`idcerita`) REFERENCES `cerita` (`idcerita`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_paragraf_users1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
