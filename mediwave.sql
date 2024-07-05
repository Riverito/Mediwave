-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 05:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediwavees`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajustes_inventario`
--

CREATE TABLE `ajustes_inventario` (
  `idAjuste` varchar(10) NOT NULL,
  `idArticulo` varchar(10) DEFAULT NULL,
  `cantidadAjuste` int(11) DEFAULT NULL,
  `razonAjuste` varchar(255) DEFAULT NULL,
  `fechaHoraAjuste` datetime NOT NULL DEFAULT current_timestamp(),
  `idUsuario` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ajustes_inventario`
--

INSERT INTO `ajustes_inventario` (`idAjuste`, `idArticulo`, `cantidadAjuste`, `razonAjuste`, `fechaHoraAjuste`, `idUsuario`) VALUES
('123456', 'KzBLnT', 50, 'HOY SI', '2024-06-05 01:29:56', '2q9YO2'),
('R8n96M', '72WEdA', 44, 'asdasd', '2024-06-05 08:12:27', 'Y1lYyf'),
('ucM9U6', 'KzBLnT', 123, 'asdasdasdasd', '2024-06-05 01:44:29', 'Y1lYyf');

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `idArticulo` varchar(10) NOT NULL,
  `nombreArticulo` varchar(255) NOT NULL,
  `descripcionArticulo` text DEFAULT NULL,
  `cantidadArticulo` int(11) NOT NULL DEFAULT 0,
  `ultima_entrada` datetime DEFAULT NULL,
  `ultima_salida` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventario`
--

INSERT INTO `inventario` (`idArticulo`, `nombreArticulo`, `descripcionArticulo`, `cantidadArticulo`, `ultima_entrada`, `ultima_salida`) VALUES
('72WEdA', 'ssssss', 'ssssssssssss', 44, NULL, NULL),
('KzBLnT', 'Paracetamol', 'Tabletas de 15 pastillas para adultos', 271, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

CREATE TABLE `pacientes` (
  `idPaciente` varchar(10) NOT NULL,
  `nombrePaciente` varchar(255) NOT NULL,
  `apellidoPaciente` varchar(255) NOT NULL,
  `cedulaPaciente` varchar(20) NOT NULL,
  `fechaNacimientoPaciente` date NOT NULL,
  `generoPaciente` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registros_medicos`
--

CREATE TABLE `registros_medicos` (
  `idRegistro` varchar(10) NOT NULL,
  `idPaciente` varchar(10) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `rutaArchivoRegistro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`idRol`, `nombreRol`) VALUES
(1, 'Administrador'),
(2, 'Doctor'),
(3, 'Enfermero');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` varchar(10) NOT NULL,
  `nombreUsuario` varchar(50) DEFAULT NULL,
  `contrasenaUsuario` varchar(255) DEFAULT NULL,
  `apellidoUsuario` varchar(50) DEFAULT NULL,
  `cedulaUsuario` varchar(20) DEFAULT NULL,
  `emailUsuario` varchar(100) DEFAULT NULL,
  `idRol` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `contrasenaUsuario`, `apellidoUsuario`, `cedulaUsuario`, `emailUsuario`, `idRol`) VALUES
('2q9YO2', 'stefa', '$2y$10$EQgt39rOFipSt83/Og6KIOvLVKyDm3CJISJzsFC334xOe4wJLK6zy', 'Rssd', '1236548', 'stefa@gmail.com', 3),
('tCgEjI', 'Greyvin', '$2y$10$tL.0702OY7iaiD54noU6KOxSRChMuC5Mtgbtl7w8Lzrgw529C74Te', 'Rivero', '28046959', 'greyvinpaz@gmail.com', 2),
('veWvW9', 'Juano', '$2y$10$bObE9KL17AeMmJ6yklhZ6.mEiZAegDgEoEKuwsSe4W991Mx3cs6tO', 'Magano', '12345677', 'gu@gmail.com', 1),
('Y1lYyf', 'Riverito', '$2y$10$NpvDvCPTJ5nQ/eDlRJNwJuP2u5b3cWE2tOyQso3MuQlYPwUquBHAa', 'Rivero', '12345678', 'greyvinpazz@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajustes_inventario`
--
ALTER TABLE `ajustes_inventario`
  ADD PRIMARY KEY (`idAjuste`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `fk_idArticulo` (`idArticulo`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idArticulo`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`idPaciente`);

--
-- Indexes for table `registros_medicos`
--
ALTER TABLE `registros_medicos`
  ADD PRIMARY KEY (`idRegistro`),
  ADD KEY `idPaciente` (`idPaciente`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ajustes_inventario`
--
ALTER TABLE `ajustes_inventario`
  ADD CONSTRAINT `ajustes_inventario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `fk_idArticulo` FOREIGN KEY (`idArticulo`) REFERENCES `inventario` (`idArticulo`);

--
-- Constraints for table `registros_medicos`
--
ALTER TABLE `registros_medicos`
  ADD CONSTRAINT `registros_medicos_ibfk_1` FOREIGN KEY (`idPaciente`) REFERENCES `pacientes` (`idPaciente`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
