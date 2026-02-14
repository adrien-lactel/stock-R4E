-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: stock_r4e
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `article_brands`
--

DROP TABLE IF EXISTS `article_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `article_brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `article_category_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_brands_article_category_id_foreign` (`article_category_id`),
  CONSTRAINT `article_brands_article_category_id_foreign` FOREIGN KEY (`article_category_id`) REFERENCES `article_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_brands`
--

LOCK TABLES `article_brands` WRITE;
/*!40000 ALTER TABLE `article_brands` DISABLE KEYS */;
INSERT INTO `article_brands` VALUES (1,1,'Nintendo','2026-01-25 14:55:33','2026-01-25 14:55:33'),(2,1,'Sony','2026-01-25 14:55:33','2026-01-25 14:55:33'),(3,1,'Microsoft','2026-01-25 14:55:34','2026-01-25 14:55:34'),(4,1,'Sega','2026-01-25 14:55:34','2026-01-25 14:55:34'),(5,1,'Atari','2026-01-25 14:55:34','2026-01-25 14:55:34'),(6,1,'NEC','2026-01-25 14:55:34','2026-01-25 14:55:34'),(7,1,'SNK','2026-01-25 14:55:34','2026-01-25 14:55:34'),(8,1,'Autres','2026-01-25 14:55:34','2026-01-25 14:55:34'),(9,12,'Pokémon','2026-01-25 15:48:10','2026-01-25 15:48:10'),(10,13,'Nintendo','2026-01-25 21:20:34','2026-01-25 21:20:34'),(11,13,'Sony','2026-01-25 21:20:34','2026-01-25 21:20:34'),(12,13,'Microsoft','2026-01-25 21:20:34','2026-01-25 21:20:34'),(13,13,'Sega','2026-01-25 21:20:34','2026-01-25 21:20:34'),(14,13,'Atari','2026-01-25 21:20:34','2026-01-25 21:20:34'),(15,13,'NEC','2026-01-25 21:20:34','2026-01-25 21:20:34'),(16,13,'SNK','2026-01-25 21:20:34','2026-01-25 21:20:34'),(17,13,'Autres','2026-01-25 21:20:34','2026-01-25 21:20:34'),(18,14,'Nintendo','2026-01-25 21:20:35','2026-01-25 21:20:35'),(19,14,'Sony','2026-01-25 21:20:35','2026-01-25 21:20:35'),(20,14,'Microsoft','2026-01-25 21:20:35','2026-01-25 21:20:35'),(21,14,'Sega','2026-01-25 21:20:35','2026-01-25 21:20:35'),(22,14,'Atari','2026-01-25 21:20:35','2026-01-25 21:20:35'),(23,14,'NEC','2026-01-25 21:20:35','2026-01-25 21:20:35'),(24,14,'SNK','2026-01-25 21:20:35','2026-01-25 21:20:35'),(25,14,'Autres','2026-01-25 21:20:35','2026-01-25 21:20:35'),(27,1,'Bandai','2026-02-07 09:30:09','2026-02-07 09:30:09'),(28,14,'Bandai','2026-02-07 09:35:57','2026-02-07 09:35:57');
/*!40000 ALTER TABLE `article_brands` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-14 20:52:10
