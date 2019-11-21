SELECT CONCAT(cl.id,cl.name,clt.name,cs.fullname) as recherche from codir_locals as cl join codir_local_type as clt on cl.local_type_id = clt.id join codir_users as cs on cl.local_manager_id = cs.id where clt.name ="site"
CREATE VIEW recherche_global as SELECT CONCAT(cl.id,cl.name,clt.name,cs.fullname) as recherche from codir_locals as cl join codir_local_type as clt on cl.local_type_id = clt.id join codir_users as cs on cl.local_manager_id = cs.id where clt.name ="site"
SELECT * FROM recherche_global where recherche LIKE '%1%'

DROP TABLE IF EXISTS `codir_user_profil`;
CREATE TABLE IF NOT EXISTS `codir_user_profil`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY  ,
 `name` varchar(45) UNIQUE NOT NULL 
);
insert into codir_user_profil(name) values('Gérant');
insert into codir_user_profil(name) values('Chef de site');
insert into codir_user_profil(name) values('Visiteur');

-- ************************************** `codir_users`
DROP TABLE IF EXISTS `codir_users`;
CREATE TABLE IF NOT EXISTS `codir_users`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY  ,
 `login`     varchar(100) UNIQUE NOT NULL ,
 `password`  varchar(300) NOT NULL ,
 `fullname`  varchar(200) UNIQUE NOT NULL , 
 `profil_id` integer  NULL ,
 `adress_email`  varchar(200) UNIQUE NOT NULL , 
 `is_active` tinyint NULL ,
    FOREIGN KEY  (`profil_id`) REFERENCES `codir_user_profil` (`id`)
);
insert into codir_users(login,password,fullname,adress_email) values('user001','pass','USER 001','user001@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user002','pass','USER 002','user002@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user003','pass','USER 003','user003gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user004','pass','USER 004','user004@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user005','pass','USER 005','user005@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user006','pass','USER 006','user006@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user007','pass','USER 007','user007@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user008','pass','USER 008','user008@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user009','pass','USER 009','user009@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user010','pass','USER 010','user0010@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user011','pass','USER 011','user0011@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user012','pass','USER 012','user0012@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user013','pass','USER 013','user0013@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user014','pass','USER 014','user0014@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user015','pass','USER 015','user0015@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user016','pass','USER 016','user0016@gmail.com');
insert into codir_users(login,password,fullname,adress_email) values('user017','pass','USER 017','user0017@gmail.com');

--
-- Structure de la table `centre_emplisseur`
--

DROP TABLE IF EXISTS `centre_emplisseur`;
CREATE TABLE IF NOT EXISTS `centre_emplisseur` (
  `id_centre` int(11) NOT NULL AUTO_INCREMENT,
  `ville` varchar(255) NOT NULL,
  PRIMARY KEY (`id_centre`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
INSERT INTO centre_emplisseur(ville) VALUES
('Antananarivo'),
('Toamasina'),
('Fianarantsoa'),
('Antsiranana'),
('Antsirabe'),
('Diego'),
('Majunga'),
('Amparafaravola'),
('Ambatondrazaka');

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

INSERT INTO depot_aviation (id_depot, depot_aviation, nom_chef_site) VALUES
(1, 'Arivonimamo', 'Jean Marc2'),
(2, 'Ivato', 'Ndrema'),
(3, 'Toamasina', 'Bezily');

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

INSERT INTO station_service (id_station, nom_station) VALUES
(1, 'Total tsy anosy'),
(2, 'Total Ampefiloha'),
(3, 'Total ankadimbahoaka');


-- ************************************** `gpl_visit`
DROP TABLE IF EXISTS `gpl_visit`;
CREATE TABLE IF NOT EXISTS `gpl_visit`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY  ,
 `visit_date` date NOT NULL ,
 `visitor_id` integer NOT NULL ,
`state` tinyint ,

FOREIGN KEY  (`visitor_id`) REFERENCES `codir_users` (`id`)
);
-- ************************************** `deposit_visit`
CREATE TABLE `codir_local_type`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `name` varchar(100) UNIQUE NOT NULL 
);
insert into codir_local_type(name) values('site');
insert into codir_local_type(name) values('lieu');
insert into codir_local_type(name) values('station service');
insert into codir_local_type(name) values('dépot aviation');
insert into codir_local_type(name) values('ville');
-- ************************************** `codir_locals` 
CREATE TABLE `codir_locals`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `name`             varchar(45)  NOT NULL ,
 `local_manager_id` integer NULL ,
 `local_type_id`    integer NOT NULL ,
 UNIQUE(name),
 FOREIGN KEY (`local_manager_id`) REFERENCES `codir_users` (`id`),
 FOREIGN KEY (`local_type_id`) REFERENCES `codir_local_type` (`id`)
);
-- station services
insert into codir_locals(name,local_manager_id,local_type_id) values('Domaine Alasora',1,3);
insert into codir_locals(name,local_manager_id,local_type_id) values('Ankadivato',2,3);
insert into codir_locals(name,local_manager_id,local_type_id) values('Antsahabe',3,3);
insert into codir_locals(name,local_manager_id,local_type_id) values('Ambanidia',4,3);
insert into codir_locals(name,local_manager_id,local_type_id) values('Anosizato',5,3);

-- depot aviation
insert into codir_locals(name,local_manager_id,local_type_id) values('Ivato',6,4);
insert into codir_locals(name,local_manager_id,local_type_id) values('Tamatave',7,4);
insert into codir_locals(name,local_manager_id,local_type_id) values('Majunga',8,4);

-- site 
insert into codir_locals(name,local_manager_id,local_type_id) values('Sambirano',9,1);
insert into codir_locals(name,local_manager_id,local_type_id) values('Antsohihy',10,1);
insert into codir_locals(name,local_manager_id,local_type_id) values('Sava',11,1);
insert into codir_locals(name,local_manager_id,local_type_id) values('Diana',12,1);

-- lieu 
insert into codir_locals(name,local_manager_id,local_type_id) values('Alavitra be',13,2);
insert into codir_locals(name,local_manager_id,local_type_id) values('Any e',14,2);
insert into codir_locals(name,local_manager_id,local_type_id) values('Ambohitsitononina',15,2);


-- villes 
insert into codir_locals(name,local_manager_id,local_type_id) values('Analakely',13,5);
insert into codir_locals(name,local_manager_id,local_type_id) values('Isotry',13,5);
insert into codir_locals(name,local_manager_id,local_type_id) values('Mahamasina',13,5);
insert into codir_locals(name,local_manager_id,local_type_id) values('Ankorondrano',13,5);

DROP TABLE IF EXISTS `deposit_visit`;
CREATE TABLE IF NOT EXISTS `deposit_visit`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `visit_date` date NOT NULL ,
 `visitor_id` integer NOT NULL ,
 `site_id`    integer NOT NULL ,
  `state` tinyint ,

