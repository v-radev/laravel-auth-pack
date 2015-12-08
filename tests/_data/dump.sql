-- MySQL dump 10.13  Distrib 5.6.19, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	5.6.19-0ubuntu0.14.04.1-log

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  UNIQUE KEY `cache_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravelpermissions_admin','eyJpdiI6IlpPeUtBRWV5UWZIWkQ4WUlZMWpKcEE9PSIsInZhbHVlIjoiMU8yYTRpWldWeERPczM2OTRqTXFvMzN2cU9hN1pYNWdScTRIUU4zbzArWEw5SFluZitGUVwvaTRlRU1KdCtBd1gycWl4WkdOQ0pqelR4NEY5aU1PQktNOGZBamdPc1wvMDZtem1nUk5ONUtDUkRGVFNWeDdJVDE0dGtlXC9LN2NRdW9CWXQyazg2Z01JRzNqOFF3MUFuYUZYUFgyajU5ZlJMM0EzUzhFWk1nSmdtXC8yeXJVRFRyaHl5OTZXS1B1RHNudkRMTTE2YkRjT0dOVW1KbG5vbTdOcW45XC9qM1wvZHRWSmZSdVwvYlZkdEZYTXFuQmJjTkhZOVFDSUdBeE83dThPbzZkSkhcL0lDQ1dcL0ZxcVd2M0VmangzdHowd1dEdU14OWs5Yk9OeU9yVFozNk0rdG5SZXRXUzFYelZFVFVlc2FLT3hcL1hhOHJDQkE4QUpmcUMzRllFMHBha3hJOEdTd0p1d2Qyc1NsSFg5ZHozR2JLRG81dmhVUk9LUlQ3R1J5R0xqOGdZNHB3cHc4a0RyMk9qOE9zRWNEZVRHUXRlREdQdDhHUjdxamxFNCs5VjBxSVR3eU5qdEZ4ZjI3NEV1UWdlTUppYVNLbEZkakZ6a1Z5enRKOFJtQndwRFF2VWRQXC9iazhUU2U5R29sRFwvbjA4dmNUMWFEU3h2TmRveVYyUk1PSXo4djQ4M2F4UFVOTUVnMmQzQ1Y5MzdmdEdaTVZNSmp3RElzVVVONmlCUWtDNTlXZ2tBcXJ4Z29zbDVnMlNzanBKRUdcL3hCbXNrVm1WZ3ZBQkpUOHR4aFE9PSIsIm1hYyI6ImJkMDRkZmQyMzU4OThiNzY2MGU3ZGYzMTkxOTYwYTE3MDgzNzYxOWM2ZWY4OGY4MzI4Y2VhZWNhN2YxY2RkMWQifQ==',1449051105);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_08_07_095703_create_roles_table',1),('2015_08_07_100140_create_permissions_table',1),('2015_08_07_100401_create_roles_permissions_table',1),('2015_08_07_100814_create_users_roles_table',1),('2015_08_07_112139_create_users_permissions_table',1),('2015_11_13_095417_create_cache_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES (29,'email@example.com','a8087fe5f52ff3552689c4f595168806969d30f62fa041b9f205efb2ff36d2a1','2015-12-07 06:47:57');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'editUserProfiles','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'browseWebsite','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'accessDashboard','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'viewUsers','0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'updateUsersAccess','0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'deleteUsers','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_permission_role_id_permission_id_unique` (`role_id`,`permission_id`),
  KEY `role_permission_permission_id_foreign` (`permission_id`),
  CONSTRAINT `role_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permission`
--

