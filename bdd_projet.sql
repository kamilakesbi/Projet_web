-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2016 at 11:57 PM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `salons` (
  `idSalon` int(11) NOT NULL COMMENT 'Clé primaire',
  `started` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indique si la partie a commencé',
  `nomSalon` varchar(40) CHARACTER SET latin1 NOT NULL COMMENT 'Nom du salon',
  `nbJoueurs` int(11) NOT NULL COMMENT 'Indique le nombre de joueurs présent dans le salon',
  `idJoueurs` varchar(40) CHARACTER SET latin1  COMMENT 'indique les identifiants des joueurs dans le salon',
  `vainqueur` varchar(10) CHARACTER SET latin1 NOT NULL DEFAULT 'non defini'COMMENT 'indique pseudo du joueur qui a gagné'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversations`
--

INSERT INTO `salons` (`idSalon`, `started`, `nomSalon`, `nbJoueurs`, `idJoueurs`) VALUES
(0, 0, 'Salon1', 3 , '{0}'),
(1, 0, 'Salon2', 2 , '{1}');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `action` (
  `idAction` int(11) NOT NULL COMMENT 'Identifiant action efectuée',
  `idSalon` int(11) NOT NULL COMMENT 'Clé étrangère vers la table des salons',
  `idJoueur` int(11) NOT NULL COMMENT 'clé étrangère vers la table des joueurs',
  `action` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Contenu action'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `action` (`idAction`, `idSalon`, `idJoueur`) VALUES
(1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `joueurs` (
  `idJoueur` int(11) NOT NULL COMMENT 'clé primaire, identifiant numérique auto incrémenté',
  `pseudo` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'pseudo',
  `passe` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'mot de passe',
  `color` varchar(10) CHARACTER SET latin1 NOT NULL DEFAULT 'black' COMMENT 'indique la couleur préférée de l''utilisateur, en anglais',
  `nbVictoires` int(11) COMMENT 'indique le nombre de victoires du joueur',
  `nbDefaites` int(11) COMMENT 'indique le nombre de défaites du joueur'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `joueurs` (`idJoueur`, `pseudo`, `passe`, `color`, `nbVictoires`,`nbDefaites`) VALUES
(0, 'Kamil', '1234', 'blue', 2, 0),
(1, 'Felix', 'ok', 'green', 0, 1),
(2, 'Ulysse', '4567', 'RED', 0, 1);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `salons`
  ADD PRIMARY KEY (`idSalon`);

--
-- Indexes for table `messages`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`idAction`);

--
-- Indexes for table `users`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`idJoueur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `salons`
  MODIFY `idSalon` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `action`
  MODIFY `idAction` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id action', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `joueurs`
  MODIFY `idJoueur` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire, identifiant numérique auto incrémenté', AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
