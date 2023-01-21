-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 19 jan 2023 om 22:17
-- Serverversie: 10.9.4-MariaDB-1:10.9.4+maria~ubu2204
-- PHP-versie: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+01:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librarydb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bookReservations`
--

CREATE TABLE `bookReservations` (
  `id` int(11) NOT NULL,
  `bookId` varchar(12) NOT NULL,
  `bookThumbnail` varchar(255) NOT NULL,
  `bookTitle` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `lendingDate` date NOT NULL DEFAULT current_timestamp(),
  `bookStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bookReservations`
--

INSERT INTO `bookReservations` (`id`, `bookId`, `bookThumbnail`, `bookTitle`, `userId`, `lendingDate`, `bookStatus`) VALUES
(1, 'luPvDAAAQBAJ', 'http://books.google.com/books/content?id=luPvDAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'De Da Vinci code', 2, '2023-01-19', 2),
(2, '4ro-EAAAQBAJ', 'http://books.google.com/books/content?id=4ro-EAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'Beginning Programming with Java For Dummies', 2, '2023-01-19', 1),
(3, 'xwu4DgAAQBAJ', 'http://books.google.com/books/content?id=xwu4DgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'Coding All-in-One For Dummies', 2, '2023-01-19', 0),
(4, 'yjmLuH_xyIoC', 'http://books.google.com/books/content?id=yjmLuH_xyIoC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'Rookie Teaching For Dummies', 2, '2023-01-19', 2),
(5, 'NBYtEAAAQBAJ', 'http://books.google.com/books/content?id=NBYtEAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 'PHP and MySQL For Dummies', 2, '2023-01-19', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hashedPassword` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `hashedPassword`, `isAdmin`) VALUES
(1, 'sempl', '$2y$10$6fIx/nTXs36KI4djRyU0e.lozFxpBE0Lyv3o8lnba.OteOGDigA0G', 1),
(2, 'mark', '$2y$10$4iNaQNQcxKclniUNNOxAnu1PxlTipKzIFlq7eQ2PRN/Pw1ktdnYXu', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bookReservations`
--
ALTER TABLE `bookReservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bookReservations`
--
ALTER TABLE `bookReservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