FOREIGN KEY  (`visitor_id`) REFERENCES `codir_users` (`id`),
FOREIGN KEY  (`site_id`) REFERENCES `codir_locals` (`id`)
);

CREATE TABLE if not exists `codir_product`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `name` varchar(150) NOT NULL 
);
insert into codir_product(name) values('Produit 1');
insert into codir_product(name) values('Produit 2');
insert into codir_product(name) values('Produit 3');
insert into codir_product(name) values('Produit 4');
insert into codir_product(name) values('Produit 5');
-- ************************************** `business`
CREATE TABLE if not exists  `business`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `name` varchar(100) NOT NULL 
);
insert into business(name) values('Entreprise 1');
insert into business(name) values('Entreprise 2');
insert into business(name) values('Entreprise 3');
insert into business(name) values('Entreprise 4');
insert into business(name) values('Entreprise 5');
insert into business(name) values('Entreprise 6');
insert into business(name) values('Entreprise 7');
insert into business(name) values('Entreprise 8');
insert into business(name) values('Entreprise 9');
insert into business(name) values('Entreprise 10');
-- ************************************** `point_of_control`
CREATE TABLE if not exists  `point_of_control`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `name` varchar(45) NOT NULL 
);
insert into point_of_control(name) values('Chargement');
insert into point_of_control(name) values('Trajet');
insert into point_of_control(name) values('Déchargement');
insert into point_of_control(name) values('Autre');

--*********************************************
CREATE TABLE if not exists `network_visit`
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `visit_date`     date NOT NULL ,
 `visitor_id`     integer NOT NULL ,
 `gas_station_id` integer NOT NULL ,
 state tinyint,
FOREIGN KEY (`visitor_id`) REFERENCES `codir_users` (`id`),
FOREIGN KEY (`gas_station_id`) REFERENCES `codir_locals` (`id`)
);

insert into network_visit (visit_date, visitor_id, gas_station_id) VALUES ('2019-10-18',2,1);
insert into network_visit (visit_date, visitor_id, gas_station_id) VALUES ('2019-01-20',3,2);
insert into network_visit (visit_date, visitor_id, gas_station_id) VALUES ('2019-11-12',4,3);
insert into network_visit (visit_date, visitor_id, gas_station_id) VALUES ('2019-09-09',10,4);
insert into network_visit (visit_date, visitor_id, gas_station_id) VALUES ('2019-06-25',5,5);
insert into network_visit (visit_date, visitor_id, gas_station_id) VALUES ('2019-07-16',9,1);
insert into network_visit (visit_date, visitor_id, gas_station_id) VALUES ('2019-05-05',7,3);
-- ************************************** `truck_visit`
CREATE TABLE `truck_visit`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY  ,
 `visit_date`                     date NOT NULL ,
 `visit_time`                     time NOT NULL ,
 `primary_driver_name`            varchar(200) NULL ,
 `secondary_driver_name`          varchar(200) NULL ,
 `truck_registration`             varchar(15) NOT NULL ,
 `carrier`                        varchar(150) NOT NULL ,
 `product_id`                     integer NOT NULL ,
 `point_of_control_id`            integer NOT NULL ,
 `primary_driver_alcool_test_1`   tinyint NOT NULL ,
 `primary_driver_alcool_test_2`   tinyint NOT NULL ,
 `secondary_driver_alcool_test_1` tinyint NOT NULL ,
 `secondary_driver_alcool_test_2` tinyint NOT NULL ,
 `observations`                   text NOT NULL ,
 `place_id`                       integer NOT NULL ,
 `city_id`                        integer NOT NULL ,
 `site_id`                        integer NOT NULL ,
    state tinyint,
FOREIGN KEY  (`product_id`) REFERENCES `codir_product` (`id`),
FOREIGN KEY  (`point_of_control_id`) REFERENCES `point_of_control` (`id`),
FOREIGN KEY  (`place_id`) REFERENCES `codir_locals` (`id`),
FOREIGN KEY  (`city_id`) REFERENCES `codir_locals` (`id`),
FOREIGN KEY  (`site_id`) REFERENCES `codir_locals` (`id`)
);
-- ************************************** `truck_controllers`

DROP TABLE IF EXISTS `truck_controllers`;
CREATE TABLE IF not EXISTS `truck_controllers`
(
 `truck_visit_id`      integer NOT NULL ,
 `society_or_function` varchar(150) NULL ,
 `visa`                varchar(200) NULL ,
 `controller_id`       integer NOT NULL ,
  `state` boolean ,

 FOREIGN KEY  (`truck_visit_id`) REFERENCES `truck_visit` (`id`),
 FOREIGN KEY  (`controller_id`) REFERENCES `codir_users` (`id`)
);
-- ************************************** `stl_operated_truck_visit`

DROP TABLE IF EXISTS `stl_operated_truck_visit`;
CREATE TABLE IF NOT EXISTS `stl_operated_truck_visit`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `visit_date`               date NOT NULL ,
 `visit_time`               time NOT NULL ,
 `carrier`                  varchar(200) NOT NULL ,
 `sender_name`              varchar(200) NOT NULL ,
 `tractor_registration`     varchar(15) NOT NULL ,
 `semitrailer_registration` varchar(15) NOT NULL ,
 `driver_name`              varchar(200) NOT NULL ,
 `tractor_mileage`          integer NOT NULL ,
 `product_id`               integer NOT NULL ,
 `inspector_id`             integer NOT NULL ,
 `vehicle_accepted`         tinyint  NULL ,
 `inspector_visa`           blob  NULL ,
 `driver_visa`              blob  NULL ,
 `control_place_id`         integer NOT NULL ,
  `state` boolean ,

FOREIGN KEY  (`product_id`) REFERENCES `codir_product` (`id`),
FOREIGN KEY  (`inspector_id`) REFERENCES `codir_users` (`id`),
FOREIGN KEY  (`control_place_id`) REFERENCES `codir_locals` (`id`)
);
-- ************************************** `stl_bottle_visit`

DROP TABLE IF EXISTS `stl_bottle_visit`;
CREATE TABLE IF NOT EXISTS `stl_bottle_visit`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `visit_date`               date NOT NULL ,
 `visit_time`               time NOT NULL ,
 `inspector_id`             integer NOT NULL ,
 `product_id`               integer NOT NULL ,
 `carrier`                  varchar(150) NOT NULL ,
 `tractor_registration`     varchar(15) NOT NULL ,
 `semitrailer_registration` varchar(15) NOT NULL ,
 `driver_name`              varchar(200) NOT NULL ,
 `tractor_mileage`          numeric (10,2) NOT NULL ,
 `remarks`                  text NULL ,
 `vehicle_accepted`         tinyint NULL ,
 `inspector_visa`           blob NULL ,
 `driver_visa`              blob NULL ,
 `control_place_id`         integer NOT NULL ,
 `state` boolean ,

