-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2022 a las 01:37:14
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infobdn`
--
CREATE DATABASE IF NOT EXISTS `infobdn` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `infobdn`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracio`
--

CREATE TABLE `administracio` (
  `nombre` varchar(250) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `administracio`
--

INSERT INTO `administracio` (`nombre`, `password`) VALUES
('root', '63a9f0ea7bb98050796b649e85481845');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnes`
--

CREATE TABLE `alumnes` (
  `dni_alum` varchar(250) COLLATE utf8_bin NOT NULL,
  `nombre_alum` varchar(250) COLLATE utf8_bin NOT NULL,
  `apellido_alum` varchar(250) COLLATE utf8_bin NOT NULL,
  `contraseña_alum` varchar(100) COLLATE utf8_bin NOT NULL,
  `edad_alum` varchar(250) COLLATE utf8_bin NOT NULL,
  `cursos_matriculats` varchar(250) COLLATE utf8_bin NOT NULL,
  `rol_alum` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `alumnes`
--

INSERT INTO `alumnes` (`dni_alum`, `nombre_alum`, `apellido_alum`, `contraseña_alum`, `edad_alum`, `cursos_matriculats`, `rol_alum`) VALUES
('12213212F', 'OSCAR', 'HSADH', '1234', '19', '2daw', 0),
('21757547F', 'Marcos', 'xfkifk', '1234', '20', '2ASIX', 0),
('21757547R', 'Carlos', 'Diaz', '1234', '17', '1 DAW', 0),
('32984568J', 'Horacio', 'perez', '6547', '19', 'ASIX', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `idCurso` int(11) NOT NULL,
  `nom` varchar(250) COLLATE utf8_bin NOT NULL,
  `descripcio` varchar(250) COLLATE utf8_bin NOT NULL,
  `horas` int(4) NOT NULL,
  `data_inici` date NOT NULL,
  `data_final` date NOT NULL,
  `dni_prof` varchar(250) COLLATE utf8_bin NOT NULL,
  `act` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idCurso`, `nom`, `descripcio`, `horas`, `data_inici`, `data_final`, `dni_prof`, `act`) VALUES
(1, 'ASIX', 'ASIX', 400, '2022-11-01', '2022-11-30', '21568741D', 0),
(2, 'Telecomunicaciones', 'jhffjfgj', 500, '2022-11-03', '2022-11-29', '65784132H', 1),
(3, 'DAW', 'DAW', 640, '2022-11-01', '2022-11-30', '64757513K', 0),
(4, 'ESO', 'FHKFS', 600, '2022-11-12', '2022-11-30', '64757513K', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `idCurso` int(11) NOT NULL,
  `dni_alum` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professors`
--

CREATE TABLE `professors` (
  `dni_prof` varchar(250) COLLATE utf8_bin NOT NULL,
  `nom` varchar(250) COLLATE utf8_bin NOT NULL,
  `cognom` varchar(250) COLLATE utf8_bin NOT NULL,
  `pass` varchar(100) COLLATE utf8_bin NOT NULL,
  `titol_academic` varchar(250) COLLATE utf8_bin NOT NULL,
  `fotografia` varchar(250) COLLATE utf8_bin NOT NULL,
  `cursos_imparteixen` varchar(250) COLLATE utf8_bin NOT NULL,
  `act` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `professors`
--

INSERT INTO `professors` (`dni_prof`, `nom`, `cognom`, `pass`, `titol_academic`, `fotografia`, `cursos_imparteixen`, `act`) VALUES
('11111111A', 'Olha', 'ldllrll', '4567', 'pppp', 'img/20220805_133616.jpg', 'Telecomunicaciones', 0),
('11111111B', 'Olha', 'ldllrll', 'lfoler', 'ff', 'img/kmhgk.PNG', 'ddd', 0),
('21568741D', 'Ana', 'lopez', '6548', 'ASIX', 'img/.jpg', 'ASIX', 1),
('35786594B', 'Olga', 'dfghgh', '1234', 'DAW', 'img/.jpg', 'DAW', 0),
('64757513K', 'vanesa', 'martin', '9876', 'DAW', 'img/.jpg', 'DAW', 0),
('65784132H', 'Pau', 'Lopez', '6543', 'Telecomunicaciones', 'img/.jpg', 'Telecos', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administracio`
--
ALTER TABLE `administracio`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `alumnes`
--
ALTER TABLE `alumnes`
  ADD PRIMARY KEY (`dni_alum`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idCurso`),
  ADD KEY `dni_prof` (`dni_prof`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`idCurso`,`dni_alum`),
  ADD KEY `dni_alum` (`dni_alum`);

--
-- Indices de la tabla `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`dni_prof`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`dni_prof`) REFERENCES `professors` (`dni_prof`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`dni_alum`) REFERENCES `alumnes` (`dni_alum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
