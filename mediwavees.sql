-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 03:08 AM
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
('ou5HxH', 'KzBLnT', 20, 'Llegada de nuevos insumos del mes de mayo', '2024-05-28 12:55:56', 'cwCmzz'),
('bTeOOP', 'KzBLnT', 5, 'porque hoy si', '2024-06-04 19:49:53', 'cwCmzz'),
('3xvNtF', 'F1gva1', 5, 'porque hoy si', '2024-06-04 19:49:53', 'cwCmzz'),
('GbUxeF', 'F1gva1', 60, '', '2024-06-04 19:54:20', 'cwCmzz'),
('nbKZFV', 'F1gva1', 10, 'si', '2024-06-04 19:54:35', 'cwCmzz'),
('eC0w9v', 'F1gva1', 34, 'se', '2024-06-04 20:18:06', 'ZuBJdd');

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
('KzBLnT', 'Paracetamol', 'Tabletas de 15 pastillas para adultos', 25, NULL, NULL),
('F1gva1', 'Greyvin', 'Rivero', 109, NULL, NULL),
('GBtUHV', 'pelo peluo', 'sxd', 0, NULL, NULL);

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

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`idPaciente`, `nombrePaciente`, `apellidoPaciente`, `cedulaPaciente`, `fechaNacimientoPaciente`, `generoPaciente`) VALUES
('MbgiWC', 'Maria', 'Rivas', '12345678', '1999-04-21', 'Femenino'),
('NXAXAi', 'Juan', 'Serrano', '26546789', '2007-04-11', 'Masculino'),
('VxYdpw', 'Greyvin', 'Rivero', '28046951', '2001-01-11', 'Masculino');

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
('ZuBJdd', 'Greyvin', '$2y$10$OurW/uo/zaEfDhhbRAO9F.quPGvOTvMv4R1gyudJ2QR.8r1Sk.5eq', 'Rivero', '28046958', 'greyvinpaz@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
