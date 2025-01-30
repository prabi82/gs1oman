/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.10-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: gs1omancom_barcode
-- ------------------------------------------------------
-- Server version	10.11.10-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `gs1omancom_barcode`
--


--
-- Table structure for table `admin_tbl`
--

DROP TABLE IF EXISTS `admin_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email_id` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `password2` varchar(26) NOT NULL,
  `token` varchar(30) NOT NULL,
  `reset_link_token` varchar(255) NOT NULL,
  `roles` enum('Super Admin','Admin') DEFAULT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1= Enable,0= Disable',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_tbl`
--

LOCK TABLES `admin_tbl` WRITE;
/*!40000 ALTER TABLE `admin_tbl` DISABLE KEYS */;
INSERT INTO `admin_tbl` (`admin_id`, `username`, `name`, `image`, `email_id`, `password`, `password2`, `token`, `reset_link_token`, `roles`, `status`) VALUES (1,'Barcode','Barcode','images/Upload/admin/agent-3.jpg','barcode@gmail.com','7c222fb2927d828af22f592134e8932480637c0d','barcode@gmail.combarcode@g','','547821125d3cb3e8d3f4133d1fb263d57263','Super Admin','1'),
(2,'prabi','prabi Krishna','images/Upload/admin.png','prabi@c-dat.co','be5b8eff0fc173566171edec2847dc4c6b37a18c','AccountPassword@1','','','Super Admin','1'),
(3,'Mohamed.abdulkarim','Mohamed Abdulkarim','../','mohamed.abdulkarim@gs1oman.org','7c4a8d09ca3762af61e59520943dc26494f8941b','123456','','','Super Admin','1'),
(4,'sheikha.nofali','Sheikha Nofali','../','sheikha.nofali@gs1oman.org','7c4a8d09ca3762af61e59520943dc26494f8941b','123456','','52f75a71640248369ffe102489daeafc9651','Admin','1');
/*!40000 ALTER TABLE `admin_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_contacts_tbl`
--

DROP TABLE IF EXISTS `company_contacts_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_contacts_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `phone_number1` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_contacts_tbl`
--

LOCK TABLES `company_contacts_tbl` WRITE;
/*!40000 ALTER TABLE `company_contacts_tbl` DISABLE KEYS */;
INSERT INTO `company_contacts_tbl` (`id`, `product_id`, `company_id`, `title`, `first_name`, `last_name`, `job_title`, `email_id`, `phone_number1`, `status`, `created_at`, `updated_at`) VALUES (1,5,1,'Mr.','test','test','CEO.','shikha3034@gmail.com','78979809809',0,'2024-10-03 08:09:58','2024-10-03 08:09:58'),
(2,5,1,'Mr.','testt','testtt','CEO.','sunjeetrawat1@gmail.com','98898898080',0,'2024-10-03 08:09:58','2024-10-03 08:09:58'),
(3,5,2,'Mr.','the first','PPERSON','CEO.','7thoctober@GMAIL.COM','96895231255',0,'2024-10-07 04:19:02','2024-10-07 04:19:02'),
(4,5,2,'Mr.','thoctober','asd','CEO.','7thoctober_1@gmail.com','96865321125',0,'2024-10-07 04:19:02','2024-10-07 04:19:02'),
(5,5,3,'Mr.','Prabi','Krishna','CEO.','7thoctobertest2@gmail.com','96896553210',0,'2024-10-07 04:23:12','2024-10-07 04:23:12'),
(6,5,3,'Mr.','thoctobertest','asd','CEO.','7thoctobertest2_1@gmail.com','96895663210',0,'2024-10-07 04:23:12','2024-10-07 04:23:12'),
(7,10,4,'Mr.','Fjjdk','Djnsl','CEO.','7thoctmobiletest@gmail.com','96893778299',0,'2024-10-07 04:27:34','2024-10-07 04:27:34'),
(8,10,4,'Mr.','Dhakle','Pdeal','CEO.','7thoctmobiletest2@gmail.com','96890989902',0,'2024-10-07 04:27:34','2024-10-07 04:27:34'),
(9,5,5,'Mrs.','Azza','Alhabsi','CEO.','azzaredsea@gmail.com','96891173551',0,'2024-10-10 06:36:55','2024-10-10 06:36:55'),
(10,5,5,'Mr.','Hilal','Alhabsi','Staff','hilalredsea@gmail.com','96899433966',0,'2024-10-10 06:36:55','2024-10-10 06:36:55'),
(11,5,6,'Mrs.','Mohamed','Abdulkarim','CEO.','mohamed.abdulkarim@goman.org','99971777467',0,'2024-10-21 09:19:37','2024-10-21 09:19:37'),
(12,5,6,'Mr.','Mohamed','Abdulkarim','CEO.','dbak@gmail.com','78872226166',0,'2024-10-21 09:19:37','2024-10-21 09:19:37'),
(13,6,7,'Miss','Amal ','Hello ','CEO.','karim@obcogaghhsman.org','66667377777',0,'2024-10-21 09:24:52','2024-10-21 09:24:52'),
(14,6,7,'Miss','Tyshh','Abdulkarim','CEO.','kaggsim@obcoman.org','71777467555',0,'2024-10-21 09:24:52','2024-10-21 09:24:52'),
(15,3,8,'Mr.','october','ks','CEO.','october231@gmail.com','96899452147',0,'2024-10-23 11:32:38','2024-10-23 11:32:38'),
(16,3,8,'Mr.','octobere','ak','CEO.','october232@gmail.com','96897887411',0,'2024-10-23 11:32:38','2024-10-23 11:32:38'),
(17,5,9,'Mr.','Test ','test','CEO.','test@test1.com','98765432100',0,'2024-10-24 08:49:24','2024-10-24 08:49:24'),
(18,5,9,'Mr.','testing','testing','CEO.','testing@test1.com','98765324125',0,'2024-10-24 08:49:24','2024-10-24 08:49:24'),
(19,5,10,'Mrs.','testing','test','CEO.','test2@test1.com','98765324121',0,'2024-10-24 09:15:07','2024-10-24 09:15:07'),
(20,5,10,'Mr.','testing','test','CEO.','test3@test1.com','98765324149',0,'2024-10-24 09:15:07','2024-10-24 09:15:07'),
(21,3,11,'Miss','test','test','CEO.','test55@test.com','66577767678',0,'2024-10-24 10:11:58','2024-10-24 10:11:58'),
(22,3,11,'Mr.','test','verma','CEO.','test','67688768799',0,'2024-10-24 10:11:58','2024-10-24 10:11:58'),
(23,3,12,'Mr.','Test','Test','CEO.','test@44test.com','59666666866',0,'2024-10-24 10:22:40','2024-10-24 10:22:40'),
(24,3,12,'Mr.','Test','Test','CEO.','test99@test.com','56553665666',0,'2024-10-24 10:22:40','2024-10-24 10:22:40'),
(25,6,13,'Mr.','Prabi','k','CEO.','28thoctober1@gmail.com','96878965231',0,'2024-10-28 05:23:15','2024-10-28 05:23:15'),
(26,6,13,'Mr.','ksj','lkasd','CEO.','28thoctober2@gmail.com','9687456411',0,'2024-10-28 05:23:15','2024-10-28 05:23:15'),
(27,5,14,'Mr.','adasd','asd','CEO.','OctoberTest21@gmail.com','96877855787',0,'2024-10-28 06:13:42','2024-10-28 06:13:42'),
(28,5,14,'Mr.','avasdr','asasdfsd','CEO.','OctoberTest22@gmail.com','96874123658',0,'2024-10-28 06:13:42','2024-10-28 06:13:42'),
(29,3,15,'Mrs.','test','test','CEO.','test@test.com','34534534534',0,'2024-10-29 06:52:15','2024-10-29 06:52:15'),
(30,3,15,'Mr.','testing','testing','CEO.','test2@test.com','35345345345',0,'2024-10-29 06:52:15','2024-10-29 06:52:15'),
(31,3,16,'Mrs.','testing','test','Accounts.','test56@test.com','34534534956',0,'2024-10-29 07:43:30','2024-10-29 07:43:30'),
(32,3,16,'Miss','testing','test','Accounts.','test2@test.com','98765324148',0,'2024-10-29 07:43:30','2024-10-29 07:43:30'),
(33,3,17,'Mr.','testing','testing','CEO.','test2@test.com','45878599665',0,'2024-10-29 07:54:26','2024-10-29 07:54:26'),
(34,3,17,'Mr.','testing','testing','CEO.','test4@test.com','96589633326',0,'2024-10-29 07:54:26','2024-10-29 07:54:26'),
(35,5,18,'Mr.','testing','test','CEO.','test123@testt.com','45878594565',0,'2024-10-29 11:29:03','2024-10-29 11:29:03'),
(36,5,18,'Mr.','qwe','test','CEO.','test56@tesrt.com','34534531236',0,'2024-10-29 11:29:03','2024-10-29 11:29:03'),
(37,3,19,'Mr.','testing','test','CEO.','testing@ymail.com','98659865986',0,'2024-10-29 12:03:38','2024-10-29 12:03:38'),
(38,3,19,'Mr.','testing','test','CEO.','testing1@ymail.com','97845785487',0,'2024-10-29 12:03:38','2024-10-29 12:03:38'),
(39,5,20,'Mr.','Amal','AlZidi','CEO.','a.ah.alzidi@gmail.com','96897114040',0,'2024-10-31 09:22:35','2024-10-31 09:22:35'),
(40,5,20,'Mr.','sdtyu','mpoiuytre','CEO.','amal.zeidi@gs1oman.org','96897114046',0,'2024-10-31 09:22:35','2024-10-31 09:22:35'),
(41,3,21,'Mr.','Ahmed ','Mohammed ','CEO.','s@gmail.com','96897456655',0,'2024-10-31 09:35:05','2024-10-31 09:35:05'),
(42,3,21,'Miss','Amal','Ahmed','Staff','a@gmail.com','96890000000',0,'2024-10-31 09:35:05','2024-10-31 09:35:05'),
(43,3,22,'Mr.','bdri','amry','CEO.','456@hotmail.om','96899112219',0,'2024-10-31 09:45:49','2024-10-31 09:45:49'),
(44,3,22,'Mr.','bdri','amry','CEO.','456@hotmaili.om','96899112299',0,'2024-10-31 09:45:49','2024-10-31 09:45:49'),
(45,6,23,'Mrs.','sheikha','nofali','CEO.','she5ikha@hotmail.com','96897887800',0,'2024-10-31 10:00:03','2024-10-31 10:00:03'),
(46,6,23,'Mrs.','SHOOSHA','nofali','CEO.','sheikh77a@hotmail.com','96897897800',0,'2024-10-31 10:00:03','2024-10-31 10:00:03'),
(47,5,24,'Mrs.','Skgd','Sgh','CEO.','dh@jgdz.com','96877445566',0,'2024-10-31 10:05:25','2024-10-31 10:05:25'),
(48,5,24,'Mrs.','Sfh','Dgj','Accounts.','sgjjh@gmail.com','96877445588',0,'2024-10-31 10:05:25','2024-10-31 10:05:25');
/*!40000 ALTER TABLE `company_contacts_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_tbl`
--

DROP TABLE IF EXISTS `company_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `registration_fee` varchar(255) NOT NULL,
  `gtins_annual_fee` varchar(255) NOT NULL,
  `gln_price` varchar(255) NOT NULL,
  `sscc_price` varchar(255) NOT NULL,
  `annual_subscription_fee` varchar(255) NOT NULL,
  `reg_discount` varchar(255) DEFAULT NULL,
  `annual_discount` varchar(255) DEFAULT NULL,
  `vat_amount` varchar(255) DEFAULT NULL,
  `annual_total_price` varchar(255) NOT NULL,
  `discount_amount` varchar(255) DEFAULT NULL,
  `promo_code` varchar(255) DEFAULT NULL,
  `details` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `pobox` varchar(255) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address_ar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `fax_number` varchar(255) DEFAULT NULL,
  `website_address` varchar(255) NOT NULL,
  `cr_number` varchar(255) NOT NULL,
  `cr_legal_type` varchar(255) NOT NULL,
  `cr_registration_date` date NOT NULL,
  `cr_expiry_date` date NOT NULL,
  `cr_tax_registration_number` bigint(20) NOT NULL,
  `vat_number` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `business_type_product_category` varchar(255) NOT NULL,
  `number_of_employee` int(11) NOT NULL,
  `upload_document1` varchar(255) NOT NULL,
  `upload_document2` varchar(255) NOT NULL,
  `upload_document3` varchar(255) NOT NULL,
  `healthcare_status` varchar(50) NOT NULL,
  `main_contact_status` varchar(50) NOT NULL,
  `tnc` varchar(255) NOT NULL,
  `captcha_code` varchar(255) NOT NULL,
  `record_date` date NOT NULL,
  `reset_link_token` varchar(255) NOT NULL,
  `up_month` varchar(255) NOT NULL,
  `tax_reg_no` varchar(255) DEFAULT NULL,
  `riyada_certificate` varchar(255) DEFAULT NULL,
  `issue_date` timestamp NULL DEFAULT NULL,
  `exp_date` timestamp NULL DEFAULT NULL,
  `documents_req` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_tbl`
--

LOCK TABLES `company_tbl` WRITE;
/*!40000 ALTER TABLE `company_tbl` DISABLE KEYS */;
INSERT INTO `company_tbl` (`id`, `product_id`, `product_name`, `registration_fee`, `gtins_annual_fee`, `gln_price`, `sscc_price`, `annual_subscription_fee`, `reg_discount`, `annual_discount`, `vat_amount`, `annual_total_price`, `discount_amount`, `promo_code`, `details`, `name`, `name_ar`, `pobox`, `zipcode`, `address`, `address_ar`, `country`, `city`, `mobile_number`, `phone_number`, `fax_number`, `website_address`, `cr_number`, `cr_legal_type`, `cr_registration_date`, `cr_expiry_date`, `cr_tax_registration_number`, `vat_number`, `user_email`, `password`, `cpassword`, `business_type_product_category`, `number_of_employee`, `upload_document1`, `upload_document2`, `upload_document3`, `healthcare_status`, `main_contact_status`, `tnc`, `captcha_code`, `record_date`, `reset_link_token`, `up_month`, `tax_reg_no`, `riyada_certificate`, `issue_date`, `exp_date`, `documents_req`, `status`, `created_at`, `updated_at`) VALUES (1,5,'GTIN: Global Trade Item Numbers','400','500','','','500','0','0','45','945','0','','','test','امتحان','134243445575786879879087098709809890809888888888888888888888888888888888888888888888888888888888888888888',2147483647,'test qwerty','اختبار كويرتي','Angola','Haima','78900000000','78888888809','89999999999','www.gs1oman.org','67898798798098790','Limited Liability Company - LLC','2024-09-30','2024-10-31',8979879790890,'9779878978777','shikha3034@gmail.com','aa523afcc95fbf5d6579ee48240bd7578cc81e97','3FNY0nVz','Chocolate',1,'images/Upload/file-sample_150kB.pdf','images/Upload/file-sample_150kB.pdf','images/Upload/file-sample_150kB.pdf','NO','','','','2024-10-03','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-03 08:09:58','2024-10-03 08:09:58'),
(2,5,'GTIN: Global Trade Item Numbers','400','500','400',' 400','1300','0','0','85','1785','0','','','7th june test 1','7th june test 1','100',100,'7th june test 1','7th june test 1','Oman','Ibra','96896521236','96897521365','96897420123','www.7thoctober.com','96523100','Joint Venture','2024-04-07','2025-02-14',1002300,'6558741','7thoctober@gmail.com','50cb06251635737c58b069281664b6668df83174','NlGOHh6y','Celular Phones',10,'images/Upload/TaxCardCertificate_2024-2026.pdf','images/Upload/TaxCardCertificate_2024-2026.pdf','images/Upload/Report_202410061233.pdf','NO','','','','2024-10-07','','','','Yes','0000-00-00 00:00:00','2024-11-01 00:00:00','Additional Services - CORPORATE.PDF',0,'2024-10-07 04:19:02','2024-10-07 04:19:02'),
(3,5,'GTIN: Global Trade Item Numbers','400','','400',' 400','800','0','0','60','1260','0','','','7thoctober test 2','7thoctober test 2','500',120,'7thoctober test 2','7thoctober test 2','Oman','Mahooth','96936541233','96865641221','96896553210','www.7thoctobertest2.com','56974123','Joint Stock Company - closed SAOC','2024-07-07','2024-10-31',96523122,'845584','7thoctobertest2@gmail.com','71879f65b714084cd50f9faae54e7332045ab7c5','HPELGo3c','Babyfood',5,'images/Upload/Report_202410061233.pdf','images/Upload/__إستمارة طلب تسجيل مورد__Filled_Signed.pdf','images/Upload/Additional Services - CORPORATE.PDF','NO','','','','2024-10-07','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-07 04:23:12','2024-10-07 04:23:12'),
(4,10,'GTIN: Global Trade Item Numbers','200','250','0','','250','0','0','22.5','472.5','0','','','7thoct mobile test','7thoct mobile test','187',178,'7thoct mobile test','7thoct mobile test','Oman','Al Hamra','96892871678','96827627893','96829747829','Www.7thoctmobiletest.com','72636772','Joint Stock Company - public SAOG','2024-08-11','2024-12-19',8377892,'47667892','7thoctmobiletest@gmail.com','6b11acf159a3ab193d8a8855db77f58ece8c2f45','lbUL6XSo','Beverages',87,'images/Upload/IMG-20241004-WA0007.jpg','images/Upload/Oman Air - Print confirmation.pdf','images/Upload/CdatChamber2023-2024.pdf','Yes','','','','2024-10-07','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-07 04:27:34','2024-10-07 04:27:34'),
(5,5,'GTIN: Global Trade Item Numbers','400','500','','','500','0','0','45','945','0','','','The Red Sea ','البحر الأحمر ','275801',988,'Muscat ','مسقط ','Oman','Muscat','96891183551','96891183551','96891183551','www.redsea.com','3570813072','Limited Partnership','2024-10-03','2025-10-02',0,'','Redsea@gmail.com','9d35ba65b4fc40695728f21dd55db2be14952b3f','otJ7PG1S','Fruit',9,'images/Upload/BT 2023 Tutorial 4 Solutions.pptx','images/Upload/مشروع رياضة.docx','images/Upload/Week 5 Lecture.pptx','NO','','','','2024-10-10','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-10 06:36:55','2024-10-10 06:36:55'),
(6,5,'GTIN: Global Trade Item Numbers','400','500','','','500','50.00%','50.00%','22.5','472.5','450','Bader100','','GS1 Oman October 21','GS1 Oman','12323',112,'Markaz Al Tijari Street,First-floor OCCI','Ruwi, Sultanate of Oman','Oman','Muscat','98771777467','77771777467','96871777123','ww.Sairk.gata','177','Limited Partnership','2024-10-05','2024-10-30',234567876543,'OM346543','barco@mail.com','386415ad308377171047d7015824a1b56ad425a5','Rl971AGJ','Agro machinery',66,'images/Upload/No action for sign up.png','images/Upload/No action for sign up.png','images/Upload/Picture1.png','NO','','','','2024-10-21','','','','Yes','0000-00-00 00:00:00','2024-10-31 00:00:00','No action for sign up.png',0,'2024-10-21 09:19:37','2024-10-21 09:19:37'),
(7,6,'GTIN: Global Trade Item Numbers','400','700','500',' 500','1700','50.00%','50.00%','52.5','1102.5','1050','Bader100','','Oman Barcoding Center October a55','Oman Barcoding Center','1445',117,'Oman Post Wadi Kabir, P.O. Box 1338','Muscat - Oman','Oman','Muscat','71777467455','70016151556','56666744444','Wwa.Mm.Nmn','566666','Holding Company','2024-10-04','2024-10-31',66667,'Om1111','mohamed.akarim@gs1oman.org','81de4ea6bc5c5eb1a2d857e57e1913623730e8d3','IpeXJcGV','Biscuits',5666,'images/Upload/17294989972464737947867516112965.jpg','images/Upload/17294990047308339352705091535376.jpg','images/Upload/17294990114141036487755478422106.jpg','Yes','','','','2024-10-21','','','','Yes','0000-00-00 00:00:00','2024-11-15 00:00:00','17294988888724591360740623336134.jpg',0,'2024-10-21 09:24:52','2024-10-21 09:24:52'),
(8,3,'GTIN: Global Trade Item Numbers','200','350','300','','650','0','0','42.5','892.5','0','','','October 23rd','October 23rd','110',100,'MCT','test','Oman','Mahooth','96899453357','96845212365','','www.october23.com','1000122','General Partnership','2024-04-09','2025-04-08',23654587,'7887411','october23@gmail.com','a6194d22f8887ef7c4ba8bae5c29063836096a17','1Ze42bsL','Chemicals',10,'images/Upload/LIPCReport_PremiumCertificate_20241022151010616_U224582304.pdf','images/Upload/Policy Information Page.pdf','images/Upload/LIPCReport_PremiumCertificate_20241022151010616_U224582304.pdf','NO','','','','2024-10-23','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-23 11:32:38','2024-10-23 11:32:38'),
(9,5,'GTIN: Global Trade Item Numbers','400','','','','0','0','0','20','420','0','','','Test1','Conpany 1','123',123,'123','123','Albania','Al Buraimi','98765432100','98765432659','','','456235','General Partnership','2018-10-17','2025-10-15',956897548444,'5962123356','test1@test1.com','74e8c8f0d48714d1f01acb035add4c2801a91e18','aGh26L4e','Agro machinery',956,'images/Upload/sample.pdf','images/Upload/sample.pdf','images/Upload/sample.pdf','NO','','','','2024-10-24','','','','Yes','0000-00-00 00:00:00','0000-00-00 00:00:00','sample.pdf',0,'2024-10-24 08:49:24','2024-10-24 08:49:24'),
(10,5,'GTIN: Global Trade Item Numbers','400','','',' 400','400','0','0','40','840','0','','','Testing','testing','78965',986,'testing','testing','Oman','Al Ashkharah','98765698569','98659696589','','','456235','Limited Partnership','2019-12-26','2046-07-22',956897548444,'5962123356','testing2@testing1.com','d77cec41b6770453c4b93081bac00c40eeb2d29e','WOQKsAZt','Agriculture',956,'images/Upload/sample.pdf','images/Upload/sample.pdf','images/Upload/sample.pdf','NO','','','','2024-10-24','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-24 09:15:07','2024-10-24 09:15:07'),
(11,3,'','','','','','0','0','0','0','0','0','','','abs','abs','767676',657,'ghgjh8778','jhjkjh767','Oman','Al Suwaiq','89768787987','89789879879','65665756867','','767678878','Joint Stock Company - public SAOG','0000-00-00','0000-00-00',6565654,'vhfhgf435656576','chandni.abstain','0e02dd3eb624fe08640f93bb6f5a41bd15154995','DcT3ks90','Chocolate',44,'images/Upload/blank.pdf','images/Upload/sample.pdf','images/Upload/sample.pdf','NO','','','','2024-10-24','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-24 10:11:58','2024-10-24 10:11:58'),
(12,3,'GTIN: Global Trade Item Numbers','200','','','','0','0','0','10','210','0','','','Abs','Ghj','256959',549,'66','59','Algeria','','55599965556','55855556555','56538386766','','66464646','Joint Stock Company - closed SAOC','2024-10-11','2024-10-30',59888855,'54676767676dd','Test@test555gmail.com','7604244a4684d0e39b2b0aed5f75554834cd0f04','S1lXot9G','Bakery Products',12,'images/Upload/images.jpeg','images/Upload/images.jpeg','images/Upload/images.jpeg','NO','','','','2024-10-24','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-24 10:22:40','2024-10-24 10:22:40'),
(13,6,'GTIN: Global Trade Item Numbers','400','700','500',' 500','1700','0','0','105','2205','0','','','28th october','28th october','122',122,'28th october','28th october','Oman','','96899532145','96877452136','','www.28thoctober.com','12554789','Joint Venture','2024-10-28','2025-02-28',12544477,'78784157','28th october','4e3985239b615b3227ffbe5061682ec576b5e9fe','s0WNtkX6','Bottled water',1012,'images/Upload/report.pdf','images/Upload/report.pdf','images/Upload/report.pdf','Yes','','','','2024-10-28','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-28 05:23:15','2024-10-28 05:23:15'),
(14,5,'GTIN: Global Trade Item Numbers','400','500','400',' 400','1300','0','0','85','1785','0','','','October Test 2','October Test 2','564',433,'October Test 2','October Test 2','Oman','','96898541236','96897457974','','www.OctoberTest2.com','8784548','Joint Venture','2023-10-17','2025-10-30',75487418,'87878487','OctoberTest2@gmail.com','2c9681826a7c852565be85073a35a2044bb7495d','6S7ChJMr','Bread',100,'images/Upload/report.pdf','images/Upload/report.pdf','images/Upload/report.pdf','NO','','','','2024-10-28','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-28 06:13:42','2024-10-28 06:13:42'),
(15,3,'GTIN: Global Trade Item Numbers','200','350','300','','650','0','0','42.5','892.5','0','','','Test','test','123456',123,'Address','Address','Algeria','','98655589658','96598965899','','','456235','Limited Partnership','2024-02-14','2024-10-30',0,'','sumit.abstain@gmail.com','32566f4f448892286577c4c014de304b1cc09dbf','1rvuzmsP','Agro machinery',956,'images/Upload/sample.pdf','images/Upload/sample.pdf','images/Upload/sample.pdf','NO','','','','2024-10-29','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-29 06:52:15','2024-10-29 06:52:15'),
(16,3,'GTIN: Global Trade Item Numbers','200','350','300','','650','0','0','42.5','892.5','0','','','test','test','123',123,'test','test','Oman','','98655589658','96598965899','','','456235','Limited Partnership','2024-08-15','2024-11-01',0,'','anubhav.abstain@gmail.com','2a51d6e40d1b496a2f5e3a596b009bc211aefd2f','mVrGsg3x','Agro machinery',956,'images/Upload/sample.pdf','images/Upload/sample.pdf','images/Upload/sample.pdf','NO','','','','2024-10-29','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-29 07:43:30','2024-10-29 07:43:30'),
(17,3,'GTIN: Global Trade Item Numbers','200','350','300','','650','0','0','42.5','892.5','0','','','test','test','123',986,'asd','asd','Oman','','65239856985','65236985698','','','456235','Limited Partnership','0000-00-00','0000-00-00',0,'','anubhav,abstain@gmail.com','f9afc3575923f99e22268b480f718fb6af4211a9','BEua7639','Agriculture',956,'images/Upload/sample.pdf','images/Upload/sample.pdf','images/Upload/sample.pdf','NO','','','','2024-10-29','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-29 07:54:26','2024-10-29 07:54:26'),
(18,5,'GTIN: Global Trade Item Numbers','200','','','','0','0','0','10','210','0','','','test','test','123',123,'test','test','Afghanistan','','98655589658','96598965899','','','456235','Limited Partnership','2022-08-27','2026-08-27',956897548444,'5962123356','testing.sumit@test.com','a6a0480f7c5b0b9beb98c029feefdf80a3fdcb49','YmPCc6as','Babyfood',956,'images/Upload/sample.pdf','images/Upload/sample.pdf','images/Upload/sample.pdf','NO','','','','2024-10-29','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-29 11:29:03','2024-10-29 11:29:03'),
(19,3,'GTIN: Global Trade Item Numbers','200','','','','0','0','0','10','210','0','','','test','test','123',123,'test','test','Afghanistan','','98655589658','96598965899','','','456235','Limited Partnership','2022-08-27','2026-08-27',956897548444,'5962123356','testting@ymail.com','2a5d5bec907b1db973cab710e329e156e81ac321','6n7V2U0f','Agro machinery',956,'images/Upload/sample.pdf','images/Upload/sample.pdf','images/Upload/sample.pdf','NO','','','','2024-10-29','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-29 12:03:38','2024-10-29 12:03:38'),
(20,5,'GTIN: Global Trade Item Numbers','400','500','','','500','50.00%','50.00%','22.5','472.5','450','Bader100','','Amal','6','54678',112,'Bousher','Ruwi','Oman','','96897114040','96897114046','','Bousher','234567890','Limited Liability Company - LLC','2024-10-31','2024-12-07',0,'','amal.zeidi@gs1oman.org','3eba1e29ebb352e5b79cd7e5ada50fd5addc0f72','9UQbSBGj','Coffee',5,'images/Upload/gs1oman_banner.png','images/Upload/gs1oman_banner.png','images/Upload/gs1oman_banner.png','NO','','','','2024-10-31','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-31 09:22:35','2024-10-31 09:22:35'),
(21,3,'GTIN: Global Trade Item Numbers','200','350','300','','650','50.00%','50.00%','21.25','446.25','425','Bader100','','Amal','امل ','3468',356,'Muscat ','مسقط ','Oman','','96897114040','96897114046','','','257899','Joint Stock Company - closed SAOC','2024-09-07','2025-01-21',99655,'4678','a.ah@gmail.com','f71ae051c32abe083cd7faaeac00ada60a401451','Tf3RuXVY','Babyfood',7,'images/Upload/image.jpg','images/Upload/image.jpg','images/Upload/image.jpg','NO','','','','2024-10-31','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-31 09:35:05','2024-10-31 09:35:05'),
(22,3,'GTIN: Global Trade Item Numbers','200','350','300','','650','50.00%','50.00%','21.25','446.25','425','Bader100','','Oman Barcoding Bader','مركز الترقيم بدر ','111',111,'Seeb','السيب','Oman','','96899361328','96899119917','','','12345987','General Partnership','2024-10-09','2024-11-01',12121255,'1313166','123@hotmail.om','4656d8ad52a48b2365741c221ccd6667d85aaf1a','E1lnHStO','Vegetable',10,'images/Upload/Screenshot 2024-10-16 150035.png','images/Upload/Screenshot 2023-05-10 094817.png','images/Upload/Screenshot 2023-05-10 094817.png','Yes','','','','2024-10-31','','','','Yes','0000-00-00 00:00:00','2024-11-01 00:00:00','Screenshot 2023-05-10 083708.png',0,'2024-10-31 09:45:49','2024-10-31 09:45:49'),
(23,6,'','','','','','0','50.00%','50.00%','0','0','0','Bader100','','Sheikha S H N','شيخه سالم حمد النوفلي ','112',116,'Al Qurum, Bousher, Muscat','Muscat','Oman','','96890998434','96890998544','96890398446','www.sheik44ha.com','123477','Joint Stock Company - public SAOG','2024-10-08','2024-12-31',1234567,'OM1235467','shei5kha@hotmail.com','25cbcdefd1c939369c8a599f83f321e5bdce9dde','LK1MX5ua','Babyfood',45,'images/Upload/download.png','images/Upload/af9108a9-b11e-4799-893e-25d7984cd2e2.jpeg','images/Upload/E_EUbuGXIAISYix-1-811x485-1.jpeg','NO','','','','2024-10-31','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-31 10:00:03','2024-10-31 10:00:03'),
(24,5,'GTIN: Global Trade Item Numbers','400','500','','','500','50.00%','50.00%','22.5','472.5','450','Bader100','','Sheikh','شيخه م ','134',245,'Shoar','صحار','Oman','','96898654337','96823568974','','www.bysheikha.com','1235','Joint Stock Company - closed SAOC','0000-00-00','0000-00-00',1356,'Om23696','She@hotmail.com','c8afe6912fcf35a0a9fadff4498858ae396bce8c','vX87GOWI','Bottled water',35,'images/Upload/image.jpg','images/Upload/image.jpg','images/Upload/image.jpg','NO','','','','2024-10-31','','','','No','0000-00-00 00:00:00','0000-00-00 00:00:00','',0,'2024-10-31 10:05:25','2024-10-31 10:05:25');
/*!40000 ALTER TABLE `company_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `country_code` varchar(2) NOT NULL,
  `country_enName` varchar(100) NOT NULL DEFAULT '',
  `country_arName` varchar(100) NOT NULL DEFAULT '',
  `country_enNationality` varchar(100) NOT NULL DEFAULT '',
  `country_arNationality` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`country_code`),
  KEY `country_code_2` (`country_code`),
  KEY `country_code` (`country_code`) USING BTREE,
  FULLTEXT KEY `country_code_3` (`country_code`),
  FULLTEXT KEY `country_code_4` (`country_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`country_code`, `country_enName`, `country_arName`, `country_enNationality`, `country_arNationality`) VALUES ('AF','Afghanistan','أفغانستان','Afghan','أفغانستاني'),
('AL','Albania','ألبانيا','Albanian','ألباني'),
('AX','Aland Islands','جزر آلاند','Aland Islander','آلاندي'),
('DZ','Algeria','الجزائر','Algerian','جزائري'),
('AS','American Samoa','ساموا-الأمريكي','American Samoan','أمريكي سامواني'),
('AD','Andorra','أندورا','Andorran','أندوري'),
('AO','Angola','أنغولا','Angolan','أنقولي'),
('AI','Anguilla','أنغويلا','Anguillan','أنغويلي'),
('AQ','Antarctica','أنتاركتيكا','Antarctican','أنتاركتيكي'),
('AG','Antigua and Barbuda','أنتيغوا وبربودا','Antiguan','بربودي'),
('AR','Argentina','الأرجنتين','Argentinian','أرجنتيني'),
('AM','Armenia','أرمينيا','Armenian','أرميني'),
('AW','Aruba','أروبه','Aruban','أوروبهيني'),
('AU','Australia','أستراليا','Australian','أسترالي'),
('AT','Austria','النمسا','Austrian','نمساوي'),
('AZ','Azerbaijan','أذربيجان','Azerbaijani','أذربيجاني'),
('BS','Bahamas','الباهاماس','Bahamian','باهاميسي'),
('BH','Bahrain','البحرين','Bahraini','بحريني'),
('BD','Bangladesh','بنغلاديش','Bangladeshi','بنغلاديشي'),
('BB','Barbados','بربادوس','Barbadian','بربادوسي'),
('BY','Belarus','روسيا البيضاء','Belarusian','روسي'),
('BE','Belgium','بلجيكا','Belgian','بلجيكي'),
('BZ','Belize','بيليز','Belizean','بيليزي'),
('BJ','Benin','بنين','Beninese','بنيني'),
('BL','Saint Barthelemy','سان بارتيلمي','Saint Barthelmian','سان بارتيلمي'),
('BM','Bermuda','جزر برمودا','Bermudan','برمودي'),
('BT','Bhutan','بوتان','Bhutanese','بوتاني'),
('BO','Bolivia','بوليفيا','Bolivian','بوليفي'),
('BA','Bosnia and Herzegovina','البوسنة و الهرسك','Bosnian / Herzegovinian','بوسني/هرسكي'),
('BW','Botswana','بوتسوانا','Botswanan','بوتسواني'),
('BV','Bouvet Island','جزيرة بوفيه','Bouvetian','بوفيهي'),
('BR','Brazil','البرازيل','Brazilian','برازيلي'),
('IO','British Indian Ocean Territory','إقليم المحيط الهندي البريطاني','British Indian Ocean Territory','إقليم المحيط الهندي البريطاني'),
('BN','Brunei Darussalam','بروني','Bruneian','بروني'),
('BG','Bulgaria','بلغاريا','Bulgarian','بلغاري'),
('BF','Burkina Faso','بوركينا فاسو','Burkinabe','بوركيني'),
('BI','Burundi','بوروندي','Burundian','بورونيدي'),
('KH','Cambodia','كمبوديا','Cambodian','كمبودي'),
('CM','Cameroon','كاميرون','Cameroonian','كاميروني'),
('CA','Canada','كندا','Canadian','كندي'),
('CV','Cape Verde','الرأس الأخضر','Cape Verdean','الرأس الأخضر'),
('KY','Cayman Islands','جزر كايمان','Caymanian','كايماني'),
('CF','Central African Republic','جمهورية أفريقيا الوسطى','Central African','أفريقي'),
('TD','Chad','تشاد','Chadian','تشادي'),
('CL','Chile','شيلي','Chilean','شيلي'),
('CN','China','الصين','Chinese','صيني'),
('CX','Christmas Island','جزيرة عيد الميلاد','Christmas Islander','جزيرة عيد الميلاد'),
('CC','Cocos (Keeling) Islands','جزر كوكوس','Cocos Islander','جزر كوكوس'),
('CO','Colombia','كولومبيا','Colombian','كولومبي'),
('KM','Comoros','جزر القمر','Comorian','جزر القمر'),
('CG','Congo','الكونغو','Congolese','كونغي'),
('CK','Cook Islands','جزر كوك','Cook Islander','جزر كوك'),
('CR','Costa Rica','كوستاريكا','Costa Rican','كوستاريكي'),
('HR','Croatia','كرواتيا','Croatian','كوراتي'),
('CU','Cuba','كوبا','Cuban','كوبي'),
('CY','Cyprus','قبرص','Cypriot','قبرصي'),
('CW','Curaçao','كوراساو','Curacian','كوراساوي'),
('CZ','Czech Republic','الجمهورية التشيكية','Czech','تشيكي'),
('DK','Denmark','الدانمارك','Danish','دنماركي'),
('DJ','Djibouti','جيبوتي','Djiboutian','جيبوتي'),
('DM','Dominica','دومينيكا','Dominican','دومينيكي'),
('DO','Dominican Republic','الجمهورية الدومينيكية','Dominican','دومينيكي'),
('EC','Ecuador','إكوادور','Ecuadorian','إكوادوري'),
('EG','Egypt','مصر','Egyptian','مصري'),
('SV','El Salvador','إلسلفادور','Salvadoran','سلفادوري'),
('GQ','Equatorial Guinea','غينيا الاستوائي','Equatorial Guinean','غيني'),
('ER','Eritrea','إريتريا','Eritrean','إريتيري'),
('EE','Estonia','استونيا','Estonian','استوني'),
('ET','Ethiopia','أثيوبيا','Ethiopian','أثيوبي'),
('FK','Falkland Islands (Malvinas)','جزر فوكلاند','Falkland Islander','فوكلاندي'),
('FO','Faroe Islands','جزر فارو','Faroese','جزر فارو'),
('FJ','Fiji','فيجي','Fijian','فيجي'),
('FI','Finland','فنلندا','Finnish','فنلندي'),
('FR','France','فرنسا','French','فرنسي'),
('GF','French Guiana','غويانا الفرنسية','French Guianese','غويانا الفرنسية'),
('PF','French Polynesia','بولينيزيا الفرنسية','French Polynesian','بولينيزيي'),
('TF','French Southern and Antarctic Lands','أراض فرنسية جنوبية وأنتارتيكية','French','أراض فرنسية جنوبية وأنتارتيكية'),
('GA','Gabon','الغابون','Gabonese','غابوني'),
('GM','Gambia','غامبيا','Gambian','غامبي'),
('GE','Georgia','جيورجيا','Georgian','جيورجي'),
('DE','Germany','ألمانيا','German','ألماني'),
('GH','Ghana','غانا','Ghanaian','غاني'),
('GI','Gibraltar','جبل طارق','Gibraltar','جبل طارق'),
('GG','Guernsey','غيرنزي','Guernsian','غيرنزي'),
('GR','Greece','اليونان','Greek','يوناني'),
('GL','Greenland','جرينلاند','Greenlandic','جرينلاندي'),
('GD','Grenada','غرينادا','Grenadian','غرينادي'),
('GP','Guadeloupe','جزر جوادلوب','Guadeloupe','جزر جوادلوب'),
('GU','Guam','جوام','Guamanian','جوامي'),
('GT','Guatemala','غواتيمال','Guatemalan','غواتيمالي'),
('GN','Guinea','غينيا','Guinean','غيني'),
('GW','Guinea-Bissau','غينيا-بيساو','Guinea-Bissauan','غيني'),
('GY','Guyana','غيانا','Guyanese','غياني'),
('HT','Haiti','هايتي','Haitian','هايتي'),
('HM','Heard and Mc Donald Islands','جزيرة هيرد وجزر ماكدونالد','Heard and Mc Donald Islanders','جزيرة هيرد وجزر ماكدونالد'),
('HN','Honduras','هندوراس','Honduran','هندوراسي'),
('HK','Hong Kong','هونغ كونغ','Hongkongese','هونغ كونغي'),
('HU','Hungary','المجر','Hungarian','مجري'),
('IS','Iceland','آيسلندا','Icelandic','آيسلندي'),
('IN','India','الهند','Indian','هندي'),
('IM','Isle of Man','جزيرة مان','Manx','ماني'),
('ID','Indonesia','أندونيسيا','Indonesian','أندونيسيي'),
('IR','Iran','إيران','Iranian','إيراني'),
('IQ','Iraq','العراق','Iraqi','عراقي'),
('IE','Ireland','إيرلندا','Irish','إيرلندي'),
('IL','Israel','إسرائيل','Israeli','إسرائيلي'),
('IT','Italy','إيطاليا','Italian','إيطالي'),
('CI','Ivory Coast','ساحل العاج','Ivory Coastian','ساحل العاج'),
('JE','Jersey','جيرزي','Jersian','جيرزي'),
('JM','Jamaica','جمايكا','Jamaican','جمايكي'),
('JP','Japan','اليابان','Japanese','ياباني'),
('JO','Jordan','الأردن','Jordanian','أردني'),
('KZ','Kazakhstan','كازاخستان','Kazakh','كازاخستاني'),
('KE','Kenya','كينيا','Kenyan','كيني'),
('KI','Kiribati','كيريباتي','I-Kiribati','كيريباتي'),
('KP','Korea(North Korea)','كوريا الشمالية','North Korean','كوري'),
('KR','Korea(South Korea)','كوريا الجنوبية','South Korean','كوري'),
('XK','Kosovo','كوسوفو','Kosovar','كوسيفي'),
('KW','Kuwait','الكويت','Kuwaiti','كويتي'),
('KG','Kyrgyzstan','قيرغيزستان','Kyrgyzstani','قيرغيزستاني'),
('LA','Lao PDR','لاوس','Laotian','لاوسي'),
('LV','Latvia','لاتفيا','Latvian','لاتيفي'),
('LB','Lebanon','لبنان','Lebanese','لبناني'),
('LS','Lesotho','ليسوتو','Basotho','ليوسيتي'),
('LR','Liberia','ليبيريا','Liberian','ليبيري'),
('LY','Libya','ليبيا','Libyan','ليبي'),
('LI','Liechtenstein','ليختنشتين','Liechtenstein','ليختنشتيني'),
('LT','Lithuania','لتوانيا','Lithuanian','لتوانيي'),
('LU','Luxembourg','لوكسمبورغ','Luxembourger','لوكسمبورغي'),
('LK','Sri Lanka','سريلانكا','Sri Lankian','سريلانكي'),
('MO','Macau','ماكاو','Macanese','ماكاوي'),
('MK','Macedonia','مقدونيا','Macedonian','مقدوني'),
('MG','Madagascar','مدغشقر','Malagasy','مدغشقري'),
('MW','Malawi','مالاوي','Malawian','مالاوي'),
('MY','Malaysia','ماليزيا','Malaysian','ماليزي'),
('MV','Maldives','المالديف','Maldivian','مالديفي'),
('ML','Mali','مالي','Malian','مالي'),
('MT','Malta','مالطا','Maltese','مالطي'),
('MH','Marshall Islands','جزر مارشال','Marshallese','مارشالي'),
('MQ','Martinique','مارتينيك','Martiniquais','مارتينيكي'),
('MR','Mauritania','موريتانيا','Mauritanian','موريتانيي'),
('MU','Mauritius','موريشيوس','Mauritian','موريشيوسي'),
('YT','Mayotte','مايوت','Mahoran','مايوتي'),
('MX','Mexico','المكسيك','Mexican','مكسيكي'),
('FM','Micronesia','مايكرونيزيا','Micronesian','مايكرونيزيي'),
('MD','Moldova','مولدافيا','Moldovan','مولديفي'),
('MC','Monaco','موناكو','Monacan','مونيكي'),
('MN','Mongolia','منغوليا','Mongolian','منغولي'),
('ME','Montenegro','الجبل الأسود','Montenegrin','الجبل الأسود'),
('MS','Montserrat','مونتسيرات','Montserratian','مونتسيراتي'),
('MA','Morocco','المغرب','Moroccan','مغربي'),
('MZ','Mozambique','موزمبيق','Mozambican','موزمبيقي'),
('MM','Myanmar','ميانمار','Myanmarian','ميانماري'),
('NA','Namibia','ناميبيا','Namibian','ناميبي'),
('NR','Nauru','نورو','Nauruan','نوري'),
('NP','Nepal','نيبال','Nepalese','نيبالي'),
('NL','Netherlands','هولندا','Dutch','هولندي'),
('AN','Netherlands Antilles','جزر الأنتيل الهولندي','Dutch Antilier','هولندي'),
('NC','New Caledonia','كاليدونيا الجديدة','New Caledonian','كاليدوني'),
('NZ','New Zealand','نيوزيلندا','New Zealander','نيوزيلندي'),
('NI','Nicaragua','نيكاراجوا','Nicaraguan','نيكاراجوي'),
('NE','Niger','النيجر','Nigerien','نيجيري'),
('NG','Nigeria','نيجيريا','Nigerian','نيجيري'),
('NU','Niue','ني','Niuean','ني'),
('NF','Norfolk Island','جزيرة نورفولك','Norfolk Islander','نورفوليكي'),
('MP','Northern Mariana Islands','جزر ماريانا الشمالية','Northern Marianan','ماريني'),
('NO','Norway','النرويج','Norwegian','نرويجي'),
('OM','Oman','عمان','Omani','عماني'),
('PK','Pakistan','باكستان','Pakistani','باكستاني'),
('PW','Palau','بالاو','Palauan','بالاوي'),
('PS','Palestine','فلسطين','Palestinian','فلسطيني'),
('PA','Panama','بنما','Panamanian','بنمي'),
('PG','Papua New Guinea','بابوا غينيا الجديدة','Papua New Guinean','بابوي'),
('PY','Paraguay','باراغواي','Paraguayan','بارغاوي'),
('PE','Peru','بيرو','Peruvian','بيري'),
('PH','Philippines','الفليبين','Filipino','فلبيني'),
('PN','Pitcairn','بيتكيرن','Pitcairn Islander','بيتكيرني'),
('PL','Poland','بولندا','Polish','بولندي'),
('PT','Portugal','البرتغال','Portuguese','برتغالي'),
('PR','Puerto Rico','بورتو ريكو','Puerto Rican','بورتي'),
('QA','Qatar','قطر','Qatari','قطري'),
('RE','Reunion Island','ريونيون','Reunionese','ريونيوني'),
('RO','Romania','رومانيا','Romanian','روماني'),
('RU','Russian','روسيا','Russian','روسي'),
('RW','Rwanda','رواندا','Rwandan','رواندا'),
('KN','Saint Kitts and Nevis','سانت كيتس ونيفس,','Kittitian/Nevisian','سانت كيتس ونيفس'),
('MF','Saint Martin (French part)','ساينت مارتن فرنسي','St. Martian(French)','ساينت مارتني فرنسي'),
('SX','Sint Maarten (Dutch part)','ساينت مارتن هولندي','St. Martian(Dutch)','ساينت مارتني هولندي'),
('LC','Saint Pierre and Miquelon','سان بيير وميكلون','St. Pierre and Miquelon','سان بيير وميكلوني'),
('VC','Saint Vincent and the Grenadines','سانت فنسنت وجزر غرينادين','Saint Vincent and the Grenadines','سانت فنسنت وجزر غرينادين'),
('WS','Samoa','ساموا','Samoan','ساموي'),
('SM','San Marino','سان مارينو','Sammarinese','ماريني'),
('ST','Sao Tome and Principe','ساو تومي وبرينسيبي','Sao Tomean','ساو تومي وبرينسيبي'),
('SA','Saudi Arabia','المملكة العربية السعودية','Saudi Arabian','سعودي'),
('SN','Senegal','السنغال','Senegalese','سنغالي'),
('RS','Serbia','صربيا','Serbian','صربي'),
('SC','Seychelles','سيشيل','Seychellois','سيشيلي'),
('SL','Sierra Leone','سيراليون','Sierra Leonean','سيراليوني'),
('SG','Singapore','سنغافورة','Singaporean','سنغافوري'),
('SK','Slovakia','سلوفاكيا','Slovak','سولفاكي'),
('SI','Slovenia','سلوفينيا','Slovenian','سولفيني'),
('SB','Solomon Islands','جزر سليمان','Solomon Island','جزر سليمان'),
('SO','Somalia','الصومال','Somali','صومالي'),
('ZA','South Africa','جنوب أفريقيا','South African','أفريقي'),
('GS','South Georgia and the South Sandwich','المنطقة القطبية الجنوبية','South Georgia and the South Sandwich','لمنطقة القطبية الجنوبية'),
('SS','South Sudan','السودان الجنوبي','South Sudanese','سوادني جنوبي'),
('ES','Spain','إسبانيا','Spanish','إسباني'),
('SH','Saint Helena','سانت هيلانة','St. Helenian','هيلاني'),
('SD','Sudan','السودان','Sudanese','سوداني'),
('SR','Suriname','سورينام','Surinamese','سورينامي'),
('SJ','Svalbard and Jan Mayen','سفالبارد ويان ماين','Svalbardian/Jan Mayenian','سفالبارد ويان ماين'),
('SZ','Swaziland','سوازيلند','Swazi','سوازيلندي'),
('SE','Sweden','السويد','Swedish','سويدي'),
('CH','Switzerland','سويسرا','Swiss','سويسري'),
('SY','Syria','سوريا','Syrian','سوري'),
('TW','Taiwan','تايوان','Taiwanese','تايواني'),
('TJ','Tajikistan','طاجيكستان','Tajikistani','طاجيكستاني'),
('TZ','Tanzania','تنزانيا','Tanzanian','تنزانيي'),
('TH','Thailand','تايلندا','Thai','تايلندي'),
('TL','Timor-Leste','تيمور الشرقية','Timor-Lestian','تيموري'),
('TG','Togo','توغو','Togolese','توغي'),
('TK','Tokelau','توكيلاو','Tokelaian','توكيلاوي'),
('TO','Tonga','تونغا','Tongan','تونغي'),
('TT','Trinidad and Tobago','ترينيداد وتوباغو','Trinidadian/Tobagonian','ترينيداد وتوباغو'),
('TN','Tunisia','تونس','Tunisian','تونسي'),
('TR','Turkey','تركيا','Turkish','تركي'),
('TM','Turkmenistan','تركمانستان','Turkmen','تركمانستاني'),
('TC','Turks and Caicos Islands','جزر توركس وكايكوس','Turks and Caicos Islands','جزر توركس وكايكوس'),
('TV','Tuvalu','توفالو','Tuvaluan','توفالي'),
('UG','Uganda','أوغندا','Ugandan','أوغندي'),
('UA','Ukraine','أوكرانيا','Ukrainian','أوكراني'),
('AE','United Arab Emirates','الإمارات العربية المتحدة','Emirati','إماراتي'),
('GB','United Kingdom','المملكة المتحدة','British','بريطاني'),
('US','United States','الولايات المتحدة','American','أمريكي'),
('UM','US Minor Outlying Islands','قائمة الولايات والمناطق الأمريكية','US Minor Outlying Islander','أمريكي'),
('UY','Uruguay','أورغواي','Uruguayan','أورغواي'),
('UZ','Uzbekistan','أوزباكستان','Uzbek','أوزباكستاني'),
('VU','Vanuatu','فانواتو','Vanuatuan','فانواتي'),
('VE','Venezuela','فنزويلا','Venezuelan','فنزويلي'),
('VN','Vietnam','فيتنام','Vietnamese','فيتنامي'),
('VI','Virgin Islands (U.S.)','الجزر العذراء الأمريكي','American Virgin Islander','أمريكي'),
('VA','Vatican City','فنزويلا','Vatican','فاتيكاني'),
('WF','Wallis and Futuna Islands','والس وفوتونا','Wallisian/Futunan','فوتوني'),
('EH','Western Sahara','الصحراء الغربية','Sahrawian','صحراوي'),
('YE','Yemen','اليمن','Yemeni','يمني'),
('ZM','Zambia','زامبيا','Zambian','زامبياني'),
('ZW','Zimbabwe','زمبابوي','Zimbabwean','زمبابوي');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multiple_order`
--

DROP TABLE IF EXISTS `multiple_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multiple_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) DEFAULT NULL,
  `compay_id` varchar(255) DEFAULT NULL,
  `receipt_img` varchar(255) DEFAULT NULL,
  `trans_number` varchar(255) DEFAULT NULL,
  `renewal_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multiple_order`
--

LOCK TABLES `multiple_order` WRITE;
/*!40000 ALTER TABLE `multiple_order` DISABLE KEYS */;
INSERT INTO `multiple_order` (`id`, `order_id`, `compay_id`, `receipt_img`, `trans_number`, `renewal_date`, `created_at`, `updated_at`) VALUES (1,'128','15','images/Upload/dummytesting.pdf','123456555588888','2024-03-20','2024-03-14 08:06:37','2024-03-14 08:06:37'),
(2,'126','15','images/Upload/dummy.pdf','123456','2024-03-22','2024-03-14 10:09:39','2024-03-14 10:09:39'),
(3,'136','15','images/Upload/dummy15.pdf','12345','2024-03-20','2024-03-15 07:44:40','2024-03-15 07:44:40'),
(4,'135','15','images/Upload/dummy15.pdf','123456','2024-03-27','2024-03-15 08:26:49','2024-03-15 08:26:49'),
(5,'136','15','images/Upload/dummy15.pdf','12345','2024-03-21','2024-03-15 09:44:31','2024-03-15 09:44:31'),
(6,'63','32','images/Upload/dummy18.pdf','2145874','2024-03-18','2024-03-18 04:49:38','2024-03-18 04:49:38'),
(7,'63','32','images/Upload/dummy18.pdf','2145874','2024-03-18','2024-03-18 05:02:44','2024-03-18 05:02:44'),
(8,'64','32','images/Upload/dummy19.pdf','123456','2024-03-22','2024-03-18 05:16:14','2024-03-18 05:16:14'),
(9,'89','15','images/Upload/dummy19.pdf','123456','2024-03-18','2024-03-18 05:20:58','2024-03-18 05:20:58');
/*!40000 ALTER TABLE `multiple_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_tbl`
--

DROP TABLE IF EXISTS `order_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `payment_data` text DEFAULT NULL,
  `offline_payment` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prefix_num` varchar(255) NOT NULL,
  `gln_number` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `registration_fee` varchar(255) NOT NULL,
  `gtins_annual_fee` varchar(255) NOT NULL,
  `gln_price` varchar(255) NOT NULL,
  `sscc_price` varchar(255) NOT NULL,
  `annual_subscription_fee` int(11) NOT NULL,
  `annual_total_price` varchar(255) NOT NULL,
  `renew_price` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `renew_date` date NOT NULL,
  `record_date` date NOT NULL,
  `up_month` varchar(255) NOT NULL,
  `certificate_img` varchar(255) NOT NULL,
  `certificate_pdf` varchar(255) NOT NULL,
  `certificate_glnimg` varchar(255) NOT NULL,
  `certificate_glnpdf` varchar(255) NOT NULL,
  `trans_number` varchar(255) DEFAULT NULL,
  `payment_receipt` varchar(255) DEFAULT NULL,
  `promo_code` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL,
  `renew_status` int(11) NOT NULL,
  `old` int(11) NOT NULL DEFAULT 0,
  `expired` int(11) NOT NULL DEFAULT 0,
  `renewal_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=278 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_tbl`
--

LOCK TABLES `order_tbl` WRITE;
/*!40000 ALTER TABLE `order_tbl` DISABLE KEYS */;
INSERT INTO `order_tbl` (`id`, `order_id`, `payment_data`, `offline_payment`, `company_id`, `product_id`, `prefix_num`, `gln_number`, `longitude`, `latitude`, `username`, `user_email`, `registration_fee`, `gtins_annual_fee`, `gln_price`, `sscc_price`, `annual_subscription_fee`, `annual_total_price`, `renew_price`, `order_date`, `expiry_date`, `renew_date`, `record_date`, `up_month`, `certificate_img`, `certificate_pdf`, `certificate_glnimg`, `certificate_glnpdf`, `trans_number`, `payment_receipt`, `promo_code`, `parent_id`, `status`, `renew_status`, `old`, `expired`, `renewal_date`) VALUES (63,'Barcode1019','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002802044521L87075099F3\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"f5b5e42a01\",\"successIndicator\":\"6232984656e846d4\"}',NULL,32,5,'test','test','32.658741','45.658741','','prabi@alkhanjartechnology.com','400','500','400','',900,'900',0,'2023-08-28','2023-12-31','0000-00-00','0000-00-00','','certificate/1715053260.jpg','certificate/1715053260.pdf','certificate/glncertificate/gln_1715053260.jpg','certificate/glncertificate/gln_1715053260.pdf','2145874',NULL,'',0,1,0,0,1,NULL),
(64,'Barcode9668','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002598008980G4179741J49\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"6d8c0acb01\",\"successIndicator\":\"d1338532aee84c8e\"}',NULL,32,5,'','','','','','prabi@alkhanjartechnology.com','400','500','400','400',1300,'1300',0,'2023-08-28','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(65,'Barcode2558','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002204517504M8786062G73\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"c8d596bb01\",\"successIndicator\":\"eb383c0295994974\"}',NULL,15,3,'','','','','','prabikrishna+gs1@gmail.com','200','350','','',350,'350',0,'2023-09-15','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(66,'Barcode3302','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002570164058L4547383F76\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"680b28f101\",\"successIndicator\":\"5e49c45b2f1b44f8\"}',NULL,15,6,'','','','','','prabikrishna+gs1@gmail.com','400','','','500',500,'500',0,'2023-09-15','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(67,'Barcode1418','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002480626957M8505805L72\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"0f4fc21101\",\"successIndicator\":\"2f5ef2c5db6e4f6a\"}',NULL,15,10,'','','','','','prabikrishna+gs1@gmail.com','200','250','0','',250,'250',0,'2023-09-16','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(68,'Barcode4281','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002026184053I6685042G89\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"f783341201\",\"successIndicator\":\"2f886ff0d9434e17\"}',NULL,15,6,'','','','','','prabikrishna+gs1@gmail.com','400','','','500',500,'500',0,'2023-09-16','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(69,'Barcode9389','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002273629976L5300627N13\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"de89fa1f01\",\"successIndicator\":\"5431966ba1a74802\"}',NULL,15,5,'','','','','','prabikrishna+gs1@gmail.com','400','','400','',400,'400',0,'2023-09-16','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(70,'Barcode6875','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002991310855H3772384J66\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"8d9fe67501\",\"successIndicator\":\"cde42d7e2a4848b4\"}',NULL,15,3,'','','','','','prabikrishna+gs1@gmail.com','200','','','',0,'0',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(71,'Barcode1023','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002230437227I05090545H5\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"65b75fbf01\",\"successIndicator\":\"645e12a428324b5a\"}',NULL,15,6,'112','112','','','','prabikrishna+gs1@gmail.com','400','700','','',700,'700',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(72,'Barcode6041','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002398677135N3165419K04\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"9c630f1f01\",\"successIndicator\":\"95e694e9bde7428d\"}',NULL,15,5,'','','','','','prabikrishna+gs1@gmail.com','400','500','','',500,'500',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(73,'Barcode2484',NULL,NULL,15,5,'11','11','','','','prabikrishna+gs1@gmail.com','400','500','','',500,'500',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','certificate/1701089814.jpg','certificate/1701089814.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(75,'Barcode5250',NULL,NULL,15,3,'','','','','','prabikrishna+gs1@gmail.com','200','350','','',350,'350',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(76,'Barcode1243','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002606528025G2684984G26\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"888f017d01\",\"successIndicator\":\"bf04969d3dbc45bc\"}',NULL,15,5,'','','','','','prabikrishna+gs1@gmail.com','400','','400','',400,'400',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(77,'Barcode6560',NULL,NULL,15,5,'','','','','','prabikrishna+gs1@gmail.com','400','','400','',400,'400',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(78,'Barcode6425','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002830801498F8308703I50\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"730ae7ac01\",\"successIndicator\":\"d6969374c24d4a3b\"}',NULL,15,5,'','','','','','prabikrishna+gs1@gmail.com','400','500','','',500,'500',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(79,'Barcode4593','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002873249400K9218276N07\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"4659142301\",\"successIndicator\":\"a9176584f03d4ead\"}',NULL,15,5,'','','','','','prabikrishna+gs1@gmail.com','400','500','','',500,'500',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(80,'Barcode5786',NULL,NULL,15,3,'','','','','','prabikrishna+gs1@gmail.com','200','350','','',350,'350',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(81,'Barcode613','offlineBarcode613',1,15,5,'','','','','','prabikrishna+gs1@gmail.com','400','','400','',400,'400',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(82,'Barcode6944','offlineBarcode6944',1,15,5,'11','11','','','','prabikrishna+gs1@gmail.com','400','500','','',500,'500',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','certificate/1695368850.jpg','certificate/1695368850.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(83,'Barcode6722','offlineBarcode6722',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','200','250','','',250,'250',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(84,'Barcode8748','offlineBarcode8748',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','200','250','','',250,'250',0,'2023-09-18','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(85,'Barcode2726','offlineBarcode2726',1,15,10,'123','123','','','','prabikrishna+gs1@gmail.com','200','250','','',250,'250',0,'2023-09-18','2023-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(86,'Barcode9959','offlineBarcode9959',1,15,10,'223','233','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2023-09-18','2023-12-31','0000-00-00','0000-00-00','','certificate/1701089548.jpg','certificate/1701089548.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(89,'Barcode9214','offlineBarcode9214',1,15,10,'123','123','','','','prabikrishna+gs1@gmail.com','1','250','','',250,'250',0,'2023-09-18','2023-12-31','0000-00-00','0000-00-00','','certificate/1698751622.jpg','certificate/1698751622.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(90,'Barcode3385','offlineBarcode3385',1,15,10,'456','456','','','','prabikrishna+gs1@gmail.com','0','','0','',0,'0',0,'2023-09-18','2023-12-31','0000-00-00','0000-00-00','','certificate/1698751492.jpg','certificate/1698751492.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(92,'Barcode4663','offlineBarcode4663',1,15,3,'1234','1234','','','','prabikrishna+gs1@gmail.com','0','','300','0',0,'0',0,'2023-09-20','2023-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(94,'Barcode728','offlineBarcode728',1,34,6,'55887458','55887458','','','','prabi@ftsoman.com','0','700','500','',1200,'1200',0,'2023-10-08','2023-12-31','0000-00-00','0000-00-00','','certificate/1696911749.jpg','certificate/1696911749.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(95,'Barcode6432','offlineBarcode6432',1,15,10,'456','456','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2023-10-10','2023-12-31','0000-00-00','0000-00-00','','certificate/1701089425.jpg','certificate/1701089425.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(96,'Barcode7255','offlineBarcode7255',1,15,10,'123','123','','','','prabikrishna+gs1@gmail.com','0','','0','',0,'0',0,'2023-10-10','2023-12-31','0000-00-00','0000-00-00','','certificate/1698743912.jpg','certificate/1698743912.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(97,'Barcode1598','offlineBarcode1598',1,15,10,'3345','345','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2023-10-10','2023-12-31','0000-00-00','0000-00-00','','certificate/1698751210.jpg','certificate/1698751210.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(99,'Barcode938','offlineBarcode938',1,15,10,'123','123','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2023-10-11','2023-12-31','0000-00-00','0000-00-00','','certificate/1698751135.jpg','certificate/1698751135.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(100,'Barcode9981','offlineBarcode9981',1,15,3,'1234','2222','','','','prabikrishna+gs1@gmail.com','0','350','300','',650,'650',0,'2023-10-11','2023-12-31','0000-00-00','0000-00-00','','certificate/1697026657.jpg','certificate/1697026657.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(101,'Barcode1950','offlineBarcode1950',1,15,10,'123','123','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2023-10-17','2023-12-31','0000-00-00','0000-00-00','','certificate/1698752053.jpg','certificate/1698752053.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(102,'Barcode1795','offlineBarcode1795',1,34,5,'55887454','55887454','','','','prabi@ftsoman.com','0','500','400','400',1300,'1300',0,'2023-11-27','2023-12-31','0000-00-00','0000-00-00','','certificate/1701088030.jpg','certificate/1701088030.pdf','','',NULL,NULL,'',0,1,0,0,1,NULL),
(103,'Barcode709','offlineBarcode709',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','','0','',0,'0',0,'2024-01-03','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(104,'Barcode2256','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002327987545H0615654I72\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"187a0dd501\",\"successIndicator\":\"bd943e266d324eef\"}',0,15,3,'','','','','','prabikrishna+gs1@gmail.com','0','','300','',300,'300',0,'2024-01-03','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(105,'Barcode599','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002476224951M83186213M9\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"6dc34ad201\",\"successIndicator\":\"a7aca8204473470f\"}',0,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-01-05','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(106,'Barcode8456','offlineBarcode8456',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-01-05','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(107,'Barcode7313','offlineBarcode7313',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-01-05','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(108,'Barcode7663','offlineBarcode7663',1,15,5,'12554478774','12554478774','','','','prabikrishna+gs1@gmail.com','0','500','400','400',1300,'1300',0,'2024-01-28','2024-12-31','0000-00-00','0000-00-00','','certificate/1706446984.jpg','certificate/1706446984.pdf','','',NULL,NULL,'',0,1,0,0,0,NULL),
(109,'Barcode8904','offlineBarcode8904',1,15,10,'123456','123456','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-01-29','2024-12-31','0000-00-00','0000-00-00','','certificate/1706522326.jpg','certificate/1706522326.pdf','','',NULL,NULL,'',0,1,0,0,0,NULL),
(110,'Barcode5559','offlineBarcode5559',1,15,3,'123','123','30.90096555','75.8572888','','prabikrishna+gs1@gmail.com','0','350','300','',650,'650',0,'2024-01-29','2024-12-31','0000-00-00','0000-00-00','','certificate/1707389614.jpg','certificate/1707389614.pdf','certificate/glncertificate/gln_1707389614.jpg','certificate/glncertificate/gln_1707389614.pdf',NULL,NULL,'',0,1,0,0,0,NULL),
(111,'Barcode9783','offlineBarcode9783',1,15,10,'123','123','30.90096555','75.8572888','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-01-30','2024-12-31','0000-00-00','0000-00-00','','certificate/1707294465.jpg','certificate/1707294465.pdf','certificate/glncertificate/gln_1707294466.jpg','certificate/glncertificate/gln_1707294465.pdf',NULL,NULL,'',0,1,0,0,0,NULL),
(112,'Barcode7138','offlineBarcode7138',1,15,3,'456','456','30.90096555','75.8572888','','prabikrishna+gs1@gmail.com','0','','300','',300,'300',0,'2024-01-30','2024-12-31','0000-00-00','0000-00-00','','certificate/1707389420.jpg','certificate/1707389420.pdf','certificate/glncertificate/gln_1707389421.jpg','certificate/glncertificate/gln_1707389420.pdf',NULL,NULL,'',0,1,0,0,0,NULL),
(113,'Barcode4549','offlineBarcode4549',1,52,10,'','','','','','prabi@omancompany.com','0','250','0','',250,'250',0,'2024-01-30','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(114,'Barcode3029','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002409102330I87330517G9\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"88672b5c01\",\"successIndicator\":\"f9c89ae78f924d1a\"}',0,52,10,'123456','123456','','','','prabi@omancompany.com','0','250','','',250,'250',0,'2024-01-30','0000-00-00','0000-00-00','0000-00-00','','certificate/1706602521.jpg','certificate/1706602521.pdf','certificate/glncertificate/gln_1706602522.jpg','certificate/glncertificate/gln_1706602521.pdf',NULL,NULL,'',0,0,0,0,1,NULL),
(115,'Barcode632','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002531655882H70112305F8\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"ead6691301\",\"successIndicator\":\"1ba9f1f0c4b342b0\"}',0,52,10,'123456','1234','30.90096555','75.8572888','','prabi@omancompany.com','0','250','','',250,'250',0,'2024-01-30','2024-12-31','0000-00-00','0000-00-00','','certificate/1715053228.jpg','certificate/1715053228.pdf','certificate/glncertificate/gln_1715053229.jpg','certificate/glncertificate/gln_1715053228.pdf',NULL,NULL,'',0,1,0,0,0,NULL),
(116,'Barcode2971','offlineBarcode2971',1,15,3,'123456','123456','30.90096555','75.8572888','','prabikrishna+gs1@gmail.com','0','350','300','',650,'650',0,'2024-01-30','2024-12-31','0000-00-00','0000-00-00','','certificate/1707390355.jpg','certificate/1707390355.pdf','certificate/glncertificate/gln_1707390355.jpg','certificate/glncertificate/gln_1707390355.pdf',NULL,NULL,'',0,1,0,0,0,NULL),
(117,'Barcode3142','offlineBarcode3142',1,52,5,'GTIC201455771','201455771','65.25445','12.25445','','prabi@omancompany.com','0','500','400','400',1300,'1300',0,'2024-01-30','2024-12-31','0000-00-00','0000-00-00','','certificate/1706770062.jpg','certificate/1706770062.pdf','certificate/glncertificate/gln_1706770062.jpg','certificate/glncertificate/gln_1706770062.pdf',NULL,NULL,'',0,0,0,0,0,NULL),
(118,'Barcode3738','offlineBarcode3738',1,15,5,'HYS45871415','HYS45871415','25.23254778','12.5787465','','prabikrishna+gs1@gmail.com','0','500','400','400',1300,'1300',0,'2024-02-01','2024-12-31','0000-00-00','0000-00-00','','certificate/1707714195.jpg','certificate/1707714195.pdf','certificate/glncertificate/gln_1707714195.jpg','certificate/glncertificate/gln_1707714195.pdf',NULL,NULL,'',0,1,0,0,0,NULL),
(119,'Barcode4295','offlineBarcode4295',1,15,6,'','','','','','prabikrishna+gs1@gmail.com','0','700','500','500',1700,'1700',0,'2024-02-01','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(120,'Barcode9090','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002086827635N0988692N52\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"f35b1acc01\",\"successIndicator\":\"dfea0f843de4495f\"}',0,15,6,'','','','','','prabikrishna+gs1@gmail.com','0','','','',0,'0',0,'2024-02-01','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,1,NULL),
(121,'Barcode4564','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002003543128N9609984G62\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"60b0a66101\",\"successIndicator\":\"62c2fcf060634afa\"}',0,15,5,'kli45574','jjkj87445','13','45.2258','','prabikrishna+gs1@gmail.com','0','500','400','400',1300,'1300',0,'2024-02-01','0000-00-00','0000-00-00','0000-00-00','','certificate/1715068972.jpg','certificate/1715068972.pdf','certificate/glncertificate/gln_1715068973.jpg','certificate/glncertificate/gln_1715068972.pdf',NULL,NULL,'',0,1,0,0,1,NULL),
(122,'Barcode4326','offlineBarcode4326',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-02-12','2024-12-31','0000-00-00','0000-00-00','','','','','','123456','images/pay-receipts/dummypay16new.jpg','',0,1,0,0,0,NULL),
(123,'Barcode5382','offlineBarcode5382',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-02-12','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(124,'Barcode2769','offlineBarcode2769',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-02-12','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/dummyimage.jpg','',0,1,0,0,0,NULL),
(125,'Barcode186','offlineBarcode186',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-02-13','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/Upload/dummypay1.jpg','',0,1,0,0,0,NULL),
(126,'Barcode3364','offlineBarcode3364',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','','','',0,'0',0,'2024-02-13','2024-12-31','0000-00-00','0000-00-00','','','','','','123','images/pay-receipts/testingnew.pdf','',0,1,0,0,0,NULL),
(127,'Barcode7365','offlineBarcode7365',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-02-13','2024-12-31','0000-00-00','0000-00-00','','','','','','123456789','images/pay-receipts/dummyypay.pdf','',0,1,0,0,0,NULL),
(128,'Barcode8177','offlineBarcode8177',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-02-17','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/dummyypay17new.pdf','',0,1,0,0,0,NULL),
(129,'Barcode4904','offlineBarcode4904',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-03-15','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,1,0,0,0,NULL),
(130,'Barcode8353','offlineBarcode8353',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-03-15','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/dummy15.pdf','',0,1,0,0,0,NULL),
(131,'Barcode4251','offlineBarcode4251',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-03-15','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,1,0,0,0,NULL),
(132,'Barcode5672','offlineBarcode5672',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-03-15','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/dummy15.pdf','',0,1,0,0,0,'0000-00-00 00:00:00'),
(133,'Barcode2575','offlineBarcode2575',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-03-15','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/dummy15.pdf','',0,1,0,0,0,'0000-00-00 00:00:00'),
(134,'Barcode8484','offlineBarcode8484',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-03-15','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,1,0,0,0,'0000-00-00 00:00:00'),
(135,'Barcode4187','offlineBarcode4187',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-03-15','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,1,0,0,0,'0000-00-00 00:00:00'),
(136,'Barcode425','offlineBarcode425',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-03-15','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,1,0,0,0,'2024-03-16 00:00:00'),
(137,'Barcode2838','offlineBarcode2838',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','','','',0,'0',0,'2024-05-07','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,1,0,0,0,'2024-05-15 23:00:00'),
(138,'Barcode1392','offlineBarcode1392',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-05-07','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,1,0,0,0,'2024-04-30 23:00:00'),
(139,'Barcode2242','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002304117626J0282738H01\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"9b9c93fa01\",\"successIndicator\":\"89ce9cccb65d443b\"}',0,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','','','',0,'0',0,'2024-05-07','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,0,0,0,0,'0000-00-00 00:00:00'),
(140,'Barcode5774','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002133901135G7509118I82\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"c978d8fc01\",\"successIndicator\":\"aa869311a90a49a6\"}',0,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-05-07','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,1,0,0,0,'0000-00-00 00:00:00'),
(141,'Barcode1072',NULL,NULL,72,10,'','','','','','testing8524@gnail.com','200','250','','',250,'450',0,'2024-05-08','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(142,'Barcode1073',NULL,NULL,73,10,'','','','','','sumit.abstain@gmail.com','200','250','','',250,'450',0,'2024-05-09','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(143,'Barcode7502','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002725938236G89393828M3\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"01ff3aea01\",\"successIndicator\":\"bdcc03c54ef84476\"}',0,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','','','',0,'0',0,'2024-05-09','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,0,0,0,0,'0000-00-00 00:00:00'),
(144,'Barcode5292','offlineBarcode5292',1,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','250','','',250,'250',0,'2024-05-09','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,1,0,0,0,'2024-05-07 23:00:00'),
(145,'Barcode1220','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002916616402G57789995E4\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"b10ea48401\",\"successIndicator\":\"8a9ce11f6d3f4bfe\"}',0,15,10,'','','','','','prabikrishna+gs1@gmail.com','0','','0','',0,'0',0,'2024-05-09','0000-00-00','0000-00-00','0000-00-00','','','','','',NULL,'images/pay-receipts/','',0,0,0,0,0,'0000-00-00 00:00:00'),
(146,'Barcode1074',NULL,NULL,74,10,'','','','','','testingtesting@gmail.com','200','250','','',250,'450',0,'2024-05-09','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(147,'Barcode1075','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002676491421M13698994E1\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"afcb421301\",\"successIndicator\":\"dc6e20581e504be1\"}',NULL,75,10,'','','','','','tetsingtest@gnail.com','200','250','','',250,'450',0,'2024-05-09','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(148,'Barcode1076',NULL,NULL,76,10,'','','','','','testing105@gnail.com','200','250','','',250,'450',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(149,'Barcode1077','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002385160324K34568680E6\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"7da5093901\",\"successIndicator\":\"e2541cd19b8f4a4b\"}',NULL,77,10,'','','','','','anubhav2.abstain@gmail.com','200','250','','',250,'450',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(150,'Barcode1078','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002863943190F94220558H5\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"53b0248001\",\"successIndicator\":\"d970170b99564a10\"}',NULL,78,10,'','','','','','chandni.abstain@gmail.com','200','250','','',250,'450',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(151,'Barcode1082','offlineBarcode1082',1,82,10,'','','','','','sumit3.abstain@gmail.com','200','250','','',250,'450',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(152,'Barcode1083','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002810048186E52222563H7\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"6b23c89601\",\"successIndicator\":\"a9fd2d864ff54287\"}',0,83,10,'','','','','','testingpay@gnail.com','200','250','','',250,'450',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(153,'Barcode1084','offlineBarcode1084',1,84,10,'','','','','','testing12120@gnail.com','200','250','','',250,'450',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(154,'Barcode1085','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002344689153K11563437G3\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"cb88c65701\",\"successIndicator\":\"c8b0751631704b3c\"}',0,85,10,'','','','','','testingonpay@gmail.com','200','250','','',250,'450',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(155,'Barcode1086','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002936400568F83939219F0\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"b9569f5301\",\"successIndicator\":\"0e1420e182934456\"}',0,86,10,'','','','','','testingen@gmail.com','200','250','','',250,'450',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(156,'Barcode1087','offlineBarcode1087',1,87,10,'','','','','','testcpay@gnail.com','200','250','','',250,'450',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(157,'Barcode1088','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002939966828H88160283I9\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"c80f813801\",\"successIndicator\":\"a7d7f54bc0ae4ca5\"}',0,88,10,'','','','','','testing510@gmail.com','200','250','','',250,'450',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(158,'Barcode1089',NULL,NULL,89,3,'','','','','','testarabic@gmail.com','200','','300','',300,'500',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(159,'Barcode1090',NULL,NULL,90,10,'','','','','','testingarabicnew@gmail.com','200','','0','',0,'200',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(160,'Barcode1091','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002939947922L59563903H6\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"755cf15301\",\"successIndicator\":\"63a1882049ed4e8d\"}',NULL,91,10,'','','','','','arabictest@gnail.com','200','','0','',0,'200',0,'2024-05-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(161,'Barcode1092','offlineBarcode1092',1,92,6,'','','','','','prabikrishna+may14@gmail.com','400','700','500','500',1700,'2100',0,'2024-05-14','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(162,'Barcode1093','offlineBarcode1093',1,93,10,'','','','','','testing15524@gmail.com','200','250','','',250,'450',0,'2024-05-15','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(163,'Barcode1094','offlineBarcode1094',1,94,10,'','','','','','testing1524@gmail.com','200','250','','',250,'450',0,'2024-05-15','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(164,'Barcode1095','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002024218765I94759892N9\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"69681e3d01\",\"successIndicator\":\"335db9f008ec498c\"}',0,95,3,'','','','','','TST16@gmail.com','200','350','','',350,'550',0,'2024-05-16','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(165,'Barcode1096',NULL,0,96,0,'','','','','','testing16chck@gmail.com','','','','',0,'0',0,'2024-05-16','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(166,'Barcode1097','offlineBarcode1097',1,97,10,'','','','','','Testng16@gmal.com','200','250','','',250,'450',0,'2024-05-16','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(167,'Barcode1098','offlineBarcode1098',1,98,10,'','','','','','Testng1688@gmail.com','200','250','','',250,'450',0,'2024-05-16','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(168,'Barcode1099','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002442215715G34665378M3\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"3225040301\",\"successIndicator\":\"5ccfaa01cf994c04\"}',0,99,10,'','','','','','Test1752024@gmail.com','200','250','','',250,'450',0,'2024-05-17','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(169,'Barcode1100','offlineBarcode1100',1,100,10,'','','','','','testing1724@gmail.com','200','250','','',250,'450',0,'2024-05-17','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(170,'Barcode1101','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002756439221L34972359K4\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"c447386201\",\"successIndicator\":\"2ff08c9ec4c84ecb\"}',NULL,101,3,'','','','','','anubhav.abstain@gmail.com','200','350','','',350,'550',0,'2024-05-17','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(171,'Barcode1102','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002227959453J53131027M7\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"9d89482101\",\"successIndicator\":\"67d41cb64c3a4bb8\"}',NULL,102,10,'','','','','','test8899999@gmail.com','200','250','','',250,'450',0,'2024-05-18','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(172,'Barcode1103','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002313992308N33598399K8\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"0de1a99d01\",\"successIndicator\":\"09741823cbaa42f6\"}',NULL,103,10,'','','','','','test85214@gmail.com','200','250','','',250,'450',0,'2024-05-18','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(173,'Barcode1104','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002190579444G26922308K7\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"fba1a4ca01\",\"successIndicator\":\"8f3ca94790634784\"}',NULL,104,10,'','','','','','Test1246666@gmail.com','200','250','','',250,'450',0,'2024-05-18','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(174,'Barcode1105','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002240740273F79089638F3\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"86a8843e01\",\"successIndicator\":\"4df6438c072f4372\"}',NULL,105,10,'','','','','','12366999@gmail.com','200','250','','',250,'450',0,'2024-05-18','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(175,'Barcode1106','offlineBarcode1106',1,106,10,'','','','','','test989898@gmail.com','200','250','','',250,'450',0,'2024-05-18','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(176,'Barcode1107','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002225014912I87756565L8\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"cbfaa8d501\",\"successIndicator\":\"a16d40e073934d64\"}',0,107,6,'','','','','','sheikha224@hotmail.com','400','700','','',700,'1100',0,'2024-05-20','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(177,'Barcode1108','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002028551406H05333438I5\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"2baeaabd01\",\"successIndicator\":\"ed49862ed7824e81\"}',0,108,6,'','','','','','amal.zeidi@gs1oman.org','400','700','','',700,'1100',0,'2024-05-20','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(178,'Barcode1109','offlineBarcode1109',1,109,6,'','','','','','sheikha298@hotmail.com','400','700','','',700,'1100',0,'2024-05-20','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(179,'Barcode1110','offlineBarcode1110',1,110,5,'','','','','','a.ah.alzidi@gmail.com','400','500','','',500,'900',0,'2024-05-20','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(180,'Barcode1111','offlineBarcode1111',1,111,3,'','','','','','southerngeneral@gmail.com','200','350','300','',650,'850',0,'2024-05-20','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(181,'Barcode1112','offlineBarcode1112',1,112,10,'','','','','','test24522@gnail.com','200','250','','',250,'450',0,'2024-05-22','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(182,'Barcode1113','offlineBarcode1113',1,113,10,'','','','','','testing124578@gnail.com','200','250','','',250,'450',0,'2024-05-22','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(183,'Barcode1114','offlineBarcode1114',1,114,10,'','','','','','testing277@gnail.com','200','250','','',250,'450',0,'2024-05-27','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(184,'Barcode1115',NULL,1,115,10,'','','','','','Testing2752024@gmail.com','200','250','','',250,'450',0,'2024-05-27','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(185,'Barcode1116','offlineBarcode1116',1,116,10,'','','','','','testingpaymnt27@gmail.com','200','250','','',250,'450',0,'2024-05-27','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(186,'Barcode1117','offlineBarcode1117',1,117,10,'','','','','','testingar2777@gnail.com','200','','0','',0,'200',0,'2024-05-27','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(187,'Barcode1118','offlineBarcode1118',1,118,10,'','','','','','TEST295244@gmail.com','200','250','','',250,'450',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST',0,1,0,0,0,NULL),
(188,'Barcode1119','offlineBarcode1119',1,119,6,'','','','','','TESTing62@gnail.com','400','700','500','',1200,'1600',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(189,'Barcode1120','offlineBarcode1120',1,120,5,'','','','','','testingpromo@gmail.com','400','500','400','',900,'1300',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(190,'Barcode1121',NULL,1,121,5,'','','','','','testing555558@gmail.com','400','500','400','',900,'1300',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(191,'Barcode1122',NULL,1,122,5,'','','','','','testingcheckpromo29@gnail.com','400','500','400','',900,'1300',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(192,'Barcode1123','offlineBarcode1123',1,123,10,'','','','','','testing85441@gmail.com','200','250','','',250,'450',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(193,'Barcode1124','offlineBarcode1124',1,124,10,'','','','','','Testing124578@gmail.com','200','250','','',250,'450',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(194,'Barcode1125','offlineBarcode1125',1,125,10,'','','','','','test5656@gnail.com','200','250','','',250,'450',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST',0,1,0,0,0,NULL),
(195,'Barcode1126','offlineBarcode1126',1,126,3,'','','','','','testing988888888@gmail.com','200','350','300','',650,'850',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(196,'Barcode1127','offlineBarcode1127',1,127,10,'','','','','','testingpromo22@gmail.com','200','250','','',250,'450',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(197,'Barcode1128','offlineBarcode1128',1,128,3,'','','','','','testtest7896@gnail.com','','','','',0,'0',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(198,'Barcode1129','offlineBarcode1129',1,129,3,'','','','','','Sachin54444@gmail.com','200','350','300','',650,'850',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(199,'Barcode1130','offlineBarcode1130',1,130,3,'','','','','','testing78555@gmail.com','200','350','300','',650,'850',0,'2024-05-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST',0,1,0,0,0,NULL),
(200,'Barcode1131','offlineBarcode1131',1,131,3,'','','','','','test30524@gnail.com','200','350','300','',650,'850',0,'2024-05-30','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST',0,1,0,0,0,NULL),
(201,'Barcode1132','offlineBarcode1132',1,132,10,'','','','','','testing858@gnail.com','200','250','','',250,'450',0,'2024-05-30','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(202,'Barcode1133','offlineBarcode1133',1,133,6,'','','','','','prabikrishna+june12@gmail.com','400','700','500','',1200,'1600',0,'2024-06-12','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(203,'Barcode1134','offlineBarcode1134',1,134,3,'','','','','','test146244@gnail.com','200','350','300','',650,'618.45',0,'2024-06-14','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST14',0,0,0,0,0,NULL),
(204,'Barcode1135','offlineBarcode1135',1,135,3,'','','','','','test@gmai.com','200','350','300','',650,'807.975',0,'2024-06-21','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'20dsc',0,0,0,0,0,NULL),
(205,'Barcode1136','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002444922677I7939770K63\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"7f40b07301\",\"successIndicator\":\"7f4bfaf6368e4cf2\"}',0,136,5,'','','','','','prabi@26thjune.com','400','500','400','400',1300,'1695.75',0,'2024-06-26','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(208,'Barcode1139','offlineBarcode1139',1,139,5,'607123456','607123456324','23 22 37.6 N','57 49 41.8 East','','karim@obcoman.org','400','500','400','400',1300,'1236.9',0,'2024-07-01','2024-12-31','0000-00-00','0000-00-00','','certificate/1719839205.jpg','certificate/1719839205.pdf','certificate/glncertificate/gln_1719839205.jpg','certificate/glncertificate/gln_1719839205.pdf',NULL,NULL,'TEST14',0,1,0,0,0,NULL),
(209,'Barcode1140',NULL,0,140,0,'','','','','','','','','','',0,'0',0,'2024-07-03','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(210,'Barcode1141','offlineBarcode1141',1,141,10,'','','','','','testing372024@gnai.com','200','250','','',250,'448.875',0,'2024-07-03','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(211,'Barcode1142','offlineBarcode1142',1,142,10,'','','','','','testing1885544@gmail.com','200','250','','',250,'448.875',0,'2024-07-03','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(212,'Barcode1143',NULL,1,143,10,'','','','','','test472244@gnail.com','200','250','','',250,'448.875',0,'2024-07-04','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(213,'Barcode1144',NULL,1,144,10,'','','','','','test84512366@gnail.com','200','250','','',250,'448.875',0,'2024-07-04','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(214,'Barcode1145','offlineBarcode1145',1,145,10,'','','','','','testing1885522222@gnail.com','200','250','','',250,'448.875',0,'2024-07-04','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(215,'Barcode1146','offlineBarcode1146',1,146,10,'','','','','','TEST472024@gnail.com','200','250','','',250,'448.875',0,'2024-07-04','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(216,'Barcode1147','offlineBarcode1147',1,147,3,'','','','','','testing572024@gnail.com','200','350','','',350,'548.625',0,'2024-07-05','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(217,'Barcode1148','offlineBarcode1148',1,148,10,'','','','','','sumit.abstain@gmail.com','200','250','','',250,'448.875',0,'2024-07-05','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(218,'Barcode1149','offlineBarcode1149',1,149,10,'','','','','','TEST672024@gnail.com','200','250','','',250,'448.875',0,'2024-07-06','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(219,'Barcode1150','offlineBarcode1150',1,150,10,'','','','','','TEST872024@gnail.com','200','250','','',250,'448.875',0,'2024-07-08','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(220,'Barcode1151','offlineBarcode1151',1,151,5,'','','','','','digigraphy@hotmail.com','400','500','400','400',1300,'1236.9',0,'2024-07-23','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST14',0,1,0,0,0,NULL),
(221,'Barcode1152','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002797177817L6685118E33\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"5fe5b79901\",\"successIndicator\":\"bfafc156270a4643\"}',0,152,10,'','','','','','amal.zeidi3@gs1oman.org','200','250','0','',250,'448.875',0,'2024-07-31','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(222,'Barcode1153','offlineBarcode1153',1,153,10,'','','','','','amal.zeidi8899@gs1oman.org','200','250','0','',250,'448.875',0,'2024-07-31','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(223,'Barcode1154','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002793893602M5225738J33\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"8dc044fd01\",\"successIndicator\":\"4a218d190f80481d\"}',0,154,15,'','','','','','shamnas@amalalkhairoman.com','','','','',0,'0',0,'2024-08-12','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(224,'Barcode1155','offlineBarcode1155',1,155,3,'','','','','','testing12824@gnail.com','200','350','300','',650,'892.5',0,'2024-08-12','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(225,'Barcode1156','offlineBarcode1156',1,156,3,'','','','','','test145263@gnail.com','200','350','300','',650,'651',0,'2024-08-12','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST14',0,1,0,0,0,NULL),
(226,'Barcode1157','offlineBarcode1157',1,157,5,'','','','','','testing14522@gnail.com','400','500','400','',900,'661.5',0,'2024-08-12','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST',0,1,0,0,0,NULL),
(227,'Barcode1158','offlineBarcode1158',1,158,6,'','','','','','Testuser12824@gmail.com','400','700','500','500',1700,'913.5',0,'2024-08-12','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST',0,1,0,0,0,NULL),
(228,'Barcode1159','offlineBarcode1159',1,159,5,'','','','','','mctdigigraphy@gmail.com','400','500','400','',900,'661.5',0,'2024-08-14','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST',0,1,0,0,0,NULL),
(229,'Barcode1160','offlineBarcode1160',1,160,5,'','','','','','testing2282024@gmail.com','400','500','400','400',1300,'787.5',0,'2024-08-22','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST',0,1,0,0,0,NULL),
(230,'Barcode1161','offlineBarcode1161',1,161,3,'','','','','','testing23824@gnail.com','200','350','300','',650,'393.75',0,'2024-08-23','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST',0,1,0,0,0,NULL),
(231,'Barcode1162','offlineBarcode1162',1,162,6,'','','','','','sheikha@hotmail.com','400','700','','',700,'',0,'2024-08-25','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'tst',0,1,0,0,0,NULL),
(232,'Barcode1163','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002698808474F6142307L12\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"08674ef301\",\"successIndicator\":\"4e8633dc5c5a45b4\"}',0,163,6,'','','','','','sheikha.nofali@gs1oman.org','400','700','','',700,'1155',0,'2024-08-25','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(233,'Barcode1164','offlineBarcode1164',1,164,10,'','','','','','amal.zeidi8890@gs1oman.org','200','250','0','',250,'267.75',0,'2024-08-25','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'TEST',0,1,0,0,0,NULL),
(234,'Barcode1165','offlineBarcode1165',1,165,5,'','','','','','Twentyfive@gmail.com','400','500','400','',900,'1365',0,'2024-08-25','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(235,'Barcode1166','offlineBarcode1166',1,166,10,'','','','','','testing2682024@gnail.com','200','250','','',250,'472.5',0,'2024-08-26','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(236,'Barcode1167','offlineBarcode1167',1,167,3,'','','','','','Tod@gmail.com','200','350','','',350,'577.5',0,'2024-09-11','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(237,'Barcode1168','offlineBarcode1168',1,168,5,'','','','','','rayyanjaffar@hotmail.com','400','500','400','400',1300,'892.5',0,'2024-09-11','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'Bader100',0,1,0,0,0,NULL),
(238,'Barcode1169','offlineBarcode1169',1,169,5,'','','','','','amal.zeidi@gs1oman.org','400','500','','',500,'472.5',0,'2024-09-11','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'Bader100',0,1,0,0,0,NULL),
(239,'Barcode1170','offlineBarcode1170',1,170,3,'','','','','','She@hotmail.com','200','350','','',350,'577.5',0,'2024-09-11','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(240,'Barcode1171','offlineBarcode1171',1,171,15,'','','','','','sheikha.nofalilhd@gs1oman.org','200','250','','',250,'472.5',0,'2024-09-11','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(241,'Barcode1172','offlineBarcode1172',1,172,6,'','','','','','a@gmail.com','','','','',0,'0',0,'2024-09-12','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'Bader100',0,1,0,0,0,NULL),
(242,'Barcode1173','offlineBarcode1173',1,173,5,'','','','','','16thsept_android@gmail.com','400','500','','',500,'945',0,'2024-09-16','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(243,'Barcode1174','offlineBarcode1174',1,174,5,'','','','','','Prabi@16thandroid.com','400','500','','400',900,'1365',0,'2024-09-16','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(244,'Barcode1175','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002043319733N9485712N01\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"aa45752c01\",\"successIndicator\":\"214f8c9749354317\"}',0,175,6,'6071234','607123456324','123','1234','','barcode@gmail.com','400','700','500','500',1700,'1102.5',0,'2024-09-18','2024-12-31','0000-00-00','0000-00-00','','certificate/1726637069.jpg','certificate/1726637069.pdf','certificate/glncertificate/gln_1726637069.jpg','certificate/glncertificate/gln_1726637069.pdf',NULL,NULL,'Bader100',0,1,0,0,0,NULL),
(245,'Barcode1176','offlineBarcode1176',1,176,5,'','','','','','18thiphone@gmail.com','400','500','400','400',1300,'1785',0,'2024-09-18','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(246,'Barcode1177',NULL,1,177,5,'','','','','','4455obc@f.vom','400','500','400','',900,'682.5',0,'2024-09-18','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'Bader100',0,0,0,0,0,NULL),
(247,'Barcode1178','offlineBarcode1178',1,178,3,'','','','','','alhashmi.zainab91@gmail.cyy','200','350','300','',650,'892.5',0,'2024-09-18','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(248,'Barcode1179','offlineBarcode1179',1,179,6,'','','','','','samsungchrome@gmail.com','400','700','500','',1200,'1680',0,'2024-09-18','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(249,'Barcode1180','offlineBarcode1180',1,180,5,'','','','','','asus@gmail.com','400','500','400','400',1300,'1785',0,'2024-09-18','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(250,'Barcode1188','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002866237940E9571348M13\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"a45b34c301\",\"successIndicator\":\"618888ac08cb45b7\"}',0,188,3,'','','','','','sumit.abstain1@gmail.com','200','','','',0,'210',0,'2024-10-02','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(251,'Barcode1001','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002506184969G6232593E42\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"b8e87d3701\",\"successIndicator\":\"4943e69784884d89\"}',0,1,3,'','','','','','sumit.abstain@gmail.com','200','','','',0,'210',0,'2024-10-03','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(252,'Barcode1001',NULL,0,1,3,'','','','','','sumit.absttain@gmail.com','200','350','300','',650,'892.5',0,'2024-10-03','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(253,'Barcode1002','{\"checkoutMode\":\"WEBSITE\",\"merchant\":\"TEST407399002\",\"result\":\"SUCCESS\",\"session_id\":\"SESSION0002148707756E12873214M4\",\"session_updateStatus\":\"SUCCESS\",\"session_version\":\"26209b0a01\",\"successIndicator\":\"65a3ade352284e21\"}',0,2,3,'','','','','','sumit.abstain@gmail.com','200','','','',0,'210',0,'2024-10-03','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(254,'Barcode1001',NULL,0,1,5,'','','','','','shikha3034@gmail.com','400','500','','',500,'945',0,'2024-10-03','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(255,'Barcode1002',NULL,1,2,5,'','','','','','7thoctober@gmail.com','400','500','400',' 400',1300,'1785',0,'2024-10-07','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(256,'Barcode1003','offlineBarcode1003',1,3,5,'','','','','','7thoctobertest2@gmail.com','400','','400',' 400',800,'1260',0,'2024-10-07','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(257,'Barcode1004','offlineBarcode1004',1,4,10,'','','','','','7thoctmobiletest@gmail.com','200','250','0','',250,'472.5',0,'2024-10-07','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(258,'Barcode1005','offlineBarcode1005',1,5,5,'','','','','','Redsea@gmail.com','400','500','','',500,'945',0,'2024-10-10','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(259,'Barcode1006','offlineBarcode1006',1,6,5,'','','','','','barco@mail.com','400','500','','',500,'472.5',0,'2024-10-21','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'Bader100',0,1,0,0,0,NULL),
(260,'Barcode1007','offlineBarcode1007',1,7,6,'','','','','','mohamed.akarim@gs1oman.org','400','700','500',' 500',1700,'1102.5',0,'2024-10-21','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'Bader100',0,1,0,0,0,NULL),
(261,'Barcode1008',NULL,1,8,3,'','','','','','october23@gmail.com','200','350','300','',650,'892.5',0,'2024-10-23','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(262,'Barcode1009','offlineBarcode1009',1,9,5,'','','','','','test1@test1.com','400','','','',0,'420',0,'2024-10-24','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(263,'Barcode1010','offlineBarcode1010',1,10,5,'','','','','','testing2@testing1.com','400','','',' 400',400,'840',0,'2024-10-24','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(264,'Barcode1011','offlineBarcode1011',1,11,3,'','','','','','chandni.abstain','','','','',0,'0',0,'2024-10-24','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(265,'Barcode1012','offlineBarcode1012',1,12,3,'','','','','','Test@test555gmail.com','200','','','',0,'210',0,'2024-10-24','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(266,'Barcode1013','offlineBarcode1013',1,13,6,'','','','','','28th october','400','700','500',' 500',1700,'2205',0,'2024-10-28','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(267,'Barcode1014','offlineBarcode1014',1,14,5,'','','','','','OctoberTest2@gmail.com','400','500','400',' 400',1300,'1785',0,'2024-10-28','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(268,'Barcode1015','offlineBarcode1015',1,15,3,'','','','','','sumit.abstain@gmail.com','200','350','300','',650,'892.5',0,'2024-10-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(269,'Barcode1016','offlineBarcode1016',1,16,3,'','','','','','anubhav.abstain@gmail.com','200','350','300','',650,'892.5',0,'2024-10-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(270,'Barcode1017','offlineBarcode1017',1,17,3,'','','','','','anubhav,abstain@gmail.com','200','350','300','',650,'892.5',0,'2024-10-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(271,'Barcode1018','offlineBarcode1018',1,18,5,'','','','','','testing.sumit@test.com','200','','','',0,'210',0,'2024-10-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,1,0,0,0,NULL),
(272,'Barcode1019',NULL,1,19,3,'','','','','','testting@ymail.com','200','','','',0,'210',0,'2024-10-29','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'',0,0,0,0,0,NULL),
(273,'Barcode1020','offlineBarcode1020',1,20,5,'','','','','','amal.zeidi@gs1oman.org','400','500','','',500,'472.5',0,'2024-10-31','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'Bader100',0,1,0,0,0,NULL),
(274,'Barcode1021','offlineBarcode1021',1,21,3,'','','','','','a.ah@gmail.com','200','350','300','',650,'446.25',0,'2024-10-31','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'Bader100',0,1,0,0,0,NULL),
(275,'Barcode1022','offlineBarcode1022',1,22,3,'','','','','','123@hotmail.om','200','350','300','',650,'446.25',0,'2024-10-31','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'Bader100',0,1,0,0,0,NULL),
(276,'Barcode1023',NULL,1,23,6,'','','','','','shei5kha@hotmail.com','','','','',0,'0',0,'2024-10-31','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'Bader100',0,0,0,0,0,NULL),
(277,'Barcode1024','offlineBarcode1024',1,24,5,'','','','','','She@hotmail.com','400','500','','',500,'472.5',0,'2024-10-31','2024-12-31','0000-00-00','0000-00-00','','','','','',NULL,NULL,'Bader100',0,1,0,0,0,NULL);
/*!40000 ALTER TABLE `order_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_tbl`
--

DROP TABLE IF EXISTS `package_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gtins` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `registration_fee` int(11) NOT NULL,
  `annual_fee` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_tbl`
--

LOCK TABLES `package_tbl` WRITE;
/*!40000 ALTER TABLE `package_tbl` DISABLE KEYS */;
INSERT INTO `package_tbl` (`id`, `gtins`, `product_id`, `product_name`, `registration_fee`, `annual_fee`, `status`) VALUES (1,'100',1,'GTIN: Global Trade Item Numbers',400,800,1),
(2,'7899',1,'GTIN: Global Trade Item Numbers',200,200,1);
/*!40000 ALTER TABLE `package_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_tbl`
--

DROP TABLE IF EXISTS `product_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `gtins_name` text NOT NULL,
  `registration_fee` int(11) NOT NULL,
  `gtins_annual_fee` int(11) NOT NULL,
  `gln_annual_fee` int(11) NOT NULL,
  `sscc_annual_fee` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_tbl`
--

LOCK TABLES `product_tbl` WRITE;
/*!40000 ALTER TABLE `product_tbl` DISABLE KEYS */;
INSERT INTO `product_tbl` (`id`, `product_name`, `gtins_name`, `registration_fee`, `gtins_annual_fee`, `gln_annual_fee`, `sscc_annual_fee`, `status`) VALUES (3,'GTIN: Global Trade Item Numbers','1000',200,350,300,0,1),
(5,'GTIN: Global Trade Item Numbers','10000',400,500,400,400,1),
(6,'GTIN: Global Trade Item Numbers','100000',400,700,500,500,1),
(10,'GTIN: Global Trade Item Numbers','100',200,250,0,0,1),
(15,'GTIN: Global Trade Item Numbers','GCP 10',200,250,250,0,1);
/*!40000 ALTER TABLE `product_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_codes`
--

DROP TABLE IF EXISTS `promo_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `promoregistration_fee` decimal(10,2) DEFAULT NULL,
  `promoannual_fee` decimal(10,2) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_codes`
--

LOCK TABLES `promo_codes` WRITE;
/*!40000 ALTER TABLE `promo_codes` DISABLE KEYS */;
INSERT INTO `promo_codes` (`id`, `promo_code`, `promoregistration_fee`, `promoannual_fee`, `expiry_date`) VALUES (1,'TEST14',50.00,20.00,'2024-06-10'),
(2,'TEST20',20.00,20.00,'2024-06-18'),
(3,'5DSC',5.00,0.00,'2024-07-31'),
(4,'20dsc',20.00,0.00,'2024-06-28'),
(6,'Bader100',50.00,50.00,'2024-12-31'),
(7,'TEST',10.00,70.00,'2024-12-31');
/*!40000 ALTER TABLE `promo_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_settings`
--

DROP TABLE IF EXISTS `system_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `website_url` varchar(60) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `website_name` varchar(255) NOT NULL,
  `website_email_id` varchar(50) NOT NULL,
  `mobile_number` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_settings`
--

LOCK TABLES `system_settings` WRITE;
/*!40000 ALTER TABLE `system_settings` DISABLE KEYS */;
INSERT INTO `system_settings` (`id`, `website_url`, `logo`, `favicon`, `website_name`, `website_email_id`, `mobile_number`) VALUES (1,'https://gs1oman.com/','images/Upload/logo/logo-oman.png','images/Upload/logo/favicon.png','MyGS1','info@barcode.com','+974 4430 0437');
/*!40000 ALTER TABLE `system_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'gs1omancom_barcode'
--

--
-- Dumping routines for database 'gs1omancom_barcode'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-19  6:54:35
