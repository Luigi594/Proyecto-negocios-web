CREATE TABLE `ventas` (
  `idVenta` int NOT NULL AUTO_INCREMENT,
  `clienteId` int NOT NULL,
  `fechaVenta` datetime NOT NULL,
  `tipoPago` varchar(256) NOT NULL,
  `estadoVenta` enum('VND','PND','CNL') DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `estadoEntrega` enum('RCB','PND','CNL') DEFAULT NULL,
  `docsMeta` mediumtext,
  PRIMARY KEY (`idVenta`),
  KEY `fk_ventas_clientes_idx` (`clienteId`),
  CONSTRAINT `fk_ventas_clientes` FOREIGN KEY (`clienteId`) REFERENCES `clientes` (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci


CREATE TABLE `ventas_detalle` (
  `idDetalle` int NOT NULL AUTO_INCREMENT,
  `idVenta` int NOT NULL,
  `idProducto` int NOT NULL,
  `cantidad` int DEFAULT NULL,
  `precio` decimal(13,2) DEFAULT NULL,
  `IVA` decimal(6,2) DEFAULT NULL,
  `observacion` varchar(256) DEFAULT NULL,
  `descuento` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`idDetalle`),
  KEY `fk_detalle_venta_idx` (`idVenta`),
  KEY `fk_detalle_producto_idx` (`idProducto`),
  CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  CONSTRAINT `fk_detalle_venta` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`idVenta`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci