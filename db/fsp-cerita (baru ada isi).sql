-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 03:59 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fsp-cerita`
--

-- --------------------------------------------------------

--
-- Table structure for table `cerita`
--

CREATE TABLE `cerita` (
  `idcerita` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `idusers_pembuat_awal` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cerita`
--

INSERT INTO `cerita` (`idcerita`, `judul`, `idusers_pembuat_awal`) VALUES
(1, 'TIMUN MAS', '160421023'),
(2, 'SANGKURIANG', '160421094'),
(3, 'MISTERI TELAGA WARNA', '160421094'),
(6, 'SI KABAYAN', '160421023'),
(7, 'PURBASARI DAN PURBARARANG', '160421023'),
(9, 'JAKA TARUB', '160421094'),
(10, 'MALIN KUNDANG', '160421094');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(13, '160421094', 7, 'Praesent non nulla nec tellus congue dictum. Praesent dictum laoreet sapien in tincidunt. Aenean eu.', '2023-10-11 13:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` varchar(40) NOT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `salt` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `nama`, `password`, `salt`) VALUES
('160421023', 'Alexander Kenrick Duanto', 'd19cea416abae5c1a6a200471bd1a1e8', 'ChgAfDiEBj'),
('160421094', 'Wensel Alvin Viking', '58da3eda3a95915d2e71d33b687f0015', 'BghiCDjfAE');

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
  MODIFY `idcerita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `paragraf`
--
ALTER TABLE `paragraf`
  MODIFY `idparagraf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
