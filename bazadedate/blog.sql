-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2019 at 11:04 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

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
(7, 1, 'Excursie in Budapesta', 'Suspendisse sed nisi lacus sed viverra tellus. Cras sed felis eget velit aliquet. Mattis vulputate enim nulla aliquet. Convallis a cras semper auctor neque vitae tempus quam pellentesque. Commodo nulla facilisi nullam vehicula ipsum a arcu cursus. Vulputa', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Fringilla ut morbi tincidunt augue interdum velit. Senectus et netus et malesuada fames ac turpis egestas integer. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit duis. Dolor magna eget est lorem ipsum dolor. Integer feugiat scelerisque varius morbi enim. Vel facilisis volutpat est velit egestas dui id ornare arcu. Sollicitudin tempor id eu nisl. Faucibus a pellentesque sit amet porttitor eget dolor morbi non. Praesent tristique magna sit amet purus gravida quis blandit. Tincidunt augue interdum velit euismod in pellentesque massa placerat duis. Ut morbi tincidunt augue interdum velit. Amet consectetur adipiscing elit pellentesque habitant morbi. Turpis cursus in hac habitasse platea.\r\n\r\nNunc sed id semper risus in. Mattis pellentesque id nibh tortor id aliquet. Diam vulputate ut pharetra sit amet aliquam id diam maecenas. Elit at imperdiet dui accumsan sit amet nulla facilisi. Cursus eget nunc scelerisque viverra mauris in aliquam. Mi quis hendrerit dolor magna eget est. Tellus in metus vulputate eu. Viverra nam libero justo laoreet sit amet cursus. Vitae nunc sed velit dignissim sodales ut. Amet consectetur adipiscing elit ut aliquam purus sit. Mattis nunc sed blandit libero volutpat sed. Cras pulvinar mattis nunc sed blandit libero volutpat sed. Tellus integer feugiat scelerisque varius morbi enim nunc. Non nisi est sit amet facilisis magna. Rutrum tellus pellentesque eu tincidunt tortor. At auctor urna nunc id cursus metus aliquam eleifend.\r\n\r\nVestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare. Pulvinar mattis nunc sed blandit libero. Condimentum lacinia quis vel eros donec ac odio tempor orci. Leo duis ut diam quam nulla porttitor massa id neque. Morbi enim nunc faucibus a pellentesque sit amet. Interdum velit laoreet id donec ultrices tincidunt arcu non sodales. Eget arcu dictum varius duis at consectetur. Morbi quis commodo odio aenean sed adipiscing. Quis ipsum suspendisse ultrices gravida. Netus et malesuada fames ac. Ut etiam sit amet nisl.\r\n\r\nEst pellentesque elit ullamcorper dignissim cras tincidunt lobortis. Pretium nibh ipsum consequat nisl. Tincidunt eget nullam non nisi est sit amet facilisis. Tristique senectus et netus et. Id porta nibh venenatis cras sed felis eget. Rhoncus est pellentesque elit ullamcorper. Nibh tortor id aliquet lectus. Mollis nunc sed id semper risus. Enim facilisis gravida neque convallis a cras semper. Diam vulputate ut pharetra sit amet aliquam id diam maecenas. Quisque id diam vel quam elementum.\r\n\r\nMalesuada fames ac turpis egestas sed. Rutrum quisque non tellus orci ac auctor. Donec massa sapien faucibus et molestie. Tincidunt lobortis feugiat vivamus at. Morbi leo urna molestie at elementum eu. Habitasse platea dictumst vestibulum rhoncus est. Vel risus commodo viverra maecenas accumsan lacus. Amet justo donec enim diam vulputate ut pharetra sit amet. Est ante in nibh mauris cursus mattis molestie a. Semper auctor neque vitae tempus quam pellentesque. Ut venenatis tellus in metus vulputate eu scelerisque. Eu turpis egestas pretium aenean pharetra magna. Arcu dui vivamus arcu felis bibendum ut.\r\n\r\nAliquam vestibulum morbi blandit cursus risus at ultrices. Non curabitur gravida arcu ac. Dui nunc mattis enim ut tellus elementum. Commodo viverra maecenas accumsan lacus vel facilisis volutpat. Vulputate mi sit amet mauris commodo quis imperdiet massa. Magna fringilla urna porttitor rhoncus dolor purus. Augue ut lectus arcu bibendum at varius vel pharetra vel. Dolor sit amet consectetur adipiscing elit ut. Elit at imperdiet dui accumsan sit amet. Suspendisse sed nisi lacus sed viverra tellus. Cras sed felis eget velit aliquet. Mattis vulputate enim nulla aliquet. Convallis a cras semper auctor neque vitae tempus quam pellentesque. Commodo nulla facilisi nullam vehicula ipsum a arcu cursus. Vulputate sapien nec sagittis aliquam malesuada. Tincidunt lobortis feugiat vivamus at augue eget arcu dictum. Ultricies mi quis hendrerit dolor magna eget est.', '20190603133908.jpg', 1, '2019-06-12 19:44:39', 1),
(8, 1, 'Visiting Berlin', 'Nisl pretium fusce id velit ut tortor pretium. Lorem ipsum dolor sit amet consectetur adipiscing elit duis. Adipiscing elit pellentesque habitant morbi. Arcu cursus vitae congue mauris rhoncus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Justo laoreet sit amet cursus sit. Ornare suspendisse sed nisi lacus sed viverra tellus in. Tellus at urna condimentum mattis pellentesque. Vel fringilla est ullamcorper eget nulla facilisi etiam dignissim diam. Tincidunt lobortis feugiat vivamus at augue. Sit amet consectetur adipiscing elit ut aliquam. In ornare quam viverra orci sagittis eu. Dictum sit amet justo donec enim. Velit aliquet sagittis id consectetur. Nec nam aliquam sem et tortor.\r\n\r\nAliquam sem fringilla ut morbi tincidunt augue interdum velit euismod. Pulvinar elementum integer enim neque volutpat. Et tortor at risus viverra adipiscing at in. Venenatis lectus magna fringilla urna. Hendrerit dolor magna eget est lorem ipsum. Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Ut diam quam nulla porttitor massa id neque aliquam. Commodo elit at imperdiet dui. Risus sed vulputate odio ut enim blandit volutpat maecenas volutpat. Sit amet consectetur adipiscing elit ut aliquam purus sit amet. Nisl pretium fusce id velit ut tortor pretium. Lorem ipsum dolor sit amet consectetur adipiscing elit duis. Adipiscing elit pellentesque habitant morbi. Arcu cursus vitae congue mauris rhoncus.\r\n\r\nTincidunt nunc pulvinar sapien et ligula. Quis blandit turpis cursus in hac. Fusce id velit ut tortor. Egestas congue quisque egestas diam in arcu. Luctus venenatis lectus magna fringilla urna porttitor rhoncus. Viverra mauris in aliquam sem fringilla ut morbi tincidunt augue. Tristique nulla aliquet enim tortor at. Vel risus commodo viverra maecenas accumsan lacus. Nisl pretium fusce id velit ut. Volutpat ac tincidunt vitae semper quis lectus nulla.\r\n\r\nA pellentesque sit amet porttitor. Fusce id velit ut tortor pretium viverra suspendisse potenti. Viverra orci sagittis eu volutpat odio facilisis. Turpis tincidunt id aliquet risus feugiat. Vulputate enim nulla aliquet porttitor. Volutpat diam ut venenatis tellus in metus. Amet cursus sit amet dictum sit. Pellentesque sit amet porttitor eget dolor morbi. Facilisis leo vel fringilla est ullamcorper. Non consectetur a erat nam at. Donec massa sapien faucibus et molestie ac feugiat sed. Diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Mi proin sed libero enim sed faucibus turpis.\r\n\r\nNibh mauris cursus mattis molestie a iaculis at erat. At urna condimentum mattis pellentesque id nibh. Lorem donec massa sapien faucibus. Lacinia at quis risus sed. Nisl tincidunt eget nullam non nisi est sit. Vel fringilla est ullamcorper eget nulla facilisi etiam. Tincidunt lobortis feugiat vivamus at augue eget. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi. Vulputate mi sit amet mauris commodo quis. Felis imperdiet proin fermentum leo. Mauris a diam maecenas sed. Sociis natoque penatibus et magnis. Sit amet cursus sit amet dictum. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus.\r\n\r\nQuam pellentesque nec nam aliquam sem et tortor. Donec adipiscing tristique risus nec feugiat in. Mauris a diam maecenas sed enim ut sem viverra. Est sit amet facilisis magna etiam tempor. At elementum eu facilisis sed odio morbi quis. Enim tortor at auctor urna nunc. Orci eu lobortis elementum nibh tellus molestie nunc. Neque vitae tempus quam pellentesque nec nam aliquam sem et. Tempor id eu nisl nunc mi. Nunc sed blandit libero volutpat. Accumsan in nisl nisi scelerisque eu ultrices vitae auctor eu. Euismod in pellentesque massa placerat duis ultricies. Iaculis eu non diam phasellus vestibulum lorem sed. Quis lectus nulla at volutpat diam. Feugiat vivamus at augue eget arcu dictum varius. Accumsan sit amet nulla facilisi morbi tempus iaculis. Molestie nunc non blandit massa enim nec.\r\n\r\nSollicitudin nibh sit amet commodo nulla facilisi nullam vehicula. Facilisi nullam vehicula ipsum a arcu cursus vitae. Odio eu feugiat pretium nibh ipsum consequat nisl vel pretium. Ullamcorper morbi tincidunt ornare massa eget egestas purus viverra accumsan. Aenean euismod elementum nisi quis. Mi ipsum faucibus vitae aliquet nec ullamcorper sit. Fames ac turpis egestas integer eget aliquet nibh. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Fermentum dui faucibus in ornare quam viverra orci sagittis. Tellus at urna condimentum mattis pellentesque. Ut faucibus pulvinar elementum integer enim neque. Platea dictumst quisque sagittis purus sit.', '20190603135623.jpg', 1, '2019-06-03 11:56:23', 1),
(9, 1, 'City break in Amsterdam', ' Hendrerit dolor magna eget est lorem ipsum. Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Ut diam quam nulla porttitor massa id neque aliquam. Commodo elit at imperdiet dui. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Justo laoreet sit amet cursus sit. Ornare suspendisse sed nisi lacus sed viverra tellus in. Tellus at urna condimentum mattis pellentesque. Vel fringilla est ullamcorper eget nulla facilisi etiam dignissim diam. Tincidunt lobortis feugiat vivamus at augue. Sit amet consectetur adipiscing elit ut aliquam. In ornare quam viverra orci sagittis eu. Dictum sit amet justo donec enim. Velit aliquet sagittis id consectetur. Nec nam aliquam sem et tortor.\r\n\r\nAliquam sem fringilla ut morbi tincidunt augue interdum velit euismod. Pulvinar elementum integer enim neque volutpat. Et tortor at risus viverra adipiscing at in. Venenatis lectus magna fringilla urna. Hendrerit dolor magna eget est lorem ipsum. Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Ut diam quam nulla porttitor massa id neque aliquam. Commodo elit at imperdiet dui. Risus sed vulputate odio ut enim blandit volutpat maecenas volutpat. Sit amet consectetur adipiscing elit ut aliquam purus sit amet. Nisl pretium fusce id velit ut tortor pretium. Lorem ipsum dolor sit amet consectetur adipiscing elit duis. Adipiscing elit pellentesque habitant morbi. Arcu cursus vitae congue mauris rhoncus.', '20190603140251.jpg', 1, '2019-06-03 12:02:51', 1),
(10, 2, 'Weekend in Sighisoara', 'A pellentesque sit amet porttitor. Fusce id velit ut tortor pretium viverra suspendisse potenti. Viverra orci sagittis eu volutpat odio facilisis. Turpis tincidunt id aliquet risus feugiat. Vulputate enim nulla aliquet porttitor.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Justo laoreet sit amet cursus sit. Ornare suspendisse sed nisi lacus sed viverra tellus in. Tellus at urna condimentum mattis pellentesque. Vel fringilla est ullamcorper eget nulla facilisi etiam dignissim diam. Tincidunt lobortis feugiat vivamus at augue. Sit amet consectetur adipiscing elit ut aliquam. In ornare quam viverra orci sagittis eu. Dictum sit amet justo donec enim. Velit aliquet sagittis id consectetur. Nec nam aliquam sem et tortor.\r\n\r\nAliquam sem fringilla ut morbi tincidunt augue interdum velit euismod. Pulvinar elementum integer enim neque volutpat. Et tortor at risus viverra adipiscing at in. Venenatis lectus magna fringilla urna. Hendrerit dolor magna eget est lorem ipsum. Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Ut diam quam nulla porttitor massa id neque aliquam. Commodo elit at imperdiet dui. Risus sed vulputate odio ut enim blandit volutpat maecenas volutpat. Sit amet consectetur adipiscing elit ut aliquam purus sit amet. Nisl pretium fusce id velit ut tortor pretium. Lorem ipsum dolor sit amet consectetur adipiscing elit duis. Adipiscing elit pellentesque habitant morbi. Arcu cursus vitae congue mauris rhoncus.\r\n\r\nTincidunt nunc pulvinar sapien et ligula. Quis blandit turpis cursus in hac. Fusce id velit ut tortor. Egestas congue quisque egestas diam in arcu. Luctus venenatis lectus magna fringilla urna porttitor rhoncus. Viverra mauris in aliquam sem fringilla ut morbi tincidunt augue. Tristique nulla aliquet enim tortor at. Vel risus commodo viverra maecenas accumsan lacus. Nisl pretium fusce id velit ut. Volutpat ac tincidunt vitae semper quis lectus nulla.', '20190603141320.jpg', 1, '2019-06-03 12:13:20', 1),
(11, 2, 'Sibiu', 'Nibh mauris cursus mattis molestie a iaculis at erat. At urna condimentum mattis pellentesque id nibh. Lorem donec massa sapien faucibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Justo laoreet sit amet cursus sit. Ornare suspendisse sed nisi lacus sed viverra tellus in. Tellus at urna condimentum mattis pellentesque. Vel fringilla est ullamcorper eget nulla facilisi etiam dignissim diam. Tincidunt lobortis feugiat vivamus at augue. Sit amet consectetur adipiscing elit ut aliquam. In ornare quam viverra orci sagittis eu. Dictum sit amet justo donec enim. Velit aliquet sagittis id consectetur. Nec nam aliquam sem et tortor.\r\n\r\nAliquam sem fringilla ut morbi tincidunt augue interdum velit euismod. Pulvinar elementum integer enim neque volutpat. Et tortor at risus viverra adipiscing at in. Venenatis lectus magna fringilla urna. Hendrerit dolor magna eget est lorem ipsum. Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Ut diam quam nulla porttitor massa id neque aliquam. Commodo elit at imperdiet dui. Risus sed vulputate odio ut enim blandit volutpat maecenas volutpat. Sit amet consectetur adipiscing elit ut aliquam purus sit amet. Nisl pretium fusce id velit ut tortor pretium. Lorem ipsum dolor sit amet consectetur adipiscing elit duis. Adipiscing elit pellentesque habitant morbi. Arcu cursus vitae congue mauris rhoncus.', '20190603142127.jpg', 1, '2019-06-03 12:21:27', 1),
(12, 1, 'Prague ', 'Tincidunt nunc pulvinar sapien et ligula. Quis blandit turpis cursus in hac. Fusce id velit ut tortor. Egestas congue quisque egestas diam in arcu.', 'Tincidunt nunc pulvinar sapien et ligula. Quis blandit turpis cursus in hac. Fusce id velit ut tortor. Egestas congue quisque egestas diam in arcu. Luctus venenatis lectus magna fringilla urna porttitor rhoncus. Viverra mauris in aliquam sem fringilla ut morbi tincidunt augue. Tristique nulla aliquet enim tortor at. Vel risus commodo viverra maecenas accumsan lacus. Nisl pretium fusce id velit ut. Volutpat ac tincidunt vitae semper quis lectus nulla.\r\n\r\nA pellentesque sit amet porttitor. Fusce id velit ut tortor pretium viverra suspendisse potenti. Viverra orci sagittis eu volutpat odio facilisis. Turpis tincidunt id aliquet risus feugiat. Vulputate enim nulla aliquet porttitor. Volutpat diam ut venenatis tellus in metus. Amet cursus sit amet dictum sit. Pellentesque sit amet porttitor eget dolor morbi. Facilisis leo vel fringilla est ullamcorper. Non consectetur a erat nam at. Donec massa sapien faucibus et molestie ac feugiat sed. Diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Mi proin sed libero enim sed faucibus turpis.\r\n\r\nNibh mauris cursus mattis molestie a iaculis at erat. At urna condimentum mattis pellentesque id nibh. Lorem donec massa sapien faucibus. Lacinia at quis risus sed. Nisl tincidunt eget nullam non nisi est sit. Vel fringilla est ullamcorper eget nulla facilisi etiam. Tincidunt lobortis feugiat vivamus at augue eget. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi. Vulputate mi sit amet mauris commodo quis. Felis imperdiet proin fermentum leo. Mauris a diam maecenas sed. Sociis natoque penatibus et magnis. Sit amet cursus sit amet dictum. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus.', '20190603142950.jpg', 1, '2019-06-03 12:29:50', 1),
(13, 3, 'My Trip to Japan ', 'Mauris a diam maecenas sed. Sociis natoque penatibus et magnis. Sit amet cursus sit amet dictum. Adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut tortor pretium viverra suspendisse potenti. Nec feugiat in fermentum posuere urna nec tincidunt praesent. Magna eget est lorem ipsum dolor. Tempor nec feugiat nisl pretium fusce id velit. Tincidunt dui ut ornare lectus sit. Varius quam quisque id diam. Est placerat in egestas erat. Semper auctor neque vitae tempus quam. Sed felis eget velit aliquet sagittis id. Non enim praesent elementum facilisis leo vel. Egestas dui id ornare arcu odio ut sem. Imperdiet sed euismod nisi porta lorem mollis. Molestie nunc non blandit massa enim nec dui nunc mattis. Praesent elementum facilisis leo vel.\r\n\r\nImperdiet sed euismod nisi porta lorem mollis aliquam. Leo a diam sollicitudin tempor id eu nisl nunc mi. Id leo in vitae turpis massa sed elementum tempus egestas. Erat imperdiet sed euismod nisi porta lorem mollis aliquam ut. Nullam eget felis eget nunc lobortis. Ridiculus mus mauris vitae ultricies leo integer malesuada. Faucibus turpis in eu mi bibendum neque egestas. Mollis nunc sed id semper risus in. Est ultricies integer quis auctor elit sed vulputate mi sit. Sit amet facilisis magna etiam tempor.\r\n\r\nNascetur ridiculus mus mauris vitae ultricies leo integer. Et malesuada fames ac turpis egestas. Turpis massa sed elementum tempus. Scelerisque felis imperdiet proin fermentum. Condimentum lacinia quis vel eros donec ac. Dictum fusce ut placerat orci nulla. Libero volutpat sed cras ornare arcu dui. Turpis massa sed elementum tempus. Iaculis urna id volutpat lacus laoreet non curabitur. Sit amet venenatis urna cursus. Non enim praesent elementum facilisis leo vel. Cras adipiscing enim eu turpis egestas. Enim diam vulputate ut pharetra sit amet aliquam id. Viverra vitae congue eu consequat ac felis.\r\n\r\nMi sit amet mauris commodo quis imperdiet massa. Sed turpis tincidunt id aliquet risus. Urna nec tincidunt praesent semper. Et netus et malesuada fames. Montes nascetur ridiculus mus mauris vitae ultricies leo integer malesuada. Vivamus arcu felis bibendum ut tristique et. Euismod lacinia at quis risus sed. Eu lobortis elementum nibh tellus molestie nunc. Mollis nunc sed id semper risus. Etiam dignissim diam quis enim lobortis scelerisque fermentum dui faucibus. Quam elementum pulvinar etiam non quam lacus suspendisse faucibus interdum. Aliquet porttitor lacus luctus accumsan tortor posuere ac. Pharetra vel turpis nunc eget lorem dolor. Pellentesque pulvinar pellentesque habitant morbi. Gravida dictum fusce ut placerat orci nulla pellentesque. Donec massa sapien faucibus et molestie ac feugiat sed. In metus vulputate eu scelerisque felis imperdiet proin fermentum. Semper risus in hendrerit gravida rutrum. Libero justo laoreet sit amet cursus.\r\n\r\nVel pharetra vel turpis nunc eget lorem dolor sed viverra. Iaculis at erat pellentesque adipiscing commodo elit at imperdiet. Arcu felis bibendum ut tristique et egestas quis. At risus viverra adipiscing at in. Arcu non sodales neque sodales ut etiam. Lobortis mattis aliquam faucibus purus in massa. Id nibh tortor id aliquet lectus. Adipiscing elit duis tristique sollicitudin nibh sit. Eros donec ac odio tempor orci dapibus ultrices in. Et netus et malesuada fames ac turpis egestas. Sit amet cursus sit amet dictum sit amet justo donec. Amet consectetur adipiscing elit duis tristique. Duis ultricies lacus sed turpis tincidunt. Tellus id interdum velit laoreet id donec. Sit amet volutpat consequat mauris nunc congue nisi vitae. Condimentum lacinia quis vel eros donec ac odio. Eget duis at tellus at.', '20190603144316.jpg', 1, '2019-06-03 12:43:16', 1);

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
(11, 'Gamer', 'In dapibus mauris magna, ac vestibulum orci convallis sit amet. Praesent nibh enim, hendrerit sit amet sapien in, congue elementum tortor. Sed eget posuere est. ', 13, 1),
(12, 'cosmina', 'Maecenas semper dolor nec mauris tristique, a tristique tellus accumsan. Suspendisse pulvinar enim a tortor finibus mollis. Pellentesque elementum tellus nec magna tincidunt scelerisque. ', 11, 1),
(13, 'Biancab', 'Aenean a est malesuada, feugiat est sit amet, lobortis tellus. Curabitur ut sapien orci. Integer justo elit, hendrerit nec consectetur ultricies, lobortis nec leo.', 13, 1);

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
(20, 6, '20181029182350.jpg', 'gfgf', 0),
(21, 7, '20190603134007.jpg', 'Icecream in Budapest', 1),
(22, 7, '20190603134055.jpg', 'Holocaust memorial', 1),
(23, 7, '20190603134302.jpg', 'Budapest', 1),
(24, 8, '20190603135638.jpg', 'Berlin Cathedral', 1),
(25, 8, '20190603135708.jpg', '', 1),
(26, 9, '20190603140726.jpg', '', 1),
(27, 9, '20190603140741.jpg', '', 1),
(28, 9, 'ceva', '', 1),
(29, 10, '20190603141333.jpg', '', 1),
(30, 10, '20190603141344.jpg', '', 1),
(31, 10, '20190603141423.jpg', '', 1),
(32, 11, '20190603142144.jpg', '', 1),
(33, 11, '20190603142156.jpg', '', 1),
(34, 12, '20190603143009.jpg', '', 1),
(35, 12, '20190603143026.jpg', '', 1),
(36, 12, '20190603143210.jpg', '', 1),
(38, 13, '20190603144346.jpg', '', 1),
(39, 13, '20190603144526.jpg', '', 1);

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
(22, '20190603134400.jpg', '2019-06-02 00:00:00', '2020-08-27 00:00:00', 'My blog', 1);

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
(1, 'Cristina', 'e10adc3949ba59abbe56e057f20f883e', 'bizoi@gmail.com', 1, '2018-10-22 12:25:02');

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categorii`
--
ALTER TABLE `categorii`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comentarii`
--
ALTER TABLE `comentarii`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `galerie`
--
ALTER TABLE `galerie`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `homepage_images`
--
ALTER TABLE `homepage_images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