FOREIGN KEY (`inspector_id`) REFERENCES `codir_users` (`id`),
FOREIGN KEY (`product_id`) REFERENCES `codir_product` (`id`),
FOREIGN KEY (`control_place_id`) REFERENCES `codir_locals` (`id`)
);
-- ************************************** `hse_construction_visit`

DROP TABLE IF EXISTS `hse_construction_visit`;
CREATE TABLE IF NOT EXISTS `hse_construction_visit`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `visit_date`                date NOT NULL ,
 `site_or_place_id`          integer NOT NULL ,
 `construction_manager_name` varchar(200) NOT NULL ,
 `business_id`               integer NOT NULL ,
 `state` boolean ,

FOREIGN KEY  (`site_or_place_id`) REFERENCES `codir_locals` (`id`),
FOREIGN KEY  (`business_id`) REFERENCES `business` (`id`)
);

-- ************************************** `hse_visit_users`

DROP TABLE IF EXISTS `hse_visit_users`;
CREATE TABLE IF NOT EXISTS `hse_visit_users`
(
 `hse_construction_visit_id` integer NOT NULL ,
 `visitor_id`                integer NOT NULL ,
 `state` boolean ,

PRIMARY KEY (`hse_construction_visit_id`, `visitor_id`),
FOREIGN KEY  (`hse_construction_visit_id`) REFERENCES `hse_construction_visit` (`id`),
FOREIGN KEY  (`visitor_id`) REFERENCES `codir_users` (`id`)
);

-- ************************************** `items`

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `label` varchar(200) NOT NULL 
);
insert into items(label) values("network");
insert into items(label) values("deposit");
insert into items(label) values("gpl");
insert into items(label) values("hseconstruction");
insert into items(label) values("bottles");
insert into items(label) values("operatedtruck");
insert into items(label) values("truckcontrol");


-- ************************************** `categories`
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `label` varchar(150) UNIQUE NOT NULL 
);
insert into categories(label) values('HYGIENE');
insert into categories(label) values('SECURITE INSTALLATIONS');
insert into categories(label) values('ENVIRONNEMENT');
insert into categories(label) values('QUALITE');
insert into categories(label) values('CAUSERIE SECURITE');
insert into categories(label) values('SECURITE INSTALLATIONS FIXES & MATERIELS ROULANTS');
insert into categories(label) values('Accès');
insert into categories(label) values('Extincteurs');
insert into categories(label) values('Sirène  - Alarme');
insert into categories(label) values('Circulation');
insert into categories(label) values('Stockage bouteilles vides ou pleines');
insert into categories(label) values('Aire de dépotage');
insert into categories(label) values('Pomperie incendie');
insert into categories(label) values('Défense incendie');
insert into categories(label) values("Hall d'emplissage");
insert into categories(label) values('Matériel roulant');
insert into categories(label) values('Stockage');
insert into categories(label) values("Arrêt d'urgence");
insert into categories(label) values('Electricité');
insert into categories(label) values('Documents');
insert into categories(label) values('EPI');
insert into categories(label) values('Si travaux en cours');
insert into categories(label) values('Local groupe électrogène');
insert into categories(label) values('DCI');
insert into categories(label) values('Documents de chantier');
insert into categories(label) values('Installation de chantier');
insert into categories(label) values('Aire de circulation et de travaiil');
insert into categories(label) values('Equipement de protection individuelle');
insert into categories(label) values('Equipement de protection collective');
insert into categories(label) values('Respect de consignes');
insert into categories(label) values('Engins de chantier');
insert into categories(label) values('Moyens de lutte contre incendie');
insert into categories(label) values('Moyens de premiers secours');
insert into categories(label) values('Stop card');
insert into categories(label) values('Etat général');
insert into categories(label) values('Equipement de véhicules');
insert into categories(label) values('Chauffeur');
insert into categories(label) values('Contrôles communs');
insert into categories(label) values('Hydrocarbures,lubrifiants vrac,fuel lourd');
insert into categories(label) values('Semi et porteur de gaz vrac');
insert into categories(label) values('Contrôle du camion citerne');
insert into categories(label) values('Contrôle application des consignes de sécurité');
insert into categories(label) values('Contrôle sur route');

-- ************************************** `subcategories`
DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE IF NOT EXISTS `subcategories`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `label` varchar(150) NOT NULL 
);

insert into subcategories(label) values("Installations sanitaires");
insert into subcategories(label) values("Trousses de secours");
insert into subcategories(label) values("EPI");
insert into subcategories(label) values("Extincteus");
insert into subcategories(label) values("Arrêt d'urgence");
insert into subcategories(label) values("Bac à sable");
insert into subcategories(label) values("Appareils distributeurs");
insert into subcategories(label) values("Electricité");
insert into subcategories(label) values("Zone de dépotage");
insert into subcategories(label) values("Si opération de dépotage");
insert into subcategories(label) values("Baies de services");
insert into subcategories(label) values("Présence d'entreprise extérieure");
insert into subcategories(label) values("Documents");
insert into subcategories(label) values("Décanteurs");
insert into subcategories(label) values("Campagne qualité");
insert into subcategories(label) values("Evacuation en cas d'urgence");
insert into subcategories(label) values("Zone pomperie");
insert into subcategories(label) values("Tableau électrique TGBT");
insert into subcategories(label) values("Zone de stockage");
insert into subcategories(label) values("Couronne des bacs");
insert into subcategories(label) values("Parc à fûts");
insert into subcategories(label) values("Matériels roulants");
insert into subcategories(label) values("Compartiment des décanteurs");
insert into subcategories(label) values("Qualité produit");
insert into subcategories(label) values("Aptitude chauffeur et papiers véhicules");
insert into subcategories(label) values("Camion citerne");
insert into subcategories(label) values("Par le réceptionnaire");
insert into subcategories(label) values("Par les chauffeurs du camion citerne");
*/

-- ************************************** `questions`
DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `label` text NOT NULL 
);
----------------------------------  NETWORK  -------------------------------------
-- hygiene
insert into questions(label) values("Propre et en bon état ? bien aérée ? Absence de fuite ?");
insert into questions(label) values("Existe-t-il une trousse de premier secours ? Est-elle signalé et accessible ?");
insert into questions(label) values("Tout le personnel de la station est-il de chaussures de sécurité, vêtement en coton, casquette ? ");


