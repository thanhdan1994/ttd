-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: localhost    Database: ttd
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookmarks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookmarks_user_id_foreign` (`user_id`),
  KEY `bookmarks_product_id_foreign` (`product_id`),
  CONSTRAINT `bookmarks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks`
--

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
INSERT INTO `bookmarks` VALUES (1,20,23,'2020-06-11 14:08:55','2020-06-11 14:08:55'),(2,18,38,'2020-07-13 13:14:07','2020-07-13 13:14:07'),(3,7,38,'2020-07-13 14:16:52','2020-07-13 14:16:52'),(5,7,37,'2020-07-13 14:17:03','2020-07-13 14:17:03'),(6,7,36,'2020-07-13 14:23:15','2020-07-13 14:23:15'),(7,7,35,'2020-07-13 14:23:21','2020-07-13 14:23:21'),(8,7,32,'2020-07-13 14:23:28','2020-07-13 14:23:28'),(9,7,28,'2020-07-13 14:23:33','2020-07-13 14:23:33'),(10,41,42,'2020-07-18 15:12:14','2020-07-18 15:12:14'),(11,41,39,'2020-07-18 15:12:26','2020-07-18 15:12:26'),(12,41,43,'2020-07-18 15:46:40','2020-07-18 15:46:40');
/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint NOT NULL DEFAULT '0',
  `featured_image` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Trái cây','trai-cay',0,65,'2020-06-09 15:14:19','2020-07-19 19:49:23'),(3,'Ăn vặt','an-vat',0,63,'2020-06-09 15:23:20','2020-07-19 19:48:53'),(4,'Hải sản','hai-san',0,64,'2020-06-09 15:23:20','2020-07-19 19:49:08');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_product_id_foreign` (`product_id`),
  CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,20,22,'táo thì dỡ như cức nghỉ đến thôi đã đếu muốn ăn rồi',0,1,'2020-06-09 17:41:35','2020-06-09 17:41:35'),(2,20,23,'ngon lắm nha mình mới mua được 2kg nè',0,1,'2020-06-09 17:42:01','2020-06-09 17:42:01'),(3,20,23,'sò ngon lắm nha mọi người',0,1,'2020-06-11 14:32:20','2020-06-11 14:32:20'),(4,19,23,'xác nhận nhé, quá ngon luôn bạn ê',3,1,'2020-07-08 10:32:20','2020-06-11 14:32:20'),(5,18,23,'quá tuyệt vời, mình đã thử',3,1,'2020-07-08 10:48:20','2020-06-11 14:32:20'),(6,17,23,'ngon lắm nha mình mới mua được 2kg nè 1111',0,1,'2020-07-07 17:42:01','2020-06-09 17:42:01'),(7,15,23,'ngon lắm nha mình mới mua được 2kg nè 3333',0,1,'2020-07-07 17:42:01','2020-06-09 17:42:01'),(8,10,23,'ngon lắm nha mình mới mua được 2kg nè 2222',0,1,'2020-07-07 17:42:01','2020-06-09 17:42:01'),(9,9,23,'ngon lắm nha mình mới mua được 2kg nè 4444',0,1,'2020-07-07 09:42:01','2020-06-09 17:42:01'),(10,9,23,'ngon lắm nha mình mới mua được 2kg nè 5555',0,1,'2020-07-08 10:42:01','2020-06-09 17:42:01'),(11,20,23,'gửi bình luận',0,1,'2020-07-09 14:44:01','2020-07-09 14:44:01'),(12,20,23,'gửi lại 1 cái bình luận nữa',0,1,'2020-07-09 15:28:13','2020-07-09 15:28:13'),(13,20,23,'tét',0,1,'2020-07-09 15:29:17','2020-07-09 15:29:17'),(14,20,23,'nhập và gửi nội dung bình luận',0,1,'2020-07-09 15:45:55','2020-07-09 15:45:55'),(15,20,23,'hihi',0,1,'2020-07-09 15:47:22','2020-07-09 15:47:22'),(16,20,23,'trả lời bình luận hihi',15,1,'2020-07-09 16:04:40','2020-07-09 16:04:40'),(17,20,25,'gửi bình luận chơi nè',0,1,'2020-07-11 07:50:33','2020-07-11 07:50:33'),(18,41,36,'gửi bình luận test pusher',0,1,'2020-07-15 11:27:36','2020-07-15 11:27:36'),(19,42,38,'gừi bình luận nè',0,1,'2020-07-15 12:08:00','2020-07-15 12:08:00'),(20,41,38,'gừi bình luận chơi nè',0,1,'2020-07-15 13:21:39','2020-07-15 13:21:39'),(21,43,40,'gừi bình luận nè',0,1,'2020-07-17 16:55:02','2020-07-17 16:55:02'),(22,41,40,'gửi bình luận nè',0,1,'2020-07-17 18:12:45','2020-07-17 18:12:45'),(23,41,38,'tao gửi bình luận cho vui thôi nhé',0,1,'2020-07-18 00:15:34','2020-07-18 00:15:34'),(24,41,33,'gửi bình luận nè nè',0,1,'2020-07-18 08:34:15','2020-07-18 08:34:15'),(25,41,42,'gửi bình luận chơi hihi',0,1,'2020-07-18 08:35:23','2020-07-18 08:35:23'),(26,41,43,'mình thích thì mình gửi thôi',0,1,'2020-07-18 08:35:36','2020-07-18 08:35:36'),(27,41,43,'create bình luận',0,1,'2020-08-20 14:24:48','2020-08-20 14:24:48'),(28,42,43,'tao gửi bình luận nà',0,1,'2020-08-20 14:30:54','2020-08-20 14:30:54');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `like`
--

