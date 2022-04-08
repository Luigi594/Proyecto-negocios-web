-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: sorburgers_negocios
-- ------------------------------------------------------
-- Server version	8.0.23

use sorburgers_negocios;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `funcionesroles`
--

DROP TABLE IF EXISTS `funcionesroles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionesroles` (
  `RolId` varchar(15) NOT NULL,
  `FuncionId` varchar(255) NOT NULL,
  `FuncionRolEst` char(3) NOT NULL,
  `FuncionExp` datetime NOT NULL,
  PRIMARY KEY (`RolId`,`FuncionId`),
  KEY `rol_funcion_key_idx` (`FuncionId`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionesroles`
--

LOCK TABLES `funcionesroles` WRITE;
/*!40000 ALTER TABLE `funcionesroles` DISABLE KEYS */;
INSERT INTO `funcionesroles` VALUES ('ADMINISTRADOR','Controllers\\Admin\\Admin','ACT','2050-12-30 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Categoria','ACT','2050-12-30 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Categorias','ACT','2050-12-30 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\FuncionesRoles','ACT','2050-12-31 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\FuncionRol','ACT','2050-12-31 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Pedido','ACT','2050-12-31 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Pedidos','ACT','2050-12-31 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Producto','ACT','2026-03-11 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Productos','ACT','2026-03-11 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Rol','ACT','2050-12-31 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Roles','ACT','2050-12-31 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\RolesUsuarios','ACT','2050-12-31 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\RolUsuario','ACT','2050-12-31 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Usuario','ACT','2050-12-30 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Usuarios','ACT','2050-12-31 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Venta','ACT','2026-03-11 00:00:00'),('ADMINISTRADOR','Controllers\\Admin\\Ventas','ACT','2026-03-11 00:00:00');
/*!40000 ALTER TABLE `funcionesroles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-12 22:58:14
