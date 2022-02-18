-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-02-2022 a las 22:39:11
-- Versión del servidor: 10.3.32-MariaDB-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mis_estudios`
--
CREATE DATABASE IF NOT EXISTS `bps_mis_estudios` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bps_mis_estudios`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

DROP TABLE IF EXISTS `asignaturas`;
CREATE TABLE `asignaturas` (
  `codigo` int(4) UNSIGNED NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL,
  `horas_semana` int(2) UNSIGNED NOT NULL,
  `profesor` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`codigo`, `nombre`, `horas_semana`, `profesor`) VALUES
(374, 'Administración de sistemas operativos', 6, 'Susana Oviedo Bocanegra'),
(375, 'Servicios de red e Internet', 6, 'Rafael Montero González'),
(376, 'Implantación de aplicaciones web.', 4, 'Raúl Gil Sarmiento'),
(377, 'Administración de sistemas gestores de BB.DD.', 3, 'Raúl Gil Sarmiento'),
(378, 'Seguridad y alta disponibilidad.', 4, 'Patricia Vegas Gómez'),
(381, 'Empresa e inicisativa emprendedora.', 4, 'MªCarmen Castaños Berlín');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instrumentos`
--

DROP TABLE IF EXISTS `instrumentos`;
CREATE TABLE `instrumentos` (
  `clave` int(10) UNSIGNED NOT NULL,
  `unidad` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `peso` int(2) UNSIGNED NOT NULL,
  `calificacion` decimal(10,2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `instrumentos`
--

INSERT INTO `instrumentos` (`clave`, `unidad`, `nombre`, `peso`, `calificacion`) VALUES
(1, 1, 'Examen Teórico', 45, '8.50'),
(2, 1, 'Examen Práctico', 35, '6.30'),
(3, 1, 'Actividades de Aula', 20, NULL),
(4, 2, 'Examen', 70, '9.20'),
(32, 14, 'EXAMEN TEÓRICO', 20, '6.67'),
(33, 14, 'EXAMEN PRÁCTICO', 70, '10.00'),
(34, 14, 'TRABAJO', 10, '10.00'),
(35, 15, 'EXAMEN TEÓRICO', 20, '10.00'),
(36, 15, 'EXAMEN PRÁCTICO', 70, '10.00'),
(37, 15, 'TRABAJO', 10, '10.00'),
(38, 16, 'EXAMEN TEÓRICO', 20, '7.33'),
(39, 16, 'EXAMEN PRÁCTICO', 70, '10.00'),
(40, 16, 'TRABAJO', 10, '10.00'),
(41, 17, 'EXAMEN TEÓRICO', 20, '6.67'),
(42, 17, 'EXAMEN PRÁCTICO', 70, '10.00'),
(43, 17, 'TRABAJO', 10, '10.00'),
(44, 18, 'EXAMEN TEÓRICO', 20, '5.17'),
(45, 18, 'EXAMEN PRÁCTICO', 70, '10.00'),
(46, 18, 'TRABAJO', 10, '10.00'),
(47, 19, 'EXAMEN TEÓRICO', 20, '10.00'),
(48, 19, 'EXAMEN PRÁCTICO', 70, '10.00'),
(49, 19, 'TRABAJO', 10, '10.00'),
(50, 20, 'EXAMEN TEÓRICO', 20, '10.00'),
(51, 20, 'EXAMEN PRÁCTICO', 70, '10.00'),
(52, 20, 'TRABAJO', 10, '10.00'),
(53, 21, 'EXAMEN TEÓRICO', 20, '10.00'),
(54, 21, 'EXAMEN PRÁCTICO', 70, '10.00'),
(55, 21, 'TRABAJO', 10, '10.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

DROP TABLE IF EXISTS `unidades`;
CREATE TABLE `unidades` (
  `clave` int(11) NOT NULL,
  `asignatura` int(4) NOT NULL,
  `numero` int(2) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `porcentaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`clave`, `asignatura`, `numero`, `nombre`, `porcentaje`) VALUES
(1, 374, 1, 'Administración de Servicio de Directorios', 15),
(2, 374, 2, 'Procesos del Sistema', 20),
(14, 375, 1, 'DNS', 20),
(15, 375, 2, 'DHCP', 10),
(16, 375, 3, 'HTTP', 15),
(17, 375, 4, 'FTP', 10),
(18, 375, 5, 'CORREO', 15),
(19, 375, 6, 'IM y NL', 10),
(20, 375, 7, 'AUDIO STREAMING', 10),
(21, 375, 8, 'VIDEO STREAMING', 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `instrumentos`
--
ALTER TABLE `instrumentos`
  ADD PRIMARY KEY (`clave`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`clave`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `instrumentos`
--
ALTER TABLE `instrumentos`
  MODIFY `clave` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
