-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 07, 2020 alle 17:44
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmo`
--
CREATE DATABASE IF NOT EXISTS `tmo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tmo`;

-- --------------------------------------------------------

--
-- Struttura della tabella `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(50) NOT NULL,
  `numeroTracce` int(11) NOT NULL,
  `id_release` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `album`
--

INSERT INTO `album` (`id`, `titolo`, `numeroTracce`, `id_release`) VALUES
(1, 'The Miracle', 5, 1),
(2, 'The Works', 3, 2),
(3, '÷', 5, 3),
(4, 'No. 6 Collaborations Project', 2, 4),
(5, 'Believe', 2, 5),
(6, 'Ancora una notte insieme', 4, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `album_di_artista`
--

DROP TABLE IF EXISTS `album_di_artista`;
CREATE TABLE IF NOT EXISTS `album_di_artista` (
  `id_album` int(11) NOT NULL,
  `id_artista` int(11) NOT NULL,
  PRIMARY KEY (`id_album`,`id_artista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `album_di_artista`
--

INSERT INTO `album_di_artista` (`id_album`, `id_artista`) VALUES
(1, 1),
(2, 2),
(3, 1),
(5, 8),
(6, 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `artista`
--

DROP TABLE IF EXISTS `artista`;
CREATE TABLE IF NOT EXISTS `artista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `nazione` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `artista`
--

INSERT INTO `artista` (`id`, `nome`, `tipo`, `nazione`) VALUES
(1, 'Ed Sheeran', 'Solo', 'Inglese'),
(2, 'Queen', 'Gruppo', 'Inglese'),
(3, 'Freddie Mercury', 'Artista', 'Inglese'),
(5, 'Brian May', 'Artista', 'Inglese'),
(6, 'Roger Taylor', 'Artista', 'Inglese'),
(7, 'John Deacon', 'Artista', 'Inglese'),
(8, 'Justin Bieber', 'Solo', 'Americano'),
(9, 'Pooh', 'Gruppo', 'Italiana'),
(10, 'Dodi Battaglia ', 'Artista', 'Italiana'),
(11, 'Roby Facchinetti', 'Solo', 'Italiana'),
(12, 'Riccardo Fogli', 'Artista', 'Italiana'),
(13, 'Red Canzian', 'Artista', 'Italiana'),
(14, 'Stefano D\'Orazio', 'Artista', 'Italiana');

-- --------------------------------------------------------

--
-- Struttura della tabella `artista_partecipa`
--

DROP TABLE IF EXISTS `artista_partecipa`;
CREATE TABLE IF NOT EXISTS `artista_partecipa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_artista` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_artista`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `artista_partecipa`
--

INSERT INTO `artista_partecipa` (`id`, `id_artista`) VALUES
(1, 3),
(2, 5),
(3, 6),
(4, 7),
(5, 10),
(6, 11),
(7, 12),
(8, 13),
(9, 14);

-- --------------------------------------------------------

--
-- Struttura della tabella `autore_performa_traccia`
--

DROP TABLE IF EXISTS `autore_performa_traccia`;
CREATE TABLE IF NOT EXISTS `autore_performa_traccia` (
  `id_traccia` int(11) NOT NULL,
  `id_autore` int(11) NOT NULL,
  PRIMARY KEY (`id_traccia`,`id_autore`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `autore_performa_traccia`
--

INSERT INTO `autore_performa_traccia` (`id_traccia`, `id_autore`) VALUES
(22, 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `canzone`
--

DROP TABLE IF EXISTS `canzone`;
CREATE TABLE IF NOT EXISTS `canzone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autore` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `canzone`
--

INSERT INTO `canzone` (`id`, `autore`, `nome`) VALUES
(1, 2, 'Party'),
(2, 2, 'The Miracle'),
(3, 2, 'Rain Must Fall '),
(4, 2, 'My Baby Does Me '),
(5, 2, 'Was It All Worth It'),
(6, 2, 'Tear It Up'),
(7, 2, 'Man on the Prowl '),
(8, 2, 'Keep Passing the Open Windows'),
(9, 1, 'Eraser'),
(10, 1, 'Castle on the Hill'),
(11, 1, 'Dive'),
(12, 1, 'Shape of You'),
(13, 1, 'Perfect'),
(14, 1, 'Best Part of Me'),
(15, 1, 'Beautiful People'),
(16, 8, 'All Around the World'),
(17, 8, 'Be Alright'),
(18, 9, 'Anni senza fiato'),
(19, 9, 'Donne italiane'),
(20, 9, 'Brava la vita'),
(21, 9, 'La mia donna'),
(22, 11, 'Il segreto del tempo');

-- --------------------------------------------------------

--
-- Struttura della tabella `casadiscografica`
--

DROP TABLE IF EXISTS `casadiscografica`;
CREATE TABLE IF NOT EXISTS `casadiscografica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `casadiscografica`
--

INSERT INTO `casadiscografica` (`id`, `nome`) VALUES
(1, 'Parlophone'),
(2, 'Electric and Musical Industries'),
(3, 'Asylum Records'),
(4, 'Island Records'),
(5, 'CBS');

-- --------------------------------------------------------

--
-- Struttura della tabella `featuring_traccia`
--

DROP TABLE IF EXISTS `featuring_traccia`;
CREATE TABLE IF NOT EXISTS `featuring_traccia` (
  `id_traccia` int(11) NOT NULL,
  `id_artista` int(11) NOT NULL,
  PRIMARY KEY (`id_traccia`,`id_artista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `featuring_traccia`
--

INSERT INTO `featuring_traccia` (`id_traccia`, `id_artista`) VALUES
(15, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `genere`
--

DROP TABLE IF EXISTS `genere`;
CREATE TABLE IF NOT EXISTS `genere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `genere`
--

INSERT INTO `genere` (`id`, `nome`) VALUES
(1, 'Pop'),
(2, 'Rock'),
(3, 'Indie'),
(4, 'Jazz');

-- --------------------------------------------------------

--
-- Struttura della tabella `membro_di_gruppo`
--

DROP TABLE IF EXISTS `membro_di_gruppo`;
CREATE TABLE IF NOT EXISTS `membro_di_gruppo` (
  `id` int(11) NOT NULL,
  `id_gruppo` int(11) NOT NULL,
  `id_artista` int(11) NOT NULL,
  `id_ruolo` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_gruppo`,`id_artista`,`id_ruolo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `membro_di_gruppo`
--

INSERT INTO `membro_di_gruppo` (`id`, `id_gruppo`, `id_artista`, `id_ruolo`) VALUES
(1, 2, 3, 3),
(1, 2, 3, 5),
(2, 2, 5, 4),
(3, 2, 6, 1),
(4, 2, 7, 5),
(5, 9, 10, 3),
(6, 9, 11, 2),
(7, 9, 12, 1),
(8, 9, 13, 3),
(9, 9, 14, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `musicista`
--

DROP TABLE IF EXISTS `musicista`;
CREATE TABLE IF NOT EXISTS `musicista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruolo` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `musicista`
--

INSERT INTO `musicista` (`id`, `ruolo`) VALUES
(1, 'Bassista'),
(2, 'Batterista'),
(3, 'Cantante'),
(4, 'Chitarrista'),
(5, 'Tastierista');

-- --------------------------------------------------------

--
-- Struttura della tabella `release`
--

DROP TABLE IF EXISTS `release`;
CREATE TABLE IF NOT EXISTS `release` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `id_casaDiscografica` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `release`
--

INSERT INTO `release` (`id`, `titolo`, `data`, `id_casaDiscografica`) VALUES
(1, 'The Miracle', '1989-05-21', 1),
(2, 'The Works', '1984-02-27', 2),
(3, '÷', '2015-12-12', 3),
(4, 'No. 6 Collaborations Project', '2019-11-08', 3),
(5, 'Believe', '2012-05-03', 4),
(6, 'Ancora una notte insieme', '2009-05-29', 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `release_ha_supporto`
--

DROP TABLE IF EXISTS `release_ha_supporto`;
CREATE TABLE IF NOT EXISTS `release_ha_supporto` (
  `id_release` int(11) NOT NULL,
  `id_supporto` int(11) NOT NULL,
  PRIMARY KEY (`id_release`,`id_supporto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `release_ha_supporto`
--

INSERT INTO `release_ha_supporto` (`id_release`, `id_supporto`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(3, 1),
(3, 3),
(4, 2),
(4, 3),
(5, 1),
(5, 3),
(6, 1),
(6, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `supporto`
--

DROP TABLE IF EXISTS `supporto`;
CREATE TABLE IF NOT EXISTS `supporto` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `supporto`
--

INSERT INTO `supporto` (`id`, `nome`) VALUES
(1, 'CD'),
(2, 'Vinile'),
(3, 'Digitale');

-- --------------------------------------------------------

--
-- Struttura della tabella `traccia`
--

DROP TABLE IF EXISTS `traccia`;
CREATE TABLE IF NOT EXISTS `traccia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `durata` int(11) NOT NULL,
  `bpm` int(11) NOT NULL,
  `scala` varchar(10) NOT NULL,
  `id_album` int(11) DEFAULT NULL,
  `id_canzone` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `traccia`
--

INSERT INTO `traccia` (`id`, `nome`, `durata`, `bpm`, `scala`, `id_album`, `id_canzone`) VALUES
(1, 'Party', 145, 74, 'Maggiore', 1, 1),
(2, 'The Miracle', 139, 86, 'Maggiore', 1, 2),
(3, 'Rain Must Fall', 187, 51, 'Maggiore', 1, 3),
(4, 'My Baby Does Me', 163, 40, 'Minore', 1, 4),
(5, 'Was It All Worth It', 131, 89, 'Maggiore', 1, 5),
(6, 'Tear It Up', 172, 56, 'Minore', 2, 6),
(7, 'Man on the Prowl ', 156, 90, 'Maggiore', 2, 7),
(8, 'Keep Passing the Open Windows ', 140, 81, 'Maggiore', 2, 8),
(9, 'Eraser', 132, 10, 'Minore', 3, 9),
(10, 'Castle on the Hill', 178, 90, 'Minore', 3, 10),
(11, 'Dive', 240, 80, 'Maggiore', 3, 11),
(12, 'Shape of You', 210, 30, 'Minore', 3, 12),
(13, 'Perfect', 430, 78, 'Maggiore', 3, 13),
(14, 'Best Part of Me', 321, 75, 'Maggiore', 4, 14),
(15, 'Beautiful People', 243, 82, 'Minore', 4, 15),
(16, 'All Around the World', 189, 71, 'Minore', 5, 16),
(17, 'Be Alright', 164, 84, 'Maggiore', 5, 17),
(18, 'Anni senza fiato', 321, 70, 'Minore', 6, 18),
(19, 'Donne italiane', 234, 71, 'Maggiore', 6, 19),
(20, 'Brava la vita', 154, 90, 'Minore', 6, 20),
(21, 'La mia donna', 241, 90, 'Maggiore', 6, 21),
(22, 'Il segreto del tempo', 145, 90, 'Maggiore', NULL, 22);

-- --------------------------------------------------------

--
-- Struttura della tabella `traccia_ha_genere`
--

DROP TABLE IF EXISTS `traccia_ha_genere`;
CREATE TABLE IF NOT EXISTS `traccia_ha_genere` (
  `id_traccia` int(11) NOT NULL,
  `id_genere` int(11) NOT NULL,
  PRIMARY KEY (`id_traccia`,`id_genere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `traccia_ha_genere`
--

INSERT INTO `traccia_ha_genere` (`id_traccia`, `id_genere`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(3, 2),
(4, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(8, 2),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 2),
(16, 3),
(17, 4),
(18, 1),
(19, 1),
(20, 1),
(21, 2),
(22, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `traccia_successiva_precedente`
--

DROP TABLE IF EXISTS `traccia_successiva_precedente`;
CREATE TABLE IF NOT EXISTS `traccia_successiva_precedente` (
  `id_traccia` int(11) NOT NULL AUTO_INCREMENT,
  `id_traccia_successiva` int(11) DEFAULT NULL,
  `id_traccia_precedente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_traccia`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `traccia_successiva_precedente`
--

INSERT INTO `traccia_successiva_precedente` (`id_traccia`, `id_traccia_successiva`, `id_traccia_precedente`) VALUES
(1, 2, NULL),
(2, 3, 1),
(3, 4, 2),
(4, 5, 3),
(5, NULL, 4),
(6, 7, NULL),
(7, 8, 6),
(8, NULL, 7),
(9, 10, NULL),
(10, 11, 9),
(11, 12, 10),
(12, 13, 11),
(13, NULL, 12),
(14, 15, NULL),
(15, NULL, 14),
(16, 17, NULL),
(17, NULL, 16),
(18, 19, NULL),
(19, 20, 18),
(20, 21, 19),
(21, NULL, 20),
(22, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
