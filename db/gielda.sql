-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2024 at 11:53 AM
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
(1, 'Ponad Słowami 1 Część 1', 'język polski', 1, 'Małgorzata Chmiel,Anna Cisowska,Joanna Kościerzyńska,Helena Kusy,Aleksandra Wróblewska', 'Nowa Era'),
(2, 'Ponad Słowami 1 Część 2', 'język polski', 1, 'Małgorzata Chmiel,Anna Cisowska,Joanna Kościerzyńska,Helena Kusy,Aleksandra Wróblewska', 'Nowa Era'),
(3, 'Checkpoint A2+/B1', 'język angielski podstawowy', 1, 'David Spencer, Monika Cichmińska, Lynda Edwards', 'Macmillan'),
(4, 'Pioneer Plus. Level B1+ Students Book', 'język angielski rozszerzony', 1, 'H.G. Mitchell, Marileni Malkogianni', 'MM Publications'),
(5, 'Perfekt 1', 'język niemiecki', 1, 'Beata Jaroszewicz, Jan Szurmant, Anna Wojdat-Niklewska', 'Pearson'),
(6, 'Perfekt 1 Zeszyt Ćwiczeń', 'język niemiecki', 1, 'Piotr Dudek, Danuta Kin, Monika Ostrowska-Polak', 'Pearson'),
(7, 'Spotkania z filozofią', 'filozofia', 1, 'Monika Bokiniec, Sylwester Zielka', 'Nowa Era'),
(8, 'Historia 1 - Ślady czasu Starożytność i Średniowiecze', 'historia', 1, 'Łukasz Kępski, Jakub Kufel, Przemysław Ruchlewski', 'GWO'),
(9, 'Historia i Teraźniejszość 1 Zakres Podstawowy', 'historia', 1, 'Izabella Modzelewska-Rysak, Leszek Rysak, Adam Cisek, Karol Wilczyński', 'Wydawnictwa Szkolne i Pedagogiczne'),
(10, 'Biologia na czasie 1', 'biologia', 1, 'Anna Helmin, Jolanta Holeczek', 'Nowa Era'),
(11, 'Biologia na czasie 2', 'biologia', 1, 'Anna Helmin, Jolanta Holeczek', 'Nowa Era'),
(12, 'To jest chemia 1 Zakres Podstawowy', 'chemia', 1, 'Romuald Hassa, Aleksandra Mrzigod, Janusz Mrzigod', 'Nowa Era'),
(13, 'MATeMAtyka 1 Zakres Podstawowy', 'matematyka', 1, 'W. Babiański, L. Chańko, K. Wej', 'Nowa Era'),
(14, 'MATeMAtyka 1 Zakres Rozszerzony', 'matematyka', 1, 'W. Babiański, L. Chańko, K. Wej', 'Nowa Era'),
(15, 'MATeMAtyka 1 Maturalne karty pracy Zakres Podstawowy', 'matematyka', 1, 'Dorota Ponczek, Karolina Wej', 'Nowa Era'),
(16, 'MATeMAtyka 1 Maturalne karty pracy Zakres Rozszerzony', 'matematyka', 1, 'Dorota Ponczek, Karolina Wej', 'Nowa Era'),
(17, 'Informatyka na czasie 1 Zakres Podstawowy', 'informatyka', 1, 'Janusz Mazur, Paweł Perekietka, Zbigniew Talaga, Janusz S. Wierzbick', 'Nowa Era'),
(18, 'Edukacja dla bezpieczeństwa', 'edukacja dla bezpieczeństwa', 1, 'Bogusław Breitkopf, Mariusz Cieśla', 'WSiP Nowa Edycja'),
(19, 'Krok w biznes i zarządzanie Część 1 Zakres Podstawowy', 'biznes i zarządzanie', 1, 'Zbigniew Makieła, Tomasz Rachwał', 'Nowa Era'),
(20, 'Krok w biznes i zarządzanie Część 1 ćwiczenia', 'biznes i zarządzanie', 1, 'Zbigniew Makieła, Tomasz Rachwał', 'Nowa Era'),
(21, 'Ponad Słowami 1 Część 2', 'język polski', 2, 'Małgorzata Chmiel,Anna Cisowska,Joanna Kościerzyńska,Helena Kusy,Aleksandra Wróblewska', 'Nowa Era'),
(22, 'Ponad Słowami 2 Część 1', 'język polski', 2, 'Małgorzata Chmiel,Anna Cisowska,Joanna Kościerzyńska,Helena Kusy,Aleksandra Wróblewska', 'Nowa Era'),
(23, 'Checkpoint A2+/B1', 'język angielski podstawowy', 2, 'David Spencer, Monika Cichmińska, Lynda Edwards', 'Macmillan'),
(24, 'Checkpoint A2+/B1 Ćwiczenia', 'język angielski podstawowy', 2, 'David Spencer, Monika Cichmińska, Lynda Edwards', 'Macmillan'),
(25, 'Pioneer Plus. Level B1+ Students Book', 'język angielski rozszerzony', 2, 'H.G. Mitchell, Marileni Malkogianni', 'MM Publications'),
(26, 'Perfekt 2', 'język niemiecki', 2, 'Beata Jaroszewicz, Jan Szurmant, Anna Wojdat-Niklewska', 'Pearson'),
(27, 'Perfekt 2 Ćwiczenia', 'język niemiecki', 2, 'Piotr Dudek, Danuta Kin, Monika Ostrowska-Polak', 'Pearson'),
(28, 'Historia 2 - Ślady czasu', 'historia', 2, 'Łukasz Kępski, Jacek Wijaczka', 'GWO'),
(29, 'HiT 2 Poziom Podstawowy', 'historia', 2, 'I. Modzelewska Rysak, K. Wilczyński, A. Cisek, M. Buczyński, T. Grochowski, W. Pelczar', 'WSiP'),
(30, 'Oblicza geografii 1 Zakres Podstawowy', 'geografia', 2, 'Roman Malarz, Marek Więckowski', 'Nowa Era'),
(31, 'Biologia na czasie 2', 'biologia', 2, 'Anna Helmin, Jolanta Holeczek', 'Nowa Era'),
(32, 'Biologia na czasie 3', 'biologia', 2, 'Anna Helmin, Jolanta Holeczek', 'Nowa Era'),
(33, 'To jest chemia 2 Zakres Podstawowy', 'chemia', 2, 'Romuald Hassa, Aleksandra Mrzigod, Janusz Mrzigog', 'Nowa Era'),
(34, 'MATeMAtyka 1 Zakres Podstawowy', 'matematyka', 2, 'Wojciech Babiański, Lech Chańko, Karolina Wej', 'Nowa Era'),
(35, 'MATeMAtyka 2 Zakres Podstawowy', 'matematyka', 2, 'Wojciech Babiański, Lech Chańko, Joanna Czarnowska, Grzegorz Janocha, Dorota Ponczek', 'Nowa Era'),
(36, 'MATeMAtyka 1 Karty pracy Zakres Podstawowy', 'matematyka', 2, 'Dorota Ponczek, Karolina Wej', 'Nowa Era'),
(37, 'MATeMAtyka 2 Karty pracy Zakres Podstawowy', 'matematyka', 2, 'Dorota Ponczek, Karolina Wej', 'Nowa Era'),
(38, 'Informatyka na czasie 2 Zakres Podstawowy', 'informatyka', 2, 'Janusz Mazur, Paweł Perekietka, Zbigniew Talaga, Janusz S. Wierzbicki', 'Nowa Era'),
(39, 'Informatyka na czasie 1 Zakres Rozszerzony', 'informatyka', 2, 'Zbigniew Talaga, Janusz Mazur, Janusz Wierzbicki, Paweł Perekietka', 'Nowa Era'),
(40, 'Krok w przedsiębiorczość', 'podstawy przedsiębiorzczośći', 2, 'Zbigniew Makieła, Tomasz Rachwał', 'Nowa Era'),
(41, 'Ponad Słowami 3 Część 2', 'język polski', 5, 'Joanna Kościerzyńska, Anna Cisowska, Małgorzata Matecka, Aleksandra Wróblewska, Joanna Ginter, Anna Równy', 'Nowa Era'),
(42, 'Ponad Słowami 4', 'język polski', 5, 'Joanna Kościerzyńska, Aleksandra Wróblewska, Małgorzata Matecka, Anna Cisowska, Joanna Baczyńska-Wybrańska, Joanna Ginter', 'Nowa Era'),
(43, 'REPETYTORIUM Poziom Podstawowy', 'język angielski podstawowy', 5, 'M. Rosińska, L. Edwards', 'Macmillan Education'),
(44, 'REPETYTORIUM Poziom Rozszerzony', 'język angielski rozszerzony', 5, 'M. Rosińska, L. Edward', 'Macmillan Education'),
(45, 'Perfekt 4', 'język niemiecki', 5, 'Beata Jaroszewicz, Jan Szurmant, Anna Wojdat-Niklewska', 'Pearson'),
(46, 'MATeMAtyka 4 Zakres Podstawowy', 'matematyka', 5, 'Wojciech Babiański, Lech Chańko, Joanna Czarnowska, Jolanta Wesołowska', 'Nowa Era'),
(47, 'MATeMAtyka 4 Zakres Podstawowy Karty Pracy', 'matematyka', 5, 'Dorota Ponczek, Karolina Wej', 'Nowa Era'),
(48, 'Historia 4 Zakres Podstawowy', 'historia', 5, 'J. Kłaczkow, S. Roszak', 'Nowa Era'),
(49, 'Wiedza o społeczeństwie 1 Zakres Podstawowy', 'wiedza o społeczeństwie', 5, 'Zbigniew Smutek, Beata Surmacz, Jan Maleska', 'OPERON');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user-uuid` varchar(34) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
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

INSERT INTO `offers` (`id`, `user-uuid`, `offer-cdate`, `offer-edate`, `status`, `phone`, `email`, `discord`) VALUES
(7, 'tetester#je3', '2024-03-22 10:11:59', '2024-04-01 10:11:59', 0, 0, '', 'Yippe'),
(8, 'tetester#je3', '2024-03-22 10:48:31', '2024-03-27 10:48:31', 0, 607419261, '', 'MangoBanana'),
(9, 'admin#11d', '2024-03-22 12:59:48', '2024-03-30 14:59:48', 0, 111333777, '', 'Marcin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer-id` bigint(20) UNSIGNED NOT NULL,
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

