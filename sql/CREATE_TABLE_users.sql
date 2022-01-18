-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Jan 2022 um 00:11
-- Server-Version: 10.4.22-MariaDB
-- PHP-Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hotel_webpage_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersAnrede` varchar(50) DEFAULT NULL,
  `usersNachname` varchar(255) NOT NULL,
  `usersVorname` varchar(255) NOT NULL,
  `usersEmail` varchar(255) NOT NULL,
  `usersPassword` varchar(255) NOT NULL,
  `usersUid` varchar(255) NOT NULL,
  `usersTyp` varchar(12) NOT NULL DEFAULT 'guest',
  `usersStatus` varchar(12) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`usersId`, `usersAnrede`, `usersNachname`, `usersVorname`, `usersEmail`, `usersPassword`, `usersUid`, `usersTyp`, `usersStatus`) VALUES
(11, '', 'Ingo', 'Weigel', 'ingo@my-hotel.com', '$2y$10$9B8CAueXFqf5/ySwp6jbF.J13oNrQjX8bjBPYITyggB5pzSmDokPC', 'ingo', 'guest', 'active'),
(12, '', 'Admin', 'istrator', 'admin@my-hotel.com', '$2y$10$LSYxEy/IBFGwbg/2O8Vv5uFXTvjVvlbAgbPGfzHu/XfaLm6/fs4VO', 'admin', 'guest', 'active'),
(13, '', 'Gast', 'Gästin', 'guest@my-hotel.com', '$2y$10$58K.U9OyGAECCQDh8/VPge5Ck9Ap0uxFH59KnKcgeADPqKWq3wGGy', 'guest', 'guest', 'active'),
(14, '', 'serviceTech', 'niker*in', 'service@my-hotel.com', '$2y$10$gpVChCSPpFySU3rhSZzrw.XzUiw6/alUe/F1mYk5SqFxOc/CelPxm', 'service', 'guest', 'active'),
(15, '', 'Peter', 'Gamsjäger', 'peter@my-hotel.com', '$2y$10$T7KwOQWEEA3FnXontOhvGeu.qj2yjzs5EXaCI1UeNZPRTNF2/37FK', 'peter', 'guest', 'active'),
(16, '', 'Simon', 'Biegler', 'simon@my-hotel.com', '$2y$10$br6CyfNQyVlw8g.sc5P/IehhBQYO/INvTIKFbk0DjqhEGHw4bwlEy', 'simon', 'guest', 'active');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
