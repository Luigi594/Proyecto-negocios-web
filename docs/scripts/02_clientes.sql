
 /**los scripts que vaamos a usar*/

 CREATE TABLE `clientes` (
  `idCliente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `rtn` varchar(45) DEFAULT NULL,
  `fechaNacimiento` date NOT NULL,
  `estado` enum('AC','INA') DEFAULT 'AC',
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
