-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: Twitter
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `Comment`
--

DROP TABLE IF EXISTS `Comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text` varchar(60) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `Posts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comment`
--

LOCK TABLES `Comment` WRITE;
/*!40000 ALTER TABLE `Comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `Comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Posts`
--

DROP TABLE IF EXISTS `Posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `Posts_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Posts`
--

LOCK TABLES `Posts` WRITE;
/*!40000 ALTER TABLE `Posts` DISABLE KEYS */;
INSERT INTO `Posts` VALUES (1,9,'nowy tekst','2017-05-18 01:45:34');
/*!40000 ALTER TABLE `Posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `hashed_password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'Agata','agata.p4@op.pl','$2y$10$mjUjPvyiO4tqdueVJtbaneTIr0Z7GMMGf3DFzExOsLBGZJkzjYZHq'),(2,'Nela','nela12@op.pl','$2y$10$ag0BhQgK7OGCqEkJg17s0.FhYW3O5dXY/Vrb45.acSyNaGAx9t9aW'),(4,'rogata','rogata@wp.pl','$2y$10$K2w7RDxkpH3id1ScBZ/e0u8kRLj7FuH5mjuR7QtjZ3fuZfWAxJlQ2'),(5,'nowa','nowa@op.pl','$2y$10$.zl/MUZ2l4SgxlxHOx90/Ob9BYNBG.S8V1hX/EAGGNHO4YjLUMtO.'),(6,'Nowa2','nowa@wp.pl','$2y$10$wFPZ6kB5IhZbQO8kjnag3.7tonFeYLlxMdNhvEyPLm45V2..y0iha'),(7,'Zosia','zosia@zosia.pl','$2y$10$iq9DYuQDzkwKvXa5TQvxReSyYCLKVbpafCERdf9d077je8MMRs8v.'),(8,'Nowa3','nowa3@op.pl','$2y$10$AcbF1SHWoy47hp1PLNEfhuyYABYcI1GqmIwHScJNOkVvgxnlaWGbi'),(9,'Agata2','agata.p2@op.pl','$2y$10$DQn/oiBMK6I8JL16lfaL4OB0heUn42Ha7QAqFHpQJdqktON7IREcO'),(10,'Agata3','agata.p3@op.pl','$2y$10$orilsETeVk/qDZ..fIX9A.w2jDZ6NUPtJdJOJGXgb/G8veVhvQnES'),(11,'Agata5','agata.p5@op.pl','$2y$10$A96rplAVFlK6W7cjdFKM8.1fuChZ17QMW..R.hAYOST6maYDaRkrC'),(12,'Nela2','nela2@op.pl','$2y$10$RTMufo5ZXnvvfzsewLJjjeRvKzA5A6uBMbBx00UQ62HJqvr8UfpDC'),(13,'Nela3','nela3@op.pl','$2y$10$paMA4mOJZ8Qej7LVQnvBgOzszZUl82v4QtLhIzi4kHfEh1t22OnYC'),(14,'Nowa5','nowa5@op.pl','$2y$10$5goHd1oXJJziju75BjgQ0OZWuxM10t3qScgo2iaN7Y2rEHZIjq9ke'),(15,'','','$2y$10$1u4sLBu7omFWIN4zFzuePuyxrlJz/P5tgE2kP8mzqibjyqrELnl5i');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-06 13:25:53
