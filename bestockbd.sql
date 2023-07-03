-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: bestockbd
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articulos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `id_categoria` int NOT NULL,
  `id_usuario` int NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `cantidad_min` int DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fechaCaptura` date DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (1,1,1,'PEPSI','2.25L',40,15,100,'2021-11-26'),(2,1,1,'CEPITA','1L',68,10,70,'2021-11-26'),(9,3,1,'SILLA','GAMER',100,20,10000,'2021-11-29'),(10,4,1,'HELADERA','GAFA',50,5,30000,'2021-11-29'),(11,1,1,'LEVITE','NARANJA',4,5,50,'2021-11-29'),(13,1,1,'LECHE','SANCOR',80,10,80,'2021-12-01');
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `nombreCategoria` varchar(150) DEFAULT NULL,
  `fechaCaptura` date DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,1,'BEBIDAS','2021-11-26'),(2,1,'CARNES','2021-11-26'),(3,1,'MUEBLES','2021-11-26'),(4,1,'ELECTRODOMESTICOS','2021-11-29');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificaciones` (
  `id_notificacion` int NOT NULL AUTO_INCREMENT,
  `mensaje` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint NOT NULL DEFAULT '1',
  `id_producto` int NOT NULL,
  PRIMARY KEY (`id_notificacion`),
  KEY `Relacion_notifiacion_articulo_idx` (`id_producto`),
  CONSTRAINT `Relacion_notifiacion_articulo` FOREIGN KEY (`id_producto`) REFERENCES `articulos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
INSERT INTO `notificaciones` VALUES (1,'Advertencia: El articulo LEVITE ha alcanzado el stock minimo.','2021-12-01 18:19:15',1,11);
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` tinytext,
  `fechaCaptura` date DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Valentina','Capece','admin','d033e22ae348aeb5660fc2140aec35850c4da997','2021-11-26'),(2,'Gloria','Fulguera','cliente','d94019fd760a71edf11844bb5c601a4de95aacaf','2021-11-26'),(3,'aaa','aaa','supera','d033e22ae348aeb5660fc2140aec35850c4da997','2021-12-01');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `consVenta` int NOT NULL AUTO_INCREMENT,
  `id_producto` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `fechaCompra` date DEFAULT NULL,
  `nombreP` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`consVenta`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (9,1,1,1000,10,'2021-11-29','PEPSI'),(10,2,1,700,10,'2021-11-29','CEPITA'),(11,1,1,100,1,'2021-11-29','PEPSI'),(12,1,1,100,1,'2021-11-29','PEPSI'),(13,1,1,100,1,'2021-11-29','PEPSI'),(14,1,1,100,1,'2021-11-29','PEPSI'),(15,2,1,70,1,'2021-11-29','CEPITA'),(16,9,1,20000,2,'2021-11-29','SILLA'),(17,9,1,20000,2,'2021-11-29','SILLA'),(18,9,1,20000,2,'2021-11-29','SILLA'),(19,2,1,70,1,'2021-11-29','CEPITA'),(20,2,1,70,1,'2021-11-29','CEPITA'),(21,2,1,70,1,'2021-11-29','CEPITA'),(22,2,1,70,1,'2021-11-29','CEPITA'),(23,2,1,70,1,'2021-11-29','CEPITA'),(24,2,1,70,1,'2021-11-29','CEPITA'),(25,2,1,70,1,'2021-11-29','CEPITA'),(26,2,1,70,1,'2021-11-29','CEPITA'),(27,2,1,70,1,'2021-11-29','CEPITA'),(28,2,1,70,1,'2021-11-29','CEPITA'),(29,2,1,70,1,'2021-11-29','CEPITA'),(30,1,1,600,6,'2021-11-29','PEPSI'),(31,2,1,560,8,'2021-11-29','CEPITA'),(32,11,1,400,8,'2021-11-29','LEVITE'),(33,1,1,8000,80,'2021-12-01','PEPSI'),(34,1,1,8000,80,'2021-12-01','PEPSI'),(35,1,1,2000,20,'2021-12-01','PEPSI'),(36,1,1,5000,50,'2021-12-01','PEPSI'),(37,2,1,140,2,'2021-12-01','CEPITA'),(38,1,1,1000,10,'2021-12-01','PEPSI'),(39,13,1,800,10,'2021-12-01','LECHE'),(40,13,1,800,10,'2021-12-01','LECHE'),(41,11,1,250,5,'2021-12-01','LEVITE'),(42,11,1,50,1,'2021-12-01','LEVITE'),(43,9,1,940000,94,'2021-12-01','SILLA');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-01 19:08:54
