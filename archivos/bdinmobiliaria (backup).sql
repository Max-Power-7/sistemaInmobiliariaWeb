-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2021 a las 23:20:12
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdinmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agente`
--

CREATE TABLE `agente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ci` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `agente`
--

INSERT INTO `agente` (`id`, `ci`, `nombre`, `apellidos`, `telefono`, `direccion`, `estado`) VALUES
(1, 78787441, 'Mario', 'Gomez', 7445121, 'Calle bolivar', '1'),
(2, 154411, 'Julio', 'Marquez', 78415211, 'calle independiente', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ci` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipoPropiedad` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `tipo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razonSocial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `direccion`, `correo`, `telefono`, `tipo`, `ci`, `nombre`, `apellidos`, `razonSocial`) VALUES
(1, 'calle la paz', 'mercado@gmail.com', 75388964, 'persona', 0, 'Julio', 'Mercados Duran', NULL),
(2, 'calle 24 septiembre', 'tigo@hotmail.com', 335644, 'empresa', 0, NULL, NULL, 'Tigo'),
(3, 'calle junin', 'soboce@gmail.com', 3356478, 'empresa', 0, NULL, NULL, 'soboce'),
(4, 'calle villa cbba', 'salazarmario@gmail.com', 75488965, 'persona', 8111411, 'Mario', 'Salazar', NULL),
(5, 'Avenida florida c/3', 'ronald_valdivia@hotmail.com', 75388927, 'persona', 8174410, 'Karen', 'Vargas Perez', NULL),
(6, 'calle villa cbba', 'pancho@gmail.com', 77676321, 'persona', 8912121, 'Francisco', 'Prado Ligua', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota`
--

CREATE TABLE `cuota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(11,2) NOT NULL,
  `estado` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPlanCredito` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuota`
--

INSERT INTO `cuota` (`id`, `fecha`, `monto`, `estado`, `idPlanCredito`) VALUES
(1, '2021-08-19', '3300.00', '0', 1),
(2, '2022-02-19', '3300.00', '0', 1),
(3, '2022-08-19', '3300.00', '0', 1),
(4, '2023-02-19', '3300.00', '0', 1),
(5, '2021-08-19', '155833.33', '0', 2),
(6, '2021-09-19', '155833.33', '0', 2),
(7, '2021-10-19', '155833.33', '0', 2),
(8, '2021-11-19', '155833.33', '0', 2),
(9, '2021-12-19', '155833.33', '0', 2),
(10, '2022-01-19', '155833.33', '0', 2),
(11, '2022-02-19', '155833.33', '0', 2),
(12, '2022-03-19', '155833.33', '0', 2),
(13, '2022-04-19', '155833.33', '0', 2),
(14, '2022-05-19', '155833.33', '0', 2),
(15, '2022-06-19', '155833.33', '0', 2),
(16, '2022-07-19', '155833.33', '0', 2),
(17, '2022-08-19', '155833.33', '0', 2),
(18, '2022-09-19', '155833.33', '0', 2),
(19, '2022-10-19', '155833.33', '0', 2),
(20, '2022-11-19', '155833.33', '0', 2),
(21, '2022-12-19', '155833.33', '0', 2),
(22, '2023-01-19', '155833.33', '0', 2),
(23, '2023-02-19', '155833.33', '0', 2),
(24, '2023-03-19', '155833.33', '0', 2),
(25, '2023-04-19', '155833.33', '0', 2),
(26, '2023-05-19', '155833.33', '0', 2),
(27, '2023-06-19', '155833.33', '0', 2),
(28, '2023-07-19', '155833.33', '1', 2),
(29, '2021-08-25', '35750.00', '0', 20),
(30, '2022-02-25', '35750.00', '0', 20),
(31, '2022-08-25', '35750.00', '0', 20),
(32, '2023-02-25', '35750.00', '0', 20),
(57, '2021-08-25', '4312.50', '0', 27),
(58, '2022-02-25', '4312.50', '0', 27),
(59, '2022-08-25', '4312.50', '0', 27),
(60, '2023-02-25', '4312.50', '1', 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ci` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `ci`, `nombre`, `apellidos`, `fecha_nacimiento`, `telefono`, `direccion`, `estado`) VALUES
(1, 8174410, 'Ronald', 'Valdivia Prado', '0000-00-00', 75388927, 'Avenida florida c/3', '1'),
(3, 7588884, 'Paul', 'Luna', '1997-08-01', 75388967, 'Divino niño', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcionFoto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idPropiedad` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `foto`, `descripcionFoto`, `idPropiedad`) VALUES
(1, 't8Ra0P15hoIsl1ZU.jpg', 'foto de la entrada', 1),
(2, '3wAUeqBKClP4gqcv.jpg', 'foto del patio', 1),
(3, 'i6WdaslzFnv4QYTN.jpg', 'foto 1', 2),
(4, 'ZlCRWVR7P8NmJ1jJ.jpg', 'foto 2', 2),
(5, 'cVXIZb3iu5Q01Aml.jpg', 'la entrada', 3),
(6, 'F61nr4qEvjyi1eRe.jpg', 'foto del patio', 3),
(7, 'TbZu5z0TbnCxOQi0.jpg', 'foto de entrada', 4),
(8, 'uF1QirVojFdOjzxf.jpg', 'foto de la picina', 4),
(9, '1nnIgCXeGCMJrmYa.jpg', 'foto del terreno', 5),
(10, 'mP9OGm7jcMzOW3u5.jpg', 'foto del terreno', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provincia` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `municipio` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`id`, `provincia`, `municipio`, `ciudad`, `estado`) VALUES
(1, 'obispo santistevan', 'Montero', 'Montero', '1'),
(2, 'obispo santistevan', 'Minero', 'Minero', '1'),
(3, 'obispo santistevan', 'Saavedra', 'Saavedra', '1'),
(4, 'obispo santistevan', 'Fernandez alonso', 'chane', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logincliente`
--

CREATE TABLE `logincliente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuarioCliente` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idCliente` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `logincliente`
--

INSERT INTO `logincliente` (`id`, `usuarioCliente`, `password`, `idCliente`) VALUES
(1, 'Mario', '123456', 4),
(4, 'Karen', '8174410', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_08_14_145953_create_agente', 1),
(4, '2021_08_14_174501_create_cliente_table', 1),
(5, '2021_08_14_174552_create_propietario_table', 1),
(6, '2021_08_14_174623_create_categoria_table', 1),
(7, '2021_08_14_174648_create_localidad_table', 1),
(8, '2021_08_14_174714_create_empleado_table', 1),
(9, '2021_08_14_174741_create_usuario_table', 1),
(10, '2021_08_14_174818_create_propiedad_table', 1),
(11, '2021_08_14_174859_create_imagen_table', 1),
(12, '2021_08_14_174952_create_notaventa_table', 1),
(13, '2021_08_15_153941_create_plancredito', 1),
(14, '2021_08_15_161057_create_cuota', 1),
(15, '2021_08_17_071622_create_pago', 1),
(16, '2021_08_19_172147_create_asignacion', 1),
(17, '2021_08_25_131812_create_login_cliente', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notaventa`
--

CREATE TABLE `notaventa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `tipoPago` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montoTotal` decimal(11,2) NOT NULL,
  `estado` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPropiedad` bigint(20) UNSIGNED NOT NULL,
  `idCliente` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notaventa`
--

INSERT INTO `notaventa` (`id`, `fecha`, `tipoPago`, `montoTotal`, `estado`, `idPropiedad`, `idCliente`) VALUES
(7, '2021-08-19', 'contado', '250000.00', '1', 3, 2),
(8, '2021-08-19', 'credito', '12000.00', '1', 2, 3),
(9, '2021-08-19', 'credito', '3400000.00', '1', 5, 1),
(27, '2021-08-25', 'credito', '130000.00', '1', 4, 5),
(34, '2021-08-25', 'credito', '15000.00', '1', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(11,2) NOT NULL,
  `estado` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idCuota` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id`, `fecha`, `monto`, `estado`, `idCuota`) VALUES
(1, '2021-08-19', '155833.33', '1', 28),
(2, '2021-08-25', '4312.50', '1', 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plancredito`
--

CREATE TABLE `plancredito` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `montoTotal` decimal(11,2) NOT NULL,
  `tipoCredito` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plazo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interes` decimal(11,2) NOT NULL,
  `idNotaVenta` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plancredito`
--

INSERT INTO `plancredito` (`id`, `fecha`, `montoTotal`, `tipoCredito`, `plazo`, `interes`, `idNotaVenta`) VALUES
(1, '2021-08-19', '12000.00', 'semestral', '2', '10.00', 8),
(2, '2021-08-19', '3400000.00', 'mensual', '2', '10.00', 9),
(20, '2021-08-25', '130000.00', 'semestral', '2', '10.00', 27),
(27, '2021-08-25', '15000.00', 'semestral', '2', '15.00', 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedad`
--

CREATE TABLE `propiedad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metroCuadrado` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nroPiso` int(11) DEFAULT NULL,
  `inicioConstruccion` date DEFAULT NULL,
  `finConstruccion` date DEFAULT NULL,
  `precio` decimal(11,2) NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPropietario` bigint(20) UNSIGNED NOT NULL,
  `idLocalidad` bigint(20) UNSIGNED NOT NULL,
  `idAgente` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `propiedad`
--

INSERT INTO `propiedad` (`id`, `codigo`, `descripcion`, `metroCuadrado`, `nroPiso`, `inicioConstruccion`, `finConstruccion`, `precio`, `tipo`, `estado`, `idPropietario`, `idLocalidad`, `idAgente`) VALUES
(1, 'Vi-123', 'casa de color blanco', '12*24', 1, '2010-02-11', '2011-02-04', '15000.00', 'vivienda', 'vendido', 1, 1, 1),
(2, 'TR-105', 'terreno con cespez', '24*24', NULL, NULL, NULL, '12000.00', 'terreno', 'vendido', 2, 4, 1),
(3, 'TR-145', 'casa con patio y picina', '12*24', 1, NULL, NULL, '250000.00', 'vivienda', 'vendido', 3, 1, 2),
(4, 'Vi-555', 'casa con picina', '18*26', 1, NULL, NULL, '130000.00', 'vivienda', 'vendido', 3, 3, 1),
(5, 'TR-189', 'terreno con cespez y arboles', '38*40', NULL, NULL, NULL, '3400000.00', 'terreno', 'vendido', 4, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietario`
--

CREATE TABLE `propietario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ci` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `propietario`
--

INSERT INTO `propietario` (`id`, `ci`, `nombre`, `paterno`, `materno`, `telefono`, `direccion`, `estado`) VALUES
(1, 8787454, 'Roxana', 'Sanchez', 'Vallejos', 7585221, 'av Barrientos', '1'),
(2, 7878451, 'Mauricio', 'Perez', 'Perez', 787451111, 'Av. barriento c/2', '1'),
(3, 4784521, 'Romario', 'Paz', 'Vaca', 7811215, 'calle simon bolivar', '1'),
(4, 62162161, 'Herland', 'Vaca', 'Diez', 746261621, 'calle la cereza', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idEmpleado` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `password`, `tipo`, `estado`, `idEmpleado`) VALUES
(1, 'valdivia', '$2y$10$qYHPU0bf9dHvFNb41B6.POr/FZKzslqLkRpHqkpDHkOxBw3K91oxa', 'Administrador', '1', 1),
(2, 'paul', '$2y$10$qYHPU0bf9dHvFNb41B6.POr/FZKzslqLkRpHqkpDHkOxBw3K91oxa', 'Administrador', '1', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agente`
--
ALTER TABLE `agente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuota`
--
ALTER TABLE `cuota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuota_idplancredito_foreign` (`idPlanCredito`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagen_idpropiedad_foreign` (`idPropiedad`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logincliente`
--
ALTER TABLE `logincliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logincliente_idcliente_foreign` (`idCliente`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notaventa`
--
ALTER TABLE `notaventa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notaventa_idpropiedad_foreign` (`idPropiedad`),
  ADD KEY `notaventa_idcliente_foreign` (`idCliente`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pago_idcuota_foreign` (`idCuota`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `plancredito`
--
ALTER TABLE `plancredito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plancredito_idnotaventa_foreign` (`idNotaVenta`);

--
-- Indices de la tabla `propiedad`
--
ALTER TABLE `propiedad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propiedad_idpropietario_foreign` (`idPropietario`),
  ADD KEY `propiedad_idlocalidad_foreign` (`idLocalidad`),
  ADD KEY `propiedad_idagente_foreign` (`idAgente`);

--
-- Indices de la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_login_unique` (`login`),
  ADD KEY `usuario_idempleado_foreign` (`idEmpleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agente`
--
ALTER TABLE `agente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cuota`
--
ALTER TABLE `cuota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `logincliente`
--
ALTER TABLE `logincliente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `notaventa`
--
ALTER TABLE `notaventa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `plancredito`
--
ALTER TABLE `plancredito`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `propiedad`
--
ALTER TABLE `propiedad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `propietario`
--
ALTER TABLE `propietario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuota`
--
ALTER TABLE `cuota`
  ADD CONSTRAINT `cuota_idplancredito_foreign` FOREIGN KEY (`idPlanCredito`) REFERENCES `plancredito` (`id`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_idpropiedad_foreign` FOREIGN KEY (`idPropiedad`) REFERENCES `propiedad` (`id`);

--
-- Filtros para la tabla `logincliente`
--
ALTER TABLE `logincliente`
  ADD CONSTRAINT `logincliente_idcliente_foreign` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `notaventa`
--
ALTER TABLE `notaventa`
  ADD CONSTRAINT `notaventa_idcliente_foreign` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `notaventa_idpropiedad_foreign` FOREIGN KEY (`idPropiedad`) REFERENCES `propiedad` (`id`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_idcuota_foreign` FOREIGN KEY (`idCuota`) REFERENCES `cuota` (`id`);

--
-- Filtros para la tabla `plancredito`
--
ALTER TABLE `plancredito`
  ADD CONSTRAINT `plancredito_idnotaventa_foreign` FOREIGN KEY (`idNotaVenta`) REFERENCES `notaventa` (`id`);

--
-- Filtros para la tabla `propiedad`
--
ALTER TABLE `propiedad`
  ADD CONSTRAINT `propiedad_idagente_foreign` FOREIGN KEY (`idAgente`) REFERENCES `agente` (`id`),
  ADD CONSTRAINT `propiedad_idlocalidad_foreign` FOREIGN KEY (`idLocalidad`) REFERENCES `localidad` (`id`),
  ADD CONSTRAINT `propiedad_idpropietario_foreign` FOREIGN KEY (`idPropietario`) REFERENCES `propietario` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_idempleado_foreign` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