DROP TABLE IF EXISTS `like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `like` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `type` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `like_unlike_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `like_unlike_user_id_foreign` (`user_id`),
  CONSTRAINT `like_unlike_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=293 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `like`
--

LOCK TABLES `like` WRITE;
/*!40000 ALTER TABLE `like` DISABLE KEYS */;
INSERT INTO `like` VALUES (1,'App\\Product',23,9,1,NULL,NULL),(2,'App\\Product',23,10,1,NULL,NULL),(169,'App\\Product',22,20,2,'2020-07-07 02:16:25','2020-07-07 02:16:25'),(170,'App\\Product',24,20,1,'2020-07-07 09:47:47','2020-07-07 09:47:47'),(171,'App\\Product',24,21,1,'2020-07-07 09:49:01','2020-07-07 09:49:01'),(173,'App\\Product',24,25,2,'2020-07-07 09:49:42','2020-07-07 09:49:42'),(175,'App\\Product',22,25,1,'2020-07-07 09:50:23','2020-07-07 09:50:23'),(177,'App\\Comment',2,20,1,'2020-07-07 14:42:28','2020-07-07 14:42:28'),(179,'App\\Comment',2,10,2,'2020-07-07 14:42:28','2020-07-07 14:42:28'),(180,'App\\Product',23,25,1,'2020-07-08 11:40:20','2020-07-08 11:40:20'),(181,'App\\Comment',10,20,1,'2020-07-08 14:05:03','2020-07-08 14:05:03'),(182,'App\\Comment',7,20,1,'2020-07-08 14:12:59','2020-07-08 14:12:59'),(183,'App\\Comment',8,20,1,'2020-07-08 14:15:51','2020-07-08 14:15:51'),(185,'App\\Comment',8,25,1,'2020-07-08 14:17:03','2020-07-08 14:17:03'),(193,'App\\Product',23,20,2,'2020-07-09 15:48:50','2020-07-09 15:48:50'),(194,'App\\Product',38,20,1,'2020-07-11 16:04:53','2020-07-11 16:04:53'),(195,'App\\Product',38,6,1,'2020-07-12 12:16:25','2020-07-12 12:16:25'),(197,'App\\Comment',18,41,1,'2020-07-15 11:27:51','2020-07-15 11:27:51'),(199,'App\\Comment',19,42,1,'2020-07-15 13:19:18','2020-07-15 13:19:18'),(200,'App\\Comment',20,42,1,'2020-07-15 13:22:05','2020-07-15 13:22:05'),(201,'App\\Product',38,42,1,'2020-07-15 13:28:31','2020-07-15 13:28:31'),(202,'App\\Product',38,41,1,'2020-07-15 13:29:04','2020-07-15 13:29:04'),(233,'App\\Product',40,41,1,'2020-07-17 16:46:03','2020-07-17 16:46:03'),(234,'App\\Product',40,43,1,'2020-07-17 16:54:24','2020-07-17 16:54:24'),(236,'App\\Comment',21,43,1,'2020-07-17 16:55:44','2020-07-17 16:55:44'),(264,'App\\Comment',21,41,1,'2020-07-17 18:10:37','2020-07-17 18:10:37'),(271,'App\\Comment',22,43,1,'2020-07-17 18:22:15','2020-07-17 18:22:15'),(273,'App\\Comment',23,41,1,'2020-07-18 00:55:05','2020-07-18 00:55:05'),(275,'App\\Comment',23,43,1,'2020-07-18 01:44:33','2020-07-18 01:44:33'),(277,'App\\Comment',22,41,1,'2020-07-18 07:47:48','2020-07-18 07:47:48'),(278,'App\\Comment',20,41,1,'2020-07-18 08:33:29','2020-07-18 08:33:29'),(279,'App\\Comment',19,41,1,'2020-07-18 08:33:40','2020-07-18 08:33:40'),(280,'App\\Comment',24,41,1,'2020-07-18 08:34:24','2020-07-18 08:34:24'),(281,'App\\Comment',25,20,1,'2020-07-18 08:36:22','2020-07-18 08:36:22'),(282,'App\\Comment',26,20,1,'2020-07-18 08:36:34','2020-07-18 08:36:34'),(286,'App\\Product',36,41,2,'2020-08-20 14:11:44','2020-08-20 14:11:44'),(287,'App\\Comment',27,42,1,'2020-08-20 14:24:59','2020-08-20 14:24:59'),(288,'App\\Comment',28,41,1,'2020-08-20 14:31:09','2020-08-20 14:31:09'),(289,'App\\Comment',25,41,1,'2020-08-21 00:59:59','2020-08-21 00:59:59'),(292,'App\\Product',43,41,1,'2020-08-21 01:09:03','2020-08-21 01:09:03');
/*!40000 ALTER TABLE `like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'App\\Product',22,'f899596e-2085-4862-9867-811df1187c7b','images','green-apple','green-apple.jpg','image/jpeg','public','public',223759,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',1,'2020-06-09 15:26:48','2020-06-09 15:26:49'),(27,'App\\Report',4,'b591cc52-a4f0-434c-bb14-a4e76bce72bb','detail-images','media-libraryRQIhvQ','LW4fKtDN8uk0QJBPhTgw.jpg','image/jpeg','public','public',54049,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',13,'2020-06-09 15:56:53','2020-06-09 15:56:53'),(28,'App\\Report',4,'91d0d760-3e2d-433f-9be8-d9be9b1a41ef','detail-images','media-library0IEIsb','lvDWDqehCpP8JB41xwU1.jpg','image/jpeg','public','public',390236,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',14,'2020-06-09 15:56:53','2020-06-09 15:56:54'),(29,'App\\Report',4,'9d67ee84-5892-4a4a-86e1-814da8a7d729','detail-images','media-librarycU0jxI','0ilc2KyfoDmG9U7U3gdO.jpg','image/jpeg','public','public',160865,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',15,'2020-06-09 15:56:54','2020-06-09 15:56:55'),(30,'App\\Report',4,'6ba7aab5-dc69-4908-9708-9f7d0b1f0a45','detail-images','media-libraryEvtHHk','nmw2EVuRJYE0W0cpdE9M.jpg','image/jpeg','public','public',7497,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',16,'2020-06-09 15:56:55','2020-06-09 15:56:55'),(31,'App\\Report',4,'ed167cfc-9166-4322-973a-38e7f7b5d54f','detail-images','media-libraryOUZ1lZ','D2AxC8TA3NkXSbQ3q7do.jpg','image/jpeg','public','public',88404,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',17,'2020-06-09 15:56:55','2020-06-09 15:56:55'),(32,'App\\Report',4,'9812e21a-f534-466a-8d51-7a2bbd474acf','detail-images','media-library4KEvxH','milLCmFohpacpIgGT5el.jpg','image/jpeg','public','public',146192,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',18,'2020-06-09 15:56:55','2020-06-09 15:56:56'),(33,'App\\Report',5,'53803159-7275-4cfb-8d8c-15c8e32b043b','detail-images','media-libraryPMDWKe','BBTxhatK1UzCRcuUMJ55.jpg','image/jpeg','public','public',639900,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',19,'2020-06-09 16:09:21','2020-06-09 16:09:23'),(34,'App\\Report',5,'e5f33ec3-cdc7-4fdb-8c98-7b4d3c1d1603','detail-images','media-library5h91Oi','cUgplUlkrwBEVwYXWeMF.jpg','image/jpeg','public','public',79958,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',20,'2020-06-09 16:09:23','2020-06-09 16:09:23'),(35,'App\\Report',5,'d95ab1d3-13d0-4b7a-86d2-c61d0cf2b860','detail-images','media-libraryA318ks','nlKoO8Auc703EEe8rzdb.jpg','image/jpeg','public','public',26690,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',21,'2020-06-09 16:09:23','2020-06-09 16:09:23'),(36,'App\\Report',5,'af693a05-96dc-4a68-b9c2-c17273a61afb','detail-images','media-library5Q6hnF','9y0FCIWyXenjeitvn7qe.jpg','image/jpeg','public','public',35413,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',22,'2020-06-09 16:09:23','2020-06-09 16:09:24'),(37,'App\\Report',5,'e4787318-408a-4082-84a6-d12c087e57f0','detail-images','media-libraryYBh3PW','nyC4Vm2UKVKlFyKwiu5K.jpg','image/jpeg','public','public',75678,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',23,'2020-06-09 16:09:24','2020-06-09 16:09:24'),(38,'App\\Report',5,'09e96315-3382-4560-bb55-49090552cb89','detail-images','media-library8MOXYj','V4berB5ltjNBTdzfgbVL.jpg','image/jpeg','public','public',223759,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',24,'2020-06-09 16:09:24','2020-06-09 16:09:25'),(39,'App\\Report',5,'8d1eb7eb-59f2-4403-bbfd-8bb85890148e','detail-images','media-library6gosaP','3iqQ5CTwRNNSIwgbrEeX.jpg','image/jpeg','public','public',54049,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',25,'2020-06-09 16:09:25','2020-06-09 16:09:25'),(40,'App\\Report',5,'06bd390b-ee26-40b4-b32d-1eb83b1ae8b4','detail-images','media-libraryEv2Tro','FMEeFRs9x0hgPrundtsl.jpg','image/jpeg','public','public',37977,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',26,'2020-06-09 16:09:25','2020-06-09 16:09:26'),(41,'App\\Report',5,'6f6871f3-a63f-4b82-af02-e511f0e1964c','detail-images','media-libraryR3a2j1','iqspFYwZu9YvH8MuF2qm.jpg','image/jpeg','public','public',390236,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',27,'2020-06-09 16:09:26','2020-06-09 16:09:27'),(42,'App\\Report',5,'8fa7e46b-3ec4-4cb8-9991-99891d884a57','detail-images','media-libraryfhufQQ','WwKhkh6bZxgEmkthsyMF.jpg','image/jpeg','public','public',160865,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',28,'2020-06-09 16:09:27','2020-06-09 16:09:27'),(43,'App\\Report',6,'022d8981-9cdf-43b3-8bb9-69a9a9b94e84','detail-images','media-libraryfYABBY','Kxk59pscdw2wyl1Lk85n.jpg','image/jpeg','public','public',42705,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',29,'2020-06-09 16:15:22','2020-06-09 16:15:23'),(44,'App\\Report',6,'3e186fa3-e715-4935-b28e-7995f1b82f3a','detail-images','media-libraryf6NaoG','e3ZRuYEFXJ6QdM0o5a8Q.jpg','image/jpeg','public','public',127720,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',30,'2020-06-09 16:15:23','2020-06-09 16:15:23'),(45,'App\\Report',6,'c94a1282-a6ed-4acf-8d3c-5c96f5b4538e','detail-images','media-libraryt0M6Ys','gtzMo4yeucN0KQsHlVFZ.jpg','image/jpeg','public','public',52499,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',31,'2020-06-09 16:15:23','2020-06-09 16:15:23'),(46,'App\\Report',6,'01894948-74d4-42c2-b1b1-09969cde02b4','detail-images','media-libraryi3GIcj','a4LqoasOztJXQExpa3Wc.jpg','image/jpeg','public','public',390236,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',32,'2020-06-09 16:15:24','2020-06-09 16:15:25'),(47,'App\\Report',6,'ac7008a9-133d-484c-838d-97b175a1cf99','detail-images','media-library40pY5k','Mwg2wkDBNtk3WnGKfNsX.jpg','image/jpeg','public','public',160865,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',33,'2020-06-09 16:15:25','2020-06-09 16:15:25'),(48,'App\\Report',6,'ada7929d-e2fb-4a7d-b26b-ce696138812b','detail-images','media-library9h2Dls','XewKYl0V9Z0GRaAdHS5a.jpg','image/jpeg','public','public',7497,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',34,'2020-06-09 16:15:25','2020-06-09 16:15:25'),(49,'App\\Report',7,'57bac84f-8410-48ea-9c9d-d60a92bcc404','detail-images','media-libraryJ6Pgwa','RoYV5sJW5NyfuFoh74RC.jpg','image/jpeg','public','public',7497,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',35,'2020-06-09 16:58:23','2020-06-09 16:58:24'),(50,'App\\Report',8,'6450845e-0db5-4f90-937f-89d7e054dca5','detail-images','media-librarykoD85Q','VPMJLdx75MKjpoTZ2BIR.jpg','image/jpeg','public','public',35413,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',36,'2020-06-09 17:08:25','2020-06-09 17:08:25'),(51,'App\\Report',8,'950a6c09-abf0-4471-ba2b-7cf960ba5301','detail-images','media-libraryVm0mOw','RZXpNhXvotmB3ztviOd2.jpg','image/jpeg','public','public',75678,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',37,'2020-06-09 17:08:25','2020-06-09 17:08:26'),(52,'App\\Report',8,'0a0b63f3-c505-4083-a62e-d5cb7e9ba90b','detail-images','media-libraryo1OC1g','rIP2pkOPaYBTUY4mAyOC.jpg','image/jpeg','public','public',26690,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',38,'2020-06-09 17:08:26','2020-06-09 17:08:26'),(53,'App\\Report',8,'7add1b9d-7d5d-4750-bc50-e63ff916ccae','detail-images','media-libraryDpqH73','PBuINmJCDmkumeTxKmn2.jpg','image/jpeg','public','public',87994,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',39,'2020-06-09 17:08:26','2020-06-09 17:08:26'),(54,'App\\Product',23,'cb18d3e4-2745-48b9-a3f6-b54f3e6bf1b1','images','so-diep','so-diep.jpg','image/jpeg','public','public',390236,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',40,'2020-06-09 17:11:17','2020-06-09 17:11:18'),(57,'App\\Report',9,'260bf1f5-d84f-4dc2-a041-7bd1e04e01bd','detail-images','media-libraryNpuu7g','jNqd43Dks8jWkCWLlkS9.jpg','image/jpeg','public','public',79958,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',43,'2020-06-09 17:15:02','2020-06-09 17:15:02'),(58,'App\\Report',9,'b1b27597-90a0-4c41-af80-e9b3cdb96f5a','detail-images','media-libraryN6MHJr','wIrmlW698O4kYfF9fYYk.jpg','image/jpeg','public','public',35413,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',44,'2020-06-09 17:15:02','2020-06-09 17:15:03'),(59,'App\\Report',9,'5f6a0e98-740b-4968-b801-971dd8a37db4','detail-images','media-libraryrLF0HF','ByDgPuh4gmRTXxF34m0C.jpg','image/jpeg','public','public',390236,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',45,'2020-06-09 17:15:03','2020-06-09 17:15:04'),(60,'App\\Report',9,'ef447f7c-0ca0-4dfe-9e93-9f25b2d5fd51','detail-images','media-libraryjfyzp5','7vUNtxkhakUtVBaUmnpj.jpg','image/jpeg','public','public',160865,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',46,'2020-06-09 17:15:04','2020-06-09 17:15:04'),(61,'App\\Report',9,'4bdfff6d-d016-41ba-8561-214866edfa94','detail-images','media-libraryGm1JkA','oQbUZhXXIGeyLQn0Hue1.jpg','image/jpeg','public','public',88404,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',47,'2020-06-09 17:15:04','2020-06-09 17:15:04'),(62,'App\\Report',9,'df8552dc-a6a1-4f28-82d5-ad1b16a98fe8','detail-images','media-libraryyPkQ58','kXQyPgsm6SodpyoFbeL3.jpg','image/jpeg','public','public',639900,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',48,'2020-06-09 17:15:04','2020-06-09 17:15:06'),(63,'App\\Category',3,'6d3c67ec-5c4c-44f6-b0bb-7a36f32df38b','images','CỔ-THẠCH-–-BÌNH-THUẬN-min','CỔ-THẠCH-–-BÌNH-THUẬN-min.jpg','image/jpeg','public','public',79958,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',49,'2020-06-11 14:55:27','2020-06-11 14:55:29'),(64,'App\\Category',4,'9f881275-fe40-49d9-93ff-47e551c48b06','images','IMG_5169','IMG_5169.jpg','image/jpeg','public','public',1242834,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',50,'2020-06-11 14:56:04','2020-06-11 14:56:07'),(65,'App\\Category',1,'e43fbdf2-5cfa-48c3-b2f7-7fe330515d33','images','Sò-Điệp-Nhật7','Sò-Điệp-Nhật7.jpg','image/jpeg','public','public',160865,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',51,'2020-06-11 14:56:58','2020-06-11 14:56:59'),(85,'App\\Product',23,'dec322b6-0496-4e19-a9b2-1ab792d7bf96','images','tom-cang-xanh-nuong-bo-toi','tom-cang-xanh-nuong-bo-toi.webp','image/webp','public','public',557532,'[]','[]','[]',68,'2020-07-07 02:37:06','2020-07-07 02:37:06'),(88,'App\\Product',22,'28d35c55-825a-4463-8e1f-9e6771ffd918','images','nho-xanh-ninh-thuan-1','nho-xanh-ninh-thuan-1.jpg','image/jpeg','public','public',54049,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',71,'2020-07-07 02:37:39','2020-07-07 02:37:40'),(89,'App\\Product',22,'ab131f33-3a55-477c-a934-69889d9e17c8','detail-images','media-librarybzwmGv','ylTVmbvqHhW2LWzWuhtk.jpg','image/jpeg','public','public',118589,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',72,'2020-07-07 02:37:41','2020-07-07 02:37:41'),(90,'App\\Product',22,'c4d1e82d-83a3-49d1-8eb8-9ae468a6faec','detail-images','media-libraryDZDZlL','IYmxGrNaaevP6agVxklX.jpg','image/jpeg','public','public',53536,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',73,'2020-07-07 02:37:41','2020-07-07 02:37:42'),(91,'App\\Product',22,'ef223458-b9bf-4872-afd1-5d92b1383994','detail-images','media-libraryD79mB7','ouCrT6dTvDxhdpNHb79h.jpg','image/jpeg','public','public',26690,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',74,'2020-07-07 02:37:42','2020-07-07 02:37:42'),(92,'App\\Product',22,'f32883a8-c4a3-40dc-8c33-93d5ed970183','detail-images','media-library30i63y','2YXVU59ByRiNdHY2HnsG.jpg','image/jpeg','public','public',35413,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',75,'2020-07-07 02:37:42','2020-07-07 02:37:42'),(93,'App\\Product',22,'52823644-ab66-47ff-a240-f8463289b441','detail-images','media-librarylM1rG5','1iWA6l6EsIC3skBRleJX.jpg','image/jpeg','public','public',79958,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',76,'2020-07-07 02:37:42','2020-07-07 02:37:43'),(94,'App\\Product',22,'36bc05b0-a9c6-4e86-af9d-7b40c631816d','detail-images','media-libraryNtSs8I','QzBh0zPenYzbiVNESO4Y.jpg','image/jpeg','public','public',223759,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',77,'2020-07-07 02:37:43','2020-07-07 02:37:43'),(95,'App\\Product',22,'b5a40803-a1d3-46d2-bebb-1c01eb855b50','detail-images','media-library6WdA0x','3YA0yoPNtRT0Wd20VoQD.jpg','image/jpeg','public','public',75678,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',78,'2020-07-07 02:37:44','2020-07-07 02:37:44'),(96,'App\\Product',22,'54a32c35-6616-410b-b771-0e8e91df300c','detail-images','media-libraryvUxhru','d1kzXommgaKad4D534Zz.jpg','image/jpeg','public','public',52499,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',79,'2020-07-07 02:37:44','2020-07-07 02:37:44'),(97,'App\\Product',22,'badf2472-0fc0-4290-9002-0156fc8ddaae','detail-images','media-libraryS51Etw','f8Astbxe9Gretoj1WH09.jpg','image/jpeg','public','public',53536,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',80,'2020-07-07 02:37:44','2020-07-07 02:37:45'),(98,'App\\Product',22,'d3a47903-7462-4232-a2f8-6b45f4986c27','detail-images','media-library2XCwtE','KXQYcIGNIsKGuztLobVo.jpg','image/jpeg','public','public',87994,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',81,'2020-07-07 02:37:45','2020-07-07 02:37:45'),(99,'App\\Product',22,'e1335715-0c30-4748-b26b-5be1e402ea8d','detail-images','media-libraryrxhS8S','8W3680XEOdd41qx6ki2W.jpg','image/jpeg','public','public',228735,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',82,'2020-07-07 02:37:45','2020-07-07 02:37:46'),(100,'App\\Product',23,'c6920410-6532-41af-a160-df88387d2320','images','green-apple','green-apple.jpg','image/jpeg','public','public',223759,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',83,'2020-07-07 02:38:08','2020-07-07 02:38:09'),(101,'App\\Product',23,'514910e9-3ed5-440b-b9e8-efb84f1dd684','detail-images','media-librarydcmea5','14GRfgpRl2zPWCG5HfCC.jpg','image/jpeg','public','public',118589,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',84,'2020-07-07 02:38:09','2020-07-07 02:38:10'),(102,'App\\Product',23,'5bdefcbb-f4e4-4c0c-ad21-0b10494abb0a','detail-images','media-library8C3apn','hH90emcAqsAB8uCZD1kG.jpg','image/jpeg','public','public',160865,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',85,'2020-07-07 02:38:10','2020-07-07 02:38:10'),(103,'App\\Product',24,'f1b1a15f-53b5-49c6-915c-2635ca793fa4','images','30727603_1211267989010122_16259436217630720_n','30727603_1211267989010122_16259436217630720_n.jpg','image/jpeg','public','public',71260,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',86,'2020-07-07 02:38:48','2020-07-07 02:38:49'),(107,'App\\Product',24,'7a940c4c-2a73-4a42-bb1e-9067a6f38c1f','images','85057-muc-mot-nang-nha-trang-1kg','85057-muc-mot-nang-nha-trang-1kg.jpg','image/jpeg','public','public',118589,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',90,'2020-07-07 02:42:21','2020-07-07 02:42:22'),(108,'App\\Product',24,'40aacbc8-0c65-4236-915e-93b66e33fcba','detail-images','media-libraryQmjxOJ','ba0sgtfdcr540BZKUYOv.jpg','image/jpeg','public','public',142259,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',91,'2020-07-07 02:42:22','2020-07-07 02:42:23'),(109,'App\\Product',24,'a081d795-5725-4713-81d3-ed191677fd13','detail-images','media-libraryiAXGFp','dtOnwaNqUMjinL1vAeoS.jpg','image/jpeg','public','public',26690,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',92,'2020-07-07 02:42:23','2020-07-07 02:42:23'),(110,'App\\Product',24,'444f67ae-532a-4a60-a449-94805fd7f001','detail-images','media-libraryp9lVtb','g5Lj8CiiLmSRNLkbsTb7.jpg','image/jpeg','public','public',35413,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',93,'2020-07-07 02:42:23','2020-07-07 02:42:23'),(111,'App\\Product',25,'3800e8e2-00d5-4c1c-a13b-ed1f7a2786d1','detail-images','media-libraryIgFjzV','2PgVdX4DAPdfNJoaRsym.jpg','image/jpeg','public','public',79958,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',94,'2020-07-11 07:45:58','2020-07-11 07:46:00'),(112,'App\\Product',25,'f36a216d-92fd-4e6f-b580-ee4a55e0320a','detail-images','media-libraryOA3GqW','Q2C8RwzikkK9DEQChDS5.jpg','image/jpeg','public','public',88404,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',95,'2020-07-11 07:46:00','2020-07-11 07:46:01'),(113,'App\\Product',25,'7dfadf73-8435-4ac4-823b-ff4ce59a8066','detail-images','media-library3ixim6','gtqLFTcq4LajfYQUCuaz.jpg','image/jpeg','public','public',87994,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',96,'2020-07-11 07:46:01','2020-07-11 07:46:01'),(114,'App\\Product',25,'c0ea5e83-8b24-46e4-b134-16aefb852d4c','detail-images','media-libraryyHUtZm','FOVALQoCwSGn0beUWOCy.jpg','image/jpeg','public','public',146192,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',97,'2020-07-11 07:46:01','2020-07-11 07:46:02'),(115,'App\\Product',25,'babe23c6-34e5-4221-8223-34b551246849','detail-images','media-libraryOImjAM','dKHdIVQlnUOyH1Wcooye.jpg','image/jpeg','public','public',1242834,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',98,'2020-07-11 07:46:02','2020-07-11 07:46:05'),(119,'App\\Product',28,'f807ad6d-542c-4d6b-9014-90f7b4434700','images','clb40-roselyn-s','clb40-roselyn-s.jpg','image/jpeg','public','public',43839,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',101,'2020-07-11 08:03:46','2020-07-11 08:03:46'),(120,'App\\Product',28,'d617d7ec-6c16-4a16-8980-fdf83f31c2cb','detail-images','media-library24hqou','Qeg2DEsptNdd0GM8rX3a.jpg','image/jpeg','public','public',43839,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',102,'2020-07-11 08:03:46','2020-07-11 08:03:47'),(121,'App\\Product',27,'5112c6d6-e6b3-49d9-a7a9-e570ecc97593','images','dw00100319_petite_rosewater_w28rg','dw00100319_petite_rosewater_w28rg.png','image/png','public','public',97013,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',103,'2020-07-11 08:04:05','2020-07-11 08:04:06'),(122,'App\\Product',27,'04cfa7bd-8f19-4758-bf7b-505102270304','detail-images','media-libraryjbQdEx','Ed4Ge8YWZa6itPBTgpvV.jpg','image/png','public','public',97013,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',104,'2020-07-11 08:04:06','2020-07-11 08:04:06'),(125,'App\\Product',30,'1b74fb00-c750-48f9-bcd2-ee7518ea007f','detail-images','media-librarykBZdLi','uebqOWUH3zdL6fJzwdcQ.jpg','image/jpeg','public','public',50602,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',105,'2020-07-11 08:08:14','2020-07-11 08:08:15'),(126,'App\\Product',30,'ee4fc1ac-40f3-49b9-b6b5-c604f358ba93','detail-images','media-libraryU3l3yy','b8jfZnBvyKcip26AZoo3.jpg','image/jpeg','public','public',30269,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',106,'2020-07-11 08:08:15','2020-07-11 08:08:15'),(127,'App\\Product',31,'d3273900-1fb1-464c-add1-54ba153e4e31','detail-images','media-library95yZMa','mSJXtqphIFQjJY3mOE0v.jpg','image/jpeg','public','public',50602,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',107,'2020-07-11 08:09:44','2020-07-11 08:09:45'),(128,'App\\Product',31,'bc7c29d3-12d4-4c9d-850a-6f848798c683','detail-images','media-librarygiFNHE','vWWuAbXb5l0eJJw71yHy.jpg','image/jpeg','public','public',30269,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',108,'2020-07-11 08:09:45','2020-07-11 08:09:45'),(129,'App\\Product',32,'47c454ed-72d7-4504-badd-d823fcc990d6','detail-images','media-library0aHndT','9DcqbGB6gCIkdigrRg9i.jpg','image/jpeg','public','public',32705,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',109,'2020-07-11 08:17:40','2020-07-11 08:17:40'),(130,'App\\Product',32,'22629536-d4d7-407f-9b58-459c729a78a8','detail-images','media-libraryIVGCjI','x8K18O9mR46uQIlhWCWM.jpg','image/jpeg','public','public',44378,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',110,'2020-07-11 08:17:40','2020-07-11 08:17:41'),(131,'App\\Product',33,'8e8f70b5-cccc-4acc-92be-1a662e1a1bfe','detail-images','media-libraryRiuKsh','bZNRmoFMLnAiQV32ntOR.jpg','image/png','public','public',805710,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',111,'2020-07-11 08:18:55','2020-07-11 08:18:57'),(132,'App\\Product',34,'30f6628a-906a-4757-b972-a224cbd2a857','detail-images','media-libraryBcMlzp','cBRAfVcb85XzFQRymusk.jpg','image/jpeg','public','public',146192,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',112,'2020-07-11 08:39:59','2020-07-11 08:40:01'),(133,'App\\Product',35,'b02c12a8-a3f5-4791-8d44-0f43555da09e','detail-images','media-libraryg5pJUI','imHhhUvhoCHRVenViJlL.jpg','image/jpeg','public','public',162461,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',113,'2020-07-11 08:49:33','2020-07-11 08:49:34'),(134,'App\\Product',36,'d1c6e01c-e143-428b-a5a8-bc9a7c2b0d18','detail-images','media-libraryuC3RkG','9Ecp0H3mox92JDpthyUj.jpg','image/jpeg','public','public',284820,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',114,'2020-07-11 08:51:34','2020-07-11 08:51:35'),(135,'App\\Product',37,'0eba5433-8abe-4652-b55b-c2d21c712d91','detail-images','media-libraryiTOQ32','gSm2oYetf1yTf4PInPMc.jpg','image/jpeg','public','public',52512,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',115,'2020-07-11 08:55:50','2020-07-11 08:55:50'),(136,'App\\Product',38,'cd7946ae-82d9-49e6-b514-1981819c42ae','detail-images','media-libraryFvEchA','PA0uNfAn2NXMKaXIzlVS.jpg','image/jpeg','public','public',70904,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',116,'2020-07-11 08:57:42','2020-07-11 08:57:43'),(137,'App\\Report',10,'fcf3502d-3d13-430e-8a3c-80662eec9886','detail-images','media-librarywiJ1rq','UES3ToTt5uRRS6YNvbZz.jpg','image/jpeg','public','public',39557,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',117,'2020-07-12 06:07:07','2020-07-12 06:07:09'),(138,'App\\Report',11,'7d78eaf0-89a4-476a-92fa-6c53da2cf3db','detail-images','media-libraryk6aKNu','8rnNxw2PuazjwR2Ws3uq.jpg','image/jpeg','public','public',39557,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',118,'2020-07-12 06:08:33','2020-07-12 06:08:33'),(139,'App\\Report',12,'bd128ec0-1b50-4bdd-811e-7035416792c6','detail-images','media-library5l3BcQ','RAt07I1g7GzL6PRBgf4L.jpg','image/jpeg','public','public',70904,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',119,'2020-07-12 11:33:50','2020-07-12 11:33:52'),(140,'App\\Report',12,'ba7bff9f-e3aa-46cc-b5fe-eb9f1cf739c6','detail-images','media-library0usKcl','iqOTDFaozph4E0IwRfg8.jpg','image/jpeg','public','public',39557,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',120,'2020-07-12 11:33:52','2020-07-12 11:33:52'),(141,'App\\Report',12,'29b44c21-f0b6-4c91-8e60-0e0add995711','detail-images','media-libraryCF1CpW','gCkDrDNMTTImtcV0zbOE.jpg','image/jpeg','public','public',52512,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',121,'2020-07-12 11:33:52','2020-07-12 11:33:52'),(142,'App\\Report',12,'32666766-dfd3-4587-bd88-88f64e298154','detail-images','media-libraryGolGhB','AJreQIVdYt7sPH8VWaX3.jpg','image/jpeg','public','public',142259,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',122,'2020-07-12 11:33:52','2020-07-12 11:33:53'),(143,'App\\Report',12,'d80ed9af-b6cb-4416-aecb-3555a12c18fb','detail-images','media-libraryoxTnEn','2iyQX0gbv6eXSI39SU63.jpg','image/jpeg','public','public',79958,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',123,'2020-07-12 11:33:53','2020-07-12 11:33:53'),(144,'App\\Report',12,'fc3751ad-c097-411b-bf07-0b594860ee48','detail-images','media-libraryjsrhFe','F05m5MPD9OmuVwHjI6tz.jpg','image/jpeg','public','public',284820,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',124,'2020-07-12 11:33:53','2020-07-12 11:33:54'),(145,'App\\Report',13,'8c5a4fb8-8f26-45b1-b076-59a7fa8b0af3','detail-images','media-libraryrYwV2S','7b4bdBlHeeAmeOJW7X7t.jpg','image/jpeg','public','public',52512,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',125,'2020-07-12 12:24:10','2020-07-12 12:24:11'),(146,'App\\Report',14,'7e5976d9-1d5a-4f20-87b0-3655fc788a28','detail-images','media-libraryHoV98t','5ygBsWVDgJbEJSrnDnBN.jpg','image/jpeg','public','public',64047,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',126,'2020-07-14 14:10:57','2020-07-14 14:10:57'),(147,'App\\Report',15,'8cb115ab-f865-42eb-8e23-65266f51918a','detail-images','media-librarymNNaTy','UMoBkcHOlUH4rmgbhvuG.jpg','image/jpeg','public','public',32705,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',127,'2020-07-14 14:11:52','2020-07-14 14:11:52'),(148,'App\\Report',15,'fe64129e-2986-4fb3-a1f3-45ecf570c30e','detail-images','media-libraryYgqtux','uu7NMTGjW6IUjEHyXytq.jpg','image/jpeg','public','public',44378,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',128,'2020-07-14 14:11:52','2020-07-14 14:11:52'),(149,'App\\Report',15,'21a15825-6c32-4fa6-901e-208ffa805050','detail-images','media-libraryvsRsPz','xvkPpt8cGZRTICfsRCxK.jpg','image/jpeg','public','public',63592,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',129,'2020-07-14 14:11:52','2020-07-14 14:11:53'),(150,'App\\Report',15,'79672b08-59a7-44e3-8c4f-f7226eee3513','detail-images','media-librarycLMqCG','dbFiUXwNRHKRGtyJPBZf.jpg','image/png','public','public',805710,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',130,'2020-07-14 14:11:53','2020-07-14 14:11:55'),(151,'App\\Product',39,'84710ba8-731b-4a3b-bc8a-ca5f3900708a','detail-images','media-libraryVn2h5d','U65tTgD4Gjglsa5Ub84G.jpg','image/jpeg','public','public',44378,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',131,'2020-07-15 14:49:41','2020-07-15 14:49:43'),(152,'App\\Product',39,'048dc975-469c-41c4-bacb-96f1c2465b53','detail-images','media-libraryJuwkbq','9lksMBPUpS88QtSTcadI.jpg','image/jpeg','public','public',63592,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',132,'2020-07-15 14:49:43','2020-07-15 14:49:43'),(153,'App\\Product',40,'36d3726e-0ff0-4f08-a987-32bfc19cf7ed','detail-images','media-libraryZYVRSP','vCqzVOnASTMpznNdyMYE.jpg','image/jpeg','public','public',39401,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',133,'2020-07-15 14:53:13','2020-07-15 14:53:13'),(154,'App\\Product',40,'7c991566-8a37-4dc9-8b21-713032d377ff','detail-images','media-libraryxnfKo1','GqnP01itHdh1DRfBDPKy.jpg','image/jpeg','public','public',50602,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',134,'2020-07-15 14:53:13','2020-07-15 14:53:14'),(155,'App\\Product',40,'92ef2335-3b63-4d1a-87aa-65a71c5ecc18','detail-images','media-libraryKWi0jj','MukhxpfhalvdsBT7HQ6v.jpg','image/jpeg','public','public',64047,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',135,'2020-07-15 14:53:14','2020-07-15 14:53:14'),(156,'App\\Product',42,'ed5c3157-6734-40b4-8721-3a6b1177e202','detail-images','media-librarywbe4jP','VdCwdnILkPDLngrjjRGs.jpg','image/jpeg','public','public',21220,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',136,'2020-07-15 15:05:53','2020-07-15 15:05:54'),(157,'App\\Product',43,'144dcf72-1b5e-4458-b817-fafb48851cc6','detail-images','media-libraryLAzXLc','dROYH1djTMQzUsAt0nzF.jpg','image/jpeg','public','public',493883,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',137,'2020-07-15 15:11:51','2020-07-15 15:11:52'),(158,'App\\Product',44,'d932844e-2ec1-4224-8544-167e83a82be5','detail-images','media-libraryH2Jgo2','IQEZMMuRUHczg0xnCKUm.jpg','image/jpeg','public','public',32705,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',138,'2020-07-15 15:44:22','2020-07-15 15:44:23'),(159,'App\\Product',44,'f07be4fc-faa2-42bd-9fdb-782e0083d161','detail-images','media-libraryKUtr8D','hRBJEn2CMf78660ktIKW.jpg','image/png','public','public',805710,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-150\": true, \"thumb-350\": true}}','[]',139,'2020-07-15 15:44:23','2020-07-15 15:44:25'),(160,'App\\Report',16,'87fc4d4a-8a4d-413e-8c11-0de912d7e869','detail-images','media-libraryUE0mH5','tSmQ0EXmXfXkk0QKFtEN.jpg','image/jpeg','public','public',52499,'[]','{\"generated_conversions\": {\"thumb\": true, \"thumb-350\": true}}','[]',140,'2020-08-20 14:19:37','2020-08-20 14:19:39');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_type`
--

DROP TABLE IF EXISTS `message_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message_type` (
  `message_type` int unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`message_type`),
  UNIQUE KEY `message_type_message_type_unique` (`message_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_type`
--

LOCK TABLES `message_type` WRITE;
/*!40000 ALTER TABLE `message_type` DISABLE KEYS */;
INSERT INTO `message_type` VALUES (1,'đã thích bình luận của bạn','thông báo khi có người tương tác với bình luận của người dùng (like)',NULL,NULL),(2,'đã thích bài viết của bạn','thông báo khi có người thích bài viết',NULL,NULL);
/*!40000 ALTER TABLE `message_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_06_07_153515_create_categories_table',1),(5,'2020_06_07_154924_create_products_table',1),(6,'2020_06_07_155525_create_comments_table',1),(7,'2020_06_07_155823_create_reports_table',1),(8,'2020_06_08_034136_create_bookmarks_table',1),(9,'2020_06_09_081312_create_media_table',1),(10,'2020_06_12_080349_create_services_table',2),(11,'2020_06_12_080742_create_product_service_table',2),(12,'2016_06_01_000001_create_oauth_auth_codes_table',3),(13,'2016_06_01_000002_create_oauth_access_tokens_table',3),(14,'2016_06_01_000003_create_oauth_refresh_tokens_table',3),(15,'2016_06_01_000004_create_oauth_clients_table',3),(16,'2016_06_01_000005_create_oauth_personal_access_clients_table',3),(17,'2020_07_05_081312_create_like_table',4),(20,'2020_07_13_162615_create_social_accounts_table',5),(21,'2020_07_17_152615_create_message_type_table',6),(26,'2020_07_17_162615_create_notifications_table',6),(31,'2020_07_18_162690_create_read_notification_at_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `creator` bigint unsigned NOT NULL,
  `receiver` bigint unsigned NOT NULL,
  `message_type_id` int unsigned NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `notifications_creator_foreign` (`creator`),
  KEY `notifications_receiver_foreign` (`receiver`),
  KEY `notifications_message_type_id_foreign` (`message_type_id`),
  CONSTRAINT `notifications_creator_foreign` FOREIGN KEY (`creator`) REFERENCES `users` (`id`),
  CONSTRAINT `notifications_message_type_id_foreign` FOREIGN KEY (`message_type_id`) REFERENCES `message_type` (`message_type`),
  CONSTRAINT `notifications_receiver_foreign` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'App\\Comment',20,1,41,1,NULL,0,'2020-07-17 22:58:39','2020-07-17 22:58:41'),(2,'App\\Comment',20,2,41,1,NULL,0,'2020-07-17 18:58:39','2020-07-17 22:58:41'),(3,'App\\Comment',20,3,41,1,NULL,0,'2020-07-17 17:58:39','2020-07-17 22:58:41'),(5,'App\\Product',40,41,20,2,NULL,0,'2020-07-17 16:46:03','2020-07-17 16:46:03'),(6,'App\\Product',40,43,20,2,NULL,0,'2020-07-17 16:54:24','2020-07-17 16:54:24'),(29,'App\\Comment',21,41,43,1,NULL,0,'2020-07-17 18:09:12','2020-07-17 18:09:12'),(36,'App\\Comment',22,43,41,1,NULL,0,'2020-07-17 18:22:15','2020-07-17 18:22:15'),(38,'App\\Comment',23,41,41,1,NULL,0,'2020-07-18 00:20:05','2020-07-18 00:55:05'),(40,'App\\Comment',22,41,41,1,NULL,0,'2020-07-18 07:22:03','2020-07-18 07:22:03'),(41,'App\\Comment',20,41,41,1,NULL,0,'2020-07-18 08:33:29','2020-07-18 08:33:29'),(42,'App\\Comment',19,41,42,1,NULL,0,'2020-07-18 08:33:40','2020-07-18 08:33:40'),(43,'App\\Comment',24,41,41,1,NULL,0,'2020-07-18 08:34:24','2020-07-18 08:34:24'),(44,'App\\Comment',25,20,41,1,NULL,0,'2020-07-18 08:36:22','2020-07-18 08:36:22'),(45,'App\\Comment',26,20,41,1,NULL,0,'2020-07-18 08:36:34','2020-07-18 08:36:34'),(46,'App\\Product',36,41,20,2,NULL,0,'2020-08-20 14:11:38','2020-08-20 14:11:38'),(47,'App\\Comment',27,42,41,1,NULL,0,'2020-08-20 14:24:59','2020-08-20 14:24:59'),(48,'App\\Comment',28,41,42,1,NULL,0,'2020-08-20 14:31:09','2020-08-20 14:31:09'),(49,'App\\Comment',25,41,41,1,NULL,0,'2020-08-21 00:59:59','2020-08-21 00:59:59'),(50,'App\\Product',43,41,41,2,NULL,0,'2020-08-21 01:09:00','2020-08-21 01:09:00');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('0065fd0d17b819fb87cdb5f59ca0b36641f27c69913bc725d84332a4176f751a894d2793914bed81',42,1,'Laravel Password Grant Client','[]',0,'2020-07-15 12:07:05','2020-07-15 12:07:05','2021-01-15 12:07:04'),('08bd29a6272c706f8692b50fb4708a21ab718162e80adb41109bedd93fd1aea56ed57f791cb07b9f',39,2,NULL,'[]',0,'2020-07-14 15:24:20','2020-07-14 15:24:20','2021-07-14 15:24:20'),('0904bf01731899b44535b0d260e387750410cf069948dc1dd44eff69411fc9138105b7979dc39dd8',27,1,'Laravel Password Grant Client','[]',0,'2020-07-05 11:38:44','2020-07-05 11:38:44','2021-07-05 11:38:44'),('0a4bd395df5c6e905046f4068136cb4d7505cd53a3acb7af10f858ba021378b8c0723bb60a733bdb',20,2,NULL,'[]',0,'2020-07-15 14:10:56','2020-07-15 14:10:56','2020-07-30 14:10:56'),('14917201433b430cc0be2bcb90da635c30b00c0c6c9da05b4a327dcfcb91096845ed7c02f0219ea9',20,2,NULL,'[]',0,'2020-07-02 16:58:33','2020-07-02 16:58:33','2021-07-02 16:58:33'),('152c4b6c1322ef3216c028011e79fa090ac915b8d669a9327373096b842fec6aa6f7844c4c090d8a',41,1,'Dan Tran','[]',0,'2020-07-17 15:54:32','2020-07-17 15:54:32','2021-01-17 15:54:29'),('16f766c25e22e4ae3b11307ec415df3d74248ffdd8b7dce813755cfcebc4c1858fb0c10dee5e9cc5',41,1,'Dan Tran','[]',0,'2020-08-20 15:27:58','2020-08-20 15:27:58','2021-02-20 15:27:57'),('1a8894765de06bf2d761826e3bf3234eb365439d9e92ffaa1ce8e4ad4e5d22590cd337d6eef7c485',41,1,'Dan Tran','[]',0,'2020-07-14 15:53:13','2020-07-14 15:53:13','2021-07-14 15:53:13'),('220ed1e8c96d177cda4b5e8b62295dd7bdacab9493ef0fdd384b989d530b5b763b5cb257618f70a3',20,2,NULL,'[]',0,'2020-07-09 14:43:45','2020-07-09 14:43:45','2021-07-09 14:43:45'),('249e88287672146f790681859f3c77cd5df40c0f42f93372e675d6a8d03c4712a1db1d75387468ab',40,2,NULL,'[]',0,'2020-07-14 15:30:34','2020-07-14 15:30:34','2021-07-14 15:30:34'),('256df1d39e1edeff0a1ab496c070d91130ab79954d16fa389ec9106de4df79168f71a7a71e20f652',26,1,'Laravel Password Grant Client','[]',0,'2020-07-05 10:37:10','2020-07-05 10:37:10','2021-07-05 10:37:10'),('27065d7986499ac8f3898b1d7ea5e54fbdb28f223beeabcace8db33f97b608f22e59c02c72633540',22,1,'Laravel Password Grant Client','[]',0,'2020-07-05 08:23:55','2020-07-05 08:23:55','2021-07-05 08:23:55'),('29255077f3fbb057af2df1e062120df951a61d7ffb7968ba6dc06325c71e4e593235eae09db93e54',25,1,'Laravel Password Grant Client','[]',0,'2020-07-05 08:29:06','2020-07-05 08:29:06','2021-07-05 08:29:06'),('2af7556d98b18addd7f94097f2d066a2d55c1e1d15dae5c1512f990c575dd15fbf337a593ca03fb5',24,1,'Laravel Password Grant Client','[]',0,'2020-07-05 08:27:45','2020-07-05 08:27:45','2021-07-05 08:27:45'),('2fe3d5931e6ed795dab1e1c59f6536dd08733fcac01b71d273cfc84cd0353655212fe96543b4ae37',41,1,'Dan Tran','[]',0,'2020-07-19 19:46:48','2020-07-19 19:46:48','2021-01-19 19:46:46'),('30659c0aa5b4528ef90f10cc73beeb4163045e77e7a9ee7967e5014028d009e503ad8cab1fc46413',21,2,NULL,'[]',0,'2020-07-07 09:48:53','2020-07-07 09:48:53','2021-07-07 09:48:53'),('35607d3308cf7eaf339653e8bbde92ea91b38b7658757e7bf42d31f66d5ef0c7165c2c8cd89c6a22',20,2,NULL,'[]',0,'2020-07-03 14:24:28','2020-07-03 14:24:28','2021-07-03 14:24:28'),('37f2c8249af661e794845e52080e136a5390dac5bf0757e3b22d9272e978343d4ab729544d6e8174',41,1,'Dan Tran','[]',0,'2020-07-15 11:26:47','2020-07-15 11:26:47','2021-01-15 11:26:47'),('386003011deccf1160d42f915c640beae7b55f5e52b1e3e36a8d3c5bec6c43105da01a7b0d37cbf6',21,1,'Laravel Password Grant Client','[]',0,'2020-07-04 15:51:03','2020-07-04 15:51:03','2021-07-04 15:51:03'),('3b79d1526e9cc7b0342c69a43d05115b9acb882620e19dfa2c99269b5c771914d9fb5c466efb2b26',41,2,NULL,'[]',0,'2020-07-14 15:35:13','2020-07-14 15:35:13','2021-07-14 15:35:13'),('3c37ba95c581990b0b851d488ddb5f7d15d72f620c048e24979eaa8be98618c3cee162c14330f488',23,1,'Laravel Password Grant Client','[]',0,'2020-07-05 08:26:59','2020-07-05 08:26:59','2021-07-05 08:26:59'),('4019bf8876891702555ddb4c138ef8fa7a38a93cb135be06ade53751194023842a4e034b6aa149f9',41,1,'Dan Tran','[]',0,'2020-07-14 15:52:43','2020-07-14 15:52:43','2021-07-14 15:52:43'),('4897dafef3fa088823d0f90214b83d788a1c404da682c9c4d57e0f6c7f66bedc1b588fcb91da3428',21,2,NULL,'[]',0,'2020-07-04 15:51:37','2020-07-04 15:51:37','2021-07-04 15:51:37'),('4a12ec1506463cd0dd23ca1ff539b66c459990a940195c076583d4ca24c347a72e22a3d3d6800ade',42,2,NULL,'[]',0,'2020-08-20 14:24:02','2020-08-20 14:24:02','2020-09-04 14:24:02'),('4e44efa18260ea439c408270a621edf431e81a46ec5eb571fefabf4dbbdc12a233004ba476338e05',20,2,NULL,'[]',0,'2020-07-06 06:13:10','2020-07-06 06:13:10','2021-07-06 06:13:10'),('54adc9bdc8044c3f857e710388c5763403630c78e879fc0f4e29e4af35a1b0efe6626490cc486f15',20,2,NULL,'[]',0,'2020-07-04 06:11:13','2020-07-04 06:11:13','2021-07-04 06:11:13'),('555cd020a82225a30d407c8d6602bc2e37d65b69599e6b9dc6cc8b66c77daccae9afc6a5d79db2d8',20,2,NULL,'[]',0,'2020-07-08 14:12:44','2020-07-08 14:12:44','2021-07-08 14:12:44'),('55cd4cc57e0c4df7e29565fc728baab71c9791ff2bc940368c068b9b4d90b7171ddf9c0d8b57d99d',20,2,NULL,'[]',0,'2020-07-06 14:59:35','2020-07-06 14:59:35','2021-07-06 14:59:35'),('56843e3ea14c4041726ca0451bf38824fce3b213d53ec92c2f0cbc7b981c156a8a764e7f300a4c3b',20,2,NULL,'[]',0,'2020-07-06 06:28:09','2020-07-06 06:28:09','2021-07-06 06:28:09'),('5cd2f58e938fe3016bcf87d85f9bba459f8bfff8fd6ff212a926fd35a50ee9c2fe6c5f2c086f2ffb',20,2,NULL,'[]',0,'2020-07-06 15:03:19','2020-07-06 15:03:19','2021-07-06 15:03:19'),('5d9bfe998f08812e2e5b405ace34b0b3832c1eb3bf24468799f7d1c4a4b5a0576fbca75255852bd9',25,2,NULL,'[]',0,'2020-07-08 14:16:31','2020-07-08 14:16:31','2021-07-08 14:16:31'),('69de46d6d869a5c1ef74096013f7f2d426178fdc24be971d0349f0606440aa04bff7f8eaaebcad22',31,2,NULL,'[]',0,'2020-07-14 14:08:07','2020-07-14 14:08:07','2021-07-14 14:08:07'),('6cb403ba2999a3b113243eb5cbb73846e4e78c38bd5de81b92e42681643318eacb61616c956b42c2',20,2,NULL,'[]',0,'2020-07-11 07:42:53','2020-07-11 07:42:53','2021-07-11 07:42:53'),('7240bdd76d98620755bcbd85fec9350261dfce1945143385e410229bdc0b53161d68a6090f7ae553',20,2,NULL,'[]',0,'2020-07-17 16:48:24','2020-07-17 16:48:24','2020-08-01 16:48:24'),('76af1bc04e89c06b93d9b3315fdd54e0e147cea6772574ca40062f26131fe618deb4db03efe43bd9',18,2,NULL,'[]',0,'2020-07-13 13:13:43','2020-07-13 13:13:43','2021-07-13 13:13:43'),('84e74d35dbf4225813ac1b79599f28472197206d208abb87d179897708a709520ad592fea55aa1c7',20,2,NULL,'[]',0,'2020-07-06 14:57:37','2020-07-06 14:57:37','2021-07-06 14:57:37'),('867544713d31e943020fa6daef715ae4154801bd8ceaeceea786d9e1164d89691d2bcd62a173c211',39,2,NULL,'[]',0,'2020-07-14 15:28:21','2020-07-14 15:28:21','2021-07-14 15:28:21'),('9238cfb1a81afcc16e82afd19d87551f94c0bd00c958ad41b522ee119f8d32ede716344519b4b7e6',6,2,NULL,'[]',0,'2020-07-12 11:33:13','2020-07-12 11:33:13','2021-07-12 11:33:13'),('95f18f51f0c2a555dbe4cf3aeeb20fe8deff03346de354276e9212a9b9a910aa5d231500c83719a8',41,1,'Dan Tran','[]',0,'2020-07-14 15:55:36','2020-07-14 15:55:36','2021-07-14 15:55:36'),('9728ca1793501d94607f9f4cb7b553f470698047a2e8b4bd78b289eaf3ab0d4788f166915b52454b',20,2,NULL,'[]',0,'2020-07-09 15:53:38','2020-07-09 15:53:38','2021-07-09 15:53:38'),('ab1c0990a67bba1910c501e1d39796fe848fd9e79e80221f1c71fd11a31787f0902f9cda1fb3fb76',20,2,NULL,'[]',0,'2020-07-15 12:31:51','2020-07-15 12:31:51','2020-07-30 12:31:51'),('ad6a94faf64c758dd7765261d70fa81f340ed10bc1a7a59f6bd2666a72d6901f1dfb34e36014225b',20,2,NULL,'[]',0,'2020-07-05 11:41:10','2020-07-05 11:41:10','2021-07-05 11:41:10'),('b4ad5c81091bc0efef745da065e8aed98e61aebb73f13dc57602c99cec81ae27184f62757597e4bb',41,1,'Laravel Personal Access Client','[]',0,'2020-07-14 15:49:45','2020-07-14 15:49:45','2021-07-14 15:49:45'),('be322c990babd92e32b0d0688ff0b125897d0127c085e01da908cd51240fc654b34618d01e4b9a13',11,2,NULL,'[]',0,'2020-07-13 13:44:16','2020-07-13 13:44:16','2021-07-13 13:44:16'),('bed38769620dc0046a5a6905d74a108157f36a70e0d522fd33486b4e550333420877adbaf8d948d6',41,1,'Dan Tran','[]',0,'2020-08-20 14:10:25','2020-08-20 14:10:25','2021-02-20 14:10:23'),('c93c53156685def6e87ce6e81449766d5f1f3bfeb37944741415f0b1bd1ca3e9493bdaafa482529a',25,2,NULL,'[]',0,'2020-07-07 09:49:33','2020-07-07 09:49:33','2021-07-07 09:49:33'),('d63768831566571aa96f4a2d8d712e8b0f9c1b0f19aa55e2c590422cbc2f202469ae372a5807a3f4',20,2,NULL,'[]',0,'2020-07-06 10:47:01','2020-07-06 10:47:01','2021-07-06 10:47:01'),('da016926d8b2e59ff6aeff0e08abc1f0d4154c0a965ca44f2a98376dffb6766e6d0e27541a3f5ff5',20,2,NULL,'[]',0,'2020-07-08 12:48:42','2020-07-08 12:48:42','2021-07-08 12:48:42'),('dbeaf3e4fc191c0912a01927b079e1313dd0e59ab17a5b88a47bd7379d77ff8996748f4521eab4be',41,1,'Laravel Personal Access Client','[]',0,'2020-07-14 15:50:48','2020-07-14 15:50:48','2021-07-14 15:50:48'),('dc475cf2ba379bc6f3bc77a57eccd5d8d997254c9d2195c4bcc85e2d716ac963ccf9540e698da4ab',20,2,NULL,'[]',0,'2020-07-15 12:15:25','2020-07-15 12:15:25','2020-07-30 12:15:25'),('dcd4e320ee3b9b0a58deae89041690f2b176f1c73f7c0a120112d525d5d64ad363cf309a7189bac7',43,1,'Finder KW','[]',0,'2020-07-17 16:53:24','2020-07-17 16:53:24','2021-01-17 16:53:22'),('de3cdac3590ae9096078ce19798a9746d6487d2e3fd14d65054dcb10a27316d1436a94eca90069a4',20,2,NULL,'[]',0,'2020-07-15 12:17:46','2020-07-15 12:17:46','2020-07-30 12:17:45'),('def111b21291340a5efae0ca6f862ac01d3e8509686cf916193f9ea52e5c28ea9b8d2138b8fdd69f',41,1,'sdfsdfsdfsdfsdf','[]',0,'2020-07-14 15:51:21','2020-07-14 15:51:21','2021-07-14 15:51:21'),('e0a2f93d1f1e61b4d33adde1e3b9a39f54d148712e84e49bfb33b92753a0a49e0673012d290a5643',11,2,NULL,'[]',0,'2020-07-13 13:42:44','2020-07-13 13:42:44','2021-07-13 13:42:44'),('e391919689ecdf5e0a11bc900e5b15c8bf6917e8fdeb70acf66f980d3020cf0fe75ec8ca92aa8506',31,2,NULL,'[]',0,'2020-07-14 14:15:37','2020-07-14 14:15:37','2021-07-14 14:15:37'),('e7504756b16e6142b7a294595a6dddaecde96b162b487f4d9e6a17c42919798039108b85fce14c1e',20,2,NULL,'[]',0,'2020-07-06 15:08:20','2020-07-06 15:08:20','2021-07-06 15:08:20'),('ea8ceaa807437d418562fec5e6c413199a742a4836221562d48b28fbbaee6314a9d7cc5caf73415d',41,1,'Dan Tran','[]',0,'2020-07-14 15:53:42','2020-07-14 15:53:42','2021-07-14 15:53:42'),('eb7fe3dff54faf5a185fe07ecd7324cd59e3a17b1ce8ab11debb8ad34a991945d85817747ba8de88',7,2,NULL,'[]',0,'2020-07-13 14:09:09','2020-07-13 14:09:09','2021-07-13 14:09:09'),('ed626ad912c6a793b17de2c4098302dbde81a0dc1b74cc0c1b1186ae1ac2b968865fd5c893c7808b',20,2,NULL,'[]',0,'2020-07-18 08:36:14','2020-07-18 08:36:14','2020-08-02 08:36:13'),('ed963fd53ea912eea570847580929f0974f57fca359c81e609cdbe6a39a3003ac8a2b6f1f2d61d29',41,1,'Dan Tran','[]',0,'2020-07-15 13:21:03','2020-07-15 13:21:03','2021-01-15 13:21:01'),('f9bf3fde436bf62202232b4e0e142b539bc51ca662ff1c241012fde39ba062ec392c25db887f340a',41,1,'Dan Tran','[]',0,'2020-08-21 00:59:35','2020-08-21 00:59:35','2021-02-21 00:59:34'),('ffa10edbcf1d1524916228ed05066593ac06b546af4f1958a8068e7ef11f243cc623625460897e8b',20,2,NULL,'[]',0,'2020-07-07 09:47:35','2020-07-07 09:47:35','2021-07-07 09:47:35'),('ffb87d1372d28251ac2cfffc55c5fd817eee2e7366b5488d9a5f097fcc49fe63c5ed9d65c8daa06b',1,2,NULL,'[]',0,'2020-07-13 14:01:40','2020-07-13 14:01:40','2021-07-13 14:01:40');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Laravel Personal Access Client','179oLhxfzCdHd626tZHv4Md3K5YrLc30NMxFlL24',NULL,'http://localhost',1,0,0,'2020-07-02 16:57:01','2020-07-02 16:57:01'),(2,NULL,'Laravel Password Grant Client','SJSqMdPxm3rwiYmL2FNthRwGFid3krnB8SDWMdc0','users','http://localhost',0,1,0,'2020-07-02 16:57:01','2020-07-02 16:57:01');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2020-07-02 16:57:01','2020-07-02 16:57:01');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
