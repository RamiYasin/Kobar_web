-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Dec 2020 um 14:05
-- Server-Version: 10.4.11-MariaDB

-- PHP-Version: 7.4.2

-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8mb4 */;

--
--


CREATE DATABASE IF NOT EXISTS `kobarweb`
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

USE kobarweb;


SET NAMES utf8mb4;

-- ----------------------------------------------------------------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `article`
--

CREATE TABLE `admin`(
                        `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
                        `pass` varchar(254) COLLATE utf8_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ordering`
--

CREATE TABLE `news` (
                            `new_id` int(11) NOT NULL,
                            `new_Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                            `new_dis` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
                            `new_img` VARBINARY(100)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- --------------------------------------------------------
ALTER TABLE `news`
    ADD PRIMARY KEY (`new_id`);
ALTER TABLE `news`
    MODIFY `new_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;
--
-- Indizes für die Tabelle `ordered_articles`
--


--
-- AUTO_INCREMENT für Tabelle `article`
--


--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `ordered_articles`
--


-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
