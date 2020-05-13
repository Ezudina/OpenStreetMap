-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 01:34 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `openstreetmap`
--

-- --------------------------------------------------------

--
-- Table structure for table `objects`
--

CREATE TABLE `objects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf32 COLLATE utf32_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `objects`
--

INSERT INTO `objects` (`id`, `name`, `longitude`, `latitude`, `description`) VALUES
(1, 'Begova dzamija', 43.859214, 18.429283, 'Gazi Husrev-begova džamija, također poznata i kao Begova džamija je izgrađena 1530. godine u Sarajevu i smatra se jednom od najvažnijih džamija u Bosni i Hercegovini i na Balkanu.'),
(2, 'Narodno pozoriste', 43.857194, 18.42075, 'Narodno pozorište Sarajevo najveća je pozorišna kuća u Bosni i Hercegovini i jedna od najznačajnijih u Jugoistočnoj Evropi. Otvoreno je 17. novembra 1921. godine.'),
(3, 'Vjecna vatra', 43.85883, 18.421862, 'Vječna vatra je spomenik vojnim i civilnim žrtvama Drugog svjetskog rata u Sarajevu. Spomenik je napravljen 6. aprila 1946. godine na prvu godišnjicu oslobođenja Sarajeva od njemačke okupacije.'),
(4, 'Sebilj', 43.859715, 18.431223, 'Sebilj na Baščaršiji je jedini objekt te vrste u Sarajevu, izgrađen 1891. godine, vjerojatno po projektu Josipa Vancaša.'),
(5, 'Zuta tabija', 43.861449, 18.437681, 'Žuta tabija, nalazi se na litici Jekovac, zbog čega je poznata i kao Jekovačka tabija. Jedna je od utvrda koje su činile odbrambeni bedem oko starog grada Vratnika.Pruža jedinstven doživljaj u panorami, pogledu i zvuku. Sagrađena je 1809. godine.'),
(6, 'Bijela tabija', 43.859521, 18.444721, 'Bijela tabija je tvrđava na cesti Dariva - Mošćanica, na istočnoj visinskoj koti sarajevske kotline. Podignuta je na mjestu srednjovjekovne tvrđave, sagrađene oko 1550. godine.'),
(7, 'Inat kuca', 43.858522, 18.434331, 'Inat kuća je objekat u Sarajevu nedaleko od Baščaršije koji je prvobitno izgrađen na mjestu gdje je trebala biti izgrađena Gradska vijećnica a trenutno stoji na drugoj strani rijeke Miljacke.Danas se inat kuća  koristi kao restoran sa tradicionalnom bosan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'mersiha', '123'),
(2, 'emira', '321'),
(3, 'ezudina', '111'),
(4, 'belmin', '222');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `objects`
--
ALTER TABLE `objects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
