-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-08-2022 a las 04:34:38
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nativo_digital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agente`
--

CREATE TABLE `agente` (
  `id_agente` int(11) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fecha_alta` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `agente`
--

INSERT INTO `agente` (`id_agente`, `nombre_completo`, `email`, `password`, `fecha_alta`, `status`) VALUES
(1, 'didier pech', 'didierpech96@gmail.com', '1c06b4ea2b9c4705aebc21fbb0ae43f5e6c108f4', '2022-08-19 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asegurado`
--

CREATE TABLE `asegurado` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `edad` int(3) NOT NULL,
  `id_poliza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asegurado`
--

INSERT INTO `asegurado` (`id`, `nombre_completo`, `edad`, `id_poliza`) VALUES
(1, 'didier pech123', 26, 1),
(2, 'uriel', 0, 1),
(3, 'didier pech123', 2, 2),
(4, 'uriel', 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_agente` int(11) NOT NULL,
  `fecha_alta` date NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_completo`, `telefono`, `email`, `id_agente`, `fecha_alta`, `status`) VALUES
(1, 'didier uriel', '9999604409', 'didierpech96@gmail.com', 1, '2022-08-21', 1),
(2, 'didier uriel2', '9999604409', 'didierpech96@gmail.com', 1, '2022-08-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poliza`
--

CREATE TABLE `poliza` (
  `id_poliza` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_vigencia` date NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `aseguradora` varchar(150) NOT NULL,
  `tipo_poliza` int(11) NOT NULL,
  `precio` double(12,2) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 - vigente, 0 - vencida',
  `id_agente` int(11) NOT NULL,
  `numero_poliza` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `poliza`
--

INSERT INTO `poliza` (`id_poliza`, `fecha_inicio`, `fecha_vigencia`, `id_cliente`, `aseguradora`, `tipo_poliza`, `precio`, `status`, `id_agente`, `numero_poliza`) VALUES
(1, '2022-01-01', '2022-08-31', 1, 'omega', 1, 2000.00, 1, 1, '1234567890'),
(2, '2022-01-01', '2022-09-01', 1, 'omega', 1, 2000.00, 1, 1, '1234567890');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_poliza`
--

CREATE TABLE `tipo_poliza` (
  `id` int(11) NOT NULL,
  `tipo_poliza` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_poliza`
--

INSERT INTO `tipo_poliza` (`id`, `tipo_poliza`) VALUES
(1, 'Gastos medicos'),
(2, 'Auto'),
(3, 'Seguro de vida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token_rest`
--

CREATE TABLE `token_rest` (
  `token` varchar(100) NOT NULL,
  `vigencia` datetime NOT NULL DEFAULT current_timestamp(),
  `id_agente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `token_rest`
--

INSERT INTO `token_rest` (`token`, `vigencia`, `id_agente`) VALUES
('3e64427b855503098d9e62910343ba0f8dfb16e8', '2022-08-21 21:30:03', 1),
('83329c3fee117dcd10cf24d68f1d45543e3082bb', '2022-08-21 20:31:08', 1),
('da13e74504c2978fb3a6e5cfbda53d4414377202', '2022-08-21 20:32:16', 1),
('dc6b55f05bd1cb33dfd72071ef381ac6cf524a38', '2022-08-21 20:31:19', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agente`
--
ALTER TABLE `agente`
  ADD PRIMARY KEY (`id_agente`);

--
-- Indices de la tabla `asegurado`
--
ALTER TABLE `asegurado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_poliza_asegurado` (`id_poliza`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD UNIQUE KEY `unico_cliente_agente` (`id_cliente`,`id_agente`),
  ADD KEY `fk_cliente_agente` (`id_agente`);

--
-- Indices de la tabla `poliza`
--
ALTER TABLE `poliza`
  ADD PRIMARY KEY (`id_poliza`),
  ADD KEY `fk_poliza_cliente` (`id_cliente`),
  ADD KEY `fk_poliza_agente` (`id_agente`),
  ADD KEY `fk_tipo_poliza` (`tipo_poliza`);

--
-- Indices de la tabla `tipo_poliza`
--
ALTER TABLE `tipo_poliza`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `token_rest`
--
ALTER TABLE `token_rest`
  ADD PRIMARY KEY (`token`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agente`
--
ALTER TABLE `agente`
  MODIFY `id_agente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asegurado`
--
ALTER TABLE `asegurado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `poliza`
--
ALTER TABLE `poliza`
  MODIFY `id_poliza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_poliza`
--
ALTER TABLE `tipo_poliza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asegurado`
--
ALTER TABLE `asegurado`
  ADD CONSTRAINT `fk_poliza_asegurado` FOREIGN KEY (`id_poliza`) REFERENCES `poliza` (`id_poliza`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_agente` FOREIGN KEY (`id_agente`) REFERENCES `agente` (`id_agente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `poliza`
--
ALTER TABLE `poliza`
  ADD CONSTRAINT `fk_poliza_agente` FOREIGN KEY (`id_agente`) REFERENCES `agente` (`id_agente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_poliza_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_poliza` FOREIGN KEY (`tipo_poliza`) REFERENCES `tipo_poliza` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
