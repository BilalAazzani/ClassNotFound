-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 14 mai 2019 à 12:59
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `database`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `question_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`answer_id`),
  KEY `question_id` (`question_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`answer_id`, `subject`, `question_id`, `member_id`, `creation_date`) VALUES
(29, 'Here\'s a link that could help : https://www.w3schools.com/css/css_font.asp', 26, 4, '2019-05-14 14:47:29'),
(30, 'Source -> Generate Getters and Setters...', 27, 4, '2019-05-14 14:49:09'),
(31, 'I think it\'s in the source menu', 27, 3, '2019-05-14 14:49:35'),
(32, 'While loops, like the ForLoop, are used for repeating sections of code - but unlike a for loop, the while loop will not run n times, but until a defined condition is no longer met. If the condition is initially false, the loop body will not be executed at all.', 31, 3, '2019-05-14 14:52:09'),
(34, 'I agree with member2 ', 31, 17, '2019-05-14 14:54:08'),
(35, 'This website does it perfectly : https://htmlcheatsheet.com/', 29, 17, '2019-05-14 14:55:01'),
(36, 'Just learn by yourself', 29, 3, '2019-05-14 14:55:26'),
(37, 'w3school is very trustworthy, i agree with member3', 26, 2, '2019-05-14 14:56:33'),
(38, 'I don\'t know', 28, 1, '2019-05-14 14:57:13');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'CSS'),
(3, 'Java'),
(4, 'SQL'),
(5, 'HTML'),
(6, 'Algorithm');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `members_email_uindex` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`member_id`, `first_name`, `last_name`, `email`, `password`, `is_admin`, `is_active`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$JdDQOE4ZJsuzcl0QfUz8kOS9fHkWd7/Gbx6df4K3UMCDXkleKfPiu', 1, 1),
(2, 'member', 'member', 'member@gmail.com', '$2y$10$8UVGsYbebw.m9adC4vD3COPvRLpkJ0II6OlXlpjj7fYBq0v5iNklW', 0, 1),
(3, 'member2', 'member2', 'member2@gmail.com', '$2y$10$o80gVbYq16vAv01PLT49/.8YKJuDpMYWuaPl1zueT3oJfE.jnTxE6', 0, 1),
(4, 'member3', 'member3', 'member3@gmail.com', '$2y$10$M7hoOLqK7h3vV8LGG/uebekYJYsqn.kzAbMp0ozdGwK6OKJBWqgB6', 0, 1),
(17, 'member4', 'member4', 'member4@gmail.com', '$2y$10$PYyKI43U/9jf4cKaHppg0ehfs0XIvt8v0S4aLyZ2CiLw0AJ1OT.YO', 0, 1),
(18, 'member6', 'member6', 'member6@gmail.com', '$2y$10$3HoQI5/j/zja5JDZDRHNwu3T5h5wdmQEWwJdz1N.TeKxO9Up92A1W', 0, 1),

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` char(1) NOT NULL DEFAULT 'O',
  `goodanswer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`question_id`),
  KEY `category_id` (`category_id`),
  KEY `member_id` (`member_id`),
  KEY `answer_id` (`goodanswer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`question_id`, `title`, `subject`, `category_id`, `member_id`, `creation_date`, `state`, `goodanswer_id`) VALUES
(26, 'How to change font', 'I would like some help to change the font of my website', 1, 1, '2019-05-14 14:39:42', 'S', 29),
(27, 'How to generate getters in Eclipse', 'I don\'t know how to do it, can someone help ?', 3, 1, '2019-05-14 14:40:37', 'S', 30),
(28, 'How to implement a Database? ', 'I need help to use PhpMyAdmin ', 4, 3, '2019-05-14 14:43:07', 'O', NULL),
(29, 'HTML tags....', 'Does someone have a cheat sheet with all the HTML tags ? ', 5, 4, '2019-05-14 14:43:55', 'O', NULL),
(30, 'How to implement a database ??', 'I need help to do it ..', 4, 4, '2019-05-14 14:44:34', 'D', NULL),
(31, 'For loops', 'How do they work ? What\'s the difference compared to while loops ?', 6, 4, '2019-05-14 14:46:30', 'O', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `question_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `vote_value` char(1) NOT NULL,
  PRIMARY KEY (`member_id`,`answer_id`),
  KEY `member_id` (`member_id`),
  KEY `answer_id` (`answer_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`question_id`, `member_id`, `answer_id`, `vote_value`) VALUES
(27, 1, 30, 'p'),
(27, 1, 31, 'n'),
(28, 1, 38, 'n'),
(26, 2, 29, 'p'),
(31, 2, 32, 'p'),
(31, 2, 34, 'p'),
(29, 2, 35, 'p'),
(29, 2, 36, 'n'),
(26, 3, 29, 'p'),
(27, 3, 30, 'p'),
(29, 3, 35, 'p'),
(26, 17, 29, 'p'),
(31, 17, 32, 'p'),
(29, 17, 35, 'p');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`goodanswer_id`) REFERENCES `answers` (`answer_id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`),
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
