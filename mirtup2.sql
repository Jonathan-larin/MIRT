/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.0.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: MIRENTATOTAL
-- ------------------------------------------------------
-- Server version	12.0.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `record_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `action` enum('INSERT','UPDATE','DELETE') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `old_values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `activity_log` VALUES
(1,'motos','M76453','UPDATE','{\"placa\":\"M76453\",\"idestado\":\"2\",\"idcliente\":null,\"chasis\":null,\"Motor\":\"76\",\"Sucursal\":null,\"idmarca\":\"2\",\"a\\u00f1o\":\"2023\",\"modelo\":\"YRZ9845\",\"color\":null,\"fecha_entrega\":null,\"fecha_renovacion\":null,\"Envio\":null,\"taller\":null,\"iddepartamento\":null,\"idagencia\":\"2\",\"renta_sinIva\":null,\"renta_conIva\":null,\"naf\":null,\"creado_por\":\"3\",\"modificado_por\":null}','{\"idmarca\":\"2\",\"modelo\":\"YRZ9845\",\"a\\u00f1o\":\"2023\",\"Motor\":\"76\",\"idestado\":\"4\",\"idagencia\":null,\"chasis\":null,\"idcliente\":null,\"color\":null,\"fecha_entrega\":null,\"fecha_renovacion\":null,\"Envio\":null,\"taller\":null,\"iddepartamento\":null,\"renta_sinIva\":null,\"renta_conIva\":null,\"naf\":null}',3,'2025-09-24 19:57:40'),
(2,'servicios','2','DELETE','{\"id\":\"2\",\"placa_motocicleta\":\"MB5423\",\"tipo_servicio\":\"Cambio de Aceite\",\"descripcion\":\"Test2 para notificaciones\",\"estado_servicio\":\"completado\",\"fecha_solicitud\":\"2025-09-07\",\"fecha_inicio\":\"2025-09-08\",\"fecha_completado\":\"2025-09-09\",\"costo_estimado\":\"54.00\",\"costo_real\":null,\"tecnico_responsable\":\"DIPARVEL\",\"notas\":null,\"prioridad\":\"media\",\"kilometraje_actual\":\"432\",\"estado_original_motocicleta\":null,\"creado_por\":\"3\",\"modificado_por\":\"3\",\"created_at\":\"2025-09-07 01:21:23\",\"updated_at\":\"2025-09-07 01:47:42\",\"deleted_at\":null}',NULL,3,'2025-09-24 20:00:41');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `agencia`
--

DROP TABLE IF EXISTS `agencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `agencia` (
  `idagencia` int(11) NOT NULL AUTO_INCREMENT,
  `agencia` varchar(100) DEFAULT NULL,
  `dirrecion` varchar(250) DEFAULT NULL,
  `celular` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`idagencia`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agencia`
--