INSERT INTO `oauth_refresh_tokens` VALUES ('017a9d8a6f031275f99d532bc430a01a72d03e19d7769a647610a8309e87293e8b99193a943eae82','e0a2f93d1f1e61b4d33adde1e3b9a39f54d148712e84e49bfb33b92753a0a49e0673012d290a5643',0,'2021-07-13 13:42:44'),('0f2ab9d8b2e22fe545fef341d24de7d6754303915e4dec1a743b8cdaf22e0de717e87d98d87178d3','9728ca1793501d94607f9f4cb7b553f470698047a2e8b4bd78b289eaf3ab0d4788f166915b52454b',0,'2021-07-09 15:53:38'),('1a8fc77cfa6a22daf3398d9e66d7f082781dbd9f3de897a3f3a4537265acf9ef857fdd30b85d3605','08bd29a6272c706f8692b50fb4708a21ab718162e80adb41109bedd93fd1aea56ed57f791cb07b9f',0,'2021-07-14 15:24:20'),('2638b2c191d47364ac42a56eb9d4bb3741474390ad8dda5640d9d7cc5e991a07caf7cd9fda62e628','14917201433b430cc0be2bcb90da635c30b00c0c6c9da05b4a327dcfcb91096845ed7c02f0219ea9',0,'2021-07-02 16:58:33'),('2df4bff8f62454533e4d4d646e88aa29c40c98b27b99ff5e60e8c6ee21cb8456cdd7104a99a229a9','54adc9bdc8044c3f857e710388c5763403630c78e879fc0f4e29e4af35a1b0efe6626490cc486f15',0,'2021-07-04 06:11:13'),('38ac6847e594b7775bfdfb801b06ac542a0e74407a7af4fd453e5322a8f492c6a7907a511a82b3eb','9238cfb1a81afcc16e82afd19d87551f94c0bd00c958ad41b522ee119f8d32ede716344519b4b7e6',0,'2021-07-12 11:33:13'),('3be2bae65ddd8e0e61d602853689d4e21e928bdf710323b60e56ea8d7c52ffa31519800eab7fe8ca','35607d3308cf7eaf339653e8bbde92ea91b38b7658757e7bf42d31f66d5ef0c7165c2c8cd89c6a22',0,'2021-07-03 14:24:28'),('587b6c17b011763bd4f8bba44881fe4d00a10f92d21ea00833bc7986ca4c6d3fe5fcce55e402163f','5cd2f58e938fe3016bcf87d85f9bba459f8bfff8fd6ff212a926fd35a50ee9c2fe6c5f2c086f2ffb',0,'2021-07-06 15:03:19'),('666c33a91131ea1da5990bd7365ca88918df43e6d41a6f28d083d4f6b1104fce4f7cbba178d265b1','56843e3ea14c4041726ca0451bf38824fce3b213d53ec92c2f0cbc7b981c156a8a764e7f300a4c3b',0,'2021-07-06 06:28:09'),('67e2ce6b3bd77931663cd71c05b594b71bb4fa47aa5e93c844d477ede460406bf1636ec47f02837c','0a4bd395df5c6e905046f4068136cb4d7505cd53a3acb7af10f858ba021378b8c0723bb60a733bdb',0,'2020-08-14 14:10:56'),('7f1a3a546daea5f8fe3bbd7c06e341152394e0fb4008eb37d55a01d6b21d274244a5deb42c5920ae','dc475cf2ba379bc6f3bc77a57eccd5d8d997254c9d2195c4bcc85e2d716ac963ccf9540e698da4ab',0,'2020-08-14 12:15:25'),('822b63dbfe0a9a9e8bcf5f3318931b2f6108b860c5bf39436195096fed62fda7c2e0915b47de37e4','84e74d35dbf4225813ac1b79599f28472197206d208abb87d179897708a709520ad592fea55aa1c7',0,'2021-07-06 14:57:37'),('8395f0723d23c5c144cb2e79ad9cf539f225d990c5329c903fade34b2494dddbd3780e4d07e012f5','e7504756b16e6142b7a294595a6dddaecde96b162b487f4d9e6a17c42919798039108b85fce14c1e',0,'2021-07-06 15:08:20'),('892b84043a2f3ba9ca962d3a68193c34f4c5f97dceefecf58979b7d463c486b21f91b3b636897550','30659c0aa5b4528ef90f10cc73beeb4163045e77e7a9ee7967e5014028d009e503ad8cab1fc46413',0,'2021-07-07 09:48:53'),('956fcef8e2330bd4bc7eac30c36c790084ef28af56338e007179f2abc6bd07625993df047e3a08bf','c93c53156685def6e87ce6e81449766d5f1f3bfeb37944741415f0b1bd1ca3e9493bdaafa482529a',0,'2021-07-07 09:49:33'),('96b9be79d080102013c9199816eb256f8c93b61367a0e88c4be7923b53bdefbc80838f690ffaf3ff','eb7fe3dff54faf5a185fe07ecd7324cd59e3a17b1ce8ab11debb8ad34a991945d85817747ba8de88',0,'2021-07-13 14:09:09'),('9a268c33c0b6ca094f146eb98ed8f8be07d3a80a61a7dcdc90e1d8505070a142edb312e2e35e83be','ffa10edbcf1d1524916228ed05066593ac06b546af4f1958a8068e7ef11f243cc623625460897e8b',0,'2021-07-07 09:47:35'),('a56e13f92c5bc3bc5763f01b9706fe6d2bd7f28df8bba35709b102e7e95211ebbbfd99c3d06beb35','ed626ad912c6a793b17de2c4098302dbde81a0dc1b74cc0c1b1186ae1ac2b968865fd5c893c7808b',0,'2020-08-17 08:36:13'),('a635048dc8077d557c5d884e177d59e2acbe5500045b29052621a31d23a9a8f03ef8c7054ba57828','de3cdac3590ae9096078ce19798a9746d6487d2e3fd14d65054dcb10a27316d1436a94eca90069a4',0,'2020-08-14 12:17:45'),('ad3081351d86f45b8c327d60125233004585db68b6d1b8ee511d4d8a5206cd6372080f39fda4cdd3','249e88287672146f790681859f3c77cd5df40c0f42f93372e675d6a8d03c4712a1db1d75387468ab',0,'2021-07-14 15:30:34'),('bad6c47be9431911b7691a3060ffd2f2164f93ba7967fd373f3ef1fc116355931099b0ec70587ebc','220ed1e8c96d177cda4b5e8b62295dd7bdacab9493ef0fdd384b989d530b5b763b5cb257618f70a3',0,'2021-07-09 14:43:45'),('c087e07c338521e82c2e26640af9e08594e418e512e199b579e181dd2e9a57abceb34449ad8833f9','da016926d8b2e59ff6aeff0e08abc1f0d4154c0a965ca44f2a98376dffb6766e6d0e27541a3f5ff5',0,'2021-07-08 12:48:42'),('c10ce4821294ba40ab8bcf423f54643ef0c074817321899bdf02144528049ada250ec6ac1fe1eb0d','ab1c0990a67bba1910c501e1d39796fe848fd9e79e80221f1c71fd11a31787f0902f9cda1fb3fb76',0,'2020-08-14 12:31:51'),('c2880f02d84178859f8fb431e616395ef9877b879f3b8463222c52ab9203fb028e3edee68aad8626','4a12ec1506463cd0dd23ca1ff539b66c459990a940195c076583d4ca24c347a72e22a3d3d6800ade',0,'2020-09-19 14:24:02'),('c2fdaf01f5ed0bf6a0595713b881d64e7b2fbf9be48476612b53f15cd17b6a5def04b14fe9c7d68e','76af1bc04e89c06b93d9b3315fdd54e0e147cea6772574ca40062f26131fe618deb4db03efe43bd9',0,'2021-07-13 13:13:43'),('c7a01181ed6dbf31657528f2554a73b64f95bb641d24927c82bbd6f802a20a422d2822d54f832f2c','6cb403ba2999a3b113243eb5cbb73846e4e78c38bd5de81b92e42681643318eacb61616c956b42c2',0,'2021-07-11 07:42:53'),('c9b612545b23e21ae5399f3b93a4568d62ae25797f17717b1a26155478b003452812456de4cb8f41','4897dafef3fa088823d0f90214b83d788a1c404da682c9c4d57e0f6c7f66bedc1b588fcb91da3428',0,'2021-07-04 15:51:37'),('ca1b47f5f4b2e662cbd8519f54aeacc4ed7ef22932ea4e73d59d4ed92a6164909f1a0e2515846fcf','7240bdd76d98620755bcbd85fec9350261dfce1945143385e410229bdc0b53161d68a6090f7ae553',0,'2020-08-16 16:48:24'),('cf3f125cbf505814bc5d5bb3bdfc7a4a50bfbe9a06817f1e5a0c5524229af06a8ead70d3369fb5a7','ffb87d1372d28251ac2cfffc55c5fd817eee2e7366b5488d9a5f097fcc49fe63c5ed9d65c8daa06b',0,'2021-07-13 14:01:40'),('d03134ea6b1fe7d08b7d5afb11c6d66691901d8bd8acfdffe372713b6c17a51628b7054f51193688','555cd020a82225a30d407c8d6602bc2e37d65b69599e6b9dc6cc8b66c77daccae9afc6a5d79db2d8',0,'2021-07-08 14:12:44'),('d3546a7bc21831a4032ebf24ad00eb2482aa99afb73ce4c1cffa2426505fde8a4c758ecd2b6c243b','867544713d31e943020fa6daef715ae4154801bd8ceaeceea786d9e1164d89691d2bcd62a173c211',0,'2021-07-14 15:28:22'),('d731f4526d6c6314a157ee56c607761f190d621c2d3272442a7485152532ef981b7bbc973f1c550f','69de46d6d869a5c1ef74096013f7f2d426178fdc24be971d0349f0606440aa04bff7f8eaaebcad22',0,'2021-07-14 14:08:07'),('d7cbd33e2b59a72dbe18048f4b5b36b4ff6868c65797529c54d075b9f122dcac4446f52ab42df794','d63768831566571aa96f4a2d8d712e8b0f9c1b0f19aa55e2c590422cbc2f202469ae372a5807a3f4',0,'2021-07-06 10:47:01'),('dd9576d8d2e0a1187f7370b3d7e4b612ad423ade9930c47c51a1351a0d87f0ff08b32371aa4178b6','55cd4cc57e0c4df7e29565fc728baab71c9791ff2bc940368c068b9b4d90b7171ddf9c0d8b57d99d',0,'2021-07-06 14:59:35'),('e2cdc38b1041d8a5d91ad5d7ed12b6f5d085fb45a0825ef6b48e28d7220996f4d6134a3eda2f8dcb','e391919689ecdf5e0a11bc900e5b15c8bf6917e8fdeb70acf66f980d3020cf0fe75ec8ca92aa8506',0,'2021-07-14 14:15:37'),('e331312182a50c296d6f51717b48dbe0dd0e2d64dfc7f010292c2f8958a4e918b29efda060882aeb','ad6a94faf64c758dd7765261d70fa81f340ed10bc1a7a59f6bd2666a72d6901f1dfb34e36014225b',0,'2021-07-05 11:41:10'),('e43307d852b429d27a62ec354f7d967d10ec7e5141e858fa76865d4db8c3757cc0e1a1a7315d532c','4e44efa18260ea439c408270a621edf431e81a46ec5eb571fefabf4dbbdc12a233004ba476338e05',0,'2021-07-06 06:13:10'),('e744eb828a14518b2541f36e8c1e4a3300416f0ed6911681d0556c8ea6f91055b6be863a99d68b53','3b79d1526e9cc7b0342c69a43d05115b9acb882620e19dfa2c99269b5c771914d9fb5c466efb2b26',0,'2021-07-14 15:35:13'),('eac3e85a881273cf591f207b076c64fec4c2dfbcd5b1a40abe5e910bba7af78263f807a83ffb937e','be322c990babd92e32b0d0688ff0b125897d0127c085e01da908cd51240fc654b34618d01e4b9a13',0,'2021-07-13 13:44:16'),('ed92f5799240089ebd4cec4bbac2aa7b2975998eff26ead80d3ab34ec3bcbdf1e4d3351ce21d1ebd','5d9bfe998f08812e2e5b405ace34b0b3832c1eb3bf24468799f7d1c4a4b5a0576fbca75255852bd9',0,'2021-07-08 14:16:31');
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_service`
--

DROP TABLE IF EXISTS `product_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_service` (
  `product_id` bigint unsigned NOT NULL,
  `service_id` bigint unsigned NOT NULL,
  KEY `product_service_product_id_foreign` (`product_id`),
  KEY `product_service_service_id_foreign` (`service_id`),
  CONSTRAINT `product_service_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_service`
--

LOCK TABLES `product_service` WRITE;
/*!40000 ALTER TABLE `product_service` DISABLE KEYS */;
INSERT INTO `product_service` VALUES (22,1),(22,2),(22,3),(24,1),(24,2),(24,3),(25,1),(25,2),(25,3),(28,2),(28,3),(27,1),(27,2),(27,3),(30,1),(30,2),(31,1),(32,1),(32,3),(33,3),(33,2),(34,2),(34,3),(36,2),(36,3),(37,3),(37,1),(38,2),(38,3),(39,1),(39,2),(40,2),(40,3),(42,2),(42,3),(43,3);
/*!40000 ALTER TABLE `product_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` tinytext COLLATE utf8mb4_unicode_ci,
  `long` tinytext COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `featured_image` bigint NOT NULL DEFAULT '0',
  `properties` json DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_user_id_foreign` (`user_id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (22,20,1,'Táo xanh bình thuận','tao-xanh-binh-thuan','táo xanh','0982490741',999000.00,'496 duong quãng hàm','10.83814','106.6844773','<p>sản phẩm chỉ trưng bày</p>',88,'[{\"key\": \"thuộc tính 1\", \"value\": \"giá trị 1\"}, {\"key\": \"thuộc tính 2\", \"value\": \"giá trị 2\"}, {\"key\": \"key ne\", \"value\": \"value ne\"}, {\"key\": \"Cách biển\", \"value\": \"250m\"}, {\"key\": \"vui thôi nha\", \"value\": \"ừ thì vui\"}]',1,'2020-06-09 15:26:48','2020-07-07 02:37:40'),(23,20,4,'sò điệp nướng mỡ hành','so-diep-nuong-mo-hanh','món này ngon thì thôi rồi bạn ơi','0982490741',999000.00,'496 duong quãng hàm','10.83814','106.6844773','<p>nội dung sò điệp nướng mỡ hành</p>',100,'[{\"key\": \"thuộc tính 3\", \"value\": \"giá trị 3\"}, {\"key\": \"Cách biển\", \"value\": \"500m\"}, {\"key\": \"Hồ bơi\", \"value\": \"không\"}, {\"key\": \"Có vui hay khong\", \"value\": \"vui lắm bạn ơi\"}, {\"key\": \"nhận dạng\", \"value\": \"hàng cứng cáp lắm nhé\"}]',1,'2020-06-09 17:11:17','2020-07-07 02:38:09'),(24,20,3,'test lại lần nữa','test-lai-lan-nua','mô tả bài viết','0982390731',999000.00,'496 duong quãng hàm','10.8305987','106.6840686','<p>tét content</p>',107,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',1,'2020-07-03 14:26:03','2020-07-07 02:42:22'),(25,20,1,'Tôm Hùm Bông La Gàn','tom-hum-bong-la-gan','bạn đang thèm tôm hùm, vậy thì hãy để chúng tôi phục vụ','0982390731',500000.00,'496 duong quãng hàm','10.8305987','106.6840686','tét content',112,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-11 07:45:57','2020-07-11 07:46:01'),(27,20,1,'Đồng Hồ Nữ Daniel Wellington Classic Petite RoseWater DW00100319 (size 28mm)','dong-ho-nu-daniel-wellington-classic-petite-rosewater-dw00100319-size-28mm','Đồng Hồ Nữ Daniel Wellington Classic Petite RoseWater DW00100319 (size 28mm)','0982390731',999000.00,'496 duong quãng hàm','10.8305987','106.6840686','<p>tét content</p>',121,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',1,'2020-07-11 07:59:13','2020-07-11 08:04:06'),(28,20,1,'Đồng Hồ Nam Daniel Wellington Classic Black Roselyn DW00100270 (size: 40 mm)','dong-ho-nam-daniel-wellington-classic-black-roselyn-dw00100270-size-40-mm','Đồng Hồ Nam Daniel Wellington Classic Black Roselyn DW00100270 (size: 40 mm)','0982390731',999000.00,'496 duong quãng hàm','10.8305987','106.6840686','<p>tét content</p>',119,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',1,'2020-07-11 08:02:42','2020-07-11 08:03:46'),(30,20,1,'Iphone 12 Pro Max 128GB','iphone-12-pro-max-128gb','Iphone 12 Pro Max 128GB','0982390731',9999999.99,'496 duong quãng hàm','10.8305987','106.6840686','tét content',126,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-11 08:08:14','2020-07-11 08:08:15'),(31,20,1,'Iphone 12 Plus 64GB','iphone-12-plus-64gb','Iphone 12 Plus 64GB','0982390731',1599000.00,'496 duong quãng hàm','10.8305987','106.6840686','tét content',127,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-11 08:09:44','2020-07-11 08:09:45'),(32,20,1,'Iphone 12 độ nhạy màn hình 120Hz','iphone-12-do-nhay-man-hinh-120hz','Iphone 12 độ nhạy màn hình 120Hz','0982390731',9999999.99,'496 duong quãng hàm','10.8305987','106.6840686','tét content',129,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-11 08:17:40','2020-07-11 08:17:40'),(33,20,1,'Iphone 12 60HZ','iphone-12-60hz','Iphone 12 60HZ','0982390731',199999999.99,'496 duong quãng hàm','10.8305987','106.6840686','tét content',131,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-11 08:18:55','2020-07-11 08:18:57'),(34,20,1,'Siêu Thịt Tôm Hùm','sieu-thit-tom-hum','Siêu Thịt Tôm Hùm','0982390731',999000.00,'496 duong quãng hàm','10.8305987','106.6840686','tét content',132,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-11 08:39:58','2020-07-11 08:40:01'),(35,20,1,'Diệt sạch Tôm Hùm Đất với giá cực ưu đãi tại nhà hàng A Mào','diet-sach-tom-hum-dat-voi-gia-cuc-uu-dai-tai-nha-hang-a-mao','Diệt sạch Tôm Hùm Đất với giá cực ưu đãi tại nhà hàng A Mào','0982390731',999000.00,'496 duong quãng hàm','10.8305987','106.6840686','tét content',133,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-11 08:49:33','2020-07-11 08:49:34'),(36,20,1,'đến Quảng Ngãi bạn nhất định phải tự thưởng cho mình tô mỳ Quảng ngon tuyệt nhé','den-quang-ngai-ban-nhat-dinh-phai-tu-thuong-cho-minh-to-my-quang-ngon-tuyet-nhe','đến Quảng Ngãi bạn nhất định phải tự thưởng cho mình tô mỳ Quảng ngon tuyệt nhé','0982390731',30000.00,'496 duong quãng hàm','10.8305987','106.6840686','tét content',134,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-11 08:51:34','2020-07-11 08:51:35'),(37,41,1,'Cá Bống Sông Trà rim/kho tiêu','ca-bong-song-tra-rimkho-tieu','Cá Bống Sông Trà rim/kho tiêu','0982390731',50000.00,'496 duong quãng hàm','10.8305987','106.6840686','tét content',135,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-11 08:55:50','2020-07-11 08:55:50'),(38,41,1,'Kẹo gương Quãng Ngãi','keo-guong-quang-ngai','Kẹo gương Quãng Ngãi','0982390731',75000.00,'496 duong quãng hàm','10.8305987','106.6840686','tét content',136,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-11 08:57:42','2020-07-11 08:57:43'),(39,41,1,'Iphone 12 nè','iphone-12-ne','tên sản phẩm 4','0982390731',999000.00,'769 Quang Trung, P. 12, Q. Gò Vấp','10.8305987','106.6840686','tét content',151,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-15 14:49:41','2020-07-15 14:49:43'),(40,41,1,'Tôm Hùm Bông La Gàn','tom-hum-bong-la-gan','Tôm Hùm Bông La Gàn','0982390731',500000.00,'769 Quang Trung, P. 12, Q. Gò Vấp','10.8417382','106.6437372','tét content',153,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-15 14:53:13','2020-07-15 14:53:13'),(42,41,1,'create product nè','create-product-ne','create product nè','1900 6005',500000.00,'769 Quang Trung, P. 12, Q. Gò Vấp','10.8305987','106.6840686','tét content',156,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-15 15:05:53','2020-07-15 15:05:54'),(43,41,1,'test lại lần nữa 1','test-lai-lan-nua-1','test lại lần nữa 1','0982390731',50000.00,'769 Quang Trung, P. 12, Q. Gò Vấp','10.8417382','106.6437372','tét content',157,'[{\"key\": \"Chiều cao\", \"value\": \"1m55\"}, {\"key\": \"Cân nặng\", \"value\": \"45kg\"}, {\"key\": \"Giờ hoạt động\", \"value\": \"10h-24h\"}]',0,'2020-07-15 15:11:50','2020-07-15 15:11:52');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `read_notification_at`
--

DROP TABLE IF EXISTS `read_notification_at`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `read_notification_at` (
  `reader` bigint unsigned NOT NULL,
  `read_at` timestamp NOT NULL,
  KEY `read_notification_at_reader_foreign` (`reader`),
  CONSTRAINT `read_notification_at_reader_foreign` FOREIGN KEY (`reader`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `read_notification_at`
--

LOCK TABLES `read_notification_at` WRITE;
/*!40000 ALTER TABLE `read_notification_at` DISABLE KEYS */;
INSERT INTO `read_notification_at` VALUES (41,'2020-08-21 01:09:09'),(42,'2020-08-21 01:09:09');
/*!40000 ALTER TABLE `read_notification_at` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `properties` json NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reports_user_id_foreign` (`user_id`),
  KEY `reports_product_id_foreign` (`product_id`),
  CONSTRAINT `reports_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (4,19,22,'mô tả nguyên nhân reports','[{\"key\": \"Giá hợp lý\", \"value\": \"7\"}, {\"key\": \"Sản phẩm như hình\", \"value\": \"7\"}, {\"key\": \"Shop vui vẻ\", \"value\": \"7\"}, {\"key\": \"Giao hàng nhanh\", \"value\": \"7\"}, {\"key\": \"Nhân viên vui vẻ\", \"value\": \"7\"}]',1,'2020-06-09 15:56:53','2020-06-09 15:56:53'),(5,20,22,'tét report nà','[{\"key\": \"Giá hợp lý\", \"value\": \"7\"}, {\"key\": \"Sản phẩm như hình\", \"value\": \"7\"}, {\"key\": \"Shop vui vẻ\", \"value\": \"7\"}, {\"key\": \"Giao hàng nhanh\", \"value\": \"7\"}, {\"key\": \"Nhân viên vui vẻ\", \"value\": \"7\"}]',1,'2020-06-09 16:09:21','2020-06-09 16:09:21'),(6,18,22,'test report nhé','[{\"key\": \"Giá hợp lý\", \"value\": \"7\"}, {\"key\": \"Sản phẩm như hình\", \"value\": \"7\"}, {\"key\": \"Shop vui vẻ\", \"value\": \"7\"}, {\"key\": \"Giao hàng nhanh\", \"value\": \"7\"}, {\"key\": \"Nhân viên vui vẻ\", \"value\": \"7\"}]',1,'2020-06-09 16:15:22','2020-06-09 16:15:22'),(7,16,22,'như 1 cục cức luôn','[{\"key\": \"Giá hợp lý\", \"value\": \"7\"}, {\"key\": \"Sản phẩm như hình\", \"value\": \"7\"}, {\"key\": \"Shop vui vẻ\", \"value\": \"7\"}, {\"key\": \"Giao hàng nhanh\", \"value\": \"7\"}, {\"key\": \"Nhân viên vui vẻ\", \"value\": \"7\"}]',1,'2020-06-09 16:58:23','2020-06-09 16:58:23'),(8,10,22,'vui vẻ hiền lành thân thiện','[{\"key\": \"Giá hợp lý\", \"value\": \"7\"}, {\"key\": \"Sản phẩm như hình\", \"value\": \"7\"}, {\"key\": \"Shop vui vẻ\", \"value\": \"7\"}, {\"key\": \"Giao hàng nhanh\", \"value\": \"7\"}, {\"key\": \"Nhân viên vui vẻ\", \"value\": \"7\"}]',1,'2020-06-09 17:08:24','2020-06-09 17:08:24'),(9,20,23,'sò hôi vãi cái lồn luôn ý','[{\"key\": \"Giá hợp lý\", \"value\": \"7\"}, {\"key\": \"Sản phẩm như hình\", \"value\": \"7\"}, {\"key\": \"Shop vui vẻ\", \"value\": \"7\"}, {\"key\": \"Giao hàng nhanh\", \"value\": \"7\"}, {\"key\": \"Nhân viên vui vẻ\", \"value\": \"7\"}]',1,'2020-06-09 17:15:02','2020-06-09 17:15:02'),(10,20,37,'test report','[{\"key\": \"Đánh giá 1\", \"value\": 9}, {\"key\": \"Đánh giá 2\", \"value\": 8}, {\"key\": \"Đánh giá 3\", \"value\": 10}]',1,'2020-07-12 06:07:06','2020-07-12 06:07:06'),(11,20,37,'thêm 1 report','[{\"key\": \"Đánh giá 1\", \"value\": 10}, {\"key\": \"Đánh giá 2\", \"value\": 9}, {\"key\": \"Đánh giá 3\", \"value\": 10}]',1,'2020-07-12 06:08:33','2020-07-12 06:08:33'),(12,6,38,'viết report cho bài viết này thử','[{\"key\": \"Đánh giá 1\", \"value\": 9}, {\"key\": \"Đánh giá 2\", \"value\": 10}, {\"key\": \"Đánh giá 3\", \"value\": 9}]',1,'2020-07-12 11:33:49','2020-07-12 11:33:49'),(13,6,37,'thử gửi report mới id 37','[{\"key\": \"Đánh giá 1\", \"value\": 9}, {\"key\": \"Đánh giá 2\", \"value\": 8}, {\"key\": \"Đánh giá 3\", \"value\": 1}]',1,'2020-07-12 12:24:09','2020-07-12 12:24:09'),(16,41,40,'sản phẩm này hay bị lỗi quá','[{\"key\": \"Đánh giá 1\", \"value\": 3}, {\"key\": \"Đánh giá 2\", \"value\": 3}, {\"key\": \"Đánh giá 3\", \"value\": 3}]',1,'2020-08-20 14:19:37','2020-08-20 14:19:37');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Tắm bùn',NULL,NULL),(2,'Tắm biển',NULL,NULL),(3,'Ăn bánh tráng trộn',NULL,NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_accounts`
--

DROP TABLE IF EXISTS `social_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `social_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_accounts`
--

LOCK TABLES `social_accounts` WRITE;
/*!40000 ALTER TABLE `social_accounts` DISABLE KEYS */;
INSERT INTO `social_accounts` VALUES (12,41,'116754504274350776119','google','Dan Tran','2020-07-14 15:35:12','2020-07-14 15:35:12'),(13,43,'115689329622081915575','google','Finder KW','2020-07-17 16:53:24','2020-07-17 16:53:24');
/*!40000 ALTER TABLE `social_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'checker',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Estrella McKenzie','fgoldner@example.org','2020-06-09 15:14:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','n915RP37Wd','2020-06-09 15:14:19','2020-06-09 15:14:19'),(2,'Mr. Edwardo Macejkovic','fannie.towne@example.org','2020-06-09 15:14:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','KpfC6m5IXv','2020-06-09 15:14:19','2020-06-09 15:14:19'),(3,'Carmen Cartwright','dschulist@example.com','2020-06-09 15:14:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','pLoMZphpTD','2020-06-09 15:14:19','2020-06-09 15:14:19'),(4,'Mateo Greenfelder','timmothy98@example.com','2020-06-09 15:14:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','QrK8lNvd0B','2020-06-09 15:14:19','2020-06-09 15:14:19'),(5,'Dr. Nelson Bosco','ikreiger@example.org','2020-06-09 15:14:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','ovfg7Zw1kh','2020-06-09 15:14:19','2020-06-09 15:14:19'),(6,'Prof. Princess O\'Conner III','ihessel@example.net','2020-06-09 15:14:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','52yp1aam7v','2020-06-09 15:14:19','2020-06-09 15:14:19'),(7,'Koby Lowe I','catharine40@example.org','2020-06-09 15:14:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','eBMWUEZg4f','2020-06-09 15:14:19','2020-06-09 15:14:19'),(8,'Miss Peggie Hermiston','dashawn96@example.com','2020-06-09 15:14:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','wwczRN2MKl','2020-06-09 15:14:19','2020-06-09 15:14:19'),(9,'May Padberg Sr.','cleo.powlowski@example.org','2020-06-09 15:14:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','r3EwohmseT','2020-06-09 15:14:19','2020-06-09 15:14:19'),(10,'Chloe Ankunding','rosenbaum.tremayne@example.com','2020-06-09 15:14:19','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','f3jpJww2zA','2020-06-09 15:14:19','2020-06-09 15:14:19'),(11,'Rebeca Pfannerstill DDS','hyatt.madelynn@example.com','2020-06-09 15:23:20','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','gfxirFIXD0','2020-06-09 15:23:20','2020-06-09 15:23:20'),(12,'Leonel Yundt V','ernser.cesar@example.org','2020-06-09 15:23:20','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','zlMldWwxYG','2020-06-09 15:23:20','2020-06-09 15:23:20'),(13,'Ulices Windler','astrid07@example.org','2020-06-09 15:23:20','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','n2tKqw2nXw','2020-06-09 15:23:20','2020-06-09 15:23:20'),(14,'Mr. Jaleel Murazik','nathan.hoppe@example.com','2020-06-09 15:23:20','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','USDPRTbAQ2','2020-06-09 15:23:20','2020-06-09 15:23:20'),(15,'Miss Daniela Cummerata','utreutel@example.com','2020-06-09 15:23:20','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','RvP33p0Lfq','2020-06-09 15:23:20','2020-06-09 15:23:20'),(16,'Estell Kassulke','zula10@example.net','2020-06-09 15:23:20','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','YPbuWkPP5U','2020-06-09 15:23:20','2020-06-09 15:23:20'),(17,'Libbie Windler','geovany48@example.com','2020-06-09 15:23:20','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','5rL41csU0C','2020-06-09 15:23:20','2020-06-09 15:23:20'),(18,'Gerson Volkman','gennaro03@example.org','2020-06-09 15:23:20','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','LsN2Zt6kV9','2020-06-09 15:23:20','2020-06-09 15:23:20'),(19,'Dr. Juanita Rowe','collin65@example.net','2020-06-09 15:23:20','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','checker','P7EjJOk1A4','2020-06-09 15:23:20','2020-06-09 15:23:20'),(20,'Reyes Brown DVM','thanhdanpc@gmail.com','2020-06-09 15:23:20','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','super-admin','Ktmjw1l2vOXfINQHRHllfEAPmrk7ZLBYHViTsvxd9SoIsSy90oaXeq3SqMmF','2020-06-09 15:23:20','2020-06-09 15:23:20'),(21,'Tran Dan','thanhdanhihi@gmail.com',NULL,'$2y$10$l0d7uFcy2v5d4ziNBSUMqeCpH.Fj1SBYy7NSvfx5.qUOy05IpyJJG','checker',NULL,'2020-07-04 15:51:02','2020-07-04 15:51:02'),(25,'Trần Thanh Dân','thanhdan26081994434@gmail.com',NULL,'$2y$10$QGdkTBnb/8T0sriwiQ4bp.ARobmt/6.c5i.w2Vf6eH0PgZZkh50CK','checker',NULL,'2020-07-05 08:29:06','2020-07-05 08:29:06'),(26,'Táo xanh bình thuận','thanhdan2608199@gmail.com',NULL,'$2y$10$YUuDgW0H0JmZg.wXfjqhzusmIKpwnOigYuK65tr4E6Ais.xJ.rKLu','checker',NULL,'2020-07-05 10:37:09','2020-07-05 10:37:09'),(27,'Đà Nẵng','superadmin@example.com',NULL,'$2y$10$PLh/QDmfvSDkCuiIl69Ye.FXX6huug4TgamoJHUj3nNpBHyahXcd.','checker',NULL,'2020-07-05 11:38:43','2020-07-05 11:38:43'),(41,'Dan Tran','thanhdan26081994@gmail.com',NULL,'$2y$10$oBugFfRQhPon6qGXVCryCe9T.ndDx3C3E25jKYWO4u8HPYFLPNYXi','checker',NULL,'2020-07-14 15:35:12','2020-07-14 15:35:12'),(42,'Trần Thanh Dân','thanhdanpc1994@gmail.com',NULL,'$2y$10$T2vrT7TY1AtYFrs/ZBGzWO5C1vYj.zgKYSQIeCpPAB1gxllA8VMve','checker',NULL,'2020-07-15 12:07:05','2020-07-15 12:07:05'),(43,'Finder KW','kwfinder90@gmail.com',NULL,'$2y$10$UhihKN2hkzTe5RwIJHuouuv4U28qDSRNdRM8Xy8faB6Mu03qYZKnS','checker',NULL,'2020-07-17 16:53:24','2020-07-17 16:53:24');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-21 10:28:53
