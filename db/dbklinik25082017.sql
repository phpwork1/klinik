/*
SQLyog Enterprise - MySQL GUI v7.15 
MySQL - 5.5.5-10.1.19-MariaDB : Database - dbklinik2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `account` */

DROP TABLE IF EXISTS `account`;

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

/*Data for the table `account` */

insert  into `account`(`id`,`category_id`,`code`,`name`,`beginning_balance`,`created_at`,`updated_at`) values (1,1,'KAS','KAS',5000000,'2013-11-27','2013-11-27'),(2,1,NULL,'PIUTANG USAHA',0,'2013-11-25','2013-11-25'),(3,1,NULL,'BANK BCA',0,'2013-11-27','2013-11-27'),(4,1,NULL,'BANK MANDIRI',0,'2013-11-27','2013-11-27'),(5,12,NULL,'BEBAN LISTRIK',0,'2013-12-03','2013-11-28'),(6,12,NULL,'BEBAN AIR',0,'2013-12-01','2013-12-05'),(7,10,NULL,'PENJUALAN',0,'2015-08-28',NULL),(8,12,NULL,'PEMBELIAN',0,'2015-08-28',NULL),(9,11,'PDLU','PENDAPATAN LAIN-LAIN',0,'2015-08-28',NULL),(10,6,'123','HUTANG PEMBELIAN',0,'2015-09-05',NULL),(11,13,'500','PENGELUARAN',100000,'2015-09-06',NULL),(12,11,'PDT','Undian BCA',0,'2015-09-06',NULL),(13,11,'TIPS','TIPS',0,'2015-09-06',NULL),(14,1,'KAS','GIRO BANK DANAMON',0,NULL,NULL),(15,1,'KAS','GIRO BANK BTN',0,NULL,NULL);

/*Table structure for table `account_category` */

DROP TABLE IF EXISTS `account_category`;

CREATE TABLE `account_category` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` tinyint(2) unsigned NOT NULL,
  `code` varchar(4) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `fc-ac-ag` FOREIGN KEY (`group_id`) REFERENCES `account_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `account_category` */

insert  into `account_category`(`id`,`group_id`,`code`,`name`) values (1,1,'HALC','HARTA LANCAR'),(2,1,'HAI','HARTA INVESTASI'),(3,1,'HATB','HARTA TAK BERWUJUD'),(4,1,'HAT','HARTA TETAP'),(5,1,'HAL','HARTA LAINNYA'),(6,2,'HUC','HUTANG LANCAR'),(7,2,'HUJP','HUTANG JANGKA PANJANG'),(8,2,'HULL','HUTANG LAIN-LAIN'),(9,3,'MDL','MODAL'),(10,4,'PU','PENDAPATAN USAHA'),(11,4,'PLU','PENDAPATAN DI LUAR USAHA'),(12,5,'BU','BEBAN USAHA'),(13,5,'BLU','BEBAN DI LUAR USAHA');

/*Table structure for table `account_group` */

DROP TABLE IF EXISTS `account_group`;

CREATE TABLE `account_group` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(4) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `account_group` */

