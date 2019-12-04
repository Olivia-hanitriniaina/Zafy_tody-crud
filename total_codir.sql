-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 28 nov. 2019 à 12:13
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `total_codir`
--

-- --------------------------------------------------------

--
-- Structure de la table `EntrepriseExterieur`
--

CREATE TABLE `EntrepriseExterieur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `EntrepriseExterieur`
--

INSERT INTO `EntrepriseExterieur` (`id`, `nom`) VALUES
(1, 'Entreprise 1'),
(2, 'Entreprise 2'),
(3, 'Entreprise 3'),
(4, 'Entreprise 4'),
(5, 'Entreprise 5');

-- --------------------------------------------------------

--
-- Structure de la table `Localisation`
--

CREATE TABLE `Localisation` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Localisation`
--

INSERT INTO `Localisation` (`id`, `nom`, `type_id`, `parent_id`, `responsable_id`) VALUES
(1, 'Antananarivo', 2, NULL, NULL),
(2, 'Fianarantsoa', 2, NULL, NULL),
(3, 'Toamasina', 2, NULL, NULL),
(4, 'Mahajanga', 2, NULL, NULL),
(5, 'Antsiranana', 2, NULL, NULL),
(6, 'Toliara', 2, NULL, NULL),
(7, 'Sambirano', 1, NULL, NULL),
(8, 'Sava', 1, NULL, NULL),
(9, 'Diana', 1, NULL, NULL),
(10, 'Vohipeno', 1, NULL, NULL),
(11, 'Analakely', 3, 1, NULL),
(12, 'Isotry', 3, 1, NULL),
(13, 'Mahamasina', 3, 1, NULL),
(14, 'Ankorondrano', 3, 1, NULL),
(15, 'Antarandolo', 3, 2, NULL),
(16, 'Ampasambaza', 3, 2, NULL),
(17, 'Talatamaty', 3, 2, NULL),
(18, 'Ambatondrazaka', 4, NULL, 5),
(19, 'Amparafaravola', 4, NULL, 2),
(20, 'Andoharanofotsy', 4, NULL, 3),
(21, 'Tanjombato', 4, NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `LocalisationType`
--

CREATE TABLE `LocalisationType` (
  `id` int(11) NOT NULL,
  `label` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `LocalisationType`
--

INSERT INTO `LocalisationType` (`id`, `label`) VALUES
(1, 'site'),
(2, 'lieu'),
(3, 'ville'),
(4, 'station service'),
(5, 'depot aviation'),
(6, 'centre emplisseur');

-- --------------------------------------------------------

--
-- Structure de la table `PointBloquant`
--

CREATE TABLE `PointBloquant` (
  `id` int(11) NOT NULL,
  `label` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `PointBloquant`
--

INSERT INTO `PointBloquant` (`id`, `label`, `description`) VALUES
(1, 'O', 'Oui'),
(2, 'N', 'Non'),
(3, 'N*', 'Ce point est bloquant dans le cas où la protection des feux est fortement endommagée'),
(4, 'N**', 'Ce point est bloquant uniquement pour les camions devant etre équipés d\'un coupe batterie (obligation en fonction de la nature des produits transportés et des conditions de chargement).'),
(5, 'N***', 'Ce point est bloquant uniquement si la citerne n\'est pas correctement gazée.');

-- --------------------------------------------------------

--
-- Structure de la table `PointControle`
--

CREATE TABLE `PointControle` (
  `id` int(11) NOT NULL,
  `label` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `PointControle`
--

INSERT INTO `PointControle` (`id`, `label`) VALUES
(1, 'Chargement'),
(2, 'Trajet'),
(3, 'Déchargement'),
(4, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Produit`
--

INSERT INTO `Produit` (`id`, `nom`) VALUES
(1, 'Pétrole'),
(2, 'Essence super sans plong 95'),
(3, 'Gasoil'),
(4, 'Essence super sans plong 97'),
(5, 'Goudron'),
(6, 'Bouteillen Gaz');

-- --------------------------------------------------------

--
-- Structure de la table `Question`
--

CREATE TABLE `Question` (
  `id` int(11) NOT NULL,
  `label` text COLLATE utf8_unicode_ci NOT NULL,
  `visite_type_id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `sous_categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Question`
--

INSERT INTO `Question` (`id`, `label`, `visite_type_id`, `categorie_id`, `sous_categorie_id`) VALUES
(1, 'Propre et en bon état ? Bien aérée ? Absence de fuite ?', 1, 1, 1),
(2, 'Existe-t-il une trousse de premier secours ? Est-elle signalé et accessible ? Existe-t-il une liste du contenu et fiche de suivi de la trousse ?', 1, 1, 2),
(3, 'Tout le personnel de la station est-il de chaussures de sécurité, vêtement en coton, casquette ?', 1, 1, 3),
(4, 'La Station dispose-t-elle d\'un parc à extincteur (ABC 9kg dans les différents locaux/ CO2 2kg près des coffrets électriques) ? Dernier contrôle datant de moins d\'un an ? Sont-t-ils accrochés et signalés ?', 1, 2, 4),
(5, 'La Station dispose-t-elle d\'un arrêt d\'urgence ? Est-t-il signalé ? Est-t-il accessible ? Est-t-il operationnel ?', 1, 2, 5),
(6, 'Bien situé? - en bon état - plein? Avec pelle?', 1, 2, 6),
(7, 'Les scellés sont -ils en place?  Total sur index et Métrologie sur le mesureur', 1, 2, 7),
(8, 'Les coffrets électriques sont-ils fermés ? Identifiés par un pictogramme danger ? ', 1, 2, 8),
(9, 'Les cablages électriques sont-t-ils protegés par des chemins ou goulottes ? Absence de cables nus ni de connexion apparente ? Les regards électriques sont-t-ils protégés (ensablés, bouchonnés)?', 1, 2, NULL),
(10, ' La station dispose-t-elle de plots et chainettes ou cône pour delimiter le perimètre de sécurité ? Le perimètre de sécurité est-t-il matérialisé au sol ? Les bouches de dépotage sont-t-elles identifiées et cadenassées ?', 1, 2, 9),
(11, 'état du camion citerne ? Conformité des équipements de contrôles qualité et quantité ? EPIs du chauffeur ?', 1, 2, 34),
(12, 'Borne à air? Borne à eau? Compresseur opérationnel ? Baie de graissage et ou lavage propre ?', 1, 2, 10),
(13, 'Si travaux chantier : contrôle du plan de prevention + permis de travail disponibles et affichés ? Balisage du périmètre de travail? Respect port des EPIS? Permis de \"Travaux en hauteur\" ?', 1, 2, 11),
(14, 'La station dispose-t-elle d\'un registre d\'anomalies/dysfonctionnement ? d\'un classeur de maintenance ? Liste téléphone d\'urgence ?Sont-t-ils tenus à jour ? Les certificats de barémâge?', 1, 2, 12),
(15, 'La Station dispose-t-elle d\'un decanteur/separateur ? Est-t-il operationnel ? Date de dernière entretien ?', 1, 4, 13),
(16, 'Les regards d\'asssainissement sont-t-ils en bon état et propres ? Les huiles usées sont-t-ils stockés dans des cuves ? Les filtres usés ?', 1, 4, NULL),
(17, 'Date du dernier prélèvement campagne qualité ? Type de produits analysés? Nombre de non-conformité?', 1, 5, 14),
(18, 'Nombre de plainte clients sur la qualité produits ?', 1, 5, NULL),
(19, 'La station dispose-t-elle de: certificats de baremage de ses cuves ? Sont-t-ils valides ? Les huiles usées sont-t-ils stockés dans des cuves ?', 1, 5, NULL),
(20, 'La station dispose-t-elle de pâte de detection d\'eau ? Pâte de detection de produit ? d\'un règle gradué pour reperer le niveau de produit dans les cuves ? La station dispose-t-elle d\'un thermomètre ? D\'un densimètre ? D\'une éprouvette ?', 1, 5, NULL),
(21, 'Les consignes de sécurité sont-t-ils respectés sur la station ? Moteur arrêté , Téléphone Interdit, Défense de fumer etc ….', 1, 6, NULL),
(22, 'Le personnel connaît-t-il les conduites à tenir en cas d\'urgence ?Epandage de produit , Epandage, Agression, Attentat', 1, 6, NULL),
(23, 'Le personnel respecte-t-il les procedures en vigueur concernant l\'opération de dépotage (Perimètre de sécurité, temps de relaxation, liaison équipotentielle, etc.) ?', 1, 6, NULL),
(24, 'Le personnel sait-il utilisé des élements suivants : Arrêt d\'urgence , Extincteur , Couverture anti-feu', 1, 6, NULL),
(25, 'Le personnel releve-t-il les situations dangereuses, presques accident ou incident mineur ? Informe-t-il leur superieur hierarchique ou ignore ses évenements ?', 1, 6, NULL),
(26, 'Quelle est la somme detenue par les pompistes sur eux ?', 1, 6, NULL),
(27, 'Propre et en bon état ? Bien aérée ? Absence de fuite ?', 2, 1, 1),
(28, 'Existe-t-il une trousse de premier secours ? Est-elle signalé et accessible ? Existe-t-il une liste du contenu et fiche de suivi de la trousse ?', 2, 1, 2),
(29, 'Tout le personnel respecte-t-il le port obligatoire des EPIs (chassures de sécurité, vêtement en coton, casquette,,,) ?', 2, 1, 3),
(30, 'les issues de secours, le point de ralliement matérialisé, plan d\'évacuation à jour', 2, 3, 15),
(31, 'L\'état du parc à extincteur (ABC dans les différentszones - bâtiments et matériels roulants / CO2 dans les locaux électriques) ? Dernier contrôle datant de moins d\'un an ? Sont-t-ils accrochés et signalés ?', 2, 3, 16),
(32, 'L\' arrêt d\'urgence est-t-il signalé ? Est-t-il accessible ? Est-t-il operationnel ?', 2, 3, 17),
(33, '1Absence de bruits et vibrations anormaux ?  Zone ATEX signalé (panneaux et/ou marquage au sol) ? Pas de traces d\'HC importantes sur le sol?', 2, 3, 18),
(34, 'Fermé et cadenassé ? Identifié ? Voyants fonctionnels?', 2, 3, 19),
(35, 'En bon état ?  présence de revêtement anti-dérapant  ? Dispositif DCMT3 en bon état & opérationnel? Armoire de commande pompe: Fermé? Identifié?   Presence de pictogramme danger ATEX?  Harnais de sécurité, ligne de vie...: en bon état? et contrôlé régulièrement?\r\n', 2, 3, 20),
(36, 'état du camion citerne ? Conformité des équipements de contrôles qualité et quantité ? EPIs du chauffeur ?', 2, 3, 21),
(37, 'Cuvette de rétention: pas de fissure? exemptes de végétation, boue, matériel parasite (outil, flexible, gamelle, etc.)? Bacs de stockage identifiés, orifices obturés ( mano, purge…), capacité indiquée - En bon état? Passerelles - rambardes-garde-corps & escaliers: Présence de revêtement anti-dérapant ou de caillebotis, non corrodés, fixés?', 2, 3, 22),
(38, 'Non corrodées - En bon état - Pas de fuite? Hauteur d\'empilement des fûts & méthode d\'empilement des fûts?', 2, 3, 23),
(39, 'En bon état - Toiture bien fixé ? zone étanche?', 2, 3, 24),
(40, 'Fiche d\'inspection avant utilisation autres matériels roulants, matériels de levage et de manutention, detecteurs mobiles?(Aspect visuel des pneus - bon fonctionnement de l\'éclairage - bon fonctionnement des freins - bon fonctionnement des interlocks - bon fonctionnement arrêt d\'urgence - vérification de la liaison équipotentielle - fiabilité des enregistrements - autres)', 2, 3, 25),
(41, 'Si travaux chantier :Un surveillant chantier ? contrôle du plan de prevention + permis de travail disponibles et affichés ? Balisage du périmètre? Respect port des EPIS? Travaux en hauteur ?', 2, 3, 26),
(42, 'Le dépôt dispose-t-il d\'un registre visiteur ? d\'un classeur de déclaration d\'événement? d\'un classeur de maintenance?d\'un classeur des contrôles réguliers?Liste téléphone d\'urgence ?Sont-t-ils tenus à jour ? Les certificats de barémâge?', 2, 3, 27),
(43, 'Absence de couches d\'hydrocarbures ou de boues - absence de couches filamenteuse ou d’émulsions anormales? Absence d\'hydrocarbures? Date d\'analyse des rejets? Cuve d\'écrémage: creux nécessaire disponible?', 2, 4, 28),
(44, 'Gestion des déchets (ménagers et industriels)?Les huiles usées?', 2, 4, NULL),
(45, 'Le N° Lot du lot d\'Avgas ? Date du dernier analyse d\'Avgas 100 LL? Date de la dernière recertification de JET A-1?', 2, 5, 29),
(46, 'Le dépôt dispose-t-il de: certificats de baremage de ses bacs? Sont-t-ils valides ? ', 2, 5, NULL),
(47, 'Le dépôt dispose-t-il  de Shell Water Detection(SWD)et papier chimique (pour l\'essence) pour le test de la présence d\' eau dans le produit ? La date de péremption du SWD et du papier chimique? La station dispose-t-elle d\'un thermomètre ? D\'un densimètre ? D\'une éprouvette ?', 2, 5, NULL),
(48, 'Les 12 règles d\'or: affichage visible et accessible aux opérateurs? Connaissance des 12 règles d\'or?', 2, 6, NULL),
(49, 'Le personnel connaît-t-il les conduites à tenir en cas d\'urgence ?Epandage de produit , Agression, Attentat', 2, 6, NULL),
(50, 'Le personnel respecte-t-il les procedures en vigueur concernant l\'opération de dépotage (contrôle du camion citerne, temps de relaxation, liaison équipotentielle, etc.) ?', 2, 6, NULL),
(51, 'Le personnel sait-il utilisé des élements suivants : Arrêt d\'urgence , Extincteur , Couverture anti-feu?', 2, 6, NULL),
(52, 'Le personnel releve-t-il les situations dangereuses, presques accident ou incident mineur ? Informe-t-il leur superieur hierarchique ou ignore ses évenements ?', 2, 6, NULL),
(53, 'Date de la  dernière réunion - causerie sécurité ? Rapport ?', 2, 6, NULL),
(54, 'Date du dernier exercice incendie ? Rapports?', 2, 6, NULL),
(55, 'Accès / sorties contrôlés par agents de sécurité? Points de ralliement, et issues de secours matérialisés et dégagés?', 3, 7, NULL),
(56, 'Grillages, portails  et clôtures : en bon état?', 3, 7, NULL),
(57, 'Panneaux\" interdictions - obligations, consignes d\'urgence \"? Plan d\'évacuation ?', 3, 7, NULL),
(58, 'Extincteurs: classe adaptée aux risques - accrochés - vérifiés - numérotés - signalés?', 3, 8, NULL),
(59, 'Présence? Contacteurs en nombre suffisants? Date du dernier test périodique de fonctionnement ? Etat \"Autochim\"? Opérationnel?', 3, 9, NULL),
(60, 'Circulation piétons : marquage au sol de circulation? panneaux code de la route visible et en bon état? exempt de matériél encombrant?  largeur >à 80 cm, circulation pratiquable', 3, 10, NULL),
(61, 'Circulation véhicules:panneaux code de la route visible et en bon état? bordures de trottoir signalisés et en bon état? sol plan, exempt de matériel encombrant ?', 3, 10, NULL),
(62, 'Hauteur d\'empilage bouteille? allées de circulation d\'accès libre de matériaux ou d\'objets étrangers?  stockage bouteilles en position debout et retenues de façon à ne pas pouvoir tomber', 3, 11, NULL),
(63, 'Accès libre en tout point; sol plane', 3, 12, NULL),
(64, 'état du camion citerne ? Conformité des équipements de contrôles qualité et quantité ? EPIs du chauffeur ?', 3, 12, 35),
(65, 'Dispositif DCMT3 ?Détecteur de fuite? DCI, couronne d\'arrosage? : opérationnel', 3, 12, NULL),
(66, 'Flexibles de dépotage: en état - valides - bouchonnés si, non utilisés?', 3, 12, NULL),
(67, 'Local pomperie incendie: identifié et présence de casque anti-bruit?', 3, 13, NULL),
(68, 'Cuve , nourrice de carburant:pleines et indicateur de niveau opérationnel - absence de fuite HC?', 3, 13, NULL),
(69, 'Motopompe :en position de démarrage automatique ou conforme à l\'instruction du dépôt', 3, 13, NULL),
(70, 'Electropompe : en position de démarrage automatique ou conforme à l\'instruction du dépôt', 3, 13, NULL),
(71, 'Arrêt d\'urgence: en bon état, disposé judicieusement et identifiable (couleur, plaque) ?', 3, 13, NULL),
(72, 'Pleine et indicateur de niveau opérationnel? Pas de fuite et  corrosion notable du bac?', 3, 14, NULL),
(73, 'Motopompe appoint d\'eau de la citerne: réservoir de carburant plein et réserve?instruction d\'usage affiché?Niveau d\'huile ?', 3, 14, NULL),
(74, 'Flexibles incendie, canons: en bon état, disposés judicieusement et identifiables (couleur, ecriteaux) -', 3, 14, NULL),
(75, 'Vêtement anti feu : en bon état, rangés et disposés judicieusement et identifiables (ecriteaux et inventaire)?', 3, 14, NULL),
(76, 'Propreté d\'ensemble :propre, en ordre et salubre, bon drainage de l\'eau?', 3, 15, NULL),
(77, 'Zone ATEX - signalée (panneaux et/ou marquage au sol) ', 3, 15, NULL),
(78, ' Absence de fuite : au niveau du hall, dans la rampe de vidange, bouteille en vidange libre', 3, 15, NULL),
(79, 'Equipement et machine: équipements fonctionnent (correctement), propres et non corrodés', 3, 15, NULL),
(80, 'Trousse de 1ers secours : liste du contenu, vérification périodique?', 3, 15, NULL),
(81, 'Transpalette: en état? opérationnel?', 3, 16, NULL),
(82, 'Fiche d\'inspection avant utilisation des transpalettes?', 3, 16, NULL),
(83, 'Cigare identifié, orifices obturés ( mano, purge, soupape de décompression…), capacité indiquée?capteurs de gaz en état?', 3, 17, NULL),
(84, 'Etat des passerelles, escaliers, rambardes… ?', 3, 17, NULL),
(85, 'Zone ATEX - signalée (panneaux et/ou marquage au sol) ', 3, 17, NULL),
(86, 'Le dépôt dispose-t-il d\'arrêt d\'urgence ? Est-t-il signalé ? Est-t-il accessible ? Est-t-il operationnel ?', 3, 18, NULL),
(87, 'Les coffrets électriques sont-ils fermés ? Identifiés par un pictogramme danger ? ', 3, 19, NULL),
(88, 'Les cablages électriques sont-t-ils protegés par des chemins ou goulottes ? Absence de cables nus ni de connexion apparente ? ', 3, 19, NULL),
(89, 'Le dépôt dispose-t-il d\'un registre visiteur ? d\'un registre d\'anomalies/dysfonctionnement ? D\'un classeur de maintenance ? Sont-t-ils tenus à jour ?', 3, 20, NULL),
(90, 'Respect port des EPI? Personnel? Tiers?', 3, 21, NULL),
(91, 'Port effectif des Epi-s ?Les EPIs sont-ils en bon état?', 3, 22, NULL),
(92, 'Existance permis de travail et autres permis associés signés par le site et l\'entreprise? ', 3, 22, NULL),
(93, 'Application processus de consignation /  déconsignation?', 3, 22, NULL),
(94, 'Propreté d\'ensemble: Absence de papier et de chiffon au sol - Armoire identifiée et fermée - Plans et documents rangés', 3, 23, NULL),
(95, 'Signaletique de démarrage automatique - Protection auditive disponible - Accès reglementé', 3, 23, NULL),
(96, 'Groupe : en position de démarrage automatique ou dans la position définie selon instruction dépôt - capotage des batteries en place - absence de fuite(s) (huile moteur, eau)', 3, 23, NULL),
(97, 'Bac à eau : Pleine et indicateur de niveau opérationnel - absence de fuite(s) - pas de corrosion notable du bac', 3, 24, NULL),
(98, 'Manifold, vannes : Pas de fuite - graissé - Opérationnel', 3, 24, NULL),
(99, 'Défense incendie (boîtes à mousse, couronne de refroidissement,,,,)?', 3, 24, NULL),
(100, 'Détecteur gaz? Détecteur fuite? En bon état?', 3, 24, NULL),
(101, 'Explosimètre ?  Balise de chantier? En bon état? Opérationnel?', 3, 24, NULL),
(102, 'Les 12 règles d\'or: affichage visible et accessible aux opérateurs? Connaissance des 12 règles d\'or?', 3, 6, NULL),
(103, 'Le personnel connaît-t-il les conduites à tenir en cas d\'urgence ?Epandage de produit , Agression, Attentat', 3, 6, NULL),
(104, 'Le personnel respecte-t-il les procedures en vigueur concernant l\'opération de dépotage (contrôle du camion citerne, temps de relaxation, liaison équipotentielle, etc.) ?', 3, 6, NULL),
(105, 'Le personnel sait-il utilisé des élements suivants : Arrêt d\'urgence , Extincteur , Couverture anti-feu?', 3, 6, NULL),
(106, 'Le personnel releve-t-il les situations dangereuses, presques accident ou incident mineur ? Informe-t-il leur superieur hierarchique ou ignore ses évenements ?', 3, 6, NULL),
(107, 'Date du dernier exercice incendie ? Rapports?', 3, 6, NULL),
(108, 'Date de la  dernière réunion - causerie sécurité ? Rapport ?', 3, 6, NULL),
(109, 'Accusé de reception signé par tout le personnel présent', 4, 25, NULL),
(110, 'Autorisation de travail/permis divers affiché et bien renseigné', 4, 25, NULL),
(111, 'PV ouverture de chantier / Points sécurité disponibles', 4, 25, NULL),
(112, 'Registre des évènements disponible et utilisé', 4, 25, NULL),
(113, 'Copie aptitude médicale du personnel présent disponible', 4, 25, NULL),
(114, 'Présence d\'une personne formé sur extincteur et secourisme', 4, 25, NULL),
(115, 'Copie habilitations divers disponibles (élec, soudeur, etc.)', 4, 25, NULL),
(116, 'FDS des produits manipulés disponibles', 4, 25, NULL),
(117, 'Contact d\'urgence disponible et testé annuellement', 4, 25, NULL),
(118, 'Plan d\'urgence disponible', 4, 25, NULL),
(119, 'Baraque de chantier en bon état et bien disposé', 4, 26, NULL),
(120, 'Outillages et équipements divers en bon état et adaptés', 4, 26, NULL),
(121, 'Balisage de la zone de travail signalé (Panneau oblig/interd)', 4, 26, NULL),
(122, 'Outillages et équipements divers en bon état et adaptés', 4, 26, NULL),
(123, 'Point de ralliement identifié et signalé', 4, 26, NULL),
(124, 'Moyen d\'alerte disponible (sifflet, sirène, etc.)', 4, 26, NULL),
(125, 'Autres (s)', 4, 26, NULL),
(126, 'Propre', 4, 27, NULL),
(127, 'Exempt d\'obstacle', 4, 27, NULL),
(128, 'Exempt d\'objet trainant', 4, 27, NULL),
(129, 'Autres (s)', 4, 27, NULL),
(130, 'Port de vêtement de travail en coton et manche longue', 4, 28, NULL),
(131, 'Port de casque de protection (Avec jugulaire si W en hauteur)', 4, 28, NULL),
(132, 'Port de chaussures de sécurité', 4, 28, NULL),
(133, 'Port de gants de protection adaptés aux opérations éffectuées', 4, 28, NULL),
(134, 'Port de lunettes de protection', 4, 28, NULL),
(135, 'Port de protection auditive*', 4, 28, NULL),
(136, 'Port de masque filtrant*', 4, 28, NULL),
(137, 'Port de masque respiratoire*', 4, 28, NULL),
(138, 'Port de harnais et longe antichute (En bon état et valide)*', 4, 28, NULL),
(139, 'Autres (s)', 4, 28, NULL),
(140, 'Echafaudage en bon état, contrôlé et bien placé (Panneau HS ou ES)', 4, 29, NULL),
(141, 'Escabeau en bon état , contrôlé et maintenu par un opérateur', 4, 29, NULL),
(142, 'Nacelle en bon état  et contrôlé', 4, 29, NULL),
(143, 'Autres (s)', 4, 29, NULL),
(144, 'Respect des consignes de sécurité ', 4, 30, NULL),
(145, 'Respect des 12 Règles d\'Or', 4, 30, NULL),
(146, 'Autres (s)', 4, 30, NULL),
(147, 'Documents de l\'engin valide (Assurance, visite technique, etc.)', 4, 31, NULL),
(148, 'Documents du conducteur valide (Permis, habilitation, etc.)', 4, 31, NULL),
(149, 'Présence de trousse de secours (Signalé, contenu complet et valide)', 4, 31, NULL),
(150, 'Présence de cales adaptés et en bon état', 4, 31, NULL),
(151, 'Présence d\'extincteur valide et en bon état (2 ABC 09kg / 1 de 02kg)', 4, 31, NULL),
(152, 'Présence d\'AU ou coupe courant', 4, 31, NULL),
(153, 'Accessoires en bon état (Manille, eligngue, etc.)', 4, 31, NULL),
(154, 'Absence de fuite', 4, 31, NULL),
(155, 'Autres (s)', 4, 31, NULL),
(156, 'Propreté', 4, 32, NULL),
(157, 'Identification des déchets', 4, 32, NULL),
(158, 'Etiquetage des produits / substances chimiques', 4, 32, NULL),
(159, 'Autres (s)', 4, 32, NULL),
(160, 'Extincteurs disponibles, valides et suffisants (ABC 09kg à minima)', 4, 33, NULL),
(161, 'Autres (s)', 4, 33, NULL),
(162, 'Trousse de secours disponible, identifiée et contenu complet', 4, 45, NULL),
(163, 'Autres (s)', 4, 45, NULL),
(164, 'Disponible', 4, 34, NULL),
(165, 'Utilisé (s)', 4, 34, NULL),
(166, 'Points sécurité abordés (exemples : Règles d\'Or, phases à risques, REX, etc.)				', 4, 35, NULL),
(167, 'Contrôle technique du camion ', 5, 36, NULL),
(168, 'Visibilité', 5, 36, NULL),
(169, 'Ceintures de sécurité trois points', 5, 36, NULL),
(170, 'Eclairage', 5, 36, NULL),
(171, 'Extincteurs', 5, 36, NULL),
(172, 'Roues/jantes', 5, 36, NULL),
(173, 'Pneus', 5, 36, NULL),
(174, 'Sellette et pivot d\'accrochage (concerne semi remorque et attelage de remorque)', 5, 36, NULL),
(175, 'Test du frein de parking ', 5, 36, NULL),
(176, 'Signalisation et placardage ', 5, 36, NULL),
(177, 'Etat général du cablage électrique', 5, 36, NULL),
(178, 'Numéro de téléphone d\'urgence ', 5, 36, NULL),
(179, 'Etat de la fermeture de la porte arrière', 5, 37, NULL),
(180, 'Etat du plancher ', 5, 37, NULL),
(181, 'Solidité des montants latéraux ou état général de la cage ', 5, 37, NULL),
(182, 'Sangles d\'arrimage ou barres de calage', 5, 37, NULL),
(183, 'Coupe batterie (Cabine ou extérieur)', 5, 37, NULL),
(184, 'Cales de roues', 5, 37, NULL),
(185, '2 signaux d\'avertissement (triangle, cones)', 5, 37, NULL),
(186, 'Permis de conduire et attestation', 5, 38, NULL),
(187, 'Les EPI du conducteur', 5, 38, NULL),
(188, 'Contrôle technique du camion ', 6, 39, NULL),
(189, 'Permis de conduire et attestation', 6, 39, NULL),
(190, 'Visibilité ', 6, 39, NULL),
(191, 'Ceintures de sécurité trois points', 6, 39, NULL),
(192, 'Eclairage', 6, 39, NULL),
(193, 'Coupe Batterie (cabine ou extérieur)', 6, 39, NULL),
(194, 'Extincteurs', 6, 39, NULL),
(195, 'EPI du conducteur', 6, 39, NULL),
(196, 'Roues/jantes', 6, 39, NULL),
(197, 'Pneus', 6, 39, NULL),
(198, 'Scellette et pivot d\'attelage (concerne semi remorque et attelage de remoque)', 6, 39, NULL),
(199, 'Signalisation et placardage', 6, 39, NULL),
(200, '2 signaux d\'avertissements (triangle, cones)', 6, 39, NULL),
(201, 'Etat des soudures et absence de fissures', 6, 39, NULL),
(202, 'Numéro de téléphone d\'urgence ', 6, 39, NULL),
(203, 'Etat géneral du cablage électrique', 6, 39, NULL),
(204, 'Prise de terre', 6, 39, NULL),
(205, 'Cales de roues', 6, 39, NULL),
(206, 'Test du frein de parking', 6, 39, NULL),
(207, 'Echelle, rambarde et passerelle supérieure ', 6, 40, NULL),
(208, 'Fuites ', 6, 40, NULL),
(209, 'Clapets de fond', 6, 40, NULL),
(210, 'Flexibles', 6, 40, NULL),
(211, 'Jauge ou système de contrôle de niveau', 6, 41, NULL),
(212, 'Documentation d\'agrément et date d\'épreuve ', 6, 41, NULL),
(213, 'Vérification que le camion est bien sous pression ', 6, 41, NULL),
(214, 'Obturateurs', 6, 41, NULL),
(215, 'Validité premis de conduire  / PATH', 7, 42, 30),
(216, 'Validité visite technique / assurance ', 7, 42, 30),
(217, 'Visite médicale', 7, 42, 30),
(218, 'Documents de bords Livret Blackspot, manuel chauffeur /PATH , Carnet d\'entretien,....', 7, 42, 30),
(219, 'Documents d’urgence : Plan et contact urgence, FDS ou fiche de sécurité,…', 7, 42, 30),
(220, 'Visibilité (pare brise, rétroviseur,...)', 7, 42, 31),
(221, 'Ceinture de sécurité chauffeur et passager présents et conformes', 7, 42, 31),
(222, 'Feux de position, route et croisement opérationnel', 7, 42, 31),
(223, 'Feux de signalisation opérationels', 7, 42, 31),
(224, 'Coupe batterie conforme et opérationnel', 7, 42, 31),
(225, 'Plot de mise à la terre présent et conforme', 7, 42, 31),
(226, 'Pare flamme conforme', 7, 42, 31),
(227, 'Etat des pneus y/c roue(s) de secours', 7, 42, 31),
(228, 'Redémarrage / fonctionnement freinage', 7, 42, 31),
(229, 'Etiquettes ADR présent et en bon état', 7, 42, 31),
(230, 'Extincteurs présents, en bon état et valides (2 ABC 09kg citerne et 1 CO2 cabine)', 7, 42, 31),
(231, 'Existence triangle de signalisation, rubans de balisage ou cônes', 7, 42, 31),
(232, 'Cales en bon état et conformes', 7, 42, 31),
(233, 'Contenu trousse de secours complet et valide', 7, 42, 31),
(234, 'Absence de câbles nus et apparents', 7, 42, 31),
(235, 'Absence de branchement frauduleuse', 7, 42, 31),
(236, 'Cerclages trous d’hommes soudés', 7, 42, 31),
(237, 'Conformité scellés trou d’homme', 7, 42, 31),
(238, 'Propreté/vacuité compartiment', 7, 42, 31),
(239, 'Conformité scellés des vannes', 7, 42, 31),
(240, 'Absence de fuite', 7, 42, 31),
(241, 'Flexibles valides et en bon état', 7, 42, 31),
(242, 'Balisage de zone par usage de plot avec chainette,', 7, 43, 32),
(243, 'Arrêt de distribution dans un rayon de 5m,', 7, 43, 32),
(244, 'Pas de feux nus à proximité,', 7, 43, 32),
(245, 'Présence 2 extincteurs ABC 09kg dans la zone,', 7, 43, 32),
(246, 'Camion en position de départ (Marche avant)', 7, 43, 33),
(247, 'Vitres portières fermés,', 7, 43, 33),
(248, 'Appareil électrique CC éteint.', 7, 43, 33),
(249, 'Téléphone éteint', 7, 43, 33),
(250, 'Mise à la terre en place,', 7, 43, 33),
(251, 'Pas de feux nus à proximité,', 7, 43, 33),
(252, 'Frein de parc bien engagé,', 7, 43, 33),
(253, 'Coupe batterie enclenché,', 7, 43, 33),
(254, 'Pose de triangle de signalisation, ', 7, 43, 33),
(255, 'Cales apposées sur les roues,', 7, 43, 33),
(256, 'Seau de récupération égoutture en alu et en place,', 7, 43, 33),
(257, 'Branchement flexible côté camion avant connexion côté bouche (PB) – flexible dépôt (Autres)', 7, 43, 33),
(258, 'Respect distance de sécurité', 7, 44, NULL),
(259, 'Position correcte par rapport à la chaussée', 7, 44, NULL),
(260, 'Allure adaptée à la circonstance', 7, 44, NULL),
(261, 'Signalisation lors des changements de direction', 7, 44, NULL),
(262, 'Pas de téléphone au volant ni de passager public', 7, 44, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `QuestionCategorie`
--

CREATE TABLE `QuestionCategorie` (
  `id` int(11) NOT NULL,
  `label` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `QuestionCategorie`
--

INSERT INTO `QuestionCategorie` (`id`, `label`) VALUES
(1, 'HYGIENE'),
(2, 'SECURITE INSTALLATIONS'),
(3, 'SECURITE INSTALLATIONS FIXES & MATERIELS ROULANTS'),
(4, 'ENVIRONNEMENT'),
(5, 'QUALITE'),
(6, 'CAUSERIE SECURITE'),
(7, 'Accès'),
(8, 'Extincteurs'),
(9, 'Sirène - Alarme'),
(10, 'Circulation'),
(11, 'Stockage bouteilles vides ou pleines'),
(12, 'Aire de dépotage'),
(13, 'Pomporie incendie'),
(14, 'Défense incendie (boîtes à mousse, couronne de refroidissement...)'),
(15, 'Hail demplissage'),
(16, 'Matériel roulant'),
(17, 'Stockage'),
(18, 'Arrêt d\'urgence'),
(19, 'Electricité'),
(20, 'Documents'),
(21, 'EPI'),
(22, 'Si travaux en cours'),
(23, 'Local groupe électrogène'),
(24, 'DCI'),
(25, 'DOCUMENTS DE CHANTIER'),
(26, 'INSTALLATIONS DE CHANTIER'),
(27, 'AIRE DE CIRCULATION ET DE TRAVAIL'),
(28, 'EQUIPEMENT DE PROTECTION INDIVIDUELLE'),
(29, 'EQUIPEMENT DE PROTECTION COLLECTIVE'),
(30, 'RESPECT DES CONSIGNES'),
(31, 'ENGINS DE CHANTIER'),
(32, 'ENVIRONNEMENT'),
(33, 'MOYENS DE LUTTE CONTRE INCENDIE'),
(34, 'STOP CARD'),
(35, 'DEBRIFIENG TOUR SECURITE'),
(36, 'Etat général'),
(37, 'Equipement du véhicule'),
(38, 'Chauffeur'),
(39, 'Contrôles communs'),
(40, 'Hydrocarbures, lubrifiants vrac, fuel lourd'),
(41, 'Semi et porteur gaz vrac'),
(42, 'CONTROLE DU CAMION CITERNE'),
(43, 'CONTROLE APPLICATION DES CONSIGNES DE SECURITE'),
(44, 'CONTROLE SUR ROUTE'),
(45, 'MOYENS DE PREMIERS SECOURS');

-- --------------------------------------------------------

--
-- Structure de la table `QuestionSousCategorie`
--

CREATE TABLE `QuestionSousCategorie` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `label` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `QuestionSousCategorie`
--

INSERT INTO `QuestionSousCategorie` (`id`, `categorie_id`, `label`) VALUES
(1, 1, 'Installations sanitaires'),
(2, 1, 'Trousse de secours'),
(3, 1, 'EPI'),
(4, 2, 'Extinceurs'),
(5, 2, 'Arrêt d\'urgence'),
(6, 2, 'Bac à sable'),
(7, 2, 'Appareils distributeurs'),
(8, 2, 'Electricité'),
(9, 2, 'Zone de depotage'),
(10, 2, 'Baies de services'),
(11, 2, 'Présence Entreprise Extérieure'),
(12, 2, 'Documents'),
(13, 4, 'Décanteurs'),
(14, 5, 'Campagne qualité'),
(15, 3, 'Evacuation en cas d\'urgence'),
(16, 3, 'Extincteurs'),
(17, 3, 'Arrêt d\'urgence'),
(18, 3, 'Zone pomperie'),
(19, 3, 'Tableau électrique TGBT'),
(20, 3, 'Zone de depotage'),
(21, 3, 'Si opération de dépotage'),
(22, 3, 'Zone de stockage'),
(23, 3, 'Couronne des bacs'),
(24, 3, 'Parc à fûts'),
(25, 3, 'Matériels roulants'),
(26, 3, 'Présence Entreprise Extérieure'),
(27, 3, 'Documents'),
(28, 4, 'Compartiments des décanteurs'),
(29, 5, 'Qualité produits'),
(30, 42, ' Aptititude chaffeurs et papiers véhicules'),
(31, 42, 'Camion citerne'),
(32, 43, 'Par le réceptionnaire'),
(33, 43, 'Par les chauffeurs du camion citerne'),
(34, 2, 'Si opération de dépotage'),
(35, 12, 'Si opération de dépotage');

-- --------------------------------------------------------

--
-- Structure de la table `Reponse`
--

CREATE TABLE `Reponse` (
  `id` int(11) NOT NULL,
  `visite_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `type_reponse` tinyint(4) NOT NULL,
  `oui_non` tinyint(4) DEFAULT NULL,
  `observation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `point_bloquant_id` int(11) DEFAULT NULL,
  `controle` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id` int(11) NOT NULL,
  `nom_utilisateur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mot_de_passe` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `nom_complet` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `est_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`id`, `nom_utilisateur`, `mot_de_passe`, `type_id`, `nom_complet`, `adresse_email`, `est_active`) VALUES
(1, 'admin', 'admin', 1, 'administrateur', NULL, 1),
(2, 'rakoto', 'rakoto', 3, 'Rakotoarinaivo Jean Paul', 'rakotoariavojp@email.com', 1),
(3, 'user001', 'pass', 3, 'User 001', 'user001@email.com', 1),
(5, 'David', 'david', 2, 'David Leroy', 'davidleroy@email.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `UtilisateurType`
--

CREATE TABLE `UtilisateurType` (
  `id` int(11) NOT NULL,
  `label` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `UtilisateurType`
--

INSERT INTO `UtilisateurType` (`id`, `label`) VALUES
(1, 'Gérant'),
(2, 'Chef de site'),
(3, 'Visiteur');

-- --------------------------------------------------------

--
-- Structure de la table `Visite`
--

CREATE TABLE `Visite` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `localisation_id` int(11) NOT NULL,
  `visiteur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `Visite`
--

INSERT INTO `Visite` (`id`, `date`, `time`, `localisation_id`, `visiteur_id`) VALUES
(1, '2019-11-04', '10:12:06', 18, 1),
(2, '2019-11-01', '13:08:10', 19, 2),
(3, '2019-11-20', '12:07:06', 20, 3),
(4, '2019-11-19', '05:05:05', 21, 4);

-- --------------------------------------------------------

--
-- Structure de la table `VisiteCamionControle`
--

CREATE TABLE `VisiteCamionControle` (
  `visite_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `nom_chauffeur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nom_aide_chauffeur` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `immatriculation` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `produit_id` int(11) NOT NULL,
  `point_controle_id` int(11) NOT NULL,
  `point_controle_autre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chaffeur_test_alcool_1` tinyint(4) NOT NULL,
  `chauffeur_test_alcool_2` tinyint(4) NOT NULL,
  `aide_chaffeur_test_alcool_1` tinyint(4) DEFAULT NULL,
  `aide_chaffeur_test_alcool_2` tinyint(4) DEFAULT NULL,
  `chaffeur_signature` blob DEFAULT NULL,
  `aide_chauffeur_signature` blob DEFAULT NULL,
  `observations` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `VisiteCamionSTLBouteille`
--

CREATE TABLE `VisiteCamionSTLBouteille` (
  `visite_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `nom_transporteur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nom_conducteur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kilometrage_tracteur` int(11) NOT NULL DEFAULT 0,
  `immatriculation_tracteur` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `immatriculation_semi_remorque` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `remarques` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `vehicule_acceptee` tinyint(4) NOT NULL,
  `visa_inspecteur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `visa_conducteur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `produit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `VisiteCamionSTLOpere`
--

CREATE TABLE `VisiteCamionSTLOpere` (
  `visite_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `nom_trasporteur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nom_conducteur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nom_expediteur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kilometrage_tracteur` int(11) NOT NULL,
  `immatriculation_tracteur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `immatriculation_semi_remorque` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `produit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `VisiteCentreEmplisseur`
--

CREATE TABLE `VisiteCentreEmplisseur` (
  `visite_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `VisiteDepotAviation`
--

CREATE TABLE `VisiteDepotAviation` (
  `visite_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `VisiteHSEChantier`
--

CREATE TABLE `VisiteHSEChantier` (
  `visite_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `nom_chef_chantier_exterieur` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entreprise_exterieur_id` int(11) DEFAULT NULL,
  `point_forts` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `point_faibles` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `point_abordes` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `VisiteStationService`
--

CREATE TABLE `VisiteStationService` (
  `visite_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `VisiteStationService`
--

INSERT INTO `VisiteStationService` (`visite_id`, `type_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `VisiteType`
--

CREATE TABLE `VisiteType` (
  `id` int(11) NOT NULL,
  `label` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `VisiteType`
--

INSERT INTO `VisiteType` (`id`, `label`) VALUES
(1, 'Station Service'),
(2, 'Dépôt Aviation'),
(3, 'Centre Emplisseur'),
(4, 'HSE Chantier'),
(5, 'Camion STL Bouteilles'),
(6, 'Camion STL Operé'),
(7, 'Camion Contrôle');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `VUECamionControleQuestion`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `VUECamionControleQuestion` (
`id` int(11)
,`categorie` varchar(250)
,`sous_categorie` varchar(200)
,`question` text
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `VUECamionSTLBouteilleQuestion`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `VUECamionSTLBouteilleQuestion` (
`id` int(11)
,`categorie` varchar(250)
,`question` text
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `VUECamionSTLOpereQuestion`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `VUECamionSTLOpereQuestion` (
`id` int(11)
,`categorie` varchar(250)
,`question` text
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `VUECentreEmplisseurQuestion`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `VUECentreEmplisseurQuestion` (
`id` int(11)
,`categorie` varchar(250)
,`sous_categorie` varchar(200)
,`question` text
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `VUEDepotAviationQuestion`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `VUEDepotAviationQuestion` (
`id` int(11)
,`categorie` varchar(250)
,`sous_categorie` varchar(200)
,`question` text
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `VUEHSEChantierQuestion`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `VUEHSEChantierQuestion` (
`id` int(11)
,`categorie` varchar(250)
,`question` text
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `VUEStationServiceQuestion`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `VUEStationServiceQuestion` (
`id` int(11)
,`categorie` varchar(250)
,`sous_categorie` varchar(200)
,`question` text
);

-- --------------------------------------------------------

--
-- Structure de la vue `VUECamionControleQuestion`
--
DROP TABLE IF EXISTS `VUECamionControleQuestion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VUECamionControleQuestion`  AS  select `Question`.`id` AS `id`,`QuestionCategorie`.`label` AS `categorie`,`QuestionSousCategorie`.`label` AS `sous_categorie`,`Question`.`label` AS `question` from ((`Question` join `QuestionCategorie` on(`QuestionCategorie`.`id` = `Question`.`categorie_id`)) left join `QuestionSousCategorie` on(`QuestionSousCategorie`.`id` = `Question`.`sous_categorie_id`)) where `Question`.`visite_type_id` = 7 ;

-- --------------------------------------------------------

--
-- Structure de la vue `VUECamionSTLBouteilleQuestion`
--
DROP TABLE IF EXISTS `VUECamionSTLBouteilleQuestion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VUECamionSTLBouteilleQuestion`  AS  select `Question`.`id` AS `id`,`QuestionCategorie`.`label` AS `categorie`,`Question`.`label` AS `question` from (`Question` join `QuestionCategorie` on(`QuestionCategorie`.`id` = `Question`.`categorie_id`)) where `Question`.`visite_type_id` = 5 ;

-- --------------------------------------------------------

--
-- Structure de la vue `VUECamionSTLOpereQuestion`
--
DROP TABLE IF EXISTS `VUECamionSTLOpereQuestion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VUECamionSTLOpereQuestion`  AS  select `Question`.`id` AS `id`,`QuestionCategorie`.`label` AS `categorie`,`Question`.`label` AS `question` from (`Question` join `QuestionCategorie` on(`QuestionCategorie`.`id` = `Question`.`categorie_id`)) where `Question`.`visite_type_id` = 6 ;

-- --------------------------------------------------------

--
-- Structure de la vue `VUECentreEmplisseurQuestion`
--
DROP TABLE IF EXISTS `VUECentreEmplisseurQuestion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VUECentreEmplisseurQuestion`  AS  select `Question`.`id` AS `id`,`QuestionCategorie`.`label` AS `categorie`,`QuestionSousCategorie`.`label` AS `sous_categorie`,`Question`.`label` AS `question` from ((`Question` join `QuestionCategorie` on(`QuestionCategorie`.`id` = `Question`.`categorie_id`)) left join `QuestionSousCategorie` on(`QuestionSousCategorie`.`id` = `Question`.`sous_categorie_id`)) where `Question`.`visite_type_id` = 3 ;

-- --------------------------------------------------------

--
-- Structure de la vue `VUEDepotAviationQuestion`
--
DROP TABLE IF EXISTS `VUEDepotAviationQuestion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VUEDepotAviationQuestion`  AS  select `Question`.`id` AS `id`,`QuestionCategorie`.`label` AS `categorie`,`QuestionSousCategorie`.`label` AS `sous_categorie`,`Question`.`label` AS `question` from ((`Question` join `QuestionCategorie` on(`QuestionCategorie`.`id` = `Question`.`categorie_id`)) left join `QuestionSousCategorie` on(`QuestionSousCategorie`.`id` = `Question`.`sous_categorie_id`)) where `Question`.`visite_type_id` = 2 ;

-- --------------------------------------------------------

--
-- Structure de la vue `VUEHSEChantierQuestion`
--
DROP TABLE IF EXISTS `VUEHSEChantierQuestion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VUEHSEChantierQuestion`  AS  select `Question`.`id` AS `id`,`QuestionCategorie`.`label` AS `categorie`,`Question`.`label` AS `question` from (`Question` join `QuestionCategorie` on(`QuestionCategorie`.`id` = `Question`.`categorie_id`)) where `Question`.`visite_type_id` = 4 ;

-- --------------------------------------------------------

--
-- Structure de la vue `VUEStationServiceQuestion`
--
DROP TABLE IF EXISTS `VUEStationServiceQuestion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VUEStationServiceQuestion`  AS  select `Question`.`id` AS `id`,`QuestionCategorie`.`label` AS `categorie`,`QuestionSousCategorie`.`label` AS `sous_categorie`,`Question`.`label` AS `question` from ((`Question` join `QuestionCategorie` on(`QuestionCategorie`.`id` = `Question`.`categorie_id`)) left join `QuestionSousCategorie` on(`QuestionSousCategorie`.`id` = `Question`.`sous_categorie_id`)) where `Question`.`visite_type_id` = 1 ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `EntrepriseExterieur`
--
ALTER TABLE `EntrepriseExterieur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Localisation`
--
ALTER TABLE `Localisation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `responsable_id` (`responsable_id`),
  ADD KEY `type_localisation_id` (`type_id`);

--
-- Index pour la table `LocalisationType`
--
ALTER TABLE `LocalisationType`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `PointBloquant`
--
ALTER TABLE `PointBloquant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `PointControle`
--
ALTER TABLE `PointControle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `QuestionCategorie`
--
ALTER TABLE `QuestionCategorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `QuestionSousCategorie`
--
ALTER TABLE `QuestionSousCategorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Reponse`
--
ALTER TABLE `Reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `point_bloquant_id` (`point_bloquant_id`),
  ADD KEY `visite_id` (`visite_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_utilisateur_id` (`type_id`);

--
-- Index pour la table `UtilisateurType`
--
ALTER TABLE `UtilisateurType`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Visite`
--
ALTER TABLE `Visite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `VisiteCamionControle`
--
ALTER TABLE `VisiteCamionControle`
  ADD PRIMARY KEY (`visite_id`),
  ADD KEY `type_visite_id` (`type_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Index pour la table `VisiteCamionSTLBouteille`
--
ALTER TABLE `VisiteCamionSTLBouteille`
  ADD PRIMARY KEY (`visite_id`),
  ADD KEY `type_visite_id` (`type_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Index pour la table `VisiteCamionSTLOpere`
--
ALTER TABLE `VisiteCamionSTLOpere`
  ADD PRIMARY KEY (`visite_id`),
  ADD KEY `type_visite_id` (`type_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Index pour la table `VisiteCentreEmplisseur`
--
ALTER TABLE `VisiteCentreEmplisseur`
  ADD PRIMARY KEY (`visite_id`),
  ADD KEY `type_visite_id` (`type_id`);

--
-- Index pour la table `VisiteDepotAviation`
--
ALTER TABLE `VisiteDepotAviation`
  ADD PRIMARY KEY (`visite_id`),
  ADD KEY `type_visite_id` (`type_id`);

--
-- Index pour la table `VisiteHSEChantier`
--
ALTER TABLE `VisiteHSEChantier`
  ADD PRIMARY KEY (`visite_id`),
  ADD KEY `type_visite_id` (`type_id`),
  ADD KEY `entreprise_exterieur_id` (`entreprise_exterieur_id`);

--
-- Index pour la table `VisiteStationService`
--
ALTER TABLE `VisiteStationService`
  ADD PRIMARY KEY (`visite_id`),
  ADD KEY `type_visite_id` (`type_id`);

--
-- Index pour la table `VisiteType`
--
ALTER TABLE `VisiteType`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `EntrepriseExterieur`
--
ALTER TABLE `EntrepriseExterieur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Localisation`
--
ALTER TABLE `Localisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `LocalisationType`
--
ALTER TABLE `LocalisationType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `PointBloquant`
--
ALTER TABLE `PointBloquant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `PointControle`
--
ALTER TABLE `PointControle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Produit`
--
ALTER TABLE `Produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Question`
--
ALTER TABLE `Question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT pour la table `QuestionCategorie`
--
ALTER TABLE `QuestionCategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `QuestionSousCategorie`
--
ALTER TABLE `QuestionSousCategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `Reponse`
--
ALTER TABLE `Reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `UtilisateurType`
--
ALTER TABLE `UtilisateurType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `VisiteType`
--
ALTER TABLE `VisiteType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Localisation`
--
ALTER TABLE `Localisation`
  ADD CONSTRAINT `Localisation_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `Localisation` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Localisation_ibfk_2` FOREIGN KEY (`responsable_id`) REFERENCES `Utilisateur` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Localisation_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `LocalisationType` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `Reponse`
--
ALTER TABLE `Reponse`
  ADD CONSTRAINT `Reponse_ibfk_1` FOREIGN KEY (`point_bloquant_id`) REFERENCES `PointBloquant` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Reponse_ibfk_2` FOREIGN KEY (`visite_id`) REFERENCES `Visite` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Reponse_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `Question` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD CONSTRAINT `Utilisateur_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `UtilisateurType` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `VisiteCamionControle`
--
ALTER TABLE `VisiteCamionControle`
  ADD CONSTRAINT `VisiteCamionControle_ibfk_1` FOREIGN KEY (`visite_id`) REFERENCES `Visite` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VisiteCamionControle_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `VisiteType` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VisiteCamionControle_ibfk_3` FOREIGN KEY (`produit_id`) REFERENCES `Produit` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `VisiteCamionSTLBouteille`
--
ALTER TABLE `VisiteCamionSTLBouteille`
  ADD CONSTRAINT `VisiteCamionSTLBouteille_ibfk_1` FOREIGN KEY (`visite_id`) REFERENCES `Visite` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VisiteCamionSTLBouteille_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `VisiteType` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VisiteCamionSTLBouteille_ibfk_3` FOREIGN KEY (`produit_id`) REFERENCES `Produit` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `VisiteCamionSTLOpere`
--
ALTER TABLE `VisiteCamionSTLOpere`
  ADD CONSTRAINT `VisiteCamionSTLOpere_ibfk_1` FOREIGN KEY (`visite_id`) REFERENCES `Visite` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VisiteCamionSTLOpere_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `VisiteType` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VisiteCamionSTLOpere_ibfk_3` FOREIGN KEY (`produit_id`) REFERENCES `Produit` (`id`) ON UPDATE NO ACTION;

--
-- Contraintes pour la table `VisiteCentreEmplisseur`
--
ALTER TABLE `VisiteCentreEmplisseur`
  ADD CONSTRAINT `VisiteCentreEmplisseur_ibfk_1` FOREIGN KEY (`visite_id`) REFERENCES `Visite` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VisiteCentreEmplisseur_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `VisiteType` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `VisiteDepotAviation`
--
ALTER TABLE `VisiteDepotAviation`
  ADD CONSTRAINT `VisiteDepotAviation_ibfk_1` FOREIGN KEY (`visite_id`) REFERENCES `Visite` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VisiteDepotAviation_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `VisiteType` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `VisiteHSEChantier`
--
ALTER TABLE `VisiteHSEChantier`
  ADD CONSTRAINT `VisiteHSEChantier_ibfk_1` FOREIGN KEY (`visite_id`) REFERENCES `Visite` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VisiteHSEChantier_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `VisiteType` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VisiteHSEChantier_ibfk_3` FOREIGN KEY (`entreprise_exterieur_id`) REFERENCES `EntrepriseExterieur` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `VisiteStationService`
--
ALTER TABLE `VisiteStationService`
  ADD CONSTRAINT `VisiteStationService_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `VisiteType` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `VisiteStationService_ibfk_2` FOREIGN KEY (`visite_id`) REFERENCES `Visite` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