-- securite installations
insert into questions(label) values("La Station dispose-t-elle d'un parc à extincteur (ABC 9kg dans les différents locaux/ CO2 2kg près des coffrets électriques) ? Dernier contrôle datant de moins d'un an ? Sont-t-ils accrochés et signalés ?");
insert into questions(label) values("La Station dispose-t-elle d'un arrêt d'urgence ? Est-t-il signalé ? Est-t-il accessible ? Est-t-il operationnel ?");
insert into questions(label) values("Bien situé? - en bon état - plein? Avec pelle?");
insert into questions(label) values("Les scellés sont -ils en place? Total sur index et Métrologie sur le mesureur");
insert into questions(label) values("Les coffrets électriques sont-ils fermés ? Identifiés par un pictogramme danger ?");
insert into questions(label) values("Les cablages électriques sont-t-ils protegés par des chemins ou goulottes ? Absence de cables nus ni de connexion apparente ? Les regards électriques sont-t-ils protégés (ensablés, bouchonnés)?");
insert into questions(label) values("La station dispose-t-elle de plots et chainettes ou cône pour delimiter le perimètre de sécurité ? Le perimètre de sécurité est-t-il matérialisé au sol ? Les bouches de dépotage sont-t-elles identifiées et  cadenassées ?");
insert into questions(label) values("état du camion citerne ? Conformité des équipements de contrôles qualité et quantité ? EPIs du chauffeur ?");
insert into questions(label) values("Borne à air? Borne à eau? Compresseur opérationnel ? Baie de graissage et ou lavage propre ?");
insert into questions(label) values("Si travaux chantier : contrôle du plan de prevention + permis de travail disponibles et affichés ? Balisage du périmètre de travail? Respect port des EPIS? Permis de 'Travaux en hauteur' ?");
insert into questions(label) values("La station dispose-t-elle d'un registre d'anomalies/dysfonctionnement ? d'un classeur de maintenance ? Liste téléphone d'urgence ?Sont-t-ils tenus à jour ? Les certificats de barémâge?");
-- environment
insert into questions(label) values("La Station dispose-t-elle d'un decanteur/separateur ? Est-t-il operationnel ? Date de dernière entretien ?");
insert into questions(label) values("Les regards d'asssainissement sont-t-ils en bon état et propres ? Les huiles usées sont-t-ils stockés dans des cuves ? Les filtres usés ?");

-- qualite
insert into questions(label) values("Date du dernier prélèvement campagne qualité ? Type de produits analysés? Nombre de non-conformité?Propre et en bon état ? bien aérée ? Absence de fuite ?");
insert into questions(label) values("Nombre de plainte clients sur la qualité produits ?");
insert into questions(label) values("La station dispose-t-elle de: certificats de baremage de ses cuves ? Sont-t-ils valides ? Les huiles usées sont-t-ils stockés dans des cuves ?");
insert into questions(label) values("La station dispose-t-elle de pâte de detection d'eau ? Pâte de detection de produit ? d'un règle gradué pour reperer le niveau de produit dans les cuves ? La station dispose-t-elle d'un thermomètre ? D'un densimètre ? D'une éprouvette ?");

--causerie securite
insert into questions(label) values("Les consignes de sécurité sont-t-ils respectés sur la station ? Moteur arrêté , Téléphone Interdit, Défense de fumer etc ….");
insert into questions(label) values("Le personnel connaît-t-il les conduites à tenir en cas d'urgence ?Epandage de produit , Epandage, Agression, Attentat");
insert into questions(label) values("Le personnel respecte-t-il les procedures en vigueur concernant l'opération de dépotage (Perimètre de sécurité, temps de relaxation, liaison équipotentielle, etc.) ?");
insert into questions(label) values("Le personnel sait-il utilisé des élements suivants : Arrêt d'urgence , Extincteur , Couverture anti-feu");
insert into questions(label) values("Le personnel releve-t-il les situations dangereuses, presques accident ou incident mineur ? Informe-t-il leur superieur hierarchique ou ignore ses évenements ?");
insert into questions(label) values("Quelle est la somme detenue par les pompistes sur eux ?");


----------------------------------  DEPOT AVIATION  -------------------------------------
-- hygiene
insert into questions(label) values(" Propre et en bon état ? bien aérée ? Absence de fuite ?");
insert into questions(label) values(" Existe-t-il une trousse de premier secours ? Est-elle signalé et accessible ? Existe-t-il une liste du contenu et fiche de suivi de la trousse ?");
insert into questions(label) values(" Existe-t-il une trousse de premier secours ? Est-elle signalé et accessible ? Existe-t-il une liste du contenu et fiche de suivi de la trousse ? ");

-- securite installations &  materiels roulants
insert into questions(label) values(" les issues de secours, le point de ralliement matérialisé, plan d'évacuation à jour");
insert into questions(label) values(" L'état du parc à extincteur (ABC dans les différentszones - bâtiments et matériels roulants / CO2 dans les locaux électriques) ? Dernier contrôle datant de moins d'un an ? Sont-t-ils accrochés et signalés ?");
insert into questions(label) values(" L' arrêt d'urgence est-t-il signalé ? Est-t-il accessible ? Est-t-il operationnel ?");
insert into questions(label) values(" Absence de bruits et vibrations anormaux ?  Zone ATEX signalé (panneaux et/ou marquage au sol) ? Pas de traces d'HC importantes sur le sol?");
insert into questions(label) values(" Fermé et cadenassé ? Identifié ? Voyants fonctionnels?");
insert into questions(label) values(" En bon état ?  présence de revêtement anti-dérapant  ? Dispositif DCMT3 en bon état & opérationnel? Armoire de commande pompe: Fermé? Identifié?   Presence de pictogramme danger ATEX?  Harnais de sécurité, ligne de vie...: en bon état? et contrôlé régulièrement?");
insert into questions(label) values(" état du camion citerne ? Conformité des équipements de contrôles qualité et quantité ? EPIs du chauffeur ?");
insert into questions(label) values(" Cuvette de rétention: pas de fissure? exemptes de végétation, boue, matériel parasite (outil, flexible, gamelle, etc.)? Bacs de stockage identifiés, orifices obturés ( mano, purge…), capacité indiquée - En bon état? Passerelles - rambardes-garde-corps & escaliers: Présence de revêtement anti-dérapant ou de caillebotis, non corrodés, fixés?");
insert into questions(label) values(" Non corrodées - En bon état - Pas de fuite? Hauteur d'empilement des fûts & méthode d'empilement des fûts?");
insert into questions(label) values(" En bon état - Toiture bien fixé ? zone étanche?");
insert into questions(label) values(" Fiche d'inspection avant utilisation autres matériels roulants, matériels de levage et de manutention, detecteurs mobiles?(Aspect visuel des pneus - bon fonctionnement de l'éclairage - bon fonctionnement des freins - bon fonctionnement des interlocks - bon fonctionnement arrêt d'urgence - vérification de la liaison équipotentielle - fiabilité des enregistrements - autres)");
insert into questions(label) values(" Si travaux chantier :Un surveillant chantier ? contrôle du plan de prevention + permis de travail disponibles et affichés ? Balisage du périmètre? Respect port des EPIS? Travaux en hauteur ?");
insert into questions(label) values(" Le dépôt dispose-t-il d'un registre visiteur ? d'un classeur de déclaration d'événement? d'un classeur de maintenance?d'un classeur des contrôles réguliers?Liste téléphone d'urgence ?Sont-t-ils tenus à jour ? Les certificats de barémâge?");

