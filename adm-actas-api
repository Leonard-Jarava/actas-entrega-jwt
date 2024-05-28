-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 28-05-2024 a las 03:12:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `actas_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actas`
--

CREATE TABLE `actas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `compromisos` text DEFAULT NULL,
  `reunion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actas`
--

INSERT INTO `actas` (`id`, `fecha`, `hora`, `titulo`, `compromisos`, `reunion_id`) VALUES
(4, '2024-05-01', '08:00:00', 'Nombre de la acta', '1.  primer compromiso\n2. segundo compromiso\n3. tercer compromiso', 17),
(8, '2024-05-01', '08:00:00', 'nombre acta', 'compromiso', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `usuario_id` int(11) NOT NULL,
  `reunion_id` int(11) NOT NULL,
  `hora_ingreso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`usuario_id`, `reunion_id`, `hora_ingreso`) VALUES
(11, 17, '2024-05-16 00:15:52'),
(11, 20, '2024-05-15 23:22:11'),
(12, 17, '2024-05-16 04:31:53'),
(12, 20, '2024-05-15 23:43:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refresh_token`
--

CREATE TABLE `refresh_token` (
  `token_hash` varchar(255) NOT NULL,
  `expires_at` int(128) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `refresh_token`
--

INSERT INTO `refresh_token` (`token_hash`, `expires_at`) VALUES
('613b944fad2d13d872b9bd2257fba8047843c605ae508dde254e6afe03ebc2a6', 1717287656);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reuniones`
--

CREATE TABLE `reuniones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reuniones`
--

INSERT INTO `reuniones` (`id`, `nombre`, `fecha`, `hora`, `lugar`, `descripcion`) VALUES
(17, 'Reunion de entrega', '2024-05-01', '08:00:00', 'U', 'entrega'),
(20, 'Nombre de la reunión', '2024-05-01', '08:00:00', 'Lugar del reunión', 'Descripcion del reunión');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`) VALUES
(11, 'nombre', 'apellido', 'usuario@correo.com', '$2y$10$2ofdZGEjlIHfsPorVNq94u2jVXLexPATNOrpd.L.EUFuXTJbHWfEy');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actas`
--
ALTER TABLE `actas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reunion` (`reunion_id`);

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`usuario_id`,`reunion_id`),
  ADD KEY `reunion_id` (`reunion_id`);

--
-- Indices de la tabla `refresh_token`
--
ALTER TABLE `refresh_token`
  ADD PRIMARY KEY (`token_hash`);

--
-- Indices de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actas`
--
ALTER TABLE `actas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actas`
--
ALTER TABLE `actas`
  ADD CONSTRAINT `actas_ibfk_1` FOREIGN KEY (`reunion_id`) REFERENCES `reuniones` (`id`);

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `asistencias_ibfk_2` FOREIGN KEY (`reunion_id`) REFERENCES `reuniones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
