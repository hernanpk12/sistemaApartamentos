-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2021 a las 05:16:56
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE OR REPLACE DATABASE `sistemaapartamentos`

--
-- Base de datos: `sistemaapartamentos`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GenerarFacturas` (IN `fecha` DATE)  BEGIN
	SELECT costo_administracion INTO @COSTO_ADMINISTRACION from administracion where estado=1;

	UPDATE factura SET mora=1 where DATEDIFF(fecha,fecha_creacion)>=1 and pago=0 and mora=0 and estado=1;

	INSERT INTO `factura`(`total`, `fecha_creacion`, `id_apartamento`,`pago` ,`estado`) 
		SELECT IF(AP.arrendado=0, AP.valor_cuota, @COSTO_ADMINISTRACION) AS total,
			fecha AS fecha_creacion,AP.id_apartamento,0 as pago,1 as estado
        FROM apartamentos AP INNER JOIN 
			administracion AD ON AD.id_administracion=AP.id_administracion
		WHERE AP.estado=1;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion`
--

CREATE TABLE `administracion` (
  `id_administracion` int(11) NOT NULL,
  `costo_administracion` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administracion`
--

INSERT INTO `administracion` (`id_administracion`, `costo_administracion`, `fecha_creacion`, `estado`) VALUES
(1, 20000, '2020-06-16', b'0'),
(4, 25000, '2021-06-22', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamentos`
--

CREATE TABLE `apartamentos` (
  `id_apartamento` int(11) NOT NULL,
  `valor_cuota` int(11) NOT NULL,
  `id_administracion` int(11) NOT NULL,
  `numero_apartamento` int(11) NOT NULL,
  `numero_personas` int(11) NOT NULL,
  `arrendado` int(11) DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `apartamentos`
--

INSERT INTO `apartamentos` (`id_apartamento`, `valor_cuota`, `id_administracion`, `numero_apartamento`, `numero_personas`, `arrendado`, `estado`) VALUES
(4, 30000, 1, 101, 3, 2, b'1'),
(6, 50000, 1, 102, 5, 1, b'1'),
(16, 12300, 1, 106, 5, 0, b'1'),
(17, 89000, 1, 201, 0, 0, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamento_usuario`
--

CREATE TABLE `apartamento_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_apartamento` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `apartamento_usuario`
--

INSERT INTO `apartamento_usuario` (`id_usuario`, `id_apartamento`, `estado`) VALUES
(3, 4, 1),
(3, 6, 1),
(3, 16, 1),
(9, 17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE `comprobante` (
  `id_comprobante` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `url_comprobante` int(11) NOT NULL,
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `id_apartamento` int(11) NOT NULL,
  `pago` bit(1) NOT NULL,
  `mora` bit(1) NOT NULL DEFAULT b'0',
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `total`, `fecha_creacion`, `id_apartamento`, `pago`, `mora`, `estado`) VALUES
(47, 20000, '2021-06-18', 4, b'0', b'1', b'1'),
(48, 20000, '2021-06-18', 6, b'0', b'1', b'1'),
(49, 20000, '2021-06-19', 4, b'0', b'1', b'1'),
(50, 20000, '2021-06-19', 6, b'0', b'1', b'1'),
(76, 25000, '2021-06-22', 4, b'0', b'0', b'1'),
(77, 25000, '2021-06-22', 6, b'0', b'0', b'1'),
(78, 12300, '2021-06-22', 16, b'0', b'0', b'1'),
(79, 89000, '2021-06-22', 17, b'0', b'0', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `identificacion` int(11) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(150) NOT NULL,
  `estado` bit(1) NOT NULL,
  `id_tipo_documento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `propietarios`
--

INSERT INTO `propietarios` (`id_usuario`, `nombre`, `apellidos`, `identificacion`, `telefono`, `email`, `estado`, `id_tipo_documento`) VALUES
(3, 'test', 'pap', 100277615, '90909090', 'zapatadani28@gmail.com', b'1', 1),
(9, 'Daniel', 'vvbvb', 3909090, '89898989', 'mariangelsc0605@gmail.com', b'1', 1),
(10, 'Raqueta', 'rtrtrt', 90909090, '89898989', 'daniel@gmail.com', b'1', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL,
  `Descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_documento`, `Descripcion`) VALUES
(1, 'cedula de ciudadania'),
(2, 'Tarjeta de identidad'),
(3, 'tarjeta de extranjeria');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD PRIMARY KEY (`id_administracion`);

--
-- Indices de la tabla `apartamentos`
--
ALTER TABLE `apartamentos`
  ADD PRIMARY KEY (`id_apartamento`),
  ADD UNIQUE KEY `numero_apartamento` (`numero_apartamento`),
  ADD KEY `id_administracion` (`id_administracion`) USING BTREE;

--
-- Indices de la tabla `apartamento_usuario`
--
ALTER TABLE `apartamento_usuario`
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE,
  ADD KEY `id_apartamento` (`id_apartamento`) USING BTREE;

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`id_comprobante`),
  ADD KEY `id_factura` (`id_factura`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_apartamento` (`id_apartamento`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `identificacion` (`identificacion`),
  ADD KEY `id_tipo_documento_2` (`id_tipo_documento`),
  ADD KEY `id_tipo_documento_3` (`id_tipo_documento`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administracion`
--
ALTER TABLE `administracion`
  MODIFY `id_administracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `apartamentos`
--
ALTER TABLE `apartamentos`
  MODIFY `id_apartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apartamentos`
--
ALTER TABLE `apartamentos`
  ADD CONSTRAINT `apartamentos_ibfk_2` FOREIGN KEY (`id_administracion`) REFERENCES `administracion` (`id_administracion`);

--
-- Filtros para la tabla `apartamento_usuario`
--
ALTER TABLE `apartamento_usuario`
  ADD CONSTRAINT `apartamento_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `propietarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `apartamento_usuario_ibfk_2` FOREIGN KEY (`id_apartamento`) REFERENCES `apartamentos` (`id_apartamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD CONSTRAINT `comprobante_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_apartamento`) REFERENCES `apartamentos` (`id_apartamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD CONSTRAINT `propietarios_ibfk_1` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documento` (`id_tipo_documento`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `ValidarFacturas` ON SCHEDULE EVERY 1 DAY STARTS '2021-06-18 08:00:00' ON COMPLETION NOT PRESERVE ENABLE DO call GenerarFacturas(now())$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
