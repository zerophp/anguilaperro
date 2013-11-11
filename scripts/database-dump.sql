CREATE DATABASE  IF NOT EXISTS `anguilaperro` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `anguilaperro`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: anguilaperro
-- ------------------------------------------------------
-- Server version	5.5.23

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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `idanswers` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `question` int(11) NOT NULL,
  PRIMARY KEY (`idanswers`),
  KEY `fk_answers_questions1_idx` (`question`),
  CONSTRAINT `fk_answers_questions1` FOREIGN KEY (`question`) REFERENCES `questions` (`idquestions`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `established_exams`
--

DROP TABLE IF EXISTS `established_exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `established_exams` (
  `idestablished_exams` int(11) NOT NULL AUTO_INCREMENT,
  `ini_date` date NOT NULL,
  `end_date` date NOT NULL,
  `group` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  `exam_state` int(11) NOT NULL,
  PRIMARY KEY (`idestablished_exams`),
  KEY `fk_established_exams_groups1_idx` (`group`),
  KEY `fk_established_exams_exams1_idx` (`exam`),
  KEY `fk_established_exams_exam_state1_idx` (`exam_state`),
  CONSTRAINT `fk_established_exams_exams1` FOREIGN KEY (`exam`) REFERENCES `exams` (`idexams`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_established_exams_exam_state1` FOREIGN KEY (`exam_state`) REFERENCES `exam_state` (`idexam_state`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_established_exams_groups1` FOREIGN KEY (`group`) REFERENCES `groups` (`idgroups`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `established_exams`
--

LOCK TABLES `established_exams` WRITE;
/*!40000 ALTER TABLE `established_exams` DISABLE KEYS */;
/*!40000 ALTER TABLE `established_exams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_done`
--

DROP TABLE IF EXISTS `exam_done`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_done` (
  `users_idusers` int(11) NOT NULL,
  `established_exams_idestablished_exams` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `questions_correct` int(11) DEFAULT NULL,
  `questions_incorrect` int(11) DEFAULT NULL,
  `mark` float DEFAULT NULL,
  PRIMARY KEY (`users_idusers`,`established_exams_idestablished_exams`),
  KEY `fk_users_has_established_exams_established_exams1_idx` (`established_exams_idestablished_exams`),
  KEY `fk_users_has_established_exams_users1_idx` (`users_idusers`),
  CONSTRAINT `fk_users_has_established_exams_established_exams1` FOREIGN KEY (`established_exams_idestablished_exams`) REFERENCES `established_exams` (`idestablished_exams`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_established_exams_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_done`
--

LOCK TABLES `exam_done` WRITE;
/*!40000 ALTER TABLE `exam_done` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_done` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_state`
--

DROP TABLE IF EXISTS `exam_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_state` (
  `idexam_state` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  PRIMARY KEY (`idexam_state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_state`
--

LOCK TABLES `exam_state` WRITE;
/*!40000 ALTER TABLE `exam_state` DISABLE KEYS */;
INSERT INTO `exam_state` VALUES (1,'opened'),(2,'closed');
/*!40000 ALTER TABLE `exam_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exams` (
  `idexams` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) NOT NULL,
  `difficulty` int(11) NOT NULL,
  PRIMARY KEY (`idexams`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exams`
--

LOCK TABLES `exams` WRITE;
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_states`
--

DROP TABLE IF EXISTS `group_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_states` (
  `idgroup_state` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(255) NOT NULL,
  PRIMARY KEY (`idgroup_state`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_states`
--

LOCK TABLES `group_states` WRITE;
/*!40000 ALTER TABLE `group_states` DISABLE KEYS */;
INSERT INTO `group_states` VALUES (1,'active'),(2,'inactive');
/*!40000 ALTER TABLE `group_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `idgroups` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `group_state` int(11) NOT NULL,
  PRIMARY KEY (`idgroups`),
  KEY `fk_groups_group_states1_idx` (`group_state`),
  CONSTRAINT `fk_groups_group_states1` FOREIGN KEY (`group_state`) REFERENCES `group_states` (`idgroup_state`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_has_users`
--

DROP TABLE IF EXISTS `groups_has_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_has_users` (
  `groups_idgroups` int(11) NOT NULL,
  `users_idusers` int(11) NOT NULL,
  PRIMARY KEY (`groups_idgroups`,`users_idusers`),
  KEY `fk_groups_has_users_users1_idx` (`users_idusers`),
  KEY `fk_groups_has_users_groups1_idx` (`groups_idgroups`),
  CONSTRAINT `fk_groups_has_users_groups1` FOREIGN KEY (`groups_idgroups`) REFERENCES `groups` (`idgroups`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_groups_has_users_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_has_users`
--

LOCK TABLES `groups_has_users` WRITE;
/*!40000 ALTER TABLE `groups_has_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups_has_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_difficulties`
--

DROP TABLE IF EXISTS `question_difficulties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_difficulties` (
  `idquestion_difficulties` int(11) NOT NULL AUTO_INCREMENT,
  `question_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idquestion_difficulties`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_difficulties`
--

LOCK TABLES `question_difficulties` WRITE;
/*!40000 ALTER TABLE `question_difficulties` DISABLE KEYS */;
INSERT INTO `question_difficulties` VALUES (1,'0'),(2,'1'),(3,'2'),(4,'3');
/*!40000 ALTER TABLE `question_difficulties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_types`
--

DROP TABLE IF EXISTS `question_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_types` (
  `idquestion_types` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idquestion_types`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_types`
--

LOCK TABLES `question_types` WRITE;
/*!40000 ALTER TABLE `question_types` DISABLE KEYS */;
INSERT INTO `question_types` VALUES (1,'simple'),(2,'multiple'),(3,'text');
/*!40000 ALTER TABLE `question_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `idquestions` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `question_difficulty` int(11) NOT NULL,
  `question_type` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  PRIMARY KEY (`idquestions`),
  KEY `fk_questions_question_difficulties_idx` (`question_difficulty`),
  KEY `fk_questions_question_types1_idx` (`question_type`),
  KEY `fk_questions_exams1_idx` (`exam`),
  CONSTRAINT `fk_questions_exams1` FOREIGN KEY (`exam`) REFERENCES `exams` (`idexams`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_question_difficulties` FOREIGN KEY (`question_difficulty`) REFERENCES `question_difficulties` (`idquestion_difficulties`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_question_types1` FOREIGN KEY (`question_type`) REFERENCES `question_types` (`idquestion_types`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions_done`
--

DROP TABLE IF EXISTS `questions_done`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions_done` (
  `idquestions_done` int(11) NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) NOT NULL,
  `is_correct` int(11) DEFAULT NULL,
  `exam_done_users_idusers` int(11) NOT NULL,
  `exam_done_established_exams_idestablished_exams` int(11) NOT NULL,
  `questions_idquestions` int(11) NOT NULL,
  PRIMARY KEY (`idquestions_done`),
  KEY `fk_questions_done_exam_done1_idx` (`exam_done_users_idusers`,`exam_done_established_exams_idestablished_exams`),
  KEY `fk_questions_done_questions1_idx` (`questions_idquestions`),
  CONSTRAINT `fk_questions_done_exam_done1` FOREIGN KEY (`exam_done_users_idusers`, `exam_done_established_exams_idestablished_exams`) REFERENCES `exam_done` (`users_idusers`, `established_exams_idestablished_exams`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_done_questions1` FOREIGN KEY (`questions_idquestions`) REFERENCES `questions` (`idquestions`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions_done`
--

LOCK TABLES `questions_done` WRITE;
/*!40000 ALTER TABLE `questions_done` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions_done` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `idteacher` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`idteacher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher_has_exams`
--

DROP TABLE IF EXISTS `teacher_has_exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_has_exams` (
  `teacher_idteacher` int(11) NOT NULL,
  `exams_idexams` int(11) NOT NULL,
  PRIMARY KEY (`teacher_idteacher`,`exams_idexams`),
  KEY `fk_teacher_has_exams_exams1_idx` (`exams_idexams`),
  KEY `fk_teacher_has_exams_teacher1_idx` (`teacher_idteacher`),
  CONSTRAINT `fk_teacher_has_exams_exams1` FOREIGN KEY (`exams_idexams`) REFERENCES `exams` (`idexams`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_teacher_has_exams_teacher1` FOREIGN KEY (`teacher_idteacher`) REFERENCES `teacher` (`idteacher`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_has_exams`
--

LOCK TABLES `teacher_has_exams` WRITE;
/*!40000 ALTER TABLE `teacher_has_exams` DISABLE KEYS */;
/*!40000 ALTER TABLE `teacher_has_exams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher_has_groups`
--

DROP TABLE IF EXISTS `teacher_has_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_has_groups` (
  `teacher_idteacher` int(11) NOT NULL,
  `groups_idgroups` int(11) NOT NULL,
  PRIMARY KEY (`teacher_idteacher`,`groups_idgroups`),
  KEY `fk_teacher_has_groups_groups1_idx` (`groups_idgroups`),
  KEY `fk_teacher_has_groups_teacher1_idx` (`teacher_idteacher`),
  CONSTRAINT `fk_teacher_has_groups_groups1` FOREIGN KEY (`groups_idgroups`) REFERENCES `groups` (`idgroups`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_teacher_has_groups_teacher1` FOREIGN KEY (`teacher_idteacher`) REFERENCES `teacher` (`idteacher`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_has_groups`
--

LOCK TABLES `teacher_has_groups` WRITE;
/*!40000 ALTER TABLE `teacher_has_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `teacher_has_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_states`
--

DROP TABLE IF EXISTS `user_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_states` (
  `iduser_state` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(255) NOT NULL,
  PRIMARY KEY (`iduser_state`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_states`
--

LOCK TABLES `user_states` WRITE;
/*!40000 ALTER TABLE `user_states` DISABLE KEYS */;
INSERT INTO `user_states` VALUES (1,'confirmed'),(2,'not confirmed');
/*!40000 ALTER TABLE `user_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idusers` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_state` int(11) NOT NULL,
  PRIMARY KEY (`idusers`),
  KEY `fk_users_user_states1_idx` (`user_state`),
  CONSTRAINT `fk_users_user_states1` FOREIGN KEY (`user_state`) REFERENCES `user_states` (`iduser_state`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2013-11-11 18:23:00
