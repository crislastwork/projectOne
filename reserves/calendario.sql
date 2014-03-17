-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-01-2014 a las 14:51:46
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `calendario`
--
CREATE DATABASE IF NOT EXISTS `calendario` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `calendario`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cayacs`
--

CREATE TABLE IF NOT EXISTS `cayacs` (
  `id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `cayaca` int(3) unsigned NOT NULL,
  `cayacb` int(3) unsigned NOT NULL,
  `cayacc` int(3) unsigned NOT NULL,
  `llogatsa` int(3) unsigned NOT NULL,
  `llogatsb` int(3) unsigned NOT NULL,
  `llogatsc` int(3) unsigned NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cayacs`
--

INSERT INTO `cayacs` (`id`, `cayaca`, `cayacb`, `cayacc`, `llogatsa`, `llogatsb`, `llogatsc`, `data`) VALUES
('20140101', 2, 2, 2, 0, 0, 0, '2014-01-01'),
('20140102', 2, 2, 2, 0, 0, 0, '2014-01-02'),
('20140103', 2, 2, 2, 0, 0, 0, '2014-01-03'),
('20140104', 2, 2, 2, 0, 0, 0, '2014-01-04'),
('20140105', 2, 2, 2, 0, 0, 0, '2014-01-05'),
('20140106', 2, 2, 2, 0, 0, 0, '2014-01-06'),
('20140107', 2, 2, 2, 0, 0, 0, '2014-01-07'),
('20140108', 2, 2, 2, 0, 0, 0, '2014-01-08'),
('20140109', 2, 2, 2, 0, 0, 0, '2014-01-09'),
('20140110', 2, 2, 2, 0, 0, 0, '2014-01-10'),
('20140115', 2, 2, 2, 2, 2, 2, '2014-01-15'),
('20140116', 2, 2, 2, 2, 2, 2, '2014-01-16'),
('20140117', 4, 4, 4, 2, 2, 2, '2014-01-17'),
('20140118', 2, 2, 2, 0, 0, 0, '2014-01-18'),
('20140119', 2, 2, 2, 0, 0, 0, '2014-01-19'),
('20140120', 2, 2, 2, 0, 0, 0, '2014-01-20'),
('20140121', 11, 11, 11, 0, 0, 0, '2014-01-21'),
('20140122', 11, 11, 11, 0, 0, 0, '2014-01-22'),
('20140123', 11, 11, 11, 0, 0, 2, '2014-01-23'),
('20140124', 11, 11, 11, 0, 0, 2, '2014-01-24'),
('20140125', 11, 11, 11, 0, 0, 2, '2014-01-25'),
('20140126', 9, 9, 9, 0, 0, 2, '2014-01-26'),
('20140127', 9, 9, 9, 0, 0, 2, '2014-01-27'),
('20140128', 9, 9, 9, 0, 0, 2, '2014-01-28'),
('20140129', 7, 7, 7, 0, 0, 2, '2014-01-29'),
('20140130', 7, 7, 7, 0, 0, 2, '2014-01-30'),
('20140131', 2, 2, 2, 0, 0, 2, '2014-01-31'),
('20140201', 2, 2, 2, 0, 0, 2, '2014-02-01'),
('20140202', 2, 2, 2, 0, 0, 2, '2014-02-02'),
('20140203', 2, 2, 2, 0, 0, 2, '2014-02-03'),
('20140204', 2, 2, 2, 0, 0, 2, '2014-02-04'),
('20140205', 2, 2, 2, 0, 0, 0, '2014-02-05'),
('20140206', 2, 2, 2, 0, 0, 0, '2014-02-06'),
('20140207', 2, 2, 2, 0, 0, 0, '2014-02-07'),
('20140208', 2, 2, 2, 0, 0, 0, '2014-02-08'),
('20140209', 2, 2, 2, 0, 0, 0, '2014-02-09'),
('20140210', 2, 2, 2, 0, 0, 0, '2014-02-10'),
('20140211', 2, 2, 2, 0, 0, 0, '2014-02-11'),
('20140212', 2, 2, 2, 0, 0, 0, '2014-02-12'),
('20140213', 2, 2, 2, 0, 0, 0, '2014-02-13'),
('20140214', 2, 2, 2, 0, 0, 0, '2014-02-14'),
('20140215', 2, 2, 2, 2, 2, 2, '2014-02-15'),
('20140216', 2, 2, 2, 2, 2, 2, '2014-02-16'),
('20140217', 2, 2, 2, 2, 2, 2, '2014-02-17'),
('20140218', 2, 2, 2, 2, 2, 2, '2014-02-18'),
('20140219', 3, 3, 3, 2, 2, 2, '2014-02-19'),
('20140220', 3, 3, 3, 2, 2, 2, '2014-02-20'),
('20140221', 2, 2, 2, 0, 0, 0, '2014-02-21'),
('20140222', 2, 2, 2, 0, 0, 0, '2014-02-22'),
('20140223', 2, 2, 2, 0, 0, 0, '2014-02-23'),
('20140224', 2, 2, 2, 0, 0, 0, '2014-02-24'),
('20140225', 2, 2, 2, 0, 0, 0, '2014-02-25'),
('20140226', 2, 2, 2, 0, 0, 0, '2014-02-26'),
('20140227', 2, 2, 2, 0, 0, 0, '2014-02-27'),
('20140228', 2, 2, 2, 0, 0, 0, '2014-02-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuari` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `clau` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
