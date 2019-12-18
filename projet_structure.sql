-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 20 nov. 2019 à 13:30
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_structure`
--

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

DROP TABLE IF EXISTS `secteur`;
CREATE TABLE IF NOT EXISTS `secteur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `LIBELLE` (`LIBELLE`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `secteur`
--

INSERT INTO `secteur` (`ID`, `LIBELLE`) VALUES
(4, 'Automobile'),
(1, 'Energie'),
(2, 'Environnement'),
(5, 'Informatique'),
(3, 'Transport');

-- --------------------------------------------------------

--
-- Structure de la table `secteurs_structures`
--

DROP TABLE IF EXISTS `secteurs_structures`;
CREATE TABLE IF NOT EXISTS `secteurs_structures` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_STRUCTURE` int(11) NOT NULL,
  `ID_SECTEUR` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_STRUCTURE` (`ID_STRUCTURE`),
  KEY `ID_SECTEUR` (`ID_SECTEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `secteurs_structures`
--

INSERT INTO `secteurs_structures` (`ID`, `ID_STRUCTURE`, `ID_SECTEUR`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 3, 2),
(6, 4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `structure`
--

DROP TABLE IF EXISTS `structure`;
CREATE TABLE IF NOT EXISTS `structure` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(100) NOT NULL,
  `RUE` varchar(200) NOT NULL,
  `CP` varchar(5) NOT NULL,
  `VILLE` varchar(100) NOT NULL,
  `ESTASSO` tinyint(1) NOT NULL,
  `NB_DONATEURS` int(11) DEFAULT NULL,
  `NB_ACTIONNAIRES` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `structure`
--

INSERT INTO `structure` (`ID`, `NOM`, `RUE`, `CP`, `VILLE`, `ESTASSO`, `NB_DONATEURS`, `NB_ACTIONNAIRES`) VALUES
(1, 'Veolia', 'rue veolia', '75000', 'Paris', 0, NULL, 1000000),
(2, 'Renault', 'rue Renault', '78000', 'Versailles', 0, NULL, 2000000),
(3, 'WWF', 'rue WWF', '92000', 'Antony', 1, 500000, NULL),
(4, 'Microsoft', 'rue Microsoft', '75000', 'Paris', 0, NULL, 3000000);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `secteurs_structures`
--
ALTER TABLE `secteurs_structures`
  ADD CONSTRAINT `secteurs_structures_secteur_fk` FOREIGN KEY (`ID_SECTEUR`) REFERENCES `secteur` (`ID`),
  ADD CONSTRAINT `secteurs_structures_structure_fk` FOREIGN KEY (`ID_STRUCTURE`) REFERENCES `structure` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