--environment
insert into questions(label) values(" Absence de couches d'hydrocarbures ou de boues - absence de couches filamenteuse ou d’émulsions anormales? Absence d'hydrocarbures? Date d'analyse des rejets? Cuve d'écrémage: creux nécessaire disponible?");
insert into questions(label) values(" Gestion des déchets (ménagers et industriels)?Les huiles usées?");
--qualite
insert into questions(label) values(" Le N° Lot du lot d'Avgas ? Date du dernier analyse d'Avgas 100 LL? Date de la dernière recertification de JET A-1?");
insert into questions(label) values(" Le dépôt dispose-t-il de: certificats de baremage de ses bacs? Sont-t-ils valides ?");
insert into questions(label) values(" Le dépôt dispose-t-il  de Shell Water Detection(SWD)et papier chimique (pour l'essence) pour le test de la présence d' eau dans le produit ? La date de péremption du SWD et du papier chimique? La station dispose-t-elle d'un thermomètre ? D'un densimètre ? D'une éprouvette ?");
--causerie securite
insert into questions(label) values(" Date de la  dernière réunion - causerie sécurité ? Rapport ?");
insert into questions(label) values(" Date du dernier exercice incendie ? Rapports?");

----------------------------------  GPL emplisseur  -------------------------------------
--access
insert into questions(label) values("Accès / sorties contrôlés par agents de sécurité? Points de ralliement, et issues de secours matérialisés et dégagés?");
insert into questions(label) values("Grillages, portails  et clôtures : en bon état?");
insert into questions(label) values("Panneaux interdictions - obligations, consignes d'urgence ? Plan d'évacuation ?");

--extincteurs
insert into questions(label) values("Extincteurs: classe adaptée aux risques - accrochés - vérifiés - numérotés - signalés?");

--sirene alarmes
insert into questions(label) values("Présence? Contacteurs en nombre suffisants? Date du dernier test périodique de fonctionnement ? Etat Autochim? Opérationnel?");

--circulation
insert into questions(label) values("Circulation piétons : marquage au sol de circulation? panneaux code de la route visible et en bon état? exempt de matériél encombrant?  largeur >à 80 cm, circulation pratiquable");
insert into questions(label) values("Circulation véhicules:panneaux code de la route visible et en bon état? bordures de trottoir signalisés et en bon état? sol plan, exempt de matériel encombrant ?");

--stockage bouteilles vides ou pleines
insert into questions(label) values("Hauteur d'empilage bouteille? allées de circulation d'accès libre de matériaux ou d'objets étrangers?  stockage bouteilles en position debout et retenues de façon à ne pas pouvoir tomber");

--aire de depotage
insert into questions(label) values("Accès libre en tout point; sol plane");
insert into questions(label) values("Si opération de dépotage: état du camion citerne ? Conformité des équipements de contrôles qualité et quantité ? EPIs du chauffeur ?");
insert into questions(label) values("Dispositif DCMT3 ?Détecteur de fuite? DCI, couronne d'arrosage? : opérationnel");
insert into questions(label) values("Flexibles de dépotage: en état - valides - bouchonnés si, non utilisés?");

--pomperie incendie 
insert into questions(label) values("Local pomperie incendie: identifié et présence de casque anti-bruit?");
insert into questions(label) values("Cuve , nourrice de carburant:pleines et indicateur de niveau opérationnel - absence de fuite HC?");
insert into questions(label) values("Motopompe :en position de démarrage automatique ou conforme à l'instruction du dépôt");
insert into questions(label) values("Electropompe : en position de démarrage automatique ou conforme à l'instruction du dépôt");
insert into questions(label) values("Arrêt d'urgence: en bon état, disposé judicieusement et identifiable (couleur, plaque) ?");

-- defense incendie
insert into questions(label) values("Pleine et indicateur de niveau opérationnel? Pas de fuite et  corrosion notable du bac?");
insert into questions(label) values("Motopompe appoint d'eau de la citerne: réservoir de carburant plein et réserve?instruction d'usage affiché?Niveau d'huile ?");
insert into questions(label) values("Flexibles incendie, canons: en bon état, disposés judicieusement et identifiables (couleur, ecriteaux) ");
insert into questions(label) values(" Vêtement anti feu : en bon état, rangés et disposés judicieusement et identifiables (ecriteaux et inventaire)?");

-- hall d'emplissage
insert into questions(label) values("Propreté d'ensemble :propre, en ordre et salubre, bon drainage de l'eau?");
insert into questions(label) values("Zone ATEX - signalée (panneaux et/ou marquage au sol)");
insert into questions(label) values("Absence de fuite : au niveau du hall, dans la rampe de vidange, bouteille en vidange libre");
insert into questions(label) values(" Equipement et machine: équipements fonctionnent (correctement), propres et non corrodés");
insert into questions(label) values("Trousse de 1ers secours : liste du contenu, vérification périodique?");

--materiel roulant
insert into questions(label) values("Transpalette: en état? opérationnel?");
insert into questions(label) values("Fiche d'inspection avant utilisation des transpalettes?");

--stockage
insert into questions(label) values("Cigare identifié, orifices obturés ( mano, purge, soupape de décompression…), capacité indiquée?capteurs de gaz en état? ");
insert into questions(label) values("Etat des passerelles, escaliers, rambardes… ?");
insert into questions(label) values("Zone ATEX - signalée (panneaux et/ou marquage au sol) ");

--arret d'urgence
insert into questions(label) values("Le dépôt dispose-t-il d'arrêt d'urgence ? Est-t-il signalé ? Est-t-il accessible ? Est-t-il operationnel ?");

-- electricite
insert into questions(label) values("Les coffrets électriques sont-ils fermés ? Identifiés par un pictogramme danger ? ");
insert into questions(label) values("Les cablages électriques sont-t-ils protegés par des chemins ou goulottes ? Absence de cables nus ni de connexion apparente ? ");

-- documents
insert into questions(label) values("Le dépôt dispose-t-il d'un registre visiteur ? d'un registre d'anomalies/dysfonctionnement ? D'un classeur de maintenance ? Sont-t-ils tenus à jour ?");

-- epi
insert into questions(label) values("Respect port des EPI? Personnel? Tiers?");

-- si travaux en cours
insert into questions(label) values("Port effectif des Epi-s ?Les EPIs sont-ils en bon état?");
insert into questions(label) values("Existance permis de travail et autres permis associés signés par le site et l'entreprise? ");
insert into questions(label) values("Application processus de consignation /  déconsignation?");

--local groupe electrogene
insert into questions(label) values("Propreté d'ensemble: Absence de papier et de chiffon au sol - Armoire identifiée et fermée - Plans et documents rangés");
insert into questions(label) values("Signaletique de démarrage automatique - Protection auditive disponible - Accès reglementé");
insert into questions(label) values("Groupe : en position de démarrage automatique ou dans la position définie selon instruction dépôt - capotage des batteries en place - absence de fuite(s) (huile moteur, eau)");