insert  into `account_group`(`id`,`code`,`name`) values (1,'ASET','ASET/HARTA'),(2,'KWJB','KEWAJIBAN'),(3,'EQTS','EQUITAS'),(4,'PDPT','PENDAPATAN'),(5,'PGLR','PENGELUARAN'),(6,'BDA','BIAYA DEPRESIASI DAN AMORTASI'),(7,'LAIN','LAIN');

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_assignment` */

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

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

/*Data for the table `auth_item` */

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_item_child` */

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_rule` */

/*Table structure for table `bill_footer` */

DROP TABLE IF EXISTS `bill_footer`;

CREATE TABLE `bill_footer` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `footer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bill_footer` */

/*Table structure for table `clinical_action` */

DROP TABLE IF EXISTS `clinical_action`;

CREATE TABLE `clinical_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ca_name` varchar(40) NOT NULL,
  `ca_cost` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `clinical_action` */

insert  into `clinical_action`(`id`,`ca_name`,`ca_cost`) values (1,'Layanan 2',50000);

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `country` */

insert  into `country`(`id`,`code`,`name`) values (1,'AF','Afghanistan'),(2,'AL','Albania'),(3,'DZ','Algeria'),(4,'DS','American Samoa'),(5,'AD','Andorra'),(6,'AO','Angola'),(7,'AI','Anguilla'),(8,'AQ','Antarctica'),(9,'AG','Antigua and Barbuda'),(10,'AR','Argentina'),(11,'AM','Armenia'),(12,'AW','Aruba'),(13,'AU','Australia'),(14,'AT','Austria'),(15,'AZ','Azerbaijan'),(16,'BS','Bahamas'),(17,'BH','Bahrain'),(18,'BD','Bangladesh'),(19,'BB','Barbados'),(20,'BY','Belarus'),(21,'BE','Belgium'),(22,'BZ','Belize'),(23,'BJ','Benin'),(24,'BM','Bermuda'),(25,'BT','Bhutan'),(26,'BO','Bolivia'),(27,'BA','Bosnia and Herzegovina'),(28,'BW','Botswana'),(29,'BV','Bouvet Island'),(30,'BR','Brazil'),(31,'IO','British Indian Ocean Territory'),(32,'BN','Brunei Darussalam'),(33,'BG','Bulgaria'),(34,'BF','Burkina Faso'),(35,'BI','Burundi'),(36,'KH','Cambodia'),(37,'CM','Cameroon'),(38,'CA','Canada'),(39,'CV','Cape Verde'),(40,'KY','Cayman Islands'),(41,'CF','Central African Republic'),(42,'TD','Chad'),(43,'CL','Chile'),(44,'CN','China'),(45,'CX','Christmas Island'),(46,'CC','Cocos (Keeling) Islands'),(47,'CO','Colombia'),(48,'KM','Comoros'),(49,'CG','Congo'),(50,'CK','Cook Islands'),(51,'CR','Costa Rica'),(52,'HR','Croatia (Hrvatska)'),(53,'CU','Cuba'),(54,'CY','Cyprus'),(55,'CZ','Czech Republic'),(56,'DK','Denmark'),(57,'DJ','Djibouti'),(58,'DM','Dominica'),(59,'DO','Dominican Republic'),(60,'TP','East Timor'),(61,'EC','Ecuador'),(62,'EG','Egypt'),(63,'SV','El Salvador'),(64,'GQ','Equatorial Guinea'),(65,'ER','Eritrea'),(66,'EE','Estonia'),(67,'ET','Ethiopia'),(68,'FK','Falkland Islands (Malvinas)'),(69,'FO','Faroe Islands'),(70,'FJ','Fiji'),(71,'FI','Finland'),(72,'FR','France'),(73,'FX','France, Metropolitan'),(74,'GF','French Guiana'),(75,'PF','French Polynesia'),(76,'TF','French Southern Territories'),(77,'GA','Gabon'),(78,'GM','Gambia'),(79,'GE','Georgia'),(80,'DE','Germany'),(81,'GH','Ghana'),(82,'GI','Gibraltar'),(83,'GK','Guernsey'),(84,'GR','Greece'),(85,'GL','Greenland'),(86,'GD','Grenada'),(87,'GP','Guadeloupe'),(88,'GU','Guam'),(89,'GT','Guatemala'),(90,'GN','Guinea'),(91,'GW','Guinea-Bissau'),(92,'GY','Guyana'),(93,'HT','Haiti'),(94,'HM','Heard and Mc Donald Islands'),(95,'HN','Honduras'),(96,'HK','Hong Kong'),(97,'HU','Hungary'),(98,'IS','Iceland'),(99,'IN','India'),(100,'IM','Isle of Man'),(101,'ID','Indonesia'),(102,'IR','Iran (Islamic Republic of)'),(103,'IQ','Iraq'),(104,'IE','Ireland'),(105,'IL','Israel'),(106,'IT','Italy'),(107,'CI','Ivory Coast'),(108,'JE','Jersey'),(109,'JM','Jamaica'),(110,'JP','Japan'),(111,'JO','Jordan'),(112,'KZ','Kazakhstan'),(113,'KE','Kenya'),(114,'KI','Kiribati'),(115,'KP','Korea, Democratic People\'s Republic '),(116,'KR','Korea, Republic of'),(117,'XK','Kosovo'),(118,'KW','Kuwait'),(119,'KG','Kyrgyzstan'),(120,'LA','Lao People\'s Democratic Republic'),(121,'LV','Latvia'),(122,'LB','Lebanon'),(123,'LS','Lesotho'),(124,'LR','Liberia'),(125,'LY','Libyan Arab Jamahiriya'),(126,'LI','Liechtenstein'),(127,'LT','Lithuania'),(128,'LU','Luxembourg'),(129,'MO','Macau'),(130,'MK','Macedonia'),(131,'MG','Madagascar'),(132,'MW','Malawi'),(133,'MY','Malaysia'),(134,'MV','Maldives'),(135,'ML','Mali'),(136,'MT','Malta'),(137,'MH','Marshall Islands'),(138,'MQ','Martinique'),(139,'MR','Mauritania'),(140,'MU','Mauritius'),(141,'TY','Mayotte'),(142,'MX','Mexico'),(143,'FM','Micronesia, Federated States of'),(144,'MD','Moldova, Republic of'),(145,'MC','Monaco'),(146,'MN','Mongolia'),(147,'ME','Montenegro'),(148,'MS','Montserrat'),(149,'MA','Morocco'),(150,'MZ','Mozambique'),(151,'MM','Myanmar'),(152,'NA','Namibia'),(153,'NR','Nauru'),(154,'NP','Nepal'),(155,'NL','Netherlands'),(156,'AN','Netherlands Antilles'),(157,'NC','New Caledonia'),(158,'NZ','New Zealand'),(159,'NI','Nicaragua'),(160,'NE','Niger'),(161,'NG','Nigeria'),(162,'NU','Niue'),(163,'NF','Norfolk Island'),(164,'MP','Northern Mariana Islands'),(165,'NO','Norway'),(166,'OM','Oman'),(167,'PK','Pakistan'),(168,'PW','Palau'),(169,'PS','Palestine'),(170,'PA','Panama'),(171,'PG','Papua New Guinea'),(172,'PY','Paraguay'),(173,'PE','Peru'),(174,'PH','Philippines'),(175,'PN','Pitcairn'),(176,'PL','Poland'),(177,'PT','Portugal'),(178,'PR','Puerto Rico'),(179,'QA','Qatar'),(180,'RE','Reunion'),(181,'RO','Romania'),(182,'RU','Russian Federation'),(183,'RW','Rwanda'),(184,'KN','Saint Kitts and Nevis'),(185,'LC','Saint Lucia'),(186,'VC','Saint Vincent and the Grenadines'),(187,'WS','Samoa'),(188,'SM','San Marino'),(189,'ST','Sao Tome and Principe'),(190,'SA','Saudi Arabia'),(191,'SN','Senegal'),(192,'RS','Serbia'),(193,'SC','Seychelles'),(194,'SL','Sierra Leone'),(195,'SG','Singapore'),(196,'SK','Slovakia'),(197,'SI','Slovenia'),(198,'SB','Solomon Islands'),(199,'SO','Somalia'),(200,'ZA','South Africa'),(201,'GS','South Georgia South Sandwich Islands'),(202,'ES','Spain'),(203,'LK','Sri Lanka'),(204,'SH','St. Helena'),(205,'PM','St. Pierre and Miquelon'),(206,'SD','Sudan'),(207,'SR','Suriname'),(208,'SJ','Svalbard and Jan Mayen Islands'),(209,'SZ','Swaziland'),(210,'SE','Sweden'),(211,'CH','Switzerland'),(212,'SY','Syrian Arab Republic'),(213,'TW','Taiwan'),(214,'TJ','Tajikistan'),(215,'TZ','Tanzania, United Republic of'),(216,'TH','Thailand'),(217,'TG','Togo'),(218,'TK','Tokelau'),(219,'TO','Tonga'),(220,'TT','Trinidad and Tobago'),(221,'TN','Tunisia'),(222,'TR','Turkey'),(223,'TM','Turkmenistan'),(224,'TC','Turks and Caicos Islands'),(225,'TV','Tuvalu'),(226,'UG','Uganda'),(227,'UA','Ukraine'),(228,'AE','United Arab Emirates'),(229,'GB','United Kingdom'),(230,'US','United States'),(231,'UM','United States minor outlying islands'),(232,'UY','Uruguay'),(233,'UZ','Uzbekistan'),(234,'VU','Vanuatu'),(235,'VA','Vatican City State'),(236,'VE','Venezuela'),(237,'VN','Vietnam'),(238,'VG','Virgin Islands (British)'),(239,'VI','Virgin Islands (U.S.)'),(240,'WF','Wallis and Futuna Islands'),(241,'EH','Western Sahara'),(242,'YE','Yemen'),(243,'ZR','Zaire'),(244,'ZM','Zambia'),(245,'ZW','Zimbabwe');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) NOT NULL,
  `c_phone_number` int(11) NOT NULL,
  `c_address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`id`,`c_name`,`c_phone_number`,`c_address`) values (1,'Pelanggan 1',812,'Jalan 1');

/*Table structure for table `diagnosis` */

DROP TABLE IF EXISTS `diagnosis`;

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `d_name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `diagnosis` */

insert  into `diagnosis`(`id`,`d_name`) values (1,'HIPERTENSI');

/*Table structure for table `drug_allergies` */

DROP TABLE IF EXISTS `drug_allergies`;

CREATE TABLE `drug_allergies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `da_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_drug_allergies_patient` (`patient_id`),
  KEY `FK_drug_allergies_registration` (`registration_id`),
  CONSTRAINT `FK_drug_allergies_patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  CONSTRAINT `FK_drug_allergies_registration` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `drug_allergies` */

insert  into `drug_allergies`(`id`,`patient_id`,`registration_id`,`da_name`) values (26,1,19,'12');

/*Table structure for table `item` */

DROP TABLE IF EXISTS `item`;

CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_category_id` int(11) NOT NULL,
  `i_name` varchar(50) NOT NULL,
  `i_barcode` varchar(200) DEFAULT NULL,
  `i_description` text,
  `i_factory` varchar(50) DEFAULT NULL,
  `i_buy_price` int(11) NOT NULL,
  `i_sell_price` int(11) NOT NULL,
  `i_ppn` int(3) DEFAULT NULL,
  `i_retail_price` int(11) DEFAULT NULL,
  `i_net_price` int(11) DEFAULT NULL,
  `i_blend_price` int(11) DEFAULT NULL,
  `i_stock_amount` int(8) NOT NULL,
  `i_unit` varchar(30) DEFAULT NULL,
  `i_stock_min` int(8) DEFAULT NULL,
  `i_stock_max` int(8) DEFAULT NULL,
  `i_blended` int(1) NOT NULL,
  `i_expired_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_item_category` (`item_category_id`),
  CONSTRAINT `FK_item_item_category` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `item` */

insert  into `item`(`id`,`item_category_id`,`i_name`,`i_barcode`,`i_description`,`i_factory`,`i_buy_price`,`i_sell_price`,`i_ppn`,`i_retail_price`,`i_net_price`,`i_blend_price`,`i_stock_amount`,`i_unit`,`i_stock_min`,`i_stock_max`,`i_blended`,`i_expired_date`) values (1,2,'Barang 1',NULL,'Deskripsi 1','Pabrik 1',11500,15121,1000,10000,1540,15467,100,'Tab',100,120,0,'2017-08-01'),(2,1,'Barang 2',NULL,'123','123',123,32,23,32,23,23,123,'123',23,23,1,'2017-08-09'),(3,1,'Barang 3',NULL,'123','awd',123213,123,123,123,123,123,123,'awd',12,3123,1,'1970-01-01');

