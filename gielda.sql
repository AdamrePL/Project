-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 10:55 AM
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
  `id` int(11) NOT NULL COMMENT 'Produkt bedzie przypisany do osoby sprzedajacej',
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `quality` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `user-uuid` int(11) NOT NULL COMMENT 'informacje o sprzedawcy bierze z tabeli user',
  `product-id` int(11) NOT NULL COMMENT 'informacje o produkcie bierze z tabeli product',
  `offer-cdate` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'czas utworzenia oferty',
  `offer-edate` datetime NOT NULL COMMENT 'czas wygasniecia oferty po uplywie czasu zdefiniowanego przez sprzedawce lub defaultowo przez server w ciagu 14dni, inaczej data kiedy oferta zostanie zdjeta',
  `status` tinyint(4) NOT NULL COMMENT 'Status oferty',
  `phone` int(9) DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `discord` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'Produkt bedzie przypisany do osoby sprzedajacej',
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `quality` tinytext NOT NULL,
  `quantity` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `uuid` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `user-offers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '\'[]\'' COMMENT 'oferty uzytkownika przechowywane w liscie\r\nprzyklad: [ID offerty, ID]',
  `phone` int(9) DEFAULT NULL COMMENT 'dane kontaktowe - nr tel',
  `email` varchar(320) NOT NULL,
  `discord` tinytext DEFAULT NULL,
  `last-login` datetime NOT NULL DEFAULT current_timestamp(),
  `email-flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uuid`, `username`, `password`, `user-offers`, `phone`, `email`, `discord`, `last-login`, `email-flag`) VALUES
('tester#aA1', 'tester', '', '\'[]\'', 123456789, 'example@example.com', NULL, '2024-03-01 09:40:19', 0);

--
-- Indeksy dla zrzutów tabel
--

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
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
