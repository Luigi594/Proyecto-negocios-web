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
-- Table structure for table `funciones`
--

DROP TABLE IF EXISTS `funciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funciones` (
  `FuncionId` varchar(255) NOT NULL,
  `FuncionDsc` varchar(45) NOT NULL,
  `FuncionEst` char(3) NOT NULL,
  `FuncionTipo` char(3) NOT NULL,
  PRIMARY KEY (`FuncionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funciones`
--

LOCK TABLES `funciones` WRITE;
/*!40000 ALTER TABLE `funciones` DISABLE KEYS */;
INSERT INTO `funciones` VALUES ('Controllers\\Admin\\Admin','Controllers\\Admin\\Admin','ACT','CTR'),('Controllers\\Admin\\Categoria','Controllers\\Admin\\Categoria','ACT','CTR'),('Controllers\\Admin\\Categorias','Controllers\\Admin\\Categorias','ACT','CTR'),('Controllers\\Admin\\FuncionesRoles','Controllers\\Admin\\FuncionesRoles','ACT','CTR'),('Controllers\\Admin\\FuncionRol','Controllers\\Admin\\FuncionRol','ACT','CTR'),('Controllers\\Admin\\Pedido','Controllers\\Admin\\Pedido','ACT','CTR'),('Controllers\\Admin\\Pedidos','Controllers\\Admin\\Pedidos','ACT','CTR'),('Controllers\\Admin\\Producto','Controllers\\Admin\\Producto','ACT','CTR'),('Controllers\\Admin\\Productos','Controllers\\Admin\\Productos','ACT','CTR'),('Controllers\\Admin\\Rol','Controllers\\Admin\\Rol','ACT','CTR'),('Controllers\\Admin\\Roles','Controllers\\Admin\\Roles','ACT','CTR'),('Controllers\\Admin\\RolesUsuarios','Controllers\\Admin\\RolesUsuarios','ACT','CTR'),('Controllers\\Admin\\RolUsuario','Controllers\\Admin\\RolUsuario','ACT','CTR'),('Controllers\\Admin\\Usuario','Controllers\\Admin\\Usuario','ACT','CTR'),('Controllers\\Admin\\Usuarios','Controllers\\Admin\\Usuarios','ACT','CTR'),('Controllers\\Admin\\Venta','Controllers\\Admin\\Venta','ACT','CTR'),('Controllers\\Admin\\Ventas','Controllers\\Admin\\Ventas','ACT','CTR');
/*!40000 ALTER TABLE `funciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-12 22:58:13
