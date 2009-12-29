-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-12-2009 a las 19:43:39
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `areas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eval_models`
--

CREATE TABLE IF NOT EXISTS `eval_models` (
  `id` int(10) NOT NULL auto_increment,
  `structure` text collate utf8_spanish_ci NOT NULL,
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


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects_packages`
--

CREATE TABLE IF NOT EXISTS `projects_packages` (
  `id` int(10) NOT NULL auto_increment,
  `institution` tinytext collate utf8_spanish_ci NOT NULL,
  `bases` tinytext collate utf8_spanish_ci NOT NULL,
  `convocatory` tinytext collate utf8_spanish_ci NOT NULL,
  `incoming_date` int(10) NOT NULL,
  `outcoming_date` int(10) NOT NULL,
  `deadline` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `projects_packages`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subareas`
--

CREATE TABLE IF NOT EXISTS `subareas` (
  `id` int(10) NOT NULL,
  `aid` int(10) NOT NULL COMMENT 'area id',
  `uid` int(10) NOT NULL COMMENT 'user id',
  `name` tinytext collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `subareas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(10) NOT NULL auto_increment,
  `subject` enum('register_user','invitation','notice_periods') collate utf8_spanish_ci NOT NULL,
  `body` tinytext collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `templates`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL auto_increment,
  `type` enum('secretary','coordinator','attached','expert') collate utf8_spanish_ci NOT NULL,
  `email` tinytext collate utf8_spanish_ci NOT NULL,
  `password` tinytext collate utf8_spanish_ci NOT NULL,
  `name` tinytext collate utf8_spanish_ci NOT NULL,
  `last_names` tinytext collate utf8_spanish_ci NOT NULL,
  `phone` int(10) NOT NULL,
  `area` int(10) NOT NULL,
  `institution` tinytext collate utf8_spanish_ci NOT NULL,
  `curriculum` tinytext collate utf8_spanish_ci NOT NULL,
  `keywords` tinytext collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `users`
--


