-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:33062
-- Tiempo de generación: 04-06-2024 a las 20:45:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carnes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidop` varchar(15) NOT NULL,
  `apellido_m` varchar(15) NOT NULL,
  `alias` varchar(18) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `genero` varchar(15) NOT NULL,
  `puesto` varchar(15) NOT NULL,
  `contrasena` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `apellidop`, `apellido_m`, `alias`, `telefono`, `genero`, `puesto`, `contrasena`) VALUES
(1, 'Yesenia', 'Montes	', 'Juarez', 'Yeseniamj10', '9511279010', 'Femenino', 'Administrador', 'root12345'),
(2, 'Jairo', 'Montes', 'Garcia', 'Jairomg10', '9512338710', 'Masculino', 'Administrador', 'Jairo93dj'),
(3, 'Saul', 'Torres', 'Santiago', 'Saults90', '9511279490', 'Masculino', 'Empleado', 'saul1234'),
(12, 'Fernando', 'Olivera', 'Velazquez', 'Fernandoov88', '9531124888', 'Masculino', 'Empleado', 'fernando12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_con_inventario`
--

CREATE TABLE `productos_con_inventario` (
  `id` int(11) UNSIGNED NOT NULL,
  `codigo_produc` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria` varchar(255) NOT NULL,
  `existencia` int(11) NOT NULL,
  `id_proveedor` int(11) UNSIGNED NOT NULL,
  `proveedor_nombre` varchar(255) DEFAULT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `stock_ideal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos_con_inventario`
--

INSERT INTO `productos_con_inventario` (`id`, `codigo_produc`, `nombre`, `img`, `descripcion`, `categoria`, `existencia`, `id_proveedor`, `proveedor_nombre`, `precio_compra`, `precio_venta`, `fecha_ingreso`, `fecha_vencimiento`, `status`, `stock_ideal`) VALUES
(1, 'P3C1235', 'Pechuga de pollo', 'pechuga_pollo.jpg', 'Pechuga de pollo fresca y sin piel', 'Carnes', 12, 2, 'Avicola San Juan', 75.40, 85.90, '2023-11-21', '2023-12-21', '1', 20),
(2, 'M0L1D1234', 'Carne de res molida', 'carne_res_molida.jpg', 'Carne de res molida fresca y de alta calidad', 'Carnes', 5, 1, 'Carniceria El Toro', 85.00, 99.90, '2023-11-22', '2023-12-22', '1', 20),
(3, 'JAM9865', 'Jamón de cerdo', 'jamon_cerdo.jpg', 'Jamón de cerdo de alta calidad', 'Carnes frías', 9, 3, 'Embutidos La Delicia', 65.00, 75.00, '2023-11-23', '2023-12-23', '1', 20),
(4, 'QU3S0654', 'Queso Oaxaca', 'queso_oaxaca.jpg', 'Queso Oaxaca fresco y de alta calidad', 'Lácteos', 18, 4, 'Productos Lácteos La Vaquita', 50.00, 60.00, '2023-11-24', '2023-12-24', '0', 30),
(5, 'L3CH3450', 'Leche entera', 'leche_entera.jpg', 'Leche entera fresca y de alta calidad', 'Lácteos', 48, 5, 'Lácteos La Pradera', 18.00, 22.00, '2023-11-25', '2023-12-25', '0', 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `contacto` varchar(50) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `contacto`, `telefono`, `correo`, `direccion`) VALUES
(1, 'Carniceria El Toro', 'Ernesto Javier', '9512563171', 'carneseltoro@gmail.com', 'frenos303 col,bosque norte'),
(2, 'Avicola San Juan', 'Zaira Vasquez', '9512563171', 'avicolasanjuan@gmail.com', 'frenos 300 col del bosque norte'),
(3, 'Embutidos La Delicia', 'Yahir Chimil', '9512563171', 'chimil_yahir@hotmail.com', 'frenos 300 col del bosque norte'),
(4, 'Productos Lácteos La Vaquita', 'Lacteos La Vaquita', '9512563171', 'lacteoslavaquita@hotmail.com', 'frenos 300 col del bosque norte'),
(5, 'Lácteos La Pradera', 'La Pradera', '9512563171', 'chimil_yahir@hotmail.com', 'frenos 300 col del bosque norte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) UNSIGNED NOT NULL,
  `numero_serie` varchar(255) NOT NULL,
  `id_empleado` int(11) UNSIGNED NOT NULL,
  `codigo_produc` varchar(255) NOT NULL,
  `nombre_producto` varchar(255) DEFAULT NULL,
  `categoria_producto` varchar(255) DEFAULT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `precio_producto` decimal(10,2) NOT NULL,
  `fecha_venta` date NOT NULL,
  `total_producto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `numero_serie`, `id_empleado`, `codigo_produc`, `nombre_producto`, `categoria_producto`, `cantidad_producto`, `precio_producto`, `fecha_venta`, `total_producto`) VALUES
(1, '20240525023406ce1f8c', 3, 'M0L1D1234', 'Carne de res molida', 'Carnes', 1, 99.90, '2024-05-25', 99.90),
(2, '20240525023406ce1f8c', 3, 'QU3S0654', 'Queso Oaxaca', 'Lácteos', 2, 60.00, '2024-05-25', 120.00),
(3, '20240525024453103755', 12, 'M0L1D1234', 'Carne de res molida', 'Carnes', 2, 99.90, '2024-05-25', 199.80),
(4, '202405250631585f0a40', 12, 'QU3S0654', 'Queso Oaxaca', 'Lácteos', 1, 60.00, '2024-05-25', 60.00),
(5, '202405250631585f0a40', 12, 'L3CH3450', 'Leche entera', 'Lácteos', 2, 22.00, '2024-05-25', 44.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_con_inventario`
--
ALTER TABLE `productos_con_inventario`
  ADD PRIMARY KEY (`id`,`codigo_produc`),
  ADD KEY `fk_productos_proveedores` (`id_proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`,`numero_serie`),
  ADD KEY `fk_ventas_empleado` (`id_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `productos_con_inventario`
--
ALTER TABLE `productos_con_inventario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos_con_inventario`
--
ALTER TABLE `productos_con_inventario`
  ADD CONSTRAINT `fk_productos_proveedores` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
