-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 09 jan. 2021 à 20:30
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `thequiz`
--

-- --------------------------------------------------------

--
-- Structure de la table `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `id_card` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_card_package` bigint(20) UNSIGNED NOT NULL COMMENT 'cle etrangere ''card_package''',
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `fake_answers` varchar(255) NOT NULL COMMENT 'chaque reponse est separee par '',''',
  PRIMARY KEY (`id_card`),
  KEY `id_card_package` (`id_card_package`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `card_package`
--

DROP TABLE IF EXISTS `card_package`;
CREATE TABLE IF NOT EXISTS `card_package` (
  `id_card_package` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_package_image` bigint(20) UNSIGNED NOT NULL COMMENT 'cle etrangere ''package_image''',
  `id_theme` bigint(20) UNSIGNED NOT NULL COMMENT 'cle etrangere ''theme''',
  PRIMARY KEY (`id_card_package`),
  KEY `id_package_image` (`id_package_image`),
  KEY `id_theme` (`id_theme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id_history` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) UNSIGNED NOT NULL COMMENT 'cle etrangere ''user''',
  `id_card_package` bigint(20) UNSIGNED NOT NULL COMMENT 'cle etrangere ''card_package''',
  `points_win` smallint(5) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `others_user` varchar(128) DEFAULT NULL COMMENT 'id user separe par '','' ou NULL',
  PRIMARY KEY (`id_history`),
  KEY `id_user` (`id_user`),
  KEY `id_card_package` (`id_card_package`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `package_image`
--

DROP TABLE IF EXISTS `package_image`;
CREATE TABLE IF NOT EXISTS `package_image` (
  `id_package_image` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_package_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id_permission` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `admin_access` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_permission`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `permission`
--

INSERT INTO `permission` (`id_permission`, `name`, `admin_access`) VALUES
(1, 'Administrateur', 0),
(2, 'Joueur', 1);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id_theme` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(70) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `id_permission` bigint(20) UNSIGNED NOT NULL COMMENT 'cle etrangere ''permission''',
  `points` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo` (`pseudo`),
  KEY `id_permission` (`id_permission`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `fk_card_card_package` FOREIGN KEY (`id_card_package`) REFERENCES `card_package` (`id_card_package`);

--
-- Contraintes pour la table `card_package`
--
ALTER TABLE `card_package`
  ADD CONSTRAINT `fk_card_package_image` FOREIGN KEY (`id_package_image`) REFERENCES `package_image` (`id_package_image`),
  ADD CONSTRAINT `fk_card_package_theme` FOREIGN KEY (`id_theme`) REFERENCES `theme` (`id_theme`);

--
-- Contraintes pour la table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_card_package` FOREIGN KEY (`id_card_package`) REFERENCES `card_package` (`id_card_package`),
  ADD CONSTRAINT `fk_history_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_permission` FOREIGN KEY (`id_permission`) REFERENCES `permission` (`id_permission`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
