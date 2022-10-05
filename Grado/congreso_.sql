-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2022 at 03:59 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `congreso_`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `clave_admin` varchar(130) DEFAULT NULL,
  `usuario_admin` varchar(45) DEFAULT NULL,
  `token` varchar(40) NOT NULL,
  `token_password` varchar(100) NOT NULL,
  `password_request` int(11) NOT NULL,
  `estado_a` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `clave_admin`, `usuario_admin`, `token`, `token_password`, `password_request`, `estado_a`) VALUES
(1, '$2y$10$tUHDW6wY/jPURaDfSi8YtOSWEsyNoEvIk8k/gw.Ow5kN2qbA5p6n6', 'chojuanmorales@gmail.com', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `conferencia`
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
-- Dumping data for table `conferencia`
--

INSERT INTO `conferencia` (`id_confer`, `nomb_c`, `fecha_c`, `hora_c`, `estado_c`, `link_c`, `id_conferencista`) VALUES
(1, 'Suelos y subsuelos', '2022-03-02', '08:00', 1, 'Meet.com', 9614756),
(2, 'Carreteras', '2022-09-03', '08:00', 1, 'meet.com', 9614756),
(3, 'No se', '2022-03-02', '08:00', 1, 'meet.com', 9614756),
(5, 'Coloquio', '2021-12-16', '09:00', 1, 'meet.com', 789737),
(7, 'Minas', '2022-03-02', '09:00', 1, 'Meet.com', 52345687),
(8, 'Anime', '2020-12-16', '10:00', 1, 'Meet.com', 9614756),
(9, 'Matrices', '2021-03-11', '12:45', 1, 'meet.com', 789737),
(10, 'Vectores', '2021-02-10', '15:00', 1, 'meet.com', 7894561),
(11, 'nuevo', '2022-03-02', '08:00', 1, 'meet.com', 10354789),
(12, 'Matrices', '2022-03-02', '09:00', 1, 'meet.com', 1),
(13, 'Vectores', '2022-03-02', '10:00', 1, 'meet.com', 9614756);

-- --------------------------------------------------------

--
-- Table structure for table `conferencia_has_usuarios`
--

CREATE TABLE `conferencia_has_usuarios` (
  `Conferencia_id_confer` int(11) NOT NULL,
  `Conferencia_id_conferencista` int(11) NOT NULL,
  `Usuarios_id_u` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conferencia_has_usuarios`
--

INSERT INTO `conferencia_has_usuarios` (`Conferencia_id_confer`, `Conferencia_id_conferencista`, `Usuarios_id_u`) VALUES
(1, 9614756, 4574121),
(1, 9614756, 1023038928),
(5, 789737, 4574121),
(9, 789737, 4574121),
(9, 9614756, 1023038928),
(10, 7894561, 4574121),
(12, 9614756, 4574121),
(13, 9614756, 4574121);

-- --------------------------------------------------------

--
-- Table structure for table `conferencista`
--

CREATE TABLE `conferencista` (
  `id_conf` int(11) NOT NULL,
  `nomb_conf` varchar(45) DEFAULT NULL,
  `correo_c` varchar(45) DEFAULT NULL,
  `estado_co` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conferencista`
--

INSERT INTO `conferencista` (`id_conf`, `nomb_conf`, `correo_c`, `estado_co`) VALUES
(1, 'Por asignar', NULL, 0),
(789737, 'Farid Moreno', 'fardi@faraon.com', 1),
(7894561, 'Carlos Villagran', 'car@car.com', 1),
(9614756, 'Laura Clavijo', 'laclavijo@u.com', 1),
(10354789, 'Nicol Baca', 'nivol@nicol.com', 1),
(45987123, 'Peter Fierro', 'peter@u.com', 0),
(52345687, 'Mario ', 'mario@mario.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `telefonousuarios`
--

CREATE TABLE `telefonousuarios` (
  `id_tel` int(11) NOT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `idUsu` int(11) NOT NULL,
  `estado_t` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `telefonousuarios`
--

INSERT INTO `telefonousuarios` (`id_tel`, `telefono`, `idUsu`, `estado_t`) VALUES
(34, 3204777780, 1023038928, 1),
(36, 658741278, 4574121, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_u` int(11) NOT NULL,
  `nomb_u` varchar(45) DEFAULT NULL,
  `apel_u` varchar(45) DEFAULT NULL,
  `univ_u` varchar(45) DEFAULT NULL,
  `correo_u` varchar(80) DEFAULT NULL,
  `clave_u` varchar(130) DEFAULT NULL,
  `last_session` datetime DEFAULT NULL,
  `estado_u` int(1) NOT NULL DEFAULT 0,
  `token` varchar(40) NOT NULL,
  `token_password` varchar(100) NOT NULL,
  `password_request` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_u`, `nomb_u`, `apel_u`, `univ_u`, `correo_u`, `clave_u`, `last_session`, `estado_u`, `token`, `token_password`, `password_request`) VALUES
(4574121, 'Juan', 'Morales', 'Distrital Francisco Jose Caldas', 'jdmoralesp@correo.udistrital.edu.co', '$2y$10$vWmzs5UEXW7UFEvNg7/bmeKm/jt2OvpEf3G33Bt0X9mfu2yCBNtSq', '2022-09-04 19:30:55', 1, '2cfba9cf142e2971092ad52c25bf2c7a', '', 0),
(1023038928, 'LAURA ALEJANDRA', 'CLAVIJO GIL', 'UNIVERSIDAD DISTRITAL FJDC', 'LACLAVIJOG@GMAIL.COM', '$2y$10$ePKBk1PU9grgcdN4uyBa1ud1Y7uwvjEETYmtzK8VTf0Yf5iqSB6TG', '2022-04-27 20:08:43', 1, 'b676a09b159421b0d337a95aaa3e5679', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `conferencia`
--
ALTER TABLE `conferencia`
  ADD PRIMARY KEY (`id_confer`),
  ADD KEY `fk_Conferencia_Conferencista1` (`id_conferencista`);

--
-- Indexes for table `conferencia_has_usuarios`
--
ALTER TABLE `conferencia_has_usuarios`
  ADD PRIMARY KEY (`Conferencia_id_confer`,`Conferencia_id_conferencista`,`Usuarios_id_u`),
  ADD KEY `fk_Conferencia_has_Usuarios_Conferencia2` (`Conferencia_id_conferencista`),
  ADD KEY `fk_Conferencia_has_Usuarios_Usuarios1` (`Usuarios_id_u`);

--
-- Indexes for table `conferencista`
--
ALTER TABLE `conferencista`
  ADD PRIMARY KEY (`id_conf`);

--
-- Indexes for table `telefonousuarios`
--
ALTER TABLE `telefonousuarios`
  ADD PRIMARY KEY (`id_tel`),
  ADD KEY `fk_TelefonoUsuarios_Usuarios` (`idUsu`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_u`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conferencia`
--
ALTER TABLE `conferencia`
  MODIFY `id_confer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `telefonousuarios`
--
ALTER TABLE `telefonousuarios`
  MODIFY `id_tel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conferencia`
--
ALTER TABLE `conferencia`
  ADD CONSTRAINT `fk_Conferencia_Conferencista1` FOREIGN KEY (`id_conferencista`) REFERENCES `conferencista` (`id_conf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conferencia_has_usuarios`
--
ALTER TABLE `conferencia_has_usuarios`
  ADD CONSTRAINT `fk_Conferencia_has_Usuarios_Conferencia1` FOREIGN KEY (`Conferencia_id_confer`) REFERENCES `conferencia` (`id_confer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Conferencia_has_Usuarios_Conferencia2` FOREIGN KEY (`Conferencia_id_conferencista`) REFERENCES `conferencia` (`id_conferencista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Conferencia_has_Usuarios_Usuarios1` FOREIGN KEY (`Usuarios_id_u`) REFERENCES `usuarios` (`id_u`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `telefonousuarios`
--
ALTER TABLE `telefonousuarios`
  ADD CONSTRAINT `fk_TelefonoUsuarios_Usuarios` FOREIGN KEY (`idUsu`) REFERENCES `usuarios` (`id_u`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
