-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 09:07 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gielda`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `booklist`
--

CREATE TABLE `booklist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` tinytext NOT NULL,
  `class` tinyint(1) NOT NULL,
  `authors` text NOT NULL,
  `publisher` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booklist`
--

INSERT INTO `booklist` (`id`, `name`, `subject`, `class`, `authors`, `publisher`) VALUES
(1, 'Ponad słowami 1 Część 1', 'Język polski', 1, 'Małgorzata Chmiel, Anna\r\nCisowska, Joanna Kościerzyńska\r\nHelena Kusy, Aleksandra\r\nWróblewska', 'Nowa Era'),
(2, 'Ponad słowami 1\r\nCzęść 2', 'Język polski', 1, 'Małgorzata Chmiel, Anna\r\nCisowska, Joanna Kościerzyńska\r\nHelena Kusy, Aleksandra\r\nWróblewska\r\n', 'Nowa Era'),
(3, 'Ponad słowami 1 Część 2', 'Język polski', 2, 'Małgorzata Chmiel, Anna Cisowska,\r\nJoanna Kościerzyńska, Helena Kusy,\r\nAleksandra Wróblewska', 'Nowa Era'),
(4, 'Ponad słowami 3\r\nCzęść 1', 'Język polski', 4, 'Joanna Kościerzyńska, Anna Cisowska,\r\nAleksandra Wróblewska, Małgorzata Matecka,\r\nAnna Równy, Joanna Ginter', 'Nowa Era'),
(5, 'Historia 4\r\nPoznać przeszłość\r\nPodręcznik do liceum i\r\ntechnikum – zakres\r\npodstawowy', 'Historia', 4, 'J. Kłaczkow, S. Roszak ', 'Nowa Era'),
(6, 'Historia 2 – Ślady czasu\r\nPodręcznik do liceum i\r\ntechnikum 1492-1815', 'Historia', 2, 'Łukasz Kępski, Jacek Wijaczka ', 'GWO'),
(7, 'Biologia na czasie 1', 'Biologia', 1, 'Anna Helmin, Jolanta\r\nHoleczek\r\n', 'Nowa Era');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `user-uuid` tinytext NOT NULL COMMENT 'informacje o sprzedawcy bierze z tabeli user',
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '{"productid": "self-defined": false, "price": 0, "quality": "", "note": ""}',
  `offer-cdate` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'czas utworzenia oferty',
  `offer-edate` datetime NOT NULL COMMENT 'czas wygasniecia oferty po uplywie czasu zdefiniowanego przez sprzedawce lub defaultowo przez server w ciagu 14dni, inaczej data kiedy oferta zostanie zdjeta',
  `status` tinyint(4) NOT NULL COMMENT 'Status oferty',
  `phone` int(9) DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `discord` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `user-uuid`, `products`, `offer-cdate`, `offer-edate`, `status`, `phone`, `email`, `discord`) VALUES
(1, 'tester#aA1', '[1,7]', '2024-03-07 13:40:30', '2024-03-07 13:38:54', 2, 123456789, NULL, 'tester');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `uuid` varchar(34) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `user-offers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '\'[]\'' COMMENT 'oferty uzytkownika przechowywane w liscie\r\nprzyklad: [ID offerty, ID]',
  `phone` int(9) DEFAULT NULL COMMENT 'dane kontaktowe - nr tel',
  `email` varchar(320) NOT NULL,
  `discord` tinytext DEFAULT NULL,
  `last-login` datetime NOT NULL DEFAULT current_timestamp(),
  `email-flag` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uuid`, `username`, `password`, `user-offers`, `phone`, `email`, `discord`, `last-login`, `email-flag`, `admin`) VALUES
('tester#aA1', 'tester', 'tete', '\'[]\'', 123456789, 'example@example.com', NULL, '2024-03-11 14:45:55', 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `booklist`
--
ALTER TABLE `booklist`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booklist`
--
ALTER TABLE `booklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
