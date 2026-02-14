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
-- Table structure for table `mega_drive_games`
--

DROP TABLE IF EXISTS `mega_drive_games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mega_drive_games` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rom_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternate_names` text COLLATE utf8mb4_unicode_ci,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` enum('libretro','manual') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'libretro',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mega_drive_games_rom_id_unique` (`rom_id`),
  FULLTEXT KEY `name_search` (`name`,`alternate_names`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mega_drive_games`
--

LOCK TABLES `mega_drive_games` WRITE;
/*!40000 ALTER TABLE `mega_drive_games` DISABLE KEYS */;
INSERT INTO `mega_drive_games` VALUES (1,NULL,'Streets of Rage 2 (USA)',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:40:57','2026-01-31 08:40:57'),(2,NULL,'Golden Axe (World)','Kinen Axe (World)',NULL,NULL,NULL,'World',NULL,NULL,'libretro','2026-01-31 08:40:57','2026-01-31 08:40:57'),(3,NULL,'Castlevania - Bloodlines (USA)',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:40:58','2026-01-31 08:40:58'),(4,NULL,'Shinobi III - Return of the Ninja Master (USA)',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:40:59','2026-01-31 08:40:59'),(5,NULL,'Phantasy Star IV (USA)',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:40:59','2026-01-31 08:40:59'),(6,NULL,'Aladdin (USA)',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:40:59','2026-01-31 08:40:59'),(7,NULL,'Earthworm Jim (USA)',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:41:00','2026-01-31 08:41:00'),(8,NULL,'Mortal Kombat (World)',NULL,NULL,NULL,NULL,'World',NULL,NULL,'libretro','2026-01-31 08:41:01','2026-01-31 08:41:01'),(9,NULL,'007 Shitou   The Duel Japan',NULL,NULL,NULL,NULL,'Japan',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(10,NULL,'10 Super Jogos Brazil En',NULL,NULL,NULL,NULL,'Brazil',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(11,NULL,'10 Super Jogos Brazil',NULL,NULL,NULL,NULL,'Brazil',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(12,NULL,'16 Zhang Ma Jiang China Unl',NULL,NULL,NULL,NULL,'China',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(13,NULL,'16t Japan Game no Kanzume Otokuyou',NULL,NULL,NULL,NULL,'Japan',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(14,NULL,'16t Japan Game no Kanzume Vol 2',NULL,NULL,NULL,NULL,'Japan',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(15,NULL,'16t Japan SegaNet',NULL,NULL,NULL,NULL,'Japan',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(16,NULL,'2020 Nen Super Baseball Japan',NULL,NULL,NULL,NULL,'Japan',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(17,NULL,'3 Ninjas Kick Back USA','3 Ninjas Yellowck Back USA',NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(18,NULL,'3 in1 Super HangON   World Chhamp Soccer   Columns',NULL,NULL,NULL,NULL,'World',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(19,NULL,'Aladdin USA',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(20,NULL,'Castlevania   Bloodlines USA',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(21,NULL,'Earthworm Jim USA',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(22,NULL,'Golden Axe World','Kinen Axe World',NULL,NULL,NULL,'World',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(23,NULL,'Mortal Kombat World',NULL,NULL,NULL,NULL,'World',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(24,NULL,'Phantasy Star IV USA',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(25,NULL,'Shinobi III   Return of the Ninja Master USA',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44'),(26,NULL,'Streets of Rage 2 USA',NULL,NULL,NULL,NULL,'USA',NULL,NULL,'libretro','2026-01-31 08:41:44','2026-01-31 08:41:44');
/*!40000 ALTER TABLE `mega_drive_games` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-14 20:57:14
