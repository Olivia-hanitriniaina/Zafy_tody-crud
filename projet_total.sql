-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 28 oct. 2019 à 06:46
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
-- Base de données :  `projet_total`
--
-- --------------------------------------------------------

--
-- Structure de la table `role`
--
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
   `id_role` int(11) NOT NULL AUTO_INCREMENT,
   `nom` varchar (50),
   PRIMARY KEY (`id_role`)

)ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `centre_emplisseur`
--
INSERT INTO `role` (`id_role`, `nom`) VALUES
(1, 'Modification'),
(2, 'lecture');
-- --------------------------------------------------------

--
-- Structure de la table `centre_emplisseur`
--

DROP TABLE IF EXISTS `centre_emplisseur`;
CREATE TABLE IF NOT EXISTS `centre_emplisseur` (
  `id_centre` int(11) NOT NULL AUTO_INCREMENT,
  `ville` varchar(255) NOT NULL,
  PRIMARY KEY (`id_centre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `centre_emplisseur`
--

INSERT INTO `centre_emplisseur` (`id_centre`, `ville`) VALUES
(1, 'Antananarivo'),
(2, 'Toamasina');

-- --------------------------------------------------------

--
-- Structure de la table `depot_aviation`
--

DROP TABLE IF EXISTS `depot_aviation`;
CREATE TABLE IF NOT EXISTS `depot_aviation` (
  `id_depot` int(11) NOT NULL AUTO_INCREMENT,
  `depot_aviation` varchar(255) NOT NULL,
  `nom_chef_site` varchar(255) NOT NULL,
  PRIMARY KEY (`id_depot`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `depot_aviation`
--

INSERT INTO `depot_aviation` (`id_depot`, `depot_aviation`, `nom_chef_site`) VALUES
(9, 'Arivonimamo', 'Jean Marc2'),
(10, 'Ivato', 'Ndrema'),
(11, 'Toamasina', 'Bezily');

-- --------------------------------------------------------

--
-- Structure de la table `station_service`
--

DROP TABLE IF EXISTS `station_service`;
CREATE TABLE IF NOT EXISTS `station_service` (
  `id_station` int(11) NOT NULL AUTO_INCREMENT,
  `nom_station` varchar(100) NOT NULL,
  PRIMARY KEY (`id_station`)
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `station_service`
--

INSERT INTO `station_service` (`id_station`, `nom_station`) VALUES
(211, 'Total tsy anosy'),
(212, 'Total Ampefiloha'),
(213, 'Total ankadimbahoaka');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `adresse_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_role` int(11),
  PRIMARY KEY (`id_users`),
  foreign key (`id_role`) references `role` (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `adresse_email`, `password`, `id_role`) VALUES
(1, 'irintsoa32@gmail.com', 'azerty', 1),
(4, 'admin@gmail.com', 'admin', 2),
(5, 'zaza@gmail.com', 'azerty', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


