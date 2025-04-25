-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2024 a las 03:22:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_premoldeado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_clientes` int(11) NOT NULL,
  `clientes_estado` varchar(45) DEFAULT NULL,
  `clientes_fecha_alta` date DEFAULT NULL,
  `rela_personas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_clientes`, `clientes_estado`, `clientes_fecha_alta`, `rela_personas`) VALUES
(1, 'Activo', '2024-11-10', NULL),
(2, 'Activo', '2024-11-12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id_detalle_pedidos` int(11) NOT NULL,
  `rela_pedidos` int(11) NOT NULL,
  `rela_productos` int(11) DEFAULT NULL,
  `detalle_pedido_cantidad` int(11) DEFAULT 1,
  `detalle_pedido_precio_unitario` decimal(10,2) DEFAULT 0.00,
  `detalle_pedido_subtotal` decimal(10,2) GENERATED ALWAYS AS (`detalle_pedido_cantidad` * `detalle_pedido_precio_unitario`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id_detalle_pedidos`, `rela_pedidos`, `rela_productos`, `detalle_pedido_cantidad`, `detalle_pedido_precio_unitario`) VALUES
(1, 1, 1, 2, 150.00),
(2, 2, 2, 1, 200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_cabecera`
--

CREATE TABLE `factura_cabecera` (
  `id_factura_cabecera` int(11) NOT NULL,
  `factura_fecha` date NOT NULL,
  `factura_total` decimal(10,2) DEFAULT 0.00,
  `factura_estado` varchar(45) DEFAULT 'Emitida',
  `rela_clientes` int(11) DEFAULT NULL,
  `rela_metodos_pago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura_cabecera`
--

INSERT INTO `factura_cabecera` (`id_factura_cabecera`, `factura_fecha`, `factura_total`, `factura_estado`, `rela_clientes`, `rela_metodos_pago`) VALUES
(1, '2024-11-15', 500.00, 'Emitida', 1, 1),
(2, '2024-11-16', 400.00, 'Emitida', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_detalle`
--

CREATE TABLE `factura_detalle` (
  `id_factura_detalle` int(11) NOT NULL,
  `rela_factura_cabecera` int(11) NOT NULL,
  `rela_productos` int(11) DEFAULT NULL,
  `factura_detalle_cantidad` int(11) DEFAULT 1,
  `factura_detalle_precio_unitario` decimal(10,2) DEFAULT 0.00,
  `factura_detalle_subtotal` decimal(10,2) GENERATED ALWAYS AS (`factura_detalle_cantidad` * `factura_detalle_precio_unitario`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura_detalle`
--

INSERT INTO `factura_detalle` (`id_factura_detalle`, `rela_factura_cabecera`, `rela_productos`, `factura_detalle_cantidad`, `factura_detalle_precio_unitario`) VALUES
(1, 1, 1, 2, 150.00),
(2, 2, 2, 1, 200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_entrega`
--

CREATE TABLE `forma_entrega` (
  `id_forma_entrega` int(11) NOT NULL,
  `forma_entrega_nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `forma_entrega`
--

INSERT INTO `forma_entrega` (`id_forma_entrega`, `forma_entrega_nombre`) VALUES
(1, 'Envío a domicilio'),
(2, 'Retiro en tienda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `id_materiales` int(11) NOT NULL,
  `materiales_nombre` varchar(35) DEFAULT NULL,
  `materiales_cantidad` decimal(10,2) DEFAULT 0.00,
  `materiales_unidad_medida` varchar(10) DEFAULT NULL,
  `materiales_costo_unitario` decimal(10,2) DEFAULT 0.00,
  `materiales_stock_minimo` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id_materiales`, `materiales_nombre`, `materiales_cantidad`, `materiales_unidad_medida`, `materiales_costo_unitario`, `materiales_stock_minimo`) VALUES
(1, 'Cemento', 1000.00, 'kg', 50.00, 100),
(2, 'Acero', 500.00, 'kg', 80.00, 50),
(3, 'Agua', 2000.00, 'litros', 5.00, 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `id_metodos_pago` int(11) NOT NULL,
  `metodos_pago_nombre` varchar(34) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodos_pago`
--

INSERT INTO `metodos_pago` (`id_metodos_pago`, `metodos_pago_nombre`) VALUES
(1, 'Efectivo'),
(2, 'Transferencia'),
(3, 'Tarjeta de Crédito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedidos` int(11) NOT NULL,
  `pedido_fecha` date DEFAULT NULL,
  `pedido_estado` varchar(45) DEFAULT 'PENDIENTE',
  `pedido_total` decimal(10,2) DEFAULT 0.00,
  `rela_clientes` int(11) DEFAULT NULL,
  `rela_metodos_pago` int(11) DEFAULT NULL,
  `rela_forma_entrega` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_personas` int(11) NOT NULL,
  `personas_apellidos` varchar(45) DEFAULT NULL,
  `personas_nombre` varchar(45) DEFAULT NULL,
  `personas_cuil` varchar(12) DEFAULT NULL,
  `personas_domicilio` varchar(45) DEFAULT NULL,
  `personas_telefono` varchar(45) DEFAULT NULL,
  `personas_estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_personas`, `personas_apellidos`, `personas_nombre`, `personas_cuil`, `personas_domicilio`, `personas_telefono`, `personas_estado`) VALUES
(1, 'González', 'Juan', '20-12345678-', 'Calle Ficticia 123', '555-1234', 'Activo'),
(2, 'Pérez', 'Ana', '20-98765432-', 'Avenida Siempre Viva 456', '555-5678', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_productos` int(11) NOT NULL,
  `productos_ancho` decimal(10,2) DEFAULT NULL,
  `productos_alto` decimal(10,2) DEFAULT NULL,
  `productos_largo` decimal(10,2) DEFAULT NULL,
  `productos_unidad_medida` varchar(10) DEFAULT NULL,
  `productos_precio_unitario` decimal(10,2) NOT NULL,
  `rela_tipo_productos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `productos_ancho`, `productos_alto`, `productos_largo`, `productos_unidad_medida`, `productos_precio_unitario`, `rela_tipo_productos`) VALUES
(1, 100.00, 50.00, 200.00, 'cm', 150.00, 1),
(2, 120.00, 60.00, 250.00, 'cm', 200.00, 2),
(3, 50.00, 50.00, 500.00, 'cm', 100.00, 3),
(4, 120.00, 120.00, 240.00, 'cm', 300.00, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_fabricados`
--

CREATE TABLE `productos_fabricados` (
  `id_productos_fabricados` int(11) NOT NULL,
  `productos_fabricados_cant_disponible` int(11) DEFAULT 0,
  `productos_fabricados_stock_minimo` int(11) DEFAULT 0,
  `rela_productos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_fabricados`
--

INSERT INTO `productos_fabricados` (`id_productos_fabricados`, `productos_fabricados_cant_disponible`, `productos_fabricados_stock_minimo`, `rela_productos`) VALUES
(1, 100, 20, 1),
(2, 50, 15, 2),
(3, 80, 10, 3),
(4, 30, 5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedores` int(11) NOT NULL,
  `proveedores_nombre` varchar(45) NOT NULL,
  `proveedores_contacto` varchar(45) DEFAULT NULL,
  `proveedores_telefono` varchar(20) DEFAULT NULL,
  `proveedores_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedores`, `proveedores_nombre`, `proveedores_contacto`, `proveedores_telefono`, `proveedores_email`) VALUES
(1, 'Proveedor A', 'Carlos García', '555-1111', 'carlos@proveedora.com'),
(2, 'Proveedor B', 'Lucía Martínez', '555-2222', 'lucia@proveedora.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores_materiales`
--

CREATE TABLE `proveedores_materiales` (
  `id_proveedores_materiales` int(11) NOT NULL,
  `rela_proveedores` int(11) NOT NULL,
  `rela_materiales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores_materiales`
--

INSERT INTO `proveedores_materiales` (`id_proveedores_materiales`, `rela_proveedores`, `rela_materiales`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos`
--

CREATE TABLE `tipo_productos` (
  `id_tipo_productos` int(11) NOT NULL,
  `tipo_productos_nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_productos`
--

INSERT INTO `tipo_productos` (`id_tipo_productos`, `tipo_productos_nombre`) VALUES
(1, 'Cámara Séptica'),
(2, 'Alcantarilla'),
(3, 'Poste'),
(4, 'Pilar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_clientes`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id_detalle_pedidos`);

--
-- Indices de la tabla `factura_cabecera`
--
ALTER TABLE `factura_cabecera`
  ADD PRIMARY KEY (`id_factura_cabecera`);

--
-- Indices de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  ADD PRIMARY KEY (`id_factura_detalle`);

--
-- Indices de la tabla `forma_entrega`
--
ALTER TABLE `forma_entrega`
  ADD PRIMARY KEY (`id_forma_entrega`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id_materiales`);

--
-- Indices de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`id_metodos_pago`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedidos`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_personas`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_productos`);

--
-- Indices de la tabla `productos_fabricados`
--
ALTER TABLE `productos_fabricados`
  ADD PRIMARY KEY (`id_productos_fabricados`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedores`);

--
-- Indices de la tabla `proveedores_materiales`
--
ALTER TABLE `proveedores_materiales`
  ADD PRIMARY KEY (`id_proveedores_materiales`);

--
-- Indices de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  ADD PRIMARY KEY (`id_tipo_productos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id_detalle_pedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factura_cabecera`
--
ALTER TABLE `factura_cabecera`
  MODIFY `id_factura_cabecera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  MODIFY `id_factura_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `forma_entrega`
--
ALTER TABLE `forma_entrega`
  MODIFY `id_forma_entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id_materiales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id_metodos_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedidos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_personas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos_fabricados`
--
ALTER TABLE `productos_fabricados`
  MODIFY `id_productos_fabricados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedores_materiales`
--
ALTER TABLE `proveedores_materiales`
  MODIFY `id_proveedores_materiales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `id_tipo_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
