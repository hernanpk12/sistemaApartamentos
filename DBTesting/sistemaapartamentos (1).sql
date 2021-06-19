-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2021 a las 05:08:20
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

--
-- Base de datos: `sistemaapartamentos`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarMora` (IN `fecha` DATE)  NO SQL
BEGIN
    UPDATE factura SET mora=1 where DATEDIFF(fecha,fecha_creacion)>1 and pago=0 and mora=0 and estado=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GenerarFacturas` (IN `fecha` DATE)  BEGIN
	    UPDATE factura SET mora=1 where DATEDIFF(fecha,fecha_creacion)>1 and pago=0 and mora=0 and estado=1;

	INSERT INTO `factura`(`total`, `fecha_creacion`, `id_apartamento`,`pago` ,`estado`) 
		SELECT IF(AP.arrendado=0, AP.valor_cuota, AD.costo_administracion) AS total,
			NOW() AS fecha_creacion,AP.id_apartamento,0 as pago,1 as estado
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
(1, 20000, '2021-06-16', b'1');

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
(6, 40000, 1, 102, 5, 1, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamento_usuario`
--

CREATE TABLE `apartamento_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_apartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `mora` bit(1) NOT NULL,
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `total`, `fecha_creacion`, `id_apartamento`, `pago`, `mora`, `estado`) VALUES
(47, 20000, '2021-06-18', 4, b'0', b'0', b'1'),
(48, 20000, '2021-06-18', 6, b'0', b'0', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `email`, `contraseña`, `estado`) VALUES
(3, 'test', 'test', 'test@gmail.com', 'pass', b'1');

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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administracion`
--
ALTER TABLE `administracion`
  MODIFY `id_administracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `apartamentos`
--
ALTER TABLE `apartamentos`
  MODIFY `id_apartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `apartamento_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
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

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `ValidarFacturas` ON SCHEDULE EVERY 1 DAY STARTS '2021-06-18 16:26:51' ON COMPLETION NOT PRESERVE ENABLE DO call GenerarFacturas(now())$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
