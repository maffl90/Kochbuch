-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Feb 2018 um 16:01
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `kochbuch`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `BenutzerID` int(11) NOT NULL,
  `BenutzerName` varchar(50) COLLATE utf8_bin NOT NULL,
  `Passwort` varchar(25) COLLATE utf8_bin NOT NULL,
  `Email` varchar(50) COLLATE utf8_bin NOT NULL,
  `Newsletter` tinyint(1) NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  `aktiv` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`BenutzerID`, `BenutzerName`, `Passwort`, `Email`, `Newsletter`, `Admin`, `aktiv`) VALUES
(1, 'Admin', 'admin', 'test@test.at', 0, 1, 1),
(3, 'Marvin', '1234567890', 'marvin@bischof.at', 0, 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rezepte`
--

CREATE TABLE `rezepte` (
  `RezeptID` int(11) NOT NULL,
  `BenutzerID` int(11) DEFAULT NULL,
  `RezeptName` varchar(75) CHARACTER SET utf8 COLLATE utf8_german2_ci NOT NULL,
  `Kategorie` varchar(25) COLLATE utf8_bin NOT NULL,
  `Dauer` int(11) NOT NULL,
  `Schwierigkeit` int(11) NOT NULL,
  `freigeschaltet` tinyint(1) NOT NULL,
  `deaktiviert` tinyint(1) NOT NULL,
  `Datum` date DEFAULT NULL,
  `BenutzerName` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `rezepte`
--

INSERT INTO `rezepte` (`RezeptID`, `BenutzerID`, `RezeptName`, `Kategorie`, `Dauer`, `Schwierigkeit`, `freigeschaltet`, `deaktiviert`, `Datum`, `BenutzerName`) VALUES
(1, 2, 'Geröstete Kartoffel', 'Beilage', 40, 2, 1, 0, '2018-02-01', 'Marvin'),
(2, 2, 'Kürbiscremesuppe', 'Vorspeise', 30, 3, 1, 0, '2018-02-07', 'Marvin'),
(5, 1, 'Nudel', 'Beilage', 15, 1, 0, 0, '2018-02-17', 'Admin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schritte`
--

CREATE TABLE `schritte` (
  `SchrittID` int(11) NOT NULL,
  `RezeptID` int(11) NOT NULL,
  `Schritt` varchar(1000) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `schritte`
--

INSERT INTO `schritte` (`SchrittID`, `RezeptID`, `Schritt`) VALUES
(3, 5, 'Wasser zum kochen bringen und salzen.\r\nNudel in kochendes Wasser geben und 12 Minuten kochen lassen.\r\nAbseihen und abschwÃ¤mmen.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zutaten`
--

CREATE TABLE `zutaten` (
  `ZutatID` int(11) NOT NULL,
  `RezeptID` int(11) NOT NULL,
  `ZutatName` varchar(750) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `zutaten`
--

INSERT INTO `zutaten` (`ZutatID`, `RezeptID`, `ZutatName`) VALUES
(3, 5, '1000 ml Wasser<br/>500 g Nudel');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`BenutzerID`);

--
-- Indizes für die Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  ADD PRIMARY KEY (`RezeptID`);

--
-- Indizes für die Tabelle `schritte`
--
ALTER TABLE `schritte`
  ADD PRIMARY KEY (`SchrittID`);

--
-- Indizes für die Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  ADD PRIMARY KEY (`ZutatID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `BenutzerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  MODIFY `RezeptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `schritte`
--
ALTER TABLE `schritte`
  MODIFY `SchrittID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  MODIFY `ZutatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
