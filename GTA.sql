-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 09:12 PM
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
-- Database: `gta`
--

-- --------------------------------------------------------

--
-- Table structure for table `bron`
--

CREATE TABLE `bron` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `typ` varchar(50) NOT NULL,
  `opis` text NOT NULL,
  `obrazenia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bron`
--

INSERT INTO `bron` (`id`, `nazwa`, `typ`, `opis`, `obrazenia`) VALUES
(18, 'Combat Pistol', 'cos', '', 27),
(19, 'Special Carbine', 'Karabin', 'Mocniejszy karabin z dobrą szybkostrzelnością i stabilnością.', 34),
(20, 'Minigun', 'Ciężka Broń', 'Niszczycielska broń z ekstremalną szybkostrzelnością, ale bez celownika.', 30),
(21, 'RPG', 'Wyrzutnia', 'Klasyczna wyrzutnia rakiet, niszczy wszystko na swojej drodze.', 100),
(22, 'Minigun', 'Ciężka Broń', 'Niszczycielska broń z ekstremalną szybkostrzelnością, ale bez celownika.', 30);

-- --------------------------------------------------------

--
-- Table structure for table `napady`
--

CREATE TABLE `napady` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `lokalizacja` varchar(150) NOT NULL,
  `nagroda` decimal(10,2) NOT NULL,
  `opis` text NOT NULL,
  `pojazd_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `napady`
--

INSERT INTO `napady` (`id`, `nazwa`, `lokalizacja`, `nagroda`, `opis`, `pojazd_id`) VALUES
(1, 'Napad na Fleeca Bank', 'Los Santos', 500000.00, 'Pierwszy napad dostępny w GTA Online.', 1),
(2, 'Napad na Pacific Standard', 'Centrum Los Santos', 1250000.00, 'Jeden z największych napadów.', 2),
(5, 'Napad na dom', 'bogate', 1.00, '<p>csfdfdfd</p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `napad_bron`
--

CREATE TABLE `napad_bron` (
  `napad_id` int(11) NOT NULL,
  `bron_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `napad_bron`
--

INSERT INTO `napad_bron` (`napad_id`, `bron_id`) VALUES
(1, 18),
(1, 19),
(2, 20),
(2, 21);

-- --------------------------------------------------------

--
-- Table structure for table `napad_postac`
--

CREATE TABLE `napad_postac` (
  `napad_id` int(11) NOT NULL,
  `postac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `napad_postac`
--

INSERT INTO `napad_postac` (`napad_id`, `postac_id`) VALUES
(1, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pojazdy_specjalne`
--

CREATE TABLE `pojazdy_specjalne` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `typ` varchar(50) DEFAULT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pojazdy_specjalne`
--

INSERT INTO `pojazdy_specjalne` (`id`, `nazwa`, `typ`, `opis`) VALUES
(1, 'Kuruma (Opancerzona)', 'Pancerny', 'Pojazd kuloodporny, idealny do napadów.'),
(2, 'Stromberg', 'WOW', 'Samochód, który może zamieniać się w łódź podwodną.'),
(3, 'Ruiner 2000', 'SPORT', 'Sportowy samochód z rakietami, spadochronem i możliwością skoku.'),
(4, 'Rhino', 'Czołg', 'Potężny czołg wojskowy.'),
(5, 'HVY Insurgent', 'Pancernik', 'Duży pojazd opancerzony z wieżyczką. '),
(7, 'Ursus 2000', 'traktor', '2000 koni mechanicznych');

-- --------------------------------------------------------

--
-- Table structure for table `postacie`
--

CREATE TABLE `postacie` (
  `id` int(11) NOT NULL,
  `imie` varchar(100) NOT NULL,
  `nazwisko` varchar(100) NOT NULL,
  `opis` text NOT NULL,
  `rodzina` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postacie`
--

INSERT INTO `postacie` (`id`, `imie`, `nazwisko`, `opis`, `rodzina`) VALUES
(1, 'Michael', 'De Santa', 'Były złodziej, teraz próbuje ułożyć życie.', 'Żona: Amanda, Dzieci: Tracy, Jimmy'),
(2, 'Franklin', 'Clinton', 'Młody gangster szukający drogi do bogactwa.', 'Ciotka: Denise');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'gta', '$2y$10$TM0bASyDUEy22Vx.hK/V8OJMMFtv5a6XpR2n9Ve1sebRyDJP6JO5K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bron`
--
ALTER TABLE `bron`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `napady`
--
ALTER TABLE `napady`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_postacie` (`id`),
  ADD KEY `pojazd_id` (`pojazd_id`);

--
-- Indexes for table `napad_bron`
--
ALTER TABLE `napad_bron`
  ADD PRIMARY KEY (`napad_id`,`bron_id`),
  ADD KEY `bron_id` (`bron_id`);

--
-- Indexes for table `napad_postac`
--
ALTER TABLE `napad_postac`
  ADD PRIMARY KEY (`napad_id`,`postac_id`),
  ADD KEY `postac_id` (`postac_id`);

--
-- Indexes for table `pojazdy_specjalne`
--
ALTER TABLE `pojazdy_specjalne`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postacie`
--
ALTER TABLE `postacie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bron`
--
ALTER TABLE `bron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `napady`
--
ALTER TABLE `napady`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pojazdy_specjalne`
--
ALTER TABLE `pojazdy_specjalne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `postacie`
--
ALTER TABLE `postacie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `napady`
--
ALTER TABLE `napady`
  ADD CONSTRAINT `napady_ibfk_2` FOREIGN KEY (`pojazd_id`) REFERENCES `pojazdy_specjalne` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `napad_bron`
--
ALTER TABLE `napad_bron`
  ADD CONSTRAINT `napad_bron_ibfk_1` FOREIGN KEY (`napad_id`) REFERENCES `napady` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `napad_bron_ibfk_2` FOREIGN KEY (`bron_id`) REFERENCES `bron` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `napad_postac`
--
ALTER TABLE `napad_postac`
  ADD CONSTRAINT `napad_postac_ibfk_1` FOREIGN KEY (`napad_id`) REFERENCES `napady` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `napad_postac_ibfk_2` FOREIGN KEY (`postac_id`) REFERENCES `postacie` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