/*Table structure for table `item_category` */

DROP TABLE IF EXISTS `item_category`;

CREATE TABLE `item_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ic_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `item_category` */

insert  into `item_category`(`id`,`ic_name`) values (1,'NON OTC'),(2,'OTC'),(3,'RACIKAN');

/*Table structure for table `job` */

DROP TABLE IF EXISTS `job`;

CREATE TABLE `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `j_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `job` */

insert  into `job`(`id`,`j_name`) values (1,'KARYAWAN SWASTA'),(2,'WIRASWASTA'),(3,'IBU RUMAH TANGGA'),(4,'PELAJAR'),(5,'MAHASISWA / I'),(6,'DOSEN / GURU'),(7,'PNS'),(8,'TNI / POLRI');

/*Table structure for table `parameter` */

DROP TABLE IF EXISTS `parameter`;

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

/*Data for the table `parameter` */

insert  into `parameter`(`id`,`name`,`address`,`city`,`province`,`zip_code`,`phone`,`mobile`,`pin`,`facebook`,`twitter`,`logo`,`slogan`,`app_name`,`header`,`footer`,`invoice_printer`,`receipt_printer`,`reset_username`,`reset_password`,`empty_username`,`empty_password`) values (1,'Aneka Stationery','Jl. Halim Perdana Kusuma','Jambi','Jambi',0,'5911191','','','','','','Kami Melayani Lebih Baik','Aneka','','','1','1','','','','');

/*Table structure for table `patient` */

DROP TABLE IF EXISTS `patient`;

CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_medical_number` varchar(10) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_pob` varchar(20) NOT NULL,
  `p_dob` date NOT NULL,
  `p_gender` int(1) NOT NULL,
  `religion_id` int(11) NOT NULL,
  `p_address` varchar(100) NOT NULL,
  `p_postal_code` int(10) NOT NULL,
  `p_contact_number` int(15) NOT NULL,
  `job_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `p_ref` varchar(150) DEFAULT NULL,
  `p_registration_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `patient` */

insert  into `patient`(`id`,`p_medical_number`,`p_name`,`p_pob`,`p_dob`,`p_gender`,`religion_id`,`p_address`,`p_postal_code`,`p_contact_number`,`job_id`,`patient_id`,`p_ref`,`p_registration_date`) values (1,'P.00001','Pasien 1','Jambi','2023-02-16',0,1,'a',36142,154345,6,NULL,NULL,'2017-08-11'),(2,'P.00002','Passien 2','Jambi','2017-08-10',0,5,'Alamat 1',36142,124621,6,1,NULL,'2017-08-11'),(3,'P.00003','Pasien 3','jambi','2017-08-23',1,1,'1',2,3,6,1,NULL,'2017-08-22'),(4,'P.00004','Pasien 4','jmaib','2017-08-22',0,1,'12',3,4,6,1,NULL,'2017-08-22'),(5,'P.00005','Pasien 5','as','2017-08-09',0,1,'21',12,12,6,1,NULL,'2017-08-23'),(6,'P.00006','Pasien 6','a','2017-08-22',0,1,'12',12,12,6,1,NULL,'2017-08-23');

/*Table structure for table `person` */

DROP TABLE IF EXISTS `person`;

CREATE TABLE `person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regency` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marriage_status` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `educational_level` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dicipline` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `majoring` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bbm` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact_name` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact_number` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(72) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` smallint(5) unsigned DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` smallint(5) unsigned DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regency_id` (`regency`),
  KEY `province_id` (`province`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `person` */

insert  into `person`(`id`,`name`,`address`,`regency`,`province`,`country`,`birth_date`,`gender`,`religion`,`marriage_status`,`nationality`,`educational_level`,`dicipline`,`profession`,`majoring`,`email`,`mobile`,`phone`,`whatsapp`,`fb`,`bbm`,`line`,`skype`,`emergency_contact_name`,`emergency_contact_number`,`photo`,`created_at`,`created_by`,`updated_at`,`updated_by`,`deleted_at`,`deleted_by`) values (1,'Tonny Sofijan','Jl. H.M.O. Bapadal no.39 RT/RW 12/05,, Cempaka Putih, Jelutung','1571','15','101','1982-06-30','1','Buddha','1','Indonesia','Es Teler','Computer Science','Web Developer','IT','tonny.chua@gmail.com','+628192588008','6274121292','','','','','','Rita','+6281919089489','595680be5e9998.30790825.jpg','2017-06-07 15:22:20',20,'2017-08-10 12:22:23',20,NULL,NULL),(3,'Joshua Saputra','Jln Kol Pol M Taher','Kota Jambi','Jambi','Jambi','1995-07-01','1','Buddhist','1','Indonesian','Bachelor','Computer Science','Programmer','Computer Science','joshuasaputra88@yahoo.com','081295066998','','','','','','','Someone','0812','598becf10ca505.21282742.jpg','2017-08-10 12:19:45',20,NULL,NULL,NULL,NULL);

/*Table structure for table `practice_action` */

DROP TABLE IF EXISTS `practice_action`;

CREATE TABLE `practice_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pa_name` varchar(40) NOT NULL,
  `pa_cost` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `practice_action` */

insert  into `practice_action`(`id`,`pa_name`,`pa_cost`) values (1,'SUNTIKAN B',40000);

/*Table structure for table `province` */

DROP TABLE IF EXISTS `province`;

CREATE TABLE `province` (
  `id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `province` */

insert  into `province`(`id`,`name`) values ('11','ACEH'),('12','SUMATERA UTARA'),('13','SUMATERA BARAT'),('14','RIAU'),('15','JAMBI'),('16','SUMATERA SELATAN'),('17','BENGKULU'),('18','LAMPUNG'),('19','KEPULAUAN BANGKA BELITUNG'),('21','KEPULAUAN RIAU'),('31','DKI JAKARTA'),('32','JAWA BARAT'),('33','JAWA TENGAH'),('34','DI YOGYAKARTA'),('35','JAWA TIMUR'),('36','BANTEN'),('51','BALI'),('52','NUSA TENGGARA BARAT'),('53','NUSA TENGGARA TIMUR'),('61','KALIMANTAN BARAT'),('62','KALIMANTAN TENGAH'),('63','KALIMANTAN SELATAN'),('64','KALIMANTAN TIMUR'),('65','KALIMANTAN UTARA'),('71','SULAWESI UTARA'),('72','SULAWESI TENGAH'),('73','SULAWESI SELATAN'),('74','SULAWESI TENGGARA'),('75','GORONTALO'),('76','SULAWESI BARAT'),('81','MALUKU'),('82','MALUKU UTARA'),('91','PAPUA BARAT'),('94','PAPUA');

/*Table structure for table `r_consultation` */

DROP TABLE IF EXISTS `r_consultation`;

CREATE TABLE `r_consultation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `c_history` text,
  `c_td_value` varchar(20) DEFAULT NULL,
  `c_pr_value` varchar(20) DEFAULT NULL,
  `c_t_value` varchar(20) DEFAULT NULL,
  `c_rr_value` varchar(20) DEFAULT NULL,
  `c_description` text,
  `c_support` text,
  `c_control_days` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_r_consultation_registration` (`registration_id`),
  CONSTRAINT `FK_r_consultation_registration` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `r_consultation` */

