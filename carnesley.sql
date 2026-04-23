-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2026 a las 19:28:39
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
-- Base de datos: `carnesley`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `add_product`
--

CREATE TABLE `add_product` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `variante` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad_medida` enum('pieza','kilo') NOT NULL DEFAULT 'pieza',
  `cantidad_minima` int(11) DEFAULT NULL,
  `cantidad_maxima` int(11) DEFAULT NULL,
  `excedente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `add_product`
--

INSERT INTO `add_product` (`id`, `codigo`, `nombre`, `descripcion`, `variante`, `cantidad`, `unidad_medida`, `cantidad_minima`, `cantidad_maxima`, `excedente`) VALUES
(10, '4048', 'PICADILLO DE PUERCO', 'TROZITOS DE PUERCO EN CUBOS', 'CUBO', 53, 'kilo', 50, 250, 251),
(11, '4262', 'RIÑON DE RES', 'REBANADAS DE RIÑON', 'PLATO 7', 12, 'kilo', 76, 400, 401),
(12, '4057', 'CORAZON DE RES LIMPIO', 'CORAZON REBANADO', 'PLATO 7', 80, 'kilo', 42, 100, 101),
(13, '4060', 'ESPINAZO DE PUERCO', 'COSTILLAL DE PUERCO EN TROZOS', 'CAJA GRANDE', 450, 'kilo', 54, 500, 501),
(14, '4236', 'MANITA DE PUERCO', '3 PARTES DE MANITA DE PUERCO', 'CAJA BLANCAS', 15, 'kilo', 20, 300, 301),
(15, '4166', 'CARNE PARA TAMALES', 'LOMO DE PUERCO', 'CAJA GRANDE', 460, 'kilo', 320, 450, 451),
(16, '4312', 'CUBITOS DE PUERCO', 'CUBOS MAS GRANDES DE PUERCO', 'CAJA GRANDE', 75, 'kilo', 10, 60, 61),
(17, '4050', 'COSTILLA DE PUERCO', 'CINTURON DE COSTILLA 3 LINEAS ', 'CAJA GRANDE', 57, 'kilo', 30, 120, 121),
(18, '4042', 'CHULETA LOMO DE PUERCO', 'REBANDAS DE CHULETA MEDIDA', 'CAJA BARRAS', 48, 'kilo', 20, 200, 201),
(19, '4347', 'CHULETA DE PALETA DE PUERCO', 'CHULETA LARGA PLATO 7', 'CAJA GRANDE ', 15, 'kilo', 20, 200, 201),
(20, '4875', 'CHULETA AHUMADA DE PUERCO', 'CHULETA EN REBANADAS 7', 'CAJA CON BARRAS', 56, 'kilo', 10, 150, 151),
(21, '4099', 'MILANESA DE PUERCO', 'CORTE DELGADO', 'LOMO DE PUERCO', 145, 'kilo', 20, 200, 201),
(22, '4012', 'PIERNA DE PUERCO C/HUESO', 'PIERNA C/HUESO', 'CAJA GRANDE', 53, 'kilo', 60, 150, 151),
(23, '4137', 'PIERNA DE PUERCO S/HUESO', 'PIERNA S/HUESO', 'CAJA GRANDE', 458, 'kilo', 42, 500, 501),
(24, '51867', 'CARNE DE PUERCO P/ASAR', 'LOMO DE PUERCO', 'CAJA GRANDE CAFE', 671, 'kilo', 60, 500, 501),
(25, '4148', 'RETAZO DE RES C/HUESO', 'ESPINAZO DE RES C/HUESO', 'TROZOS', 381, 'kilo', 20, 400, 401),
(26, '4038', 'CHAMBARETE DE RES', 'REBABADAS GRUESA DE RES', 'CAJA CHICA', 258, 'kilo', 60, 300, 301),
(27, '53460', 'RETAZO DE DE DIEZMILLO CONGELADO', 'DIEZMILLO CONGELADO RETAZO', 'CAJA GRANDE CAFE', 98, 'kilo', 20, 200, 201),
(28, '4049', 'COSTILLA DE RES', 'COSTILLA DE RES', 'CAJA GRANDE', 132, 'kilo', 80, 200, 201),
(29, '52713', 'PESCUEZO DE RES', 'PESCUEZO DE RES', 'CAJA GRANDE', 31, 'kilo', 30, 150, 151),
(30, '4046', 'COLA DE RES', 'RABO DE RES trozo', 'PIEZA', 23, 'kilo', 30, 600, 601),
(31, '4002', 'PECHO S/HUESO DE RES', 'PECHO S/HUESO', 'CAJA GRANDE', 563, 'kilo', 30, 400, 401),
(32, '53694', 'CARNE P/BARBACOA', 'SOLOMILLO RES P/BARBACOA', 'CAJA GRANDE CAFE', 452, 'kilo', 80, 300, 301),
(33, '53758', 'BISTEC PICADO DE RES', 'TROCITOS DE BISTEC DE RES', 'CAJA BLANCA', 625, 'kilo', 60, 400, 401),
(34, '4014', 'CAZUELA DE RES CLASIFICADA', 'CAZUELA DE RES CLASIFICADA', 'CAJA BLANCA', 265, 'kilo', 30, 600, 601),
(35, '4142', 'PULPA LARGA DE RES', 'PULPA LARGA DE RES /ASAR', 'CAJA GRANDE CAFE', 568, 'kilo', 48, 600, 601),
(36, '4140', 'PULPA BOLA', 'PULPA BOLA', 'CAJA BLANCA', 458, 'kilo', 35, 500, 501),
(37, '4144', 'PULPA NEGRA', 'PULPA NEGRA RES', 'CAJA GRANDE CAFE', 654, 'kilo', 30, 700, 701);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nuevo`
--

CREATE TABLE `nuevo` (
  `id` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `variante` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad_medida` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_merma`
--

CREATE TABLE `registros_merma` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `unidad` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registros_merma`
--

