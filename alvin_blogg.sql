-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 22 maj 2021 kl 12:09
-- Serverversion: 10.4.19-MariaDB
-- PHP-version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `alvins_blogg`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `User` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `Titel` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `Text` varchar(500) COLLATE utf8_swedish_ci NOT NULL,
  `ID` int(100) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`User`, `Titel`, `Text`, `ID`) VALUES
('putte', 'Skriva inlägg', 'Hacker man Alvin har fixat så att man kan skriva inlägg.', 7),
('putte', 'baller', 'baller', 8);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `Username` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `Email` varchar(150) COLLATE utf8_swedish_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `Status` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`Username`, `Email`, `Password`, `Status`) VALUES
('Avve', 'hqwe@xn--brdfritt-o4a.com', '$2y$10$EpW5JBXVd0aULyYzT58F.uwzAHDbYRKH9Mh637zLIcWDRUzSrPLwK', 1),
('ba', 'ba@ba.com', '$2y$10$ZHwfyKGpcOr8gimUxVJLAeF46DJL5X7yKg0HB3bOAsNF5Mp3LIqYO', 1),
('putte', 'ba@ba.ba', '$2y$10$l0oL7qnq0Xbohqx4CRjmYO906J3X4LMdlL0NYu6vUWLJZyNT0CMgu', 2);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `User` (`User`);
ALTER TABLE `posts` ADD FULLTEXT KEY `User_2` (`User`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `Password` (`Password`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`User`) REFERENCES `users` (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
