-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2023 a las 00:20:44
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vehiculos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `nombre` text NOT NULL,
  `ci` int(11) NOT NULL,
  `ubicacion` varchar(25) NOT NULL,
  `telefono` int(255) NOT NULL,
  `precio` int(255) NOT NULL,
  `id_producto` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`nombre`, `ci`, `ubicacion`, `telefono`, `precio`, `id_producto`) VALUES
('Marlon AristimuÃ±o', 31898731, 'punta de mata-parcela', 412, 5000, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `id del motor` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `num de asientos` int(255) NOT NULL,
  `placa` varchar(255) NOT NULL,
  `precio` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `modelo`, `marca`, `id del motor`, `color`, `num de asientos`, `placa`, `precio`) VALUES
(8, 'Civic', 'Honda', 'HM12345', 'rojo', 5, 'ABC-123', 500),
(9, 'Corolla', 'Toyota', 'TM67890', 'Azul', 4, 'XYZ-789', 2000),
(10, 'Jetta', 'Volkswagen', 'VW45678', 'plateado', 5, 'DEF-789', 2000),
(13, 'Sentra', 'Nissan', 'NS13579', 'Gris', 4, 'MNO-802', 5000),
(14, 'Fusion', 'Ford', 'FD75319', 'Rojo', 4, 'PQR-753', 4500),
(15, 'Sonata', 'Hyundai', 'HY46813', 'Plateado', 4, 'STU-468', 1000),
(16, 'Impreza', 'Subaru', 'SB09123', 'Azul', 5, 'VWX-091', 3600),
(17, 'Optima', 'Kia', 'KI24680', 'Negro', 4, 'YZA-357', 2800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(25) NOT NULL,
  `contrasena` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasena`) VALUES
(5, 'canela', 'linda'),
(6, 'linda', 'canela');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`),
  ADD UNIQUE KEY `marca` (`marca`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
