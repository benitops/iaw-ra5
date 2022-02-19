-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-02-2022 a las 01:31:24
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
-- Base de datos: `bps_mis_estudios`
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
(1, 1, 'Presentación de un trabajo', 100, '8.50'),
(4, 2, 'Prueba teórica', 60, '7.00'),
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
(46, 18, 'TRABAJO', 10, NULL),
(47, 19, 'EXAMEN TEÓRICO', 20, '10.00'),
(48, 19, 'EXAMEN PRÁCTICO', 70, '10.00'),
(49, 19, 'TRABAJO', 10, NULL),
(50, 20, 'EXAMEN TEÓRICO', 20, '10.00'),
(51, 20, 'EXAMEN PRÁCTICO', 70, '10.00'),
(52, 20, 'TRABAJO', 10, NULL),
(53, 21, 'EXAMEN TEÓRICO', 20, '10.00'),
(54, 21, 'EXAMEN PRÁCTICO', 70, '10.00'),
(55, 21, 'TRABAJO', 10, NULL),
(71, 2, 'Prueba práctica', 40, '8.00'),
(72, 30, 'Prueba práctica', 100, '9.00'),
(73, 31, 'Prueba práctica', 100, '7.00'),
(74, 32, 'Prueba práctica', 100, '8.00'),
(75, 33, 'Prueba escrita', 70, '9.00'),
(76, 33, 'Presentación de un trabajo', 30, '6.00'),
(77, 34, 'Prueba práctica', 100, '10.00'),
(78, 35, 'Prueba escrita 1', 40, '10.00'),
(79, 35, 'Trabajo entregable 1', 60, '8.00'),
(80, 36, 'Prueba escrita 2', 20, '10.00'),
(81, 36, 'Prueba práctica 1', 65, '10.00'),
(82, 36, 'Trabajo entregable 2', 15, '7.00'),
(83, 37, 'Prueba práctica 2', 20, '7.00'),
(84, 37, 'Trabajo entregable 3', 80, '8.00'),
(85, 38, 'Prueba escrita 3', 20, '8.00'),
(86, 38, 'Trabajo práctica 2', 80, '9.00'),
(87, 39, 'Prueba escrita', 20, '7.70'),
(88, 39, 'Trabajo práctico', 80, '8.40'),
(89, 40, 'Prueba escrita', 20, '9.40'),
(90, 40, 'Trabajo práctico', 80, '8.75'),
(91, 41, 'Prueba escrita', 20, '7.75'),
(92, 41, 'Trabajo práctico', 80, '9.00'),
(93, 42, 'Prueba escrita 1', 100, '8.00'),
(94, 43, 'Prueba escrita 2', 80, '9.00'),
(95, 43, 'Trabajo entregable 2', 20, '6.00'),
(96, 44, 'Trabajo entregable 3', 100, '7.86'),
(97, 45, 'Prueba escrita 3', 20, '8.40'),
(98, 45, 'Trabajo práctico', 80, '9.60'),
(99, 46, 'Prueba escrita', 20, '6.80'),
(100, 46, 'Trabajo práctico', 80, '7.75'),
(101, 47, 'Prueba escrita', 20, '9.90'),
(102, 47, 'Trabajo práctico', 80, '8.75'),
(103, 48, 'Prueba escrita', 50, '8.00'),
(104, 48, 'Prueba practica', 50, '8.00'),
(105, 49, 'Prueba escrita', 50, '8.00'),
(106, 49, 'Prueba practica', 50, '8.00'),
(107, 50, 'Prueba escrita', 40, '8.00'),
(108, 50, 'Prueba practica', 60, '8.00'),
(109, 51, 'Prueba escrita', 25, '8.00'),
(110, 51, 'Prueba práctica', 75, '8.00'),
(111, 52, 'Prueba escrita', 10, '8.00'),
(112, 52, 'Prueba práctica', 90, '8.00'),
(113, 53, 'Prueba teórica', 50, '8.00'),
(114, 53, 'Prueba práctica', 50, '8.00'),
(115, 54, 'Trabajo', 100, '8.00'),
(116, 55, 'Prueba escrita', 40, '10.00'),
(117, 55, 'Trabajo de investigación', 25, '10.00'),
(118, 55, 'Plan de empresa', 25, '10.00'),
(119, 55, 'Análisis texto', 10, '10.00'),
(120, 56, 'Prueba escrita', 25, '10.00'),
(121, 56, 'Ejercicio práctico', 10, '10.00'),
(122, 56, 'Ejercicio práctico', 15, '10.00'),
(123, 56, 'Análisis de casos prácticos', 20, '10.00'),
(124, 56, 'Ejercicio práctico', 10, '10.00'),
(125, 56, 'Plan de empresa', 20, '10.00'),
(126, 57, 'Prueba escrita', 40, '10.00'),
(127, 57, 'Trabajo de investigación', 30, '10.00'),
(128, 57, 'Plan de empresa', 30, '10.00'),
(129, 58, 'Prueba escrita', 25, '10.00'),
(130, 58, 'Ejercicios prácticos', 10, '10.00'),
(131, 58, 'Ejercicios prácticos', 10, '10.00'),
(132, 58, 'Trabajo de investigación', 10, '10.00'),
(133, 58, 'Ejercicios prácticos', 15, '10.00'),
(134, 58, 'Plan de empresa', 30, '10.00');

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
(2, 374, 2, 'Administración de procesos', 15),
(14, 375, 1, 'DNS', 20),
(15, 375, 2, 'DHCP', 10),
(16, 375, 3, 'HTTP', 15),
(17, 375, 4, 'FTP', 10),
(18, 375, 5, 'CORREO', 15),
(19, 375, 6, 'IM y NL', 10),
(20, 375, 7, 'AUDIO STREAMING', 10),
(21, 375, 8, 'VIDEO STREAMING', 10),
(30, 374, 3, 'Gestionar automatización', 10),
(31, 374, 4, 'Administración remota', 10),
(32, 374, 5, 'Administración de impresoras', 15),
(33, 374, 6, 'Sistemas Operativos', 15),
(34, 374, 7, 'Scripts', 15),
(35, 376, 1, 'Entorno de desarrollo', 10),
(36, 376, 2, 'Implanta CMS', 10),
(37, 376, 3, 'Administra CMS', 10),
(38, 376, 4, 'Gestiona aplicaciones de ofimáticas', 10),
(39, 376, 5, 'PHP (I)', 35),
(40, 376, 6, 'PHP (II)', 25),
(41, 376, 7, 'Cambios en CMS', 10),
(42, 377, 1, 'Implementación de sistemas gestores', 15),
(43, 377, 2, 'Configura el sistema gestor', 25),
(44, 377, 3, 'Implementa métodos de control', 15),
(45, 377, 4, 'Automatiza tareas de administración', 15),
(46, 377, 5, 'Optimiza el rendimiento', 15),
(47, 377, 6, 'Aplica criterios de disponibilidad', 15),
(48, 378, 1, 'Tratamiento de la información', 25),
(49, 378, 2, 'Implementa mecanismos de seguridad activa', 25),
(50, 378, 3, 'Implementa técnicas seguras de acceso remoto', 10),
(51, 378, 4, 'Implementa cortafuegos', 10),
(52, 378, 5, 'Implementa proxy', 10),
(53, 378, 6, 'Implementa virtualización', 10),
(54, 378, 7, 'Reconoce la legislación', 10),
(55, 381, 1, 'Iniciativa emprendedora', 25),
(56, 381, 2, 'Creación de pequeña empresa', 25),
(57, 381, 3, 'Constitución de empresa', 25),
(58, 381, 4, 'Gestión administrativa', 25);

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
  MODIFY `clave` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
