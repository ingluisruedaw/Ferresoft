-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-06-2017 a las 19:58:47
-- Versión del servidor: 5.5.53
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ferresoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) NOT NULL,
  `det` varchar(100) NOT NULL,
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `det`, `estado_id`) VALUES
(1, 'CARPINTERIA', 1),
(2, 'CONSTRUCCION', 1),
(3, 'HOGAR', 1),
(4, 'PINTURERIA', 1),
(5, 'ELECTRICIDAD', 1),
(6, 'MAQUINAS Y HERRAMIENTAS', 1),
(7, 'TORNILLERIA', 1),
(8, 'PLOMERIA', 1),
(9, 'MOTORES', 1),
(10, 'SEGURIDAD', 1),
(11, 'SOGAS Y CADENAS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) NOT NULL,
  `persona_id` bigint(20) NOT NULL,
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `persona_id`, `estado_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 2),
(9, 4, 1),
(10, 3, 1),
(11, 1047611456, 1),
(12, 1156788541, 1),
(13, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` bigint(20) NOT NULL,
  `productos_id` int(10) NOT NULL,
  `proveedores_id` int(12) NOT NULL,
  `precio` double NOT NULL,
  `iva_id` bigint(20) NOT NULL,
  `cantidad` double NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `productos_id`, `proveedores_id`, `precio`, `iva_id`, `cantidad`, `fecha`, `estado_id`) VALUES
(19, 1, 3, 135000, 1, 100, '2017-05-29 05:00:00', 1),
(20, 4, 3, 30000, 2, 200, '2017-05-29 05:00:00', 1),
(21, 5, 4, 10000, 1, 500, '2017-05-29 05:00:00', 1),
(22, 1, 4, 500000, 2, 30, '2017-05-29 05:00:00', 1),
(23, 6, 6, 10000, 1, 1000, '2017-05-03 05:00:00', 1),
(24, 7, 8, 5000, 1, 50, '2017-05-30 05:00:00', 1),
(25, 8, 8, 8000, 1, 100, '2017-05-30 05:00:00', 1),
(26, 9, 8, 5000, 1, 20, '2017-05-30 05:00:00', 1),
(27, 11, 4, 1500, 2, 100, '2017-05-30 05:00:00', 1);

--
-- Disparadores `compras`
--
DELIMITER $$
CREATE TRIGGER `tCompraProductoStock` AFTER INSERT ON `compras` FOR EACH ROW BEGIN
DECLARE acantidad INT;
DECLARE aiva DOUBLE;
DECLARE aprecio DOUBLE;
DECLARE apretotal DOUBLE;
DECLARE aganancia DOUBLE;
DECLARE atotal DOUBLE;
SET @acantidad = (SELECT stockmin FROM productos WHERE id = NEW.productos_id);
SET @aprecio = NEW.precio;
SET @aganancia = (30/100);
SET @atotal = @aprecio * (1+@aganancia);
UPDATE productos SET stockmin = NEW.cantidad+@acantidad WHERE productos.id = NEW.productos_id;
INSERT INTO
  precio_venta(
  iva_id,
  productos_id,
  precio,
  neto)