LOCK TABLES `role_permission` WRITE;
/*!40000 ALTER TABLE `role_permission` DISABLE KEYS */;
INSERT INTO `role_permission` VALUES (1,1,1,'2015-12-02 07:49:10','2015-12-02 07:49:10'),(2,1,2,'2015-12-02 07:49:10','2015-12-02 07:49:10'),(3,1,3,'2015-12-02 07:49:10','2015-12-02 07:49:10'),(4,1,4,'2015-12-02 07:49:10','2015-12-02 07:49:10'),(5,1,5,'2015-12-02 07:49:10','2015-12-02 07:49:10'),(6,1,6,'2015-12-02 07:49:10','2015-12-02 07:49:10'),(7,2,1,'2015-12-02 07:49:10','2015-12-02 07:49:10'),(8,2,2,'2015-12-02 07:49:10','2015-12-02 07:49:10'),(9,2,3,'2015-12-02 07:49:10','2015-12-02 07:49:10'),(10,2,4,'2015-12-02 07:49:10','2015-12-02 07:49:10'),(11,2,5,'2015-12-02 07:49:10','2015-12-02 07:49:10'),(12,2,6,'2015-12-02 07:49:11','2015-12-02 07:49:11'),(13,3,2,'2015-12-02 07:49:11','2015-12-02 07:49:11');
/*!40000 ALTER TABLE `role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `display` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator',NULL,'2015-12-02 07:49:07','2015-12-02 07:49:07'),(2,'moderator','Moderator',NULL,'2015-12-02 07:49:07','2015-12-02 07:49:07'),(3,'user','User',NULL,'2015-12-02 07:49:07','2015-12-02 07:49:07');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permission`
--

DROP TABLE IF EXISTS `user_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_permission_user_id_permission_id_unique` (`user_id`,`permission_id`),
  KEY `user_permission_permission_id_foreign` (`permission_id`),
  CONSTRAINT `user_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `user_permission_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permission`
--

LOCK TABLES `user_permission` WRITE;
/*!40000 ALTER TABLE `user_permission` DISABLE KEYS */;
INSERT INTO `user_permission` VALUES (4,2,1,'2015-12-02 07:51:43','2015-12-02 07:51:43'),(5,2,2,'2015-12-02 07:51:43','2015-12-02 07:51:43'),(6,2,3,'2015-12-02 07:51:43','2015-12-02 07:51:43'),(7,2,4,'2015-12-02 07:51:43','2015-12-02 07:51:43'),(8,2,5,'2015-12-02 07:51:43','2015-12-02 07:51:43'),(9,2,6,'2015-12-02 07:51:43','2015-12-02 07:51:43');
/*!40000 ALTER TABLE `user_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_role_user_id_unique` (`user_id`),
  KEY `user_role_role_id_foreign` (`role_id`),
  CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,2,1,'2015-12-02 07:49:11','2015-12-02 07:49:11'),(2,1,3,'2015-12-02 07:49:11','2015-12-02 07:49:11');
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'','user','email@example.com','$2y$10$pHuWkPs8t5tX7pgKApyLGOM8YHQ3Y1Yv0eEPOts5TConLWSGuS9hK','EIM2dlDonyS80CLp8xdhu9ILwuenYGfG5X1Nyev9kc70DFJLjNHVhPISE3hd','2015-12-02 07:49:08','2015-12-07 06:47:46'),(2,'','admin','admin@example.com','$2y$10$xCAI18ET5cCrPZctWZ8ER.2VQibROLiLQFRxkOfovbRF7SsEOqE2.',NULL,'2015-12-02 07:49:08','2015-12-02 07:49:08'),(3,'','admins','admins@example.com','$2y$10$jxwLT/MKBm3tHEm2ynWBEOUDowkF.d05ExhHAZZhawWy4mC8TPEgy',NULL,'2015-12-02 07:49:09','2015-12-02 07:49:09'),(4,'','administrator','administrator@example.com','$2y$10$E4eu6Kvh2m7asKPZiwT7ZO4mUbWpqinz43aVVE0nF1Dl/uR80E8CS',NULL,'2015-12-02 07:49:09','2015-12-02 07:49:09'),(5,'','moderator','moderator@example.com','$2y$10$5APO6WGy7GLV3iBwLuMMlOKvn2x.EVt6OjfrxsxtkTx393TneE5yO',NULL,'2015-12-02 07:49:09','2015-12-02 07:49:09'),(6,'','mods','mods@example.com','$2y$10$cxSQEAvuDk6LxP6cDaHnr.LBhXivdzzuc0GMAP/M4u1hRvnjIVhBO',NULL,'2015-12-02 07:49:09','2015-12-02 07:49:09');
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

-- Dump completed on 2015-12-07 10:48:22
