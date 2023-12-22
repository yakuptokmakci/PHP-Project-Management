-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 Ara 2023, 17:25:12
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `group3`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `operations`
--

CREATE TABLE `operations` (
  `operation_id` int(11) NOT NULL,
  `operation_name` varchar(100) DEFAULT NULL,
  `operation_project_id` int(11) DEFAULT NULL,
  `operation_equipment_name` varchar(255) DEFAULT NULL,
  `operation_owner` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `operations`
--

INSERT INTO `operations` (`operation_id`, `operation_name`, `operation_project_id`, `operation_equipment_name`, `operation_owner`) VALUES
(2, 'ankara nur yapı', 6, 'qq', 1),
(3, 'istanbul bayrampaşa yıldırım mah', 6, '12kg yangın tüpü azotlu', 1),
(4, 'istanbul aydınevler metro', 6, 'kazma kürek kiti', 1),
(5, 'web projesi geliştirme', 8, 'pc', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`product_id`, `product_name`) VALUES
(1, 'qq'),
(2, 'balta'),
(3, '12kg yangın tüpü azotlu'),
(4, 'kazma kürek kiti'),
(5, 'pc');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(100) DEFAULT NULL,
  `project_creator_id` int(11) DEFAULT NULL,
  `project_start_date` date DEFAULT NULL,
  `project_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_creator_id`, `project_start_date`, `project_end_date`) VALUES
(1, 'aaa', 1, '2023-12-20', '2023-12-21'),
(2, 'aaa', 1, '2023-12-21', '0000-00-00'),
(3, 'deneme', 1, '2023-12-02', '2023-12-31'),
(4, '', 1, '0000-00-00', '0000-00-00'),
(5, '', 1, '0000-00-00', '0000-00-00'),
(6, 'toki', 1, '2023-12-04', '2023-12-23'),
(7, 'ankara', 1, '2023-12-21', '0000-00-00'),
(8, 'webdevelopment', 1, '2023-12-22', '2023-12-31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password_hash`) VALUES
(1, 'Yakup Tokmakci', 'yakuptokmakci71@gmail.com', '$2y$10$GrzTugnXSNApW0XyvPmiA.zlaPTxf5XdNa119uxfGl0h9bIR50GVa');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`operation_id`),
  ADD UNIQUE KEY `operation_name` (`operation_name`),
  ADD KEY `operation_project_id` (`operation_project_id`),
  ADD KEY `operation_owner` (`operation_owner`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Tablo için indeksler `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `project_creator_id` (`project_creator_id`);

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
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_ibfk_1` FOREIGN KEY (`operation_project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `operations_ibfk_2` FOREIGN KEY (`operation_owner`) REFERENCES `user` (`id`);

--
-- Tablo kısıtlamaları `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`project_creator_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
