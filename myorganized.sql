-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 01, 2026 alle 17:57
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myorganized`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `idUsr` int(11) NOT NULL DEFAULT 0,
  `idProp` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) DEFAULT NULL,
  `descriz` varchar(100) DEFAULT NULL,
  `position` text DEFAULT NULL,
  `start` datetime NOT NULL DEFAULT current_timestamp(),
  `end` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `events`
--

INSERT INTO `events` (`id`, `idUsr`, `idProp`, `title`, `descriz`, `position`, `start`, `end`) VALUES
(4, 1, 0, 'test Ho perso il conto', 'non si vede niente', 'terrazzo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 0, 'Testing', 'w', 'dd', '2026-05-10 19:23:00', '0000-00-00 00:00:00'),
(6, 1, 0, 'gatto', '', 'dnskn', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 0, 'Test Ven', '', 'dasd', '2026-05-22 19:29:00', '0000-00-00 00:00:00'),
(8, 1, 0, 'sd', '', 'sd', '2026-05-07 20:31:00', '0000-00-00 00:00:00'),
(9, 1, 0, 'sd', '', 'sd', '2026-05-07 20:31:00', '0000-00-00 00:00:00'),
(10, 1, 0, 'sd', '', 'sd', '2026-05-07 20:31:00', '2026-05-07 22:06:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `proposals`
--

CREATE TABLE `proposals` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `idRoutine` int(11) NOT NULL DEFAULT 0,
  `idState` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `routines`
--

CREATE TABLE `routines` (
  `id` int(11) NOT NULL,
  `idOwner` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) DEFAULT NULL,
  `descriz` varchar(100) DEFAULT NULL,
  `idTag` int(11) NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `desciz` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `state`
--

INSERT INTO `state` (`id`, `desciz`) VALUES
(1, 'Attivo'),
(2, 'Disattivo');

-- --------------------------------------------------------

--
-- Struttura della tabella `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `descriz` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `psw` varchar(100) DEFAULT NULL,
  `idState` int(11) NOT NULL DEFAULT 1,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `email`, `psw`, `idState`, `name`, `surname`) VALUES
(1, 'prova1@gmail.com', '123', 1, 'prova', 'provetta'),
(2, 'prova2@gmail.com', '234', 1, 'prova22', 'pp');

-- --------------------------------------------------------

--
-- Struttura della tabella `usr-routines`
--

CREATE TABLE `usr-routines` (
  `id` int(11) NOT NULL,
  `idUsr` int(11) DEFAULT NULL,
  `idRoutine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `routines`
--
ALTER TABLE `routines`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `usr-routines`
--
ALTER TABLE `usr-routines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `routines`
--
ALTER TABLE `routines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `usr-routines`
--
ALTER TABLE `usr-routines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
