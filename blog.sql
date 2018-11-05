-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2018 at 08:50 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articole`
--

CREATE TABLE `articole` (
  `id` int(255) NOT NULL,
  `id_categorie` int(255) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `descriere` varchar(255) NOT NULL,
  `continut` text NOT NULL,
  `poza` varchar(255) NOT NULL,
  `id_admin` int(10) NOT NULL DEFAULT '1',
  `data_adaugare` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articole`
--

INSERT INTO `articole` (`id`, `id_categorie`, `nume`, `descriere`, `continut`, `poza`, `id_admin`, `data_adaugare`, `status`) VALUES
(1, 1, 'Excursie in Budapesta', 'ceva descriere', 'aasdasd asdasdafds adadads', '', 1, '2018-11-05 17:49:26', 1),
(2, 2, 'Excursie in Arad', 'sadsad asdasdasd', 'asdasdsadasdsadsad', 'cristina.jpg', 1, '2018-10-28 11:27:28', 1),
(4, 2, 'asdsadsadsd', 'sdasdsdsadsdasd', 'dsadssssssssssssssssssssssssssssssssssssss', '20181028122030.jpg', 1, '2018-10-28 11:20:30', 0),
(5, 2, 'Arad', 'sdasdsadsd', 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '20181028122409.jpg', 1, '2018-10-28 11:24:09', 1),
(6, 2, 'Romania', 'gdgdgfgdgdfgdg', 'gggggggggggggggggggggggggggggggggggggggggggggggggggg', '20181029182320.jpg', 1, '2018-10-29 18:09:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categorii`
--

CREATE TABLE `categorii` (
  `id` int(255) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `data_adaugare` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorii`
--

INSERT INTO `categorii` (`id`, `nume`, `data_adaugare`, `status`) VALUES
(1, 'Europa', '2018-10-29 17:21:45', 1),
(2, 'Romania', '2018-11-05 13:36:23', 1),
(3, 'Asia', '2018-11-05 13:36:40', 1),
(8, 'ceva', '2018-10-22 12:14:31', 1),
(9, 'cceva', '2018-10-22 12:14:33', 1),
(10, 'Africa', '2018-10-29 17:21:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comentarii`
--

CREATE TABLE `comentarii` (
  `id` int(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `continut` text NOT NULL,
  `id_articol` int(250) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comentarii`
--

INSERT INTO `comentarii` (`id`, `username`, `continut`, `id_articol`, `status`) VALUES
(4, 'Cristina005', 'PrudentÄƒ, pragmaticÄƒ, puternicÄƒ. AÅŸa este descrisÄƒ Angela Merkel de marile publicaÅ£ii ale lumii.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `galerie`
--

CREATE TABLE `galerie` (
  `id` int(250) NOT NULL,
  `id_articol` int(150) NOT NULL,
  `poza` varchar(250) NOT NULL,
  `titlu` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galerie`
--

INSERT INTO `galerie` (`id`, `id_articol`, `poza`, `titlu`, `status`) VALUES
(10, 0, '', '', 1),
(11, 0, '', '', 1),
(15, 2, '20181028113724.jpg', 'ceva', 1),
(18, 0, '20181024225223.jpg', '', 1),
(19, 1, '20181027225602.jpg', 'sdsads', 1),
(20, 6, '20181029182350.jpg', 'gfgf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `homepage_images`
--

CREATE TABLE `homepage_images` (
  `id` int(255) NOT NULL,
  `poza` varchar(255) NOT NULL,
  `data_start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `data_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `titlu` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `homepage_images`
--

INSERT INTO `homepage_images` (`id`, `poza`, `data_start`, `data_end`, `titlu`, `status`) VALUES
(12, '20181028130737.jpg', '2002-01-01 00:00:00', '2008-01-01 00:00:00', '1111', 1),
(14, '20181025111321.jpg', '1990-11-02 00:00:00', '1995-10-10 00:00:00', 'sasasa', 1),
(15, '20181025111543.jpg', '2018-10-15 00:00:00', '2018-11-02 00:00:00', 'sasasa', 1),
(17, '20181025123915.jpg', '2018-10-15 00:00:00', '2018-11-02 00:00:00', 'sasasa', 0),
(19, '20181025124035.jpg', '2018-10-15 00:00:00', '2018-11-30 00:00:00', 'licenta', 1),
(21, '20181025124359.jpg', '2018-10-15 00:00:00', '2018-10-31 00:00:00', 'licenta', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `data_adaugare` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id`, `username`, `parola`, `email`, `status`, `data_adaugare`) VALUES
(1, 'Cristina', 'e10adc3949ba59abbe56e057f20f883e', 'bizoi@gmail.com', 1, '2018-10-22 12:25:02'),
(5, 'sasasasasa', '81dc9bdb52d04dc20036dbd8313ed055', 'Cristina@gmail.com', 0, '2018-10-29 18:13:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articole`
--
ALTER TABLE `articole`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorii`
--
ALTER TABLE `categorii`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `comentarii`
--
ALTER TABLE `comentarii`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galerie`
--
ALTER TABLE `galerie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_images`
--
ALTER TABLE `homepage_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articole`
--
ALTER TABLE `articole`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categorii`
--
ALTER TABLE `categorii`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comentarii`
--
ALTER TABLE `comentarii`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `galerie`
--
ALTER TABLE `galerie`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `homepage_images`
--
ALTER TABLE `homepage_images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
