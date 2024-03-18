-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 09:44 AM
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
  `user-uuid` varchar(34) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'lista zawierajaca id produktow oferty',
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
(15, 'tester#aA1', '3', '2024-03-18 09:32:20', '2024-03-21 09:31:12', 1, NULL, NULL, 'adamre'),
(16, 'tester#aA1', '3,4', '2024-03-18 09:33:27', '2024-03-18 09:32:38', 2, 994211045, 'federowicza@teams.tlimc.szczecin.pl', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` tinytext NOT NULL,
  `author` text NOT NULL,
  `publisher` tinytext NOT NULL,
  `subject` tinytext NOT NULL,
  `class` smallint(6) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `quality` tinytext NOT NULL,
  `note` tinytext DEFAULT NULL,
  `img` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `custom` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `author`, `publisher`, `subject`, `class`, `price`, `quality`, `note`, `img`, `custom`) VALUES
(3, 'Ponad Słowami 1 Część 2', 'nie wiem, browar', 'GWO', 'Język polski', 2, 19.99, 'Używana', 'Na okładce widocznych jest widocznych kilka zgięć. Na niektórych stronach mogą być pozaznaczane długopisem informację.', '\"a2-1ab86@mnbz.jpg\"', 0),
(4, 'Biologia na czasie 1', 'Zibi', 'Nowa Era', 'Biologia', 1, 20.00, 'Nowa', '', '', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `uuid` varchar(34) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `user-offers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'lista id ofert',
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
('tester#aA1', 'itworksnoway', 'password', '1,2,5', 123456789, 'example@example.com', NULL, '2024-03-15 11:08:35', 0, 0);

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
  ADD KEY `user-uuid` (`user-uuid`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
