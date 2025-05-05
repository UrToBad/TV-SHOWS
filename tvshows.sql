-- MySQL dump 10.13  Distrib 9.3.0, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tvshows
-- ------------------------------------------------------
-- Server version	9.3.0

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
-- Table structure for table `acteur`
--

DROP TABLE IF EXISTS `acteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acteur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acteur`
--

LOCK TABLES `acteur` WRITE;
/*!40000 ALTER TABLE `acteur` DISABLE KEYS */;
INSERT INTO `acteur` VALUES (1,'Bryan Cranston','\'\''),(2,'Aaron Paul','\'\''),(3,'Millie Bobby Brown','\'\''),(4,'David Harbour','\'\''),(5,'Winona Ryder','\'\''),(6,'Pedro Pascal','\'\''),(7,'Bella Ramsey','\'\''),(8,'Evan Peters','\'\''),(9,'Sarah Paulson','\'\''),(10,'Finn Wolfhard','\'\'');
/*!40000 ALTER TABLE `acteur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acteurs_saisons`
--

DROP TABLE IF EXISTS `acteurs_saisons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acteurs_saisons` (
  `acteur_id` int NOT NULL,
  `saison_id` int NOT NULL,
  KEY `saison_id_fk` (`saison_id`),
  KEY `acteur_id_fk` (`acteur_id`),
  CONSTRAINT `acteur_id_fk` FOREIGN KEY (`acteur_id`) REFERENCES `acteur` (`id`),
  CONSTRAINT `saison_id_fk` FOREIGN KEY (`saison_id`) REFERENCES `saison` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acteurs_saisons`
--

LOCK TABLES `acteurs_saisons` WRITE;
/*!40000 ALTER TABLE `acteurs_saisons` DISABLE KEYS */;
INSERT INTO `acteurs_saisons` VALUES (1,1),(1,2),(2,1),(2,2),(3,3),(4,1),(4,2),(5,1),(5,3),(6,1),(7,1),(8,1),(9,1),(8,2),(9,2);
/*!40000 ALTER TABLE `acteurs_saisons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `episode`
--

DROP TABLE IF EXISTS `episode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `episode` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero` int NOT NULL,
  `titre` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `synopsis` text COLLATE utf8mb4_general_ci NOT NULL,
  `duree` int NOT NULL,
  `saison_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `saison_id_fk2` (`saison_id`),
  CONSTRAINT `saison_id_fk2` FOREIGN KEY (`saison_id`) REFERENCES `saison` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `episode`
--

LOCK TABLES `episode` WRITE;
/*!40000 ALTER TABLE `episode` DISABLE KEYS */;
INSERT INTO `episode` VALUES (1,1,'Pilot','Walter découvre qu’il a un cancer.',58,1),(2,2,'Cat in the bag','Walter et Jesse cachent un cadavre.',48,1),(3,3,'Bags in the river','Le dilemme moral de Walter.',47,1),(4,1,'Chapter One','Will disparaît mystérieusement.',50,4),(5,2,'Chapter Two','La mère de Will croit qu’il est vivant.',48,4);
/*!40000 ALTER TABLE `episode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `realisateur`
--

DROP TABLE IF EXISTS `realisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `realisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `realisateur`
--

LOCK TABLES `realisateur` WRITE;
/*!40000 ALTER TABLE `realisateur` DISABLE KEYS */;
INSERT INTO `realisateur` VALUES (1,'Vince Gilligan','\'\''),(2,'Shawn Levy','\'\''),(3,'Tim Van Patten','\'\''),(4,'Cary Joji Fukunaga','\'\''),(5,'David Nutter','\'\''),(6,'Michelle MacLaren','\'\''),(7,'Reed Morano','\'\''),(8,'The Duffer Brothers','\'\''),(9,'Jean-Marc Vallée','\'\''),(10,'Deborah Chow','\'\'');
/*!40000 ALTER TABLE `realisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `realisateurs_episodes`
--

DROP TABLE IF EXISTS `realisateurs_episodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `realisateurs_episodes` (
  `realisateur_id` int NOT NULL,
  `episode_id` int NOT NULL,
  KEY `episode_id_fk` (`episode_id`),
  KEY `realisateur_id_fk` (`realisateur_id`),
  CONSTRAINT `episode_id_fk` FOREIGN KEY (`episode_id`) REFERENCES `episode` (`id`),
  CONSTRAINT `realisateur_id_fk` FOREIGN KEY (`realisateur_id`) REFERENCES `realisateur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `realisateurs_episodes`
--

LOCK TABLES `realisateurs_episodes` WRITE;
/*!40000 ALTER TABLE `realisateurs_episodes` DISABLE KEYS */;
INSERT INTO `realisateurs_episodes` VALUES (1,1),(1,2),(2,1),(2,2),(3,1);
/*!40000 ALTER TABLE `realisateurs_episodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saison`
--

DROP TABLE IF EXISTS `saison`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `saison` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `affiche` text COLLATE utf8mb4_general_ci,
  `numero` int NOT NULL,
  `serie_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `serie_id_fk` (`serie_id`),
  CONSTRAINT `serie_id_fk` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saison`
--

LOCK TABLES `saison` WRITE;
/*!40000 ALTER TABLE `saison` DISABLE KEYS */;
INSERT INTO `saison` VALUES (1,'Breaking Bad - Saison 1','https://fr.web.img3.acsta.net/c_210_280/pictures/18/07/23/11/26/1237965.jpg',1,1),(2,'Breaking Bad - Saison 2','https://imgs.search.brave.com/HvGBolvCva9YfaZ2vDv096cGJfwykVXYc2VwJSFBvVE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9mci53/ZWIuaW1nNS5hY3N0/YS5uZXQvcl8xMjgw/XzcyMC9waWN0dXJl/cy8xOC8wNy8yMy8x/MS8yNi8xNTk3MzQy/LmpwZw',2,1),(3,'Breaking Bad - Saison 3','https://imgs.search.brave.com/ADfjEbVs-v2Dda2ECab7zt_pDrpMy0SeNp0e8orbWmI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9mci53/ZWIuaW1nMy5hY3N0/YS5uZXQvcl8xMjgw/XzcyMC9waWN0dXJl/cy8xOC8wNy8yMy8x/MS8yNi8yMTY3NjU4/LmpwZw',3,1),(4,'Stranger Things - Saison 1','https://imgs.search.brave.com/ZEwN6RxREUrFVGnQXi1D9bqDUk5eeuwWviG5Uz_mgI4/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9wb3N0/ZXJzLndhYXNhYmku/Y29tL21lZGlhcy8x/NTg2NDYwMzc2ODAu/anBn',1,2),(5,'Stranger Things - Saison 2','https://imgs.search.brave.com/pk0JX2I_A7AUHE3aj2ilNdx1VJrofsNJwaah7V0yYro/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL0kv/ODFGWDZ1cDdQaEwu/anBn',2,2),(6,'Stranger Things - Saison 3','https://imgs.search.brave.com/99jnJnZxVJnr85Ei8DXemTECx5VfmnzLwY5dXAIwl1c/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL0kv/ODFNeGJTdE1aUEwu/anBn',3,2),(7,'Stranger Things - Saison 4','https://imgs.search.brave.com/WWGsesue7W2Sp_6Qrxs0TShOIdzI5C9U6Ug6yhUaRts/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMucG9zdGVycy5j/ei9pbWFnZS8zNTAv/YWZmaWNoZXMtZXQt/cG9zdGVycy9zdHJh/bmdlci10aGluZ3Mt/c2Vhc29uLTQtZXZl/cnktZW5kaW5nLWhh/cy1hLWJlZ2lubmlu/Zy1pMTI5NTgxLmpw/Zw',4,2),(8,'The Last of Us - Saison 1','https://imgs.search.brave.com/PCsXIHCGwNMxs8oPRoNuc03gcCAmYvj63H6rDns0kJ0/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9mci53/ZWIuaW1nNS5hY3N0/YS5uZXQvcl8xMjgw/XzcyMC9pbWcvZDQv/NmIvZDQ2YjM5MTc3/MzJlMTY0ZTk3YWY1/OWFiYzBiYjM1YmYu/anBlZw',1,3),(9,'The Last of Us - Saison 2','https://imgs.search.brave.com/yNLHOLmSejpxQL8OOd1xVwFOYCyRaQ-rxbULfqWZPdE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9mci53/ZWIuaW1nNi5hY3N0/YS5uZXQvcl8xMjgw/XzcyMC9pbWcvYTkv/ODkvYTk4OTI3N2Yx/ZWYwMWNjOWRjODU0/MWZlNTcxZWFmNWMu/anBn',2,3),(10,'Game of Thrones - Saison 1','https://imgs.search.brave.com/wGf9aIoerjTMW8Zd75Q74VBK8uCMqYS7nvwiPKjGeeo/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zbS5p/Z24uY29tL3QvaWdu/X2ZyL3NjcmVlbnNo/b3Qvcy9zZWFzb24t/MS1wL3NlYXNvbi0x/LXBvc3Rlcl8zdW41/LjEwODAuanBn',1,4),(11,'Game of Thrones - Saison 2','https://imgs.search.brave.com/xanbxg3wy0mgvdHaXPrCBp8KYEBrWwn3rtoQoo8OWZA/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zbS5p/Z24uY29tL3QvaWdu/X2ZyL3NjcmVlbnNo/b3Qvcy9zZWFzb24t/Mi1wL3NlYXNvbi0y/LXBvc3Rlcl9xaDhw/LjEwODAuanBn',2,4),(12,'Game of Thrones - Saison 3','https://imgs.search.brave.com/9qFc1CbF_yDoD6TnK2DceEkVlFDf7KqIaAGITYcTAZg/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zbS5p/Z24uY29tL3QvaWdu/X2ZyL3NjcmVlbnNo/b3Qvcy9zZWFzb24t/My1wL3NlYXNvbi0z/LXBvc3Rlcl94ejZ6/LjEwODAuanBn',3,4),(13,'Game of Thrones - Saison 4','https://imgs.search.brave.com/3-zojFG1TLjIVjXtg4yRSGRasn7dQ94hj1ymEXmD7KI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zbS5p/Z24uY29tL3QvaWdu/X2ZyL3NjcmVlbnNo/b3Qvcy9zZWFzb24t/NC1wL3NlYXNvbi00/LXBvc3Rlcl9tbjVo/LjEwODAuanBn',4,4),(14,'American Horror Story - Saison 1','\'\'',1,5),(15,'American Horror Story - Saison 2','\'\'',2,5);
/*!40000 ALTER TABLE `saison` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serie`
--

DROP TABLE IF EXISTS `serie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `serie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '''''',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serie`
--

LOCK TABLES `serie` WRITE;
/*!40000 ALTER TABLE `serie` DISABLE KEYS */;
INSERT INTO `serie` VALUES (1,'Breaking Bad'),(2,'Stranger Things'),(3,'The Last of Us'),(4,'Game of Thrones'),(5,'American Horror Story');
/*!40000 ALTER TABLE `serie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `series_tags`
--

DROP TABLE IF EXISTS `series_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `series_tags` (
  `serie_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`serie_id`,`tag_id`),
  KEY `tag_pk` (`tag_id`),
  CONSTRAINT `serie_pk` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tag_pk` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series_tags`
--

LOCK TABLES `series_tags` WRITE;
/*!40000 ALTER TABLE `series_tags` DISABLE KEYS */;
INSERT INTO `series_tags` VALUES (1,1),(3,1),(4,1),(2,2),(2,4),(1,5),(4,6),(5,6),(1,9),(5,11),(4,12),(2,13),(3,14);
/*!40000 ALTER TABLE `series_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `nom` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES ('Action',5),('Années 80',11),('Aventure',10),('Crime',9),('Drame',1),('Fantastique',4),('Horreur',6),('Mystère',7),('Politique',12),('Post-apocalyptique',8),('Psychologique',15),('Romance',13),('Science-fiction',2),('Survie',14),('Thriller',3);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-05 16:28:47
