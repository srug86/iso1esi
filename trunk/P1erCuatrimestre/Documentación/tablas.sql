-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-01-2010 a las 03:33:30
-- Versión del servidor: 5.0.75
-- Versión de PHP: 5.2.6-3ubuntu4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `gdrpi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(10) NOT NULL auto_increment,
  `name` tinytext collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `name`) VALUES
(1, 'Arquitectura'),
(2, 'Caminos, Canales y Puertos'),
(3, 'Informática'),
(4, 'Biociencias'),
(5, 'Tecnología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eval_models`
--

CREATE TABLE IF NOT EXISTS `eval_models` (
  `id` int(10) NOT NULL auto_increment,
  `cppid` int(10) NOT NULL COMMENT 'convocatory projects package id',
  `structure` text collate utf8_spanish_ci NOT NULL,
  `sections` int(10) NOT NULL default '0' COMMENT 'number of sections',
  `elements` int(10) NOT NULL default '0' COMMENT 'number of elements',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `eval_models`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eval_reports`
--

CREATE TABLE IF NOT EXISTS `eval_reports` (
  `id` int(10) NOT NULL,
  `emid` int(10) NOT NULL COMMENT 'eval model id',
  `state` enum('in_process','done') collate utf8_spanish_ci NOT NULL,
  `data` text collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `eval_reports`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experts-projects`
--

CREATE TABLE IF NOT EXISTS `experts-projects` (
  `eid` int(10) NOT NULL COMMENT 'expert id',
  `pid` int(10) NOT NULL COMMENT 'project id',
  `rid` int(10) NOT NULL COMMENT 'report id',
  `valuation` tinytext collate utf8_spanish_ci NOT NULL,
  `assign_date` int(10) NOT NULL,
  PRIMARY KEY  (`eid`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `experts-projects`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) NOT NULL,
  `pid` int(10) NOT NULL COMMENT 'packet id',
  `memory` tinytext collate utf8_spanish_ci NOT NULL,
  `aid` int(10) NOT NULL COMMENT 'area id',
  `said` int(10) NOT NULL COMMENT 'subarea id',
  `state` enum('without_eval','in_process','evaluated') collate utf8_spanish_ci NOT NULL,
  `invitation_time` int(10) NOT NULL,
  `eval_time` int(10) NOT NULL,
  `emid` int(10) NOT NULL COMMENT 'eval model id',
  `final_report` text collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `pid`, `memory`, `aid`, `said`, `state`, `invitation_time`, `eval_time`, `emid`, `final_report`) VALUES
(1, 1, 'proyecto correspondiente al emplazamiento y la construcción de las pistas de aterrizaje, los hangares, y accesos al futuro aeropuerto', 2, 3, 'without_eval', 0, 0, 1, ''),
(2, 1, 'proyecto relacionado con la construccion de la torre de control del aeropuerto', 2, 3, 'without_eval', 0, 0, 1, ''),
(3, 1, 'proyecto correspodiente con la contruccion de las 5 terminales, todo lo relacionado con el emplazamiento de los edificios, la distribucion de ellos y las intercomunicaciones del aeropuerto ', 2, 1, 'without_eval', 0, 0, 1, ''),
(1, 3, 'proyecto correspondiente a la construcción de 20 viviendas de 80m2', 2, 1, 'without_eval', 5, 15, 2, ''),
(2, 3, 'proyecto correspondiente a la construcción de las zonas verdes del residencial, consistente en una zona lúdica y una fuente', 2, 1, 'without_eval', 5, 15, 2, ''),
(1, 2, 'Las propiedades eléctricas de un material describen su comportamiento eléctrico -que en muchas ocasiones es más crítico que su comportamiento mecánico- y describen también su comportamiento dieléctrico, que es propio de los materiales que impiden e', 2, 1, 'without_eval', 8, 25, 3, ''),
(2, 2, 'CONDUCCIÓN EN POLÍMEROS\r\n\r\nLos polímeros tienen una estructura de banda con una gran brecha de energía, lo cual indica que su conductividad eléctrica es bien baja. Esto se debe a que los electrones de valencia en estos tupos de materiales toman parte', 2, 1, 'without_eval', 7, 17, 3, ''),
(1, 4, 'Edificio con orbe circular en la copa, consta de 20 plantas, con diseño de ventanas repartidas uniformemente, con poca contaminación medioambiental y con alto valor turístico.', 1, 4, 'without_eval', 10, 15, 4, ''),
(2, 4, 'Edificio con forma espiral, consta de 18 plantas y 80 metros de altura, con disposición para el sector hostelero y valor turístico, respetando el casco urbano.', 1, 4, 'without_eval', 10, 15, 4, ''),
(1, 5, 'Crisis versus Hardware.\r\nEfectos.\r\nDesventajas.\r\n', 3, 4, 'without_eval', 6, 20, 5, ''),
(2, 5, 'Crisis versus Software\r\nEfectos\r\nProblemas en el desarrollo', 3, 1, 'without_eval', 8, 15, 5, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects_packages`
--

CREATE TABLE IF NOT EXISTS `projects_packages` (
  `id` int(10) NOT NULL auto_increment,
  `name` tinytext collate utf8_spanish_ci NOT NULL,
  `institution` tinytext collate utf8_spanish_ci NOT NULL,
  `bases` tinytext collate utf8_spanish_ci NOT NULL,
  `convocatory` tinytext collate utf8_spanish_ci NOT NULL,
  `incoming_date` int(10) NOT NULL,
  `outcoming_date` int(10) NOT NULL default '0',
  `deadline` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `projects_packages`
--

INSERT INTO `projects_packages` (`id`, `name`, `institution`, `bases`, `convocatory`, `incoming_date`, `outcoming_date`, `deadline`) VALUES
(1, 'Paquete de proyectos 1', 'Avinor', 'Kira''s Airport', 'gran colección de proyectos sobre estructuras para el futuro aeropuerto internacional de Argamasilla de Alba', 1262300400, 0, 1264719600),
(2, 'Paquete de proyectos 2', 'HKL', 'Los materiales se pueden clasificar en:\r\n\r\n    * Materiales metálicos\r\n    * Materiales polímeros\r\n    * Materiales cerámicos\r\n', 'Las propiedades principalmente frecuentadas en la ingeniería de los materiales son:\r\n\r\n    * Propiedades eléctricas: basadas en como reacciona un material ante un campo eléctrico.\r\n    * Propiedades mecánicas: basadas en el comportamiento ante un fen', 1189807200, 0, 1197586800),
(3, 'Paquete de proyectos 3', 'DICO', 'Residencial Fuente del Álamo, POZUELO DE ALARCÓN', 'Colección de proyectos relacionados con la construcción de un barrio residencial para los nuevos terrenos recalificados en la zona sur de la localidad de Pozuelo de Alarcón', 1255989600, 0, 1265065200),
(4, 'Paquete de proyectos 4', 'ACS', 'Proyectos referidos al diseño y construcción de Edificios característicos en el emplazamiento del Puerto de Roquetas del Mar(Almería).', 'Los proyectos referentes a los edificios en la localización de Roquetas del Mar, para lo cual se valorarán ciertos aspectos, como el impacto medioambiental, turístico, su impacto en el casco urbano de dicha ciudad y su correspondiente seguridad.', 1263078000, 0, 1266966000),
(5, 'Paquete de proyectos 5', 'Asociación de Jóvenes afectados por la crisis operativa.', 'Crisis mundial económica.\r\nCómo afecta la crisis al desarrollo de la tecnología.', 'Hardware\r\nSoftware\r\nDesarrollo', 1281218400, 0, 1286402400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subareas`
--

CREATE TABLE IF NOT EXISTS `subareas` (
  `id` int(10) NOT NULL,
  `aid` int(10) NOT NULL COMMENT 'area id',
  `uid` int(10) NOT NULL default '0' COMMENT 'user id',
  `name` tinytext collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `subareas`
--

INSERT INTO `subareas` (`id`, `aid`, `uid`, `name`) VALUES
(1, 1, 1234569, 'Diseño de Interiores'),
(2, 1, 3421588, 'Historia del Paisaje'),
(3, 1, 2121234, 'Inmobiliaria'),
(4, 1, 6475292, 'Espacio Público'),
(1, 2, 9348230, 'Urbanismo'),
(2, 2, 3242432, 'Geotecnia'),
(3, 2, 1324123, 'Transporte'),
(4, 2, 3412367, 'Hidráulica'),
(1, 3, 0, 'Arquitectura y Tecnología de Computadores'),
(2, 3, 0, 'Redes'),
(3, 3, 0, 'Sistemas Operativos'),
(4, 3, 5701903, 'Tecnología y Sistemas de Información'),
(1, 4, 64548332, 'Antropología'),
(2, 4, 73793234, 'Arqueología'),
(3, 4, 9836422, 'Biología Molecular'),
(4, 4, 64514132, 'Neurociencia'),
(1, 5, 5712008, 'Ingeniería Eléctrica'),
(2, 5, 5623213, 'Ingeniería Mecánica'),
(3, 5, 70555201, 'Metalurgia'),
(4, 5, 5692919, 'Materiales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL,
  `type` enum('secretary','coordinator','attached','expert') collate utf8_spanish_ci NOT NULL default 'expert',
  `email` tinytext collate utf8_spanish_ci NOT NULL,
  `password` varchar(40) collate utf8_spanish_ci NOT NULL,
  `pwsalt` varchar(4) collate utf8_spanish_ci NOT NULL,
  `name` tinytext collate utf8_spanish_ci NOT NULL,
  `surnames` tinytext collate utf8_spanish_ci NOT NULL,
  `phone` int(10) NOT NULL,
  `area` int(10) NOT NULL default '0',
  `institution` tinytext collate utf8_spanish_ci NOT NULL,
  `curriculum` tinytext collate utf8_spanish_ci NOT NULL,
  `keywords` tinytext collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `type`, `email`, `password`, `pwsalt`, `name`, `surnames`, `phone`, `area`, `institution`, `curriculum`, `keywords`) VALUES
(5699591, 'secretary', 'luis.munoz@alu.uclm.es', '63143b6f8007b98c53ca2149822777b3566f9241', 'f10e', 'Luis', 'Muñoz Villarreal', 926921149, 3, 'UCLM', 'Un montón de cosas', 'listo, majo, hermoso, rico y que mas?'),
(70582355, 'secretary', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', '3268', 'Alicia', 'Serrano Sánchez', 645897567, 3, 'UCLM', 'Tve es una mierda sin anuncios', 'música, mes, informática, círculo de lectores'),
(5701903, 'attached', 'ildian86@gmail.com', '6c973e8803b3fbaabfb09dd916e295ed24da1d43', '2186', 'Juan Miguel', 'Torres Triviño', 666, 3, 'UCLM\r\n', 'Ingeniero eléctrico\r\nDoctor en redes transversales\r\nPirri!!!', 'Eficiente\r\nRapido\r\nGran persona'),
(5702008, 'expert', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'Miguel', 'Millán Sánchez-Grande', 1, 3, 'Luisito y asociados S.A', '', 'Software, java C++'),
(5692939, 'coordinator', 'srug86@gmail.com', '6ed32edf4e92ab3c0a4dc6f90242953c344051ad', 's86r', 'Sergio', 'de la Rubia García-Carpintero', 625996716, 3, 'UCLM', 'Ingeniero Superior en Informática\r\nInstalaciones Eléctricas Farriche,\r\nElectricidad de la Rubia y Fernández,\r\nFrutas Millán,\r\nMillán Confort.', 'Informática\r\nElectricidad\r\nFrutas\r\nConfort'),
(6758433, 'expert', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', 'blas', 'Alejandro ', 'Fernández Cabeza', 657436122, 4, 'Universidad de Granada', 'Experiencia laboral como director de proyectos de investigación.\r\nJefe de Sección en el yacimiento arqueológico de Atapuerca.', 'arqueología, enseñanza, investigación'),
(5700014, 'coordinator', 'srug86@gmail.com', '3efd4c0fe185135dd2c584b9698f506803cfaf81', 'jfc1', 'José', 'Falas de Caamaño', 926858492, 5, 'UCLM', 'Ingeniero Industrial\r\n', 'Industriales\r\nMecánica'),
(8796321, 'expert', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'Aitor', 'Menta', 696969696, 2, 'UCM', '', 'transporte publico, autovias, carreteras'),
(1234569, 'attached', 'ildian86@gmail.com', '6c973e8803b3fbaabfb09dd916e295ed24da1d43', 'l23t', 'Javier', 'García García', 67923, 1, 'Universidad Carlos III', 'Ingeniero Arquitecto\r\nDoctor en Diseño Práctico', 'Rápido\r\nApto Aprovechamiento público'),
(5712008, 'attached', 'srug86@gmail.com', '8f80c5070b333c38fb20c5df78094d39105983d0', 'ebm1', 'Enrique', 'Barjuan Montenegro', 926849301, 5, 'UCM', 'Ingeniero Técnico Eléctrico', 'Electricidad\r\nAutomóvil\r\nCircuitos'),
(6453212, 'expert', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', '7564', 'Lourdes', 'Lozano Ballesteros', 675455332, 2, 'PVG Geotecnica S.L.', 'Investigación de riesgos de deslizamientos de terreno.\r\nConstrucción de puentes en Londres', 'edificio, puente, hundimientos, suelo, roca'),
(5692919, 'attached', 'srug86@gmail.com', '37b9a01dca84d74abcfaf9323d6e53a8b05f43bd', 'rfg1', 'Rafael', 'Ferrán González', 623984561, 5, 'Universidad de Extremadura', 'Doctor en Electricidad del Automóvil', 'Automovilismo\r\nElectricidad\r\nFord\r\nBMW\r\n'),
(78956789, 'coordinator', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'Florentino', 'Fernández', 23121214, 2, 'Ferrovial', '', 'Edificios economía Estructuras'),
(9348230, 'attached', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'Juan', 'Pirri', 321321312, 2, 'Universidad Europea', '', 'tuberias agua canales'),
(2347812, 'coordinator', 'ildian86@gmail.com', '6c973e8803b3fbaabfb09dd916e295ed24da1d43', 'jut6', 'Manuel', 'Fernández Serna', 12345, 1, 'Universidad Carlos III', 'Ingeniero Arquitecto\r\nDoctor en Edificios Modernos', 'Eficiente\r\nBuena predisposición'),
(6475292, 'attached', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', '1234', 'Celia', 'Cruz Mena', 678546312, 1, 'CONSTRUGLOBAL', 'Diseñadora de diseño del interior de edificios emblemáticos, tales como Guggenheim, Museo Británico y Royal Palace.', 'edificio, casas rurales, museo, diseño, interiores'),
(5623213, 'attached', 'srug86@gmail.com', 'cd67f1d9e27549dfd0277164b8e03eb4fd917563', 'ppa1', 'Protestato', 'Pinedo Acevedo', 612982011, 5, 'Universidad de Cantabria', 'Doctor en Ingeniería Mecánica', 'Mecánica\r\nAutomoción'),
(5673421, 'expert', 'ildian86@gmail.com', '6c973e8803b3fbaabfb09dd916e295ed24da1d43', 'u75e', 'Jacinto', 'Leal Panadero', 999, 1, 'Universidad Carlos III', 'Ingeniero Arquitecto\r\nDoctor en Interiorismo', 'Interiores\r\nBuen diseñador\r\n'),
(3242432, 'expert', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'Luis Felipe', 'de Madeira', 231323213, 2, 'Dragados', '', 'areas terrenos materiales'),
(70555201, 'attached', 'srug86@gmail.com', '2a5cc4e04b9d87c55d10d9dc09268842cc024f0e', 'jmc1', 'Jesús', 'Manzano Caso', 926319911, 5, 'Universidad Politécnica de Valencia', 'Ingeniero Industrial', 'Neumática\r\nAeromodelismo'),
(3421588, 'attached', 'ildian86@gmail.com', '6c973e8803b3fbaabfb09dd916e295ed24da1d43', 'lu78', 'Sara', 'Millán Lucero', 7778, 1, 'UCLM', 'Ingeniero Medioambiental\r\nDoctor en Paisajes Urbanos', 'Rápida\r\nEficiente\r\nBuen Diseño de Paisajes'),
(5353214, 'coordinator', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', 'fw3e', 'Carmen', 'Morales Prieto', 637923112, 4, 'Universidad de las Palmas de Gran Canarias', 'Jefa de proyecto sobre los fondos marinos de la zona este de las Islas Canarias.\r\nEncargada del análisis molecular de animales en peligro de extinción', 'animales, biología, molecular'),
(1324123, 'attached', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'Pepe', 'Unpurito', 743892729, 2, 'Dux', '', 'UCLM'),
(3412367, 'attached', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'José Ramón', 'De la Morena', 342353, 2, 'UCM', '', 'Aguas cauces canales'),
(5720012, 'expert', 'srug86@gmail.com', '83555019585a7accaebe618e1fff721bc91776de', 'aob1', 'Antoni', 'Olivé Boix', 699123222, 5, 'Universidad de Barcelona', 'Ingeniero Técnico Electricidad', 'Conductores\r\nDiodos\r\nConmutadores'),
(5655433, 'expert', 'srug86@gmail.com', '0989d0c2b14d8043681418a837d2dca2ffc6bf09', 'dpv1', 'Diego', 'Pompeyo Valdés', 611982211, 5, 'Universidad Europea de Madrid', 'Ingeniero Técnico Mecánica', 'Construcción\r\nConducción\r\nAutomoción'),
(64548332, 'attached', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', 'ol43', 'Dolores', 'Novillo\r\n', 656452438, 4, 'Empresa Roche Diagnostics', 'Estudio del origen y desarrollo de toda la gama de la variabilidad humana. \r\nEstudio de los modos de comportamientos sociales a través del tiempo y el espacio.', 'evolución, ciencia, anatomía, cultura'),
(64514132, 'attached', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', '7dkj', 'Esperanza', 'Aguirre Gil de Biedma', 53232342, 4, 'Gobierno Español', 'Presidenta de la Comunidad de Madrid.\r\nColaboración con Luigi Galvani para descubrir la existencia de actividad eléctrica en animales.', 'química, farmacología, patología del sistema nervioso'),
(73793234, 'attached', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', '48sl', 'Giraldo', 'Ruíz Morote', 74647423, 4, 'Universidad Pontificia de Salamanca', 'Estudio de la rana de la fachada de la Universidad', 'animal, biología, ciencia'),
(2121234, 'attached', 'ildian86@gmail.com', '6c973e8803b3fbaabfb09dd916e295ed24da1d43', '21cr', 'Nuria', 'Ballesta Lorca', 12343, 1, 'ACS', 'Arquitecto\r\nDoctor Inmobiliario', 'Predisposición Inmediata\r\nGran experiencia Inmobiliaria'),
(9836422, 'attached', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', 'ek32', 'Paquita', 'Chocolatera', 63722234, 4, 'Fundación Biociencia', 'Análisis molecular de sustancias, Herramientas de Biología Molecular, Biotecnología y Biofarmacéutica, Consultoría en aspectos de Biociencias, Soporte en infraestructura y conocimiento para investigaciones Biocientíficas, Desarrollo de productos bio', 'biología, geobiología, proyecto, aspecto social');

