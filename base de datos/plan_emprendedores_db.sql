-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-11-2019 a las 22:34:08
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `plan_emprendedores_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cooperante`
--

DROP TABLE IF EXISTS `cooperante`;
CREATE TABLE IF NOT EXISTS `cooperante` (
  `id_cooperante` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cooperante` text COLLATE utf8_spanish_ci NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `tipo_ayuda` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `id_emprendedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_cooperante`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cooperante`
--

INSERT INTO `cooperante` (`id_cooperante`, `nombre_cooperante`, `monto`, `tipo_ayuda`, `fecha_ingreso`, `id_emprendedor`, `id_usuario`) VALUES
(2, 'rty', '852.00', 'Materia Prima', '2019-11-04', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre`) VALUES
(1, 'AHUACHAPÁN'),
(2, 'CABAÑAS'),
(3, 'CHALATENANGO'),
(4, 'CUSCATLÁN'),
(5, 'LA LIBERTAD'),
(6, 'LA PAZ'),
(7, 'LA UNIÓN'),
(8, 'MORAZÁN'),
(9, 'SAN MIGUEL'),
(10, 'SAN SALVADOR'),
(11, 'SAN VICENTE'),
(12, 'SANTA ANA'),
(13, 'SONSONATE'),
(14, 'USULUTÁN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emprendedor`
--

DROP TABLE IF EXISTS `emprendedor`;
CREATE TABLE IF NOT EXISTS `emprendedor` (
  `id_emprendedor` int(11) NOT NULL AUTO_INCREMENT,
  `institucion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `responsable` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8_spanish_ci NOT NULL,
  `dui` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `comunidad` text COLLATE utf8_spanish_ci NOT NULL,
  `canton` text COLLATE utf8_spanish_ci NOT NULL,
  `departamento` text COLLATE utf8_spanish_ci NOT NULL,
  `municipio` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `correo` text COLLATE utf8_spanish_ci NOT NULL,
  `profesion` text COLLATE utf8_spanish_ci NOT NULL,
  `nivel_escolar` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre_organizacion` text COLLATE utf8_spanish_ci NOT NULL,
  `actividad_eco` text COLLATE utf8_spanish_ci NOT NULL,
  `tipo_local` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL,
  `act_eco_prin_de` text COLLATE utf8_spanish_ci NOT NULL,
  `infraestructura` text COLLATE utf8_spanish_ci NOT NULL,
  `equipo` text COLLATE utf8_spanish_ci NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `recursos_humanos` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil_cliente` text COLLATE utf8_spanish_ci NOT NULL,
  `mercado_objetivo` text COLLATE utf8_spanish_ci NOT NULL,
  `competencia_mercado` text COLLATE utf8_spanish_ci NOT NULL,
  `situacion_legal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_comercial` text COLLATE utf8_spanish_ci NOT NULL,
  `nit_negocio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cuenta_bancaria` text COLLATE utf8_spanish_ci NOT NULL,
  `matricula_comercio` text COLLATE utf8_spanish_ci NOT NULL,
  `factura` text COLLATE utf8_spanish_ci NOT NULL,
  `registro_iva` text COLLATE utf8_spanish_ci NOT NULL,
  `act_eco_prin_sl` text COLLATE utf8_spanish_ci NOT NULL,
  `otra` text COLLATE utf8_spanish_ci NOT NULL,
  `limitaciones` text COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_emprendedor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `emprendedor`
--

INSERT INTO `emprendedor` (`id_emprendedor`, `institucion`, `responsable`, `fecha_ingreso`, `nombre`, `apellido`, `dui`, `nit`, `fecha_nacimiento`, `comunidad`, `canton`, `departamento`, `municipio`, `telefono`, `correo`, `profesion`, `nivel_escolar`, `nombre_organizacion`, `actividad_eco`, `tipo_local`, `fecha_inicio`, `latitud`, `longitud`, `act_eco_prin_de`, `infraestructura`, `equipo`, `productos`, `recursos_humanos`, `perfil_cliente`, `mercado_objetivo`, `competencia_mercado`, `situacion_legal`, `nombre_comercial`, `nit_negocio`, `cuenta_bancaria`, `matricula_comercio`, `factura`, `registro_iva`, `act_eco_prin_sl`, `otra`, `limitaciones`, `id_usuario`) VALUES
(1, 'ABC', 'Luis Escamilla', '2019-11-04', 'Margarita ConcepciÃ³n', 'Beltran Ramirez', '75963524-1', '1004-789655-889-9', '2000-02-15', 'Local', 'Santa Lucia', '11', '199', '[\"7896-8574\"]', 'margarita@gmail.com', 'secretaria', 'bachiller', 'No', 'administracion', 'Propio', '2019-11-13', 13.649320265505045, -88.83139876331785, 'oficinista', 'propia', 'propio', 'administracion', 'propios', 'afasdfds', 'afgsdfg', 'fdvxdfvdf', 'Arrendado', '789999', '1544-615268-665-1', '05421655', '2365555', '2565', '65655', '51656hbzfv', 'nnbdfjvhbsjdfhbv', 'hb xjhbvshdfvbsdfh', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `financiamiento`
--

DROP TABLE IF EXISTS `financiamiento`;
CREATE TABLE IF NOT EXISTS `financiamiento` (
  `id_financiamiento` int(11) NOT NULL AUTO_INCREMENT,
  `propio` decimal(10,2) NOT NULL,
  `credito` decimal(10,2) NOT NULL,
  `sub_vencion` decimal(10,2) NOT NULL,
  `otro` decimal(10,2) NOT NULL,
  `id_emprendedor` int(11) NOT NULL,
  PRIMARY KEY (`id_financiamiento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `financiamiento`
--

INSERT INTO `financiamiento` (`id_financiamiento`, `propio`, `credito`, `sub_vencion`, `otro`, `id_emprendedor`) VALUES
(1, '100.00', '0.00', '0.00', '0.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

DROP TABLE IF EXISTS `institucion`;
CREATE TABLE IF NOT EXISTS `institucion` (
  `id_institucion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `areas_trabajo` text COLLATE utf8_spanish_ci NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_institucion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id_institucion`, `nombre`, `areas_trabajo`, `id_departamento`, `id_municipio`, `estado`, `id_usuario`) VALUES
(1, 'ASREDR', 'financiero, rr. hh.', 11, 210, 'Inactivo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

DROP TABLE IF EXISTS `municipios`;
CREATE TABLE IF NOT EXISTS `municipios` (
  `id_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8 NOT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`id_municipio`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id_municipio`, `nombre`, `id_departamento`) VALUES
(1, 'AHUACHAPÁN', 1),
(2, 'APANECA', 1),
(3, 'ATIQUIZAYA', 1),
(4, 'CONCEPCIÓN DE ATACO', 1),
(5, 'EL REFUGIO', 1),
(6, 'GUAYMANGO', 1),
(7, 'JUJUTLA', 1),
(8, 'SAN FRANCISCO MENÉNDEZ', 1),
(9, 'SAN LORENZO', 1),
(10, 'SAN PEDRO PUXTLA', 1),
(11, 'TACUBA', 1),
(12, 'TURÍN', 1),
(13, 'CINQUERA', 2),
(14, 'DOLORES', 2),
(15, 'GUACOTECTI', 2),
(16, 'ILOBASCO', 2),
(17, 'JUTIAPA', 2),
(18, 'SAN ISIDRO', 2),
(19, 'SENSUNTEPEQUE', 2),
(20, 'TEJUTEPEQUE', 2),
(21, 'VICTORIA', 2),
(22, 'AGUA CALIENTE', 3),
(23, 'ARCATAO', 3),
(24, 'AZACUALPA', 3),
(25, 'CANCASQUE', 3),
(26, 'CHALATENANGO', 3),
(27, 'CITALÁ', 3),
(28, 'COMALAPA', 3),
(29, 'CONCEPCIÓN QUEZALTEPEQUE', 3),
(30, 'DULCE NOMBRE DE MARÍA', 3),
(31, 'EL CARRIZAL', 3),
(32, 'EL PARAÍSO', 3),
(33, 'LA LAGUNA', 3),
(34, 'LA PALMA', 3),
(35, 'LA REINA', 3),
(36, 'LAS FLORES', 3),
(37, 'LAS VUELTAS', 3),
(38, 'NOMBRE DE JESÚS', 3),
(39, 'NUEVA CONCEPCIÓN', 3),
(40, 'NUEVA TRINIDAD', 3),
(41, 'OJOS DE AGUA', 3),
(42, 'POTONICO', 3),
(43, 'SAN ANTONIO DE LA CRUZ', 3),
(44, 'SAN ANTONIO LOS RANCHOS', 3),
(45, 'SAN FERNANDO', 3),
(46, 'SAN FRANCISCO LEMPA', 3),
(47, 'SAN FRANCISCO MORAZÁN', 3),
(48, 'SAN IGNACIO', 3),
(49, 'SAN ISIDRO LABRADOR', 3),
(50, 'SAN LUIS DEL CARMEN', 3),
(51, 'SAN MIGUEL DE MERCEDES', 3),
(52, 'SAN RAFAEL', 3),
(53, 'SANTA RITA', 3),
(54, 'TEJUTLA', 3),
(55, 'CANDELARIA', 4),
(56, 'COJUTEPEQUE', 4),
(57, 'EL CARMEN', 4),
(58, 'EL ROSARIO', 4),
(59, 'MONTE SAN JUAN', 4),
(60, 'ORATORIO DE CONCEPCIÓN', 4),
(61, 'SAN BARTOLOMÉ PERULAPÍA', 4),
(62, 'SAN CRISTÓBAL', 4),
(63, 'SAN JOSÉ GUAYABAL', 4),
(64, 'SAN PEDRO PERULAPÁN', 4),
(65, 'SAN RAFAEL CEDROS', 4),
(66, 'SAN RAMÓN', 4),
(67, 'SANTA CRUZ ANALQUITO', 4),
(68, 'SANTA CRUZ MICHAPA', 4),
(69, 'SUCHITOTO', 4),
(70, 'TENANCINGO', 4),
(71, 'ANTIGUO CUSCATLÁN', 5),
(72, 'CHILTIUPÁN', 5),
(73, 'CIUDAD ARCE', 5),
(74, 'COLÓN', 5),
(75, 'COMASAGUA', 5),
(76, 'HUIZÚCAR', 5),
(77, 'JAYAQUE', 5),
(78, 'JICALAPA', 5),
(79, 'LA LIBERTAD', 5),
(80, 'NUEVO CUSCATLÁN', 5),
(81, 'QUEZALTEPEQUE', 5),
(82, 'SACACOYO', 5),
(83, 'SAN JOSÉ VILLANUEVA', 5),
(84, 'SAN JUAN OPICO', 5),
(85, 'SAN MATÍAS', 5),
(86, 'SAN PABLO TACACHICO', 5),
(87, 'SANTA TECLA', 5),
(88, 'TALNIQUE', 5),
(89, 'TAMANIQUE', 5),
(90, 'TEOTEPEQUE', 5),
(91, 'TEPECOYO', 5),
(92, 'ZARAGOZA', 5),
(93, 'CUYULTITÁN', 6),
(94, 'EL ROSARIO', 6),
(95, 'JERUSALÉN', 6),
(96, 'MERCEDES LA CEIBA', 6),
(97, 'OLOCUILTA', 6),
(98, 'PARAÍSO DE OSORIO', 6),
(99, 'SAN ANTONIO MASAHUAT', 6),
(100, 'SAN EMIGDIO', 6),
(101, 'SAN FRANCISCO CHINAMECA', 6),
(102, 'SAN JUAN NONUALCO', 6),
(103, 'SAN JUAN TALPA', 6),
(104, 'SAN JUAN TEPEZONTES', 6),
(105, 'SAN LUIS LA HERRADURA', 6),
(106, 'SAN LUIS TALPA', 6),
(107, 'SAN MIGUEL TEPEZONTES', 6),
(108, 'SAN PEDRO MASAHUAT', 6),
(109, 'SAN PEDRO NONUALCO', 6),
(110, 'SAN RAFAEL OBRAJUELO', 6),
(111, 'SANTA MARÍA OSTUMA', 6),
(112, 'SANTIAGO NONUALCO', 6),
(113, 'TAPALHUACA', 6),
(114, 'ZACATECOLUCA', 6),
(115, 'ANAMORÓS', 7),
(116, 'BOLÍVAR', 7),
(117, 'CONCEPCIÓN DE ORIENTE', 7),
(118, 'CONCHAGUA', 7),
(119, 'EL CARMEN', 7),
(120, 'EL SAUCE', 7),
(121, 'INTIPUCÁ', 7),
(122, 'LA UNIÓN', 7),
(123, 'LISLIQUE', 7),
(124, 'MEANGUERA DEL GOLFO', 7),
(125, 'NUEVA ESPARTA', 7),
(126, 'PASAQUINA', 7),
(127, 'POLORÓS', 7),
(128, 'SAN ALEJO', 7),
(129, 'SAN JOSÉ', 7),
(130, 'SANTA ROSA DE LIMA', 7),
(131, 'YAYANTIQUE', 7),
(132, 'YUCUAIQUÍN', 7),
(133, 'ARAMBALA', 8),
(134, 'CACAOPERA', 8),
(135, 'CHILANGA', 8),
(136, 'CORINTO', 8),
(137, 'DELICIAS DE CONCEPCIÓN', 8),
(138, 'EL DIVISADERO', 8),
(139, 'EL ROSARIO', 8),
(140, 'GUALOCOCTI', 8),
(141, 'GUATAJIAGUA', 8),
(142, 'JOATECA', 8),
(143, 'JOCOAITIQUE', 8),
(144, 'JOCORO', 8),
(145, 'LOLOTIQUILLO', 8),
(146, 'MEANGUERA', 8),
(147, 'OSICALA', 8),
(148, 'PERQUÍN', 8),
(149, 'SAN CARLOS', 8),
(150, 'SAN FERNANDO', 8),
(151, 'SAN FRANCISCO GOTERA', 8),
(152, 'SAN ISIDRO', 8),
(153, 'SAN SIMÓN', 8),
(154, 'SENSEMBRA', 8),
(155, 'SOCIEDAD', 8),
(156, 'TOROLA', 8),
(157, 'YAMABAL', 8),
(158, 'YOLOAIQUÍN', 8),
(159, 'CAROLINA', 9),
(160, 'CHAPELTIQUE', 9),
(161, 'CHINAMECA', 9),
(162, 'CHIRILAGUA', 9),
(163, 'CIUDAD BARRIOS', 9),
(164, 'COMACARÁN', 9),
(165, 'EL TRÁNSITO', 9),
(166, 'LOLOTIQUE', 9),
(167, 'MONCAGUA', 9),
(168, 'NUEVA GUADALUPE', 9),
(169, 'NUEVO EDÉN DE SAN JUAN', 9),
(170, 'QUELEPA', 9),
(171, 'SAN ANTONIO', 9),
(172, 'SAN GERARDO', 9),
(173, 'SAN JORGE', 9),
(174, 'SAN LUIS DE LA REINA', 9),
(175, 'SAN MIGUEL', 9),
(176, 'SAN RAFAEL ORIENTE', 9),
(177, 'SESORI', 9),
(178, 'ULUAZAPA', 9),
(179, 'AGUILARES', 10),
(180, 'APOPA', 10),
(181, 'AYUTUXTEPEQUE', 10),
(182, 'CIUDAD DELGADO', 10),
(183, 'CUSCATANCINGO', 10),
(184, 'EL PAISNAL', 10),
(185, 'GUAZAPA', 10),
(186, 'ILOPANGO', 10),
(187, 'MEJICANOS', 10),
(188, 'NEJAPA', 10),
(189, 'PANCHIMALCO', 10),
(190, 'ROSARIO DE MORA', 10),
(191, 'SAN MARCOS', 10),
(192, 'SAN MARTÍN', 10),
(193, 'SAN SALVADOR', 10),
(194, 'SANTIAGO TEXACUANGOS', 10),
(195, 'SANTO TOMÁS', 10),
(196, 'SOYAPANGO', 10),
(197, 'TONACATEPEQUE', 10),
(198, 'APASTEPEQUE', 11),
(199, 'GUADALUPE', 11),
(200, 'SAN CAYETANO ISTEPEQUE', 11),
(201, 'SAN ESTEBAN CATARINA', 11),
(202, 'SAN ILDEFONSO', 11),
(203, 'SAN LORENZO', 11),
(204, 'SAN SEBASTIÁN', 11),
(205, 'SAN VICENTE', 11),
(206, 'SANTA CLARA', 11),
(207, 'SANTO DOMINGO', 11),
(208, 'TECOLUCA', 11),
(209, 'TEPETITÁN', 11),
(210, 'VERAPAZ', 11),
(211, 'CANDELARIA DE LA FRONTERA', 12),
(212, 'CHALCHUAPA', 12),
(213, 'COATEPEQUE', 12),
(214, 'EL CONGO', 12),
(215, 'EL PORVENIR', 12),
(216, 'MASAHUAT', 12),
(217, 'METAPÁN', 12),
(218, 'SAN ANTONIO PAJONAL', 12),
(219, 'SAN SEBASTIÁN SALITRILLO', 12),
(220, 'SANTA ANA', 12),
(221, 'SANTA ROSA GUACHIPILÍN', 12),
(222, 'SANTIAGO DE LA FRONTERA', 12),
(223, 'TEXISTEPEQUE', 12),
(224, 'ACAJUTLA', 13),
(225, 'ARMENIA', 13),
(226, 'CALUCO', 13),
(227, 'CUISNAHUAT', 13),
(228, 'IZALCO', 13),
(229, 'JUAYÚA', 13),
(230, 'NAHUIZALCO', 13),
(231, 'NAHUILINGO', 13),
(232, 'SALCOATITÁN', 13),
(233, 'SAN ANTONIO DEL MONTE', 13),
(234, 'SAN JULIÁN', 13),
(235, 'SANTA CATARINA MASAHUAT', 13),
(236, 'SANTA ISABEL ISHUATÁN', 13),
(237, 'SANTO DOMINGO DE GUZMÁN', 13),
(238, 'SONSONATE', 13),
(239, 'SONZACATE', 13),
(240, 'ALEGRÍA', 14),
(241, 'BERLÍN', 14),
(242, 'CALIFORNIA', 14),
(243, 'CONCEPCIÓN BATRES', 14),
(244, 'EL TRIUNFO', 14),
(245, 'EREGUAYQUÍN', 14),
(246, 'ESTANZUELAS', 14),
(247, 'JIQUILISCO', 14),
(248, 'JUCUAPA', 14),
(249, 'JUCUARÁN', 14),
(250, 'MERCEDES UMAÑA', 14),
(251, 'NUEVA GRANADA', 14),
(252, 'OZATLÁN', 14),
(253, 'PUERTO EL TRIUNFO', 14),
(254, 'SAN AGUSTÍN', 14),
(255, 'SAN BUENAVENTURA', 14),
(256, 'SAN DIONISIO', 14),
(257, 'SAN FRANCISCO JAVIER', 14),
(258, 'SANTA ELENA', 14),
(259, 'SANTA MARÍA', 14),
(260, 'SANTIAGO DE MARÍA', 14),
(261, 'TECAPÁN', 14),
(262, 'USULUTÁN', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8_spanish_ci NOT NULL,
  `dui` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta_secreta` text COLLATE utf8_spanish_ci NOT NULL,
  `id_jefe` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `dui`, `nit`, `usuario`, `clave`, `correo`, `nivel`, `estado`, `respuesta_secreta`, `id_jefe`) VALUES
(1, 'Mauricio', 'Constanza', '79635896-2', '1005-151190-859-6', 'admin', 'admin', 'info@cntplus.com.sv', 'Administrador', 'activo', '', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
