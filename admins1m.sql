-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2024 a las 04:51:59
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica_animales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins1m`
--

CREATE TABLE `admins1m` (
  `ida` int(6) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombreadmin` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `contrasenia` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'activo',
  `perfil` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `admins1m`
--

INSERT INTO `admins1m` (`ida`, `nombre`, `nombreadmin`, `contrasenia`, `estado`, `perfil`) VALUES
(15, 'admin1', 'admin1', '$2y$10$foRj.Zz/aiwUlzW.8UWbr.HEUafYYDS5bMIAkJmQkyQw2vp0JSgbu', 'activo', 'administrador'),
(16, 'maestro', 'maestro', '$2y$10$TJbwasNavpf3o2O8Y/kst.5h1Ik.IQ6t0qazMBqjAYCJKCYfQnIdW', 'activo', 'maestro'),
(17, 'usuario', 'usuario', '$2y$10$ZZW2fnPYlrjMjgBXwAq5qeqEUbcgJfTVlj8FweGOlf5vVW0BMdH6u', 'activo', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins1m`
--
ALTER TABLE `admins1m`
  ADD PRIMARY KEY (`ida`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins1m`
--
ALTER TABLE `admins1m`
  MODIFY `ida` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
