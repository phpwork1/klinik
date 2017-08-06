-- MySQL dump 10.13  Distrib 5.6.21, for Win32 (x86)
--
-- Host: localhost    Database: aneka
-- ------------------------------------------------------
-- Server version	5.6.21

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
-- Current Database: `aneka`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `aneka` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `aneka`;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(2) unsigned NOT NULL,
  `code` varchar(12) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `beginning_balance` bigint(20) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `fk-acc-ac-01` FOREIGN KEY (`category_id`) REFERENCES `account_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,1,'KAS','KAS',5000000,'2013-11-27','2013-11-27'),(2,1,NULL,'PIUTANG USAHA',0,'2013-11-25','2013-11-25'),(3,1,NULL,'BANK BCA',0,'2013-11-27','2013-11-27'),(4,1,NULL,'BANK MANDIRI',0,'2013-11-27','2013-11-27'),(5,12,NULL,'BEBAN LISTRIK',0,'2013-12-03','2013-11-28'),(6,12,NULL,'BEBAN AIR',0,'2013-12-01','2013-12-05'),(7,10,NULL,'PENJUALAN',0,'2015-08-28',NULL),(8,12,NULL,'PEMBELIAN',0,'2015-08-28',NULL),(9,11,'PDLU','PENDAPATAN LAIN-LAIN',0,'2015-08-28',NULL),(10,6,'123','HUTANG PEMBELIAN',0,'2015-09-05',NULL),(11,13,'500','PENGELUARAN',100000,'2015-09-06',NULL),(12,11,'PDT','Undian BCA',0,'2015-09-06',NULL),(13,11,'TIPS','TIPS',0,'2015-09-06',NULL),(14,1,'KAS','GIRO BANK DANAMON',0,NULL,NULL),(15,1,'KAS','GIRO BANK BTN',0,NULL,NULL);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_category`
--

DROP TABLE IF EXISTS `account_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_category` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` tinyint(2) unsigned NOT NULL,
  `code` varchar(4) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `fc-ac-ag` FOREIGN KEY (`group_id`) REFERENCES `account_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_category`
--

LOCK TABLES `account_category` WRITE;
/*!40000 ALTER TABLE `account_category` DISABLE KEYS */;
INSERT INTO `account_category` VALUES (1,1,'HALC','HARTA LANCAR'),(2,1,'HAI','HARTA INVESTASI'),(3,1,'HATB','HARTA TAK BERWUJUD'),(4,1,'HAT','HARTA TETAP'),(5,1,'HAL','HARTA LAINNYA'),(6,2,'HUC','HUTANG LANCAR'),(7,2,'HUJP','HUTANG JANGKA PANJANG'),(8,2,'HULL','HUTANG LAIN-LAIN'),(9,3,'MDL','MODAL'),(10,4,'PU','PENDAPATAN USAHA'),(11,4,'PLU','PENDAPATAN DI LUAR USAHA'),(12,5,'BU','BEBAN USAHA'),(13,5,'BLU','BEBAN DI LUAR USAHA');
/*!40000 ALTER TABLE `account_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_group`
--

DROP TABLE IF EXISTS `account_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_group` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(4) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_group`
--

