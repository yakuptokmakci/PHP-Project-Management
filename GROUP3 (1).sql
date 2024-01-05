-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 05 Oca 2024, 17:11:26
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `GROUP3`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `operations`
--

CREATE TABLE `operations` (
  `operation_id` int(11) NOT NULL,
  `operation_name` varchar(50) DEFAULT NULL,
  `operation_owner` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `operations`
--

INSERT INTO `operations` (`operation_id`, `operation_name`, `operation_owner`, `address`) VALUES
(1, 'emlak bankası', 1, NULL),
(6, '1', 1, 'NULL'),
(7, 'huzur evi projesi2', 1, 'köyiçi bağdatlı'),
(8, 'Ankara İnşaat projesi', 4, 'ankara anıtkabir'),
(9, 'istanbul metro projesi', 4, 'kayışdağ fındıklı çağrı market'),
(10, 'istanbul aydınevler metro', 3, 'istanbul'),
(11, 'ankara okul projesi', 4, 'ankara atatürk ilköğretim');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `operation_products`
--

CREATE TABLE `operation_products` (
  `operation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `operation_products`
--

INSERT INTO `operation_products` (`operation_id`, `product_id`) VALUES
(8, 2),
(8, 7),
(8, 11),
(9, 2),
(9, 7),
(9, 11),
(10, 2),
(11, 12),
(11, 13);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `operation_projects`
--

CREATE TABLE `operation_projects` (
  `operation_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `operation_projects`
--

INSERT INTO `operation_projects` (`operation_id`, `project_id`) VALUES
(8, 6),
(8, 8),
(9, 7),
(10, 5),
(11, 9);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `product_owner_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `amount`, `product_owner_id`, `address`) VALUES
(2, 'kazma kürek kiti', 31, 3, 'Bahçelievler Merkez, Bağcılar Cd. No:2, 34160 Güngören/İstanbul'),
(6, 'pc', 6, 1, 'köyiçi bağdatlı'),
(7, 'balta', 18, 1, 'darülacize'),
(10, 'balta', 1, 4, 'ankara konya yolu'),
(11, 'jcb marka ekskavatör', 1, 4, 'ankara aydınevler mah'),
(12, 'monitör', 24, 4, 'ankara atatürk ilköğretim'),
(13, 'klavye ', 24, 4, 'ankara atatürk ilköğretim');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(50) DEFAULT NULL,
  `project_creater_id` int(11) DEFAULT NULL,
  `project_start_date` date DEFAULT NULL,
  `project_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_creater_id`, `project_start_date`, `project_end_date`) VALUES
(1, 'toki', 1, '2023-12-27', '2024-01-07'),
(2, 'webdevelopment', 2, '2023-12-14', '0000-00-00'),
(3, 'ankara aydınevler metro', 1, '2023-12-28', '2024-01-07'),
(5, 'TeoTestis', 3, '2023-12-29', '2024-05-11'),
(6, 'ankra devlet hastahanesi', 4, '2024-01-05', '2024-01-17'),
(7, 'kayışdağ metro', 4, '2024-01-05', '2025-01-02'),
(8, 'ankra devlet tiyatrosu', 4, '2024-01-16', '2024-03-21'),
(9, 'okul bilgisayar odası', 4, '2024-01-12', '2024-02-09');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password_hash`) VALUES
(1, 'Yakup Tokmakci', 'yakuptokmakci71@gmail.com', '$2y$10$cLyY/HLBwzdubRyrf4eBn./ngv7kO0SAF3wznNSMdaB/1j6fhF1.q'),
(2, 'ozan', 'ozang@gmail.com', '$2y$10$xMlkJ0RvAEbEWWIv6BvqW.jLy8OsM9Gq/6zm08gbQcFrklYjzQwkC'),
(3, 'teoman', 'teoman@teoman.com', '$2y$10$7y0O/3WOqjzaOpUShPkvd.nDx9k.BTeGnGd91PTbPNtXgYnHhV.1u'),
(4, 'test hesabi', 'test@gmail.com', '$2y$10$KN63DqCJQZyZpbs4qqLP6eklbHAE0b88l1j0wXfs2qX3u4G4wQ8SK');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`operation_id`),
  ADD KEY `operation_owner` (`operation_owner`);

--
-- Tablo için indeksler `operation_products`
--
ALTER TABLE `operation_products`
  ADD PRIMARY KEY (`operation_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Tablo için indeksler `operation_projects`
--
ALTER TABLE `operation_projects`
  ADD PRIMARY KEY (`operation_id`,`project_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_owner_id` (`product_owner_id`);

--
-- Tablo için indeksler `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `project_creater_id` (`project_creater_id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `operations`
--
ALTER TABLE `operations`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_ibfk_1` FOREIGN KEY (`operation_owner`) REFERENCES `user` (`id`);

--
-- Tablo kısıtlamaları `operation_products`
--
ALTER TABLE `operation_products`
  ADD CONSTRAINT `operation_products_ibfk_1` FOREIGN KEY (`operation_id`) REFERENCES `operations` (`operation_id`),
  ADD CONSTRAINT `operation_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Tablo kısıtlamaları `operation_projects`
--
ALTER TABLE `operation_projects`
  ADD CONSTRAINT `operation_projects_ibfk_1` FOREIGN KEY (`operation_id`) REFERENCES `operations` (`operation_id`),
  ADD CONSTRAINT `operation_projects_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Tablo kısıtlamaları `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_owner_id`) REFERENCES `user` (`id`);

--
-- Tablo kısıtlamaları `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`project_creater_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