insert  into `r_consultation`(`id`,`registration_id`,`c_history`,`c_td_value`,`c_pr_value`,`c_t_value`,`c_rr_value`,`c_description`,`c_support`,`c_control_days`) values (1,5,'12345667','123','12','123','123','123','123',NULL),(2,6,'123','123','123','123','123','123','123',123),(3,8,'','123','123','123','123','123','123',123),(4,10,'12','','','','','','',NULL),(5,11,'Batuk','12','14','16','18','Diperiksa','Pemeriksaan kedua',50),(6,15,'12','12','12','12','12','12','12',12),(7,16,'123','12','12','12','12','12','12',12),(8,18,'12','12','12','12','12','12','12',12),(9,19,'12','12','12','12','12','12','12',12),(10,19,'123','12','12','12','12','12','12',12),(11,19,'123','12','12','12','12','123','12',12),(12,19,'123','12','12','12','12','1234','12',12),(13,19,'1234','12','12','12','12','1234','12',12),(14,19,'12345','12','12','12','12','1234','12',12),(15,19,'123456','12','12','12','12','1234','12',12),(16,19,'1234567','12','12','12','12','1234','12',12),(17,19,'12345674','12','12','12','12','1234','12',12),(18,19,'12345674','12','12','12','12','1234','12',12),(19,19,'12345674','12','12','12','12','1234','12',12),(20,19,'12345674','12','12','12','12','12345','12',12);

/*Table structure for table `r_diagnosis` */

DROP TABLE IF EXISTS `r_diagnosis`;

