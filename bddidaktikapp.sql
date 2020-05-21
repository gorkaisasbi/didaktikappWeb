-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-05-2020 a las 22:29:07
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bddidaktikapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadErrota`
--

CREATE TABLE `actividadErrota` (
  `id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fragment` int(11) NOT NULL,
  `frases` varchar(150) NOT NULL,
  `foto1` longblob DEFAULT NULL,
  `foto2` longblob DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadGernika`
--

CREATE TABLE `actividadGernika` (
  `id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fragment` int(11) NOT NULL,
  `test` varchar(150) NOT NULL,
  `puzle` varchar(150) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadSanMiguel`
--

CREATE TABLE `actividadSanMiguel` (
  `id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fragment` int(11) NOT NULL,
  `test` varchar(150) NOT NULL,
  `fotos` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadTrena`
--

CREATE TABLE `actividadTrena` (
  `id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fragment` int(11) NOT NULL,
  `puzle` varchar(150) NOT NULL,
  `palabra` varchar(150) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadUnibertsitatea`
--

CREATE TABLE `actividadUnibertsitatea` (
  `id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fragment` int(11) NOT NULL,
  `test` varchar(150) NOT NULL,
  `foto1` longblob DEFAULT NULL,
  `foto2` longblob DEFAULT NULL,
  `foto3` longblob DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadZumeltzegi`
--

CREATE TABLE `actividadZumeltzegi` (
  `id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fragment` int(11) NOT NULL,
  `foto1` varchar(150) NOT NULL,
  `foto2` varchar(150) NOT NULL,
  `sopa` varchar(150) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cardGrupos`
--

CREATE TABLE `cardGrupos` (
  `idusuario` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idGrupo` int(11) NOT NULL,
  `nombreGrupo` varchar(150) NOT NULL,
  `fechaInicio` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaFin` datetime DEFAULT NULL,
  `deviceId` varchar(150) NOT NULL,
  `idAct1` int(11) DEFAULT NULL,
  `idAct2` int(11) DEFAULT NULL,
  `idAct3` int(11) DEFAULT NULL,
  `idAct4` int(11) DEFAULT NULL,
  `idAct5` int(11) DEFAULT NULL,
  `idAct6` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listas`
--

CREATE TABLE `listas` (
  `idLista` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombreLista` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listasGrupos`
--

CREATE TABLE `listasGrupos` (
  `idLista` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `imagen` blob NOT NULL,
  `estiloAuto` tinyint(1) DEFAULT NULL,
  `indCardListas` tinyint(1) DEFAULT NULL,
  `dash` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividadErrota`
--
ALTER TABLE `actividadErrota`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `actividadGernika`
--
ALTER TABLE `actividadGernika`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `actividadSanMiguel`
--
ALTER TABLE `actividadSanMiguel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `actividadTrena`
--
ALTER TABLE `actividadTrena`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `actividadUnibertsitatea`
--
ALTER TABLE `actividadUnibertsitatea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `actividadZumeltzegi`
--
ALTER TABLE `actividadZumeltzegi`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cardGrupos`
--
ALTER TABLE `cardGrupos`
  ADD PRIMARY KEY (`idusuario`,`idgrupo`),
  ADD KEY `FK_GRUPO_CARDGRUPO` (`idgrupo`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idGrupo`),
  ADD UNIQUE KEY `deviceId` (`deviceId`),
  ADD KEY `FK_ACT1` (`idAct1`),
  ADD KEY `FK_ACT2` (`idAct2`),
  ADD KEY `FK_ACT3` (`idAct3`),
  ADD KEY `FK_ACT4` (`idAct4`),
  ADD KEY `FK_ACT5` (`idAct5`),
  ADD KEY `FK_ACT6` (`idAct6`);

--
-- Indices de la tabla `listas`
--
ALTER TABLE `listas`
  ADD PRIMARY KEY (`idLista`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `listasGrupos`
--
ALTER TABLE `listasGrupos`
  ADD PRIMARY KEY (`idLista`,`idGrupo`) USING BTREE,
  ADD KEY `FK_GRUPO` (`idGrupo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividadErrota`
--
ALTER TABLE `actividadErrota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `actividadGernika`
--
ALTER TABLE `actividadGernika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `actividadSanMiguel`
--
ALTER TABLE `actividadSanMiguel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `actividadTrena`
--
ALTER TABLE `actividadTrena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `actividadUnibertsitatea`
--
ALTER TABLE `actividadUnibertsitatea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT de la tabla `actividadZumeltzegi`
--
ALTER TABLE `actividadZumeltzegi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT de la tabla `listas`
--
ALTER TABLE `listas`
  MODIFY `idLista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cardGrupos`
--
ALTER TABLE `cardGrupos`
  ADD CONSTRAINT `FK_GRUPO_CARDGRUPO` FOREIGN KEY (`idgrupo`) REFERENCES `grupos` (`idGrupo`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_USUARIO_CARDGRUPOS` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `FK_ACT1` FOREIGN KEY (`idAct1`) REFERENCES `actividadZumeltzegi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ACT2` FOREIGN KEY (`idAct2`) REFERENCES `actividadSanMiguel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ACT3` FOREIGN KEY (`idAct3`) REFERENCES `actividadUnibertsitatea` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ACT4` FOREIGN KEY (`idAct4`) REFERENCES `actividadTrena` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ACT5` FOREIGN KEY (`idAct5`) REFERENCES `actividadErrota` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ACT6` FOREIGN KEY (`idAct6`) REFERENCES `actividadGernika` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `listas`
--
ALTER TABLE `listas`
  ADD CONSTRAINT `FK_USUARIO` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `listasGrupos`
--
ALTER TABLE `listasGrupos`
  ADD CONSTRAINT `FK_GRUPO` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`idGrupo`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_LISTA` FOREIGN KEY (`idLista`) REFERENCES `listas` (`idLista`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
