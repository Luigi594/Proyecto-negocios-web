

CREATE SCHEMA `sorburgers_negocios` ;


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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `UsuarioId` int NOT NULL AUTO_INCREMENT,
  `UsuarioEmail` varchar(80) NOT NULL,
  `UsuarioNombre` varchar(80) NOT NULL,
  `UsuarioPswd` varchar(128) NOT NULL,
  `UsuarioFching` datetime NOT NULL,
  `UsuarioPswdEst` char(3) NOT NULL,
  `UsuarioPswdExp` datetime NOT NULL,
  `UsuarioEst` char(3) NOT NULL,
  `UsuarioActCod` varchar(128) NOT NULL,
  `UsuarioPswdChg` varchar(128) NOT NULL,
  `UsuarioTipo` char(3) NOT NULL COMMENT 'Tipo de Usuario, Normal, Consultor o Cliente',
  `ClienteDireccion` varchar(180) DEFAULT NULL,
  `ClienteTelefono` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`UsuarioId`),
  UNIQUE KEY `useremail_UNIQUE` (`UsuarioEmail`) USING BTREE,
  KEY `usertipo` (`UsuarioTipo`,`UsuarioEmail`,`UsuarioId`,`UsuarioEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'wilson123@gmail.com','Wilson Lizardo','$2y$10$8YyE.HSaoXlbnmDfP1ICMuIuFTuq/c50D5NdvRHj0kTNVzW/NVZ8C','2022-04-07 16:47:44','ACT','2022-07-06 00:00:00','ACT','7aca21d2806ebb82e2911190f068136984f773bc048f121908d1b656e9861031','2022-04-07 16:47:44','ADM',NULL,NULL);
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
