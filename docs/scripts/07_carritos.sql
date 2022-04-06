CREATE TABLE `carrito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `clienteId` int NOT NULL,
  `productoId` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(13,2) NOT NULL,
  `fechahora` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci