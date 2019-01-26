CREATE DATABASE  IF NOT EXISTS `bitter-geoffwalker` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bitter-geoffwalker`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: bitter-geoffwalker
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `follows`
--

DROP TABLE IF EXISTS `follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follows` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `FK_follows` (`from_id`),
  KEY `FK_follows2` (`to_id`),
  CONSTRAINT `FK_follows` FOREIGN KEY (`from_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `FK_follows2` FOREIGN KEY (`to_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
INSERT INTO `follows` VALUES (7,47,48),(10,48,47),(12,46,48),(13,48,46),(14,46,47),(15,49,48),(16,48,49),(18,48,40),(24,47,40),(25,52,51),(26,52,48),(27,52,46),(28,52,49),(29,48,52),(30,48,51);
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`like_id`),
  KEY `FK_tweet_id_idx` (`tweet_id`),
  KEY `FK_user_id_idx` (`user_id`),
  CONSTRAINT `FK_tweet_id` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`tweet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (1,43,48,'2018-12-02 17:11:57'),(2,9,48,'2018-12-02 17:13:47'),(3,39,48,'2018-12-02 18:03:23'),(4,39,47,'2018-12-06 19:55:55');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message_text` varchar(255) NOT NULL,
  `date_sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_toid_idx` (`id`,`from_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (7,47,48,'Testing messages','2018-12-06 17:10:29');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tweets`
--

DROP TABLE IF EXISTS `tweets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tweets` (
  `tweet_id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_text` varchar(280) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `original_tweet_id` int(11) NOT NULL DEFAULT '0',
  `reply_to_tweet_id` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tweet_id`),
  KEY `FK_tweets` (`user_id`),
  CONSTRAINT `FK_tweets` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweets`
--

LOCK TABLES `tweets` WRITE;
/*!40000 ALTER TABLE `tweets` DISABLE KEYS */;
INSERT INTO `tweets` VALUES (1,'Hi Peter, how are you?',48,0,0,'2014-10-18 15:34:42'),(2,'Hi, I\'m ptor!',47,0,0,'2015-10-18 16:01:09'),(5,'Geoff, over here!',47,0,0,'2018-10-18 16:12:51'),(6,'psst, hey you kids!',46,0,0,'2018-10-18 16:14:11'),(9,'test',48,0,0,'2018-10-19 18:41:48'),(10,'new test',50,0,0,'2018-11-01 13:38:15'),(19,'psst, hey you kids!',48,6,0,'2018-11-01 18:24:13'),(31,'hello there!',48,0,7,'2018-11-05 18:45:21'),(34,'hi AGAIN',48,0,7,'2018-11-06 13:50:53'),(35,'hihi',48,0,9,'2018-11-06 15:47:45'),(39,'hello there!',48,31,0,'2018-11-20 12:08:17'),(40,'asdfffff',48,0,4,'2018-11-20 12:31:46'),(41,'replies are great!',52,0,9,'2018-11-20 14:40:38'),(42,'hello there!',52,39,0,'2018-11-20 14:40:42'),(43,'new user, new troll!',52,0,0,'2018-11-20 14:41:19'),(44,'psst, hey you kids!',47,19,0,'2018-12-06 20:46:42'),(45,'get away from my kids.',47,6,19,'2018-12-06 20:50:04');
/*!40000 ALTER TABLE `tweets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `screen_name` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `address` varchar(200) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal_code` varchar(7) NOT NULL,
  `contact_number` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `description` varchar(160) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_pic` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (40,'test101','test101','test101','$2y$10$/WKdhGz8OrnhiDqZnRQbEuUqn/AdpsHiOoHEjeW0JvTxEKo8Qe46G','test101','Alberta','e3g4e3','5064555555','test101@test.com','test101','test101','test101','2018-10-16 20:16:23',NULL),(46,'seth','seth','seth','$2y$10$inhi147pRyn0py9CpxkkROWztnMcXP7IIzrtlNy4SJKa84zYFp6fi','seth','Saskatchewan','E3G7W8','5064444444','seth@seth.com','seth','seth','seth','2018-10-17 18:00:18','46.jpg'),(47,'ptor','ptor','ptor','$2y$10$j8KbNgKtRwsTEpzkaM6buePqL9Mxcp89fEq8SD9po4ue/fSUkjNo2','1 ptor lane','British Columbia','E3G7W8','5064444444','ptor@ptor.com','ptor.com','ptor','ptor','2018-10-17 18:20:17',NULL),(48,'Nick','Taggart','nick','$2y$10$BTF2naa5nQB19585hz12pefn8geX5eyPaj1uRu/SrMkWDotrQ8RIu','123 nick st.','Alberta','E3G7W8','5064445555','Nick.Taggart@nbcc.ca','nick.com','instructor at nickU','Nick\'s place','2018-10-17 18:33:25','48.jpg'),(49,'Justin','Williams','TrustyJusty','$2y$10$G/ROtvWkrcScjKfSQGJ5D.mOMKvfe0ef/R0gFOKQl/KUDfLU8A596','justin','New Brunswick','E3G7W8','4444444444','justin@justin.com','justin','justin','justin','2018-10-19 18:34:09',NULL),(50,'new','test','newtest','$2y$10$r04ak4yobugVDGLP.ukcJOFxG4eqsjETlEJ2YU7KKbAwxn6x2JCGK','asdf','Alberta','E3G7W8','5064530710','new@test.com','asdf','asdf','asdf','2018-11-01 13:37:17',NULL),(51,'Gulshan','Gill','ggill','$2y$10$4AndyHpzKjE045223VFiDetAlvc9pwoIqQ2jG1sbY2V1kqu/SPq2K','asdf','NB','E3G7W8','5064445555','gulsh@gill.com','asdf','asdf','asdf','2018-11-20 13:37:50',NULL),(52,'Geoff','Walker','gwalk','$2y$10$lyoeMYDb3vF88vsGK0t1h.8ek848XUrihiNgZNDVArYJVXP5L7pIi','asdf','NB','E3G7W8','5064445555','gwalk@gmail.com','asdf','asdf','asdf','2018-11-20 14:40:09',NULL);
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

-- Dump completed on 2019-01-23 22:29:20