-- dci 
insert into questions(label) values("Bac à eau : Pleine et indicateur de niveau opérationnel - absence de fuite(s) - pas de corrosion notable du bac");
insert into questions(label) values("Manifold, vannes : Pas de fuite - graissé - Opérationnel");
insert into questions(label) values("Défense incendie (boîtes à mousse, couronne de refroidissement,,,,)?");
insert into questions(label) values("Détecteur gaz? Détecteur fuite? En bon état?");
insert into questions(label) values("Explosimètre ?  Balise de chantier? En bon état? Opérationnel?");

--causerie securite
-- causerie securite anle depot aviation iany io 


----------------------------------  HSE Chantier  -------------------------------------
-- documents de chantier
insert into questions(label) values("Plan de prevention / ADR établis et disponibles");
insert into questions(label) values("Accusé de reception signé par tout le personnel présent");
insert into questions(label) values("Autorisation de travail/permis divers affiché et bien renseigné");
insert into questions(label) values("PV ouverture de chantier / Points sécurité disponibles");
insert into questions(label) values("Registre des évènements disponible et utilisé");
insert into questions(label) values("Copie aptitude médicale du personnel présent disponible");
insert into questions(label) values("Présence d'une personne formé sur extincteur et secourisme");
insert into questions(label) values("Copie habilitations divers disponibles (élec, soudeur, etc.)");
insert into questions(label) values("FDS des produits manipulés disponibles");
insert into questions(label) values("Contact d'urgence disponible et testé annuellement");
insert into questions(label) values("Plan d'urgence disponible");

-- installations de chantier
insert into questions(label) values("Baraque de chantier en bon état et bien disposé");
insert into questions(label) values("Outillages et équipements divers en bon état et adaptés");
insert into questions(label) values("Balisage de la zone de travail signalé (Panneau oblig/interd)");
insert into questions(label) values("Outillages et équipements divers en bon état et adaptés");
insert into questions(label) values("Point de ralliement identifié et signalé");
insert into questions(label) values("Moyen d'alerte disponible (sifflet, sirène, etc.)");
insert into questions(label) values("Autre(s)");

--aire de circulation et de travail
insert into questions(label) values("Propre");
insert into questions(label) values("Exempt d'obstacle");
insert into questions(label) values("Exempt d'objet trainant");

-- equipement de protection individuelle
insert into questions(label) values("Port de vêtement de travail en coton et manche longue");
insert into questions(label) values("Port de casque de protection (Avec jugulaire si W en hauteur)");
insert into questions(label) values("Port de chaussures de sécurité");
insert into questions(label) values("Port de gants de protection adaptés aux opérations éffectuées");
insert into questions(label) values("Port de lunettes de protection");
insert into questions(label) values("Port de protection auditive*");
insert into questions(label) values("Port de masque filtrant*");
insert into questions(label) values("Port de masque respiratoire*");
insert into questions(label) values("Port de harnais et longe antichute (En bon état et valide)*");


--equipement de protection collective
insert into questions(label) values("Echafaudage en bon état, contrôlé et bien placé (Panneau HS ou ES)");
insert into questions(label) values("Escabeau en bon état , contrôlé et maintenu par un opérateur");
insert into questions(label) values("Nacelle en bon état  et contrôlé");

-- respect de consignes
insert into questions(label) values("Respect des consignes de sécurité ");
insert into questions(label) values("Respect des 12 Règles d'Or");

--engins de chantier
insert into questions(label) values("Documents de l'engin valide (Assurance, visite technique, etc.)");
insert into questions(label) values("Documents du conducteur valide (Permis, habilitation, etc.)");
insert into questions(label) values("Présence de trousse de secours (Signalé, contenu complet et valide)");
insert into questions(label) values("Présence de cales adaptés et en bon état");
insert into questions(label) values("Présence d'extincteur valide et en bon état (2 ABC 09kg / 1 de 02kg)");
insert into questions(label) values("Présence d'AU ou coupe courant");
insert into questions(label) values("Accessoires en bon état (Manille, eligngue, etc.)");
insert into questions(label) values("Absence de fuite");

-- environment
insert into questions(label) values("Propreté");
insert into questions(label) values("Identification des déchets");
insert into questions(label) values("Etiquetage des produits / substances chimiques");

-- moyen de lutte contre incendie
insert into questions(label) values("Extincteurs disponibles, valides et suffisants (ABC 09kg à minima)");

--moyen de premiers secours
insert into questions(label) values("Trousse de secours disponible, identifiée et contenu complet");

--stop card
insert into questions(label) values("Disponible");
insert into questions(label) values("Utilisé(s)");


----------------------------------  STL bouteilles  -------------------------------------
-- etat general
insert into questions(label) values("Contrôle technique du camion");
insert into questions(label) values("Visibilité");
insert into questions(label) values("Ceintures de sécurité trois points");
insert into questions(label) values("Eclairage");
insert into questions(label) values("Extincteurs");
insert into questions(label) values("Roues/jantes");
insert into questions(label) values("Pneus");
insert into questions(label) values("Scellette et pivot d'accrochage (concerne semi remorque et attelage de remorque)");
insert into questions(label) values("Test du frein de parking ");
insert into questions(label) values("Signalisation et placardage ");
insert into questions(label) values("Etat général du cablage électrique");
insert into questions(label) values("Numéro de téléphone d'urgence ");


--equipement du vehicule
insert into questions(label) values("Etat de la fermeture de la porte arrière");
insert into questions(label) values("Etat du plancher ");
insert into questions(label) values("Solidité des montants latéraux ou état général de la cage ");
insert into questions(label) values("Sangles d'arrimage ou barres de calage");
insert into questions(label) values("Coupe batterie (Cabine ou extérieur)");
insert into questions(label) values("Cales de roues");
insert into questions(label) values("2 signaux d'avertissement (triangle, cones)");
insert into questions(label) values("Permis de conduire et attestation");
insert into questions(label) values("Les EPI du conducteur");
insert into questions(label) values("Prise de terre");
----------------------------------  STL camion opere  -------------------------------------
-- control communs [ miampy anle etat general ao amn stl bouteilles ]
insert into questions(label) values("Etat des soudures et absence de fissures");
insert into questions(label) values("Etat général du cablage électrique");

--hydrocarbures , lubrifiants vrac, fuel lourd
insert into questions(label) values("Echelle , rambarde et passerelle supérieure");
insert into questions(label) values("Fuites");
insert into questions(label) values("Clapets de fond");
insert into questions(label) values("Flexibles");

-- semi et porteur gaz vrac
insert into questions(label) values("Jauge ou système de contrôle de niveau");
insert into questions(label) values("Documentation d'agrément et date d'épreuve");
insert into questions(label) values("Vérification que le camion est bien sous pression");
insert into questions(label) values("Obturateurs");


