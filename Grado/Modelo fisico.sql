-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2022 a las 05:36:09
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `congreso_`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `clave_admin` varchar(45) DEFAULT NULL,
  `usuario_admin` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `clave_admin`, `usuario_admin`) VALUES
(1, '123456', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conferencia`
--

CREATE TABLE `conferencia` (
  `id_confer` int(11) NOT NULL,
  `nomb_c` varchar(45) DEFAULT NULL,
  `fecha_c` date DEFAULT NULL,
  `hora_c` varchar(45) DEFAULT NULL,
  `estado_c` int(1) DEFAULT NULL,
  `link_c` varchar(200) DEFAULT NULL,
  `id_conferencista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `conferencia`
--

INSERT INTO `conferencia` (`id_confer`, `nomb_c`, `fecha_c`, `hora_c`, `estado_c`, `link_c`, `id_conferencista`) VALUES
(1, 'Suelos y subsuelos', '2022-03-02', '08:00', 1, 'Meet.com', 789737),
(2, 'Carreteras', '2022-03-02', '08:00', 1, 'meet.com', 7894561),
(3, 'No se', '2022-03-02', '08:00', 1, 'meet.com', 10354789),
(5, 'Coloquio', '2021-12-16', '09:00', 1, 'meet.com', 10354789),
(6, 'Hidrantes', '2020-12-16', '09:00', 1, 'meet.com', 45987123),
(7, 'Minas', '2022-03-02', '09:00', 1, 'Meet.com', 52345687),
(8, 'Anime', '2020-12-16', '10:00', 1, 'Meet.com', 9614756);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conferencia_has_usuarios`
--

CREATE TABLE `conferencia_has_usuarios` (
  `Conferencia_id_confer` int(11) NOT NULL,
  `Conferencia_id_conferencista` int(11) NOT NULL,
  `Usuarios_id_u` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `conferencia_has_usuarios`
--

INSERT INTO `conferencia_has_usuarios` (`Conferencia_id_confer`, `Conferencia_id_conferencista`, `Usuarios_id_u`) VALUES
(1, 789737, 7921456),
(2, 7894561, 7921456),
(2, 7894561, 9774578),
(6, 45987123, 7921456),
(8, 9614756, 7921456),
(8, 9614756, 10378456);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conferencista`
--

CREATE TABLE `conferencista` (
  `id_conf` int(11) NOT NULL,
  `nomb_conf` varchar(45) DEFAULT NULL,
  `correo_c` varchar(45) DEFAULT NULL,
  `estado_co` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `conferencista`
--

INSERT INTO `conferencista` (`id_conf`, `nomb_conf`, `correo_c`, `estado_co`) VALUES
(1, 'Por asignar', NULL, 0),
(789737, 'Farid Moreno', 'fardi@f.com', 1),
(7894561, 'Carlos Villagran', 'car@car.com', 1),
(9614756, 'Laura Clavijo', 'laclavijo@u.com', 1),
(10354789, 'Nicol Baca', 'nivol@nicol.com', 1),
(45987123, 'Peter Fierro', 'peter@u.com', 1),
(52345687, 'Mario ', 'mario@mario.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonousuarios`
--

CREATE TABLE `telefonousuarios` (
  `id_tel` int(11) NOT NULL,
  `telefono` int(20) DEFAULT NULL,
  `idUsu` int(11) NOT NULL,
  `estado_t` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `telefonousuarios`
--

INSERT INTO `telefonousuarios` (`id_tel`, `telefono`, `idUsu`, `estado_t`) VALUES
(1, 34578964, 9774578, 1),
(2, 894561, 75474955, 1),
(3, 301642066, 1241984, 1),
(4, 7426589, 5897463, 1),
(5, 47515640, 10378456, 1),
(6, 789063487, 10311798, 1),
(7, 4587411, 52142345, 1),
(9, 59781643, 14544345, 1),
(10, 301786412, 19748523, 1),
(22, 3697415, 7921456, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_u` int(11) NOT NULL,
  `nomb_u` varchar(45) DEFAULT NULL,
  `apel_u` varchar(45) DEFAULT NULL,
  `univ_u` varchar(45) DEFAULT NULL,
  `correo_u` varchar(45) DEFAULT NULL,
  `clave_u` varchar(45) DEFAULT NULL,
  `pregunta_u` varchar(32) NOT NULL,
  `estado_u` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_u`, `nomb_u`, `apel_u`, `univ_u`, `correo_u`, `clave_u`, `pregunta_u`, `estado_u`) VALUES
(1241984, 'carlos Andresiño', 'Castaño', 'Universidad Distritales', 'carlos@carloses.com', 'carlos12', 'amarillo', 1),
(5897463, 'Huilton Andres', 'molano', 'Distrital', 'huiwi@m.com', 'huilton123', 'blanco', 1),
(7921456, 'Ricardo', 'Paez', 'Nacional', 'r@r.com', 'ricardo', 'blanco', 1),
(9774578, 'Andres', 'Becerra', 'Nacional2', 'g@g.com', 'juanos23', 'blanco', 1),
(10311798, 'Juanes C.', 'Morales P', 'Universidad Distrital', 'jdmorales@udistri.com', 'Juan123', 'rosado', 1),
(10378456, 'juan', 'Valencia', 'Javeriana', 'jd@jd.com', 'jauajan a', 'rojo', 1),
(14544345, 'juan Mor. C', 'clamor123', 'Distrital', 'j@j.com', 'jau', 'lila', 1),
(19748523, 'Maria', 'Pinzón', 'Javeriana', 'mari@mari.com', 'maria', 'verde', 1),
(52142345, 'Juliana', 'Mejia', 'Distrital', 'juli@juli.com', 'jukiana123', 'morado', 1),
(75474955, 'Andres', 'mor', 'Nacional', 'juan@juan.com', '123456', 'rojo', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `conferencia`
--
ALTER TABLE `conferencia`
  ADD PRIMARY KEY (`id_confer`),
  ADD KEY `fk_Conferencia_Conferencista1` (`id_conferencista`);

--
-- Indices de la tabla `conferencia_has_usuarios`
--
ALTER TABLE `conferencia_has_usuarios`
  ADD PRIMARY KEY (`Conferencia_id_confer`,`Conferencia_id_conferencista`,`Usuarios_id_u`),
  ADD KEY `fk_Conferencia_has_Usuarios_Conferencia2` (`Conferencia_id_conferencista`),
  ADD KEY `fk_Conferencia_has_Usuarios_Usuarios1` (`Usuarios_id_u`);

--
-- Indices de la tabla `conferencista`
--
ALTER TABLE `conferencista`
  ADD PRIMARY KEY (`id_conf`);

--
-- Indices de la tabla `telefonousuarios`
--
ALTER TABLE `telefonousuarios`
  ADD PRIMARY KEY (`id_tel`),
  ADD KEY `fk_TelefonoUsuarios_Usuarios` (`idUsu`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_u`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `telefonousuarios`
--
ALTER TABLE `telefonousuarios`
  MODIFY `id_tel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `conferencia`
--
ALTER TABLE `conferencia`
  ADD CONSTRAINT `fk_Conferencia_Conferencista1` FOREIGN KEY (`id_conferencista`) REFERENCES `conferencista` (`id_conf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `conferencia_has_usuarios`
--
ALTER TABLE `conferencia_has_usuarios`
  ADD CONSTRAINT `fk_Conferencia_has_Usuarios_Conferencia1` FOREIGN KEY (`Conferencia_id_confer`) REFERENCES `conferencia` (`id_confer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Conferencia_has_Usuarios_Conferencia2` FOREIGN KEY (`Conferencia_id_conferencista`) REFERENCES `conferencia` (`id_conferencista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Conferencia_has_Usuarios_Usuarios1` FOREIGN KEY (`Usuarios_id_u`) REFERENCES `usuarios` (`id_u`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `telefonousuarios`
--
ALTER TABLE `telefonousuarios`
  ADD CONSTRAINT `fk_TelefonoUsuarios_Usuarios` FOREIGN KEY (`idUsu`) REFERENCES `usuarios` (`id_u`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
