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
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025_12_22_213336_create_stores_table',1),(2,'2025_12_22_213337_create_console_types_table',1),(3,'2025_12_22_213337_create_consoles_table',1),(4,'2025_12_22_213338_create_articles_table',1),(5,'2025_12_22_213338_create_mods_table',1),(6,'2025_12_22_213339_create_invoices_table',1),(7,'2025_12_23_191038_create_console_store_prices_table',1),(8,'2025_12_24_083622_create_console_store_table',1),(9,'2025_12_24_140435_create_users_table',1),(10,'2025_12_24_140504_create_password_reset_tokens_table',1),(11,'2025_12_24_140529_create_sessions_table',1),(12,'2025_12_27_213119_create_console_returns_table',1),(13,'2025_12_28_085455_fix_console_returns_status_column',1),(14,'2025_12_28_090058_add_admin_comment_to_console_returns',1),(15,'2025_12_28_114128_create_repair_quotes_table',1),(16,'2025_12_28_162450_add_status_comment_to_consoles_table',1),(17,'2025_12_28_163319_add_status_comment_to_consoles_table',1),(18,'2025_12_28_200411_extend_consoles_table',1),(19,'2025_12_30_170619_make_store_id_nullable_on_consoles',1),(20,'2025_12_30_221731_make_store_id_nullable_on_consoles_table',1),(21,'2026_01_04_140925_create_article_categories_table',1),(22,'2026_01_04_141007_create_article_sub_categories_table',1),(23,'2026_01_04_141026_create_article_types_table',1),(24,'2026_01_04_142403_add_article_relations_to_consoles_table',1),(25,'2026_01_06_193007_make_console_type_id_nullable',1),(26,'2026_01_06_194446_make_console_type_id_nullable_on_consoles',1),(27,'2026_01_06_201557_drop_console_type_id_from_consoles_table',1),(28,'2026_01_08_203116_create_repairers_table',1),(29,'2026_01_09_095117_add_deleted_at_to_repairers_table',1),(30,'2026_01_09_102302_add_repairer_id_to_consoles_table',1),(31,'2026_01_11_130000_drop_identite_reparateur_from_consoles_table',1),(32,'2026_01_11_141500_add_columns_to_password_reset_tokens_table',1),(33,'2026_01_11_163500_make_store_id_nullable_on_consoles',1),(34,'2026_01_11_180000_add_repairer_id_to_console_returns_table',1),(35,'2026_01_11_184500_add_acknowledged_to_console_returns_table',1),(36,'2026_01_11_190000_create_console_offers_table',1),(37,'2026_01_11_190500_create_store_lot_requests_table',1),(38,'2026_01_11_200000_add_sold_at_to_consoles_table',1),(39,'2026_01_11_210000_make_console_id_nullable_in_console_returns_table',1),(40,'2026_01_11_214300_make_console_id_nullable_in_repair_quotes_table',1),(41,'2026_01_13_195621_refactor_mods_table',1),(42,'2026_01_13_195648_create_mod_compatibilities_table',1),(43,'2026_01_13_195730_create_console_mod_table',1),(44,'2026_01_13_200643_update_mods_add_quantity_remove_price',1),(45,'2026_01_13_201017_create_mod_repairer_table',1),(46,'2026_01_15_215000_create_admin_user',1),(47,'2026_01_15_220500_ensure_sessions_table_exists',1),(48,'2026_01_17_120000_add_work_time_to_console_mod_table',1),(49,'2026_01_17_130000_add_repairer_id_to_users_table',1),(50,'2026_01_17_140000_add_is_operation_to_mods_table',1),(51,'2026_01_17_150000_create_repairer_operations_table',1),(52,'2026_01_18_130107_add_additional_fields_to_stores_table',1),(53,'2026_01_18_131446_add_consignment_price_to_console_store_prices',1),(54,'2026_01_18_131818_add_consignment_price_to_console_offers_table',1),(55,'2026_01_18_134622_make_description_nullable_in_mods_table',1),(56,'2026_01_18_140431_add_valorisation_to_mods_table',1),(57,'2026_01_18_154406_add_assignment_status_to_consoles_table',1),(58,'2026_01_18_154815_add_to_ship_status_to_assignment_status',1),(59,'2026_01_18_155419_add_destination_store_to_consoles_table',1),(60,'2026_01_18_194837_add_product_details_to_consoles_table',1),(61,'2026_01_18_195306_add_product_details_to_article_types_table',1),(62,'2026_01_18_200811_create_product_sheets_table',1),(63,'2026_01_20_195247_add_condition_criteria_to_product_sheets_table',1),(64,'2026_01_20_202650_create_game_boy_games_table',1),(65,'2026_01_22_204641_add_product_sheet_id_to_consoles_table',1),(66,'2026_01_22_211504_add_cloudinary_url_to_gameboy_games_table',1),(67,'2026_01_23_105245_add_featured_mods_to_product_sheets_table',1),(68,'2026_01_23_110816_add_icon_to_mods_table',1),(69,'2026_01_23_113442_modify_icon_column_in_mods_table',1),(70,'2026_01_23_120212_fix_mods_icon_column_to_text',1),(71,'2026_01_24_171448_create_feature_requests_table',1),(72,'2026_01_24_172610_add_admin_response_to_feature_requests_table',1),(73,'2026_01_24_173530_create_article_brands_table',1),(74,'2026_01_24_173600_add_brand_id_to_article_sub_categories_table',1),(75,'2026_01_25_142411_add_region_to_consoles_table',1),(76,'2026_01_25_142754_add_completeness_to_consoles_table',1),(77,'2026_01_25_154715_add_language_to_consoles_table',1),(78,'2026_01_25_201331_add_publisher_to_article_types_table',1),(79,'2026_01_25_203402_add_publisher_to_consoles_table',1),(80,'2026_01_25_205057_add_images_to_article_types_table',1),(81,'2026_01_26_150408_add_rom_id_to_consoles_table',1),(82,'2026_01_26_150741_add_year_to_consoles_table',1),(83,'2026_01_26_191413_add_publisher_to_game_boy_games_table',1),(84,'2026_01_27_101419_update_source_enum_in_game_boy_games_table',1),(85,'2026_01_27_140546_add_artwork_image_to_article_types_table',1),(86,'2026_01_27_add_rom_id_to_article_types',1),(87,'2026_01_28_000001_create_snes_games_table',1),(88,'2026_01_28_000002_add_cartridge_id_to_snes_games',1),(89,'2026_01_28_110728_increase_cartridge_id_length_in_snes_games',1),(90,'2026_01_28_120000_add_superfamicom_to_snes_games_source',1),(91,'2026_01_28_141514_create_nes_games_table',1),(92,'2026_01_28_141850_add_image_path_to_snes_games_table',1),(93,'2026_01_28_142117_create_game_gear_games_table',1),(95,'2026_01_28_143330_create_n64_games_table',2),(96,'2026_01_28_184601_swap_rom_id_and_cartridge_id_in_snes_games',3),(97,'2026_01_30_000000_remove_unused_image_columns',3),(98,'2026_01_31_083335_create_wonderswan_games_table',4),(99,'2026_01_31_090136_create_sega_saturn_games_table',5),(100,'2026_01_31_092741_update_sega_saturn_games_image_format',6),(101,'2026_01_31_093412_create_mega_drive_games_table',7),(102,'2026_01_31_102221_swap_snes_rom_id_and_cartridge_id',8),(103,'2026_01_31_103240_create_publishers_table',9),(104,'2026_01_31_104048_add_alternate_names_to_game_tables',10),(105,'2026_01_31_205015_add_article_images_to_consoles_table',11),(106,'2026_02_08_092227_add_wonderswan_subcategories_to_bandai',12),(107,'2026_02_08_173710_fix_taxonomy_encoding_non_games',13),(108,'2026_02_08_174208_fix_console_types_encoding',14),(109,'2026_02_08_204427_add_article_brand_id_to_consoles_table',15),(110,'2026_02_08_204524_populate_article_brand_id_in_consoles',16),(111,'2026_02_09_154701_add_can_create_articles_to_repairers_table',17),(112,'2026_02_10_135346_add_article_images_to_consoles_table',18),(113,'2026_02_10_135742_add_primary_image_and_captions_to_consoles_table',19),(114,'2026_02_10_190352_add_condition_criteria_labels_to_product_sheets_table',20),(115,'2026_02_11_124424_add_display_sections_to_product_sheets_table',21);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