VALUES(
  NEW.iva_id,
  NEW.productos_id,
  @aprecio,
  @atotal);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_factura`
--

CREATE TABLE `det_factura` (
  `id` bigint(20) NOT NULL,
  `factura_id` bigint(20) NOT NULL,
  `precio_venta_id` bigint(20) NOT NULL,
  `cantidad` double NOT NULL,
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `det_factura`
--

INSERT INTO `det_factura` (`id`, `factura_id`, `precio_venta_id`, `cantidad`, `estado_id`) VALUES
(35, 23, 14, 100, 4),
(36, 23, 15, 100, 4),
(37, 23, 16, 250, 4),
(38, 24, 14, 50, 4),
(39, 24, 15, 100, 4),
(40, 24, 16, 250, 4),
(41, 25, 15, 1, 1),
(42, 25, 15, 1, 1),
(43, 26, 18, 50, 5),
(44, 27, 21, 1, 1),
(45, 27, 21, 1, 1),
(46, 27, 17, 1, 1),
(47, 28, 18, 1, 1),
(48, 28, 21, 1, 1),
(49, 30, 20, 1, 5),
(50, 31, 16, 1, 1),
(51, 31, 17, 2, 1),
(52, 31, 21, 1, 1),
(53, 32, 18, 2, 1),
(54, 32, 19, 3, 1),
(55, 33, 20, 1, 1),
(56, 33, 18, 5, 1),
(57, 34, 21, 12, 1),
(58, 36, 16, 1, 1),
(59, 37, 22, 10, 5),
(60, 38, 16, 1, 4),
(61, 40, 16, 1, 5),
(63, 40, 16, 9, 5),
(64, 46, 16, 0, 4),
(65, 48, 16, 10, 1),
(66, 49, 20, 2, 1),
(67, 49, 20, 3, 1),
(68, 49, 17, 33, 1);

--
-- Disparadores `det_factura`
--
DELIMITER $$
CREATE TRIGGER `tDevolverProductos` AFTER UPDATE ON `det_factura` FOR EACH ROW BEGIN
	DECLARE aprecio BIGINT;
    DECLARE aproducto BIGINT;
    DECLARE acantidad INT;
    DECLARE cantidad_antes INT;
	SET @aprecio = NEW.estado_id;
    SET @producto = (SELECT productos_id FROM precio_venta WHERE id = NEW.precio_venta_id);
    SET @cantidad_antes = (SELECT stockmin FROM productos WHERE productos.id = @producto);
    SET @acantidad = NEW.cantidad;
    IF @aestado = 2 THEN
    	UPDATE productos SET stockmin = @cantidad_antes+@acantidad WHERE id = @producto;
    ELSEIF @aestado = 4 THEN
    	UPDATE productos SET stockmin = @cantidad_antes+@acantidad WHERE id = @producto;
    END IF;
    
    IF @aestado = 1 THEN
        UPDATE productos SET stockmin = @cantidad_antes-NEW.cantidad WHERE id = @producto;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `embalaje`
--

CREATE TABLE `embalaje` (
  `id` bigint(20) NOT NULL,
  `det` varchar(100) NOT NULL,
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `embalaje`
--

INSERT INTO `embalaje` (`id`, `det`, `estado_id`) VALUES
(1, 'BOTELLA', 1),
(2, 'GALON', 1),
(3, 'CAJA', 1),
(4, 'UNIDAD', 1),
(5, 'UNIDAD', 2),
(6, 'PRUEBA', 2),
(7, '0', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint(20) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `fingreso` date NOT NULL,
  `persona_id` bigint(20) NOT NULL,
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `cargo`, `fingreso`, `persona_id`, `estado_id`) VALUES
(1, 'Webmaster', '2017-02-02', 1, 1),
(4, 'Inventario', '2017-05-28', 2, 1),
(5, 'Facturación', '2017-05-29', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` bigint(20) NOT NULL,
  `det` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `det`) VALUES