INSERT INTO `registros_merma` (`id`, `usuario`, `fecha`, `hora`, `codigo`, `nombre`, `cantidad`, `unidad`) VALUES
(82, 'admin', '2025-08-25', '22:51:46', '4144', 'PULPA NEGRA', 12, 'kg'),
(83, 'admin', '2025-08-25', '22:51:46', '4142', 'PULPA LARGA DE RES', 32, 'pz'),
(84, 'admin', '2025-08-25', '22:51:46', '4140', 'PULPA BOLA', 15, 'kg'),
(85, 'admin', '2025-08-25', '22:51:46', '53758', 'BISTEC PICADO DE RES', 14, 'kg'),
(86, 'admin', '2025-08-25', '22:51:46', '4014', 'CAZUELA DE RES CLASIFICADA', 87, 'kg'),
(87, 'PEDRO', '2025-08-25', '23:00:20', '52713', 'PESCUEZO DE RES', 3, 'kg'),
(88, 'PEDRO', '2025-08-25', '23:00:20', '4046', 'COLA DE RES', 2, 'kg'),
(89, 'PEDRO', '2025-08-25', '23:00:20', '4002', 'PECHO S/HUESO DE RES', 2, 'kg'),
(90, 'PEDRO', '2025-08-25', '23:00:20', '53694', 'CARNE P/BARBACOA', 3, 'kg'),
(91, 'PEDRO', '2025-08-25', '23:00:20', '53758', 'BISTEC PICADO DE RES', 2, 'kg'),
(92, 'PEDRO', '2025-08-25', '23:00:20', '4014', 'CAZUELA DE RES CLASIFICADA', 1, 'pz'),
(93, 'PEDRO', '2025-08-25', '23:00:20', '4142', 'PULPA LARGA DE RES', 2, 'kg'),
(94, 'PEDRO', '2025-08-25', '23:00:20', '4144', 'PULPA NEGRA', 3, 'pz'),
(95, 'Admin', '2025-11-06', '22:45:02', '4014', 'CAZUELA DE RES CLASIFICADA', 20, 'kg'),
(96, 'Admin', '2025-11-06', '22:45:02', '4144', 'PULPA NEGRA', 30, 'kg'),
(97, 'Admin', '2025-11-06', '22:45:02', '4137', 'PIERNA DE PUERCO S/HUESO', 40, 'kg'),
(98, 'Admin', '2025-11-06', '22:45:02', '53758', 'BISTEC PICADO DE RES', 50, 'kg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '147852'),
(13, 'fernando', '123456'),
(15, 'pedro', '123456'),
(16, 'isabel', '123456'),
(18, 'elena', '123456'),
(19, 'luis', '123456'),
(25, 'francisco', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `add_product`
--
ALTER TABLE `add_product`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nuevo`
--
ALTER TABLE `nuevo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `registros_merma`
--
ALTER TABLE `registros_merma`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `add_product`
--
ALTER TABLE `add_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `nuevo`
--
ALTER TABLE `nuevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registros_merma`
--
ALTER TABLE `registros_merma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
