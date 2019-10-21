-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 17 oct. 2019 à 07:29
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
-- Structure de la table `centre_emplisseur`
--

DROP TABLE IF EXISTS `centre_emplisseur`;
CREATE TABLE IF NOT EXISTS `centre_emplisseur` (
  `id_centre` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `nom_visiteur` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  PRIMARY KEY (`id_centre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `depot_aviation`
--

DROP TABLE IF EXISTS `depot_aviation`;
CREATE TABLE IF NOT EXISTS `depot_aviation` (
  `id_depot` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `depot_aviation` varchar(255) NOT NULL,
  `nom_chef_site` varchar(255) NOT NULL,
  `nom_visiteur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_depot`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `depot_aviation`
--

INSERT INTO `depot_aviation` (`id_depot`, `date`, `depot_aviation`, `nom_chef_site`, `nom_visiteur`) VALUES
(9, '2019-10-16', 'Arivonimamo', 'Jean Marc2', 'zaza');

-- --------------------------------------------------------

--
-- Structure de la table `station_service`
--

DROP TABLE IF EXISTS `station_service`;
CREATE TABLE IF NOT EXISTS `station_service` (
  `id_station` int(11) NOT NULL AUTO_INCREMENT,
  `nom_station` varchar(100) NOT NULL,
  `nom_visiteur` varchar(100) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_station`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `station_service`
--

INSERT INTO `station_service` (`id_station`, `nom_station`, `nom_visiteur`, `date`) VALUES
(200, 'TotalAmpasika', 'zaza', '2019-10-16'),
(201, 'TotalAmpasika', 'zaza', '2019-10-16'),
(202, 'TotalAmpasika', 'Ndrema', '2019-10-16'),
(203, 'TotalAmpasika', 'Ndrema', '2019-10-16'),
(204, 'TotalAmpasika', 'Ndrema', '2019-10-16'),
(205, 'Total Anosy', 'za', '2019-10-16'),
(206, 'TotalAmpasika', 'zaza', '2019-10-16'),
(207, 'TotalAmpasika', 'zaza', '2019-10-16'),
(210, 'TotalAm', 'za', '2019-10-16');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `adresse_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `adresse_email`, `password`) VALUES
(1, 'irintsoa32@gmail.com', 'azerty');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