CREATE TABLE `r_diagnosis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `rd_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_r_diagnosis_registration` (`registration_id`),
  CONSTRAINT `FK_r_diagnosis_registration` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `r_diagnosis` */

insert  into `r_diagnosis`(`id`,`registration_id`,`rd_name`) values (1,16,'12'),(2,16,'13'),(3,18,'diagnosis 1'),(6,19,'13'),(8,19,'12');

/*Table structure for table `r_doctor_action` */

DROP TABLE IF EXISTS `r_doctor_action`;

CREATE TABLE `r_doctor_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `rda_name` varchar(100) NOT NULL,
  `rda_price` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_r_doctor_action_registration` (`registration_id`),
  KEY `FK_r_doctor_action_practice_action` (`rda_name`),
  CONSTRAINT `FK_r_doctor_action_registration` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `r_doctor_action` */

insert  into `r_doctor_action`(`id`,`registration_id`,`rda_name`,`rda_price`) values (6,11,'SUNTIKAN B',40000),(7,16,'SUNTIKAN B',40000),(8,16,'SUNTIKAN B',40000),(9,18,'SUNTIKAN B',40000),(13,19,'SUNTIKAN B',1240000),(14,19,'SUNTIKAN B',1240000);

/*Table structure for table `r_medicine` */

DROP TABLE IF EXISTS `r_medicine`;

CREATE TABLE `r_medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `rmr_amount` int(8) NOT NULL,
  `rmr_dosage_1` varchar(20) DEFAULT NULL,
  `rmr_dosage_2` varchar(20) DEFAULT NULL,
  `rmr_dosage_3` varchar(20) DEFAULT NULL,
  `rmr_ref` text,
  PRIMARY KEY (`id`),
  KEY `FK_r_medicine_registration` (`registration_id`),
  KEY `FK_r_medicine_item` (`item_id`),
  CONSTRAINT `FK_r_medicine_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  CONSTRAINT `FK_r_medicine_registration` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

/*Data for the table `r_medicine` */

insert  into `r_medicine`(`id`,`registration_id`,`item_id`,`rmr_amount`,`rmr_dosage_1`,`rmr_dosage_2`,`rmr_dosage_3`,`rmr_ref`) values (27,10,1,123,'12','12','12','12'),(29,10,1,123,'12','12','12','12'),(30,10,1,12,'12','12','12','12'),(31,10,2,123,'12','12','12','12'),(32,10,2,3,'2','2','3','2'),(52,11,1,12,'3','3','Sehari','Cepat Diminum'),(53,11,2,12,'3','3','Abiskan','Abiskan Obat'),(54,12,1,12,'12','12','12','12'),(55,12,2,12,'12','12','12','12'),(56,12,2,12,'12','12','12','12'),(57,12,2,12,'12','12','12','12'),(58,15,2,12,'12','12','12','12'),(59,15,2,12,'12','12','12','12'),(60,15,2,12,'12','12','12','12'),(61,16,1,12,'12','12','12','12'),(62,16,2,12,'12','12','12','12'),(63,16,2,12,'12','12','12','12'),(64,16,2,12,'12','12','12','12'),(65,18,2,10,'3','3','sehari','Habiskan'),(81,18,1,12,'','','',''),(82,19,1,12,'12','12','12','12'),(83,19,1,1212,'12','12','12','12'),(87,19,2,12,'12','12','12','12'),(88,19,2,12,'12','12','12','12'),(90,19,3,12,'12','12','1','12');

/*Table structure for table `regency` */

DROP TABLE IF EXISTS `regency`;

CREATE TABLE `regency` (
  `id` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `province_id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `regencies_province_id_index` (`province_id`),
  CONSTRAINT `regencies_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `regency` */

insert  into `regency`(`id`,`province_id`,`name`) values ('1101','11','KABUPATEN SIMEULUE'),('1102','11','KABUPATEN ACEH SINGKIL'),('1103','11','KABUPATEN ACEH SELATAN'),('1104','11','KABUPATEN ACEH TENGGARA'),('1105','11','KABUPATEN ACEH TIMUR'),('1106','11','KABUPATEN ACEH TENGAH'),('1107','11','KABUPATEN ACEH BARAT'),('1108','11','KABUPATEN ACEH BESAR'),('1109','11','KABUPATEN PIDIE'),('1110','11','KABUPATEN BIREUEN'),('1111','11','KABUPATEN ACEH UTARA'),('1112','11','KABUPATEN ACEH BARAT DAYA'),('1113','11','KABUPATEN GAYO LUES'),('1114','11','KABUPATEN ACEH TAMIANG'),('1115','11','KABUPATEN NAGAN RAYA'),('1116','11','KABUPATEN ACEH JAYA'),('1117','11','KABUPATEN BENER MERIAH'),('1118','11','KABUPATEN PIDIE JAYA'),('1171','11','KOTA BANDA ACEH'),('1172','11','KOTA SABANG'),('1173','11','KOTA LANGSA'),('1174','11','KOTA LHOKSEUMAWE'),('1175','11','KOTA SUBULUSSALAM'),('1201','12','KABUPATEN NIAS'),('1202','12','KABUPATEN MANDAILING NATAL'),('1203','12','KABUPATEN TAPANULI SELATAN'),('1204','12','KABUPATEN TAPANULI TENGAH'),('1205','12','KABUPATEN TAPANULI UTARA'),('1206','12','KABUPATEN TOBA SAMOSIR'),('1207','12','KABUPATEN LABUHAN BATU'),('1208','12','KABUPATEN ASAHAN'),('1209','12','KABUPATEN SIMALUNGUN'),('1210','12','KABUPATEN DAIRI'),('1211','12','KABUPATEN KARO'),('1212','12','KABUPATEN DELI SERDANG'),('1213','12','KABUPATEN LANGKAT'),('1214','12','KABUPATEN NIAS SELATAN'),('1215','12','KABUPATEN HUMBANG HASUNDUTAN'),('1216','12','KABUPATEN PAKPAK BHARAT'),('1217','12','KABUPATEN SAMOSIR'),('1218','12','KABUPATEN SERDANG BEDAGAI'),('1219','12','KABUPATEN BATU BARA'),('1220','12','KABUPATEN PADANG LAWAS UTARA'),('1221','12','KABUPATEN PADANG LAWAS'),('1222','12','KABUPATEN LABUHAN BATU SELATAN'),('1223','12','KABUPATEN LABUHAN BATU UTARA'),('1224','12','KABUPATEN NIAS UTARA'),('1225','12','KABUPATEN NIAS BARAT'),('1271','12','KOTA SIBOLGA'),('1272','12','KOTA TANJUNG BALAI'),('1273','12','KOTA PEMATANG SIANTAR'),('1274','12','KOTA TEBING TINGGI'),('1275','12','KOTA MEDAN'),('1276','12','KOTA BINJAI'),('1277','12','KOTA PADANGSIDIMPUAN'),('1278','12','KOTA GUNUNGSITOLI'),('1301','13','KABUPATEN KEPULAUAN MENTAWAI'),('1302','13','KABUPATEN PESISIR SELATAN'),('1303','13','KABUPATEN SOLOK'),('1304','13','KABUPATEN SIJUNJUNG'),('1305','13','KABUPATEN TANAH DATAR'),('1306','13','KABUPATEN PADANG PARIAMAN'),('1307','13','KABUPATEN AGAM'),('1308','13','KABUPATEN LIMA PULUH KOTA'),('1309','13','KABUPATEN PASAMAN'),('1310','13','KABUPATEN SOLOK SELATAN'),('1311','13','KABUPATEN DHARMASRAYA'),('1312','13','KABUPATEN PASAMAN BARAT'),('1371','13','KOTA PADANG'),('1372','13','KOTA SOLOK'),('1373','13','KOTA SAWAH LUNTO'),('1374','13','KOTA PADANG PANJANG'),('1375','13','KOTA BUKITTINGGI'),('1376','13','KOTA PAYAKUMBUH'),('1377','13','KOTA PARIAMAN'),('1401','14','KABUPATEN KUANTAN SINGINGI'),('1402','14','KABUPATEN INDRAGIRI HULU'),('1403','14','KABUPATEN INDRAGIRI HILIR'),('1404','14','KABUPATEN PELALAWAN'),('1405','14','KABUPATEN S I A K'),('1406','14','KABUPATEN KAMPAR'),('1407','14','KABUPATEN ROKAN HULU'),('1408','14','KABUPATEN BENGKALIS'),('1409','14','KABUPATEN ROKAN HILIR'),('1410','14','KABUPATEN KEPULAUAN MERANTI'),('1471','14','KOTA PEKANBARU'),('1473','14','KOTA D U M A I'),('1501','15','KABUPATEN KERINCI'),('1502','15','KABUPATEN MERANGIN'),('1503','15','KABUPATEN SAROLANGUN'),('1504','15','KABUPATEN BATANG HARI'),('1505','15','KABUPATEN MUARO JAMBI'),('1506','15','KABUPATEN TANJUNG JABUNG TIMUR'),('1507','15','KABUPATEN TANJUNG JABUNG BARAT'),('1508','15','KABUPATEN TEBO'),('1509','15','KABUPATEN BUNGO'),('1571','15','KOTA JAMBI'),('1572','15','KOTA SUNGAI PENUH'),('1601','16','KABUPATEN OGAN KOMERING ULU'),('1602','16','KABUPATEN OGAN KOMERING ILIR'),('1603','16','KABUPATEN MUARA ENIM'),('1604','16','KABUPATEN LAHAT'),('1605','16','KABUPATEN MUSI RAWAS'),('1606','16','KABUPATEN MUSI BANYUASIN'),('1607','16','KABUPATEN BANYU ASIN'),('1608','16','KABUPATEN OGAN KOMERING ULU SELATAN'),('1609','16','KABUPATEN OGAN KOMERING ULU TIMUR'),('1610','16','KABUPATEN OGAN ILIR'),('1611','16','KABUPATEN EMPAT LAWANG'),('1612','16','KABUPATEN PENUKAL ABAB LEMATANG ILIR'),('1613','16','KABUPATEN MUSI RAWAS UTARA'),('1671','16','KOTA PALEMBANG'),('1672','16','KOTA PRABUMULIH'),('1673','16','KOTA PAGAR ALAM'),('1674','16','KOTA LUBUKLINGGAU'),('1701','17','KABUPATEN BENGKULU SELATAN'),('1702','17','KABUPATEN REJANG LEBONG'),('1703','17','KABUPATEN BENGKULU UTARA'),('1704','17','KABUPATEN KAUR'),('1705','17','KABUPATEN SELUMA'),('1706','17','KABUPATEN MUKOMUKO'),('1707','17','KABUPATEN LEBONG'),('1708','17','KABUPATEN KEPAHIANG'),('1709','17','KABUPATEN BENGKULU TENGAH'),('1771','17','KOTA BENGKULU'),('1801','18','KABUPATEN LAMPUNG BARAT'),('1802','18','KABUPATEN TANGGAMUS'),('1803','18','KABUPATEN LAMPUNG SELATAN'),('1804','18','KABUPATEN LAMPUNG TIMUR'),('1805','18','KABUPATEN LAMPUNG TENGAH'),('1806','18','KABUPATEN LAMPUNG UTARA'),('1807','18','KABUPATEN WAY KANAN'),('1808','18','KABUPATEN TULANGBAWANG'),('1809','18','KABUPATEN PESAWARAN'),('1810','18','KABUPATEN PRINGSEWU'),('1811','18','KABUPATEN MESUJI'),('1812','18','KABUPATEN TULANG BAWANG BARAT'),('1813','18','KABUPATEN PESISIR BARAT'),('1871','18','KOTA BANDAR LAMPUNG'),('1872','18','KOTA METRO'),('1901','19','KABUPATEN BANGKA'),('1902','19','KABUPATEN BELITUNG'),('1903','19','KABUPATEN BANGKA BARAT'),('1904','19','KABUPATEN BANGKA TENGAH'),('1905','19','KABUPATEN BANGKA SELATAN'),('1906','19','KABUPATEN BELITUNG TIMUR'),('1971','19','KOTA PANGKAL PINANG'),('2101','21','KABUPATEN KARIMUN'),('2102','21','KABUPATEN BINTAN'),('2103','21','KABUPATEN NATUNA'),('2104','21','KABUPATEN LINGGA'),('2105','21','KABUPATEN KEPULAUAN ANAMBAS'),('2171','21','KOTA B A T A M'),('2172','21','KOTA TANJUNG PINANG'),('3101','31','KABUPATEN KEPULAUAN SERIBU'),('3171','31','KOTA JAKARTA SELATAN'),('3172','31','KOTA JAKARTA TIMUR'),('3173','31','KOTA JAKARTA PUSAT'),('3174','31','KOTA JAKARTA BARAT'),('3175','31','KOTA JAKARTA UTARA'),('3201','32','KABUPATEN BOGOR'),('3202','32','KABUPATEN SUKABUMI'),('3203','32','KABUPATEN CIANJUR'),('3204','32','KABUPATEN BANDUNG'),('3205','32','KABUPATEN GARUT'),('3206','32','KABUPATEN TASIKMALAYA'),('3207','32','KABUPATEN CIAMIS'),('3208','32','KABUPATEN KUNINGAN'),('3209','32','KABUPATEN CIREBON'),('3210','32','KABUPATEN MAJALENGKA'),('3211','32','KABUPATEN SUMEDANG'),('3212','32','KABUPATEN INDRAMAYU'),('3213','32','KABUPATEN SUBANG'),('3214','32','KABUPATEN PURWAKARTA'),('3215','32','KABUPATEN KARAWANG'),('3216','32','KABUPATEN BEKASI'),('3217','32','KABUPATEN BANDUNG BARAT'),('3218','32','KABUPATEN PANGANDARAN'),('3271','32','KOTA BOGOR'),('3272','32','KOTA SUKABUMI'),('3273','32','KOTA BANDUNG'),('3274','32','KOTA CIREBON'),('3275','32','KOTA BEKASI'),('3276','32','KOTA DEPOK'),('3277','32','KOTA CIMAHI'),('3278','32','KOTA TASIKMALAYA'),('3279','32','KOTA BANJAR'),('3301','33','KABUPATEN CILACAP'),('3302','33','KABUPATEN BANYUMAS'),('3303','33','KABUPATEN PURBALINGGA'),('3304','33','KABUPATEN BANJARNEGARA'),('3305','33','KABUPATEN KEBUMEN'),('3306','33','KABUPATEN PURWOREJO'),('3307','33','KABUPATEN WONOSOBO'),('3308','33','KABUPATEN MAGELANG'),('3309','33','KABUPATEN BOYOLALI'),('3310','33','KABUPATEN KLATEN'),('3311','33','KABUPATEN SUKOHARJO'),('3312','33','KABUPATEN WONOGIRI'),('3313','33','KABUPATEN KARANGANYAR'),('3314','33','KABUPATEN SRAGEN'),('3315','33','KABUPATEN GROBOGAN'),('3316','33','KABUPATEN BLORA'),('3317','33','KABUPATEN REMBANG'),('3318','33','KABUPATEN PATI'),('3319','33','KABUPATEN KUDUS'),('3320','33','KABUPATEN JEPARA'),('3321','33','KABUPATEN DEMAK'),('3322','33','KABUPATEN SEMARANG'),('3323','33','KABUPATEN TEMANGGUNG'),('3324','33','KABUPATEN KENDAL'),('3325','33','KABUPATEN BATANG'),('3326','33','KABUPATEN PEKALONGAN'),('3327','33','KABUPATEN PEMALANG'),('3328','33','KABUPATEN TEGAL'),('3329','33','KABUPATEN BREBES'),('3371','33','KOTA MAGELANG'),('3372','33','KOTA SURAKARTA'),('3373','33','KOTA SALATIGA'),('3374','33','KOTA SEMARANG'),('3375','33','KOTA PEKALONGAN'),('3376','33','KOTA TEGAL'),('3401','34','KABUPATEN KULON PROGO'),('3402','34','KABUPATEN BANTUL'),('3403','34','KABUPATEN GUNUNG KIDUL'),('3404','34','KABUPATEN SLEMAN'),('3471','34','KOTA YOGYAKARTA'),('3501','35','KABUPATEN PACITAN'),('3502','35','KABUPATEN PONOROGO'),('3503','35','KABUPATEN TRENGGALEK'),('3504','35','KABUPATEN TULUNGAGUNG'),('3505','35','KABUPATEN BLITAR'),('3506','35','KABUPATEN KEDIRI'),('3507','35','KABUPATEN MALANG'),('3508','35','KABUPATEN LUMAJANG'),('3509','35','KABUPATEN JEMBER'),('3510','35','KABUPATEN BANYUWANGI'),('3511','35','KABUPATEN BONDOWOSO'),('3512','35','KABUPATEN SITUBONDO'),('3513','35','KABUPATEN PROBOLINGGO'),('3514','35','KABUPATEN PASURUAN'),('3515','35','KABUPATEN SIDOARJO'),('3516','35','KABUPATEN MOJOKERTO'),('3517','35','KABUPATEN JOMBANG'),('3518','35','KABUPATEN NGANJUK'),('3519','35','KABUPATEN MADIUN'),('3520','35','KABUPATEN MAGETAN'),('3521','35','KABUPATEN NGAWI'),('3522','35','KABUPATEN BOJONEGORO'),('3523','35','KABUPATEN TUBAN'),('3524','35','KABUPATEN LAMONGAN'),('3525','35','KABUPATEN GRESIK'),('3526','35','KABUPATEN BANGKALAN'),('3527','35','KABUPATEN SAMPANG'),('3528','35','KABUPATEN PAMEKASAN'),('3529','35','KABUPATEN SUMENEP'),('3571','35','KOTA KEDIRI'),('3572','35','KOTA BLITAR'),('3573','35','KOTA MALANG'),('3574','35','KOTA PROBOLINGGO'),('3575','35','KOTA PASURUAN'),('3576','35','KOTA MOJOKERTO'),('3577','35','KOTA MADIUN'),('3578','35','KOTA SURABAYA'),('3579','35','KOTA BATU'),('3601','36','KABUPATEN PANDEGLANG'),('3602','36','KABUPATEN LEBAK'),('3603','36','KABUPATEN TANGERANG'),('3604','36','KABUPATEN SERANG'),('3671','36','KOTA TANGERANG'),('3672','36','KOTA CILEGON'),('3673','36','KOTA SERANG'),('3674','36','KOTA TANGERANG SELATAN'),('5101','51','KABUPATEN JEMBRANA'),('5102','51','KABUPATEN TABANAN'),('5103','51','KABUPATEN BADUNG'),('5104','51','KABUPATEN GIANYAR'),('5105','51','KABUPATEN KLUNGKUNG'),('5106','51','KABUPATEN BANGLI'),('5107','51','KABUPATEN KARANG ASEM'),('5108','51','KABUPATEN BULELENG'),('5171','51','KOTA DENPASAR'),('5201','52','KABUPATEN LOMBOK BARAT'),('5202','52','KABUPATEN LOMBOK TENGAH'),('5203','52','KABUPATEN LOMBOK TIMUR'),('5204','52','KABUPATEN SUMBAWA'),('5205','52','KABUPATEN DOMPU'),('5206','52','KABUPATEN BIMA'),('5207','52','KABUPATEN SUMBAWA BARAT'),('5208','52','KABUPATEN LOMBOK UTARA'),('5271','52','KOTA MATARAM'),('5272','52','KOTA BIMA'),('5301','53','KABUPATEN SUMBA BARAT'),('5302','53','KABUPATEN SUMBA TIMUR'),('5303','53','KABUPATEN KUPANG'),('5304','53','KABUPATEN TIMOR TENGAH SELATAN'),('5305','53','KABUPATEN TIMOR TENGAH UTARA'),('5306','53','KABUPATEN BELU'),('5307','53','KABUPATEN ALOR'),('5308','53','KABUPATEN LEMBATA'),('5309','53','KABUPATEN FLORES TIMUR'),('5310','53','KABUPATEN SIKKA'),('5311','53','KABUPATEN ENDE'),('5312','53','KABUPATEN NGADA'),('5313','53','KABUPATEN MANGGARAI'),('5314','53','KABUPATEN ROTE NDAO'),('5315','53','KABUPATEN MANGGARAI BARAT'),('5316','53','KABUPATEN SUMBA TENGAH'),('5317','53','KABUPATEN SUMBA BARAT DAYA'),('5318','53','KABUPATEN NAGEKEO'),('5319','53','KABUPATEN MANGGARAI TIMUR'),('5320','53','KABUPATEN SABU RAIJUA'),('5321','53','KABUPATEN MALAKA'),('5371','53','KOTA KUPANG'),('6101','61','KABUPATEN SAMBAS'),('6102','61','KABUPATEN BENGKAYANG'),('6103','61','KABUPATEN LANDAK'),('6104','61','KABUPATEN MEMPAWAH'),('6105','61','KABUPATEN SANGGAU'),('6106','61','KABUPATEN KETAPANG'),('6107','61','KABUPATEN SINTANG'),('6108','61','KABUPATEN KAPUAS HULU'),('6109','61','KABUPATEN SEKADAU'),('6110','61','KABUPATEN MELAWI'),('6111','61','KABUPATEN KAYONG UTARA'),('6112','61','KABUPATEN KUBU RAYA'),('6171','61','KOTA PONTIANAK'),('6172','61','KOTA SINGKAWANG'),('6201','62','KABUPATEN KOTAWARINGIN BARAT'),('6202','62','KABUPATEN KOTAWARINGIN TIMUR'),('6203','62','KABUPATEN KAPUAS'),('6204','62','KABUPATEN BARITO SELATAN'),('6205','62','KABUPATEN BARITO UTARA'),('6206','62','KABUPATEN SUKAMARA'),('6207','62','KABUPATEN LAMANDAU'),('6208','62','KABUPATEN SERUYAN'),('6209','62','KABUPATEN KATINGAN'),('6210','62','KABUPATEN PULANG PISAU'),('6211','62','KABUPATEN GUNUNG MAS'),('6212','62','KABUPATEN BARITO TIMUR'),('6213','62','KABUPATEN MURUNG RAYA'),('6271','62','KOTA PALANGKA RAYA'),('6301','63','KABUPATEN TANAH LAUT'),('6302','63','KABUPATEN KOTA BARU'),('6303','63','KABUPATEN BANJAR'),('6304','63','KABUPATEN BARITO KUALA'),('6305','63','KABUPATEN TAPIN'),('6306','63','KABUPATEN HULU SUNGAI SELATAN'),('6307','63','KABUPATEN HULU SUNGAI TENGAH'),('6308','63','KABUPATEN HULU SUNGAI UTARA'),('6309','63','KABUPATEN TABALONG'),('6310','63','KABUPATEN TANAH BUMBU'),('6311','63','KABUPATEN BALANGAN'),('6371','63','KOTA BANJARMASIN'),('6372','63','KOTA BANJAR BARU'),('6401','64','KABUPATEN PASER'),('6402','64','KABUPATEN KUTAI BARAT'),('6403','64','KABUPATEN KUTAI KARTANEGARA'),('6404','64','KABUPATEN KUTAI TIMUR'),('6405','64','KABUPATEN BERAU'),('6409','64','KABUPATEN PENAJAM PASER UTARA'),('6411','64','KABUPATEN MAHAKAM HULU'),('6471','64','KOTA BALIKPAPAN'),('6472','64','KOTA SAMARINDA'),('6474','64','KOTA BONTANG'),('6501','65','KABUPATEN MALINAU'),('6502','65','KABUPATEN BULUNGAN'),('6503','65','KABUPATEN TANA TIDUNG'),('6504','65','KABUPATEN NUNUKAN'),('6571','65','KOTA TARAKAN'),('7101','71','KABUPATEN BOLAANG MONGONDOW'),('7102','71','KABUPATEN MINAHASA'),('7103','71','KABUPATEN KEPULAUAN SANGIHE'),('7104','71','KABUPATEN KEPULAUAN TALAUD'),('7105','71','KABUPATEN MINAHASA SELATAN'),('7106','71','KABUPATEN MINAHASA UTARA'),('7107','71','KABUPATEN BOLAANG MONGONDOW UTARA'),('7108','71','KABUPATEN SIAU TAGULANDANG BIARO'),('7109','71','KABUPATEN MINAHASA TENGGARA'),('7110','71','KABUPATEN BOLAANG MONGONDOW SELATAN'),('7111','71','KABUPATEN BOLAANG MONGONDOW TIMUR'),('7171','71','KOTA MANADO'),('7172','71','KOTA BITUNG'),('7173','71','KOTA TOMOHON'),('7174','71','KOTA KOTAMOBAGU'),('7201','72','KABUPATEN BANGGAI KEPULAUAN'),('7202','72','KABUPATEN BANGGAI'),('7203','72','KABUPATEN MOROWALI'),('7204','72','KABUPATEN POSO'),('7205','72','KABUPATEN DONGGALA'),('7206','72','KABUPATEN TOLI-TOLI'),('7207','72','KABUPATEN BUOL'),('7208','72','KABUPATEN PARIGI MOUTONG'),('7209','72','KABUPATEN TOJO UNA-UNA'),('7210','72','KABUPATEN SIGI'),('7211','72','KABUPATEN BANGGAI LAUT'),('7212','72','KABUPATEN MOROWALI UTARA'),('7271','72','KOTA PALU'),('7301','73','KABUPATEN KEPULAUAN SELAYAR'),('7302','73','KABUPATEN BULUKUMBA'),('7303','73','KABUPATEN BANTAENG'),('7304','73','KABUPATEN JENEPONTO'),('7305','73','KABUPATEN TAKALAR'),('7306','73','KABUPATEN GOWA'),('7307','73','KABUPATEN SINJAI'),('7308','73','KABUPATEN MAROS'),('7309','73','KABUPATEN PANGKAJENE DAN KEPULAUAN'),('7310','73','KABUPATEN BARRU'),('7311','73','KABUPATEN BONE'),('7312','73','KABUPATEN SOPPENG'),('7313','73','KABUPATEN WAJO'),('7314','73','KABUPATEN SIDENRENG RAPPANG'),('7315','73','KABUPATEN PINRANG'),('7316','73','KABUPATEN ENREKANG'),('7317','73','KABUPATEN LUWU'),('7318','73','KABUPATEN TANA TORAJA'),('7322','73','KABUPATEN LUWU UTARA'),('7325','73','KABUPATEN LUWU TIMUR'),('7326','73','KABUPATEN TORAJA UTARA'),('7371','73','KOTA MAKASSAR'),('7372','73','KOTA PAREPARE'),('7373','73','KOTA PALOPO'),('7401','74','KABUPATEN BUTON'),('7402','74','KABUPATEN MUNA'),('7403','74','KABUPATEN KONAWE'),('7404','74','KABUPATEN KOLAKA'),('7405','74','KABUPATEN KONAWE SELATAN'),('7406','74','KABUPATEN BOMBANA'),('7407','74','KABUPATEN WAKATOBI'),('7408','74','KABUPATEN KOLAKA UTARA'),('7409','74','KABUPATEN BUTON UTARA'),('7410','74','KABUPATEN KONAWE UTARA'),('7411','74','KABUPATEN KOLAKA TIMUR'),('7412','74','KABUPATEN KONAWE KEPULAUAN'),('7413','74','KABUPATEN MUNA BARAT'),('7414','74','KABUPATEN BUTON TENGAH'),('7415','74','KABUPATEN BUTON SELATAN'),('7471','74','KOTA KENDARI'),('7472','74','KOTA BAUBAU'),('7501','75','KABUPATEN BOALEMO'),('7502','75','KABUPATEN GORONTALO'),('7503','75','KABUPATEN POHUWATO'),('7504','75','KABUPATEN BONE BOLANGO'),('7505','75','KABUPATEN GORONTALO UTARA'),('7571','75','KOTA GORONTALO'),('7601','76','KABUPATEN MAJENE'),('7602','76','KABUPATEN POLEWALI MANDAR'),('7603','76','KABUPATEN MAMASA'),('7604','76','KABUPATEN MAMUJU'),('7605','76','KABUPATEN MAMUJU UTARA'),('7606','76','KABUPATEN MAMUJU TENGAH'),('8101','81','KABUPATEN MALUKU TENGGARA BARAT'),('8102','81','KABUPATEN MALUKU TENGGARA'),('8103','81','KABUPATEN MALUKU TENGAH'),('8104','81','KABUPATEN BURU'),('8105','81','KABUPATEN KEPULAUAN ARU'),('8106','81','KABUPATEN SERAM BAGIAN BARAT'),('8107','81','KABUPATEN SERAM BAGIAN TIMUR'),('8108','81','KABUPATEN MALUKU BARAT DAYA'),('8109','81','KABUPATEN BURU SELATAN'),('8171','81','KOTA AMBON'),('8172','81','KOTA TUAL'),('8201','82','KABUPATEN HALMAHERA BARAT'),('8202','82','KABUPATEN HALMAHERA TENGAH'),('8203','82','KABUPATEN KEPULAUAN SULA'),('8204','82','KABUPATEN HALMAHERA SELATAN'),('8205','82','KABUPATEN HALMAHERA UTARA'),('8206','82','KABUPATEN HALMAHERA TIMUR'),('8207','82','KABUPATEN PULAU MOROTAI'),('8208','82','KABUPATEN PULAU TALIABU'),('8271','82','KOTA TERNATE'),('8272','82','KOTA TIDORE KEPULAUAN'),('9101','91','KABUPATEN FAKFAK'),('9102','91','KABUPATEN KAIMANA'),('9103','91','KABUPATEN TELUK WONDAMA'),('9104','91','KABUPATEN TELUK BINTUNI'),('9105','91','KABUPATEN MANOKWARI'),('9106','91','KABUPATEN SORONG SELATAN'),('9107','91','KABUPATEN SORONG'),('9108','91','KABUPATEN RAJA AMPAT'),('9109','91','KABUPATEN TAMBRAUW'),('9110','91','KABUPATEN MAYBRAT'),('9111','91','KABUPATEN MANOKWARI SELATAN'),('9112','91','KABUPATEN PEGUNUNGAN ARFAK'),('9171','91','KOTA SORONG'),('9401','94','KABUPATEN MERAUKE'),('9402','94','KABUPATEN JAYAWIJAYA'),('9403','94','KABUPATEN JAYAPURA'),('9404','94','KABUPATEN NABIRE'),('9408','94','KABUPATEN KEPULAUAN YAPEN'),('9409','94','KABUPATEN BIAK NUMFOR'),('9410','94','KABUPATEN PANIAI'),('9411','94','KABUPATEN PUNCAK JAYA'),('9412','94','KABUPATEN MIMIKA'),('9413','94','KABUPATEN BOVEN DIGOEL'),('9414','94','KABUPATEN MAPPI'),('9415','94','KABUPATEN ASMAT'),('9416','94','KABUPATEN YAHUKIMO'),('9417','94','KABUPATEN PEGUNUNGAN BINTANG'),('9418','94','KABUPATEN TOLIKARA'),('9419','94','KABUPATEN SARMI'),('9420','94','KABUPATEN KEEROM'),('9426','94','KABUPATEN WAROPEN'),('9427','94','KABUPATEN SUPIORI'),('9428','94','KABUPATEN MAMBERAMO RAYA'),('9429','94','KABUPATEN NDUGA'),('9430','94','KABUPATEN LANNY JAYA'),('9431','94','KABUPATEN MAMBERAMO TENGAH'),('9432','94','KABUPATEN YALIMO'),('9433','94','KABUPATEN PUNCAK'),('9434','94','KABUPATEN DOGIYAI'),('9435','94','KABUPATEN INTAN JAYA'),('9436','94','KABUPATEN DEIYAI'),('9471','94','KOTA JAYAPURA');

/*Table structure for table `registration` */

DROP TABLE IF EXISTS `registration`;

CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `r_number` varchar(30) NOT NULL,
  `r_date` date NOT NULL,
  `r_patient_weight` int(4) DEFAULT NULL,
  `r_patient_tension` int(4) DEFAULT NULL,
  `r_patient_temp` int(4) DEFAULT NULL,
  `r_complaint` text,
  `r_position` int(1) NOT NULL,
  `r_checked` tinyint(1) NOT NULL,
  `r_paid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`r_number`,`r_date`),
  KEY `FK_registration_patient` (`patient_id`),
  CONSTRAINT `FK_registration_patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `registration` */

insert  into `registration`(`id`,`patient_id`,`r_number`,`r_date`,`r_patient_weight`,`r_patient_tension`,`r_patient_temp`,`r_complaint`,`r_position`,`r_checked`,`r_paid`) values (2,2,'000002','2017-08-16',1234,1234,1234,'1234',0,0,0),(4,1,'000003','2017-08-16',123,123,123,'123',0,0,0),(5,2,'000004','2017-08-17',123123,123,123,'123',0,0,0),(6,1,'000001','2017-08-18',123123,12,123,'123',0,0,0),(8,1,'000001','2017-08-19',1212,12,12,'12',0,0,0),(9,2,'000002','2017-08-19',123123,123,123,'123',0,0,0),(10,2,'000001','2017-08-20',123123,213,213,'123',0,0,0),(11,1,'000001','2017-08-21',123,12,12,'12',0,0,0),(12,1,'000001','2017-08-22',123123,12,12,'12',1,1,0),(13,1,'000002','2017-08-22',123,12,1234,'12',0,1,0),(15,1,'000001','2017-08-23',121,12,12,'12',0,1,0),(16,1,'000002','2017-08-23',12,12,12,'12',0,0,0),(17,1,'000003','2017-08-23',12,12,12,'12',0,0,0),(18,1,'000001','2017-08-24',12112,12,12,'12',0,1,0),(19,1,'000001','2017-08-25',121,12,12,'12',0,1,0);

/*Table structure for table `religion` */

DROP TABLE IF EXISTS `religion`;

CREATE TABLE `religion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `r_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `religion` */

insert  into `religion`(`id`,`r_name`) values (1,'BUDHA'),(2,'ISLAM'),(3,'KATOLIK'),(4,'PROTESTAN'),(5,'HINDU');

/*Table structure for table `rm_detail` */

DROP TABLE IF EXISTS `rm_detail`;

CREATE TABLE `rm_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `r_medicine_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `rmd_amount` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_rm_detail_item` (`item_id`),
  KEY `FK_rm_detail_registration` (`registration_id`),
  KEY `FK_rm_detail_medicine` (`r_medicine_id`),
  CONSTRAINT `FK_rm_detail_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_rm_detail_medicine` FOREIGN KEY (`r_medicine_id`) REFERENCES `r_medicine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_rm_detail_registration` FOREIGN KEY (`registration_id`) REFERENCES `registration` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `rm_detail` */