(1, 'ACTIVO'),
(2, 'ELIMINADO'),
(3, 'NO VIGENTE'),
(4, 'ANULADO'),
(5, 'FACTURA EN PROCESO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` bigint(20) NOT NULL,
  `empleados_id` bigint(20) NOT NULL,
  `clientes_id` bigint(20) NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total` double DEFAULT '0',
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `empleados_id`, `clientes_id`, `fecha`, `total`, `estado_id`) VALUES
(23, 4, 11, '2017-05-29 05:00:00', 0, 4),
(24, 4, 11, '2017-05-29 05:00:00', 15925000, 4),
(25, 1, 9, '2017-05-29 05:00:00', 78000, 1),
(26, 4, 12, '2017-05-29 05:00:00', 0, 5),
(27, 5, 10, '2017-05-30 05:00:00', 663000, 1),
(28, 5, 12, '2017-05-30 05:00:00', 19500, 1),
(29, 4, 10, '2017-05-30 05:00:00', 0, 5),
(30, 1, 1, '2017-05-30 05:00:00', 0, 5),
(31, 4, 1, '2017-05-30 05:00:00', 1319500, 1),
(32, 1, 1, '2017-05-29 05:00:00', 45500, 1),
(33, 5, 12, '2017-05-30 05:00:00', 75400, 1),
(34, 5, 10, '2017-05-30 05:00:00', 78000, 1),
(35, 5, 9, '2017-05-30 05:00:00', 0, 5),
(36, 1, 1, '2017-11-30 05:00:00', 13000, 1),
(37, 5, 1, '2017-05-10 05:00:00', 0, 5),
(38, 5, 1, '2017-12-31 05:00:00', 13000, 4),
(39, 5, 1, '2015-10-29 05:00:00', 0, 4),
(40, 1, 1, '2017-05-31 05:00:00', 0, 5),
(44, 1, 1, '2017-05-20 05:00:00', 0, 4),
(45, 1, 1, '2017-05-07 05:00:00', 0, 4),
(46, 1, 1, '2017-05-19 05:00:00', 0, 4),
(47, 1, 1, '2017-05-19 05:00:00', 0, 5),
(48, 1, 1, '2017-05-13 05:00:00', 130000, 1),
(49, 4, 10, '2017-06-01 05:00:00', 21502000, 1);

--
-- Disparadores `factura`
--
DELIMITER $$
CREATE TRIGGER `tFacturaAnular` AFTER UPDATE ON `factura` FOR EACH ROW BEGIN
	DECLARE aestado BIGINT;
	SET @aestado = NEW.estado_id;
    IF @aestado = 2 THEN
    	UPDATE det_factura SET estado_id = @aestado WHERE det_factura.factura_id = new.id;
    ELSEIF @aestado = 4 THEN
    	UPDATE det_factura SET estado_id = @aestado WHERE det_factura.factura_id = new.id;
    END IF;
    
    IF @aestado = 1 THEN
    	UPDATE det_factura SET estado_id = @aestado WHERE det_factura.factura_id = NEW.id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iva`
--

CREATE TABLE `iva` (
  `id` bigint(20) NOT NULL,
  `det` double NOT NULL,
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `iva`
--

INSERT INTO `iva` (`id`, `det`, `estado_id`) VALUES
(1, 19, 1),
(2, 5, 1),
(3, 16, 1),
(4, 10, 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `new_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `new_view` (
`empleado` varchar(255)
,`cliente` varchar(255)
,`FECHA` timestamp
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` bigint(20) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombres`, `direccion`, `telefono`, `correo`) VALUES
(0, 'aaa', 'aaaa', 123, 'aaaa'),
(1, 'c', 'asas', 0, 'factura@ferresoft.com'),
(2, 'Elver Salcedo', 'calle 8#72-15', 3321245, 'elversalc@gmail.com'),
(3, 'camilo', 'asas', 0, 'factura@ferresoft.com'),
(4, 'pwned', 'asas', 0, '_'),
(1047611456, 'LIONEL MESSI', 'CALLE 106 N 56 - 99', 3568901, '---'),
(1156788541, 'DAVID NARVAEZ BARRIOS', 'CRA 78 N 44 99', 3550966, 'DNARVAEZB@HOTMAIL.COM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio_venta`
--

CREATE TABLE `precio_venta` (
  `id` bigint(20) NOT NULL,
  `iva_id` bigint(20) DEFAULT NULL,
  `productos_id` int(10) NOT NULL,
  `precio` double DEFAULT NULL,
  `neto` double DEFAULT NULL,
  `estado_id` bigint(20) NOT NULL DEFAULT '1',
  `fecha_activacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_cancelado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `precio_venta`
--

INSERT INTO `precio_venta` (`id`, `iva_id`, `productos_id`, `precio`, `neto`, `estado_id`, `fecha_activacion`, `fecha_cancelado`) VALUES
(14, 1, 1, 135000, 175500, 3, '2017-05-29 20:10:58', '2017-05-29 23:58:23'),
(15, 2, 4, 30000, 39000, 3, '2017-05-29 20:12:19', '2017-05-29 23:31:58'),
(16, 1, 5, 10000, 13000, 1, '2017-05-29 20:12:48', NULL),
(17, 2, 1, 500000, 650000, 1, '2017-05-29 23:31:16', NULL),
(18, 1, 6, 10000, 13000, 1, '2017-05-29 23:36:02', NULL),
(19, 1, 7, 5000, 6500, 1, '2017-05-30 13:31:43', NULL),
(20, 1, 8, 8000, 10400, 1, '2017-05-30 13:39:58', NULL),
(21, 1, 9, 5000, 6500, 1, '2017-05-30 13:40:26', NULL),
(22, 2, 11, 1500, 1950, 1, '2017-05-31 00:54:31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `stockmin` int(10) NOT NULL,
  `embalaje_id` bigint(20) NOT NULL,
  `categorias_id` bigint(20) NOT NULL,
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `stockmin`, `embalaje_id`, `categorias_id`, `estado_id`) VALUES
(1, 'SIERRA BLACK+DECKER', 94, 4, 1, 1),
(4, 'SERRUCHO BLACK+DECKER', 198, 4, 1, 1),
(5, 'MARTILLO ELECTRICO ECONOMICO', 488, 4, 3, 1),
(6, 'CEMENTO ARGOS X 50 KG', 992, 4, 2, 1),
(7, 'CANDADO STANLEY CUELLO STANDARD', 47, 4, 10, 1),
(8, 'CANDADO YALE TIPO ALEMAN', 94, 4, 10, 1),
(9, 'TORNILLO ROSCADO 5/8 10UNID', 4, 3, 7, 1),
(10, 'CLAVOS DE ACERO 3\'\'', 0, 4, 1, 1),
(11, 'BLOCK SAMO', 100, 4, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(12) NOT NULL,
  `det` varchar(80) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `det`, `direccion`, `telefono`, `email`, `estado_id`) VALUES
(3, 'RUKIM', 'Av. Murillo #Km. 4, Soledad, Atlántico', 3282000, 'admin@ruquim.com.co', 1),
(4, 'FERRETERIA LARA', 'Cl 75 48-13 Barranquilla, Colombia', 3565544, 'admin@ferreteriarueda.com', 1),
(5, 'demo', '1234', 1234, 'kljkjk@demo.com', 2),
(6, 'ARGOS', 'VIA 40', 3212345, 'ARGOS@ARGOS.COM', 1),
(7, 'FERRETERIA SAMIR', 'CALLE 84 N 43 77', 3440955, 'INFO@SAMIR.COM', 1),
(8, 'DISTRIFEREETERIA ATLANTICO', 'VIA 40 CALLE 89', 3445321, 'INFO@DISTRIFER.COM.CO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `det` varchar(100) NOT NULL,
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `det`, `estado_id`) VALUES
(1, 'SUPERUSUARIO', 1),
(2, 'FACTURA', 1),
(3, 'INVENTARIO', 1),
(4, 'prueba', 2),
(5, 'sd', 2),
(6, 'SS', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `roles_id` bigint(20) NOT NULL,
  `empleados_id` bigint(20) NOT NULL,
  `estado_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `clave`, `roles_id`, `empleados_id`, `estado_id`) VALUES
('administrador', '$2y$10$FGaoJn8.lKbUUeZyUUuoAe/sJM2YRtd/mZOrHSDtu.Oqp4r49.Qoq', 1, 1, 1),
('facturacion', '$2y$10$JZ6evj4Kiibq7B8xefG2L.WuKQuF6cWfW7tidRnsfT2XkfGpOH6lC', 2, 5, 1),
('inventario', '$2y$10$QPOGT8aR.iyHbw3TauPVbuPVPrgpapoYNJcwEBUzbrG8vAH7saKXe', 3, 4, 1),
('sergio', '$2y$10$wk58ThiJ7HdP310YPvUcMu9POKy4yE7xyh0pCguwQ.0nTYfef4bnC', 2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura para la vista `new_view`
--
DROP TABLE IF EXISTS `new_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ferresoft`@`%` SQL SECURITY DEFINER VIEW `new_view`  AS  select `persona`.`nombres` AS `empleado`,`persona1`.`nombres` AS `cliente`,`factura`.`fecha` AS `FECHA` from ((((`factura` join `empleados` on((`factura`.`empleados_id` = `empleados`.`id`))) join `clientes` on((`factura`.`clientes_id` = `clientes`.`id`))) join `persona` on((`empleados`.`persona_id` = `persona`.`id`))) join `persona` `persona1` on((`clientes`.`persona_id` = `persona1`.`id`))) where (`factura`.`id` = 33) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categorias_estado1_idx` (`estado_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clientes_persona1_idx` (`persona_id`),
  ADD KEY `fk_clientes_estado1_idx` (`estado_id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_has_proveedores_proveedores1_idx` (`proveedores_id`),
  ADD KEY `fk_productos_has_proveedores_productos1_idx` (`productos_id`),
  ADD KEY `fk_compras_estado1_idx` (`estado_id`),
  ADD KEY `fk_productos_has_iva_idx` (`iva_id`);

--
-- Indices de la tabla `det_factura`
--
ALTER TABLE `det_factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_det_factura_factura1_idx` (`factura_id`),
  ADD KEY `fk_det_factura_precio_venta1_idx` (`precio_venta_id`),
  ADD KEY `fk_det_factura_estado1_idx` (`estado_id`);

--
-- Indices de la tabla `embalaje`
--
ALTER TABLE `embalaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_embalaje_estado1_idx` (`estado_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empleados_persona_idx` (`persona_id`),
  ADD KEY `fk_empleados_estado1_idx` (`estado_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_factura_empleados1_idx` (`empleados_id`),
  ADD KEY `fk_factura_clientes1_idx` (`clientes_id`),
  ADD KEY `fk_factura_estado1_idx` (`estado_id`);

--
-- Indices de la tabla `iva`
--
ALTER TABLE `iva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_iva_estado1_idx` (`estado_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precio_venta`
--
ALTER TABLE `precio_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_precio_iva1_idx` (`iva_id`),
  ADD KEY `fk_precio_productos1_idx` (`productos_id`),
  ADD KEY `fk_precio_venta_estado1_idx` (`estado_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_categorias1_idx` (`categorias_id`),
  ADD KEY `fk_productos_embalaje1_idx` (`embalaje_id`),
  ADD KEY `fk_productos_estado1_idx` (`estado_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_proveedores_estado1_idx` (`estado_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_roles_estado1_idx` (`estado_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`),
  ADD KEY `fk_usuario_roles1_idx` (`roles_id`),
  ADD KEY `fk_usuario_empleados1_idx` (`empleados_id`),
  ADD KEY `fk_usuario_estado1_idx` (`estado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `det_factura`
--
ALTER TABLE `det_factura`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT de la tabla `embalaje`
--
ALTER TABLE `embalaje`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `iva`
--
ALTER TABLE `iva`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `precio_venta`
--
ALTER TABLE `precio_venta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categorias_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clientes_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_iva` FOREIGN KEY (`iva_id`) REFERENCES `iva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_proveedores_productos1` FOREIGN KEY (`productos_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_proveedores_proveedores1` FOREIGN KEY (`proveedores_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `det_factura`
--
ALTER TABLE `det_factura`
  ADD CONSTRAINT `fk_det_factura_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_det_factura_factura1` FOREIGN KEY (`factura_id`) REFERENCES `factura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_det_factura_precio_venta1` FOREIGN KEY (`precio_venta_id`) REFERENCES `precio_venta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `embalaje`
--
ALTER TABLE `embalaje`
  ADD CONSTRAINT `fk_embalaje_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_empleados_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empleados_persona` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_factura_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_factura_empleados1` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_factura_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `iva`
--
ALTER TABLE `iva`
  ADD CONSTRAINT `fk_iva_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `precio_venta`
--
ALTER TABLE `precio_venta`
  ADD CONSTRAINT `fk_precio_iva1` FOREIGN KEY (`iva_id`) REFERENCES `iva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_precio_productos1` FOREIGN KEY (`productos_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_precio_venta_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categorias1` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_embalaje1` FOREIGN KEY (`embalaje_id`) REFERENCES `embalaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `fk_proveedores_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `fk_roles_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_empleados1` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_estado1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