LOCK TABLES `agencia` WRITE;
/*!40000 ALTER TABLE `agencia` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `agencia` VALUES
(1,'Agencia Central','Calle Principal 123, San Salvador','7890-1234'),
(2,'Agencia Oriente','Carretera al Litoral Km 5, San Miguel','7123-4567'),
(3,'Agencia Occidente','Avenida Las Palmas 45, Santa Ana','7567-8901'),
(4,'Agencia Norte','Bulevar Constitución 789, Chalatenango','7345-6789'),
(5,'Agencia Sur','Final Calle La Mascota 10, Antiguo Cuscatlán','7012-3456');
/*!40000 ALTER TABLE `agencia` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `Cliente` varchar(100) DEFAULT NULL,
  `idempresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `idempresa` (`idempresa`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `cliente` VALUES
(1,'Jose',1),
(3,'Ivan',1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamento` (
  `iddepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`iddepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresa` (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `Empresa` varchar(50) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `nit` varchar(17) DEFAULT NULL,
  `representante_legal` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `empresa` VALUES
(1,'Doordash','adjasfgg','7645423','sbdasjd@hjdsf.com','1234-123456-123-1','dsfsdfsf');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `estado` VALUES
(1,'Disponible'),
(2,'En Mantenimiento'),
(3,'Alquilada'),
(4,'Fuera de Servicio');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(60) DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `celular` varchar(9) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modificado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `marca` VALUES
(1,'Hero','Juan Perez','78901234','2025-06-14 21:03:57',NULL,'2025-08-28 14:30:03',NULL),
(2,'Honda','Maria Gomez','71234567','2025-06-14 21:03:57',NULL,'2025-06-14 21:03:57',NULL),
(3,'Freedom','Carlos Diaz','75678901','2025-06-14 21:04:03',NULL,'2025-08-28 14:30:37',NULL),
(4,'TVS','Jose Adan','76543123','2025-08-28 14:32:41',NULL,'2025-08-28 14:32:41',NULL);
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `migrations` VALUES
(1,'2025-08-26-204750','App\\Database\\Migrations\\CreateServiciosTable','default','App',1756845546,1),
(2,'2025-09-02-203808','App\\Database\\Migrations\\AddEmpresaFields','default','App',1756845546,1),
(3,'2025-09-02-212214','App\\Database\\Migrations\\FixClienteAutoIncrement','default','App',1756848167,2),
(4,'2025-09-08-140000','App\\Database\\Migrations\\AddEstadoOriginalMotocicletaToServicios','default','App',1757362023,3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `motos`
--

DROP TABLE IF EXISTS `motos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `motos` (
  `placa` varchar(15) NOT NULL,
  `idestado` int(11) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `chasis` varchar(50) DEFAULT NULL,
  `Motor` varchar(50) DEFAULT NULL,
  `Sucursal` varchar(100) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `año` int(11) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `fecha_renovacion` date DEFAULT NULL,
  `Envio` varchar(50) DEFAULT NULL,
  `taller` varchar(100) DEFAULT NULL,
  `iddepartamento` int(11) DEFAULT NULL,
  `idagencia` int(11) DEFAULT NULL,
  `renta_sinIva` double(10,2) DEFAULT NULL,
  `renta_conIva` double(10,2) DEFAULT NULL,
  `naf` varchar(50) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`placa`),
  KEY `idestado` (`idestado`),
  KEY `idcliente` (`idcliente`),
  KEY `idmarca` (`idmarca`),
  KEY `iddepartamento` (`iddepartamento`),
  KEY `idagencia` (`idagencia`),
  KEY `creado_por` (`creado_por`),
  KEY `modificado_por` (`modificado_por`),
  CONSTRAINT `motos_ibfk_1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`),
  CONSTRAINT `motos_ibfk_2` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idCliente`),
  CONSTRAINT `motos_ibfk_3` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`),
  CONSTRAINT `motos_ibfk_4` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`),
  CONSTRAINT `motos_ibfk_5` FOREIGN KEY (`idagencia`) REFERENCES `agencia` (`idagencia`),
  CONSTRAINT `motos_ibfk_6` FOREIGN KEY (`creado_por`) REFERENCES `usuario` (`idUsuario`),
  CONSTRAINT `motos_ibfk_7` FOREIGN KEY (`modificado_por`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motos`
--

LOCK TABLES `motos` WRITE;
/*!40000 ALTER TABLE `motos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `motos` VALUES
('B65241',3,3,NULL,'1234',NULL,3,2012,'B54231',NULL,'2025-09-08','2025-09-10',NULL,NULL,NULL,NULL,150.00,175.00,NULL,3,3),
('BHTER12',3,NULL,'Sport','8761',NULL,1,2020,'KJUY56','Negro','2025-06-10','2025-06-10','DHL','MotorSport',NULL,5,NULL,NULL,NULL,3,NULL),
('H63452',3,NULL,NULL,'12',NULL,2,2024,'YHR324',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,3,NULL),
('M56543',3,3,NULL,'25431',NULL,1,2012,'JHY432',NULL,'2025-09-25','2025-09-30',NULL,NULL,NULL,NULL,54.00,67.00,NULL,3,3),
('M76453',4,NULL,NULL,'76',NULL,2,2023,'YRZ9845',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL),
('MB5423',2,NULL,NULL,'1235',NULL,1,2025,'YHF12341',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,3,NULL),
('TRE6512',4,NULL,NULL,'420',NULL,3,2016,'HJHGA',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,3,NULL);
/*!40000 ALTER TABLE `motos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `placa_motocicleta` varchar(15) NOT NULL,
  `tipo_servicio` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `estado_servicio` enum('pendiente','en_progreso','completado','cancelado') NOT NULL DEFAULT 'pendiente',
  `fecha_solicitud` date NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_completado` date DEFAULT NULL,
  `costo_estimado` decimal(10,2) DEFAULT NULL,
  `costo_real` decimal(10,2) DEFAULT NULL,
  `tecnico_responsable` varchar(100) DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `prioridad` enum('baja','media','alta','urgente') NOT NULL DEFAULT 'media',
  `kilometraje_actual` int(11) unsigned DEFAULT NULL,
  `estado_original_motocicleta` int(11) DEFAULT NULL COMMENT 'Estado original de la motocicleta antes del servicio',
  `creado_por` int(11) NOT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_servicios_usuario` (`creado_por`),
  KEY `fk_servicios_motos` (`placa_motocicleta`),
  CONSTRAINT `fk_servicios_motos` FOREIGN KEY (`placa_motocicleta`) REFERENCES `motos` (`placa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_servicios_usuario` FOREIGN KEY (`creado_por`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `servicios` VALUES
(1,'BHTER12','Mantenimiento Preventivo','Probando probando','pendiente','2025-08-28','2025-09-08',NULL,45.00,24.00,'DIPARVEL',NULL,'media',5423,NULL,3,3,'2025-08-28 02:46:55','2025-09-07 02:11:51',NULL),
(3,'MB5423','Reparación','Se esta reparando','en_progreso','2025-09-07','2025-09-06','2025-09-10',123.00,NULL,'Jose Perez',NULL,'alta',13121,NULL,3,3,'2025-09-07 01:52:07','2025-09-07 01:52:36',NULL);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `dui` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `usuario` VALUES
(1,'Arch Test User','testuser','444$','test@example.com',1,'Operativo','00000000-0','2025-06-08 17:11:49',NULL,'2025-06-09 19:09:17'),
(2,'Test User','testuser1','pass123','test1@example.com',1,'admin','123456789','2025-06-08 17:11:49',NULL,'2025-06-09 10:01:33'),
(3,'Admin','admin','$2y$12$fuImYO/JaUzLbcarP0kNiuL4yv0V9MERdE73m25YUdlvQJekQWGb6','admin@example.com',1,'admin','123456789','2025-06-08 17:11:49',NULL,'2025-06-15 15:37:44'),
(4,'Visualizador','visual','$2y$12$79xwB.LwTuKM1h/Pt/4beu.XyRf9XlfvGK1Re4EM8O/fwhGQfm5UO','visualizador@email.com',1,'Visualizador','00000000-0','2025-06-08 17:11:49',NULL,'2025-06-09 10:01:33'),
(9,'asdasfaf','fasfasfasf','$2y$12$WRIVfwitvgl6.wXhIVieaOLOuA/0gvFMMhIFmBcGkkWqyZgaZDXUS','qweqweqweq@test.com',1,'Visualizador','63542711-1','2025-06-09 18:38:35',NULL,'2025-06-09 18:38:35'),
(11,'eqw23423','2342342','$2y$12$MNQVpyGZZ/1VKrw3RuWJ4.xnC3SOyN5hxcVkMf8Gsecmpdu.1Qdo.','werwerw@test.com',1,'Operativo','12312314-5','2025-06-09 18:41:56',NULL,'2025-06-09 18:41:56'),
(14,'wqsdqfq','dadqwdqq','$2y$12$l1dwcXHyE2UcZgQcwr14jurTvE5PGlReOKoJ5Ds5DkQdz8K4X6fci','lenfibweyb@gmail.com',0,'Jefatura','12345679-8','2025-06-09 18:55:45',NULL,'2025-06-10 03:11:08'),
(20,'askjygd','asdjbaj','$2y$12$KYgegKWyFiYisuSFB4Kx0e0Nz3ET4ZCG4BtVfnxyrroCriNfmBuhe','kjyasygdjkua@test.com',1,'Operativo','33121312-1','2025-06-15 03:13:30',NULL,'2025-06-15 03:13:30'),
(21,'TEST1','TEST','$2y$12$A54cJvhX9YofeDelSMu5VO5QdmM/Lec2OBwrinizmJqw4EeIvsSBq','dvqgwyq@test.com',1,'Administrador','14451142-1','2025-06-15 19:57:15',NULL,'2025-06-15 19:57:15'),
(22,'PRUEBAFINAL','hjasg','$2y$12$hlCXXYFnE/xTCHLu3x8EluAiq9o73D/QO7dZpW/JV64XOiGYwMam2','kudwvgke@test.com',0,'Operativo','12673471-6','2025-06-15 20:06:29',NULL,'2025-06-15 20:06:29'),
(23,'ARCH','arch','$2y$12$8s9w6n9xj25HKhpq72gQ1etfaQCM7caszJYdvYfpBvhafm8qoUJ4K','test@test.com',1,'Operativo','99237312-4','2025-06-15 21:12:37',NULL,'2025-06-15 21:12:37'),
(24,'hjasvsdjJKHASV','VJHADV','$2y$12$/vW2eVyT/X2T8vus9plZaOZpnSVzAiRnaZ7IS3vbOf4IqBdSJI5pe','savahdga@test.com',0,'Visualizador','32626232-1','2025-06-16 20:47:45',NULL,'2025-06-16 20:47:45');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Dumping routines for database 'MIRENTATOTAL'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-09-26 13:19:48
