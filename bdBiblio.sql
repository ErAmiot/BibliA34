-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 30 Mai 2018 à 14:17
-- Version du serveur :  5.5.59-0+deb8u1
-- Version de PHP :  5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bdsamyn`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE IF NOT EXISTS `auteur` (
`AUT_NUM` int(11) NOT NULL,
  `AUT_NOM` char(50) COLLATE utf8_bin NOT NULL,
  `AUT_PRENOM` char(30) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `auteur`
--

INSERT INTO `auteur` (`AUT_NUM`, `AUT_NOM`, `AUT_PRENOM`) VALUES
(2, 'S&eacute;han', 'Jean-Fran&ccedil;ois'),
(3, 'Combaudon', 'St&eacute;phane');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
`CLIENT_ID` int(11) NOT NULL,
  `CLIENT_NOM` varchar(25) COLLATE utf8_bin NOT NULL,
  `CLIENT_PRENOM` varchar(30) COLLATE utf8_bin NOT NULL,
  `CLIENT_TEL` varchar(10) COLLATE utf8_bin NOT NULL,
  `CLIENT_ADR` varchar(50) COLLATE utf8_bin NOT NULL,
  `CLIENT_VILLE` varchar(20) COLLATE utf8_bin NOT NULL,
  `CLIENT_CP` int(11) NOT NULL,
  `CLIENT_MAIL` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`CLIENT_ID`, `CLIENT_NOM`, `CLIENT_PRENOM`, `CLIENT_TEL`, `CLIENT_ADR`, `CLIENT_VILLE`, `CLIENT_CP`, `CLIENT_MAIL`) VALUES
(6, 'Ayrault', 'Fred', '0612365478', '6 Rue St-Aignan', 'Orléans', 45000, 'ayrault.fred@gmail.com'),
(7, 'Samyn', 'Valentin', '0612345678', '42 Rue Emile Zola', 'Fleury-Les-Aubrais', 45400, 'valentinsamyn@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `collection`
--

CREATE TABLE IF NOT EXISTS `collection` (
`COL_NUM` int(11) NOT NULL,
  `EDIT_NUM` int(11) NOT NULL,
  `COL_NOM` char(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `collection`
--

INSERT INTO `collection` (`COL_NUM`, `EDIT_NUM`, `COL_NOM`) VALUES
(3, 4, 'Le Livre De'),
(4, 5, 'MariaDB');

-- --------------------------------------------------------

--
-- Structure de la table `correspondre`
--

CREATE TABLE IF NOT EXISTS `correspondre` (
  `RUB_ID` int(11) NOT NULL,
  `LIV_ISBN` char(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `correspondre`
--

INSERT INTO `correspondre` (`RUB_ID`, `LIV_ISBN`) VALUES
(1, '978-2-4090-0962-4'),
(6, '275-4-0834-1345-7');

-- --------------------------------------------------------

--
-- Structure de la table `ecrire`
--

CREATE TABLE IF NOT EXISTS `ecrire` (
  `AUT_NUM` int(11) NOT NULL,
  `LIV_ISBN` char(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `ecrire`
--

INSERT INTO `ecrire` (`AUT_NUM`, `LIV_ISBN`) VALUES
(2, '275-4-0834-1345-7'),
(3, '978-2-4090-0962-4');

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE IF NOT EXISTS `editeur` (
  `EDIT_NOM` char(30) COLLATE utf8_bin NOT NULL,
  `EDIT_ADRWEB` char(100) COLLATE utf8_bin DEFAULT NULL,
`EDIT_NUM` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `editeur`
--

INSERT INTO `editeur` (`EDIT_NOM`, `EDIT_ADRWEB`, `EDIT_NUM`) VALUES
('First Interactive', 'www.firstinteractive.com', 4),
('ENI', 'www.editions-eni.fr', 5);

-- --------------------------------------------------------

--
-- Structure de la table `emprunter`
--

CREATE TABLE IF NOT EXISTS `emprunter` (
  `LIV_ISBN` char(20) COLLATE utf8_bin NOT NULL,
  `CLIENT_ID` int(11) NOT NULL,
`EMP_ID` int(11) NOT NULL,
  `EMP_DATE` date NOT NULL,
  `EMP_ETAT` tinyint(1) NOT NULL,
  `EMP_DATE_R_MAX` date NOT NULL,
  `EMP_DATE_R_REEL` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `emprunter`
--

INSERT INTO `emprunter` (`LIV_ISBN`, `CLIENT_ID`, `EMP_ID`, `EMP_DATE`, `EMP_ETAT`, `EMP_DATE_R_MAX`, `EMP_DATE_R_REEL`) VALUES
('275-4-0834-1345-7', 6, 1, '2018-05-29', 0, '2018-06-28', '2018-05-30'),
('275-4-0834-1345-7', 6, 2, '2018-05-30', 0, '2018-06-29', NULL),
('275-4-0834-1345-7', 6, 3, '2018-05-30', 0, '2018-06-29', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE IF NOT EXISTS `livre` (
  `LIV_ISBN` char(20) COLLATE utf8_bin NOT NULL,
  `COL_NUM` int(11) DEFAULT NULL,
  `EDIT_NUM` int(11) NOT NULL,
  `LIV_TITRE` char(100) COLLATE utf8_bin NOT NULL,
  `LIV_DATE` char(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `livre`
--

INSERT INTO `livre` (`LIV_ISBN`, `COL_NUM`, `EDIT_NUM`, `LIV_TITRE`, `LIV_DATE`) VALUES
('275-4-0834-1345-7', 3, 4, 'Le Livre De Windows 10', '2016-02-25'),
('978-2-4090-0962-4', 4, 5, 'MariaDB Administration et optimisation', '2017-06-15');

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `LOGID` varchar(20) COLLATE utf8_bin NOT NULL,
  `PWD` varchar(70) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `login`
--

INSERT INTO `login` (`LOGID`, `PWD`) VALUES
('Admin', 'e3afed0047b08059d0fada10f400c1e5');

-- --------------------------------------------------------

--
-- Structure de la table `rubriques`
--

CREATE TABLE IF NOT EXISTS `rubriques` (
  `RUB_ID` int(11) NOT NULL,
  `RUB_NOM` char(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `rubriques`
--

INSERT INTO `rubriques` (`RUB_ID`, `RUB_NOM`) VALUES
(1, 'Base de donn&eacute;es'),
(2, 'Bureautique'),
(3, 'Conception et developpement web'),
(4, 'Langage'),
(5, 'R&eacute;seau'),
(6, 'Syst&egrave;mes d exploitation'),
(7, 'T&eacute;l&eacute;phonie');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
 ADD PRIMARY KEY (`AUT_NUM`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
 ADD PRIMARY KEY (`CLIENT_ID`);

--
-- Index pour la table `collection`
--
ALTER TABLE `collection`
 ADD PRIMARY KEY (`COL_NUM`), ADD KEY `REALISER_FK` (`EDIT_NUM`);

--
-- Index pour la table `correspondre`
--
ALTER TABLE `correspondre`
 ADD PRIMARY KEY (`RUB_ID`,`LIV_ISBN`), ADD KEY `LIEN_7_FK` (`RUB_ID`), ADD KEY `LIEN_8_FK` (`LIV_ISBN`);

--
-- Index pour la table `ecrire`
--
ALTER TABLE `ecrire`
 ADD PRIMARY KEY (`AUT_NUM`,`LIV_ISBN`), ADD KEY `LIEN_10_FK` (`AUT_NUM`), ADD KEY `LIEN_11_FK` (`LIV_ISBN`);

--
-- Index pour la table `editeur`
--
ALTER TABLE `editeur`
 ADD PRIMARY KEY (`EDIT_NUM`), ADD UNIQUE KEY `EDIT_NUM` (`EDIT_NUM`);

--
-- Index pour la table `emprunter`
--
ALTER TABLE `emprunter`
 ADD PRIMARY KEY (`EMP_ID`), ADD KEY `FK_EMP_CLI` (`CLIENT_ID`), ADD KEY `FK_EMP_ISBN` (`LIV_ISBN`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
 ADD PRIMARY KEY (`LIV_ISBN`), ADD KEY `APPARTIENT_FK` (`COL_NUM`), ADD KEY `EDITER_FK` (`EDIT_NUM`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`LOGID`);

--
-- Index pour la table `rubriques`
--
ALTER TABLE `rubriques`
 ADD PRIMARY KEY (`RUB_ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
MODIFY `AUT_NUM` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
MODIFY `CLIENT_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `collection`
--
ALTER TABLE `collection`
MODIFY `COL_NUM` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `editeur`
--
ALTER TABLE `editeur`
MODIFY `EDIT_NUM` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `emprunter`
--
ALTER TABLE `emprunter`
MODIFY `EMP_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
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
ADD CONSTRAINT `FK_EMP_LIVRE` FOREIGN KEY (`LIV_ISBN`) REFERENCES `livre` (`LIV_ISBN`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
ADD CONSTRAINT `FK_LIVRE_APPARTIEN_COLLECTI` FOREIGN KEY (`COL_NUM`) REFERENCES `collection` (`COL_NUM`),
ADD CONSTRAINT `FK_LIVRE_EDITER_EDITEUR` FOREIGN KEY (`EDIT_NUM`) REFERENCES `editeur` (`EDIT_NUM`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
