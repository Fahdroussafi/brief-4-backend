-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 24 jan. 2022 à 16:30
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parfume.art`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `passwd`, `phone`, `email`) VALUES
(1, 'hamzax123', '1234', '0689063923', 'g.hamza@gmail.com'),
(2, 'ayoub', '0000', '0699873923', 'g.ayoub@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `brandID` int(100) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) NOT NULL,
  PRIMARY KEY (`brandID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `brand`
--

INSERT INTO `brand` (`brandID`, `brandName`) VALUES
(1, 'GUCCI'),
(2, 'Chanel Coco'),
(3, 'Marc Jacobs'),
(4, 'Glossier You'),
(5, 'Chane'),
(6, 'Paco Rabanne');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(100) NOT NULL AUTO_INCREMENT,
  `catName` varchar(100) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`categoryID`, `catName`) VALUES
(1, 'Perfume'),
(2, 'Eau de Perfum'),
(3, 'Eau de Toilette'),
(4, 'Eau de Cologne');

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employeeID` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`employeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `employee`
--

INSERT INTO `employee` (`employeeID`, `username`, `passwd`, `phone`, `email`) VALUES
('EX1111', 'fahd', '11111', '0697352024', 'fahd@gmail.com'),
('HH123456', 'hamza_g', '1234', '+3657687873', 'hamza@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `brandID` int(100) NOT NULL,
  `categoyID` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `volume` double NOT NULL,
  `price` double NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brandID` (`brandID`,`categoyID`),
  KEY `fk_product_category` (`categoyID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `brandID`, `categoyID`, `name`, `gender`, `volume`, `price`, `image`, `description`) VALUES
(41, 3, 2, 'sauvage', 'male', 100, 100, '16430402191_3.jpg', 'this is perfume'),
(43, 5, 1, 'chanel', 'male', 50, 100, '16430393101_7.jpg', 'this is perfume'),
(44, 1, 1, 'gucci', 'male', 120, 150, '16430415741_5.jpg', 'this is perfume');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `ref` int(100) NOT NULL AUTO_INCREMENT,
  `id` int(100) NOT NULL,
  `sold` date DEFAULT NULL,
  PRIMARY KEY (`ref`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=228 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`ref`, `id`, `sold`) VALUES
(207, 41, '2022-01-24'),
(208, 41, '2022-01-24'),
(209, 41, '2022-01-24'),
(210, 41, NULL),
(211, 41, NULL),
(212, 41, NULL),
(213, 41, NULL),
(214, 41, NULL),
(215, 41, NULL),
(216, 41, NULL),
(223, 43, '2022-01-24'),
(224, 44, NULL),
(225, 44, NULL),
(226, 44, NULL),
(227, 44, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_brand` FOREIGN KEY (`brandID`) REFERENCES `brand` (`brandID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`categoyID`) REFERENCES `category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stock_product` FOREIGN KEY (`id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
