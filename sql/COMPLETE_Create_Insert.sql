-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 20. Jan 2022 um 04:58
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.12

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
(22, 'Frau', 'Meister', 'Admin', 'admin@hotel.com', '$2y$10$thRfFkW3Bm8pEizBDRparu1dhq08vu/hYLfYn94eJ337O7vP.lUSe', 'admin', 'admin', 'active'),
(23, '', 'Service', 'Techniker', 'Service@hotel.com', '$2y$10$iMgzEkm4PVGvWCAtVC5D3u5cWlbK/gQwPCPIMGg7dzHWvtA5R9nBu', 'service', 'serviceTech', 'active'),
(24, '', 'Gästrich', 'Gast', 'Gast@email.com', '$2y$10$7NDRfoVwaof.jvM8t0NxHupUQuWAj1PHeLMOYgjd2doFaNyjnP.fC', 'gast', 'guest', 'active'),
(25, 'Enby', 'Müller', 'Edit', 'edit@mail.com', '$2y$10$hhfRxlLpLLhzUK2n11E7CejsEteSG/98MtfcE/cAZNkcn9UPWEuhO', 'edit', 'guest', 'active');

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
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