----------------------------------  controlle de camion -------------------------------------
--controle du camion citerne
--aptitude chauffeurs et papiers vehicules
insert into questions(label) values("Validité premis de conduire  / PATH");
insert into questions(label) values("Validité visite technique / assurance ");
insert into questions(label) values("Visite médicale");
insert into questions(label) values("Documents de bords Livret Blackspot, manuel chauffeur /PATH , Carnet d'entretien,....");
insert into questions(label) values("  Documents d’urgence : Plan et contact urgence, FDS ou fiche de sécurité,…");
-- Camion citerne
insert into questions(label) values("Visibilité (pare brise, rétroviseur,...)");
insert into questions(label) values("Ceinture de sécurité chauffeur et passager présents et conformes");
insert into questions(label) values("Feux de position, route et croisement opérationnel");
insert into questions(label) values("Feux de signalisation opérationels");
insert into questions(label) values("Coupe batterie conforme et opérationnel");
insert into questions(label) values("Plot de mise à la terre présent et conforme");
insert into questions(label) values("Pare flamme conforme");
insert into questions(label) values("Etat des pneus y/c roue(s) de secours");
insert into questions(label) values("Redémarrage / fonctionnement freinage");
insert into questions(label) values("Etiquettes ADR présent et en bon état");
insert into questions(label) values("Extincteurs présents, en bon état et valides (2 ABC 09kg citerne et 1 CO2 cabine)");
insert into questions(label) values("Existence triangle de signalisation, rubans de balisage ou cônes");
insert into questions(label) values("Cales en bon état et conformes");
insert into questions(label) values("Contenu trousse de secours complet et valide");
insert into questions(label) values("Absence de câbles nus et apparents");
insert into questions(label) values("Absence de branchement frauduleuse");
insert into questions(label) values("Cerclages trous d’hommes soudés");
insert into questions(label) values("Conformité scellés trou d’homme");
insert into questions(label) values("Propreté/vacuité compartiment");
insert into questions(label) values("Conformité scellés des vannes");
insert into questions(label) values("Absence de fuite");
insert into questions(label) values("Flexibles valides et en bon état");

-- controle application des consignes .. 
-- par le receptionnaire
insert into questions(label) values("Balisage de zone par usage de plot avec chainette,");
insert into questions(label) values("Arrêt de distribution dans un rayon de 5m,");
insert into questions(label) values("Pas de feux nus à proximité,");
insert into questions(label) values("Présence 2 extincteurs ABC 09kg dans la zone,");

--par les chauffeurs du camion citerne
insert into questions(label) values("Camion en position de départ (Marche avant)");
insert into questions(label) values("Vitres portières fermés,");
insert into questions(label) values("Appareil électrique CC éteint.");
insert into questions(label) values("Téléphone éteint");
insert into questions(label) values("Mise à la terre en place,");
insert into questions(label) values("Pas de feux nus à proximité,");
insert into questions(label) values("Frein de parc bien engagé,");
insert into questions(label) values("Coupe batterie enclenché,");
insert into questions(label) values("Pose de triangle de signalisation, ");
insert into questions(label) values("Cales apposées sur les roues,");
insert into questions(label) values("Seau de récupération égoutture en alu et en place,");
insert into questions(label) values("Branchement flexible côté camion avant connexion côté bouche (PB) – flexible dépôt (Autres)");

--control sur route
insert into questions(label) values("Respect distance de sécurité");
insert into questions(label) values("Position correcte par rapport à la chaussée");
insert into questions(label) values("Allure adaptée à la circonstance");
insert into questions(label) values("Signalisation lors des changements de direction");
insert into questions(label) values("Pas de téléphone au volant ni de passager public");

-- ************************************** `responses`

DROP TABLE IF EXISTS `responses`;
CREATE TABLE IF NOT EXISTS `responses`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `label` varchar(45) NOT NULL 
);

insert into responses(id,label) values(1,"oui");
insert into responses(id,label) values(2,"non");
insert into responses(id,label) values(3,"na");
insert into responses(id,label) values(4,"so");
insert into responses(id,label) values(5,"c");
insert into responses(id,label) values(6,"nc");
insert into responses(id,label) values(7,"contrôle");

--**************************************`item_response`
DROP TABLE IF EXISTS `item_response`;
CREATE TABLE `item_response`
(
 `response_id` integer NOT NULL ,
 `item_id`     integer NOT NULL ,

FOREIGN KEY (`response_id`) REFERENCES `responses` (`id`),
FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
);


--network
insert into item_response values(1,1);
insert into item_response values(2,1);
insert into item_response values(3,1);
---Depot

insert into item_response values(1,2);
insert into item_response values(2,2);
insert into item_response values(3,2);
---gpl
insert into item_response values(1,3);
insert into item_response values(2,3);
insert into item_response values(4,3);

--chantier 
insert into item_response values(5,4);
insert into item_response values(6,4);
insert into item_response values(3,4);

--bottles
insert into item_response values(7,5);

--operated truck
insert into item_response values(7,6);

---truck

insert into item_response values(1,7);
insert into item_response values(2,7);
insert into item_response values(3,7);

-- ************************************** visit_responses
DROP TABLE IF EXISTS `visit_responses`;
CREATE TABLE IF NOT EXISTS `visit_responses`
(
 `item_id`              integer NOT NULL ,
 `response_id`          integer NOT NULL ,
 `question_category_id` integer NOT NULL ,
 `observations`         text NULL ,
 `visit_id`             INTEGER NOT NULL ,


FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
FOREIGN KEY (`response_id`) REFERENCES `responses` (`id`),
FOREIGN KEY (`question_category_id`) REFERENCES `question_category_subcategory` (`id`)
);

-- ************************************** `blocking_points`
DROP TABLE IF EXISTS `blocking_points`;
CREATE TABLE IF NOT EXISTS `blocking_points`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `label` varchar(10) UNIQUE NOT NULL ,
 `value` varchar(250) NOT NULL 
);
insert into blocking_points(label,value) values('O',"Ce point est toujours bloquant");
insert into blocking_points(label,value) values('N*',"Ce point est bloquant dans le cas où la protection des feux est fortement endommagée.");
insert into blocking_points(label,value) values('N**',"Ce point est bloquant uniquement pour les camions devant etre équipés d'un coupe batterie (obligation en fonction de la nature des produits transportés et des conditions de chargement).");
insert into blocking_points(label,value) values('N***'," Ce point est bloquant uniquement si la citerne n'est pas correctement gazée.");

