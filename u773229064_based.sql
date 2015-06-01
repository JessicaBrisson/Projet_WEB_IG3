
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 01 Juin 2015 à 21:03
-- Version du serveur: 5.1.67
-- Version de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `u773229064_based`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `Id_Catego` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nom_Catego` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_Catego`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`Id_Catego`, `Nom_Catego`) VALUES
(1, 'Musée'),
(2, 'Rue & Place'),
(3, 'Batiment'),
(4, 'Monument'),
(5, 'Parc'),
(6, 'Zoo'),
(7, 'Théâtre & Opéra'),
(8, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `continent`
--

CREATE TABLE IF NOT EXISTS `continent` (
  `Id_Continent` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Nom_Continent` varchar(30) NOT NULL,
  `Description_Continent` text,
  PRIMARY KEY (`Id_Continent`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `continent`
--

INSERT INTO `continent` (`Id_Continent`, `Nom_Continent`, `Description_Continent`) VALUES
(1, 'Amérique du Nord', 'Cette partie de Amérique offre une richesse de culture. Le territoire s''étend du Canada au Panama.  Elle oppose des sociétés modernes à d''autre plus rurales. Mais tous ses pays offrent de nombreuses visites pour découvrir l''histoire, se divertir ou s''ouvrir à de nouvelle culture.'),
(2, 'Amérique du sud', 'Ce sous continent offre au visiteur un dépaysement avec une culture totalement différente des occidentaux. Il abrite la forêt de l''Amazonie et d''ici deux ans, il attirera toute les caméras avec les nombreux événements sportif qui doivent se dérouler au Brézil.'),
(3, 'Europe', 'L''Europe est parfois appellé "Vieux continent" pour son histoire à travers les siècles. Sur le plan culturel, l''Europe a reçu une multiplicité d''influences au cours des âges, et comprend de nombreux pays qui possèdent à la fois un héritage commun, des différences linguistiques, religieuses et historiques, et des apports récents venus depuis la mondialisation. De belle choses sont à découvrir sur ces terres.'),
(4, 'Afrique', 'La culture africaine n''est pas un bloc monolithique, il existe plusieurs cultures africaines. La culture africaine subsaharienne traditionnelle est basée sur la transmission orale, souvent accompagnée de musique.'),
(5, 'Asie', 'L''Asie est le plus grand continent mais aussi le plus peuplé. Sur ses terres ont découvre à la fois de merveille naturelle avec le plus haut sommet du monde mais aussi des temples anciens mélangé à des architectures plus modernes portées par les pays en développement.'),
(6, 'Océanie', 'L''Océanie est une vaste région regroupant des territoires situés dans l''océan Pacifique. Elle inclut l''Australie, la Nouvelle-Zélande et la Nouvelle-Guinée et d''autres îles et archipels. Avec cette diversité de pays, les monuments et les cultures à découvrir ne manque pas. ');

-- --------------------------------------------------------

--
-- Structure de la table `mise_a_jour_bd`
--

CREATE TABLE IF NOT EXISTS `mise_a_jour_bd` (
  `Derniere_MAJ` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `mise_a_jour_bd`
--

INSERT INTO `mise_a_jour_bd` (`Derniere_MAJ`) VALUES
('2015-05-31');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE IF NOT EXISTS `pays` (
  `Id_Pays` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nom_Pays` varchar(50) NOT NULL,
  `fk_Continent` int(11) NOT NULL,
  PRIMARY KEY (`Id_Pays`),
  KEY `fk_continent` (`fk_Continent`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`Id_Pays`, `Nom_Pays`, `fk_Continent`) VALUES
(1, 'France', 3),
(2, 'Etats-Unis', 1),
(3, 'Allemagne', 3),
(4, 'Australie', 6),
(5, 'Chine', 5),
(6, 'Canada', 1),
(7, 'Mexique', 1),
(8, 'Pays-Bas', 3),
(9, 'Maroc', 4),
(10, 'Autriche', 3),
(11, 'Royaume-Uni', 3);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE IF NOT EXISTS `ville` (
  `Id_Ville` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nom_Ville` varchar(50) NOT NULL,
  `fk_pays` int(11) NOT NULL,
  PRIMARY KEY (`Id_Ville`),
  KEY `fk_pays` (`fk_pays`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`Id_Ville`, `Nom_Ville`, `fk_pays`) VALUES
(1, 'Paris', 1),
(2, 'Montpellier', 1),
(3, 'New York', 2),
(4, 'Berlin', 3),
(5, 'Munich', 3),
(6, 'Melbourne', 4),
(7, 'Pekin', 5),
(8, 'Lyon', 1),
(9, 'Bordeaux', 1),
(10, 'Londres', 11),
(11, 'Quebec', 12),
(12, 'Niagara', 12),
(13, 'San Antonio', 2),
(14, 'Orange', 1),
(15, 'Mexico', 7),
(16, 'Casablanca', 9);

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

CREATE TABLE IF NOT EXISTS `visite` (
  `Id_Visite` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nom_Visite` varchar(200) NOT NULL,
  `Descriptif` text,
  `Photo` varchar(300) DEFAULT NULL,
  `fk_Catego` int(10) unsigned NOT NULL,
  `fk_Ville` int(10) unsigned NOT NULL,
  `Mise_A_Jour` date NOT NULL,
  PRIMARY KEY (`Id_Visite`),
  KEY `fk_Catego` (`fk_Catego`),
  KEY `fk_ville` (`fk_Ville`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Contenu de la table `visite`
--

INSERT INTO `visite` (`Id_Visite`, `Nom_Visite`, `Descriptif`, `Photo`, `fk_Catego`, `fk_Ville`, `Mise_A_Jour`) VALUES
(1, 'Musée du Louvres', NULL, 'http://upload.wikimedia.org/wikipedia/commons/5/5b/Le_mus%C3%A9e_du_Louvre_(4750261198).jpg', 1, 1, '2015-05-15'),
(2, 'Times square', NULL, 'http://upload.wikimedia.org/wikipedia/commons/c/c0/1_times_square_night_2013.jpg', 2, 3, '2015-05-16'),
(3, 'Musée Fabre', NULL, NULL, 1, 2, '2015-05-28'),
(4, 'Musée de l''histoire de Montpellier', 'Ce musée offre une vue d''ensemble de l''histoire de la ville. Situé sous l''actuelle place Jean Jaurès, dans les soubassements de l''ancienne église de Notre-Dame des Tables, ce musée retrace l''histoire de Montpellier (Xe-XVIe siècles)  à travers celle de l''église en utilisant des animations visuelles et sonores. Un audio guide vous est fourni dès le début de la visite. ', NULL, 1, 2, '2015-05-16'),
(5, 'Musée du Vieux Montpellier', 'Installé dans l’Hôtel de Varennes, ce musée présente des collections d''objets très divers liés à l''histoire de Montpellier du Moyen Age au 20ème siècle. Il est situé place Pétrarque, dans un appartement d''un ancien hôtel particulier, décoré de boiseries du 18ème, de plafonds à la française, gypseries et bars au sol.', NULL, 1, 2, '2015-05-16'),
(6, 'Musée Atger', 'Il est composé d''une très riche collection de dessins des écoles flamandes, italiennes, hollandaises, allemandes et françaises, patiemment rassemblée par l''amateur d''art averti Xavier Atger qui l''a léguée au siècle dernier à la Faculté de Médecine. La bibliothèque de cette faculté possède un nombre important de manuscrits précieux du VIIIe au XIXe siècle. ', NULL, 1, 2, '2015-05-16'),
(7, 'Pharmacie et Chapelle de la Miséricorde', 'L''ensemble historique de la Miséricorde recèle la dernière apothicairerie montpelliéraine encore en place.', NULL, 1, 2, '2015-05-16'),
(8, 'Musée de l''Infanterie', 'Le musée de l''Infanterie présente l''histoire des troupes à pied de 1479 à nos jours au travers de plus de 15000 objets. Un espace est consacré à l''armée d''Afrique. Il comporte également un centre de documentation et d''information.', NULL, 1, 2, '2015-05-16'),
(9, 'Musée des Moulages', NULL, NULL, 1, 2, '2015-05-16'),
(10, 'Musée Languedocien', 'Musée d''Art, d''Histoire et d''Archéologie de Montpellier, le Musée Languedocien bénéficie du label Musée de France pour la richesse et la variété de ses collections qui s''étendent de la préhistoire au XIXème siècle et comptent nombre de chefs d''œuvre.', NULL, 1, 2, '2015-05-16'),
(11, 'Place de la comédie', 'Une architecture remarquable à admirer sur les batiments qui la orne. ', NULL, 2, 2, '2015-05-16'),
(12, 'Empire State Building', 'Panorama sur l''ensemble de new york en étant au 86e étage de la tour.', NULL, 3, 3, '2015-05-16'),
(13, 'Musée américain d''Histoire naturelle', NULL, NULL, 1, 3, '2015-05-16'),
(14, 'Le Metropolitan Museum of Art', 'Vous découvrirez ce que la créativité humaine a inventé de plus beau. Avec des collections retraçant plus de 5 000 ans de culture, allant de la préhistoire à nos jours, le Metropolitan offre un voyage merveilleux à travers les arts.', NULL, 1, 3, '2015-05-16'),
(15, 'The Cloisters', 'Un musée consacré à l''art et à l''architecture de l''Europe médiévale.', NULL, 1, 3, '2015-05-16'),
(16, 'Top of the Rock', 'Immeuble art déco qui offre une vue panoramique sur New York', NULL, 3, 3, '2015-05-16'),
(17, 'Musée Guggenheim', 'Le chef-d''œuvre d''architecture moderne abrite l''une des plus belles collections mondiales d''art du 20e siècle. ', NULL, 1, 3, '2015-05-16'),
(18, 'Statue de la Liberté', NULL, NULL, 4, 3, '2015-05-16'),
(19, 'Ellis Island', 'Ile chargée d''histoire qui offre au visiteur un musée sur l''immigration', NULL, 1, 3, '2015-05-16'),
(20, 'Musée du 11 septembre', 'Dans le musée, découvrez leurs photos et lisez l''histoire des pertes et de la reconstruction.', NULL, 1, 3, '2015-05-16'),
(21, 'Mémorial du 11 septembre', 'Le Mémorial du 11 septembre rendent hommage aux victimes des attaques et préservent l''histoire des événements. Rendez hommage aux victimes en lisant leurs noms inscrits autour des bassins de réflexion du Mémorial.', NULL, 4, 3, '2015-05-16'),
(22, 'Intrepid Sea, Air & Space Museum', '', NULL, 1, 3, '2015-05-26'),
(23, 'Central Park', 'Espace vert au nord de Manhattan.', NULL, 5, 3, '2015-05-16'),
(24, 'Zoo municipal', 'Zoo gratuit avec un grand nombre d''animaux à découvrir.', NULL, 6, 2, '2015-05-16'),
(25, 'Arc de Triomphe', NULL, 'http://upload.wikimedia.org/wikipedia/commons/8/8d/Paris_July_2011-30.jpg', 4, 1, '2015-05-17'),
(26, 'Jardin des tuileries', 'Espace vert joignant le Louvre aux mythique Champs-Elysées.', NULL, 5, 1, '2015-05-17'),
(27, 'Musée Grévin', 'Statues de cire de personnages célèbres.', 'http://upload.wikimedia.org/wikipedia/commons/f/f2/Mus%C3%A9e_Gr%C3%A9vin_(2).JPG', 1, 1, '2015-05-17'),
(28, 'Mémorial de la Shoah ', 'Lieu de mémoire du génocide des Juifs de France. Il réunit dans un même lieu : un musée consacré à l''histoire juive durant la Seconde Guerre mondiale dont l''axe central est l''enseignement de la Shoah.', NULL, 1, 1, '2015-05-17'),
(29, 'Tiananmen', NULL, NULL, 2, 7, '2015-05-22'),
(30, 'Le musée national d''histoire', 'L''histoire de la Chine vous sera contée de la Préhistoire jusqu''au début du XXe siècle. Plus de 9000 objets sont exposés par thématiques.', NULL, 1, 7, '2015-05-22'),
(31, 'Musée de la révolution chinoise', 'L''histoire du parti communiste chinois est racontée dans ce musée afin d''expliquer les étapes de son accession au pouvoir. ', NULL, 1, 7, '2015-05-22'),
(32, 'Tour Montparnasse ', 'Au pied de la gare Montparnasse, au dernière étage de la tour un panorama à 360° sur ensemble de la ville de Paris', NULL, 3, 1, '2015-05-22'),
(33, 'Australian Centre for the Moving Image', 'Ce sont les images en mouvement qui sont mis à la l''honneur : cinéma, télévision, jeux vidéo et culture numérique.', NULL, 1, 6, '2015-05-22'),
(34, 'Ian Potter Centre', 'Premier grand musée d’art indigène en Australie.', NULL, 1, 6, '2015-05-22'),
(35, 'Jardins de Carlton', NULL, NULL, 5, 6, '2015-05-17'),
(36, 'Melbourne Museum ', 'Les collections du Melbourne Museum sont consacrées à la vie dans le Victoria à travers son histoire, son environnement naturel et sa culture.', NULL, 1, 6, '2015-05-17'),
(37, 'Australian Centre for Contemporary Art', 'L’ Australian Centre for Contemporary Art est une des galeries d’art contemporain majeure à Melbourne, présentant les œuvres d’artistes du moment australiens ou étrangers avec des valeurs innovantes parfois même décalées. Le bâtiment qui abrite cette galerie est lui-même spectaculaire.', NULL, 1, 6, '2015-05-26'),
(38, 'Alliierten-Museum ', 'Situé au centre de l’ancien secteur américain de Berlin-Zehlendorf, le Musée des Alliés présente l’histoire des puissances occidentales à Berlin durant la Guerre froide, de 1945 jusqu’en 1989.', NULL, 1, 4, '2015-05-26'),
(39, 'Alte Nationalgalerie ', 'La Alte Nationalgalerie abrite une importante collection de peinture allemande du 19ème siècle. On y trouve des chefs-d’œuvre de Caspar David Friedrich, Adolph Menzel, Edouard Manet et de l''impressionnisme français.', NULL, 1, 4, '2015-05-26'),
(40, 'Panthéon', 'Ce monument abrite dans son cœur le dépouille de nombreux Hommes illustres ayant fait acte de bravoure pour la Frnce. ', 'http://upload.wikimedia.org/wikipedia/commons/5/58/Panth%C3%A9on,_Paris_25_March_2012.jpg', 4, 1, '2015-05-26'),
(41, 'Les Champs Élysées', 'Avenue très célèbre qui rejoind la concorde et l''arc de triomphe.', NULL, 2, 1, '2015-05-26'),
(42, 'Tour Eiffel', 'Appelé par certain "Dame de fer", ce monument est un souvenir du de l''exposition universelle de 1889', NULL, 4, 1, '2015-05-26'),
(43, 'Quai branly', 'Musée parisien reconnu pour sa collection remarquable sur les tribus ethniques.', NULL, 1, 1, '2015-05-26'),
(44, 'Montmartre ', 'Quartier qui englobe différente ruelle de la butte de Montmartre', NULL, 2, 1, '2015-05-26'),
(45, 'Sacré Cœur ', 'Point culminant de la ville de Paris. Partez à l''asso de ses marchés et vous aurez une des plus belle vue de Paris. De plus, un basilique est à découvrir.', 'http://upload.wikimedia.org/wikipedia/commons/8/8a/Paris_Sacre_Coeur_BW_1.jpg', 4, 1, '2015-05-26'),
(46, 'Boulevard Haussmann', 'Rue qui regroupe de nombreux grands magasins avec des bâtiments architecturals à découvrir. ', NULL, 2, 1, '2015-05-26'),
(47, 'Musée d''Orsay', 'Sa collection d''œuvre regroupe un grand nombre de toile des impressionnistes.', NULL, 1, 1, '2015-05-26'),
(48, 'Grand Palais', 'Le grand palais accueil régulièrement de nombreuses expositions sous sa majestueuse voûte en verre. ', 'http://upload.wikimedia.org/wikipedia/commons/d/d1/Grand-palais-et-pont-Alexan.jpg', 3, 1, '2015-05-26'),
(49, 'Quai de Seine ', 'Zone piétonnière près de Hôtel de Ville pour se détendre. ', NULL, 5, 1, '2015-05-17'),
(50, 'Parc zoologique de Paris', 'Au cœur de bois de Vincennes, un zoo rénové récemment offre une grande collection d''animaux.', NULL, 6, 1, '2015-05-17'),
(51, 'Opéra Garnier', NULL, 'http://upload.wikimedia.org/wikipedia/commons/d/dc/Paris_Opera_full_frontal_architecture,_May_2009.jpg', 7, 1, '2015-05-17'),
(52, 'Opéra Bastille ', NULL, NULL, 7, 1, '2015-05-17'),
(53, 'Opéra Comédie ', 'Bâtiment principal qui borde la place de la comédie il abrite l''orchestre national de Montpellier.', NULL, 7, 2, '2015-05-17'),
(54, 'Chute du Niagara', NULL, NULL, 5, 6, '2015-05-31'),
(55, 'Parlement du Canada', 'Parlement du Canada gardé par les gardes anglais opèrent chaque jour une relève de la garde. Les salles à l''intérieur sont aussi visitable ainsi on découvre des salles ornées de boiserie.', NULL, 3, 11, '2015-05-17'),
(58, 'San Antonio River Walk', 'Des terrasses animées sur les bords de la San Antonio River.', NULL, 2, 13, '2015-06-01'),
(59, 'Theatre Orange', 'Theatre romain datant de Jules César', NULL, 2, 14, '2015-06-01'),
(60, 'Musée du chocolat', NULL, NULL, 3, 1, '2015-06-01'),
(61, 'Notre Dame de Paris', NULL, NULL, 3, 1, '2015-06-01'),
(62, 'Beaubourg', '', NULL, 1, 1, '2015-06-01'),
(63, 'Parc de la tête d or', '', NULL, 6, 8, '2015-06-01'),
(64, 'Musée antropologie', '', NULL, 1, 15, '0000-00-00'),
(65, 'Mosquée Hassan II', '', NULL, 3, 16, '0000-00-00'),
(66, 'Souk', '', NULL, 8, 16, '0000-00-00');

--
-- Déclencheurs `visite`
--
DROP TRIGGER IF EXISTS `trigger_after_insert_visite`;
DELIMITER //
CREATE TRIGGER `trigger_after_insert_visite` AFTER INSERT ON `visite`
 FOR EACH ROW BEGIN 
	UPDATE mise_a_jour_bd SET Derniere_MAJ=(NOW());
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger_before_update_visite`;
DELIMITER //
CREATE TRIGGER `trigger_before_update_visite` BEFORE UPDATE ON `visite`
 FOR EACH ROW BEGIN
	SET new.Mise_A_Jour=(NOW());
END
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
