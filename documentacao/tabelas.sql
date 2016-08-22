-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: ruianderson.com.br    Database: ruiand_pjtbase
-- ------------------------------------------------------
-- Server version	5.5.50-cll

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `ukey` varchar(20) NOT NULL,
  `cia_ukey` varchar(20) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sql_cmd` text,
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(200) NOT NULL,
  `nome_fantasia` varchar(200) NOT NULL,
  `cnpj_cpf` varchar(45) NOT NULL,
  `responsavel` varchar(200) DEFAULT NULL,
  `contato` varchar(200) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `telefone_1` varchar(45) DEFAULT NULL,
  `telefone_2` varchar(45) DEFAULT NULL,
  `telefone_3` varchar(45) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `cep` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ukey`),
  KEY `idx_cia_ukey` (`cia_ukey`),
  KEY `idx_timestamp` (`timestamp`),
  KEY `idx_codigo` (`codigo`),
  KEY `idx_razao_social` (`razao_social`),
  KEY `idx_nome_fantasia` (`nome_fantasia`),
  KEY `idx_cnpj_cpf` (`cnpj_cpf`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES ('3711','3711','2016-07-31 00:54:53',NULL,1,'Empresa teste na WEB - Alterada na Web','Empresa teste na WEB','07044177743','Rui Anderson Santos','Rui','ruiandersonsantos@gmail.com','2187668572','2187668572','2187668572','AVENIDA COMENDADOR TELES',1758,'LT 03 QD 06','25561-162','RJ','São João de Meriti'),('A4FE','A4FE','2016-07-31 00:56:07',NULL,2,'Simone Teste WEB Com Dao','Empresa teste na WEB','0009998877','Simone Moraes','Simone','simone.moraes77@gmail.com','21987668572','21987668572','2187668572','AVENIDA COMENDADOR TELES',1758,'LT 03 QD 06','25561-162','RJ','Rio de Janeiro'),('BB6D','BB6D','2016-08-02 23:14:06',NULL,3,'Empresa teste depois da edição','Teste de Edição Rui','1234','Rui Teste ','Rui Anderson','ruianderson@yahoo.com','987668582','2752-0296','2578-9999','Rua Silva Gomes',70,'casa 2','21350-050','RJ','Rio de Janeiro');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `ukey` varchar(20) NOT NULL,
  `cia_ukey` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sql_cmd` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ukey`),
  KEY `idx_codigo` (`codigo`),
  KEY `idx_nome` (`nome`),
  KEY `idx_descricao` (`descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES ('20160822EB250DAAD51F','A4FE','2016-08-22 19:46:45',NULL,1,11,'Empresarial','Empresarial'),('20160822EB258AD1826A','A4FE','2016-08-22 19:47:25',NULL,1,13,'Empresarial Grande Porte','Empresarial Grande Porte'),('20160822EB25C2D837EF','A4FE','2016-08-22 19:45:09',NULL,1,10,'Individual','Descrição Individual'),('20160822EB25CC4FF228','A4FE','2016-08-22 19:46:56',NULL,1,12,'Adesão','Adesão');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguradoras`
--

DROP TABLE IF EXISTS `seguradoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguradoras` (
  `ukey` varchar(20) NOT NULL,
  `cia_ukey` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sql_cmd` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ukey`),
  KEY `idx_codigo` (`codigo`),
  KEY `idx_nome` (`nome`),
  KEY `idx_descricao` (`descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguradoras`
--

LOCK TABLES `seguradoras` WRITE;
/*!40000 ALTER TABLE `seguradoras` DISABLE KEYS */;
INSERT INTO `seguradoras` VALUES ('20160813EB25325C3F39',NULL,'2016-08-12 22:29:49',NULL,1,1,'Amil','Amil'),('20160813EB2593A118A2','A4FE','2016-08-12 22:37:02',NULL,1,2,'Unimed','Unimed Planos de saude'),('20160813EB25D0BF622D','A4FE','2016-08-12 23:22:07',NULL,0,3,'Golden Cross','Golden Cross'),('20160816EB2552FFE786','A4FE','2016-08-16 21:16:13',NULL,1,5,'Golden','Golden'),('20160816EB2582433805','A4FE','2016-08-17 00:47:27',NULL,0,7,'Cemeru','Cemeru Saude'),('20160816EB25AB700285','A4FE','2016-08-16 21:07:23',NULL,1,4,'Dix','Dix Saúde'),('20160817EB25C3432561','A4FE','2016-08-17 00:40:57',NULL,1,6,'Samoc','Samoc Saude'),('20160822EB2572DCA453','A4FE','2016-08-22 18:07:37',NULL,1,8,'Amil','Amil Assistência Médica Internacional'),('20160822EB25F3CC6944','A4FE','2016-08-22 18:08:43',NULL,1,9,'Amil Dental','Amil Dental');
/*!40000 ALTER TABLE `seguradoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `ukey` varchar(20) NOT NULL,
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cia_ukey` varchar(20) NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sql_cmd` varchar(45) DEFAULT NULL,
  `nome` varchar(200) NOT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`ukey`),
  KEY `idx_codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('20160805EB25',1,'A4FE','2016-08-05 00:17:44',NULL,'Rui Anderson Paim Santos','ruiandersonsantos@gmail.com','202cb962ac59075b964b07152d234b70','07044177743',1),('201608083589',3,'3711','2016-08-08 02:30:22',NULL,'Vitor Moraes','vitor@gmail.com','202cb962ac59075b964b07152d234b70','00099988877',1),('20160808F4BF',2,'A4FE','2016-08-08 02:18:32',NULL,'Simone Moraes Santos','simone@gmail.com','202cb962ac59075b964b07152d234b70','12312344',1),('20160813C046',4,'A4FE','2016-08-12 23:19:04',NULL,'Bruna Moreia','bruna@gmail.com','202cb962ac59075b964b07152d234b70','223344556',1),('201608162CA7',9,'A4FE','2016-08-17 00:44:35',NULL,'moraes','moraes','d41d8cd98f00b204e9800998ecf8427e','0000',1),('2016081832CA',10,'A4FE','2016-08-17 23:21:57',NULL,'Jose Carlos','rui','202cb962ac59075b964b07152d234b70','122233',1),('20160818377F',12,'A4FE','2016-08-17 23:31:30',NULL,'ruiandersonz3','ssss','202cb962ac59075b964b07152d234b70','1234',0),('201608188EA4',14,'A4FE','2016-08-17 23:39:02',NULL,'ruiandersonz3','1111','c4ca4238a0b923820dcc509a6f75849b','111',0),('20160818A792',13,'A4FE','2016-08-17 23:35:22',NULL,'ruiandersonz3','123','202cb962ac59075b964b07152d234b70','345',0),('20160818ECA3',11,'A4FE','2016-08-17 23:26:34',NULL,'ruiandersonz3','rui2','202cb962ac59075b964b07152d234b70','1111',0),('20160818F05E',15,'A4FE','2016-08-18 01:53:22',NULL,'teste','teste@teste.com','202cb962ac59075b964b07152d234b70','6666',0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-22 16:53:24
