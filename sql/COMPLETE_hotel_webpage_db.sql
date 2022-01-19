-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Jan 2022 um 18:08
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
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news` (
  `newsid` int(11) NOT NULL,
  `newsfile_path` varchar(255) NOT NULL,
  `newstitle` varchar(255) NOT NULL,
  `newsarticle` varchar(255) NOT NULL,
  `newsdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticketStatus` varchar(50) NOT NULL DEFAULT 'open',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tickets`
--

INSERT INTO `tickets` (`id`, `file_path`, `title`, `comment`, `user_id`, `ticketStatus`, `created`) VALUES
(3, 'ticketUploads/3483f6b8-a600-4832-80c9-bca36045fcb2.jpg', 'Versuch1', 'Beschreibung blub', 16, 'open', '2022-01-19 02:59:07'),
(4, 'ticketUploads/10e6e741-2549-43cb-a68c-ed7c221f5f6c.jpg', 'neues', 'Für Peter', 15, 'open', '2022-01-19 03:02:17'),
(5, 'ticketUploads/c767bfd3-dbd5-40c1-8203-2f7bec82a9a2.jpg', 'kasjdkl', 'aldfasdflkj', 12, 'open', '2022-01-19 03:45:41');

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
(12, '', 'Admin', 'istrator', 'admin@my-hotel.com', '$2y$10$LSYxEy/IBFGwbg/2O8Vv5uFXTvjVvlbAgbPGfzHu/XfaLm6/fs4VO', 'admin', 'admin', 'active'),
(13, '', 'Gast', 'Gästin', 'guest@my-hotel.com', '$2y$10$58K.U9OyGAECCQDh8/VPge5Ck9Ap0uxFH59KnKcgeADPqKWq3wGGy', 'guest', 'guest', 'active'),
(14, '', 'niker*in', 'serviceTech', 'service@my-hotel.com', '$2y$10$gpVChCSPpFySU3rhSZzrw.XzUiw6/alUe/F1mYk5SqFxOc/CelPxm', 'service', 'service', 'active'),
(15, '', 'Peter', 'Gamsjäger', 'peter@my-hotel.com', '$2y$10$T7KwOQWEEA3FnXontOhvGeu.qj2yjzs5EXaCI1UeNZPRTNF2/37FK', 'peter', 'guest', 'active'),
(16, '', 'Simon', 'Biegler', 'simon@my-hotel.com', '$2y$10$br6CyfNQyVlw8g.sc5P/IehhBQYO/INvTIKFbk0DjqhEGHw4bwlEy', 'simon', 'guest', 'active'),
(18, 'Herr', 'Nachname', 'Vorname', 'VorNach@email.com', '$2y$10$HGFJoer51ae/ffvB3pa/IuUXHr0XwkkN7ziLIu6SxgjgrJfWkiQI2', 'Vornach', 'guest', 'active');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsid`);

--
-- Indizes für die Tabelle `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `newsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