insert  into `rm_detail`(`id`,`registration_id`,`r_medicine_id`,`item_id`,`rmd_amount`) values (14,11,53,1,12),(15,15,58,1,12),(16,15,58,1,12),(20,19,87,1,1234),(21,19,87,1,12),(22,19,87,1,123),(23,19,88,1,12),(24,19,87,1,12),(25,19,90,1,12),(26,19,90,1,12),(27,19,90,1,12);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(8) NOT NULL,
  `name` varchar(48) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `role` */

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(50) NOT NULL,
  `s_address` text NOT NULL,
  `s_phone_number` int(11) NOT NULL,
  `s_contact_person` varchar(50) NOT NULL,
  `s_file` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `supplier` */

insert  into `supplier`(`id`,`s_name`,`s_address`,`s_phone_number`,`s_contact_person`,`s_file`) values (10,'Suplier 1','Alamat 1',812,'Rudi','');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` int(10) unsigned DEFAULT NULL,
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
  KEY `person_id` (`person_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`person_id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`role`,`status`,`created_at`,`updated_at`) values (8,1,'chandra','VPELb8z_8Yoogk6ITTlriBcoTBJ9Vm9D','$2y$13$QypH4POoSTsbjpZXWeJgLeA3tifix2ySgVh7KegLiCRwKIiOxwmou','','tonny.chua@gmail.com',10,10,1478320023,1502468930),(20,3,'zehel09','mtfHWXqUOUyNWDwwytnUhhFrda44hF0V','$2y$13$HazRXw.HihVAHk1lU/FHQumyYBbQKw84esmjK6S/7wDyi2oWt02D6',NULL,'joshuasaputra77@gmail.com',10,10,2147483647,2147483647),(27,1,'peserta1','aLYu604JeZ5RxjabdDc4fzPJ9DO0I4KR','$2y$13$EU8a.ske/CDkTSKR2ez3POwkfp6yD2Fa.bA6ze3IoqtCKY2Q8yFHG',NULL,'peserta1@gmail.com',1000,10,2147483647,1502621334);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
