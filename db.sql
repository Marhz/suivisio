drop database if exists newsuivisio;
create database newsuivisio;
use newsuivisio;

-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 17 Octobre 2017 à 11:02
-- Version du serveur: 5.5.53-0ubuntu0.14.04.1
-- Version de PHP: 5.6.29-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `newsuivisio`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain_id` int(11) DEFAULT NULL,
  `nomenclature` varchar(50) DEFAULT NULL,
  `label` text,
  `lngutile` int(11) DEFAULT NULL,
  `main_activity_id` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `domain_id` (`domain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Contenu de la table `activities`
--

INSERT INTO `activities` (`id`, `domain_id`, `nomenclature`, `label`, `lngutile`, `main_activity_id`, `deleted_at`) VALUES
(1, 1, 'A1.1.1', 'Analyse du cahier des charges d''un service à produire', 54, 6, NULL),
(2, 1, 'A1.1.2', 'Étude de l''impact de l''intégration d''un service sur le système informatique', 47, 6, NULL),
(3, 1, 'A1.1.3', 'Étude des exigences liées à la qualité attendue d''un service', 47, 6, NULL),
(4, 2, 'A1.2.1', 'Élaboration et présentation d''un dossier de choix de solution technique', 49, 6, NULL),
(5, 2, 'A1.2.2', 'Rédaction des spécifications techniques de la solution retenue (adaptation d''une solution existante ou réalisation d''une nouvelle solution)', 54, NULL, NULL),
(6, 2, 'A1.2.3', 'Évaluation des risques liés à l''utilisation d''un service', 57, NULL, NULL),
(7, 2, 'A1.2.4', 'Détermination des tests nécessaires à la validation d''un service', 51, NULL, NULL),
(8, 2, 'A1.2.5', 'Définition des niveaux d''habilitation associés à un service', 37, NULL, NULL),
(9, 3, 'A1.3.1', 'Test d''intégration et d''acceptation d''un service', 49, NULL, NULL),
(10, 3, 'A1.3.2', 'Définition des éléments nécessaires à la continuité d''un service', 51, NULL, NULL),
(11, 3, 'A1.3.3', 'Accompagnement de la mise en place d''un nouveau service', 56, NULL, NULL),
(12, 3, 'A1.3.4', 'Déploiement d''un service', 25, NULL, NULL),
(13, 4, 'A1.4.1', 'Participation à un projet', 25, 7, NULL),
(14, 4, 'A1.4.2', 'Évaluation des indicateurs de suivi d''un projet et justification des écarts', 47, 7, NULL),
(15, 4, 'A1.4.3', 'Gestion des ressources', 22, NULL, NULL),
(16, 5, 'A2.1.1', 'Accompagnement des utilisateurs dans la prise en main d''un service', 53, NULL, NULL),
(17, 5, 'A2.1.2', 'Évaluation et maintien de la qualité d''un service', 50, NULL, NULL),
(18, 6, 'A2.2.1', 'Suivi et résolution d''incidents', 32, 7, NULL),
(19, 6, 'A2.2.2', 'Suivi et réponse à des demandes d''assistance', 45, 7, NULL),
(20, 6, 'A2.2.3', 'Réponse à une interruption de service', 37, 7, NULL),
(21, 7, 'A2.3.1', 'Identification, qualification et évaluation d''un problème', 58, NULL, NULL),
(22, 7, 'A2.3.2', 'Proposition d''amélioration d''un service', 41, NULL, NULL),
(23, 8, 'A3.1.1', 'Proposition d''une solution d''infrastructure', 45, 10, NULL),
(24, 8, 'A3.1.2', 'Maquettage et prototypage d''une solution d''infrastructure', 58, 10, NULL),
(25, 8, 'A3.1.3', 'Prise en compte du niveau de sécurité nécessaire à une infrastructure', 48, NULL, NULL),
(26, 9, 'A3.2.1', 'Installation et configuration d''éléments d''infrastructure', 57, NULL, NULL),
(27, 9, 'A3.2.2', 'Remplacement ou mise à jour d''éléments défectueux ou obsolètes', 49, NULL, NULL),
(28, 9, 'A3.2.3', 'Mise à jour de la documentation technique d''une solution d''infrastructure', 41, NULL, NULL),
(29, 10, 'A3.3.1', 'Administration sur site ou à distance des éléments d''un réseau, de serveurs, de services et d''équipements terminaux', 50, NULL, NULL),
(30, 10, 'A3.3.2', 'Planification des sauvegardes et gestion des restaurations', 59, NULL, NULL),
(31, 10, 'A3.3.3', 'Gestion des identités et des habilitations', 42, NULL, NULL),
(32, 10, 'A3.3.4', 'Automatisation des tâches d''administration', 43, NULL, NULL),
(33, 10, 'A3.3.5', 'Gestion des indicateurs et des fichiers d''activité', 51, NULL, NULL),
(34, 11, 'A4.1.1', 'Proposition d''une solution applicative', 39, 10, NULL),
(35, 11, 'A4.1.2', 'Conception ou adaptation de l''interface utilisateur d''une solution applicative', 51, 10, NULL),
(36, 11, 'A4.1.3', 'Conception ou adaptation d''une base de données', 47, 10, NULL),
(37, 11, 'A4.1.4', 'Définition des caractéristiques d''une solution applicative', 59, NULL, NULL),
(38, 11, 'A4.1.5', 'Prototypage de composants logiciels', 35, NULL, NULL),
(39, 11, 'A4.1.6', 'Gestion d''environnements de développement et de test', 53, NULL, NULL),
(40, 11, 'A4.1.7', 'Développement, utilisation ou adaptation de composants logiciels', 54, NULL, NULL),
(41, 11, 'A4.1.8', 'Réalisation des tests nécessaires à la validation d''éléments adaptés ou développés', 49, NULL, NULL),
(42, 11, 'A4.1.9', 'Rédaction d''une documentation technique', 40, NULL, NULL),
(43, 11, 'A4.1.1', 'Rédaction d''une documentation d''utilisation', 45, NULL, NULL),
(44, 12, 'A4.2.1', 'Analyse et correction d''un dysfonctionnement, d''un problème de qualité de service ou de sécurité', 44, NULL, NULL),
(45, 12, 'A4.2.2', 'Adaptation d''une solution applicative aux évolutions de ses composants', 52, NULL, NULL),
(46, 12, 'A4.2.3', 'Réalisation des tests nécessaires à la mise en production d''éléments mis à jour', 57, NULL, NULL),
(47, 12, 'A4.2.4', 'Mise à jour d''une documentation technique', 42, NULL, NULL),
(48, 13, 'A5.1.1', 'Mise en place d''une gestion de configuration', 45, NULL, NULL),
(49, 13, 'A5.1.2', 'Recueil d''informations sur une configuration et ses éléments', 44, NULL, NULL),
(50, 13, 'A5.1.3', 'Suivi d''une configuration et de ses éléments', 45, NULL, NULL),
(51, 13, 'A5.1.4', 'Étude de propositions de contrat de service (client, fournisseur)', 43, NULL, NULL),
(52, 13, 'A5.1.5', 'Évaluation d''un élément de configuration ou d''une configuration', 40, NULL, NULL),
(53, 13, 'A5.1.6', 'Évaluation d''un investissement informatique', 44, NULL, NULL),
(54, 14, 'A5.2.1', 'Exploitation des référentiels, normes et standards adoptés par le prestataire informatique', 50, 11, NULL),
(55, 14, 'A5.2.2', 'Veille technologique', 20, 11, NULL),
(56, 14, 'A5.2.3', 'Repérage des compléments de formation ou d''auto-formation utiles à l''acquisition de nouvelles compétences', 37, 11, NULL),
(57, 14, 'A5.2.4', 'Étude d‘une technologie, d''un composant, d''un outil ou d''une méthode', 51, 11, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `activity_category`
--

CREATE TABLE IF NOT EXISTS `activity_category` (
  `activity_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `activity_category`
--

INSERT INTO `activity_category` (`activity_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(35, 4),
(36, 4),
(40, 4),
(41, 4),
(48, 5),
(49, 5),
(50, 5),
(51, 5),
(52, 5),
(53, 5),
(54, 5),
(55, 5),
(56, 5),
(57, 5),
(34, 8),
(35, 8),
(36, 8),
(37, 8),
(38, 8),
(39, 8),
(40, 8),
(41, 8),
(42, 8),
(43, 8),
(44, 8),
(45, 8),
(46, 8),
(47, 8),
(23, 9),
(24, 9),
(26, 9),
(30, 9);

-- --------------------------------------------------------

--
-- Structure de la table `activity_situation`
--

CREATE TABLE IF NOT EXISTS `activity_situation` (
  `activity_id` int(11) NOT NULL,
  `situation_id` int(11) NOT NULL,
  `rephrasing` text,
  PRIMARY KEY (`activity_id`,`situation_id`),
  KEY `situation_id` (`situation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `activity_situation`
--

INSERT INTO `activity_situation` (`activity_id`, `situation_id`, `rephrasing`) VALUES
(4, 6, ''),
(5, 6, ''),
(5, 7, ''),
(5, 8, ''),
(1, 9, ''),
(2, 9, ''),
(3, 9, ''),
(5, 9, ''),
(1, 10, ''),
(2, 10, ''),
(3, 10, ''),
(4, 10, ''),
(2, 11, ''),
(4, 11, ''),
(4, 14, ''),
(2, 12, ''),
(4, 12, ''),
(5, 12, ''),
(2, 13, ''),
(4, 13, ''),
(5, 13, ''),
(1, 15, ''),
(2, 15, ''),
(7, 15, ''),
(13, 15, ''),
(1, 16, ''),
(2, 16, ''),
(3, 16, ''),
(23, 16, ''),
(23, 19, NULL),
(1, 20, NULL),
(2, 20, NULL),
(3, 20, NULL),
(23, 20, NULL),
(1, 21, NULL),
(2, 21, NULL),
(3, 21, NULL),
(23, 21, NULL),
(1, 22, NULL),
(10, 22, NULL),
(11, 22, NULL),
(13, 22, NULL),
(1, 23, NULL),
(10, 23, NULL),
(11, 23, NULL),
(13, 23, NULL),
(1, 24, NULL),
(10, 24, NULL),
(11, 24, NULL),
(13, 24, NULL),
(1, 25, NULL),
(10, 25, NULL),
(11, 25, NULL),
(13, 25, NULL),
(1, 26, NULL),
(10, 26, NULL),
(11, 26, NULL),
(13, 26, NULL),
(1, 27, NULL),
(10, 27, NULL),
(11, 27, NULL),
(13, 27, NULL),
(1, 28, NULL),
(10, 28, NULL),
(11, 28, NULL),
(13, 28, NULL),
(1, 29, NULL),
(8, 29, NULL),
(11, 29, NULL),
(12, 29, NULL),
(13, 29, NULL),
(1, 30, NULL),
(8, 30, NULL),
(11, 30, NULL),
(12, 30, NULL),
(13, 30, NULL),
(1, 31, 'freger'),
(8, 31, 'rgregge'),
(11, 31, ''),
(12, 31, 'rgegreg'),
(13, 31, 'ferfregre'),
(1, 32, 'ceci'),
(10, 32, ''),
(3, 32, 'est'),
(8, 32, 'un'),
(12, 32, 'autre'),
(13, 32, 'test\r\n'),
(1, 33, 'piou'),
(2, 33, 'pew'),
(4, 33, 'pewpew'),
(5, 33, 'pioupew'),
(1, 34, 'aze'),
(2, 34, 'aze'),
(5, 34, 'aze'),
(2, 35, 'piou'),
(3, 35, ''),
(5, 35, ''),
(58, 36, ''),
(24, 37, ''),
(35, 37, ''),
(36, 37, ''),
(55, 37, ''),
(33, 38, ''),
(34, 38, ''),
(35, 38, ''),
(36, 38, ''),
(1, 39, ''),
(4, 39, ''),
(12, 39, ''),
(22, 39, ''),
(27, 39, ''),
(38, 39, '');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomenclature` varchar(25) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `nomenclature`, `label`, `course_id`) VALUES
(1, 'P1', 'Production de services', NULL),
(2, 'P2', 'Fournitures de services', NULL),
(3, 'P3', 'Conception et maintenance de solutions d''infrastructures', 3),
(4, 'P4', 'Conception et maintenance de solutions applicatives', 3),
(5, 'P5', 'Gestion du patrtimoine informatique', NULL),
(8, 'P4', 'Conception et maintenance de solutions applicatives', 2),
(9, 'P3', 'Conception et maintenance de solutions d''infrastructures', 2);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `situation_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `situation_id` (`situation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `situation_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(10, 31, 4, 'kkrgrge\r\n', '2016-12-09 15:23:03', '2016-12-09 15:23:03');

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `courses`
--

INSERT INTO `courses` (`id`, `name`, `label`) VALUES
(1, '1ere année', 'indifférencie'),
(2, 'SLAM', 'solutions logicielles et applications métiers'),
(3, 'SISR', 'Solutions d’infrastructure, systèmes et réseaux');

-- --------------------------------------------------------

--
-- Structure de la table `domains`
--

CREATE TABLE IF NOT EXISTS `domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `nomenclature` varchar(10) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `domains`
--

INSERT INTO `domains` (`id`, `category_id`, `nomenclature`, `label`) VALUES
(1, 1, 'D1.1', 'Analyse de la demande'),
(2, 1, 'D1.2', 'Choix d''une solution'),
(3, 1, 'D1.3', 'Mise en production d''un service'),
(4, 1, 'D1.4', 'Travail en mode projet'),
(5, 2, 'D2.1', 'Exploitation des services'),
(6, 2, 'D2.2', 'Gestion des incidents et des demandes d''assistance'),
(7, 2, 'D2.3', 'Gestion des problèmes et des changements'),
(8, 3, 'D3.1', 'Conception d''une solution d''infrastructure'),
(9, 3, 'D3.2', 'Installation d''une solution d''infrastructure'),
(10, 3, 'D3.3', 'Administration et supervision d''une infrastructure'),
(11, 4, 'D4.1', 'Conception et réalisation d''une solution applicative'),
(12, 4, 'D4.2', 'Maintenance d''une solution applicative'),
(13, 5, 'D5.1', 'Gestion des configurations'),
(14, 5, 'D5.2', 'Gestion des compétences');

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `groups`
--

INSERT INTO `groups` (`id`, `name`, `year`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 'SLAM16', '2016', 2, '2016-11-29 14:39:33', '2016-12-16 12:00:56'),
(4, 'SISR16', '2016', 3, '2016-11-29 15:50:45', '2016-11-29 15:50:45');

-- --------------------------------------------------------

--
-- Structure de la table `group_user`
--

CREATE TABLE IF NOT EXISTS `group_user` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `group_user`
--

INSERT INTO `group_user` (`user_id`, `group_id`) VALUES
(19, 1),
(32, 1),
(32, 4);

-- --------------------------------------------------------

--
-- Structure de la table `main_activities`
--

CREATE TABLE IF NOT EXISTS `main_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `main_activities`
--

INSERT INTO `main_activities` (`id`, `name`) VALUES
(6, 'Production d''une solution logicielle et d''infrastructure'),
(7, 'Prise en charge d''incidents et de demandes d''assistance'),
(10, 'Élaboration de documents relatifs à la production'),
(11, 'Mise en place d’un dispositif de veille technologique');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `productions`
--

CREATE TABLE IF NOT EXISTS `productions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `situation_id` int(11) DEFAULT NULL,
  `label` text,
  `address` text,
  PRIMARY KEY (`id`),
  KEY `situation_id` (`situation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `situations`
--

CREATE TABLE IF NOT EXISTS `situations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `context` varchar(255) DEFAULT NULL,
  `begin_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `environement` varchar(255) DEFAULT NULL,
  `tools` varchar(255) DEFAULT NULL,
  `validate` tinyint(4) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `situations`
--

INSERT INTO `situations` (`id`, `user_id`, `source_id`, `name`, `description`, `context`, `begin_at`, `end_at`, `environement`, `tools`, `validate`, `created_at`, `updated_at`, `deleted_at`, `viewed`) VALUES
(3, 27, 1, 'test', 'pewpew', NULL, '2016-12-13', '2017-01-08', NULL, NULL, 0, '2016-12-05 02:22:43', '2016-12-06 16:25:32', '2016-12-06 16:25:32', 0),
(4, 27, 2, 'gerger', 'regre', NULL, '2016-12-28', '2016-12-26', NULL, NULL, 0, '2016-12-05 02:29:41', '2016-12-06 16:29:08', '2016-12-06 16:29:08', 0),
(5, 27, 2, 'gerger', 'regre', NULL, '2016-12-28', '2016-12-26', NULL, NULL, 0, '2016-12-05 02:30:29', '2016-12-06 16:29:07', '2016-12-06 16:29:07', 0),
(6, 27, 2, 'gerger', 'regre', NULL, '2016-12-28', '2016-12-26', NULL, NULL, 0, '2016-12-05 02:31:01', '2016-12-06 16:27:33', '2016-12-06 16:27:33', 0),
(7, 27, 1, 'zerz', 'efz', NULL, '2016-12-14', '2016-12-28', NULL, NULL, 0, '2016-12-05 11:07:22', '2016-12-06 16:28:44', '2016-12-06 16:28:44', 0),
(8, 27, 1, 'zerzfe', 'efzefzz', NULL, '2016-12-15', '2016-12-28', NULL, NULL, 0, '2016-12-05 11:27:59', '2016-12-06 16:29:03', '2016-12-06 16:29:03', 0),
(9, 27, 1, 'hytjyujuyk,y', 'jytjtrhtrhrh', NULL, '2016-12-06', '2016-12-28', NULL, NULL, 0, '2016-12-05 11:48:13', '2016-12-06 16:29:06', '2016-12-06 16:29:06', 0),
(10, 26, 3, 'grgegegegeg', 'Suspendisse eget eros sollicitudin, venenatis sem nec, rutrum nulla. Fusce at gravida erat, nec molestie massa. Integer eget maximus dui, tristique finibus magna. Praesent fermentum, velit eget vehicula porta, felis ex porta massa, at pulvinar felis purus eget turpis. Phasellus vehicula nunc volutpat odio tristique scelerisque et eu dui. Morbi enim ex, ornare in risus ac, tincidunt molestie ante. Nunc consectetur sollicitudin posuere. Sed suscipit semper mauris et bibendum. Nulla quis justo turpis. Donec id neque mauris. Mauris ex lacus, aliquam sit amet dapibus in, aliquam in magna. Praesent vitae eros hendrerit, vulputate justo et, varius ipsum. Nam venenatis vel quam vitae tempor. Pellentesque ut leo pretium, molestie purus ut, gravida lectus. Vestibulum vel porttitor sem.', NULL, '2016-11-28', '2017-01-08', NULL, NULL, 0, '2016-12-05 12:22:33', '2016-12-07 13:53:12', NULL, 1),
(11, 27, 3, 'piou', 'gregfere', NULL, '2016-11-29', '2017-01-06', NULL, NULL, 0, '2016-12-05 14:13:09', '2016-12-06 16:29:09', '2016-12-06 16:29:09', 0),
(12, 27, 1, 'gergerafrefer', 'gregfere', NULL, '2016-12-08', '2016-12-27', NULL, NULL, 0, '2016-12-05 14:13:35', '2016-12-06 16:29:10', '2016-12-06 16:29:10', 0),
(13, 27, 1, 'gergerafrefer', 'gregfere', NULL, '2016-12-08', '2016-12-27', NULL, NULL, 0, '2016-12-05 14:13:41', '2016-12-06 16:29:11', '2016-12-06 16:29:11', 0),
(14, 27, 1, 'testsecu', 'gyt', NULL, '2016-12-30', '2017-01-05', NULL, NULL, 0, '2016-12-05 16:18:50', '2016-12-06 16:29:13', '2016-12-06 16:29:13', 0),
(15, 27, 1, 'rge', 'fefefre', NULL, '2016-12-07', '2016-12-29', NULL, NULL, 0, '2016-12-06 14:27:13', '2016-12-06 16:29:14', '2016-12-06 16:29:14', 0),
(16, 27, 1, 'test rephrasing', 'fefefre', NULL, '2016-12-08', '2017-01-05', NULL, NULL, 0, '2016-12-06 14:28:15', '2016-12-06 16:29:15', '2016-12-06 16:29:15', 0),
(17, 27, 1, 'test rephrasing', 'fefefre', NULL, '2016-12-08', '2017-01-05', NULL, NULL, 0, '2016-12-06 14:39:31', '2016-12-06 16:29:15', '2016-12-06 16:29:15', 0),
(18, 27, 1, 'test rephrasing', 'fefefre', NULL, '2016-12-08', '2017-01-05', NULL, NULL, 0, '2016-12-06 14:39:46', '2016-12-06 16:29:20', '2016-12-06 16:29:20', 0),
(19, 27, 1, 'test rephrasing', 'fefefre', NULL, '2016-12-08', '2017-01-05', NULL, NULL, 0, '2016-12-06 14:40:16', '2016-12-06 16:29:21', '2016-12-06 16:29:21', 0),
(20, 27, 1, 'test rephrasing', 'fefefre', NULL, '2016-12-08', '2017-01-05', NULL, NULL, 0, '2016-12-06 14:41:26', '2016-12-06 16:29:22', '2016-12-06 16:29:22', 0),
(21, 27, 1, 'test rephrasing', 'fefefre', NULL, '2016-12-08', '2017-01-05', NULL, NULL, 0, '2016-12-06 14:41:33', '2016-12-06 16:29:22', '2016-12-06 16:29:22', 0),
(22, 25, 1, 'test rephrasing', 'frfre', NULL, '2016-12-16', '2016-12-27', NULL, NULL, 0, '2016-12-06 14:48:59', '2016-12-07 14:13:48', '2016-12-07 14:13:48', 0),
(23, 25, 1, 'test rephrasing', 'frfre', NULL, '2016-12-16', '2016-12-27', NULL, NULL, 0, '2016-12-06 14:49:29', '2016-12-07 14:13:48', '2016-12-07 14:13:48', 0),
(24, 25, 1, 'test rephrasing', 'frfre', NULL, '2016-12-16', '2016-12-27', NULL, NULL, 0, '2016-12-06 14:49:42', '2016-12-07 14:13:49', '2016-12-07 14:13:49', 0),
(25, 25, 1, 'test rephrasing', 'frfre', NULL, '2016-12-16', '2016-12-27', NULL, NULL, 0, '2016-12-06 14:50:33', '2016-12-07 14:13:49', '2016-12-07 14:13:49', 0),
(26, 25, 1, 'test rephrasing', 'frfre', NULL, '2016-12-16', '2016-12-27', NULL, NULL, 0, '2016-12-06 14:51:34', '2016-12-07 14:13:49', '2016-12-07 14:13:49', 0),
(27, 25, 1, 'test rephrasing', 'frfre', NULL, '2016-12-16', '2016-12-27', NULL, NULL, 0, '2016-12-06 14:51:43', '2016-12-07 14:13:49', '2016-12-07 14:13:49', 0),
(28, 25, 1, 'test rephrasing', 'frfre', NULL, '2016-12-16', '2016-12-27', NULL, NULL, 0, '2016-12-06 14:51:47', '2016-12-07 14:13:49', '2016-12-07 14:13:49', 0),
(29, 25, 1, 'test rephrasing', 'frfre', NULL, '2016-12-16', '2016-12-27', NULL, NULL, 0, '2016-12-06 14:53:24', '2016-12-07 14:13:49', '2016-12-07 14:13:49', 0),
(30, 27, 1, 'test rephrasing', 'frfre', NULL, '2016-12-16', '2016-12-27', NULL, NULL, 0, '2016-12-06 14:53:57', '2016-12-07 14:24:38', NULL, 1),
(31, 27, 1, 'test rephrasing', 'frfre', NULL, '2016-12-16', '2016-12-27', NULL, NULL, 0, '2016-12-06 14:54:48', '2016-12-08 11:24:05', NULL, 1),
(32, 27, 1, 'test2', 'grgre', NULL, '2016-11-28', '2017-01-06', NULL, NULL, 0, '2016-12-06 15:19:32', '2016-12-07 14:24:38', NULL, 1),
(33, 27, 1, 'test3', 'eferf', NULL, '2016-12-15', '2017-01-06', NULL, NULL, 0, '2016-12-06 15:28:41', '2016-12-06 15:28:41', '2016-12-06 15:28:41', 0),
(35, 27, 1, 'fezfzf', 'fezfzf', NULL, '2016-12-09', '2016-12-27', NULL, NULL, 0, '2016-12-09 12:31:20', '2016-12-09 12:39:00', NULL, 1),
(36, 27, 1, 'testtest', 'test', NULL, '2016-12-24', '2017-01-08', NULL, NULL, 0, '2016-12-13 16:10:06', '2016-12-13 16:11:58', '2016-12-13 16:11:58', 0),
(37, 27, 2, 'blabla', 'fzefezfezfz', NULL, '2016-12-12', '2017-01-06', NULL, NULL, 0, '2016-12-15 10:54:06', '2016-12-15 10:54:06', NULL, 0),
(38, 27, 3, 'piou', 'fezffe', NULL, '2016-12-07', '2017-01-05', NULL, NULL, 0, '2016-12-15 11:10:41', '2016-12-15 11:10:41', NULL, 0),
(39, 27, 4, 'mouhahahaaha', 'regfregregr', NULL, '2016-12-04', '2016-12-26', NULL, NULL, 0, '2016-12-15 11:11:17', '2016-12-15 11:11:17', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) DEFAULT NULL,
  `nomenclature` varchar(50) DEFAULT NULL,
  `label` text,
  PRIMARY KEY (`id`),
  KEY `activity_id` (`activity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Contenu de la table `skills`
--

INSERT INTO `skills` (`id`, `activity_id`, `nomenclature`, `label`) VALUES
(1, 1, 'C1.1.1.1', 'Recenser et caractériser les contextes d''utilisation, les processus et les acteurs sur lesquels le service à produire aura un impact'),
(2, 1, 'C1.1.1.2', 'Identifier les fonctionnalités attendues du service à produire'),
(3, 1, 'C1.1.1.3', 'Préparer sa participation à une réunion'),
(4, 1, 'C1.1.1.4', 'Rédiger un compte-rendu d''entretien, de réunion'),
(5, 2, 'C1.1.2.1', 'Analyser les interactions entre services'),
(6, 2, 'C1.1.2.2', 'Recenser les composants de l''architecture technique sur lesquels le service à produire aura un impact'),
(7, 3, 'C1.1.3.1', 'Recenser et caractériser les exigences liées à la qualité attendue du service à produire'),
(8, 3, 'C1.1.3.2', 'Recenser et caractériser les exigences de sécurité pour le service à produire'),
(9, 4, 'C1.2.1.1', 'Recenser et caractériser des solutions répondant au cahier des charges (adaptation d''une solution existante ou réalisation d''une nouvelle)'),
(10, 4, 'C1.2.1.2', 'Estimer le coût d''une solution'),
(11, 4, 'C1.2.1.3', 'Rédiger un dossier de choix et un argumentaire technique'),
(12, 5, 'C1.2.2.1', 'Recenser les composants nécessaires à la réalisation de la solution retenue'),
(13, 5, 'C1.2.2.2', 'Décrire l''implantation des différents composants de la solution et les échanges entre eux '),
(14, 5, 'C1.2.2.3', 'Rédiger les spécifications fonctionnelles et techniques de la solution retenue dans le formalisme exigé par l''organisation'),
(15, 6, 'C1.2.3.1', 'Recenser les risques liés à une mauvaise utilisation ou à une utilisation malveillante du service'),
(16, 6, 'C1.2.3.2', 'Recenser les risques liés à un dysfonctionnement du service'),
(17, 6, 'C1.2.3.3', 'Prévoir les conséquences techniques de la non prise en compte d''un risque'),
(18, 7, 'C1.2.4.1', 'Recenser les tests d''acceptation nécessaires à la validation du service et les résultats attendus'),
(19, 7, 'C1.2.4.2', 'Préparer les jeux d''essai et les procédures pour la réalisation des tests'),
(20, 8, 'C1.2.5.1', 'Recenser les utilisateurs du service, leurs rôles et leur niveau de responsabilité'),
(21, 8, 'C1.2.5.2', 'Recenser les ressources liées à l''utilisation du service'),
(22, 8, 'C1.2.5.3', 'Proposer les niveaux d''habilitation associés au service'),
(23, 9, 'C1.3.1.1', 'Mettre en place l''environnement de test du service'),
(24, 9, 'C1.3.1.2', 'Tester le service'),
(25, 9, 'C1.3.1.3', 'Rédiger le rapport de test'),
(26, 10, 'C1.3.2.1', 'Identifier les éléments à sauvegarder et à journaliser pour assurer la continuité du service et la traçabilité des transactions'),
(27, 10, 'C1.3.2.2', 'Spécifier les procédures d''alerte associées au service'),
(28, 10, 'C1.3.2.3', 'Décrire les solutions de fonctionnement en mode dégradé et les procédures de reprise du service'),
(29, 11, 'C1.3.3.1', 'Mettre en place l''environnement de formation au nouveau service'),
(30, 11, 'C1.3.3.2', 'Informer et former les utilisateurs'),
(31, 12, 'C1.3.4.1', 'Mettre au point une procédure d''installation de la solution'),
(32, 12, 'C1.3.4.2', 'Automatiser l''installation de la solution '),
(33, 12, 'C1.3.4.3', 'Mettre en exploitation le service'),
(34, 13, 'C1.4.1.1', 'Établir son planning personnel en fonction des exigences et du déroulement du projet'),
(35, 13, 'C1.4.1.2', 'Rendre compte de son activité'),
(36, 14, 'C1.4.2.1', 'Suivre l''exécution du projet'),
(37, 14, 'C1.4.2.2', 'Analyser les écarts entre temps prévu et temps consommé'),
(38, 14, 'C1.4.2.3', 'Contribuer à l''évaluation du projet'),
(39, 15, 'C1.4.3.1', 'Recenser les ressources humaines, matérielles, logicielles et budgétaires nécessaires à l''exécution du projet et de ses tâches personnelles'),
(40, 15, 'C1.4.3.2', 'Adapter son planning personnel en fonction des ressources disponibles'),
(41, 16, 'C2.1.1.1', 'Aider les utilisateurs dans l''appropriation du nouveau service'),
(42, 16, 'C2.1.1.2', 'Identifier des besoins de formation complémentaires'),
(43, 16, 'C2.1.1.3', 'Rendre compte de la satisfaction des utilisateurs'),
(44, 17, 'C2.1.2.1', 'Analyser les indicateurs de qualité du service'),
(45, 17, 'C2.1.2.2', 'Appliquer les procédures d''alerte destinées à rétablir la qualité du service'),
(46, 17, 'C2.1.2.3', 'Vérifier périodiquement le fonctionnement du service en mode dégradé et la disponibilité des éléments permettant une reprise du service'),
(47, 17, 'C2.1.2.4', 'Superviser les services et leur utilisation'),
(48, 17, 'C2.1.2.5', 'Contrôler la confidentialité et l''intégrité des données'),
(49, 17, 'C2.1.2.6', 'Exploiter les indicateurs et les fichiers d''audit'),
(50, 17, 'C2.1.2.7', 'Produire les rapports d''activité demandés par les différents acteurs'),
(51, 18, 'C2.2.1.1', 'Résoudre l''incident en s''appuyant sur une base de connaissances et la documentation associée ou solliciter l''entité compétente'),
(52, 18, 'C2.2.1.2', 'Prendre le contrôle d''un système à distance'),
(53, 18, 'C2.2.1.3', 'Rédiger un rapport d''incident et mémoriser l''incident et sa résolution dans une base de connaissances'),
(54, 18, 'C2.2.1.4', 'Faire évoluer une procédure de résolution d''incident'),
(55, 19, 'C2.2.2.1', 'Identifier le niveau d''assistance souhaité et proposer une réponse adaptée en s''appuyant sur une base de connaissances et sur la documentation associée ou solliciter l''entité compétente'),
(56, 19, 'C2.2.2.2', 'Informer l''utilisateur de la situation de sa demande'),
(57, 19, 'C2.2.2.3', 'Prendre le contrôle d''un poste utilisateur à distance'),
(58, 19, 'C2.2.2.4', 'Mémoriser la demande d''assistance et sa réponse dans une base de connaissances'),
(59, 20, 'C2.2.3.1', 'Appliquer la procédure de continuité du service en mode dégradé'),
(60, 20, 'C2.2.3.2', 'Appliquer la procédure de reprise du service'),
(61, 21, 'C2.3.1.1', 'Repérer une suite de dysfonctionnements récurrents d''un service'),
(62, 21, 'C2.3.1.2', 'Identifier les causes de ce dysfonctionnement'),
(63, 21, 'C2.3.1.3', 'Qualifier le problème (contexte et environnement)'),
(64, 21, 'C2.3.1.4', 'Définir le degré d''urgence du problème'),
(65, 21, 'C2.3.1.5', 'Évaluer les conséquences techniques du problème'),
(66, 22, 'C2.3.2.1', 'Décrire les incidences d''un changement proposé sur le service'),
(67, 22, 'C2.3.2.2', 'Évaluer le délai et le coût de réalisation du changement proposé'),
(68, 22, 'C2.3.2.3', 'Recenser les risques techniques, humains, financiers et juridiques associés au changement proposé'),
(69, 23, 'C3.1.1.1', 'Lister les composants matériels et logiciels nécessaires à la prise en charge des processus, des flux d''information et de leur rôle'),
(70, 23, 'C3.1.1.2', 'Caractériser les éléments d''interconnexion, les services, les serveurs et les équipements terminaux nécessaires'),
(71, 23, 'C3.1.1.3', 'Caractériser les éléments permettant d''assurer la qualité et la sécurité des services'),
(72, 23, 'C3.1.1.4', 'Recenser les modifications et/ou les acquisitions nécessaires à la mise en place d''une solution d''infrastructure compatible avec le budget et le planning prévisionnels'),
(73, 23, 'C3.1.1.5', 'Caractériser les solutions d''interconnexion utilisées entre un réseau et d''autres réseaux internes ou externes à l''organisation'),
(74, 24, 'C3.1.2.1', 'Concevoir une maquette de la solution'),
(75, 24, 'C3.1.2.2', 'Construire un prototype de la solution'),
(76, 24, 'C3.1.2.3', 'Préparer l''intégration d''un composant d''infrastructure'),
(77, 25, 'C3.1.3.1', 'Caractériser des solutions de sécurité et en évaluer le coût'),
(78, 25, 'C3.1.3.2', 'Proposer une solution de sécurité compatible avec les contraintes techniques, financières, juridiques et organisationnelles'),
(79, 25, 'C3.1.3.3', 'Décrire une solution de sécurité et les risques couverts'),
(80, 26, 'C3.2.1.1', 'Installer et configurer un élément d''interconnexion, un service, un serveur, un équipement terminal utilisateur'),
(81, 26, 'C3.2.1.2', 'Installer et configurer un élément d''infrastructure permettant d''assurer la continuité de service, un système de régulation des éléments d''infrastructure, un outil de métrologie, un dispositif d''alerte'),
(82, 26, 'C3.2.1.3', 'Installer et configurer des éléments de sécurité permettant d''assurer la protection du système informatique'),
(83, 27, 'C3.2.2.1', 'Élaborer une procédure de remplacement ou de migration respectant la continuité d''un service'),
(84, 27, 'C3.2.2.2', 'Mettre en œuvre une procédure de remplacement ou de migration'),
(85, 28, 'C3.2.3.1', 'Repérer les éléments de la documentation à mettre à jour'),
(86, 28, 'C3.2.3.2', 'Mettre à jour la documentation'),
(87, 29, 'C3.3.1.1', 'Installer et configurer des éléments d''administration sur site ou à distance'),
(88, 29, 'C3.3.1.2', 'Administrer des éléments d''infrastructure sur site ou à distance'),
(89, 30, 'C3.3.2.1', 'Installer et configurer des outils de sauvegarde et de restauration'),
(90, 30, 'C3.3.2.2', 'Définir des procédures de sauvegarde et de restauration'),
(91, 30, 'C3.3.2.3', 'Appliquer des procédures de sauvegarde et de restauration'),
(92, 31, 'C3.3.3.1', 'Identifier les besoins en gestion d''identité permettant de protéger les éléments d''une infrastructure'),
(93, 31, 'C3.3.3.2', 'Gérer des utilisateurs et une structure organisationnelle'),
(94, 31, 'C3.3.3.3', 'Affecter des droits aux utilisateurs sur les éléments d''une solution d''infrastructure'),
(95, 32, 'C3.3.4.1', 'Repérer les tâches d''administration à automatiser'),
(96, 32, 'C3.3.4.2', 'Concevoir, réaliser et mettre en place une procédure d''automatisation'),
(97, 33, 'C3.3.5.1', 'Installer et configurer les outils nécessaires à la production d''indicateurs d''activité et à l''exploitation de fichiers d''activité'),
(98, 33, 'C3.3.5.2', 'Assurer la confidentialité des informations collectées et traitées'),
(99, 34, 'C4.1.1.1', 'Identifier les composants logiciels nécessaires à la conception de la solution'),
(100, 34, 'C4.1.1.2', 'Estimer les éléments de coût et le délai de mise en œuvre de la solution'),
(101, 35, 'C4.1.2.1', 'Définir les spécifications de l''interface utilisateur de la solution applicative'),
(102, 35, 'C4.1.2.2', 'Maquetter un élément de la solution applicative'),
(103, 35, 'C4.1.2.3', 'Concevoir et valider la maquette en collaboration avec des utilisateurs'),
(104, 36, 'C4.1.3.1', 'Modéliser le schéma de données nécessaire à la mise en place de la solution applicative'),
(105, 36, 'C4.1.3.2', 'Implémenter le schéma de données dans un SGBD'),
(106, 36, 'C4.1.3.3', 'Programmer des éléments de la solution applicative dans le langage d''un SGBD'),
(107, 36, 'C4.1.3.4', 'Manipuler les données liées à la solution applicative à travers un langage de requête'),
(108, 37, 'C4.1.4.1', 'Recenser et caractériser les composants existants ou à développer utiles à la réalisation de la solution applicative dans le respect des budgets et planning prévisionnels'),
(109, 38, 'C4.1.5.1', 'Choisir les éléments de la solution à prototyper'),
(110, 38, 'C4.1.5.2', 'Développer un prototype'),
(111, 38, 'C4.1.5.3', 'Valider un prototype'),
(112, 39, 'C4.1.6.1', 'Mettre en place et exploiter un environnement de développement'),
(113, 39, 'C4.1.6.2', 'Mettre en place et exploiter un environnement de test'),
(114, 40, 'C4.1.7.1', 'Développer les éléments d''une solution'),
(115, 40, 'C4.1.7.2', 'Créer un composant logiciel'),
(116, 40, 'C4.1.7.3', 'Analyser et modifier le code d''un composant logiciel'),
(117, 40, 'C4.1.7.4', 'Utiliser des composants d''accès aux données'),
(118, 40, 'C4.1.7.5', 'Mettre en place des éléments de sécurité liés à l''utilisation d''un composant logiciel'),
(119, 41, 'C4.1.8.1', 'Élaborer et réaliser des tests unitaires'),
(120, 41, 'C4.1.8.2', 'Mettre en évidence et corriger les écarts'),
(121, 42, 'C4.1.9.1', 'Produire ou mettre à jour la documentation technique d''une solution applicative et de ses composants logiciels'),
(122, 43, 'C4.1.10.1', 'Rédiger la documentation d''utilisation, une aide en ligne, une FAQ'),
(123, 43, 'C4.1.10.2', 'Adapter la documentation d''utilisation à chaque contexte d''utilisation'),
(124, 44, 'C4.2.1.1', 'Élaborer un jeu d''essai permettant de reproduire le dysfonctionnement'),
(125, 44, 'C4.2.1.2', 'Repérer les composants à l''origine du dysfonctionnement'),
(126, 44, 'C4.2.1.3', 'Concevoir les mises à jour à effectuer'),
(127, 44, 'C4.2.1.4', 'Réaliser les mises à jour'),
(128, 45, 'C4.2.2.1', 'Repérer les évolutions des composants utilisés et leurs conséquences'),
(129, 45, 'C4.2.2.2', 'Concevoir les mises à jour à effectuer'),
(130, 45, 'C4.2.2.3', 'Élaborer et réaliser les tests unitaires des composants mis à jour'),
(131, 46, 'C4.2.3.1', 'Élaborer et réaliser des tests d''intégration et de non régression de la solution mise à jour'),
(132, 46, 'C4.2.3.2', 'Concevoir une procédure de migration et l''appliquer dans le respect de la continuité de service'),
(133, 47, 'C4.2.4.1', 'Repérer les éléments de la documentation à mettre à jour'),
(134, 47, 'C4.2.4.2', 'Mettre à jour une documentation'),
(135, 48, 'C5.1.1.1', 'Recenser les caractéristiques techniques nécessaires à la gestion des éléments de la configuration d''une organisation'),
(136, 48, 'C5.1.1.2', 'Paramétrer une solution de gestion des éléments d''une configuration'),
(137, 49, 'C5.1.2.1', 'Renseigner les événements relatifs au cycle de vie d''un élément de la configuration'),
(138, 49, 'C5.1.2.2', 'Actualiser les caractéristiques des éléments de la configuration'),
(139, 50, 'C5.1.3.1', 'Contrôler et auditer les éléments de la configuration'),
(140, 50, 'C5.1.3.2', 'Reconstituer un historique des modifications effectuées sur les éléments de la configuration'),
(141, 50, 'C5.1.3.3', 'Identifier les éléments de la configuration à modifier ou à remplacer'),
(142, 50, 'C5.1.3.4', 'Repérer les équipements obsolètes et en proposer le traitement dans le respect de la réglementation en vigueur'),
(143, 51, 'C5.1.4.1', 'Assister la maîtrise d''ouvrage dans l''analyse technique de la proposition de contrat'),
(144, 51, 'C5.1.4.2', 'Interpréter des indicateurs de suivi de la prestation associée à la proposition de contrat'),
(145, 51, 'C5.1.4.3', 'Renseigner les éléments permettant d''estimer la valeur du service'),
(146, 52, 'C5.1.5.1', 'Vérifier un plan d''amortissement'),
(147, 52, 'C5.1.5.2', 'Apprécier la valeur actuelle d''un élément de configuration'),
(148, 53, 'C5.1.6.1', 'Renseigner les variables d''une étude de rentabilité d''un investissement'),
(149, 53, 'C5.1.6.2', 'Caractériser et prévoir les investissements matériels et logiciels'),
(150, 54, 'C5.2.1.1', 'Évaluer le degré de conformité des pratiques à un référentiel, à une norme ou à un standard adopté par le prestataire informatique'),
(151, 54, 'C5.2.1.2', 'Identifier et partager les bonnes pratiques à intégrer'),
(152, 55, 'C5.2.2.1', 'Définir une stratégie de recherche d''informations'),
(153, 55, 'C5.2.2.2', 'Tenir à jour une liste de sources d''information'),
(154, 55, 'C5.2.2.3', 'Évaluer la qualité d''une source d''information en fonction d''un besoin'),
(155, 55, 'C5.2.2.4', 'Synthétiser et diffuser les résultats d''une veille'),
(156, 56, 'C5.2.3.1', 'Identifier les besoins de formation pour mettre en œuvre une technologie, un composant, un outil ou une méthode'),
(157, 56, 'C5.2.3.2', 'Repérer l''offre et les dispositifs de formation'),
(158, 57, 'C5.2.4.1', 'Se documenter à propos d‘une technologie, d''un composant, d''un outil ou d''une méthode'),
(159, 57, 'C5.2.4.2', 'Identifier le potentiel et les limites d''une technologie, d''un composant, d''un outil ou d''une méthode par rapport à un service à produire');

-- --------------------------------------------------------

--
-- Structure de la table `sources`
--

CREATE TABLE IF NOT EXISTS `sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `sources`
--

INSERT INTO `sources` (`id`, `label`, `description`) VALUES
(1, 'Stage 1', 'SITUATIONS VECUES EN STAGE DE PREMIERE ANNEE DANS L''ORGANISATION'),
(2, 'Stage 2', 'SITUATIONS VECUES EN STAGE DE DEUXIEME ANNEE DANS L''ORGANISATION'),
(3, 'TP', 'SITUATIONS VECUES EN FORMATION(TP)'),
(4, 'PPE', 'SITUATIONS VECUES EN FORMATION(PPE)');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `level` tinyint(4) DEFAULT '2',
  `remember_token` varchar(60) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_index` (`email`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `group_id`, `first_name`, `last_name`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, NULL, 'Georges', 'DE REMUSAT', 'gderemusat@gmail.com', '$2y$10$bJUa/t.ySIShwoHUBv0T6O0Cda9xRo487v9rpLaK6u1KMxd19khYu', 0, 'xPWu2T48wj9MxEOcClgCDo7Lzu04RBAgBlauIUp9etlJ1fK2OXIo1g8ORgSt', '0000-00-00 00:00:00', '2016-12-16 14:55:48', NULL),
(7, 4, 'Emeline', 'COMBELLES', 'fakemail1@mail.com', '$2y$10$oVXZWG3EK9F4DjY3L6PvVu.5m0ehiv/iTveMH/z7gldiR0u3rvoDS', 2, NULL, '2016-11-30 12:15:45', '2016-12-16 12:05:17', NULL),
(8, 4, 'Léa', 'FERREIRA', 'fakemai2l@mail.com', '$2y$10$9SQGJCsmkqTPks.CmMHD..o2NGK8m8kfoSsXJxr.UUqtypnooZVRC', 2, NULL, '2016-11-30 12:15:46', '2016-12-16 12:05:17', NULL),
(9, 4, 'Camille', 'GENAU', 'fakemail3@mail.com', '$2y$10$9QlcZv/18ZLDzW5jvGiM5uf6CjgKBjs.1W/nDqBKP.Ckw6H3th24y', 2, NULL, '2016-11-30 12:15:46', '2016-12-16 12:05:17', NULL),
(11, 4, 'Kamille', 'BEHARY LAUL SIRDER', 'fakemail@mail.com', '$2y$10$cSEioLm.Xbsi84hp6WAFMOuLj6W40LxR2WCEBqKaX5v4OMKBAcbg6', 2, NULL, '2016-11-30 12:35:30', '2016-12-16 12:05:17', NULL),
(18, 1, 'fref', 'ref', 'gr@gre.com', '$2y$10$BRQVErHVtRWA9HuPE0q5FuKR9jvtsjmYUsk9U9LQ76RTkdITtPz6O', 2, NULL, '2016-12-01 15:32:45', '2016-12-16 12:05:17', NULL),
(19, NULL, 'mister', 'teacher', 'mt@mt.co', '$2a$06$nirk2/gkvlA/hBzBdZed/efXnz8OBWzF2cQ2ORnhu7rYJBOqMbO.W', 1, 'YTJzbwiMqvaBD6jR4PQJHitPCUFaoey4Z7HwO2MPkiaxa2EzpyK4Nc5dBONl', '0000-00-00 00:00:00', '2016-12-16 14:47:07', NULL),
(24, 1, 'azez', 'aze', 'mc@mc.mc', '$2y$10$KCXIz7MtjXQlCfkCi8..m.aIHZ4y/SfDoH1Vl6vQuSxXV5twYqgIS', 2, NULL, '2016-12-02 11:12:03', '2016-12-02 11:12:07', '2016-12-02 11:12:07'),
(25, 1, 'Brittany', 'LOISEAUs', 'fakemail5@mail.com', '$2y$10$fCkK9/GobuM.PFHXXib/teeZDOlnNeW.7LDjWLzMEcdtkNbKoYK.O', 2, NULL, '2016-12-02 12:27:16', '2016-12-07 14:13:49', '2016-12-07 14:13:49'),
(26, 1, 'test', 'test', 'test@test.test', '$2y$10$wTD5kv5Y3tRIlppK3jeQ3O.oS3QQ1xIWjmJosVPyQCCjeg.2RV8cW', 2, NULL, '2016-12-02 16:31:34', '2016-12-16 12:05:17', NULL),
(27, 1, 'pew', 'pew', 'pewpew@pew.com', '$2y$10$JN0qgLvuKba76f2uTqGq3.meJTZiSrjOn8W7sBlb/Ey3RuW2DL4u.', 2, 'vKSer9O0527TKJgp14ZzwGVgNvqPcuVUVyKvmhvpFSxj0dbloH6hERR8DRDw', '2016-12-04 02:23:36', '2016-12-16 15:43:02', NULL),
(32, NULL, 'prof', 'testprof', 'prof@test.com', NULL, 1, NULL, '2016-12-16 16:57:31', '2016-12-16 16:57:32', NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`);

--
-- Contraintes pour la table `activity_category`
--
ALTER TABLE `activity_category`
  ADD CONSTRAINT `activity_category_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`),
  ADD CONSTRAINT `activity_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`situation_id`) REFERENCES `situations` (`id`);

--
-- Contraintes pour la table `domains`
--
ALTER TABLE `domains`
  ADD CONSTRAINT `domains_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `group_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `group_user_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Contraintes pour la table `productions`
--
ALTER TABLE `productions`
  ADD CONSTRAINT `productions_ibfk_1` FOREIGN KEY (`situation_id`) REFERENCES `situations` (`id`);

--
-- Contraintes pour la table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
