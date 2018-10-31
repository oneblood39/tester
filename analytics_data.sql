-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 28 Eki 2018, 12:14:17
-- Sunucu sürümü: 10.1.19-MariaDB
-- PHP Sürümü: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `proje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `analytics_data`
--

CREATE TABLE `analytics_data` (
  `data_id` int(5) NOT NULL,
  `profile_name` varchar(110) NOT NULL,
  `total_sessions` int(5) NOT NULL,
  `city` varchar(110) NOT NULL,
  `data_date` varchar(12) NOT NULL,
  `total_visits` int(5) NOT NULL,
  `total_pageviews` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `analytics_data`
--

INSERT INTO `analytics_data` (`data_id`, `profile_name`, `total_sessions`, `city`, `data_date`, `total_visits`, `total_pageviews`) VALUES
(3, 'Tüm Web Sitesi Verileri', 12, 'Sharjah', '2018-10-09', 12, 12),
(4, 'Tüm Web Sitesi Verileri', 11, '(not set)', '2018-10-11', 11, 11),
(5, 'Tüm Web Sitesi Verileri', 8, '(not set)', '2018-10-12', 8, 8);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `analytics_data`
--
ALTER TABLE `analytics_data`
  ADD PRIMARY KEY (`data_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `analytics_data`
--
ALTER TABLE `analytics_data`
  MODIFY `data_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
