-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-11-2024 a las 00:01:02
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eventos_deportivos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_evento` varchar(255) NOT NULL,
  `tipo_deporte` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `id_organizador` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_organizador` (`id_organizador`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `nombre_evento`, `tipo_deporte`, `fecha`, `hora`, `ubicacion`, `id_organizador`) VALUES
(1, 'Evento prueba 2', 'Fútbol', '2024-11-12', '22:48:00', 'Ubicación de prueba', 1),
(4, 'Evento prueba 3', 'Fútbol', '2024-11-13', '23:52:00', 'Test', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizadores`
--

DROP TABLE IF EXISTS `organizadores`;
CREATE TABLE IF NOT EXISTS `organizadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `organizadores`
--

INSERT INTO `organizadores` (`id`, `nombre`, `email`, `telefono`) VALUES
(1, 'Organizador 1', 'email@test', '123456789'),
(4, 'Alonso', 'email@test', '000000000');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
