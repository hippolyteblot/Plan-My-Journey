-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 19 jan. 2023 à 08:54
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `plan_my_journey`
--

-- --------------------------------------------------------

--
-- Structure de la table `abstract_type`
--

CREATE TABLE `abstract_type` (
  `abstract_type_id` varchar(32) NOT NULL,
  `abstract_type_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentary`
--

CREATE TABLE `commentary` (
  `commentary_id` int(11) NOT NULL,
  `journey_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(4096) NOT NULL,
  `date` datetime NOT NULL,
  `is_reported` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `compose`
--

CREATE TABLE `compose` (
  `journey_id` int(11) NOT NULL,
  `step_id` varchar(64) NOT NULL,
  `type_id` varchar(64) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `isSelected` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `favorite`
--

CREATE TABLE `favorite` (
  `journey_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `journey`
--

CREATE TABLE `journey` (
  `journey_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(4096) NOT NULL,
  `journey_start` time NOT NULL,
  `journey_end` time NOT NULL,
  `journey_budget` int(11) NOT NULL,
  `creation_date` date NOT NULL,
  `journey_rating` int(11) NOT NULL DEFAULT '0',
  `public` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE `place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(64) NOT NULL,
  `place_fullname` varchar(128) NOT NULL,
  `place_lat` float NOT NULL,
  `place_lng` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `primary_preferences`
--

CREATE TABLE `primary_preferences` (
  `user_id` int(11) NOT NULL,
  `primary_type_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `primary_preferences`
--

INSERT INTO `primary_preferences` (`user_id`, `primary_type_id`) VALUES
(1, 'amusement_park'),
(1, 'aquarium'),
(1, 'art_gallery'),
(1, 'bakery'),
(1, 'bar'),
(1, 'church'),
(1, 'florist'),
(1, 'gym'),
(1, 'library'),
(1, 'mosque'),
(1, 'museum'),
(1, 'night_club'),
(1, 'painter'),
(1, 'supermarket'),
(1, 'synagogue'),
(1, 'university'),
(3, 'aquarium'),
(3, 'cafe'),
(3, 'church'),
(3, 'park'),
(5, 'amusement_park'),
(5, 'art_gallery'),
(5, 'bakery'),
(5, 'casino'),
(5, 'florist'),
(5, 'gym'),
(5, 'movie_rental'),
(5, 'painter'),
(5, 'park'),
(5, 'spa'),
(5, 'stadium'),
(5, 'tourist_attraction'),
(8, 'park'),
(8, 'spa'),
(8, 'university'),
(11, 'bakery'),
(11, 'bar'),
(11, 'cafe'),
(11, 'mosque'),
(11, 'stadium'),
(11, 'zoo'),
(12, 'amusement_park'),
(12, 'art_gallery'),
(12, 'bakery'),
(12, 'bar'),
(12, 'casino'),
(12, 'church'),
(12, 'florist'),
(12, 'jewelry_store'),
(12, 'movie_rental'),
(12, 'museum'),
(12, 'night_club'),
(12, 'painter'),
(12, 'park'),
(12, 'synagogue'),
(12, 'tourist_attraction');

-- --------------------------------------------------------

--
-- Structure de la table `primary_type`
--

CREATE TABLE `primary_type` (
  `primary_type_id` varchar(32) NOT NULL,
  `primary_type_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `primary_type`
--

INSERT INTO `primary_type` (`primary_type_id`, `primary_type_name`) VALUES
('amusement_park', 'Parc d\'attraction'),
('aquarium', 'Aquarium'),
('art_gallery', 'Galerie d\'art'),
('bakery', 'Boulangerie'),
('bar', 'Bar'),
('beauty_salon', 'Salon de beauté'),
('bowling_alley', 'Bowling'),
('cafe', 'Café'),
('campground', 'Terrain de camping'),
('casino', 'Casino'),
('church', 'Église'),
('embassy', 'Ambassade'),
('florist', 'Fleuriste'),
('gym', 'Gymnase'),
('jewelry_store', 'Bijouterie'),
('library', 'Bibliothèque'),
('mosque', 'Mosquée'),
('movie_rental', 'Location de films'),
('museum', 'Musée'),
('night_club', 'Boîte de nuit'),
('painter', 'Peintre'),
('park', 'Parc'),
('restaurant', 'Restaurant'),
('school', 'École'),
('shopping_mall', 'Centre commercial'),
('spa', 'Spa'),
('stadium', 'Stade'),
('supermarket', 'Supermarché'),
('synagogue', 'Synagogue'),
('tourist_attraction', 'Attraction touristique'),
('travel_agency', 'Agence de voyage'),
('university', 'Université'),
('zoo', 'Zoo');

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

CREATE TABLE `rating` (
  `journey_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `value` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `save`
--

CREATE TABLE `save` (
  `user_id` int(11) NOT NULL,
  `journey_id` int(11) NOT NULL,
  `favorite` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `secondary_preferences`
--

CREATE TABLE `secondary_preferences` (
  `secondary_type_id` varchar(32) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `secondary_preferences`
--

INSERT INTO `secondary_preferences` (`secondary_type_id`, `user_id`) VALUES
('bar_coffee_shop', 1),
('bar_coffee_shop', 5),
('bar_coffee_shop', 11),
('bar_coffee_shop', 12),
('bar_lounge', 1),
('bar_tapas', 11),
('chinese_restaurant', 1),
('chinese_restaurant', 5),
('chinese_restaurant', 8),
('chinese_restaurant', 11),
('chinese_restaurant', 12),
('fast_food', 5),
('fast_food', 8),
('fast_food', 11),
('fast_food', 12),
('food_truck', 1),
('food_truck', 11),
('food_truck', 12),
('french_restaurant', 8),
('french_restaurant', 12),
('grill', 1),
('grill', 12),
('italian_restaurant', 5),
('italian_restaurant', 8),
('italian_restaurant', 12),
('japanese_restaurant', 1),
('japanese_restaurant', 12),
('korean_restaurant', 1),
('korean_restaurant', 12),
('sandwicherie', 1),
('sandwicherie', 11),
('sandwicherie', 12),
('street_food', 1),
('street_food', 12);

-- --------------------------------------------------------

--
-- Structure de la table `secondary_type`
--

CREATE TABLE `secondary_type` (
  `secondary_type_id` varchar(32) NOT NULL,
  `secondary_type_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `secondary_type`
--

INSERT INTO `secondary_type` (`secondary_type_id`, `secondary_type_name`) VALUES
('bar_coffee_shop', 'Bar a café'),
('bar_lounge', 'Bar lounge'),
('bar_tapas', 'Bar à tapas'),
('buddhist_temple', 'Temple bouddhiste'),
('chinese_restaurant', 'Restaurant chinois'),
('climbing_wall', 'Mur d\'escalade'),
('congolese_restaurant', 'Restaurant congolais'),
('creperie', 'Creperie'),
('fast_food', 'Fast Food'),
('fooding', 'Fooding'),
('food_truck', 'Food truck'),
('french_restaurant', 'Restaurant français'),
('garden', 'Jardin'),
('gastronomic', 'Gastronomique'),
('grill', 'Grill'),
('in_the_dark', 'Dans le noir'),
('italian_restaurant', 'Restaurant italien'),
('japanese_restaurant', 'Restaurant japonais'),
('korean_restaurant', 'Restaurant coréen'),
('lake', 'Lac'),
('mexican_restaurant', 'Restaurant mexicain'),
('moroccan_restaurant', 'Restaurant marocain'),
('pagoda', 'Pagode'),
('sanctuary', 'Sanctuaire'),
('sandwicherie', 'Sandwicherie'),
('sports_hall', 'Salle de sport'),
('steak_house', 'Steak house'),
('street_food', 'Street food'),
('vegan', 'Vegan');

-- --------------------------------------------------------

--
-- Structure de la table `step`
--

CREATE TABLE `step` (
  `step_id` varchar(64) NOT NULL,
  `step_name` varchar(128) NOT NULL,
  `step_vicinity` varchar(256) NOT NULL,
  `step_lat` float NOT NULL,
  `step_lng` float NOT NULL,
  `step_rating` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type_category`
--

CREATE TABLE `type_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(64) NOT NULL,
  `structure_type` char(4) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_category`
--

INSERT INTO `type_category` (`category_id`, `category_name`, `structure_type`) VALUES
(1, 'Culture', 'A'),
(2, 'Détente', 'A'),
(3, 'Religion', 'A'),
(4, 'Asiatique', 'R'),
(5, 'Restauration rapide', 'R'),
(6, 'Boutique', 'A'),
(7, 'Sport', 'A'),
(8, 'Européen', 'R'),
(9, 'Autres', 'R'),
(10, 'Américain', 'R'),
(11, 'Africain', 'R'),
(12, 'Nature', 'A');

-- --------------------------------------------------------

--
-- Structure de la table `type_membership`
--

CREATE TABLE `type_membership` (
  `category_id` int(11) NOT NULL,
  `type_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_membership`
--

INSERT INTO `type_membership` (`category_id`, `type_id`) VALUES
(1, 'art_gallery'),
(1, 'church'),
(1, 'embassy'),
(1, 'library'),
(1, 'mosque'),
(1, 'museum'),
(1, 'painter'),
(1, 'synagogue'),
(1, 'university'),
(2, 'amusement_park'),
(2, 'aquarium'),
(2, 'bar'),
(2, 'beauty_salon'),
(2, 'bowling_alley'),
(2, 'cafe'),
(2, 'casino'),
(2, 'night_club'),
(2, 'park'),
(2, 'spa'),
(2, 'tourist_attraction'),
(2, 'zoo'),
(3, 'buddhist_temple'),
(3, 'church'),
(3, 'mosque'),
(3, 'pagoda'),
(3, 'sanctuary'),
(3, 'synagogue'),
(4, 'chinese_restaurant'),
(4, 'japanese_restaurant'),
(4, 'korean_restaurant'),
(5, 'bakery'),
(5, 'bar'),
(5, 'bar_coffee_shop'),
(5, 'bar_lounge'),
(5, 'bar_tapas'),
(5, 'creperie'),
(5, 'fast_food'),
(5, 'food_truck'),
(5, 'grill'),
(5, 'sandwicherie'),
(5, 'street_food'),
(6, 'florist'),
(6, 'jewelry_store'),
(6, 'movie_rental'),
(6, 'supermarket'),
(7, 'climbing_wall'),
(7, 'gym'),
(7, 'sports_hall'),
(7, 'stadium'),
(8, 'french_restaurant'),
(8, 'italian_restaurant'),
(8, 'steak_house'),
(9, 'gastronomic'),
(9, 'in_the_dark'),
(9, 'vegan'),
(10, 'mexican_restaurant'),
(11, 'congolese_restaurant'),
(11, 'moroccan_restaurant'),
(12, 'garden'),
(12, 'lake'),
(12, 'park');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(128) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `registration_date` date NOT NULL,
  `newsletter_subscription` tinyint(4) NOT NULL,
  `token` varchar(60) DEFAULT NULL,
  `query_counter` int(11) NOT NULL DEFAULT '0',
  `generation_token` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abstract_type`
--
ALTER TABLE `abstract_type`
  ADD PRIMARY KEY (`abstract_type_id`);

--
-- Index pour la table `commentary`
--
ALTER TABLE `commentary`
  ADD PRIMARY KEY (`commentary_id`);

--
-- Index pour la table `compose`
--
ALTER TABLE `compose`
  ADD PRIMARY KEY (`journey_id`,`step_id`,`start`,`end`);

--
-- Index pour la table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`journey_id`,`user_id`);

--
-- Index pour la table `journey`
--
ALTER TABLE `journey`
  ADD PRIMARY KEY (`journey_id`);

--
-- Index pour la table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`place_id`);

--
-- Index pour la table `primary_preferences`
--
ALTER TABLE `primary_preferences`
  ADD PRIMARY KEY (`user_id`,`primary_type_id`);

--
-- Index pour la table `primary_type`
--
ALTER TABLE `primary_type`
  ADD PRIMARY KEY (`primary_type_id`);

--
-- Index pour la table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`journey_id`,`user_id`);

--
-- Index pour la table `save`
--
ALTER TABLE `save`
  ADD PRIMARY KEY (`user_id`,`journey_id`);

--
-- Index pour la table `secondary_preferences`
--
ALTER TABLE `secondary_preferences`
  ADD PRIMARY KEY (`secondary_type_id`,`user_id`);

--
-- Index pour la table `secondary_type`
--
ALTER TABLE `secondary_type`
  ADD PRIMARY KEY (`secondary_type_id`);

--
-- Index pour la table `step`
--
ALTER TABLE `step`
  ADD PRIMARY KEY (`step_id`);

--
-- Index pour la table `type_category`
--
ALTER TABLE `type_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `type_membership`
--
ALTER TABLE `type_membership`
  ADD PRIMARY KEY (`category_id`,`type_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentary`
--
ALTER TABLE `commentary`
  MODIFY `commentary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `journey`
--
ALTER TABLE `journey`
  MODIFY `journey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pour la table `place`
--
ALTER TABLE `place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `type_category`
--
ALTER TABLE `type_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
