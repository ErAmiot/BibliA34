-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 23 mai 2019 à 10:54
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdbiblia34`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `AUT_NUM` int(11) NOT NULL AUTO_INCREMENT,
  `AUT_NOM` char(50) COLLATE utf8_bin NOT NULL,
  `AUT_PRENOM` char(30) COLLATE utf8_bin DEFAULT NULL,
  `AUT_PHOTO` text COLLATE utf8_bin,
  PRIMARY KEY (`AUT_NUM`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`AUT_NUM`, `AUT_NOM`, `AUT_PRENOM`, `AUT_PHOTO`) VALUES
(2, 'S&eacute;han', 'Jean-Fran&ccedil;ois', NULL),
(3, 'Combaudon', 'St&eacute;phane', NULL),
(4, 'Jean', 'Francois', NULL),
(5, 'Patrick', 'Patrack', NULL),
(6, 'Faggot', 'Jhonny', NULL),
(7, 'Meyer', 'Reto', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `CLIENT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLIENT_NOM` varchar(25) COLLATE utf8_bin NOT NULL,
  `CLIENT_PRENOM` varchar(30) COLLATE utf8_bin NOT NULL,
  `CLIENT_TEL` varchar(10) COLLATE utf8_bin NOT NULL,
  `CLIENT_ADR` varchar(50) COLLATE utf8_bin NOT NULL,
  `CLIENT_VILLE` varchar(20) COLLATE utf8_bin NOT NULL,
  `CLIENT_CP` int(11) NOT NULL,
  `CLIENT_MAIL` varchar(50) COLLATE utf8_bin NOT NULL,
  `CLIENT_MDP` varchar(32) COLLATE utf8_bin NOT NULL,
  `CLIENT_PHOTO` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  PRIMARY KEY (`CLIENT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`CLIENT_ID`, `CLIENT_NOM`, `CLIENT_PRENOM`, `CLIENT_TEL`, `CLIENT_ADR`, `CLIENT_VILLE`, `CLIENT_CP`, `CLIENT_MAIL`, `CLIENT_MDP`, `CLIENT_PHOTO`) VALUES
