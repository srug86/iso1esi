-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-02-2010 a las 13:04:03
-- Versión del servidor: 5.1.37
-- Versión de PHP: 5.2.10-2ubuntu6.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `gdrpi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

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
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cppid` int(10) NOT NULL COMMENT 'convocatory projects package id',
  `structure` text COLLATE utf8_spanish_ci NOT NULL,
  `sections` int(10) NOT NULL DEFAULT '0' COMMENT 'number of sections',
  `elements` int(10) NOT NULL DEFAULT '0' COMMENT 'number of elements',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `eval_models`
--

INSERT INTO `eval_models` (`id`, `cppid`, `structure`, `sections`, `elements`) VALUES
(10, 5, 'a:5:{i:0;a:2:{s:3:"txt";s:23:"Capacidad de síntesis:";s:3:"els";a:1:{i:0;a:1:{s:3:"rad";a:3:{i:0;s:4:"Mala";i:1;s:5:"Media";i:2;s:5:"Buena";}}}}i:1;a:2:{s:3:"txt";s:38:"Tiempo estimado de desarrollo (meses):";s:3:"els";a:1:{i:0;a:1:{s:3:"lst";a:5:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";}}}}i:2;a:2:{s:3:"txt";s:12:"Presupuesto:";s:3:"els";a:1:{i:0;a:1:{s:3:"fie";s:3:"€";}}}i:3;a:2:{s:3:"txt";s:14:"Observaciones:";s:3:"els";a:1:{i:0;a:1:{s:3:"are";s:0:"";}}}i:4;a:2:{s:3:"txt";s:18:"Valoración final:";s:3:"els";a:1:{i:0;a:1:{s:3:"lst";a:5:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";}}}}}', 5, 5),
(3, 2, 'a:4:{i:0;a:2:{s:3:"txt";s:12:"Viabilidad: ";s:3:"els";a:1:{i:0;a:1:{s:3:"rad";a:5:{i:0;s:1:"0";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";}}}}i:1;a:2:{s:3:"txt";s:24:"Impacto medioambiental: ";s:3:"els";a:1:{i:0;a:1:{s:3:"chk";a:4:{i:0;s:24:"Contaminación acústica";i:1;s:17:"Emisión de gases";i:2;s:17:"Vertidos tóxicos";i:3;s:24:"Contaminación lumínica";}}}}i:2;a:2:{s:3:"txt";s:20:"Prestaciones/Precio:";s:3:"els";a:1:{i:0;a:1:{s:3:"lst";a:5:{i:0;s:8:"Muy malo";i:1;s:4:"Malo";i:2;s:7:"Regular";i:3;s:5:"Bueno";i:4;s:9:"Muy bueno";}}}}i:3;a:2:{s:3:"txt";s:14:"Observaciones:";s:3:"els";a:1:{i:0;a:1:{s:3:"are";s:0:"";}}}}', 4, 4),
(9, 5, 'a:5:{i:0;a:2:{s:3:"txt";s:12:"Viabilidad: ";s:3:"els";a:1:{i:1;a:1:{s:3:"rad";a:5:{i:0;s:8:"Muy mala";i:1;s:4:"Mala";i:2;s:7:"Regular";i:3;s:5:"Buena";i:4;s:9:"Muy buena";}}}}i:1;a:2:{s:3:"txt";s:23:"Capacidad inalámbrica:";s:3:"els";a:1:{i:0;a:1:{s:3:"rad";a:3:{i:0;s:4:"Nula";i:1;s:5:"Posee";i:2;s:5:"Buena";}}}}i:2;a:2:{s:3:"txt";s:26:"Velocidad de transmisión:";s:3:"els";a:1:{i:0;a:1:{s:3:"rad";a:5:{i:0;s:8:"Muy baja";i:1;s:4:"Baja";i:2;s:5:"Media";i:3;s:4:"Alta";i:4;s:8:"Muy alta";}}}}i:3;a:2:{s:3:"txt";s:12:"Comentarios:";s:3:"els";a:1:{i:1;a:1:{s:3:"are";s:0:"";}}}i:4;a:2:{s:3:"txt";s:20:"Valoración general:";s:3:"els";a:1:{i:0;a:1:{s:3:"lst";a:10:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";i:6;s:1:"7";i:7;s:1:"8";i:8;s:1:"9";i:9;s:2:"10";}}}}}', 5, 5),
(5, 2, 'a:4:{i:0;a:2:{s:3:"txt";s:10:"Fiabilidad";s:3:"els";a:2:{i:0;a:1:{s:3:"fie";s:67:"El 1 corresponde a poca flexibilidad y el 5 a flexibilidad completa";}i:1;a:1:{s:3:"rad";a:5:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";}}}}i:1;a:2:{s:3:"txt";s:28:"Competitividad en el mercado";s:3:"els";a:1:{i:0;a:1:{s:3:"are";s:0:"";}}}i:2;a:2:{s:3:"txt";s:14:"Calidad-precio";s:3:"els";a:1:{i:0;a:1:{s:3:"chk";a:2:{i:0;s:9:"Mejorable";i:1;s:12:"Comprensible";}}}}i:3;a:2:{s:3:"txt";s:13:"Ser útil en:";s:3:"els";a:1:{i:0;a:1:{s:3:"lst";a:3:{i:0;s:8:"Empresas";i:1;s:22:"Colegios/Universidades";i:2;s:13:"Modo personal";}}}}}', 4, 5),
(8, 5, 'a:3:{i:0;a:2:{s:3:"txt";s:12:"Viabilidad: ";s:3:"els";a:1:{i:0;a:1:{s:3:"rad";a:3:{i:0;s:4:"Baja";i:1;s:5:"Media";i:2;s:4:"Alta";}}}}i:1;a:2:{s:3:"txt";s:22:"Aspectos destacables: ";s:3:"els";a:1:{i:0;a:1:{s:3:"are";s:0:"";}}}i:2;a:2:{s:3:"txt";s:18:"Valoración final:";s:3:"els";a:1:{i:0;a:1:{s:3:"lst";a:10:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";i:6;s:1:"7";i:7;s:1:"8";i:8;s:1:"9";i:9;s:2:"10";}}}}}', 3, 3),
(7, 2, 'a:4:{i:0;a:2:{s:3:"txt";s:24:"valoración del proyecto";s:3:"els";a:1:{i:0;a:1:{s:3:"rad";a:10:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";i:6;s:1:"7";i:7;s:1:"8";i:8;s:1:"9";i:9;s:2:"10";}}}}i:1;a:2:{s:3:"txt";s:35:"Impacto en la situación de mercado";s:3:"els";a:1:{i:0;a:1:{s:3:"rad";a:3:{i:0;s:4:"Baja";i:1;s:5:"Media";i:2;s:4:"Alta";}}}}i:2;a:2:{s:3:"txt";s:24:"Relación precio/calidad";s:3:"els";a:1:{i:0;a:1:{s:3:"rad";a:4:{i:0;s:4:"Mala";i:1;s:7:"Regular";i:2;s:5:"Buena";i:3;s:9:"Muy buena";}}}}i:3;a:2:{s:3:"txt";s:10:"Viabilidad";s:3:"els";a:1:{i:0;a:1:{s:3:"rad";a:10:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";i:6;s:1:"7";i:7;s:1:"8";i:8;s:1:"9";i:9;s:2:"10";}}}}}', 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eval_reports`
--

CREATE TABLE IF NOT EXISTS `eval_reports` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `emid` int(10) NOT NULL COMMENT 'eval model id',
  `state` enum('in_process','done') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'in_process',
  `data` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `eval_reports`
--

INSERT INTO `eval_reports` (`id`, `emid`, `state`, `data`) VALUES
(1, 3, 'in_process', ''),
(2, 7, 'done', ''),
(3, 5, 'done', 'a:4:{i:0;a:1:{s:3:"els";a:1:{i:1;a:1:{s:3:"rad";s:1:"2";}}}i:1;a:1:{s:3:"els";a:1:{i:0;a:1:{s:3:"are";s:4:"poca";}}}i:2;a:1:{s:3:"els";a:1:{i:0;a:1:{s:3:"chk";a:1:{i:0;s:1:"1";}}}}i:3;a:1:{s:3:"els";a:1:{i:0;a:1:{s:3:"lst";s:1:"1";}}}}'),
(4, 8, 'in_process', ''),
(5, 8, 'in_process', ''),
(6, 9, 'in_process', ''),
(7, 9, 'in_process', ''),
(8, 10, 'in_process', ''),
(9, 10, 'in_process', ''),
(10, 7, 'done', 'a:4:{i:0;a:1:{s:3:"els";a:1:{i:0;a:1:{s:3:"rad";s:1:"5";}}}i:1;a:1:{s:3:"els";a:1:{i:0;a:1:{s:3:"rad";s:1:"1";}}}i:2;a:1:{s:3:"els";a:1:{i:0;a:1:{s:3:"rad";s:1:"2";}}}i:3;a:1:{s:3:"els";a:1:{i:0;a:1:{s:3:"rad";s:1:"6";}}}}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experts-projects`
--

CREATE TABLE IF NOT EXISTS `experts-projects` (
  `uid` int(10) NOT NULL COMMENT 'expert id',
  `ppid` int(10) NOT NULL COMMENT 'projects package id',
  `pid` int(10) NOT NULL COMMENT 'project id',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT 'report id',
  `valuation` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `assign_date` int(10) NOT NULL,
  PRIMARY KEY (`uid`,`ppid`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `experts-projects`
--

INSERT INTO `experts-projects` (`uid`, `ppid`, `pid`, `rid`, `valuation`, `assign_date`) VALUES
(73793234, 5, 1, 5, '', 1263164540),
(54548332, 5, 3, 6, '', 1263165555),
(5699592, 5, 2, 4, '', 1263164666),
(3412367, 2, 3, 2, '', 1263164403),
(5720012, 2, 2, 3, '', 1263164403),
(5655433, 2, 1, 1, '', 1260399600),
(54548332, 5, 5, 7, '', 1263165522),
(5712008, 5, 4, 8, '', 1263164540),
(70582355, 5, 4, 9, '', 1263164540),
(5673421, 1, 1, 10, '', 1263164403);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) NOT NULL,
  `pid` int(10) NOT NULL COMMENT 'packet id',
  `name` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `memory` text COLLATE utf8_spanish_ci NOT NULL,
  `aid` int(10) NOT NULL COMMENT 'area id',
  `said` int(10) NOT NULL COMMENT 'subarea id',
  `state` enum('without_eval','experts_evaluating','evaluated_experts','evaluated_attached','validated_coordinator') COLLATE utf8_spanish_ci NOT NULL,
  `invitation_time` int(10) NOT NULL,
  `eval_time` int(10) NOT NULL,
  `emid` int(10) NOT NULL COMMENT 'eval model id',
  `final_report` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `pid`, `name`, `memory`, `aid`, `said`, `state`, `invitation_time`, `eval_time`, `emid`, `final_report`) VALUES
(1, 2, 'Nuevo tipos grúas', 'Consiste en un nuevo tipo de grúas ecológicas, basadas en un sistema de poleas y el uso de materiales reciclados y biodegradables. ', 5, 2, 'experts_evaluating', 1, 7, 3, ''),
(2, 2, 'Estudio centrales eléctricas España', 'Últimas informaciones proporcionadas por el ministerio industria, turismo y comercio', 5, 1, 'experts_evaluating', 8, 15, 5, ''),
(3, 2, 'Remodelación catedral Ciudad Real', 'estudio sobre la posible construcción de alguna estructuras metálicas, para reforzar los castigados pilares de la catedral de la capital manchega.', 5, 3, 'experts_evaluating', 2, 11, 7, ''),
(1, 5, 'Sistema automático para creación de páginas web personales a partir de formularios', '    *  Planteamiento:\r\n          o  Crear una herramienta fácil de usar y mantener para que el personal del departamento ATC pueda crearse de forma sencilla y rápida una página Web personal.\r\n    * Objetivos:\r\n          o  Diseñar e implementar el sistema descrito e integrarlo dentro de la página Web del departamento.\r\n    * Desarrollo del proyecto:\r\n          o Análisis de los elementos esenciales que forman parte de una página web personal docente\r\n          o Desarrollo de los elementos que van a ir generando la página web\r\n          o Diseño e implementación del sistema de mantenimiento de las páginas generadas\r\n', 3, 1, 'experts_evaluating', 5, 10, 0, ''),
(2, 5, 'Sistema experto para el tratamiento de información de redes de telesupervisión de agua', 'El proyecto consiste en el diseño de procedimientos automáticos de análisis y diagnóstico en tiempo real de los datos que se reciben del sistema de Telesupervisión de la Red de Abastecimiento para la detección de anomalías (averías, fugas, fraudes, ..) y la implantación de un sistema de predicción de consumos a corto y medio plazo. Para ello se utilizarán nuevas técnicas de diseño basadas en el procesamiento de series temporales, lógica difusa, redes neuronales artificiales y algoritmos genéticos.', 3, 1, 'experts_evaluating', 5, 10, 0, ''),
(3, 5, 'Chat a través de Bluetooth', 'La idea es crear un cliente/servidor que permita a dos personas con un teléfono u otro dispositivo bluetooth (tal como un ordenador) conversar, sin necesidad de usar protocolos que dependan de una compañía telefónica. El programa permitiría que las dos personas tuvieran en la pantalla de su ordenador la conversación, y distinguiría claramente qué frase procede de cada uno de los usuarios.\r\nOpcionalmente, el programa permitirá también enviar ficheros y permitir a varias personas conversar entre sí, usando al iniciador de la conversación, por ejemplo, como servidor central.', 3, 2, 'experts_evaluating', 4, 8, 0, ''),
(4, 5, 'Sistema embebido en Hardware reconfigurable para monitorización de adelantemientos de vehículos', 'El objetivo del proyecto es la implementación de algoritmos de seguimiento de objetos en procesadores embebidos en dispositivos de tipo FPGA. Los dispositivos FPGA disponen de gran cantidad de recursos configurables de propósito general. En concreto,\r\nactualmente se pueden definir distintos tipos de procesadores. En este proyecto se plantea el desarrollo de una plataforma de seguimiento de objetos basada en visión.\r\nPara ello se pretende utilizar una arquitectura específica de procesamiento de movimiento (flujo óptico) desarrollada en el departamento como “camino de datos” de altas prestaciones. El trabajo planteado en este proyecto consiste en instanciar un\r\nprocesador embebido como el microblaze en la FPGA para que utilice  eficientemente las primitivas que se implementan en la arquitectura complementaria de procesamiento\r\nde movimiento. El procesamiento de flujo óptico lo realizará el camino de datos específico y el algoritmo de seguimiento de objetos se programará en software en el procesador embebido. Además se realizará una evaluación de las prestaciones del sistema Hardware/Software y se comentarán las ventajas e inconvenientes de este tipo\r\nde plataformas.\r\n', 3, 4, 'experts_evaluating', 6, 12, 0, ''),
(5, 5, 'Plataforma reconfigurable multimedia para captura, compresión y envío de imágenes', '• Planteamiento: El ancho de banda requerido para transmisión de video es muy grande y una limitación importante para sensores digitales empotrados. En este proyecto el estudiante analizará técnicas de compresión de datos para la implementación en sistema empotrado con comunicación Ethernet.\r\n• Objetivos:\r\n     o Desarrollo de un sistema empotrado de captura y envío de imágenes.\r\n     o Análisis de la viabilidad de la implementación de métodos de         compresión de imágenes.\r\n     o Programación de la solución escogida y medición de prestaciones.\r\n     o Adicional: Desarrollo de módulos IP a medida.\r\n• Desarrollo del proyecto:\r\n     o Constará de dos fases bien diferenciadas. La primera se estudiará un protocolo de bajo nivel de comunicación usando la interfaz ethernet así como su implementación. La segunda fase tratará sobre el envío y compresión de imágenes mediante el protocolo desarrollado.\r\n', 3, 2, 'experts_evaluating', 5, 10, 0, ''),
(1, 1, 'Estructura de la torre de control', 'Estudio sobre la estructura de la torre de control, incluyendo los materiales a usar, el estilo arquitectónico, el tipo de estructura a usar, estudios de resistencia a el aire, situación de dicha torre.', 1, 4, 'evaluated_attached', 10, 23, 7, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects_packages`
--

CREATE TABLE IF NOT EXISTS `projects_packages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `institution` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `bases` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `convocatory` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `incoming_date` int(10) NOT NULL,
  `outcoming_date` int(10) NOT NULL DEFAULT '0',
  `deadline` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `projects_packages`
--

INSERT INTO `projects_packages` (`id`, `name`, `institution`, `bases`, `convocatory`, `incoming_date`, `outcoming_date`, `deadline`) VALUES
(1, 'Paquete de proyectos 1', 'Avinor', 'Kira''s Airport', 'gran colección de proyectos sobre estructuras para el futuro aeropuerto internacional de Argamasilla de Alba', 1262300400, 0, 1264719600),
(2, 'Paquete de proyectos 2', 'HKL', 'Los materiales se pueden clasificar en:\r\n\r\n    * Materiales metálicos\r\n    * Materiales polímeros\r\n    * Materiales cerámicos\r\n', 'Las propiedades principalmente frecuentadas en la ingeniería de los materiales son:\r\n\r\n    * Propiedades eléctricas: basadas en como reacciona un material ante un campo eléctrico.\r\n    * Propiedades mecánicas: basadas en el comportamiento ante un fen', 1189807200, 0, 1197586800),
(3, 'Paquete de proyectos 3', 'DICO', 'Residencial Fuente del Álamo, POZUELO DE ALARCÓN', 'Colección de proyectos relacionados con la construcción de un barrio residencial para los nuevos terrenos recalificados en la zona sur de la localidad de Pozuelo de Alarcón', 1255989600, 0, 1265065200),
(4, 'Paquete de proyectos 4', 'ACS', 'Proyectos referidos al diseño y construcción de Edificios característicos en el emplazamiento del Puerto de Roquetas del Mar(Almería).', 'Los proyectos referentes a los edificios en la localización de Roquetas del Mar, para lo cual se valorarán ciertos aspectos, como el impacto medioambiental, turístico, su impacto en el casco urbano de dicha ciudad y su correspondiente seguridad.', 1263078000, 0, 1266966000),
(5, 'Paquete de proyectos 5', 'ETSIIT - Universidad de Granada', 'Proyectos ofertados por ATC para la convocatoria 09/10', 'Hardware\r\nSoftware', 1281218400, 0, 1286402400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subareas`
--

CREATE TABLE IF NOT EXISTS `subareas` (
  `id` int(10) NOT NULL,
  `aid` int(10) NOT NULL COMMENT 'area id',
  `uid` int(10) NOT NULL DEFAULT '0' COMMENT 'user id',
  `name` tinytext COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`,`aid`)
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
(1, 3, 5692919, 'Software de Sistemas'),
(2, 3, 0, 'Redes'),
(3, 3, 0, 'Sistemas Operativos'),
(4, 3, 5701903, 'Hardware de Sistemas'),
(1, 4, 64548332, 'Antropología'),
(2, 4, 73793234, 'Arqueología'),
(3, 4, 9836422, 'Biología Molecular'),
(4, 4, 64514132, 'Neurociencia'),
(1, 5, 5712008, 'Ingeniería Eléctrica'),
(2, 5, 5623213, 'Ingeniería Mecánica'),
(3, 5, 70555201, 'Metalurgia'),
(5, 3, 5692919, 'Materiales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL,
  `type` enum('secretary','coordinator','attached','expert') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'expert',
  `email` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `pwsalt` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `name` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `surnames` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `phone` int(10) NOT NULL,
  `aid` int(10) NOT NULL DEFAULT '0' COMMENT 'area id',
  `institution` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `curriculum` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `keywords` tinytext COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `type`, `email`, `password`, `pwsalt`, `name`, `surnames`, `phone`, `aid`, `institution`, `curriculum`, `keywords`) VALUES
(5699591, 'secretary', 'luis.munoz@alu.uclm.es', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'f10e', 'Luis', 'Muñoz Villarreal', 926921149, 3, 'Universidad de Castilla-La Mancha', 'Un montón de cosas', 'listo, majo, hermoso, rico'),
(70582355, 'expert', 'alisesan86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', '3268', 'Alicia', 'Serrano Sánchez', 645897567, 3, 'Universidad de Castilla-La Mancha', '', 'Hardware, interfaces gráficas, eficaz'),
(5701903, 'attached', 'ildian86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', '2186', 'Juan Miguel', 'Torres Triviño', 666356897, 3, 'Universidad de Castilla-La Mancha\r\n', 'Ingeniero eléctrico\r\nDoctor en redes transversales', 'Eficiente\r\nRapido\r\nGran persona'),
(5702008, 'expert', 'uoohh@hotmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'luis', 'Miguel', 'Millán Sánchez-Grande', 609362571, 3, 'Universidad Castilla La-Mancha', '', 'Software, eficiente,Java'),
(5692939, 'coordinator', 'srug86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 's86r', 'Sergio', 'de la Rubia García-Carpintero', 625996716, 3, 'Universidad de Castilla-La Mancha', 'Ingeniero Superior en Informática\r\nInstalaciones Eléctricas Farriche,\r\nElectricidad de la Rubia y Fernández', 'Informática\r\nElectricidad'),
(5699592, 'expert', 'alisesan86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'blas', 'Alejandro ', 'Fernández Cabeza', 657436122, 3, 'Universidad de Granada', 'Experiencia laboral como director de proyectos de investigación.\r\nJefe de Sección en el yacimiento arqueológico de Atapuerca.', 'arqueología, enseñanza, investigación'),
(5700014, 'coordinator', 'srug86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'jfc1', 'José', 'Falas de Caamaño', 926858492, 5, 'Universidad de Castilla-La Mancha', 'Ingeniero Industrial\r\n', 'Industriales\r\nMecánica'),
(8796321, 'expert', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'Aitor', 'Menta', 696969696, 2, 'UCM', '', 'transporte publico, autovias, carreteras'),
(1234569, 'attached', 'ildian86@gmail.com', '6c973e8803b3fbaabfb09dd916e295ed24da1d43', 'l23t', 'Javier', 'García García', 67923, 1, 'Universidad Carlos III', 'Ingeniero Arquitecto\r\nDoctor en Diseño Práctico', 'Rápido\r\nApto Aprovechamiento público'),
(5712008, 'attached', 'srug86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'ebm1', 'Enrique', 'Barjuan Montenegro', 926849301, 5, 'UCM', 'Ingeniero Técnico Eléctrico', 'Electricidad\r\nAutomóvil\r\nCircuitos'),
(6453212, 'expert', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', '7564', 'Lourdes', 'Lozano Ballesteros', 675455332, 2, 'PVG Geotecnica S.L.', 'Investigación de riesgos de deslizamientos de terreno.\r\nConstrucción de puentes en Londres', 'edificio, puente, hundimientos, suelo, roca'),
(5692919, 'attached', 'srug86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'rfg1', 'Rafael', 'Ferrán González', 623984561, 3, 'Universidad de Extremadura', 'Doctor en Redes y Comunicaciones', 'Automovilismo\r\nElectricidad\r\nMovil\r\nPortatil'),
(78956789, 'coordinator', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'Florentino', 'Fernández', 23121214, 2, 'Ferrovial', '', 'Edificios economía Estructuras'),
(9348230, 'attached', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'Juan', 'Naranjo García', 321321312, 2, 'Universidad Europea', '', 'tuberias agua canales'),
(2347812, 'coordinator', 'ildian86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'jut6', 'Manuel', 'Fernández Serna', 678212345, 1, 'Universidad Carlos III', 'Ingeniero Arquitecto\r\nDoctor en Edificios Modernos', 'Eficiente\r\nBuena predisposición'),
(6475292, 'attached', 'alisesan86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', '1234', 'Celia', 'Cruz Mena', 678546312, 1, 'CONSTRUGLOBAL', 'Diseñadora de diseño del interior de edificios emblemáticos, tales como Guggenheim, Museo Británico y Royal Palace.', 'edificio, casas rurales, museo, diseño, interiores'),
(5623213, 'attached', 'srug86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'ppa1', 'Protestato', 'Pinedo Acevedo', 612982011, 5, 'Universidad de Cantabria', 'Doctor en Ingeniería Mecánica', 'Mecánica\r\nAutomoción'),
(5673421, 'expert', 'ildian86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'u75e', 'Jacinto', 'Leal Panadero', 672835491, 1, 'Universidad Carlos III', 'Ingeniero Arquitecto\r\nDoctor en Interiorismo', 'Interiores\r\nBuen diseñador\r\n'),
(3242432, 'expert', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'Luis Felipe', 'de Madeira', 231323213, 2, 'Dragados', '', 'areas terrenos materiales'),
(70555201, 'attached', 'srug86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'jmc1', 'Jesús', 'Manzano Caso', 926319911, 5, 'Universidad Politécnica de Valencia', 'Ingeniero Industrial', 'Neumática\r\nAeromodelismo'),
(3421588, 'attached', 'ildian86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'lu78', 'Sara', 'Millán Lucero', 654327778, 3, 'Universidad de Castilla-La Mancha', 'Ingeniero Técnico en Informática de Sistemas', 'Rápida\r\nEficiente\r\n'),
(5353214, 'coordinator', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', 'fw3e', 'Carmen', 'Morales Prieto', 637923112, 4, 'Universidad de las Palmas de Gran Canarias', 'Jefa de proyecto sobre los fondos marinos de la zona este de las Islas Canarias.\r\nEncargada del análisis molecular de animales en peligro de extinción', 'animales, biología, molecular'),
(1324123, 'attached', 'uoohh@hotmail.com', 'f9aa902916e813ab39d6b48fe172e2b7df98d28f', 'luis', 'Pepe', 'Unpurito', 743892729, 2, 'Dux', '', 'UCLM'),
(3412367, 'expert', 'uoohh@hotmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'luis', 'José Ramón', 'De la Morena', 687342353, 5, 'Universidad Complutense de Madrid', 'Doctor en Arquitectura', 'Infraestructura\r\nDiseño ecológico\r\n'),
(5720012, 'expert', 'srug86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'aob1', 'Antoni', 'Olivé Boix', 699123222, 5, 'Universidad de Barcelona', 'Ingeniero Técnico Electricidad', 'Conductores\r\nDiodos\r\nConmutadores'),
(5655433, 'expert', 'srug86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'dpv1', 'Diego', 'Pompeyo Valdés', 611982211, 5, 'Universidad Europea de Madrid', 'Ingeniero Técnico Mecánica', 'Construcción\r\nConducción\r\nAutomoción'),
(54548332, 'expert', 'alisesan86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', 'ol43', 'Dolores', 'Novillo García\r\n', 656452438, 3, 'Universidad de Cantabria', 'Blue:Sens, Telefónica\r\n', 'Comunicaciones, Redes'),
(64514132, 'attached', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', '7dkj', 'Esperanza', 'Aguirre Gil de Biedma', 53232342, 4, 'Gobierno Español', 'Presidenta de la Comunidad de Madrid.\r\nColaboración con Luigi Galvani para descubrir la existencia de actividad eléctrica en animales.', 'química, farmacología, patología del sistema nervioso'),
(73793234, 'expert', 'alisesan86@gmail.com', 'e1abf4c6220c30de9f4be07fefe733bd264fbf43', '48sl', 'Giraldo', 'Ruíz Morote', 643212343, 3, 'Universidad de Castilla-La Mancha', 'CHICO, ALARCOS', 'dinámica, emprendedora'),
(2121234, 'attached', 'ildian86@gmail.com', '6c973e8803b3fbaabfb09dd916e295ed24da1d43', '21cr', 'Nuria', 'Ballesta Lorca', 12343, 1, 'ACS', 'Arquitecto\r\nDoctor Inmobiliario', 'Predisposición Inmediata\r\nGran experiencia Inmobiliaria'),
(9836422, 'attached', 'alisesan86@gmail.com', '0eb9ea0bef58bbe654059ac7e27f67c2e8eb9240', 'ek32', 'Paquita', 'Chocolatera', 63722234, 4, 'Fundación Biociencia', 'Análisis molecular de sustancias, Herramientas de Biología Molecular, Biotecnología y Biofarmacéutica, Consultoría en aspectos de Biociencias, Soporte en infraestructura y conocimiento para investigaciones Biocientíficas, Desarrollo de productos bio', 'biología, geobiología, proyecto, aspecto social');