INSERT INTO `products` (`id`, `offer-id`, `name`, `author`, `publisher`, `subject`, `class`, `price`, `quality`, `note`, `img`, `custom`) VALUES
(3, 7, 'MATeMAtyka 1 Zakres Rozszerzony', 'W. Babiański, L. Chańko, K. Wej', 'Nowa Era', 'matematyka', 1, 12.00, '1', 'Książka ma wiele notacji wewnątrz.. oraz na zewnątrz, wiele obliczeń na stronach', '', 0),
(4, 8, 'Informatyka na czasie 1 Zakres Rozszerzony', 'Zbigniew Talaga, Janusz Mazur, Janusz Wierzbicki, Paweł Perekietka', 'Nowa Era', 'informatyka', 2, 20.00, '0', '', '', 0),
(5, 8, 'Informatyka na czasie 2 Zakres Podstawowy', 'Janusz Mazur, Paweł Perekietka, Zbigniew Talaga, Janusz S. Wierzbicki', 'Nowa Era', 'informatyka', 2, 30.00, '0', 'Stan książki - praktycznie jak nowa', '', 0),
(6, 9, 'Biologia na czasie 1', 'Anna Helmin, Jolanta Holeczek', 'Nowa Era', 'biologia', 1, 20.00, '2', 'Jest jeszcze w folii', '', 0),
(7, 9, 'MATeMAtyka 1 Maturalne karty pracy Zakres Rozszerzony', 'Dorota Ponczek, Karolina Wej', 'Nowa Era', 'matematyka', 1, 10.00, '0', 'Książka ma wiele notacji wewnątrz.. oraz na zewnątrz, wiele obliczeń na stronach', '', 0),
(8, 9, 'Edukacja dla bezpieczeństwa', 'Bogusław Breitkopf, Mariusz Cieśla', 'WSiP Nowa Edycja', 'edukacja dla bezpieczeństwa', 1, 14.00, '1', '', '', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `uuid` varchar(34) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `phone` int(9) DEFAULT NULL,
  `email` varchar(320) NOT NULL,
  `discord` tinytext DEFAULT NULL,
  `last-login` datetime NOT NULL DEFAULT current_timestamp(),
  `email-flag` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uuid`, `username`, `password`, `phone`, `email`, `discord`, `last-login`, `email-flag`, `admin`) VALUES
('admin#11d', 'admin', '', NULL, '49$=6>F1%0C!:6$XP3&Y2;&,S43T`\n`\n', NULL, '2024-03-22 12:56:10', 0, 1),
('chopa#vj1', 'chopa', '', NULL, '06D=&>F,P0FM94S5J8C(P/0``\n`\n', NULL, '2024-04-03 13:41:20', 0, 1),
('etetee#Vqc', 'etetee', '', NULL, '08E=6=%I50G1:4S5T6E$]/0``\n`\n', NULL, '2024-03-20 14:50:28', 0, 0),
('ola#fhk', 'Ola', '$2y$10$1Lpi2a2zldtQoGIPkqu4U.wVJ2ld8IS/fg8HSyTWZgNoIFXW.Rfwq', NULL, '06EAD=&0R,3-11T8P3&Y\"<P``\n`\n', NULL, '2024-03-22 12:55:05', 0, 0),
('tete#WGu', 'tete', '', NULL, '09$=6,%I50C!:6%)L3&Y2;```\n`\n', NULL, '2024-03-22 12:53:19', 0, 0),
('tetester#je3', 'Tetester', '', NULL, '49#(Y:&%%0C595VAV8GDU-5E823T`\n`\n', NULL, '2024-03-22 09:52:13', 0, 0);

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
  ADD KEY `user-uuid` (`user-uuid`);

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
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booklist`
--
ALTER TABLE `booklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`user-uuid`) REFERENCES `users` (`uuid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`offer-id`) REFERENCES `offers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
