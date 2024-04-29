-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Kwi 2024, 16:09
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `gielda`
--
CREATE DATABASE IF NOT EXISTS `gielda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gielda`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `booklist`
--

DROP TABLE IF EXISTS `booklist`;
CREATE TABLE `booklist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` tinytext NOT NULL,
  `class` tinyint(1) NOT NULL,
  `authors` text NOT NULL,
  `publisher` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user-uid` mediumint(8) UNSIGNED NOT NULL,
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

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer-id` bigint(20) UNSIGNED NOT NULL,
  `name` tinytext NOT NULL,
  `author` text NOT NULL,
  `publisher` tinytext NOT NULL,
  `subject` tinytext DEFAULT NULL,
  `class` smallint(6) DEFAULT NULL,
  `price` decimal(5,2) NOT NULL,
  `quality` tinytext NOT NULL,
  `note` tinytext DEFAULT NULL,
  `img` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `custom` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reset-tokens`
--

DROP TABLE IF EXISTS `reset-tokens`;
CREATE TABLE `reset-tokens` (
  `email` text NOT NULL,
  `token` tinytext NOT NULL,
  `timeout` datetime NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` mediumint(8) UNSIGNED NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `phone` int(9) DEFAULT NULL COMMENT 'dane kontaktowe - nr tel',
  `discord` tinytext DEFAULT NULL,
  `last-login` datetime NOT NULL DEFAULT current_timestamp(),
  `email-flag` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `verify`
--

DROP TABLE IF EXISTS `verify`;
CREATE TABLE `verify` (
  `email` text NOT NULL,
  `token` tinytext NOT NULL,
  `timeout` datetime NOT NULL DEFAULT current_timestamp(),
  `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user-uuid` (`user-uid`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `offer-id` (`offer-id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `booklist`
--
ALTER TABLE `booklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `uid` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`user-uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`offer-id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