LOCK TABLES `account_group` WRITE;
/*!40000 ALTER TABLE `account_group` DISABLE KEYS */;
INSERT INTO `account_group` VALUES (1,'ASET','ASET/HARTA'),(2,'KWJB','KEWAJIBAN'),(3,'EQTS','EQUITAS'),(4,'PDPT','PENDAPATAN'),(5,'PGLR','PENGELUARAN'),(6,'BDA','BIAYA DEPRESIASI DAN AMORTASI'),(7,'LAIN','LAIN');
/*!40000 ALTER TABLE `account_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('Accounting','12',1420160339),('Accounting','19',1430718623),('Administrator','6',1419223312),('Administrator','7',1419223993),('Kepala Cabang','16',1430718513),('Kepala Cabang','17',1430718548),('Owner','8',1419224032),('Sales Admin','10',1420117993),('Sales Admin','11',1420118327),('Sales Admin','13',1420419972),('Sales Admin','15',1420419972),('Sales Admin','18',1430718577),('Sales Admin','20',1430718669),('Sales Admin','21',1430718697),('Sales Admin','22',1433222686),('Sales Admin','23',1434860437),('Sales Admin','24',1439350656);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx_auth_item_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('Accounting',1,NULL,NULL,NULL,1419222292,1419222292),('Administrator',1,NULL,NULL,NULL,1419222292,1419222292),('Finance',1,NULL,NULL,NULL,1419222292,1419222292),('Kepala Cabang',1,NULL,NULL,NULL,1419222292,1419222292),('Owner',1,NULL,NULL,NULL,1419222292,1419222292),('Sales Admin',1,NULL,NULL,NULL,1419222292,1419222292),('updatePaidTicket',2,'Update Paid Ticket',NULL,NULL,1424848942,1424848942),('updateUser',2,'Update user',NULL,NULL,1419222291,1419222291);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('Accounting','updatePaidTicket'),('Administrator','updatePaidTicket'),('Finance','updatePaidTicket'),('Owner','updatePaidTicket'),('Accounting','updateUser'),('Administrator','updateUser'),('Finance','updateUser'),('Owner','updateUser'),('Sales Admin','updateUser');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bill_footer`
--

DROP TABLE IF EXISTS `bill_footer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bill_footer` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `footer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill_footer`
--

LOCK TABLES `bill_footer` WRITE;
/*!40000 ALTER TABLE `bill_footer` DISABLE KEYS */;
INSERT INTO `bill_footer` VALUES (1,'Disc 25% untuk tiap sabtu pagi.\r\n');
/*!40000 ALTER TABLE `bill_footer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_sale`
--

DROP TABLE IF EXISTS `cash_sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash_sale` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(13) DEFAULT NULL,
  `total` int(10) unsigned NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `FK_cash_sale_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `FK_cash_sale_user_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_sale`
--

LOCK TABLES `cash_sale` WRITE;
/*!40000 ALTER TABLE `cash_sale` DISABLE KEYS */;
/*!40000 ALTER TABLE `cash_sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `province_id` tinyint(3) unsigned NOT NULL,
  `code` varchar(4) NOT NULL,
  `name` varchar(24) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `province_id` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,7,'DJBK','Jambi Kota'),(2,6,'Jkt ','Jakarta '),(3,32,'0711','Sumatera Selatan '),(4,32,'PLB','Palembang'),(5,10,'Sby','Surabaya '),(6,33,'mdn','Medan ');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `email` varchar(48) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `city_id` smallint(5) unsigned DEFAULT NULL,
  `province_id` tinyint(3) unsigned DEFAULT NULL,
  `zip_code` int(6) unsigned DEFAULT NULL,
  `term_of_payment_id` tinyint(3) unsigned DEFAULT NULL,
  `price_category_id` tinyint(3) unsigned DEFAULT NULL,
  `limit` int(10) unsigned DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `province_id` (`province_id`),
  KEY `price_category_id` (`price_category_id`),
  KEY `term_of_payment_id` (`term_of_payment_id`),
  CONSTRAINT `fk-cust-city` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-cust-pricecat` FOREIGN KEY (`price_category_id`) REFERENCES `price_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-cust-prov` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-cust-top` FOREIGN KEY (`term_of_payment_id`) REFERENCES `term_of_payment` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (4,'CASH','-','-','-',1,7,NULL,1,NULL,NULL,NULL,''),(5,'Bank BCA ','','','Pasar Jambi',1,7,NULL,4,NULL,NULL,NULL,''),(6,'Bang Nazar','','','Bayung Lincir ',3,32,NULL,4,NULL,NULL,NULL,''),(7,'PT. Waskita Karya','','','',1,7,NULL,6,NULL,NULL,NULL,''),(8,'Ak Phone','','','',1,7,NULL,4,NULL,NULL,NULL,''),(9,'PT. Surya Sriwijaya Perkasa','','','',1,7,NULL,4,NULL,NULL,NULL,''),(10,'PT. Surya Madistrindo','','','',1,7,NULL,4,NULL,NULL,NULL,''),(11,'PT. Hok Tong','','','',1,7,NULL,4,NULL,NULL,NULL,''),(12,'KSU Anugrah Usaha Kito Tbg Emas','','','',1,7,NULL,4,NULL,NULL,NULL,''),(13,'KSU Anugrah Usaha Kito Hitam Ulu','','','',1,7,NULL,4,NULL,NULL,NULL,''),(14,'KSU Anugrah Usaha Kito Bangko','','','',1,7,NULL,4,NULL,NULL,NULL,''),(15,'Bank OCBC NISP','','','',1,7,NULL,4,NULL,NULL,NULL,''),(16,'BCA Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(17,'PT. Jambi Media Grafika','','','',1,7,NULL,4,NULL,NULL,NULL,''),(18,'PT. Multindo Oto Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(19,'Asuransi Wahana Tata','','','',1,7,NULL,4,NULL,NULL,NULL,''),(20,'BAF Finance','','','',1,7,NULL,1,NULL,NULL,NULL,''),(21,'Citra Mendalo Prima KSO','','','',1,7,NULL,4,NULL,NULL,NULL,''),(22,'KKB Bukopin','','','',1,7,NULL,4,NULL,NULL,NULL,''),(23,'Golden Star','','','',1,7,NULL,4,NULL,NULL,NULL,''),(24,'PT. Sumber Swarna Nusa','','','',1,7,NULL,4,NULL,NULL,NULL,''),(25,'Sundawa','','','',1,7,NULL,4,NULL,NULL,NULL,''),(26,'PT. Kedaton','','','',1,7,NULL,4,NULL,NULL,NULL,''),(27,'PT. Everbright','','','',1,7,NULL,4,NULL,NULL,NULL,''),(28,'Kiky Ekspress','','','',1,7,NULL,4,NULL,NULL,NULL,''),(29,'PO Ratu Intan','','','',1,7,NULL,4,NULL,NULL,NULL,''),(30,'PT. Palma Abadi ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(31,'PT. Palma Jaya Sejahtera ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(32,'Arthess','','','',1,7,NULL,1,NULL,NULL,NULL,''),(33,'KOP BTN Simpang Rimbo ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(34,'PT. Remco ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(35,'Bank Syariah Mandiri','','','',1,7,NULL,4,NULL,NULL,NULL,''),(36,'Apotik dr. Bratanata ','','','',1,7,NULL,1,NULL,NULL,NULL,''),(37,'SMP Unggul Sakti','','','',1,7,NULL,4,NULL,NULL,NULL,''),(38,'Rumah Kito ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(39,'Sinarmas Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(40,'PT. Bina San Prima','','','',1,7,NULL,4,NULL,NULL,NULL,''),(41,'PT. ATGA','','','',1,7,NULL,4,NULL,NULL,NULL,''),(42,'AVIAN','','','',1,7,NULL,1,NULL,NULL,NULL,''),(43,'Suk Asun ','','','',1,7,NULL,6,NULL,NULL,NULL,''),(44,'PT. Dos Ni Roha ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(45,'Aston Hotel','','','',1,7,NULL,4,NULL,NULL,NULL,''),(46,'PT. Angsana Jaya Indah','','','',1,7,NULL,4,NULL,NULL,NULL,''),(47,'CV. Indo Pilling Raya','','','',1,7,NULL,4,NULL,NULL,NULL,''),(48,'PT. Petaling Mandra Guna','','','',1,7,NULL,4,NULL,NULL,NULL,''),(49,'Mandiri Tunas Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(50,'Bank Mandiri Naryo','','','',1,7,NULL,4,NULL,NULL,NULL,''),(51,'Bank Mandiri Rika','','','',1,7,NULL,4,NULL,NULL,NULL,''),(52,'Bank Mandiri Saminah','','','',1,7,NULL,4,NULL,NULL,NULL,''),(53,'Bintang Mas ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(54,'PT. Superfood','','','',1,7,NULL,4,NULL,NULL,NULL,''),(55,'PT. MAS ','','','',1,7,NULL,3,NULL,NULL,NULL,''),(56,'PT. Manggala Alam Lestari','','','',1,7,NULL,4,NULL,NULL,NULL,''),(57,'PT. Asia Sawit Lestari','','','',1,7,NULL,4,NULL,NULL,NULL,''),(58,'PT. Prima Mas Lestari','','','',1,7,NULL,4,NULL,NULL,NULL,''),(59,'Bank Mega Jelutung','','','',1,7,NULL,4,NULL,NULL,NULL,''),(60,'PT. Parit Padang Global','','','',1,7,NULL,4,NULL,NULL,NULL,''),(61,'PT. Sinar Sentosa Primatama','','','',1,7,NULL,4,NULL,NULL,NULL,''),(62,'Noval Photocopy','','','',1,7,NULL,4,NULL,NULL,NULL,''),(63,'PT. Oto Multi Artha','','','',1,7,NULL,4,NULL,NULL,NULL,''),(64,'Procar Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(65,'Cahaya Motor','','','',1,7,NULL,4,NULL,NULL,NULL,''),(66,'First Finance ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(67,'Mbak Miss','','','',1,7,NULL,3,NULL,NULL,NULL,''),(68,'PT. Cahaya Cemerlang Lestari','','','',1,7,NULL,4,NULL,NULL,NULL,''),(69,'PT. CMG ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(70,'Philips','','','',1,7,NULL,4,NULL,NULL,NULL,''),(71,'Novita Hotel','','','',1,7,NULL,4,NULL,NULL,NULL,''),(72,'Shang Ratu Hotel','','','',1,7,NULL,4,NULL,NULL,NULL,''),(73,'Swiss-Belhotel','','','',1,7,NULL,4,NULL,NULL,NULL,''),(74,'PT. Djambi Waras','','','',1,7,NULL,4,NULL,NULL,NULL,''),(75,'Bank BTPN Talang Banjar','','','',1,7,NULL,4,NULL,NULL,NULL,''),(76,'PT. Tiga Raksa','','','',1,7,NULL,4,NULL,NULL,NULL,''),(77,'PT. CKT','','','',1,7,NULL,4,NULL,NULL,NULL,''),(78,'MNC Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(79,'PT. Jambi Motor Kencana Indah','','','',1,7,NULL,4,NULL,NULL,NULL,''),(80,'Bank CIMB Niaga','','','',1,7,NULL,4,NULL,NULL,NULL,''),(81,'Bank BPR Kencana Mandiri','','','',1,7,NULL,4,NULL,NULL,NULL,''),(82,'Bank banten','','','',1,7,NULL,4,NULL,NULL,NULL,''),(83,'PT. Sapta Saritama','','','',1,7,NULL,4,NULL,NULL,NULL,''),(84,'Bank BPR Central Niaga Abadi','','','',1,7,NULL,4,NULL,NULL,NULL,''),(85,'Ratu Hotel','','','',1,7,NULL,4,NULL,NULL,NULL,''),(86,'PT. Tempo','','','',1,7,NULL,4,NULL,NULL,NULL,''),(87,'PT. Surya Mandala','','','',1,7,NULL,4,NULL,NULL,NULL,''),(88,'Masterpiece Karaoke','','','',1,7,NULL,4,NULL,NULL,NULL,''),(89,'PT. Summit Oto Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(90,'PT. Sabang Raya Hotel','','','',1,7,NULL,4,NULL,NULL,NULL,''),(91,'Media Foto','','','',1,7,NULL,4,NULL,NULL,NULL,''),(92,'Siloam Hospital','','','',1,7,NULL,4,NULL,NULL,NULL,''),(93,'CV. Artomoro Sakti','','','',1,7,NULL,4,NULL,NULL,NULL,''),(94,'Bank BCA Sipin','','','',1,7,NULL,4,NULL,NULL,NULL,''),(95,'PT. Sumber Alfaria Trijaya Tbk','','','',1,7,NULL,4,NULL,NULL,NULL,''),(96,'Bank BTPN Sipin','','','',1,7,NULL,4,NULL,NULL,NULL,''),(97,'PT. Jambi Lampura Seberang ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(98,'SMS Finance','','','',1,7,NULL,3,NULL,NULL,NULL,''),(99,'Bank Maybank','','','',1,7,NULL,4,NULL,NULL,NULL,''),(100,'Toserba Abadi','','','',1,7,NULL,4,NULL,NULL,NULL,''),(101,'PT. Agung Baru Sejahtera','','','',6,7,NULL,3,NULL,NULL,NULL,''),(102,'Bank BPR Buana Mandiri','','','',1,7,NULL,4,NULL,NULL,NULL,''),(103,'PT. MYJ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(104,'Dine N Chat','','','',1,7,NULL,4,NULL,NULL,NULL,''),(105,'Simon & Sons','','','',1,7,NULL,4,NULL,NULL,NULL,''),(106,'PT. WOM Finance','','','',1,7,NULL,3,NULL,NULL,NULL,''),(107,'PT. Adira Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(108,'SD Unggul Sakti','','','',1,7,NULL,4,NULL,NULL,NULL,''),(109,'PT. Sumatra Mas Plywood','','','',1,7,NULL,4,NULL,NULL,NULL,''),(110,'CV. Rajawali Alam Semesta','','','',1,7,NULL,4,NULL,NULL,NULL,''),(111,'Mbak Putri / Bang Irsil','','','',1,7,NULL,4,NULL,NULL,NULL,''),(112,'PT, POC','','','',1,7,NULL,4,NULL,NULL,NULL,''),(113,'PT. U Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(114,'SD IT Ahmad Dahlan','','','',1,7,NULL,4,NULL,NULL,NULL,''),(115,'Asuransi AIA','','','',1,7,NULL,4,NULL,NULL,NULL,''),(116,'FC. Dante','','','',1,7,NULL,4,NULL,NULL,NULL,''),(117,'Bang Afdhal','','','',1,7,NULL,4,NULL,NULL,NULL,''),(118,'PT. Indomarco','','','',1,7,NULL,4,NULL,NULL,NULL,''),(119,'PT. Tiga Sepakat Mandiri','','','',1,7,NULL,3,NULL,NULL,NULL,''),(120,'SD Xaverius II','','','',1,7,NULL,4,NULL,NULL,NULL,''),(121,'RS Theresia','','','',1,7,NULL,2,NULL,NULL,NULL,''),(122,'Warung Rawit','','','',1,7,NULL,4,NULL,NULL,NULL,''),(123,'PT. Black Steel','','','',1,7,NULL,4,NULL,NULL,NULL,''),(124,'PT. Yamaha Mataram Sakti ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(125,'PT. Cipta Niaga Semesta','','','',1,7,NULL,4,NULL,NULL,NULL,''),(126,'PT. Trimurni Usaha Jaya','','','',1,7,NULL,4,NULL,NULL,NULL,''),(127,'Mandala Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(128,'Panin Bank','','','',1,7,NULL,4,NULL,NULL,NULL,''),(129,'PT. Agung Rent A Car','','','',1,7,NULL,4,NULL,NULL,NULL,''),(130,'ABDA Insurance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(131,'PT. Samhutani','','','',1,7,NULL,4,NULL,NULL,NULL,''),(133,'PT. Angkasa Raya ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(134,'PT.Indonesia Fibreboard Industry','','','',1,7,NULL,4,NULL,NULL,NULL,''),(135,'PT. Angso Duo Sawit ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(136,'Nova Photocopy','','','',1,7,NULL,4,NULL,NULL,NULL,''),(137,'PT. Cahaya Murni Angso Duo','','','',1,7,NULL,4,NULL,NULL,NULL,''),(138,'PT. Bina Mitra Makmur','','','',1,7,NULL,4,NULL,NULL,NULL,''),(139,'CV. Inti Mulia Jaya','','','',1,7,NULL,4,NULL,NULL,NULL,''),(140,'Buana Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(141,'Ora Naldo','','','',1,7,NULL,4,NULL,NULL,NULL,''),(142,'Golden Star Sipin','','','',1,7,NULL,4,NULL,NULL,NULL,''),(143,'BPJS Kesehatan','','','',1,7,NULL,4,NULL,NULL,NULL,''),(144,'PT. Aneka Bumi Pratama','','','',1,7,NULL,3,NULL,NULL,NULL,''),(145,'Rilexindo Koni','','','',1,7,NULL,4,NULL,NULL,NULL,''),(146,'PT. Capella','','','',1,7,NULL,4,NULL,NULL,NULL,''),(147,'Batavia Finance','','','',1,7,NULL,1,NULL,NULL,NULL,''),(148,'Kanaan Global School','','','',1,7,NULL,4,NULL,NULL,NULL,''),(149,'PT. Fastrata Buana','','','',1,7,NULL,3,NULL,NULL,NULL,''),(150,'BFI Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(151,'PT. Sucofindo','','','',1,7,NULL,4,NULL,NULL,NULL,''),(152,'Bank BPR Mitra Lestari','','','',1,7,NULL,4,NULL,NULL,NULL,''),(153,'Bank BRI Syariah','','','',1,7,NULL,4,NULL,NULL,NULL,''),(154,'PT. Jambi Mandiri Sentosa / JMS ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(155,'Bank BPR Pundi Dana Mandiri','','','',1,7,NULL,4,NULL,NULL,NULL,''),(156,'PT. Bestprofit Futures ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(157,'PT. Catur ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(159,'PD. Ogan','','','',1,7,NULL,4,NULL,NULL,NULL,''),(160,'PT. Bintang Baru Sejahtera','','','',1,7,NULL,4,NULL,NULL,NULL,''),(161,'PT. Sumber Agrindo Sejahtera','','','',1,7,NULL,4,NULL,NULL,NULL,''),(162,'PT. PBP','','','',1,7,NULL,4,NULL,NULL,NULL,''),(163,'PT. PAUL','','','',1,7,NULL,4,NULL,NULL,NULL,''),(164,'KOP. PLN ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(165,'Tk. Abadi Jaya Teknik','','','',1,7,NULL,4,NULL,NULL,NULL,''),(166,'PT. Mitra Sawit Jambi ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(167,'Bank BRI Agro','','','',1,7,NULL,4,NULL,NULL,NULL,''),(168,'PT. Anugrah Bungo Lestari','','','',1,7,NULL,4,NULL,NULL,NULL,''),(169,'Diva Karaoke','','','',1,7,NULL,4,NULL,NULL,NULL,''),(170,'KOP BNI','','','',1,7,NULL,4,NULL,NULL,NULL,''),(171,'Bank Danamon Talang Banjar','','','',1,7,NULL,4,NULL,NULL,NULL,''),(172,'Gunung Sari','','','',1,7,NULL,4,NULL,NULL,NULL,''),(173,'PT. Kresna Duta Agroindo','','','',1,7,NULL,4,NULL,NULL,NULL,''),(174,'PT. Satya Kisma Usaha','','','',1,7,NULL,4,NULL,NULL,NULL,''),(175,'PT. Dasa Anugrah Sejati ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(176,'PT. Inti Indosawit Subur','','','',1,7,NULL,4,NULL,NULL,NULL,''),(177,'Bang Rafit','','','',1,7,NULL,4,NULL,NULL,NULL,''),(178,'Bang Yamir','','','',1,7,NULL,4,NULL,NULL,NULL,''),(179,'Pak Syahrandi','','','',1,7,NULL,4,NULL,NULL,NULL,''),(180,'Mbak Ijuz','','','',1,7,NULL,3,NULL,NULL,NULL,''),(181,'PT. SBPU','','','',1,7,NULL,4,NULL,NULL,NULL,''),(182,'Bank BPR Universal Sentosa','','','',1,7,NULL,4,NULL,NULL,NULL,''),(183,'PT. Jambi Vision','','','',1,7,NULL,4,NULL,NULL,NULL,''),(184,'Pak Sandi','','','',1,7,NULL,4,NULL,NULL,NULL,''),(185,'Bang Johar','','','',1,7,NULL,4,NULL,NULL,NULL,''),(186,'PT. Kirana Windu','','','',1,7,NULL,4,NULL,NULL,NULL,''),(187,'Kangaroo','','','',1,7,NULL,4,NULL,NULL,NULL,''),(188,'Tata Logam','','','',1,7,NULL,4,NULL,NULL,NULL,''),(189,'Grand Hotel','','','',1,7,NULL,4,NULL,NULL,NULL,''),(190,'PT. KNC','','','',1,7,NULL,4,NULL,NULL,NULL,''),(191,'ACA Insurance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(192,'PT. Mega Wahana Pesona','','','',1,7,NULL,4,NULL,NULL,NULL,''),(193,'PT. Traktor Nusantara','','','',1,7,NULL,4,NULL,NULL,NULL,''),(194,'PT. Kumala Melur','','','',1,7,NULL,4,NULL,NULL,NULL,''),(195,'Stephen Computer','','','',1,7,NULL,4,NULL,NULL,NULL,''),(196,'Tk. Bintang Elektronik','','','',1,7,NULL,4,NULL,NULL,NULL,''),(197,'D\'Cost','','','',1,7,NULL,4,NULL,NULL,NULL,''),(198,'Cosmo Hotel','','','',1,7,NULL,4,NULL,NULL,NULL,''),(199,'B Phone','','','',1,7,NULL,4,NULL,NULL,NULL,''),(200,'PT. Unilever','','','',1,7,NULL,4,NULL,NULL,NULL,''),(201,'Tk. Bimasakti Kuala Tungkal','','','',1,7,NULL,6,NULL,NULL,NULL,''),(202,'Bank BPR Perdana','','','',1,7,NULL,4,NULL,NULL,NULL,''),(203,'PT. Ken Brother','','','',1,7,NULL,4,NULL,NULL,NULL,''),(204,'Purnama Photocopy','','','',1,7,NULL,4,NULL,NULL,NULL,''),(205,'Inul Vista Karaoke','','','',1,7,NULL,4,NULL,NULL,NULL,''),(206,'PT. Biccon Agro Makmur ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(207,'PT. Mensa Bina Sukses ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(208,'Q-mart','','','',1,7,NULL,4,NULL,NULL,NULL,''),(209,'PT. Air Nav Indonesia','','','',1,7,NULL,4,NULL,NULL,NULL,''),(210,'Lavender','','','',1,7,NULL,4,NULL,NULL,NULL,''),(211,'PT. Anindya','','','',1,7,NULL,4,NULL,NULL,NULL,''),(212,'Clipan Finance','','','',1,7,NULL,4,NULL,NULL,NULL,''),(213,'Hikma Photocopy','','','',1,7,NULL,4,NULL,NULL,NULL,''),(214,'Pak Pahmi','','','',1,7,NULL,4,NULL,NULL,NULL,''),(215,'Royal Garden Resort','','','',1,7,NULL,4,NULL,NULL,NULL,''),(216,'PT. Hutan Alam Lestari','','','',1,7,NULL,4,NULL,NULL,NULL,''),(217,'PT. Fajar Pematang Indah Lestari','','','',1,7,NULL,4,NULL,NULL,NULL,''),(218,'Bank Artha Graha','','','',1,7,NULL,4,NULL,NULL,NULL,''),(219,'PT.Indofood CBPSukses Makmur Tbk','','','',1,7,NULL,4,NULL,NULL,NULL,''),(220,'PT. United Tractor','','','',1,7,NULL,4,NULL,NULL,NULL,''),(221,'Percetakan Bumiputera','','','',1,7,NULL,4,NULL,NULL,NULL,''),(222,'PT. Linggau Prima Perkasa','','','',1,7,NULL,4,NULL,NULL,NULL,''),(223,'PT. Gerak Bangun Nusa','','','',1,7,NULL,4,NULL,NULL,NULL,''),(224,'Sekolah Nurul Hidayah','','','',1,7,NULL,4,NULL,NULL,NULL,''),(225,'PT. Ciputra NGK Mitra','','','',1,7,NULL,4,NULL,NULL,NULL,''),(226,'PT. Tegas Guna Mandiri (TGM)','','','',1,7,NULL,4,NULL,NULL,NULL,''),(227,'PT. Bumi Mentari Karya','','','',1,7,NULL,4,NULL,NULL,NULL,''),(228,'Bang Indra','','','',1,7,NULL,4,NULL,NULL,NULL,''),(229,'Bang Eko','','','',1,7,NULL,4,NULL,NULL,NULL,''),(230,'Niaga Finance ','','','Kebun Handil',1,7,NULL,4,NULL,NULL,NULL,'Langsung Buat Tanda Terima'),(231,'Bank BCA Talang Banjar','','','',1,7,NULL,4,NULL,NULL,NULL,''),(232,'PT. MBB','','','',1,7,NULL,4,NULL,NULL,NULL,''),(233,'Sederhana THEHOK ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(234,'BANG SURYA','','','',1,7,NULL,3,NULL,NULL,NULL,''),(235,'Adira Warehouse','','','',1,7,NULL,4,NULL,NULL,NULL,''),(236,'STIKOM S1','','','',1,7,NULL,4,NULL,NULL,NULL,''),(237,'STIKOM S2','','','',1,7,NULL,4,NULL,NULL,NULL,''),(238,'Bank Mandiri','','','',1,7,NULL,4,NULL,NULL,NULL,''),(239,'BTN cabang','','','',1,7,NULL,4,NULL,NULL,NULL,''),(240,'Bank BRI Syariah Financing supor','','','',1,7,NULL,1,NULL,NULL,NULL,''),(241,'Bank BRI Syariah Mikro Area ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(242,'Bank BRI Syariah SMEC Consumer','','','',1,7,NULL,4,NULL,NULL,NULL,''),(243,'Kehijau Berbak','','','',1,7,NULL,1,NULL,NULL,NULL,''),(244,'Indomobil Finance Ka. Tungkal','','','',1,7,NULL,4,NULL,NULL,NULL,''),(245,'Djambi Vision ','','','',1,7,NULL,2,NULL,NULL,NULL,''),(246,'PTPN6','','','',1,7,NULL,3,NULL,NULL,NULL,''),(247,'Bank BPR Mitra Lestari S. Bahar','','','',1,7,NULL,4,NULL,NULL,NULL,''),(248,'PT.JMS','','','',1,7,NULL,1,NULL,NULL,NULL,''),(249,'KEBUN PETALING ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(250,'KEBUN TANJUNG PAUH','','','',1,7,NULL,4,NULL,NULL,NULL,''),(251,'KEBUN SEPINTUN','','','',1,7,NULL,4,NULL,NULL,NULL,''),(252,'KEBUN BUNGKU','','','',1,7,NULL,4,NULL,NULL,NULL,''),(254,'Pak Helmi','','','',1,7,NULL,4,NULL,NULL,NULL,''),(255,'Bu Listaryati','','','',1,7,NULL,2,NULL,NULL,NULL,'SUNGAI BENGKAL'),(256,'PT.Mandiangin Batu Bara','','','',1,7,NULL,4,NULL,NULL,NULL,''),(257,'TMA','','','',1,7,NULL,4,NULL,NULL,NULL,''),(258,'Bang Muslim ','','','',1,7,NULL,4,NULL,NULL,NULL,''),(259,'Bang Syamsul','','','',1,7,NULL,3,NULL,NULL,NULL,''),(260,'kebun Sei,Bahar','','','',1,7,NULL,4,NULL,NULL,NULL,''),(261,'kebun Sei,Durian','','','',1,7,NULL,4,NULL,NULL,NULL,''),(262,'BSM   kantor Pos','','','',1,7,NULL,4,NULL,NULL,NULL,''),(263,'Kantor Paal V','','','',1,7,NULL,1,NULL,NULL,NULL,''),(264,'PT. Cahaya Sawit Lestari','','','',1,7,NULL,4,NULL,NULL,NULL,''),(265,'Koperasi BTN','','','',1,7,NULL,4,NULL,NULL,NULL,''),(266,'PT. Sabang Raya Indah','','','',1,7,NULL,4,NULL,NULL,NULL,''),(267,'BTPN Syariah','','','',1,7,NULL,4,NULL,NULL,NULL,''),(268,'Bang Ferry','','','',1,7,NULL,1,NULL,NULL,NULL,''),(269,'Mini Market \"WINWIN\"','','','',1,7,NULL,5,NULL,NULL,NULL,'Jl. Kapten Pattimura Simpang Rimbo'),(270,'Mini Market \"GARUDA\"','','','',1,7,NULL,5,NULL,NULL,NULL,'Jalan Lingkar Selatan ');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `joined_date` date NOT NULL,
  `name` varchar(32) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(32) NOT NULL,
  `salary` int(11) DEFAULT NULL,
  `commission` decimal(5,2) DEFAULT NULL,
  `note` text,
  `status` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'2016-03-01','Tonny Sofijan','Cempaka Putih','08192588008',10000000,20.00,'','Y'),(2,'2016-04-05','Michael ','','08117456399',NULL,NULL,NULL,'Y'),(3,'2016-04-05','Steffi','','25769',NULL,NULL,NULL,'Y'),(4,'2016-04-06','CHANDRA ','','074124708',NULL,NULL,NULL,'Y'),(5,'2016-04-08','Mas Yudi','','085767024465',NULL,NULL,NULL,'Y'),(6,'2016-04-08','Mira ','','-',NULL,NULL,NULL,'Y'),(7,'2016-04-08','Jimmy ','Padang ','-',NULL,NULL,NULL,'Y'),(8,'2016-04-22','Michael Chandra','','07415911191',NULL,NULL,NULL,'Y');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(13) DEFAULT NULL,
  `debet` smallint(5) unsigned DEFAULT NULL,
  `credit` smallint(5) unsigned DEFAULT NULL,
  `amount` int(10) unsigned NOT NULL,
  `detail` varchar(128) DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `debet` (`debet`),
  KEY `credit` (`credit`),
  CONSTRAINT `fk-exps-acc-01` FOREIGN KEY (`debet`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-exps-acc-02` FOREIGN KEY (`credit`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-exps-user-01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-exps-user-02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense`
--

LOCK TABLES `expense` WRITE;
/*!40000 ALTER TABLE `expense` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `income`
--

DROP TABLE IF EXISTS `income`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `income` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(13) DEFAULT NULL,
  `debet` smallint(5) unsigned DEFAULT NULL,
  `credit` smallint(5) unsigned DEFAULT NULL,
  `amount` int(10) unsigned NOT NULL,
  `detail` varchar(128) DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `debet` (`debet`),
  KEY `credit` (`credit`),
  CONSTRAINT `fk-inc-acc-01` FOREIGN KEY (`debet`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-inc-acc-02` FOREIGN KEY (`credit`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-inc-user-01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-inc-user-02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `income`
--

LOCK TABLES `income` WRITE;
/*!40000 ALTER TABLE `income` DISABLE KEYS */;
/*!40000 ALTER TABLE `income` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parameter`
--

DROP TABLE IF EXISTS `parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameter` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(48) NOT NULL,
  `address` varchar(96) NOT NULL,
  `city` varchar(24) NOT NULL,
  `province` varchar(24) NOT NULL,
  `zip_code` int(5) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `mobile` varchar(32) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `facebook` varchar(64) DEFAULT NULL,
  `twitter` varchar(64) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `slogan` varchar(128) DEFAULT NULL,
  `app_name` varchar(48) NOT NULL,
  `header` varchar(128) DEFAULT NULL,
  `footer` varchar(128) DEFAULT NULL,
  `invoice_printer` char(1) NOT NULL DEFAULT '0' COMMENT '0=struk;1=invoice;2=kwitansi',
  `receipt_printer` char(1) NOT NULL DEFAULT '1' COMMENT '0=struk;1=invoice;2=kwitansi',
  `reset_username` varchar(24) DEFAULT NULL,
  `reset_password` varchar(50) DEFAULT NULL,
  `empty_username` varchar(24) DEFAULT NULL,
  `empty_password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameter`
--

LOCK TABLES `parameter` WRITE;
/*!40000 ALTER TABLE `parameter` DISABLE KEYS */;
INSERT INTO `parameter` VALUES (1,'Aneka Stationery','Jl. Halim Perdana Kusuma','Jambi','Jambi',0,'5911191','','','','','','Kami Melayani Lebih Baik','Aneka','','','1','1','','','','');
/*!40000 ALTER TABLE `parameter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_category`
--

DROP TABLE IF EXISTS `price_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_category` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(4) NOT NULL,
  `name` varchar(24) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_category`
--

LOCK TABLES `price_category` WRITE;
/*!40000 ALTER TABLE `price_category` DISABLE KEYS */;
INSERT INTO `price_category` VALUES (1,'ECR','ECERAN');
/*!40000 ALTER TABLE `price_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_list`
--

DROP TABLE IF EXISTS `price_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `price_category_id` tinyint(3) unsigned DEFAULT NULL,
  `price` double(14,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `price_category_id` (`price_category_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk-pl-pc-01` FOREIGN KEY (`price_category_id`) REFERENCES `price_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-pl-product-01` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_list`
--

LOCK TABLES `price_list` WRITE;
/*!40000 ALTER TABLE `price_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `price_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `printer`
--

DROP TABLE IF EXISTS `printer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `printer` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `computer_name` varchar(32) NOT NULL,
  `computer_user` varchar(24) DEFAULT NULL,
  `computer_password` varchar(24) DEFAULT NULL,
  `printer_name` varchar(32) NOT NULL,
  `printer_type` char(1) NOT NULL,
  `printer_port` varchar(5) DEFAULT NULL,
  `print_quality` char(1) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `printer`
--

LOCK TABLES `printer` WRITE;
/*!40000 ALTER TABLE `printer` DISABLE KEYS */;
INSERT INTO `printer` VALUES (1,'DESKTOP-TDDAL53','atkan','123456','LQ310','2','LPT1','0',''),(2,'user-pc','User','123456','lq310','1','lpt1','1',''),(3,'rio-pc','rio','123456789','lq310','1','lpt1','1','');
/*!40000 ALTER TABLE `printer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(16) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `category_id` smallint(5) unsigned DEFAULT NULL,
  `brand_id` smallint(5) unsigned DEFAULT NULL,
  `pricelist` int(10) unsigned NOT NULL DEFAULT '0',
  `discount1` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `discount2` decimal(4,2) NOT NULL DEFAULT '0.00',
  `capital` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `minimum_quantity` tinyint(3) unsigned DEFAULT '0',
  `unit_id` tinyint(3) unsigned DEFAULT NULL,
  `location` varchar(12) DEFAULT NULL,
  `note` text,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brand_id` (`brand_id`),
  KEY `category_id` (`category_id`),
  KEY `unit_id` (`unit_id`),
  KEY `created_by` (`created_by`,`updated_by`),
  KEY `updated_by` (`updated_by`),
  KEY `updated_by_2` (`updated_by`),
  KEY `unit_id_2` (`unit_id`),
  CONSTRAINT `fk-product-ib-01` FOREIGN KEY (`brand_id`) REFERENCES `product_brand` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-product-ic-01` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-product-unit-01` FOREIGN KEY (`unit_id`) REFERENCES `product_unit` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-product-user-01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-product-user-02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=834 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (8,'','Kertas A4 @70gsm ',6,18,28175,5.00,0.00,26766,27000,715,0,2,'','15 dus Bonus 1 dus ( Harga potong habis ) ','2016-04-06',1,'2016-11-09',9),(9,'','Buku Gambar K Super ',7,7,22800,10.00,0.00,20520,23000,0,0,5,'','','2016-04-06',1,'2016-10-31',1),(10,'','Kertas Tellstruk 75 x 65 2 ply ',6,8,50594,0.00,0.00,50594,50594,-20,0,5,'','','2016-04-06',1,'2016-11-04',1),(11,'','Kertas F4 @70gsm ',6,7,32947,0.00,0.00,32947,33000,376,0,2,'','11 dus bonus 1 dus ','2016-04-06',1,'2016-11-10',1),(12,'','Kertas A4 @70gsm ',6,7,30300,4.50,0.00,28936,30000,199,0,2,'','11 dus bonus 1 dus ','2016-04-06',1,'2016-11-10',1),(13,'','Tali Uang ',8,6,37500,0.00,0.00,37500,45000,0,0,6,'','','2016-04-06',1,'2016-04-06',1),(14,'','Plastik Buah / Fotocopy ',9,9,44000,0.00,0.00,44000,65000,120,0,6,'','1.7 kg 1 dus isi 12 roll ','2016-04-06',1,'2016-11-06',8),(15,'','Kertas Bufallo Biru Benhur ',6,10,18800,0.00,0.00,18800,23000,-3,0,5,'','','2016-04-06',1,'2016-11-06',1),(16,'','Kertas Photo Silky ',6,11,33000,0.00,0.00,33000,36000,0,0,5,'','','2016-04-06',1,'2016-10-31',1),(17,'','Plastik Laminating F4 ',9,12,58000,0.00,0.00,58000,58000,-3,0,5,'','','2016-04-06',1,'2016-11-10',1),(18,'','Box File Hitam ',10,10,7500,0.00,0.00,7500,15000,0,0,1,'','','2016-04-06',1,'2016-04-07',1),(19,'','Box File Biru ',10,10,7500,0.00,0.00,7500,15000,-9,0,1,'','','2016-04-06',1,'2016-11-06',8),(20,'','Box File Biru ',10,13,7292,0.00,0.00,7292,15000,-10,0,1,'','','2016-04-06',1,'2016-11-09',9),(21,'','Ordner 401 ',10,10,11500,0.00,0.00,11500,15000,-7,0,1,'','','2016-04-06',1,'2016-11-05',1),(22,'','Pita Printer 2180',11,14,12500,0.00,0.00,12500,15000,452,0,1,'','','2016-04-06',1,'2016-11-09',9),(23,'','Pita Printer LX 300/310',11,14,4500,0.00,0.00,4500,7500,-23,0,1,'','','2016-04-06',1,'2016-11-07',9),(24,'','CD-RW (TBG)',11,15,195000,0.00,0.00,195000,225000,0,0,8,'','','2016-04-06',1,'2016-06-20',7),(26,'','Map plastik tulang / Spring file Merah',10,53,3300,0.00,0.00,3300,5000,-36,0,1,'','','2016-04-06',1,'2016-11-09',1),(27,'','Kalkulator MJ-120 D ',13,19,84328,0.00,0.00,84328,95000,-2,0,1,'','','2016-04-06',1,'2016-11-04',1),(28,'','Kalkulator DH-16',13,19,220000,40.00,8.00,121440,175000,0,0,1,'','','2016-04-06',1,'2016-04-06',1),(29,'','Kalkulator HR-100 TM ',13,19,461000,40.00,8.00,254472,300000,5,0,1,'','','2016-04-06',1,'2016-11-06',8),(30,'','Kalkulator SDC 868 L ',13,20,81500,0.00,0.00,81500,95000,75,0,1,'','','2016-04-06',1,'2016-11-10',1),(31,'','Lakban hitam 1 1/2\" ',12,16,7125,0.00,0.00,7125,9000,-6,0,6,'','','2016-04-06',1,'2016-11-09',1),(32,'','Lakban hitam 2\"',12,16,9500,0.00,0.00,9500,12000,-18,0,1,'','','2016-04-06',1,'2016-11-08',9),(33,'','Paper/Trigonal clip no. 3 (B)',14,23,7250,0.00,0.00,7250,12000,293,0,9,'','','2016-04-06',1,'2016-11-07',9),(34,'','Paper clip no. 5 (B)',14,23,19500,0.00,0.00,19500,30000,-3,0,9,'','','2016-04-06',1,'2016-11-08',9),(35,'','Tinta DP-40 ',11,6,23000,0.00,0.00,23000,25000,0,0,10,'','','2016-04-06',1,'2016-04-06',1),(36,'','Tinta DP-41 ',11,6,22000,0.00,0.00,22000,25000,0,0,10,'','','2016-04-06',1,'2016-04-06',1),(37,'','Spidol 12 warna Fancy',15,6,32500,0.00,0.00,32500,40000,0,0,5,'','1 pak isi 12 set ','2016-04-06',1,'2016-04-22',7),(38,'','Plastik Jilid Bening ',9,6,16000,0.00,0.00,16000,23000,0,0,5,'','','2016-04-06',1,'2016-04-06',1),(39,'','Plastik Jilid Merah ',9,6,17000,0.00,0.00,17000,23000,-1,0,6,'','','2016-04-06',1,'2016-11-06',1),(40,'','Plastik Jilid Biru Tua ',9,6,17000,0.00,0.00,17000,23000,0,0,5,'','','2016-04-06',1,'2016-11-02',1),(41,'','Plastik Jilid Biru Muda ',9,6,17250,0.00,0.00,17250,23000,147,0,5,'','','2016-04-06',1,'2016-11-06',8),(42,'','Plastik Jilid Kuning ',7,6,17000,0.00,0.00,17000,23000,-1,0,5,'','','2016-04-06',1,'2016-11-06',1),(43,'','Clipboard Fancy ',10,6,60000,0.00,0.00,60000,48000,0,0,4,'','','2016-04-06',1,'2016-04-20',1),(44,'','Pena Standard AE-7 Hitam (K)',16,24,13250,0.00,0.00,13250,15000,-47,0,4,'','1 gross = 159.000','2016-04-06',1,'2016-11-09',1),(45,'','Pena Standard ST-009 Htm (K)',16,24,15375,0.00,0.00,15375,18000,-9,0,4,'','1 gross = 184500','2016-04-06',1,'2016-11-09',1),(46,'','Cartridge ERC-38 ',11,25,17500,0.00,0.00,17500,30000,0,0,1,'','','2016-04-06',1,'2016-04-08',1),(47,'','Cartridge EPSON LX-310',11,26,13000,0.00,0.00,13000,20000,0,0,1,'','','2016-04-06',1,'2016-04-06',1),(48,'','Cartridge EPSON LX-300',11,26,11000,0.00,0.00,11000,20000,-5,0,1,'','','2016-04-06',1,'2016-11-09',9),(49,'','Cartridge Olivetti Pr-2PR',11,26,30000,0.00,0.00,30000,40000,-25,0,1,'','','2016-04-06',1,'2016-11-09',9),(50,'','Cartridge IBM 01 Original ',11,6,100000,0.00,0.00,100000,150000,0,0,1,'','','2016-04-06',1,'2016-04-06',1),(51,'','Cartridge Compuprint SP-40 Plus',11,6,300000,0.00,0.00,300000,350000,-2,0,1,'','','2016-04-06',1,'2016-11-03',1),(52,'','Tissue 900 gr ',17,27,20114,0.00,0.00,20114,25000,-27,0,6,'','1 dus isi 20 pak \r\n','2016-04-06',1,'2016-11-09',9),(53,'','Pelobang kertas No.85',17,22,29509,0.00,0.00,29509,38000,0,0,1,'','','2016-04-06',1,'2016-04-06',1),(54,'','Tip-ex Cair (K)',17,22,2702,0.00,0.00,2702,5000,-15,0,1,'','Harga Lusinan 39.000 Disc 12.5 + 5 % : 32.419','2016-04-06',1,'2016-11-09',9),(55,'','Film Fax IT 93 A PANASONIC ',13,6,60000,0.00,0.00,60000,75000,-20,0,10,'','','2016-04-06',1,'2016-11-08',9),(56,'','Tape Dispenser Isolasi ',17,22,14214,0.00,0.00,14214,25000,-3,0,1,'','TD-103 ','2016-04-06',1,'2016-11-09',9),(57,'','Lem Cair Joyko ',12,22,1912,0.00,0.00,1912,4000,0,0,1,'','','2016-04-06',1,'2016-04-15',1),(58,'','Pena Standard AE-7 Merah (K)',16,24,13250,0.00,0.00,13250,15000,-5,0,4,'','','2016-04-06',1,'2016-11-09',9),(59,'','Pena Standard AE-7 Biru (K)',16,24,13250,0.00,0.00,13250,15000,-12,0,4,'','','2016-04-06',1,'2016-11-10',1),(60,'','Ordner 401 ',10,28,11605,0.00,0.00,11605,15000,-66,0,1,'','','2016-04-06',1,'2016-11-10',1),(61,'','Ordner 402 ',10,28,11542,0.00,0.00,11542,15000,-24,0,1,'','','2016-04-06',1,'2016-11-09',9),(62,'','Ordner 403',10,28,11542,0.00,0.00,11542,15000,0,0,1,'','','2016-04-06',1,'2016-04-08',1),(63,'','Lem Cair Povinal 111 (B)',12,6,14700,0.00,0.00,14700,18000,0,0,4,'','','2016-04-06',1,'2016-11-03',1),(64,'','Lem Cair Povinal 112 (B)',12,6,30600,0.00,0.00,30600,36000,-3,0,10,'','1 ktk 1 lsn ','2016-04-06',1,'2016-11-06',1),(65,'','Tinta Stempel (B)',17,29,78200,0.00,0.00,78200,95000,-1,0,4,'','','2016-04-06',1,'2016-11-09',9),(66,'','Post it 654 3 x 3 \" ',17,30,7700,0.00,0.00,7700,10000,-42,0,5,'','','2016-04-06',1,'2016-11-09',9),(67,'','Post it 655 3 x 5\" ',17,30,12430,0.00,0.00,12430,15000,-3,0,5,'','','2016-04-06',1,'2016-11-09',9),(68,'','Post it Sign Here ',17,30,15510,0.00,0.00,15510,20000,-3,0,5,'','','2016-04-06',1,'2016-11-08',1),(69,'','Pena Zebra Sarasa ',16,6,150000,0.00,0.00,150000,165000,0,0,4,'','','2016-04-06',1,'2016-04-06',1),(70,'','Buku SSP Tebal ',7,6,11000,0.00,0.00,11000,15000,0,0,1,'','','2016-04-06',1,'2016-04-06',1),(71,'','Lakban bening 2\" Core Merah (K)',12,31,6400,0.00,0.00,6400,10000,-191,0,7,'','1 dus 72 roll ','2016-04-06',1,'2016-11-10',9),(72,'','Bingkai Foto 10 R/ 8 R ',17,6,8750,0.00,0.00,8750,11000,0,0,1,'','','2016-04-06',1,'2016-11-02',1),(73,'','Kertas F4 @60gsm ',6,7,26919,0.00,0.00,26919,31000,-15,0,2,'','','2016-04-06',1,'2016-11-10',1),(74,'','Kertas A4-s @70gsm ',6,7,29366,0.00,0.00,29366,31000,0,0,2,'','','2016-04-06',1,'2016-04-23',7),(75,'','Map Biola 5002 merah',10,6,44000,0.00,0.00,44000,53500,0,0,10,'','','2016-04-06',1,'2016-10-31',1),(76,'','Loose Leaf A5 / Isi Binder A5',6,32,2348,10.00,0.00,2113,2500,0,0,5,'','','2016-04-06',1,'2016-11-08',8),(77,'','Buku 38 ',7,17,10200,10.00,0.00,9180,10000,-1,0,5,'','1 pak = 10 buku , 1 dus = 40 pak ','2016-04-06',1,'2016-10-31',1),(78,'','Kalkulator MZ - 12 s ',13,19,91000,40.00,8.00,50232,55000,20,0,6,'','','2016-04-06',1,'2016-11-06',8),(79,'','Kalkulator JJ-120 D ',13,19,98473,0.00,0.00,98473,105000,0,0,1,'','','2016-04-06',1,'2016-05-24',7),(80,'','Kalkulator DJ-240 D ',13,19,296000,40.00,8.00,163392,175000,0,0,6,'','','2016-04-06',1,'2016-04-06',1),(81,'','Kalkulator DM-1600',13,19,320000,40.00,8.00,176640,185000,0,0,1,'','','2016-04-06',1,'2016-04-06',1),(82,'','Lakban coklat 2\" Core Merah (K)',12,31,6400,0.00,0.00,6400,10000,-8,0,7,'','','2016-04-06',1,'2016-11-08',9),(83,'','Map L Daichi ',10,6,19750,0.00,0.00,19750,25000,-1,0,4,'','','2016-04-06',1,'2016-11-09',9),(84,'','Jangka Set Amanda #716',17,12,8000,0.00,0.00,8000,9000,0,0,1,'','','2016-04-06',1,'2016-04-08',1),(85,'','Jangka Set V-90 (LSN)',17,12,36000,0.00,0.00,36000,45000,0,0,4,'','','2016-04-06',1,'2016-04-22',7),(86,'','Pensil 2b (B)',17,34,25550,0.00,0.00,25550,28000,-3,0,1,'','','2016-04-06',1,'2016-11-06',1),(87,'','Pensil 2b biasa (K)',17,6,3000,0.00,0.00,3000,3000,-5,0,1,'','','2016-04-06',1,'2016-11-09',9),(88,'','Kertas Quarto @80gsm ',6,37,28976,0.00,0.00,28976,32000,0,0,2,'','','2016-04-06',1,'2016-04-08',1),(89,'','Mouse Pad ',11,6,3750,0.00,0.00,3750,6000,0,0,1,'','','2016-04-06',1,NULL,NULL),(90,'','Map Kertas Tulang / Snelhecter merah',10,6,18900,0.00,0.00,18900,25000,0,0,5,'','1 pak isi 50 ','2016-04-06',1,'2016-04-20',1),(91,'','Buku 50',7,17,12900,10.00,0.00,11610,15000,0,0,5,'','1 dus isi 28 pak ','2016-04-06',1,'2016-04-20',1),(92,'','Amplop Coklat uk Folio F4 ',17,6,24000,0.00,0.00,24000,35000,490,0,5,'','','2016-04-06',1,'2016-11-09',9),(93,'','Buku Quarto 100 (K)',7,7,5185,0.00,0.00,5185,7000,0,0,1,'','Harga list 28.805 / pak discount 10 %\r\n','2016-04-06',1,'2016-04-25',7),(94,'','Post-it 654 STICKY NOTE ',17,6,3361,0.00,0.00,3361,7000,0,0,1,'','Harga List 3.735','2016-04-06',1,'2016-04-06',1),(95,'','Kertas Tellstruk 58 x 48 x 12 ',6,6,15233,0.00,0.00,15233,18000,-4,0,5,'','Harga list 16.926 Disc 10%','2016-04-06',1,'2016-11-08',9),(96,'','Kertas A4 @70gsm ',6,37,30250,4.50,0.00,28888,30000,125,0,2,'','Beli 10 Bonus 1 dus ','2016-04-06',1,'2016-11-09',8),(97,'','Buku gambar A-3',7,7,31500,0.00,0.00,31500,36000,0,0,5,'','Harga list 35.000 Discount 10%','2016-04-06',1,'2016-04-06',1),(98,'','Kertas CF 14 7/8 x 11\" 1 ply ',6,38,213233,1.00,0.00,211100,225500,-20,0,3,'','Harga List 228.132 disc 10%','2016-04-06',1,'2016-11-09',8),(99,'','Tinta Stempel (K)',17,29,6700,0.00,0.00,6700,8000,-17,0,12,'','Matahari ','2016-04-06',1,'2016-11-09',9),(100,'','Kertas CF 9 1/2 x 11\" 1 ply ',6,38,144901,8.00,1.00,131976,144901,-4,0,3,'','Harga : 144.901 - 10% ','2016-04-06',1,'2016-11-08',8),(101,'','Kertas CF 9 1/2 x 11\" 2 ply',6,38,208487,1.00,0.00,206402,219000,7,0,3,'','harga 208.487 disc 3% ','2016-04-06',1,'2016-11-09',9),(102,'','Kertas CF 9 1/2 x 11\" 4 ply PRS ',6,38,231600,0.00,0.00,231600,248000,0,0,3,'','harga 236.327 disc 3% ','2016-04-06',1,'2016-04-28',7),(103,'','Kertas CF 9 1/2 x 11\" 3 ply ',6,38,312165,0.00,0.00,312165,330000,0,0,3,'','Harga 321.820 disc 3% ','2016-04-06',1,'2016-04-15',1),(104,'','Stopmap folio merah ',10,10,14500,0.00,0.00,14500,18000,-6,0,5,'','','2016-04-06',1,'2016-11-07',9),(105,'','Stopmap folio kuning',10,10,14500,0.00,0.00,14500,18000,-5,0,5,'','','2016-04-06',1,'2016-11-07',9),(106,'','Stopmap folio hijau',10,10,14500,0.00,0.00,14500,18000,-6,0,5,'','','2016-04-06',1,'2016-11-09',9),(107,'','Stopmap folio biru ',10,10,14500,0.00,0.00,14500,18000,-19,0,5,'','','2016-04-06',1,'2016-11-07',9),(108,'','Plastik ID Card 10.5 x 16 cm ',17,6,23000,0.00,0.00,23000,35000,0,0,5,'','','2016-04-06',1,'2016-04-06',1),(109,'','Map Batik folio ',10,6,37500,0.00,0.00,37500,45000,-1,0,5,'','','2016-04-06',1,'2016-11-07',9),(110,'','Pisau Cutter L-500 (K)',17,39,9375,0.00,0.00,9375,12000,-8,0,1,'','','2016-04-06',1,'2016-11-07',9),(111,'','Isi cutter L-150 (K)',17,39,3733,0.00,0.00,3733,5000,-36,0,10,'','','2016-04-06',1,'2016-11-09',9),(112,'','Lem Glue stick 25gr ',12,39,4417,0.00,0.00,4417,6000,-47,0,1,'','','2016-04-06',1,'2016-11-09',1),(113,'','Buku folio 300 lbr ',7,40,32000,0.00,0.00,32000,39000,0,0,1,'','','2016-04-06',1,'2016-04-06',1),(114,'','Buku folio 100 lbr ',7,40,10500,0.00,0.00,10500,13000,0,0,1,'','','2016-04-06',1,'2016-04-06',1),(115,'','Label No.129',6,41,3400,0.00,0.00,3400,5000,1000,0,5,'','Harga sebox 85.000','2016-04-06',1,'2016-11-07',9),(116,'','Lakban kain merah 2\" ',12,6,13000,0.00,0.00,13000,20000,0,0,7,'','','2016-04-06',1,'2016-04-06',1),(117,'','Lakban kain orange 2\" ',12,6,13000,0.00,0.00,13000,20000,0,0,7,'','','2016-04-06',1,'2016-04-06',1),(118,'','Kertas CF 9 1/2 x 11\" 2 ply PRS ',6,38,209000,0.00,0.00,209000,224000,-3,0,3,'','','2016-04-07',1,'2016-11-07',9),(119,'','Kertas CF 14 7/8 x 11\" 3 ply ',6,38,506500,2.00,0.00,496370,530000,0,0,3,'','','2016-04-07',1,'2016-04-29',7),(120,'','Kertas CF 9 1/2 x 11\" 3 ply PRS ',6,38,332000,1.00,0.00,328680,340000,-22,0,3,'','','2016-04-07',1,'2016-11-09',9),(121,'','Kertas F4 @70gsm ',6,37,32518,0.00,0.00,32518,33000,-20,0,2,'','11 dus bonus 1 dus ','2016-04-07',1,'2016-11-08',8),(122,'','Kertas A3 @70gsm ',6,7,53060,0.00,0.00,53060,60000,0,0,2,'','','2016-04-07',1,'2016-11-08',8),(123,'','Pena Pilot BPT-P Hitam (K)',16,42,14833,0.00,0.00,14833,18000,0,0,4,'','','2016-04-07',1,'2016-04-22',7),(124,'','Pena Frixion FR5 (Erasable) ',16,42,195000,0.00,0.00,195000,210000,0,0,4,'','','2016-04-07',1,NULL,NULL),(125,'','Pensil 2b (B)',17,35,32083,0.00,0.00,32083,34000,-1,0,4,'','','2016-04-07',1,'2016-11-08',1),(126,'','Clipboard Doff',10,6,9000,20.00,0.00,7200,9000,0,0,1,'','','2016-04-07',1,NULL,NULL),(127,'','Stopmap Batik ',10,6,32000,0.00,0.00,32000,45000,-1,0,5,'','','2016-04-07',1,'2016-11-04',1),(128,'','Kertas Metalik ',6,6,73200,0.00,0.00,73200,100000,0,0,5,'','1 pak = 100 lembar ','2016-04-08',1,NULL,NULL),(129,'','Stapler Jilid 13mm',17,43,84000,20.00,0.00,67200,100000,0,0,1,'','','2016-04-08',1,NULL,NULL),(130,'','Buku Binder A5 ',7,43,11250,20.00,0.00,9000,11000,0,0,6,'','','2016-04-08',1,NULL,NULL),(131,'','Document Keeper A4 isi 20 ',10,43,9167,20.00,0.00,7334,12500,0,0,1,'','','2016-04-08',1,'2016-04-07',1),(132,'','Stapler HS-45 (K)',17,44,23000,5.00,5.00,20757,25000,838,0,1,'','','2016-04-08',1,'2016-11-09',9),(133,'','Isi Staples 1206',17,44,8000,5.00,0.00,7600,10000,0,0,10,'','','2016-04-08',1,'2016-04-08',1),(134,'','Isi Staples 1210',17,44,10500,5.00,0.00,9975,12000,0,0,10,'','','2016-04-08',1,'2016-04-08',1),(135,'','Isi Staples 1213',17,44,11500,5.00,0.00,10925,14000,0,0,10,'','','2016-04-08',1,'2016-04-08',1),(136,'','Tinta Blueprint 100ml',11,6,30000,0.00,0.00,30000,35000,-15,0,12,'','','2016-04-07',1,'2016-11-09',9),(137,'','Pena Balliner Hitam (K)',16,42,10000,0.00,0.00,10000,15000,-3,0,1,'','','2016-04-07',1,'2016-11-08',9),(138,'','Pena Balliner Biru (K)',16,42,10000,0.00,0.00,10000,15000,0,0,1,'','','2016-04-07',1,'2016-04-22',7),(139,'','Pena Balliner Hijau (K)',16,42,10000,0.00,0.00,10000,15000,-5,0,1,'','','2016-04-07',1,'2016-11-07',9),(140,'','Pena PILOT Hi-Tec 0.3 Hitam (K)',16,42,14500,0.00,0.00,14500,18000,0,0,1,'','','2016-04-07',1,'2016-04-22',7),(141,'','Pena PILOT Hi-Tec 0.3 Biru (K)',16,42,14500,0.00,0.00,14500,18000,0,0,1,'','','2016-04-07',1,'2016-06-20',7),(142,'','Pena PILOT Hi-Tec 0.4 Biru (K)',16,42,14500,0.00,0.00,14500,18000,0,0,1,'','','2016-04-07',1,'2016-04-22',7),(143,'','Pena PILOT Hi-Tec 0.4 Hitam (K)',16,42,14500,0.00,0.00,14500,18000,0,0,1,'','','2016-04-07',1,'2016-06-20',7),(144,'','Refill Pena G-1 0.7 Hitam',16,42,5917,0.00,0.00,5917,7917,0,0,1,'','','2016-04-07',1,'2016-04-07',1),(145,'','Refill Pena G-1 0.7 Biru',16,42,5917,0.00,0.00,5917,7917,0,0,1,'','','2016-04-07',1,'2016-04-07',1),(146,'','Pelobang kertas No.85',17,43,37000,20.00,0.00,29600,38000,-3,0,1,'','','2016-04-07',1,'2016-11-10',1),(147,'','Cat air (LSN)',15,43,57996,0.00,0.00,57996,75000,0,0,4,'','','2016-04-07',1,'2016-04-22',7),(148,'','Document Keeper F4 isi 60',10,6,16500,0.00,0.00,16500,25000,-1,0,1,'','','2016-04-08',1,'2016-11-08',8),(149,'','Document Keeper F4 isi 100',10,6,25000,0.00,0.00,25000,45000,0,0,1,'','','2016-04-08',1,'2016-04-26',7),(150,'','Yoyo ID Card ',17,6,1175,0.00,0.00,1175,1500,-100,0,1,'','','2016-04-08',1,'2016-11-09',9),(151,'','CD-R (K)',11,6,1300,0.00,0.00,1300,1500,0,0,1,'','1 tbg isi 50 pcs ','2016-04-08',1,'2016-04-22',7),(152,'','Double Tape 1\" (K)',12,39,4246,0.00,0.00,4246,6000,0,0,1,'','','2016-04-08',1,'2016-04-22',7),(153,'','Plastik Laminating A3 ',9,51,155000,0.00,0.00,155000,180000,0,0,5,'','','2016-04-08',1,'2016-04-08',1),(154,'','Plastik CD Kerang ',9,6,850,0.00,0.00,850,1000,0,0,1,'','1 pak isi 50 ','2016-04-08',1,NULL,NULL),(155,'','Box File Biru ',10,46,13650,0.00,0.00,13650,25000,0,0,6,'','','2016-04-08',1,NULL,NULL),(158,'','Clip File Merah (LSN)',10,6,42172,0.00,0.00,42172,48000,-2,0,4,'','','2016-04-08',1,'2016-11-05',1),(159,'','Clip File Biru (LSN)',10,6,42172,0.00,0.00,42172,48000,-2,0,4,'','','2016-04-08',1,'2016-11-05',1),(160,'','Clip File Kuning (LSN)',10,6,42172,0.00,0.00,42172,48000,-2,0,4,'','','2016-04-08',1,'2016-11-05',1),(161,'','Clip file Hijau (LSN)',10,6,42172,0.00,0.00,42172,48000,-2,0,4,'','','2016-04-08',1,'2016-11-05',1),(162,'','Pita Printer LX 300/310',11,25,11000,0.00,0.00,11000,15000,0,0,1,'','1 box = 30 pcs ','2016-04-08',1,'2016-06-20',7),(163,'','Pita LQ 680',11,25,26000,0.00,0.00,26000,35000,0,0,1,'','','2016-04-08',1,'2016-04-08',1),(164,'','Clipboard with Cover ',10,47,19800,0.00,0.00,19800,25000,0,0,1,'','','2016-04-08',1,'2016-04-25',7),(165,'','Pembolong 3 Lobang ',17,47,85388,0.00,0.00,85388,85388,0,0,1,'','','2016-04-08',1,NULL,NULL),(166,'','Stapler remover / Pencabut staples ',17,47,6270,0.00,0.00,6270,10000,-8,0,1,'','','2016-04-08',1,'2016-11-09',9),(167,'','Paket ujian BANTEX',17,6,18398,0.00,0.00,18398,25000,0,0,13,'','','2016-04-08',1,NULL,NULL),(168,'','Refill/Isi Tembakan Baju',17,6,19500,20.00,0.00,15600,25000,0,0,9,'','','2016-04-08',1,'2016-04-08',1),(169,'','Standbook/ Pembatas Buku',17,6,13000,20.00,0.00,10400,15000,-5,0,13,'','','2016-04-08',1,'2016-11-07',9),(170,'','Stapler HS-45 ',17,48,18500,20.00,0.00,14800,25000,-11,0,1,'','','2016-04-08',1,'2016-11-06',8),(171,'','Mesin Laminating ',13,48,480000,0.00,0.00,480000,650000,0,0,1,'','','2016-04-08',1,'2016-04-08',1),(172,'','Divider / Pembatas ',10,48,11000,20.00,0.00,8800,12000,0,0,13,'','','2016-04-08',1,'2016-04-28',7),(173,'','Spidol whiteboard hitam(K) ',15,49,4840,0.00,0.00,4840,6000,-24,0,1,'','','2016-04-08',1,'2016-11-06',8),(174,'','Spidol whiteboard biru(K)',15,49,4840,0.00,0.00,4840,6000,-2,0,1,'','','2016-04-08',1,'2016-11-01',1),(176,'','Spidol whiteboard merah(K)',15,49,4840,0.00,0.00,4840,6000,0,0,1,'','','2016-04-08',1,'2016-04-22',7),(177,'','Spidol whiteboard hijau(K)',15,49,4840,0.00,0.00,4840,6000,0,0,1,'','','2016-04-08',1,'2016-04-22',7),(178,'','Isi/Refill Spidol Whiteboard hitam(K)',17,49,10200,0.00,0.00,10200,12000,0,0,12,'','','2016-04-08',1,'2016-04-22',7),(179,'','Isi/Refill Spidol Whiteboard biru (K)',17,49,10200,0.00,0.00,10200,12000,0,0,12,'','','2016-04-08',1,'2016-04-22',7),(180,'','Isi/Refill Spidol Whiteboard merah (K)',17,49,10200,0.00,0.00,10200,12000,-5,0,12,'','','2016-04-08',1,'2016-11-07',9),(181,'','Isi/Refill Spidol Whiteboard hijau (K)',17,49,10200,0.00,0.00,10200,15000,0,0,12,'','','2016-04-08',1,'2016-04-22',7),(182,'','Pena Snowman V-5 hitam (K)',16,49,20160,0.00,0.00,20160,24000,-15,0,4,'','','2016-04-08',1,'2016-11-10',1),(183,'','Pena Snowman V-5 biru (K)',16,49,20160,0.00,0.00,20160,24000,-6,0,4,'','','2016-04-08',1,'2016-11-10',1),(184,'','Spidol permanent hitam (K)',15,49,4120,0.00,0.00,4120,5000,-23,0,1,'','','2016-04-08',1,'2016-11-09',9),(185,'','Spidol permanent biru (K)',15,49,4120,0.00,0.00,4120,5000,0,0,1,'','','2016-04-08',1,'2016-04-22',7),(186,'','Spidol permanent merah (K)',15,49,4120,0.00,0.00,4120,5000,0,0,1,'','','2016-04-08',1,'2016-04-22',7),(187,'','Spidol permanent hijau (K)',15,49,4120,0.00,0.00,4120,5000,0,0,1,'','','2016-04-08',1,'2016-04-22',7),(188,'','Pena Twinpen Hitam & Merah',16,49,12745,0.00,0.00,12745,18000,0,0,4,'','','2016-04-08',1,NULL,NULL),(189,'','Spidol Paint Marker Putih/Warna (K)',15,49,9216,0.00,0.00,9216,15000,0,0,1,'','','2016-04-08',1,'2016-04-22',7),(190,'','Isolasi/Masking Tape 1\" Kertas (K)',12,50,2250,0.00,0.00,2250,3000,0,0,7,'','1 dus merk SKS isi 144 roll','2016-04-08',1,'2016-04-26',7),(191,'','Crayon 12 warna (K)',15,6,5950,20.00,0.00,4760,6500,0,0,13,'','','2016-04-08',1,'2016-04-22',7),(192,'','Tinta Eprint 200 ml hitam ',11,6,38000,0.00,0.00,38000,45000,-4,0,12,'','','2016-04-08',1,'2016-11-04',1),(193,'','Tinta Eprint 200 ml merah',11,6,38000,0.00,0.00,38000,45000,0,0,12,'','','2016-04-08',1,'2016-05-24',7),(194,'','Tinta Eprint 200 ml biru',11,6,38000,0.00,0.00,38000,45000,0,0,12,'','','2016-04-08',1,'2016-05-24',7),(195,'','Tinta Eprint 200 ml kuning ',11,6,38000,0.00,0.00,38000,45000,0,0,12,'','','2016-04-08',1,'2016-05-24',7),(196,'','Stapler Jilid 24mm DELI',17,6,479500,30.00,0.00,335650,450000,0,0,1,'','','2016-04-08',1,'2016-05-24',7),(197,'','Paket ujian Standard Faber Castell',17,35,15153,0.00,0.00,15153,17000,0,0,13,'','','2016-04-08',1,'2016-04-08',1),(198,'','Penghapus/Eraser Faber Castell Hitam',17,35,73500,0.00,0.00,73500,77000,-3,0,9,'','','2016-04-08',1,'2016-11-09',1),(199,'','Plastik Laminating A3 ',9,12,110000,0.00,0.00,110000,150000,0,0,5,'','','2016-04-08',1,NULL,NULL),(200,'','Binder clip 105 (K)',17,6,1801,0.00,0.00,1801,3000,-6,0,10,'','','2016-04-08',1,'2016-11-09',9),(201,'','Binder clip 260',17,6,12119,0.00,0.00,12119,15000,-16,0,10,'','','2016-04-08',1,'2016-11-09',9),(202,'','Double Tape 1\" (K)',12,22,3890,0.00,0.00,3890,6000,-25,0,7,'','','2016-04-08',1,'2016-11-10',1),(203,'','Map Gantung / Hanging Map ',10,52,113000,0.00,0.00,113000,150000,-1,0,10,'','','2016-04-08',1,'2016-11-04',1),(204,'','Map plastik tulang/ Spring File Hijau',10,53,3300,0.00,0.00,3300,5000,0,0,1,'','','2016-04-08',1,'2016-10-31',1),(205,'','Map Plastik Tulang/ Spring File Biru',10,53,3300,0.00,0.00,3300,5000,-25,0,1,'','','2016-04-08',1,'2016-11-09',1),(206,'','Map plastik tulang / Spring File Kuning',10,53,3300,0.00,0.00,3300,5000,0,0,1,'','','2016-04-08',1,'2016-10-31',1),(207,'','Map plastik tulang / Spring file Merah',10,54,3445,0.00,0.00,3445,5000,0,0,1,'','','2016-04-08',1,NULL,NULL),(208,'','Map Plastik Tulang/ Spring File Biru',10,54,3445,0.00,0.00,3445,5000,0,0,1,'','','2016-04-08',1,'2016-05-24',7),(209,'','Map plastik tulang / Spring File Kuning',10,54,3445,0.00,0.00,3445,5000,-5,0,1,'','','2016-04-08',1,'2016-11-04',1),(210,'','Map plastik tulang/ Spring File Hijau',10,54,3445,0.00,0.00,3445,5000,0,0,1,'','','2016-04-08',1,'2016-05-24',7),(211,'','Buku Absen Siswa',7,6,100000,0.00,0.00,100000,120000,0,0,5,'','1 pak = 50 pcs ','2016-04-08',1,'2016-04-08',1),(212,'','Cartridge ERC-05',11,25,21000,0.00,0.00,21000,35000,0,0,1,'','','2016-04-08',1,'2016-06-20',7),(213,'','Pita LQ 2090',11,26,50000,0.00,0.00,50000,60000,0,0,10,'','','2016-04-08',1,'2016-06-20',7),(214,'','Pita Printer 2180',11,25,29000,0.00,0.00,29000,35000,0,0,1,'','','2016-04-08',1,'2016-06-20',7),(215,'','Cartridge Compuprint SP-40 New',11,6,180000,0.00,0.00,180000,350000,0,0,10,'','','2016-04-08',1,'2016-05-24',7),(216,'','Buku Quarto 200',7,40,10500,0.00,0.00,10500,14000,-6,0,1,'','','2016-04-08',1,'2016-11-01',1),(217,'','Kertas concorde ',6,6,7000,0.00,0.00,7000,12000,0,0,5,'','','2016-04-08',1,'2016-04-08',1),(219,'','Kalkulator DH-12 ',13,19,151000,40.00,8.00,83352,100000,0,0,1,'','','2016-04-08',1,NULL,NULL),(220,'','Kalkulator DH-14',13,19,184000,40.00,8.00,101568,120000,0,0,6,'','','2016-04-08',1,NULL,NULL),(221,'','Kalkulator DJ-120 D',13,19,184000,40.00,8.00,101568,120000,0,0,1,'','','2016-04-08',1,NULL,NULL),(222,'','Kalkulator DM-1200',7,6,254000,40.00,8.00,140208,175000,0,0,1,'','','2016-04-08',1,NULL,NULL),(223,'','Kalkulator DM-1400',13,19,284000,40.00,8.00,156768,185000,0,0,1,'','','2016-04-08',1,NULL,NULL),(224,'','Buku folio 100 lbr (K)',7,55,8085,0.00,0.00,8085,11000,0,0,1,'','1 dus isi 40 pcs','2016-04-08',1,'2016-04-22',7),(225,'','Buku Quarto 100 (K)',7,55,4125,0.00,0.00,4125,6000,780,0,1,'','','2016-04-08',1,'2016-11-08',8),(226,'','Buku Ekspedisi 100 (K)',7,55,4125,0.00,0.00,4125,6000,0,0,1,'','1 dus isi 80 pcs','2016-04-08',1,'2016-04-22',7),(227,'','Buku folio 200 lbr ',7,55,14575,0.00,0.00,14575,20000,106,0,1,'','1 dus isi 48 pcs','2016-04-08',1,'2016-11-09',1),(228,'','Buku Quarto 200',7,55,7425,0.00,0.00,7425,12000,0,0,1,'','','2016-04-08',1,'2016-04-15',1),(229,' ','Buku folio 100 lbr (K)',7,56,6710,0.00,0.00,6710,10000,-57,0,1,'','1 dus isi 50 pcs','2016-04-08',1,'2016-11-09',9),(230,'','Buku Quarto 100 (K)',7,56,3630,0.00,0.00,3630,5000,-34,0,1,'','1 dus isi 100 pcs','2016-04-08',1,'2016-11-08',9),(231,'','Buku Ekspedisi 100 (K)',7,56,3630,0.00,0.00,3630,5000,-15,0,1,'','1 dus isi 100 pcs','2016-04-08',1,'2016-11-06',8),(232,'','Buku Oktavo 100 lbr (K)',7,56,2200,0.00,0.00,2200,3500,-68,0,1,'','1 dus isi 200 pcs ','2016-04-08',1,'2016-11-09',9),(233,'','Kertas Quarto @70gsm',6,7,27695,0.00,0.00,27695,29000,0,0,2,'','11 dus bonus 1 dus ','2016-04-08',1,NULL,NULL),(234,'','Kertas F4 @80gsm',6,37,37197,0.00,0.00,37197,37000,-5,0,6,'','11 dus bonus 1 dus ','2016-04-08',1,'2016-11-06',8),(235,'','Kertas A4 @80gsm ',6,37,32709,0.00,0.00,32709,33000,-5,0,2,'','11 dus bonus 1 dus ','2016-04-08',1,'2016-11-06',8),(236,'','Kertas A3@80gsm ',6,37,60275,0.00,0.00,60275,68000,0,0,2,'','11 dus bonus 1 dus ','2016-04-08',1,'2016-11-08',8),(237,'','Kertas Tellstruk 44 x 65 ',6,8,21408,0.00,0.00,21408,25000,0,0,5,'','','2016-04-08',1,NULL,NULL),(238,'','Kertas Tellstruk 68 x 48 ',6,8,18586,0.00,0.00,18586,25000,0,0,5,'','','2016-04-08',1,'2016-04-26',7),(239,'','Buku Kwitansi Kecil (K)',7,37,1168,0.00,0.00,1168,1500,-15,0,1,'','','2016-04-08',1,'2016-11-05',1),(240,'','Buku Kwitansi Tanggung (K)',7,37,2199,0.00,0.00,2199,2750,0,0,1,'','','2016-04-08',1,'2016-04-22',7),(241,'','Buku Kwitansi Besar (K)',7,37,2807,0.00,0.00,2807,3500,-17,0,1,'','','2016-04-08',1,'2016-11-01',1),(242,'','Buku Nota Kontan k1 (K)',7,32,1255,0.00,0.00,1255,1500,-16,0,1,'','','2016-04-08',1,'2016-11-06',8),(243,'','Buku Nota Kontan k2 (K)',7,32,1736,0.00,0.00,1736,2000,0,0,1,'','','2016-04-08',1,'2016-04-26',7),(245,'','Buku Nota Kontan k3 (K)',7,32,2543,0.00,0.00,2543,3000,0,0,1,'','','2016-04-08',1,'2016-04-26',7),(246,'','Buku Nota Kontan b2 (K)',7,32,3520,0.00,0.00,3520,4000,0,0,1,'','','2016-04-08',1,'2016-04-26',7),(247,'','Buku Nota Kontan b3 (K)',7,32,5167,0.00,0.00,5167,6000,0,0,1,'','','2016-04-08',1,'2016-04-26',7),(248,'','Buku Nota Kontan b1 (K)',7,32,2670,0.00,0.00,2670,3000,0,0,1,'','','2016-04-08',1,'2016-04-26',7),(249,'','Buku Surat Jalan 3ply (K)',7,32,5497,0.00,0.00,5497,7000,0,0,1,'','','2016-04-08',1,'2016-04-22',7),(250,'','Amplop super mini ',6,7,2880,0.00,0.00,2880,4000,0,0,10,'','','2016-04-08',1,NULL,NULL),(251,'','Amplop 90s(K)',6,32,13462,0.00,0.00,13462,17500,-5,0,10,'','','2016-04-08',1,'2016-11-02',1),(252,'','Amplop 90s(K)',6,37,13071,0.00,0.00,13071,17500,-8,0,10,'','','2016-04-08',1,'2016-11-08',9),(253,'','Amplop 110 (K)',6,32,11725,0.00,0.00,11725,15000,0,0,10,'','','2016-04-08',1,'2016-04-22',7),(254,'','Amplop 110 (K)',6,37,11030,0.00,0.00,11030,15000,-20,0,10,'','','2016-04-08',1,'2016-11-05',1),(255,'','Amplop 104 (K)',6,32,9640,0.00,0.00,9640,12500,0,0,10,'','','2016-04-08',1,'2016-04-22',7),(256,'','Amplop 104 (K)',6,37,9223,0.00,0.00,9223,12500,-3,0,10,'','','2016-04-08',1,'2016-11-09',9),(257,'','Amplop 90s AIRMAIL(K)',6,32,13592,0.00,0.00,13592,20000,0,0,10,'','','2016-04-08',1,'2016-04-22',7),(258,'','Amplop 90s AIRMAIL(K)',6,37,13158,0.00,0.00,13158,20000,0,0,10,'','','2016-04-08',1,'2016-04-22',7),(259,'','Amplop 104 AIRMAIL(K)',6,32,9988,0.00,0.00,9988,15000,0,0,10,'','','2016-04-08',1,'2016-04-22',7),(260,'','Amplop 104 AIRMAIL (K)',6,37,9553,0.00,0.00,9553,15000,0,0,10,'','','2016-04-08',1,'2016-04-22',7),(261,'','Amplop 110 AIRMAIL (K)',6,32,11768,0.00,0.00,11768,17500,0,0,10,'','','2016-04-08',1,'2016-04-22',7),(262,'','Amplop 110 AIRMAIL (K)',6,37,11073,0.00,0.00,11073,17500,0,0,10,'','','2016-04-08',1,'2016-04-22',7),(264,'','Stabillo/Highlighter Merah(K)',15,57,0,0.00,0.00,0,7500,-4,0,1,'','','2016-04-14',1,'2016-11-05',1),(265,'','Stabillo/Highlighter Biru (K)',15,57,0,0.00,0.00,0,7500,0,0,1,'','','2016-04-14',1,'2016-04-22',7),(266,'','Stabillo/Highlighter Kuning (K)',15,6,0,0.00,0.00,0,7500,0,0,1,'','','2016-04-14',1,'2016-04-22',7),(267,'','Stabillo/Highlighter Hijau (K)',15,57,0,0.00,0.00,0,7500,0,0,1,'','','2016-04-14',1,'2016-04-22',7),(268,'','Stabillo/Highlighter Ungu(K)',15,57,0,0.00,0.00,0,7500,0,0,1,'','','2016-04-14',1,'2016-04-22',7),(269,'','Stabillo/Highlighter Pink(K)',15,57,0,0.00,0.00,0,7500,0,0,1,'','','2016-04-14',1,'2016-04-22',7),(270,'','Amplop coklat uk Kabinet',6,6,10800,0.00,0.00,10800,15000,-3,0,5,'','','2016-04-14',1,'2016-11-09',9),(271,'','Gunting Besar',17,6,4868,0.00,0.00,4868,10000,-1,0,1,'','','2016-04-14',1,'2016-11-04',1),(272,'','Gunting Sedang ',17,6,2850,0.00,0.00,2850,6000,-26,0,1,'','','2016-04-14',1,'2016-11-10',1),(273,'','Pena 4 warna BIC',16,6,0,0.00,0.00,0,18000,0,0,1,'','','2016-04-14',1,NULL,NULL),(274,'','Penghapus Pensil Fancy',17,6,12000,0.00,0.00,12000,18000,-6,0,9,'','','2016-04-14',1,'2016-11-07',9),(275,'','Isi Pensil Mekanik (K)',17,42,0,0.00,0.00,0,4000,-2,0,13,'','','2016-04-14',1,'2016-11-09',8),(276,'','Isolasi 1/2\" bening core biru (K)',12,31,687,0.00,0.00,687,1500,-19,0,1,'','','2016-04-14',1,'2016-11-09',9),(277,'','Binder clip 107 (K)',17,6,0,0.00,0.00,0,3000,-29,0,10,'','','2016-04-14',1,'2016-11-09',9),(278,'','Map L (LSN)',10,6,0,0.00,0.00,0,15000,-8,0,5,'','','2016-04-15',1,'2016-11-09',9),(279,'','Pena Batik Cetek ',16,22,0,0.00,0.00,0,25000,0,0,4,'','','2016-04-15',1,'2016-04-15',1),(280,'','Magnet Papan Tulis Whiteboard',17,6,0,0.00,0.00,0,6000,-22,0,13,'','','2016-04-15',1,'2016-11-08',1),(281,'','Isi staples no. 10 (K)',17,44,0,0.00,0.00,0,1500,-12,0,10,'','','2016-04-15',1,'2016-10-31',1),(282,'','Isi staples no. 3 (K)',17,44,0,0.00,0.00,0,3000,0,0,10,'','','2016-04-15',1,'2016-04-26',7),(283,'','Kertas CF 9 1/2 x 13\" 3 ply ',6,6,275000,0.00,0.00,275000,380000,-3,0,3,'','','2016-04-15',1,'2016-11-10',1),(284,'','Amplop Coklat uk A4',6,6,0,0.00,0.00,0,30000,0,0,5,'','','2016-04-15',1,'2016-04-15',1),(285,'','Binder clip 111 (K)',17,6,3253,0.00,0.00,3253,5000,-12,0,10,'','','2016-04-15',1,'2016-11-09',9),(286,'','Binder clip 200',17,6,7671,0.00,0.00,7671,10000,-8,0,10,'','','2016-04-15',1,'2016-11-09',9),(288,'','Binder clip 155 (K)',17,6,4732,0.00,0.00,4732,6000,-27,0,10,'','','2016-04-15',1,'2016-11-09',9),(289,'','Post it 654 warna',17,6,26500,0.00,0.00,26500,45000,0,0,5,'','','2016-04-15',1,'2016-05-14',7),(290,'','Lem Glue stick 8gr (K)',12,6,0,0.00,0.00,0,3000,0,0,1,'','','2016-04-15',1,'2016-05-14',7),(291,'','Paper fastener/Acco',17,6,5600,0.00,0.00,5600,7500,-19,0,10,'','','2016-04-15',1,'2016-11-09',9),(292,'','Stempel Tanggal',17,6,0,0.00,0.00,0,10000,0,0,1,'','','2016-04-15',1,'2016-04-15',1),(293,'','Isolasi 1\" bening core biru (K)',12,31,0,0.00,0.00,0,2500,-39,0,7,'','','2016-04-15',1,'2016-11-10',1),(294,'','Stella Semprot 400 gr',17,6,0,0.00,0.00,0,18000,0,0,12,'','','2016-04-15',1,'2016-04-15',1),(295,'','CF 9 1/2 x 11\" 5 ply PRS ',6,37,295158,0.00,0.00,295158,350000,0,0,3,'','','2016-04-15',1,'2016-04-20',1),(296,'','Pena Lilin',16,22,0,0.00,0.00,0,10000,0,0,4,'','','2016-04-15',1,'2016-04-29',7),(297,'','Cartridge EPSON LQ-2180 Ori',11,61,112000,0.00,0.00,112000,150000,-4,0,1,'','','2016-04-15',1,'2016-11-08',1),(298,'','Isi/Refill Spidol permanent htm (K)',17,49,0,0.00,0.00,0,8000,-10,0,12,'','','2016-04-15',1,'2016-11-07',9),(299,'','Pena Meja/ Nasabah',16,22,4488,0.00,0.00,4488,6000,-127,0,1,'','','2016-04-15',1,'2016-11-09',9),(300,'','Kertas F4 @70gsm ',6,58,30000,0.00,0.00,30000,33000,-16,0,2,'','','2016-04-15',1,'2016-11-09',8),(301,'','Business File (K)',10,6,0,0.00,0.00,0,2500,0,0,1,'','','2016-04-15',1,'2016-04-22',7),(302,'','Label No. 121',17,41,0,0.00,0.00,0,5000,-2,0,5,'','','2016-04-15',1,'2016-11-08',8),(303,'','Kertas A4 @70gsm ',6,58,26500,0.00,0.00,26500,30000,-1,0,2,'','','2016-04-16',1,'2016-11-09',8),(304,'','Kertas CF 9 1/2 x 11\" 2 ply mix colour',6,38,202232,0.00,0.00,202232,219000,0,0,3,'','harga 208.487 disc 3%','2016-04-16',1,NULL,NULL),(305,'','Kertas CF 9 1/2 x 11\" 3 ply mix colour',6,38,312165,0.00,0.00,312165,330000,-3,0,6,'','Harga 321.820 disc 3%','2016-04-16',1,'2016-11-09',9),(306,'','Kertas CF 9 1/2 x 11\" 4 ply mix colour',6,38,226251,1.00,0.00,223988,237000,-2,0,3,'','','2016-04-16',1,'2016-11-08',8),(307,'','Map plastik kancing merah',10,6,20000,0.00,0.00,20000,30000,0,0,4,'','','2016-04-16',1,'2016-04-20',1),(308,'','Map plastik tali merah',10,6,0,0.00,0.00,0,30000,0,0,4,'','','2016-04-16',1,'2016-04-16',1),(309,'','Penggaris 30 cm plastik',17,6,0,0.00,0.00,0,1500,-2,0,1,'','','2016-04-16',1,'2016-10-31',1),(310,'','Amplop Coklat Tali 311',6,6,0,0.00,0.00,0,45000,0,0,5,'','','2016-04-16',1,'2016-04-16',1),(311,'','Map Tas Jaring Merah',10,6,0,0.00,0.00,0,10000,0,0,1,'','','2016-04-16',1,NULL,NULL),(312,'','Map Tas Jaring Biru',10,6,0,0.00,0.00,0,10000,0,0,1,'','','2016-04-16',1,NULL,NULL),(313,'','Map Tas Jaring Kuning',10,6,0,0.00,0.00,0,10000,-12,0,1,'','','2016-04-16',1,'2016-10-31',1),(314,'','Map Tas Jaring Hijau',10,6,0,0.00,0.00,0,10000,0,0,1,'','','2016-04-16',1,NULL,NULL),(315,'','Map Kertas Tulang / Snelhecter biru',10,6,18700,0.00,0.00,18700,25000,0,0,5,'','','2016-04-16',1,'2016-04-16',1),(316,'','Map Kertas Tulang / Snelhecter Kuning',10,6,18700,0.00,0.00,18700,25000,0,0,5,'','','2016-04-16',1,NULL,NULL),(317,'','Map Kertas Tulang / Snelhecter Hijau',10,6,18700,0.00,0.00,18700,25000,0,0,5,'','','2016-04-16',1,NULL,NULL),(318,'','Map Biola 5002 biru',10,6,44000,0.00,0.00,44000,53500,-7,0,5,'','','2016-04-16',1,'2016-11-08',8),(319,'','Map Biola 5002 kuning',10,6,44000,0.00,0.00,44000,53500,-1,0,10,'','','2016-04-16',1,'2016-11-08',9),(320,'','Map Biola 5002 hijau',10,6,44000,0.00,0.00,44000,53500,-1,0,5,'','','2016-04-16',1,'2016-11-09',9),(321,'','Map Biola 5002 biru benhur',10,6,44000,0.00,0.00,44000,53500,0,0,5,'','','2016-04-16',1,NULL,NULL),(322,'','Map Biola 5002 coklat',10,6,44000,0.00,0.00,44000,53500,0,0,5,'','','2016-04-16',1,NULL,NULL),(323,'','Map biola 5002 orange',10,6,44000,0.00,0.00,44000,53500,0,0,5,'','','2016-04-16',1,'2016-06-20',7),(324,'','Map biola 5002 biru muda',10,6,44000,0.00,0.00,44000,53500,0,0,5,'','','2016-04-16',1,NULL,NULL),(325,'','Map Biola 5001 merah',10,6,52000,0.00,0.00,52000,59500,0,0,5,'','','2016-04-16',1,'2016-05-14',7),(326,'','Map Biola 5001 biru',10,6,52000,0.00,0.00,52000,59500,0,0,5,'','','2016-04-16',1,'2016-05-14',7),(327,'','Map Biola 5001 biru benhur',10,6,51250,0.00,0.00,51250,59500,0,0,5,'','','2016-04-16',1,'2016-04-22',7),(328,'','Map biola 5001 kuning ',10,6,52000,0.00,0.00,52000,59500,-2,0,5,'','','2016-04-16',1,'2016-11-08',9),(329,'','Map Biola 5001 hijau',10,6,52000,0.00,0.00,52000,59500,-7,0,5,'','','2016-04-16',1,'2016-11-10',1),(330,'','Map biola 5001 coklat',10,6,51250,0.00,0.00,51250,59500,0,0,5,'','','2016-04-16',1,'2016-04-22',7),(331,'','Map Biola 5001 orange',10,6,51250,0.00,0.00,51250,59500,0,0,5,'','','2016-04-16',1,'2016-04-20',1),(332,'','Map plastik kancing biru',10,6,20000,0.00,0.00,20000,30000,0,0,4,'','','2016-04-16',1,'2016-04-20',1),(333,'','Map plastik kancing kuning',10,6,20000,0.00,0.00,20000,30000,0,0,4,'','','2016-04-16',1,'2016-04-20',1),(334,'','Map plastik kancing hijau',10,6,20000,0.00,0.00,20000,30000,0,0,4,'','','2016-04-16',1,'2016-04-20',1),(335,'','Map plastik tali biru',10,6,0,0.00,0.00,0,30000,-1,0,4,'','','2016-04-16',1,'2016-11-08',1),(336,'','Map plastik tali kuning',10,6,0,0.00,0.00,0,30000,-1,0,4,'','','2016-04-16',1,'2016-11-01',1),(338,'','Map plastik tali hijau',10,6,0,0.00,0.00,0,30000,0,0,4,'','','2016-04-16',1,NULL,NULL),(339,'','Map plastik tali bening',10,6,0,0.00,0.00,0,30000,-1,0,4,'','','2016-04-16',1,'2016-11-04',1),(340,'','Map plastik kancing bening',10,6,20000,0.00,0.00,20000,30000,0,0,4,'','','2016-04-16',1,'2016-04-20',1),(342,'','Map plastik tali',10,6,19875,0.00,0.00,19875,30000,-1,0,4,'','','2016-04-16',1,'2016-11-04',1),(343,'','Kertas HVS warna merah',6,37,46320,4.50,0.00,44235,50000,25,0,2,'','','2016-04-16',1,'2016-11-03',1),(344,'','Kertas HVS warna biru',6,37,44250,0.00,0.00,44250,50000,0,0,2,'','','2016-04-16',1,'2016-11-02',1),(345,'','Kertas HVS warna kuning',6,37,44250,0.00,0.00,44250,50000,-3,0,2,'','','2016-04-16',1,'2016-11-10',1),(346,'','Kertas HVS warna hijau',6,37,44250,0.00,0.00,44250,50000,0,0,2,'','','2016-04-16',1,'2016-11-02',1),(347,'','Buku Kas folio ',7,59,0,0.00,0.00,0,12000,0,0,1,'','','2016-04-16',1,'2016-04-16',1),(348,'','Buku Kas folio ',7,40,0,0.00,0.00,0,15000,0,0,1,'','','2016-04-16',1,NULL,NULL),(349,'','Ordner 401 ',10,60,0,0.00,0.00,0,25000,-36,0,1,'','','2016-04-16',1,'2016-11-04',1),(350,'','Ordner 402 ',10,60,0,0.00,0.00,0,25000,0,0,1,'','','2016-04-16',1,NULL,NULL),(351,'','Buku Bigboss 42 Hippo',7,6,17100,10.00,0.00,15390,18000,0,0,5,'','1 pak = 6 buku ','2016-04-20',1,'2016-04-23',7),(352,'','Pena Pilot G-2 0,7 Hitam (B)',16,42,125000,0.00,0.00,125000,135000,0,0,4,'','','2016-04-20',1,'2016-06-20',7),(353,'','Isi/Refill Pena Pilot Biasa',16,42,16000,0.00,0.00,16000,20000,-2,0,4,'','','2016-04-20',1,'2016-11-10',1),(354,'','Push-pin',17,6,2375,20.00,0.00,1900,0,-13,0,1,'','','2016-04-20',1,'2016-11-09',1),(355,'','Lakban bening 2\" core biru (TBG)',12,31,26400,0.00,0.00,26400,36000,0,0,8,'','','2016-04-20',1,'2016-04-22',7),(356,'','Isi staples T310MB Max ',17,6,9000,0.00,0.00,9000,11000,0,0,10,'','','2016-04-20',1,'2016-04-20',1),(357,'','Lem Diakol Besar (K)',12,6,4072,0.00,0.00,4072,6000,-1,0,1,'','','2016-04-20',1,'2016-11-03',1),(358,'','Karbon Daito Folio',6,6,37000,0.00,0.00,37000,45000,-5,0,5,'','','2016-04-20',1,'2016-11-10',1),(359,'','Paket ujian Mantap Faber Castell',17,35,19372,0.00,0.00,19372,22000,0,0,13,'','','2016-04-20',1,'2016-04-20',1),(360,'','Clipboard Fancy 2 muka',10,6,68000,0.00,0.00,68000,75000,0,0,4,'','','2016-04-20',1,'2016-06-20',7),(361,'','Amplop Coklat Tali 310',6,6,30000,0.00,0.00,30000,45000,0,0,5,'','','2016-04-20',1,'2016-04-22',7),(362,'','Penggaris 30 cm besi (K)',17,6,1750,0.00,0.00,1750,4000,-7,0,1,'','','2016-04-20',1,'2016-11-09',9),(363,'','Penghapus whiteboard/papan tulis (K)',17,6,2583,0.00,0.00,2583,5000,-2,0,1,'','','2016-04-20',1,'2016-11-09',9),(364,'','Tinta Epson 6641 black ',11,6,75000,0.00,0.00,75000,85000,-3,0,12,'','','2016-04-20',1,'2016-11-09',9),(365,'','Tinta Epson 6642 Cyan',11,6,75000,0.00,0.00,75000,85000,-1,0,12,'','','2016-04-20',1,'2016-11-08',1),(366,'','Tinta Epson 6643 Magenta',11,6,75000,0.00,0.00,75000,85000,-1,0,12,'','','2016-04-20',1,'2016-11-08',1),(367,'','Tinta Epson 6644 Yellow',11,6,75000,0.00,0.00,75000,85000,-1,0,12,'','','2016-04-20',1,'2016-11-08',1),(368,'','Mouse Logitech B100',11,6,48000,0.00,0.00,48000,55000,0,0,1,'','','2016-04-20',1,'2016-04-20',1),(369,'','Keyboard Logitech K120',7,6,110000,0.00,0.00,110000,130000,9,0,1,'','','2016-04-20',1,'2016-11-04',1),(370,'','Pita Printer 2180',11,61,62000,0.00,0.00,62000,75000,-3,0,1,'','','2016-04-20',1,'2016-11-09',9),(371,'','Cartridge EPSON LX-310',11,61,40000,0.00,0.00,40000,55000,0,0,1,'','','2016-04-20',1,'2016-04-20',1),(372,'','Flashdisk 8gb ',11,62,30500,0.00,0.00,30500,40000,-5,0,1,'','','2016-04-20',1,'2016-11-05',1),(373,'','Flashdisk 16gb ',11,62,42500,0.00,0.00,42500,50000,0,0,1,'','','2016-04-20',1,'2016-04-20',1),(374,'','Buku 20',7,17,6458,10.00,0.00,5812,6500,0,0,5,'','','2016-04-20',1,NULL,NULL),(375,'','Kalkulator Joyko CC-11A',13,22,37406,0.00,0.00,37406,45000,0,0,1,'','','2016-04-20',1,'2016-04-20',1),(376,'','Kalkulator Joyko CC-15A',13,22,32419,0.00,0.00,32419,40000,0,0,1,'','','2016-04-20',1,'2016-04-20',1),(377,'','Kalkulator Joyko CC-2',13,22,24938,0.00,0.00,24938,35000,0,0,1,'','','2016-04-20',1,'2016-04-20',1),(378,'','Kertas CF 9 1/2 x 11\" 1 ply ',6,37,131444,0.00,0.00,131444,150000,0,0,3,'','','2016-04-20',1,'2016-04-20',1),(380,'','Map Tas Jaring Batik',10,6,9000,0.00,0.00,9000,1000,0,0,1,'','','2016-04-20',1,'2016-04-22',7),(381,'','Bingkai Foto 5R',17,6,5750,0.00,0.00,5750,6500,0,0,1,'','','2016-04-20',1,'2016-04-20',1),(382,'','Bingkai Foto 3R',17,6,4000,0.00,0.00,4000,5000,0,0,1,'','','2016-04-20',1,'2016-04-20',1),(383,'','Document Keeper isi 20 Sleting (BS)',10,6,26286,0.00,0.00,26286,35000,0,0,1,'','','2016-04-20',1,'2016-06-20',7),(384,'','Pena Tizo 1.0',16,6,28000,0.00,0.00,28000,32000,-1,0,4,'','','2016-04-20',1,'2016-10-31',1),(385,'','Kalkulator SDC 812 ',13,20,44500,0.00,0.00,44500,55000,0,0,1,'','','2016-04-20',1,'2016-05-24',7),(386,'','Kalkulator CT-555',13,20,82500,0.00,0.00,82500,95000,0,0,1,'','','2016-04-20',1,'2016-04-20',1),(387,'','Pita Ir40T Casio',13,6,19000,0.00,0.00,19000,25000,0,0,1,'','','2016-04-20',1,'2016-04-20',1),(388,'','Stabillo/Highlighter Merah(K)',15,22,2431,0.00,0.00,2431,3000,0,0,1,'','','2016-04-20',1,'2016-04-22',7),(389,'','Stabillo/Highlighter Biru (K)',15,22,2431,0.00,0.00,2431,3000,0,0,1,'','','2016-04-20',1,'2016-04-22',7),(390,'','Stabillo/Highlighter Kuning (K)',15,22,2431,0.00,0.00,2431,3000,-3,0,1,'','','2016-04-20',1,'2016-11-09',9),(391,'','Stabillo/Highlighter Hijau (K)',15,22,2431,0.00,0.00,2431,3000,-3,0,1,'','','2016-04-20',1,'2016-11-06',8),(392,'','Pembolong no. 30 ',17,22,8229,0.00,0.00,8229,12500,0,0,1,'','','2016-04-20',1,NULL,NULL),(393,'','Bantalan Stempel Sedang (K)',17,22,4613,0.00,0.00,4613,6000,-3,0,1,'','','2016-04-20',1,'2016-11-08',8),(394,'','Bantalan Stempel Besar',17,22,9559,0.00,0.00,9559,12000,0,0,1,'','','2016-04-20',1,NULL,NULL),(395,'','Pembolong/Punch Kertas 30XL JK',17,22,9900,12.50,5.00,8229,9900,0,0,1,'','','2016-04-21',1,'2016-04-22',7),(396,'','Bantalan Stempel Sedang (B)',17,22,55356,0.00,0.00,55356,60000,0,0,4,'','','2016-04-22',7,'2016-04-22',7),(397,'','Binder clip 105 (B)',17,6,21613,0.00,0.00,21613,25000,0,0,9,'','','2016-04-22',7,'2016-04-25',7),(398,'','Binder clip 107 (B)',17,6,0,0.00,0.00,0,27500,0,0,9,'','','2016-04-22',7,NULL,NULL),(399,'','Binder clip 111 (B)',17,6,39036,0.00,0.00,39036,48000,0,0,9,'','','2016-04-22',7,NULL,NULL),(400,'','Binder clip 155 (B)',17,6,56784,0.00,0.00,56784,60000,0,0,9,'','','2016-04-22',7,NULL,NULL),(401,'','Box File (LSN) ',10,6,0,0.00,0.00,0,114000,0,0,4,'','','2016-04-22',7,'2016-04-22',7),(402,'','Buku Ekspedisi 100 (B)',7,56,36300,0.00,0.00,36300,45000,0,0,5,'','','2016-04-22',7,'2016-10-31',1),(403,'','Buku Ekspedisi 100 (B)',7,55,41250,0.00,0.00,41250,50000,0,0,5,'','','2016-04-22',7,'2016-04-22',7),(404,'','Buku folio 100 lbr (B)',7,56,33550,0.00,0.00,33550,42500,-7,0,5,'','','2016-04-22',7,'2016-11-06',1),(405,'','Buku folio 100 lbr (B)',7,55,40425,0.00,0.00,40425,55000,0,0,5,'','','2016-04-22',7,NULL,NULL),(406,'','Buku Kwitansi Besar (B)',7,37,28070,0.00,0.00,28070,35000,-4,0,5,'','','2016-04-22',7,'2016-11-09',9),(407,'','Buku Kwitansi Kecil (B)',7,37,11680,0.00,0.00,11680,15000,-5,0,5,'','','2016-04-22',7,'2016-11-09',9),(408,'','Buku Kwitansi Tanggung (B)',7,37,21990,0.00,0.00,21990,25000,0,0,5,'','','2016-04-22',7,'2016-05-14',7),(409,'','Buku Oktavo 100 lbr (B)',7,56,22000,0.00,0.00,22000,27500,0,0,5,'','','2016-04-22',7,'2016-10-28',1),(410,'','Buku Quarto 100 (B)',7,56,18150,0.00,0.00,18150,22500,-4,0,5,'','','2016-04-22',7,'2016-11-05',1),(411,'','Buku Quarto 100 (B)',7,55,20625,0.00,0.00,20625,25000,-7,0,5,'','','2016-04-22',7,'2016-11-09',1),(412,'','Buku Surat Jalan 3ply (B)',7,32,54970,0.00,0.00,54970,60000,0,0,5,'','','2016-04-22',7,NULL,NULL),(413,'','Business File (B)',10,6,19550,0.00,0.00,19550,27500,-2,0,4,'','','2016-04-22',7,'2016-11-10',1),(414,'','CD-R (TBG)',11,6,65000,0.00,0.00,65000,75000,0,0,8,'','','2016-04-22',7,'2016-06-20',7),(415,'','Crayon 12 warna (B)',15,6,57120,0.00,0.00,57120,78000,35,0,4,'','','2016-04-22',7,'2016-11-09',1),(416,'','Pisau Cutter L-500 (B)',17,39,113000,0.00,0.00,113000,125000,-2,0,4,'','','2016-04-22',7,'2016-11-09',1),(417,'','Double Tape 1\" (B)',12,6,0,0.00,0.00,0,54000,-2,0,8,'','1 tbg isi 12 roll','2016-04-22',7,'2016-11-05',1),(418,'','Isi cutter L-150 (B)',17,39,43000,0.00,0.00,43000,48000,0,0,4,'','','2016-04-22',7,'2016-10-31',1),(419,'','Isi Pensil Mekanik (LSN)',17,42,0,0.00,0.00,0,33000,0,0,4,'','','2016-04-22',7,NULL,NULL),(420,'','Isi staples no. 10 (B)',17,44,0,0.00,0.00,0,23000,-22,0,9,'','','2016-04-22',7,'2016-11-09',1),(421,'','Isi staples no. 3 (B)',17,44,0,0.00,0.00,0,48000,-1,0,9,'','','2016-04-22',7,'2016-11-06',8),(422,'','Isi/Refill Spidol permanent htm (LSN)',17,49,78240,0.00,0.00,78240,82000,-9,0,4,'','','2016-04-22',7,'2016-11-10',1),(423,'','Isolasi 1\" bening core biru (TBG)',12,31,0,0.00,0.00,0,12000,-28,0,8,'','','2016-04-22',7,'2016-11-09',1),(424,'','Isolasi 1/2\" bening core biru (TBG)',12,31,8244,0.00,0.00,8244,12000,-18,0,8,'','','2016-04-22',7,'2016-11-09',1),(425,'','Isolasi/Masking Tape 1\" Kertas (TBG)',12,50,0,0.00,0.00,0,30000,-3,0,8,'','','2016-04-22',7,'2016-11-07',9),(427,'','Kertas Bufallo Biru Langit',6,10,18800,0.00,0.00,18800,23000,0,0,5,'','','2016-04-22',7,NULL,NULL),(428,'','Kertas Bufallo Merah',6,10,18800,0.00,0.00,18800,23000,-3,0,5,'','','2016-04-22',7,'2016-11-06',1),(429,'','Kertas Bufallo Putih',6,10,18800,0.00,0.00,18800,23000,-2,0,5,'','','2016-04-22',7,'2016-10-31',1),(430,'','Kertas Bufallo Pink',6,10,18800,0.00,0.00,18800,23000,-1,0,5,'','','2016-04-22',7,'2016-11-01',1),(431,'','Kertas Bufallo Kuning',6,10,18800,0.00,0.00,18800,23000,-1,0,5,'','','2016-04-22',7,'2016-11-06',1),(432,'','Kertas Bufallo Orange',6,10,18800,0.00,0.00,18800,23000,0,0,5,'','','2016-04-22',7,'2016-11-02',1),(433,'','Kertas Bufallo Coklat',6,10,18800,0.00,0.00,18800,23000,0,0,5,'','','2016-04-22',7,'2016-05-24',7),(434,'','Kertas Bufallo Ungu',6,10,18800,0.00,0.00,18800,23000,0,0,5,'','','2016-04-22',7,'2016-05-24',7),(435,'','Kertas Bufallo Hijau Tua',6,10,18800,0.00,0.00,18800,23000,-4,0,5,'','','2016-04-22',7,'2016-11-06',1),(436,'','Kertas Bufallo Hijau Muda',6,10,18800,0.00,0.00,18800,23000,0,0,5,'','','2016-04-22',7,'2016-05-24',7),(438,'','Lakban bening 2\" Core Merah (TBG)',12,31,38400,0.00,0.00,38400,50000,-26,0,8,'','','2016-04-22',7,'2016-11-09',9),(439,'','Lakban coklat 2\" Core Merah (TBG)',12,31,38400,0.00,0.00,38400,50000,-4,0,8,'','','2016-04-22',7,'2016-11-07',9),(440,'','Lem Diakol Besar (B)',12,6,28600,20.00,0.00,22880,27000,116,0,9,'','','2016-04-22',7,'2016-11-07',8),(441,'','Lakban hitam Nachi 1\"/ 1 1/2\"/ 2\" (DUS)',12,16,0,0.00,0.00,0,756000,0,0,3,'','','2016-04-22',7,NULL,NULL),(442,'','Map L (K)',10,6,0,0.00,0.00,0,2000,-36,0,1,'','','2016-04-22',7,'2016-11-08',1),(443,'','Map plastik kancing ',10,6,1750,0.00,0.00,1750,2500,-509,0,4,'','','2016-04-22',7,'2016-11-09',9),(444,'','Pena Balliner Biru (LSN)',16,42,130000,0.00,0.00,130000,140000,0,0,4,'','','2016-04-22',7,'2016-11-06',8),(445,'','Pena Balliner Hitam (LSN)',16,42,120000,0.00,0.00,120000,130000,0,0,4,'','','2016-04-22',7,NULL,NULL),(446,'','Pena Balliner Hijau (LSN)',16,42,120000,0.00,0.00,120000,130000,0,0,4,'','','2016-04-22',7,NULL,NULL),(447,'','Pena Pilot BPT-P Hitam (B)',16,42,177000,0.00,0.00,177000,190000,0,0,11,'','','2016-04-22',7,'2016-06-20',7),(448,'','Pena Pilot G-2 0,7 Hitam (K)',7,42,10417,0.00,0.00,10417,15000,0,0,1,'','','2016-04-22',7,'2016-04-22',7),(449,'','Pena PILOT Hi-Tec 0.3 Biru (B)',16,42,174000,0.00,0.00,174000,185000,0,0,11,'','','2016-04-22',7,NULL,NULL),(450,'','Pena PILOT Hi-Tec 0.3 Hitam (B)',16,42,174000,0.00,0.00,174000,185000,0,0,11,'','','2016-04-22',7,NULL,NULL),(451,'','Pena PILOT Hi-Tec 0.4 Hitam (B)',16,42,174000,0.00,0.00,174000,185000,-1,0,11,'','','2016-04-22',7,'2016-11-08',1),(452,'','Pena PILOT Hi-Tec 0.4 Biru (B)',16,42,174000,0.00,0.00,174000,185000,0,0,11,'','','2016-04-22',7,NULL,NULL),(453,'','Pena Snowman V-5 biru (B)',16,49,241920,0.00,0.00,241920,265000,0,0,11,'','','2016-04-22',7,NULL,NULL),(454,'','Pena Snowman V-5 hitam (B)',16,49,241920,0.00,0.00,241920,265000,0,0,11,'','','2016-04-22',7,NULL,NULL),(455,'','Pena Standard ST-009 Htm (B)',16,24,184500,0.00,0.00,184500,190000,-2,0,11,'','','2016-04-22',7,'2016-11-08',1),(456,'','Pena Standard ST-009 Bru (B)',16,24,184500,0.00,0.00,184500,190000,0,0,11,'','','2016-04-22',7,NULL,NULL),(457,'','Pena Standard ST-009 Bru (K)',16,24,15375,0.00,0.00,15375,18000,0,0,4,'','','2016-04-22',7,NULL,NULL),(458,'','Penggaris 30 cm besi (B)',17,6,21000,0.00,0.00,21000,28000,-1,0,4,'','','2016-04-22',7,'2016-11-09',1),(459,'','Pena Standard AE-7 Htm (B)',16,24,159000,0.00,0.00,159000,165000,-2,0,11,'','','2016-04-22',7,'2016-11-07',9),(460,'','Pena Standard AE-7 Bru (B)',16,24,159000,0.00,0.00,159000,165000,0,0,11,'','','2016-04-22',7,'2016-10-31',1),(461,'','Pena Standard AE-7 Mrh (B)',16,24,159000,0.00,0.00,159000,165000,0,0,11,'','','2016-04-22',7,'2016-10-31',1),(462,'','Penghapus whiteboard/papan tulis (LSN)',17,6,30996,0.00,0.00,30996,40000,0,0,4,'','','2016-04-22',7,NULL,NULL),(464,'','Plastik Jilid Hijau Tua',9,6,17000,0.00,0.00,17000,22500,0,0,5,'','','2016-04-22',7,'2016-11-02',1),(465,'','Plastik Jilid Hijau Muda',9,6,17000,0.00,0.00,17000,22500,-1,0,5,'','','2016-04-22',7,'2016-11-06',1),(466,'','Plastik Jilid Ungu',9,6,17000,0.00,0.00,17000,22500,0,0,5,'','','2016-04-22',7,NULL,NULL),(467,'','Plastik Jilid Orange',9,6,17000,0.00,0.00,17000,22500,0,0,5,'','','2016-04-22',7,'2016-11-02',1),(468,'','Spidol Paint Marker Putih/Warna (B)',15,49,110592,0.00,0.00,110592,150000,0,0,4,'','','2016-04-22',7,NULL,NULL),(469,'','Spidol permanent biru (B)',15,49,49440,0.00,0.00,49440,55000,0,0,4,'','','2016-04-22',7,NULL,NULL),(470,'','Spidol permanent hijau (B)',15,49,49440,0.00,0.00,49440,55000,0,0,4,'','','2016-04-22',7,NULL,NULL),(471,'','Spidol permanent hitam (B)',15,49,49445,0.00,0.00,49445,55000,404,0,4,'','','2016-04-22',7,'2016-11-09',1),(472,'','Spidol permanent merah (B)',15,49,49440,0.00,0.00,49440,55000,-1,0,4,'','','2016-04-22',7,'2016-11-02',1),(473,'','Spidol whiteboard biru(B)',15,49,58396,0.00,0.00,58396,65000,360,0,4,'','','2016-04-22',7,'2016-11-08',8),(474,'','Spidol whiteboard hijau(B)',15,49,58080,0.00,0.00,58080,65000,0,0,4,'','','2016-04-22',7,NULL,NULL),(475,'','Spidol whiteboard hitam(B)',15,49,58080,0.00,0.00,58080,65000,-19,0,4,'','','2016-04-22',7,'2016-11-06',1),(476,'','Spidol whiteboard merah(B)',15,49,58080,0.00,0.00,58080,65000,0,0,4,'','','2016-04-22',7,NULL,NULL),(477,'','Stabillo/Highlighter (B)',15,22,24310,0.00,0.00,24310,30000,-4,0,9,'','','2016-04-22',7,'2016-11-08',8),(478,'','Stabillo/Highlighter (B)',15,57,57000,0.00,0.00,57000,65000,-12,0,6,'','','2016-04-22',7,'2016-11-09',9),(479,'','Stapler HS-45 (B)',17,44,218500,0.00,0.00,218500,230000,-1,0,9,'','','2016-04-22',7,'2016-11-09',1),(480,'','Tip-ex Cair (B)',17,22,32424,0.00,0.00,32424,38000,-2,0,4,'','','2016-04-22',7,'2016-10-31',1),(481,'','Amplop 104 (B)',6,63,48200,0.00,0.00,48200,55000,0,0,5,'','','2016-04-22',7,'2016-11-06',8),(482,'','Amplop 90s (B)',6,63,67310,0.00,0.00,67310,75000,0,0,5,'','','2016-04-22',7,'2016-10-31',1),(483,'','Buku Bigboss 42',7,6,17100,10.00,0.00,15390,18000,0,0,5,'','','2016-04-23',7,'2016-04-26',7),(484,'','Buku 30 ',7,17,8820,10.00,0.00,7938,9000,0,0,5,'','','2016-04-23',7,'2016-04-23',7),(485,'','Loose Leaf B5 / Isi Binder B5',6,32,3077,0.00,0.00,3077,4000,0,0,5,'','','2016-04-23',7,'2016-04-23',7),(486,'','Buku gambar A4',7,7,14810,0.00,0.00,14810,16456,-3,0,5,'','','2016-04-23',7,'2016-11-06',1),(487,'','Origami 14 x 14/ SDU KS 100 K',6,37,2862,0.00,0.00,2862,3800,-20,0,5,'','','2016-04-23',7,'2016-10-31',1),(488,'','Kertas F4 @70gsm ',6,18,32065,5.00,0.00,30461,28800,790,0,2,'','','2016-04-23',7,'2016-11-07',8),(489,'','Buku folio 100 lbr (B)',7,7,50221,0.00,0.00,50221,55000,0,0,5,'','','2016-04-23',7,'2016-04-25',7),(490,'','Buku Bigboss 36',7,6,26350,10.00,0.00,23715,28000,0,0,5,'','','2016-04-23',7,'2016-04-23',7),(491,'','Kertas Double Folio bergaris / SDU RF 100',6,37,13425,0.00,0.00,13425,15000,-2,0,5,'','','2016-04-23',7,'2016-10-31',1),(492,'','Post it panah',17,22,4532,0.00,0.00,4532,5300,0,0,5,'','','2016-04-25',7,'2016-04-25',7),(493,'','Kaca Pembesar 60mm',17,22,6071,0.00,0.00,6071,8000,0,0,1,'','','2016-04-25',7,'2016-04-25',7),(494,'','Kaca Pembesar 75mm',17,22,7097,0.00,0.00,7097,10000,0,0,1,'','','2016-04-25',7,'2016-04-25',7),(495,'','Mesin Nomorator 6 digits',17,22,60000,0.00,5.00,57000,70000,0,0,1,'','','2016-04-25',7,'2016-04-25',7),(496,'','Mesin Nomorator 7 digits',17,22,63500,0.00,5.00,60325,80000,0,0,1,'','','2016-04-25',7,'2016-04-25',7),(497,'','Stapler Jilid 24mm',17,22,128884,0.00,0.00,128884,200000,0,0,1,'','','2016-04-25',7,'2016-04-25',7),(498,'','Pocket Sheet A4 ',10,47,841,0.00,0.00,841,1200,0,0,1,'','','2016-04-25',7,'2016-04-25',7),(499,'','Ring Insert 5236 A4 3D-65mm',7,6,40177,0.00,0.00,40177,55000,0,0,1,'','','2016-04-25',7,'2016-04-25',7),(500,'','Buku folio 100 lbr (K)',7,7,10044,0.00,0.00,10044,12000,-4,0,1,'','','2016-04-25',7,'2016-11-09',9),(501,'','Buku Quarto 100 (B) ',7,7,25925,0.00,0.00,25925,30000,0,0,5,'','','2016-04-25',7,NULL,NULL),(502,'','Paper/Trigonal clip no. 3 (K)',14,6,0,0.00,0.00,0,1500,-3,0,10,'','','2016-04-25',7,'2016-11-06',8),(503,'','Paper clip no. 5 (K)',14,6,0,0.00,0.00,0,3500,-5,0,10,'','','2016-04-25',7,'2016-11-07',9),(504,'','Pena Standard Techno Hitam (K) ',16,24,0,0.00,0.00,0,18000,-6,0,4,'','','2016-04-26',7,'2016-11-09',1),(505,'','Pena Standard Techno Biru (K) ',16,24,0,0.00,0.00,0,18000,-7,0,4,'','','2016-04-26',7,'2016-11-09',1),(506,'','Pena Standard Techno Biru (B) ',16,24,15750,0.00,0.00,15750,18000,0,0,4,'','','2016-04-26',7,'2016-11-06',8),(507,'','Pena Standard Techno Hitam (B) ',16,24,0,0.00,0.00,0,195000,0,0,4,'','','2016-04-26',7,NULL,NULL),(508,'','Amplop Coklat uk A3',6,6,0,0.00,0.00,0,65000,0,0,5,'','','2016-04-26',7,'2016-04-26',7),(509,'','Isolasi 1/2\" bening core Hijau (TBG)',12,31,12000,0.00,0.00,12000,17000,0,0,8,'','','2016-04-26',7,'2016-05-14',7),(510,'','Pita PLQ-20 Epson',11,61,165000,0.00,0.00,165000,300000,-3,0,9,'','','2016-04-26',7,'2016-11-08',9),(511,'','Kertas Photo Paper Glossy',6,6,12000,0.00,0.00,12000,15000,-15,0,5,'','','2016-04-26',7,'2016-11-03',1),(512,'','Plastik Laminating A4 ',9,12,0,0.00,0.00,0,70000,-3,0,5,'','','2016-04-26',7,'2016-11-07',9),(513,'','Kertas Photo Paper Sticker ',6,6,20500,0.00,0.00,20500,25000,-1,0,5,'','','2016-04-26',7,'2016-11-04',1),(514,'','Isolasi Koin 1/2\" bening tipis',12,16,0,0.00,0.00,0,6000,0,0,8,'','','2016-04-26',7,'2016-04-26',7),(515,'','Isolasi Koin 1/2\" bening tebal',12,16,0,0.00,0.00,0,12000,0,0,8,'','','2016-04-26',7,'2016-04-26',7),(516,'','Plastik Laminating KTP Tipis',9,6,12000,0.00,0.00,12000,15000,-5,0,5,'','','2016-04-26',7,'2016-11-07',9),(517,'','Plastik Laminating KTP Tebal',9,6,22500,0.00,0.00,22500,30000,0,0,5,'','','2016-04-26',7,'2016-10-21',1),(518,'','Document Keeper F4 isi 80',10,6,0,0.00,0.00,0,0,0,0,1,'','','2016-04-26',7,'2016-04-26',7),(519,'','Document Keeper F4 isi 40',10,6,13100,0.00,0.00,13100,0,-2,0,1,'','','2016-04-26',7,'2016-11-07',9),(520,'','Document Keeper F4 isi 20',10,6,0,0.00,0.00,0,0,-12,0,1,'','','2016-04-26',7,'2016-11-07',9),(521,'','Pocket Sheet F4',10,6,0,0.00,0.00,0,65000,0,0,5,'','','2016-04-26',7,'2016-04-26',7),(522,'','Buku DOUBLEFOLIO 100',7,40,0,0.00,0.00,0,27500,0,0,1,'','','2016-04-26',7,'2016-04-26',7),(523,'','Buku Nota Kontan b1 (B)',7,32,26700,0.00,0.00,26700,30000,0,0,5,'','','2016-04-26',7,'2016-05-14',7),(524,'','Buku Nota Kontan b2 (B)',7,32,35200,0.00,0.00,35200,40000,0,0,5,'','','2016-04-26',7,'2016-05-14',7),(525,'','Buku Nota Kontan b3 (B)',7,32,51670,0.00,0.00,51670,60000,0,0,5,'','','2016-04-26',7,NULL,NULL),(526,'','Buku Nota Kontan k1 (B)',7,32,12550,0.00,0.00,12550,15000,-1,0,5,'','','2016-04-26',7,'2016-11-09',9),(527,'','Buku Nota Kontan k2 (B)',7,32,17360,0.00,0.00,17360,20000,-2,0,5,'','','2016-04-26',7,'2016-11-04',1),(528,'','Buku Nota Kontan k3 (B)',7,32,25430,0.00,0.00,25430,30000,-7,0,5,'','','2016-04-26',7,'2016-11-09',9),(529,'','Pita Casio ',11,19,0,0.00,0.00,0,10000,-3,0,1,'','','2016-04-26',7,'2016-11-08',9),(530,'','Money Detector',13,6,0,0.00,0.00,0,110000,0,0,1,'','','2016-04-26',7,'2016-04-26',7),(531,'','Battery/Baterai Alkaline AA (K)',17,6,0,0.00,0.00,0,8000,-34,0,13,'','','2016-04-26',7,'2016-11-08',1),(532,'','Battery/Baterai Alkaline AA (B)',17,6,0,0.00,0.00,0,180000,-2,0,9,'','','2016-04-26',7,'2016-11-08',1),(533,'','Battery/Baterai Alkaline AAA (B)',17,6,0,0.00,0.00,0,180000,0,0,9,'','','2016-04-26',7,'2016-04-26',7),(534,'','Battery/Baterai Alkaline AAA (K)',17,6,0,0.00,0.00,0,8000,-7,0,13,'','','2016-04-26',7,'2016-11-08',1),(535,'','Rak Surat/Elevated Tray 3 susun ',17,6,76000,20.00,0.00,60800,75000,-1,0,1,'','','2016-04-28',7,'2016-11-04',1),(536,'','Kapur Lilin/Crayon ',15,6,17500,0.00,0.00,17500,22000,240,0,10,'','','2016-04-28',7,'2016-11-07',8),(537,'','Crayon 12 warna TITI',15,6,10765,0.00,0.00,10765,10765,0,0,13,'','','2016-04-28',7,'2016-04-28',7),(538,'','Isi staples no. 3 ETONA',17,6,43500,0.00,0.00,43500,50000,0,0,9,'','','2016-04-28',7,'2016-04-28',7),(539,'','Isi cutter A-100 (B)',17,39,21250,0.00,0.00,21250,24000,-1,0,9,'','','2016-04-28',7,'2016-11-06',1),(540,'','Isi cutter A-100 (K)',17,39,1771,0.00,0.00,1771,3000,0,0,10,'','','2016-04-28',7,NULL,NULL),(541,'','Pena Signo Hitam (B) ',16,6,120000,0.00,0.00,120000,135000,0,0,4,'','','2016-04-28',7,'2016-11-09',8),(542,'','Pena Signo Biru (B) ',16,6,120000,0.00,0.00,120000,135000,0,0,4,'','','2016-04-28',7,NULL,NULL),(543,'','Pena Signo Biru (K) ',16,6,10000,0.00,0.00,10000,15000,0,0,1,'','','2016-04-28',7,NULL,NULL),(544,'','Pena Signo Biru (B) ',16,6,120000,0.00,0.00,120000,135000,0,0,1,'','','2016-04-28',7,NULL,NULL),(545,'','Isi/Refill Pena Signo',16,6,56000,0.00,0.00,56000,85000,0,0,4,'','','2016-04-28',7,'2016-04-28',7),(546,'','Pena Mini Gel',16,6,13750,0.00,0.00,13750,18000,0,0,4,'','','2016-04-29',7,'2016-04-29',7),(547,'','Stabillo 2 warna',15,6,19600,0.00,0.00,19600,21000,-3,0,4,'','','2016-04-29',7,'2016-11-05',1),(548,'','Paper/Trigonal clip no. 3 (B)',14,64,10000,0.00,0.00,10000,15000,-5,0,9,'','','2016-04-29',7,'2016-11-09',9),(549,'','Paper clip no. 5 (B)',14,64,28000,0.00,0.00,28000,35000,0,0,9,'','','2016-04-29',7,'2016-04-29',7),(550,'','Penggaris/Garisan Set ',17,64,3250,0.00,0.00,3250,4500,-14,0,1,'','','2016-04-29',7,'2016-11-08',8),(551,'','Stapler Mini',17,64,45000,0.00,0.00,45000,55000,0,0,4,'','','2016-04-29',7,'2016-04-29',7),(552,'','Pensil warna 12  Panjang (K)',15,65,6800,0.00,0.00,6800,12000,0,0,1,'','','2016-04-29',7,'2016-04-29',7),(553,'','Pensil warna 12 Panjang (B)',15,65,81600,0.00,0.00,81600,90000,0,0,4,'','','2016-04-29',7,'2016-04-29',7),(554,'','Pensil warna 12 Pendek (K) ',15,65,3500,0.00,0.00,3500,6000,0,0,1,'','','2016-04-29',7,'2016-04-29',7),(555,'','Pensil warna 12 Pendek (B) ',15,65,42000,0.00,0.00,42000,50000,0,0,1,'','','2016-04-29',7,'2016-04-29',7),(556,'','Kertas CF 9 1/2 x 11\" 4 ply ',6,38,226251,1.00,0.00,223988,237000,-1,0,3,'','','2016-04-29',7,'2016-11-09',9),(557,'','Kertas CF 14 7/8 x 11\" 4 ply',6,38,337838,1.00,0.00,334459,380000,5,0,3,'','','2016-04-29',7,'2016-11-09',8),(558,'','Lem Fox 150 gr ',12,6,6000,0.00,0.00,6000,8000,-25,0,12,'','','2016-05-01',7,'2016-11-06',8),(559,'','Tali Rafia ',17,6,8333,0.00,0.00,8333,10000,-1,0,7,'','','2016-05-14',7,'2016-11-05',1),(560,'','Kertas CF 9 1/2 x 11\" 1 ply PRS',6,38,137540,0.00,0.00,137540,137540,0,0,3,'','','2016-05-14',7,'2016-05-14',7),(561,'','Kertas Kado BOX',6,37,67765,0.00,0.00,67765,75000,0,0,9,'','','2016-05-14',7,'2016-05-14',7),(562,'','Kertas Kado',6,37,0,0.00,0.00,0,25000,-1,0,5,'','','2016-05-14',7,'2016-11-09',9),(563,'','Cartridge HP 704 BLACK',11,67,85000,0.00,0.00,85000,100000,0,0,1,'','','2016-05-14',7,NULL,NULL),(564,'','Cartridge HP 678 Black',11,67,85000,0.00,0.00,85000,100000,0,0,1,'','','2016-05-14',7,NULL,NULL),(565,'','Cartridge HP 920 Magenta',11,67,164000,0.00,0.00,164000,185000,0,0,1,'','','2016-05-14',7,NULL,NULL),(566,'','Cartridge Canon 98',11,66,200000,0.00,0.00,200000,215000,0,0,1,'','','2016-05-14',7,'2016-05-24',7),(567,'','Cartridge HP 920 Black',11,67,219000,0.00,0.00,219000,235000,0,0,1,'','','2016-05-14',7,NULL,NULL),(568,'','Kertas Fax (B)',6,6,230000,0.00,0.00,230000,270000,0,0,3,'','','2016-05-14',7,'2016-05-14',7),(569,'','Kertas Fax (K)',6,6,7667,0.00,0.00,7667,10000,-14,0,7,'','','2016-05-14',7,'2016-11-04',1),(570,'','Paper Cutter/ Pemotong Kertas B4 ',17,22,161200,0.00,0.00,161200,200000,0,0,1,'','','2016-05-14',7,'2016-06-24',1),(571,'','Double Tape 1/4\"',12,22,995,0.00,0.00,995,1500,0,0,1,'','','2016-05-14',7,NULL,NULL),(572,'','Lem Glue stick 8gr (B)',12,22,35910,0.00,0.00,35910,40000,-2,0,9,'','','2016-05-14',7,'2016-11-06',1),(573,'','Isolasi kabel unibell',12,6,4850,0.00,0.00,4850,7000,0,0,7,'','','2016-05-14',7,'2016-05-14',7),(574,'','Amplop 90 Jendela Kiri',6,6,25000,0.00,0.00,25000,35000,0,0,5,'','','2016-05-14',7,'2016-06-20',7),(575,'','Lakban kain biru 2\"',12,6,12500,0.00,0.00,12500,15000,0,0,7,'','','2016-05-14',7,'2016-05-14',7),(576,'','Lem Dlukol Tanggung (B)',12,6,21575,20.00,0.00,17260,20000,35,0,4,'','','2016-05-14',7,'2016-11-09',1),(577,'','Toner 85 A Eprint',11,11,340000,0.00,0.00,340000,365000,0,0,1,'','','2016-05-14',7,NULL,NULL),(578,'','Kertas Bufallo Hitam',6,6,18800,0.00,0.00,18800,23000,0,0,5,'','','2016-05-24',7,'2016-05-24',7),(579,'','Plastik Card ID 8 x 12',9,6,22500,0.00,0.00,22500,35000,0,0,5,'','','2016-05-24',7,'2016-05-24',7),(580,'','Lakban hitam 1\"',12,16,4750,0.00,0.00,4750,6000,-11,0,7,'','','2016-05-24',7,'2016-11-09',1),(581,'','Karton Padi ',6,6,1428,0.00,0.00,1428,1800,0,0,1,'','','2016-05-24',7,'2016-05-24',7),(582,'','Spidol kecil PW-12 (GROSS)',15,49,92070,0.00,0.00,92070,105000,12,0,11,'','','2016-05-24',7,'2016-11-08',8),(583,'','Pena Snowman V-3 Hitam',16,49,18720,0.00,0.00,18720,22000,-6,0,4,'','','2016-05-24',7,'2016-11-09',1),(584,'','Buku Agenda Batik ',7,6,9750,0.00,0.00,9750,9750,0,0,1,'','','2016-05-24',7,'2016-05-24',7),(585,'','Bantex Prong Paper Fastener',14,47,32835,0.00,0.00,32835,40000,0,0,10,'','','2016-05-24',7,'2016-05-24',7),(586,'','Kertas A4 @70gsm ',6,68,25550,0.00,0.00,25550,30000,0,0,2,'','','2016-05-24',7,'2016-05-24',7),(587,'','Kertas CF 9 1/2 x 11\" 5 ply White ',6,37,282812,0.00,0.00,282812,320000,0,0,3,'','','2016-05-24',7,'2016-05-24',7),(588,'','Cartridge HP 802 Colour',11,67,122000,0.00,0.00,122000,135000,0,0,1,'','','2016-05-24',7,'2016-05-24',7),(589,'','Cartridge HP 704 Colour',11,67,84000,0.00,0.00,84000,105000,0,0,1,'','','2016-05-24',7,'2016-05-24',7),(590,'','Cartridge Canon 88',11,66,165000,0.00,0.00,165000,180000,0,0,1,'','','2016-05-24',7,'2016-05-24',7),(591,'','Kalkulator CT-666',13,20,110000,0.00,0.00,110000,130000,0,0,1,'','','2016-05-24',7,'2016-05-24',7),(592,'','Kalkulator FX 350 ES PLUS',13,19,113706,0.00,0.00,113706,140000,0,0,1,'','','2016-05-24',7,'2016-05-24',7),(593,'','Kalkulator FX 570 ES PLUS',13,19,179536,0.00,0.00,179536,200000,0,0,1,'','','2016-05-24',7,'2016-05-24',7),(594,'','Kalkulator FX 991 ID PLUS',13,19,186065,0.00,0.00,186065,210000,0,0,1,'','','2016-05-24',7,'2016-05-24',7),(595,'','Kalkulator SX-220',13,19,58213,0.00,0.00,58213,70000,0,0,1,'','','2016-05-24',7,'2016-05-24',7),(596,'','Pita Printer LX 300/310',11,11,4000,0.00,0.00,4000,4000,0,0,1,'','','2016-06-20',7,'2016-06-20',7),(597,'','Kertas Thermal 80 mm x 140 mm ',6,6,32727,0.00,0.00,32727,32727,0,0,7,'','','2016-06-20',7,NULL,NULL),(598,'','Pensil warna 12 Panjang (K)',15,34,16538,0.00,0.00,16538,16538,228,0,13,'','','2016-06-20',7,'2016-11-09',1),(599,'','Pita Printer 2180',11,11,12000,0.00,0.00,12000,12000,0,0,1,'','','2016-06-20',7,'2016-06-20',7),(600,'','Tip-ex cair Murah',17,6,25000,0.00,0.00,25000,25000,0,0,4,'','','2016-06-20',7,'2016-06-20',7),(601,'','Document Keeper isi 40 Sleting (BS)',10,6,33448,0.00,0.00,33448,33448,0,0,1,'','','2016-06-20',7,'2016-06-20',7),(602,'','Document Keeper isi 60 Sleting (BS)',10,6,41548,0.00,0.00,41548,50000,0,0,1,'','','2016-06-20',7,'2016-06-20',7),(603,'','Gunting ss',17,6,20250,0.00,0.00,20250,25000,-2,0,4,'','','2016-06-20',7,'2016-11-07',9),(604,'','Gunting XL',17,6,34875,0.00,0.00,34875,40000,-2,0,4,'','','2016-06-20',7,'2016-10-31',1),(605,'','Peruncing Roti @2lsn',17,6,13500,0.00,0.00,13500,16000,0,0,5,'','','2016-06-20',7,'2016-06-20',7),(606,'','Sampul Buku ukuran Quarto',17,6,3750,0.00,0.00,3750,4500,0,0,5,'','','2016-06-20',7,'2016-06-20',7),(607,'','Pensil warna 12 Pendek (K) ',15,34,8925,0.00,0.00,8925,11000,480,0,13,'','','2016-06-20',7,'2016-11-07',9),(608,'','Pensil warna 12 Pendek (B) ',15,34,107100,0.00,0.00,107100,125000,-1,0,11,'','','2016-06-20',7,'2016-11-09',1),(609,'','DVD-R',11,6,85000,0.00,0.00,85000,95000,0,0,8,'','','2016-06-20',7,'2016-06-20',7),(610,'','Pena KENKO Easy Gel Hitam',16,39,20250,0.00,0.00,20250,24000,-17,0,4,'','','2016-06-20',7,'2016-11-09',9),(611,'','Pena KENKO Easy Gel Biru',16,39,20250,0.00,0.00,20250,24000,-1,0,4,'','','2016-06-20',7,'2016-11-09',9),(612,'','Stapler Tembak TP-8H V-TECH',17,48,58000,0.00,0.00,58000,75000,0,0,1,'','','2016-06-20',7,'2016-06-20',7),(613,'','Tembakan Baju',17,48,16000,0.00,0.00,16000,25000,0,0,1,'','','2016-06-20',7,'2016-06-20',7),(614,'','Kertas Thermal 80 mm x 80 mm',6,6,8800,0.00,0.00,8800,15000,0,0,7,'','','2016-06-20',7,'2016-06-20',7),(615,'','Correction Tape (K)',17,69,3708,0.00,0.00,3708,3708,-15,0,1,'','','2016-06-24',1,'2016-11-08',8),(616,'','Correction Tape (B)',17,69,44500,0.00,0.00,44500,54000,-2,0,4,'','','2016-06-24',1,'2016-11-06',1),(617,'','Crayon 18 warna (K)',15,6,11200,0.00,0.00,11200,13000,0,0,13,'','','2016-06-24',1,'2016-06-24',1),(618,'','Isi staples no. 10 murah',17,6,6080,0.00,0.00,6080,10000,0,0,9,'','','2016-06-24',1,'2016-06-24',1),(619,'','Label Harga murah (B)',17,43,40000,0.00,0.00,40000,50000,-5,0,5,'','','2016-06-24',1,'2016-11-07',9),(620,'','Pensil TABUNG',17,43,30000,0.00,0.00,30000,35000,0,0,8,'','','2016-06-24',1,'2016-06-24',1),(621,'Styrofoam','Styrofoam/Gabus',17,6,0,0.00,0.00,0,5500,-2,0,1,'','','2016-10-28',1,'2016-11-09',9),(622,'','Cartridge Canon 810',11,66,175000,0.00,0.00,175000,195000,-5,0,1,'','','2016-10-28',1,'2016-11-10',9),(623,'','Cartridge Canon 811',11,66,225000,0.00,0.00,225000,245000,3,0,1,'','','2016-10-28',1,'2016-11-10',9),(624,'','Kertas karton BC Putih',6,6,0,0.00,0.00,0,1500,-40,0,1,'','','2016-10-28',1,'2016-11-09',1),(625,'','Kertas karton BC Pink/Merah',6,6,0,0.00,0.00,0,1500,0,0,1,'','','2016-10-28',1,'2016-10-28',1),(626,'','Kertas karton BC Kuning',6,6,0,0.00,0.00,0,1500,0,0,1,'','','2016-10-28',1,'2016-10-31',1),(628,'','Kertas karton BC Hijau',6,6,0,0.00,0.00,0,1500,-20,0,1,'','','2016-10-28',1,'2016-11-09',1),(629,'','Kertas karton BC Biru',6,6,1140,0.00,0.00,1140,1140,-20,0,1,'','','2016-10-28',1,'2016-11-09',1),(630,'','Kertas karton BC Hitam',6,6,0,0.00,0.00,0,1500,0,0,1,'','','2016-10-28',1,NULL,NULL),(631,'','Kertas DRH Daftar Riwayat Hidup ',6,6,0,0.00,0.00,0,12000,0,0,5,'','','2016-10-28',1,'2016-10-31',1),(632,'','Kertas SLK Surat Lamaran Kerja',6,6,0,0.00,0.00,0,12000,0,0,5,'','','2016-10-28',1,'2016-10-31',1),(633,'','Buku Folio 50 lbr ',7,7,0,0.00,0.00,0,7600,0,0,1,'','','2016-10-28',1,'2016-11-02',1),(634,'','Kertas Asturo Pelangi',6,6,0,0.00,0.00,0,75000,0,0,5,'','','2016-10-28',1,'2016-10-28',1),(635,'','Ordner Bambi 1014',10,60,0,0.00,0.00,0,25000,-42,0,1,'','','2016-10-31',1,'2016-11-04',1),(636,'','Stapler HD-10 Kangaro (K) ',17,6,0,0.00,0.00,0,10000,-13,0,1,'','','2016-10-31',1,'2016-11-09',9),(637,'','Stapler HD-10 Kangaro (B) ',17,6,0,0.00,0.00,0,85000,-7,0,1,'','','2016-10-31',1,'2016-11-09',1),(638,'','Stapler HD-10 Max (K) ',17,6,0,0.00,0.00,0,15000,0,0,1,'','','2016-10-31',1,NULL,NULL),(639,'','Stapler HD-10 Max (B) ',17,6,0,0.00,0.00,0,135000,0,0,4,'','','2016-10-31',1,NULL,NULL),(640,'','Papan whiteboard 2 m x 1,22 m',17,6,0,0.00,0.00,0,250000,-1,0,1,'','','2016-10-31',1,'2016-10-31',1),(641,'','Lem setan/korea (B)',12,6,0,0.00,0.00,0,165000,-2,0,5,'','','2016-10-31',1,'2016-11-09',1),(642,'','Lem setan/korea (K)',12,6,2900,0.00,0.00,2900,5000,2480,0,1,'','','2016-10-31',1,'2016-11-07',9),(643,'','Kelir Kayu Panjang',15,6,0,0.00,0.00,0,55000,-1,0,5,'','','2016-10-31',1,'2016-10-31',1),(644,'','Isolasi Kabel TABUNGAN',12,6,0,0.00,0.00,0,8000,-2,0,8,'','','2016-10-31',1,'2016-10-31',1),(645,'','Pena Balliner PROKENSO',16,6,0,0.00,0.00,0,15000,-2,0,4,'','','2016-10-31',1,'2016-10-31',1),(646,'','Tip-ex Cair (B)',17,39,0,0.00,0.00,0,43000,-19,0,4,'','','2016-10-31',1,'2016-11-09',1),(647,'','Paku payung ',17,6,3700,0.00,0.00,3700,6000,487,0,9,'','','2016-10-31',1,'2016-11-07',9),(648,'','Pena 3 warna',16,6,0,0.00,0.00,0,28000,-1,0,4,'','','2016-10-31',1,'2016-10-31',1),(649,'','Lem aica aibon besar (B)',12,6,95000,0.00,0.00,95000,100000,-1,0,4,'','','2016-10-31',1,'2016-11-08',8),(650,'','Lem aica aibon kecil (B)',12,6,75000,0.00,0.00,75000,75000,-1,0,4,'','','2016-10-31',1,'2016-11-09',1),(651,'','Lem aica aibon kecil (K)',12,6,0,0.00,0.00,0,8000,0,0,1,'','','2016-10-31',1,NULL,NULL),(652,'','Lem aica aibon besar (K)',12,6,0,0.00,0.00,0,10000,0,0,1,'','','2016-10-31',1,NULL,NULL),(653,'','Toner Fotocopy Singa Gold',17,6,115000,0.00,0.00,115000,125000,-1,0,5,'','','2016-10-31',1,'2016-11-04',1),(654,'','Isolasi kertas/masking tape 2\"',12,6,0,0.00,0.00,0,48000,-2,0,8,'','','2016-10-31',1,'2016-11-07',9),(655,'','Buku folio 100 lbr SINARLINE (K)',7,6,0,0.00,0.00,0,9000,-15,0,1,'','','2016-10-31',1,'2016-11-09',1),(656,'','Post it pronto FLAG',17,6,0,0.00,0.00,0,8000,-40,0,6,'','','2016-11-01',1,'2016-11-07',9),(657,'','Kertas Tellstruk 75 x 65 1 ply',6,8,39276,10.00,0.00,35348,40000,-3,0,5,'','','2016-11-01',1,'2016-11-08',8),(658,'','Tinta Stempel Manis Merah',17,6,0,0.00,0.00,0,10000,0,0,1,'','','2016-11-01',1,NULL,NULL),(659,'','Tinta Stempel Manis Biru',17,6,0,0.00,0.00,0,10000,-10,0,1,'','','2016-11-01',1,'2016-11-01',1),(660,'','Tinta Stempel Manis Ungu',17,6,0,0.00,0.00,0,10000,-5,0,1,'','','2016-11-01',1,'2016-11-06',8),(661,'','Tinta Stempel Manis Hijau',17,6,0,0.00,0.00,0,10000,0,0,1,'','','2016-11-01',1,NULL,NULL),(662,'','Tinta Stempel Manis Hitam',17,6,0,0.00,0.00,0,10000,0,0,1,'','','2016-11-01',1,NULL,NULL),(663,'','Pensil tukang',17,6,1100,0.00,0.00,1100,2500,-85,0,1,'','','2016-11-02',1,'2016-11-09',9),(664,'','Plastik clips 20 X 12',9,6,25000,0.00,0.00,25000,30000,-20,0,5,'','','2016-11-02',1,'2016-11-04',1),(665,'','Lem Cair Povinal 112 (K)',12,6,0,0.00,0.00,0,0,-2,0,1,'','','2016-11-03',1,'2016-11-03',1),(666,'','Lem Cair Povinal 111 (K)',12,6,0,0.00,0.00,0,3000,0,0,1,'','','2016-11-03',1,NULL,NULL),(667,'','Isi/Refill Lem Cair Povinal',12,6,0,0.00,0.00,0,25000,-1,0,12,'','','2016-11-03',1,'2016-11-03',1),(668,'','Lakban bening 2\" Core Merah (DUS)',12,31,0,0.00,0.00,0,550000,-1,0,3,'','','2016-11-03',1,'2016-11-07',9),(669,'','Lakban coklat 2\" Core Merah (DUS)',12,31,0,0.00,0.00,0,550000,-1,0,3,'','','2016-11-03',1,'2016-11-03',1),(670,'','tinta Epson blue print hitam',11,45,27000,0.00,0.00,27000,35000,50,0,12,'','','2016-11-03',1,'2016-11-03',1),(671,'','tinta Epson blue print cyan',11,45,27000,0.00,0.00,27000,35000,50,0,12,'','','2016-11-03',1,'2016-11-03',1),(672,'','tinta Epson blue print magenta',11,45,27000,0.00,0.00,27000,35000,50,0,12,'','','2016-11-03',1,'2016-11-03',1),(673,'','tinta Epson blue print yellow',11,45,27000,0.00,0.00,27000,35000,50,0,12,'','','2016-11-03',1,'2016-11-03',1),(674,'','Isolasi 1\" bening Nachi (k)',12,16,0,0.00,0.00,0,6000,-30,0,7,'','','2016-11-03',1,'2016-11-08',9),(675,'','Isolasi 1/2\" bening Nachi (k)',12,16,0,0.00,0.00,0,6000,0,0,7,'','','2016-11-03',1,NULL,NULL),(676,'','Kertas Photo Paper Glossy 210',6,70,12250,20.00,0.00,9800,12500,495,0,5,'','','2016-11-03',1,'2016-11-06',1),(677,'','Kertas Photo Paper Glossy 230',6,70,13250,20.00,0.00,10600,15000,250,0,5,'','','2016-11-03',1,'2016-11-03',1),(678,'','Plastik buah',9,71,52500,15.00,0.00,44625,60000,120,0,7,'','','2016-11-03',1,'2016-11-03',1),(679,'','cartrdige epson lq 2180 ',11,26,45000,0.00,0.00,45000,65000,-3,0,6,'','','2016-11-03',1,'2016-11-09',9),(680,'','kertas buram',6,6,17500,0.00,0.00,17500,20000,260,0,2,'','','2016-11-03',1,'2016-11-08',8),(681,'','amplop 90 ',6,63,13575,0.00,0.00,13575,13575,-13,0,10,'','','2016-11-03',1,'2016-11-10',1),(682,'','Pena AE-7 Hitam ',16,24,13500,0.00,0.00,13500,15000,-18,0,10,'','','2016-11-03',1,'2016-11-10',1),(683,'','cf 9,5 X 11 3 ply ',6,38,319000,0.00,0.00,319000,330000,-1,0,3,'','','2016-11-03',1,'2016-11-03',1),(684,'','cartridge 5040',11,26,60000,0.00,0.00,60000,75000,-1,0,1,'','','2016-11-03',1,'2016-11-03',1),(685,'','stella all in one',17,6,8645,0.00,0.00,8645,10000,72,0,1,'','','2016-11-03',1,'2016-11-03',1),(686,'','Spidol kecil PW-12 (LSN)',15,49,0,0.00,0.00,0,10000,-2,0,4,'','','2016-11-03',1,'2016-11-09',1),(687,'','Spidol kecil PW-12 (K)',15,49,0,0.00,0.00,0,1500,0,0,1,'','','2016-11-03',1,NULL,NULL),(688,'','mouse  logitec m165',11,6,105000,0.00,0.00,105000,120000,-3,0,6,'','','2016-11-03',1,'2016-11-04',1),(689,'','rautan pensil',17,6,700,0.00,0.00,700,1500,-1,0,6,'','','2016-11-03',1,'2016-11-03',1),(690,'','pena merah',16,6,1000,0.00,0.00,1000,1500,-2,0,1,'','','2016-11-03',1,'2016-11-03',1),(691,'','buku tulis 38 KIKY',7,6,19000,0.00,0.00,19000,20000,-1,0,5,'','','2016-11-03',1,'2016-11-03',1),(692,'','Pensil Case Deli ',17,6,21000,0.00,0.00,21000,30000,-2,0,1,'','','2016-11-04',1,'2016-11-04',1),(693,'','Post it flag warna',17,30,0,0.00,0.00,0,20000,-1,0,5,'','','2016-11-04',1,'2016-11-04',1),(694,'','Post it 656 3m',17,30,0,0.00,0.00,0,8000,-1,0,1,'','','2016-11-04',1,'2016-11-04',1),(695,'','Cartridge Canon 740',11,66,0,0.00,0.00,0,195000,-1,0,1,'','','2016-11-04',1,'2016-11-06',8),(696,'','Cartridge Canon 741',11,66,0,0.00,0.00,0,0,0,0,1,'','','2016-11-04',1,NULL,NULL),(697,'','Amplop coklat uk Map',6,6,0,0.00,0.00,0,43000,-4,0,5,'','','2016-11-04',1,'2016-11-10',1),(698,'','Buku agenda surat keluar masuk ',7,6,0,0.00,0.00,0,20000,-2,0,1,'','','2016-11-04',1,'2016-11-06',8),(699,'','Ordner 401 (LSN)',10,72,0,0.00,0.00,0,315000,-11,0,4,'','','2016-11-04',1,'2016-11-09',8),(700,'','Pelobang Deli Besar',17,6,478000,0.00,0.00,478000,560000,0,0,1,'','','2016-11-04',1,'2016-11-05',8),(701,'','pelobang kertas No 800',17,44,375000,0.00,0.00,375000,450000,-2,0,1,'','','2016-11-04',1,'2016-11-06',8),(702,'','kertas CF 9 1/2 X 11 4 ply PRS',6,38,238000,0.00,0.00,238000,248000,-5,0,3,'','','2016-11-04',1,'2016-11-07',9),(703,'','Tip-ex PENTEL',17,6,20000,0.00,0.00,20000,25000,-1,0,1,'','','2016-11-04',1,'2016-11-05',1),(704,'','Kertas BC',6,6,0,0.00,0.00,0,22000,-2,0,6,'','','2016-11-05',1,'2016-11-05',1),(705,'','foam tape 1\"',12,16,6500,0.00,0.00,6500,12000,-6,0,7,'','','2016-11-05',1,'2016-11-08',1),(706,'','Buku Tamu Joyko',7,6,0,0.00,0.00,0,20000,-9,0,1,'','','2016-11-05',1,'2016-11-09',9),(707,'','Papan/clipboard ujian (K)',17,6,5000,0.00,0.00,5000,5000,-5,0,1,'','','2016-11-06',1,'2016-11-09',9),(708,'','Papan/clipboard ujian (B)',17,6,0,0.00,0.00,0,36000,-2,0,4,'','','2016-11-06',1,'2016-11-06',1),(710,'','Isi/Refill Spidol Whiteboard hitam(B)',15,49,0,0.00,0.00,0,130000,-1,0,4,'','','2016-11-06',1,'2016-11-06',1),(711,'','Buku Halus Kasar (B)',7,6,0,0.00,0.00,0,20000,-4,0,5,'','','2016-11-06',1,'2016-11-06',1),(712,'','kertas photo paper glossy 230',6,73,11500,0.00,0.00,11500,15000,497,0,5,'','','2016-11-06',8,'2016-11-07',9),(713,'','cash box 8868 L',17,6,600000,25.00,0.00,450000,600000,12,0,1,'','','2016-11-06',8,'2016-11-06',8),(714,'','lem povinal 113',12,6,13375,0.00,0.00,13375,25000,0,0,12,'','','2016-11-06',8,NULL,NULL),(715,'','isolasi pvc hitam',12,31,4900,0.00,0.00,4900,7000,0,0,8,'','','2016-11-06',8,NULL,NULL),(716,'','note book 156',7,6,24000,0.00,0.00,24000,30000,0,0,4,'','','2016-11-06',8,NULL,NULL),(717,'','stapler Deli No 10',17,6,136800,0.00,0.00,136800,150000,0,0,9,'','','2016-11-06',8,NULL,NULL),(718,'','stapler heavy duty E0150',18,6,516841,7.50,0.00,478077,600000,2,0,1,'','','2016-11-06',8,'2016-11-09',8),(719,'','Acco fasterner',14,64,5600,0.00,0.00,5600,7500,0,0,10,'','','2016-11-06',8,'2016-11-07',9),(720,'','Binder clip 200',14,6,7100,0.00,0.00,7100,10000,0,0,10,'','','2016-11-06',8,NULL,NULL),(721,'','binder clip 260',14,6,11400,0.00,0.00,11400,15000,0,0,6,'','','2016-11-06',8,NULL,NULL),(722,'','pita IBM 9068 A01',11,6,100000,0.00,0.00,100000,150000,0,0,1,'','','2016-11-06',8,NULL,NULL),(723,'','pita printer 7755',11,25,11000,0.00,0.00,11,15000,0,0,1,'','','2016-11-06',8,NULL,NULL),(725,'','pensil  2 B Nagata',17,6,56000,0.00,0.00,56000,80000,0,0,11,'','','2016-11-06',8,NULL,NULL),(726,'','buku gambar A-3 mobil',7,6,34500,20.00,0.00,27600,32000,0,0,5,'','','2016-11-06',8,NULL,NULL),(727,'','buku  gambar A-4 mobil',7,6,17250,20.00,0.00,13800,17250,0,0,5,'','','2016-11-06',8,NULL,NULL),(728,'','amplop coklat kwarto',6,6,21375,0.00,0.00,21375,27500,0,0,5,'','','2016-11-06',8,NULL,NULL),(729,'','colour magnit MN-1',17,22,5600,12.50,5.00,4655,7000,200,0,5,'','','2016-11-06',8,'2016-11-06',8),(730,'','label LB-2RL(1baris)',12,22,16500,12.50,5.00,13715,18000,100,0,5,'','','2016-11-06',8,'2016-11-06',8),(731,'','bantalan stempel No 1',17,22,5550,12.50,5.00,4613,6000,216,0,1,'','','2016-11-06',8,'2016-11-06',8),(732,'','calculator Joykp CC-31',13,22,65000,12.50,5.00,54031,75000,60,0,1,'','','2016-11-06',8,'2016-11-06',8),(733,'','calculator Joyko CC-12CO',13,22,44500,12.50,5.00,36990,44500,74,0,1,'','','2016-11-06',8,'2016-11-07',9),(734,'','document bag DCB-42B4',10,22,11300,12.50,5.00,9393,12500,228,0,1,'','','2016-11-06',8,'2016-11-07',9),(735,'','school bag B-2367BT',10,22,19000,12.50,5.00,15793,22500,42,0,1,'','','2016-11-06',8,'2016-11-07',9),(736,'','pensil warna 24 joyko',15,22,18600,12.50,5.00,15461,20000,60,0,13,'','','2016-11-06',8,'2016-11-07',9),(737,'','battery LR-44',13,6,1700,0.00,0.00,1700,5000,100,0,1,'','','2016-11-06',8,'2016-11-06',8),(738,'','calculator casio dh-12',13,19,73500,0.00,0.00,73500,90000,20,0,6,'','','2016-11-07',9,'2016-11-07',9),(739,'','carbon daito ',17,6,37500,0.00,0.00,37500,45000,-2,0,10,'','','2016-11-07',9,'2016-11-07',9),(740,'','Pena G-2 0,7 Hitam (B)',16,42,138500,0.00,0.00,138500,150000,-1,0,10,'','','2016-11-07',9,'2016-11-07',9),(741,'','Isi/Refill Spidol permanent merahm (K )',17,49,6500,0.00,0.00,6500,8000,-5,0,12,'','','2016-11-07',9,'2016-11-09',8),(742,'','plasyik ID card',17,6,55000,0.00,0.00,55000,75000,0,0,10,'','','2016-11-07',9,'2016-11-07',9),(743,'','plastik ID card',17,6,55000,0.00,0.00,55000,75000,-2,0,10,'','','2016-11-07',9,'2016-11-09',9),(744,'','Pocket Sheet A4 ELA',10,6,38500,0.00,0.00,38500,60000,25,0,5,'','','2016-11-07',9,'2016-11-07',9),(745,'','Pocket Sheet F-4 ELA',10,6,40000,0.00,0.00,40000,65000,25,0,5,'','','2016-11-07',9,'2016-11-07',9),(746,'','mesin label 2 line 6600',17,6,46000,0.00,0.00,46000,75000,50,0,1,'','','2016-11-07',9,'2016-11-07',9),(747,'','pelobang kertas No 40',18,23,12500,0.00,0.00,12500,17500,120,0,1,'','','2016-11-07',9,'2016-11-07',9),(748,'','kapur tulis putih',17,6,196000,0.00,0.00,196000,300000,10,0,3,'','','2016-11-07',8,'2016-11-07',8),(749,'','kapur tulis putih ( K )',17,6,45000,0.00,0.00,4500,7000,0,0,10,'','','2016-11-07',8,NULL,NULL),(750,'','kertas casing',6,6,1700,0.00,0.00,1700,2000,500,0,14,'','','2016-11-07',8,'2016-11-07',8),(751,'','Refill Tip-ex PLUS',17,6,15000,0.00,0.00,15000,20000,-1,0,1,'','','2016-11-07',9,'2016-11-07',9),(752,'','Refill Pencil PILOT ',17,6,2166,0.00,0.00,2166,3000,-2,0,8,'','','2016-11-07',9,'2016-11-07',9),(753,'','Pena standard Quantum',16,6,58000,0.00,0.00,58000,65000,-22,0,11,'','','2016-11-07',9,'2016-11-09',9),(754,'','Tip-ex DEBOZZ',17,64,26000,0.00,0.00,26000,30000,-6,0,4,'','','2016-11-07',9,'2016-11-07',9),(755,'','Lem ALTECO',17,6,40700,0.00,0.00,40700,45000,70,0,15,'','','2016-11-07',9,'2016-11-07',8),(756,'','Lem UHU 7 ml',17,6,123750,0.00,0.00,123750,135000,-1,0,9,'','Sekotak 30 pcs','2016-11-07',9,'2016-11-07',9),(757,'','Kalkulator CIGI',17,6,10750,0.00,0.00,10750,15000,-10,0,1,'','','2016-11-07',9,'2016-11-07',9),(758,'','Buku ekspedisi 200',7,40,12000,0.00,0.00,12000,15000,-10,0,1,'','','2016-11-07',9,'2016-11-07',9),(759,'','isi staples 1217 ',18,44,13500,5.00,0.00,12825,17500,100,0,10,'','','2016-11-07',8,'2016-11-07',8),(760,'','isi staples 1220 ',18,44,27500,0.00,0.00,27500,35000,20,0,10,'','','2016-11-07',8,'2016-11-07',8),(761,'','isi staples 1224',18,44,32000,0.00,0.00,32000,45000,20,0,10,'','','2016-11-07',8,'2016-11-07',8),(762,'','isi staples No 10 MAX',18,6,31500,0.00,0.00,31500,40000,40,0,9,'','','2016-11-07',8,'2016-11-07',8),(763,'','stapler HD-50 MAX',18,6,43500,0.00,0.00,43500,55000,50,0,1,'','','2016-11-07',8,'2016-11-07',8),(764,'','garisan mika 30 cm 008-30 FZ.SF.HK',17,6,20000,20.00,0.00,16000,20000,100,0,4,'','','2016-11-07',8,'2016-11-07',8),(765,'','pensil bensia ',7,6,56000,20.00,0.00,44800,55000,30,0,9,'','','2016-11-07',8,'2016-11-07',8),(766,'','pensil 2B Nagata',17,6,56000,0.00,0.00,56000,80000,0,0,11,'','','2016-11-07',8,NULL,NULL),(767,'','pemotong lakban cadwell',17,43,12250,20.00,0.00,9800,15000,0,0,6,'','','2016-11-07',8,NULL,NULL),(768,'','lem gluevinal kecil',12,6,33600,20.00,0.00,26880,36000,-2,0,9,'','','2016-11-07',8,'2016-11-09',1),(769,'','lem gluevinal taggung',12,6,36100,20.00,0.00,28880,36000,-2,0,9,'','','2016-11-07',8,'2016-11-09',1),(770,'','lem Dlukol kecil',12,6,15350,20.00,2.50,11973,16000,-2,0,6,'','','2016-11-07',8,'2016-11-09',1),(771,'','kertas cf 9 1/2 x 11 5 ply PRS',6,38,307900,0.00,0.00,307900,350000,0,0,3,'','','2016-11-07',8,NULL,NULL),(772,'','spidol white board hitam ( K )',17,49,4800,0.00,0.00,4800,6000,-31,0,1,'','','2016-11-08',8,'2016-11-08',1),(773,'','isi staples No 3',18,44,44000,0.00,0.00,44000,50000,-1,0,9,'','','2016-11-08',8,'2016-11-08',8),(774,'','isi staples No 3 ( K )',18,44,2175,0.00,0.00,2175,3000,0,0,10,'','','2016-11-08',8,NULL,NULL),(775,'','Isi/Refill pena meja/nasabah',16,22,0,0.00,0.00,0,1500,-34,0,1,'','','2016-11-08',9,'2016-11-08',9),(776,'','Amplop coklat ukuran 1/2 Folio',17,6,0,0.00,0.00,0,25000,-4,0,5,'','','2016-11-08',9,'2016-11-09',9),(777,'','Amplop coklat 312 ',17,6,80000,0.00,0.00,80000,90000,-1,0,6,'','','2016-11-08',9,'2016-11-08',9),(778,'','Spring file ',10,6,3500,0.00,0.00,3500,5000,-46,0,1,'','','2016-11-08',9,'2016-11-09',9),(779,'','spidol twin pen',16,49,144925,0.00,0.00,144925,170000,1,0,11,'','','2016-11-08',8,'2016-11-08',8),(780,'','spidol twin pen ( K )',16,49,12500,0.00,0.00,12500,15000,0,0,11,'','','2016-11-08',8,NULL,NULL),(781,'','spidol twin pen ( K )',16,49,12500,0.00,0.00,12500,15000,0,0,4,'','','2016-11-08',8,NULL,NULL),(782,'','spidol Jumbo',16,49,138958,0.00,0.00,138958,160000,3,0,4,'','','2016-11-08',8,'2016-11-08',8),(783,'','spidol Jumbo J-500',16,49,12000,0.00,0.00,12000,15000,0,0,1,'','','2016-11-08',8,NULL,NULL),(784,'','spidol OPF',16,49,58823,0.00,0.00,58823,70000,33,0,4,'','','2016-11-08',8,'2016-11-08',8),(785,'','spidol OPM',16,49,58823,0.00,0.00,58823,70000,12,0,4,'','','2016-11-08',8,'2016-11-08',8),(786,'','spidol OPM',16,49,58823,0.00,0.00,58823,70000,0,0,4,'','','2016-11-08',8,NULL,NULL),(787,'','Pena V-5',16,49,238700,0.00,0.00,238700,264000,12,0,11,'','','2016-11-08',8,'2016-11-08',8),(788,'','Pena V-5 ( K )',16,49,19900,0.00,0.00,19900,24000,0,0,4,'','','2016-11-08',8,NULL,NULL),(789,'','Double Tape 2\" (K)',12,22,0,0.00,0.00,0,12000,-12,0,7,'','','2016-11-08',1,'2016-11-08',1),(790,'','Staper HS-10 Y',18,44,9000,0.00,0.00,9000,12500,0,0,1,'','','2016-11-08',8,NULL,NULL),(791,'','stapler HS-10 Y',18,44,9000,0.00,0.00,9000,12500,-11,0,1,'','','2016-11-08',8,'2016-11-09',1),(792,'','Printable Id Card',6,6,0,0.00,0.00,0,45000,-1,0,5,'','','2016-11-08',1,'2016-11-10',1),(793,'','Pena Hi-Tec 0.3 Biru',16,42,187000,0.00,0.00,187000,200000,36,0,4,'','','2016-11-08',8,'2016-11-08',8),(794,'','refill hi-tec',16,42,122500,0.00,0.00,122500,135000,24,0,4,'','','2016-11-08',8,'2016-11-08',8),(795,'','pena BPT Pilot',16,42,184000,0.00,0.00,184000,195000,24,0,11,'','','2016-11-08',8,'2016-11-08',8),(796,'','kertas cf 14 7/8\" X 11\" 2ply',6,38,340500,1.00,0.00,337095,360000,-2,0,3,'','','2016-11-08',8,'2016-11-09',9),(797,'','buku oktavo  Mirage 100',7,7,15754,10.00,0.00,14179,16500,0,0,5,'','','2016-11-08',8,'2016-11-08',8),(798,'','Pena OHP F ',16,6,65000,0.00,0.00,65000,75000,-2,0,4,'','','2016-11-09',9,'2016-11-09',9),(799,'','Kartu absensi Jambu',17,6,12000,0.00,0.00,12000,15000,-4,0,5,'','','2016-11-09',9,'2016-11-09',9),(800,'','Cutter A-300 ',17,6,3500,0.00,0.00,3500,5000,-2,0,1,'','','2016-11-09',9,'2016-11-09',9),(801,'','post it 653',12,30,4000,0.00,0.00,4000,5000,-8,0,5,'','','2016-11-09',8,'2016-11-09',9),(802,'','Spidol whiteboard hitam ',17,49,4833,0.00,0.00,4833,6000,0,0,1,'','','2016-11-09',9,NULL,NULL),(803,'','refill signo',16,6,85000,0.00,0.00,85000,100000,-1,0,4,'','','2016-11-09',8,'2016-11-09',8),(804,'','Thermal 58 x 48 ',17,6,25000,0.00,0.00,25000,35000,-1,0,5,'','','2016-11-09',9,'2016-11-09',9),(805,'','Kertas F4 70 gr ',6,18,28900,0.00,0.00,28900,29600,-10,0,2,'','','2016-11-09',9,'2016-11-09',9),(806,'','Buku tulis 38 lbr DODO ',7,6,11000,0.00,0.00,11000,13000,-1,0,5,'','','2016-11-09',9,'2016-11-09',9),(807,'','Pena Standard Quantum ( K ) ',16,6,4833,0.00,0.00,4833,10000,-2,0,4,'','','2016-11-09',9,'2016-11-09',9),(808,'','Sponge uang ',17,6,8000,0.00,0.00,8000,12000,-1,0,1,'','','2016-11-09',9,'2016-11-09',9),(809,'','Tape Dispenser Lakban plastik ',17,6,11000,0.00,0.00,11000,11000,-2,0,1,'','','2016-11-09',9,'2016-11-09',9),(810,'','Pena STANDARD TECNO hitam ( K ) ',16,24,15833,0.00,0.00,15833,18000,-3,0,4,'','','2016-11-09',9,'2016-11-09',9),(811,'','Ordner BAMBI',10,60,19000,0.00,0.00,19000,25000,-5,0,1,'','','2016-11-09',9,'2016-11-09',9),(812,'','Computer file besar ',6,6,47500,0.00,0.00,47500,60000,-5,0,1,'','','2016-11-09',9,'2016-11-09',9),(813,'','Kertas ATM Diebold ',17,6,39000,0.00,0.00,39000,60000,-2,0,7,'','','2016-11-09',9,'2016-11-09',9),(814,'','Pena Tizo Vector 30605',16,6,0,0.00,0.00,0,18000,-5,0,4,'','','2016-11-09',1,'2016-11-09',1),(815,'','Penghapus/Eraser Faber Castell Putih',17,35,0,0.00,0.00,0,64000,-1,0,9,'','','2016-11-09',1,'2016-11-09',1),(816,'','Stabillo Cadwell CD-700',15,43,15000,0.00,0.00,15000,15000,-2,0,9,'','','2016-11-09',1,'2016-11-09',1),(817,'','Peruncing Toples @2lsn',17,6,0,0.00,0.00,0,16000,-1,0,8,'','','2016-11-09',1,'2016-11-09',1),(818,'','Peruncing Teko (K)',17,6,0,0.00,0.00,0,2000,-12,0,1,'','','2016-11-09',1,'2016-11-09',1),(819,'','Lem Glukol mini',12,6,0,0.00,0.00,0,16000,0,0,9,'','','2016-11-09',1,'2016-11-09',1),(820,'','Lem Glukol tanggung',12,6,0,0.00,0.00,0,27000,0,0,9,'','','2016-11-09',1,NULL,NULL),(821,'','Buku Quarto 200',7,7,10654,0.00,0.00,10654,14000,-9,0,1,'','','2016-11-09',1,'2016-11-09',1),(822,'','Kertas Manila Emas',6,6,0,0.00,0.00,0,1000,0,0,1,'','','2016-11-09',1,NULL,NULL),(823,'','Kertas Manila Silver',6,6,0,0.00,0.00,0,1000,-20,0,1,'','','2016-11-09',1,'2016-11-09',1),(824,'','Kertas ManilaBiru',6,6,0,0.00,0.00,0,1000,-20,0,1,'','','2016-11-09',1,'2016-11-09',1),(825,'','Kertas Manila Hijau',6,6,0,0.00,0.00,0,1000,-20,0,1,'','','2016-11-09',1,'2016-11-09',1),(826,'','Kertas Manila Merah',6,6,0,0.00,0.00,0,1000,-20,0,1,'','','2016-11-09',1,'2016-11-09',1),(827,'','Map Tas Jaring',10,6,0,0.00,0.00,0,108000,-1,0,4,'','','2016-11-09',1,'2016-11-09',1),(828,'','Map Tas Kancing',10,6,0,0.00,0.00,0,120000,-1,0,4,'','','2016-11-09',1,'2016-11-09',1),(829,'','Pena snowman V3 biru',16,49,0,0.00,0.00,0,20000,-6,0,4,'','','2016-11-09',1,'2016-11-09',1),(830,'','Correction Tape Debozz Mini (K)',17,64,0,0.00,0.00,0,6000,0,0,1,'','','2016-11-09',1,NULL,NULL),(831,'','Correction Tape Debozz Mini (B)',17,64,0,0.00,0.00,0,35000,-1,0,4,'','','2016-11-09',1,'2016-11-09',1),(832,'','Kuas Cat Air (SET)',17,6,0,0.00,0.00,0,15000,-1,0,5,'','','2016-11-09',1,'2016-11-09',1),(833,'','KOTAK PENSIL KALKULATOR',17,6,0,0.00,0.00,0,15000,-12,0,1,'','','2016-11-09',1,'2016-11-09',1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_brand`
--

DROP TABLE IF EXISTS `product_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_brand` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(24) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_brand`
--

LOCK TABLES `product_brand` WRITE;
/*!40000 ALTER TABLE `product_brand` DISABLE KEYS */;
INSERT INTO `product_brand` VALUES (6,'-'),(30,'3 M'),(12,'Amanda '),(60,'Bambi '),(47,'BANTEX'),(46,'Benex '),(40,'Bintang Obor '),(10,'Bio '),(45,'Blueprint '),(57,'Boss'),(43,'Cadwell'),(66,'CANON'),(19,'CASIO '),(20,'CITIZEN '),(70,'Combo'),(53,'Data Plus'),(64,'Debozz'),(17,'Dodo'),(11,'E-print '),(74,'Eagle'),(61,'EPSON'),(69,'ESCO'),(35,'Faber Castell'),(33,'Fancy '),(54,'Folder One '),(52,'Fujita'),(25,'FULLMARK '),(55,'GARDA'),(72,'GOBI'),(31,'Gold Tape '),(8,'GOLDEN COIN '),(38,'GOLDEN FORM '),(34,'Greebel'),(15,'GT-PRO '),(26,'Hologram'),(71,'Hombo'),(67,'HP'),(22,'JOYKO '),(44,'Kangaro '),(65,'KAYAGI'),(39,'KENKO'),(59,'Kiky'),(14,'Mark Print '),(7,'MIRAGE '),(16,'Nachi '),(18,'Natural'),(27,'NICE'),(68,'Office Print'),(32,'Paperline '),(58,'PaperOne'),(36,'Pelikan'),(42,'Pilot '),(28,'SAKATO '),(37,'Sinar Dunia '),(63,'Sinar Dunia / Paperline'),(50,'SKS'),(49,'SNOWMAN'),(24,'Standard '),(21,'TARGET'),(13,'Therecia '),(51,'TOHO'),(41,'Tom & Jerry '),(62,'Toshiba'),(9,'V-gen '),(48,'V-Tec'),(73,'Vertex'),(56,'VOLTA'),(29,'Yamura '),(23,'Yoeker ');
/*!40000 ALTER TABLE `product_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(24) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES (6,'Kertas '),(7,'Buku '),(8,'Tali '),(9,'Plastik '),(10,'Folder File '),(11,'Computer '),(12,'Perekat '),(13,'Electronic '),(14,'Clip '),(15,'Pewarna '),(16,'Pena '),(17,'Macam Macam '),(18,'Stapler');
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_history`
--

DROP TABLE IF EXISTS `product_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(13) DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `quantity` double(7,2) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `fk-sh-product-01` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-sh-user-01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-sh-user-02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_history`
--

LOCK TABLES `product_history` WRITE;
/*!40000 ALTER TABLE `product_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_unit`
--

DROP TABLE IF EXISTS `product_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_unit` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(24) NOT NULL,
  `code` char(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_unit`
--

LOCK TABLES `product_unit` WRITE;
/*!40000 ALTER TABLE `product_unit` DISABLE KEYS */;
INSERT INTO `product_unit` VALUES (1,'Pieces','PCs'),(2,'rim ','rim'),(3,'dus ','dus'),(4,'lusin','lsn'),(5,'pack','pak'),(6,'ball','ball'),(7,'Roll ','roll'),(8,'tabung','tbg'),(9,'box','box'),(10,'kotak','ktk'),(11,'gross','gros'),(12,'botol','btl'),(13,'set','set'),(14,'lembar',''),(15,'keping','kpg');
/*!40000 ALTER TABLE `product_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `province` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(28) NOT NULL,
  `capital` varchar(24) NOT NULL,
  `iso_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iso_code` (`iso_code`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES (1,'Aceh','Banda Aceh','ID_AC'),(2,'Bali','Denpasar','ID_BA'),(3,'Banten','Serang','ID_BT'),(4,'Bengkulu','Bengkulu','ID_BE'),(5,'Gorontalo','Gorontalo','ID_GO'),(6,'Jakarta','Jakarta','ID_JK'),(7,'Jambi','Jambi','ID_JA'),(8,'Jawa Barat','Bandung','ID_JB'),(9,'Jawa Tengah','Semarang','ID_JT'),(10,'Jawa Timur','Surabaya','ID_JI'),(11,'Kalimantan Barat','Pontianak','ID_KB'),(12,'Kalimantan Selatan','Banjarmasin','ID_KS'),(13,'Kalimantan Tengah','Palangkaraya','ID_KT'),(14,'Kalimantan Timur','Samarinda','ID_KI'),(15,'Kalimantan Utara','Tanjung Selor','ID_KU'),(16,'Kepulauan Bangka Belitung','Pangkal Pinang','ID_BB'),(17,'Kepulauan Riau','Pangkal Pinang','ID_KR'),(18,'Lampung','Bandar Lampung','ID_LA'),(19,'Maluku','Ambon','ID_MA'),(20,'Maluku Utara','Sofifi','ID_MU'),(21,'Nusa Tenggara Barat','Mataram','ID_NB'),(22,'Nusa Tenggara Timur','Kupang','ID_NT'),(23,'Papua','Jayapura','ID_PA'),(24,'Papua Barat','Manokrawi','ID_PB'),(25,'Riau','Pekanbaru','ID_RI'),(26,'Sulawesi Barat','Mamuju','ID_SR'),(27,'Sulawesi Selatan','Makassar','ID_SN'),(28,'Sulawesi Tengah','Palu','ID_ST'),(29,'Sulawesi Tenggara','Kendari','ID_SG'),(30,'Sulawesi Utara','Manado','ID_SA'),(31,'Sumatera Barat','Padang','ID_SB'),(32,'Sumatera Selatan','Palembang','ID_SS'),(33,'Sumatera Utara','Medan','ID_SU'),(34,'Yogyakarta','Yogyakarta','ID_YO');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_order`
--

DROP TABLE IF EXISTS `purchase_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(13) NOT NULL,
  `supplier_id` smallint(5) unsigned DEFAULT NULL,
  `receipt_id` int(10) unsigned DEFAULT NULL,
  `term_of_payment_id` tinyint(3) DEFAULT NULL,
  `tax_id` tinyint(3) unsigned DEFAULT NULL,
  `tax_no` varchar(24) DEFAULT NULL,
  `other_costs` int(10) unsigned NOT NULL DEFAULT '0',
  `include_ppn` char(1) NOT NULL DEFAULT 'N',
  `ppn` decimal(4,2) NOT NULL DEFAULT '0.00',
  `discount` double(5,2) NOT NULL,
  `total` double(11,2) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'O' COMMENT 'O=open;L=locked;S=settled',
  `printed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `payment_id` (`receipt_id`),
  KEY `tax_id` (`tax_id`),
  KEY `term_of_payment_id` (`term_of_payment_id`),
  CONSTRAINT `fk-purch-receipt-01` FOREIGN KEY (`receipt_id`) REFERENCES `purchase_receipt` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-purch-suppl-01` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-purch-user-01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-purch-user-02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-purhc-tax-01` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_order`
--

LOCK TABLES `purchase_order` WRITE;
/*!40000 ALTER TABLE `purchase_order` DISABLE KEYS */;
INSERT INTO `purchase_order` VALUES (5,'PO161101-sssc',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,6092350.00,'O',0,'2016-11-01','2016-11-01',1,'2016-11-01',1),(6,'PO161103-sssc',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,12667558.00,'O',0,'2016-11-03','2016-11-03',1,'2016-11-03',1),(7,'PO161103-sssh',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,5880412.00,'O',0,'2016-11-03','2016-11-03',1,'2016-11-03',1),(8,'PO161103-sssa',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,6092350.00,'O',0,'2016-11-03','2016-11-03',1,'2016-11-03',1),(9,'PO161103-sssn',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,4128043.00,'O',0,'2016-11-03','2016-11-03',1,'2016-11-03',1),(10,'PO161103-sssd',27,NULL,30,NULL,NULL,0,'N',0.00,0.00,5400000.00,'O',0,'2016-11-03','2016-11-03',1,'2016-11-03',1),(11,'PO161103-sssr',5,NULL,30,NULL,NULL,0,'N',0.00,0.00,5280000.00,'O',0,'2016-11-03','2016-11-03',1,'2016-11-03',1),(12,'PO161103-sssi',9,NULL,30,NULL,NULL,0,'N',0.00,0.00,6175000.00,'O',0,'2016-11-03','2016-11-03',1,'2016-11-03',1),(13,'PO161103-sssk',26,NULL,30,NULL,NULL,0,'N',0.00,0.00,12905000.00,'O',0,'2016-11-03','2016-11-03',1,'2016-11-03',1),(14,'PO161103-sssu',48,NULL,7,NULL,NULL,0,'N',0.00,0.00,622321.00,'O',0,'2016-11-03','2016-11-03',1,'2016-11-03',1),(15,'PO161103-sscs',6,NULL,30,NULL,NULL,0,'N',0.00,0.00,12000000.00,'O',0,'2016-11-03','2016-11-03',1,'2016-11-03',1),(16,'PO161104-sssc',27,NULL,30,NULL,NULL,0,'N',0.00,0.00,5900000.00,'O',0,'2016-11-04','2016-11-04',1,'2016-11-04',1),(17,'PO161104-sssh',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,10872675.00,'O',0,'2016-11-04','2016-11-04',1,'2016-11-04',1),(18,'PO161105-sssc',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,13383125.00,'O',0,'2016-11-05','2016-11-05',1,'2016-11-05',1),(19,'PO161105-sssh',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,6366038.00,'O',0,'2016-11-05','2016-11-05',1,'2016-11-05',1),(20,'PO161105-sssa',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,9412205.00,'O',0,'2016-11-05','2016-11-05',1,'2016-11-05',1),(21,'PO161106-sssc',42,NULL,30,NULL,NULL,0,'N',0.00,0.00,5750000.00,'O',0,'2016-11-06','2016-11-06',8,'2016-11-06',8),(22,'PO161106-sssh',22,NULL,30,NULL,NULL,0,'N',0.00,0.00,5400000.00,'O',0,'2016-11-06','2016-11-06',8,'2016-11-06',8),(25,'PO161106-sssa',5,NULL,30,NULL,NULL,0,'N',0.00,0.00,7312500.00,'O',0,'2016-11-06','2016-11-06',8,'2016-11-06',8),(26,'PO161106-sssn',15,NULL,30,NULL,NULL,0,'N',0.00,0.00,4125660.00,'O',0,'2016-11-06','2016-11-06',8,'2016-11-06',8),(27,'PO161106-sssd',15,NULL,30,NULL,NULL,0,'N',0.00,0.00,3299065.00,'O',0,'2016-11-06','2016-11-06',8,'2016-11-06',8),(28,'PO161106-sssr',39,NULL,30,NULL,NULL,0,'N',0.00,0.00,6201125.00,'O',0,'2016-11-06','2016-11-06',8,'2016-11-06',8),(29,'PO161106-sssi',10,NULL,30,NULL,NULL,0,'N',0.00,0.00,5707000.00,'O',0,'2016-11-06','2016-11-06',8,'2016-11-06',8),(30,'PO161107-sssc',10,NULL,30,NULL,NULL,0,'N',0.00,0.00,4730000.00,'O',0,'2016-11-07','2016-11-07',9,'2016-11-07',9),(31,'PO161107-sssh',20,NULL,30,NULL,NULL,0,'N',0.00,0.00,3400000.00,'O',0,'2016-11-07','2016-11-07',9,'2016-11-07',9),(32,'PO161107-sssa',54,NULL,60,NULL,NULL,0,'N',0.00,0.00,1962500.00,'O',0,'2016-11-07','2016-11-07',9,'2016-11-07',9),(33,'PO161107-sssn',11,NULL,30,NULL,NULL,0,'N',0.00,0.00,15075000.00,'O',0,'2016-11-07','2016-11-07',9,'2016-11-07',9),(34,'PO161107-sssd',21,NULL,30,NULL,NULL,0,'N',0.00,0.00,8253000.00,'O',0,'2016-11-07','2016-11-07',9,'2016-11-07',9),(35,'PO161107-sssr',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,9138525.00,'O',0,'2016-11-07','2016-11-07',8,'2016-11-07',8),(36,'PO161107-sssi',45,NULL,14,NULL,NULL,0,'N',0.00,0.00,850000.00,'O',0,'2016-11-07','2016-11-07',8,'2016-11-07',8),(37,'PO161107-sssk',42,NULL,30,NULL,NULL,0,'N',0.00,0.00,6160000.00,'O',0,'2016-11-07','2016-11-07',8,'2016-11-07',8),(38,'PO161107-sssu',26,NULL,30,NULL,NULL,0,'N',0.00,0.00,19908800.00,'O',0,'2016-11-07','2016-11-07',8,'2016-11-07',8),(39,'PO161107-sscs',12,NULL,30,NULL,NULL,0,'N',0.00,0.00,8593400.00,'O',0,'2016-11-07','2016-11-07',8,'2016-11-07',8),(40,'PO161107-sscc',25,NULL,30,NULL,NULL,0,'N',0.00,0.00,8436320.00,'O',0,'2016-11-07','2016-11-07',8,'2016-11-07',8),(41,'PO161108-sssc',32,NULL,30,NULL,NULL,0,'N',0.00,0.00,48967600.00,'O',0,'2016-11-08','2016-11-08',8,'2016-11-08',8),(42,'PO161108-sssh',36,NULL,30,NULL,NULL,0,'N',0.00,0.00,5049000.00,'O',0,'2016-11-08','2016-11-08',8,'2016-11-08',8),(43,'PO161108-sssa',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,5436338.00,'O',0,'2016-11-08','2016-11-08',8,'2016-11-08',8),(44,'PO161108-sssn',24,NULL,7,NULL,NULL,0,'N',0.00,0.00,14088000.00,'S',0,'2016-11-08','2016-11-08',8,'2016-11-09',8),(45,'PO161109-sssc',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,4766644.00,'O',0,'2016-11-09','2016-11-09',8,'2016-11-09',8),(46,'PO161109-sssh',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,1672298.00,'O',0,'2016-11-09','2016-11-09',8,'2016-11-09',8),(47,'PO161109-sssa',34,NULL,30,NULL,NULL,0,'N',0.00,0.00,956156.00,'O',0,'2016-11-09','2016-11-09',8,'2016-11-09',8),(50,'PO161109-sssn',3,NULL,30,NULL,NULL,0,'N',0.00,0.00,422202.00,'O',0,'2016-11-09','2016-11-09',8,'2016-11-09',8);
/*!40000 ALTER TABLE `purchase_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_order_detail`
--

DROP TABLE IF EXISTS `purchase_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_order_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `pricelist` int(10) unsigned NOT NULL DEFAULT '0',
  `disc1` decimal(4,2) NOT NULL DEFAULT '0.00',
  `disc2` decimal(4,2) NOT NULL DEFAULT '0.00',
  `price` int(10) unsigned NOT NULL,
  `quantity` double(7,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `purchase_id` (`order_id`),
  CONSTRAINT `fk-pod-po-01` FOREIGN KEY (`order_id`) REFERENCES `purchase_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-pod-product-01` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_order_detail`
--

LOCK TABLES `purchase_order_detail` WRITE;
/*!40000 ALTER TABLE `purchase_order_detail` DISABLE KEYS */;
INSERT INTO `purchase_order_detail` VALUES (3,5,488,32065,5.00,0.00,30462,200.00),(4,6,8,28175,5.00,0.00,26766,300.00),(5,6,488,32065,5.00,0.00,30462,100.00),(6,6,12,30300,4.50,0.00,28937,55.00),(7,7,12,30300,4.50,0.00,28937,165.00),(8,7,343,46320,4.50,0.00,44236,25.00),(9,8,488,32065,5.00,0.00,30462,200.00),(11,10,670,27000,0.00,0.00,27000,50.00),(12,10,671,27000,0.00,0.00,27000,50.00),(13,10,672,27000,0.00,0.00,27000,50.00),(14,10,673,27000,0.00,0.00,27000,50.00),(16,9,101,208487,1.00,0.00,206402,20.00),(17,11,14,44000,0.00,0.00,44000,120.00),(18,12,22,12500,0.00,0.00,12500,494.00),(19,13,676,12250,20.00,0.00,9800,500.00),(20,13,677,13250,20.00,0.00,10600,250.00),(21,13,678,52500,15.00,0.00,44625,120.00),(22,14,685,8645,0.00,0.00,8645,72.00),(23,15,92,24000,0.00,0.00,24000,500.00),(24,16,622,175000,0.00,0.00,175000,12.00),(25,16,623,225000,0.00,0.00,225000,12.00),(26,16,369,110000,0.00,0.00,110000,10.00),(27,17,11,32947,0.00,0.00,32947,330.00),(28,18,8,28175,5.00,0.00,26766,500.00),(29,19,12,30300,4.50,0.00,28937,220.00),(30,20,488,32065,5.00,0.00,30462,100.00),(31,20,12,30300,4.50,0.00,28937,220.00),(32,21,712,11500,0.00,0.00,11500,500.00),(33,22,713,600000,25.00,0.00,450000,12.00),(36,25,680,17500,0.00,0.00,17500,270.00),(37,25,41,17250,0.00,0.00,17250,150.00),(38,26,736,18600,12.50,5.00,15461,72.00),(39,26,734,11300,12.50,5.00,9393,240.00),(40,26,735,19000,12.50,5.00,15794,48.00),(41,27,729,5600,12.50,5.00,4655,200.00),(42,27,731,5550,12.50,5.00,4613,216.00),(43,27,730,16500,12.50,5.00,13716,100.00),(44,28,732,65000,12.50,5.00,54031,60.00),(45,28,733,44500,12.50,5.00,36991,80.00),(46,29,78,91000,40.00,8.00,50232,20.00),(47,29,29,461000,40.00,8.00,254472,5.00),(48,29,30,81500,0.00,0.00,81500,40.00),(49,29,737,1700,0.00,0.00,1700,100.00),(50,30,738,73500,0.00,0.00,73500,20.00),(51,30,30,81500,0.00,0.00,81500,40.00),(52,31,115,3400,0.00,0.00,3400,1000.00),(53,32,744,38500,0.00,0.00,38500,25.00),(54,32,745,40000,0.00,0.00,40000,25.00),(60,34,607,8925,0.00,0.00,8925,480.00),(61,34,598,16538,0.00,0.00,16538,240.00),(62,33,33,7250,0.00,0.00,7250,300.00),(63,33,642,2900,0.00,0.00,2900,2500.00),(64,33,746,46000,0.00,0.00,46000,50.00),(65,33,647,3700,0.00,0.00,3700,500.00),(66,33,747,12500,0.00,0.00,12500,120.00),(67,35,488,32065,5.00,0.00,30462,300.00),(68,36,750,1700,0.00,0.00,1700,500.00),(69,37,748,196000,0.00,0.00,196000,10.00),(70,37,536,17500,0.00,0.00,17500,240.00),(71,38,759,13500,5.00,0.00,12825,100.00),(72,38,760,27500,0.00,0.00,27500,20.00),(73,38,761,32000,0.00,0.00,32000,20.00),(74,38,132,23000,5.00,5.00,20758,840.00),(75,39,60,11605,0.00,0.00,11605,192.00),(76,39,762,31500,0.00,0.00,31500,40.00),(77,39,763,43500,0.00,0.00,43500,50.00),(78,39,755,40700,0.00,0.00,40700,72.00),(79,40,415,57120,0.00,0.00,57120,36.00),(80,40,576,21575,20.00,0.00,17260,40.00),(81,40,440,28600,20.00,0.00,22880,120.00),(82,40,764,20000,20.00,0.00,16000,100.00),(83,40,765,56000,20.00,0.00,44800,30.00),(84,41,473,58396,0.00,0.00,58396,360.00),(85,41,471,49445,0.00,0.00,49445,420.00),(86,41,582,92070,0.00,0.00,92070,12.00),(87,41,779,144925,0.00,0.00,144925,1.00),(88,41,782,138958,0.00,0.00,138958,3.00),(89,41,784,58823,0.00,0.00,58823,33.00),(90,41,785,58823,0.00,0.00,58823,12.00),(91,41,787,238700,0.00,0.00,238700,12.00),(92,42,225,4125,0.00,0.00,4125,800.00),(93,42,227,14575,0.00,0.00,14575,120.00),(94,43,11,32947,0.00,0.00,32947,165.00),(95,44,793,187000,0.00,0.00,187000,36.00),(96,44,795,184000,0.00,0.00,184000,24.00),(97,44,794,122500,0.00,0.00,122500,24.00),(98,45,96,30250,4.50,0.00,28889,165.00),(100,46,557,337838,1.00,0.00,334460,5.00),(101,47,718,516841,7.50,0.00,478078,2.00),(102,50,98,213233,1.00,0.00,211101,2.00);
/*!40000 ALTER TABLE `purchase_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_payment`
--

DROP TABLE IF EXISTS `purchase_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `invoice_no` varchar(13) DEFAULT NULL,
  `debet` smallint(5) unsigned DEFAULT NULL,
  `credit` smallint(5) unsigned DEFAULT NULL,
  `amount` int(10) unsigned NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `debet` (`debet`),
  KEY `credit` (`credit`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `fk-pp-acc-cr` FOREIGN KEY (`credit`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-pp-acc-dr` FOREIGN KEY (`debet`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-pp-po-01` FOREIGN KEY (`order_id`) REFERENCES `purchase_order` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-pp-user-01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-pp-user-02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_payment`
--

LOCK TABLES `purchase_payment` WRITE;
/*!40000 ALTER TABLE `purchase_payment` DISABLE KEYS */;
INSERT INTO `purchase_payment` VALUES (2,44,'PP161109-sssc',NULL,3,14088000,'','2016-11-09','2016-11-09',8,NULL,NULL);
/*!40000 ALTER TABLE `purchase_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_receipt`
--

DROP TABLE IF EXISTS `purchase_receipt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_receipt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(13) DEFAULT NULL,
  `supplier_id` smallint(5) unsigned DEFAULT NULL,
  `total` int(10) NOT NULL,
  `printed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `fk_pr_supplier_01` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_pr_user_01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_pr_user_02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_receipt`
--

LOCK TABLES `purchase_receipt` WRITE;
/*!40000 ALTER TABLE `purchase_receipt` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_receipt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_return`
--

DROP TABLE IF EXISTS `purchase_return`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_return` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(13) NOT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `print` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0: waiting for approval, 1: approved',
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `fk-pr-po-01` FOREIGN KEY (`order_id`) REFERENCES `purchase_order` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-pr-user-01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-pr-user-02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_return`
--

LOCK TABLES `purchase_return` WRITE;
/*!40000 ALTER TABLE `purchase_return` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_return` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_return_detail`
--

DROP TABLE IF EXISTS `purchase_return_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_return_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `return_id` int(10) unsigned DEFAULT NULL,
  `order_detail_id` int(10) unsigned DEFAULT NULL,
  `quantity` double(7,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `return_id` (`return_id`),
  KEY `order_detail_id` (`order_detail_id`),
  CONSTRAINT `fk-prd-pod-01` FOREIGN KEY (`order_detail_id`) REFERENCES `purchase_order_detail` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-prd-pr-01` FOREIGN KEY (`return_id`) REFERENCES `purchase_return` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_return_detail`
--

LOCK TABLES `purchase_return_detail` WRITE;
/*!40000 ALTER TABLE `purchase_return_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_return_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(8) NOT NULL,
  `name` varchar(48) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'ADM','ADMINISTRATOR'),(2,'OWN','Owner'),(3,'ACC','Accounting'),(4,'FINANCE','Finance'),(5,'SLA','Sales Admin'),(6,'OB','Office Boy'),(7,'BM','Branch Manager');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_order`
--

DROP TABLE IF EXISTS `sale_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_no` varchar(32) DEFAULT NULL,
  `invoice_no` varchar(13) NOT NULL,
  `customer_id` smallint(5) unsigned DEFAULT NULL,
  `receipt_id` int(10) unsigned DEFAULT NULL,
  `term_of_payment_id` tinyint(3) DEFAULT NULL,
  `tax_id` tinyint(3) unsigned DEFAULT NULL,
  `tax_no` varchar(24) DEFAULT NULL,
  `other_costs` int(10) unsigned NOT NULL DEFAULT '0',
  `include_ppn` char(1) NOT NULL DEFAULT 'N',
  `ppn` decimal(4,2) NOT NULL DEFAULT '0.00',
  `discount` double(5,2) NOT NULL,
  `total` double(11,2) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'O' COMMENT 'O=Open;L=locked;S=settled',
  `printed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `payment_id` (`receipt_id`),
  KEY `tax_id` (`tax_id`),
  KEY `term_of_payment_id` (`term_of_payment_id`),
  CONSTRAINT `fk-so-cust-01` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-so-receipt-01` FOREIGN KEY (`receipt_id`) REFERENCES `sale_receipt` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-so-tax-01` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-so-user-01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-so-user-02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_order`
--

LOCK TABLES `sale_order` WRITE;
/*!40000 ALTER TABLE `sale_order` DISABLE KEYS */;
INSERT INTO `sale_order` VALUES (2,NULL,'SO161031-sssc',164,NULL,30,NULL,NULL,0,'N',0.00,0.00,1327000.00,'O',3,'2016-10-31','2016-10-31',1,'2016-10-31',1),(3,NULL,'SO161031-sssh',232,NULL,30,NULL,NULL,0,'N',0.00,0.00,1472000.00,'O',1,'2016-10-31','2016-10-31',1,'2016-10-31',1),(4,NULL,'SO161031-sssa',233,NULL,30,NULL,NULL,0,'N',0.00,0.00,575000.00,'S',1,'2016-10-31','2016-10-31',1,'2016-10-31',1),(5,NULL,'SO161031-sssn',234,NULL,7,NULL,NULL,0,'N',0.00,0.00,2302500.00,'S',7,'2016-10-31','2016-10-31',1,'2016-11-01',1),(7,NULL,'SO161101-sssc',25,NULL,30,NULL,NULL,0,'N',0.00,0.00,1351500.00,'O',1,'2016-11-01','2016-11-01',1,'2016-11-01',1),(8,NULL,'SO161101-sssh',126,NULL,30,NULL,NULL,0,'N',0.00,0.00,1187000.00,'O',1,'2016-11-01','2016-11-01',1,'2016-11-01',1),(9,NULL,'SO161101-sssa',92,NULL,30,NULL,NULL,0,'N',0.00,0.00,592000.00,'O',1,'2016-11-01','2016-11-01',1,'2016-11-01',1),(10,NULL,'SO161102-sssc',235,NULL,0,NULL,NULL,0,'N',0.00,0.00,1790500.00,'S',1,'2016-11-02','2016-11-02',1,'2016-11-02',1),(11,NULL,'SO161103-sssc',148,NULL,30,NULL,NULL,0,'N',0.00,0.00,1013000.00,'O',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(12,NULL,'SO161103-sssh',237,NULL,30,NULL,NULL,0,'N',0.00,0.00,500500.00,'S',1,'2016-11-03','2016-11-03',1,'2016-11-08',8),(13,NULL,'SO161103-sssa',236,NULL,30,NULL,NULL,0,'N',0.00,0.00,744250.00,'S',1,'2016-11-03','2016-11-03',1,'2016-11-08',8),(14,NULL,'SO161103-sssn',4,NULL,0,NULL,NULL,0,'N',0.00,0.00,210000.00,'S',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(15,NULL,'SO161103-sssd',207,NULL,30,NULL,NULL,0,'N',0.00,0.00,550000.00,'S',1,'2016-11-03','2016-11-03',1,'2016-11-08',8),(16,NULL,'SO161103-sssr',42,NULL,30,NULL,NULL,0,'N',0.00,0.00,468000.00,'S',1,'2016-11-03','2016-11-03',1,'2016-11-08',8),(17,NULL,'SO161103-sssi',238,NULL,30,NULL,NULL,0,'N',0.00,0.00,135000.00,'O',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(18,NULL,'SO161103-sssk',39,NULL,30,NULL,NULL,0,'N',0.00,0.00,165000.00,'S',1,'2016-11-03','2016-11-03',1,'2016-11-08',8),(20,NULL,'SO161103-sscs',67,NULL,7,NULL,NULL,0,'N',0.00,0.00,290000.00,'O',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(21,NULL,'SO161103-sscc',141,NULL,30,NULL,NULL,0,'N',0.00,0.00,864000.00,'O',2,'2016-11-03','2016-11-03',1,'2016-11-03',1),(22,NULL,'SO161103-ssch',84,NULL,30,NULL,NULL,0,'N',0.00,0.00,284000.00,'O',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(23,NULL,'SO161103-ssca',239,NULL,30,NULL,NULL,0,'N',0.00,0.00,300000.00,'O',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(24,NULL,'SO161103-sscn',72,NULL,30,NULL,NULL,0,'N',0.00,0.00,277500.00,'O',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(25,NULL,'SO161103-sscd',85,NULL,30,NULL,NULL,0,'N',0.00,0.00,60000.00,'O',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(26,NULL,'SO161103-sscr',51,NULL,30,NULL,NULL,0,'N',0.00,0.00,1843000.00,'O',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(27,NULL,'SO161103-ssci',148,NULL,30,NULL,NULL,0,'N',0.00,0.00,95000.00,'O',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(28,NULL,'SO161103-ssck',240,NULL,0,NULL,NULL,0,'N',0.00,0.00,1900000.00,'S',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(29,NULL,'SO161103-sscu',131,NULL,30,NULL,NULL,0,'N',0.00,0.00,154500.00,'O',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(30,NULL,'SO161103-sshs',131,NULL,30,NULL,NULL,0,'N',0.00,0.00,126000.00,'O',1,'2016-11-03','2016-11-03',1,'2016-11-03',1),(31,NULL,'SO161104-sssc',241,NULL,30,NULL,NULL,0,'N',0.00,0.00,300000.00,'O',1,'2016-11-04','2016-11-04',1,'2016-11-04',1),(32,NULL,'SO161104-sssh',242,NULL,30,NULL,NULL,0,'N',0.00,0.00,790000.00,'O',1,'2016-11-04','2016-11-04',1,'2016-11-04',1),(33,NULL,'SO161104-sssa',67,NULL,7,NULL,NULL,0,'N',0.00,0.00,425000.00,'O',1,'2016-11-04','2016-11-04',1,'2016-11-04',1),(34,NULL,'SO161104-sssn',80,NULL,30,NULL,NULL,0,'N',0.00,0.00,210000.00,'O',1,'2016-11-04','2016-11-04',1,'2016-11-04',1),(35,NULL,'SO161104-sssd',4,NULL,0,NULL,NULL,0,'N',0.00,0.00,20000.00,'S',1,'2016-11-04','2016-11-04',1,'2016-11-04',1),(36,NULL,'SO161104-sssr',79,NULL,30,NULL,NULL,0,'N',0.00,0.00,181000.00,'O',1,'2016-11-04','2016-11-04',1,'2016-11-04',1),(37,NULL,'SO161104-sssi',191,NULL,30,NULL,NULL,0,'N',0.00,0.00,165000.00,'S',1,'2016-11-04','2016-11-04',1,'2016-11-08',8),(38,NULL,'SO161104-sssk',243,NULL,0,NULL,NULL,0,'N',0.00,0.00,300000.00,'S',1,'2016-11-04','2016-11-04',1,'2016-11-04',1),(40,NULL,'SO161104-sscs',197,NULL,30,NULL,NULL,0,'N',0.00,0.00,1700000.00,'S',1,'2016-11-04','2016-11-04',1,'2016-11-05',1),(41,NULL,'SO161104-sscc',51,NULL,30,NULL,NULL,0,'N',0.00,0.00,45000.00,'O',1,'2016-11-04','2016-11-04',1,'2016-11-04',1),(43,NULL,'SO161104-ssca',247,NULL,30,NULL,NULL,0,'N',0.00,0.00,488000.00,'O',2,'2016-11-04','2016-11-04',1,'2016-11-04',1),(44,NULL,'SO161104-sscn',54,NULL,30,NULL,NULL,0,'N',0.00,0.00,190000.00,'S',1,'2016-11-04','2016-11-04',1,'2016-11-08',8),(45,NULL,'SO161104-sscd',181,NULL,30,NULL,NULL,0,'N',0.00,0.00,125000.00,'S',1,'2016-11-04','2016-11-04',1,'2016-11-05',1),(46,NULL,'SO161104-sscr',235,NULL,30,NULL,NULL,0,'N',0.00,0.00,1825500.00,'O',2,'2016-11-04','2016-11-04',1,'2016-11-04',1),(47,NULL,'SO161104-ssci',88,NULL,30,NULL,NULL,0,'N',0.00,0.00,575000.00,'O',1,'2016-11-04','2016-11-04',1,'2016-11-04',1),(48,NULL,'SO161104-ssck',92,NULL,30,NULL,NULL,0,'N',0.00,0.00,750000.00,'O',1,'2016-11-04','2016-11-04',1,'2016-11-04',1),(49,NULL,'SO161104-sscu',48,NULL,30,NULL,NULL,0,'N',0.00,0.00,102500.00,'O',1,'2016-11-04','2016-11-04',1,'2016-11-04',1),(51,NULL,'SO161104-sshc',154,NULL,30,NULL,NULL,0,'N',0.00,0.00,1041000.00,'S',1,'2016-11-04','2016-11-04',1,'2016-11-08',8),(52,NULL,'SO161105-sssc',61,NULL,30,NULL,NULL,0,'N',0.00,0.00,1439000.00,'O',1,'2016-11-05','2016-11-05',1,'2016-11-05',1),(54,NULL,'SO161105-sssa',249,NULL,30,NULL,NULL,0,'N',0.00,0.00,60000.00,'O',3,'2016-11-05','2016-11-05',1,'2016-11-05',1),(55,NULL,'SO161105-sssn',250,NULL,30,NULL,NULL,0,'N',0.00,0.00,67000.00,'O',1,'2016-11-05','2016-11-05',1,'2016-11-05',1),(56,NULL,'SO161105-sssd',251,NULL,30,NULL,NULL,0,'N',0.00,0.00,40000.00,'O',1,'2016-11-05','2016-11-05',1,'2016-11-05',1),(57,NULL,'SO161105-sssr',252,NULL,30,NULL,NULL,0,'N',0.00,0.00,25000.00,'O',1,'2016-11-05','2016-11-05',1,'2016-11-05',1),(58,NULL,'SO161105-sssi',106,NULL,7,NULL,NULL,0,'N',0.00,0.00,2083000.00,'O',1,'2016-11-05','2016-11-05',1,'2016-11-05',1),(59,NULL,'SO161105-sssk',154,NULL,30,NULL,NULL,0,'N',0.00,0.00,150000.00,'S',1,'2016-11-05','2016-11-05',1,'2016-11-08',8),(61,NULL,'SO161105-sssu',179,NULL,30,NULL,NULL,0,'N',0.00,0.00,4642000.00,'O',1,'2016-11-05','2016-11-05',1,'2016-11-05',1),(62,NULL,'SO161105-sscs',254,NULL,30,NULL,NULL,0,'N',0.00,0.00,210000.00,'O',1,'2016-11-05','2016-11-05',1,'2016-11-05',1),(63,NULL,'SO161105-sssu',246,NULL,7,NULL,NULL,0,'N',0.00,0.00,9070500.00,'O',3,'2016-11-05','2016-11-05',8,'2016-11-06',8),(64,NULL,'SO161105-sscs',73,NULL,30,NULL,NULL,0,'N',0.00,0.00,120000.00,'O',1,'2016-11-05','2016-11-05',1,'2016-11-05',1),(65,NULL,'SO161105-sscc',14,NULL,30,NULL,NULL,0,'N',0.00,0.00,187000.00,'O',1,'2016-11-05','2016-11-05',8,'2016-11-05',8),(67,NULL,'SO161105-ssca',13,NULL,30,NULL,NULL,0,'N',0.00,0.00,168000.00,'O',1,'2016-11-05','2016-11-05',8,'2016-11-05',8),(68,NULL,'SO161105-sscn',12,NULL,30,NULL,NULL,0,'N',0.00,0.00,168000.00,'O',1,'2016-11-05','2016-11-05',8,'2016-11-05',8),(69,NULL,'SO161106-sssc',244,NULL,30,NULL,NULL,0,'N',0.00,0.00,1490000.00,'O',4,'2016-11-06','2016-11-06',8,'2016-11-06',8),(70,NULL,'SO161106-sssh',255,NULL,3,NULL,NULL,0,'N',0.00,0.00,2534238.00,'S',3,'2016-11-06','2016-11-06',1,'2016-11-08',9),(71,NULL,'SO161106-sssa',188,NULL,30,NULL,NULL,0,'N',0.00,0.00,486000.00,'S',1,'2016-11-06','2016-11-06',9,'2016-11-08',8),(72,NULL,'SO161106-sssn',217,NULL,30,NULL,NULL,0,'N',0.00,0.00,316500.00,'S',1,'2016-11-06','2016-11-06',9,'2016-11-08',8),(73,NULL,'SO161106-sssd',173,NULL,30,NULL,NULL,0,'N',0.00,0.00,100000.00,'O',1,'2016-11-06','2016-11-06',9,'2016-11-06',9),(74,NULL,'SO161107-sssc',133,NULL,30,NULL,NULL,0,'N',0.00,0.00,1403000.00,'O',1,'2016-11-07','2016-11-07',9,'2016-11-07',9),(75,NULL,'SO161107-sssh',35,NULL,30,NULL,NULL,0,'N',0.00,0.00,687000.00,'O',1,'2016-11-07','2016-11-07',9,'2016-11-07',9),(76,NULL,'SO161107-sssa',23,NULL,30,NULL,NULL,0,'N',0.00,0.00,45000.00,'O',1,'2016-11-07','2016-11-07',9,'2016-11-07',9),(77,NULL,'SO161107-sssn',256,NULL,30,NULL,NULL,0,'N',0.00,0.00,985000.00,'O',2,'2016-11-07','2016-11-07',9,'2016-11-07',9),(78,NULL,'SO161107-sssd',53,NULL,30,NULL,NULL,0,'N',0.00,0.00,2541000.00,'O',1,'2016-11-07','2016-11-07',9,'2016-11-07',9),(79,NULL,'SO161107-sssr',257,NULL,30,NULL,NULL,0,'N',0.00,0.00,35000.00,'O',1,'2016-11-07','2016-11-07',9,'2016-11-07',9),(80,NULL,'SO161107-sssi',230,1,30,NULL,NULL,0,'N',0.00,0.00,720500.00,'O',1,'2016-11-07','2016-11-07',9,'2016-11-08',9),(81,NULL,'SO161107-sssk',162,NULL,30,NULL,NULL,0,'N',0.00,0.00,275000.00,'O',3,'2016-11-07','2016-11-07',9,'2016-11-08',8),(82,NULL,'SO161107-sssu',163,NULL,30,NULL,NULL,0,'N',0.00,0.00,185000.00,'O',1,'2016-11-07','2016-11-07',9,'2016-11-07',9),(83,NULL,'SO161107-sscs',258,NULL,30,NULL,NULL,0,'N',0.00,0.00,4931000.00,'O',1,'2016-11-07','2016-11-07',9,'2016-11-07',9),(84,NULL,'SO161108-sssc',259,NULL,7,NULL,NULL,0,'N',0.00,0.00,1033250.00,'O',1,'2016-11-08','2016-11-08',8,'2016-11-08',8),(85,NULL,'SO161108-sssh',252,NULL,30,NULL,NULL,0,'N',0.00,0.00,98000.00,'O',1,'2016-11-08','2016-11-08',8,'2016-11-08',8),(86,NULL,'SO161108-sssa',260,NULL,30,NULL,NULL,0,'N',0.00,0.00,187000.00,'O',1,'2016-11-08','2016-11-08',8,'2016-11-08',8),(87,NULL,'SO161108-sssn',261,NULL,30,NULL,NULL,0,'N',0.00,0.00,127000.00,'O',1,'2016-11-08','2016-11-08',8,'2016-11-08',8),(88,NULL,'SO161108-sssd',262,NULL,30,NULL,NULL,0,'N',0.00,0.00,60000.00,'O',1,'2016-11-08','2016-11-08',8,'2016-11-08',8),(89,NULL,'SO161108-sssr',49,NULL,30,NULL,NULL,0,'N',0.00,0.00,271000.00,'O',1,'2016-11-08','2016-11-08',8,'2016-11-08',8),(90,NULL,'SO161108-sssi',49,NULL,30,NULL,NULL,0,'N',0.00,0.00,738000.00,'O',1,'2016-11-08','2016-11-08',8,'2016-11-08',8),(91,NULL,'SO161108-sssk',67,NULL,7,NULL,NULL,0,'N',0.00,0.00,1951500.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',8),(92,NULL,'SO161108-sssu',80,NULL,30,NULL,NULL,0,'N',0.00,0.00,309000.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(93,NULL,'SO161108-sscs',80,NULL,30,NULL,NULL,0,'N',0.00,0.00,85500.00,'O',1,'2016-11-08','2016-11-08',8,'2016-11-08',8),(94,NULL,'SO161108-sscc',53,NULL,30,NULL,NULL,0,'N',0.00,0.00,143500.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(95,NULL,'SO161108-ssch',26,NULL,30,NULL,NULL,0,'N',0.00,0.00,149000.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(96,NULL,'SO161108-ssca',26,NULL,30,NULL,NULL,0,'N',0.00,0.00,80000.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(97,NULL,'SO161108-sscn',25,NULL,30,NULL,NULL,0,'N',0.00,0.00,1425000.00,'O',1,'2016-11-08','2016-11-08',1,'2016-11-08',1),(98,NULL,'SO161108-sscd',48,NULL,30,NULL,NULL,0,'N',0.00,0.00,20000.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(99,NULL,'SO161108-sscr',48,NULL,30,NULL,NULL,0,'N',0.00,0.00,15000.00,'O',2,'2016-11-08','2016-11-08',9,'2016-11-08',9),(100,NULL,'SO161108-sscr',220,NULL,30,NULL,NULL,0,'N',0.00,0.00,2126000.00,'O',1,'2016-11-08','2016-11-08',1,'2016-11-08',1),(101,NULL,'SO161108-ssci',66,NULL,30,NULL,NULL,0,'N',0.00,0.00,230500.00,'S',2,'2016-11-08','2016-11-08',1,'2016-11-08',8),(102,NULL,'SO161108-ssck',73,NULL,30,NULL,NULL,0,'N',0.00,0.00,1322000.00,'O',1,'2016-11-08','2016-11-08',1,'2016-11-08',1),(103,NULL,'SO161108-sscu',73,NULL,30,NULL,NULL,0,'N',0.00,0.00,243000.00,'O',1,'2016-11-08','2016-11-08',1,'2016-11-08',1),(104,NULL,'SO161108-sshs',73,NULL,30,NULL,NULL,0,'N',0.00,0.00,145000.00,'O',1,'2016-11-08','2016-11-08',1,'2016-11-08',1),(105,NULL,'SO161108-sshc',73,NULL,30,NULL,NULL,0,'N',0.00,0.00,20000.00,'O',1,'2016-11-08','2016-11-08',1,'2016-11-08',1),(106,NULL,'SO161108-sshh',263,NULL,0,NULL,NULL,0,'N',0.00,0.00,280000.00,'S',2,'2016-11-08','2016-11-08',9,'2016-11-08',9),(107,NULL,'SO161108-ssha',67,NULL,7,NULL,NULL,0,'N',0.00,0.00,370500.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(108,NULL,'SO161108-sshn',263,NULL,0,NULL,NULL,0,'N',0.00,0.00,57500.00,'S',1,'2016-11-08','2016-11-08',8,'2016-11-08',8),(109,NULL,'SO161108-sshn',77,NULL,30,NULL,NULL,0,'N',0.00,0.00,208000.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(111,NULL,'SO161108-sshr',128,NULL,30,NULL,NULL,0,'N',0.00,0.00,1780000.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(112,NULL,'SO161108-sshi',25,NULL,30,NULL,NULL,0,'N',0.00,0.00,4584500.00,'O',1,'2016-11-08','2016-11-08',1,'2016-11-08',1),(113,NULL,'SO161108-sshk',92,NULL,30,NULL,NULL,0,'N',0.00,0.00,404500.00,'O',1,'2016-11-08','2016-11-08',1,'2016-11-08',1),(114,NULL,'SO161108-sshu',264,NULL,30,NULL,NULL,0,'N',0.00,0.00,74000.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(115,NULL,'SO161108-ssas',67,NULL,7,NULL,NULL,0,'N',0.00,0.00,57500.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(116,NULL,'SO161108-ssac',265,NULL,30,NULL,NULL,0,'N',0.00,0.00,900000.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(117,NULL,'SO161108-ssah',144,NULL,7,NULL,NULL,0,'N',0.00,3.00,960300.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(118,NULL,'SO161108-ssaa',98,NULL,7,NULL,NULL,0,'N',0.00,0.00,755000.00,'O',1,'2016-11-08','2016-11-08',9,'2016-11-08',9),(119,NULL,'SO161109-sssc',237,NULL,30,NULL,NULL,0,'N',0.00,0.00,386250.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(120,NULL,'SO161109-sssh',236,NULL,30,NULL,NULL,0,'N',0.00,0.00,150000.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(121,NULL,'SO161109-sssa',266,NULL,30,NULL,NULL,0,'N',0.00,0.00,185500.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(122,NULL,'SO161109-sssn',265,NULL,30,NULL,NULL,0,'N',0.00,0.00,750000.00,'O',2,'2016-11-09','2016-11-09',9,'2016-11-09',9),(123,NULL,'SO161109-sssd',110,NULL,30,NULL,NULL,0,'N',0.00,0.00,266000.00,'O',2,'2016-11-09','2016-11-09',9,'2016-11-09',9),(124,NULL,'SO161109-sssr',150,NULL,30,NULL,NULL,0,'N',0.00,0.00,974500.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(125,NULL,'SO161109-sssi',150,NULL,30,NULL,NULL,0,'N',0.00,0.00,227000.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(126,NULL,'SO161109-sssk',25,NULL,30,NULL,NULL,0,'N',0.00,0.00,320000.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(127,NULL,'SO161109-sssi',74,NULL,30,NULL,NULL,0,'N',0.00,0.00,3773500.00,'O',2,'2016-11-10','2016-11-09',8,'2016-11-10',9),(128,NULL,'SO161109-sssk',42,NULL,0,NULL,NULL,0,'N',0.00,0.00,252500.00,'S',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(129,NULL,'SO161109-sssk',161,NULL,30,NULL,NULL,0,'N',0.00,0.00,186000.00,'O',1,'2016-11-09','2016-11-09',8,'2016-11-09',8),(130,NULL,'SO161109-sssu',80,NULL,30,NULL,NULL,0,'N',0.00,0.00,236000.00,'O',2,'2016-11-09','2016-11-09',9,'2016-11-10',9),(132,NULL,'SO161109-sscs',67,NULL,7,NULL,NULL,0,'N',0.00,0.00,31000.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(135,NULL,'SO161109-ssch',206,NULL,30,NULL,NULL,0,'N',0.00,0.00,283500.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(136,NULL,'SO161109-ssca',206,NULL,30,NULL,NULL,0,'N',0.00,0.00,4149600.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(137,NULL,'SO161109-sscn',67,NULL,7,NULL,NULL,0,'N',0.00,0.00,43000.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(138,NULL,'SO161109-sscd',27,NULL,30,NULL,NULL,0,'N',0.00,0.00,397500.00,'O',1,'2016-11-09','2016-11-09',8,'2016-11-09',8),(139,NULL,'SO161109-sscr',268,NULL,0,NULL,NULL,0,'N',0.00,0.00,645500.00,'S',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(140,NULL,'SO161109-sscr',267,NULL,30,NULL,NULL,0,'N',0.00,0.00,397500.00,'O',0,'2016-11-09','2016-11-09',8,'2016-11-09',8),(141,NULL,'SO161109-ssci',166,NULL,30,NULL,NULL,0,'N',0.00,0.00,150000.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(142,NULL,'SO161109-ssck',138,NULL,30,NULL,NULL,0,'N',0.00,0.00,106000.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(143,NULL,'SO161109-sscu',68,NULL,30,NULL,NULL,0,'N',0.00,0.00,395000.00,'O',2,'2016-11-09','2016-11-09',9,'2016-11-09',9),(144,NULL,'SO161109-sshs',138,NULL,30,NULL,NULL,0,'N',0.00,0.00,330000.00,'O',2,'2016-11-09','2016-11-09',9,'2016-11-09',9),(145,NULL,'SO161109-sshc',257,NULL,30,NULL,NULL,0,'N',0.00,0.00,1320915.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(146,NULL,'SO161109-sshh',257,NULL,30,NULL,NULL,0,'N',0.00,0.00,26500.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(147,NULL,'SO161109-ssha',55,NULL,7,NULL,NULL,0,'N',0.00,0.00,2073500.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(149,NULL,'SO161109-sshn',5,NULL,30,NULL,NULL,0,'N',0.00,0.00,150000.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(150,NULL,'SO161109-sshd',5,NULL,30,NULL,NULL,0,'N',0.00,0.00,175000.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(151,NULL,'SO161109-sshr',5,NULL,30,NULL,NULL,0,'N',0.00,0.00,666000.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(152,NULL,'SO161109-sshi',265,NULL,30,NULL,NULL,0,'N',0.00,0.00,715500.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(153,NULL,'SO161109-sshk',265,NULL,30,NULL,NULL,0,'N',0.00,0.00,741300.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(154,NULL,'SO161109-sshu',265,NULL,30,NULL,NULL,0,'N',0.00,0.00,420000.00,'O',1,'2016-11-09','2016-11-09',9,'2016-11-09',9),(157,NULL,'SO161109-ssas',270,NULL,60,NULL,NULL,0,'N',0.00,0.00,1638000.00,'O',3,'2016-11-09','2016-11-09',1,'2016-11-10',9),(158,NULL,'SO161109-ssac',269,NULL,60,NULL,NULL,0,'N',0.00,0.00,3307486.00,'O',11,'2016-11-09','2016-11-09',1,'2016-11-10',9),(159,NULL,'SO161110-sssc',35,NULL,30,NULL,NULL,0,'N',0.00,0.00,300000.00,'O',2,'2016-11-10','2016-11-10',1,'2016-11-10',9),(160,NULL,'SO161110-sssh',74,NULL,30,NULL,NULL,0,'N',0.00,0.00,100000.00,'O',1,'2016-11-10','2016-11-10',9,'2016-11-10',9),(161,'Tempo 1 minggu ','SO161110-sssa',204,NULL,30,NULL,NULL,0,'N',0.00,0.00,3395000.00,'O',2,'2016-11-10','2016-11-10',9,'2016-11-10',9);
/*!40000 ALTER TABLE `sale_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_order_detail`
--

DROP TABLE IF EXISTS `sale_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale_order_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `capital` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `quantity` double(7,2) unsigned NOT NULL,
  `disc` double(4,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `sale_id` (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `fk-sod-product-01` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-sod-so-01` FOREIGN KEY (`order_id`) REFERENCES `sale_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1884 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_order_detail`
--

LOCK TABLES `sale_order_detail` WRITE;
/*!40000 ALTER TABLE `sale_order_detail` DISABLE KEYS */;
INSERT INTO `sale_order_detail` VALUES (553,2,12,28650,27650,20.00,0.00),(554,2,349,0,21000,24.00,0.00),(555,2,362,1750,3000,2.00,0.00),(556,2,110,9375,12000,1.00,0.00),(557,2,635,0,21000,12.00,0.00),(558,3,44,13250,15000,6.00,0.00),(559,3,471,49440,55000,6.00,0.00),(560,3,475,58080,65000,6.00,0.00),(561,3,363,2583,5000,1.00,0.00),(562,3,19,7500,15000,6.00,0.00),(563,3,636,0,10000,4.00,0.00),(564,3,281,0,1500,12.00,0.00),(565,3,241,2807,3500,12.00,0.00),(566,3,242,1255,1500,12.00,0.00),(567,3,71,6400,10000,2.00,0.00),(568,3,309,0,1500,2.00,0.00),(569,3,77,9180,12000,1.00,0.00),(570,3,232,2200,4000,24.00,0.00),(571,3,640,0,250000,1.00,0.00),(572,3,104,14500,20000,1.00,0.00),(573,3,26,3300,4000,12.00,0.00),(574,4,10,50594,57500,10.00,0.00),(575,5,12,28650,27650,10.00,0.00),(576,5,491,13425,14500,2.00,0.00),(577,5,558,6000,7000,24.00,0.00),(578,5,32,9500,11000,10.00,0.00),(579,5,641,0,165000,1.00,0.00),(580,5,580,4750,5500,5.00,0.00),(581,5,438,38400,50000,3.00,0.00),(582,5,439,38400,50000,3.00,0.00),(583,5,329,52000,59500,1.00,0.00),(584,5,610,20250,22000,3.00,0.00),(585,5,477,24310,30000,2.00,0.00),(586,5,643,0,55000,1.00,0.00),(587,5,471,49440,53000,1.00,0.00),(588,5,472,49440,53000,1.00,0.00),(589,5,420,0,22000,2.00,0.00),(590,5,624,0,1400,20.00,0.00),(591,5,644,0,8000,2.00,0.00),(592,5,645,0,15000,2.00,0.00),(593,5,313,0,10000,12.00,0.00),(594,5,384,28000,32000,1.00,0.00),(595,5,480,32424,40000,2.00,0.00),(596,5,646,0,43000,1.00,0.00),(597,5,647,0,6000,3.00,0.00),(598,5,425,0,24000,1.00,0.00),(599,5,648,0,30000,1.00,0.00),(600,5,649,0,100000,1.00,0.00),(601,5,41,17000,22500,2.00,0.00),(602,5,429,18800,21500,2.00,0.00),(603,5,15,18800,21500,2.00,0.00),(604,5,272,2850,40000,2.00,0.00),(605,5,604,34875,40000,2.00,0.00),(606,5,487,2862,1200,20.00,0.00),(632,7,101,204317,215000,2.00,0.00),(633,7,299,4488,5000,60.00,0.00),(634,7,230,3630,4500,5.00,0.00),(635,7,201,12119,14000,5.00,0.00),(636,7,358,37000,45000,1.00,0.00),(637,7,60,11500,13500,24.00,0.00),(638,7,656,0,8000,20.00,0.00),(734,8,528,25430,30000,6.00,0.00),(735,8,8,26505,27000,5.00,0.00),(736,8,488,30461,30000,5.00,0.00),(737,8,430,18800,23000,1.00,0.00),(738,8,184,4120,5000,2.00,0.00),(739,8,173,4840,6000,2.00,0.00),(740,8,174,4840,6000,2.00,0.00),(741,8,252,13071,17500,1.00,0.00),(742,8,420,0,23000,2.00,0.00),(743,8,23,4500,7500,10.00,0.00),(744,8,192,38000,45000,2.00,0.00),(745,8,438,38400,50000,5.00,0.00),(746,8,34,19500,25000,1.00,0.00),(747,8,291,5600,7500,2.00,0.00),(748,8,239,1168,1500,10.00,0.00),(749,8,241,2807,3500,5.00,0.00),(750,8,277,0,3000,6.00,0.00),(751,8,285,3253,5000,6.00,0.00),(752,8,288,4732,6000,6.00,0.00),(753,8,286,7671,10000,3.00,0.00),(754,9,216,10500,15000,6.00,0.00),(755,9,288,4732,6000,3.00,0.00),(756,9,286,7671,10000,3.00,0.00),(757,9,201,12119,15000,3.00,0.00),(758,9,95,15233,18000,3.00,0.00),(759,9,657,0,40000,3.00,0.00),(760,9,82,6400,10000,6.00,0.00),(761,9,336,0,25000,1.00,0.00),(762,9,34,19500,35000,1.00,0.00),(763,9,33,7500,15000,1.00,0.00),(764,9,659,0,10000,10.00,0.00),(765,10,11,32566,33000,10.00,0.00),(766,10,420,0,23000,2.00,0.00),(767,10,44,13250,15000,10.00,0.00),(768,10,184,4120,5000,4.00,0.00),(769,10,173,4840,6000,4.00,0.00),(770,10,111,3733,5000,4.00,0.00),(771,10,110,9375,12000,2.00,0.00),(772,10,663,1100,2500,36.00,0.00),(773,10,646,0,48000,2.00,0.00),(774,10,251,13462,17500,5.00,0.00),(775,10,272,2850,6000,2.00,0.00),(776,10,229,6710,10000,10.00,0.00),(777,10,288,4732,6000,2.00,0.00),(778,10,56,14214,25000,1.00,0.00),(779,10,438,38400,50000,5.00,0.00),(780,10,424,8244,12000,15.00,0.00),(781,10,32,9500,12000,2.00,0.00),(782,10,664,25000,30000,10.00,0.00),(788,11,11,32566,33000,20.00,0.00),(789,11,12,28650,30000,5.00,0.00),(790,11,166,6270,12000,6.00,0.00),(791,11,30,81500,95000,1.00,0.00),(792,11,615,3708,6000,6.00,0.00),(795,12,12,28650,27650,10.00,0.00),(796,12,118,209000,224000,1.00,0.00),(797,13,12,28650,27650,20.00,0.00),(798,13,11,32566,31250,5.00,0.00),(799,13,665,0,5000,2.00,0.00),(800,13,667,0,25000,1.00,0.00),(801,14,511,12000,14000,15.00,0.00),(802,15,669,0,550000,1.00,0.00),(803,16,30,81500,95000,1.00,0.00),(804,16,11,32566,33000,1.00,0.00),(805,16,407,11680,15000,1.00,0.00),(806,16,184,4120,5000,2.00,0.00),(807,16,291,5600,7500,2.00,0.00),(808,16,297,112000,150000,1.00,0.00),(809,16,370,62000,75000,2.00,0.00),(810,17,8,26505,27000,5.00,0.00),(811,18,11,32566,33000,5.00,0.00),(813,20,12,28936,29000,10.00,0.00),(814,21,107,14500,18000,12.00,0.00),(815,21,60,11500,162000,4.00,0.00),(818,22,101,206402,219000,1.00,0.00),(819,22,679,45000,65000,1.00,0.00),(820,23,12,28936,30000,10.00,0.00),(821,24,680,17500,20000,5.00,0.00),(822,24,21,11500,15000,5.00,0.00),(823,24,681,13575,17500,3.00,0.00),(824,24,404,33550,10000,5.00,0.00),(825,25,293,0,2500,10.00,0.00),(826,25,136,30000,35000,1.00,0.00),(827,26,674,0,6000,18.00,0.00),(828,26,682,13500,15000,1.00,0.00),(829,26,270,0,15000,2.00,0.00),(830,26,99,6700,8000,4.00,0.00),(831,26,420,0,23000,1.00,0.00),(832,26,438,38400,50000,1.00,0.00),(833,26,569,7667,10000,12.00,0.00),(834,26,683,319000,330000,1.00,0.00),(835,26,328,52000,60000,1.00,0.00),(836,26,684,60000,75000,1.00,0.00),(837,26,51,300000,350000,2.00,0.00),(838,26,510,165000,300000,1.00,0.00),(839,27,30,81500,95000,1.00,0.00),(840,28,12,28936,30000,5.00,0.00),(841,28,443,1750,2500,500.00,0.00),(842,28,66,7700,10000,12.00,0.00),(843,28,299,4488,6000,8.00,0.00),(844,28,110,9375,12000,2.00,0.00),(845,28,111,3733,5000,2.00,0.00),(846,28,272,2850,6000,2.00,0.00),(847,28,277,0,3000,12.00,0.00),(848,28,369,102000,130000,1.00,0.00),(849,28,688,105000,120000,1.00,0.00),(850,29,173,4840,6000,2.00,0.00),(851,29,435,18800,23000,2.00,0.00),(852,29,663,1100,3000,4.00,0.00),(853,29,689,700,1500,1.00,0.00),(854,29,21,11500,15000,2.00,0.00),(855,29,291,5600,8000,3.00,0.00),(856,29,54,2702,5000,4.00,0.00),(857,29,690,1000,1500,2.00,0.00),(858,29,357,4072,6000,1.00,0.00),(859,30,300,30000,33000,1.00,0.00),(860,30,303,26500,30000,1.00,0.00),(861,30,680,17500,20000,1.00,0.00),(862,30,435,18800,23000,1.00,0.00),(863,30,691,19000,20000,1.00,0.00),(864,31,12,28936,30000,5.00,0.00),(865,31,339,0,30000,1.00,0.00),(866,31,688,105000,120000,1.00,0.00),(867,32,229,6710,10000,1.00,0.00),(868,32,127,32000,45000,1.00,0.00),(869,32,12,28936,30000,15.00,0.00),(870,32,342,19875,30000,1.00,0.00),(871,32,692,21000,30000,2.00,0.00),(872,32,535,60800,75000,1.00,0.00),(873,32,688,105000,120000,1.00,0.00),(874,33,12,28936,29000,10.00,0.00),(875,33,203,113000,135000,1.00,0.00),(876,34,12,28936,30000,5.00,0.00),(877,34,299,4488,6000,10.00,0.00),(878,35,693,0,20000,1.00,0.00),(879,36,271,4868,10000,1.00,0.00),(880,36,438,38400,50000,1.00,0.00),(881,36,71,6400,10000,1.00,0.00),(882,36,45,15375,18000,2.00,0.00),(883,36,420,0,23000,1.00,0.00),(884,36,393,4613,6000,1.00,0.00),(885,36,390,2431,3000,1.00,0.00),(886,36,694,0,8000,1.00,0.00),(887,36,423,0,12000,1.00,0.00),(888,36,99,6700,8000,1.00,0.00),(889,36,23,4500,7500,2.00,0.00),(890,37,12,28936,30000,5.00,0.00),(891,37,682,13500,15000,1.00,0.00),(892,38,349,0,23000,12.00,0.00),(893,38,513,20500,24000,1.00,0.00),(903,40,120,325360,340000,5.00,0.00),(904,41,192,38000,45000,1.00,0.00),(929,43,12,28936,30000,5.00,0.00),(930,43,11,32566,33000,5.00,0.00),(931,43,569,7667,10000,1.00,0.00),(932,43,107,14500,20000,2.00,0.00),(933,43,209,3445,5000,5.00,0.00),(934,43,505,0,18000,1.00,0.00),(935,43,92,24000,35000,1.00,0.00),(936,43,192,38000,45000,1.00,0.00),(937,44,27,84328,95000,2.00,0.00),(938,45,653,115000,125000,1.00,0.00),(939,46,11,32947,33000,10.00,0.00),(940,46,420,0,23000,2.00,0.00),(941,46,44,13250,15000,10.00,0.00),(942,46,184,4120,5000,4.00,0.00),(943,46,173,4840,6000,4.00,0.00),(944,46,111,3733,5000,4.00,0.00),(945,46,110,9375,12000,2.00,0.00),(946,46,646,0,48000,2.00,0.00),(947,46,92,24000,35000,1.00,0.00),(948,46,681,13575,17500,5.00,0.00),(949,46,272,2850,6000,2.00,0.00),(950,46,229,6710,10000,10.00,0.00),(951,46,288,4732,6000,2.00,0.00),(952,46,56,14214,25000,1.00,0.00),(953,46,438,38400,50000,5.00,0.00),(954,46,423,0,12000,15.00,0.00),(955,46,32,9500,12000,2.00,0.00),(956,46,664,25000,30000,10.00,0.00),(957,46,663,1100,2500,36.00,0.00),(958,47,10,50594,57500,10.00,0.00),(959,48,635,0,25000,30.00,0.00),(960,49,44,13250,15000,2.00,0.00),(961,49,229,6710,10000,2.00,0.00),(962,49,232,2200,3500,15.00,0.00),(964,51,702,238000,248000,3.00,0.00),(965,51,100,133309,145000,1.00,0.00),(966,51,569,7667,10000,1.00,0.00),(967,51,703,20000,25000,1.00,0.00),(968,51,527,17360,20000,2.00,0.00),(969,51,99,6700,8000,3.00,0.00),(970,51,423,0,12000,1.00,0.00),(971,51,406,28070,35000,1.00,0.00),(972,51,288,4732,6000,1.00,0.00),(973,52,11,32947,33000,5.00,0.00),(974,52,73,26919,31000,5.00,0.00),(975,52,559,8333,10000,1.00,0.00),(976,52,428,18800,22000,2.00,0.00),(977,52,101,206402,219000,2.00,0.00),(978,52,306,0,237000,2.00,0.00),(979,52,420,0,22000,2.00,0.00),(980,52,64,30600,40000,1.00,0.00),(981,52,111,3733,5000,2.00,0.00),(982,52,704,0,22000,2.00,0.00),(983,52,291,5600,7500,2.00,0.00),(985,54,230,3630,5000,6.00,0.00),(986,54,636,0,10000,3.00,0.00),(987,55,682,13500,15000,1.00,0.00),(988,55,229,6710,10000,4.00,0.00),(989,55,615,3708,6000,2.00,0.00),(990,56,230,3630,5000,5.00,0.00),(991,56,682,13500,15000,1.00,0.00),(992,57,54,2702,5000,5.00,0.00),(993,58,101,206402,219000,4.00,0.00),(994,58,12,28936,30000,30.00,0.00),(995,58,705,6500,12000,1.00,0.00),(996,58,71,6400,10000,2.00,0.00),(997,58,229,6710,10000,10.00,0.00),(998,58,264,0,7500,4.00,0.00),(999,58,23,4500,7500,6.00,0.00),(1000,58,413,19550,30000,1.00,0.00),(1001,58,173,4840,6000,10.00,0.00),(1002,58,239,1168,2000,5.00,0.00),(1003,59,297,112000,150000,1.00,0.00),(1024,61,254,11030,12000,20.00,0.00),(1025,61,547,19600,25000,3.00,0.00),(1026,61,170,14800,18000,10.00,0.00),(1027,61,159,42172,48000,2.00,0.00),(1028,61,161,42172,48000,2.00,0.00),(1029,61,160,42172,48000,2.00,0.00),(1030,61,158,42172,48000,2.00,0.00),(1031,61,475,58080,60500,10.00,0.00),(1032,61,410,18150,22500,4.00,0.00),(1033,61,417,0,54000,2.00,0.00),(1034,61,488,30461,29600,100.00,0.00),(1035,62,299,4488,5000,4.00,0.00),(1036,62,372,30500,38000,5.00,0.00),(1095,64,706,0,20000,6.00,0.00),(1096,65,137,10000,15000,1.00,0.00),(1097,65,488,30461,29600,5.00,0.00),(1098,65,610,20250,24000,1.00,0.00),(1100,67,60,11500,14000,12.00,0.00),(1101,68,60,11500,14000,12.00,0.00),(1102,69,12,28936,30000,5.00,0.00),(1103,69,11,32947,33000,1.00,0.00),(1104,69,184,4120,5000,1.00,0.00),(1105,69,173,4840,6000,1.00,0.00),(1106,69,622,175000,195000,3.00,0.00),(1107,69,623,225000,245000,2.00,0.00),(1108,69,242,1255,1500,4.00,0.00),(1109,69,66,7700,10000,2.00,0.00),(1110,69,695,0,195000,1.00,0.00),(1111,70,121,32518,31250,15.00,0.00),(1112,70,96,28602,27650,10.00,0.00),(1113,70,486,14810,16000,3.00,0.00),(1114,70,676,9800,12500,5.00,0.00),(1115,70,428,18800,21500,1.00,0.00),(1116,70,15,18800,21500,1.00,0.00),(1117,70,435,18800,21500,1.00,0.00),(1118,70,431,18800,21500,1.00,0.00),(1119,70,39,17000,22500,1.00,0.00),(1120,70,41,17000,22500,1.00,0.00),(1121,70,42,17000,22500,1.00,0.00),(1122,70,465,17000,22500,1.00,0.00),(1123,70,404,33550,42500,2.00,0.00),(1124,70,411,20625,25000,4.00,0.00),(1125,70,26,3300,3833,12.00,0.00),(1126,70,205,3300,3833,12.00,0.00),(1127,70,708,0,36000,2.00,0.00),(1128,70,475,58080,60500,3.00,0.00),(1129,70,471,49440,53000,2.00,0.00),(1130,70,710,0,130000,1.00,0.00),(1131,70,646,0,43000,3.00,0.00),(1132,70,86,25550,28000,3.00,0.00),(1133,70,198,73500,77000,1.00,0.00),(1134,70,711,0,20000,4.00,0.00),(1135,70,616,44500,40000,2.00,0.00),(1136,70,64,30600,36000,2.00,0.00),(1137,70,572,35910,40000,2.00,0.00),(1138,70,272,2850,3333,12.00,0.00),(1139,70,642,0,3500,20.00,0.00),(1140,70,539,21250,24000,1.00,0.00),(1141,63,697,0,45000,3.00,0.00),(1142,63,92,24000,33000,1.00,0.00),(1143,63,531,0,12000,10.00,0.00),(1144,63,201,12119,16500,1.00,0.00),(1145,63,288,4732,7500,1.00,0.00),(1146,63,698,0,23000,2.00,0.00),(1147,63,231,3630,6000,15.00,0.00),(1148,63,19,7500,11000,3.00,0.00),(1149,63,421,0,50000,1.00,0.00),(1150,63,420,0,25000,1.00,0.00),(1151,63,11,32947,32500,20.00,0.00),(1152,63,12,28936,31500,69.00,0.00),(1153,63,234,37197,39500,5.00,0.00),(1154,63,71,6400,11000,8.00,0.00),(1155,63,558,6000,9000,1.00,0.00),(1156,63,318,44000,54500,5.00,0.00),(1157,63,205,3300,49000,1.00,0.00),(1158,63,699,0,312000,11.00,0.00),(1159,63,701,375000,625000,2.00,0.00),(1160,63,362,1750,9000,2.00,0.00),(1161,63,66,7700,13000,5.00,0.00),(1162,63,173,4840,6500,1.00,0.00),(1163,63,184,4120,6500,3.00,0.00),(1164,63,391,2431,3500,3.00,0.00),(1165,63,170,14800,26000,1.00,0.00),(1166,63,636,0,10000,3.00,0.00),(1167,63,660,0,9000,5.00,0.00),(1168,63,502,0,2500,3.00,0.00),(1169,63,235,32709,33000,5.00,0.00),(1170,71,422,78240,84000,4.00,0.00),(1171,71,438,38400,50000,3.00,0.00),(1172,72,11,32947,33000,8.00,0.00),(1173,72,44,13250,15000,2.00,0.00),(1174,72,23,4500,7500,3.00,0.00),(1175,73,225,4125,5000,20.00,0.00),(1176,74,100,133309,145000,3.00,0.00),(1177,74,118,209000,224000,2.00,0.00),(1178,74,298,0,8000,10.00,0.00),(1179,74,180,10200,12000,5.00,0.00),(1180,74,739,37500,45000,2.00,0.00),(1181,74,438,38400,50000,1.00,0.00),(1182,74,439,38400,50000,1.00,0.00),(1183,74,740,138500,150000,1.00,0.00),(1184,74,741,6500,8000,5.00,0.00),(1185,75,12,28936,30000,10.00,0.00),(1186,75,112,4417,6000,12.00,0.00),(1187,75,32,9500,12000,2.00,0.00),(1188,75,299,4488,6000,5.00,0.00),(1189,75,60,11500,13750,12.00,0.00),(1190,75,519,13100,15000,2.00,0.00),(1191,75,705,6500,12000,2.00,0.00),(1192,75,674,0,6000,6.00,0.00),(1193,75,202,3890,6000,1.00,0.00),(1194,76,278,0,15000,3.00,0.00),(1195,77,516,12000,15000,5.00,0.00),(1196,77,512,0,70000,3.00,0.00),(1197,77,712,11500,15000,3.00,0.00),(1198,77,743,55000,75000,1.00,0.00),(1199,77,136,30000,35000,4.00,0.00),(1200,77,622,175000,195000,1.00,0.00),(1201,77,623,225000,245000,1.00,0.00),(1202,78,702,238000,248000,2.00,0.00),(1203,78,120,325360,340000,2.00,0.00),(1204,78,11,32947,33000,5.00,0.00),(1205,78,101,206402,219000,1.00,0.00),(1206,78,58,13250,15000,3.00,0.00),(1207,78,110,9375,12000,1.00,0.00),(1208,78,423,0,12000,2.00,0.00),(1209,78,668,0,550000,1.00,0.00),(1210,78,139,10000,15000,5.00,0.00),(1211,78,22,12500,15000,8.00,0.00),(1212,78,232,2200,4000,10.00,0.00),(1213,78,503,0,3500,5.00,0.00),(1214,78,252,13071,17500,3.00,0.00),(1215,78,548,10000,15000,3.00,0.00),(1216,79,60,11500,15000,1.00,0.00),(1217,79,751,15000,20000,1.00,0.00),(1218,80,500,10044,12000,3.00,0.00),(1219,80,291,5600,7500,3.00,0.00),(1220,80,23,4500,7500,2.00,0.00),(1221,80,66,7700,10000,2.00,0.00),(1222,80,112,4417,6000,1.00,0.00),(1223,80,12,28936,30000,15.00,0.00),(1224,80,11,32947,33000,5.00,0.00),(1225,80,272,2850,6000,1.00,0.00),(1230,82,752,2166,3000,2.00,0.00),(1231,82,11,32947,35000,5.00,0.00),(1232,82,362,1750,4000,1.00,0.00),(1233,83,107,14500,18000,5.00,0.00),(1234,83,106,14500,18000,5.00,0.00),(1235,83,105,14500,18000,5.00,0.00),(1236,83,104,14500,18000,5.00,0.00),(1237,83,459,159000,165000,2.00,0.00),(1238,83,753,58000,65000,2.00,0.00),(1239,83,734,9393,11000,12.00,0.00),(1240,83,735,15793,19000,6.00,0.00),(1241,83,33,7250,10000,6.00,0.00),(1242,83,109,37500,45000,1.00,0.00),(1243,83,706,0,95000,1.00,0.00),(1244,83,647,3700,6000,10.00,0.00),(1245,83,440,24432,27000,4.00,0.00),(1246,83,576,20000,20000,4.00,0.00),(1247,83,169,10400,14000,5.00,0.00),(1248,83,637,0,85000,5.00,0.00),(1249,83,274,12000,18000,6.00,0.00),(1250,83,754,26000,30000,6.00,0.00),(1251,83,755,41000,44000,2.00,0.00),(1252,83,756,123750,135000,1.00,0.00),(1253,83,520,0,12500,12.00,0.00),(1254,83,52,20114,23500,20.00,0.00),(1255,83,736,15461,20000,12.00,0.00),(1256,83,757,10750,12000,10.00,0.00),(1257,83,733,36990,44500,6.00,0.00),(1258,83,656,0,8000,20.00,0.00),(1259,83,550,3250,4500,12.00,0.00),(1260,83,619,40000,45000,5.00,0.00),(1261,83,603,20250,35000,2.00,0.00),(1262,83,654,0,48000,2.00,0.00),(1263,83,425,0,30000,2.00,0.00),(1264,83,354,1900,35000,1.00,0.00),(1265,83,610,20250,22000,12.00,0.00),(1266,83,423,0,12000,5.00,0.00),(1267,83,758,12000,14000,10.00,0.00),(1268,84,121,32518,31250,5.00,0.00),(1269,84,96,28602,27650,20.00,0.00),(1270,84,60,11605,13500,24.00,0.00),(1271,85,772,4800,6000,3.00,0.00),(1272,85,184,4120,5000,2.00,0.00),(1273,85,682,13500,15000,2.00,0.00),(1274,85,680,17500,20000,2.00,0.00),(1275,86,682,13500,15000,3.00,0.00),(1276,86,230,3630,5000,12.00,0.00),(1277,86,772,4800,6000,4.00,0.00),(1278,86,680,17500,20000,2.00,0.00),(1279,86,615,3708,6000,3.00,0.00),(1280,87,230,3630,5000,1.00,0.00),(1281,87,477,24310,30000,2.00,0.00),(1282,87,682,13500,15000,2.00,0.00),(1283,87,550,3250,4000,2.00,0.00),(1284,87,615,3708,6000,4.00,0.00),(1285,88,12,28936,30000,2.00,0.00),(1286,89,92,24000,35000,1.00,0.00),(1287,89,773,44000,50000,1.00,0.00),(1288,89,277,0,3000,2.00,0.00),(1289,89,200,1801,2500,2.00,0.00),(1290,89,285,3253,5000,2.00,0.00),(1291,89,71,6400,10000,1.00,0.00),(1292,89,302,0,5000,2.00,0.00),(1293,89,318,44000,55000,2.00,0.00),(1294,89,406,28070,35000,1.00,0.00),(1295,90,12,28936,30000,10.00,0.00),(1296,90,101,206402,219000,2.00,0.00),(1297,91,510,165000,270000,2.00,0.00),(1298,91,98,209881,225500,4.00,0.00),(1299,91,22,12500,15000,10.00,0.00),(1300,91,299,4488,5000,10.00,0.00),(1301,91,775,0,1500,10.00,0.00),(1302,91,112,4417,5000,12.00,0.00),(1303,91,328,52000,59500,1.00,0.00),(1304,91,146,29600,35000,1.00,0.00),(1305,91,99,6700,8000,2.00,0.00),(1306,91,95,15233,18000,1.00,0.00),(1307,91,529,0,10000,1.00,0.00),(1308,91,674,0,6000,6.00,0.00),(1309,91,44,13250,15000,1.00,0.00),(1310,91,358,37000,45000,1.00,0.00),(1311,92,12,28936,30000,5.00,0.00),(1312,92,201,12119,15000,2.00,0.00),(1313,92,288,4732,6000,4.00,0.00),(1314,92,776,0,25000,2.00,0.00),(1315,92,299,4488,6000,5.00,0.00),(1316,92,230,3630,5000,5.00,0.00),(1317,93,393,4613,6000,2.00,0.00),(1318,93,99,6700,8000,2.00,0.00),(1319,93,299,4488,6000,5.00,0.00),(1320,93,148,16500,27500,1.00,0.00),(1321,94,319,44000,53500,1.00,0.00),(1322,94,777,80000,90000,1.00,0.00),(1323,95,778,3500,5000,10.00,0.00),(1324,95,11,32947,33000,3.00,0.00),(1325,96,71,6400,10000,6.00,0.00),(1326,96,82,6400,10000,2.00,0.00),(1327,97,329,52000,59500,5.00,0.00),(1328,97,98,209881,225500,5.00,0.00),(1329,98,229,6710,10000,2.00,0.00),(1330,99,44,13250,15000,1.00,0.00),(1331,100,12,28936,30000,20.00,0.00),(1332,100,182,20160,24000,3.00,0.00),(1333,100,71,6400,10000,10.00,0.00),(1334,100,202,3890,6000,3.00,0.00),(1335,100,92,24000,35000,2.00,0.00),(1336,100,705,6500,12000,3.00,0.00),(1337,100,278,0,15000,3.00,0.00),(1338,100,364,75000,80000,1.00,0.00),(1339,100,365,75000,80000,1.00,0.00),(1340,100,366,75000,80000,1.00,0.00),(1341,100,367,75000,80000,1.00,0.00),(1342,100,60,11605,13750,36.00,0.00),(1343,100,166,6270,10000,1.00,0.00),(1344,100,297,112000,150000,2.00,0.00),(1345,100,68,15510,20000,3.00,0.00),(1346,101,291,5600,7500,1.00,0.00),(1347,101,12,28936,30000,5.00,0.00),(1348,101,45,15375,18000,1.00,0.00),(1349,101,22,12500,15000,1.00,0.00),(1350,101,663,1100,2500,2.00,0.00),(1351,101,776,0,25000,1.00,0.00),(1352,101,71,6400,10000,1.00,0.00),(1353,102,202,3890,6000,12.00,0.00),(1354,102,789,0,12000,12.00,0.00),(1355,102,12,28936,27650,40.00,0.00),(1356,103,772,4800,6000,24.00,0.00),(1357,103,280,0,8000,12.00,0.00),(1358,103,277,0,3000,1.00,0.00),(1359,104,229,6710,10000,10.00,0.00),(1360,104,442,0,1250,36.00,0.00),(1361,105,280,0,2000,10.00,0.00),(1362,106,532,0,185000,1.00,0.00),(1363,106,252,13071,17500,4.00,0.00),(1364,106,256,9223,12500,2.00,0.00),(1365,107,12,28936,29000,5.00,0.00),(1366,107,98,209881,225500,1.00,0.00),(1367,108,791,9000,12500,1.00,0.00),(1368,108,407,11680,15000,3.00,0.00),(1373,81,111,3733,5000,2.00,0.00),(1374,81,548,10000,15000,1.00,0.00),(1375,81,11,32947,35000,5.00,0.00),(1376,81,682,13500,15000,5.00,0.00),(1377,109,20,7292,15000,4.00,0.00),(1378,109,778,3500,5000,24.00,0.00),(1379,109,291,5600,8000,1.00,0.00),(1380,109,66,7700,10000,2.00,0.00),(1410,111,55,60000,75000,20.00,0.00),(1411,111,22,12500,14000,20.00,0.00),(1412,112,532,0,180000,1.00,0.00),(1413,112,534,0,7500,7.00,0.00),(1414,112,92,24000,30000,1.00,0.00),(1415,112,451,174000,195000,1.00,0.00),(1416,112,125,32083,34000,1.00,0.00),(1417,112,60,11605,13500,48.00,0.00),(1418,112,49,30000,40000,20.00,0.00),(1419,112,455,184500,195000,2.00,0.00),(1420,112,98,209881,225500,10.00,0.00),(1421,113,531,0,8000,24.00,0.00),(1422,113,227,14575,27500,5.00,0.00),(1423,113,293,0,2500,20.00,0.00),(1424,113,335,0,25000,1.00,0.00),(1425,114,111,3733,5000,10.00,0.00),(1426,114,99,6700,8000,3.00,0.00),(1427,115,276,687,1500,5.00,0.00),(1428,115,529,0,10000,2.00,0.00),(1429,115,775,0,1250,24.00,0.00),(1430,116,12,28936,30000,30.00,0.00),(1431,117,71,6400,8250,120.00,0.00),(1432,118,60,11605,15000,10.00,0.00),(1433,118,137,10000,15000,2.00,0.00),(1434,118,66,7700,10000,10.00,0.00),(1435,118,99,6700,8000,1.00,0.00),(1436,118,12,28936,30000,10.00,0.00),(1437,118,112,4417,6000,3.00,0.00),(1438,118,201,12119,15000,2.00,0.00),(1439,118,288,4732,6000,2.00,0.00),(1440,118,277,0,3000,2.00,0.00),(1441,118,420,0,23000,1.00,0.00),(1442,118,232,2200,3500,2.00,0.00),(1443,118,34,19500,35000,1.00,0.00),(1444,118,202,3890,6000,2.00,0.00),(1445,118,32,9500,12000,2.00,0.00),(1446,119,12,28936,27650,5.00,0.00),(1447,119,60,11605,13750,12.00,0.00),(1448,119,71,6400,10000,3.00,0.00),(1449,119,202,3890,6000,3.00,0.00),(1450,119,146,29600,35000,1.00,0.00),(1451,120,798,65000,75000,2.00,0.00),(1452,121,132,20757,25000,1.00,0.00),(1453,121,44,13250,15000,1.00,0.00),(1454,121,59,13250,15000,1.00,0.00),(1455,121,420,0,23000,1.00,0.00),(1456,121,30,81500,95000,1.00,0.00),(1457,121,256,9223,12500,1.00,0.00),(1458,122,12,28936,30000,25.00,0.00),(1523,124,8,26766,26500,30.00,0.00),(1524,124,44,13250,15000,2.00,0.00),(1525,124,610,20250,24000,1.00,0.00),(1526,124,420,0,23000,1.00,0.00),(1527,124,406,28070,35000,2.00,0.00),(1528,124,87,3000,3000,5.00,0.00),(1529,124,663,1100,2500,7.00,0.00),(1530,125,438,38400,50000,2.00,0.00),(1531,125,423,0,17000,1.00,0.00),(1532,125,277,0,3000,2.00,0.00),(1533,125,288,4732,6000,2.00,0.00),(1534,125,201,12119,15000,2.00,0.00),(1535,125,166,6270,10000,1.00,0.00),(1536,125,272,2850,6000,2.00,0.00),(1537,125,278,0,15000,2.00,0.00),(1538,125,800,3500,5000,2.00,0.00),(1539,126,136,30000,32000,10.00,0.00),(1569,128,562,0,25000,1.00,0.00),(1570,128,706,0,20000,2.00,0.00),(1571,128,753,58000,8000,20.00,0.00),(1572,128,621,0,7000,2.00,0.00),(1573,128,293,0,2500,3.00,0.00),(1574,128,272,2850,6000,1.00,0.00),(1579,130,12,28936,30000,5.00,0.00),(1580,130,299,4488,6000,5.00,0.00),(1581,130,92,24000,35000,1.00,0.00),(1582,130,270,10800,15000,1.00,0.00),(1583,130,288,4732,6000,1.00,0.00),(1587,132,184,4120,5000,2.00,0.00),(1588,132,390,2431,3000,2.00,0.00),(1589,132,363,2583,15000,1.00,0.00),(1595,135,443,1750,31500,9.00,0.00),(1597,136,120,328680,357000,5.00,0.00),(1598,136,305,312165,345000,3.00,0.00),(1599,136,611,20250,25200,1.00,0.00),(1600,136,548,10000,15000,1.00,0.00),(1601,136,622,175000,204750,1.00,0.00),(1602,136,623,225000,257250,1.00,0.00),(1603,136,804,25000,36750,1.00,0.00),(1604,136,48,11000,57750,5.00,0.00),(1605,136,805,28900,31080,5.00,0.00),(1606,136,8,26766,29400,5.00,0.00),(1607,136,59,13250,15750,2.00,0.00),(1608,136,364,75000,84000,2.00,0.00),(1610,137,526,12550,14000,1.00,0.00),(1611,137,528,25430,29000,1.00,0.00),(1613,138,96,28602,30000,10.00,0.00),(1614,138,803,85000,97500,1.00,0.00),(1615,139,8,26766,26500,5.00,0.00),(1616,139,805,28900,29600,5.00,0.00),(1617,139,61,11542,13750,12.00,0.00),(1618,139,49,30000,40000,5.00,0.00),(1619,140,8,26766,26500,15.00,0.00),(1620,141,20,7292,15000,6.00,0.00),(1621,141,778,3500,5000,12.00,0.00),(1622,142,111,3733,5000,12.00,0.00),(1623,142,420,0,23000,2.00,0.00),(1624,143,44,13250,15000,4.00,0.00),(1625,143,291,5600,8000,5.00,0.00),(1626,143,229,6710,10000,8.00,0.00),(1627,143,112,4417,5000,4.00,0.00),(1628,143,71,6400,10000,10.00,0.00),(1629,143,636,0,10000,2.00,0.00),(1630,143,478,57000,7500,10.00,0.00),(1631,144,300,30000,33000,10.00,0.00),(1632,145,471,49445,52000,4.00,0.00),(1633,145,183,20160,22000,4.00,0.00),(1634,145,182,20160,22000,1.00,0.00),(1635,145,54,2702,3000,5.00,0.00),(1636,145,232,2200,2750,17.00,0.00),(1637,145,8,26766,26500,19.00,0.00),(1638,145,707,5000,3000,5.00,0.00),(1639,145,362,1750,3000,2.00,0.00),(1640,145,17,58000,75000,2.00,0.00),(1641,145,71,6400,8333,5.00,0.00),(1642,145,150,1175,1500,100.00,0.00),(1643,145,743,55000,75000,1.00,0.00),(1644,146,8,26766,26500,1.00,0.00),(1645,147,92,24000,35000,1.00,0.00),(1646,147,200,1801,2500,4.00,0.00),(1647,147,277,0,3000,4.00,0.00),(1648,147,285,3253,5000,4.00,0.00),(1649,147,288,4732,6000,3.00,0.00),(1650,147,286,7671,10000,2.00,0.00),(1651,147,201,12119,15000,1.00,0.00),(1652,147,407,11680,15000,1.00,0.00),(1653,147,806,11000,13000,1.00,0.00),(1654,147,66,7700,10000,2.00,0.00),(1655,147,112,4417,6000,2.00,0.00),(1656,147,276,687,1500,4.00,0.00),(1657,147,293,0,2500,2.00,0.00),(1658,147,98,207783,225500,1.00,0.00),(1659,147,101,206402,219000,1.00,0.00),(1660,147,556,223988,237000,1.00,0.00),(1661,147,12,28936,30000,10.00,0.00),(1662,147,11,32947,33000,5.00,0.00),(1663,147,71,6400,10000,2.00,0.00),(1664,147,60,11605,13750,12.00,0.00),(1665,147,61,11542,13750,12.00,0.00),(1666,147,59,13250,15000,2.00,0.00),(1667,147,44,13250,15000,2.00,0.00),(1668,147,22,12500,15000,3.00,0.00),(1669,147,807,4833,10000,2.00,0.00),(1670,147,370,62000,75000,1.00,0.00),(1671,147,184,4120,5000,3.00,0.00),(1672,147,808,8000,12000,1.00,0.00),(1673,147,636,0,10000,1.00,0.00),(1674,147,132,20757,25000,1.00,0.00),(1675,147,422,78240,84000,1.00,0.00),(1676,147,809,11000,15000,2.00,0.00),(1680,149,12,28936,30000,5.00,0.00),(1681,150,52,20114,25000,7.00,0.00),(1682,129,300,30000,33000,5.00,0.00),(1683,129,801,4000,5000,3.00,0.00),(1684,129,275,0,3000,2.00,0.00),(1685,151,58,13250,15000,2.00,0.00),(1686,151,810,15833,18000,3.00,0.00),(1687,151,54,2702,5000,1.00,0.00),(1688,151,182,20160,24000,1.00,0.00),(1689,151,293,0,2500,2.00,0.00),(1690,151,801,4000,6000,5.00,0.00),(1691,151,112,4417,6000,1.00,0.00),(1692,151,500,10044,12000,1.00,0.00),(1693,151,56,14214,25000,1.00,0.00),(1694,151,71,6400,10000,10.00,0.00),(1695,151,276,687,1500,10.00,0.00),(1696,151,92,24000,35000,1.00,0.00),(1697,151,299,4488,6000,10.00,0.00),(1698,151,811,19000,25000,5.00,0.00),(1699,151,66,7700,10000,7.00,0.00),(1700,151,83,19750,25000,1.00,0.00),(1701,151,67,12430,15000,3.00,0.00),(1702,123,65,78200,93000,1.00,0.00),(1703,123,799,12000,15000,4.00,0.00),(1704,123,776,0,25000,1.00,0.00),(1705,123,478,57000,7500,2.00,0.00),(1706,123,106,14500,18000,1.00,0.00),(1707,123,320,44000,55000,1.00,0.00),(1708,152,98,207783,225500,1.00,0.00),(1709,152,796,337095,360000,1.00,0.00),(1710,152,679,45000,65000,2.00,0.00),(1711,153,299,4488,6300,5.00,0.00),(1712,153,99,6700,8400,1.00,0.00),(1713,153,60,11605,15750,15.00,0.00),(1714,153,812,47500,63000,5.00,0.00),(1715,153,813,39000,63000,2.00,0.00),(1716,153,420,0,24150,1.00,0.00),(1717,154,12,28936,30000,2.00,0.00),(1718,154,796,337095,360000,1.00,0.00),(1788,157,646,0,43000,5.00,0.00),(1789,157,814,0,18000,5.00,0.00),(1790,157,686,0,9000,2.00,0.00),(1791,157,471,49445,53000,3.00,0.00),(1792,157,416,113000,120000,1.00,0.00),(1793,157,637,0,75000,1.00,0.00),(1794,157,198,73500,77000,1.00,0.00),(1795,157,815,0,64000,1.00,0.00),(1796,157,816,15000,20000,2.00,0.00),(1797,157,818,0,2000,12.00,0.00),(1798,157,770,11973,16000,1.00,0.00),(1799,157,576,17260,22000,1.00,0.00),(1800,157,650,75000,80000,1.00,0.00),(1801,157,411,20625,25000,3.00,0.00),(1802,157,821,10654,11000,9.00,0.00),(1803,157,655,0,9000,15.00,0.00),(1804,157,227,14575,19000,9.00,0.00),(1805,157,624,0,1300,20.00,0.00),(1806,157,629,1140,1300,20.00,0.00),(1807,157,628,0,1300,20.00,0.00),(1808,157,825,0,1000,20.00,0.00),(1809,157,824,0,1000,20.00,0.00),(1810,157,826,0,1000,20.00,0.00),(1811,157,823,0,1000,20.00,0.00),(1812,158,26,3300,3833,12.00,0.00),(1813,158,205,3300,3833,12.00,0.00),(1814,158,827,0,108000,1.00,0.00),(1815,158,828,0,120000,1.00,0.00),(1816,158,817,0,16000,1.00,0.00),(1817,158,198,73500,77000,1.00,0.00),(1818,158,44,13250,13750,6.00,0.00),(1819,158,59,13250,13750,6.00,0.00),(1820,158,182,20160,22000,6.00,0.00),(1821,158,583,18720,20000,6.00,0.00),(1822,158,829,0,20000,6.00,0.00),(1823,158,504,0,15833,6.00,0.00),(1824,158,505,0,15833,6.00,0.00),(1825,158,45,15375,15833,6.00,0.00),(1826,158,458,21000,28000,1.00,0.00),(1827,158,831,0,38000,1.00,0.00),(1828,158,415,57120,78000,1.00,0.00),(1829,158,832,0,15000,1.00,0.00),(1830,158,608,107100,120000,1.00,0.00),(1831,158,598,16538,17500,12.00,0.00),(1832,158,354,1900,2500,12.00,0.00),(1833,158,420,0,22000,3.00,0.00),(1834,158,637,0,75000,1.00,0.00),(1835,158,791,9000,10000,10.00,0.00),(1836,158,479,218500,220000,1.00,0.00),(1837,158,768,26880,36000,2.00,0.00),(1838,158,769,28880,36000,2.00,0.00),(1839,158,423,0,12000,3.00,0.00),(1840,158,424,8244,12000,3.00,0.00),(1841,158,641,0,160000,1.00,0.00),(1842,158,833,0,15000,12.00,0.00),(1843,158,770,11973,16000,1.00,0.00),(1844,158,112,4417,5000,12.00,0.00),(1845,158,416,113000,120000,1.00,0.00),(1846,158,646,0,43000,6.00,0.00),(1847,158,31,7125,8250,6.00,0.00),(1848,158,580,4750,5500,6.00,0.00),(1849,159,12,28936,30000,10.00,0.00),(1850,127,12,28936,30000,5.00,0.00),(1851,127,73,26919,31000,5.00,0.00),(1852,127,682,13500,15000,2.00,0.00),(1853,127,353,16000,20000,2.00,0.00),(1854,127,422,78240,130000,4.00,0.00),(1855,127,59,13250,15000,1.00,0.00),(1856,127,413,19550,30000,1.00,0.00),(1857,127,183,20160,24000,2.00,0.00),(1858,127,182,20160,24000,2.00,0.00),(1859,127,358,37000,45000,3.00,0.00),(1860,127,681,13575,17500,5.00,0.00),(1861,127,60,11605,13750,12.00,0.00),(1862,127,182,20160,24000,2.00,0.00),(1863,127,73,26919,31000,5.00,0.00),(1864,127,345,44250,50000,3.00,0.00),(1865,127,283,275000,380000,1.00,0.00),(1866,127,283,275000,380000,2.00,0.00),(1867,127,60,11605,13750,24.00,0.00),(1868,127,329,52000,60000,1.00,0.00),(1869,127,272,2850,6000,2.00,0.00),(1870,127,697,0,45000,1.00,0.00),(1871,127,146,29600,38000,1.00,0.00),(1872,127,30,81500,95000,1.00,0.00),(1873,127,12,28936,30000,3.00,0.00),(1874,127,11,32947,33000,1.00,0.00),(1875,127,17,58000,80000,1.00,0.00),(1876,127,202,3890,6000,4.00,0.00),(1877,127,792,0,45000,1.00,0.00),(1878,127,293,0,2500,2.00,0.00),(1879,160,71,6400,10000,10.00,0.00),(1882,161,622,175000,185000,12.00,0.00),(1883,161,623,225000,235000,5.00,0.00);
/*!40000 ALTER TABLE `sale_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_payment`
--

DROP TABLE IF EXISTS `sale_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `invoice_no` varchar(13) DEFAULT NULL,
  `debet` smallint(5) unsigned DEFAULT NULL,
  `credit` smallint(5) unsigned DEFAULT NULL,
  `amount` int(10) NOT NULL,
  `note` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `debet` (`debet`),
  KEY `credit` (`credit`),
  CONSTRAINT `fk-sp-acc-cr` FOREIGN KEY (`credit`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-sp-acc-dr` FOREIGN KEY (`debet`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-sp-user-01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-sp-user-02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_payment`
--

LOCK TABLES `sale_payment` WRITE;
/*!40000 ALTER TABLE `sale_payment` DISABLE KEYS */;
INSERT INTO `sale_payment` VALUES (1,5,'SP161031-sssc',1,NULL,2302500,'','2016-10-31','2016-10-31',1,NULL,NULL),(2,4,'SP161031-sssh',1,NULL,575000,'','2016-10-31','2016-10-31',1,NULL,NULL),(3,10,'SP161102-sssc',1,NULL,1790500,'CASH','2016-11-02','2016-11-02',1,NULL,NULL),(4,14,'SP161103-sssc',1,NULL,210000,'CASH','2016-11-03','2016-11-03',1,NULL,NULL),(5,28,'SP161103-sssh',1,NULL,1900000,'CASH','2016-11-03','2016-11-03',1,NULL,NULL),(6,35,'SP161104-sssc',1,NULL,20000,'CASH','2016-11-04','2016-11-04',1,NULL,NULL),(7,38,'SP161104-sssh',1,NULL,300000,'CASH','2016-11-04','2016-11-04',1,NULL,NULL),(8,40,'SP161105-sssc',1,NULL,1700000,'','2016-11-05','2016-11-05',1,NULL,NULL),(9,45,'SP161105-sssh',1,NULL,125000,'','2016-11-05','2016-11-05',1,NULL,NULL),(10,70,'SP161108-sssc',4,NULL,2534238,'','2016-11-07','2016-11-08',8,NULL,NULL),(11,44,'SP161108-sssh',1,NULL,190000,'','2016-11-08','2016-11-08',8,NULL,NULL),(12,15,'SP161108-sssa',1,NULL,550000,'','2016-11-08','2016-11-08',8,'2016-11-08',8),(13,16,'SP161108-sssn',1,NULL,468000,'','2016-11-08','2016-11-08',8,NULL,NULL),(14,13,'SP161108-sssd',1,NULL,744250,'','2016-11-04','2016-11-08',8,NULL,NULL),(15,12,'SP161108-sssr',1,NULL,500500,'','2016-11-06','2016-11-08',8,NULL,NULL),(16,71,'SP161108-sssi',1,NULL,486000,'','2016-11-07','2016-11-08',8,NULL,NULL),(17,72,'SP161108-sssk',1,NULL,316500,'','2016-11-07','2016-11-08',8,NULL,NULL),(18,37,'SP161108-sssu',1,NULL,165000,'','2016-11-04','2016-11-08',8,NULL,NULL),(19,18,'SP161108-sscs',1,NULL,165000,'','2016-11-03','2016-11-08',8,NULL,NULL),(20,106,'SP161108-sscc',1,NULL,280000,'CASH','2016-11-08','2016-11-08',9,NULL,NULL),(21,59,'SP161108-ssch',2,NULL,150000,'','2016-11-08','2016-11-08',8,NULL,NULL),(22,51,'SP161108-ssca',1,NULL,1041000,'','2016-11-08','2016-11-08',8,NULL,NULL),(23,108,'SP161108-sscn',1,NULL,57500,'CASH','2016-11-08','2016-11-08',8,NULL,NULL),(24,101,'SP161108-sscd',1,NULL,230500,'','2016-11-08','2016-11-08',8,NULL,NULL),(25,128,'SP161109-sssc',1,NULL,252500,'CASH','2016-11-09','2016-11-09',9,NULL,NULL),(26,139,'SP161109-sssh',1,NULL,645500,'CASH','2016-11-09','2016-11-09',9,NULL,NULL);
/*!40000 ALTER TABLE `sale_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_receipt`
--

DROP TABLE IF EXISTS `sale_receipt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale_receipt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(13) DEFAULT NULL,
  `customer_id` smallint(5) unsigned DEFAULT NULL,
  `total` int(10) NOT NULL,
  `printed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `fk_sr_customer_01` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_sr_user_01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_sr_user_02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_receipt`
--

LOCK TABLES `sale_receipt` WRITE;
/*!40000 ALTER TABLE `sale_receipt` DISABLE KEYS */;
INSERT INTO `sale_receipt` VALUES (1,'ST161108-sssk',230,720500,2,'2016-11-08','2016-11-08',9,'2016-11-08',9);
/*!40000 ALTER TABLE `sale_receipt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_return`
--

DROP TABLE IF EXISTS `sale_return`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale_return` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(13) NOT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `print` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0: waiting for approval, 1: approved',
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_no` (`invoice_no`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `fk-sr-so-01` FOREIGN KEY (`order_id`) REFERENCES `sale_order` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-sr-user-01` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-sr-user-02` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_return`
--

LOCK TABLES `sale_return` WRITE;
/*!40000 ALTER TABLE `sale_return` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale_return` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_return_detail`
--

DROP TABLE IF EXISTS `sale_return_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale_return_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `return_id` int(10) unsigned DEFAULT NULL,
  `order_detail_id` int(10) unsigned DEFAULT NULL,
  `quantity` double(7,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `return_id` (`return_id`),
  KEY `sale_detail_id` (`order_detail_id`),
  CONSTRAINT `fk-srd-sod-01` FOREIGN KEY (`order_detail_id`) REFERENCES `sale_order_detail` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-srd-sr-01` FOREIGN KEY (`return_id`) REFERENCES `sale_return` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_return_detail`
--

LOCK TABLES `sale_return_detail` WRITE;
/*!40000 ALTER TABLE `sale_return_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale_return_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `email` varchar(48) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `city_id` smallint(5) unsigned DEFAULT NULL,
  `province_id` tinyint(3) unsigned DEFAULT NULL,
  `zip_code` int(6) unsigned DEFAULT NULL,
  `term_of_payment_id` tinyint(3) unsigned DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (3,'PT. Sinarjaya Makmur Mandiri ',' ','44268','Jl. Lingkar ',1,7,NULL,4,NULL,'Ext 106 '),(4,'TOKO BENANG MAS ','','','Pasar Jambi ',1,7,NULL,4,NULL,'BELI TALI IKAT UANG '),(5,'Putra KK ','','','',2,6,NULL,4,NULL,''),(6,'CHG ','','','Jakarta ',2,6,NULL,4,NULL,'Nama Sales : Handi '),(7,'Inti Komputer ','','','',1,7,NULL,4,NULL,'Sales name : Suandi '),(8,'HIMALAYA ','','','',2,6,NULL,4,NULL,'PEMBAYARAN TRANSFER BCA 467 149 0007 Yenny Cowandy '),(9,'ASIA JAYA ','','','',2,6,NULL,4,NULL,'Pita PRINTER MARK PRINTER '),(10,'Sinar Apollo','','0711352090','',3,32,NULL,4,NULL,'KALKULATOR CASIO & CITIZEN REK BCA 0450557986 SURY JANTO '),(11,'Andy Stationery','','','',2,6,NULL,4,NULL,'Transfer Ng Bing Hwie BCA 4811046889'),(12,'Dwi Jaya ','','','',2,6,NULL,4,NULL,''),(13,'RAJAWALI','','','',2,6,NULL,4,NULL,'Fullmark & Hologram ( ko Ahong ) '),(14,'PAGODA JAYA ','','','',1,7,NULL,4,NULL,'KESI 0823-7333-0457 '),(15,'ATALI MAKMUR ( JOYKO ) ','','','',2,6,NULL,4,NULL,'JOYKO  NATHAN '),(16,'PELITA ELEKTONIK ','','','',2,6,NULL,4,NULL,'NINA '),(17,'PT. Dwi Maju ','','','Jl. Roa Malaka Utara no. 14 Tambora Jakarta ',2,6,11230,4,NULL,''),(18,'Surya Mas ','','','',2,6,NULL,4,NULL,''),(19,'TOKO MATAHARI','','0711356821-362543','',3,32,NULL,4,NULL,''),(20,'Ananda ','','','ITC Mangga Dua Lantai Dasar , Blok E2 no 72-73 ',2,6,NULL,4,NULL,''),(21,'ACC ANDI ','','','Jl. Tiang Bendera 4 no. 34 e',2,6,NULL,4,NULL,''),(22,'BINTANG SAUDARA ','','','',2,6,NULL,4,NULL,''),(23,'MATAHARI ','','','',4,32,NULL,4,NULL,''),(24,'UD. MARIBAYA ','','0711-368393','',4,32,NULL,3,NULL,'PENA PILOT '),(25,'PT. SIP (CADWELL) ','','','',5,10,NULL,4,NULL,''),(26,'Prima Saudara (Kangaro) ','','061-4551882','Jl. Palangkaraya No. 109A/36',6,33,NULL,4,NULL,''),(27,'Eleven Computer ','','','',1,7,NULL,4,NULL,''),(28,'Sahabat Sejati (ESCO) ','','','',2,6,NULL,4,NULL,''),(29,'PT. SURYAINDAH WIRAPERKASA','','','Jl. Bypass Alang - Alang Lebar , Blok B11 Palembang ',4,32,30154,4,NULL,'Beli clip file , spring file '),(30,'PT. Bino Mitra Sejati (BANTEX) ','','','',4,32,NULL,4,NULL,'Sales name : Suwandi '),(31,'PT. Gading Murni ','gadingmurni_jkt@yahoo.com','0213504985','Jl. Tanah Abang IV/12',2,6,10160,4,NULL,''),(32,'Liman Jaya Stationery ( SNOWMAN ','','0216900266 / 08881366820 ','',2,6,NULL,4,NULL,''),(33,'Remaja Jaya ','','','',2,6,NULL,4,NULL,''),(34,'DELI STATIONERY','','','Jelutung ',1,7,NULL,4,NULL,''),(35,'TOKO ABADI BERSAMA/FABER CASTELL','','','PALEMBANG',4,32,NULL,4,NULL,'Sales name : ERWIN TRF REK BCA 0212952808 (ERIC PRANOLO)'),(36,'GARDA MAS / VOLTA ','','','',2,6,NULL,4,NULL,''),(37,'Putra Harapan Sukses ','','','',2,6,NULL,4,NULL,''),(38,'CV. Multikom','','','',4,32,NULL,3,NULL,''),(39,'PT. Kalindo Sukses ( Calc Joyko)','','','',2,6,NULL,4,NULL,''),(40,'ACL ( Paperone) ','','0711317341','',4,32,NULL,4,NULL,'Anugerah Cemerlang Lestari '),(41,'DB (Debozz) Stationery','','','',2,6,NULL,5,NULL,''),(42,'MESTIKA DHARMA','','','',6,30,NULL,4,NULL,''),(43,'PT. Bintang Baru Sejahtera','','','',1,7,NULL,4,NULL,''),(44,'TOKO LIMAS','','','',1,7,NULL,4,NULL,'BELI TALI RAFIA '),(45,'MARI JAYA ','','','',1,7,NULL,6,NULL,''),(46,'INTEGRA','','','',2,6,NULL,4,NULL,''),(47,'Guna Jaya Ribbon','','021-6121606-07','',2,6,NULL,4,NULL,''),(48,'PT.Segarprima laksana','','','',1,7,NULL,3,NULL,''),(54,'PT.Trimegah pilar perkasa','','','',2,6,NULL,5,NULL,'');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax`
--

DROP TABLE IF EXISTS `tax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(8) NOT NULL,
  `name` varchar(32) NOT NULL,
  `amount` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax`
--

LOCK TABLES `tax` WRITE;
/*!40000 ALTER TABLE `tax` DISABLE KEYS */;
/*!40000 ALTER TABLE `tax` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `term_of_payment`
--

DROP TABLE IF EXISTS `term_of_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `term_of_payment` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `name` varchar(24) NOT NULL,
  `amount` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `term_of_payment`
--

LOCK TABLES `term_of_payment` WRITE;
/*!40000 ALTER TABLE `term_of_payment` DISABLE KEYS */;
INSERT INTO `term_of_payment` VALUES (1,'CASH','Tunai',0),(2,'TOP3','Kredit 3',3),(3,'TOP7','Kredit 7',7),(4,'K30','Kredit 30 ',30),(5,'K60','Kredit 60',60),(6,'K14','Kredit 14 ',14);
/*!40000 ALTER TABLE `term_of_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` smallint(5) unsigned NOT NULL,
  `branch_id` tinyint(3) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,2,1,'mike','W4KVWldzE8U09NsjClkAD-bSuMscLUeQ','$2y$13$tf8WUkTvozA4aT7OUdmDg.MeS3iVpid9w5M2b7.RM036WoOOAXT.W',NULL,'mike@a.com',10,10,1419223312,1459937951),(2,4,1,'chandra1','YNLAha7tPg4UBhA1eAxO5iDDAoHAqZxL','$2y$13$kFcNS2q20vREpvgGkv4nNOgKdeBv8mWK.pBdhom9nl2xCpxbUeKf2',NULL,'atkjambi@gmail.com',10,10,1419223993,1461244845),(4,6,1,'LARAS','QX1mMKXVBJ2bEfAHC-1xmg2vJNoGOHcd','$2y$13$w1BgsxE3gCGjCJGPQaYOJuHTDdtJvsOvf2irqW.DObCz8ZPHBcVam',NULL,'nusantara.tour@yahoo.co.id',10,10,1420118327,1420160134),(5,1,1,'tonny','_niGQ5puw3IDWCKAi0zgp9fyjuyRbCj5','$2y$13$VAVhe08fOltOILjewXXvveSuNrpmUWgPMnRWMTJXInvWi/kZgRRFm',NULL,'a@a.com',10,10,1457708718,1476974776),(6,3,1,'steffi','4-mhGPqT2-x-QZNP_cYvDbLNY7B1v05c','$2y$13$Ac/.0jW5VGGFi3KGYRR4n.WWw3GYpAvJ.D0kMztumdKl4jRTGaokW',NULL,'b@gmail.com',20,10,1459872079,1459876710),(7,8,1,'michael','QvdZfrpkDAtyLhuOYdf3-hzIH7g4TmVd','$2y$13$5G6AzN3LPrAZHc4CgxwFPeY75jbhCoKJ.fvR/ERNFQkmotasM1eo2',NULL,'atk@jambi.com',10,10,1461284872,1461284872),(8,4,1,'chandra','tYRzMHOMvSVJv1BiSClDug83Y6c1Qv6I','$2y$13$2enxulu/mgfd6iqIUMXOq.3V7qmKbsm3CwbXA8Fvt9XGkuU8sxgt2',NULL,'lll@gmail.com',10,10,1478320023,1478320023),(9,3,1,'steffichandra','9t4VZLTzK8kvTrasaUFtcXPkQ3JZilUZ','$2y$13$v.FksNnKF8RBIWAldOy9Yuj2M0tyxldwfbEyujRBAL0trejDysy5a',NULL,'mmm@gmail.com',10,10,1478426889,1478426889);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-10 10:40:10
