CREATE DATABASE  IF NOT EXISTS `bdrh` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bdrh`;
-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bdrh
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `tb_candidatos`
--

DROP TABLE IF EXISTS `tb_candidatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_candidatos` (
  `PK_COD` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(255) DEFAULT NULL,
  `SEXO` varchar(255) DEFAULT NULL,
  `DATA_NASC` varchar(255) DEFAULT NULL,
  `IDADE` varchar(10) DEFAULT NULL,
  `ESTADO_CIVIL` varchar(255) DEFAULT NULL,
  `NOME_CONJUGE` varchar(255) DEFAULT NULL,
  `QTD_FILHOS` varchar(50) DEFAULT NULL,
  `NOME_MAE` varchar(255) DEFAULT NULL,
  `CEP` varchar(50) DEFAULT NULL,
  `ENDERECO` varchar(200) DEFAULT NULL,
  `BAIRRO` varchar(100) DEFAULT NULL,
  `CIDADE` varchar(100) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `CELULAR` varchar(50) DEFAULT NULL,
  `FACEBOOK` varchar(255) DEFAULT NULL,
  `INSTAGRAN` varchar(255) DEFAULT NULL,
  `ESCOLARIDADE` varchar(255) DEFAULT NULL,
  `CURSO` varchar(255) DEFAULT NULL,
  `CURSO_EXTRA1` varchar(255) DEFAULT NULL,
  `CURSO_EXTRA2` varchar(255) DEFAULT NULL,
  `CURSO_EXTRA3` varchar(255) DEFAULT NULL,
  `IDENTIDADE` varchar(255) DEFAULT NULL,
  `CPF` varchar(255) DEFAULT NULL,
  `PIS` varchar(255) DEFAULT NULL,
  `CTPS` varchar(255) DEFAULT NULL,
  `TITULO_ELEITOR` varchar(255) DEFAULT NULL,
  `EMPRESA1` varchar(255) DEFAULT NULL,
  `CARGO1` varchar(255) DEFAULT NULL,
  `SALARIO1` varchar(255) DEFAULT NULL,
  `PERIODO1_1` varchar(255) DEFAULT NULL,
  `PERIODO1_2` varchar(255) DEFAULT NULL,
  `ATIVIDADES1` varchar(255) DEFAULT NULL,
  `EMPRESA2` varchar(255) DEFAULT NULL,
  `CARGO2` varchar(255) DEFAULT NULL,
  `SALARIO2` varchar(255) DEFAULT NULL,
  `PERIODO2_1` varchar(255) DEFAULT NULL,
  `PERIODO2_2` varchar(255) DEFAULT NULL,
  `ATIVIDADES2` varchar(255) DEFAULT NULL,
  `EMPRESA3` varchar(255) DEFAULT NULL,
  `CARGO3` varchar(255) DEFAULT NULL,
  `SALARIO3` varchar(255) DEFAULT NULL,
  `PERIODO3_1` varchar(255) DEFAULT NULL,
  `PERIODO3_2` varchar(255) DEFAULT NULL,
  `ATIVIDADES3` varchar(255) DEFAULT NULL,
  `OBS_ENTREVISTADOR` varchar(255) DEFAULT NULL,
  `DEFICIENTE` varchar(255) DEFAULT NULL,
  `DATA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CARGO_PRETENDIDO` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`PK_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_candidatos`
--

LOCK TABLES `tb_candidatos` WRITE;
/*!40000 ALTER TABLE `tb_candidatos` DISABLE KEYS */;
INSERT INTO `tb_candidatos` VALUES (10,'MARCOS ANDRE REIS ELIAS','Masculino','2022-10-16','50','Casado','elisangela de lima silva elias','1','Ana Deisy Reis Elias','26279235','Rua Neisa','riachao','Nova Iguaçu','RJ','marereis@gmail.com','982460839','','','Ensino Superior','Ciencia Contabeis','','','','121212','07139512736','','','','marinha do brasil','Arquivista e protocolista','12121','1212',NULL,'    121212','','','','',NULL,'    ','','','','',NULL,'    ','    ','n','2022-10-16 18:27:17','Auxiliar Adm'),(11,'elisangela de lima silva elias','Femenino','2022-10-20','30','Solteiro','a','1','ivanilda','26279235','Rua Neisa','riachao','Nova Iguaçu','RJ','marereis@gmail.com','982460839','','','Ensino Médio','medio','','','','121212','01010101','','','','','','','',NULL,'  ','','','','',NULL,'  ','','','','',NULL,'  ','  ','n','2022-10-17 05:33:54','Auxiliar Adm'),(12,'Ana Deisy Reis Elias','Femenino','2022-10-31','50','Casado','FABIO aaa','7','MARCOS ANDRE REIS ELIAS','26279235','Rua Neisa','riachao','Nova Iguaçu','RJ','marereis@gmail.com','982460839','','','Ensino Médio','medio','','','','121212','07139','','','','','','','',NULL,'      ','','','','',NULL,'      ','','','','',NULL,'      ','      ','n','2022-10-31 04:14:42','Auxiliar Adm');
/*!40000 ALTER TABLE `tb_candidatos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_empresa`
--

DROP TABLE IF EXISTS `tb_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_empresa` (
  `PK_COD` int NOT NULL AUTO_INCREMENT,
  `CNPJ` varchar(50) DEFAULT NULL,
  `RAZAO_SOCIAL` varchar(100) DEFAULT NULL,
  `NOME_FANTASIA` varchar(100) DEFAULT NULL,
  `RESPONSAVEL` varchar(100) DEFAULT NULL,
  `CPF_RESPONSAVEL` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `CELULAR` varchar(50) DEFAULT NULL,
  `CEP` varchar(50) DEFAULT NULL,
  `ENDERECO` varchar(200) DEFAULT NULL,
  `BAIRRO` varchar(100) DEFAULT NULL,
  `CIDADE` varchar(100) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `DATA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PK_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_empresa`
--

LOCK TABLES `tb_empresa` WRITE;
/*!40000 ALTER TABLE `tb_empresa` DISABLE KEYS */;
INSERT INTO `tb_empresa` VALUES (1,'29.223.222/0001-55','Empresa padrao - 01','Fantasia padrao','silva  andrade solano','(21) 98307-3707','marereis@gmail.com','(21) 98307-3707','26279235','Rua Neisa, 111 - casa 10','riachao','Nova Iguaçu','RJ','2022-09-01 04:14:20');
/*!40000 ALTER TABLE `tb_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_empresas_parceiras`
--

DROP TABLE IF EXISTS `tb_empresas_parceiras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_empresas_parceiras` (
  `PK_COD` int NOT NULL AUTO_INCREMENT,
  `CNPJ` varchar(50) DEFAULT NULL,
  `RAZAO_SOCIAL` varchar(100) DEFAULT NULL,
  `NOME_FANTASIA` varchar(100) DEFAULT NULL,
  `ATIVIDADE_EMPRESA` varchar(255) DEFAULT NULL,
  `RESPONSAVEL` varchar(100) DEFAULT NULL,
  `TEL_RESPONS` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `CELULAR` varchar(50) DEFAULT NULL,
  `CEP` varchar(50) DEFAULT NULL,
  `ENDERECO` varchar(200) DEFAULT NULL,
  `BAIRRO` varchar(100) DEFAULT NULL,
  `CIDADE` varchar(100) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `DATA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PK_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_empresas_parceiras`
--

LOCK TABLES `tb_empresas_parceiras` WRITE;
/*!40000 ALTER TABLE `tb_empresas_parceiras` DISABLE KEYS */;
INSERT INTO `tb_empresas_parceiras` VALUES (15,'24463760000101','Padrao Empresa Parceiras','Padrao Fantasia',NULL,'marcos silva padrao','922222','marereis@gmail.com','(21) 98307-3707','26279235','Rua Neisa','Bangu','Nova Iguaçu','RJ','2022-10-16 18:28:54');
/*!40000 ALTER TABLE `tb_empresas_parceiras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_encaminhamentos`
--

DROP TABLE IF EXISTS `tb_encaminhamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_encaminhamentos` (
  `PK_COD` int NOT NULL AUTO_INCREMENT,
  `DATA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATA_EMISSAO` varchar(11) DEFAULT NULL,
  `DATA_ENTREVISTA` varchar(11) DEFAULT NULL,
  `HORA_ENTREVISTA` varchar(5) DEFAULT NULL,
  `FK_CAND` int DEFAULT NULL,
  `CANDIDATO` varchar(255) DEFAULT NULL,
  `TEL_CAND` varchar(45) DEFAULT NULL,
  `EMAIL_CAND` varchar(100) DEFAULT NULL,
  `FK_VAGA` int DEFAULT NULL,
  `CARGO_PRETENDIDO` varchar(255) DEFAULT NULL,
  `FK_EMPRESA` int DEFAULT NULL,
  `EMPRESA` varchar(255) DEFAULT NULL,
  `CEP` varchar(50) DEFAULT NULL,
  `ENDERECO` varchar(200) DEFAULT NULL,
  `BAIRRO` varchar(100) DEFAULT NULL,
  `CIDADE` varchar(100) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `NOME_CONTATO` varchar(255) DEFAULT NULL,
  `TEL_CONTATO` varchar(45) DEFAULT NULL,
  `EMAIL_ENCAM_EMPRE` varchar(255) DEFAULT NULL,
  `STATUS_ENCAMI` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`PK_COD`),
  KEY `FK_CANDS` (`FK_CAND`),
  KEY `FK_VAGAS` (`FK_VAGA`),
  CONSTRAINT `tb_encaminhamentos_ibfk_1` FOREIGN KEY (`FK_CAND`) REFERENCES `tb_candidatos` (`PK_COD`),
  CONSTRAINT `tb_encaminhamentos_ibfk_2` FOREIGN KEY (`FK_VAGA`) REFERENCES `tb_vaga` (`PK_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_encaminhamentos`
--

LOCK TABLES `tb_encaminhamentos` WRITE;
/*!40000 ALTER TABLE `tb_encaminhamentos` DISABLE KEYS */;
INSERT INTO `tb_encaminhamentos` VALUES (7,'2022-10-16 18:53:03','16/10/2022','2022-10-17','08:00',10,'MARCOS ANDRE REIS ELIAS','982460839','marereis@gmail.com',13,'ASG - SERVIÇOS GERAIS',15,'Padrao Empresa Parceiras','26279235','Rua Neisa','Bangu','Nova Iguaçu','RJ','marcos silva padrao','922222','email.empresa@gmail.com','Em Selecao'),(8,'2022-10-17 05:05:49','17/10/2022','2022-10-22','08:00',10,'MARCOS ANDRE REIS ELIAS','982460839','marereis@gmail.com',14,'ASG - SERVIÇOS GERAIS',15,'Padrao Empresa Parceiras','26279235','Rua Neisa','Bangu','Nova Iguaçu','RJ','marcos silva padrao','922222','email.empresa@gmail.com','Em Selecao'),(9,'2022-10-17 05:36:50','17/10/2022','2022-10-20','08:00',11,'elisangela de lima silva elias','982460839','marereis@gmail.com',14,'ASG - SERVIÇOS GERAIS',15,'Padrao Empresa Parceiras','26279235','Rua Neisa','Bangu','Nova Iguaçu','RJ','marcos silva padrao','922222','email.empresa@gmail.com','Em Selecao'),(11,'2022-10-28 20:08:56','28/10/2022','2022-10-28','08:00',11,'elisangela de lima silva elias','982460839','marereis@gmail.com',13,'ASG - SERVIÇOS GERAIS',15,'Padrao Empresa Parceiras','26279235','Rua Neisa','Bangu','Nova Iguaçu','RJ','marcos silva padrao','922222','email.empresa@gmail.com','Em Selecao'),(12,'2022-10-30 20:54:06','30/10/2022','2022-10-31','08:00',10,'MARCOS ANDRE REIS ELIAS','982460839','marereis@gmail.com',15,'Auxliar administrativo',15,'Padrao Empresa Parceiras','26279235','Rua Neisa','Bangu','Nova Iguaçu','RJ','marcos silva padrao','922222','email.empresa@gmail.com','Em Selecao'),(13,'2022-10-31 03:21:35','31/10/2022','2022-11-01','10:00',11,'elisangela de lima silva elias','982460839','marereis@gmail.com',15,'Auxliar administrativo',15,'Padrao Empresa Parceiras','26279235','Rua Neisa','Bangu','Nova Iguaçu','RJ','marcos silva padrao','922222','email.empresa@gmail.com','Em Selecao'),(14,'2022-11-01 17:45:09','01/11/2022','2022-11-02','10:00',12,'Ana Deisy Reis Elias','982460839','marereis@gmail.com',15,'Auxliar administrativo',15,'Padrao Empresa Parceiras','26279235','Rua Neisa','Bangu','Nova Iguaçu','RJ','marcos silva padrao','922222','email.empresa@gmail.com','Em Selecao'),(15,'2022-11-07 14:49:24','07/11/2022','2022-11-08','10:00',12,'Ana Deisy Reis Elias','982460839','marereis@gmail.com',13,'ASG - SERVIÇOS GERAIS',15,'Padrao Empresa Parceiras','26279235','Rua Neisa','Bangu','Nova Iguaçu','RJ','marcos silva padrao','922222','marereis@gmail.com','Em Selecao');
/*!40000 ALTER TABLE `tb_encaminhamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_funcionario`
--

DROP TABLE IF EXISTS `tb_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_funcionario` (
  `PK_COD` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(50) NOT NULL,
  `ENDERECO` varchar(50) DEFAULT NULL,
  `BAIRRO` varchar(50) DEFAULT NULL,
  `CIDADE` varchar(50) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `CEP` varchar(10) DEFAULT NULL,
  `CPF` varchar(14) DEFAULT NULL,
  `FUNCAO` varchar(50) DEFAULT NULL,
  `CELULAR` varchar(13) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `NIVEL_ACESSO` varchar(50) DEFAULT NULL,
  `CODIGO` varchar(50) DEFAULT NULL,
  `DATA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PK_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=1083 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_funcionario`
--

LOCK TABLES `tb_funcionario` WRITE;
/*!40000 ALTER TABLE `tb_funcionario` DISABLE KEYS */;
INSERT INTO `tb_funcionario` VALUES (1082,'Administrador','rua admin','admin','admin','RJ','0000000000','0000000000','Administrador','0000000000','admin@gmail.com','02','1000','2022-10-09 18:12:07');
/*!40000 ALTER TABLE `tb_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_senha`
--

DROP TABLE IF EXISTS `tb_senha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_senha` (
  `PK_COD` int NOT NULL AUTO_INCREMENT,
  `COD_LOJA` int DEFAULT NULL,
  `CODIGO` int DEFAULT NULL,
  `COD_AUTORIZACAO` int DEFAULT NULL,
  `SENHA` varchar(255) DEFAULT NULL,
  `ACESSOS` longtext,
  `DATA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PK_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_senha`
--

LOCK TABLES `tb_senha` WRITE;
/*!40000 ALTER TABLE `tb_senha` DISABLE KEYS */;
INSERT INTO `tb_senha` VALUES (5,NULL,1000,NULL,'e10adc3949ba59abbe56e057f20f883e','02','2022-10-09 18:12:07');
/*!40000 ALTER TABLE `tb_senha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_vaga`
--

DROP TABLE IF EXISTS `tb_vaga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_vaga` (
  `PK_COD` int NOT NULL AUTO_INCREMENT,
  `CARGO` varchar(255) DEFAULT NULL,
  `SALARIO` varchar(255) DEFAULT NULL,
  `FORMACAO` varchar(255) DEFAULT NULL,
  `LOCAL_VAGA` varchar(255) DEFAULT NULL,
  `EXPERIENCIA` varchar(255) DEFAULT NULL,
  `ATIVIDADES` varchar(255) DEFAULT NULL,
  `FK_EMPRESA` int DEFAULT NULL,
  `EMPRESA` varchar(255) DEFAULT NULL,
  `CNPJ` varchar(255) DEFAULT NULL,
  `STATUS_VAGA` varchar(255) DEFAULT NULL,
  `DATA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATA_ABERTURA` varchar(255) DEFAULT NULL,
  `DATA_FECHAMENTO` varchar(255) DEFAULT NULL,
  `QTD_VAGA` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`PK_COD`),
  KEY `FK_EMPRESAS` (`FK_EMPRESA`),
  CONSTRAINT `tb_vaga_ibfk_1` FOREIGN KEY (`FK_EMPRESA`) REFERENCES `tb_empresas_parceiras` (`PK_COD`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_vaga`
--

LOCK TABLES `tb_vaga` WRITE;
/*!40000 ALTER TABLE `tb_vaga` DISABLE KEYS */;
INSERT INTO `tb_vaga` VALUES (13,'ASG - SERVIÇOS GERAIS','1500','Ensino Fundamental','BANGU','   asg ','   asg ',15,'Padrao Empresa Parceiras','24463760000101','Encaminhados','2022-10-16 18:30:44','2022-10-16','2022-10-16','2'),(14,'ASG - SERVIÇOS GERAIS','1300','Ensino Fundamental','BANGU',' sasaasasas   ','sasas  asasas\r\nasasa,as ',15,'Padrao Empresa Parceiras','24463760000101','Encaminhados','2022-10-17 05:01:05','2022-10-17','2022-10-23','3'),(15,'Auxliar administrativo','3000','Ensino Superior imcompleto','centro',' adm\r\n                         ','adm \r\n                         ',15,'Padrao Empresa Parceiras','24463760000101','Encaminhados','2022-10-30 20:53:27','2022-10-30','2022-11-05','2');
/*!40000 ALTER TABLE `tb_vaga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bdrh'
--

--
-- Dumping routines for database 'bdrh'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-08 15:28:32
