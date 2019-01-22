-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 15 Oca 2019, 07:23:50
-- Sunucu sürümü: 5.7.23
-- PHP Sürümü: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `bitirme`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `balance_log`
--

DROP TABLE IF EXISTS `balance_log`;
CREATE TABLE IF NOT EXISTS `balance_log` (
  `dealer_id` int(11) NOT NULL,
  `daily_balance` float NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_turkish_ci;

--
-- Tablo döküm verisi `balance_log`
--

INSERT INTO `balance_log` (`dealer_id`, `daily_balance`, `Date`, `Time`) VALUES
(3, 800, '2018-12-30', '00:00:00'),
(6, 20516, '2018-12-30', '00:00:00'),
(4, 123, '2018-12-30', '00:00:00'),
(1, 159753, '2018-12-30', '00:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dealerprices`
--

DROP TABLE IF EXISTS `dealerprices`;
CREATE TABLE IF NOT EXISTS `dealerprices` (
  `dealer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`dealer_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_turkish_ci;

--
-- Tablo döküm verisi `dealerprices`
--

INSERT INTO `dealerprices` (`dealer_id`, `product_id`, `price`) VALUES
(6, 1, 0.15),
(6, 2, 0.8),
(6, 3, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dealers`
--

DROP TABLE IF EXISTS `dealers`;
CREATE TABLE IF NOT EXISTS `dealers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf16 COLLATE utf16_turkish_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf16 COLLATE utf16_turkish_ci NOT NULL,
  `balance` float NOT NULL,
  `route` varchar(20) COLLATE utf32_turkish_ci NOT NULL,
  `taxnumber` varchar(100) COLLATE utf32_turkish_ci NOT NULL,
  `authorizedPerson` varchar(40) COLLATE utf32_turkish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `phone_num` varchar(15) COLLATE utf32_turkish_ci NOT NULL,
  `tax_address` varchar(80) COLLATE utf32_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf32 COLLATE=utf32_turkish_ci;

--
-- Tablo döküm verisi `dealers`
--

INSERT INTO `dealers` (`id`, `name`, `address`, `balance`, `route`, `taxnumber`, `authorizedPerson`, `status`, `phone_num`, `tax_address`) VALUES
(1, 'test', '', 0, 'Güzergah 2', '', '', 0, '', ''),
(2, 'test2', '', 1000, 'Güzergah 1', '', '', 0, '', ''),
(3, 'Eren ', 'Subayevleri', 20, 'Güzergah 1', '0', 'Kemal', 0, '05370542149', 'sincan'),
(4, 'Kardelen Büfe', 'eryaman', 20, 'Güzergah 2', '3', 'Kadir', 0, '05550207649', 'etimesgut'),
(6, 'Cavus', 'aktepe', 0, 'Güzergah 1', '0', 'Hilal', 1, '05331378748', 'çankaya');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf32_turkish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf32 COLLATE=utf32_turkish_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `name`, `status`) VALUES
(1, 'Ekmek', 1),
(2, 'Poğaça', 1),
(3, 'Sandiviç', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf32_turkish_ci NOT NULL,
  `driver` varchar(30) COLLATE utf32_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf32 COLLATE=utf32_turkish_ci;

--
-- Tablo döküm verisi `routes`
--

INSERT INTO `routes` (`id`, `name`, `driver`) VALUES
(2, 'Güzergah 2', 'h4'),
(3, 'Güzergah 1', 'serkan1'),
(4, 'Güzergah 3', 'Mehmet');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tradelogs`
--

DROP TABLE IF EXISTS `tradelogs`;
CREATE TABLE IF NOT EXISTS `tradelogs` (
  `dealer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `cost` float NOT NULL,
  `tour_no` int(11) NOT NULL,
  `numberofcase` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `type` varchar(10) COLLATE utf32_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_turkish_ci;

--
-- Tablo döküm verisi `tradelogs`
--

INSERT INTO `tradelogs` (`dealer_id`, `product_id`, `amount`, `cost`, `tour_no`, `numberofcase`, `time`, `date`, `type`) VALUES
(6, 1, 50, 250, 1, 14, '00:00:00', '2018-12-30', 'insert'),
(6, 2, 10, 360, 14, 12, '00:00:00', '2018-12-30', 'insert'),
(6, 3, 15, 14, 3, 2, '00:00:00', '2018-12-30', 'insert'),
(6, 3, 21, 123, 3, 12, '00:00:00', '2018-12-30', 'insert'),
(6, 1, 45, 250, 3, 2, '00:00:00', '2018-12-30', 'insert'),
(6, 1, 20, 120, 1, 2, '00:00:00', '2019-01-04', 'insert'),
(6, 2, 7, 15, 1, 1, '00:00:02', '2019-01-04', 'insert'),
(6, 3, 15, 250, 2, 1, '00:00:00', '2019-01-04', 'insert'),
(6, 2, 19, 258, 3, 2, '00:00:00', '2019-01-04', 'insert');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf32_turkish_ci NOT NULL,
  `username` varchar(30) COLLATE utf32_turkish_ci NOT NULL,
  `password` varchar(30) COLLATE utf32_turkish_ci NOT NULL,
  `privilage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf32 COLLATE=utf32_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `privilage`) VALUES
(1, 'Dilara', 'admin', 'admin', 1),
(2, 'mahmut', 'asd', '12345', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
