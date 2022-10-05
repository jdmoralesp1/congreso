-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2022 at 03:15 PM
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
(1, '$2y$10$imPz.jGVb6POyxxNzZpBe.shPBNxr0t6Kxo4bYQ7/Vjmpcp2ePtT.', 'chojuanmorales@gmail.com', '', '', 0, 1);

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
(39, 'Alcalinos', '2022-10-06', '8:00', 1, 'meet.com', 9614756),
(40, 'Hidrantes', '2022-10-06', '10:00', 1, 'meet.com', 789737),
(41, 'Liquidos', '2022-10-07', '15:00', 1, 'meet.com', 9614756),
(42, 'Matrices', '2022-10-07', '12:15', 1, 'meet.com', 4871351),
(43, 'Montañas', '2022-10-08', '9:30', 1, 'meet.com', 45987123),
(44, 'Vectores', '2022-10-08', '11:15', 1, 'meet.com', 52345687),
(45, 'Materias Primas', '2022-10-06', '9:00', 1, 'meet.com', 7894561),
(46, 'Tierras', '2022-10-06', '7:00', 1, 'meet.com', 4871351),
(47, 'Geometria', '2022-10-07', '16:30', 1, 'meet.com', 1),
(48, 'Topografia', '2022-10-07', '14:20', 1, 'meet.com', 4871351),
(49, 'Estructuras', '2022-10-08', '11:15', 1, 'meet.com', 45987123),
(50, 'Electromagnetismo', '2022-10-08', '15:00', 1, 'meet.com', 45987123),
(51, 'Fosiles', '2022-10-08', '15:00', 1, 'meet.com', 52345687),
(52, 'Mallas', '2022-10-08', '9:30', 1, 'meet.com', 789737),
(53, 'Seguridad', '2022-10-07', '14:20', 1, 'meet.com', 52345687),
(54, 'Construcción en madera', '2022-10-07', '16:30', 1, 'meet.com', 4871351),
(55, 'Levantamiento', '2022-10-07', '15:00', 1, 'meet.com', 10354789),
(56, 'Herramientas', '2022-10-07', '12:15', 1, 'meet.com', 4871351),
(57, 'Aplicaciones', '2022-10-06', '10:00', 1, 'meet.com', 7894561),
(58, 'Minerales', '2022-10-06', '8:00', 1, 'meet.com', 789737),
(59, 'Nuevas tecnologias', '2022-10-06', '7:00', 1, 'meet.com', 7894561),
(60, 'Maquinaria', '2022-10-06', '9:00', 1, 'meet.com', 10354789);

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
(39, 9614756, 4541784),
(39, 9614756, 79474955),
(40, 789737, 6348751),
(40, 789737, 45961275),
(40, 789737, 1031154576),
(41, 9614756, 6348751),
(41, 9614756, 45961275),
(41, 9614756, 1031154576),
(42, 4871351, 6348751),
(42, 4871351, 45961275),
(42, 4871351, 1031154576),
(43, 45987123, 6348751),
(43, 45987123, 79474955),
(44, 52345687, 4541784),
(44, 52345687, 6348751),
(44, 52345687, 79474955),
(45, 7894561, 6348751),
(45, 7894561, 79474955),
(45, 7894561, 1031154576),
(46, 4871351, 6348751),
(46, 4871351, 1031154576),
(47, 1, 6348751),
(47, 1, 1031154576),
(48, 4871351, 4541784),
(48, 4871351, 1031154576),
(49, 45987123, 45961275),
(49, 45987123, 1031154576),
(50, 45987123, 1031154576),
(51, 52345687, 6348751),
(51, 52345687, 45961275),
(51, 52345687, 79474955),
(52, 789737, 4541784),
(52, 789737, 45961275),
(52, 789737, 1031154576),
(53, 52345687, 45961275),
(53, 52345687, 79474955),
(54, 4871351, 45961275),
(54, 4871351, 79474955),
(55, 10354789, 4541784),
(55, 10354789, 79474955),
(56, 4871351, 4541784),
(56, 4871351, 79474955),
(57, 7894561, 79474955),
(58, 789737, 6348751),
(58, 789737, 45961275),
(58, 789737, 1031154576),
(59, 7894561, 4541784),
(59, 7894561, 45961275),
(59, 7894561, 79474955),
(60, 10354789, 4541784),
(60, 10354789, 45961275);

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
(4871351, 'Andres Moral', 'fardi@f.com', 1),
(7894561, 'Carlos Villagran', 'car@car.com', 1),
(9614756, 'Laura Clavijo', 'laclavijo@u.com', 1),
(10354789, 'Nicol Baca', 'nivol@nicol.com', 1),
(16487541, 'Laura', 'fardi@f.com', 0),
(45987123, 'Peter Fierro', 'peter@u.com', 1),
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
(36, 658741747, 4574121, 1),
(41, 4187121, 4541784, 1),
(42, 3225698741, 79474955, 1),
(43, 3044052793, 1031154576, 1),
(44, 96547154, 45961275, 1),
(45, 5874152, 6348751, 1);

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
(4541784, 'Carlos Andresiño', 'David', 'Distrital', 'jdmoralesp1@outlook.com', '$2y$10$ZjlGYYuoa6DMq6yY7UQFYut0EdQ7ERMo.zvmpeO7KGMkdUtX9kSO6', '2022-10-05 07:25:04', 1, '3fd5765d986f48d20370ac6339d344a4', '', 0),
(4574121, 'Juan', 'Morales', 'Distrital Francisco Jose ', 'jdmoralesp@correo.udistrital.edu.co', '$2y$10$zHBzBrPRTCmKEtS6XSQ0kernvictftTMsTEHc2JtWZ5XsUUO7Flyi', '2022-10-05 07:05:18', 1, '2cfba9cf142e2971092ad52c25bf2c7a', '', 0),
(6348751, 'Ricardo', 'Moreno', 'Universidad pedagogica', 'ricardomoralesmoreno@gmail.com', '$2y$10$xOVuYorV.7fF5CnQgrb18.lpPJaFvVy6XlvRt7UNDi73FSiDflgCW', '2022-10-05 07:24:26', 1, '90cec645e3a6e5d1c6a8a2dc44e69cb2', '', 0),
(45961275, 'Arturo', 'Silva', 'Universidad Sergio Arboleda', 'arturogsilvag@gmail.com', '$2y$10$ErU4tBSruttwbtc1kXir3O3RgM83mUO4EZpdbeBEp25q0nAAtecm6', '2022-10-05 07:25:51', 1, '85120b66c7ba321b3445b6a9395b45d8', '', 0),
(79474955, 'Ricardo', 'Morales', 'N/A', 'ricardomorales@gmail.com', '$2y$10$VrzLRqJfQ2/maPSe8NEMlOGi06SxgwnPCC5FvHbAAA8udGTe2WE9K', '2022-10-05 07:26:36', 1, '9847fe968163e92336778be9e80d9c6a', '', 0),
(1023038928, 'LAURA ALEJANDRA', 'CLAVIJO GIL', 'UNIVERSIDAD DISTRITAL FJDC', 'LACLAVIJOG@GMAIL.COM', '$2y$10$ePKBk1PU9grgcdN4uyBa1ud1Y7uwvjEETYmtzK8VTf0Yf5iqSB6TG', '2022-04-27 20:08:43', 1, 'b676a09b159421b0d337a95aaa3e5679', '', 0),
(1031154576, 'Johan', 'Pinzón', 'UniAndes', 'johanmrls33@gmail.com', '$2y$10$GMJQtSoFCvLvJhZxgUzgqO9fVpz.5x3R/c5WcfS3LATqrLE23gHue', '2022-10-05 07:28:43', 1, '0546b2b57cd1de38660211643f62994d', '', 0);

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
  MODIFY `id_confer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `telefonousuarios`
--
ALTER TABLE `telefonousuarios`
  MODIFY `id_tel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
