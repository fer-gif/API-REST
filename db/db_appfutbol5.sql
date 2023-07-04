-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-07-2023 a las 04:56:50
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_appfutbol5-api`
--
CREATE DATABASE IF NOT EXISTS `db_appfutbol5-api` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_appfutbol5-api`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `socios` int(11) DEFAULT NULL,
  `escudo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `nombre`, `ciudad`, `socios`, `escudo`) VALUES
(5, 'Platense', 'Necochea', 2500, 'platense.png'),
(11, 'River', 'Tandil', 8000, NULL),
(12, 'Boca', 'Tandil', 5000, NULL),
(14, 'Estudiantes', 'Tandil', 3400, NULL),
(15, 'Maipu', 'Olavarria', 3500, NULL),
(16, 'Gimnasioa', 'Necochea', 1500, NULL),
(18, 'Independiente', 'Olavarria', 4500, NULL),
(25, 'Belgrano', 'Neochea', 3000, NULL),
(26, 'Intituto', 'Necochea', 1200, NULL),
(28, 'Ferro', 'Tandil', 3000, NULL),
(31, 'Milan', 'Neochea', 500, NULL),
(32, 'Luz y Fuerza', 'Necochea', 3000, NULL),
(33, 'Ministerio', 'Quequen', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id_jugador` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `posicion` varchar(5) NOT NULL,
  `foto` text DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `id_equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id_jugador`, `dni`, `nombre`, `apellido`, `telefono`, `posicion`, `foto`, `edad`, `id_equipo`) VALUES
(0, 25690321, 'Cristian', 'Lotartaro', 0, 'DEF', NULL, 42, 15),
(15, 30548888, 'Pipa', 'Garcia', 0, 'DEF', NULL, 38, 5),
(19, 25145666, 'Mario', 'Diaz', 0, 'POR', NULL, 43, 11),
(20, 30548999, 'Pity', 'Martinez', 0, 'DEL', NULL, 38, 11),
(21, 35641222, 'Cristian', 'Zapata', 456999, 'DEF', NULL, 35, 11),
(22, 34215666, 'Matias', 'Dindart', 0, 'MED', NULL, 34, 11),
(23, 29065448, 'Franco', 'Figal', 15887888, 'POR', NULL, 40, 12),
(24, 38156354, 'Javier', 'Villanueba', 0, 'MED', NULL, 28, 12),
(28, 36451233, 'Marcelo', 'Morello', 0, 'POR', NULL, 35, 5),
(29, 25687963, 'Fernando', 'Castañeda', 0, 'MED', NULL, 43, 5),
(30, 28964563, 'Dardo', 'Fuceneco', 0, 'DEL', NULL, 40, 5),
(31, 27896541, 'Gabriel', 'Roncaglia', 0, 'DEF', NULL, 42, 5),
(32, 26547896, 'Cristian', 'Rinaudo', 0, 'DEF', NULL, 41, 11),
(33, 35698120, 'Ismael', 'Frontier', 0, 'DEF', NULL, 35, 12),
(34, 34102390, 'Chango', 'Sosa', 15879966, 'DEL', NULL, 36, 12),
(35, 34109708, 'Paulino', 'Frances', 0, 'DEF', NULL, 36, 12),
(38, 24876302, 'Damian', 'Ledesma', 45987633, 'POR', NULL, 45, 14),
(39, 36789456, 'Fermin', 'Hernando', 0, 'DEL', NULL, 35, 14),
(40, 34109005, 'Mario', 'Martino', 0, 'DEF', NULL, 34, 14),
(41, 30548700, 'Lautaro', 'Pedernera', 0, 'MED', NULL, 39, 14),
(42, 37456899, 'Patricio', 'Perez', 15478987, 'DEF', NULL, 30, 14),
(43, 29874301, 'Samuel', 'Equemendiba', 15879999, 'DEL', NULL, 40, 15),
(44, 20548796, 'Humberto', 'Zoilo', 0, 'DEF', NULL, 47, 15),
(45, 31450360, 'Graciano', 'Modas', 4587777, 'POR', NULL, 38, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `id_partido` int(11) NOT NULL,
  `id_equipo1` int(11) NOT NULL,
  `id_equipo2` int(11) NOT NULL,
  `goles_equipo1` int(11) NOT NULL,
  `goles_equipo2` int(11) NOT NULL,
  `fecha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`id_partido`, `id_equipo1`, `id_equipo2`, `goles_equipo1`, `goles_equipo2`, `fecha`) VALUES
(2, 5, 11, 1, 1, 1),
(8, 11, 12, 9, 0, 3),
(9, 5, 14, 2, 4, 3),
(17, 18, 16, 4, 2, 2),
(18, 25, 26, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` text DEFAULT NULL,
  `permisos` int(11) NOT NULL,
  `id_equipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `email`, `permisos`, `id_equipo`) VALUES
(1, 'Admin', '$2y$10$g9jCUa3Pu9NxQKIYwNy.gerhYqlOQNtjPx7W0X6jiNXrO/op/iIfq', '', 5, NULL),
(10, 'capiPlatense', '$2y$10$27gA43ID6O/3NgH77S8dsOV4k3cYautXQXOQxlCEN910l19dfZYSu', '', 3, 5),
(15, 'capiRiver', '$2y$10$m1bBqea5QjF9Xqc4vmNxveJHPUEIMgNQ4xMmIZ5X1npoLrgwzZuGG', 'river@gmail.com', 3, 11),
(16, 'capiEstudiantes', '$2y$10$zbMh.sEYWhF4gr6fYDks0eG6F/P2tc89YeOVmvU3yEDI.SPrXMnnu', '', 3, 14),
(17, 'capiIsotopos', '$2y$10$yIw09F8goyMFsIo.ieSxnONEkyzvjkOzOpPwHfCCWC9v3cAcl/OvK', '', 3, 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`),
  ADD UNIQUE KEY `nombreEquipo` (`nombre`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id_jugador`),
  ADD UNIQUE KEY `dniJugador` (`dni`),
  ADD KEY `jugadorId_equipo` (`id_equipo`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`id_partido`),
  ADD KEY `partidoEquipo1` (`id_equipo1`),
  ADD KEY `partidoEquipo2` (`id_equipo2`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuarioUsuarios` (`usuario`),
  ADD UNIQUE KEY `usuarioEquipo` (`id_equipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `id_partido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `jugadorId_equipo` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD CONSTRAINT `partidoEquipo1` FOREIGN KEY (`id_equipo1`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `partidoEquipo2` FOREIGN KEY (`id_equipo2`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarioEquipo` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