-- ************************************** `question_category_subcategory

DROP TABLE IF EXISTS `question_category_subcategory`;

CREATE TABLE `question_category_subcategory`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `question_id`    integer NOT NULL ,
 `category_id`    integer NOT NULL ,
 `subcategory_id` integer NULL ,
 `item_id`        integer NOT NULL , 
 `blocking_point` varchar(10) NULL,
FOREIGN KEY  (`question_id`) REFERENCES `questions` (`id`),
FOREIGN KEY  (`category_id`) REFERENCES `categories` (`id`),
FOREIGN KEY  (`subcategory_id`) REFERENCES `subcategories` (`id`),
FOREIGN KEY  (`item_id`) REFERENCES `items` (`id`)
);
-------------------------NETWORK--------------------
--hygiene
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,1,1,1);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,1,2,2);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,1,3,3);
--securite installations
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,2,4,4);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,2,5,5);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,2,6,6);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,2,7,7);

insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,2,8,8);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,2,8,9);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,2,9,10);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,2,10,11);

insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,2,11,12);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,2,12,13);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,2,13,14);
--environment
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,3,14,15);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,3,14,16);
--qualite 
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,4,15,17);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,4,15,18);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,4,15,19);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,4,15,20);
--causerie securite
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,5,null,21);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,5,null,22);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,5,null,23);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,5,null,24);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,5,null,25);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(1,5,null,26);

-------------------------DEPOSIT--------------------
--hygiene
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,1,1,27);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,1,2,28);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,1,3,29);
--securite installations fixes et materiels roulants
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,16,30);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,4,31);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,5,32);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,17,33);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,18,34);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,9,35);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,10,36);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,19,37);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,20,38);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,21,39);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,2,40);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,12,41);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,6,13,42);
-- environment
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,3,23,43);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,3,23,44);
--qualite
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,4,24,45);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,4,24,46);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,4,24,47);
-- causerie securite
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,5,null,21);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,5,null,22);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,5,null,23);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,5,null,24);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,5,null,25);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,5,null,48);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(2,5,null,49);

-------------------------------- GPL -------------------------------------
--acces
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,7,null,50);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,7,null,51);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,7,null,52);
--extincteurs
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,8,null,53);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,9,null,54);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,10,null,55);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,10,null,56);
-- stockage bouteilles vides ou pleines
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,11,null,57);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,12,null,58);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,12,10,59);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,12,null,60);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,12,null,61);
-- pomperie incendie 
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,13,null,62);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,13,null,63);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,13,null,64);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,13,null,65);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,13,null,66);
--defense incendie
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,14,null,67);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,14,null,68);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,14,null,69);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,14,null,70);
--hall d'emplissage
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,15,null,71);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,15,null,72);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,15,null,73);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,15,null,74);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,15,null,75);
--materiel roulant
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,16,null,76);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,16,null,77);
--stockage
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,17,null,78);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,17,null,79);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,17,null,80);
--arret d'urgence
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,18,null,81);
--electricite
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,19,null,82);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,19,null,83);
--documents
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,20,null,84);
--EPI
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,21,null,85);
-- si travaux en cours
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,22,null,86);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,22,null,87);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,22,null,88);
-- local groupe electrogene
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,23,null,89);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,23,null,90);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,23,null,91);
-- DCI 
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,24,null,92);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,24,null,93);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,24,null,94);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,24,null,95);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,24,null,96);
-- causerie securite
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,5,null,21);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,5,null,22);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,5,null,23);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,5,null,24);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,5,null,25);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,5,null,48);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(3,5,null,49);
--------------- HSE Chantier-------------------
-- documents chantier
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,25,null,97);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,25,null,98);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,25,null,99);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,25,null,100);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,25,null,101);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,25,null,102);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,25,null,103);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,25,null,104);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,25,null,105);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,25,null,106);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,25,null,107);

--installations de chantier
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,26,null,108);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,26,null,109);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,26,null,110);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,26,null,111);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,26,null,112);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,26,null,113);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,26,null,114);

--aire de circulation et de travail
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,27,null,115);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,27,null,116);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,27,null,117);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,27,null,114);

--equipement de protection individuel
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,28,null,118);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,28,null,119);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,28,null,120);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,28,null,121);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,28,null,122);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,28,null,123);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,28,null,124);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,28,null,125);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,28,null,126);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,28,null,114);

--equipement de protection collective
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,29,null,127);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,29,null,128);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,29,null,129);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,29,null,114);

-- respect des consignes
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,30,null,130);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,30,null,131);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,30,null,114);
--engins de chantier
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,31,null,132);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,31,null,133);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,31,null,134);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,31,null,135);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,31,null,136);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,31,null,137);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,31,null,138);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,31,null,139);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,31,null,114);
--environment
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,3,null,140);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,3,null,141);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,3,null,142);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,3,null,114);
-- moyens de lutte contre incendie 
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,32,null,143);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,32,null,114);
-- moyen de premiers secours
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,33,null,144);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,33,null,114);
--stop card
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,34,null,145);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(4,32,null,146);
----------------------------- BOTTLES ---------------------------------
--etat general 
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,147);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,148);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,149);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,150);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,151);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,152);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,153);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,154);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,155);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,156);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,157);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,35,null,158);
-- equipement du vehicule
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,36,null,159);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,36,null,160);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,36,null,161);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,36,null,162);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,36,null,163);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,36,null,164);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,36,null,165);
-- chauffeur
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,37,null,166);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(5,37,null,167);

----------------- STL OPERATED TRUCK ----------------
-- control commmun
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,147);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,166);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,148);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,149);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,150);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,163);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,167);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,152);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,153);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,154);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,156);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,165);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,168);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,158);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,157);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,164);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,38,null,155);

-- hydrocarbures , lubrifiants .... 

insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,39,null,171);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,39,null,172);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,39,null,173);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,39,null,174);

-- semi et porteur de gaz vrac 
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,40,null,175);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,40,null,176);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,40,null,177);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(6,40,null,178);


--------------------- TRUCK CONTROL ----------------------
-- aptitudes chauffeurs ........
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,25,179);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,25,180);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,25,181);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,25,182);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,25,183);

--camion citerne 
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,184);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,185);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,186);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,187);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,188);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,189);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,190);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,191);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,192);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,193);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,194);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,195);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,196);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,197);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,198);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,199);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,200);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,201);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,202);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,203);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,204);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,41,26,205);

--controle application des consignes de securite
-- par le receptionnaire 
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,206);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,207);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,208);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,209);

--par les chauffeurs du camion citerne
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,210);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,21);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,212);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,213);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,214);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,215);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,216);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,217);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,218);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,219);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,220);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,42,27,221);

-- controle sur route
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,43,null,222);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,43,null,223);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,43,null,224);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,43,null,225);
insert into question_category_subcategory(item_id,category_id,subcategory_id,question_id) values(7,43,null,226);

-- ************************************** `network_visit`
CREATE TABLE `network_visit`
(
 `id`    integer NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `visit_date`     date NOT NULL ,
 `visitor_id`     integer NOT NULL ,
 `gas_station_id` integer NOT NULL ,
 state tinyint,
FOREIGN KEY (`visitor_id`) REFERENCES `codir_users` (`id`),
FOREIGN KEY (`gas_station_id`) REFERENCES `codir_locals` (`id`)
);


-- ************************************** `data_for_sync`
CREATE TABLE `data_for_sync`
(
 `table_name` varchar(100) NOT NULL ,
 `is_synced`  tinyint NULL ,
 `row_id`     integer NOT NULL 
);