(6, 'Ayrault', 'Fred', '0612365478', '6 Rue St-Aignan', 'Orléans', 45000, 'ayrault.fred@gmail.com', 'f2cb32166f77f33e80311be40c97466e', 'ayrault'),
(7, 'Samyn', 'Valentin', '0612345678', '42 Rue Emile Zola', 'Fleury-Les-Aubrais', 45400, 'valentinsamyn@gmail.com', '76bf1508c054395f67a605468d76c22f', 'samyn'),
(12, 'Amiot', 'Erwann', '0123456789', '4 rue ouiouiland', 'disney', 5887, 'er.amiot@outlook.fr', '4a77d2e4da0b42a1ac6513a3fa0106b0', 'bonsoir.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `collection`
--

DROP TABLE IF EXISTS `collection`;
CREATE TABLE IF NOT EXISTS `collection` (
  `COL_NUM` int(11) NOT NULL AUTO_INCREMENT,
  `EDIT_NUM` int(11) NOT NULL,
  `COL_NOM` char(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`COL_NUM`),
  KEY `REALISER_FK` (`EDIT_NUM`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `collection`
--

INSERT INTO `collection` (`COL_NUM`, `EDIT_NUM`, `COL_NOM`) VALUES
(3, 4, 'Le Livre De'),
(4, 5, 'MariaDB'),
(5, 6, ' R&eacute;f&eacute;rence');

-- --------------------------------------------------------

--
-- Structure de la table `correspondre`
--

DROP TABLE IF EXISTS `correspondre`;
CREATE TABLE IF NOT EXISTS `correspondre` (
  `RUB_ID` int(11) NOT NULL,
  `LIV_ISBN` char(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`RUB_ID`,`LIV_ISBN`),
  KEY `LIEN_7_FK` (`RUB_ID`),
  KEY `LIEN_8_FK` (`LIV_ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `correspondre`
--

INSERT INTO `correspondre` (`RUB_ID`, `LIV_ISBN`) VALUES
(1, '333-3-3333-3333-3'),
(1, '978-2-4090-0962-4'),
(2, '555-5-5555-5555-5'),
(2, '978-2-4090-0962-4'),
(3, '555-5-5555-5555-5');

-- --------------------------------------------------------

--
-- Structure de la table `ecrire`
--

DROP TABLE IF EXISTS `ecrire`;
CREATE TABLE IF NOT EXISTS `ecrire` (
  `AUT_NUM` int(11) NOT NULL,
  `LIV_ISBN` char(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`AUT_NUM`,`LIV_ISBN`),
  KEY `LIEN_10_FK` (`AUT_NUM`),
  KEY `LIEN_11_FK` (`LIV_ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ecrire`
--

INSERT INTO `ecrire` (`AUT_NUM`, `LIV_ISBN`) VALUES
(2, '333-3-3333-3333-3'),
(2, '978-2-4090-0962-4'),
(3, '333-3-3333-3333-3'),
(3, '978-2-4090-0962-4'),
(6, '555-5-5555-5555-5');

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

DROP TABLE IF EXISTS `editeur`;
CREATE TABLE IF NOT EXISTS `editeur` (
  `EDIT_NOM` char(30) COLLATE utf8_bin NOT NULL,
  `EDIT_ADRWEB` char(100) COLLATE utf8_bin DEFAULT NULL,
  `EDIT_NUM` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`EDIT_NUM`),
  UNIQUE KEY `EDIT_NUM` (`EDIT_NUM`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `editeur`
--

INSERT INTO `editeur` (`EDIT_NOM`, `EDIT_ADRWEB`, `EDIT_NUM`) VALUES
('First Interactive', 'www.firstinteractive.com', 4),
('ENI', 'www.editions-eni.fr', 5),
('Pearson', 'https://www.pearson.fr/', 6);

-- --------------------------------------------------------

--
-- Structure de la table `emprunter`
--

DROP TABLE IF EXISTS `emprunter`;
CREATE TABLE IF NOT EXISTS `emprunter` (
  `LIV_ISBN` char(20) COLLATE utf8_bin NOT NULL,
  `CLIENT_ID` int(11) NOT NULL,
  `EMP_ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMP_DATE` date NOT NULL,
  `EMP_ETAT` tinyint(1) NOT NULL,
  `EMP_DATE_R_MAX` date NOT NULL,
  `EMP_DATE_R_REEL` date DEFAULT NULL,
  `AVIS_EMPRUNTER` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`EMP_ID`),
  KEY `FK_EMP_CLI` (`CLIENT_ID`),
  KEY `FK_EMP_ISBN` (`LIV_ISBN`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `emprunter`
--

INSERT INTO `emprunter` (`LIV_ISBN`, `CLIENT_ID`, `EMP_ID`, `EMP_DATE`, `EMP_ETAT`, `EMP_DATE_R_MAX`, `EMP_DATE_R_REEL`, `AVIS_EMPRUNTER`) VALUES
('978-2-4090-0962-4', 6, 9, '2019-01-23', 1, '2019-02-22', '2019-01-25', ''),
('333-3-3333-3333-3', 6, 23, '2019-02-01', 1, '2019-03-03', '2019-02-01', ''),
('555-5-5555-5555-5', 6, 24, '2019-02-01', 1, '2019-03-03', '2019-02-01', NULL),
('978-2-4090-0962-4', 7, 25, '2019-02-01', 1, '2019-03-03', '2019-02-01', NULL),
('555-5-5555-5555-5', 7, 26, '2019-03-29', 1, '2019-04-28', '2019-03-29', NULL),
('333-3-3333-3333-3', 6, 27, '2019-04-04', 1, '2019-05-04', '2019-04-04', ''),
('333-3-3333-3333-3', 6, 28, '2019-04-04', 1, '2019-05-04', '2019-04-04', ''),
('333-3-3333-3333-3', 7, 29, '2019-04-04', 1, '2019-05-04', '2019-04-04', NULL),
('333-3-3333-3333-3', 7, 30, '2019-04-04', 1, '2019-05-04', '2019-04-04', NULL),
('333-3-3333-3333-3', 12, 31, '2019-04-04', 1, '2019-05-04', '2019-04-04', NULL),
('333-3-3333-3333-3', 6, 32, '2019-04-05', 1, '2019-05-05', '2019-04-05', ''),
('333-3-3333-3333-3', 6, 33, '2019-04-05', 1, '2019-05-05', '2019-04-05', ''),
('333-3-3333-3333-3', 7, 34, '2019-04-05', 1, '2019-05-05', '2019-04-05', NULL),
('333-3-3333-3333-3', 12, 35, '2019-04-05', 1, '2019-05-05', '2019-04-05', NULL),
('333-3-3333-3333-3', 6, 36, '2019-05-03', 0, '2019-06-02', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fileattente`
--

DROP TABLE IF EXISTS `fileattente`;
CREATE TABLE IF NOT EXISTS `fileattente` (
  `LIV_ISBN` char(20) COLLATE utf8_bin NOT NULL,
  `CLIENT_ID` int(11) NOT NULL,
  `NUM_ATTENTE` int(11) NOT NULL,
  PRIMARY KEY (`CLIENT_ID`,`LIV_ISBN`),
  KEY `FK_ATTENTE_LIEN_8_LIVRE` (`LIV_ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `fileattente`
--

INSERT INTO `fileattente` (`LIV_ISBN`, `CLIENT_ID`, `NUM_ATTENTE`) VALUES
('333-3-3333-3333-3', 6, 0),
('333-3-3333-3333-3', 7, 1),
('333-3-3333-3333-3', 12, 2);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `LIV_ISBN` char(20) COLLATE utf8_bin NOT NULL,
  `COL_NUM` int(11) DEFAULT NULL,
  `EDIT_NUM` int(11) NOT NULL,
  `LIV_TITRE` char(100) COLLATE utf8_bin NOT NULL,
  `LIV_DATE` char(20) COLLATE utf8_bin DEFAULT NULL,
  `LIV_IMG` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `LIV_RESUME` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `LIV_ETAT` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `LIV_EMPRUNTER` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`LIV_ISBN`),
  KEY `APPARTIENT_FK` (`COL_NUM`),
  KEY `EDITER_FK` (`EDIT_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`LIV_ISBN`, `COL_NUM`, `EDIT_NUM`, `LIV_TITRE`, `LIV_DATE`, `LIV_IMG`, `LIV_RESUME`, `LIV_ETAT`, `LIV_EMPRUNTER`) VALUES
('333-3-3333-3333-3', 3, 4, 'Je suis un livre', '2019-02-01', 'balloon-2331488_960_720.jpg', 'errebe', '', 1),
('555-5-5555-5555-5', 3, 4, 'mpmpmppmp', '2019-02-01', 'the-glace-gel_1-940x572.jpg', 'vzevzeze', '', 0),
('978-2-4090-0962-4', 4, 5, 'MariaDB Administration et optimisation', '2017-06-15', 'mariadb.jpg', 'Bonsoir', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `LOGID` varchar(20) COLLATE utf8_bin NOT NULL,
  `PWD` varchar(70) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`LOGID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`LOGID`, `PWD`) VALUES
('Admin', 'e3afed0047b08059d0fada10f400c1e5');

-- --------------------------------------------------------

--
-- Structure de la table `rubriques`
--

DROP TABLE IF EXISTS `rubriques`;
CREATE TABLE IF NOT EXISTS `rubriques` (
  `RUB_ID` int(11) NOT NULL,
  `RUB_NOM` char(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`RUB_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `rubriques`
--

INSERT INTO `rubriques` (`RUB_ID`, `RUB_NOM`) VALUES
(1, 'Base de donn&eacute;es'),
(2, 'Bureautique'),
(3, 'Conception et developpement web'),
(4, 'Langage'),
(5, 'R&eacute;seau'),
(6, 'Syst&egrave;mes d exploitation'),
(7, 'T&eacute;l&eacute;phonie'),
(8, 'erez');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `FK_COLLECTI_REALISER_EDITEUR` FOREIGN KEY (`EDIT_NUM`) REFERENCES `editeur` (`EDIT_NUM`);

--
-- Contraintes pour la table `correspondre`
--
ALTER TABLE `correspondre`
  ADD CONSTRAINT `FK_CORRESPO_LIEN_7_RUBRIQUE` FOREIGN KEY (`RUB_ID`) REFERENCES `rubriques` (`RUB_ID`),
  ADD CONSTRAINT `FK_CORRESPO_LIEN_8_LIVRE` FOREIGN KEY (`LIV_ISBN`) REFERENCES `livre` (`LIV_ISBN`);

--
-- Contraintes pour la table `ecrire`
--
ALTER TABLE `ecrire`
  ADD CONSTRAINT `FK_ECRIRE_LIEN_10_AUTEUR` FOREIGN KEY (`AUT_NUM`) REFERENCES `auteur` (`AUT_NUM`),
  ADD CONSTRAINT `FK_ECRIRE_LIEN_11_LIVRE` FOREIGN KEY (`LIV_ISBN`) REFERENCES `livre` (`LIV_ISBN`);

--
-- Contraintes pour la table `emprunter`
--
ALTER TABLE `emprunter`
  ADD CONSTRAINT `FK_EMP_CLI` FOREIGN KEY (`CLIENT_ID`) REFERENCES `client` (`CLIENT_ID`),
  ADD CONSTRAINT `FK_EMP_LIVRE` FOREIGN KEY (`LIV_ISBN`) REFERENCES `livre` (`LIV_ISBN`),
  ADD CONSTRAINT `FK_FIL_LIVRE` FOREIGN KEY (`LIV_ISBN`) REFERENCES `livre` (`LIV_ISBN`);

--
-- Contraintes pour la table `fileattente`
--
ALTER TABLE `fileattente`
  ADD CONSTRAINT `FK_ATTENTE_LIEN_7_CLIENT` FOREIGN KEY (`CLIENT_ID`) REFERENCES `client` (`CLIENT_ID`),
  ADD CONSTRAINT `FK_ATTENTE_LIEN_8_LIVRE` FOREIGN KEY (`LIV_ISBN`) REFERENCES `livre` (`LIV_ISBN`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_LIVRE_APPARTIEN_COLLECTI` FOREIGN KEY (`COL_NUM`) REFERENCES `collection` (`COL_NUM`),
  ADD CONSTRAINT `FK_LIVRE_EDITER_EDITEUR` FOREIGN KEY (`EDIT_NUM`) REFERENCES `editeur` (`EDIT_NUM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
