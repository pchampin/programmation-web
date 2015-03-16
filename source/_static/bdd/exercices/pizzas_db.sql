-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 16 Mars 2015 à 11:03
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pizzas_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `ID_INGREDIENT` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL_INGREDIENT` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_INGREDIENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `ingredients`
--

INSERT INTO `ingredients` (`ID_INGREDIENT`, `LABEL_INGREDIENT`) VALUES
(1, 'Emmental'),
(2, 'Mozzarella'),
(3, 'Tomate'),
(4, 'Crème'),
(5, 'Champignons'),
(6, 'Poulet'),
(7, 'Mergez'),
(8, 'Cancoillotte'),
(9, 'Pomme de terre'),
(10, 'Oignons'),
(11, 'Reblochon'),
(12, 'Boeuf Haché'),
(13, 'Poivrons'),
(14, 'Jambon'),
(15, 'Chèvre'),
(16, 'Roquefort'),
(17, 'Saumon'),
(18, 'Fruits de Mer'),
(19, 'Oeuf'),
(20, 'Ananas'),
(21, 'Lardons'),
(22, 'Viande à Kebab'),
(23, 'Chorizo');

-- --------------------------------------------------------

--
-- Structure de la table `pizzas`
--

CREATE TABLE IF NOT EXISTS `pizzas` (
  `ID_PIZZA` int(11) NOT NULL AUTO_INCREMENT,
  `NAME_PIZZA` varchar(70) NOT NULL,
  `PRICE_PIZZA` float unsigned NOT NULL,
  PRIMARY KEY (`ID_PIZZA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `pizzas`
--

INSERT INTO `pizzas` (`ID_PIZZA`, `NAME_PIZZA`, `PRICE_PIZZA`) VALUES
(1, 'Reine', 9),
(2, 'Margherita', 8),
(3, '3 Fromages', 12),
(4, 'Saumon', 11),
(5, 'Fruits de Mer', 13),
(6, 'Suprême', 15),
(7, 'Tahitienne', 14),
(8, 'Savoyarde', 13),
(9, 'Orientale', 12),
(10, 'Kebab', 13),
(11, 'Espagnole', 15),
(12, 'Calzone', 12),
(13, 'Montbéliarde', 11),
(14, 'Chef', 18);

-- --------------------------------------------------------

--
-- Structure de la table `pizzas_ingredients`
--

CREATE TABLE IF NOT EXISTS `pizzas_ingredients` (
  `ID_PIZZA` int(11) NOT NULL,
  `ID_INGREDIENT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pizzas_ingredients`
--

INSERT INTO `pizzas_ingredients` (`ID_PIZZA`, `ID_INGREDIENT`) VALUES
(1, 3),
(1, 14),
(1, 2),
(1, 5),
(2, 3),
(2, 14),
(2, 2),
(3, 4),
(3, 10),
(3, 1),
(3, 15),
(3, 16),
(4, 4),
(4, 10),
(4, 17),
(4, 2),
(5, 4),
(5, 10),
(5, 18),
(5, 2),
(6, 4),
(6, 10),
(6, 15),
(6, 6),
(6, 2),
(7, 4),
(7, 10),
(7, 6),
(7, 20),
(7, 2),
(8, 4),
(8, 10),
(8, 21),
(8, 9),
(8, 11),
(9, 3),
(9, 10),
(9, 13),
(9, 7),
(9, 2),
(10, 3),
(10, 10),
(10, 22),
(10, 2),
(11, 3),
(11, 10),
(11, 12),
(11, 23),
(11, 2),
(12, 3),
(12, 14),
(12, 19),
(12, 2),
(12, 1),
(13, 4),
(13, 10),
(13, 9),
(13, 8),
(13, 2),
(14, 3),
(14, 4),
(14, 10),
(14, 13),
(14, 6),
(14, 12),
(14, 14),
(14, 15),
(14, 17),
(14, 19),
(14, 1),
(14, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
